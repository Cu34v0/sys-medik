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

    public function editar(int $id)
    {
        $data = $this->model->editarInfoPaci($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $id = $_POST["idInfoPaci"];
        $fechaNacimiento = $_POST["fechaNacimiento"];
        $peso = $_POST["peso"];
        $tipoSangre = $_POST["tipoSangre"];

        if (empty($fechaNacimiento) || empty($peso) || empty($tipoSangre)) {
            $msg = "Todos los datos son obligatorios";
        } else {
            $data = $this->model->actualizarInfoPaci($fechaNacimiento, $peso, $tipoSangre, $id);
            if ($data == "modificado") {
                $msg = "modificado";
            } else {
                $msg = "Error al actualizar los datos";
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        }
    }
}
