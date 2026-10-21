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

        $this->Configuracion->logoPdf($pdf, 0, 4, 216, 22);

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
    // Informe diario en una sola hoja: si no entra, se reduce la letra hasta que entre
    public function printA($fecha=''){
        require_once('tcpdf.php');
        $t = strtotime($fecha ?: date('Y-m-d'));
        $fecha = date('Y-m-d', $t ?: time());
        $datos = $this->datosInforme($fecha);

        foreach (array(8, 7.5, 7, 6.5, 6, 5.5, 5) as $fs){
            $pdf = $this->informePdf($datos, $fs);
            if ($pdf->getNumPages() == 1) break;
        }
        $pdf->Output('informe-diario-'.$fecha.'.pdf', 'I');
    }

    private function datosInforme($fecha){
        $d = array('fecha' => $fecha, 'sm' => 0, 'st' => 0, 'secciones' => array(), 'egresos' => array(), 'totalEgresos' => 0);
        $turno = function ($f) { return substr($f, 11, 5) < '12:00' ? 'M' : 'T'; };
        $sumar = function ($f, $monto) use (&$d, $turno) {
            if ($turno($f) == 'M') $d['sm'] += $monto; else $d['st'] += $monto;
        };

        // Consultas médicas (montos sin tratamiento)
        $rows = $this->db->query("SELECT m.fecha, m.monto, p.nombres, p.apellidos, p.celular, p.referencia, h.consulta, u.nombre medico
            FROM montos m
            LEFT JOIN cotizacion c ON c.idcotizacion = m.idcotizacion
            LEFT JOIN historial h ON h.idhistorial = c.idhistorial
            LEFT JOIN paciente p ON p.idpaciente = h.idpaciente
            LEFT JOIN usuario u ON u.idusuario = m.idusuario
            WHERE DATE(m.fecha) = ? AND m.idtratamiento IS NULL ORDER BY m.fecha", array($fecha))->result();
        $filas = array();
        foreach ($rows as $r){
            $sumar($r->fecha, $r->monto);
            $filas[] = array($turno($r->fecha).' '.substr($r->fecha, 11, 5), trim($r->apellidos.' '.$r->nombres), $r->consulta, $r->referencia, $r->celular, $r->medico, $r->monto);
        }
        $d['secciones'][] = array('Consulta médica', '', array(
            array('Hora', 8), array('Paciente', 30), array('Cot / Sug TX', 17), array('Ref.', 10), array('Teléfono', 10), array('Médico', 15), array('Costo/Adel.', 10, 'R'),
        ), $filas);

        // Tratamientos faciales y corporales
        foreach (array('FACIAL' => array('Tratamientos faciales', 'IPL · MESO · PEELING · PRP · TOX · RELLENO · HILOS · MASC · ELECTRO · RF · INJERTOS'),
                       'CORPORAL' => array('Tratamientos corporales', 'UCV · VACCUM · RF · ELECTRO · LIPO · HIDRO · MESO · VIT C · CAPILAR · ARTICULAR · HILOS · MELA')) as $tipo => $info){
            $rows = $this->db->query("SELECT m.fecha, m.monto, m.obs, m.cub, p.nombres, p.apellidos, p.celular, t.nombre tratamiento, u.nombre medico
                FROM montos m
                INNER JOIN tratamiento t ON m.idtratamiento = t.idtratamiento
                INNER JOIN cotizacion c ON c.idcotizacion = m.idcotizacion
                INNER JOIN historial h ON h.idhistorial = c.idhistorial
                INNER JOIN paciente p ON p.idpaciente = h.idpaciente
                INNER JOIN usuario u ON u.idusuario = m.idusuario
                WHERE DATE(m.fecha) = ? AND t.tipo = ? ORDER BY m.fecha", array($fecha, $tipo))->result();
            $filas = array();
            foreach ($rows as $r){
                $sumar($r->fecha, $r->monto);
                $filas[] = array($turno($r->fecha).' '.substr($r->fecha, 11, 5), trim($r->nombres.' '.$r->apellidos), $r->tratamiento, $r->obs, $r->cub, $r->celular, $r->medico, $r->monto);
            }
            $d['secciones'][] = array($info[0], $info[1], array(
                array('Hora', 8), array('Paciente', 25), array('Tratamiento', 16), array('Obs / Res', 12), array('Cub/Ses', 7), array('Celular', 9), array('Médico', 13), array('Costo', 10, 'R'),
            ), $filas);
        }

        // Productos vendidos
        $rows = $this->db->query("SELECT f.fecha, p.nombres, p.apellidos, pr.nombre producto, d.cantidad, p.celular, d.subtotal, u.nombre vendedor
            FROM factura f
            INNER JOIN paciente p ON p.idpaciente = f.idpaciente
            INNER JOIN detallefactura d ON d.idfactura = f.idfactura
            INNER JOIN producto pr ON pr.idproducto = d.idproducto
            INNER JOIN usuario u ON u.idusuario = f.idusuario
            WHERE DATE(f.fecha) = ? ORDER BY f.fecha", array($fecha))->result();
        $filas = array();
        foreach ($rows as $r){
            $sumar($r->fecha, $r->subtotal);
            $filas[] = array($turno($r->fecha).' '.substr($r->fecha, 11, 5), trim($r->apellidos.' '.$r->nombres), $r->producto, $r->cantidad, $r->celular, $r->vendedor, $r->subtotal);
        }
        $d['secciones'][] = array('Productos vendidos', '', array(
            array('Hora', 8), array('Comprador', 28), array('Producto', 24), array('Cant.', 6, 'R'), array('Celular', 10), array('Vendedor', 14), array('Costo', 10, 'R'),
        ), $filas);

        // Adelantos (suman) y pagos de deuda (restan), igual que antes
        $rows = $this->db->query("SELECT d.fecha, d.comprador, d.detalle, d.celular, u.nombre, d.tipo, d.monto
            FROM deudas d INNER JOIN usuario u ON d.idusuario = u.idusuario
            WHERE DATE(d.fecha) = ? ORDER BY d.fecha", array($fecha))->result();
        $filas = array();
        foreach ($rows as $r){
            $signo = $r->tipo == 'ADELANTO' ? 1 : -1;
            $sumar($r->fecha, $signo * $r->monto);
            $filas[] = array($turno($r->fecha).' '.substr($r->fecha, 11, 5), $r->comprador, $r->detalle, $r->celular, $r->tipo == 'ADELANTO' ? 'Adelanto' : 'Pago deuda', $r->nombre, $signo * $r->monto);
        }
        $d['secciones'][] = array('Adelantos / pago de deudas', '', array(
            array('Hora', 8), array('Comprador', 26), array('Detalle', 22), array('Celular', 10), array('Tipo', 10), array('Vendedor', 14), array('Monto', 10, 'R'),
        ), $filas);

        // Egresos agrupados por tratamiento para que el informe entre en una hoja
        $rows = $this->db->query("SELECT t.nombre, COUNT(*) n, SUM(e.monto) monto FROM egreso e
            INNER JOIN usuario u ON u.idusuario = e.idusuario
            INNER JOIN tratamiento t ON t.idtratamiento = e.idtratamiento
            WHERE DATE(e.fecha) = ? GROUP BY t.nombre ORDER BY monto DESC, t.nombre", array($fecha))->result();
        foreach ($rows as $r){
            $d['egresos'][] = $r;
            $d['totalEgresos'] += $r->monto;
        }
        return $d;
    }

    private function informePdf($d, $fs){
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->SetTitle('Informe diario '.$d['fecha']);
        $pdf->AddPage();

        $slate = array(94, 118, 138);
        $sage = array(137, 188, 171);
        $esc = function ($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); };
        // php7.2-fpm del servidor no tiene mbstring: mayúsculas UTF-8 sin depender de él
        $may = function ($s) {
            if (function_exists('mb_strtoupper')) return mb_strtoupper($s, 'UTF-8');
            return strtr(strtoupper($s), array('á' => 'Á', 'é' => 'É', 'í' => 'Í', 'ó' => 'Ó', 'ú' => 'Ú', 'ñ' => 'Ñ', 'ü' => 'Ü'));
        };
        $bs = function ($n) {
            $n = (float)$n;
            return number_format($n, floor($n) == $n ? 0 : 2, ',', '.');
        };
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $meses = array('', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        $t = strtotime($d['fecha']);

        // Encabezado: logo + título + fecha del informe, con franja degradada
        $this->Configuracion->logoPdf($pdf, 10, 8, 44, 18);
        $pdf->SetTextColor($slate[0], $slate[1], $slate[2]);
        $pdf->SetFont('dejavusans', 'B', 15);
        $pdf->SetXY(60, 9);
        $pdf->Cell(140, 7, 'INFORME DIARIO', 0, 1, 'R');
        $pdf->SetFont('dejavusans', '', 9);
        $pdf->SetX(60);
        $pdf->SetTextColor(110, 125, 138);
        $pdf->Cell(140, 5, $dias[date('w', $t)].', '.date('j', $t).' de '.$meses[(int)date('n', $t)].' de '.date('Y', $t), 0, 1, 'R');
        $pdf->SetX(60);
        $pdf->SetFont('dejavusans', '', 6.5);
        $pdf->Cell(140, 4, 'Generado el '.date('d/m/Y H:i').(isset($_SESSION['nombre']) ? ' por '.$_SESSION['nombre'] : ''), 0, 1, 'R');
        $pdf->LinearGradient(10, 28, 190, 1.6, $slate, $sage, array(0, 0, 1, 0));

        // Tarjetas de resumen con degradado
        $kpis = array(
            array('Mañana', $d['sm']),
            array('Tarde', $d['st']),
            array('Total ingresos', $d['sm'] + $d['st']),
            array('Egresos', $d['totalEgresos']),
        );
        $kw = (190 - 3 * 3) / 4;
        foreach ($kpis as $i => $k){
            $x = 10 + $i * ($kw + 3);
            if ($i == 2){
                $pdf->LinearGradient($x, 32, $kw, 13, $slate, $sage, array(0, 0, 1, 1));
                $pdf->SetTextColor(255, 255, 255);
            }else{
                $pdf->RoundedRect($x, 32, $kw, 13, 2, '1111', 'F', array(), array(243, 246, 247));
                $pdf->SetTextColor($slate[0], $slate[1], $slate[2]);
            }
            $pdf->SetFont('dejavusans', '', 6.5);
            $pdf->SetXY($x + 3, 33.5);
            $pdf->Cell($kw - 6, 4, $may($k[0]), 0, 1, 'L');
            $pdf->SetFont('dejavusans', 'B', 12);
            $pdf->SetX($x + 3);
            $pdf->Cell($kw - 6, 6, 'Bs '.$bs($k[1]), 0, 1, 'L');
        }
        $pdf->SetTextColor(61, 75, 87);
        $pdf->SetY(48);

        // Secciones: sin grilla, filas cebra y subtotal. cellpadding de TCPDF va en mm
        $pad = round($fs * 0.09, 2);
        // Recorta el texto al ancho real de la columna (% de 190 mm), medido con la fuente,
        // para que cada fila ocupe una sola línea
        $corta = function ($s, $pct, $reserva = '') use ($fs, $pad, $pdf) {
            $s = trim(preg_replace('/\s+/', ' ', (string)$s));
            $ancho = $pct * 1.9 - 2 * $pad - 0.6 - ($reserva !== '' ? $pdf->GetStringWidth($reserva, 'dejavusans', '', $fs) : 0);
            if ($pdf->GetStringWidth($s, 'dejavusans', '', $fs) <= $ancho) return $s;
            while (preg_match('/^.{2}/us', $s) && $pdf->GetStringWidth($s.'…', 'dejavusans', '', $fs) > $ancho){
                $s = preg_replace('/.$/us', '', $s);
            }
            return rtrim($s).'…';
        };
        $html = '';
        foreach ($d['secciones'] as $s){
            list($titulo, $sub, $cols, $filas) = $s;
            $total = 0;
            foreach ($filas as $f) $total += end($f);

            $html .= '<table cellpadding="0" cellspacing="0" style="font-size:'.($fs + 1.5).'pt"><tr>'
                .'<td width="75%" style="color:#4a5f71;font-weight:bold">'.$esc($may($titulo))
                .' <span style="color:#89bcab;font-weight:normal;font-size:'.($fs - 0.5).'pt">'.count($filas).' reg.</span></td>'
                .'<td width="25%" align="right" style="color:#4a5f71;font-weight:bold">Bs '.$bs($total).'</td></tr></table>';
            if ($sub !== ''){
                $html .= '<div style="font-size:'.($fs - 1.5).'pt;color:#8a97a3">'.$esc($sub).'</div>';
            }
            $html .= '<table cellpadding="'.$pad.'" cellspacing="0" style="font-size:'.$fs.'pt;color:#3d4b57">';
            $html .= '<tr style="background-color:#5e768a;color:#ffffff;font-weight:bold">';
            foreach ($cols as $c){
                $html .= '<td width="'.$c[1].'%"'.(isset($c[2]) ? ' align="right"' : '').'>'.$esc($c[0]).'</td>';
            }
            $html .= '</tr>';
            if (!$filas){
                $html .= '<tr><td width="100%" style="color:#a3aeb8;font-style:italic">Sin movimientos</td></tr>';
            }
            foreach ($filas as $i => $f){
                $html .= '<tr style="background-color:'.($i % 2 ? '#f3f6f7' : '#ffffff').'">';
                foreach ($cols as $j => $c){
                    $v = $j == count($cols) - 1 ? $bs($f[$j]) : $esc($corta($f[$j], $c[1]));
                    $html .= '<td width="'.$c[1].'%"'.(isset($c[2]) ? ' align="right"' : '').'>'.$v.'</td>';
                }
                $html .= '</tr>';
            }
            $html .= '</table><div style="font-size:'.($fs * 0.6).'pt">&nbsp;</div>';
        }

        // Egresos (en dos columnas) y control de turnos
        $mitad = (int)ceil(count($d['egresos']) / 2);
        $eg = '';
        for ($i = 0; $i < $mitad; $i++){
            $eg .= '<tr style="background-color:'.($i % 2 ? '#f3f6f7' : '#ffffff').'">';
            foreach (array($i, $i + $mitad) as $k){
                if (isset($d['egresos'][$k])){
                    $e = $d['egresos'][$k];
                    $veces = $e->n > 1 ? ' ×'.$e->n : '';
                    $eg .= '<td width="36%">'.$esc($corta($e->nombre, 20.5, $veces)).($veces !== '' ? '<span style="color:#8a97a3">'.$veces.'</span>' : '').'</td>'
                        .'<td width="11%" align="right">'.$bs($e->monto).'</td><td width="3%"></td>';
                }else{
                    $eg .= '<td width="50%"></td>';
                }
            }
            $eg .= '</tr>';
        }
        if ($eg === '') $eg = '<tr><td width="100%" style="color:#a3aeb8;font-style:italic">Sin egresos</td></tr>';
        $linea = '<span style="color:#b8c4cc">______________</span>';
        $html .= '<table cellpadding="0" cellspacing="0"><tr>'
            .'<td width="58%"><table cellpadding="'.$pad.'" cellspacing="0" style="font-size:'.$fs.'pt">'
            .'<tr style="background-color:#89bcab;color:#ffffff;font-weight:bold"><td width="75%">EGRESOS</td><td width="25%" align="right">Bs '.$bs($d['totalEgresos']).'</td></tr>'
            .$eg.'</table></td>'
            .'<td width="4%"></td>'
            .'<td width="38%"><table cellpadding="'.($pad + 0.5).'" cellspacing="0" style="font-size:'.$fs.'pt">'
            .'<tr style="background-color:#5e768a;color:#ffffff;font-weight:bold"><td width="30%">TURNO</td><td width="35%">Ingreso</td><td width="35%">Salida</td></tr>'
            .'<tr><td width="30%"><b>Mañana</b></td><td width="35%">'.$linea.'</td><td width="35%">'.$linea.'</td></tr>'
            .'<tr style="background-color:#f3f6f7"><td width="30%"><b>Tarde</b></td><td width="35%">'.$linea.'</td><td width="35%">'.$linea.'</td></tr>'
            .'</table></td></tr></table>';

        $pdf->SetFont('dejavusans', '', $fs);
        $pdf->writeHTML($html, true, false, true, false, '');
        return $pdf;
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