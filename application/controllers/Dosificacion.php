<?php


class Dosificacion extends CI_Controller
{
    function index()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $data['title'] = 'Gestionar dosificacion';
        $data['css'] = "<link rel='stylesheet' href='" . base_url() . "assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='" . base_url() . "assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header', $data);
        $this->load->view('dosificacion');
        $data['tipo'] = "info";
        $data['msg'] = "Gestionar dosificacion";
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
    function update()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $desde = ($_POST['desde']);
        $hasta = $_POST['hasta'];
        $nrotramite = $_POST['nrotramite'];
        $nroautorizacion = $_POST['nroautorizacion'];
        $nrofacturai = $_POST['nrofactura'];
        $llave = $_POST['llave'];
        $leyenda = $_POST['leyenda'];
        $estado = $_POST['estado'];
        $iddosificacion = $_POST['iddosificacion'];

        $query = $this->db->query("UPDATE dosificacion SET 
        desde='$desde',
        hasta='$hasta',
        nrotramite='$nrotramite',
        nroautorizacion='$nroautorizacion',
        nrofacturai='$nrofacturai',
        llave='$llave',
        leyenda='$leyenda',
        estado='$estado'
        WHERE
        iddosificacion='$iddosificacion';
");
        header("Location: ".base_url().'Dosificacion');
    }
    function datos(){
        $idproducto=$_POST['idproducto'];
        $query=$this->db->query("SELECT * FROM Dosificacion WHERE iddosificacion='$idproducto'");
        echo json_encode( $query->result_array());
    }
    function delete($id){
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $query = $this->db->query("DELETE FROM dosificacion WHERE iddosificacion='$id'");
        header("Location: ".base_url().'Dosificacion');
    }
    function insert()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $desde = ($_POST['desde']);
        $hasta = $_POST['hasta'];
        $nrotramite = $_POST['nrotramite'];
        $nroautorizacion = $_POST['nroautorizacion'];
        $nrofacturai = $_POST['nrofactura'];
        $llave = $_POST['llave'];
        $leyenda = $_POST['leyenda'];
        $query = $this->db->query("INSERT INTO dosificacion(desde,hasta,nrotramite,nroautorizacion,nrofacturai,llave,leyenda) 
VALUES ('$desde','$hasta','$nrotramite','$nroautorizacion','$nrofacturai','$llave','$leyenda');");
        header("Location: ".base_url().'Dosificacion');
    }
}