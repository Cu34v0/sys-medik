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

            $idUsuarioQuery = "SELECT idUsuario FROM users WHERE usuario = '$this->usuario'";
            $idUsuario = $this->select($idUsuarioQuery);

            switch ($tipoUsuario) {
                case 1:
                    $sql2 = "INSERT INTO infoAdmin (idUsuario) VALUES (?)";
                    $datos2 = array($idUsuario["idUsuario"]);
                    $data2 = $this->save($sql2, $datos2);
                    break;
                case 2:
                    $sql2 = "INSERT INTO infoDoc (idUsuario) VALUES (?)";
                    $datos2 = array($idUsuario["idUsuario"]);
                    $data2 = $this->save($sql2, $datos2);
                    break;
                case 3:
                    $sql2 = "INSERT INTO infoPaci (idUsuario) VALUES (?)";
                    $datos2 = array($idUsuario["idUsuario"]);
                    $data2 = $this->save($sql2, $datos);
                    break;
            }


            if ($data == 1 and $data2 == 1) {
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

        // Verifico el TipoUsuario al cual pertenece el id de modificación
        $idTipoUsuarioQuery = "SELECT idTipoUsuario FROM users WHERE idUsuario = '$this->id'";
        $idTipoUsuario = $this->select($idTipoUsuarioQuery);

        // Primero, compaero si el ID obtenido es diferente al ID que vienen en los campos a cambiar
        if ($tipoUsuario != $idTipoUsuario['idTipoUsuario']) {
            switch ($idTipoUsuario['idTipoUsuario']) {
                case 1:
                    // Primero elimino el registro que ya estaba en la tabla
                    $sql = "DELETE FROM infoAdmin WHERE idUsuario = ?";
                    $datos = array($this->id);
                    $data = $this->save($sql, $datos);
                    break;
                case 2:
                    // Primero elimino el registro que ya estaba en la tabla
                    $sql = "DELETE FROM infoDoc WHERE idUsuario = ?";
                    $datos = array($this->id);
                    $data = $this->save($sql, $datos);
                    break;
                case 3:
                    // Primero elimino el registro que ya estaba en la tabla
                    $sql = "DELETE FROM infoPaci WHERE idUsuario = ?";
                    $datos = array($this->id);
                    $data = $this->save($sql, $datos);
                    break;
            }
        }

        // Dependiendo del nuevo id que nos traiga el POST, insertaremos el dato
        switch ($tipoUsuario) {
            case 1:
                $sql2 = "INSERT INTO infoAdmin (idUsuario) VALUES (?)";
                $datos2 = array($this->id);
                $data2 = $this->save($sql2, $datos2);
                break;
            case 2:
                $sql2 = "INSERT INTO infoDoc (idUsuario) VALUES (?)";
                $datos2 = array($this->id);
                $data2 = $this->save($sql2, $datos2);
                break;
            case 3:
                $sql2 = "INSERT INTO infoPaci (idUsuario) VALUES (?)";
                $datos2 = array($this->id);
                $data2 = $this->save($sql2, $datos);
                break;
        }

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

    public function getIdUsuario(string $usuario)
    {
        $sql = "SELECT idUsuario FROM users WHERE usuario = $usuario";
        $data = $this->select($sql);
        return $data;
    }

    public function eliminarUser(int $id)
    {
        $this->id = $id;
        $sql = "DELETE FROM users WHERE idUsuario = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}