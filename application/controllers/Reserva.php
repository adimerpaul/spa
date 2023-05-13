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
        $query=$this->db->query("DELETE FROM events WHERE id='$id'");
        if ($query){
            echo 1;
        }
        exit;
    }
    function datos(){
        $id=$_POST['id'];

        $query=$this->db->query("SELECT * FROM paciente WHERE idpaciente='$id'");
        echo json_encode($query->result_array());
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
        $pdf->Image('assets/img/spa.png',0,0,216);
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
