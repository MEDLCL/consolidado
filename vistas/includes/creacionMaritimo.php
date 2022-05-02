<div class="tab-pane fade active" id="CrearMar">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <!-- <form class="form-horizontal"> -->
                    <div class="col-md-6">
                        <div class="form-group col-md-4">
                            <label for="fechaingreso" class="control-label">Fecha(*):</label>
                            <input type="text" id="fechaingreso" name="fechaingreso" class="form-control input-sm">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="codigoMaritimo" class="control-label">Codigo:</label>
                            <input type="text" name="codigoMaritimo" id="codigoMaritimo" class="form-control input-sm"
                                readonly>
                            <input type="hidden" name="idembarquemaritimo" id="idembarquemaritimo">
                            <input type="hidden" name="idingresomaritimo" id="idingresomaritimo">
                            <input type="hidden" name="tipo" id="tipo">
                            <input type="hidden" name="idembarque" id="idembarque">

                        </div>
                        <div class="form-group col-md-4">
                            <label for="consecutivo" class="control-label">Consecutivo:</label>
                            <input type="text" name="consecutivo" id="consecutivo" class="form-control input-sm"
                                readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="tipocarga" class="">T. Carga(*)</label>
                            <div class="input-group input-group-sm">
                                <select id="tipocarga" name="tipocarga" class="form-control selectpicker"
                                    data-live-search="true" onchange="llenaNAVAGE()">
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info fa-circle-thin"></button>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="tipoServicio" class="">T. Servicio(*)</label>
                            <div class="input-group input-group-sm">
                                <select id="tipoServicio" name="tipoServicio" class="form-control selectpicker"
                                    data-live-search="true">
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info fa-circle-thin"></button>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <span class="label">.</span>
                        </div>
                        <!--  -->
                        <div class="col-md-6">
                            <label for="envioCourier" class="">Courier</label>
                            <div class="input-group input-group-sm">
                                <select id="envioCourier" name="envioCourier" class="form-control selectpicker"
                                    data-live-search="true">
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info fa-circle-thin"></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span class="label">.</span>
                        </div>
                        <div class="col-md-12">
                            <label for="barco" class="">Barco(*)</label>
                            <div class="input-group input-group-sm">
                                <select id="barco" name="barco" class="form-control selectpicker"
                                    data-live-search="true">
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success fa fa-plus" data-target="#modalBarco"
                                        onclick="nuevoBarcoM()"></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span class="label">.</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Viaje" class="control-label">Viaje(*):</label>
                            <input type="text" class="form-control input-sm" id="Viaje" name="Viaje"
                                onkeyup="mayusculas(this)">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cntClientes" class="control-label">Cant. Clientes(*):</label>
                            <input type="number" name="cntClientes" id="cntClientes" class="form-control input-sm"
                                onkeyup="this.value=numeroTelefono(this.value)">
                        </div>

                        <div class="col-md-12">
                            <label for="agente" class="">Agente Embarcador(*)</label>
                            <div class="input-group input-group-sm">
                                <select id="agente" name="agente" class="form-control selectpicker"
                                    data-live-search="true">
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success fa fa-plus" data-target="#modalempresa"
                                        onclick="nuevoAgente()"></button>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <span class="label">.</span>
                        </div>

                        <div class="col-md-12">
                            <label for="naviera" class="">Naviera / Agencia de Carga(*)</label>
                            <div class="input-group input-group-sm">
                                <select id="naviera" name="naviera" class="form-control selectpicker"
                                    data-live-search="true">
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success fa fa-plus" data-target="#modalempresa"
                                        onclick="nuevaNaviera()"></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="PaisOrigen" class="">Pais Origen(*) </label>
                        <div class="input-group input-group-sm">
                            <select id="PaisOrigen" name="PaisOrigen" class="form-control selectpicker"
                                data-live-search="true" onclick="llenaCiudadOrigenMar(0)"
                                onchange="llenaCiudadOrigenMar(0)">
                            </select>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info fa-circle-thin"></button>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <span class="label">.</span>
                        </div>
                        <label for="Origen" class="">Origen(*) </label>
                        <div class="input-group input-group-sm">
                            <select id="Origen" name="Origen" class="form-control selectpicker" data-live-search="true">
                            </select>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success fa fa-plus" data-target="#modalCiudad"
                                    onclick="nuevoOrigen()"></button>
                            </span>
                        </div>

                        <div class="col-md-12">
                            <span class="label">.</span>
                        </div>

                        <label for="PaisDestino" class="">Pais Destino(*) </label>
                        <div class="input-group input-group-sm">
                            <select id="PaisDestino" name="PaisDestino" class="form-control selectpicker"
                                data-live-search="true" onclick="llenaciudadDestinoMar(0)"
                                onchange="llenaciudadDestinoMar(0)">
                            </select>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info fa-circle-thin"></button>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <span class="label">.</span>
                        </div>
                        <label for="Destino" class="">Destino(*) </label>
                        <div class="input-group input-group-sm">
                            <select id="Destino" name="Destino" class="form-control selectpicker"
                                data-live-search="true">
                            </select>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success fa fa-plus" data-target="#modalCiudad"
                                    onclick="nuevoDestino()"></button>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <span class="label">.</span>
                        </div>
                        <label for="usuarioAsignado" class="">Usuario Asignado(*) </label>
                        <div class="input-group input-group-sm">
                            <select id="usuarioAsignado" name="usuarioAsignado" class="form-control selectpicker"
                                data-live-search="true">
                            </select>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info fa-circle-thin"></button>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <span class="label">.</span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="obervaciones" class="control-label">Observaciones:</label>
                            <textarea class="form-control input-sm" id="obervaciones" name="obervaciones" rows="3"
                                onkeyup="mayusculas(this)"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1 col-md-offset-1 form-group">
            <button type="button" class="btn btn-warning" id="btnActualizarOPEmbarque" onclick="EditarMaritimo()">Actualizar Cambios <span class="fa fa-floppy-o"></span></button>         
        </div>
        
    </div>
</div>