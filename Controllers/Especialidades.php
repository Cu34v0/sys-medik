<?php

class Especialidades extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }

    public function listar()
    {
        $data = $this->model->getEspecialidades();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-primary" type="button" onclick="btnEditarEspecialidad(' . $data[$i]['idEspecialidad'] . ');"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button" onclick="btnEliminarEspecialidad(' . $data[$i]['idEspecialidad'] . ')"><i class="fas fa-trash-alt"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $especialidad = $_POST["especialidad"];
        $id = $_POST["id"];

        if (empty($especialidad)) {
            $msg = "Todos los campos son obligatorios";
        } else {
            if ($id == "") {
                $data = $this->model->registrarEspecialidad($especialidad);
                if ($data == "ok") {
                    $msg = "si";
                } else {
                    $msg = "Error al registrar la nueva especialidad";
                }
            } else {
                $data = $this->model->modificarEspecialidad($especialidad, $id);
                if ($data = "modificado") {
                    $msg = "modificado";
                } else {
                    $msg = "Error al modificar la especialidad";
                }
            }
        }
        // Respuesta de la operación
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
        $data = $this->model->editarEspecialidad($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
