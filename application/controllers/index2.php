<?php
require('fpdf.php');
$pdf = new FPDF('P','mm','Letter');

class PDF extends FPDF
{
    /*
// Cabecera de página
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30,10,'Title',1,0,'C');
        // Salto de línea
        $this->Ln(20);
    }

// Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }*/
    function titulo($title,$a=0){
        $this->SetFont('Arial','B',10);
        $this->Cell( strlen($title)*2.4 +$a,5,utf8_decode($title),'B');
    }
    function subtitulo($title,$a=0){
        $this->SetFont('Arial','B',8);
        $this->Cell(strlen($title)*2.2+$a,5,utf8_decode($title));

    }
    function texto($title,$a=0){
        $this->SetFont('Arial','',8);
        $this->Cell( strlen($title)*2.1+$a ,5,utf8_decode($title));
    }
    function espacio(){
        $this->Ln();
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm','Letter');



$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,4,utf8_decode('HISTORIAL CLINICA'),0,0,'C');


$pdf->espacio();
$pdf->SetFont('Arial','B',8);
$pdf->Cell(11,5,utf8_decode('FECHA:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(15,5,utf8_decode('01/01/2018'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(14,5,utf8_decode('NOMBRE:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(50,5,utf8_decode('CHAMBI AJATA ADIMER PAUL NIÑO'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(9,5,utf8_decode('EDAD:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(5,5,utf8_decode('99'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(9,5,utf8_decode('ZONA:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(23,5,utf8_decode('ZONA CENTRAL'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(17,5,utf8_decode('DIRECCION:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,5,utf8_decode('calle bolivar y españa y precidente '));

$pdf->espacio();
$pdf->SetFont('Arial','B',8);
$pdf->Cell(18,5,utf8_decode('FECHA NAC:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(16,5,utf8_decode('01/01/2018'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(17,5,utf8_decode('TELEFONO:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(17,5,utf8_decode('69603027'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(15,5,utf8_decode('CELULAR:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(5,5,utf8_decode('52612499'));

$pdf->espacio();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(82,5,utf8_decode('MOTIVO CONSULTA Y ENFERMEDAD ACTUAL'),'B');
$pdf->espacio();
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,5,utf8_decode('Cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum. '));


$pdf->SetFont('Arial','B',10);
$pdf->Cell(32,5,utf8_decode('SIGNOS VITALES:'),'B');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(7,5,utf8_decode('PA:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(16,5,utf8_decode('01/2018'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(7,5,utf8_decode('FC:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(17,5,utf8_decode('1010'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(9,5,utf8_decode('PESO:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(12,5,utf8_decode('120.15'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,5,utf8_decode('TALLA:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,5,utf8_decode('100'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(7,5,utf8_decode('IMC:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,5,utf8_decode('1201'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(15,5,utf8_decode('%GC:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(5,5,utf8_decode('125'));

$pdf->espacio();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(55,5,utf8_decode('ANTECEDENTES FAMILIARES:'),'B');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(16,5,utf8_decode('DIABETES:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,5,utf8_decode('(X)'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(7,5,utf8_decode('HTA:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,5,utf8_decode('(X)'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(18,5,utf8_decode('CARDIACOS:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(12,5,utf8_decode('(X)'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(13,5,utf8_decode('CANCER:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,5,utf8_decode('(X)'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(20,5,utf8_decode('QUE FAMILIA:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,5,utf8_decode('TIA SEGUNDA'));

$pdf->espacio();
$pdf->titulo("ANTECEDENTES NO PATOLOGICOS:");
$pdf->subtitulo("ESTADO CIVIL:");
$pdf->texto("Soltera");
$pdf->subtitulo("OCUPACION:");
$pdf->texto("Cocinera ayduante");
$pdf->subtitulo("FUMA:");
$pdf->texto("de mes en cuanto");
$pdf->espacio();
$pdf->subtitulo("BEBE:");
$pdf->texto("NO tiene");
$pdf->subtitulo("ACTIVIDAD FISICA:");
$pdf->texto("Cocinera ayduante");
$pdf->subtitulo("HABITOS DE SUEÑO:");
$pdf->texto("de mes en cuanto");
$pdf->espacio();
$pdf->subtitulo("HABITOS ALIMENTICIOS:");
$pdf->texto("NO tiene");
$pdf->subtitulo("DIURESIS:");
$pdf->texto("Cocinera ayduante");
$pdf->subtitulo("CATARASIS:");
$pdf->texto("de mes en cuanto");

$pdf->espacio();
$pdf->titulo("ANTECEDENTES PATOLOGICOS:");
$pdf->espacio();
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,5,utf8_decode('Cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum. '));

$pdf->subtitulo("ALERGIAS:");
$pdf->texto("NO tiene");
$pdf->subtitulo("TRATAMIENTO RECIENTES:");
$pdf->texto("Cocinera ayduante");
$pdf->subtitulo("ESTADO PSICOLOGICO:");
$pdf->texto("de mes en cuanto");

$pdf->espacio();
$pdf->titulo("ANTECEDENTES GINECO OBSTETRICOS:");

$pdf->espacio();
$pdf->subtitulo("FUM:");
$pdf->texto("NO ");
$pdf->subtitulo("DIAS:");
$pdf->texto("10");
$pdf->subtitulo("FRECUENCIA:");
$pdf->texto("15 veces al dia");
$pdf->subtitulo("GESTAS:");
$pdf->texto("5");
$pdf->subtitulo("PARTOS:");
$pdf->texto("10");
$pdf->subtitulo("AB:");
$pdf->texto("15 ");
$pdf->subtitulo("Cesarias:");
$pdf->texto("1");

$pdf->espacio();
$pdf->subtitulo("LACTANCIA:");
$pdf->texto("NO ");
$pdf->subtitulo("Nº DE HIJOS:");
$pdf->texto("10");
$pdf->subtitulo("MENOPAUSIA:");
$pdf->texto("NO",3);
$pdf->subtitulo("PAP:");
$pdf->texto("NO",3);
$pdf->subtitulo("ANTICONCEPTIVOS :");
$pdf->texto("NO");

$pdf->espacio();
$pdf->subtitulo("AUTOEXAMEN MAMARIO:");
$pdf->texto("SI(X) NO(X)");
$pdf->subtitulo("PTOSIS MAMARIO");
$pdf->texto("SI(X) NO(X)");

$pdf->espacio();
$pdf->titulo("PIEL Y FANERAS:");
$pdf->subtitulo("CREMAS QUE UTILIZA:");
$pdf->texto(" ");
$pdf->subtitulo("LIMPIEZA DE CUTIS:");
$pdf->texto("SI(X) NO(X)");
$pdf->subtitulo("DONDE:");
$pdf->texto("Por ahi");

$pdf->espacio();
$pdf->subtitulo("QUE UTILIZARON:");
$pdf->texto("NIVELA ");
$pdf->subtitulo("ESTA EN EL SOL:");
$pdf->texto("NOP  ");
$pdf->subtitulo("PROTECCION SOLAR:");
$pdf->texto("SIasda  ");
$pdf->subtitulo("OTROS TX ESTETICOS:",-8);
$pdf->texto("asda,lgu ");

$pdf->espacio();
$pdf->titulo("ALOPECIA:");
$pdf->texto("SI() NO()");
$pdf->titulo("DEPILACION(Describa habitos depilatorios):",-22);
$pdf->texto( "adimer paul chambi ");

$pdf->espacio();
$pdf->subtitulo("TIPO DE PIEL:");
$pdf->texto(" TIPO I() TIPO II() TIPO III() TIPO IV() TIPO V() TIPO VI()");
$pdf->espacio();
$pdf->subtitulo("BIOTIPO DE LA PIEL:");
$pdf->texto(" MUY BUENA");
$pdf->subtitulo("ARRUGA LUGAR Y GRADO DEL I-II:");
$pdf->texto(" MUY BUENA");
/*
$pdf->SetFont('Arial','B',8);
$pdf->Cell(16,5,utf8_decode('ESTADO CIVIL:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,5,utf8_decode('(X)'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(7,5,utf8_decode('OCUPACION:'));
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,5,utf8_decode('(X)'));
$pdf->SetFont('Arial','B',8);
$pdf->Cell(18,5,utf8_decode('FUMA:'));
*/
$pdf->Output();
?>