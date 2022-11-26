<?php
class PerfilesAdministradoresModel extends Query{
    private $id, $experiencia;
    public function __construct()
    {
        parent::__construct();
    }

    public function getPerfilesAdministradores()
    {
        $sql = "SELECT * FROM users u, infoAdmin ia WHERE u.idUsuario = ia.idUsuario";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function editarInfoAdmin(int $id)
    {
        $sql = "SELECT * FROM infoAdmin WHERE idInfoAdmin = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function actualizarInfoAdmin(string $experiencia, int $id)
    {
        $this->experiencia = $experiencia;
        $this->id = $id;

        $sql = "UPDATE infoAdmin SET experiencia = ? WHERE idInfoAdmin = ?";
        $datos = array($this->experiencia, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
}

?>