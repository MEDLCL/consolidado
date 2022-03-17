<?php
require_once "../config/Conexion.php";
require_once "../config/funciones.php";
require_once "../modelos/evaluacionProyecto.php";

$evaluacion = new evaluacionProyecto();

$idproyecto  = isset($_POST["idproyecto"]) ? $idproyecto = $_POST["idproyecto"] : $idproyecto = 0;
$codigoProyecto  = isset($_POST["codigoProyecto"]) ? $codigoProyecto = $_POST["codigoProyecto"] : $codigoProyecto = 0;
$idcliente  = isset($_POST["idcliente"]) ? $idcliente = $_POST["idcliente"] : $idcliente = 0;
$fechaInicio  = isset($_POST["fechainicio"]) ? $fechaInicio = $_POST["fechainicio"] : $fechaInicio = date('Y-m-d');
$fechaFinal  = isset($_POST["fechafinal"]) ? $fechaFinal = $_POST["fechafinal"] : $fechaFinal = date('Y-m-d');
$tipocargaProyecto  = isset($_POST["tipocargaProyecto"]) ? $tipocargaProyecto = $_POST["tipocargaProyecto"] : $tipocargaProyecto = 0;
$fianzaProyecto  = isset($_POST["fianzaProyecto"]) ? $fianzaProyecto = $_POST["fianzaProyecto"] : $fianzaProyecto = 0;
$pesopromedio  = isset($_POST["pesopromedio"]) ? $pesopromedio = $_POST["pesopromedio"] : $pesopromedio = 0;
$unidadMedida  = isset($_POST["unidadMedida"]) ? $unidadMedida = $_POST["unidadMedida"] : $unidadMedida = 0;
$piesCubico  = isset($_POST["piesCubico"]) ? $piesCubico = $_POST["piesCubico"] : $piesCubico = 0;
$mercaderia  = isset($_POST["mercaderia"]) ? $mercaderia = $_POST["mercaderia"] : $mercaderia = "";
$permisos  = isset($_POST["permisos"]) ? $permisos = $_POST["permisos"] : $permisos = "";
$entregasPromedio  = isset($_POST["entregasPromedio"]) ? $entregasPromedio = $_POST["entregasPromedio"] : $entregasPromedio = "";
$kilometrosPromedio  = isset($_POST["kilometrosPromedio"]) ? $kilometrosPromedio = $_POST["kilometrosPromedio"] : $kilometrosPromedio = "";
$frecuenciaViajes  = isset($_POST["frecuenciaViajes"]) ? $frecuenciaViajes = $_POST["frecuenciaViajes"] : $frecuenciaViajes = "";            

        
$seCargaPro  = isset($_POST["seCargaPro"]) ? $seCargaPro = $_POST["seCargaPro"] : $seCargaPro = 0;
$seDescargaPro  = isset($_POST["seDescargaPro"]) ? $seDescargaPro = $_POST["seDescargaPro"] : $seDescargaPro = 0;
$manejoEfectivoPro  = isset($_POST["manejoEfectivoPro"]) ? $manejoEfectivoPro = $_POST["manejoEfectivoPro"] : $manejoEfectivoPro = 0;

//para tipo de unidades 
$idtipounidadtransporte = isset($_POST["idtipounidadtransporte"]) ? $idtipounidadtransporte = $_POST["idtipounidadtransporte"] : $idtipounidadtransporte = 0;
$cantUnidad = isset($_POST["numeroUnidadesPro"]) ? $cantUnidad = $_POST["numeroUnidadesPro"] : $cantUnidad = 0;
$tipoUnida = isset($_POST['tipoUnidaPro']) ? $tipoUnida = limpia($_POST['tipoUnidaPro']) : $tipoUnida = 0;
$tipoEquipo = isset($_POST["tipoEquipoPro"]) ? $tipoEquipo = $_POST["tipoEquipoPro"] : $tipoEquipo = 0;
$temperatura = isset($_POST["temperaturaPro"]) ? $temperatura = $_POST["temperaturaPro"] : $temperatura = "";
$caracEquipo = isset($_POST['caracEquipoPro']) ? $caracEquipo = limpia($_POST['caracEquipoPro']) : $caracEquipo = "";
$seguridad = isset($_POST["cajillaSeguridadPro"]) ? $seguridad = $_POST["cajillaSeguridadPro"] : $seguridad = 0;
$marchamo = isset($_POST["marchamoPro"]) ? $marchamo = $_POST["marchamoPro"] : $marchamo = 0;
$gps = isset($_POST["gpsPro"]) ? $gps = $_POST["gpsPro"] : $gps = 0;

$lugarCargaPro = isset($_POST["lugarCargaPro"]) ? $lugarCargaPro = $_POST["lugarCargaPro"] : $lugarCargaPro = "";
$lugarDescargaPro = isset($_POST["lugarDescargaPro"]) ? $lugarDescargaPro = $_POST["lugarDescargaPro"] : $lugarDescargaPro = "";
$canalDistribucionPro = isset($_POST["canalDistribucionPro"]) ? $canalDistribucionPro = $_POST["canalDistribucionPro"] : $canalDistribucionPro = "";

$idtarifatarget = isset($_POST["idtarifatarget"]) ? $idtarifatarget = $_POST["idtarifatarget"] : $idtarifatarget = 0;
$tipounidadTarget = isset($_POST["tipounidadTarget"]) ? $tipounidadTarget = $_POST["tipounidadTarget"] : $tipounidadTarget = 0;
$fianzaTarget = isset($_POST["fianzaTarget"]) ? $lugarDesfianzaTargetcargaPro = $_POST["fianzaTarget"] : $fianzaTarget = 0;
$lugarCargaTarget = isset($_POST["lugarCargaTarget"]) ? $lugarCargaTarget = $_POST["lugarCargaTarget"] : $lugarCargaTarget = "";
$lugardescargaTarget = isset($_POST["lugardescargaTarget"]) ? $lugardescargaTarget = $_POST["lugardescargaTarget"] : $lugardescargaTarget = "";


$idserviciotarget = isset($_POST["idserviciotarget"]) ? $idserviciotarget = $_POST["idserviciotarget"] : $idserviciotarget = 0;
$servicioTarget = isset($_POST["servicioTarget"]) ? $servicioTarget = $_POST["servicioTarget"] : $servicioTarget = 0;
$lugarCargaTargetServicios = isset($_POST["lugarCargaTargetServicios"]) ? $lugarCargaTargetServicios = $_POST["lugarCargaTargetServicios"] : $lugarCargaTargetServicios = "";
$lugarDescargaTargetServicios = isset($_POST["lugarDescargaTargetServicios"]) ? $lugarDescargaTargetServicios = $_POST["lugarDescargaTargetServicios"] : $lugarDescargaTargetServicios = "";




switch ($_GET["op"]) {
    case 'guardaryeditarProyecto':
        if ($idproyecto == 0 || $idproyecto == "") {
            $resp = $evaluacion->grabar();
            echo json_encode($resp);
        } else {
            $resp = $evaluacion->editar($idproyecto,$codigoProyecto,$idcliente,$fechaInicio,$fechaFinal,$tipocargaProyecto,$fianzaProyecto,$pesopromedio,$unidadMedida,$piesCubico,$mercaderia,$permisos,$entregasPromedio,$kilometrosPromedio,$frecuenciaViajes,$seCargaPro,$seDescargaPro,$manejoEfectivoPro);
            echo json_encode($resp);
        }
        break;
    case 'listarProyectos':
        $rspt = $evaluacion->listarProyectos();
        $acciones = "";
        mb_internal_encoding('UTF-8');
        //colocar if 
        $data = array();
        foreach ($rspt as $reg) {
            
            $acciones = "<button type= 'button' class='btn btn-warning btn-sm' onclick='listarProyecto(" . $reg->idproyecto . ")' ><i class='fa fa-pencil'></i></button>" .
                " <button type= 'button' class='btn btn-danger btn-sm' onclick='eliminarUnidad(" . $reg->idproyecto . ")' ><i class='fa fa-close'></i></button>";
            $data[] = array(
                "0" => $acciones,
                "1" => $reg->codigo,
                "2" => $reg->cliente,
                "3" => $reg->fechainicio,
                "4" => $reg->fechafinal,
                "5" => $reg->tipocarga,
                "6" => $reg->Fianza,
                "7" => $reg->peso.$reg->Unidad,
                "8" => $reg->pies_cubicos,
                "9" => $reg->descripcion_mercaderia,
                "10" => $reg->permisos,
                "11" => $reg->entregas,
                "12" => $reg->recorrido,
                "13" => $reg->frecuencua,
                "14" => $reg->secarga,
                "15" => $reg->sedescarga,
                "16" => $reg->efectivo,
            );
        }
        $results = array(
            "sEcho" => 1, //informacion para el datatable
            "iTotalRecords" => count($data), //enviamos el total al datatable
            "iTotalDisplayRecords" => count($data), //enviamos total de rgistror a utlizar
            "aaData" => $data
        );
        echo json_encode($results);
        # code...
        break;
        case 'listarProyecto':
            $resp = $evaluacion->listarProyecto($idproyecto);
        echo json_encode($resp);
            break;
    case 'guardaUnidades':
        if ($idtipounidadtransporte == 0 || $idtipounidadtransporte == "") {
            $resp = $evaluacion->grabarUnidades($idproyecto, $cantUnidad, $tipoUnida, $tipoEquipo, $temperatura, $caracEquipo, $seguridad, $marchamo, $gps, $lugarCargaPro, $lugarDescargaPro, $canalDistribucionPro);
            echo json_encode($resp);
        }else {
            $resp = $evaluacion->editarUnidad($idtipounidadtransporte, $cantUnidad, $tipoUnida, $tipoEquipo, $temperatura, $caracEquipo, $seguridad, $marchamo, $gps, $lugarCargaPro, $lugarDescargaPro, $canalDistribucionPro);
            echo json_encode($resp);
        }
        break;
    case 'listarUnidad':
        $resp = $evaluacion->listaUnidad($idtipounidadtransporte);
        echo json_encode($resp);
        break;

    case 'listarUnidades':
        $rspt = $evaluacion->listarUnidades($idproyecto);
        $acciones = "";
        mb_internal_encoding('UTF-8');
        //colocar if 
        $data = array();
        foreach ($rspt as $reg) {
            
            $acciones = "<button type= 'button' class='btn btn-warning btn-sm' onclick='listarUnidad(" . $reg->id_asigna_unidad . ")' ><i class='fa fa-pencil'></i></button>"; 
               // " <button type= 'button' class='btn btn-danger btn-sm' onclick='eliminarUnidad(" . $reg->id_asigna_unidad . ")' ><i class='fa fa-close'></i></button>";
            $data[] = array(
                "0" => $acciones,
                "1" => $reg->cantidad_unidad,
                "2" => $reg->unidad,
                "3" => $reg->Equipo,
                "4" => $reg->temperatura,
                "5" => $reg->especificacion,
                "6" => $reg->seguridad,
                "7" => $reg->marchamo,
                "8" => $reg->gps,
                "9" => $reg->lugar_carga,
                "10" => $reg->lugar_descarga,
                "11" => $reg->canal_distrbucion
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

    case 'guardaTarifasT':
        if ($idtarifatarget==0 || $idtarifatarget ==""){
            $rspt = $evaluacion->grabarTarifaTarget($idproyecto,$tipounidadTarget,$fianzaTarget,$lugarCargaTarget,$lugardescargaTarget);
        }else{
            $rspt = $evaluacion->editarTarifaTarget($idtarifatarget,$tipounidadTarget,$fianzaTarget,$lugarCargaTarget,$lugardescargaTarget);
        }
            echo json_encode($rspt);
        break;

    case 'listarTarifa':
        $rsp = $evaluacion->listarTarifaTarget($idtarifatarget);
        echo json_encode($rsp);
        break;
    case 'listarTarifasT':
        $rspt = $evaluacion->listarTarifasTarget($idproyecto);
        $acciones = "";
        mb_internal_encoding('UTF-8');
        //colocar if 
        $data = array();
        foreach ($rspt as $reg) {
            
            $acciones = "<button type= 'button' class='btn btn-warning btn-sm' onclick='listaTarifa(" . $reg->idtarifa_target . ")' ><i class='fa fa-pencil'></i></button>"; 
                //" <button type= 'button' class='btn btn-danger btn-sm' onclick='eliminarUnidad(" . $reg->idtarifa_target . ")' ><i class='fa fa-close'></i></button>";
            $data[] = array(
                "0" => $acciones,
                "1" => $reg->unidad,
                "2" => $reg->fianza,
                "3" => $reg->lugar_carga,
                "4" => $reg->lugar_descarga
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

        case 'grabaServicioTarget':
            if ($idserviciotarget==0 || $idserviciotarget ==""){
                $rspt = $evaluacion->grabaServicoTarget($idproyecto,$servicioTarget,$lugarCargaTargetServicios,$lugarDescargaTargetServicios);
            }else{
                $rspt = $evaluacion->editaServicioTarget($idserviciotarget,$servicioTarget,$lugarCargaTargetServicios,$lugarDescargaTargetServicios);
            }
                echo json_encode($rspt);
            break;
        case 'listarServicoTarget':
                $rsp = $evaluacion->listarServicioTarget($idserviciotarget);
            break;
        case 'listarServiosTarget':
            $rspt = $evaluacion->listarServiciosTarget($idproyecto);
            $acciones = "";
            mb_internal_encoding('UTF-8');
            //colocar if 
            $data = array();
            foreach ($rspt as $reg) {
                
                $acciones = "<button type= 'button' class='btn btn-warning btn-sm' onclick='listarServicio(" . $reg->id_servicio_target . ")' ><i class='fa fa-pencil'></i></button>"; 
                    //" <button type= 'button' class='btn btn-danger btn-sm' onclick='eliminarUnidad(" . $reg->id_servicio_target . ")' ><i class='fa fa-close'></i></button>";
                $data[] = array(
                    "0" => $acciones,
                    "1" => $reg->servicio,
                    "2" => $reg->lugar_carga,
                    "3" => $reg->lugar_descarga,
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
        
}
