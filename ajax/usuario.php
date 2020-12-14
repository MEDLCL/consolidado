<?php
include_once "../config/Conexion.php";
include_once "../config/funciones.php";


$op = isset($_GET['op'])?$op = $_GET['op']: $op ='';
$idusuario = isset ($_POST["idusuario"])?$idusuario = $_POST["idusuario"]:$idusuario = "0";
$nombre = isset($_POST["nombre"])?$nombre = $_POST["nombre"]:$nombre = "";
$apellido = isset($_POST["apellido"])?$apellido = $_POST["apellido"]:$apellido = "";
$correo = isset($_POST["correo"])?$correo = $_POST["correo"]:$correo = "";
$acceso = isset($_POST["acceso"])?$acceso = $_POST["acceso"]:$acceso = "";
$pass = isset($_POST["pass"])?$pass = $_POST["pass"]:$pass = "";
$idsucursal = isset($_POST["sucursal"])?$idsucursal = $_POST["sucursal"]:$idsucursal = "";
$iddepto = isset($_POST["depto"])?$iddepto = $_POST["depto"]:$iddepto = "";
$idpuesto = isset($_POST["puesto"])?$idpuesto = $_POST["puesto"]:$idpuesto = "";
$avatar = isset($_POST["avatar_actual"])?$avatar = $_POST["avatar_actual"]:$avatar = "";

switch ($op) {
    case 'permisos':
        $tabla = '<tbody>';
        try {
           
            $con = Conexion::getConexion();
            $rspt = $con->prepare('SELECT * FROM menu WHERE id_Padre = 0');
            $rspt->execute();
            foreach ($rspt->fetchAll(PDO::FETCH_OBJ) as $menup){

                $tabla = $tabla.'<tr>'
                            .'<td>'.$menup->id_menu.'</td>'
                            .'<td>'. $menup->nombre. '</td>'
                            .'<td></td>'
                            .'<td><input type ="checkbox" name= "consultar[]" value = "'.$menup->id_menu.'" class="custom-control-input"></td>'
                            .'<td><input type ="checkbox" name= "agregar[]" value = "'.$menup->id_menu.'" class="custom-control-input" disabled></td>'
                            .'<td><input type ="checkbox" name= "editar[]" value = "'.$menup->id_menu.'" class="custom-control-input" disabled></td>'
                            .'<td><input type ="checkbox" name= "eliminar[]" value = "'.$menup->id_menu.'" class="custom-control-input" disabled></td>'
                .'</tr>';
                $rspt = $con->prepare("SELECT * FROM menu WHERE id_Padre = $menup->id_menu");
                $rspt->execute();

                foreach ($rspt->fetchAll(PDO::FETCH_OBJ)as $menui ) {

                    $tabla = $tabla.'<tr>'
                            .'<td>'.$menui->id_menu.'</td>' 
                            .'<td></td>'
                            .'<td>'. $menui->nombre. '</td>'
                            .'<td><input type ="checkbox" name= "consultar[]" value = "'.$menui->id_menu.'" class="custom-control-input"></td>'
                            .'<td><input type ="checkbox" name= "agregar[]" value = "'.$menui->id_menu.'" class="custom-control-input"></td>'
                            .'<td><input type ="checkbox" name= "editar[]" value = "'.$menui->id_menu.'" class="custom-control-input"></td>'
                            .'<td><input type ="checkbox" name= "eliminar[]" value = "'.$menui->id_menu.'" class="custom-control-input"></td>'
                .'</tr>';
                }
            }
            $tabla = $tabla.'</tbody>';
            echo $tabla;
        } catch (\Throwable $th) {
            return "No se pudo carga la tabla". $th->getMessage();
        }
        break;
    case 'guardaryeditar':
        if ($idusuario =="0"){
      try {
          $con =  Conexion::getConexion();
          $resp = $con->prepare("INSERT INTO login(id_sucursal,id_depto,id_puesto,acceso,pass,avatar,nombre,apellido,correo)
                            VALUES (:id_sucursal,:id_depto,:id_puesto,:acceso,:pass,:avatar,:nombre,:apellido,:correo)");
          $resp->bindParam(":id_sucursal",$idsucursal);
          $resp->bindParam(":id_depto",$iddepto);
          $resp->bindParam(":id_puesto",$idpuesto);
          $resp->bindParam(":acceso",$acceso);
          $resp->bindParam(":pass",$pass);
          $resp->bindParam(":avatar",$avatar);
          $resp->bindParam(":nombre",$nombre);
          $resp->bindParam(":apellido",$apellido);
          $resp->bindParam(":correo",$correo);
          $resp->execute();
          $idusuario = $con->lastInsertId();
          $con = Conexion::cerrar();
          if ($idusuario >0){
            if (count($_POST["consultar"])>0){
                $contador =0;
                $consul = 1;
                $con = Conexion::getConexion();
                $res = $con->prepare("INSERT INTO  asigna_permiso(id_usuario, id_menu, id_permiso)
                                    VALUES(:id_usuario,:id_menu,:id_permiso)");
                 while ($contador < count($_POST["consultar"]))
                {

                    $res->bindParam(":id_usuario",$idusuario);
                    $res->bindParam(":id_menu",$_POST["consultar"][$contador]);
                    $res->bindParam(":id_permiso",$consul);
                    $res->execute(); 
                    $contador = $contador +1;
                } 
                $con= Conexion::cerrar();
          }   
        }
        echo 1;
      } catch (\Throwable $th) {
         echo "Usuario no se pudo registrar: ".$th->getMessage();
      }
    }
    break;

    default:
        # code...
        break;
}
?>