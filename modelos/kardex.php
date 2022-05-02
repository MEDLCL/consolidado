<?php
session_start();
include_once "../config/Conexion.php";
class kardex
{

    public function __construct()
    {
    }
    public function grabar($idconsignado, $contenedor, $poliza, $referencia, $peso, $volumen, $bultos, $fechaI, $cantClie, $viaje)
    {
        $codigo = "";
        $mes = date("m");
        $annio = date("y");
        $fechaG = date("Y-m-d");
        $fechaI = date("Y-m-d", strtotime($fechaI));
        $con = Conexion::getConexion();
        $idkardex =0;
        try {
            $con->beginTransaction();
            $stm = $con->prepare("SELECT COUNT(contador)AS CNT FROM  correlativo_almacen 
            WHERE annio = :annio AND mes = :mes AND id_sucursal= :idsucursal");
            $stm->bindParam(":annio", $annio);
            $stm->bindParam(":mes", $mes);
            $stm->bindParam(":idsucursal", $_SESSION["idsucursal"]);
            $stm->execute();
            $stm = $stm->fetch(PDO::FETCH_OBJ);

            if ($stm) {
                $cont = $stm->CNT + 1;
                $stm = $con->prepare("INSERT INTO correlativo_almacen (annio,mes,id_sucursal,contador) 
                                VALUES (:annio,:mes,:idsucursal,:contador)");
                $stm->bindParam(":annio", $annio);
                $stm->bindParam(":mes", $mes);
                $stm->bindParam(":idsucursal", $_SESSION['idsucursal']);
                $stm->bindParam(":contador", $cont);
                $stm->execute();
                if ($stm) {
                    $idcont = $con->lastInsertId();
                    $codigo = $mes . "." . $cont . "." . $annio;
                }

            $stmt = $con->prepare("INSERT INTO almacen(id_usuario,id_sucursal,id_consignado,codigo,contenedor_placa,poliza,referencia,peso,volumen,bultos,fecha_almacen,id_usuario_modifica,fecha_modifica,cant_clientes,viaje)
            VALUES (:idusuario,:idsucursal,:idconsignado,:codigo,:contenedor,:poliza,:referencia,:peso,:volumen,:bultos,:fechaI,:idusuarioM,:fechaM,:cntClie,:viaje)");
            $stmt->bindParam(":idusuario", $_SESSION['idusuario']);
            $stmt->bindParam(":idsucursal", $_SESSION["idsucursal"]);
            $stmt->bindParam(":idconsignado", $idconsignado);
            $stmt->bindParam(":codigo", $codigo);
            $stmt->bindParam(":contenedor", $contenedor);
            $stmt->bindParam(":poliza", $poliza);
            $stmt->bindParam(":referencia", $referencia);
            $stmt->bindParam(":peso", $peso);
            $stmt->bindParam(":volumen", $volumen);
            $stmt->bindParam(":bultos", $bultos);
            $stmt->bindParam(":fechaI", $fechaI);
            $stmt->bindParam(":idusuarioM", $_SESSION["idusuario"]);
            $stmt->bindParam(":fechaM", $fechaG);
            $stmt->bindParam(":cntClie", $cantClie);
            $stmt->bindParam(":viaje", $viaje);
            $stmt->execute();

            if ($stmt) {
                $idkardex= $con->lastInsertId();
            }
        }
            $con->commit();
            $json = array();
            $json['idkardex'] = $idkardex;
            $json['codigo'] = $codigo;
            $json["mensaje"] = "File Ingresado con exito";
            return $json;
        } catch (\Throwable $th) {
            $json = array();
            $json['idkardex'] = 0;
            $json['codigo'] = "";
            $json["mensaje"] = "Error al ingresar el File ".$th->getMessage();
            return $json;
        }
    }
    public function editarAlmacen($idalmacen, $idconsignado, $contenedor, $poliza, $referencia, $peso, $volumen, $bultos, $fechaI, $cantClie)
    {
        $fechaM = date("Y-m-d");
        $fechaI = date("Y-m-d", strtotime($fechaI));
        $con = Conexion::getConexion();
        try {
            $rsp = $con->prepare("UPDATE almacen 
                    SET id_consignado=:idconsignado,
                        contenedor_placa=:contenedor,
                        poliza=:poliza,
                        referencia=:referencia,
                        peso=:peso,
                        volumen=:volumen,
                        bultos=:bultos,
                        fecha_almacen=:fechaA,
                        id_usuario_modifica=:idusuarioM,
                        fecha_modifica=:fechaM,
                        cant_clientes=:cntCli
                    WHERE id_almacen=:idalmacen");
            $rsp->bindParam(":idconsignado", $idconsignado);
            $rsp->bindParam(":contenedor", $contenedor);
            $rsp->bindParam(":poliza", $poliza);
            $rsp->bindParam(":referencia", $referencia);
            $rsp->bindParam(":peso", $peso);
            $rsp->bindParam(":volumen", $volumen);
            $rsp->bindParam(":bultos", $bultos);
            $rsp->bindParam(":fechaA", $fechaI);
            $rsp->bindParam(":idusuarioM", $_SESSION["idusuario"]);
            $rsp->bindParam(":fechaM", $fechaM);
            $rsp->bindParam(":cntCli", $cantClie);
            $rsp->bindParam(":idalmacen", $idalmacen);
            $rsp->execute();
            if ($rsp !== false) {
                return $idalmacen;
            } else {
                return 0;
            }
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public function codigo()
    {
        $codigo = "";
        $mes = date("m");
        $annio = date("y");

        $con = Conexion::getConexion();

        $stm = $con->prepare("SELECT COUNT(contador)AS CNT FROM  correlativo_almacen 
                            WHERE annio = :annio AND mes = :mes AND id_sucursal= :idsucursal");
        $stm->bindParam(":annio", $annio);
        $stm->bindParam(":mes", $mes);
        $stm->bindParam(":idsucursal", $_SESSION["idsucursal"]);
        $stm->execute();
        $stm = $stm->fetch(PDO::FETCH_OBJ);

        if ($stm) {
            $cont = $stm->CNT + 1;
            $stm = $con->prepare("INSERT INTO correlativo_almacen (annio,mes,id_sucursal,contador) 
            VALUES (:annio,:mes,:idsucursal,:contador)");
            $stm->bindParam(":annio", $annio);
            $stm->bindParam(":mes", $mes);
            $stm->bindParam(":idsucursal", $_SESSION['idsucursal']);
            $stm->bindParam(":contador", $cont);
            $stm->execute();
            if ($stm) {
                $idcont = $con->lastInsertId();
                $codigo = $mes . "." . $cont . "." . $annio;
            }
        }
        $con = Conexion::cerrar();
        return $codigo;
    }

    public function listar()
    {
        $con = Conexion::getConexion();
        try {
            $rsp = $con->prepare("CALL prcKardex(:idsucursal);");
            $rsp->bindParam(":idsucursal", $_SESSION['idsucursal']);
            $rsp->execute();
            $rsp = $rsp->fetchAll(PDO::FETCH_OBJ);
            return $rsp;
            $con = Conexion::cerrar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function muestraAlmacen($idalmacen)
    {
        $con = Conexion::getConexion();
        try {
            $rsp = $con->prepare("SELECT id_almacen,
                                        id_usuario,
                                        id_sucursal,
                                        id_consignado,
                                        codigo,
                                        contenedor_placa,
                                        poliza,
                                        referencia,
                                        peso,
                                        id_medida_peso,
                                        volumen,
                                        id_medida_volumen,
                                        bultos,
                                        cant_clientes,
                                        DATE_FORMAT(fecha_almacen, '%m/%d/%Y') as fechaI,
                                        fecha_graba,
                                        id_usuario_modifica,
                                        fecha_modifica
                                FROM almacen where id_almacen = :idalmacen");
            $rsp->bindParam(":idalmacen", $idalmacen);
            $rsp->execute();
            $rsp = $rsp->fetch(PDO::FETCH_OBJ);
            if ($rsp) {
                return $rsp;
            }
        } catch (\Throwable $th) {
            return 0;
        }
    }
}
