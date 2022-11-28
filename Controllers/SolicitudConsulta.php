<?php

class SolicitudConsulta extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        if (empty($_SESSION["activo"])) {
            header('Location: ' . base_url);
        }
        $data["especialidades"] = $this->model->getEspecialidades();
        $this->views->getView($this, "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getSolicitudConsulta();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="btnCancelarCita(' . $data[$i]['idSolicitudConsulta'] . ')"><i class="fas fa-trash-alt"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
