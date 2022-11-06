<?php
class Usuarios extends Controller
{
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index()
    {
        if (empty($_SESSION['activo'])) {
            header('Location: '.base_url);
        }
        $this->views->getView($this, "index");
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

    public function salir()
    {
        session_destroy();
        header('location: ' . base_url);
    }
}
?>