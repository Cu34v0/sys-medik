<?php
class UsuariosModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuario(string $usuario, string $clave)
    {
        $sql = "SELECT *, tp.nombre AS tpNombre FROM users u, tipoUsuarios tp WHERE usuario = '$usuario' AND pass = '$clave' AND u.idTipoUsuario = tp.idTipoUsuario";
        $data = $this->select($sql);
        return $data;

    }
}

?>