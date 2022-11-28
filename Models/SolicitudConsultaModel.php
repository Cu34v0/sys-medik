<?php
class SolicitudConsultaModel extends Query{
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
}

?>