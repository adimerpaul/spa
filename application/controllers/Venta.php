<?php



require('mc_table.php');
require('NumeroALetras.php');
require "phpqrcode/qrlib.php";
require "ControlCode.php";
require "autoload.php";
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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
    function cliente(){
        $ci=$_POST['ci'];
        $query=$this->db->query("SELECT * FROM paciente WHERE ci='$ci'");
        //$row=$query->row();
        echo json_encode($query->result_array());
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
        $nrofactura = $row->nrofacturai;
        $llave = $row->llave;
        $leyenda = $row->leyenda;
        $iddosificacion = $row->iddosificacion;
        $query=$this->db->query("SELECT count(*)+1 as cantidad FROM factura WHERE iddosificacion=$iddosificacion");
        $row=$query->row();
        $numerodefactura=$row->cantidad;
        $class2 = new ControlCode();
        $nitci="170444028";
        $fecha=date("Ymd");
        //$monto="120.50";

        $query=$this->db->query("SELECT *  FROM paciente WHERE ci='".$_POST['ci']."'");
        //$row=$query->row();
        //$nombres=$row->nombres;
        //$apellidos=$row->apellidos;
        $total= number_format( $_POST['total'],2);
        $monto=$total;
        if ($query->num_rows()==0){
            $nombres=$_POST['nombres'];
            $apellidos=$_POST['apellidos'];
            $query=$this->db->query("INSERT INTO paciente(ci,apellidos,nombres) VALUES('".$_POST['ci']."','$apellidos','$nombres')");
        }
        $idpaciente=$this->User->consulta('idpaciente','paciente','ci',$_POST['ci']);
        $codigo=$class2->generate($nroautorizacion, $numerodefactura, $nitci,$fecha, $monto, $llave);
        //echo $codigo;
        $query=$this->db->query("INSERT INTO factura(
idpaciente,
total,
codigocontrol,
iddosificacion,
nrofactura,
idusuario) VALUES(
'$idpaciente',
'$total',
'$codigo',
'$iddosificacion',
'$numerodefactura',
'".$_SESSION['idusuario']."')");

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
        header("Location: ".base_url()."Venta/printfactura/".$idfacura);





/*

        //$total="7841.98";
        $pdf=new PDF_MC_Table('P','mm',array(250,80));
        $pdf->AddPage();
        $pdf->SetFont('Courier','B',8);
        $pdf->Cell(0,3,utf8_decode('ESCENCIA SPA MEDICO LTDA.'),0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(0,3,utf8_decode('Lo ultimo en tecnologia estetica sin cirugia'),0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,3,utf8_decode('CALLE BOLIVAR ENTRE POTOSI y 6 DE OCTUBRE '),0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,3,utf8_decode('NRO. 440(ZONA: CENTRAL)'),0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,3,utf8_decode('Teléfono 5210229 Celular: 60413300'),0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,3,utf8_decode('ORURO-BOLIVIA'),0,0,'C');

        $pdf->Ln();
        $pdf->SetFont('Courier','B',8);
        $pdf->Cell(0,3,utf8_decode('FACTURA'),0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(30,3,utf8_decode('NIT:'),0,0,'L');
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(30,3,utf8_decode('170444028'),0,0,'R');
        $pdf->Ln();
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(30,3,utf8_decode('Nro. Factura:'),0,0,'L');
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(30,3,utf8_decode($numerodefactura),0,0,'R');
        $pdf->Ln();
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(30,3,utf8_decode('Nro. Autorización:'),0,0,'L');
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(30,3,utf8_decode($nroautorizacion),0,0,'R');
        $pdf->Ln();
        //$pdf->SetFont('Courier','',7);
       // $pdf->Cell(0,3,utf8_decode('Venta al por menor de productos farmaceuticos,'),0,0,'C');
        //$pdf->Ln();
        //$pdf->Cell(0,3,utf8_decode('Medicinales, cosméticos y articulos de tocador'),0,0,'C');
        //$pdf->SetFont('Courier','B',7);

        //$pdf->Ln();
        $pdf->Cell(15,3,utf8_decode('Fecha:'),0,0,'L');
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(15,3,utf8_decode(date('d/m/Y')),0,0,'R');
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(15,3,utf8_decode('Hora:'),0,0,'L');
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(15,3,utf8_decode(date('H:i')),0,0,'R');
        $pdf->Ln();
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(15,3,utf8_decode('Señor(es):'),0,0,'L');
        $pdf->SetFont('Courier','',7);
        $pdf->Cell(30,3,utf8_decode($apellidos." ".$nombres),0,0,'L');

        $pdf->Ln(4);
        $pdf->SetFont('Courier','B',7);
        $pdf->Cell(8,3,utf8_decode('Cant.'),0,0,'C');
        $pdf->Cell(32,3,utf8_decode('DETALLE '),0,0,'C');
        $pdf->Cell(10,3,utf8_decode('P/U '),0,0,'C');
        $pdf->Cell(13,3,utf8_decode('Subtotal '),0,0,'C');

        $query=$this->db->query("SELECT * FROM detallefactura d
        INNER JOIN producto p ON d.idproducto=p.idproducto
 WHERE idfactura='$idfacura'");
        $yi=55;
        foreach ($query->result() as $row){
            $yi=$yi+15;
            $pdf->Ln();
            $pdf->SetFont('Courier','',7);
            $pdf->SetWidths(array(8,32,10,13));
            $pdf->Row(array("$row->cantidad",utf8_decode("$row->nombre"),"$row->precio","$row->subtotal"));
        }

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

        $pdf->Image(base_url().$dir.basename($filename),25,$yi,30);
        $pdf->Ln(30);
        $pdf->SetFont('Courier','',7);
        $pdf->MultiCell(0,3,utf8_decode("LEY Nº 453 Está prohibido importar, distribuir o comercializar productos expirados o prontos a expirar."));
        $pdf->MultiCell(0,3,utf8_decode("Ud. fue atendido por: ".$_SESSION['nombre']));
        $pdf->MultiCell(0,3,utf8_decode("Si desea comentar sobre la atencion, llame al 69002326."));
        $pdf->MultiCell(0,3,utf8_decode("GRACIAS POR SU PREFERENCIA."),0,'C');
        $pdf->Output();*/

    }
    public function printfactura($idfactura){
        $nombre_impresora = "POS";




        /*
            Intentaremos cargar e imprimir
            el logo
        */

        /*
            Ahora vamos a imprimir un encabezado
        */
        $query=$this->db->query("SELECT * FROM factura f
INNER JOIN dosificacion d ON f.iddosificacion=d.iddosificacion
INNER JOIN paciente p ON p.idpaciente=f.idpaciente
WHERE f.idfactura='$idfactura'");
        $row=$query->row();
        $nrofactura=$row->nrofactura;
        $nroautorizacion=$row->nroautorizacion;
        $total=number_format($row->total,2);
        $d = explode('.',$total);
        $entero=$d[0];
        $decimal=$d[1];
        $fecha=$row->fecha;
        $nombres=$row->nombres;
        $apellidos=$row->apellidos;
        $ci=$row->ci;
        $codigocontrol=$row->codigocontrol;
        $hasta=$row->hasta;
        $leyenda=$row->leyenda;
        $nit="170444028";


        $connector = new WindowsPrintConnector($nombre_impresora);
        $printer = new Printer($connector);
        echo 1;
        /*
            Vamos a imprimir un logotipo
            opcional. Recuerda que esto
            no funcionará en todas las
            impresoras

            Pequeña nota: Es recomendable que la imagen no sea
            transparente (aunque sea png hay que quitar el canal alfa)
            y que tenga una resolución baja. En mi caso
            la imagen que uso es de 250 x 250
        */

# Vamos a alinear al centro lo próximo que imprimamos
        $printer->setJustification(Printer::JUSTIFY_CENTER);

        $printer->text("\n"."ESCENCIA SPA MEDICO LTDA." . "\n");
        $printer->text("Lo ultimo en tecnologia estetica sin cirugia" . "\n");
        $printer->text("CALLE BOLIVAR ENTRE POTOSI y 6 DE OCTUBRE NRO. 440(ZONA: CENTRAL)" . "\n");
        $printer->text("Teléfono 5210229 Celular: 60413300" . "\n");
        $printer->text("ORURO-BOLIVIA" . "\n");
        $printer->text("FACTURA". "\n");
        $printer->text("-----------------------------" . "\n");
        $printer->text("NIT: 170444028 \n");
        $printer->text("NRO FACTURA:$nrofactura \n");
        $printer->text("NRO AUTORIZACION: $nroautorizacion". "\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("FECHA: $fecha\n");
        $printer->text("Señor(es): $apellidos $nombres \n");
        $printer->text("CI/NIT: $ci". "\n");
        $printer->text("-----------------------------" . "\n");
        $printer->text("CANT  DESCRIPCION    P.U   IMP.\n");
        $printer->text("-----------------------------"."\n");
        /*
            Ahora vamos a imprimir los
            productos
        */
        /*Alinear a la izquierda para la cantidad y el nombre*/
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $query=$this->db->query("SELECT * FROM detallefactura d 
INNER JOIN producto p ON p.idproducto=d.idproducto
WHERE d.idfactura='$idfactura'");
        foreach ($query->result() as $row){
            $printer->text("$row->nombre\n");
            $printer->text( "$row->cantidad           $row->precio $row->subtotal   \n");
        }
        /*
            Terminamos de imprimir
            los productos, ahora va el total
        */
        $printer->text("-----------------------------"."\n");
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->text("SUBTOTAL: $total Bs.\n");
        $printer->text("IVA: 0.00 Bs.\n");
        $printer->text("TOTAL: $total Bs.\n");

        /*
            Podemos poner también un pie de página
        */
        $c= new NumeroALetras();
        $printer->text("SON: ".$c->convertir($entero)." $decimal/100 Bs.\n");
        $printer->text("-----------------------------"."\n");
        $printer->text("Cod. de Control: ".$codigocontrol." \n");
        $printer->text("Fecha Lim. de Emision: ".substr($hasta,0,10)."\n");


        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $testStr = "$nit|$nrofactura|$nroautorizacion|".date('d/m/Y',$fecha)."|$total|$total|$codigocontrol|$ci|0|0|0|0";
        $models = array(
            //Printer::QR_MODEL_1 => "QR Model 1",
            Printer::QR_MODEL_2 => "ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS. EL USO ILICITO DE ESTA SERA SANCIONADO DE ACUERDO A LEY"
            //Printer::QR_MICRO => "Micro QR code\n(not supported on all printers)"
        );
        foreach ($models as $model => $name) {
            $printer -> qrCode($testStr, Printer::QR_ECLEVEL_L, 4, $model);
            $printer -> text("$name\n");
            $printer -> feed();
        }
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text($leyenda."\n");
        $printer->text("PUNTO: ".gethostname()." \n");
        $printer->text("USUARIO: ".$_SESSION['nombre']." \n");
        $printer->text("NUMERO: $idfactura \n");

        /*
            Cortamos el papel. Si nuestra impresora
            no tiene soporte para ello, no generará
            ningún error
        */
        $printer->cut();


        /*
            Para imprimir realmente, tenemos que "cerrar"
            la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
        */
        $printer->close();
        header("Location: ".base_url()."Venta");
    }
}