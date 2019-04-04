<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 1/4/2019
 * Time: 15:43
 */
require('fpdf.php');
class Consentimientos extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Gestionar Consentimientos';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('consentimientos');
        $data['tipo']="info";
        $data['msg']="Bienvenidos a gestinar usuarios";
        $data['js']="
<script src='".base_url()."assets/js/jquery.dataTables.min.js'></script>
<script src='".base_url()."assets/js/dataTables.buttons.min.js'></script>
<script src='".base_url()."assets/js/buttons.flash.min.js'></script>
<script src='".base_url()."assets/js/jszip.min.js'></script>
<script src='".base_url()."assets/js/pdfmake.min.js'></script>
<script src='".base_url()."assets/js/vfs_fonts.js'></script>
<script src='".base_url()."assets/js/buttons.html5.min.js'></script>
<script src='".base_url()."assets/js/buttons.print.min.js'></script>
<link rel='stylesheet' href='".base_url()."assets/dist/summernote-bs4.css'>
<script src='".base_url()."assets/dist/summernote-bs4.js'></script>
<script src='".base_url()."assets/js/consentimientos.js'></script>";
        $this->load->view('templates/footer',$data);
    }
    function insert(){
        $nombre=$_POST['nombre'];
        $contenido=nl2br(($_POST['contenido']),false);
        $this->db->query("INSERT INTO consentimiento(nombre,contenido) VALUES('$nombre','$contenido')");
        //echo htmlspecialchars($contenido);
        header("Location: ".base_url()."Consentimientos");
    }
    function delete($id){

        $this->db->query("DELETE FROM consentimiento WHERE idconsentimiento='$id' ");

        header("Location: ".base_url()."Consentimientos");
    }
    function update(){
        header("Content-Type: text/html; charset=utf-8");
        $nombre=$_POST['nombre'];
        $id=$_POST['id'];
        $contenido=($_POST['contenido']);
        $this->db->query("UPDATE consentimiento SET
        nombre='$nombre',
        contenido='$contenido'
        WHERE idconsentimiento='$id'
        ");
        //echo htmlspecialchars($contenido);
        header("Location: ".base_url()."Consentimientos");
    }
    function datos(){
        $id=$_POST['id'];
        $query=$this->db->query("SELECT * FROM consentimiento WHERE idconsentimiento='$id'");
        $row=$query->row();
        echo htmlspecialchars_decode($row->contenido, ENT_NOQUOTES);
    }
    function ver($id){
        $pdf = new FPDF('P','mm','Letter');

        $nombres="NOMBRE DEL ";
        $apellidos="PACIENTE";
        $ci="8888888";
        $query=$this->db->query("SELECT * FROM consentimiento WHERE idconsentimiento=$id");
        $row=$query->row();
        $nombre=$row->nombre;
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
            $pdf->SetFont('Times','',10);
            $pdf->Cell(11,4,utf8_decode('Oruro, '.date("d/m/Y")));
            $pdf->Ln();
            $pdf->MultiCell(0,4,utf8_decode("En forma libre y voluntaria yo, $nombres $apellidos
Identificado(a) con la cédula de identidad número $ci manifiesto que:"));
            $pdf->Ln();
            $pdf->MultiCell(0,4, utf8_decode($texto));
            $pdf->Ln();$pdf->Cell(75);
        $pdf->Cell(55,4," FIRMA PACIENTE   ",'T',0,'C');
        $pdf->Output();
    }
}