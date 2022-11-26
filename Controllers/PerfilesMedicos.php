<?php
class PerfilesMedicos extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }

    public function index()
    {
        if (($_SESSION['activo']) && $_SESSION['tipoUsuario'] == 'Administrador') {
            $data["turnos"] = $this->model->getTurnos();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location: ' . base_url);
        }
    }

    public function listar()
    {
        $data = $this->model->getPerfilesDoctores();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]["acciones"] = '<div>
            <button class="btn btn-primary" type="button" onclick="btnEditarInfoDoc(' . $data[$i]['idInfoDoc'] . ');"><i class="fas fa-edit"></i></button>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $id = $_POST["idInfoDoc"];
        $especialidad = $_POST["especialidad"];
        $cedulaProfesional = $_POST["cedulaProfesional"];
        $turno = $_POST["turno"];

        if (empty($especialidad) || empty($cedulaProfesional) || empty($turno)) {
            $msg = "Todos los datos son obligatorios";
        } else {
            $data = $this->model->actualizarInfoMedic($especialidad, $cedulaProfesional, $turno, $id);
            if ($data == "modificado") {
                $msg = "modificado";
            } else {
                $msg = "Error al actualizar los datos";
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            

        }
        
    }

    public function editar(int $id)
    {
        $data = $this->model->editarInfoDoc($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    
}
