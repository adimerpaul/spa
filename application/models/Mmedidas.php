<?php
/**
 * Created by PhpStorm.
 * User: Adimer
 * Date: 08/01/2019
 * Time: 21:21
 */

class Mmedidas extends CI_Model{
    function insert(){
        $idcotizacion=$_POST['idcotizacion'];
        $papada=$_POST['papada'];
        $brazosd1=$_POST['brazosd1'];
        $espaldaalta=$_POST['espaldaalta'];
        $espaldabaja=$_POST['espaldabaja'];
        $cintura=$_POST['cintura'];
        $ombligo=$_POST['ombligo'];
        $cm2=$_POST['cm2'];
        $cm4=$_POST['cm4'];
        $cadera=$_POST['cadera'];
        $muslo=$_POST['muslo'];
        $this->db->query("INSERT INTO medida(
papada,
brazosd1,
espaldaalta,
espaldabaja,
cintura,
ombligo,
cm2,
cm4,
cadera,
muslo,
idcotizacion
) VALUES (
'$papada',
'$brazosd1',
'$espaldaalta',
'$espaldabaja',
'$cintura',
'$ombligo',
'$cm2',
'$cm4',
'$cadera',
'$muslo',
'$idcotizacion'
)");
    }
}