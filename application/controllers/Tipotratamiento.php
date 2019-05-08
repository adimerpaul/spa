<?php

class Tipotratamiento extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Gestionar Tipo Tratamientos';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('tipotratamiento');
        $data['tipo']="info";
        $data['msg']="Gestionar tipo tratamientos";
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
        $descripcion = strtoupper($_POST['descripcion']);
        $costo = strtoupper($_POST['costo']);
        $query = $this->db->query("INSERT INTO tipotratamiento(nombre,descripcion,costo) 
VALUES ('$nombre','$descripcion','$costo');");
        header("Location: ".base_url().'Tipotratamiento');
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

        $query = $this->db->query("DELETE FROM tipotratamiento WHERE idtipotratamiento='$id'");
        header("Location: ".base_url().'Tipotratamiento');
    }
}