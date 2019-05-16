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
        $nombre = strtoupper($_POST['nombre']);
        $idtipotratamiento = strtoupper($_POST['idtipotratamiento']);
        $descripcion = strtoupper($_POST['descripcion']);
        $costo = strtoupper($_POST['costo']);
        $query = $this->db->query("UPDATE tipotratamiento SET
nombre='$nombre',
descripcion='$descripcion',
costo='$costo') 
WHERE idtipotratamiento='$idtipotratamiento';");
        header("Location: ".base_url().'Tipotratamiento');
    }
    function delete($id){
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }

        $query = $this->db->query("DELETE FROM tipotratamiento WHERE idtipotratamiento='$id'");
        header("Location: ".base_url().'Tipotratamiento');
    }
}