<?php
// Ajustes del sistema (por ahora: el logo que sale en el login, el menú y los PDF)
class Ajustes extends CI_Controller{
    private function json($data, $status = 200){
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_INVALID_UTF8_SUBSTITUTE);
        exit;
    }
    private function requiereAdmin(){
        if (empty($_SESSION['tipo'])){
            $this->json(array('error' => 'Sesión expirada'), 401);
        }
        if ($_SESSION['tipo'] != 'ADMIN'){
            $this->json(array('error' => 'Solo el administrador puede cambiar los ajustes'), 403);
        }
    }
    private function datosLogo(){
        return array(
            'logo' => $this->Configuracion->logoUrl(),
            'porDefecto' => $this->Configuracion->logo() === Configuracion::LOGO_DEFECTO,
        );
    }

    function datos(){
        $this->requiereAdmin();
        $this->json($this->datosLogo());
    }

    function logo(){
        $this->requiereAdmin();
        $r = $this->Configuracion->subirLogo(isset($_FILES['logo']) ? $_FILES['logo'] : null);
        if ($r !== true) $this->json(array('error' => $r), 422);
        $this->json($this->datosLogo());
    }

    function restablecer(){
        $this->requiereAdmin();
        $this->Configuracion->restablecerLogo();
        $this->json($this->datosLogo());
    }
}
