<?php
    require_once  "../config/ClaseConexion.php";

class Pais
  {

public function getPaisLista(){
    $conexion = Conexion::getConexion();
    $stmt = $conexion->prepare("select idpais,nombre,iniciales from pais order by nombre asc");
    $stmt->execute();
?>
    <option value="">Seleccione un pais</option>
<?php
    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as $pais):
?>
    <option value="<?php echo $pais->idpais;?>"><?php echo $pais->nombre ."-".$pais->iniciales; ?> </option>
<?php
      endforeach;
    }
}
?>
