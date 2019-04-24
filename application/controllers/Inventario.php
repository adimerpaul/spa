<?php

class Inventario extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Gestionar Reactivo';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('inventario');
        $data['tipo']="info";
        $data['msg']="Gestinar Reactivo";
        $data['js']="
<script src='".base_url()."assets/js/jquery.dataTables.min.js'></script>
<script src='".base_url()."assets/js/dataTables.buttons.min.js'></script>
<script src='".base_url()."assets/js/buttons.flash.min.js'></script>
<script src='".base_url()."assets/js/jszip.min.js'></script>
<script src='".base_url()."assets/js/pdfmake.min.js'></script>
<script src='".base_url()."assets/js/vfs_fonts.js'></script>
<script src='".base_url()."assets/js/buttons.html5.min.js'></script>
<script src='".base_url()."assets/js/buttons.print.min.js'></script>
<script src='".base_url()."assets/js/inventario.js'></script>";
        $this->load->view('templates/footer',$data);
    }
    function insert()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $nombre = ($_POST['nombre']);
        $cantidad = $_POST['cantidad'];
        $presentacion = $_POST['presentacion'];
        $query = $this->db->query("INSERT INTO reactivo(nombre,cantidad,presentacion) 
VALUES ('$nombre','$cantidad','$presentacion');");
        header("Location: ".base_url().'Inventario');
    }
    function datos(){
        $idreactivo=$_POST['idreactivo'];
        $query=$this->db->query("SELECT * FROM reactivo WHERE idreactivo='$idreactivo'");
        echo json_encode( $query->result_array());
    }
    function update()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $nombre = strtoupper($_POST['nombre']);
        $idreactivo=$_POST['idreactivo'];
        $cantidad = $_POST['cantidad'];
        $presentacion = $_POST['presentacion'];
        $query = $this->db->query("UPDATE reactivo SET 
        nombre='$nombre',
        cantidad='$cantidad',
        presentacion='$presentacion'
        WHERE
        idreactivo='$idreactivo';
");
        header("Location: ".base_url().'Inventario');
    }
    function delete($id){
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $query = $this->db->query("DELETE FROM reactivo WHERE idreactivo='$id'");
        header("Location: ".base_url().'Inventario');
    }
}