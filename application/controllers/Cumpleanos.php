<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 26/3/2019
 * Time: 19:10
 */
require('fpdf.php');
class Cumpleanos extends CI_Controller{

    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Cumpleaños';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('cumpleanos');
        $data['tipo']="success";
        $data['msg']="Cumpleaños del mes";
        $data['js']="
<script src='".base_url()."assets/js/jquery.dataTables.min.js'></script>
<script src='".base_url()."assets/js/dataTables.buttons.min.js'></script>
<script src='".base_url()."assets/js/buttons.flash.min.js'></script>
<script src='".base_url()."assets/js/jszip.min.js'></script>
<script src='".base_url()."assets/js/pdfmake.min.js'></script>
<script src='".base_url()."assets/js/vfs_fonts.js'></script>
<script src='".base_url()."assets/js/buttons.html5.min.js'></script>
<script src='".base_url()."assets/js/buttons.print.min.js'></script>
<script src='".base_url()."assets/js/moment.js'></script>";
        $this->load->view('templates/footer',$data);
    }

    function pacientesGet(){
        $mount=$this->input->post('mount');
        $query=$this->db->query("SELECT *, DATE_FORMAT(fechanac,'%d/%m/%Y') as fechanacformat, TIMESTAMPDIFF(YEAR,fechanac,CURDATE()) AS edad,
        DATEDIFF(CURDATE(),fechanac) - TIMESTAMPDIFF(YEAR,fechanac,CURDATE()) * 365 AS dias,
       'a' opciones 
        FROM paciente WHERE MONTH(fechanac)='$mount' Order by fechanac");
        $data['data']=$query->result();
        echo json_encode($data);
    }
    function imprimir($idcotizacion=""){
        $pdf = new FPDF('P','mm','Letter');
        $pdf->AddPage();

        $pdf->Image('assets/img/spa.png',0,0,216);

        $pdf->Ln(19);
        $query=$this->db->query("SELECT * FROM soap WHERE idcotizacion='$idcotizacion'");
        foreach ($query->result() as $row){
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(3,5,utf8_decode($row->fecha));
            $pdf->Ln();
            $pdf->SetFont('Arial','',10);
            $pdf->MultiCell(170,5,utf8_decode($row->subjetivo." ".$row->objetivo." ".$row->analisis." ".$row->plan));
            $pdf->Ln();
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(100,5,utf8_decode("Monto/adelanto :".$row->monto."   Fecha: ".$row->fecha));
            $pdf->Cell(80,5,utf8_decode($this->User->consulta('nombre','usuario','idusuario',$row->idusuario)),0,0,'R');
            $pdf->Ln();
        }
        $pdf->Output();

    }
}