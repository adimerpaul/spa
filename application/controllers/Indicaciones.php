<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 1/4/2019
 * Time: 15:43
 */
require('fpdf.php');
class Indicaciones extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Gestionar indicaicones';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('indicaiones');
        $data['tipo']="info";
        $data['msg']="Gestinar indicaciones";
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
<script src='".base_url()."assets/js/indicaciones.js'></script>";
        $this->load->view('templates/footer',$data);
    }
    function insert(){
        $nombre=$_POST['nombre'];

        header("Content-Type: text/html; charset=utf-8");
        $contenido=($_POST['contenido']);
        $this->db->query("INSERT INTO indicaciones(titulo,contenido) VALUES('$nombre','$contenido')");
        //echo htmlspecialchars($contenido);
        header("Location: ".base_url()."Indicaciones");
    }
    function delete($id){
        $this->db->query("DELETE FROM indicaciones WHERE idindicaciones='$id' ");

        header("Location: ".base_url()."Indicaciones");
    }
    function update(){
        header("Content-Type: text/html; charset=utf-8");
        $nombre=$_POST['nombre'];
        $id=$_POST['id'];
        $contenido=($_POST['contenido']);
        $this->db->query("UPDATE indicaciones SET
        titulo='$nombre',
        contenido='$contenido'
        WHERE idindicaciones='$id'
        ");
        //echo htmlspecialchars($contenido);
        header("Location: ".base_url()."Indicaciones");
    }
    function datos(){
        $id=$_POST['id'];
        $query=$this->db->query("SELECT * FROM indicaciones WHERE idindicaciones='$id'");
        $row=$query->row();
        echo htmlspecialchars_decode($row->contenido, ENT_NOQUOTES);
    }
    function ver($id){
        $pdf = new FPDF('P','mm','Letter');

        $nombres="NOMBRE DEL ";
        $apellidos="PACIENTE";
        $ci="8888888";
        $query=$this->db->query("SELECT * FROM indicaciones WHERE idindicaciones=$id");
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
        $pdf->MultiCell(0,4,utf8_decode("PACIENTE $nombres $apellidos "));
        $pdf->SetFont('Times','B',10);
        $pdf->MultiCell(0,4,utf8_decode("FECHA DE SU PROXIMA REVISION 01/01/2000 "));
        $pdf->SetFont('Times','',10);
        $pdf->Ln();
        $pdf->MultiCell(0,4, utf8_decode($texto));
        $pdf->Ln();$pdf->Cell(75);
        $pdf->Output();
    }
}
