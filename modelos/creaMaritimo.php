<?php
session_start();
include_once "../config/Conexion.php";
class creaMaritimo
{

    public function __construct()
    {
    }
    public function validaMBL($nodco){
        $json = array();
        $con = Conexion::getConexion();
        try {
            $rsp = $con->prepare("SELECT * FROM masterbl WHERE NMBL= :NMBL");
            $rsp->bindParam(":NMBL", $nodco);
            $rsp->execute();
            $rsp = $rsp->fetch(PDO::FETCH_OBJ);
            if ($rsp) {
                
                $json['idtipodocumento'] = -1;
                $json['mensaje'] = "";
            } else {
                $json['idtipodocumento'] = -2;
                $json['mensaje'] = "";
            }
        } catch (\Throwable $th) {
                $json['idtipodocumento'] = -2;
                $json['mensaje'] = "";
        }
        return $json;
    }

    public function grabar($cantClie, $idtipocarga, $idtiposervicio, $idcourier, $idbarco, $idagente, $idnavage, $viaje, $idpaisorigen, $idorigen, $idpaisdestino, $iddestino, $idusuarioA, $observaciones, $fechai, $contenedoresM, $tiposDoc, $ventasM, $clientesM, $orinales, $copias, $obserM, $numeroM, $archivos)
    {
        $fechai = date("Y-m-d", strtotime($fechai));
        $con = Conexion::getConexion();
        $anio = date("Y", strtotime($fechai)); //date_format($fechai, "Y");
        $anio2 = date("y", strtotime($fechai)); //date_format($fechai, "y");
        $fechamodi = date("Y-m-d");
        $mes = date("m", strtotime($fechai)); //date($fechai, "m");
        $codigoEmbarque = '';
        $consecutivo = '';
        $codigoA = '';
        $cant = 0;
        $cntConsecutivo = 0;
        $inicialPaisD = '';
        $tipoEmbarque = 'M';
        $idembarque = 0;
        $dirsucursal = '../' . $_SESSION['codigoS'];
        $tipoIngreso = 'N';

        try {
            $con->beginTransaction();
            //traendo el contador del agente
            $rsp = $con->prepare("SELECT MAX(correlativo)as Cant FROM correlativoAgente WHERE  id_sucursal = :idsucursal AND id_agente = :idagente AND anio = :anio");
            $rsp->bindParam(":idsucursal", $_SESSION["idsucursal"]);
            $rsp->bindParam(":idagente", $idagente);
            $rsp->bindParam(":anio", $anio);
            $rsp->execute();
            $rsp = $rsp->fetch(PDO::FETCH_OBJ);

            $cant = $rsp->Cant;
            $cant = $cant + 1;

            //traendo el codigo del agente
            $rsp = $con->prepare("SELECT codigo  FROM empresas WHERE  id_empresa = :idempresa");
            $rsp->bindParam(":idempresa", $idagente);
            $rsp->execute();
            $rsp = $rsp->fetch(PDO::FETCH_OBJ);

            $codigoA = $rsp->codigo;

            //traendo consecutivo 
            $rsp = $con->prepare("SELECT MAX(contador) as contador  
                                        FROM consecutivos 
                                    WHERE  id_sucursal = :idsucursal AND mes = :mes 
                                            AND  anio = :anio");

            $rsp->bindParam(":idsucursal", $_SESSION["idsucursal"]);
            $rsp->bindParam(":mes", $mes);
            $rsp->bindParam(":anio", $anio);
            $rsp->execute();
            $rsp = $rsp->fetch(PDO::FETCH_OBJ);
            $cntConsecutivo = $rsp->contador;

            $cntConsecutivo = $cntConsecutivo + 1;
            $consecutivo = $mes . '.' . $cntConsecutivo . '.' . $anio2;
            //traendo iniciales pais destino 

            $rsp = $con->prepare("SELECT iniciales  FROM pais WHERE  idpais = :idpais");
            $rsp->bindParam(":idpais", $idpaisdestino);
            $rsp->execute();
            $rsp = $rsp->fetch(PDO::FETCH_OBJ);

            $inicialPaisD = $rsp->iniciales;

            $codigoEmbarque = $_SESSION["CodigoArea"] . '.' . $codigoA . '.' . $cant . '.' . $anio2 . '.' . $inicialPaisD;
            $tipomedio = 1;
            $rspt = $con->prepare("INSERT INTO ingresoembarque (id_usuario,id_sucursal,CodigoEmbarque,idTipoMedio,idTipoCarga,idTipoServicio,idTipoDocsR,NoCliente,idUsuarioAsignado,IdUsuarioModifica,fechaModificacion,observaciones,consecutivos,tipo)
                            values(:idusuario,:idsucursal,;CodigoEmbarque,:idTipoMedio,:idtipocarga,:idtiposervicio,:idcourier,NoCliente,:idusuarioasignado,:IdUsuarioModifica,:fechaModificacion,:observaciones,:consecutivos,:tipo)");

            $rspt->bindParam(":idusuario", $_SESSION['idusuario']);
            $rspt->bindParam(":idsucursal", $_SESSION['idsucursal']);
            $rspt->bindParam(":CodigoEmbarque", $codigoEmbarque);
            $rspt->bindParam(":idTipoMedio", $tipomedio);
            $rspt->bindParam(":idtipocarga", $idtipocarga);
            $rspt->bindParam(":idtiposervicio", $idtiposervicio);
            $rspt->bindParam(":idcourier", $idcourier);
            $rspt->bindParam(":NoCliente", $cantClie);
            $rspt->bindParam(":idusuarioasignado", $idusuarioA);
            $rspt->bindParam(":IdUsuarioModifica", $_SESSION['idusuario']);
            $rspt->bindParam(":fechaModificacion", $fechamodi);
            $rspt->bindParam(":observaciones", $observaciones);
            $rspt->bindParam(":consecutivos", $consecutivo);
            $rspt->bindParam(":tipo", $tipoIngreso);
            $rspt->execute();

            if ($rspt) {
                $idembarque = $con->lastInsertId();
                
                $rspt = $con->prepare("INSERT INTO ingresomaritimo (id_usuario,id_sucursal,idBarco,numViaje,idNavOAgC,idAgenteEmbarcador,idOrigen,idDestino,idUsuarioAsignado,idUsuario,idIngresoEmbarque,fechaModificacion,idpaisorigen,)
                                values(:idusuario,:idsucursal,:idBarco,:numViaje,:idNavOAgC,:idAgenteEmbarcador,:idOrigen,idDestino,:idUsuarioAsignado,:idUsuario,:idIngresoEmbarque,:fechaModificacion,:idpaisorigen,:idpaisdestino)");

                $rspt->bindParam(":idusuario", $_SESSION['idusuario']);
                $rspt->bindParam(":idsucursal", $_SESSION['idsucursal']);
                $rspt->bindParam(":idBarco", $idbarco);
                $rspt->bindParam(":numViaje", $viaje);
                $rspt->bindParam(":idNavOAgC", $idnavage);
                $rspt->bindParam(":idAgenteEmbarcador", $idagente);
                $rspt->bindParam(":idOrigen", $idorigen);
                $rspt->bindParam(":idDestino", $iddestino);
                $rspt->bindParam(":idUsuarioAsignado",  $_SESSION['idusuario']);
                $rspt->bindParam(":idUsuario",  $_SESSION['idusuario']);
                $rspt->bindParam(":idIngresoEmbarque", $idembarque);
                $rspt->bindParam(":fechaModificacion", $fechamodi);
                $rspt->bindParam(":idpaisorigen", $idpaisorigen);
                $rspt->bindParam(":idpaisdestino", $idpaisdestino);
                
                $cont = 0;
                if (count($contenedoresM) > 0) {
                    $rspt = $con->prepare("INSERT INTO contenedor(numero,id_embarque)
                                            VALUES (:numero,:idembarque)");
                    // $contador = count($contenedoresM);
                    //echo $contador;
                    while ($cont < count($contenedoresM)) {
                        $rspt->bindParam(":numero", $contenedoresM[$cont]);
                        $rspt->bindParam(":idembarque", $idembarque);
                        $rspt->execute();
                        $cont++;
                    }
                }
                // tipos de documento ````
                if (count($tiposDoc) > 0) {
                    $contdoc = 0;

                    $rspt = $con->prepare("INSERT INTO tipodocumento(idingresoembarque, tipodocto, numero, original, copia, tipoembarque, idventa, observaciones, id_sucursal,:tipo)
                    VALUES (:idembarque,:tipodocto,:numero,:original,:copia,:tipoembarque,:idventa,:observaciones,:id_sucursal,:tipo)");

                    while ($contdoc < count($tiposDoc)) {
                        $rspt->bindParam(":idembarque", $idembarque);
                        $rspt->bindParam(":tipodocto", $tiposDoc[$contdoc]);
                        $rspt->bindParam(":numero", $numeroM[$contdoc]);
                        $rspt->bindParam(":original",$orinales[$contdoc]);
                        $rspt->bindParam(":copia", $copias[$contdoc]);
                        $rspt->bindParam(":tipoembarque", $tipoEmbarque);
                        $rspt->bindParam(":idventa", $ventasM[$contdoc]);
                        $rspt->bindParam(":observaciones", $obserM[$contdoc]);
                        $rspt->bindParam(":original", $orinales[$contdoc]);
                        $rspt->bindParam(":id_sucursal", $_SESSION['idsucursal']);
                        $rspt->bindParam(":tipo", $tipoIngreso);
                        
                        $rspt->execute();
                        $contdoc++;
                    }
                }
                //numero de master bl
                if (count($tiposDoc) > 0) {
                    $contmbl = 0;
                    $rspt = $con->prepare("INSERT INTO masterbl(nombl,id_embarque)
                    VALUES (:numero,:idembarque)");

                    while ($contmbl < count($tiposDoc)) {
                        if ($tiposDoc[$contmbl] == 'MBL') {
                            $rspt->bindParam(":numero", $tiposDoc[$contmbl]);
                            $rspt->bindParam(":idembarque", $idembarque);
                            $rspt->execute();
                        }
                        $contmbl++;
                    }
                }
                //numeros de hbl 
                if (count($tiposDoc) > 0) {
                    $conthbl = 0;
                    $rspt = $con->prepare("INSERT INTO housebl(nohbl,id_embarque,id_venta,cliente)
                    VALUES (:numero,:idembarque,:idventa,:cliente)");

                    while ($conthbl < count($tiposDoc)) {
                        if ($tiposDoc[$conthbl] == 'HBL') {
                            $rspt->bindParam(":numero", $tiposDoc[$conthbl]);
                            $rspt->bindParam(":idembarque", $idembarque);
                            $rspt->bindParam(":idventa", $ventasM[$conthbl]);
                            $rspt->bindParam(":cliente", $clientesM[$conthbl]);
                            $rspt->execute();
                        }
                        $conthbl++;
                    }
                }

                //contador codigo embarque
                $rspt = $con->prepare("INSERT INTO correlativoagente(id_sucursal,id_agente,correlativo,anio)
                                        VALUES (:idsucursal,:idagente,:correlativo,:anio)");

                $rspt->bindParam(":idsucursal", $_SESSION["idsucursal"]);
                $rspt->bindParam(":idagente", $idagente);
                $rspt->bindParam(":correlativo", $cant);
                $rspt->bindParam(":correlativo", $cant);
                $rspt->bindParam(":anio", $anio);
                $rspt->execute();

                // consecutivos codigo embarque `id_sucursal````anio``contador`
                $rspt = $con->prepare("INSERT INTO consecutivos(id_sucursal,mes,anio,contador)
                                VALUES (:idsucursal,:mes,:anio,:contador)");
                $rspt->bindParam(":idsucursal", $_SESSION["idsucursal"]);
                $rspt->bindParam(":mes", $mes);
                $rspt->bindParam(":anio", $anio);
                $rspt->bindParam(":contador", $cntConsecutivo);
                $rspt->execute();
                // subir los archivos y crear el embarque 

                $diranio = $dirsucursal . '/' . $anio;
                if (!file_exists($dirsucursal)) {
                    mkdir($dirsucursal, 0777);
                }

                if (!file_exists($diranio)) {
                    mkdir($diranio, 0777);
                }

                $dirembarque = $diranio . '/Embarques';

                if (!file_exists($dirembarque)) {
                    mkdir($dirembarque, 0777);
                }
                $dirmaritimo = $dirembarque . '/Maritimo';

                if (!file_exists($dirmaritimo)) {
                    mkdir($dirmaritimo, 0777);
                }

                $dirimpor = $dirmaritimo . '/Importacion';
                $direxpor = $dirmaritimo . '/Exportacion';
                if ($idtiposervicio == 1) {
                    if (!file_exists($dirimpor)) {
                        mkdir($dirimpor, 0777);
                        $directorio = $dirimpor . '/' . $codigoEmbarque;
                    } else {
                        $directorio = $dirimpor . '/' . $codigoEmbarque;
                    }
                } else {
                    if (!file_exists($direxpor)) {
                        mkdir($direxpor, 0777);
                        $directorio = $direxpor . '/' . $codigoEmbarque;
                    } else {
                        $directorio = $direxpor . '/' . $codigoEmbarque;
                    }
                }
                if (!file_exists($directorio)) {
                    mkdir($directorio, 0777);
                }

                foreach ($archivos['tmp_name'] as $key => $tmp_name) {
                    //Validamos que el archivo exista
                    if ($archivos["name"][$key]) {
                        $filename = $archivos["name"][$key]; //Obtenemos el nombre original del archivo
                        $source = $archivos["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo

                        $dir = opendir($directorio); //Abrimos el directorio de destino
                        $target_path = $directorio . '/' . $filename; //Indicamos la ruta de destino, así como el nombre del archivo

                        //Movemos y validamos que el archivo se haya cargado correctamente
                        //El primer campo es el origen y el segundo el destino
                        if (move_uploaded_file($source, $target_path)) {
                            //archivo movido al directorio indicado
                            //````````
                            $rspt = $con->prepare("INSERT INTO archivos_embarques(id_embarque,tipo_e,nombre_archivo,ubicacion)
                        VALUES (:id_embarque,:tipo_e,:nombre_archivo,:ubicacion)");
                            $rspt->bindParam(":id_embarque", $idembarque);
                            $rspt->bindParam(":tipo_e", $tipoEmbarque);
                            $rspt->bindParam(":nombre_archivo", $filename);
                            $rspt->bindParam(":ubicacion", $directorio);
                            $rspt->execute();
                        } else {
                            //echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                        }
                        //include($_SERVER['DOCUMENT_ROOT']."/config.php");

                        closedir($dir); //Cerramos el directorio de destino
                    }
                }
            }

            $con->commit();
            //$con = Conexion::cerrar();
            $json = array();
            $json['idembarque'] = $idembarque;
            $json['codigo'] = $codigoEmbarque;
            $json['consecutivo'] = $consecutivo;
            $json["mensaje"] = "Embarque Ingresado con exito";
            return $json;
        } catch (\Throwable $th) {
            $con->rollBack();
            if (file_exists('../embarques/Maritimo/' . $codigoEmbarque)) {
                unlink("../embarques/Maritimo/" . $codigoEmbarque);
            }
            //$con = Conexion::cerrar();
            $json = array();
            $json['idembarque'] = 0;
            $json['mensaje'] = 'Error al ingresar Embarque ' . $th->getMessage();
        }
    }

    public function editarE($idembarque,$idingresomaritimo ,$idtipocarga, $idbarco, $viaje, $idnavage, $idusuarioA, $idtiposervicio, $fechai, $codigoEmbarque, $archivos)
    {

        $con = Conexion::getConexion();
        try {
            $con->beginTransaction();
            $rspt = $con->prepare("UPDATE 
                                    WHERE ");
            
            $rspt->bindParam(":id_embarque_maritimo", $idembarque);
            $rspt->execute();
            $con->commit();
            //$con = Conexion::cerrar();

            // subir los archivos y crear el embarque 
            $fechai = date("Y-m-d", strtotime($fechai));
            $anio = date("Y", strtotime($fechai)); //date_format($fechai, "Y");
            $tipoEmbarque = 'M';


            $dirsucursal = '../' . $_SESSION['codigoS'];
            $diranio = $dirsucursal . '/' . $anio;

            if (!file_exists($dirsucursal)) {
                mkdir($dirsucursal, 0777);
            }

            if (!file_exists($diranio)) {
                mkdir($diranio, 0777);
            }

            $dirembarque = $diranio . '/Embarques';

            if (!file_exists($dirembarque)) {
                mkdir($dirembarque, 0777);
            }
            $dirmaritimo = $dirembarque . '/Maritimo';

            if (!file_exists($dirmaritimo)) {
                mkdir($dirmaritimo, 0777);
            }

            $dirimpor = $dirmaritimo . '/Importacion';
            $direxpor = $dirmaritimo . '/Exportacion';
            if ($idtiposervicio == 1) {
                if (!file_exists($dirimpor)) {
                    mkdir($dirimpor, 0777);
                    $directorio = $dirimpor . '/' . $codigoEmbarque;
                } else {
                    $directorio = $dirimpor . '/' . $codigoEmbarque;
                }
            } else {
                if (!file_exists($direxpor)) {
                    mkdir($direxpor, 0777);
                    $directorio = $direxpor . '/' . $codigoEmbarque;
                } else {
                    $directorio = $direxpor . '/' . $codigoEmbarque;
                }
            }
            if (!file_exists($directorio)) {
                mkdir($directorio, 0777);
            }
            if (!empty($emptyArray)) {
                foreach ($archivos['tmp_name'] as $key => $tmp_name) {
                    //Validamos que el archivo exista
                    if ($archivos["name"][$key]) {
                        $filename = $archivos["name"][$key]; //Obtenemos el nombre original del archivo
                        $source = $archivos["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo

                        $dir = opendir($directorio); //Abrimos el directorio de destino
                        $target_path = $directorio . '/' . $filename; //Indicamos la ruta de destino, así como el nombre del archivo

                        //Movemos y validamos que el archivo se haya cargado correctamente
                        //El primer campo es el origen y el segundo el destino
                        if (move_uploaded_file($source, $target_path)) {
                            //archivo movido al directorio indicado
                            //````````
                            $rspt = $con->prepare("INSERT INTO archivos_embarques(id_embarque,tipo_e,nombre_archivo,ubicacion)
                                VALUES (:id_embarque,:tipo_e,:nombre_archivo,:ubicacion)");
                            $rspt->bindParam(":id_embarque", $idembarque);
                            $rspt->bindParam(":tipo_e", $tipoEmbarque);
                            $rspt->bindParam(":nombre_archivo", $filename);
                            $rspt->bindParam(":ubicacion", $directorio);
                            $rspt->execute();
                        } else {
                            //echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                        }
                        //include($_SERVER['DOCUMENT_ROOT']."/config.php");

                        closedir($dir); //Cerramos el directorio de destino
                    }
                }
            }
            $json = array();
            $json['idembarque'] = $idembarque;
            $json['mensaje'] = "Embarque Actualizado con exito";
            return $json;
        } catch (\Throwable $th) {
            $con->rollBack();
            //$con = Conexion::cerrar();
            $json = array();
            $json['idembarque'] = 0;
            $json['mensaje'] = 'Se ha producido un error ' . $th->getMessage();
            return $json;
        }
    }

    public function buscaEmbarque($idembarque)
    {
        $con = Conexion::getConexion();
        try {
            $rsp = $con->prepare("call prcBuscaEmbarqueMaritimo(:idembarque);");
            $rsp->bindParam(":idembarque", $idembarque);
            $rsp->execute();
            $rsp = $rsp->fetch(PDO::FETCH_OBJ);
            return $rsp;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function listarEmbarque()
    {
        $con = Conexion::getConexion();
        try {
            $rsp = $con->prepare("call prcListadoCreaMaritimo(:idsucursal);");
            $rsp->bindParam(":idsucursal", $_SESSION['idsucursal']);
            $rsp->execute();
            $rsp = $rsp->fetchAll(PDO::FETCH_OBJ);
            return $rsp;
        } catch (\Throwable $th) {
            return 0;
        }
    }

// area de contenedores
    public function listarCNTR($idembarque,$tipoIngreso)
    {
        $con = Conexion::getConexion();
        try {
            $rsp = $con->prepare("SELECT * FROM contenedor WHERE id_embarque= :id_embarque");
            $rsp->bindParam(":id_embarque", $idembarque);
            $rsp->execute();
            $rsp = $rsp->fetchAll(PDO::FETCH_OBJ);
            if ($rsp) {
                return $rsp;
            } else {
                return array();
            }
        } catch (\Throwable $th) {
            return 0;
        }
    }
// area de documentos 
    public function grabarDocumento($idembarque,$idembarquemaritimo,$tipoDoc,$idventa,$cliente,$original,$copia,$obserDoc,$nodco,$tipoIngreso){
        $con = Conexion::getConexion();
        $tipo = 'M';
        $correlativo =0;
        $idemb =0;
        
        if ($tipoIngreso== 'A'){
            $idemb = $idembarquemaritimo;
        }else{
            $idemb = $idembarque;
        }

        try {
            $con->beginTransaction();
            $stmt = $con->prepare("INSERT INTO tipodocumento(idingresoembarque,tipodocto,numero,original,copia,tipoembarque,correlativo,idventa,observaciones,cliente,tipo,id_sucursal)
            VALUES (:idingresoembarque,:tipodocto,:numero,:original,:copia,:tipoembarque,:correlativo,:idventa,:observaciones,:cliente,:tipo,:id_sucursal)");
            $stmt->bindParam(":idingresoembarque", $idemb);
            $stmt->bindParam(":tipodocto", $tipoDoc);
            $stmt->bindParam(":numero", $nodco);
            $stmt->bindParam(":original", $original);
            $stmt->bindParam(":copia", $copia);
            $stmt->bindParam(":tipoembarque", $tipo);
            $stmt->bindParam(":correlativo", $correlativo);
            $stmt->bindParam(":idventa", $idventa);
            $stmt->bindParam(":observaciones", $obserDoc);
            $stmt->bindParam(":cliente", $cliente);
            $stmt->bindParam(":tipo", $tipoIngreso);
            $stmt->bindParam(":id_sucursal", $_SESSION['idsucursal']);
            $stmt->execute();

            if ($stmt) {
                $json = array();
                $json['idtipodocumento'] = $con->lastInsertId();
                $json['mensaje'] = "Operacion Insertada con Exito";
            }
            $con->commit();
            return $json;
        } catch (\Throwable $th) {
            $json = array();
            $json['idtipodocumento'] = 0;
            $json['mensaje'] = "Error al insertar el Documento " . $th->getMessage();
            return $json;
        }
    }

    public function editarDocumento(){
        $con = Conexion::getConexion();
        try {
            $rsp = $con->prepare("UPDATE asigna_unidad_proyecto 
                                    SET 
                                        id_tipo_unidad=:tipounidad,
                                        id_tipo_equipo=:tipoequipo,
                                        cantidad_unidad= :cantunidad,
                                        temperatura=:temperatura,
                                        especificacion=:especificacion,
                                        id_seguridad=:seguridad,
                                        id_marchamo=:marchamo,
                                        id_gps=:gps,
                                        lugar_carga=:lugarcarga,
                                        lugar_descarga=:lugardescarga,
                                        id_canal_distribucion=:canaldistribucion
                    WHERE id_asigna_unidad=:idasignaunidad");

            $rsp->bindParam(":tipounidad", $tipoUnida);
            $rsp->bindParam(":tipoequipo", $tipoEquipo);
            $rsp->bindParam(":cantunidad", $cantUnidad);
            $rsp->bindParam(":temperatura", $temperatura);
            $rsp->bindParam(":especificacion", $caracEquipo);
            $rsp->bindParam(":seguridad", $seguridad);
            $rsp->bindParam(":marchamo", $marchamo);
            $rsp->bindParam(":gps", $gps);
            $rsp->bindParam(":lugarcarga", $lugarCargaPro);
            $rsp->bindParam(":lugardescarga", $lugarDescargaPro);
            $rsp->bindParam(":canaldistribucion", $canalDistribucionPro);
            $rsp->bindParam(":idasignaunidad", $idtipounidadtransporte);

            $rsp->execute();
            if ($rsp !== false) {
                $json = array();
                $json['idunidadasingada'] = $idtipounidadtransporte;
                $json['mensaje'] = "Unidad Actualizado con exito";
                return $json;
            } else {
                $json = array();
                $json['idunidadasingada'] = 0;
                $json['mensaje'] = "Error al actualizar Unidad ";
                return $json;
            }
        } catch (\Throwable $th) {
            $json = array();
            $json['idcuenta'] = 0;
            $json['mensaje'] = "Error al actualizar Unidad " . $th->getMessage();
            return $json;
            //return $th->getMessage();
        }
    }

    public  function listarDocumentos($idembarque,$tipoIngreso,$idembarquemaritimo)
    {
        if ($tipoIngreso== 'A'){
            $idemb = $idembarquemaritimo;
        }else{
            $idemb = $idembarque;
        }
        $tipoe = 'M';
        try {
            $con = Conexion::getConexion();
            $rspt = $con->prepare("call prclistadoDocEmbarque(:idembarque, :tipoe,:tipoI);");
            $rspt->bindParam(":idembarque", $idemb);
            $rspt->bindParam(":tipoe", $tipoe);
            $rspt->bindParam(":tipoI", $tipoIngreso);
            $rspt->execute();
            $rspt = $rspt->fetchAll(PDO::FETCH_OBJ);
            if ($rspt) {
                return $rspt;
            } else {
                return array();
            }
        } catch (\Throwable $th) {
            return 0;
        }
    }


    public function eliminaDcoumento($iddocumento)
    {
        try {
            $con = Conexion::getConexion();
            $rspt = $con->prepare("DELETE FROM documentos_embarque WHERE id_documentos = :id_documentos");
            $rspt->bindParam(":id_documentos", $iddocumento);
            $rspt->execute();
            if ($rspt->rowCount() > 0) {
                return 1;
            } else {
                return array();
            }
        } catch (\Throwable $th) {
            return 0;
        }
    }

    //pendiente 
    public function listarArchivosM($idembarque)
    {
        $tipoe = 'M';
        try {
            $con = Conexion::getConexion();
            $rspt = $con->prepare("SELECT id_archivos,
                                        id_embarque,
                                        tipo_e,
                                        nombre_archivo,
                                        ubicacion
                                    FROM archivos_embarques 
                                WHERE id_embarque = :idembarque and tipo_e = :tipoe");
            $rspt->bindParam(":idembarque", $idembarque);
            $rspt->bindParam(":tipoe", $tipoe);
            $rspt->execute();
            $rspt = $rspt->fetchAll(PDO::FETCH_OBJ);
            if ($rspt) {
                return $rspt;
            } else {
                return array();
            }
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function anulaEmbarque($idembarque)
    {
        $con = Conexion::getConexion();
        $estado = 0;
        try {
            $con->beginTransaction();
            $rspt = $con->prepare("UPDATE embarque_maritimo SET
                                        estado = :estado
                                    WHERE id_embarque_maritimo = :id_embarque_maritimo");
            $rspt->bindParam(":estado", $estado);
            $rspt->bindParam(":id_embarque_maritimo", $idembarque);
            $rspt->execute();
            $con->commit();
            //$con = Conexion::cerrar();
            $json = array();
            $json['idembarque'] = $idembarque;
            return $json;
        } catch (\Throwable $th) {
            $con->rollBack();
            //$con = Conexion::cerrar();
            $json = array();
            $json['idembarque'] = 0;
            return $json;
        }
    }
}
