var tablamaritima = '';
function init() {
    // cancelar();
    $("#btnActualizarOPEmbarque").hide();
    $("#crearMaritimo").show();
    $("#listadoEmbarquesMaritimo").hide();
    $("#tabCrearMaritimo a:first").tab("show");
    llenaTipoCarga();
    llenaServicio();
    paisOrigen();
    PaisDestino();
    llenaUsuario();
    llenaEnvio();
    llenaAgente();
    llenaBarcoM();
    llenatipoDocumento();
    llenaventaro();
    estableceFecha();
    $("#clientes").attr("readonly", "readonly");
    $("#noContenedor").inputmask("[aaaa]-999999-9");
    $("#btnGrabarCreaM").prop("disabled", true);
    listarEmbarquesCreados();
    $("#crearMaritimo").hide();
    $("#listadoEmbarquesMaritimo").show();
}

function estableceFecha() {
    $("#fechaingreso").datepicker({
        autoclose: true,
    });
    $("#fechaingreso").datepicker("setDate", "0");
}

function llenaventaro() {
    $("#noventa").empty();
    $.post(
        "../modelos/pais.php?op=selectN&tabla=venta_ro&campo=numero", {
            id: "id_venta",
            tipoe: "",
        },
        function (data, status) {
            $("#noventa").html(data);
            $("#noventa").selectpicker("refresh");
            $("#noventa").val(0);
            $("#noventa").selectpicker("refresh");
        }
    );
}

function activaCliente() {
    var valor = $("#tipodocumento option:selected").html();

    if (valor.trim() == "HBL" || valor.trim() == "HAWB") {
        $("#clientes").removeAttr("readonly");
    } else {
        $("#clientes").val("");
        $("#clientes").attr("readonly", "readonly");
        $("#noventa").val(0);
        $("#noventa").selectpicker("refresh");
    }
}

function llenatipoDocumento() {
    $("#tipodocumento").empty();
    $.post(
        "../modelos/pais.php?op=General&tabla=tipo_documento&campo=nombre", {
            id: "id_tipo_documento",
            tipoe: "",
        },
        function (data, status) {
            $("#tipodocumento").html(data);
            $("#tipodocumento").selectpicker("refresh");
            $("#tipodocumento").val(0);
            $("#tipodocumento").selectpicker("refresh");
        }
    );
}

function nuevoEmbarqueTabla() {
    $("#crearMaritimo").show();
    $("#listadoEmbarquesMaritimo").hide();
    $("#tabCrearMaritimo a:first").tab("show");

    $("#btnGrabarCreaM").addClass("btn-info");
    $("#btnGrabarCreaM").removeClass("btn-warning");
    $("#btnGrabarCreaM").attr("value","Grabar");
    $("#btnGrabarCreaM").html("Grabar");
    
    habilitarCampos();
    limpiar();
}

function nuevoEmbarqueFueraTabla() {
    $("#btnGrabarCreaM").addClass("btn-info");
    $("#btnGrabarCreaM").removeClass("btn-warning");
    $("#btnGrabarCreaM").html("Grabar");

    habilitarCampos();
    limpiar();
}

function cancelar() {
    $("#crearMaritimo").hide();
    $("#listadoEmbarquesMaritimo").show();
    $("#TlistadoMaritimo").DataTable().ajax.reload();
}

function limpiar() {
    $("#codigoMaritimo").val("");
    $("#consecutivo").val("");
    $("#tipocarga").val(0);
    $("#tipocarga").selectpicker("refresh");
    $("#tipoServicio").val(0);
    $("#tipoServicio").selectpicker("refresh");
    $("#envioCourier").val(1);
    $("#envioCourier").selectpicker("refresh");

    $("#Viaje").val("");
    $("#barco").val(0);
    $("#barco").selectpicker("refresh");
    $("#agente").val(0);
    $("#agente").selectpicker("refresh");
    $("#naviera").val(0);
    $("#naviera").selectpicker("refresh");
    $("#cntClientes").val(0);
    $("#cntContenedor").val(0);
    $("#PaisOrigen").val(0);
    $("#PaisOrigen").selectpicker("refresh");
    $("#Origen").val(0);
    $("#Origen").selectpicker("refresh");
    $("#PaisDestino").val(0);
    $("#PaisDestino").selectpicker("refresh");
    $("#Destino").val(0);
    $("#Destino").selectpicker("refresh");
    $("#usuarioAsignado").val(0);
    $("#usuarioAsignado").selectpicker("refresh");
    $("#obervaciones").val("");

    $("#noContenedor").val("");
    $("#tipodocumento").val(0);
    $("#tipodocumento").selectpicker("refresh");
    $("#cantOriginal").val(0);
    $("#cantCopias").val(0);
    $("#obervacionesdoc").val("");
    $("#clientes").val("");
    $("#nodocs").val("");
    $("#noventa").val(0);
    $("#noventa").selectpicker("refresh");

    $("#tbodyContenedores").children().remove();
    $("#tbodyDocumentos").children().remove();

    $("#idtipoembarque").val(0);
    $("#idtipoembarque").val(0);
    $("#fechaingreso").datepicker("setDate", "0");
    $("#btnGrabarCreaM").prop("disabled", false);
    $("#CreaMPreviw").html("");
    $("CMarchivos").val("");
    $("#tbodyContenedores tr").remove();
    $("#tbodyArchivos tr").remove();
}

function llenaAgente() {
    $("#agente").empty();
    $.post(
        "../modelos/pais.php?op=agente", {   },
        function (data, status) {
            $("#agente").html(data);
            $("#agente").selectpicker("refresh");
            $("#agente").val(0);
            $("#agente").selectpicker("refresh");
        }
    );
}


function llenaTipoCarga() {
    $("#tipocarga").empty();
    $.post(
        "../modelos/pais.php?op=tipocarga&tabla=tipo_carga&campo=nombre&tipomedio=2", {
            id: "id_tipo_carga",
            tipoe: "",
        },
        function (data, status) {
            $("#tipocarga").html(data);
            $("#tipocarga").selectpicker("refresh");
            $("#tipocarga").val(0);
            $("#tipocarga").selectpicker("refresh");
        }
    );
}

function llenaServicio() {
    $("#tipoServicio").empty();
    $.post(
        "../modelos/pais.php?op=General&tabla=tipo_servicio&campo=nombre", {
            id: "id_tipo_servicio",
            tipoe: "",
        },
        function (data, status) {
            $("#tipoServicio").html(data);
            $("#tipoServicio").selectpicker("refresh");
            $("#tipoServicio").val(0);
            $("#tipoServicio").selectpicker("refresh");
        }
    );
}

function llenaBarcoM() {
    $("#barco").empty();
    $.post(
        "../modelos/pais.php?op=selectN&tabla=barco&campo=nombre", {
            id: "id_barco",
            tipoe: "",
        },
        function (data, status) {
            $("#barco").html(data);
            $("#barco").selectpicker("refresh");
            $("#barco").val(0);
            $("#barco").selectpicker("refresh");
        }
    );
}

function paisOrigen() {
    $("#PaisOrigen").empty();
    $.post(
        "../modelos/pais.php?op=pais", {
            id: "",
            tipoe: "",
        },
        function (data, status) {
            $("#PaisOrigen").html(data);
            $("#PaisOrigen").selectpicker("refresh");
            $("#PaisOrigen").val(0);
            $("#PaisOrigen").selectpicker("refresh");
        }
    );
}

function PaisDestino() {
    $("#PaisDestino").empty();
    $.post(
        "../modelos/pais.php?op=pais", {
            id: "",
            tipoe: "",
        },
        function (data, status) {
            $("#PaisDestino").html(data);
            $("#PaisDestino").selectpicker("refresh");
            $("#PaisDestino").val(0);
            $("#PaisDestino").selectpicker("refresh");
        }
    );
}

function llenaUsuario() {
    $("#usuarioAsignado").empty();
    $.post(
        "../modelos/pais.php?op=usuario", {
        },
        function (data, status) {
            $("#usuarioAsignado").html(data);
            $("#usuarioAsignado").selectpicker("refresh");
            $("#usuarioAsignado").val(0);
            $("#usuarioAsignado").selectpicker("refresh");
        }
    );
}

function llenaEnvio() {
    $("#envioCourier").empty();
    $.post(
        "../modelos/pais.php?op=General&tabla=envio_courier&campo=nombre", {
            id: "id_envio_courier",
            tipoe: "",
        },
        function (data, status) {
            $("#envioCourier").html(data);
            $("#envioCourier").selectpicker("refresh");
            $("#envioCourier").val(0);
            $("#envioCourier").selectpicker("refresh");
        }
    );
}

function nuevoAgente() {
    $("#tabempresa a:first").tab("show");
    nuevo("agentee");
    $("#llama").val("CreaMar");
    $("#tituloh").html("Agente Embarcador");
    //cliente detalle almacen
    $("#queActualizar").val("AgenteE");
    $("#modalempresa").modal("show");
}

function nuevaNaviera() {
    var idtipocarga = $("#tipocarga").prop("selectedIndex");
    if (idtipocarga == -1 || idtipocarga == 0) {
        alertify.alert("Mensaje", "Debe de Seleccionar el tipo de Carga");
    } else {
        $("#tabempresa a:first").tab("show");
        var valor = $("#tipocarga option:selected").html();
        if (valor.trim() == "Coloader") {
            nuevo("agenciac");
            $("#tituloh").html("Agencia de Carga");
            //cliente detalle almacen
            $("#queActualizar").val("AgenciaC");
        } else {
            nuevo("naviera");
            $("#tituloh").html("Naviera");
            //cliente detalle almacen
            $("#queActualizar").val("Naviera");
        }
        $("#llama").val("CreaMar");
        $("#modalempresa").modal("show");
    }
}

function nuevoBarcoM() {
    $("#quienllamaBarco").val("CreaMar");
    llenaBarcoModal();
    limpiaBarco();
    $("#modalBarco").modal("show");
}


function llenaNaviera(idnaviera) {
    $("#naviera").empty();
    $.post(
        "../modelos/pais.php?op=selecEmpresa&tabla=empresas&campo=Razons", {
            id: "id_empresa",
            tipoe: "NA",
        },
        function (data, status) {
            $("#naviera").html(data);
            $("#naviera").selectpicker("refresh");
            $("#naviera").val(idnaviera);
            $("#naviera").selectpicker("refresh");
        }
    );
}

function llenaAGenciaCarga(idagencia) {
    $("#naviera").empty();
    $.post(
        "../modelos/pais.php?op=selecEmpresa&tabla=empresas&campo=Razons", {
            id: "id_empresa",
            tipoe: "AC",
        },
        function (data, status) {
            $("#naviera").html(data);
            $("#naviera").selectpicker("refresh");
            $("#naviera").val(idagencia);
            $("#naviera").selectpicker("refresh");
        }
    );
}

function llenaNAVAGE() {
    var valor = $("#tipocarga option:selected").html();
    if (valor.trim() == "COLOADER") {
        llenaAGenciaCarga(0);
    } else {
        llenaNaviera(0);
    }
}

function nuevoOrigen() {
    var idpaisOrigen = $("#PaisOrigen").prop("selectedIndex");
    if (idpaisOrigen == -1 || idpaisOrigen == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar Pais de Origen");
        return false;
    } else {
        $("#quienLLamaCiudad").val("CreaMarOrigen");
        llenaPaisModalBusqueda();
        llenaPaisModal($("#PaisOrigen").val());
        limpiaCiudad();
        $("#modalCiudad").modal("show");
    }
}

function nuevoDestino() {
    var idpaisDestino = $("#PaisDestino").prop("selectedIndex");
    if (idpaisDestino == -1 || idpaisDestino == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar Pais de Destino");
        return false;
    } else {
        $("#quienLLamaCiudad").val("CreaMarDestino");
        llenaPaisModalBusqueda();
        llenaPaisModal($("#PaisDestino").val());
        limpiaCiudad();
        $("#modalCiudad").modal("show");
    }
}

function llenaCiudadOrigenMar(idorigen) {
    $("#Origen").empty();
    var idpadre = $("#PaisOrigen").val();

    $.post(
        "../modelos/pais.php?op=Dependiente&tabla=ciudad&campo=nombre", {
            id: "id_ciudad",
            tipoe: "",
            idpadre: idpadre,
        },
        function (data, status) {
            $("#Origen").html(data);
            $("#Origen").selectpicker("refresh");
            $("#Origen").val(idorigen);
            $("#Origen").selectpicker("refresh");
        }
    );
}

function llenaciudadDestinoMar(iddestino) {
    $("#Destino").empty();
    var idpadre = $("#PaisDestino").val();
    $.post(
        "../modelos/pais.php?op=Dependiente&tabla=ciudad&campo=nombre", {
            id: "id_ciudad",
            tipoe: "",
            idpadre: idpadre,
        },
        function (data, status) {
            $("#Destino").html(data);
            $("#Destino").selectpicker("refresh");
            $("#Destino").val(iddestino);
            $("#Destino").selectpicker("refresh");
        }
    );
}
//var cont = 0;

/* function agregarMBL() {
    var nomaster = $('#nomaster').val();
    if (nomaster.trim() == '') {
        alertify.alert('Campo vacio', 'Debe ingresar No. de Master');
        return false;
    }
    nomaster = nomaster.toUpperCase();
    var fila =
        '<tr class="filas" id ="fila' + cont + '">' +
        '<td><button type="button" class="btn btn-danger" onclick="eliminarFilaMBL(' + cont + ')"><span class="fa fa-trash-o"></span></button></td>' +
        '<td ><input type "text"    name ="masters[]" id ="masters[]" value="' + nomaster + '"></td>' +
        '</tr>';
    cont++;
    $('#tMaster').append(fila);
}

function eliminarFilaMBL(idmbl) {
    $.post("../ajax/crearMaritimo.php?op=eliminaC", {
            idmbl: idmbl
        },
        function (data) {
            if (data == 1) {
                $('#fila' + idmbl).remove();
                alertify.warning("No Master eliminado");
            } else {
                alertify.error("No. Master no se pudo eliminar");
            }
        }
    );
} */

var cont1 = 0;

function agregarContenedor() {
    var noContenedor = $("#noContenedor").val();
    var valida;

    if (noContenedor.trim() == "") {
        alertify.alert("Campo vacio", "Debe ingresar No. de Contenedor");
        return false;
    }
    noContenedor = noContenedor.toUpperCase();
    valida = verificarCNTRDuplicado(noContenedor);
    if (valida > 0) {
        alertify.alert("Mensaje", "Elemento Duplicado");
        return false;
    }
    var fila =
        '<tr class="filas" id ="fila' +
        cont1 +
        '">' +
        '<td><button type="button" class="btn btn-danger" onclick="eliminarFilaContenedor(' +
        cont1 +
        ')"><span class="fa fa-trash-o"></span></button></td>' +
        '<td ><input type "text"    name ="contenedores[]" id ="contenedores[]" value="' +
        noContenedor +
        '" readonly></td>' +
        "</tr>";
    cont1++;
    $("#tContenedor").append(fila);
}

function eliminarFilaContenedor(idcontenedor) {
    $.post(
        "../ajax/crearMaritimo.php?op=eliminaC", {
            idcontenedor: idcontenedor,
        },
        function (data) {
            if (data == 1) {
                $("#fila" + idcontenedor).remove();
                alertify.warning("Contenedor eliminado");
            } else {
                alertify.error("Contenedor no se pudo eliminar");
            }
        }
    );
}

function verificarCNTRDuplicado(cntr) {
    var valor = "";
    var contador = 0;

    $("input[name='contenedores[]']").each(function (indice, elemento) {
        valor = $(elemento).val();
        if (valor.trim() == cntr.trim()) {
            contador = contador + 1;
        }
    });
    return contador;
}

var cont2 = 0;

function registraDocumentos() {
    var idtipodoc = $("#tipodocumento").prop("selectedIndex");
    var tipodoc = $("#tipodocumento option:selected").html();
    var venta = $("#noventa option:selected").html();
    var idventa = $("#noventa").val();
    var cliente = $("#clientes").val();
    var nodco = $("#nodocs").val();
    var original = $("#cantOriginal").val();
    var copia = $("#cantCopias").val();
    var observaciones = $("#obervacionesdoc").val();

    var valida;

    if (idtipodoc == -1 || idtipodoc == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar un tipo de documento");
        return false;
    } else if (nodco.trim() == "") {
        alertify.alert("Campo Vacio", "Debe de colocar numero de Documento");
        return false;
    }
    if (idventa == -1 || idventa == 0) {
        idventa = 0;
        venta = "";
    }
    valida = 0;
    //noContenedor = noContenedor.toUpperCase();
    // valida= verificarCNTRDuplicado(noContenedor);
    if (valida > 0) {
        alertify.alert("Mensaje", "Elemento Duplicado");
        return false;
    }
    var fila =
        '<tr class="filas" id ="filad' +
        cont2 +
        '">' +
        '<td><button type="button" class="btn btn-danger" onclick="eliminarDocumento(' +
        cont2 +
        ')"><span class="fa fa-trash-o"></span></button></td>' +
        '<td ><input type "text"  readonly style="width: 50px;"   name ="tipocM[]" id ="tipocM[]" value="' +
        tipodoc +
        '"></td>' +
        '<td ><input type "text" readonly  name ="ventasM[]" id ="ventasM[]" value="' +
        venta +
        '"></td>' +
        '<td ><input  type "text" readonly style="width: 50px;"   name ="idventasM[]" id ="idventasM[]" value="' +
        idventa +
        '" readonly></td>' +
        '<td ><input type "text"    name ="clientesM[]" id ="clientesM[]" value="' +
        cliente +
        '" readonly></td>' +
        '<td ><input type "text"    name ="nodocM[]" id ="nodocM[]" value="' +
        nodco +
        '" readonly></td>' +
        '<td ><input type "text"  style="width: 50px;"  name ="originalM[]" id ="originalM[]" value="' +
        original +
        '" readonly></td>' +
        '<td ><input type "text"  style="width: 50px;"  name ="copiasM[]" id ="copiasM[]" value="' +
        copia +
        '" readonly></td>' +
        '<td ><input type "text"    name ="obserM[]" id ="obserM[]" value="' +
        observaciones +
        '" readonly></td>' +
        "</tr>";
    cont2++;
    $("#tDetalleCreaM").append(fila);
    limpiardetalledocumentos();
}

function eliminarDocumento(iddocumento){
    $.post(
        "../ajax/creaMaritimo.php?op=eliminarD", {
            iddocumento: iddocumento,
        },
        function (data) {
            if (data == 1) {
                $("#filad" + iddocumento).remove();
                alertify.warning("Documento eliminado");
            } else {
                alertify.error("Documento no se pudo eliminar");
            }
        }
    );
}

function limpiardetalledocumentos() {
    $("#tipodocumento").val(0);
    $("#tipodocumento").selectpicker("refresh");
    $("#noventa").val(0);
    $("#noventa").selectpicker("refresh");
    $("#clientes").val("");
    $("#nodocs").val("");
    $("#cantOriginal").val(0);
    $("#cantCopias").val(0);
    $("#obervacionesdoc").val("");
}

function grabarEditarCreaMaritimo() {
    var tipocarga = $("#tipocarga").prop("selectedIndex");
    var tiposervicio = $("#tipoServicio").prop("selectedIndex");
    var barco = $("#barco").prop("selectedIndex");
    var viaje = $("#Viaje").val();
    var cantClientes = $("#cntClientes").val();
    var agente = $("#agente").prop("selectedIndex");
    var naviera = $("#naviera").prop("selectedIndex");
    var paisorigen = $("#PaisOrigen").prop("selectedIndex");
    var origen = $("#Origen").prop("selectedIndex");
    var paisdestino = $("#PaisDestino").prop("selectedIndex");
    var destino = $("#Destino").prop("selectedIndex");
    var usuarioasinado = $("#usuarioAsignado").prop("selectedIndex");

    if (tipocarga == -1 || tipocarga == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar el Tipo de Carga");
        return false;
    } else if (tiposervicio == -1 || tiposervicio == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar el Tipo de Servicio");
        return false;
    } else if (barco == -1 || barco == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar el Barco");
        return false;
    } else if (viaje.trim() == "") {
        alertify.alert("Campo Vacio", "Debe de ingresar Viaje");
        return false;
    } else if (cantClientes.trim() == "" || cantClientes == 0) {
        alertify.alert("Campo Vacio", "Debe de ingresar Cantidad de Clientes");
        return false;
    } else if (agente == -1 || agente == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar Agente");
        return false;
    } else if (naviera == -1 || naviera == 0) {
        if (tipocarga == 1) {
            alertify.alert("Campo Vacio", "Debe de seleccionar Agencia de Carga");
            return false;
        } else {
            alertify.alert("Campo Vacio", "Debe de seleccionar Naviera");
            return false;
        }
    } else if (paisorigen == -1 || paisorigen == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar Pais Origen");
        return false;
    } else if (origen == -1 || origen == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar Origen");
        return false;
    } else if (paisdestino == -1 || paisdestino == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar Pais Destino");
        return false;
    } else if (destino == -1 || destino == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar Destino");
        return false;
    } else if (usuarioasinado == -1 || usuarioasinado == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar Usuario Asignado");
        return false;
    }

    var form = new FormData($("#frmCrearMaritimo")[0]);

    $.ajax({
        url: "../ajax/creaMaritimo.php?op=guardaryeditar",
        type: "POST",
        data: form,
        cache: false,
        contentType: false,
        processData: false,
        success: function (datos) {
            datos = JSON.parse(datos);
            if (datos.idembarque > 0) {
                //habilitar boton para imprimir caratula
                $("#codigoMaritimo").val(datos.codigo);
                $("#consecutivo").val(datos.consecutivo);
                $("#btnGrabarCreaM").prop("disabled", true);
                //alertify.success("Proceso Realizado con exito");
                Swal.fire({
                    icon: "success",
                    title: "",
                    text: datos.mensaje,
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "",
                    text: datos.mensaje,
                });
                //alertify.error("Proceso no se pudo realizar") + " " + datos;
            }
        },
    });
}

function listarEmbarquesCreados() {
    tablamaritima = $("#TlistadoMaritimo").dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginacion y fltrado realizado por el servidor
        dom: "Bfrtip", //Definimos los elementos de control de tabla
        buttons: ["copyHtml5", "excelHtml5", "pdfHtml5"],
        "ajax": {
            url: "../ajax/creaMaritimo.php?op=listarEmbarque",
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            },
        },
        "bDestroy": true,
        "pageLength" :15,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        //"iDisplayLenth": 25, //paginacion
        "order": [
            [1, "desc"]
        ], //order los datos
    });
}

function mostrarEmbarque(idembarquemaritimo) {
    limpiar();
    $.post(
        "../ajax/creaMaritimo.php?op=buscaEmbarque", {
            idembarquemaritimo: idembarquemaritimo,
        },
        function (data, status) {
            $("#crearMaritimo").show();
            $("#listadoEmbarquesMaritimo").hide();
            $("#tabCrearMaritimo a:first").tab("show");

            data = JSON.parse(data);
            $("#idembarquemaritimo").val(data.idembarque);
            $("#codigoMaritimo").val(data.codigo);
            $("#fechaingreso").val(data.fechaingreso);
            $("#consecutivo").val(data.consecutivo);
            $("#tipocarga").val(data.id_tipo_carga);
            $("#tipocarga").selectpicker("refresh");
            if (data.id_tipo_carga == 7) {
                llenaAGenciaCarga(data.id_nav_age);
            } else {
                llenaNaviera(data.id_nav_age);
            }
            $("#tipoServicio").val(data.id_tipo_servicio);
            $("#tipoServicio").selectpicker("refresh");
            $("#envioCourier").val(data.id_courier);
            $("#envioCourier").selectpicker("refresh");
            $("#barco").val(data.id_barco);
            $("#barco").selectpicker("refresh");
            $("#Viaje").val(data.viaje);
            $("#cntClientes").val(data.cant_clientes);
            $("#agente").val(data.id_agente);
            $("#agente").selectpicker("refresh");
            $("#PaisOrigen").val(data.id_pais_origen);
            $("#PaisOrigen").selectpicker("refresh");
            llenaCiudadOrigenMar(data.id_origen);
            $("#PaisDestino").val(data.id_pais_destino);
            $("#PaisDestino").selectpicker("refresh");
            llenaciudadDestinoMar(data.id_destino);
            $("#usuarioAsignado").val(data.id_usuario_asignado);
            $("#usuarioAsignado").selectpicker("refresh");
            $("#obervaciones").val(data.observaciones);
            $("#btnGrabarCreaM").removeClass("btn-info");
            $("#btnGrabarCreaM").addClass("btn-warning");
            $("#btnGrabarCreaM").html("Actualizar Cambios");

            //llena para barco
            $("#codigobarco").val(data.codigo);
            $("#consecutivoBarco").val(data.consecutivo);
            $("#idEmbarquemBarco").val(data.idembarque);
            $("#barcoLlegada").val(data.idbarcollegada);
            $("#barcoLlegada").selectpicker("refresh");
            $("#ViajeLlegada").val(data.viajellegada);
            $("#etdOP").val(data.etdop);

            $("#etaOP").val(data.etaop);
            $("#cetaOP").val(data.cetaop);
            $("#etaNavieraOP").val(data.etanav);

            $("#completoOP").val(data.completo);
            $("#pilotoOP").val(data.piloto);
            $("#descargaOP").val(data.descarga);
            $("#liberadoOP").val(data.liberado);
            $("#devueltoOP").val(data.devuelto);
        }
    );

    $.post(
        "../ajax/creaMaritimo.php?op=listarCNTR", {
            idembarquemaritimo: idembarquemaritimo,
        },
        function (data, status) {
            $('#tbodyContenedores').append(data);
        }
    );

    $.post(
        "../ajax/creaMaritimo.php?op=listarDoc", {
            idembarquemaritimo: idembarquemaritimo,
        },
        function (data, status) {
            $('#tbodyDocumentos').append(data);
        }
    );

    $.post(
        "../ajax/creaMaritimo.php?op=listarArchivosM", {
            idembarquemaritimo: idembarquemaritimo,
        },
        function (data, status) {
            $('#tbodyArchivos').append(data);
        }
    );
    /*  $.ajax({
            type: "POST",
            dataType: "html",
            url: "../ajax/empresa.php?op=cargac",
            data: "idempresa=" + idempresa,
            success: function(resp) {
            $('#tbodyC').append(resp);
            }
          }); */
    desabilitaModificacion();
}

function desabilitaModificacion() {
    //$('#tipocarga').prop("disabled",true);
    $("#envioCourier").prop("disabled", true);
    $("#cntClientes").prop("disabled", true);
    $("#agente").prop("disabled", true);
    $("#PaisOrigen").prop("disabled", true);
    $("#Origen").prop("disabled", true);
    $("#PaisDestino").prop("disabled", true);
    $("#Destino").prop("disabled", true);
    $("#obervaciones").prop("disabled", true);
}

function habilitarCampos() {
    $("#tipoServicio").prop("disabled", false);
    $("#envioCourier").prop("disabled", false);
    $("#cntClientes").prop("disabled", false);
    $("#agente").prop("disabled", false);
    $("#PaisOrigen").prop("disabled", false);
    $("#Origen").prop("disabled", false);
    $("#PaisDestino").prop("disabled", false);
    $("#Destino").prop("disabled", false);
    $("#obervaciones").prop("disabled", false);
}

function agregaPreviuw(archivos) {
    $("#CreaMPreviw").html("");
    for (var i = 0; i < archivos.files.length; i++) {
        if (archivos.files[i]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $('<img id="dynamic"  width = "50px" height = "50px">');
                img.attr("src", e.target.result);
                img.appendTo("#CreaMPreviw");
            };
            reader.readAsDataURL(archivos.files[i]);
        }
    }
}

function anularEmbarque(idembarquemaritimo){
    $.post(
        "../ajax/creaMaritimo.php?op=AnulaEmbarque", {
            idembarquemaritimo: idembarquemaritimo,
        },
        function (data, status) {
            data = JSON.parse(data);
            if (data.idembarque>0){
                Swal.fire({
                    icon: "success",
                    title: "",
                    text: "Embarque Anulado con Exito",
                });
                listarEmbarquesCreados();
            }
            else{
                Swal.fire({
                    icon: "error",
                    title: "",
                    text: "Se ha Producido un error",
                });
            }
        }
    );
    
}
/* function validarPreArchivos() {
    var filesObj = name_imagen.files;
    var filesArray = Object.keys(filesObj).map(function (key) {
        return filesObj[key];
    });
    filesArray.forEach(function (file) {
        if (file.size > 1000000) {
            $("#error").html('<p>El Archivo' + file.name + 'Supera lo permitido' + file.size + '</p>');
        } else {
            var ext = file.name.split('.');
            if ($.inArray(ext[1].toLowerCase(), ['jpg', 'png']) == -1) {
                $("#error").html('<p>El Archivo' + file.name + 'No esta Permitido</p>');
            }
        }
    });
} */

/* $(function(){
    $("input[type='submit']").prop("disabled",true);
    
    $("input[type='file']").bind('change',function(){
        var filesObj = name_imagen.files;
        var filesArray = Object.keys(filesObj).map(function(key){
            return filesObj[key];
        });
        filesArray.forEach(function(file){
            if (file.size > 1000000){ 
                $("#error").html('<p>El Archivo' +file.name+ 'Supera lo permitido' +file.size+'</p>');
            }else{
                var ext = file.name.split('.');
                if($.inArray(ext[1].toLowerCase(),['jpg','png']) == -1){
                    $("#error").html('<p>El Archivo' +file.name+ 'No esta Permitido</p>');
                }
            }
        });
    });
});
 */

init();
/* 
$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
}); */