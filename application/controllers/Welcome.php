<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function login(){
	    $email=$_POST['email'];
        $password=$_POST['password'];
        $query=$this->db->query("SELECT * FROM usuario WHERE email='$email' AND password='$password'");
        echo $query->num_rows();
        if($query->num_rows()==1){

            $row=$query->row();
            /*
            $_SESSION['email']=$row->email;
            $_SESSION['tipo']=$row->tipo;
            $_SESSION['idusuario']=$row->idusuario;
            $_SESSION['nombre']=$row->nombre; echo $_SESSION['nombre'];
            */
            $newdata = array(
                'tipo'  => 'johndoe',
                'email'     => 'johndoe@some-site.com',
                'nombre' => 'asd'
            );

            $this->session->set_userdata($newdata);
            header("Location: ".base_url()."Dashboard");
        }else{
            $data['tipo']='error';
            $data['msg']='Error en nombre o contraseña';
            header("Location: ".base_url());
        }
    }
    function logout(){
	    session_destroy();
	    header("Location: ".base_url());
    }
}
