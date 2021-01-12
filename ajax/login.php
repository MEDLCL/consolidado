<?php
session_start();
require_once "../config/Conexion.php";
include_once "../config/funciones.php";
$usuarioa = isset($_POST["logina"]) ? $usuarioa = limpia($_POST["logina"]) : $usuarioa = "";
$passa = isset($_POST["clavea"]) ? $passa = limpia($_POST["clavea"]) : $passa = "";
$codigol = isset($_POST['codigol']) ? $codigol = limpia($_POST['codigol']) : $codigol = '';

switch ($_GET['op']) {
    case 'ingreso':

        $con = Conexion::getConexion();
        try {
            $stmt = $con->prepare('CALL prclogin(:codigo,:user,:pass);');
            $stmt->bindParam(':codigo', $codigol);
            $stmt->bindParam(':user', $usuarioa);
            $stmt->bindParam(':pass', $passa);
            $stmt->execute();
            $stmt = $stmt->fetch(PDO::FETCH_OBJ);

            if ($stmt){
                    $_SESSION['idusuario'] = $stmt->id_usuario;
                    $_SESSION['idsucursal']=$stmt->id_sucursal;
                    $_SESSION['nombre'] = trim($stmt->nombre);
                    $_SESSION['apellido'] = trim($stmt->apellido);
                    $_SESSION['correo'] = trim($stmt->correo);
                    $_SESSION['avatar'] = trim($stmt->avatar);
                    $_SESSION['logo'] = trim($stmt->logo);
                    $_SESSION['direccion']=trim($stmt->direccion);
                    $_SESSION['telefono']=trim($stmt->Telefono);
                    $_SESSION['nit']=trim($stmt->identificacion);
                    $_SESSION['idpais']=$stmt->idpais;
                    $_SESSION['puesto']=trim($stmt->puesto);
                
               $stmtper = $con->prepare("SELECT * FROM asigna_menu WHERE id_usuario = :idusuario");
               $stmtper->bindParam(':idusuario',$_SESSION['idusuario']);
               $stmtper->execute();
               $stmtper = $stmtper->fetchAll(PDO::FETCH_OBJ);
               $arraypermisos = array();
                if ($stmtper){
                    foreach ($stmtper as $key) {
                        array_push($arraypermisos,$key->id_menu);
                    }
                }    
                in_array(1,$arraypermisos)?$_SESSION['Administracion']=1:$_SESSION['Administracion']=0;
                in_array(6,$arraypermisos)?$_SESSION['Sucursales']=1:$_SESSION['Sucursales']=0;
                in_array(7,$arraypermisos)?$_SESSION['Usuarios']=1:$_SESSION['Usuarios']=0;
                in_array(8,$arraypermisos)?$_SESSION['Registros']=1:$_SESSION['Registros']=0;
                in_array(9,$arraypermisos)?$_SESSION['AgenteE']=1:$_SESSION['AgenteE']=0;
                in_array(10,$arraypermisos)?$_SESSION['AgenciaC']=1:$_SESSION['AgenciaC']=0;
                in_array(11,$arraypermisos)?$_SESSION['Aéreo-linea']=1:$_SESSION['Aéreo-linea']=0;
                in_array(12,$arraypermisos)?$_SESSION['Almacenadora']=1:$_SESSION['Almacenadora']=0;
                in_array(13,$arraypermisos)?$_SESSION['Consignatario']=1:$_SESSION['Consignatario']=0;
                in_array(14,$arraypermisos)?$_SESSION['Consignado']=1:$_SESSION['Consignado']=0;
                in_array(15,$arraypermisos)?$_SESSION['Embarcador']=1:$_SESSION['Embarcador']=0;
                in_array(16,$arraypermisos)?$_SESSION['Naviera']=1:$_SESSION['Naviera']=0;
                in_array(17,$arraypermisos)?$_SESSION['Proveedor']=1:$_SESSION['Proveedor']=0;
                in_array(18,$arraypermisos)?$_SESSION['Transportista']=1:$_SESSION['Transportista']=0;
                echo 1;

            }else{
                echo 0;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        break;
        case 'salir':
            session_unset();
            session_destroy();
            header("Location: ../index.php");
        break;

    default:
        # code...
        break;
}
