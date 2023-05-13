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
        $data['title']='Reporte diario';
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

    public function insertdeudas(){
        $comprador=$_POST['comprador'];
        $detalle=$_POST['detalle'];
        $celular=$_POST['celular'];
        $monto=$_POST['monto'];

        if (isset($_POST['tipo'])){
            $tipo="ADELANTO";
        }else{
            $tipo="PAGO DEUDA";
        }
        $this->db->query("INSERT INTO deudas(comprador,detalle,celular,monto,idusuario,tipo)VALUES(
        '$comprador',
        '$detalle',
        '$celular',
        '$monto',
        '".$_SESSION['idusuario']."',
        '$tipo'
        )");
        header('Location: '.base_url().'Consulta');
    }
    public function insertdeudas2(){
        $comprador=$_POST['comprador'];
        $idreactivo=$_POST['detalle'];
        $cantidad=$_POST['cantidad'];
        $monto=$_POST['monto'];
        $tipo="ADELANTO";
        $detalle=$this->db->query("SELECT * FROM reactivo WHERE idreactivo='$idreactivo'")->row()->nombre;
        $this->db->query("UPDATE reactivo SET cantidad=cantidad-$cantidad WHERE idreactivo='$idreactivo'");
        $this->db->query("INSERT INTO deudas(comprador,detalle,celular,monto,idusuario,tipo)VALUES(
        '$comprador',
        '$detalle',
        '',
        '$monto',
        '".$_SESSION['idusuario']."',
        '$tipo'
        )");
//        echo $detalle;
        header('Location: '.base_url().'Consulta');
    }
    public function printA($fecha=''){
        require_once('tcpdf.php');

// create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetFont('dejavusans', '', 8);
        $dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
        $sm=0;
        $st=0;
// add a page
        $pdf->AddPage();

// create some HTML content
        $tex="";
        $query=$this->db->query("SELECT * FROM `montos` WHERE date(`fecha`)=date('$fecha') AND `idtratamiento` is NULL");
        foreach ($query->result() as $row){
            $hora=date('Y-m-d');

            $idhistorial=$this->User->consulta('idhistorial','cotizacion','idcotizacion',$row->idcotizacion);
            $idpaciente=$this->User->consulta('idpaciente','historial','idhistorial',$idhistorial);
            $consulta=$this->User->consulta('consulta','historial','idhistorial',$idhistorial);

            $nombres=$this->User->consulta('nombres','paciente','idpaciente',$idpaciente);
            $apellidos=$this->User->consulta('apellidos','paciente','idpaciente',$idpaciente);

            $celular=$this->User->consulta('celular','paciente','idpaciente',$idpaciente);
            $referencia=$this->User->consulta('referencia','paciente','idpaciente',$idpaciente);
            $nombre=$this->User->consulta('nombre','usuario','idusuario',$row->idusuario);
            $mediodia = strtotime("12:00:00");
            $horaactual = strtotime(date("H:j:s",strtotime(substr($row->fecha,10,6))));
            if($horaactual<$mediodia){
                $t="M";
                $sm=$sm+$row->monto;
            }else{
                $t="T";
                $st=$st+$row->monto;
            }
            $tex=$tex."<tr>
                <td> $t".substr($row->fecha,10,6)."</td>
                <td> $apellidos $nombres</td>
                <td> $consulta</td>
                <td> $referencia</td>
                <td> $row->monto</td>
                <td> $celular</td>
                <td> $nombre</td>
            </tr>";
        }
        $tex2="";
        $query=$this->db->query("
            SELECT nombres,apellidos,obs,cub,celular,t.nombre as nombret,monto,u.nombre as nombreu,m.fecha
            FROM montos m 
            INNER JOIN tratamiento t ON m.idtratamiento=t.idtratamiento
            INNER JOIN cotizacion c ON c.idcotizacion=m.idcotizacion
            INNER JOIN historial h ON h.idhistorial=c.idhistorial
            INNER JOIN paciente p ON p.idpaciente=h.idpaciente
            INNER JOIN usuario u ON u.idusuario=m.idusuario
            WHERE date(m.fecha)=date('$fecha')
            AND t.tipo='FACIAL'
            ");
        foreach ($query->result() as $row){
            $mediodia = strtotime("12:00:00");
            $horaactual = strtotime(date("H:j:s",strtotime(substr($row->fecha,10,6))));
            if($horaactual<$mediodia){
                $t="M";
                $sm=$sm+$row->monto;
            }else{
                $t="T";
                $st=$st+$row->monto;
            }
            $tex2=$tex2. "<tr>
                    <td scope='col' style='width: 72px'>$t".substr($row->fecha,10,6)."</td>
                    <td scope='col'>$row->nombres $row->apellidos</td>
                    <td scope='col'>$row->nombret</td>
                    <td scope='col'>$row->obs</td>
                    <td scope='col'>$row->cub</td>
                    <td scope='col'>$row->celular</td>
                    <td scope='col'>$row->monto</td>
                    <td scope='col'>$row->nombreu</td>
                </tr>";
        }$tex3="";
        $query=$this->db->query("
            SELECT nombres,apellidos,obs,cub,celular,t.nombre as nombret,monto,u.nombre as nombreu,m.fecha
            FROM montos m 
            INNER JOIN tratamiento t ON m.idtratamiento=t.idtratamiento
            INNER JOIN cotizacion c ON c.idcotizacion=m.idcotizacion
            INNER JOIN historial h ON h.idhistorial=c.idhistorial
            INNER JOIN paciente p ON p.idpaciente=h.idpaciente
            INNER JOIN usuario u ON u.idusuario=m.idusuario
            WHERE date(m.fecha)=date('$fecha')
            AND t.tipo='CORPORAL'
            ");
        foreach ($query->result() as $row){
            $mediodia = strtotime("12:00:00");
            $horaactual = strtotime(date("H:j:s",strtotime(substr($row->fecha,10,6))));
            if($horaactual<$mediodia){
                $t="M";
                $sm=$sm+$row->monto;
            }else{
                $t="T";
                $st=$st+$row->monto;
            }
            $tex3=$tex3."<tr>
                    <td scope='col' style='width: 72px'>$t".substr($row->fecha,10,6)."</td>
                    <td scope='col'>$row->nombres $row->apellidos</td>
                    <td scope='col'>$row->nombret</td>
                    <td scope='col'>$row->obs</td>
                    <td scope='col'>$row->cub</td>
                    <td scope='col'>$row->celular</td>
                    <td scope='col'>$row->monto</td>
                    <td scope='col'>$row->nombreu</td>
                </tr>";
        }
        $tex4="";
        $query=$this->db->query("SELECT f.fecha,nombres,apellidos,pr.nombre,cantidad,celular,subtotal,u.nombre as usuarionombre
 FROM factura f
            INNER JOIN paciente p ON p.idpaciente=f.idpaciente
            INNER JOIN detallefactura d ON d.idfactura=f.idfactura
            INNER JOIN producto pr ON pr.idproducto=d.idproducto
            INNER JOIN usuario u ON u.idusuario=f.idusuario
            WHERE date(f.fecha)=date('$fecha')
            ORDER BY f.fecha");
        foreach ($query->result() as $row){
            $mediodia = strtotime("12:00:00");
            $horaactual = strtotime(date("H:j:s",strtotime(substr($row->fecha,10,6))));
            if($horaactual<$mediodia){
                $t="M";
                $sm=$sm+$row->subtotal;
            }else{
                $t="T";
                $st=$st+$row->subtotal;
            }

            $tex4=$tex4."<tr>
                <td scope='col'>$t".substr($row->fecha,10,6)."</td>
                <td scope='col'>$row->apellidos $row->nombres</td>
                <td scope='col'>$row->nombre</td>
                <td scope='col'>$row->cantidad</td>
                <td scope='col'>$row->celular</td>
                <td scope='col'>$row->subtotal</td>
                <td scope='col'>$row->usuarionombre</td>
            </tr>";
        }
        $tex5="";
        $query=$this->db->query("SELECT d.fecha,d.comprador,d.detalle,d.celular,u.nombre,d.tipo,d.monto
 FROM deudas d
 INNER JOIN usuario u ON d.idusuario=u.idusuario
            WHERE date(d.fecha)=date('$fecha')");
        foreach ($query->result() as $row){
            $mediodia = strtotime("12:00:00");
            $horaactual = strtotime(date("H:j:s",strtotime(substr($row->fecha,10,6))));

            $tipo=$row->tipo;
            if ($tipo=="ADELANTO"){
                $te="<span class='btn-success' style='padding: 2px'>$row->monto</span>";
                if($horaactual<$mediodia){
                    $t="M";
                    $sm=$sm+$row->monto;
                }else{
                    $t="T";
                    $st=$st+$row->monto;
                }
            }else{
                $te="<span class='btn-danger' style='padding: 2px'>$row->monto</span>";
                if($horaactual<$mediodia){
                    $t="M";
                    $sm=$sm-$row->monto;
                }else{
                    $t="T";
                    $st=$st-$row->monto;
                }
            }

            $tex5=$tex5."<tr>
                        <td scope='col'>$t".substr($row->fecha,10,6)."</td>
                        <td scope='col'> $row->comprador</td>
                        <td scope='col'>$row->detalle</td>
                        <td scope='col'>$row->celular</td>
                        <td scope='col'>$te </td>
                        <td scope='col'>$row->nombre</td>
                    </tr>";
        }
        $tex6="";
        $query=$this->db->query("SELECT e.idegreso,e.monto,t.nombre FROM egreso e
 INNER JOIN usuario u ON u.idusuario=e.idusuario
 INNER JOIN tratamiento t ON t.idtratamiento=e.idtratamiento
 WHERE date(fecha)=date('$fecha')");
        foreach ($query->result() as $row){
            $tex6=$tex6."
                <small style='border: 1px solid black' class='col-sm-4'>
                   $row->monto $row->nombre
                </small>";
        }
        $html = '
<table align="center" style="font-weight:bold ">
<tr>
<td>Dia: '.$dias[date('w')].'</td>
<td>INFORME DIARIO</td>
<td>FECHA: '.date("d/m/Y").' </td>
</tr>
</table>    
<small align="center" style="font-weight:bold;font-size: 18px ">
    CONSULTA MEDICA
</small>    <br>
    <table class="table" border="1">
        <tr style="font-weight: bold">
            <td style="width: 8%"> HORA</td>
            <td style="width: 35%"> PACIENTE</td>
            <td style="width: 13%"> COT/SUG TX</td>
            <td style="width: 10%"> REF</td>
            <td style="width: 8%"> COSTO/ADEL</td>
            <td style="width: 11%"> TELEFONO</td>
            <td style="width: 16%"> MEDICO</td>
        </tr>
        '.$tex.'
    </table>
    <small align="center" style="font-size: 8px ">
    TX FACIALES: IPL-MESO-PEELING-PRP-TOX-RELLENO-HILOS-MASC-ELECTRO-RF-INJERTOS
</small>    <br>
<table class="table" border="1">
        <tr style="font-weight: bold">
            <td style="width: 8%"> HORA</td>
            <td style="width: 30%"> PACIENTE</td>
            <td style="width: 13%"> TRATAMIENTO</td>
            <td style="width: 10%"> OBS/RES</td>
            <td style="width: 8%"> CUB/SES</td>
            <td style="width: 10%"> CELULAR</td>
            <td style="width: 9%"> COSTO</td>
            <td style="width: 16%"> MEDICO</td>
        </tr>
        '.$tex2.'
    </table>
    <small align="center" style="font-size: 8px ">
    TX CORP: UCV-VACCUM-RF-ELECTRO-LIPO-HIDRO-MESO-VIT C-CAPILAR-ARTICULAR-HILOS-MELA
</small>    <br>
   <table class="table" border="1">
        <tr style="font-weight: bold">
            <td style="width: 8%"> HORA</td>
            <td style="width: 30%"> PACIENTE</td>
            <td style="width: 13%"> TRATAMIENTO</td>
            <td style="width: 10%"> OBS/RES</td>
            <td style="width: 8%"> CUB/SES</td>
            <td style="width: 10%"> CELULAR</td>
            <td style="width: 9%"> COSTO</td>
            <td style="width: 16%"> MEDICO</td>
        </tr>
        '.$tex3.'
    </table>  
    <small align="center" style="font-size: 8px ">
    PRODUCTOS VENDIDOS
</small>    <br>   
<table class="table" border="1">
        <tr style="font-weight: bold">
            <td style="width: 8%"> HORA</td>
            <td style="width: 30%"> COMPRADOR</td>
            <td style="width: 13%"> DETALLE DEL PRODUCTO</td>
            <td style="width: 10%"> CANTIDAD</td>
            <td style="width: 9%"> CELULAR</td>
            <td style="width: 10%"> COSTO</td>
            <td style="width: 20%"> VENDEDOR</td>
        </tr>
        '.$tex4.'
    </table>
    <small align="center" style="font-size: 8px ">
    ADELANTOS/PAGO DE DEUDAS
</small>    <br>  
<table class="table" border="1">
        <tr style="font-weight: bold">
            <td style="width: 8%"> HORA</td>
            <td style="width: 30%"> COMPRADOR</td>
            <td style="width: 13%"> DETALLE</td>
            <td style="width: 10%"> CELULAR</td>
            <td style="width: 9%"> MONTO</td>
            <td style="width: 20%"> VENDEDOR</td>
        </tr>
        '.$tex5.'
    </table>
<table border=>
<tr align="center">
<td>
INGRESOS <br>
<table border="1" style="width: 100%">
    <tr>
        <th colspan="2" class="thead-dark">Mañana:</th>
        <td >'.$sm.'</td>
    </tr>
    <tr>
        <th colspan="2" class="thead-dark">Tarde:</th>
        <td >'.$st.'</td>
    </tr>
    <tr>
        <th colspan="2" class="thead-dark">Total:</th>
        <td >'.($sm+$st).'</td>
    </tr>
    <tr>
        <td> <b> Mañana</b></td>
        <td>Ingreso</td>
        <td>Salida</td>
    </tr>
    <tr>
        <td><b>Tarde</b></td>
        <td>Ingreso</td>
        <td>Salida</td>
    </tr>
</table>
</td>
<td>
EGRESOS <br>
'.$tex6.'
</td>
</tr>
</table>
  
</div>
';
        $pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
        $pdf->Output('example_006.pdf', 'I');
    }
    public function datosegreso(){
        $idegreso=$_POST['idegreso'];
        $query=$this->db->query("SELECT * FROM egreso WHERE idegreso='$idegreso'");
        echo json_encode($query->result_array());
    }
    public function modificaregreso(){
        $monto=$_POST['monto'];
        $idegreso=$_POST['idegreso'];
        $query=$this->db->query("UPDATE egreso SET monto=$monto WHERE idegreso='$idegreso'");
        //exit;
        header("Location: ".base_url()."Consulta");
    }
}