<?php
/**
 * Created by PhpStorm.
 * User: Adimer
 * Date: 08/01/2019
 * Time: 21:32
 */

class Dashboard extends CI_Controller
{
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['css']="";
        $data['title']='Menu principal';
        $this->load->view('templates/header',$data);
        $this->load->view('dashboard');
        $data['tipo']="info";
        $data['msg']="Bienvenido al sistema";
        $data['js']="";
        $this->load->view('templates/footer',$data);
    }
}