<?php
include_once "../config/Conexion.php";

Class Login {
    public function __construct()
	{

    }

    public function iniciaSesion($usuario,$pass){
        try {
            $cnx = Conexion::getConexion();
            $rsp = $cnx->prepare("SELECT * FROM usuario WHERE usuario = :usuario and pass = :pass");
            $rsp->bindParam(":usuario",$usuario);
            $rsp->bindParam(":pass",$pass);
            $rsp->execute();
            $row = $rsp->fetch(PDO::FETCH_OBJ);
            if ($rsp->rowCount()>0){
                return $row;
            }else{
                return "Usuario o Password Incorrectos";
            }
        } catch (\Throwable $th) {
            return "Error en la conexion".$th->getMessage();
        }
    }
    public function cerrarSesion(){

    }
}

?>