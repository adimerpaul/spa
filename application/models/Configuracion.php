<?php
/**
 * Ajustes generales del sistema guardados en la tabla `ajustes` (clave => valor).
 *
 * La tabla se crea sola la primera vez (como la papelera) y trae el logo por defecto.
 *
 * Uso:
 *   $this->Configuracion->logoUrl();                      // <img src="...">
 *   $this->Configuracion->logoPdf($pdf, 0, 4, 216, 22);   // logo centrado en una caja de FPDF/TCPDF
 */
class Configuracion extends CI_Model{
    const LOGO_DEFECTO = 'assets/images/icon/logo-esencia.png';
    const LOGO_CARPETA = 'assets/uploads/logo/';

    private $valores = null;

    function crearTabla(){
        $this->db->query("CREATE TABLE IF NOT EXISTS ajustes (
            clave VARCHAR(64) NOT NULL PRIMARY KEY,
            valor TEXT NULL,
            actualizado DATETIME NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        $this->db->query("INSERT IGNORE INTO ajustes (clave, valor, actualizado) VALUES ('logo', ?, NOW())", array(self::LOGO_DEFECTO));
    }

    function get($clave, $defecto = null){
        if ($this->valores === null){
            $this->crearTabla();
            $this->valores = array();
            foreach ($this->db->get('ajustes')->result() as $r) $this->valores[$r->clave] = $r->valor;
        }
        return isset($this->valores[$clave]) && $this->valores[$clave] !== '' ? $this->valores[$clave] : $defecto;
    }

    function set($clave, $valor){
        $this->crearTabla();
        $this->db->replace('ajustes', array('clave' => $clave, 'valor' => $valor, 'actualizado' => date('Y-m-d H:i:s')));
        $this->valores = null;
    }

    // Ruta relativa al logo actual; si el archivo ya no existe se usa el de por defecto
    function logo(){
        $logo = $this->get('logo', self::LOGO_DEFECTO);
        return is_file(FCPATH.$logo) ? $logo : self::LOGO_DEFECTO;
    }

    function logoUrl(){
        $logo = $this->logo();
        return base_url().$logo.'?v='.filemtime(FCPATH.$logo);
    }

    // Dibuja el logo dentro de la caja (x, y, ancho, alto) en mm, centrado y sin deformarlo
    function logoPdf($pdf, $x, $y, $w, $h){
        $logo = FCPATH.$this->logo();
        $info = @getimagesize($logo);
        if (!$info) return;
        $escala = min($w / $info[0], $h / $info[1]);
        $iw = $info[0] * $escala;
        $ih = $info[1] * $escala;
        $pdf->Image($logo, $x + ($w - $iw) / 2, $y + ($h - $ih) / 2, $iw, $ih);
    }

    /**
     * Guarda la imagen subida como el nuevo logo.
     * Se convierte a PNG sin transparencia (fondo blanco) y de máximo 1000px, porque FPDF
     * no soporta PNG con canal alfa.
     * @return true|string true si se guardó, o el mensaje de error
     */
    function subirLogo($archivo){
        if (empty($archivo['tmp_name']) || $archivo['error'] !== UPLOAD_ERR_OK) return 'No se recibió la imagen';
        if ($archivo['size'] > 5 * 1024 * 1024) return 'La imagen no debe pasar de 5 MB';
        $info = @getimagesize($archivo['tmp_name']);
        $tipos = array(IMAGETYPE_PNG => 'imagecreatefrompng', IMAGETYPE_JPEG => 'imagecreatefromjpeg',
            IMAGETYPE_GIF => 'imagecreatefromgif', IMAGETYPE_WEBP => 'imagecreatefromwebp');
        if (!$info || !isset($tipos[$info[2]]) || !function_exists($tipos[$info[2]])) return 'Formato no válido: usa PNG, JPG, GIF o WEBP';

        $origen = $tipos[$info[2]]($archivo['tmp_name']);
        if (!$origen) return 'No se pudo leer la imagen';
        $escala = min(1, 1000 / max($info[0], $info[1]));
        $w = max(1, (int)round($info[0] * $escala));
        $h = max(1, (int)round($info[1] * $escala));
        $img = imagecreatetruecolor($w, $h);
        imagefill($img, 0, 0, imagecolorallocate($img, 255, 255, 255));
        imagecopyresampled($img, $origen, 0, 0, 0, 0, $w, $h, $info[0], $info[1]);

        if (!is_dir(FCPATH.self::LOGO_CARPETA)) mkdir(FCPATH.self::LOGO_CARPETA, 0775, true);
        $nuevo = self::LOGO_CARPETA.'logo-'.date('YmdHis').'.png';
        $ok = imagepng($img, FCPATH.$nuevo, 6);
        imagedestroy($img);
        imagedestroy($origen);
        if (!$ok) return 'No se pudo guardar la imagen en el servidor';

        $anterior = $this->get('logo');
        $this->set('logo', $nuevo);
        $this->borrarSubido($anterior);
        return true;
    }

    function restablecerLogo(){
        $anterior = $this->get('logo');
        $this->set('logo', self::LOGO_DEFECTO);
        $this->borrarSubido($anterior);
    }

    // Solo se borran logos subidos (nunca el de por defecto ni otros archivos)
    private function borrarSubido($ruta){
        if ($ruta && strpos($ruta, self::LOGO_CARPETA) === 0 && is_file(FCPATH.$ruta)) @unlink(FCPATH.$ruta);
    }
}
