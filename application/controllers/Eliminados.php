<?php
// Papelera: registros eliminados (soft delete) que el administrador puede revisar y restaurar
class Eliminados extends CI_Controller{
    private function json($data, $status = 200){
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_INVALID_UTF8_SUBSTITUTE);
        exit;
    }
    private function requiereAdmin(){
        if (empty($_SESSION['tipo'])){
            $this->json(array('error' => 'Sesión expirada'), 401);
        }
        if ($_SESSION['tipo'] != 'ADMIN'){
            $this->json(array('error' => 'Solo el administrador puede ver la papelera'), 403);
        }
        $this->Papelera->crearTabla();
    }

    function lista(){
        $this->requiereAdmin();
        $search = trim((string)$this->input->get('search'));
        $page = max(1, (int)$this->input->get('page'));
        $per = min(100, max(5, (int)$this->input->get('per') ?: 20));
        $estado = $this->input->get('estado');

        $where = array();
        $params = array();
        if ($search !== ''){
            $like = '%'.$this->db->escape_like_str($search).'%';
            $where[] = "(descripcion LIKE ? OR tabla LIKE ? OR usuario LIKE ?)";
            array_push($params, $like, $like, $like);
        }
        if ($estado === 'pendientes') $where[] = 'restaurado IS NULL';
        if ($estado === 'restaurados') $where[] = 'restaurado IS NOT NULL';
        $w = $where ? 'WHERE '.implode(' AND ', $where) : '';

        $total = $this->db->query("SELECT COUNT(*) c FROM papelera $w", $params)->row()->c;
        $offset = ($page - 1) * $per;
        $rows = $this->db->query("SELECT idpapelera, tabla, descripcion, filas, usuario,
                DATE_FORMAT(fecha,'%d/%m/%Y %H:%i') fecha, DATE_FORMAT(restaurado,'%d/%m/%Y %H:%i') restaurado, restaurado_por
            FROM papelera $w ORDER BY idpapelera DESC LIMIT $offset, $per", $params)->result();
        $this->json(array('rows' => $rows, 'total' => (int)$total));
    }

    function detalle($id){
        $this->requiereAdmin();
        $p = $this->db->get_where('papelera', array('idpapelera' => (int)$id))->row();
        if (!$p) $this->json(array('error' => 'No encontrado'), 404);
        $this->json(array('grupos' => json_decode($p->datos, true)));
    }

    function restaurar(){
        $this->requiereAdmin();
        $r = $this->Papelera->restaurar((int)$this->input->post('id'));
        if ($r !== true) $this->json(array('error' => $r), 422);
        $this->json(array('ok' => true));
    }
}
