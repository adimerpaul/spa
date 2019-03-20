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
}

class Paciente extends CI_Controller {
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Atencion a pacientes';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('paciente');
        $data['tipo']="info";
        $data['msg']="Atencion a pacientes";
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
        $ci=$_POST['ci'];
         $query=$this->db->query("INSERT INTO paciente(ci,nombres,apellidos,zona,direccion,fechanac,celular,telefono,idusuario) 
VALUES ('$ci','$nombres', '$apellidos', '$zona', '$direccion', '$fechanac', '$celular','$telefono', '".$_SESSION['idusuario']."');");
        $idpaciente=$this->db->insert_id();
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
        $fuma=$_POST['fuma'];
        $bebe=$_POST['bebe'];
        $actividadfisica=$_POST['actividadfisica'];
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
        $piel=$_POST['piel'];
        $biotipo=$_POST['biotipo'];
        $arrugas=$_POST['arrugas'];

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
arrugas) VALUES (
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
'$arrugas'
);");

if($query){
        $data['title']='Atencion a pacientes';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('paciente');
        $data['tipo']="success";
        $data['msg']="Paciente registrado";
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
    }
    function cotizacion($idpaciente){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Cotizacion de tratamientos';
        $data['idpaciente']=$idpaciente;
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('cotizacion');
        $data['tipo']="info";
        $data['msg']="Cotizaciones";
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
    function insertcotizacion(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $idpaciente=$_POST['idpaciente'];
        $this->db->query("INSERT INTO cotizacion(idpaciente) VALUES('$idpaciente')");
        $idcotizacion=$this->db->insert_id();
        $query=$this->db->query("SELECT * FROM tratamiento");
        foreach ($query->result() as $row){
            if (isset($_POST['t'.$row->idtratamiento])){
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
        header("Location: ".base_url()."Paciente/cotizacion/".$idpaciente);
    }
    function fotografia($idcotizacion){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Gestinar fotografias';
        $data['idcotizacion']=$idcotizacion;
        $data['idpaciente']=$this->User->consulta('idpaciente','cotizacion','idcotizacion',$idcotizacion);
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('fotografia');
        $data['tipo']="info";
        $data['msg']="Fotografias";
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
    function insertfoto(){
        $idcotizacion=$_POST['idcotizacion'];
        //$idcotizzcion

        $idpaciente=$this->User->consulta('idpaciente','cotizacion','idcotizacion',$idcotizacion);
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
    function historial($idpaciente=1){
        $query=$this->db->query("SELECT * FROM paciente WHERE idpaciente=$idpaciente");
        $row=$query->row();

        $nombres=$row->nombres;
        $apellidos=$row->apellidos;
        $zona=$row->zona;
        $direccion=$row->direccion;
        $fechanac=$row->fechanac;
        $celular=$row->celular;
        $telefono=$row->telefono;

        $query=$this->db->query("SELECT * FROM historial WHERE idpaciente=$idpaciente");
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
        $pdf->subtitulo("ARRUGA LUGAR Y GRADO DEL I-II:");
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

        $pdf->Output();
    }
    function consentimientoinsert(){
        $pdf = new FPDF('P','mm','Letter');
        $idcotizacion=$_POST['idcotizacion'];
        $idpaciente=$_POST['idpaciente'];
        $idconsentimiento=$_POST['idconsentimiento'];
        $this->db->query("INSERT INTO cotizacionconsetimeinto (idconsetimiento, idcotizacion) VALUES ('$idconsentimiento', '$idcotizacion');");
        $query=$this->db->query("SELECT * FROM paciente WHERE idpaciente=$idpaciente");
        $row=$query->row();
        $nombres=$row->nombres;
        $apellidos=$row->apellidos;
        $ci=$row->ci;

        $pdf->AddPage();
        $pdf->Image('assets/img/spa.png',0,0,216);
        $pdf->Ln(19);
        if ($idconsentimiento==1){
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(5);
        $pdf->MultiCell(185,4,utf8_decode('CONSENTIMIENTO INFORMADO PARA TRATAMIENTO MEDIANTE PLASMA RICO EN PLAQUETAS - MEGADOSIS VITAMINA C '),'B','C' );
        $pdf->SetFont('Times','',10);
        $pdf->Cell(0,4,utf8_decode('Idpaciente= '.$idpaciente ),0,0);
        $pdf->Ln();
        $pdf->SetFont('Times','',10);
        $pdf->Cell(11,4,utf8_decode('Oruro, '.date("d/m/Y")));
        $pdf->Ln();
        $pdf->MultiCell(0,4,utf8_decode("En forma libre y voluntaria yo, $nombres $apellidos
Identificado(a) con la cédula de identidad número $ci manifiesto que:"));
        $pdf->MultiCell(0,4,utf8_decode('Por el presente consiento que se me realice el procedimiento terapéutico indicado y aconsejado. Se me ha explicado la naturaleza y el objetivo del tratamiento, incluyendo riesgos leves y de gravedad en caso de no cuidarme y alternativas disponibles al tratamiento. Estoy satisfecho con esas explicaciones y las he comprendido.
También consiento la realización de todo procedimiento o tratamiento adicional o alternativo que en opinión del Medico sean necesarios. Consiento la administración de aquellos anestésicos que puedan ser considerados necesarios o convenientes, comprendiendo que ello puede implicar ciertos riesgos de distinta envergadura. Además de consentir como la filmación o fotografía para fines comparativos.
"ESCENCIA SPA MEDICO", me ha informado en qué consiste el tratamiento. Se me ha realizado una Historia Clínica para descartar patologías y riesgos, que impidan beneficiarme con éste tratamiento, confirmando que no padezco ninguna de las siguientes patologías motivo de contraindicación de la aplicación del tratamiento.
*	Embarazo y  Lactancia 
*	Inmunosupresión , Patología tumoral , Epilepsia convulsiones, deficiencias de coagulación.
*	Sitios de infección local activa , Inflamación local activa
*	Alergias 
*	Ingesta de alcohol en la última semana antes del tratamiento. 
*	Ingesta de Aspirina o antiinflamatorios, o encontrarme con tratamiento antibiótico en la última semana previa al tratamiento
*	Enfermedades del corazón,
*	Cirugías recientes o próximas al tratamiento excepto para el caso de la megadosis de vitamina C'));
        //$pdf->Cell(37,4,utf8_decode('PROCEDIMIENTO.- '),'B' );
        $pdf->Ln();
        $pdf->MultiCell(0,4,utf8_decode('PROCEDIMIENTO.- Técnica ambulatoria que consiste: paciente en decúbito dorsal se le aplica en la zona a tratar una crema anestésica dejándola que actúe unos minutos, tiempo en el que permanece tranquilamente relajado. Luego se extrae entre 5ml para el plasma superficial y entre 20 y 25ml de sangre venosa del mismo paciente para el caso del plasma profundo, la que se coloca en tubos estériles a una centrifugadora por medio de la cual se separa el plasma de los glóbulos rojos y blancos. Se activa la fracción de plasma a utilizar, al ser retirado el plasma de los tubos en jeringas pre cargadas con el activador. Una vez conseguido el plasma rico en factores de crecimiento se introduce en la dermis mediante inyecciones superficiales intradérmicas superficial o nappage, subcutánea se aplica  con una aguja hipodérmica, haciendo pequeños y múltiples micro inyecciones en la zona a tratar.
Para el caso de la megadosis de vitamina C solamente me colocarán una vía endovenosa en el antebrazo por el lapso de media a una hora donde ingresará la vitamina c y el suero. Para el caso de células madre además deberé firmar un consentimiento adicional.
Se me ha informado que puedo sentir un ligero malestar, dependiendo de mi umbral de dolor. Irritación, Enrojecimiento, Hipersensibilidad en la piel tratada Inflamación,  Picazón, molestias en la piel aparición de hematomas y que según el procedimiento, la duración puede variar , generalmente  de media a una hora, luego de la cual el paciente puede regresar sin problemas a casa siguiendo las indicaciones posteriores. La cantidad de sesiones está en relación directa con el efecto que quiera obtenerse normalmente se requieren de 2 a más sesiones, por lo tanto hago entender que no necesitaré firmar un consentimiento informado en cada sesión, sobreentendiendo que el primero es válido para todas las sesiones que voluntariamente solicite.
    '));
        //$pdf->Cell(45,4,utf8_decode('CUIDADOS POSTERIORES.-.- '),'B' );
        //$pdf->Ln();
            $pdf->Ln();
            $pdf->MultiCell(0,4,utf8_decode('CUIDADOS POSTERIORES.-
*	Evitar la  exposición al sol, cama solar o cualquier fuente de calor externo (saunas, horno, estufas, radiación solar).
*	Utilizar protector solar  FPS mayor 45 cada 2hrs
*	No Depilar  o  afeitar  la zona tratada por 48hrs
*	Evitar realizar masajes, ejercicios violentos (Excepto plasma superficial y megadosis de vitamina C), natación, baños de inmersión o sauna, ya que estos generan vasodilatación e infección por el lapso de 72Hrs
*	No consumir bebidas alcohólicas 72 Hrs, no comidas picantes o muy condimentadas, no gaseosas ni dulces.
*	Dejo constancia además de que comunicaré al profesional encargado, cualquier molestia o reacción posterior a la sesión.
*	Control Médico en 48 hrs.
He comprendido, todas las explicaciones otorgadas en lenguaje sencillo y claro, el profesional que me ha atendido me han permitido realizar todas las observaciones y me aclaró dudas planteadas.
Por ello manifiesto que estoy satisfecho(a) con la información recibida y que comprendo el alcance y riesgos del tratamiento libremente y en tales condiciones.'));
            $pdf->Ln(10);
            $pdf->Cell(75);
            $pdf->Cell(55,4," FIRMA PACIENTE   ",'T',0,'C');
            /*$pdf->Ln();
            $pdf->Cell(75);
            $pdf->Cell(55,3," C.I.: $ci   ",0,0,'C');
            */
        }elseif ($idconsentimiento==2){
            $pdf->SetFont('Times','B',10);
            $pdf->Cell(5);
            $pdf->MultiCell(185,4,utf8_decode('CONSENTIMIENTO INFORMADO PARA APLICAR MESOTERAPIA FACIAL - CAPILAR - CORPORAL - FOSFATIDILCOLINA - HIDROLIPOCLASIA QUIMICA '),'B','C' );
            $pdf->SetFont('Times','',10);
            $pdf->Cell(0,4,utf8_decode('Idpaciente= '.$idpaciente ),0,0);
            $pdf->Ln();
            $pdf->SetFont('Times','',10);
            $pdf->Cell(11,4,utf8_decode('Oruro, '.date("d/m/Y")));
            $pdf->Ln();
            $pdf->MultiCell(0,4,utf8_decode("En forma libre y voluntaria yo, $nombres $apellidos
Identificado(a) con la cédula de identidad número $ci manifiesto que:"));
            $pdf->MultiCell(0,4,utf8_decode('Por el presente consiento que se me realice el procedimiento requerido, proceso terapéutico indicado y aconsejado de acuerdo a mi patología. Se me ha explicado la naturaleza y el objetivo de lo que se me propone, incluyendo riesgos mínimos o significativos si no me cuidara y alternativas disponibles de tratamientos. Estoy satisfecho con esas explicaciones y las he comprendido.
También consiento la realización de todo procedimiento o tratamiento adicional o alternativo que en opinión del Médico sean necesarios. Además de consentir con la filmación o fotografías cuidando mi identidad, para motivos comparativos de antes y después.
"ESCENCIA SPA MEDICO", me ha informado en que consiste el tratamiento .Se me ha realizado una Historia Clínica para descartar patologías y otros, que impidan beneficiarme con éste tratamiento, confirmando de que no padezco ninguna de las siguientes patologías motivo de contraindicación de la aplicación del tratamiento.
*	Embarazo y/o lactancia 
*	Inmunosupresión (VIH)
*	Patología tumoral
*	Epilepsia
*	Pacientes con problemas de coagulación (Diátesis hemorrágicas)
*	Sitios de infección local activa
*	Inflamación local activa
*	Diabetes no controlada
'));
            //$pdf->Cell(37,4,utf8_decode('PROCEDIMIENTO.- '),'B' );
            $pdf->Ln();
            $pdf->MultiCell(0,4,utf8_decode('PROCEDIMIENTO.- Consiste en la aplicación de preparados farmacológicos, que varían según el tipo y grado de la patología a tratar, mediante una serie de inyecciones superficiales intradérmicas o subcutáneas, se aplica con una aguja hipodérmica, haciendo pequeñas y múltiples micro inyecciones en la zona a tratar. De esta, manera el medicamento actúa directamente sobre el área afectada y con dosis menores a las que se necesitarían si se aplicara por otra vía, como la oral o tópica en lociones y cremas de difícil absorción. En el caso de la Fosfatidilcolina solo se utilizará éste medicamento. Para la hidrolipoclasia además del cocktel de medicamentos también se añadirá suero fisiológico. Se me ha informado de que puedo sentir un ligero malestar, dependiendo de mi umbral de dolor y que según el procedimiento, la duración puede variar entre 20 minutos y una hora dependiendo de la zona a tratar. También tengo conocimiento de que será necesario como un mínimo de 6 a más sesiones, para conseguir mi propósito, por lo tanto hago entender que no necesitaré firmar un consentimiento informado en cada sesión, sobreentendiendo que el primero es válido para todas las sesiones que voluntariamente solicite.'));
            //$pdf->Cell(45,4,utf8_decode('CUIDADOS POSTERIORES.-.- '),'B' );
            //$pdf->Ln();
            $pdf->MultiCell(0,4,utf8_decode('CUIDADOS POSTERIORES.-
*	Durante las primeras 24 a 48 hs debemos evitar la  exposición al sol o cama solar
*	Utilizar imprescindiblemente protector solar FPS mayor 45 cada 2-3 hrs, gorra en el caso de mesoterapia capilar.
*	No depilar o afeitar la zona tratada por 24-48hs.
*	Evitar realizar masajes, ejercicios violentos, natación, baños de inmersión o sauna, ya que estos generan vasodilatación y se perdería el fármaco depositado de forma rápida.
*	Es importante beber mucha agua para que el cuerpo libere las toxinas que se desprenden con el tratamiento.
*	No hay que practicar ejercicio físico (excepto en la hidrolipoclasia química) y tratar la zona de aplicación con algo de hielo si hace falta
*	Uso de una faja de compresión durante 2 a 4 días después del tratamiento ayuda a la modelación corporal en el caso de mesoterapia corporal. Fosfatidilcolina e hidrolipoclasia.
*	Debes evitar el consumo de bebidas alcohólicas, comidas picantes o muy condimentadas, alimentos dulces y gaseosas.
*	Dejo constancia además de que comunicaré a la profesional encargada, cualquier molestia o reacción posterior a la sesión.

He comprendido, todas las explicaciones otorgadas en lenguaje sencillo y claro, el profesional que me ha atendido me han permitido realizar todas las observaciones y me aclaró dudas planteadas.
Por ello manifiesto que estoy satisfecho(a) con la información recibida y que comprendo el alcance y riesgos del tratamiento libremente y en tales condiciones.
'));
            $pdf->Ln(10);
            $pdf->Cell(75);
            $pdf->Cell(55,4," FIRMA PACIENTE   ",'T',0,'C');
        }elseif ($idconsentimiento==3){
            $pdf->SetFont('Times','B',10);
            $pdf->Cell(5);
            $pdf->MultiCell(185,4,utf8_decode('CONSENTIMIENTO INFORMADO PARA APLICACIÓN DE TOXINA BOLTULÍNICA Y/O  RELLENOS FACIALES RINOMODELACIÓN SIN CIRUGÍA O RELLENO DE LABIOS  '),'B','C' );
            $pdf->SetFont('Times','',10);
            $pdf->Cell(0,4,utf8_decode('Idpaciente= '.$idpaciente ),0,0);
            $pdf->Ln();
            $pdf->SetFont('Times','',10);
            $pdf->Cell(11,4,utf8_decode('Oruro, '.date("d/m/Y")));
            $pdf->Ln();
            $pdf->MultiCell(0,4,utf8_decode("En forma libre y voluntaria yo, $nombres $apellidos
Identificado(a) con la cédula de identidad número $ci manifiesto que:"));
            $pdf->MultiCell(0,3,utf8_decode('Por el presente consiento que se me realice el procedimiento terapéutico indicado y aconsejado. Se me ha explicado la naturaleza y el objetivo del tratamiento, incluyendo riesgos y alternativas disponibles. Estoy satisfecho con esas explicaciones y las he comprendido.
También consiento la realización de todo procedimiento o tratamiento adicional o alternativo que en opinión del Médico Tratante sean necesarios
Consiento la administración de aquellos anestésicos que puedan ser considerados necesarios o convenientes, comprendiendo que ello puede implicar ciertos riesgos de distinta envergadura. Además de consentir como la filmación o fotografía no presentando mi identidad.
"ESCENCIA SPA MEDICO", me ha informado en que consiste el tratamiento. Se me ha realizado una Historia Clínica para descartar patologías y riesgos, que me impidan beneficiarme con éste tratamiento, confirmando que no padezco ninguna de las siguientes patologías motivo de contraindicación de la aplicación del tratamiento.
*	Embarazo y  Lactancia 
*	Inmunosupresión , Patología tumoral , Epilepsia convulsiones, Enfermedades neuromusculares, debilidad muscular facial (párpados caídos, frente débil, problemas para levantar sus cejas)
*	Problemas o enfermedades de coagulación
*	Sitios de infección o inflamación local activa
*	Alergias 
*	Miastenia grave, esclerosis lateral amiotrofica (ALS, o enfermedad de Lou Gehrig); síndrome de Lambert-Eaton;
*	Ingesta de alcohol en la última semana antes del tratamiento. 
*	Ingesta de Aspirina o antiinflamatorios en la última semana previa al tratamiento
*	Enfermedades del corazón
*	Cirugías recientes o próximas al tratamiento
*	Haber recibido previamente un tratamiento con rellenos o toxina botulínica en los anteriores 4 meses
*	Problemas de respiración y deglución
*	Haber recibido vía endovenosa algún antibiótico'));
            //$pdf->Cell(37,4,utf8_decode('PROCEDIMIENTO.- '),'B' );
            $pdf->Ln();
            $pdf->MultiCell(0,3,utf8_decode('PROCEDIMIENTO.-Consiste en la aplicación de Toxina Botulínica Tipo A y/o Acido Hialurónico según el tipo y grado de la patología a tratar (El ácido hialurónico es una sustancia que se halla naturalmente en el organismo del ser humano y de los animales y la toxina botulínica tipo A es una sustancia producida por el Clostridium botulinum y la dosis es inocua), se los administra o aplica mediante inyecciones superficiales intradérmicas, y/o subcutánea  y se aplican  con una aguja hipodérmica. De esta, manera el medicamento actúa directamente sobre el área afectada, se me ha informado de que puedo sentir un ligero malestar, dependiendo de mi umbral de dolor, irritación, enrojecimiento, hipersensibilidad en la piel tratada, inflamación, picazón, aparición de hematomas o bultos en las zonas donde se ha aplicado; y que según el procedimiento, la duración puede variar entre 20 minutos y una hora dependiendo de la zona a tratar. También tengo conocimiento de que el  propio organismo va degradando las sustancias gradualmente una vez inyectado, hasta su desaparición de 4 a 6 meses, por lo tanto hago entender que no necesitaré firmar un consentimiento informado en una siguiente sesión, sobreentendiendo que el primero es válido para todas las sesiones que voluntariamente solicite.'));
            //$pdf->Cell(45,4,utf8_decode('CUIDADOS POSTERIORES.-.- '),'B' );
            $pdf->Ln();
            $pdf->MultiCell(0,4,utf8_decode('CUIDADOS POSTERIORES.- Me comprometo a cumplir con los siguientes cuidados posteriores, mismos que me serán entregados en una hoja aparte:
*	No exponerme al sol ni ninguna fuente de calor externo
*	Utilizar protector solar  FPS 50 cada 3 horas
*	No Depilar  o  afeitar  la zona tratada por 48hs
*	Evitar realizar masajes, ejercicios violentos, natación, baños de inmersión o sauna, ya que estos generan vasodilatación y se perdería el fármaco depositado.
*	Tratar la zona de aplicación con hielo en caso de dolor e inflamación
*	Evitar el consumo de bebidas alcohólicas y cigarrillo
*	En el caso de la toxina botulínica deberé dormir semi sentado para evitar que migre la misma
*	En el tratamiento de labios no ingerir bebidas calientes o sopas para evitar la aplicación de calor directamente en la zona tratada. Tampoco se depilará con cera caliente y  evitará las mordeduras en los labios.
*	Tras el tratamiento, podrá hidratar la región tratada pero no dar masajes. Deberá evitar la manipulación brusca de esa zona, por lo que tratamientos de odontología deben posponerse. 
*	Podrá lavarse la cara con agua y  maquillarse o utilizar sus cremas habituales después de 24 a 48 horas del tratamiento.
*	Dejo constancia además de que comunicaré al profesional encargado, cualquier molestia o reacción posterior a la sesión.
He comprendido, todas las explicaciones otorgadas en lenguaje sencillo y claro, el profesional que me ha atendido me permitió realizar todas las observaciones y me aclaró dudas planteadas.
Por ello manifiesto que estoy satisfecho(a) con la información recibida y que comprendo el alcance y riesgos del tratamiento libremente y en tales condiciones.
'));
            $pdf->Ln(10);
            $pdf->Cell(75);
            $pdf->Cell(55,4," FIRMA PACIENTE   ",'T',0,'C');
        }elseif ($idconsentimiento==4){
            $pdf->SetFont('Times','B',10);
            $pdf->Cell(5);
            $pdf->MultiCell(185,4,utf8_decode('CONSENTIMIENTO INFORMADO PARA APLICAR TRATAMIENTO REDUCTOR MEDIANTE ULTRACAVITACION - RADIOFRECUENCIA TRIPOLAR - LIPOLASER DE DIODO NO INVASIVO  '),'B','C' );
            $pdf->SetFont('Times','',10);
            $pdf->Cell(0,4,utf8_decode('Idpaciente= '.$idpaciente ),0,0);
            $pdf->Ln();
            $pdf->SetFont('Times','',10);
            $pdf->Cell(11,4,utf8_decode('Oruro, '.date("d/m/Y")));
            $pdf->Ln();
            $pdf->MultiCell(0,4,utf8_decode("En forma libre y voluntaria yo, $nombres $apellidos
Identificado(a) con la cédula de identidad número $ci manifiesto que:"));
            $pdf->MultiCell(0,4,utf8_decode('"ESCENCIA SPA MEDICO", me ha informado en que consiste el tratamiento de REDUCCION mediante Ultracavitación -  Radiofrecuencia Tripolar - Lipoláser de Diodo no Invasivo. Se me ha realizado una Historia Clínica para descartar patologías y otros, que impidan beneficiarme con éste tratamiento, consiento cualquier tratamiento adicional o alternativo que en opinión del médico tratante decida para mayor mejoría. Autorizo me puedan tomar fotografías del antes, durante y después con fines comparativos. 
Siendo mi firma al pie de éste documento, la confirmación de que no padezco ninguna de las siguientes patologías motivo de contraindicación de la aplicación.
*	No estoy cursando con ninguna enfermedad crónica (artritis, diabetes, epilepsia, etc.)
*	No padezco ninguna enfermedad cardíaca, arritmias, insuficiencias, hipertensión ni tampoco padezco de poliglobulia.
*	No he tomado aspirina, ni algún antiinflamatorio,  ayer ni hoy, tampoco puedo usarlas 72 horas después del tratamiento.
*	No estoy embarazada, ni dando de lactar.
*	No sufro de enfermedades gástricas: úlceras, gastritis, etc.
*	No estoy con mi período menstrual para el caso de ultracavitación.
*	No tengo fiebre, ni infección aguda.
*	No tengo ninguna herida abierta reciente o cirugía a menos de 3 meses de recuperación.
*	No tengo ningún metal dentro del cuerpo: marcapasos, T de cobre, prótesis, etc. Para el caso de ultracavitación
*	No padezco ningún problema que afecte mi función renal, incluiré un examen de orina en caso de duda, ya que como se me informó que la grasa se eliminará por esta vía en forma de glicerina.
*	No estoy realizando ningún tratamiento prostático, tampoco en o alrededor de los testículos.
*	No ingiero comidas altas en calorías, no tengo problemas de obesidad.
*	No estoy tomando píldoras u otro tratamiento para adelgazar, de ser así mencionarlo al médico tratante.
'));
            //$pdf->Cell(37,4,utf8_decode('PROCEDIMIENTO.- '),'B' );
            $pdf->Ln();
            $pdf->MultiCell(0,4,utf8_decode('PROCEDIMIENTO.- Se me tomarán las medidas en las zonas necesarias reducir previo al tratamiento. Subiré a la camilla y adoptaré la posición indicada de acuerdo a la zona a tratarse, deberé quitarme todo objeto metálico que tenga en ese momento. Se apoyará el cabezal de cavitación sobre mi piel con gel abundante se me preguntará qué nivel de energía tolero ya que se sentirá como un leve chirrido en los oídos, hasta llegar al nivel tolerable. La Ultracavitación durará de 10 a más minutos según la cantidad de tejido graso. Se me ha informado de que según el tiempo de Ultracavitación continuará el tratamiento de radiofrecuencia tripolar, siendo este generalmente el doble que de cavitación. La radiofrecuencia dará la sensación de calor en la piel que también irá aumentando según la tolerancia del paciente (1-100%), el mismo que tendrá una duración de 15 a 20 min. En el caso del lipoláser de diodo n invasivo se me colocarán pads en diferentes zonas del cuerpo y estaré en reposo por media hora, no percibiré ningún sonido o molestia alguna. También tengo conocimiento de que será necesario de 4 a más sesiones, según la zona de mi cuerpo, para conseguir mi propósito, por lo tanto hago entender que no necesitaré firmar un consentimiento informado en cada sesión, sobreentendiendo que el primero es válido para todas las sesiones que voluntariamente solicite.'));
            //$pdf->Cell(45,4,utf8_decode('CUIDADOS POSTERIORES.-.- '),'B' );
            $pdf->Ln();
            $pdf->MultiCell(0,4,utf8_decode('CUIDADOS POSTERIORES.- Después de realizado el tratamiento y durante las siguientes 72 horas, es necesario no ingerir bebidas alcohólicas en exceso, ni alimentos copiosos y ricos en grasas. Además deberé consumir agua 2 litros diarios por lo menos para ayudar al riñón a eliminar la grasa en forma de glicerina.
Uso de una faja de compresión durante 2 a 4 días después del tratamiento ayuda a la modelación corporal. 
Debes evitar el consumo de bebidas alcohólicas, comidas picantes o muy condimentadas, alimentos dulces y gaseosas.
Dejo constancia además de que comunicaré a la profesional encargada, cualquier molestia o reacción luego del tratamiento.
He comprendido, todas las explicaciones otorgadas en lenguaje sencillo y claro, el profesional que me ha atendido me permitió realizar todas las observaciones y me aclaró dudas planteadas.
Por ello manifiesto que estoy satisfecho(a) con la información recibida y que comprendo el alcance y riesgos del tratamiento en caso de incumplimiento por mi parte, libremente y en tales condiciones.
'));
            $pdf->Ln(10);
            $pdf->Cell(75);
            $pdf->Cell(55,4," FIRMA PACIENTE   ",'T',0,'C');
        }elseif ($idconsentimiento==5){
            $pdf->SetFont('Times','B',10);
            $pdf->Cell(5);
            $pdf->MultiCell(185,4,utf8_decode('CONSENTIMIENTO INFORMADO PARA TRATAMIENTO CON LUZ PULSADA INTENSA (IPL) - PEELENG FACIAL - DERMOABRASIÓN CON PUNTAS DE DIAMANTES'),'B','C' );
            $pdf->SetFont('Times','',10);
            $pdf->Cell(0,4,utf8_decode('Idpaciente= '.$idpaciente ),0,0);
            $pdf->Ln();
            $pdf->SetFont('Times','',10);
            $pdf->Cell(11,4,utf8_decode('Oruro, '.date("d/m/Y")));
            $pdf->Ln();
            $pdf->MultiCell(0,4,utf8_decode("En forma libre y voluntaria yo, $nombres $apellidos
Identificado(a) con la cédula de identidad número $ci manifiesto que:"));
            $pdf->MultiCell(0,4,utf8_decode('"ESCENCIA SPA MEDICO", me ha informado en que consiste el tratamiento con Luz Pulsada Intensa (IPL) – Peeleng Facial – Dermoabrasión con puntas de Diamantes. Se me ha realizado una Historia Clínica para descartar patologías y otros, que me impidan beneficiarme con éste tratamiento, también consiento cualquier tratamiento adicional o alternativo que en opini´n de mi médico tratante sugiera. Así mismo autorizo para que se tomen fotografías del antes de mi tratamiento, durante y después, para fines comparativos. 
Siendo mi firma al pie de éste documento, la confirmación de que no padezco ninguna de las siguientes patologías motivo de contraindicación.
*	No estoy tomando, ni he tomado isotretinoina, acitetrina, vitamina A o ácido cis-retinoico, en altas dosis, en caso afirmativo se me ha informado que debo esperar por lo menos 4 meses antes del tratamiento.
*	No he usado cremas que contengan ácido glicólico o retinoico ayer ni hoy, tampoco puedo usarlas 72 horas después del tratamiento.
*	No estoy embarazada, ni dando de lactar.
*	No sufro de epilepsia.
*	No estoy en proceso de Herpes Simplex.
*	No tengo fiebre, ni infección aguda.
*	No padezco de ninguna infección dermatológica en éste momento (dermatitis), ni sospecha de cáncer de piel.
*	No padezco de Diabetes Mellitus complicada.
*	No estoy en tratamiento con antibióticos u otros tratamientos que produzcan fotosensibilidad (hipoglucemiantes orales, clordiazpoxido, griseofulvina,  ciprofloxacino, ácido nalidixico, psoralenos, diuréticos tiazídicos, antimaláricos, difenhidramina, isoniazida, noretinodrel, sulfamidas, vacuna antisarampión, barbitúricos, fenotiazidas, mestranol, sales de oro o tetraciclinas.
*	No he tomado sol ni rayos UVA (bronceado en cama solar), 30 días antes del tratamiento.
'));
            //$pdf->Cell(37,4,utf8_decode('PROCEDIMIENTO.- '),'B' );
            $pdf->Ln();
            $pdf->MultiCell(0,4,utf8_decode('PROCEDIMIENTO.- Se me colocará un protector ocular en el caso de la luz pulsada intensa para resguardarme de la luz láser durante el procedimiento. Se apoyará el cabezal láser sobre mi piel con gel y con cada pulsación se me ha informado de que puedo sentir un ligero malestar, dependiendo de mi umbral de dolor. En el caso del peeleng se aplicará un ácido de acuerdo a mi patología sobre la cara que puede ser superficial, medio o profundo, durante un tiempo controlado por el médico tratante. Para la dermoabrasión con puntas de diamantes se aplicará un dispositivo que pule y absorbe mis células muertas de la piel, de igual manera durante un tiempo determinado. Se me ha informado de que según el procedimiento, la duración puede variar entre 2 minutos y 1 hora dependiendo de la zona a tratar. También tengo conocimiento de que será necesario como un  mínimo de 5 sesiones a más, para conseguir mi propósito, por lo tanto hago entender que no necesitaré firmar un consentimiento informado en cada sesión, sobreentendiendo que el primero es válido para todas las sesiones que voluntariamente solicite.'));
            //$pdf->Cell(45,4,utf8_decode('CUIDADOS POSTERIORES.-.- '),'B' );
            $pdf->Ln();
            $pdf->MultiCell(0,4,utf8_decode('CUIDADOS POSTERIORES.- Después de realizada la sesión y durante los siguientes 30 días, no me  expondré a los rayos solares de forma directa ni prolongada, usaré protector solar mayor a 45 FPS. Dejo constancia además de que comunicaré al profesional encargado, cualquier molestia o reacción posterior a la sesión.

He comprendido, todas las explicaciones otorgadas en lenguaje sencillo y claro, el profesional que me ha atendido me permitió realizar todas las observaciones y me aclaró dudas planteadas.
También comprendo que en cualquier momento y sin necesidad de dar ninguna explicación, puedo cancelar el consentimiento que ahora presto.
Por ello manifiesto que estoy satisfecho(a) con la información recibida y que comprendo el alcance y riesgos del tratamiento libremente y en tales condiciones.
'));
            $pdf->Ln(10);
            $pdf->Cell(75);
            $pdf->Cell(55,4," FIRMA PACIENTE   ",'T',0,'C');
        }
        //echo $idconsentimiento."sdas";
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

}