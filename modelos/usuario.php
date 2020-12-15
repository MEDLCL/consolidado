<?php
    include_once "../config/Conexion.php";

Class Usuario
{

    public function __construct()
	{

    }
    
    public function insertar ($nombre,$apellido,$correo,$acceso,$pass,$sucursal,$depto,$puesto,$pconsulta,$pagrega,$pedita,$peliminar){
        try {
            $avatar = "";
            $con = Conexion::getConexion();
            $resp = $con->prepare("INSERT INTO login(id_sucursal,id_depto,id_puesto,acceso,pass,avatar,nombre,apellido,correo)
                            VALUES (:id_sucursal,:id_depto,:id_puesto,:acceso,:pass,:avatar,:nombre,:apellido,:correo)");
          $resp->bindParam(":id_sucursal",$sucursal);
          $resp->bindParam(":id_depto",$depto);
          $resp->bindParam(":id_puesto",$puesto);
          $resp->bindParam(":acceso",$acceso);
          $resp->bindParam(":pass",$pass);
          $resp->bindParam(":avatar",$avatar);
          $resp->bindParam(":nombre",$nombre);
          $resp->bindParam(":apellido",$apellido);
          $resp->bindParam(":correo",$correo);
          $resp->bindParam(":avatar",$avatar);
          $resp->execute();
          $idu = $con->lastInsertId();
          $con = Conexion::cerrar();
          if ($idu >0){
                if (count($pconsulta)>0 || count ($pagrega)>0 || count ($pedita)>0 || count ($peliminar)>0){
                    $consulta = 1;
                    $agregar = 2;
                    $editar = 3;
                    $eliminar = 4;
                    try {
                        $con = Conexion::getConexion();
                        $res = $con->prepare("INSERT INTO  asigna_permiso(id_usuario, id_menu, id_permiso)
                                                     VALUES(:id_usuario,:id_menu,:id_permiso)");
                        foreach ($pconsulta as $value) {
                             $res->bindParam(":id_usuario",$idu);
                             $res->bindParam(":id_menu",$value);
                             $res->bindParam(":id_permiso",$consulta);
                             $res->execute();     
                        }
                        foreach ($pagrega as $value) {
                            $res->bindParam(":id_usuario",$idu);
                            $res->bindParam(":id_menu",$value);
                            $res->bindParam(":id_permiso",$agregar);
                            $res->execute();     
                       }  
                       foreach ($pedita as $value) {
                        $res->bindParam(":id_usuario",$idu);
                        $res->bindParam(":id_menu",$value);
                        $res->bindParam(":id_permiso",$editar);
                        $res->execute();     
                   } 
                        foreach ($peliminar as $value) {
                            $res->bindParam(":id_usuario",$idu);
                            $res->bindParam(":id_menu",$value);
                            $res->bindParam(":id_permiso",$eliminar);
                            $res->execute();     
                     }         

                        $con = Conexion::cerrar();
                        return 1;
                    } catch (\Throwable $th) {
                        return 0;
                    }
             
                }
          }

        } catch (\Throwable $th) {

        }
        

    }
    public function actualizar (){

    }
    public function listar (){

        try {
            $con = Conexion::getConexion();
            $resp = $con->prepare("SELECT * FROM login");
            $resp->execute();
            $resp = $resp->fetchAll(PDO::FETCH_OBJ);
            return $resp;
            $con= Conexion::cerrar();
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
    public function activar(){

    }
    public function desactivar(){

    }
    public function consultarId(){

    }
    public function listarPermisoMenu($tipo){
        $con = Conexion::getConexion();
        $res = $con->prepare("SELECT * FROM menu WHERE id_Padre = $tipo");
        $res->execute();
        $row =$res->fetchAll(PDO::FETCH_OBJ);
		return $row;
    }

}