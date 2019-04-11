<?php
require('fpdf.php');
class Venta extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Gestionar Venta';
        $data['css']="";
        $this->load->view('templates/header',$data);
        $this->load->view('venta');
        $data['tipo']="info";
        $data['msg']="Gestionar Venta";
        $data['js']="
<script src='".base_url()."assets/js/venta.js'></script>";
        $this->load->view('templates/footer',$data);
    }
    function insert()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $nombre = strtoupper($_POST['nombre']);
        $tipo = $_POST['tipo'];
        $query = $this->db->query("INSERT INTO tratamiento(nombre,idtipotratamiento) 
VALUES ('$nombre','$tipo');");
        header("Location: ".base_url().'Tratamientos');
    }
    function datosproducto(){
        $idproducto=$_POST['idproducto'];
        $query=$this->db->query("SELECT * FROM producto WHERE idproducto='$idproducto'");
        echo json_encode( $query->result_array());
    }
    function update()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $nombre = strtoupper($_POST['nombre']);
        $idtratamiento=$_POST['idtratamiento'];
        $tipo = $_POST['tipo'];
        $query = $this->db->query("UPDATE tratamiento SET 
        nombre='$nombre',
        idtipotratamiento='$tipo'
        WHERE
        idtratamiento='$idtratamiento';
");
        header("Location: ".base_url().'Tratamientos');
    }
    function delete($id){
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }

        $query = $this->db->query("DELETE FROM tratamiento WHERE idtratamiento='$id'");
        header("Location: ".base_url().'Tratamientos');
    }
    function imprimir(){
        $pdf = new FPDF('P','mm',array(1300,80));
        $pdf->AddPage();
        $pdf->SetFont('Courier','B',8);
        $pdf->Cell(0,3,utf8_decode('FARMACIA CHAVEZ'),0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Courier','',8);
        $pdf->Cell(0,3,utf8_decode('SUC-54 ORURO'),0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,3,utf8_decode('CALLE 6 DE OCTUBRE NRO. 6056'),0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,3,utf8_decode('Teléfono 5212961'),0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,3,utf8_decode('ORURO'),0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,3,utf8_decode('SFC:0'),0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Courier','B',8);
        $pdf->Cell(0,3,utf8_decode('FACTURA'),0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(30,3,utf8_decode('NIT:'),0,0,'L');
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(30,3,utf8_decode('133795023'),0,0,'R');
        $pdf->Ln();
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(30,3,utf8_decode('Nro. Factura:'),0,0,'L');
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(30,3,utf8_decode('18899'),0,0,'R');
        $pdf->Ln();
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(30,3,utf8_decode('Nro. Autorización:'),0,0,'L');
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(30,3,utf8_decode('271401900172073'),0,0,'R');
        $pdf->Ln();
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(0,3,utf8_decode('Venta al por menor de productos farmaceuticos,'),0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,3,utf8_decode('Medicinales, cosméticos y articulos de tocador'),0,0,'C');
        $pdf->SetFont('Courier','B',7);

        $pdf->Ln();
        $pdf->Cell(15,3,utf8_decode('Fecha:'),0,0,'L');
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(15,3,utf8_decode('01/01/200'),0,0,'R');
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(15,3,utf8_decode('Hora:'),0,0,'L');
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(15,3,utf8_decode('01:01:01'),0,0,'R');
        $pdf->Ln();
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(15,3,utf8_decode('Señor(es):'),0,0,'L');
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(30,3,utf8_decode('Adimer paul chambi ajata chambi '),0,0,'L');

        $pdf->Ln();
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(7,3,utf8_decode('Cant.'),1,0,'C');
        $pdf->Cell(30,3,utf8_decode('DETALLE '),1,0,'C');
        $pdf->Cell(9,3,utf8_decode('P/U '),1,0,'C');
        $pdf->Cell(14,3,utf8_decode('Subtotal '),1,0,'C');

        $pdf->Ln();
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(7,3,utf8_decode('1'),0,0,'C');
        $pdf->MultiCell(30,3,utf8_decode('ALCONAL GEL ALCOHOL GEL TUTI FRUTTI 900 GR '),1,'L');
        $pdf->Cell(9,3,utf8_decode('50.01 '),0,0,'C');
        $pdf->Cell(14,3,utf8_decode('50.01 '),0,0,'C');

        $pdf->Output();
    }
}