<?php

    require_once "../config/ClaseConexion.php";

    Class  Sucursal
    {
        //constructor
        public function __construct()
        {
        }
        // funcion para desabilitar la sucursal
        public function desabilitaS($idsucursal){
            $conexion = Conexion::getConexion();
            $stmt = $conexion->prepare("update sucursal set estado = '0' where idsucursal = '$id_sucursal'");
            $stmt->execute();
            if ($stmt->rowCount()>0){
                echo TRUE;
            }
            else {
                echo FALSE;
            }
        }


        //funcion para habilitar la sucursal


        //funcion para editar los datos de la sucursal


        //funcion para insertar la sucursal



        //mostrar los datos al hacer un selec por id
        public static function mostrarPorId($idsucursal)
        {
            $conexion = Conexion::getConexion();
            $stmt=$conexion->prepare("select * from sucursal where id_sucursal = '$idsucursal'");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        //mostrar todo el selecct
        public  function listar()
        { $conexion = Conexion::getConexion();
          $stmt = $conexion->prepare("select * from sucursal");
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

    }
?>
