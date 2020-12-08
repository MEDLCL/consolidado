<?php
require_once "../config/Conexion.php";
require_once "../config/funciones.php";

$idsucursal = isset($_POST["idsucursal"]) ? $idsucursal = $_POST["idsucursal"] : $idsucursal = 0;
$razons = isset($_POST['razons']) ? limpia($_POST['razons']) : $razons = '';
$nombrec = isset($_POST['nombrec']) ? limpia($_POST['nombrec']) : $nombrec = '';
$telefono = isset($_POST['Telefono']) ? limpia($_POST['Telefono']): $telefono = '';
$pais = isset($_POST['pais']) ? $_POST['pais'] : $pais = 0;
$identificacion = isset($_POST['identificacion']) ? limpia($_POST['identificacion']) : $identificacion = '';
$direccion = isset($_POST['direccion']) ? limpia($_POST['direccion']) : $direccion = '';
$logo = isset($_POST['logo']) ? limpia($_POST['logo']) : $logo = '';



switch ($_GET["op"]) {
    case 'guardaryeditar':
        if ($idsucursal == 0 || $idsucursal == "") {
            //insertar nuevos registros
            if (file_exists($_FILES['logo']['tmp_name']) || is_uploaded_file($_FILES['logo']['tmp_name'])) {
                $extension =  strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
                $extension_valida = array('jpeg', 'jpg', 'gif', 'png');
                if (in_array($extension, $extension_valida)) {
                    $logo = round(microtime(true)) . '.' . $extension;
                    move_uploaded_file($_FILES['logo']['tmp_name'], "../logos/" . $logo);
                }
            }
            try {
                $fecha = date("Y-m-d");
                $estado = '1';
                $con = Conexion::getConexion();
                $stmt = $con->prepare("INSERT INTO sucursal (razons,nombrec,Telefono,identificacion,direccion,logo,fechaingreso,estado) 
                                VALUES (:razon,:nombrec,:tel,:identifi,:dir,:logo,:fecha,:estado)");
                $stmt->bindParam(':razon', $razons);
                $stmt->bindParam(':nombrec', $nombrec);
                $stmt->bindParam(':tel', $telefono);
                $stmt->bindParam(':identifi', $identificacion);
                $stmt->bindParam(':dir', $direccion);
                $stmt->bindParam(':logo', $logo);
                $stmt->bindParam(":fecha", $fecha);
                $stmt->bindParam(":estado", $estado);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    echo  1;
                }
                
            } catch (\Throwable $th) {
                echo "" . $th->getMessage();
            }
        } else {
            //actualizar registros
            if (!file_exists($_FILES['logo']['tmp_name']) || !is_uploaded_file($_FILES['logo']['tmp_name'])) {
                $logo = $_POST['logo_actual'];
            } else {
                $extension =  strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
                $extension_valida = array('jpeg', 'jpg', 'gif', 'png');
                if (in_array($extension, $extension_valida)) {
                    $logo = round(microtime(true)) . '.' . $extension;
                    move_uploaded_file($_FILES['logo']['tmp_name'], "../logos/" . $logo);
                    if ($_POST['logo_actual']) {
                        $logob = $_POST['logo_actual'];

                        if (file_exists("../logos/".$logob )) {
                            unlink("../logos/" . $_POST['logo_actual']);
                        }
                    }
                }
            }
            try {
                $fecha = date("Y-m-d");
                $con = Conexion::getConexion();
                $stmt = $con->prepare("UPDATE sucursal
                                SET razons= :razon,
                                    nombrec= :nombrec,
                                    Telefono = :tel,
                                    identificacion = :identifi,
                                    direccion= :dir,
                                    logo= :logo,
                                    idpais=:pais,
                                    fechaingreso=:fecha
                                WHERE  id_sucursal = :idsucursal");
                $stmt->bindParam(':razon', $razons);
                $stmt->bindParam(':nombrec', $nombrec);
                $stmt->bindParam(':tel', $telefono);
                $stmt->bindParam(':identifi', $identificacion);
                $stmt->bindParam(':dir', $direccion);
                $stmt->bindParam(':logo', $logo);
                $stmt->bindParam(':pais', $pais);
                $stmt->bindParam(':fecha', $fecha);
                $stmt->bindParam(':idsucursal', $idsucursal);
                $stmt->execute();
                    if ($stmt !==false){
                        echo 1;
                    }
                    $con = Conexion::cerrar();

            } catch (\Throwable $th) {
                echo "Error".$th->getMessage();
                $con = Conexion::cerrar();
            }
            
        }
        break;
        case 'Desactivar':
            $con = Conexion::getConexion();
            $stmt = $con->prepare("UPDATE sucursal SET estado= 0 WHERE id_sucursal = '$idsucursal'");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                echo 1;
            } else {
                echo 0;
            }
            $con = Conexion::cerrar();
            break;   
    case 'activar':
        $con = Conexion::getConexion();
        $stmt = $con->prepare("UPDATE sucursal SET estado= 1 WHERE id_sucursal = '$idsucursal'");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo 1;
        } else {
            echo 0;
        }
        $con = Conexion::cerrar();
        break;

    case 'mostrar':
        $con = Conexion::getConexion();
        $rspt = $con->prepare("SELECT * FROM sucursal WHERE id_sucursal = '$idsucursal'");
        $rspt->execute();
        $rspt = $rspt->fetch(PDO::FETCH_OBJ);

        echo json_encode($rspt);
        break;

    case 'listar':
        $con = Conexion::getConexion();
        $rspt = $con->prepare("SELECT * 
                                        FROM  sucursal as s  LEFT JOIN 
                                        pais AS p ON p.idpais = s.idpais");
        $rspt->execute();
        $rspt = $rspt->fetchAll(PDO::FETCH_OBJ);
        //se declara un array para almacenar todo el query
        $data = array();
        foreach ($rspt as $reg) {
            $data[] = array(
                "0" => '<button class="btn btn-warning" onclick="mostrarsucursal(' . $reg->id_sucursal . ')" data-toggle="modal"  data-target="#modalsucursal"  ><i class="fa fa-pencil"></i></button>',
                "1" => ($reg->estado) ? '<button class="btn btn-danger" onclick="inactivar(' . $reg->id_sucursal . ')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-primary" onclick="activar(' . $reg->id_sucursal . ')"><i class="fa fa-check"></i></button>',
                "2" => $reg->razons,
                "3" => $reg->nombrec,
                "4" => $reg->Telefono,
                "5" => $reg->nombre . ' ' . $reg->iniciales,
                "6" => "<img  src='../logos/" . $reg->logo . "'  width: '50px' height = '50px'>",
                "7" => $reg->identificacion,
                "8" => $reg->direccion,
                "9" => ($reg->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
            );
        }
        $results = array(
            "sEcho" => 1, //informacion para el datatable
            "iTotalRecords" => count($data), //enviamos el total al datatable
            "iTotalDisplayRecords" => count($data), //enviamos total de rgistror a utlizar
            "aaData" => $data
        );
        echo json_encode($results);
        $con = Conexion::cerrar();
        break;
}
