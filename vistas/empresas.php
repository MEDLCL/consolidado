<?php
    include_once "../inc/head.php";
    include_once "../inc/header.php";

$tipoe = isset ($_GET['tipo'])?$tipoe = $_GET['tipo'] :$tipoe ='';
if ($tipoe=='agentee'){
    $tipoempresa = 'AGENTE EMBARCADOR';
} 
else if ($tipoe =='agenciac'){
    $tipoempresa = 'AGENCIA DE CCARGA';    
}else{
    $tipoempresa = "";
}

?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3><?php echo $tipoempresa ?> </h3>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalempresa"
                            onclick="">Agregar
                            Nuevo
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-condensed table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Editar</th>
                                    <th>Codigo</th>
                                    <th>Razon Social</th>
                                    <th>Nombre Comercial</th>
                                    <th>Idetentificacion</th>
                                    <th>Pais</th>
                                    <th>Direccion</th>
                                    <th>%Comision</th>
                                    <th>Tipo Comision</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th>Tel</th>
                                    <th>Fax</th>
                                    <th>Puesto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><button type="submit" class="btn btn-warning glyphicon glyphicon-pencil"
                                            data-target="" data-toggle="">
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div> <!-- box -->
            </div> <!-- columna 12 -->
        </div><!-- row -->
        <?php
    include_once "modal/modalempresa.php";
?>
    </section>
</div>

<?php
    include_once "../inc/footer.php";
    include_once "../inc/scritps.php";
?>
<script type="text/javascript" src="scritps/empresa.js"></script>
<script>
$(document).ready(function() {
    $('#tabempresa li:first-child a').tab('show')
});
</script>