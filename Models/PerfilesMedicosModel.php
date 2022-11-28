<?php
class PerfilesMedicosModel extends Query{
    private $idEspecialidad, $cedulaProfesional, $turno, $id;
    public function __construct()
    {
        parent::__construct();
    }

    public function getPerfilesDoctores()
    {
        $sql = "SELECT * FROM users u, infoDoc id, turnos tu, especialidades es WHERE u.idUsuario = id.idUsuario AND id.idTurno = tu.idTurno AND id.idEspecialidad = es.idEspecialidad;
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

    public function getEspecialidades()
    {
        $sql = "SELECT * FROM especialidades";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function editarInfoDoc(int $id)
    {
        $sql = "SELECT * FROM infoDoc WHERE idInfoDoc = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function actualizarInfoMedic(int $idEspecialidad, string $cedulaProfesional, int $turno, int $id)
    {
        $this->idEspecialidad = $idEspecialidad;
        $this->cedulaProfesional = $cedulaProfesional;
        $this->turno = $turno;
        $this->id = $id;

        $sql = "UPDATE infoDoc SET idEspecialidad = ?, cedulaProfesional = ?, idTurno = ? WHERE idInfoDoc = ?";
        $datos = array($this->idEspecialidad, $this->cedulaProfesional, $this->turno, $this->id);
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