<?php
/**
 * Created by PhpStorm.
 * User: Adimer
 * Date: 08/01/2019
 * Time: 22:29
 */
require('fpdf.php');

class PDF extends FPDF
{
    var $B=0;
    var $I=0;
    var $U=0;
    var $HREF='';
    var $ALIGN='';


    function titulo($title,$a=0){
        $this->SetFont('Times','B',10);
        $this->Cell( strlen($title)*2.4 +$a,5,utf8_decode($title),'B');
    }
    function subtitulo($title,$a=0){
        $this->SetFont('Times','B',8);
        $this->Cell(strlen($title)*2.2+$a,5,utf8_decode($title));

    }


    function texto($title,$a=0){
        $this->SetFont('Times','',8);
        $this->Cell( strlen($title)*2.1+$a ,5,utf8_decode($title));
    }
    function espacio(){
        $this->Ln();
    }
    // Simple table
    function BasicTable($header, $data)
    {
        // Header
        foreach($header as $col)
            $this->Cell(40,7,$col,1);
        $this->Ln();
        // Data
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(40,6,$col,1);
            $this->Ln();
        }
    }

    function WriteHTML($html)
    {
        //HTML parser
        $html=str_replace("\n",' ',$html);
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                elseif($this->ALIGN=='center')
                    $this->Cell(0,5,$e,0,1,'C');
                else
                    $this->Write(5,$e);
            }
            else
            {
                //Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    //Extract properties
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $prop=array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $prop[strtoupper($a3[1])]=$a3[2];
                    }
                    $this->OpenTag($tag,$prop);
                }
            }
        }
    }

    function OpenTag($tag,$prop)
    {
        //Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF=$prop['HREF'];
        if($tag=='BR')
            $this->Ln(5);
        if($tag=='P')
            $this->ALIGN=$prop['ALIGN'];
        if($tag=='HR')
        {
            if( !empty($prop['WIDTH']) )
                $Width = $prop['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $this->Ln(2);
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.4);
            $this->Line($x,$y,$x+$Width,$y);
            $this->SetLineWidth(0.2);
            $this->Ln(2);
        }
    }

    function CloseTag($tag)
    {
        //Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='P')
            $this->ALIGN='';
    }

    function SetStyle($tag,$enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s)
            if($this->$s>0)
                $style.=$s;
        $this->SetFont('',$style);
    }

    function PutLink($URL,$txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }



}

class Paciente extends CI_Controller {
    /*public function __construct()
    {
        //$this->load->model('Mmedidas');
    }*/

    function regtratamiento($idpaciente="",$idhistorial="",$idcotizacion=""){
        if ($_SESSION['nombre']=="" ){
            header("Location: ".base_url());
        }
        $data['title']='Reg tratamiento';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $data['idpaciente']=$idpaciente;
        $data['idhistorial']=$idhistorial;
        $data['idcotizacion']=$idcotizacion;
        $this->load->view('regtratamiento',$data);
        $data['tipo']="info";
        $data['msg']="Registrar tratamiento";
        $data['js']="
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

    function index(){
        if ($_SESSION['nombre']=="" ){
            header("Location: ".base_url());
        }
        $data['title']='Atencion a pacientes';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('paciente');
        $data['tipo']="info";
        $data['msg']="Atencion a pacientes";
        $data['js']="
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
    function medidas(){
        //echo $_POST['papada'];
$this->load->model('Mmedidas');
$this->Mmedidas->insert();
        $idcotizacion=$_POST['idcotizacion'];
        $idhistorial=$this->User->consulta('idhistorial','cotizacion','idcotizacion',$idcotizacion);
        $idpaciente=$this->User->consulta('idpaciente','historial','idhistorial',$idhistorial);

header("Location: ".base_url()."Paciente/cotizacion/$idpaciente/$idhistorial");

    }
    function datos(){
        $idpaciente=$_POST['idpaciente'];
        $query=$this->db->query("SELECT * FROM historial WHERE idpaciente='$idpaciente'");
        foreach ($query->result() as $row){
            echo "Fecha: <a href='paciente/historialver/".$row->idhistorial."/".$row->idpaciente."'>". substr($row->fecha,0,10)."</a> idhistorial: ".$row->idhistorial." <a href='".base_url()."Paciente/cotizacion/".$idpaciente."/".$row->idhistorial."' class='btn btn-sm btn-info sinespaciotexto' ><i class='fa fa-ambulance'></i> Tratamientos</a><br>";
        }
    }
    function historialver($idhistorial='',$idpaciente=''){
        $query=$this->db->query("SELECT * FROM paciente WHERE idpaciente=$idpaciente");
        $row=$query->row();

        $nombres=$row->nombres;
        $apellidos=$row->apellidos;
        $zona=$row->zona;
        $direccion=$row->direccion;
        $fechanac=$row->fechanac;
        $celular=$row->celular;
        $telefono=$row->telefono;
        $query=$this->db->query("SELECT * FROM historial WHERE idhistorial='$idhistorial'");
        $row=$query->row();
        $consulta=$row->consulta;
        $pa=$row->pa;
        $fc=$row->fc;
        $peso=$row->peso;
        $talla=$row->talla;
        $imc=$row->imc;
        $gc=$row->gc;
        $diabetes= $row->diabetes;
        $hta=$row->hta;
        $cardios=$row->cardios;
        $cancer=$row->cancer;
        $quefamilia=$row->quefamilia;
        $estadocivil=$row->estadocivil;
        $ocupacion=$row->ocupacion;
        $fuma=$row->fuma;
        $bebe=$row->bebe;
        $actividadfisica=$row->actividadfisica;
        $sueno=$row->sueno;
        $alimentos=$row->alimentos;
        $diuresis=$row->diuresis;
        $catarsis=$row->catarsis;
        $patologico=$row->patologico;
        $alergias=$row->alergias;
        $tratamientos=$row->tratamientos;
        $estadopsicologico=$row->estadopsicologico;
        $fum=$row->fum;
        $dias=$row->dias;
        $frecuencia=$row->frecuencia;
        $caracteristica=$row->caracteristica;
        $gestas=$row->gestas;
        $partos=$row->partos;
        $ab=$row->ab;
        $cesareas=$row->cesareas;
        $lactancia=$row->lactancia;
        $nhijos=$row->nhijos;
        $menopausia=$row->menopausia;
        $pap=$row->pap;
        $anticonceptivos=$row->anticonceptivos;
        $examenmamario=$row->examenmamario;
        $ptsimamaria=$row->ptsimamaria;
        $cremas=$row->cremas;
        $cutis=$row->cutis;
        $donde=$row->donde;
        $queutilizaron=$row->queutilizaron;
        $sol=$row->sol;
        $solar=$row->solar;
        $otros=$row->otros;
        $alopecia=$row->alopecia;
        $depilacion=$row->depilacion;
        $piel=$row->piel;
        $biotipo=$row->biotipo;
        $arrugas=$row->arrugas;
        $pdf = new PDF('P','mm','Letter');



        $pdf->AddPage();

        $pdf->Image('assets/img/spa.png',0,0,216);
        $pdf->Ln(19);

        $pdf->SetFont('Times','B',12);
        $pdf->Cell(15);
        $pdf->Cell(150,4,utf8_decode('HISTORIAL CLINICA ' ),0,0,'C');
        $pdf->SetFont('Times','',8);
        $pdf->Cell(10,4,utf8_decode('Idpaciente= '.$idpaciente ),0,0,'C');


        $pdf->espacio();
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(11,5,utf8_decode('FECHA:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(15,5,utf8_decode(date('d/m/Y')));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(14,5,utf8_decode('NOMBRE:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(50,5,utf8_decode($nombres." ".$apellidos));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(9,5,utf8_decode('EDAD:'));

        $cumpleanos = new DateTime($fechanac);
        $hoy = new DateTime();
        $annos = $hoy->diff($cumpleanos);


        $pdf->SetFont('Times','',8);
        $pdf->Cell(5,5,$annos->y);
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(9,5,utf8_decode('ZONA:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(23,5,utf8_decode($zona));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(17,5,utf8_decode('DIRECCION:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(10,5,utf8_decode($direccion));

        $pdf->espacio();
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(18,5,utf8_decode('FECHA NAC:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(16,5,utf8_decode($fechanac));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(17,5,utf8_decode('TELEFONO:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(17,5,utf8_decode($telefono));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(15,5,utf8_decode('CELULAR:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(5,5,utf8_decode($celular));

        $pdf->espacio();
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(82,5,utf8_decode('MOTIVO CONSULTA Y ENFERMEDAD ACTUAL'),'B');
        $pdf->espacio();
        $pdf->SetFont('Times','',8);
        $pdf->MultiCell(0,5,utf8_decode($consulta));


        $pdf->SetFont('Times','B',10);
        $pdf->Cell(32,5,utf8_decode('SIGNOS VITALES:'),'B');
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(7,5,utf8_decode('PA:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(16,5,utf8_decode($pa));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(7,5,utf8_decode('FC:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(17,5,utf8_decode($fc));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(9,5,utf8_decode('PESO:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(12,5,utf8_decode($peso));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(10,5,utf8_decode('TALLA:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(10,5,utf8_decode($talla));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(7,5,utf8_decode('IMC:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(10,5,utf8_decode($imc));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(15,5,utf8_decode('%GC:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(5,5,utf8_decode($gc));

        $pdf->espacio();
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(55,5,utf8_decode('ANTECEDENTES FAMILIARES:'),'B');
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(16,5,utf8_decode('DIABETES:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(10,5,utf8_decode("($diabetes)"));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(7,5,utf8_decode('HTA:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(10,5,utf8_decode("($hta)"));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(18,5,utf8_decode('CARDIACOS:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(12,5,utf8_decode("($cardios)"));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(13,5,utf8_decode('CANCER:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(10,5,utf8_decode("($cancer)"));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(20,5,utf8_decode('QUE FAMILIA:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(10,5,utf8_decode($quefamilia." "));

        $pdf->espacio();
        $pdf->titulo("ANTECEDENTES NO PATOLOGICOS:");
        $pdf->subtitulo("ESTADO CIVIL:");
        $pdf->texto("$estadocivil ");
        $pdf->subtitulo("OCUPACION:");
        $pdf->texto("$ocupacion ");
        $pdf->subtitulo("FUMA:");
        $pdf->texto("$fuma ");
        $pdf->espacio();
        $pdf->subtitulo("BEBE:");
        $pdf->texto("$bebe ");
        $pdf->subtitulo("ACTIVIDAD FISICA:");
        $pdf->texto("$actividadfisica ");
        $pdf->subtitulo("HABITOS DE SUEÑO:");
        $pdf->texto("$sueno ");
        $pdf->espacio();
        $pdf->subtitulo("HABITOS ALIMENTICIOS:");
        $pdf->texto("$alimentos ");
        $pdf->subtitulo("DIURESIS:");
        $pdf->texto("$diuresis ");
        $pdf->subtitulo("CATARASIS:");
        $pdf->texto("$catarsis ");

        $pdf->espacio();
        $pdf->titulo("ANTECEDENTES PATOLOGICOS:");
        $pdf->espacio();
        $pdf->SetFont('Times','',8);
        $pdf->MultiCell(0,5,utf8_decode("$patologico "));

        $pdf->subtitulo("ALERGIAS:");
        $pdf->texto("$alergias ");
        $pdf->subtitulo("TRATAMIENTO RECIENTES:");
        $pdf->texto("$tratamientos ");
        $pdf->subtitulo("ESTADO PSICOLOGICO:");
        $pdf->texto("$estadopsicologico ");

        $pdf->espacio();
        $pdf->titulo("ANTECEDENTES GINECO OBSTETRICOS:");

        $pdf->espacio();
        $pdf->subtitulo("FUM:");
        $pdf->texto("$fum ");
        $pdf->subtitulo("DIAS:");
        $pdf->texto("$dias ");
        $pdf->subtitulo("FRECUENCIA:");
        $pdf->texto("$frecuencia ");
        $pdf->subtitulo("GESTAS:");
        $pdf->texto("$gestas ");
        $pdf->subtitulo("PARTOS:");
        $pdf->texto("$partos ");
        $pdf->subtitulo("AB:");
        $pdf->texto("$ab ");
        $pdf->subtitulo("Cesarias:");
        $pdf->texto("$cesareas ");

        $pdf->espacio();
        $pdf->subtitulo("LACTANCIA:");
        $pdf->texto("$lactancia ");
        $pdf->subtitulo("Nº DE HIJOS:");
        $pdf->texto("$nhijos ");
        $pdf->subtitulo("MENOPAUSIA:");
        $pdf->texto("$menopausia ",3);
        $pdf->subtitulo("PAP:");
        $pdf->texto("$pap ",3);
        $pdf->subtitulo("ANTICONCEPTIVOS :");
        $pdf->texto("$anticonceptivos ");

        $pdf->espacio();
        $pdf->subtitulo("AUTOEXAMEN MAMARIO:");
        if ($examenmamario=="si"){
            $pdf->texto(" SI(X) NO()");
        }else if($examenmamario=="no"){
            $pdf->texto(" SI() NO(X)");
        }else{
            $pdf->texto(" SI() NO()");
        }
        $pdf->subtitulo("PTOSIS MAMARIO");
        if ($ptsimamaria=="si"){
            $pdf->texto(" SI(X) NO()");
        }else if($ptsimamaria=="no"){
            $pdf->texto(" SI() NO(X)");
        }else{
            $pdf->texto(" SI() NO()");
        }
        $pdf->espacio();
        $pdf->titulo("PIEL Y FANERAS:");
        $pdf->subtitulo("CREMAS QUE UTILIZA:");
        $pdf->texto($cremas." ");
        $pdf->subtitulo("LIMPIEZA DE CUTIS:");
        if ($cutis=="si"){
            $pdf->texto(" SI(X) NO()");
        }else if($cutis=="no"){
            $pdf->texto(" SI() NO(X)");
        }else{
            $pdf->texto(" SI() NO()");
        }
        $pdf->subtitulo("DONDE:");
        $pdf->texto("$donde ");

        $pdf->espacio();
        $pdf->subtitulo("QUE UTILIZARON:");
        $pdf->texto("$queutilizaron ");
        $pdf->subtitulo("ESTA EN EL SOL:");
        $pdf->texto("$sol ");
        $pdf->subtitulo("PROTECCION SOLAR:");
        $pdf->texto("$solar ");
        $pdf->subtitulo("OTROS TX ESTETICOS:",-8);
        $pdf->texto("$otros ");

        $pdf->espacio();
        $pdf->titulo("ALOPECIA:");
        if ($alopecia=="si"){
            $pdf->texto(" SI(X) NO()");
        }else if($alopecia=="no"){
            $pdf->texto(" SI() NO(X)");
        }else{
            $pdf->texto(" SI() NO()");
        }
        $pdf->titulo("DEPILACION(Describa habitos depilatorios):",-22);
        $pdf->texto( "$depilacion ");

        $pdf->espacio();
        $pdf->subtitulo("TIPO DE PIEL:");
        $pdf->texto("$piel ");
        $pdf->espacio();
        $pdf->subtitulo("BIOTIPO DE LA PIEL:");
        $pdf->texto("$biotipo ");
        $pdf->subtitulo("TIPO Y LUGAR DE ARRUGAS:");
        $pdf->texto("$arrugas ");
        /*
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(16,5,utf8_decode('ESTADO CIVIL:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(10,5,utf8_decode('(X)'));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(7,5,utf8_decode('OCUPACION:'));
        $pdf->SetFont('Times','',8);
        $pdf->Cell(10,5,utf8_decode('(X)'));
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(18,5,utf8_decode('FUMA:'));
        */
        /*
        $pdf->Ln();
        $pdf->titulo("MEDIDAS A REDUCIR:",0);
        $pdf->Ln();
        $query=$this->db->query("SELECT fecha FROM medida WHERE idpaciente=$idpaciente  ");
        $pdf->Ln();
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(35,6,'FECHA DE MEDICION',1,0);
        foreach ($query->result() as $row){
            $pdf->Cell(18,6, substr($row->fecha,0,10),1,0,'C');
        }
        $pdf->SetFont('Times','',8);
        $pdf->Ln();
        $query=$this->db->query("SELECT papada FROM medida WHERE idpaciente=$idpaciente  ");
        $pdf->Cell(35,6,'PAPADA',1,0);
        foreach ($query->result() as $row){
            $pdf->Cell(18,6,$row->papada,1,0,'C');
        }
        $query=$this->db->query("SELECT brazosd1 FROM medida WHERE idpaciente=$idpaciente  ");
        $pdf->Ln();
        $pdf->Cell(35,6,'BRAZOS D-1',1,0);
        foreach ($query->result() as $row){
            $pdf->Cell(18,6,$row->brazosd1,1,0,'C');
        }
        $query=$this->db->query("SELECT espaldaalta FROM medida WHERE idpaciente=$idpaciente  ");
        $pdf->Ln();
        $pdf->Cell(35,6,'ESPALDA ALTA',1,0);
        foreach ($query->result() as $row){
            $pdf->Cell(18,6,$row->espaldaalta,1,0,'C');
        }
        $query=$this->db->query("SELECT espaldabaja FROM medida WHERE idpaciente=$idpaciente  ");
        $pdf->Ln();
        $pdf->Cell(35,6,'ESPALDA BAJA',1,0);
        foreach ($query->result() as $row){
            $pdf->Cell(18,6,$row->espaldabaja,1,0,'C');
        }
        $query=$this->db->query("SELECT cintura FROM medida WHERE idpaciente=$idpaciente  ");
        $pdf->Ln();
        $pdf->Cell(35,6,'CINTURA',1,0);
        foreach ($query->result() as $row){
            $pdf->Cell(18,6,$row->cintura,1,0,'C');
        }
        $query=$this->db->query("SELECT ombligo FROM medida WHERE idpaciente=$idpaciente  ");
        $pdf->Ln();
        $pdf->Cell(35,6,'PAPADA',1,0);
        foreach ($query->result() as $row){
            $pdf->Cell(18,6,$row->ombligo,1,0,'C');
        }
        $query=$this->db->query("SELECT cm2 FROM medida WHERE idpaciente=$idpaciente  ");
        $pdf->Ln();
        $pdf->Cell(35,6,'A 2 CM DEL OMBLIGO',1,0);
        foreach ($query->result() as $row){
            $pdf->Cell(18,6,$row->cm2,1,0,'C');
        }
        $query=$this->db->query("SELECT cm4 FROM medida WHERE idpaciente=$idpaciente  ");
        $pdf->Ln();
        $pdf->Cell(35,6,'A 4 CM DEL OMBLIGO',1,0);
        foreach ($query->result() as $row){
            $pdf->Cell(18,6,$row->cm4,1,0,'C');
        }
        $query=$this->db->query("SELECT cadera FROM medida WHERE idpaciente=$idpaciente  ");
        $pdf->Ln();
        $pdf->Cell(35,6,'CADERA',1,0);
        foreach ($query->result() as $row){
            $pdf->Cell(18,6,$row->cadera,1,0,'C');
        }
        $query=$this->db->query("SELECT muslo FROM medida WHERE idpaciente=$idpaciente  ");
        $pdf->Ln();
        $pdf->Cell(35,6,'MUSLO D-1',1,0);
        foreach ($query->result() as $row){
            $pdf->Cell(18,6,$row->muslo,1,0,'C');
        }
*/
        $pdf->Output();
    }
    function escoger($idpaciente=""){
        if ($_SESSION['nombre']=="" ){
            header("Location: ".base_url());
        }
        $data['title']='Escoger historial';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $data['idpaciente']=$idpaciente;
        $this->load->view('escoger',$data);
        $data['tipo']="info";
        $data['msg']="Registrar tratamiento";
        $data['js']="
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
    function eliconcentimiento($idcotizacion="",$idtratamiento="",$idpaciente="",$idhistorial=""){
        $this->db->query("DELETE FROM cotizacionconsetimeinto WHERE idconsetimiento = $idcotizacion AND idcotizacion = $idtratamiento");
        header("Location: ".base_url()."Paciente/cotizacion/$idpaciente/$idhistorial");
    }
    function historialinsert(){
        $idpaciente=$_POST['idpaciente'];
        $consulta=$_POST['consulta'];
        $pa=$_POST['pa'];
        $fc=$_POST['fc'];
        $peso=$_POST['peso'];
        $talla=$_POST['talla'];
        $imc=$_POST['imc'];
        $gc=$_POST['gc'];
        $diabetes= isset($_POST['diabetes']);
        $hta=isset($_POST['hta']);
        $cardios=isset($_POST['cardios']);
        $cancer=isset($_POST['cancer']);
        $quefamilia=$_POST['quefamilia'];
        $estadocivil=$_POST['estadocivil'];
        $ocupacion=$_POST['ocupacion'];
        if (isset($_POST['fuma'])){
            $fuma=$_POST['fuma'];
        }else{
            $fuma="";
        }
        if (isset($_POST['bebe'])){
            $bebe=$_POST['bebe'];
        }else{
            $bebe="";
        }
        if (isset($_POST['actividadfisica'])){
            $actividadfisica=$_POST['actividadfisica'];
        }else{
            $actividadfisica="";
        }
        $sueno=$_POST['sueno'];
        $alimentos=$_POST['alimentos'];
        $diuresis=$_POST['diuresis'];
        $catarsis=$_POST['catarsis'];
        $patologico=$_POST['patologico'];
        $alergias=$_POST['alergias'];
        $tratamientos=$_POST['tratamientos'];
        $estadopsicologico=$_POST['estadopsicologico'];
        $fum=$_POST['fum'];
        $dias=$_POST['dias'];
        $frecuencia=$_POST['frecuencia'];
        $caracteristica=$_POST['caracteristica'];
        $gestas=$_POST['gestas'];
        $partos=$_POST['partos'];
        $ab=$_POST['ab'];
        $cesareas=$_POST['cesareas'];
        $lactancia=$_POST['lactancia'];
        $nhijos=$_POST['nhijos'];
        $menopausia=$_POST['menopausia'];
        $pap=$_POST['pap'];
        $anticonceptivos=$_POST['anticonceptivos'];
        $examenmamario=$_POST['examenmamario'];
        $ptsimamaria=$_POST['ptsimamaria'];
        $cremas=$_POST['cremas'];
        $cutis=$_POST['cutis'];
        $donde=$_POST['donde'];
        $queutilizaron=$_POST['queutilizaron'];
        $sol=$_POST['sol'];
        $solar=$_POST['solar'];
        $otros=$_POST['otros'];
        $alopecia=$_POST['alopecia'];
        $depilacion=$_POST['depilacion'];
        if (isset($_POST['piel'])){
            $piel=$_POST['piel'];
        }else{
            $piel="";
        }
        $biotipo=$_POST['biotipo'];
        $arrugas=$_POST['arrugas'];
        $referencia=$_POST['referencia'];
        $unas=$_POST['unas'];

        $this->db->query("INSERT INTO historial (idpaciente,
 consulta,
pa,
fc,
peso,
talla,
imc,
gc,
diabetes,
hta,
cardios,
cancer,
quefamilia,
estadocivil,
ocupacion,
fuma,
bebe,
actividadfisica,
sueno,
alimentos,
diuresis,
catarsis,
patologico,
alergias,
tratamientos,
estadopsicologico,
fum,
dias,
frecuencia,
caracteristica,
gestas,
partos,
ab,
cesareas,
lactancia,
nhijos,
menopausia,
pap,
anticonceptivos,
examenmamario,
ptsimamaria,
cremas,
cutis,
donde,
queutilizaron,
sol,
solar,
otros,
alopecia,
depilacion,
piel,
biotipo,
arrugas,
referencia,
unas) VALUES (
'$idpaciente',
'$consulta',
'$pa',
'$fc',
'$peso',
'$talla',
'$imc',
'$gc',
'$diabetes',
'$hta',
'$cardios',
'$cancer',
'$quefamilia',
'$estadocivil',
'$ocupacion',
'$fuma',
'$bebe',
'$actividadfisica',
'$sueno',
'$alimentos',
'$diuresis',
'$catarsis',
'$patologico',
'$alergias',
'$tratamientos',
'$estadopsicologico',
'$fum',
'$dias',
'$frecuencia',
'$caracteristica',
'$gestas',
'$partos',
'$ab',
'$cesareas',
'$lactancia',
'$nhijos',
'$menopausia',
'$pap',
'$anticonceptivos',
'$examenmamario',
'$ptsimamaria',
'$cremas',
'$cutis',
'$donde',
'$queutilizaron',
'$sol',
'$solar',
'$otros',
'$alopecia',
'$depilacion',
'$piel',
'$biotipo',
'$arrugas',
'$referencia',
'$unas'
);");
        header("Location: ".base_url()."Paciente");
    }
    function insert(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $nombres= strtoupper( $_POST['nombres']);
        $apellidos= strtoupper( $_POST['apellidos']);
        $zona=$_POST['zona'];
        $direccion=$_POST['direccion'];
        $fechanac=$_POST['fechanac'];
        $celular=$_POST['celular'];
        $telefono=$_POST['telefono'];
        $referencia=$_POST['referencia'];
        $ci=$_POST['ci'];
         $query=$this->db->query("INSERT INTO paciente(ci,nombres,apellidos,zona,direccion,fechanac,celular,telefono,idusuario,referencia) 
VALUES ('$ci','$nombres', '$apellidos', '$zona', '$direccion', '$fechanac', '$celular','$telefono', '".$_SESSION['idusuario']."','$referencia');");


/*
if($query){
        $data['title']='Atencion a pacientes';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('paciente');
        $data['tipo']="success";
        $data['msg']="Paciente registrado";
        $data['js']="
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
*/
        header("Location: ".base_url()."Paciente");
    }
    function cotizacion($idpaciente,$idhistorial=""){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Cotizacion de tratamientos';
        $data['idpaciente']=$idpaciente;
        $data['idhistorial']=$idhistorial;
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('cotizacion');
        $data['tipo']="info";
        $data['msg']="Cotizaciones";
        $data['js']="
<script src='".base_url()."assets/js/jquery.dataTables.min.js'></script>
<script src='".base_url()."assets/js/dataTables.buttons.min.js'></script>
<script src='".base_url()."assets/js/buttons.flash.min.js'></script>
<script src='".base_url()."assets/js/jszip.min.js'></script>
<script src='".base_url()."assets/js/pdfmake.min.js'></script>
<script src='".base_url()."assets/js/vfs_fonts.js'></script>
<script src='".base_url()."assets/js/buttons.html5.min.js'></script>
<script src='".base_url()."assets/js/buttons.print.min.js'></script>
<script src='".base_url()."assets/js/cotizacion.js'></script>";
        $this->load->view('templates/footer',$data);
    }
    function insertcotizacion(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $idpaciente=$_POST['idpaciente'];
        $idhistorial=$_POST['idhistorial'];
        $diagnostico=$_POST['diagnostico'];
        $programa=$_POST['programa'];
        $adelanto=$_POST['adelanto'];
        $this->db->query("INSERT INTO cotizacion(idhistorial,diagnostico,programa) VALUES('$idhistorial','$diagnostico','$programa')");
        $idcotizacion=$this->db->insert_id();
        //if($adelanto!=""){
        $this->db->query("INSERT INTO montos(monto,idcotizacion,idusuario) VALUES('$adelanto','$idcotizacion','".$_SESSION['idusuario']."')");
        $idmonto=$this->db->insert_id();
        $motivo=$_POST['motivo'];
        $cot=$_POST['cot'];
        $ref=$_POST['ref'];
        $this->db->query("INSERT INTO consulta(motivo,cot,ref,idmonto) VALUES('$motivo','$cot','$ref','$idmonto')");
        //}

        $query=$this->db->query("SELECT * FROM tratamiento");
        foreach ($query->result() as $row){
            if ($_POST['t'.$row->idtratamiento]!="" AND $_POST['t'.$row->idtratamiento]!="0" ){
                if (isset($_POST['n'.$row->idtratamiento])){
                    $n=$_POST['n'.$row->idtratamiento];
                }else{
                    $n="";
                }
                if (isset($_POST['ti'.$row->idtratamiento])){
                    $tiempo=$_POST['ti'.$row->idtratamiento];
                }else{
                    $tiempo="";
                }
                if (isset($_POST['c'.$row->idtratamiento])){
                    $costo=$_POST['c'.$row->idtratamiento];
                }else{
                    $costo="";
                }
                $this->db->query("INSERT INTO cotizaciontratamiento(idcotizacion,idtratamiento,n,tiempo,costo) 
VALUES('$idcotizacion','".$row->idtratamiento."','$n','$tiempo','$costo')");
            }
        }


        header("Location: ".base_url()."Paciente/cotizacion/".$idpaciente."/".$idhistorial);
    }
    function fotografia($idcotizacion){
        /*if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }*/
        $data['title']='Gestinar fotografias';
        $data['idcotizacion']=$idcotizacion;
        $data['idpaciente']=$this->User->consulta('idpaciente','historial','idhistorial',$this->User->consulta('idhistorial','cotizacion','idcotizacion',$idcotizacion));
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('fotografia');
        $data['tipo']="info";
        $data['msg']="Fotografias";
        $data['js']="
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
    function insertfoto(){
        $idcotizacion=$_POST['idcotizacion'];
        //$idcotizzcion

        $idpaciente=$this->User->consulta('idpaciente','historial','idhistorial',$this->User->consulta('idhistorial','cotizacion','idcotizacion',$idcotizacion));
        $nombre=$this->User->consulta('nombres','paciente','idpaciente',$idpaciente).' '.$this->User->consulta('apellidos','paciente','idpaciente',$idpaciente);
        $this->db->query("INSERT INTO foto(idcotizacion) VALUES('$idcotizacion')");
        $idfoto=$this->db->insert_id();

        $mi_archivo = 'foto';
        $carpeta = 'assets/img/'.$idpaciente.' '.$nombre;
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }
        $config['upload_path'] = $carpeta;
        $config['file_name'] = $idfoto;
        $config['allowed_types'] = "*";

        $config['overwrite'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($mi_archivo)) {
            //*** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }

        $data['uploadSuccess'] = $this->upload->data();

        header("Location: ".base_url()."Paciente/fotografia/".$idcotizacion);
    }
    function agregartratamiento(){
        $idtratamiento=$_POST['idtratamiento'];
        $idcotizacion=$_POST['idcotizacion'];
        $idpaciente=$_POST['idpaciente'];
        $idhistorial=$_POST['idhistorial'];
        $n=$_POST['n'];
        $tiempo=$_POST['tiempo'];
        $costo=$_POST['costo'];
        $diagnostico=$_POST['diagnostico'];
        $programa=$_POST['programa'];

        $query=$this->db->query("INSERT INTO cotizaciontratamiento(idcotizacion,idtratamiento,n,tiempo,costo) VALUES('$idcotizacion','$idtratamiento','$n','$tiempo','$costo')");
        $query=$this->db->query("UPDATE cotizacion SET diagnostico='$diagnostico',programa='$programa' WHERE idcotizacion='$idcotizacion' ");

        header("Location: ".base_url()."Paciente/cotizacion/$idpaciente/$idhistorial");
    }
    function datoscotizacion(){
        $idcotizacion=$_POST['idcotizacion'];
        $query=$this->db->query("SELECT * FROM cotizacion WHERE idcotizacion='$idcotizacion'");
        echo json_encode($query->result_array()[0]);

    }
    function elicotizacion($idcotizacion="",$idpaciente,$idhistorial){

        $query=$this->db->query("SELECT * FROM montos WHERE idcotizacion='$idcotizacion'");
        foreach ($query->result() as $row){
            $this->db->query("DELETE FROM consulta WHERE idmonto='$row->idmonto'");
            $this->db->query("DELETE FROM facial WHERE idmonto='$row->idmonto'");
            $this->db->query("DELETE FROM corporal WHERE idmonto='$row->idmonto'");
        }
        $query=$this->db->query("DELETE FROM cotizaciontratamiento WHERE idcotizacion='$idcotizacion'");
        $query=$this->db->query("DELETE FROM medida WHERE idcotizacion='$idcotizacion'");
        $query=$this->db->query("DELETE FROM montos WHERE idcotizacion='$idcotizacion'");
        $query=$this->db->query("DELETE FROM soap WHERE idcotizacion='$idcotizacion'");
        $query=$this->db->query("DELETE FROM receta WHERE idcotizacion='$idcotizacion'");
        $query=$this->db->query("DELETE FROM cotizacionconsetimeinto WHERE idcotizacion='$idcotizacion'");
        $query=$this->db->query("DELETE FROM cotizacionlaboratorio WHERE idcotizacion='$idcotizacion'");
        $query=$this->db->query("DELETE FROM cotizacion WHERE idcotizacion='$idcotizacion'");
        header("Location: ".base_url()."Paciente/cotizacion/$idpaciente/$idhistorial");
    }
    function consentimientoinsert(){
        $pdf = new PDF('P','mm','Letter');
        $idcotizacion=$_POST['idcotizacion'];
        $idpaciente=$_POST['idpaciente'];
        $idconsentimiento=$_POST['idconsentimiento'];

        $this->db->query("INSERT INTO cotizacionconsetimeinto (idconsetimiento, idcotizacion) VALUES ('$idconsentimiento', '$idcotizacion');");
        $query=$this->db->query("SELECT * FROM paciente WHERE idpaciente='$idpaciente'");

        $row=$query->row();
        $nombres=$row->nombres;
        $apellidos=$row->apellidos;
        $ci=$row->ci;
        $query=$this->db->query("SELECT * FROM consentimiento WHERE idconsentimiento=$idconsentimiento");
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
function laboratorioinsert(){

    $idpaciente=$_POST['idpaciente'];
    $idcotizacion=$_POST['idcotizacion'];
    $diagnostico=$_POST['diagnostico'];
    $otros=$_POST['otros'];
    $indicaciones=$_POST['indicaciones'];

    $query=$this->db->query("SELECT * FROM paciente WHERE idpaciente='$idpaciente'");
    $row=$query->row();
    $nombre=$row->nombres.' '.$row->apellidos;

    $cumpleanos = new DateTime($row->fechanac);
    $hoy = new DateTime();
    $annos = $hoy->diff($cumpleanos);
    $edad=$annos->y;



    $query=$this->db->query("SELECT * FROM laboratorio");



    $pdf = new FPDF('L','mm','Letter');
    $pdf->AddPage();
    $pdf->Image('assets/img/spa.png',280/2,3,280 /2);
    $pdf->Ln(15);
 foreach ($query->result() as $row){
     if (isset($_POST['l'.$row->idlaboratorio])){
         $this->db->query("INSERT INTO cotizacionlaboratorio(idlaboratorio,idcotizacion,diagnostico,otros,indicaciones)
        VALUES('".$row->idlaboratorio."','$idcotizacion','$diagnostico','$otros','$indicaciones')");
        }
 }
    $pdf->SetFont('Times','B',10);
    $pdf->Cell(170);
    $pdf->Cell(55,4,utf8_decode("SOLICITUD DE LABORATORIOS"),'B',0,'C');
    $pdf->Cell(15);
    $pdf->SetFont('Times','B',8);
    $pdf->Cell(17,4,utf8_decode("paciente id:"));
    $pdf->SetFont('Times','',7);
    $pdf->Cell(65,4,utf8_decode($idpaciente));
    $pdf->Ln();

    $pdf->Cell(280/2-7);
    $pdf->SetFont('Times','B',8);
    $pdf->Cell(37,4,utf8_decode("NOMBRE DEL PACIENTE:"));
    $pdf->SetFont('Times','',7);
    $pdf->Cell(65,4,utf8_decode($nombre));
    $pdf->SetFont('Times','B',8);
    $pdf->Cell(10,4,utf8_decode("EDAD:"));
    $pdf->SetFont('Times','',7);
    $pdf->Cell(55,4,utf8_decode($edad));
    $pdf->Ln();
    $pdf->Cell(280/2-7);
    $pdf->SetFont('Times','B',8);
    $pdf->Cell(37,4,utf8_decode("NOMBRE DEL MEDICO:"));
    $pdf->SetFont('Times','',7);
    $pdf->Cell(65,4,utf8_decode($_SESSION['nombre']));
    $pdf->SetFont('Times','B',8);
    $pdf->Cell(12,4,utf8_decode("FECHA:"));
    $pdf->SetFont('Times','',7);
    $pdf->Cell(55,4,utf8_decode(date("d/m/Y")));
    $pdf->Ln();
    $pdf->Cell(280/2-7);
    $pdf->SetFont('Times','B',8);
    $pdf->Cell(45,4,utf8_decode("DIAGNOSTICO PRESUNTIVO:"));
    $pdf->SetFont('Times','',7);
    $pdf->Cell(65,4,utf8_decode($diagnostico));
    $pdf->Ln();
    $query=$this->db->query("SELECT * FROM tipolaboratorio");
    foreach ($query->result() as $row){
        $pdf->SetFont('Times','B',8);
        $pdf->Cell(280/2);
        $pdf->Cell(280/2,3,$row->nombre,0,0,'C');
        $pdf->Ln();

        $query2=$this->db->query("SELECT * FROM laboratorio where idtipolaboratorio='".$row->idtipolaboratorio."'");
        foreach ($query2->result() as $row2){
            if (isset($_POST['l'.$row2->idlaboratorio])){
                $x="X";
                $n="B";
            }else{
                $x="   ";
                $n="";
            }
            $pdf->SetFont('Times',$n,7);

            $pdf->Cell(280/2+10);
            $pdf->Cell(280/2,3," ($x) ".$row2->nombre);
            $pdf->Ln();
        }
    }
    $pdf->Ln();
    $pdf->Cell(280/2-7);
    $pdf->SetFont('Times','B',8);
    $pdf->Cell(37,4,utf8_decode("OTROS EXAMENES:"));
    $pdf->SetFont('Times','',7);
    $pdf->Cell(65,4,utf8_decode($otros));
    $pdf->Ln();
    $pdf->Cell(280/2-7);
    $pdf->SetFont('Times','B',8);
    $pdf->Cell(45,4,utf8_decode("INDICACIONES ESPACIALES:"));
    $pdf->SetFont('Times','',7);
    $pdf->Cell(65,4,utf8_decode($indicaciones));

    $pdf->Ln(15);
    $pdf->Cell(170);
    $pdf->Cell(55,4,utf8_decode("FIRMA DEL MEDICO"),'T',0,'C');
    $pdf->Ln();
    $pdf->Output();
}
    function reghistorial($idpaciente=""){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['idpaciente']=$idpaciente;
        $data['title']='Registrar historial';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
            <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('reghistorial',$data);
        $data['tipo']="info";
        $data['msg']="Atencion a pacientes";
        $data['js']="
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
}