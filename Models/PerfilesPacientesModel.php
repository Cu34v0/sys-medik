<?php
class PerfilesPacientesModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPerfilesPacientes()
    {
        $sql = "SELECT * FROM users u, infoPaci ip WHERE u.idUsuario = ip.idUsuario";
        $data = $this->selectAll($sql);
        return $data;
    }
}

?>