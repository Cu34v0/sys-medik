<?php
class PerfilesAdministradores extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }

    public function index()
    {
        if (($_SESSION['activo']) && $_SESSION['tipoUsuario'] == 'Administrador') {
            $this->views->getView($this, "index");
        } else {
            header('Location: ' . base_url);
        }
    }

    
}
