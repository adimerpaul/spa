<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 26/3/2019
 * Time: 19:10
 */
require('fpdf.php');
class Soap extends CI_Controller{


    function index($idcotizacion=""){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Controlar Soap';
        $data['idcotizacion']=$idcotizacion;

        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('soap');
        $data['tipo']="info";
        $data['msg']="Soap";
        $data['js']="<script src='".base_url()."assets/js/jquery-3.3.1.js'></script>
<script src='".base_url()."assets/js/jquery.dataTables.min.js'></script>
<script src='".base_url()."assets/js/dataTables.buttons.min.js'></script>
<script src='".base_url()."assets/js/buttons.flash.min.js'></script>
<script src='".base_url()."assets/js/jszip.min.js'></script>
<script src='".base_url()."assets/js/pdfmake.min.js'></script>
<script src='".base_url()."assets/js/vfs_fonts.js'></script>
<script src='".base_url()."assets/js/buttons.html5.min.js'></script>
<script src='".base_url()."assets/js/buttons.print.min.js'></script>
<script src='".base_url()."assets/js/paciente.js'></script>";
        $this->load->view('templates/footer',$data);
    }
    function insert(){
        $idcotizacion=$_POST['idcotizacion'];
        $idtratamiento=$_POST['idtratamiento'];
        $subjetivo=$_POST['subjetivo'];
        $objetivo=$_POST['objetivo'];
        $analisis=$_POST['analisis'];
        $plan=$_POST['plan'];
        $monto=$_POST['monto'];
        $obs=$_POST['obs'];
        $cub=$_POST['cub'];
        $plan=$_POST['plan'];
        //echo $plan;
        $this->db->query("INSERT INTO soap(subjetivo,objetivo,analisis,plan,idusuario,idcotizacion,monto) VALUES('$subjetivo','$objetivo','$analisis','$plan','".$_SESSION['idusuario']."','$idcotizacion','$monto')");
        $this->db->query("INSERT INTO montos(monto,idcotizacion,idtratamiento,obs,cub,idusuario) VALUES('$monto','$idcotizacion','$idtratamiento','$obs','$cub','".$_SESSION['idusuario']."')");

       // exit;
        header("Location: ".base_url()."Soap/index/$idcotizacion");
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