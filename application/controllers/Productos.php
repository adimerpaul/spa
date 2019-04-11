<?php

class Productos extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Gestionar productos';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('productos');
        $data['tipo']="info";
        $data['msg']="Gestionar productos";
        $data['js']="
<script src='".base_url()."assets/js/jquery.dataTables.min.js'></script>
<script src='".base_url()."assets/js/dataTables.buttons.min.js'></script>
<script src='".base_url()."assets/js/buttons.flash.min.js'></script>
<script src='".base_url()."assets/js/jszip.min.js'></script>
<script src='".base_url()."assets/js/pdfmake.min.js'></script>
<script src='".base_url()."assets/js/vfs_fonts.js'></script>
<script src='".base_url()."assets/js/buttons.html5.min.js'></script>
<script src='".base_url()."assets/js/buttons.print.min.js'></script>
<script src='".base_url()."assets/js/productos.js'></script>";
        $this->load->view('templates/footer',$data);
    }
    function insert()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $nombre = strtoupper($_POST['nombre']);
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $query = $this->db->query("INSERT INTO producto(nombre,precio,stock) 
VALUES ('$nombre','$precio','$stock');");
        header("Location: ".base_url().'Productos');
    }
    function datos(){
        $idproducto=$_POST['idproducto'];
        $query=$this->db->query("SELECT * FROM producto WHERE idproducto='$idproducto'");
        echo json_encode( $query->result_array());
    }
    function update()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $nombre = strtoupper($_POST['nombre']);
        $idproducto=$_POST['idproducto'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $query = $this->db->query("UPDATE producto SET 
        nombre='$nombre',
        precio='$precio',
        stock='$stock'
        WHERE
        idproducto='$idproducto';
");
        header("Location: ".base_url().'Productos');
    }
    function delete($id){
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }

        $query = $this->db->query("DELETE FROM producto WHERE idproducto='$id'");
        header("Location: ".base_url().'Productos');
    }
}