<?php
include_once "../config/Conexion.php";
$op = isset($_GET['op'])?$op = $_GET['op']: $op ='';



switch ($op) {
    case 'permisos':
        $tabla = '<tbody>';
        try {
           
            $con = Conexion::getConexion();
            $rspt = $con->prepare('SELECT * FROM menu WHERE id_Padre = 0');
            $rspt->execute();
            foreach ($rspt->fetchAll(PDO::FETCH_OBJ) as $menup){

                $tabla = $tabla.'<tr>'
                            .'<td>'.$menup->id_menu.'</td>'
                            .'<td>'. $menup->nombre. '</td>'
                            .'<td></td>'
                            .'<td><input type ="checkbox" name= "consultar[]" value = "'.$menup->id_menu.'" class="custom-control-input"></td>'
                            .'<td><input type ="checkbox" name= "agregar[]" value = "'.$menup->id_menu.'" class="custom-control-input" disabled></td>'
                            .'<td><input type ="checkbox" name= "editar[]" value = "'.$menup->id_menu.'" class="custom-control-input" disabled></td>'
                            .'<td><input type ="checkbox" name= "eliminar[]" value = "'.$menup->id_menu.'" class="custom-control-input" disabled></td>'
                .'</tr>';
                $rspt = $con->prepare("SELECT * FROM menu WHERE id_Padre = $menup->id_menu");
                $rspt->execute();

                foreach ($rspt->fetchAll(PDO::FETCH_OBJ)as $menui ) {
                    $tabla = $tabla.'<tr>'
                            .'<td>'.$menui->id_menu.'</td>' 
                            .'<td></td>'
                            .'<td>'. $menui->nombre. '</td>'
                            .'<td><input type ="checkbox" name= "consultar[]" value = "'.$menui->id_menu.'" class="custom-control-input"></td>'
                            .'<td><input type ="checkbox" name= "agregar[]" value = "'.$menui->id_menu.'" class="custom-control-input"></td>'
                            .'<td><input type ="checkbox" name= "editar[]" value = "'.$menui->id_menu.'" class="custom-control-input"></td>'
                            .'<td><input type ="checkbox" name= "eliminar[]" value = "'.$menui->id_menu.'" class="custom-control-input"></td>'
                .'</tr>';
                }
            }
            $tabla = $tabla.'</tbody>';
            echo $tabla;
        } catch (\Throwable $th) {
            return "No se pudo carga la tabla". $th->getMessage();
        }
        break;
    case 'guardaryeditar':
     print_r($_POST);
    
    break;

    default:
        # code...
        break;
}
?>