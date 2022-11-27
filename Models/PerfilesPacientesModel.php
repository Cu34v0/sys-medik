<?php
class PerfilesPacientesModel extends Query{
    private $fechaNacimiento, $peso, $tipoSangre, $id;
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

    public function editarInfoPaci(int $id)
    {
        $sql = "SELECT * FROM infoPaci WHERE idInfoPaci = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function actualizarInfoPaci(string $fechaNacimiento, string $peso, string $tipoSangre, int $id)
    {
        $this->fechaNacimiento = $fechaNacimiento;
        $this->peso = $peso;
        $this->tipoSangre = $tipoSangre;
        $this->id = $id;

        $sql = "UPDATE infoPaci SET fechaNacimiento = ?, peso = ?, tipoSangre = ? WHERE idInfoPaci = ?";
        $datos = array($this->fechaNacimiento, $this->peso, $this->tipoSangre, $this->id);
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