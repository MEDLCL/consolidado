<?php
include_once "ConfigDB.php";
class Conexion
{
    private static $con = null;

    private function __construct() {
          try {
              self::$con = new PDO(GESTOR.":dbname=".DB_NAME
                                               .";host=".HOST
                                               .";charset=".CODIFICACION
                                               ,USER,PASS);
              self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          } catch (PDOException $e) {
              echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
              exit;
          }
      }
      public static function getConexion(){
          if(!self::$con){
              new self();
          }
          return self::$con;
      }
      public static function cerrar(){
          self::$con = null;
      }
}
 ?>