<?php


class Photo extends CI_Controller
{
    function index($idpaciente){
        /*if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }*/
        $data['title']='Gestinar fotografias';

        $data['idpaciente']=$idpaciente;
        $data['css']="<link rel='stylesheet' href='".base_url()."assets/css/jquery.dataTables.min.css'>
        <link rel='stylesheet' href='".base_url()."assets/css/buttons.dataTables.min.css'>";
        $this->load->view('templates/header',$data);
        $this->load->view('photo');
        $data['tipo']="info";
        $data['msg']="Fotografias";
        $data['js']="
<script src='".base_url()."assets/js/jquery.dataTables.min.js'></script>
<script src='".base_url()."assets/js/dataTables.buttons.min.js'></script>
<script src='".base_url()."assets/js/buttons.flash.min.js'></script>
<script src='".base_url()."assets/js/jszip.min.js'></script>
<script src='".base_url()."assets/js/pdfmake.min.js'></script>
<script src='".base_url()."assets/js/vfs_fonts.js'></script>
<script src='".base_url()."assets/js/buttons.html5.min.js'></script>
<script src='".base_url()."assets/js/buttons.print.min.js'></script>
<script src='".base_url()."assets/js/paciente.js'></script>";
        $this->load->view('templates/footer',$data);
    }
    function insertfoto(){
        $idpaciente=$_POST['idpaciente'];

        //$idpaciente=$this->User->consulta('idpaciente','historial','idhistorial',$this->User->consulta('idhistorial','cotizacion','idcotizacion',$idcotizacion));
        $nombre=$this->User->consulta('nombres','paciente','idpaciente',$idpaciente).' '.$this->User->consulta('apellidos','paciente','idpaciente',$idpaciente);
        $this->db->query("INSERT INTO photo(idpaciente) VALUES('$idpaciente')");
        $idfoto=$this->db->insert_id();

        $mi_archivo = 'foto';
        $carpeta = 'assets/img/'.$idpaciente.' '.$nombre;
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }
        $config['upload_path'] = $carpeta;
        $config['file_name'] = $idfoto;
        $config['allowed_types'] = "*";

        $config['overwrite'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($mi_archivo)) {
            //*** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }

        $data['uploadSuccess'] = $this->upload->data();

        header("Location: ".base_url()."Photo/index/".$idpaciente);
    }
}