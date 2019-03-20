<?php
/**
 * Created by PhpStorm.
 * User: Adimer
 * Date: 08/01/2019
 * Time: 21:21
 */

class User extends CI_Model{
    function consulta($mostrar,$tabla,$where,$dato){
        $query=$this->db->query("SELECT $mostrar FROM $tabla WHERE $where='$dato'");
        $row=$query->row();
        return $row->$mostrar;
    }
}