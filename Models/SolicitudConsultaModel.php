<?php
class SolicitudConsultaModel extends Query{
    private $idUsuario, $fechaSolicitud, $especialidad;
    public function __construct()
    {
        parent::__construct();
    }

    public function getSolicitudConsulta()
    {
        $sql = "SELECT * FROM solicitudConsulta sc, users us, especialidades es WHERE sc.idUsuario = us.idUsuario AND sc.idEspecialidad = es.idEspecialidad";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getEspecialidades()
    {
        $sql = "SELECT * FROM especialidades";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarCita(int $idUsuario, string $fechaSolicitud, int $especialidad)
    {
        $this->idUsuario = $idUsuario;
        $this->fechaSolicitud = $fechaSolicitud;
        $this->especialidad = $especialidad;

        // Verificar especialidad
        $verificar = "SELECT * FROM infoDoc WHERE idEspecialidad = '$this->especialidad'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO solicitudConsulta(idUsuario, fechaConsulta, idEspecialidad, estadoSolicitud) VALUES (?, ?, ?, ?)";
            $datos = array($this->idUsuario, $this->fechaSolicitud, $this->especialidad, "Pendiente");
            $data = $this->save($sql, $datos);

            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $sql = "INSERT INTO solicitudConsulta(idUsuario, fechaConsulta, idEspecialidad, estadoSolicitud) VALUES (?, ?, ?, ?)";
            $datos = array($this->idUsuario, $this->fechaSolicitud, $this->especialidad, "Aprobada");
            $data = $this->save($sql, $datos);

            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        }
        return $res;
    }
}

?>