<?php
require_once "../modelos/claseSucursal.php";
//require_once "../config/funciones.php";

$idsucursal= isset($_POST["idsucursal"])?$idsucursal= $_POST["idsucursal"]:$idsucursal =0;
$sucursal = new Sucursal();

switch ($_GET["op"]){
     case 'guardaryeditar':
        // if (!file_exists($_FILES["logo"]["tmp_name"] || !is_uploaded_file($_FILES["logo"]["tmp_name"])) {
        //      $imagen = "";
        // } else{
        //     $ext = explode(".",$_FILES["logo"]["tmp_name"]);
        //
        //     if ($_FILES["logo"]["tmp_name"])== "image/jpg" ||
        //         $_FILES["logo"]["tmp_name"])== "image/jpeg" ||
        //         $_FILES["logo"]["tmp_name"])== "image/png" ||)
        //     {
        //         $imagen = round(microtime(true)) . ".".end($ext);
        //         move_uploaded_file($_FILES["logo"]["tmp_name"],"../logos".$imagen);
        //     }
        // }
        // if (empty($idsucursal)){
        //     //nuevo
        // }else{
        //     //actualizar
        // }

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
        $rspt = $sucursal->mostrarPorId($idsucursal);
        echo json_encode($rspt);
          break;

    case 'listar':
        $rspt = $sucursal->listar();
        //se declara un array para almacenar todo el query
        $data= Array();
        foreach ($rspt as $reg) {
            $data[]=array("0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrarsucursal('.$reg->id_sucursal.')" data-toggle="modal"  data-target="#modalsucursal"  ><i class="fa fa-pencil"></i></button>'.
   					'<button class="btn btn-danger" onclick="desactivar('.$reg->id_sucursal.')"><i class="fa fa-close"></i></button>':

   					'<button class="btn btn-warning" onclick="mostrarsucursal('.$reg->idsucursal.')"><i class="fa fa-pencil"></i></button>'.
   					'<button class="btn btn-primary" onclick="activar('.$reg->id_sucursal.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->razon_social,
                "2"=>$reg->nombre_comercial,
                "3"=>$reg->Telefono,
                "4"=>"Guatemala",
                "5"=>"<img  src='../logos/".$reg->logo_nombre."' class = 'logotipo'>",
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
