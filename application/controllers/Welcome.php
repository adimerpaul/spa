<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function login(){
	    $email=$_POST['email'];
        $password=$_POST['password'];
        $query=$this->db->query("SELECT * FROM usuario WHERE email='$email' AND password='$password' AND estado='ACTIVO'");
        echo $query->num_rows();
        if($query->num_rows()==1){

            $row=$query->row();

            $_SESSION['email']=$row->email;
            $_SESSION['tipo']=$row->tipo;
            $_SESSION['idusuario']=$row->idusuario;
            $_SESSION['nombre']=$row->nombre;
            echo $_SESSION['nombre'];
            $this->db->query("INSERT INTO ingreso(idusuario) VALUES('$row->idusuario')");
            header("Location: ".base_url()."Dashboard");
        }else{
            $data['tipo']='error';
            $data['msg']='Error en nombre o contraseña';
            header("Location: ".base_url());
        }
    }
    function logout(){
        $idusuario=$_SESSION['idusuario'];
        $this->db->query("INSERT INTO ingreso(idusuario,tipo) VALUES('$idusuario','SALIDA')");
	    session_destroy();
	    header("Location: ".base_url());
    }
}
