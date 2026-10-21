<?php
/**
 * Created by PhpStorm.
 * User: Adimer
 * Date: 31/01/2019
 * Time: 19:41
 */
require('fpdf.php');
class Reserva extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Reserva de pacientes';
        $data['css']="
<link href='".base_url()."assets/packages/core/main.css' rel='stylesheet' />
<link href='".base_url()."assets/packages/daygrid/main.css' rel='stylesheet' />
<link href='".base_url()."assets/packages/timegrid/main.css' rel='stylesheet' />
<link href='".base_url()."assets/packages/list/main.css' rel='stylesheet' />";
        $this->load->view('templates/header',$data);
        $this->load->view('reservas');
        $data['tipo']="info";
        $data['msg']="Reserva de pacientes";
        $data['js']="
<script src='".base_url()."assets/packages/core/main.js'></script>
<script src='".base_url()."assets/packages/core/locales-all.js'></script>
<script src='".base_url()."assets/packages/interaction/main.js'></script>
<script src='".base_url()."assets/packages/daygrid/main.js'></script>
<script src='".base_url()."assets/packages/timegrid/main.js'></script>
<script src='".base_url()."assets/packages/list/main.js'></script>
<script src='".base_url()."assets/js/moment.js'></script>";
        $this->load->view('templates/footer',$data);
    }
    function insert()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $start=$_POST['start'];
        $end=$_POST['end'];
        $descripcion=$_POST['descripcion'];
        $idpaciente=$_POST['idpaciente'];
        $nombres=$_POST['nombres'];
        $apellidos=$_POST['apellidos'];

        if ($idpaciente==''){
            $this->db->query("INSERT INTO paciente SET nombres='$nombres',apellidos='$apellidos'");
            $idpaciente=$this->db->insert_id();
        }
        $title=$this->User->consulta('nombres','paciente','idpaciente',$idpaciente)." ".$this->User->consulta('apellidos','paciente','idpaciente',$idpaciente);

        $this->db->query("INSERT INTO `events` (
                    `title` ,
                    `start` ,
                    `end` ,
                    `idpaciente`,
                    idusuario,
                    descripcion 
                    )
                    VALUES (
                    '".$title."',
                    '".date('Y-m-d H:i:s',strtotime($_POST["start"]))."',
                    '".date('Y-m-d H:i:s',strtotime($_POST["end"]))."',
                    '".$idpaciente."',
                    '".$_SESSION['idusuario']."',
                    '".$_POST['descripcion']."'
                    )");


        header('Content-Type: application/json');
        echo '{"id":"'.$this->db->insert_id().'","title":"'.$title.'"}';
        exit;

        //header("Location: ".base_url()."Reserva");
        //header('Content-Type: application/json');
        //echo '{"id":"'.$this->db->insert_id().'"}';
        //exit;
    }
    function update(){
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $start=$_POST['start'];
        $end=$_POST['end'];
        $descripcion=$_POST['descripcion'];
        $idpaciente=$_POST['idpaciente'];
        $id=$_POST['id'];

        $title=$this->User->consulta('nombres','paciente','idpaciente',$idpaciente)." ".$this->User->consulta('apellidos','paciente','idpaciente',$idpaciente);

        $this->db->query("UPDATE events SET
            title ='$title',
            start = '$start',
            `end` ='$end',
            idpaciente='$idpaciente',
            idusuario='".$_SESSION['idusuario']."',
            descripcion='$descripcion'
            WHERE id='$id'
        ");
        header("Location: ".base_url()."Reserva");
    }
    function reservas(){
        header('Content-Type: application/json');

        $query=$this->db->query("SELECT * FROM  events");
        foreach ($query->result() as $row){
            $events[] = $row;
        }
        echo json_encode($events);
        exit;
    }
    function delete(){
        $id=$_POST['id'];
        if ($this->Papelera->eliminar('events', array('id' => (int)$id), 'Reserva #'.(int)$id) === true){
            echo 1;
        }
        exit;
    }
    function datos(){
        $id=$_POST['id'];

        $query=$this->db->query("SELECT * FROM paciente WHERE idpaciente='$id'");
        echo json_encode($query->result_array());
    }
    // ---- API JSON para la interfaz Vue ----
    private function json($data, $status = 200){
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    private function requiereSesion(){
        if (empty($_SESSION['tipo'])){
            $this->json(array('error' => 'Sesión expirada'), 401);
        }
    }
    private function fecha($valor){
        $t = strtotime((string)$valor);
        return $t ? date('Y-m-d H:i:s', $t) : null;
    }

    function eventos(){
        $this->requiereSesion();
        $desde = $this->fecha($this->input->get('start'));
        $hasta = $this->fecha($this->input->get('end'));
        if (!$desde || !$hasta){
            $this->json(array('error' => 'Rango inválido'), 422);
        }
        $rows = $this->db->query("SELECT e.id, TRIM(e.title) title,
                DATE_FORMAT(e.start,'%Y-%m-%dT%H:%i:%s') start, DATE_FORMAT(e.end,'%Y-%m-%dT%H:%i:%s') end,
                e.idpaciente, e.idusuario, e.descripcion, u.nombre usuario, p.celular, p.ci
            FROM events e
            LEFT JOIN usuario u ON u.idusuario = e.idusuario
            LEFT JOIN paciente p ON p.idpaciente = e.idpaciente
            WHERE e.start < ? AND e.end > ?
            ORDER BY e.start", array($hasta, $desde))->result();
        $this->json($rows);
    }

    function guardar(){
        $this->requiereSesion();
        $start = $this->fecha($this->input->post('start'));
        $end = $this->fecha($this->input->post('end'));
        if (!$start || !$end || $end <= $start){
            $this->json(array('error' => 'Revisa la fecha y la hora'), 422);
        }

        $idpaciente = (int)$this->input->post('idpaciente');
        if (!$idpaciente){
            // Paciente nuevo creado desde la reserva
            $nombres = mb_strtoupper(trim((string)$this->input->post('nombres')));
            if ($nombres === ''){
                $this->json(array('error' => 'Selecciona o registra un paciente'), 422);
            }
            $this->db->insert('paciente', array(
                'nombres' => $nombres,
                'apellidos' => mb_strtoupper(trim((string)$this->input->post('apellidos'))),
                'celular' => trim((string)$this->input->post('celular')),
                'idusuario' => $_SESSION['idusuario'],
            ));
            $idpaciente = $this->db->insert_id();
        }
        $p = $this->db->query("SELECT nombres, apellidos FROM paciente WHERE idpaciente = ?", array($idpaciente))->row();
        if (!$p){
            $this->json(array('error' => 'Paciente no encontrado'), 422);
        }

        $datos = array(
            'title' => trim($p->nombres.' '.$p->apellidos),
            'start' => $start,
            'end' => $end,
            'idpaciente' => $idpaciente,
            'idusuario' => $_SESSION['idusuario'],
            'descripcion' => trim((string)$this->input->post('descripcion')),
        );
        $id = (int)$this->input->post('id');
        if ($id){
            $this->db->update('events', $datos, array('id' => $id));
        }else{
            $this->db->insert('events', $datos);
            $id = $this->db->insert_id();
        }
        $this->json(array('id' => $id, 'idpaciente' => $idpaciente));
    }

    // Arrastrar o cambiar la duración desde el calendario
    function mover(){
        $this->requiereSesion();
        $start = $this->fecha($this->input->post('start'));
        $end = $this->fecha($this->input->post('end'));
        if (!$start || !$end || $end <= $start){
            $this->json(array('error' => 'Horario inválido'), 422);
        }
        $this->db->update('events', array('start' => $start, 'end' => $end), array('id' => (int)$this->input->post('id')));
        $this->json(array('ok' => true));
    }

    function eliminar(){
        $this->requiereSesion();
        $id = (int)$this->input->post('id');
        $e = $this->db->query("SELECT title, DATE_FORMAT(start,'%d/%m/%Y %H:%i') f FROM events WHERE id = ?", array($id))->row();
        $r = $this->Papelera->eliminar('events', array('id' => $id), $e ? 'Reserva '.$e->f.' - '.trim($e->title) : 'Reserva #'.$id);
        if ($r !== true) $this->json(array('error' => $r), 422);
        $this->json(array('ok' => true));
    }

    // Datos auxiliares del formulario: descripciones frecuentes e indicaciones para imprimir
    function opciones(){
        $this->requiereSesion();
        $frecuentes = $this->db->query("SELECT TRIM(descripcion) d, COUNT(*) c FROM events
            WHERE TRIM(descripcion) <> '' AND start > NOW() - INTERVAL 1 YEAR
            GROUP BY TRIM(descripcion) ORDER BY c DESC LIMIT 8")->result();
        $indicaciones = $this->db->query("SELECT idindicaciones, titulo FROM indicaciones ORDER BY titulo")->result();
        $this->json(array(
            'frecuentes' => array_map(function ($r) { return $r->d; }, $frecuentes),
            'indicaciones' => $indicaciones,
        ));
    }

    function imprimir($idindicaciones,$idpaciente,$hora){
        $pdf = new FPDF('P','mm','Letter');
        $hora=str_replace('T',' ',$hora);


        $nombres=$this->User->consulta('nombres','paciente','idpaciente',$idpaciente);
        $apellidos=$this->User->consulta('apellidos','paciente','idpaciente',$idpaciente);
        //$ci=$this->User->consulta('nombres','paciente','idpaciente',$idpaciente);
        $query=$this->db->query("SELECT * FROM indicaciones WHERE idindicaciones=$idindicaciones");
        $row=$query->row();
        $nombre=$row->titulo;
        $contenido=$row->contenido;

        $texto= htmlspecialchars_decode($contenido, ENT_NOQUOTES);
        $pdf->AddPage();
        $this->Configuracion->logoPdf($pdf, 0, 4, 216, 22);
        $pdf->Ln(19);
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(5);
        $pdf->MultiCell(185,4,utf8_decode($nombre),'B','C' );
        $pdf->SetFont('Times','',10);
        $pdf->Ln();

        $pdf->Cell(11,4,utf8_decode('Oruro, '.date("d/m/Y")));
        $pdf->Ln();
        $pdf->MultiCell(0,4,utf8_decode("PACIENTE : $nombres $apellidos "));
        $pdf->SetFont('Times','B',10);
        $pdf->MultiCell(0,4,utf8_decode("FECHA DE SU PROXIMA REVISION $hora"));
        $pdf->SetFont('Times','',10);
        $pdf->Ln();
        $pdf->MultiCell(0,4, utf8_decode($texto));
        $pdf->Ln();$pdf->Cell(75);
        $pdf->Output();
    }

}
