<?php
require_once "../config/ClaseConexion.php.php";
require_once "../config/funciones.php";

$sucursal = new Sucursal();
$idsucursal= isset($_POST["idsucursal"])?$idsucursal=$_POST["idsucursal"]:$idsucursal =0;
$razons=isset($_POST['razons'])?$_POST['']:$razons = 'razons';
$nombrec=isset($_POST['nombrec'])?$_POST['']:$nombrec = 'nombrec';
$telefono=isset($_POST['Telefono'])?$_POST['Telefono']:$telefono = '';
$pais = isset($_POST['pais'])?$_POST['pais']:$pais = 0;
$identificacion=isset($_POST[''])?$_POST['']:$identificacion = '';
$direccion=isset($_POST['direccion'])?$_POST['direccion']:$direccion = '';
$logo=isset($_POST['logo'])?$_POST['logo']:$logo = '';

 

switch ($_GET["op"]){
     case 'guardaryeditar':
        if ($idsucursal==0){
            //insertar nuevos registros
            if (file_exists($_FILES['logo']['tmp_name'])|| is_uploaded_file($_FILES['logo']['tmp_name'])){
                $extension =  strtolower(pathinfo($_FILES['logo']['name'],PATHINFO_EXTENSION));
                $extension_valida = array('jpeg','jpg','gif','png');
                if (in_array($extension,$extension_valida)){
                    $logo = round(microtime(true)).'.'.$extension;
                    move_uploaded_file($_FILES['logo']['tmp_name'],"logo/".$logo);
                }
            }
            $con = Conexion::getConexion();
            $stmt = $con->prepare("INSERT INTO (razon_social,nombre_comercial,Telefono,identificacion,direccion,logo_nombre,fechaingreso) 
                                VALUES (:razon,:nombrec,:tel,:identi,:dir,:logo,:fecha)");
            $stmt->bindParam(":razons",$razons);
            $stmt->execute();

            $con = Conexion::cerrar();

        }else{
            //actualizar registros
            if (!file_exists($_FILES['logo']['tmp_name'])||!is_uploaded_file($_FILES['logo']['tmp_name'])){
                $logo = $_POST['logo_actual'];
            }else{
                $extension =  strtolower(pathinfo($_FILES['logo']['name'],PATHINFO_EXTENSION));
                $extension_valida = array('jpeg','jpg','gif','png');
                if (in_array($extension,$extension_valida)){
                    $logo = round(microtime(true)).'.'.$extension;
                    move_uploaded_file($_FILES['logo']['tmp_name'],"logo/".$logo);
                    if ($_POST['logo_actual']){
                        if (file_exists("logos/".$_POST['logo_actual'])){
                            unlink("logo/".$_POST['logo_actual']);
                        }
                    }
                }
           
            $con = Conexion::getConexion();
            $stmt = $con->prepare("UPDATE 
                            SET 
                            WHERE  ");
            $stmt->bindParam("",$razons);
            $stmt->execute();  
            $con = Conexion::cerrar();
        }
    }      
     break;
    //
    // case 'desactivar':
    // $rspt = $categoria->desactivar($idcategoria);
    // echo $rspt ? "categoria desactivada" : "No se puedo desactivar";
    //
    // break;
    //
    // case 'activar':
    // $rspt = $categoria->activar($idcategoria);
    // echo $rspt ? "categoria activada" : "No se puedo activar";
    //
    // break;
    //
    case 'mostrar':
        $con = Conexion::getConexion();
        $rspt = $con->prepare("SELECT * FROM WHERE ");
        $rspt->execute();
        $rspt->fetch(PDO::FETCH_OBJ); 
        echo json_encode($rspt);
          break;

    case 'listar':
        $rspt = $sucursal->listar();
        //se declara un array para almacenar todo el query
        $data= Array();
        foreach ($rspt as $reg) {
            $data[]=array("0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrarsucursal('.$reg->idsucursal.')" data-toggle="modal"  data-target="#modalsucursal"  ><i class="fa fa-pencil"></i></button>'.
   					'<button class="btn btn-danger" onclick="desactivar('.$reg->idsucursal.')"><i class="fa fa-close"></i></button>':

   					'<button class="btn btn-warning" onclick="mostrarsucursal('.$reg->idsucursal.')"><i class="fa fa-pencil"></i></button>'.
   					'<button class="btn btn-primary" onclick="activar('.$reg->idsucursal.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->razons,
                "2"=>$reg->nombrec,
                "3"=>$reg->telefono,
                "4"=>"Guatemala",
                "5"=>"<img src='../logos/".$reg->logo."'>",
                "6"=>"direccion",
                "7"=> $reg->estado?"Activo":"Inactivo"
            );
        }
        $results = array(
            "sEcho"=>1,//informacion para el datatable
            "iTotalRecords"=>count($data),//enviamos el total al datatable
            "iTotalDisplayRecords"=>count($data),//enviamos total de rgistror a utlizar
            "aaData"=>$data);
            echo json_encode($results);
    break;
}
?>
