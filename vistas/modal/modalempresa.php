<div class="container">
    <div class="row">
        <div class="modal fade" id="modalempresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
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
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading"></div>
                                            <div class="panel-body">
                                                <form class="form-horizontal">
                                                    <div class="form-group">
                                                        <label for="codigo"
                                                            class="control-label col-md-3">Codigo:</label>
                                                        <div class="col-md-4">
                                                            <input type="text" name="codigo" id="codigo"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Razons" class="control-label col-md-3">Razon
                                                            Social:</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" id="Razons"
                                                                id="Razons">
                                                        </div>
                                                        <input type="hidden" name="idempresa" id='idempresa'>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="Nombrec" class="control-label col-md-3">Nombre
                                                            Comercial:</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="Nombrec" id="Nombrec"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="identificacion"
                                                            class="control-label col-md-3">Identificacion:</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="identificacion" id="identificacion"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telefono"
                                                            class="control-label col-md-3">Telefono:</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="telefono" id="telefono"
                                                                class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="direccion"
                                                            class="control-label col-md-3">Direccion:</label>
                                                        <div class="col-md-9">
                                                            <textarea class="form-control" id="direccion"
                                                                name="direccion" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contactos">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                            </div>
                                            <div class="panel-body">
                                                <form role="form">
                                                    <div class="form-group">
                                                        <label for="Nombre" class="control-label">Nombre:</label>
                                                        <input type="text" name="Nombre" id="Nombre"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Apellido" class="control-label">Apellido:</label>
                                                        <input type="text" name="Apellido" id="Apellido"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Correo" class="control-label">Correo:</label>
                                                        <input type="email" name="Correo" id="Correo"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telefono" class="control-label">Telefono:</label>
                                                        <input type="text" name="telefonoc" id="telefonoc"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="puesto" class="control-label">Puesto:</label>
                                                        <input type="text" name="puesto" id="puesto"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-offset-3">
                                                        <button type="button"
                                                            class="btn btn-large btn-success" onclick="registrarc()">Registrar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="panel-body table-responsive"></div>
                                        <table class="table table-condensed table-hover table-bordered" id="Tcontactos">
                                            <thead>
                                                <th>Aciones</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Correo</th>
                                                <th>Telefono</th>
                                                <th>Puesto</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                    <button type="button" class="btn btn-warning"><span class='fa fa-trash-o'></span>  </button>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- row -->
</div><!-- contenedor -->