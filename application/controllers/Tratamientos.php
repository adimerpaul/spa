<?php

class Tratamientos extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Gestionar Tratamientos';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('tratamientos');
        $data['tipo']="info";
        $data['msg']="Gestinar tratamientos";
        $data['js']="
<script src='".base_url()."assets/js/jquery.dataTables.min.js'></script>
<script src='".base_url()."assets/js/dataTables.buttons.min.js'></script>
<script src='".base_url()."assets/js/buttons.flash.min.js'></script>
<script src='".base_url()."assets/js/jszip.min.js'></script>
<script src='".base_url()."assets/js/pdfmake.min.js'></script>
<script src='".base_url()."assets/js/vfs_fonts.js'></script>
<script src='".base_url()."assets/js/buttons.html5.min.js'></script>
<script src='".base_url()."assets/js/buttons.print.min.js'></script>
<script src='".base_url()."assets/js/tratamiento.js'></script>";
        $this->load->view('templates/footer',$data);
    }
    function insert()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $nombre = strtoupper($_POST['nombre']);
        $caracteristica = strtoupper($_POST['caracteristica']);
        $sesiones = strtoupper($_POST['sesiones']);
        $costo = strtoupper($_POST['costo']);
        $tipo = $_POST['tipo'];
        $idtipotratamiento = $_POST['idtipotratamiento'];
        $tiempo = $_POST['tiempo'];
        $query = $this->db->query("INSERT INTO tratamiento(nombre,idtipotratamiento,caracteristica,sesiones,costo,tiempo,tipo) 
VALUES ('$nombre','$idtipotratamiento','$caracteristica','$sesiones','$costo','$tiempo','$tipo');");
        header("Location: ".base_url().'Tratamientos');
    }
    function datos(){
        $idtratamiento=$_POST['idtratamiento'];
        $query=$this->db->query("SELECT * FROM tratamiento WHERE idtratamiento='$idtratamiento'");
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
        $reposicion = $_POST['reposicion'];
        $tiempo = $_POST['tiempo'];
        $idtipotratamiento = $_POST['idtipotratamiento'];
        $caracteristica = $_POST['caracteristica'];
        $sesiones = $_POST['sesiones'];
        $costo = $_POST['costo'];
        $query = $this->db->query("UPDATE tratamiento SET 
        nombre='$nombre',
        idtipotratamiento='$tipo',
        caracteristica='$caracteristica',
        sesiones='$sesiones',
        costo='$costo',
        tiempo='$tiempo',
        idtipotratamiento='$idtipotratamiento',
        tipo='$tipo',
        reposicion='$reposicion'
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
    function reactivos($idtratamiento){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Gestionar reactivos';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $data['idtratamiento']=$idtratamiento;
        $this->load->view('templates/header',$data);
        $this->load->view('tratamientoreactivo');
        $data['tipo']="info";

        $data['msg']="Gestinar reactivos";
        $data['js']="
<script src='".base_url()."assets/js/jquery.dataTables.min.js'></script>
<script src='".base_url()."assets/js/dataTables.buttons.min.js'></script>
<script src='".base_url()."assets/js/buttons.flash.min.js'></script>
<script src='".base_url()."assets/js/jszip.min.js'></script>
<script src='".base_url()."assets/js/pdfmake.min.js'></script>
<script src='".base_url()."assets/js/vfs_fonts.js'></script>
<script src='".base_url()."assets/js/buttons.html5.min.js'></script>
<script src='".base_url()."assets/js/buttons.print.min.js'></script>
<script src='".base_url()."assets/js/tratamiento.js'></script>";
        $this->load->view('templates/footer',$data);
    }
    function insertreactivo(){
        $idtratamiento=$_POST['idtratamiento'];
        $idreactivo=$_POST['idreactivo'];
        $cantidad=$_POST['cantidad'];
        $this->db->query("INSERT INTO tratamientoreactivo VALUES('$idtratamiento','$idreactivo','$cantidad')");
        header("Location: ".base_url()."Tratamientos/reactivos/$idtratamiento");
    }
    function eliminarreactivo($idtratamiento,$idreactivo){
        $this->db->query("DELETE FROM tratamientoreactivo WHERE idtratamiento='$idtratamiento' AND idreactivo='$idreactivo'");
        header("Location: ".base_url()."Tratamientos/reactivos/$idtratamiento");
    }
}