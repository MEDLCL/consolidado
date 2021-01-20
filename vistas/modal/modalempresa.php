<div class="container">
<form action="" id='frmempresa'>
    <div class="row">
        <div class="modal fade" id="modalempresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="titulomodale"><?php echo $tipoempresa ?> </h4>
                    </div>
                    <div class="modal-body">
                        
                            <ul class="nav nav-tabs" id="tabempresa">
                                <li><a class="active" id="home-tab" data-toggle="tab" href="#home">Datos Generales</a></li>
                                <li><a id="contacto-tab" data-toggle="tab" href="#contactos">Contactos</a></li>
                                <!-- <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                    aria-controls="contact" aria-selected="false">Contact</a>
                            </li> -->
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active" id="home">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-7">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading"></div>
                                                <div class="panel-body">
                                                    <!-- <form class="form-horizontal"> -->
                                                    <div class="form-group">
                                                        <label for="codigo" class="control-label">Codigo:</label>
                                                        <input type="text" name="codigo" id="codigo" class="form-control" style="width:150px">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Razons" class="control-label">Razon
                                                            Social*:</label>
                                                        <input type="text" class="form-control" id="Razons" name="Razons" onkeyup="mayusculas(this)">
                                                        <input type="hidden" name="tipoE" id="tipoE">
                                                        <input type="hidden" name="idempresa" id='idempresa'>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Nombrec" class="control-label">Nombre
                                                            Comercial*:</label>
                                                        <input type="text" name="Nombrec" id="Nombrec" class="form-control" onkeyup="mayusculas(this)">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="identificacion" class="control-label">Identificacion*:</label>
                                                        <input type="text" name="identificacion" id="identificacion" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telefono" class="control-label">Telefono:</label>
                                                        <input type="text" name="telefono" id="telefono" class="form-control" onkeyup="this.value=numeroTelefono(this.value)" >
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="direccion" class="control-label">Direccion*:</label>
                                                        <textarea class="form-control" id="direccion" name="direccion" rows="3" onkeyup="mayusculas(this)"></textarea>
                                                    </div>
                                                    <!-- </form> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3" id="consignadoa">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading"></div>
                                                <div class="panel-body">
                                                    <!-- <form class="form-horizontal"> -->

                                                    <div class="form-group">
                                                        <label for="comision" class="control-label">% Comision</label>
                                                        <input type="number" name="comision" id="comision" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cbm" class="control-label">
                                                            <input type="radio" name="cbmtarifa" id="cbm" value="cbm">
                                                            Por CBM:</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tarifa" class="control-label">
                                                            <input type="radio" name="cbmtarifa" id="tarifa" value="tarifa">
                                                            Por TARIFA:</label>
                                                    </div>
                                                    <!-- </form> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contactos">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                </div>
                                                <div class="panel-body">
                                                    <!-- <form role="form"> -->
                                                    <div class="form-group">
                                                        <label for="Nombre" class="control-label">Nombre:</label>
                                                        <input type="text" name="Nombre" id="Nombre" class="form-control" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Apellido" class="control-label">Apellido:</label>
                                                        <input type="text" name="Apellido" id="Apellido" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Correo" class="control-label">Correo:</label>
                                                        <input type="email" name="Correo" id="Correo" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telefono" class="control-label">Telefono:</label>
                                                        <input type="text" name="telefonoc" id="telefonoc" class="form-control" onkeyup="this.value=numeroTelefono(this.value)" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="puesto" class="control-label">Puesto:</label>
                                                        <input type="text" name="puesto" id="puesto" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-offset-3">
                                                        <button type="button" class="btn btn-large btn-success" onclick="registrarc()">Registrar</button>
                                                    </div>
                                                    <!-- </form> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="panel-body table-responsive">
                                                <table class="table table-condensed table-hover table-bordered" id="Tcontactos">
                                                    <thead>
                                                        <th>Aciones</th>
                                                        <th>Nombre</th>
                                                        <th>Apellido</th>
                                                        <th>Correo</th>
                                                        <th>Telefono</th>
                                                        <th>Puesto</th>
                                                    </thead>
                                                    <tbody id="tbodyC">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> <!-- col md 8 tabla -->
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="grabareditar()">Grabar</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div><!-- row -->
    </form>
</div><!-- contenedor -->