<?php
include_once "../config/funciones.php";
include_once "../modelos/creaMaritimo.php";

$creaMaritimo = new creaMaritimo();

$idembarquemaritimo = isset($_POST['idembarquemaritimo']) ? limpia($_POST['idembarquemaritimo']) :  0;
$idembarque = isset($_POST['idembarque']) ?  limpia($_POST['idembarque']) : 0;
$tipoIngreso = isset($_POST['tipo']) ?  limpia($_POST['tipo']) : 'N';
$idingresomaritimo= isset($_POST['idingresomaritimo']) ?  $_POST['idingresomaritimo'] : 0;

$idtipocarga = isset($_POST['tipocarga']) ? $idtipocarga = limpia($_POST['tipocarga']) : $idtipocarga = 0;
$idtiposervicio = isset($_POST['tipoServicio']) ? $idtiposervicio = limpia($_POST['tipoServicio']) : $idtiposervicio = 0;
$idcourier = isset($_POST['envioCourier']) ? $idcourier = limpia($_POST['envioCourier']) : $idcourier = 0;
$idbarco = isset($_POST['barco']) ? $idbarco = limpia($_POST['barco']) : $idbarco = 0;
$idagente = isset($_POST['agente']) ? $idagente = limpia($_POST['agente']) : $idagente = '';
$idnavage = isset($_POST['naviera']) ? $idnavage = limpia($_POST['naviera']) : $idnavage = '';
$viaje = isset($_POST['Viaje']) ? $viaje = limpia($_POST['Viaje']) : $viaje = '';
$idpaisorigen = isset($_POST['PaisOrigen']) ? $idpaisorigen = limpia($_POST['PaisOrigen']) : $idpaisorigen = 0;
$idorigen = isset($_POST['Origen']) ? $idorigen = limpia($_POST['Origen']) : $idorigen = 0;
$idpaisdestino = isset($_POST['PaisDestino']) ? $idpaisdestino = $_POST['PaisDestino'] : $idpaisdestino = 0;
$iddestino = isset($_POST['Destino']) ? $iddestino = $_POST['Destino'] : $iddestino = 0;
$idusuarioA = isset($_POST["usuarioAsignado"]) ? $idusuarioA = $_POST["usuarioAsignado"] : $idusuarioA = 0;
$cantClie = isset($_POST["cntClientes"]) ? $cantClie = $_POST["cntClientes"] : $cantClie = 0;
$observaciones = isset($_POST["obervaciones"]) ? $observaciones = $_POST["obervaciones"] : $observaciones = '';
$contenedoresM = isset($_POST['contenedores']) ? $contenedoresM = $_POST['contenedores'] : $contenedoresM = array();

$tiposDoc = isset($_POST['tipocM']) ? $tiposDoc = $_POST['tipocM'] : $tiposDoc = array();
$ventasM  = isset($_POST['idventasM']) ? $ventasM = $_POST['idventasM'] : $ventasM = array();
$clientesM = isset($_POST['clientesM']) ? $clientesM = $_POST['clientesM'] : $clientesM = array();
$orinales = isset($_POST['originalM']) ? $orinales = $_POST['originalM'] : $orinales = array();
$copias = isset($_POST['copiasM']) ? $copias = $_POST['copiasM'] : $copias = array();
$obserM = isset($_POST['obserM']) ? $obserM = $_POST['obserM'] : $obserM = array();
$numeroM = isset($_POST['nodocM']) ? $numeroM =  $_POST['nodocM'] : $numeroM = array();


$tipoDoc = isset($_POST['tipodoc']) ? $_POST['tipodoc'] : "";
$idventa  = isset($_POST['idventa']) ? $_POST['idventa'] : 0;
$cliente = isset($_POST['cliente']) ? $_POST['cliente'] : "";
$original = isset($_POST['original']) ? $_POST['original'] : 0;
$copia = isset($_POST['copia']) ? $copias = $_POST['copia'] : 0;
$obserDoc = isset($_POST['observacionesd']) ? $_POST['observacionesd'] : "";
$nodco = isset($_POST['nodco']) ? trim($_POST['nodco']) : "";
$idtipodocumentose = isset($_POST['idtipodocumentose']) ? $_POST['idtipodocumentose'] : 0;


$fechai = isset($_POST['fechaingreso']) ? $fechai =  $_POST['fechaingreso'] : $fechai = date('Y-m-d');
$archivos = isset($_FILES['CMarchivos']) ? $archivos =  $_FILES['CMarchivos'] : $archivos = array();
$iddocumento = isset($_POST['iddocumento']) ? $iddocumento =  $_POST['iddocumento'] : $iddocumento = 0;
$codigoembarque = isset($_POST['codigoMaritimo']) ? $codigoembarque =  $_POST['codigoMaritimo'] : $codigoembarque = '';


switch ($_GET['op']) {
    case 'validaMBL':
        $valida = $creaMaritimo->validaMBL($nodco);
        echo json_encode($valida);
        break;
    case 'guardaryeditar':
        //$,$, $

        if ($idembarque == 0) {
            $res = $creaMaritimo->grabar($cantClie, $idtipocarga, $idtiposervicio, $idcourier, $idbarco, $idagente, $idnavage, $viaje, $idpaisorigen, $idorigen, $idpaisdestino, $iddestino, $idusuarioA, $observaciones, $fechai, $contenedoresM, $tiposDoc, $ventasM, $clientesM, $orinales, $copias, $obserM, $numeroM, $archivos);
            echo json_encode($res);
        } else {
            // editar crea embarque
            $res = $creaMaritimo->editarE($idembarque,$idingresomaritimo ,$idtipocarga, $idbarco, $viaje, $idnavage, $idusuarioA, $idtiposervicio, $fechai, $codigoembarque, $archivos);
            echo json_encode($res);
        }

        break;
    case 'buscaEmbarque':
        $res = $creaMaritimo->buscaEmbarque($idembarque);
        echo json_encode($res);
        break;

    case 'listarEmbarque':
        $res = $creaMaritimo->listarEmbarque();
        $data = array();
        foreach ($res as $reg) {
            $data[] = array(
                "0" => '<button class="btn btn-warning btn-sm" onclick="mostrarEmbarque(' . $reg->idembarque . ')"><i class="fa fa-pencil" ></i></button>'
                    . ' <button class="btn btn-danger btn-sm" onclick="anularEmbarque(' . $reg->idembarque . ')"><i class="fa fa-trash" ></i></button>',
                "1" => $reg->fechaIngreso,
                "2" => $reg->codigoEmbarque,
                "3" => $reg->consecutivos,
                "4" => $reg->tipocarga,
                "5" => $reg->servicio,
                "6" => $reg->envio,
                "7" => $reg->barco,
                "8" => $reg->numViaje,
                "9" => $reg->NoCliente,
                "10" => $reg->Agente,
                "11" => $reg->NavAgencia,
                "12" => $reg->origen,
                "13" => $reg->destino,
                "14" => $reg->usuario,
                "15" => $reg->observaciones
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
    case 'listarCNTR':

        $tablac = "";
        $res = $creaMaritimo->listarCNTR($idembarque);
        foreach ($res as $cntr) {
            $tablac = $tablac
                . '<tr>'
                . '<td ><input type "text"  readonly name ="listacntr[]" id ="listacntr[]" value="' . $cntr->numero . '"></td>'
                . '</tr>';
        }
        echo $tablac;
        break;

    case 'grabaEditaDoc':
            if ($idtipodocumentose == 0) {
                $res = $creaMaritimo->grabarDocumento($idembarque, $idembarquemaritimo, $tipoDoc, $idventa, $cliente, $original, $copia, $obserDoc, $nodco, $tipoIngreso);
                echo json_encode($res);
            } else {
                // editar crea embarque
                $res = $creaMaritimo->editarDocumento($idtipodocumentose);
                echo json_encode($res);
            }
        break;

    case 'listarDoc':
        $tablaD = "";
        $res = $creaMaritimo->listarDocumentos($idembarque, $tipoIngreso, $idembarquemaritimo);
        foreach ($res as $reg) {
            $tablaD = $tablaD
                . '<tr id = "filad' . $reg->idtipodocumento . '">'

                . '<td ><button type = "button" class="btn btn-danger" onclick="eliminarDocumento(' . $reg->idtipodocumento . ')"><i class="fa fa-close" ></i></button></td>'
                . '<td >' . $reg->tipodocto . '</td>'
                . '<td >' . $reg->noventa . '</td>'
                . '<td >' . $reg->cliente . '</td>'
                . '<td >' . $reg->numero . '</td>'
                . '<td >' . $reg->original . '</td>'
                . '<td >' . $reg->copia . '</td>'
                . '<td >' . $reg->observaciones . '</td>'
                . '</tr>';
        }
        echo $tablaD;
        break;
    case 'listarArchivosM':
        $tablaA = "";
        $res = $creaMaritimo->listarArchivosM($idembarque);
        $contador = 0;
        $src = '';
        foreach ($res as $reg) {

            $contador = $contador + 1;
            if (file_exists($reg->ubicacion . '/' . $reg->nombre_archivo)) {
                $src = $reg->ubicacion . '/' . $reg->nombre_archivo;
            } else {
                $src = '';
            }
            $tablaA = $tablaA
                . '<tr id = "filaA' . $reg->id_archivos . '">'
                . '<td >' . $contador . '</td>'
                . '<td >' . $reg->nombre_archivo . '</td>'
                . '<td ><img src ="' . $src . '" width = "50px" height = "50px"></td>'
                . '<td ><button type = "button" class="btn btn-warning" onclick="eliminarA(' . $reg->id_archivos . ')"><i class="fa fa-close" ></i></button></td>'
                . '<td ><button type = "button" class="btn btn-success"><a href="../ajax/download.php?nombre_archivo=' . $reg->nombre_archivo . '&ubicacion=' . $reg->ubicacion . '"   style="color:#FFF;"><i class="fa fa-download" ></i> </a></button></td>'
                . '</tr>';
        }
        echo $tablaA;
        break;
    case 'eliminarD':
        $res = $creaMaritimo->eliminaDcoumento($iddocumento);
        echo $res;
        break;
    case 'AnulaEmbarque':
        $res = $creaMaritimo->anulaEmbarque($idembarque);
        echo json_encode($res);
        break;
    default:
        # code...
        break;
}

/* 

 */