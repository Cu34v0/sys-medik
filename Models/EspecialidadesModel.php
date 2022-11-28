<?php
class EspecialidadesModel extends Query{
    private $especialidad, $id;
    public function __construct()
    {
        parent::__construct();
    }

    public function getEspecialidades()
    {
        $sql = "SELECT * FROM especialidades";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarEspecialidad(string $especialidad)
    {
        $this->especialidad = $especialidad;
        $sql = "INSERT INTO especialidades(nombreEspecialidad) VALUES (?)";
        $datos = array($this->especialidad);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function modificarEspecialidad(string $especialidad, int $id)
    {
        $this->id = $id;
        $this->especialidad = $especialidad;

        $sql = "UPDATE especialidades SET nombreEspecialidad = ? WHERE idEspecialidad = ?";
        $datos = array($this->especialidad, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function editarEspecialidad(int $id)
    {
        $sql = "SELECT * FROM especialidades WHERE idEspecialidad = $id";
        $data = $this->select($sql);
        return $data;
    }
}

?>