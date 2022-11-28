<?php

class CambioPass extends Controller
{
    public function __construct()
    {
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

    public function changePass()
    {
    	$idUsuario = $_SESSION['idUsuario'];
    	$passActual = $_POST['passActual'];
    	$nuevoPass = $_POST['nuevaPass'];
    	$confirmar = $_POST['confirmar'];
    	$hash1 = hash("SHA256", $passActual);
    	$hash2 = hash("SHA256", $nuevoPass);
    	$hash3 = hash("SHA256", $confirmar);

    	if (empty($idUsuario) || empty($passActual) || empty($nuevoPass) || empty($confirmar)) {
    		$msg = "Todos los campos son obligatorios";
    	}else{
    		$data = $this->model->getUsuario($idUsuario, $hash1);
    		if ($data) {
    			if ($hash2 == $hash3) {
    				$data2 = $this->model->cambioContra($hash3, $idUsuario);
    				if ($data2 == "modificada") {
    					$msg = "actualizada";
    				}else{
    					$msg = "error";
    				}
    			}else{
    				$msg = "diferentes";
    			}
    		}else{
    			$msg = "no existe";
    		}
    	}

    	echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    	die();
    }

}
