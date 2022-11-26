<?php
class PerfilesPacientes extends Controller
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

    public function listar()
    {
        $data = $this->model->getPerfilesPacientes();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]["acciones"] = '<div>
            <button class="btn btn-primary" type="button" onclick="btnEditarInfoPaci(' . $data[$i]['idInfoPaci'] . ');"><i class="fas fa-edit"></i></button>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    
}
