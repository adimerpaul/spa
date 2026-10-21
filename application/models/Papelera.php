<?php
/**
 * Soft delete con papelera.
 *
 * En vez de borrar directo, cada eliminación guarda en la tabla `papelera` una copia de
 * las filas borradas, incluidas las que la base de datos borra en cascada (se leen las
 * llaves foráneas ON DELETE CASCADE de information_schema). Desde la papelera se puede
 * restaurar todo con sus IDs originales.
 *
 * Uso:
 *   $this->Papelera->eliminar('paciente', array('idpaciente' => $id), 'Paciente JUAN PEREZ');
 *   // Varios pasos en una sola entrada (se ejecutan en orden: primero hijos, luego el padre)
 *   $this->Papelera->eliminar(array(
 *       array('montos', array('idcotizacion' => $id)),
 *       array('cotizacion', array('idcotizacion' => $id)),
 *   ), 'Cotización #'.$id);
 */
class Papelera extends CI_Model{
    private $cascadas = null;

    function crearTabla(){
        $this->db->query("CREATE TABLE IF NOT EXISTS papelera (
            idpapelera INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            tabla VARCHAR(64) NOT NULL,
            descripcion VARCHAR(255) NOT NULL DEFAULT '',
            filas INT NOT NULL DEFAULT 0,
            datos LONGTEXT NOT NULL,
            idusuario INT NULL,
            usuario VARCHAR(150) NULL,
            fecha DATETIME NOT NULL,
            restaurado DATETIME NULL,
            restaurado_por VARCHAR(150) NULL,
            KEY tabla (tabla),
            KEY fecha (fecha)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    }

    /**
     * @param string|array $tabla Tabla, o lista de pasos array(tabla, where)
     * @param array $where Condiciones columna => valor (si $tabla es string)
     * @return true|string true si se eliminó, o el mensaje de error
     */
    function eliminar($tabla, $where = array(), $descripcion = ''){
        $pasos = is_array($tabla) ? $tabla : array(array($tabla, $where));
        $this->crearTabla();

        // Con db_debug activo CodeIgniter corta la ejecución en un error; aquí se maneja a mano
        $debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $this->db->trans_begin();

        $grupos = array();
        $total = 0;
        $error = '';
        foreach ($pasos as $i => $paso){
            list($t, $w) = $paso;
            $capturado = array();
            $this->capturar($t, $w, 0, $capturado);
            foreach ($capturado as $g){
                $g['paso'] = $i;
                $grupos[] = $g;
                $total += count($g['filas']);
            }
            if (!$this->db->delete($t, $w)){
                $e = $this->db->error();
                $error = $e['code'] == 1451
                    ? 'No se puede eliminar: el registro está siendo usado en otra parte del sistema'
                    : 'Error al eliminar: '.$e['message'];
                break;
            }
        }

        if ($error === '' && $total > 0){
            $this->db->insert('papelera', array(
                'tabla' => $pasos[count($pasos) - 1][0],
                'descripcion' => mb_substr($descripcion !== '' ? $descripcion : $this->describir($pasos), 0, 255),
                'filas' => $total,
                'datos' => json_encode($grupos, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE),
                'idusuario' => isset($_SESSION['idusuario']) ? $_SESSION['idusuario'] : null,
                'usuario' => isset($_SESSION['nombre']) ? $_SESSION['nombre'] : null,
                'fecha' => date('Y-m-d H:i:s'),
            ));
        }

        if ($error !== '' || $this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $this->db->db_debug = $debug;
            return $error !== '' ? $error : 'Error al eliminar';
        }
        $this->db->trans_commit();
        $this->db->db_debug = $debug;
        return true;
    }

    /** @return true|string */
    function restaurar($idpapelera){
        $this->crearTabla();
        $p = $this->db->get_where('papelera', array('idpapelera' => (int)$idpapelera))->row();
        if (!$p) return 'No existe en la papelera';
        if ($p->restaurado) return 'Ya fue restaurado';

        $grupos = json_decode($p->datos, true);
        // Los pasos se ejecutaron de hijos a padre: se restaura al revés, y dentro de cada
        // paso primero las filas padre (profundidad 0) y luego las de la cascada
        usort($grupos, function ($a, $b){
            return $a['paso'] != $b['paso'] ? $b['paso'] - $a['paso'] : $a['nivel'] - $b['nivel'];
        });

        $debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $this->db->trans_begin();
        $error = '';
        foreach ($grupos as $g){
            foreach ($g['filas'] as $fila){
                if (!$this->db->insert($g['tabla'], $fila)){
                    $e = $this->db->error();
                    $error = $e['code'] == 1062
                        ? 'No se puede restaurar: ya existe un registro con el mismo ID en '.$g['tabla']
                        : 'Error al restaurar '.$g['tabla'].': '.$e['message'];
                    break 2;
                }
            }
        }
        if ($error === ''){
            $this->db->update('papelera', array(
                'restaurado' => date('Y-m-d H:i:s'),
                'restaurado_por' => isset($_SESSION['nombre']) ? $_SESSION['nombre'] : null,
            ), array('idpapelera' => $p->idpapelera));
        }

        if ($error !== '' || $this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $this->db->db_debug = $debug;
            return $error !== '' ? $error : 'Error al restaurar';
        }
        $this->db->trans_commit();
        $this->db->db_debug = $debug;
        return true;
    }

    // Lee las filas que se van a borrar y, recursivamente, las que caerían por ON DELETE CASCADE
    private function capturar($tabla, $where, $nivel, &$salida){
        if ($nivel > 6) return;
        $filas = $this->db->get_where($tabla, $where)->result_array();
        if (!$filas) return;
        $salida[] = array('tabla' => $tabla, 'nivel' => $nivel, 'filas' => $filas);

        foreach ($this->cascadas($tabla) as $c){
            $valores = array_values(array_unique(array_filter(array_column($filas, $c['padrecol']), function ($v){ return $v !== null; })));
            if (!$valores) continue;
            $this->db->where_in($c['col'], $valores);
            $this->capturar($c['hijo'], array(), $nivel + 1, $salida);
        }
    }

    private function cascadas($tabla){
        if ($this->cascadas === null){
            $this->cascadas = array();
            $rows = $this->db->query("SELECT k.TABLE_NAME hijo, k.COLUMN_NAME col, k.REFERENCED_TABLE_NAME padre, k.REFERENCED_COLUMN_NAME padrecol
                FROM information_schema.KEY_COLUMN_USAGE k
                JOIN information_schema.REFERENTIAL_CONSTRAINTS r
                  ON r.CONSTRAINT_NAME = k.CONSTRAINT_NAME AND r.CONSTRAINT_SCHEMA = k.CONSTRAINT_SCHEMA
                WHERE k.TABLE_SCHEMA = DATABASE() AND r.DELETE_RULE = 'CASCADE'")->result_array();
            foreach ($rows as $r){
                $this->cascadas[$r['padre']][] = $r;
            }
        }
        return isset($this->cascadas[$tabla]) ? $this->cascadas[$tabla] : array();
    }

    private function describir($pasos){
        list($t, $w) = $pasos[count($pasos) - 1];
        $partes = array();
        foreach ($w as $k => $v) $partes[] = "$k=$v";
        return $t.' ('.implode(', ', $partes).')';
    }
}
