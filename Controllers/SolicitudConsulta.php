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

    public function registrar()
    {
        $idUsuario = $_SESSION['idUsuario'];
        $fechaSolicitud = $_POST["fechaSolicitud"];
        $especialidad = $_POST["especialidad"];
        if (empty($fechaSolicitud) || empty($especialidad)) {
            $msg = "Todos los datos son obligatorios";
        } else {
            $data = $this->model->registrarCita($idUsuario, $fechaSolicitud, $especialidad);
            if ($data == "ok") {
                $msg = "si";
            } else {
                $msg = "Error al registrar al nuevo usuario";
            }
            
        }
         // Respuesta de la operación
         echo json_encode($msg, JSON_UNESCAPED_UNICODE);
         die();
    }
}
