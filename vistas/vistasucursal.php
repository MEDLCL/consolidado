<?php
 require_once ("../inc/head.php");
 require_once ("../inc/header.php");
 require_once ("../modelos/pais.php");
$pais = new Pais();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <!-- <div class="container"> -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2>Sucursales</h2>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalsucursal"
                            onclick="limpiar()">Agregar Nuevo
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                        <div class="box-tools pull-right"></div>
                    </div><!-- /.box-header -->
                    <div class="panel-body table-responsive">
                        <table id="listadosucursal" class="table table-hover table-condensed table-bordered">
                            <thead>
                                <th>Aciones</th>
                                <th>Razons</th>
                                <th>Nombrec</th>
                                <th>Telefono</th>
                                <th>Pais</th>
                                <th>Logo</th>
                                <th>Direccion</th>
                                <th>Estado</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <button class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal"
                                            data-target="#modalEdicion"></button>
                                        <button class="btn btn-danger glyphicon glyphicon-remove"></button>
                                    </td>
                                    <td>razon</td>
                                    <td>nombre</td>
                                    <td>telefono</td>
                                    <td>pais</td>
                                    <td>logo</td>
                                    <td>Direccion</td>
                                    <td>Estado</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--box body-->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>
</div>
<!-- </div> -->

<div class="modal fade" id="modalsucursal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sucursal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="post" id="formsucursal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="razons" class="control-label col-md-2">Razon Social</label>
                        <div class="col-md-9">
                            <input type="hidden" name="idsucursal" id="idsucursal">
                            <input type="text" class="form-control" id="razons" name="razons"
                                placeholder="Razon social">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombrec" class="control-label col-md-2">Nombre Comercial</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="nombrec" name="nombrec"
                                placeholder="Nombre Comercial">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Telefono" class="control-label col-md-2">Telefono</label>
                        <div class="col-md-9">
                            <input type="tel" class="form-control" id="Telefono" name="Telefono" placeholder="Telefono">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Pais" class="control-label col-md-2">Pais</label>
                        <div class="col-md-9">
                            <select class="input-control selectpicker " data-live-search="true" name="pais" id="pais">
                                <?php  $pais->getPaisLista(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Telefono" class="control-label col-md-2">Telefono</label>
                        <div class="col-md-9">
                            <input type="tel" class="form-control" id="identificacion" name="identificacion" placeholder="Telefono">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="logo" class="control-label col-md-2">Logo</label>
                        <div class="col-md-3">
                            <input type="file" id="logo" name="logo" class="form-control">
                            <input type="hidden" id="logo_actual" name="logo_actual">
                            <img src="" alt="" id="logo_muestra" name="logo_muestra" width="150px" height="120px">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="direccion" class="control-label col-md-2">Direccion</label>
                        <div class="col-md-9">
                            <textarea class="form-control" rows="3" id="direccion" name="direccion"></textarea>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" id="actualizadatos">Grabar</button>
            </div>
        </div>
    </div>
</div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php
    require_once ("../inc/footer.php");
    require_once ("../inc/scritps.php");
?>

<script type="text/javascript" src="scritps/sucursal.js"></script>