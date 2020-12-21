<?php
    include_once "../inc/head.php";
    include_once "../inc/header.php";

?>
<div class="content-wrapper">
    <section class="content">

        <div id="datosusuario">
            <form action="" method="post" class="form-ventical" id="formusuario">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid box-primary">
                            <box class=" box-header with-border">
                                <h3 class="text-center">CONTROL DE USUARIOS</h3>
                            </box>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="box">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                </div>

                                <div class="panel-body">

                                    <div class="form-group">
                                        <label for="nombre">*Nombre:</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control">
                                        <input type="hidden" name="idusuario" id="idusuario">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido">*Apellido:</label>
                                        <input type="text" name="apellido" id="apellido" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">*Correo:</label>
                                        <input type="email" name="correo" id="correo" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="login">*Login:</label>
                                        <input type="text" name="acceso" id="acceso" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">*Password</label>
                                        <input type="text" name="pass" id="pass" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="sucursal">*Sucursal:</label>
                                        <select name="sucursal" id="sucursal"
                                            class="input-control selectpicker form-control" data-live-search="true">

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="depto">*Depto:</label>
                                        <select name="depto" id="depto" class="input-control selectpicker form-control"
                                            data-live-search="true">

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="puesto">*Puesto</label>
                                        <select name="puesto" id="puesto"
                                            class="input-control selectpicker form-control" data-live-search="true">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="avatar">Avatar:</label>
                                        <input type="file" name="avatar" id="avatar" class="form-control">

                                        <input type="hidden" name="avatar_actual" id="avatar_actual">
                                        <img id="avatar_muestra" src="" alt="avatar" width="150" height="120">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="button" onclick="grabarusuario()"
                                            id="grabaru">Graba
                                            <span class="fa fa-floppy-o"></span>
                                        </button>
                                        <button class="btn btn-danger" type="button" onclick="cancelar()">Cancelar
                                            <span class= "fa fa-close"></span>
                                        </button>
                                    </div>
                                    <!--  </form>-->
                                </div> <!-- panel body -->
                            </div><!-- panel -->
                        </div> <!-- box -->
                    </div> <!-- col-md-6 -->
                    <div class="col-md-7">
                        <div class="box">
                            <div class="panel panel-default">
                                <!-- Default panel contents -->
                                <div class="panel-heading"><span class="text-center">Permisos</span></div>
                                <div class="panel-body">
                                    <!--  <form action="" method="post" id="formpermisos"> -->
                                    <!-- Table -->
                                    <table class="table table-bordered table-responsive table-hover" id="tablapermisos">
                                        
                                    </table>
                                    <!--   </form> -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div> <!-- row  -->
            </form>
        </div> <!-- div datos usuario -->
        <div class="row" id="tablausuario">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class=" box-header with-border">
                        <button type="button" class="btn btn-primary" onclick="nuevousuario()">Nuevo Usuario
                            <span class="fa  fa-plus"></span>
                        </button>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body table-responsive">
                            <table class="table table-bordered table-hover table-responsive table-hover" id="Tusuarios"
                                style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Editar</th>
                                        <th>Activar/Desactivar</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Correo</th>
                                        <th>Login</th>
                                        <th>Sucursal</th>
                                        <th>Depto</th>
                                        <th>Puesto</th>
                                        <th>Avatar</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><button><span class="btn btn-warning fa fa-pencil"></span></button></td>
                                        <td><button><span class="btn btn-danger fa  fa-power-off"></span></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- col md 12 tabla-->
        </div> <!-- row de tabla usuarios -->
    </section> <!-- content -->
</div> <!-- content wraper -->
<?php
    include_once "../inc/footer.php";
    include_once "../inc/scritps.php";
?>
<script type="text/javascript" src="scritps/usuario.js"></script>