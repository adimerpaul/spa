<?php
/**
 * Created by PhpStorm.
 * User: Adimer
 * Date: 31/01/2019
 * Time: 19:41
 */

class Reserva extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $data['title']='Reserva de pacientes';
        $data['css']="";
        //$this->load->view('templates/header',$data);
        $this->load->view('reserva');
        $data['tipo']="info";
        $data['msg']="Reservas de pacientes";
        $data['js']="";
        //$this->load->view('templates/footer',$data);
    }
    function insert()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $this->db->query("INSERT INTO `events` (
                    `title` ,
                    `start` ,
                    `end` ,
                    `uid` 
                    )
                    VALUES (
                    '".$_POST["title"]."',
                    '".date('Y-m-d H:i:s',strtotime($_POST["start"]))."',
                    '".date('Y-m-d H:i:s',strtotime($_POST["end"]))."',
                    '".$_SESSION['idusuario']."'
                    )");
        header('Content-Type: application/json');
        echo '{"id":"'.$this->db->insert_id().'"}';
        exit;
    }
    function reservas(){
        header('Content-Type: application/json');

        $query=$this->db->query("SELECT `id`, `start` ,`end` ,`title` FROM  events");
        foreach ($query->result() as $row){
            $events[] = $row;
        }
        //while($row = mysqli_fetch_assoc($result))
        /*{
            $events[] = $row;
        }
        */
        echo json_encode($events);
        exit;
    }
    function delete(){
        $id=$_POST['id'];
        $query=$this->db->query("DELETE FROM events WHERE id='$id'");
        if ($query){
            echo 1;
        }
        exit;
    }

}