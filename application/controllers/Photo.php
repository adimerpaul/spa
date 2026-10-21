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

    // ---- API JSON para la interfaz Vue ----
    const MAX_LADO = 1600;      // px del lado más largo
    const CALIDAD_WEBP = 75;
    const CALIDAD_JPG = 80;     // si el servidor no tiene WebP

    private function json($data, $status = 200){
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    private function requiereSesion(){
        if (empty($_SESSION['tipo'])){
            $this->json(array('error' => 'Sesión expirada'), 401);
        }
    }
    private function paciente($idpaciente){
        $p = $this->db->query("SELECT idpaciente, nombres, apellidos, ci, celular,
            TIMESTAMPDIFF(YEAR, fechanac, CURDATE()) edad FROM paciente WHERE idpaciente = ?", array((int)$idpaciente))->row();
        if (!$p) $this->json(array('error' => 'Paciente no encontrado'), 404);
        return $p;
    }
    // Misma carpeta que usa el módulo antiguo: assets/img/<id> <nombres> <apellidos>
    private function carpeta($p){
        return 'assets/img/'.$p->idpaciente.' '.$p->nombres.' '.$p->apellidos;
    }
    private function archivoFoto($carpeta, $idphoto){
        $f = glob(FCPATH.$carpeta.'/'.$idphoto.'.*');
        return $f ? basename($f[0]) : null;
    }

    function datos($idpaciente){
        $this->requiereSesion();
        $p = $this->paciente($idpaciente);
        $carpeta = $this->carpeta($p);
        $fotos = array();
        $rows = $this->db->query("SELECT idphoto, DATE_FORMAT(fecha,'%d/%m/%Y %H:%i') fecha FROM photo
            WHERE idpaciente = ? ORDER BY idphoto DESC", array($p->idpaciente))->result();
        foreach ($rows as $r){
            $archivo = $this->archivoFoto($carpeta, $r->idphoto);
            $fotos[] = array(
                'idphoto' => (int)$r->idphoto,
                'fecha' => $r->fecha,
                'url' => $archivo ? base_url().str_replace('%2F', '/', rawurlencode($carpeta.'/'.$archivo)) : null,
            );
        }
        $this->json(array('paciente' => $p, 'fotos' => $fotos));
    }

    function subir(){
        $this->requiereSesion();
        @ini_set('memory_limit', '512M');   // decodificar fotos de celular de 12+ MP
        $p = $this->paciente($this->input->post('idpaciente'));
        if (empty($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK){
            $this->json(array('error' => 'No llegó la imagen (¿muy pesada?)'), 422);
        }

        $img = $this->cargarImagen($_FILES['foto']['tmp_name']);
        if (!$img){
            $this->json(array('error' => 'El archivo no es una imagen válida'), 422);
        }
        $img = $this->redimensionar($img, self::MAX_LADO);

        $carpeta = $this->carpeta($p);
        if (!is_dir(FCPATH.$carpeta)) mkdir(FCPATH.$carpeta, 0777, true);

        $this->db->insert('photo', array('idpaciente' => $p->idpaciente));
        $idphoto = $this->db->insert_id();
        if (function_exists('imagewebp')){
            $destino = FCPATH.$carpeta.'/'.$idphoto.'.webp';
            $ok = imagewebp($img, $destino, self::CALIDAD_WEBP);
        }else{
            $destino = FCPATH.$carpeta.'/'.$idphoto.'.jpg';
            $ok = imagejpeg($img, $destino, self::CALIDAD_JPG);
        }
        imagedestroy($img);
        if (!$ok){
            $this->db->delete('photo', array('idphoto' => $idphoto));
            $this->json(array('error' => 'No se pudo guardar la imagen'), 500);
        }

        $this->json(array(
            'idphoto' => (int)$idphoto,
            'original' => (int)$_FILES['foto']['size'],
            'comprimido' => filesize($destino),
        ));
    }

    function eliminar(){
        $this->requiereSesion();
        $id = (int)$this->input->post('idphoto');
        // El archivo se queda en el disco para poder restaurar desde la papelera
        $r = $this->Papelera->eliminar('photo', array('idphoto' => $id), 'Fotografía #'.$id.' del paciente #'.(int)$this->input->post('idpaciente'));
        if ($r !== true) $this->json(array('error' => $r), 422);
        $this->json(array('ok' => true));
    }

    private function cargarImagen($ruta){
        $info = @getimagesize($ruta);
        if (!$info) return null;
        switch ($info[2]){
            case IMAGETYPE_JPEG: $img = @imagecreatefromjpeg($ruta); break;
            case IMAGETYPE_PNG:  $img = @imagecreatefrompng($ruta); break;
            case IMAGETYPE_WEBP: $img = function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($ruta) : null; break;
            case IMAGETYPE_GIF:  $img = @imagecreatefromgif($ruta); break;
            case IMAGETYPE_BMP:  $img = function_exists('imagecreatefrombmp') ? @imagecreatefrombmp($ruta) : null; break;
            default: $img = null;
        }
        if (!$img) return null;
        if (!imageistruecolor($img)){
            imagepalettetotruecolor($img);
        }
        // Las fotos de celular vienen giradas según la orientación EXIF
        if ($info[2] == IMAGETYPE_JPEG && function_exists('exif_read_data')){
            $exif = @exif_read_data($ruta);
            $o = isset($exif['Orientation']) ? (int)$exif['Orientation'] : 1;
            $giros = array(3 => 180, 6 => -90, 8 => 90);
            if (isset($giros[$o])){
                $rot = imagerotate($img, $giros[$o], 0);
                imagedestroy($img);
                $img = $rot;
            }
        }
        return $img;
    }

    private function redimensionar($img, $max){
        $w = imagesx($img);
        $h = imagesy($img);
        if (max($w, $h) <= $max) return $img;
        $k = $max / max($w, $h);
        $nw = (int)round($w * $k);
        $nh = (int)round($h * $k);
        $nueva = imagecreatetruecolor($nw, $nh);
        imagealphablending($nueva, false);
        imagesavealpha($nueva, true);
        imagecopyresampled($nueva, $img, 0, 0, 0, 0, $nw, $nh, $w, $h);
        imagedestroy($img);
        return $nueva;
    }
}