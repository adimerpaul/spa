<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 8/4/2019
 * Time: 18:00
 */

class Export extends CI_Controller{
    function index()
    {
        $this->load->dbutil();

        $prefs = array(
            'format'      => 'zip',
            'filename'    => 'my_db_backup.sql'
        );


        $backup =& $this->dbutil->backup($prefs);

        $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        $save = 'pathtobkfolder/'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup);


        $this->load->helper('download');
        force_download($db_name, $backup);
    }

}