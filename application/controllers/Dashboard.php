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
        if (empty($_SESSION['tipo'])){
            header("Location: ".base_url());
            exit;
        }

        // Shell de la SPA (Vue + Quasar + Vue Router)
        $this->load->view('app');
    }

    function datos(){
        if (empty($_SESSION['tipo'])){
            http_response_code(401);
            exit;
        }

        $data['pacientes']=(int)$this->db->query("SELECT COUNT(*) c FROM paciente")->row()->c;
        $data['ingresosHoy']=(float)$this->db->query("SELECT COALESCE(SUM(monto),0) s FROM montos WHERE DATE(fecha)=CURDATE()")->row()->s;
        $data['ingresosMes']=(float)$this->db->query("SELECT COALESCE(SUM(monto),0) s FROM montos
            WHERE YEAR(fecha)=YEAR(CURDATE()) AND MONTH(fecha)=MONTH(CURDATE())")->row()->s;
        $data['atencionesHoy']=(int)$this->db->query("SELECT COUNT(DISTINCT idcotizacion) c FROM montos WHERE DATE(fecha)=CURDATE()")->row()->c;

        $data['reservasHoy']=$this->db->query("SELECT e.id, DATE_FORMAT(e.start,'%H:%i') hora, DATE_FORMAT(e.end,'%H:%i') fin,
            TRIM(e.title) paciente, e.descripcion, u.nombre usuario
            FROM events e LEFT JOIN usuario u ON u.idusuario=e.idusuario
            WHERE DATE(e.start)=CURDATE() ORDER BY e.start")->result();

        $data['cumpleanosHoy']=$this->db->query("SELECT idpaciente, CONCAT(nombres,' ',apellidos) nombre, celular,
            TIMESTAMPDIFF(YEAR,fechanac,CURDATE()) edad
            FROM paciente WHERE MONTH(fechanac)=MONTH(CURDATE()) AND DAY(fechanac)=DAY(CURDATE())
            ORDER BY nombres")->result();

        $data['ingresosDias']=$this->db->query("SELECT DATE_FORMAT(MIN(fecha),'%d/%m') dia, SUM(monto) total
            FROM montos WHERE fecha >= CURDATE() - INTERVAL 13 DAY
            GROUP BY DATE(fecha) ORDER BY MIN(fecha)")->result();

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
