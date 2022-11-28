<?php
class CambioPassModel extends Query{
    private $idUsuario;
    public function __construct()
    {
        parent:: __construct();
    }

    public function getUsuario(int $idUsuario, $hash1)
    {           
        $sql = "SELECT * FROM users WHERE idUsuario = '$idUsuario' AND pass = '$hash1'";
        $data = $this->select($sql);
        return $data;
    }

    public function cambioContra(string $hash3, int $idUsuario)
    {
        $this->hash3 = $hash3;
        $this->idUsuario = $idUsuario;

        $sql = "UPDATE users SET pass = ? WHERE idUsuario = ?";
        $datos = array($this->hash3, $this->idUsuario);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "modificada";
        }else{
            $res = "error";
        }
        return $res;
    }
}

?>