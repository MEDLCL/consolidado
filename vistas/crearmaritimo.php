<div class="row" id="crearMaritimo">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border"></div>
            <div class="box-body">

                <form action="" method="POST" class="" role="form" id="frmCrearMaritimo" enctype="multipart/form-data">
                    <ul class="nav nav-tabs" id="tabCrearMaritimo">
                        <li><a class="active" id="TabCreaM" data-toggle="tab" href="#CrearMar">Datos Generales</a></li>
                        <li><a id="tabCreaMDetalle" data-toggle="tab" href="#DetalleCreaM">Detalles</a></li>
                        <li><a id="tabArchivos" data-toggle="tab" href="#CreaMArchivos">Archivos</a></li>

                        <!-- <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false">Contact</a>
                        </li> -->
                    </ul>
                    <div class="tab-content" id="myTabContentCreaM">
                        <?php
                                include_once "includes/creacionMaritimo.php";
                        ?>
                        <div class="tab-pane fade" id="DetalleCreaM">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                            </div>
                                            <div class="panel-body">
                                                <label for="noContenedor" class="control-label">No Contenedor:</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="noContenedor" id="noContenedor"
                                                        class="form-control">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-success fa fa-plus"
                                                            onclick="agregarContenedor()"></button>
                                                    </span>
                                                </div>

                                                <div class="panel-body table-responsive">
                                                    <table class="table table-condensed table-hover table-bordered"
                                                        id="tContenedor">
                                                        <thead>
                                                            <tr>
                                                                <th>No Contenedor</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbodyContenedores">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div><!--  fin panel  -->
                                    </div> <!-- fin col 4 -->
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group col-md-6">
                                        <label for="tipodocumento" class="col-form-label">Tipo Documento(*):</label>
                                        <select id="tipodocumento" name="tipodocumento"
                                            class="form-control selectpicker" data-live-search="true"
                                            onclick="activaCliente()" onchange="activaCliente()">
                                        </select>
                                    </div>
                                    <input type="hidden" name="idtipodocumentose" id= "idtipodocumentose">
                                    <div class="form-group col-md-6">
                                        <label for="noventa" class="col-form-label">No Venta/No RO(*):</label>
                                        <select id="noventa" name="noventa" class="form-control selectpicker"
                                            data-live-search="true">
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="clientes" class="control-label">Cliente(*):</label>
                                        <input type="text" class="form-control input-sm" id="clientes" name="clientes"
                                            onkeyup="mayusculas(this)">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="nodocs" class="control-label">No. Documento(*):</label>
                                        <input type="nodocs" class="form-control input-sm" id="nodocs" name="nodocs"
                                            onkeyup="mayusculas(this)">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="cantOriginal" class="control-label">Cant. Original:</label>
                                        <input type="number" class="form-control input-sm" id="cantOriginal"
                                            name="cantOriginal">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="cantCopias" class="control-label">Cant. Copias:</label>
                                        <input type="number" class="form-control input-sm" id="cantCopias"
                                            name="cantCopias">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="obervacionesdoc" class="control-label">Observaciones:</label>
                                        <textarea class="form-control input-sm" id="obervacionesdoc"
                                            name="obervacionesdoc" rows="3" onkeyup="mayusculas(this)"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button type="button" class="btn btn-large btn-primary"
                                            onclick="verificaMBL()">Registrar</button>
                                    </div>
                                    <div class="panel-body table-responsive col-md-12">
                                        <table class="table table-condensed table-hover table-bordered"
                                            id="tDetalleCreaM">
                                            <thead>
                                                <th>Acciones</th>
                                                <th>Tipo</th>
                                                <th>Venta/RO</th>
                                                <th>Cliente</th>
                                                <th>No. Documento</th>
                                                <th>Original</th>
                                                <th>Copias</th>
                                                <th>Observaciones</th>

                                            </thead>
                                            <tbody id="tbodyDocumentos">
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!--  fin col 8 -->
                            </div>
                        </div> <!-- contactos -->

                        <div class="tab-pane fade" id="CreaMArchivos">
                            <!-- comienza tab archivos -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group col-md-12">
                                        <label for="Archivos" class="col-form-label">Archivos:</label>
                                        <input type="file" name="CMarchivos[]" id="CMarchivos" class="form-control"
                                            multiple onchange="agregaPreviuw(this)">
                                    </div>

                                    <div class="col-md-12 CreaMPreviw" id="CreaMPreviw">

                                    </div>

                                    <div class="panel-body table-responsive col-md-8">
                                        <table class="table table-condensed table-hover table-bordered"
                                            id="tDetalleCreaM" style="text-align:center;">
                                            <thead>
                                                <th>#</th>
                                                <th>Nombre Archivo</th>
                                                <th>Archivo</th>
                                                <th>Eliminar</th>
                                                <th>Descargar</th>
                                            </thead>
                                            <tbody id="tbodyArchivos">
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!--  fin col 8 -->
                            </div>
                        </div> <!-- archivos -->
                    </div>

                    <div class="col-md-12"></div>
                    <div class="box-footer col-md-12">
                        <button type="button" class="btn btn-large btn-primary fa fa-file"
                            onclick="nuevoEmbarqueFueraTabla()">Nuevo</button>

                        <button type="button" class="btn btn-large btn-info fa fa-floppy-o" id="btnGrabarCreaM"
                            onclick="grabarEditarCreaMaritimo()">Grabar
                        </button>

                        <button type="button" class="btn btn-large btn-danger fa fa-close" onclick="cancelar()">Cancelar
                        </button>

                    </div>

                </form>
            </div> <!-- box body -->
        </div>
    </div>
</div>