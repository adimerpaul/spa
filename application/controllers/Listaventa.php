<?php
require('NumeroALetras.php');
require "phpqrcode/qrlib.php";
require "ControlCode.php";
require "autoload.php";
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


class Listaventa extends CI_Controller{
    function index()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $data['title'] = 'Historial de ventas';
        $data['css'] = "<link rel='stylesheet' href='" . base_url() . "assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='" . base_url() . "assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header', $data);
        $this->load->view('listadoventa');
        $data['tipo'] = "info";
        $data['msg'] = "Historial de ventas";
        $data['js'] = "
<script src='" . base_url() . "assets/js/jquery.dataTables.min.js'></script>
<script src='" . base_url() . "assets/js/dataTables.buttons.min.js'></script>
<script src='" . base_url() . "assets/js/buttons.flash.min.js'></script>
<script src='" . base_url() . "assets/js/jszip.min.js'></script>
<script src='" . base_url() . "assets/js/pdfmake.min.js'></script>
<script src='" . base_url() . "assets/js/vfs_fonts.js'></script>
<script src='" . base_url() . "assets/js/buttons.html5.min.js'></script>
<script src='" . base_url() . "assets/js/buttons.print.min.js'></script>
<script src='" . base_url() . "assets/js/dosificacion.js'></script>";
        $this->load->view('templates/footer', $data);
    }
    function printfactura($idfactura){
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
        header("Location: ".base_url()."Listaventa");
    }
}