<?php
    include_once "../config/Conexion.php";

Class Usuario
{

    public function __construct()
	{

    }
    
    public function insertar ($nombre,$apellido,$correo,$acceso,$pass,$sucursal,$depto,$puesto,$avatar,$pconsulta){
        try {
            $estado = 1;
            $con = Conexion::getConexion();
            $resp = $con->prepare("INSERT INTO login(id_sucursal,id_depto,id_puesto,acceso,pass,avatar,nombre,apellido,correo,estado)
                            VALUES (:id_sucursal,:id_depto,:id_puesto,:acceso,:pass,:avatar,:nombre,:apellido,:correo,:estado)");
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
          $resp->bindParam(":estado",$estado);
          $resp->execute();
          $idu = $con->lastInsertId();
          $con = Conexion::cerrar();
          if ($idu >0){
                if (count($pconsulta)>0){
                    try {
                        $con = Conexion::getConexion();
                        $res = $con->prepare("INSERT INTO  asigna_menu(id_usuario, id_menu)
                                                     VALUES(:id_usuario,:id_menu)");
                        foreach ($pconsulta as $value) {
                             $res->bindParam(":id_usuario",$idu);
                             $res->bindParam(":id_menu",$value);
                             $res->execute();     
                        }
                        
                        $con = Conexion::cerrar();
                        return 1;
                    } catch (\Throwable $th) {
                        return 0;
                    }
             
                }
          }// fin if 

        } catch (\Throwable $th) {
            return 0;
        }
        

    }
    public function editar ($idusuario,$nombre,$apellido,$correo,$acceso,$pass,$sucursal,$depto,$puesto,$avatar,$pconsulta){
        try {
            $con = Conexion::getConexion();
            $res = $con->prepare("UPDATE login 
            SET id_sucursal=:id_sucursal,
                id_puesto=:id_puesto,
                id_depto=:id_depto,
                acceso=:acceso,
                nombre=:nombre,
                apellido=:apellido,
                correo=:correo,
                avatar=:avatar
     
            WHERE id_usuario = :id_usuario");

          $res->bindParam(":id_sucursal",$sucursal);
          $res->bindParam(":id_depto",$depto);
          $res->bindParam(":id_puesto",$puesto);
          $res->bindParam(":acceso",$acceso);
          $res->bindParam(":nombre",$nombre);
          $res->bindParam(":apellido",$apellido);
          $res->bindParam(":correo",$correo);
          $res->bindParam(":avatar",$avatar);
          $res->bindParam(":id_usuario",$idusuario);
          $res->execute();
        
          if ($res !==false){

        //$con->Conexion::close();
          try {
              $con = Conexion::getConexion();
              $res = $con->prepare("DELETE FROM asigna_menu  WHERE id_usuario = $idusuario ");
              $res->execute();

          } catch (\Throwable $th) {
              //throw $th;
          }
            if (count($pconsulta)>0){
            
                try {
                    $con = Conexion::getConexion();
                    $res = $con->prepare("INSERT INTO  asigna_menu(id_usuario, id_menu )
                                                 VALUES(:id_usuario,:id_menu)");
                    foreach ($pconsulta as $value) {
                         $res->bindParam(":id_usuario",$idusuario);
                         $res->bindParam(":id_menu",$value);
                         $res->execute();     
                    }
                   
                    $con = Conexion::cerrar();
                    return 1;
                } catch (\Throwable $th) {
                    return NULL;
                }
         
            }
        } 
        } catch (\Throwable $th) {
            return NULL;
        }
    }
    public function listar (){

        try {
            $con = Conexion::getConexion();
            $resp = $con->prepare("CALL  prcListadoUsuarios();");
            $resp->execute();
            $resp = $resp->fetchAll(PDO::FETCH_OBJ);
            return $resp;
            $con= Conexion::cerrar();
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
    public function activar($idusuario){
       try {

        $con = Conexion::getConexion();
        $res = $con->prepare("UPDATE login SET estado = 1 WHERE id_usuario = $idusuario");
        $res->execute ();
        if ($res->rowCount()>0){
            return "1";
        }
    } catch (\Throwable $th) {
            return "0";
        }
       
    }
    public function desactivar($idusuario){
        $con = Conexion::getConexion();
        $res = $con->prepare("UPDATE login SET estado = 0 WHERE id_usuario = $idusuario");
        $res->execute ();
        if ($res->rowCount()>0){
            return "1";
        }else{
            return "0";
            }
    }


    public function menuAsignado ($idusuario){
        $con = Conexion::getConexion();
        $res = $con->prepare("SELECT * FROM asigna_menu WHERE id_usuario = $idusuario" );
        $res->execute();
        $rows= $res->fetchAll(PDO::FETCH_OBJ);
        return $rows;

    }
    public function consultarId($idusuario){
        $con = Conexion::getConexion();
        $res = $con->prepare("SELECT * FROM login where id_usuario = $idusuario");
        $res->execute();
        $row = $res->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    public function listarPermisoMenu($tipo){
        $con = Conexion::getConexion();

        $res = $con->prepare("SELECT * FROM menu WHERE id_Padre = $tipo");
        $res->execute();
        $rows =$res->fetchAll(PDO::FETCH_OBJ);
		return $rows;
    }

}