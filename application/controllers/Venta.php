<?php
require('mc_table.php');
require('NumeroALetras.php');
require "phpqrcode/qrlib.php";
require "ControlCode.php";
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
        $query=$this->db->query("SELECT * FROM dosificacion WHERE estado='ACTIVO' ORDER BY iddosificacion desc");
        $row=$query->row();
        $desde = $row->desde;
        $hasta = $row->hasta;
        $nrotramite = $row->nrotramite;
        $nroautorizacion = $row->nroautorizacion;
        $nrofactura = $row->nrofactura;
        $llave = $row->llave;
        $leyenda = $row->leyenda;
        $iddosificacion = $row->iddosificacion;
        $query=$this->db->query("SELECT count(*)+1 as cantidad FROM factura WHERE iddosificacion=$iddosificacion");
        $row=$query->row();
        $numerodefactura=$row->cantidad;
        $class2 = new ControlCode();
        $nitci="7336199013";
        $fecha=date("Ymd");
        $monto="120.50";
        $codigo=$class2->generate($nroautorizacion, $numerodefactura, $nitci,$fecha, $monto, $llave);
        $idpaciente=$_POST['idpaciente'];
        $total=$_POST['total'];
        $query=$this->db->query("INSERT INTO factura(idpaciente,total) VALUES('$idpaciente','$total')");
        $idfacura=$this->db->insert_id();
        $query=$this->db->query("SELECT * FROM producto");
        foreach ($query->result() as $row){
            if(isset($_POST['p'.$row->idproducto])){
                $query=$this->db->query("INSERT INTO detallefactura(
idfactura,
idproducto,
precio,
cantidad,
subtotal) 
VALUES(
'$idfacura',
'$row->idproducto',
'".$_POST['p'.$row->idproducto]."',
'".$_POST['c'.$row->idproducto]."',
'".$_POST['s'.$row->idproducto]."'
)");
            }
        }



        $total="7841.98";
        $pdf=new PDF_MC_Table('P','mm',array(1300,80));
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

        $pdf->Ln(4);
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(8,3,utf8_decode('Cant.'),0,0,'C');
        $pdf->Cell(32,3,utf8_decode('DETALLE '),0,0,'C');
        $pdf->Cell(10,3,utf8_decode('P/U '),0,0,'C');
        $pdf->Cell(13,3,utf8_decode('Subtotal '),0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Courier','',7);
        $pdf->SetWidths(array(8,32,10,13));
        $pdf->Row(array("1",utf8_decode("ALCONAL GEL ALCOHOL GEL TUTI GEL TUTI FRUTTI 900"),"58.78","85.78"));


        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(30,3,utf8_decode('TOTAL BS.: '),0,0,'R');
        $pdf->Cell(30,3,utf8_decode($total),0,0,'R');
        $pdf->Ln();
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(30,3,utf8_decode('DESCUENTO : '),0,0,'R');
        $pdf->Cell(30,3,utf8_decode(0),0,0,'R');
        $decimales = explode('.',$total);

        $letras = (string)NumeroALetras::convertir($decimales[0]);

        $pdf->Ln();
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(30,3,utf8_decode('TOTAL NETO BS.: '),0,0,'R');
        $pdf->Cell(30,3,utf8_decode($total),0,0,'R');

        $pdf->Ln(4);
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(8,3,utf8_decode('Son : '),0,0,'L');
        $pdf->SetFont('Courier','',7);
        $pdf->MultiCell(52,3,utf8_decode(ucfirst(strtolower($letras))).$decimales[1]."/100 Bolivianos");

        //Declaramos una carpeta temporal para guardar la imagenes generadas
        $dir = 'temp/';
        //Si no existe la carpeta la creamos
        if (!file_exists($dir))
            mkdir($dir);
        //Declaramos la ruta y nombre del archivo a generar
        $filename = $dir.'test.png';
        //Parametros de Condiguración

        $tamaño = 10; //Tamaño de Pixel
        $level = 'L'; //Precisión Baja
        $framSize = 3; //Tamaño en blanco
        $contenido = "http://codigosdeprogramacion.com"; //Texto
        //Enviamos los parametros a la Función para generar código QR
        QRcode::png($contenido, $filename, $level, $tamaño, $framSize);
        //Mostramos la imagen generada
        //echo '<img src="'.base_url().$dir.basename($filename).'" />';

        $pdf->Image(base_url().$dir.basename($filename),25,81,30);
        $pdf->Ln(28);
        $pdf->SetFont('Courier','',7);
        $pdf->MultiCell(0,3,utf8_decode("LEY Nº 453 Está prohibido importar, distribuir o comercializar productos expirados o prontos a expirar."));
        $pdf->MultiCell(0,3,utf8_decode("Ud. fue atendido por: ".$_SESSION['nombre']));
        $pdf->MultiCell(0,3,utf8_decode("Si desea comentar sobre la atencion, llame al 69002326."));
        $pdf->MultiCell(0,3,utf8_decode("GRACIAS POR SU PREFERENCIA."),0,'C');
        $pdf->Output();

    }
}