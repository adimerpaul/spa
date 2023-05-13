<?php

class Filtros extends CI_Controller {

    function index(){
        if ($_SESSION['nombre']=="" ){
            header("Location: ".base_url());
        }
        $data['title']='Filtros';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>
        <link rel='stylesheet' href='https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css'>
        ";

        $this->load->view('templates/header',$data);
        $this->load->view('filtros');
        $data['tipo']="info";
        $data['msg']="Filtros reportes";
        $data['js']="
        <script src='https://code.highcharts.com/highcharts.js'></script>
<script src='https://code.highcharts.com/modules/exporting.js'></script>
<script src='https://code.highcharts.com/modules/export-data.js'></script>
<script src='https://code.highcharts.com/modules/accessibility.js'></script>
<script src='https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js'></script>
<script src='https://momentjs.com/downloads/moment-with-locales.min.js'></script>
<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script>
<script src='https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js'></script>
";
        $this->load->view('templates/footer',$data);
    }
    function datos($d1,$d2){
        $query=$this->db->query("SELECT  YEAR(CURDATE())-YEAR( p.fechanac) as name,count(*) as y
FROM montos m
INNER JOIN cotizacion c ON m.idcotizacion=c.idcotizacion
INNER JOIN historial h ON h.idhistorial=c.idhistorial
INNER JOIN paciente p ON p.idpaciente=h.idpaciente
WHERE DATE(m.fecha)>=DATE('$d1') AND DATE(m.fecha)<=DATE('$d2')
AND p.fechanac!=''
GROUP BY  YEAR(CURDATE())-YEAR( p.fechanac)");
//        exit;
        echo json_encode($query->result_array());
    }
    function dedad($d1,$d2){

        $query=$this->db->query("SELECT  p.nombres,p.apellidos, YEAR(CURDATE())-YEAR(p.fechanac) edad,m.fecha
FROM montos m
INNER JOIN cotizacion c ON m.idcotizacion=c.idcotizacion
INNER JOIN historial h ON h.idhistorial=c.idhistorial
INNER JOIN paciente p ON p.idpaciente=h.idpaciente
WHERE DATE(m.fecha)>=DATE('$d1') AND DATE(m.fecha)<=DATE('$d2')");

        echo json_encode($query->result_array());
    }
    function tratamientos($d1,$d2){
        $query=$this->db->query("SELECT t.nombre  as name,count(*) as y
FROM montos m
INNER JOIN cotizacion c ON m.idcotizacion=c.idcotizacion
INNER JOIN historial h ON h.idhistorial=c.idhistorial
INNER JOIN paciente p ON p.idpaciente=h.idpaciente
INNER JOIN tratamiento t ON m.idtratamiento=t.idtratamiento
WHERE DATE(m.fecha)>=DATE('$d1') AND DATE(m.fecha)<=DATE('$d2')
AND t.nombre!=''
GROUP BY  t.nombre");
        echo json_encode($query->result_array());
    }
    function dtratamientos($d1,$d2){
        $query=$this->db->query("SELECT t.nombre,p.nombres,p.apellidos,m.fecha
FROM montos m
INNER JOIN cotizacion c ON m.idcotizacion=c.idcotizacion
INNER JOIN historial h ON h.idhistorial=c.idhistorial
INNER JOIN paciente p ON p.idpaciente=h.idpaciente
INNER JOIN tratamiento t ON m.idtratamiento=t.idtratamiento
WHERE DATE(m.fecha)>=DATE('$d1') AND DATE(m.fecha)<=DATE('$d2')");
        echo json_encode($query->result_array());
    }
    function zonas($d1,$d2){
        $query=$this->db->query("SELECT p.zona  as name,count(*) as y
FROM montos m
INNER JOIN cotizacion c ON m.idcotizacion=c.idcotizacion
INNER JOIN historial h ON h.idhistorial=c.idhistorial
INNER JOIN paciente p ON p.idpaciente=h.idpaciente
INNER JOIN tratamiento t ON m.idtratamiento=t.idtratamiento
WHERE DATE(m.fecha)>=DATE('$d1') AND DATE(m.fecha)<=DATE('$d2')
AND p.zona!=''
GROUP BY  p.zona");
        echo json_encode($query->result_array());
    }
    function dzonas($d1,$d2){
        $query=$this->db->query("SELECT p.zona,p.nombres,p.apellidos,m.fecha
FROM montos m
INNER JOIN cotizacion c ON m.idcotizacion=c.idcotizacion
INNER JOIN historial h ON h.idhistorial=c.idhistorial
INNER JOIN paciente p ON p.idpaciente=h.idpaciente
INNER JOIN tratamiento t ON m.idtratamiento=t.idtratamiento
WHERE DATE(m.fecha)>=DATE('$d1') AND DATE(m.fecha)<=DATE('$d2')");
        echo json_encode($query->result_array());
    }
}