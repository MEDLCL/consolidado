<div class="container">
    <form action="" id='frmempresa'>
        <div class="row">
            <div class="modal fade" id="modalempresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-center" id="tituloh">
                                <p id="titulomodale"></p>
                            </h4>
                        </div>
                        <div class="modal-body">

                            <ul class="nav nav-tabs" id="tabempresa">
                                <li><a class="active" id="home-tab" data-toggle="tab" href="#home">Datos Generales</a>
                                </li>
                                <li><a id="contacto-tab" data-toggle="tab" href="#contactos">Contactos</a></li>
                                <li><a id="flota-tab" data-toggle="tab" href="#flota">Flota</a></li>
                                <li><a id="experiencia-tab" data-toggle="tab" href="#experiencia">Experiencia</a></li>
                                <li><a id="categoria-tab" data-toggle="tab" href="#categorizacion">Categorizacion</a>
                                </li>
                                <!-- <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                    aria-controls="contact" aria-selected="false">Contact</a>
                            </li> -->
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active" id="home">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading"></div>
                                                <div class="panel-body">
                                                    <!-- <form class="form-horizontal"> -->
                                                    <div class="form-group">
                                                        <label for="codigo" class="control-label">Codigo:</label>
                                                        <input type="text" name="codigo" id="codigo"
                                                            class="form-control input-sm" style="width:150px" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="paisEmpresa" class="control-label">Pais(*)</label>
                                                        <select id="paisEmpresa" name="paisEmpresa"
                                                            class="selectpicker form-control" data-live-search="true">

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="Razons" class="control-label">Razon
                                                            Social*:</label>
                                                        <input type="text" class="form-control input-sm" id="Razons"
                                                            name="Razons" onkeyup="mayusculas(this)">
                                                        <input type="hidden" name="tipoE" id="tipoE">
                                                        <input type="hidden" name="idempresa" id='idempresa'>
                                                        <input type="hidden" name="llama" id="llama">
                                                        <input type="hidden" name="queActualizar" id="queActualizar">

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Nombrec" class="control-label">Nombre
                                                            Comercial*:</label>
                                                        <input type="text" name="Nombrec" id="Nombrec"
                                                            class="form-control input-sm" onkeyup="mayusculas(this)">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="identificacion"
                                                            class="control-label">Identificacion*:</label>
                                                        <input type="text" name="identificacion" id="identificacion"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telefono" class="control-label">Telefono:</label>
                                                        <input type="text" name="telefono" id="telefono"
                                                            class="form-control input-sm"
                                                            onkeyup="this.value=numeroTelefono(this.value)">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="direccion" class="control-label">Direccion*:</label>
                                                        <textarea class="form-control input-sm" id="direccion"
                                                            name="direccion" rows="3"
                                                            onkeyup="mayusculas(this)"></textarea>
                                                    </div>
                                                    <!-- </form> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div id="consignadoa" class="col-md-8">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading"></div>
                                                    <div class="panel-body">
                                                        <!-- <form class="form-horizontal"> -->

                                                        <div class="form-group">
                                                            <label for="comision" class="control-label">%
                                                                Comision</label>
                                                            <input type="number" name="comision" id="comision"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cbm" class="control-label">
                                                                <input type="radio" name="cbmtarifa" id="cbm"
                                                                    value="cbm">
                                                                Por CBM:</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tarifa" class="control-label">
                                                                <input type="radio" name="cbmtarifa" id="tarifa"
                                                                    value="tarifa">
                                                                Por TARIFA:</label>
                                                        </div>
                                                        <!-- </form> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="otrosTruck">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading"></div>
                                                    <div class="panel-body">
                                                        <!-- <form class="form-horizontal"> -->

                                                        <div class="form-group">
                                                            <label for="giroNegocio" class="control-label">Giro de
                                                                Negocio:</label>
                                                            <select id="giroNegocio" name="giroNegocio"
                                                                class="selectpicker form-control"
                                                                data-live-search="true">
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tamanoEmpresa" class="control-label">Tamaño de
                                                                la Empresa:</label>
                                                            <select id="tamanoEmpresa" name="tamanoEmpresa"
                                                                class="selectpicker form-control"
                                                                data-live-search="true">

                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tipoCargaEmpresa" class="control-label">Tipo
                                                                Carga:</label>
                                                            <select id="tipoCargaEmpresa" name="tipoCargaEmpresa"
                                                                class="selectpicker form-control"
                                                                data-live-search="true">

                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="canalDistribucion" class="control-label">Canal
                                                                de Distribucion:</label>
                                                            <select id="canalDistribucion" name="canalDistribucion"
                                                                class="selectpicker form-control"
                                                                data-live-search="true">

                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="asloEmpresa" class="control-label">Aslo:</label>
                                                            <select id="asloEmpresa" name="asloEmpresa"
                                                                class="selectpicker form-control"
                                                                data-live-search="true">
                                                            </select>
                                                        </div>
                                                        <!-- </form> -->
                                                    </div>
                                                </div>
                                            </div> <!-- otros truck -->
                                            <div class="col-md-12" id="paraPagoProveedor">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading"></div>
                                                    <div class="panel-body">
                                                        <!-- <form class="form-horizontal"> -->
                                                        <div class="form-group">
                                                            <label for="representanteLegal"
                                                                class="control-label">Representante Legal:</label>
                                                            <input type="text" name="representanteLegal"
                                                                id="representanteLegal" class="form-control input-sm" onkeyup="mayusculas(this)">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="diasCreditoTR" class="control-label">Dias
                                                                Credito:</label>
                                                            <input type="number" name="diasCreditoTR" id="diasCreditoTR"
                                                                class="form-control input-sm">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cuentaBancariaTR" class="control-label">Cuenta
                                                                Bancaria:</label>

                                                            <textarea name="" id="cuentaBancariaTR" class="form-control"
                                                                rows="3"></textarea>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="paraCheque" class="control-label">Datos Para
                                                                Cheque:</label>

                                                            <textarea name="" id="paraCheque" class="form-control"
                                                                rows="2" onkeyup="mayusculas(this)"></textarea>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="monedaPago" class="control-label">Moneda de
                                                                Pago:</label>
                                                            <select id="monedaPago" name="monedaPago"
                                                                class="selectpicker form-control"
                                                                data-live-search="true">

                                                            </select>
                                                        </div>

                                                        <!-- </form> -->
                                                    </div>
                                                </div>
                                            </div> <!-- datos para pago  -->
                                        </div>

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
                                                        <input type="text" name="Nombre" id="Nombre"
                                                            class="form-control input-sm" onkeyup="mayusculas(this)">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Apellido" class="control-label">Apellido:</label>
                                                        <input type="text" name="Apellido" id="Apellido"
                                                            class="form-control input-sm" onkeyup="mayusculas(this)">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Correo" class="control-label">Correo:</label>
                                                        <input type="email" name="Correo" id="Correo"
                                                            class="form-control input-sm">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telefono" class="control-label">Telefono:</label>
                                                        <input type="text" name="telefonoc" id="telefonoc"
                                                            class="form-control input-sm"
                                                            onkeyup="this.value=numeroTelefono(this.value)">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="puesto" class="control-label">Puesto:</label>
                                                        <input type="text" name="puesto" id="puesto"
                                                            class="form-control input-sm" onkeyup="mayusculas(this)">
                                                    </div>
                                                    <div class="form-group col-md-offset-3">
                                                        <button type="button" class="btn btn-large btn-success"
                                                            onclick="registrarc()">Registrar</button>
                                                    </div>
                                                    <!-- </form> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="panel-body table-responsive">
                                                <table class="table table-condensed table-hover table-bordered"
                                                    id="Tcontactos">
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
                                </div> <!-- contactos -->
                                <div class="tab-pane fade" id="flota">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading text-center">INFORMACION DE FLOTA</div>
                                                <div class="panel-body">
                                                    <!-- <form role="form"> -->
                                                    <div class="col-md-3">
                                                        <label for="permisoEspecial" class="">Permisos Especiales:
                                                        </label>
                                                        <div class="input-group input-group-sm ">
                                                            <select id="permisoEspecial" name="permisoEspecial"
                                                                class="form-control selectpicker"
                                                                data-live-search="true">
                                                            </select>
                                                            <span class="input-group-btn">
                                                                <button type="button"
                                                                    class="btn btn-primary fa fa-plus"></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <label for="codigoAduanero" class="control-label">Codigo de
                                                            Transporte Aduanero:</label>

                                                        <input type="text" name="codigoAduanero" id="codigoAduanero"
                                                            class="form-control input-sm">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="permisoEspecial" class="">Codigo CAAT:
                                                        </label>
                                                        <div class="input-group input-group-sm ">
                                                            <select id="permisoEspecial" name="permisoEspecial"
                                                                class="form-control selectpicker"
                                                                data-live-search="true">
                                                            </select>
                                                            <span class="input-group-btn">
                                                                <button type="button"
                                                                    class="btn btn-primary fa fa-plus"></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 form-group col-md-offset-1">
                                                        <label for="codigoAduanero" class="control-label">Codigo</label>

                                                        <input type="text" name="codigoAduanero" id="codigoAduanero"
                                                            class="form-control input-sm">
                                                    </div>
                                                    <!-- </form> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group"></div>
                                        <div class="col-md-6">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading text-center">UNIDADES</div>
                                                <div class="panel-body">
                                                    <!-- <form role="form"> -->
                                                    <div class="form-group col-md-12">
                                                        <label for="tipoEquipo" class="">Tipo Equipo: </label>
                                                        <div class="input-group input-group-sm">
                                                            <select id="tipoEquipo" name="tipoEquipo"
                                                                class="form-control selectpicker"
                                                                data-live-search="true">
                                                            </select>
                                                            <span class="input-group-btn">
                                                                <button type="button"
                                                                    class="btn btn-primary fa fa-plus"></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="idasignaequipo" id="idasignaequipo">
                                                    <div class="form-group col-md-6">
                                                        <label for="placaCabezal" class="control-label">Placa
                                                            Cabezal:
                                                        </label>
                                                        <input type="text" name="placaCabezal" id="placaCabezal"
                                                            class="form-control input-sm" onkeyup="mayusculas(this)">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="placaFurgon" class="control-label">Placa
                                                            Furgon:
                                                        </label>
                                                        <input type="text" name="placaFurgon" id="placaFurgon"
                                                            class="form-control input-sm" onkeyup="mayusculas(this)">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="tarjetaCirculacion" class="control-label">Tarjeta
                                                            de Circulacion:
                                                        </label>
                                                        <input type="text" name="tarjetaCirculacion"
                                                            id="tarjetaCirculacion" class="form-control input-sm"
                                                            onkeyup="mayusculas(this)">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="gps" class="control-label">GPS
                                                        </label>
                                                        <input type="text" name="gps" id="gps"
                                                            class="form-control input-sm" onkeyup="mayusculas(this)">
                                                    </div>
                                                    <div class="col-md-12">

                                                    </div>
                                                    <div class="form-group col-md-offset-5">
                                                        <button type="button" class="btn btn-large btn-success"
                                                            onclick="registrarEquipo()">Registrar</button>
                                                    </div>
                                                    <!-- </form> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="panel-body table-responsive">
                                                <table class="table table-condensed table-hover table-bordered"
                                                    id="tblEquipos">
                                                    <thead>
                                                        <th>Aciones</th>
                                                        <th>id</th>
                                                        <th>Tipo Unidad</th>
                                                        <th>Placa Cabezal</th>
                                                        <th>Placa Furgon</th>
                                                        <th>GPS</th>
                                                        <th>Tarjeta Circulacion</th>
                                                    </thead>
                                                    <tbody id="tbodyEquipos">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> <!-- col md 8 tabla -->

                                    </div>
                                    <div class="row">

                                        <div class="col-md-12 form-group"></div>
                                        <div class="col-md-6">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading text-center">PILOTOS</div>
                                                <div class="panel-body">
                                                    <!-- <form role="form"> -->
                                                    <div class="form-group col-md-6">
                                                        <label for="nombrePiloto" class="control-label">Nombre:</label>
                                                        <input type="text" name="nombrePiloto" id="nombrePiloto"
                                                            class="form-control input-sm">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="tipoLicencia" class="">Tipo Licencia:</label>
                                                        <div class="input-group input-group-sm">
                                                            <select id="tipoLicencia" name="tipoLicencia"
                                                                class="form-control selectpicker"
                                                                data-live-search="true">
                                                            </select>
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-default"></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="numeroLicencia" class="control-label">No.
                                                            Licencia:
                                                        </label>
                                                        <input type="text" name="numeroLicencia" id="numeroLicencia"
                                                            class="form-control input-sm"  onkeyup="mayusculas(this)">
                                                    </div>
                                                    <div class="form-group col-md-offset-5 col-md-12">
                                                        <button type="button" class="btn btn-large btn-success"
                                                            onclick="registrarPiloto()">Registrar</button>
                                                    </div>
                                                    <!-- </form> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="panel-body table-responsive">
                                                <table class="table table-condensed table-hover table-bordered"
                                                    id="tblPilotos">
                                                    <thead>
                                                        <th>Aciones</th>
                                                        <th>id</th>
                                                        <th>Nombre</th>
                                                        <th>Tipo Licencia</th>
                                                        <th>No. Licencia</th>
                                                    </thead>
                                                    <tbody id="tbodypilotos">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> <!-- col md 8 tabla -->

                                    </div>
                                </div> <!-- flota -->
                                <div class="tab-pane fade" id="experiencia">
                                    <!-- expericencia -->
                                    <div class="row">
                                        <div class="col-md-12 form-group"></div>

                                        <div class="box box-primary" id="">
                                            <!--  formulario para detalle de almacen -->
                                            <div class="box-header with-border text-center"></div>
                                            <div class="box-body">
                                                <div class="col-md-7">
                                                    <!-- <form role="form"> -->
                                                    <div class="form-group">
                                                        <label for="tipoEquipoTotal" class="">Industrias de Experiencia:
                                                        </label>
                                                        <div class="input-group input-group-sm">
                                                            <select id="tipoEquipoTotal" name="tipoEquipoTotal"
                                                                class="form-control selectpicker"
                                                                data-live-search="true">
                                                            </select>
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-default"></button>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <!-- </form> -->
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group ">
                                                        <label for="">.</label>
                                                        <button type="button" class="btn btn-large btn-primary"
                                                            onclick=""><span class="fa fa-plus"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="panel-body table-responsive">
                                                        <table class="table table-condensed table-hover table-bordered"
                                                            id="Tcontactos">
                                                            <thead>
                                                                <th>Aciones</th>
                                                                <th>Industrias</th>
                                                            </thead>
                                                            <tbody id="tbodyC">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> <!-- col md 8 tabla -->
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 form-group"></div>

                                        <div class="box box-primary" id="">
                                            <!--  formulario para detalle de almacen -->
                                            <div class="box-header with-border text-center"></div>
                                            <div class="box-body">
                                                <div class="col-md-7">
                                                    <!-- <form role="form"> -->
                                                    <div class="form-group">
                                                        <label for="tipoEquipoTotal" class="">Canales de
                                                            Distribucion:</label>
                                                        <div class="input-group input-group-sm">
                                                            <select id="tipoEquipoTotal" name="tipoEquipoTotal"
                                                                class="form-control selectpicker"
                                                                data-live-search="true">
                                                            </select>
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-default"></button>
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="">.</label>
                                                        <button type="button" class="btn btn-large btn-primary"
                                                            onclick="">
                                                            <span class="fa fa-plus"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="panel-body table-responsive">
                                                        <table class="table table-condensed table-hover table-bordered"
                                                            id="Tcontactos">
                                                            <thead>
                                                                <th>Aciones</th>
                                                                <th>Canales de Distribucion</th>
                                                            </thead>
                                                            <tbody id="tbodyC">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> <!-- col md 8 tabla -->
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 form-group"></div>

                                        <div class="box box-primary" id="">
                                            <!--  formulario para detalle de almacen -->
                                            <div class="box-header with-border text-center"></div>
                                            <div class="box-body">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label for="cantidadUnidadTotal" class="control-label">Empresas
                                                            a las que ha Movido:</label>
                                                        <input type="text" name="cantidadUnidadTotal"
                                                            id="cantidadUnidadTotal" class="form-control">
                                                    </div>

                                                    <!-- </form> -->
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="">.</label>
                                                        <button type="button" class="btn btn-large btn-primary"
                                                            onclick=""><span class="fa fa-plus"></span></button>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="panel-body table-responsive">
                                                        <table class="table table-condensed table-hover table-bordered"
                                                            id="Tcontactos">
                                                            <thead>
                                                                <th>Aciones</th>
                                                                <th>Empresas</th>
                                                            </thead>
                                                            <tbody id="tbodyC">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> <!-- col md 8 tabla -->
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group"></div>

                                        <div class="box box-primary" id="">
                                            <!--  formulario para detalle de almacen -->
                                            <div class="box-header with-border text-center"></div>
                                            <div class="box-body">
                                                <!-- <form role="form"> -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="cantidadUnidadTotal"
                                                            class="control-label">Referencia:</label>
                                                        <input type="text" name="cantidadUnidadTotal"
                                                            id="cantidadUnidadTotal" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cantidadUnidadTotal" class="control-label">Telefono:
                                                        </label>
                                                        <input type="text" name="cantidadUnidadTotal"
                                                            id="cantidadUnidadTotal" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-large btn-primary"
                                                            onclick=""><span class="fa fa-plus"></span></button>
                                                    </div>
                                                    <!-- </form> -->
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="panel-body table-responsive">
                                                        <table class="table table-condensed table-hover table-bordered"
                                                            id="Tcontactos">
                                                            <thead>
                                                                <th>Aciones</th>
                                                                <th>Referencia</th>
                                                                <th>Telefono</th>

                                                            </thead>
                                                            <tbody id="tbodyC">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> <!-- col md 8 tabla -->
                                            </div>
                                        </div>


                                    </div>
                                </div> <!-- experiencia -->

                                <div class="tab-pane fade" id="categorizacion">
                                    <!-- categorizacion -->
                                    <div class="row">
                                        <div class="col-md-12 form-group"></div>

                                        <div class="box box-primary" id="">
                                            <!--  formulario para detalle de almacen -->
                                            <div class="box-header with-border text-center"></div>
                                            <div class="box-body">
                                                <div class="col-md-12">
                                                    <div class="panel-body table-responsive">
                                                        <table class="table table-condensed table-hover table-bordered"
                                                            id="Tcontactos">
                                                            <thead>
                                                                <th>Descripcion</th>
                                                                <th>Bueno</th>
                                                                <th>Regular</th>
                                                                <th>Malo</th>
                                                            </thead>
                                                            <tbody id="tbodyC">
                                                                <tr>
                                                                    <td>Disponibilidad de Unidades</td>
                                                                    <td>
                                                                        <div class="radio">
                                                                            <label>
                                                                                <input type="radio"
                                                                                    name="disponibilidad" id="input"
                                                                                    value="bueno">
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="radio">
                                                                            <label>
                                                                                <input type="radio"
                                                                                    name="disponibilidad" id="input"
                                                                                    value="regular">

                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="radio">
                                                                            <label>
                                                                                <input type="radio"
                                                                                    name="disponibilidad" id="input"
                                                                                    value="malo">

                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Estado de flota</td>
                                                                    <td>
                                                                        <div class="radio">
                                                                            <label>
                                                                                <input type="radio" name="estadoflota"
                                                                                    id="input" value="bueno">

                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="radio">
                                                                            <label>
                                                                                <input type="radio" name="estadoflota"
                                                                                    id="input" value="regular">

                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="radio">
                                                                            <label>
                                                                                <input type="radio" name="estadoflota"
                                                                                    id="input" value="malo">

                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Servicio</td>
                                                                    <td>
                                                                        <div class="radio">
                                                                            <label>
                                                                                <input type="radio" name="servicio"
                                                                                    id="input" value="bueno">

                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="radio">
                                                                            <label>
                                                                                <input type="radio" name="servicio"
                                                                                    id="input" value="regular">

                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="radio">
                                                                            <label>
                                                                                <input type="radio" name="servicio"
                                                                                    id="input" value="malo">

                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> <!-- col md 8 tabla -->
                                                <div class="col-md-12">
                                                    <label for="">Comentarios</label>
                                                    <textarea name="" id="input" class="form-control"
                                                        rows="3"></textarea>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div> <!-- evaluacion -->
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