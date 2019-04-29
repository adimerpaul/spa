<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 26/3/2019
 * Time: 19:10
 */
require('fpdf.php');
class Consulta extends CI_Controller{

    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Controlar consulta';
        if (isset($_POST['fecha'])){
            $fecha=$_POST['fecha'];
        }else{
            $fecha=date("Y-m-d");
        }
        $data['fecha']=$fecha;
        $data['css']="";
        $this->load->view('templates/header',$data);
        $this->load->view('consulta',$fecha);
        $data['tipo']="info";
        $data['msg']="Consulta";
        $data['js']="";
        $this->load->view('templates/footer',$data);
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