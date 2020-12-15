<?php
//include_once "../config/Conexion.php";
include_once "../config/funciones.php";
include_once "../modelos/usuario.php";

$usuario = new Usuario();

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
$consultar = isset($_POST["consultar"])?$consultar = $_POST["consultar"]:$consultar = array();
$agregar = isset($_POST["agregar"])?$agregar = $_POST["agregar"]:$agregar = array();
$editar = isset($_POST["editar"])?$editar = $_POST["editar"]:$editar = array();
$eliminar = isset($_POST["eliminar"])?$eliminar = $_POST["eliminar"]:$eliminar = array();

switch ($op) {
    case 'permisos':
        $tabla = '<tbody>';
        try {
            $tipo = 0;
            $res = $usuario->listarPermisoMenu($tipo);

            foreach ($res as $menup){

                $tabla = $tabla.'<tr>'
                            .'<td>'.$menup->id_menu.'</td>'
                            .'<td>'. $menup->nombre. '</td>'
                            .'<td></td>'
                            .'<td><input type ="checkbox" name= "consultar[]" value = "'.$menup->id_menu.'" class="custom-control-input"></td>'
                            .'<td><input type ="checkbox" name= "agregar[]" value = "'.$menup->id_menu.'" class="custom-control-input" disabled></td>'
                            .'<td><input type ="checkbox" name= "editar[]" value = "'.$menup->id_menu.'" class="custom-control-input" disabled></td>'
                            .'<td><input type ="checkbox" name= "eliminar[]" value = "'.$menup->id_menu.'" class="custom-control-input" disabled></td>'
                .'</tr>';
                
                $res = $usuario->listarPermisoMenu($menup->id_menu);

                foreach ($res as $menui ) {

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
         $res =   $usuario->insertar($nombre,$apellido,$correo,$acceso,$pass,$idsucursal,$iddepto,$idpuesto,$consultarconsultar,  $agregar , $editar ,$eliminar);
            echo isset ($res) ? "Usuario Registrado":"Error No se pudo Registrar Usuario";
    }
    break;
    case 'listar':
        $res = $usuario->listar();
        $data = array();
        foreach ($res as $reg) {
            $data[] = array(
                "0" => '<button class="btn btn-warning" onclick="mostrarsucursal(' . $reg->id_usuario . ')" data-toggle="modal"  data-target="#modalsucursal"  ><i class="fa fa-pencil"></i></button>',
                "1" => ($reg->estado) ? '<button class="btn btn-danger" onclick="inactivar(' . $reg->id_usuario . ')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-primary" onclick="activar(' . $reg->id_usuario . ')"><i class="fa fa-check"></i></button>',
                "2" => $reg->nombre,
                "3" => $reg->apellido,
                "4" => $reg->correo,
                "5" => $reg->acceso,
                "6" =>"sucursal",
                "7"=>"Depto",
                "8" => "puesto",
                "9" => "aavatar",
                "10" => ($reg->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
            );

        }               
        $results = array(
            "sEcho" => 1, //informacion para el datatable
            "iTotalRecords" => count($data), //enviamos el total al datatable
            "iTotalDisplayRecords" => count($data), //enviamos total de rgistror a utlizar
            "aaData" => $data
        );
        echo json_encode($results);
        break;
    default:
        # code...
        break;
}
?>