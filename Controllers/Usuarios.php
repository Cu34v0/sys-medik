<?php
class Usuarios extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }

    public function index()
    {
        if (($_SESSION['activo']) && $_SESSION['tipoUsuario'] == 'Administrador') {
            $data['tipoUsuarios'] = $this->model->getTiposUsuarios();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location: ' . base_url);
        }
    }

    public function listar()
    {
        $data = $this->model->getUsuarios();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-primary" type="button" onclick="btnEditarUser(' . $data[$i]['idUsuario'] . ');"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button" onclick="btnEliminarUser(' . $data[$i]['idUsuario'] . ')"><i class="fas fa-trash-alt"></i></button>
            <button class="btn btn-warning" type="button" onclick="btnInformacionUser(' . $data[$i]['idUsuario'] . ');"><i class="fas fa-plus"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function validar()
    {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "Los campos están vacíos";
        } else {
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $data = $this->model->getUsuario($usuario, $hash);
            if ($data) {
                // Creo las variables de sesión para que sean persistentes
                $_SESSION['idUsuario'] = $data['idUsuario'];
                $_SESSION['nombreU'] = $data['nombreU'];
                $_SESSION['apePat'] = $data['apePat'];
                $_SESSION['apeMat'] = $data['apeMat'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['tipoUsuario'] = $data['tpNombre'];
                $_SESSION['fechaAlta'] = $data['fechaAlta'];

                // Inicio la sesión para indicar que el usuario se encuentra activo
                $_SESSION['activo'] = true;

                $msg = "ok";
            } else {
                $msg = "Usuario o contraseña incorrectas";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $nombre = $_POST['nombre'];
        $apePat = $_POST['apePat'];
        $apeMat = $_POST['apeMat'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $confirmar = $_POST['confirmar'];
        $tipoUsuario = $_POST['tipoUsuario'];
        $id = $_POST['id'];

        if (empty($nombre) || empty($apePat) || empty($apeMat) || empty($usuario)  || empty($tipoUsuario)) {
            $msg = "Todos los campos son obligatorios msg desde el backend";
        } else {
            if ($id == "") {
                if ($clave != $confirmar) {
                    $msg = "Las contraseñas no coinciden";
                } else {
                    $hash = hash("SHA256", $clave);
                    $data = $this->model->registrarUsuario($nombre, $apePat, $apeMat, $usuario, $hash, $tipoUsuario);
                    if ($data == "ok") {
                        $msg = "si";
                    } else if ($data == "existe") {
                        $msg = "El usuario ya existe";
                    } else {
                        $msg = "Error al registrar al nuevo usuario";
                    }
                }
            } else {
                // Si el $id contiene algo, se ejecutará la función de modificarUsuario()
                $data = $this->model->modificarUsuario($nombre, $apePat, $apeMat, $usuario, $tipoUsuario, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                } else {
                    $msg = "Error al modificar el usuario";
                }
            }
        }
        // Respuesta de la operación
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id)
    {
        $data = $this->model->eliminarUser($id);
        if ($data == 1) {
            $msg = "ok";
        } else {
            $msg = "Error al eliminar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function salir()
    {
        session_destroy();
        header('location: ' . base_url);
    }
}
