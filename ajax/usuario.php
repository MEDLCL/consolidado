<?php
//include_once "../config/Conexion.php";
include_once "../config/funciones.php";
include_once "../modelos/usuario.php";

$usuario = new Usuario();

$op = isset($_GET['op']) ? $op = $_GET['op'] : $op = '';
$idusuario = isset($_POST["idusuario"]) ? $idusuario = $_POST["idusuario"] : $idusuario = "0";
$nombre = isset($_POST["nombre"]) ? $nombre = limpia($_POST["nombre"]) : $nombre = "";
$apellido = isset($_POST["apellido"]) ? $apellido = limpia($_POST["apellido"]) : $apellido = "";
$correo = isset($_POST["correo"]) ? $correo = limpia($_POST["correo"]) : $correo = "";
$acceso = isset($_POST["acceso"]) ? $acceso = limpia($_POST["acceso"]) : $acceso = "";
$pass = isset($_POST["pass"]) ? $pass = limpia($_POST["pass"]) : $pass = "";
$idsucursal = isset($_POST["sucursal"]) ? $idsucursal = limpia($_POST["sucursal"]) : $idsucursal = "";
$iddepto = isset($_POST["depto"]) ? $iddepto = $_POST["depto"] : $iddepto = "";
$idpuesto = isset($_POST["puesto"]) ? $idpuesto = $_POST["puesto"] : $idpuesto = "";
$avatar = isset($_POST["avatar"]) ? $avatar = $_POST["avatar"] : $avatar = "";
$menuitem = isset($_POST["consultar"]) ? $menuitem = $_POST["consultar"] : $menuitem = array();

switch ($op) {
    case 'permisos':
        

        $tabla = '<thead>
                    <tr>
                        <th>Id</th>
                        <th>Menu</th>
                        <th>Sub Menu</th>
                        <th>Check</th>
                    </tr>
                 </thead>
        <tbody>';
        try {
            $tipo = 0;
            $res1 = $usuario->menuAsignado($_GET['idup']);
            $res = $usuario->listarPermisoMenu($tipo);
            
            $valores = array();

            //Almacenar los permisos asignados al usuario en el array
            foreach ($res1 as $per) {
                array_push($valores,$per->id_menu);
            }

            foreach ($res as $menup) {
                $sw=in_array($menup->id_menu,$valores)?'checked':'';

                $tabla = $tabla . '<tr>'
                    . '<td>' . $menup->id_menu . '</td>'
                    . '<td>' . $menup->nombre . '</td>'
                    . '<td></td>'
                    . '<td><input type ="checkbox" '.$sw.' name= "consultar[]"  value = "' . $menup->id_menu . '" class="custom-control-input"></td>'
                    . '</tr>';

                $res = $usuario->listarPermisoMenu($menup->id_menu);

                foreach ($res as $menui) {
                    $sw=in_array($menui->id_menu,$valores)?'checked':'';    
                    $tabla = $tabla . '<tr>'
                        . '<td>' . $menui->id_menu . '</td>'
                        . '<td></td>'
                        . '<td>' . $menui->nombre . '</td>'
                        . '<td><input type ="checkbox" '.$sw.' name= "consultar[]" value = "' . $menui->id_menu . '" class="custom-control-input"></td>'
                        . '</tr>';
                }
            }
            $tabla = $tabla . '</tbody>';
            echo $tabla;
        } catch (\Throwable $th) {
            return "No se pudo carga la tabla" . $th->getMessage();
        }
        break;
    case 'guardaryeditar':
        if ($idusuario == "0") {
            //insertar nuevos registros
            if (file_exists($_FILES['avatar']['tmp_name']) || is_uploaded_file($_FILES['avatar']['tmp_name'])) {
                $extension =  strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
                $extension_valida = array('jpeg', 'jpg', 'gif', 'png');
                if (in_array($extension, $extension_valida)) {
                    $avatar = round(microtime(true)) . '.' . $extension;
                    move_uploaded_file($_FILES['avatar']['tmp_name'], "../img/avatar/" . $avatar);
                }
            }
            $res =   $usuario->insertar($nombre, $apellido, $correo, $acceso, $pass, $idsucursal, $iddepto, $idpuesto,$avatar ,$menuitem);
            echo isset($res) ? "Usuario Registrado" : "Error No se pudo Registrar Usuario";
        } else {
            if (!file_exists($_FILES['avatar']['tmp_name']) || !is_uploaded_file($_FILES['avatar']['tmp_name'])) {
                $avatar = $_POST['avatar_actual'];
            } else {
                $extension =  strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
                $extension_valida = array('jpeg', 'jpg', 'gif', 'png');
                if (in_array($extension, $extension_valida)) {
                    $avatar = round(microtime(true)) . '.' . $extension;
                    move_uploaded_file($_FILES['avatar']['tmp_name'], "../img/avatar/" . $avatar);
                    if ($_POST['avatar_actual']) {
                        $avatarb = $_POST['avatar_actual'];

                        if (file_exists("../img/avatar/" . $avatarb)) {
                            unlink("../img/avatar/" . $_POST['avatar_actual']);
                        }
                    }
                }
            }
            $res = $usuario->editar($idusuario,$nombre, $apellido, $correo, $acceso, $pass, $idsucursal, $iddepto, $idpuesto, $avatar,$menuitem);
                echo isset($res) ? "Usuario Actualizado" : "Error No se pudo Actualizar Usuario";
        }

        break;
    case 'listar':
        $res = $usuario->listar();

        $data = array();
        foreach ($res as $reg) {
            $data[] = array(
                "0" => '<button class="btn btn-warning" onclick="mostrarUsuario(' . $reg->id_usuario . ')"><i class="fa fa-pencil"></i></button>',
                "1" => ($reg->estado) ? '<button class="btn btn-danger" onclick="desactivar(' . $reg->id_usuario . ')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-primary" onclick="activar(' . $reg->id_usuario . ')"><i class="fa fa-check"></i></button>',
                "2" => $reg->nombre,
                "3" => $reg->apellido,
                "4" => $reg->correo,
                "5" => $reg->acceso,
                "6" => $reg->sucursal,
                "7" => $reg->depto,
                "8" => $reg->puesto,
                "9" => file_exists("../img/avatar/" . $reg->avatar) ? "<img src ='../img/avatar/" . $reg->avatar . "' width = '50px' height = '50px'>" : "<img src ''>",
                "10" => ($reg->estado) ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">Desactivado</span>'
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
    case 'mostrar':
        $res = $usuario->consultarId($idusuario);
        echo json_encode($res);
        break;
        case 'desactivar':
            $res = $usuario->desactivar($idusuario);
            echo $res; 
            break;
            case 'activar':
                $res = $usuario->activar($idusuario);
                echo $res;
                break;
    default:
        # code...
        break;
}