<?php
session_start();
include_once  "../config/Conexion.php";

$tabla = isset($_GET['tabla']) ? $tabla = $_GET['tabla'] : $tabla = '';
$campo = isset($_GET['campo']) ? $campo = $_GET['campo'] : $campo = '';
$tipomedio = isset($_GET['tipomedio']) ? $tipomedio = $_GET['tipomedio'] : $tipomedio = '';
$id = isset($_POST['id']) ? $id = $_POST['id'] : $id = '';
$tipoe = isset($_POST['tipoe'])?$tipoe = $_POST['tipoe']:$tipoe = '';
$idpadre = isset ($_POST['idpadre']) ? $idpadre = $_POST['idpadre']:$idpadre= 0;
$campo2 = isset($_GET['campo2']) ? $campo2 = $_GET['campo2'] : $campo2 = '';

switch ($_GET['op']) {
    case 'pais':
        pais();
        break;
    case 'selectP':
        selectPadre($tabla, $campo, $id);
    case 'selecEmpresa':
        selecEmpresa($tabla, $campo, $id,$tipoe);
        break;
    case 'selectN':
        selectNomal($tabla,$campo,$id);
        break;
    case 'llenaMoneda':
        llenaMoneda();
        break;
    case 'tipocarga':
        tipocarga($tabla,$campo,$id,$tipomedio);
    break;   
    
    case 'General':
        selectGeneral($tabla,$campo,$id);
    break;         
    case 'Dependiente':
        selectDependiente($tabla,$idpadre,$campo,$id);
    break;
    case 'cuentaBanco':
        cuentaBancosMov($idpadre);
        break;
    default:
    case 'equipo':
        equipos();
        break;
    case 'selPro':
        selecProyecto($tabla,$campo,$id);
        break;
    case 'agente':
        agentes($id);
        break;
    case 'usuario':
        usuario($id);
        break;
    case 'tipoSucursal':
        sucursal();
        break;
    case 'destinoOrigen':
        destiOrigen($tabla,$idpadre,$campo,$id);
        break;
}



function selectPadre($tabla, $campo, $id)
{
    $con = Conexion::getConexion();
    $stmt = $con->prepare("SELECT * FROM $tabla ORDER  BY $campo ASC");
    $stmt->execute();
    $selec = '';
    $selec = '<option value="0" selected>Seleccione una Opcion</option>';
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as  $resp) {
        $selec = $selec . '<option value="' . $resp->$id . '">' . $resp->$campo . '</option>';
    }
    echo $selec;
    $con = Conexion::cerrar();
    $stmt = NULL;
}

function pais()
{
    $conexion = Conexion::getConexion();
    $stmt = $conexion->prepare("select idpais,nombre,iniciales from pais order by nombre asc");
    $stmt->execute();
    $selec = '<option value="0">Seleccione un pais</option>';
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as $pais) :
        $selec = $selec . '<option value="' . $pais->idpais . '">' . $pais->nombre . "-" . $pais->iniciales . ' </option>
';
    endforeach;
    echo $selec;
    $conexion = Conexion::cerrar();
    $stmt = null;
}

function selecEmpresa($tabla, $campo, $id,$tipoe)
{
    $con = Conexion::getConexion();
    $stmt = $con->prepare("SELECT * FROM $tabla WHERE Tipoe = :tipoe AND id_sucursal = :id_sucursal ORDER  BY $campo ASC");
    $stmt->bindParam(":tipoe",$tipoe);
    $stmt->bindParam(":id_sucursal",$_SESSION['idsucursal']);
    $stmt->execute();
    $selec = '';
    $selec = '<option value="0" selected>Seleccione una Opcion</option>';
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as  $resp) {
        $selec = $selec . '<option value="' . $resp->$id . '">' . $resp->$campo . '</option>';
    }
    echo $selec;
    $con = Conexion::cerrar();
    $stmt = NULL;
}

function selectNomal($tabla,$campo,$id){
    $con = Conexion::getConexion();
    $stmt = $con->prepare("SELECT * FROM $tabla  WHERE id_sucursal = :id_sucursal ORDER  BY $campo ASC");
    $stmt->bindParam(":id_sucursal",$_SESSION['idsucursal']);
    $stmt->execute();
    $selec = '';
    $selec = '<option value="0" selected>Seleccione una Opcion</option>';
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as  $resp) {
        $selec = $selec . '<option value="' . $resp->$id . '">' . $resp->$campo . '</option>';
    }
    echo $selec;
    $con = Conexion::cerrar();
    $stmt = NULL;
}

function llenaMoneda(){
    $con = Conexion::getConexion();
    $stmt = $con->prepare("SELECT M.signo,M.id_moneda,M.nombre
                            FROM asigna_moneda AM INNER JOIN 
                                moneda as M on M.id_moneda = AM.id_moneda
                            WHERE id_sucursal = :id_sucursal");

    $stmt->bindParam(":id_sucursal",$_SESSION['idsucursal']);
    $stmt->execute();
    $selec = '';
    $selec = '<option value="0" selected >Seleccione Moneda</option>';
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as  $resp) {
        $selec = $selec . '<option value="' . $resp->id_moneda . '">' . $resp->signo . " - " . $resp->nombre .'</option>';
    }
    echo $selec;
    $con = Conexion::cerrar();
    $stmt = NULL;
}

function tipocarga($tabla,$campo,$id,$tipomedio){
    $con = Conexion::getConexion();
    $stmt = $con->prepare("SELECT * FROM $tabla  WHERE id_tipo_medio = :idmedio ORDER  BY $campo ASC");
    $stmt->bindParam(":idmedio",$tipomedio);
    $stmt->execute();
    $selec = '';
    $selec = '<option value="0" selected>Seleccione una Opcion</option>';
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as  $resp) {
        $selec = $selec . '<option value="' . $resp->$id . '">' . $resp->$campo . '</option>';
    }
    echo $selec;
    $con = Conexion::cerrar();
    $stmt = NULL;
}

function selectGeneral($tabla,$campo,$id){
    $con = Conexion::getConexion();
    $stmt = $con->prepare("SELECT * FROM $tabla ORDER  BY $campo ASC");
    $stmt->execute();
    $selec = '';
    $selec = '<option value="0" selected>Seleccione una Opcion</option>';
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as  $resp) {
        $selec = $selec . '<option value="' . $resp->$id . '">' . $resp->$campo . '</option>';
    }
    echo $selec;
    $con = Conexion::cerrar();
    $stmt = NULL;
}
function selecProyecto($tabla,$campo,$id){
    $con = Conexion::getConexion();
    $stmt = $con->prepare("SELECT * FROM $tabla WHERE id_cliente is not null ORDER  BY $campo ASC");
    $stmt->execute();
    $selec = '';
    $selec = '<option value="0" selected>Seleccione una Opcion</option>';
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as  $resp) {
        $selec = $selec . '<option value="' . $resp->$id . '">' . $resp->$campo . '</option>';
    }
    echo $selec;
    $con = Conexion::cerrar();
    $stmt = NULL;
}


function selectDependiente($tabla,$idpadre,$campo,$id){
    $con = Conexion::getConexion();
    $stmt = $con->prepare("SELECT * FROM $tabla  WHERE id_pais = :idpais ORDER  BY $campo ASC");
    $stmt->bindParam(":idpais",$idpadre);
    
    $stmt->execute();
    $selec = '';
    $selec = '<option value="0" selected>Seleccione una Opcion</option>';
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as  $resp) {
        $selec = $selec . '<option value="' . $resp->$id . '">' . $resp->$campo . '</option>';
    }
    echo $selec;
    $con = Conexion::cerrar();
    $stmt = NULL;
}


function destiOrigen($tabla,$idpadre,$campo,$id){
    $con = Conexion::getConexion();
    $stmt = $con->prepare("SELECT * 
                                FROM $tabla  
                            WHERE id_pais = :idpais AND
                                id_sucursal = :id_sucursal
                            ORDER  BY $campo ASC");

    $stmt->bindParam(":idpais",$idpadre);
    $stmt->bindParam(":id_sucursal",$_SESSION['idsucursal']);

    $stmt->execute();
    $selec = '';
    $selec = '<option value="0" selected>Seleccione una Opcion</option>';
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as  $resp) {
        $selec = $selec . '<option value="' . $resp->$id . '">' . $resp->$campo . '</option>';
    }
    echo $selec;
    $con = Conexion::cerrar();
    $stmt = NULL;
}


function cuentaBancosMov($idpadre){
    $con = Conexion::getConexion();
    $stmt = $con->prepare("SELECT C.idcuenta_bancaria,
                            C.nombre,
                            C.numero_cuenta,
                            M.signo
                                FROM cuentabancaria AS C INNER JOIN 
                                    moneda AS M ON M.id_moneda = C.id_moneda
                            WHERE id_banco = :idbanco");
    
    $stmt->bindParam(":idbanco",$idpadre);
    $stmt->execute();
    $selec = '';
    $selec = '<option value="0" selected>Seleccione una Opcion</option>';
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as  $resp) {
        $selec = $selec . '<option value="' . $resp->idcuenta_bancaria . '">' . $resp->nombre ." - ".$resp->signo. '</option>';
    }
    echo $selec;
    $con = Conexion::cerrar();
    $stmt = NULL; 
}
function equipos(){
    $con = Conexion::getConexion();
    $stmt = $con->prepare("SELECT * FROM equipo ORDER  BY tamano,tipo ASC");
    $stmt->execute();
    $selec = '';
    $selec = '<option value="0" selected>Seleccione una Opcion</option>';
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as  $resp) {
        $selec = $selec . '<option value="' . $resp->id_tipo_equipo . '">' . $resp->tamano .' '.$resp->tipo. '</option>';
    }
    echo $selec;
    $con = Conexion::cerrar();
    $stmt = NULL;
}

function agentes($id){
    $codigo =0;
    $tipoe = 'AE';
    $con = Conexion::getConexion();
    $stmt = $con->prepare("SELECT * 
                                FROM empresas 
                                where codigo >:codigo 
                                and Tipoe =:tipoe   and id_sucursal = :idsucursal ORDER  BY codigo ASC");
    $stmt->bindParam(":tipoe",$tipoe);
    $stmt->bindParam(":codigo",$codigo);
    $stmt->bindParam(":idsucursal",$_SESSION['idsucursal']);

    $stmt->execute();
    $selec = '';
    $selec = '<option value="0" selected>Seleccione una Opcion</option>';
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as  $resp) {
        $selec = $selec . '<option value="' . $resp->$id . '">' . $resp->codigo .'-'.$resp->Razons. '</option>';
    }
    echo $selec;
    $con = Conexion::cerrar();
    $stmt = NULL;
}
function usuario($id){
    $tabla ='Login';
    $estado = true;
    $con = Conexion::getConexion();
    $stmt = $con->prepare("SELECT * FROM $tabla where estado =:estado and id_sucursal =:idsucursal ORDER  BY nombre ASC");
    $stmt->bindParam(":estado",$estado);
    $stmt->bindParam(":idsucursal",$_SESSION['idsucursal']);
    $stmt->execute();
    $selec = '';
    $selec = '<option value="0" selected>Seleccione una Opcion</option>';
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as  $resp) {
        $selec = $selec . '<option value="' . $resp->$id . '">' . $resp->nombre. '</option>';
    }
    echo $selec;
    $con = Conexion::cerrar();
    $stmt = NULL;
}
function sucursal(){
    $json= array();
    $json['tiposucursal'] = $_SESSION['idsucursal'];
    echo json_encode($json);
}