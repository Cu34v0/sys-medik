<?php
class UsuariosModel extends Query
{
    private $nombre, $apePat, $apeMat, $usuario, $clave, $tipoUsuario;
    public function __construct()
    {
        parent::__construct();
    }

    public function getTiposUsuarios()
    {
        $sql = "SELECT * FROM tipoUsuarios";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getUsuarios()
    {
        $sql = "SELECT *, tp.nombre AS tpNombre FROM users u, tipoUsuarios tp WHERE  u.idTipoUsuario = tp.idTipoUsuario";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getUsuario(string $usuario, string $clave)
    {
        $sql = "SELECT *, tp.nombre AS tpNombre FROM users u, tipoUsuarios tp WHERE usuario = '$usuario' AND pass = '$clave' AND u.idTipoUsuario = tp.idTipoUsuario";
        $data = $this->select($sql);
        return $data;
    }

    public function registrarUsuario(string $nombre, string $apePat, string $apeMat, string $usuario, string $clave, int $tipoUsuario)
    {
        $this->nombre = $nombre;
        $this->apePat = $apePat;
        $this->apeMat = $apeMat;
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->tipoUsuario = $tipoUsuario;

        $verificar = "SELECT * FROM users WHERE usuario = '$this->usuario'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO users (nombreU, apePat, apeMat, usuario, pass, idTipoUsuario) VALUES (?, ?, ?, ?, ?, ?)";
            $datos = array($this->nombre, $this->apePat, $this->apeMat, $this->usuario, $this->clave, $this->tipoUsuario);
            $data = $this->save($sql, $datos);

            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }
        return $res;
    }

    public function modificarUsuario(string $nombre, string $apePat, string $apeMat, string $usuario, int $tipoUsuario, int $id)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apePat = $apePat;
        $this->apeMat = $apeMat;
        $this->usuario = $usuario;
        $this->tipoUsuario = $tipoUsuario;

        $sql = "UPDATE users SET nombreU = ?, apePat = ?, apeMat = ?, usuario = ?, idTipoUsuario = ? WHERE idUsuario = ?";
        $datos = array($this->nombre, $this->apePat, $this->apeMat, $this->usuario, $this->tipoUsuario, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }

        return $res;
    }

    public function editarUser(int $id)
    {
        $sql = "SELECT * FROM users u WHERE idUsuario = $id";
        $data = $this->select($sql);
        return $data;
    }
}
