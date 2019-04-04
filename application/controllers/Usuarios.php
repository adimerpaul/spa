<?php

class Usuarios extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Gestionar usuarios';
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('usuarios');
        $data['tipo']="info";
        $data['msg']="Bienvenidos a gestinar usuarios";
        $data['js']="
<script src='".base_url()."assets/js/jquery.dataTables.min.js'></script>
<script src='".base_url()."assets/js/dataTables.buttons.min.js'></script>
<script src='".base_url()."assets/js/buttons.flash.min.js'></script>
<script src='".base_url()."assets/js/jszip.min.js'></script>
<script src='".base_url()."assets/js/pdfmake.min.js'></script>
<script src='".base_url()."assets/js/vfs_fonts.js'></script>
<script src='".base_url()."assets/js/buttons.html5.min.js'></script>
<script src='".base_url()."assets/js/buttons.print.min.js'></script>
<script src='".base_url()."assets/js/usuario.js'></script>";
        $this->load->view('templates/footer',$data);
    }
    function insert()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $nombre = strtoupper($_POST['nombre']);
        $email = $_POST['email'];
        $tipo = $_POST['tipo'];
        $password = $_POST['password'];
        $query = $this->db->query("INSERT INTO usuario(nombre,email,tipo,password) 
VALUES ('$nombre','$email','$tipo','$password');");
        header("Location: ".base_url().'Usuarios');
    }
    function datos(){
        $idusuario=$_POST['idusuario'];
        $query=$this->db->query("SELECT * FROM usuario WHERE idusuario='$idusuario'");

        echo json_encode( $query->result_array());
    }
    function update()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $nombre = strtoupper($_POST['nombre']);
        $email = $_POST['email'];
        $idusuario=$_POST['idusuario'];
        $tipo = $_POST['tipo'];
        $password = $_POST['password'];
        $estado = $_POST['estado'];
        $query = $this->db->query("UPDATE usuario SET 
        nombre='$nombre',
        email='$email',
        tipo='$tipo',
        password='$password',
        estado='$estado'
        WHERE
        idusuario='$idusuario';
");
        header("Location: ".base_url().'Usuarios');
    }
    function delete($id){
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }

        $query = $this->db->query("DELETE FROM usuario WHERE idusuario='$id'");
        header("Location: ".base_url().'Usuarios');
    }
}