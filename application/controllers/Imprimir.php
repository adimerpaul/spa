<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 27/3/2019
 * Time: 16:08
 */
require('fpdf.php');
require_once('tcpdf.php');
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
}
class Imprimir extends CI_Controller{
    function index($idcotizacion="",$idpaciente="",$idhistorial=""){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $query=$this->db->query("SELECT * FROM cotizacion WHERE idcotizacion=$idcotizacion");
        $row=$query->row();
        $diagnostico=$row->diagnostico;
        $programa=$row->programa;


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


            $pdf->Ln();
            $pdf->titulo("MEDIDAS A REDUCIR:",0);
            $pdf->Ln();
            $query=$this->db->query("SELECT fecha FROM medida WHERE idcotizacion=$idcotizacion  ");
            $pdf->Ln();
            $pdf->SetFont('Times','B',8);
            $pdf->Cell(35,6,'FECHA DE MEDICION',1,0);
            foreach ($query->result() as $row){
                $pdf->Cell(18,6, substr($row->fecha,0,10),1,0,'C');
            }
            $pdf->SetFont('Times','',8);
            $pdf->Ln();
            $query=$this->db->query("SELECT papada FROM medida WHERE idcotizacion=$idcotizacion  ");
            $pdf->Cell(35,6,'PAPADA',1,0);
            foreach ($query->result() as $row){
                $pdf->Cell(18,6,$row->papada,1,0,'C');
            }
            $query=$this->db->query("SELECT brazosd1 FROM medida WHERE idcotizacion=$idcotizacion  ");
            $pdf->Ln();
            $pdf->Cell(35,6,'BRAZOS D-1',1,0);
            foreach ($query->result() as $row){
                $pdf->Cell(18,6,$row->brazosd1,1,0,'C');
            }
            $query=$this->db->query("SELECT espaldaalta FROM medida WHERE idcotizacion=$idcotizacion  ");
            $pdf->Ln();
            $pdf->Cell(35,6,'ESPALDA ALTA',1,0);
            foreach ($query->result() as $row){
                $pdf->Cell(18,6,$row->espaldaalta,1,0,'C');
            }
            $query=$this->db->query("SELECT espaldabaja FROM medida WHERE idcotizacion=$idcotizacion  ");
            $pdf->Ln();
            $pdf->Cell(35,6,'ESPALDA BAJA',1,0);
            foreach ($query->result() as $row){
                $pdf->Cell(18,6,$row->espaldabaja,1,0,'C');
            }
            $query=$this->db->query("SELECT cintura FROM medida WHERE idcotizacion=$idcotizacion  ");
            $pdf->Ln();
            $pdf->Cell(35,6,'CINTURA',1,0);
            foreach ($query->result() as $row){
                $pdf->Cell(18,6,$row->cintura,1,0,'C');
            }
            $query=$this->db->query("SELECT ombligo FROM medida WHERE idcotizacion=$idcotizacion  ");
            $pdf->Ln();
            $pdf->Cell(35,6,'PAPADA',1,0);
            foreach ($query->result() as $row){
                $pdf->Cell(18,6,$row->ombligo,1,0,'C');
            }
            $query=$this->db->query("SELECT cm2 FROM medida WHERE idcotizacion=$idcotizacion  ");
            $pdf->Ln();
            $pdf->Cell(35,6,'A 2 CM DEL OMBLIGO',1,0);
            foreach ($query->result() as $row){
                $pdf->Cell(18,6,$row->cm2,1,0,'C');
            }
            $query=$this->db->query("SELECT cm4 FROM medida WHERE idcotizacion=$idcotizacion  ");
            $pdf->Ln();
            $pdf->Cell(35,6,'A 4 CM DEL OMBLIGO',1,0);
            foreach ($query->result() as $row){
                $pdf->Cell(18,6,$row->cm4,1,0,'C');
            }
            $query=$this->db->query("SELECT cadera FROM medida WHERE idcotizacion=$idcotizacion  ");
            $pdf->Ln();
            $pdf->Cell(35,6,'CADERA',1,0);
            foreach ($query->result() as $row){
                $pdf->Cell(18,6,$row->cadera,1,0,'C');
            }
            $query=$this->db->query("SELECT muslo FROM medida WHERE idcotizacion=$idcotizacion  ");
            $pdf->Ln();
            $pdf->Cell(35,6,'MUSLO D-1',1,0);
            foreach ($query->result() as $row){
                $pdf->Cell(18,6,$row->muslo,1,0,'C');
            }

        $query=$this->db->query("SELECT * FROM cotizacion WHERE idcotizacion='$idcotizacion'");
        $row=$query->row();
        $diagnostico=$row->diagnostico;
        $programa=$row->programa;
        $pdf->Ln(10);
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(30,6,'DIAGNOSTICOS:');
        $pdf->SetFont('Times','',10);
        $pdf->MultiCell(150,6,utf8_decode($diagnostico));
        $pdf->Ln(0);
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(30,6,'COTIZACIONES:');

        $pdf->SetFont('Times','',10);
        $query=$this->db->query("SELECT * FROM cotizaciontratamiento c
 INNER JOIN tratamiento t ON c.idtratamiento=t.idtratamiento
 WHERE c.idcotizacion='$idcotizacion'");
        $s=0;
        foreach ($query->result() as $row){
            $s++;
            $pdf->Ln();
            $pdf->Cell(5,3,utf8_decode($s));
            $pdf->Cell(45,3,utf8_decode($row->nombre));
            $pdf->Cell(20,3,utf8_decode("Session: ".$row->n));
            $pdf->Cell(45,3,utf8_decode("Tiempo: ".$row->tiempo));
        }
        $pdf->Ln();
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(30,6,'PROGRAMA DE TRATAMIENTO y % APROXIMADO DE MEJORIAS:');
        $pdf->Ln();
        $pdf->SetFont('Times','',10);
        $pdf->MultiCell(150,5,utf8_decode($programa));
        $pdf->Ln(3);
        $pdf->SetFont('Times','B',10);
        $pdf->Cell(200,6,'FIRMA Y SELLO DEL MEDICO TRATANTE',0,0,'R');


        $pdf->Output();
    }
    function imprimir2($idcotizacion="81",$idpaciente="13",$idhistorial="12"){
        $query=$this->db->query("SELECT * FROM cotizacion WHERE idcotizacion=$idcotizacion");
        $row=$query->row();
        $diagnostico=$row->diagnostico;
        $programa=$row->programa;
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
        $doctor=$row->doctor;
        $fecha=$row->fecha;
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

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setCellPaddings(0,0,0,0);
        // set font
        $pdf->SetFont('times', '', 14);
        // add a page
        $pdf->AddPage();
        // set JPEG quality
        $pdf->setJPEGQuality(75);
        $pdf->Image('assets/img/spa.jpg', 0, 0, 220, 22);
        $cumpleanos = new DateTime($fechanac);
        $hoy = new DateTime();
        $annos = $hoy->diff($cumpleanos);
        if ($examenmamario=="si"){
            $examenmamario=(" SI(X) NO()");
        }else if($examenmamario=="no"){
            $examenmamario=(" SI() NO(X)");
        }else{
            $examenmamario=(" SI() NO()");
        }
        if ($ptsimamaria=="si"){
            $ptsimamaria=(" SI(X) NO()");
        }else if($ptsimamaria=="no"){
            $ptsimamaria=(" SI() NO(X)");
        }else{
            $ptsimamaria=(" SI() NO()");
        }
        if ($cutis=="si"){
            $cutis=(" SI(X) NO()");
        }else if($cutis=="no"){
            $cutis=(" SI() NO(X)");
        }else{
            $cutis=(" SI() NO()");
        }
        if ($alopecia=="si"){
            $alopecia=(" SI(X) NO()");
        }else if($alopecia=="no"){
            $alopecia=(" SI() NO(X)");
        }else{
            $alopecia=(" SI() NO()");
        }
        $table='<table style="width: 650px;padding: 1px" border="1">';
        $query=$this->db->query("SELECT fecha FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table.'<tr><td style="font-size: 10px;width: 100px">FECHA DE MEDICION</td>';
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->fecha</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT papada FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>PAPADA</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->papada</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT brazosd1 FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>BRAZOS D-1</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->brazosd1</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT espaldaalta FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>ESPALDA ALTA</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->espaldaalta</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT espaldabaja FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>ESPALDA BAJA</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->espaldabaja</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT cintura FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>CINTURA</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->cintura</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT ombligo FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>OMBLIGO</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->ombligo</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT cm2 FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>A 2 CM DEL OMBLIGO</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->cm2</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT cm4 FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>A 4 CM DEL OMBLIGO</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->cm4</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT cadera FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>CADERA</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->cadera</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";
        $query=$this->db->query("SELECT muslo FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>MUSLO</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->muslo</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";


        $table=$table."</table>";


        $query=$this->db->query("SELECT * FROM cotizacion WHERE idcotizacion='$idcotizacion'");
        $row=$query->row();
        $diagnostico=$row->diagnostico;
        $programa=$row->programa;


        $query=$this->db->query("SELECT t.nombre,n,c.tiempo,c.costo FROM cotizaciontratamiento c
 INNER JOIN tratamiento t ON c.idtratamiento=t.idtratamiento
 WHERE c.idcotizacion='$idcotizacion'");
        $s=0;
        $t='';
        $to=0;
        foreach ($query->result() as $row){
            $s++;
            $t=$t."$s $row->nombre $row->n $row->tiempo <b>COSTO:</b> $row->costo<br>";
            if( $row->costo==""){
             $row->costo=0;
            }
            $to=$to+intval ($row->costo);
        }

//        $pdf->Ln();
//        $pdf->SetFont('Times','B',10);
//        $pdf->Cell(30,6,'PROGRAMA DE TRATAMIENTO y % APROXIMADO DE MEJORIAS:');
//        $pdf->Ln();
//        $pdf->SetFont('Times','',10);
//        $pdf->MultiCell(150,5,utf8_decode($programa));
//        $pdf->Ln(3);
//        $pdf->SetFont('Times','B',10);
//        $pdf->Cell(200,6,'FIRMA Y SELLO DEL MEDICO TRATANTE',0,0,'R');
        $html='<br><br><br><small align="center"><b>HISTORIAL CLINICO</b></small> <br>
        <small><b>FECHA: </b>'.$fecha.' <b>NOMBRE: </b>'.$apellidos.' '.$nombres.' <b>EDAD: </b>'.$annos->y.' <b>Direccion: </b>'.$direccion.'<br>
        <b>FECHA NAC: </b>'.$fechanac.' <b>TELEFONO: </b>'.$telefono.' <b>CELULAR: </b>'.$celular.'<br>
        <b><u>MOTIVO CONSULTA Y ENFERMEDAD ACTUAL</u></b><br>
        '.$consulta.'<br>
        <b><u>SIGNOS VITALES</u> PA:   </b>'.$pa.' <b>FC:   </b>'.$fc.' <b>PESO:   </b>'.$peso.' <b>TALLA:   </b>'.$talla.' <b>IMC:   </b>'.$imc.' <b>%GC:   </b>'.$gc.'<br> 
        <b><u>ANTECEDENTES FAMILIARES</u> DIABETES: </b>('.$diabetes.') <b>HTC:   </b>'.$hta.' <b>CARDIACOS:   </b>('.$cardios.') <b>CANCER:   </b>('.$cancer.') <b>QUE FAMILIA:   </b>'.$quefamilia.'<br>
        <b><u>ANTECEDENTES NO PATOLOGICOS</u> ESTADO CIVIL: </b>'.$estadocivil.' <b>OCUPACION:   </b>'.$ocupacion.' <b>FUMA:   </b>'.$fuma.' <br>
        <b>BEBE: </b>'.$bebe.' <b>ACTIVIDAD FISICA:   </b>'.$actividadfisica.' <b>HABITOS DE SUEÑO:   </b>'.$sueno.' <br>
        <b>HABITOS ALIMENTICIOS: </b>'.$alimentos.' <b>DIURESIS:   </b>'.$diuresis.' <b>CATARASIS:   </b>'.$catarsis.' <br>
        <b><u>ANTECEDENTES PATOLOGICOS</u></b><br>
        '.$patologico.'<br>
        <b>ALERGIAS: </b>'.$alergias.' <b>TRATAMIENTO RECIENTES:   </b>'.$tratamientos.' <b>ESTADO PSICOLOGICO:   </b>'.$estadopsicologico.' <br>
        <b><u>ANTECEDENTES GINECO OBSTETRICOS</u></b><br>
        <b>FUM: </b>'.$fum.' <b>DIAS:   </b>'.$dias.' <b>FRECUENCIA:   </b>'.$frecuencia.' <b>GESTAS:   </b>'.$gestas.' <b>PARTOS:   </b>'.$partos.' <b>AB:   </b>'.$ab.'<b>CESARIAS:   </b>'.$cesareas.' <br>
        <b>LACTANCIA: </b>'.$lactancia.' <b>Nº HIJOS:   </b>'.$nhijos.' <b>MENOPAUSIA:   </b>'.$menopausia.' <b>PAP:   </b>'.$pap.' <b>ANTICONCEPTIVOS:   </b>'.$anticonceptivos.' <br>
        <b>AUTO EXAMEN MAMARIO: </b>'.$examenmamario.' <b>PTOSIS MAMARIO:   </b>'.$ptsimamaria.' <br>
        <b><u>PIEL Y FANERAS</u>QUEMAS QUE ULITIZA: </b>'.$cremas.' <b>LIMPIEZA DE CUTIS:   </b>'.$cutis.' <b>DONDE:   </b>'.$donde.' <br>
        <b> QUE ULITIZARON: </b>'.$queutilizaron.' <b>ESTA EN EL SOL:   </b>'.$sol.' <b>PROTECION  SOLAR:   </b>'.$solar.' <b>OTROS TX ESTETICOS:   </b>'.$otros.' <br>
        <b><u>ALOPECIA</u></b>'.$alopecia.' <b>DEPILACION(Describa habitos depilatorios): </b> '.$depilacion.'<br>
        <b> TIPO DE PIEL: </b>'.$piel.' <br>
        <b> BIO TIPO DE PIEL: </b>'.$biotipo.' <b>TIPO Y LUGAR DE ARRUGAS:   </b>'.$arrugas.'<br>
        <b><u>MEDIDAS A REDUCIR</u></b> <br>
        '.$table.' <br>
        <b> DIAGNOSTICO: </b>'.$diagnostico.' <br>
        <b> COTIZACIONES: </b><br>
        '.$t.'
        <b>COSTO TOTAL='.$to.'</b><br>
        <b>PROGRAMA DE TRATAMIENTO y % APROXIMADO DE MEJORIAS:</b> <br>
        '.$programa.'
        <br>
        <div align="right">DR. '.$doctor.'</div>
        </small>';
        $pdf->writeHTML($html, true, false, true, false, '');
         $pdf->Output('example_002.pdf', 'I');

    }
    function solo($idcotizacion="81",$idpaciente="13",$idhistorial="12"){
        $query=$this->db->query("SELECT * FROM cotizacion WHERE idcotizacion=$idcotizacion");
        $row=$query->row();
        $diagnostico=$row->diagnostico;
        $programa=$row->programa;
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

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setCellPaddings(0,0,0,0);
        // set font
        $pdf->SetFont('times', '', 14);
        // add a page
        $pdf->AddPage();
        // set JPEG quality
        $pdf->setJPEGQuality(75);
        $pdf->Image('assets/img/spa.jpg', 0, 0, 220, 22);
        $cumpleanos = new DateTime($fechanac);
        $hoy = new DateTime();
        $annos = $hoy->diff($cumpleanos);
        if ($examenmamario=="si"){
            $examenmamario=(" SI(X) NO()");
        }else if($examenmamario=="no"){
            $examenmamario=(" SI() NO(X)");
        }else{
            $examenmamario=(" SI() NO()");
        }
        if ($ptsimamaria=="si"){
            $ptsimamaria=(" SI(X) NO()");
        }else if($ptsimamaria=="no"){
            $ptsimamaria=(" SI() NO(X)");
        }else{
            $ptsimamaria=(" SI() NO()");
        }
        if ($cutis=="si"){
            $cutis=(" SI(X) NO()");
        }else if($cutis=="no"){
            $cutis=(" SI() NO(X)");
        }else{
            $cutis=(" SI() NO()");
        }
        if ($alopecia=="si"){
            $alopecia=(" SI(X) NO()");
        }else if($alopecia=="no"){
            $alopecia=(" SI() NO(X)");
        }else{
            $alopecia=(" SI() NO()");
        }
        $table='<table style="width: 650px;padding: 1px" border="1">';
        $query=$this->db->query("SELECT fecha FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table.'<tr><td style="font-size: 10px;width: 100px">FECHA DE MEDICION</td>';
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->fecha</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT papada FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>PAPADA</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->papada</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT brazosd1 FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>BRAZOS D-1</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->brazosd1</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT espaldaalta FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>ESPALDA ALTA</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->espaldaalta</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT espaldabaja FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>ESPALDA BAJA</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->espaldabaja</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT cintura FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>CINTURA</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->cintura</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT ombligo FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>OMBLIGO</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->ombligo</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT cm2 FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>A 2 CM DEL OMBLIGO</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->cm2</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT cm4 FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>A 4 CM DEL OMBLIGO</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->cm4</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";

        $query=$this->db->query("SELECT cadera FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>CADERA</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->cadera</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";
        $query=$this->db->query("SELECT muslo FROM medida WHERE idcotizacion=$idcotizacion  ");
        $table=$table."<tr><td>MUSLO</td>";
        $n=$query->num_rows();
        $can=10-$n;
        foreach ($query->result() as $row){
            $table = $table . "<td>$row->muslo</td>";
        }
        for ($i=0;$i<$can;$i++){
            $table = $table . "<td></td>";
        }
        $table=$table."</tr>";


        $table=$table."</table>";


        $query=$this->db->query("SELECT * FROM cotizacion WHERE idcotizacion='$idcotizacion'");
        $row=$query->row();
        $diagnostico=$row->diagnostico;
        $programa=$row->programa;


        $query=$this->db->query("SELECT t.nombre,n,c.tiempo,c.costo FROM cotizaciontratamiento c
 INNER JOIN tratamiento t ON c.idtratamiento=t.idtratamiento
 WHERE c.idcotizacion='$idcotizacion'");
        $s=0;
        $t='';
        $to=0;
        foreach ($query->result() as $row){
            $s++;
            $t=$t."$s $row->nombre $row->n $row->tiempo <b>COSTO:</b> $row->costo<br>";
            $to=$to+$row->costo;
        }

//        $pdf->Ln();
//        $pdf->SetFont('Times','B',10);
//        $pdf->Cell(30,6,'PROGRAMA DE TRATAMIENTO y % APROXIMADO DE MEJORIAS:');
//        $pdf->Ln();
//        $pdf->SetFont('Times','',10);
//        $pdf->MultiCell(150,5,utf8_decode($programa));
//        $pdf->Ln(3);
//        $pdf->SetFont('Times','B',10);
//        $pdf->Cell(200,6,'FIRMA Y SELLO DEL MEDICO TRATANTE',0,0,'R');
        $html='<br><br><br><small align="center"><b>HISTORIAL CLINICO</b></small> <br>
        <small><b>FECHA: </b>'.date('Y-m-d').' <b>NOMBRE: </b>'.$apellidos.' '.$nombres.' <b>EDAD: </b>'.$annos->y.' <b>Direccion: </b>'.$direccion.'<br>
        <b>FECHA NAC: </b>'.$fechanac.' <b>TELEFONO: </b>'.$telefono.' <b>CELULAR: </b>'.$celular.'<br>
        <b><u>MOTIVO CONSULTA Y ENFERMEDAD ACTUAL</u></b><br>
        '.$consulta.'<br>
        <b><u>SIGNOS VITALES</u> PA:   </b>'.$pa.' <b>FC:   </b>'.$fc.' <b>PESO:   </b>'.$peso.' <b>TALLA:   </b>'.$talla.' <b>IMC:   </b>'.$imc.' <b>%GC:   </b>'.$gc.'<br> 
        <b><u>ANTECEDENTES FAMILIARES</u> DIABETES: </b>('.$diabetes.') <b>HTC:   </b>'.$hta.' <b>CARDIACOS:   </b>('.$cardios.') <b>CANCER:   </b>('.$cancer.') <b>QUE FAMILIA:   </b>'.$quefamilia.'<br>
        <b><u>ANTECEDENTES NO PATOLOGICOS</u> ESTADO CIVIL: </b>'.$estadocivil.' <b>OCUPACION:   </b>'.$ocupacion.' <b>FUMA:   </b>'.$fuma.' <br>
        <b>BEBE: </b>'.$bebe.' <b>ACTIVIDAD FISICA:   </b>'.$actividadfisica.' <b>HABITOS DE SUEÑO:   </b>'.$sueno.' <br>
        <b>HABITOS ALIMENTICIOS: </b>'.$alimentos.' <b>DIURESIS:   </b>'.$diuresis.' <b>CATARASIS:   </b>'.$catarsis.' <br>
        <b><u>ANTECEDENTES PATOLOGICOS</u></b><br>
        '.$patologico.'<br>
        <b>ALERGIAS: </b>'.$alergias.' <b>TRATAMIENTO RECIENTES:   </b>'.$tratamientos.' <b>ESTADO PSICOLOGICO:   </b>'.$estadopsicologico.' <br>
        <b><u>ANTECEDENTES GINECO OBSTETRICOS</u></b><br>
        <b>FUM: </b>'.$fum.' <b>DIAS:   </b>'.$dias.' <b>FRECUENCIA:   </b>'.$frecuencia.' <b>GESTAS:   </b>'.$gestas.' <b>PARTOS:   </b>'.$partos.' <b>AB:   </b>'.$ab.'<b>CESARIAS:   </b>'.$cesareas.' <br>
        <b>LACTANCIA: </b>'.$lactancia.' <b>Nº HIJOS:   </b>'.$nhijos.' <b>MENOPAUSIA:   </b>'.$menopausia.' <b>PAP:   </b>'.$pap.' <b>ANTICONCEPTIVOS:   </b>'.$anticonceptivos.' <br>
        <b>AUTO EXAMEN MAMARIO: </b>'.$examenmamario.' <b>PTOSIS MAMARIO:   </b>'.$ptsimamaria.' <br>
        <b><u>PIEL Y FANERAS</u>QUEMAS QUE ULITIZA: </b>'.$cremas.' <b>LIMPIEZA DE CUTIS:   </b>'.$cutis.' <b>DONDE:   </b>'.$donde.' <br>
        <b> QUE ULITIZARON: </b>'.$queutilizaron.' <b>ESTA EN EL SOL:   </b>'.$sol.' <b>PROTECION  SOLAR:   </b>'.$solar.' <b>OTROS TX ESTETICOS:   </b>'.$otros.' <br>
        <b><u>ALOPECIA</u></b>'.$alopecia.' <b>DEPILACION(Describa habitos depilatorios): </b> '.$depilacion.'<br>
        <b> TIPO DE PIEL: </b>'.$piel.' <br>
        <b> BIO TIPO DE PIEL: </b>'.$biotipo.' <b>TIPO Y LUGAR DE ARRUGAS:   </b>'.$arrugas.'<br>
        <b><u>MEDIDAS A REDUCIR</u></b> <br>
        '.$table.' <br>
        <b> DIAGNOSTICO: </b>'.$diagnostico.' <br>
        <b> COTIZACIONES: </b><br>
        '.$t.'
        <b>COSTO TOTAL='.$to.'</b><br>
        <b>PROGRAMA DE TRATAMIENTO y % APROXIMADO DE MEJORIAS:</b> <br>
        '.$programa.'
        <br>
        <div align="right">FIRMA Y SELLO DEL MEDICO TRATANTE</div>
        </small>';
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('example_002.pdf', 'I');

    }
}