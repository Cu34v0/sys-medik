<?php
class PerfilesMedicosModel extends Query{
    private $especialidad, $cedulaProfesional, $turno, $id;
    public function __construct()
    {
        parent::__construct();
    }

    public function getPerfilesDoctores()
    {
        $sql = "SELECT * FROM users u, infoDoc id, turnos tu WHERE u.idUsuario = id.idUsuario AND id.idTurno = tu.idTurno;
        ";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getTurnos()
    {
        $sql = "SELECT * FROM turnos";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function editarInfoDoc(int $id)
    {
        $sql = "SELECT * FROM infoDoc WHERE idInfoDoc = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function actualizarInfoMedic(string $especialidad, string $cedulaProfesional, int $turno, int $id)
    {
        $this->especialidad = $especialidad;
        $this->cedulaProfesional = $cedulaProfesional;
        $this->turno = $turno;
        $this->id = $id;

        $sql = "UPDATE infoDoc SET especialidad = ?, cedulaProfesional = ?, idTurno = ? WHERE idInfoDoc = ?";
        $datos = array($this->especialidad, $this->cedulaProfesional, $this->turno, $this->id);
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