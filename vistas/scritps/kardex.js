var tablaK = "";
var tablaDA = "";
var tablaDetalleP = "";

function init() {
    $("#fechaI").datepicker({
        autoclose: true,
    });
    $("#delCalculoA").datepicker({
        autoclose: true,
    });
    $("#alCalculoA").datepicker({
        autoclose: true,
    });
    //$('#Tkardex').DataTable();
    nuevoDetalle("false");
    ocultaAlma("false");
    llenaconsignado();
    llenaCliente();

    llenaEmpaqueModal();
    llenaEmpaqueDetalle();
    listarKardex();
    llenaPlantillaBM("#agregarPlantilla");
    llenaCatalogoCalculoA();
    listarDetallePlantillaA();
    limpiarDetallePlantilla();
    $("#plantillaCalculoAlmacen").hide();
    $("#calculoAlmacen").hide();
    llenatipoPoliza();
    ocultacr();
}
function llenatipoPoliza(){
    $("#tipoPolizaKardex").empty();
    $.post(
        "../modelos/pais.php?op=General&tabla=tipo_poliza&campo=nombre", {
            id: "id_tipo_poliza",
            tipoe: "",
        },
        function (data, status) {
            $("#tipoPolizaKardex").html(data);
            $("#tipoPolizaKardex").selectpicker("refresh");
            $("#tipoPolizaKardex").val(0);
            $("#tipoPolizaKardex").selectpicker("refresh");
        }
    );
}
function ocultacr(){
    $.post(
        "../modelos/pais.php?op=tipoSucursal", { },
        function (data, status) {
            data = JSON.parse(data);
            if (data.tiposucursal==4){
                $(".almacr").show();
                $(".almadisanic").hide();

                $("#tipoPolizaKardex").val(1);
                $("#tipoPolizaKardex").selectpicker("refresh");
            }else{
                $(".almacr").hide();
            }
        }
    );
}

function llenaconsignado() {
    $("#consignadoKardex").empty();
    $.post(
        "../modelos/pais.php?op=selecEmpresa&tabla=empresas&campo=Razons", {
            id: "id_empresa",
            tipoe: "CO",
        },
        function (data, status) {
            $("#consignadoKardex").html(data);
            $("#consignadoKardex").selectpicker("refresh");
            $("#consignadoKardex").val(0);
            $("#consignadoKardex").selectpicker("refresh");
        }
    );
}

function llenaDescuentos() {
    $("#descuento").empty();
    $.post(
        "../modelos/pais.php?op=selectN&tabla=descuentocalculo&campo=porcentaje", {
            id: "id_descuento",
            tipoe: "",
        },
        function (data, status) {
            $("#descuento").html(data);
            $("#descuento").selectpicker("refresh");
            $("#descuento").val(0);
            $("#descuento").selectpicker("refresh");
        }
    );
}

function llenaCliente() {
    $.post(
        "../modelos/pais.php?op=selecEmpresa&tabla=empresas&campo=Razons", {
            id: "id_empresa",
            tipoe: "CL",
        },
        function (data, status) {
            $("#cliente").html(data);
            $("#cliente").selectpicker("refresh");
            $("#cliente").val(0);
            $("#cliente").selectpicker("refresh");
        }
    );
}

function nuevoDetalle(deta) {
    if (deta == "true") {
        $("#datosDetalleA").show();
        $("#tablaDetalleAlmacen").hide();
    } else {
        $("#datosDetalleA").hide();
        $("#tablaDetalleAlmacen").show();
    }
    limpiaDetalle();
}

function limpiaDetalle() {
    $("#iddetallealmacen").val(0);
    $("#cliente").val(0);
    $("#cliente").selectpicker("refresh");
    $("#nohbl").val("");
    $("#peso").val(0);
    $("#ubicacion").val("");
    $("#volumen").val(0);
    $("#dut").val("");
    $("#bultos").val(0);
    $("#embalajeD").val(0);
    $("#embalajeD").selectpicker("refresh");
    $("#liberado").prop("checked", false);
    $("#resa").val("");
    $("#dti").val("");
    $("#ncancel").val("");
    $("#norden").val("");
    $("#mercaderia").val("");
    $("#observaciones").val("");
    $("#linea").val("");
}

function ocultaAlma(alma) {
    if (alma == true) {
        $("#Almacen").show();
    } else {
        $("#Almacen").hide();
    }
    nuevoAlma();
}

function nuevoAlma() {
    $("#codigoAlmacen").val("");
    $("#consignado").val(0);
    $("#consignado").selectpicker("refresh");
    $("#contenedor").val("");
    $("#poliza").val("");
    $("#referencia").val("");
    $("#pesoT").val(0);
    $("#volumenT").val(0);
    $("#bultosT").val(0);
    $("#cntClientes").val(1);
    $("#fechaI").val("");
    $("#btnNuevoDetalle").attr("disabled", "false");
    $("#grabaAlmacen").removeAttr("disabled");
}

function llenaEmpaqueModal() {
    $.post(
        "../modelos/pais.php?op=selectN&tabla=empaque&campo=nombre", {
            id: "id_empaque",
            tipoe: "",
        },
        function (data, status) {
            $("#empaqueB").html(data);
            $("#empaqueB").selectpicker("refresh");
        }
    );
}

function llenaEmpaqueDetalle() {
    $.post(
        "../modelos/pais.php?op=selectN&tabla=empaque&campo=nombre", {
            id: "id_empaque",
            tipoe: "",
        },
        function (data, status) {
            $("#embalajeD").html(data);
            $("#embalajeD").selectpicker("refresh");
        }
    );
}

function grabaEmpaque() {
    var nombre = $("#nombreE").val();
    var id_empaque = $("#id_empaque").val();
    if (nombre.trim() == "") {
        alertify.alert("Campo Vacio", "Debe de ingresar campo nombre Empaque");
        return false;
    }
    $.post(
        "../ajax/empaque.php?op=guardaryeditar", {
            id_empaque: id_empaque,
            nombre: nombre,
        },
        function (data) {
            if (data == 1) {
                llenaEmpaqueDetalle();
                $("#modalEmaqpue").modal("hide");
            }
        }
    );
}

function nuevoConsignado() {
    $(".nav-tabs a:first").tab("show");
    $("#titulomodale").text("Consignado");
    nuevo("consignado");
    $("#tituloh").html("Consignado");
    $("#llama").val("kardex");
    //consignado ingreso almacen
    $("#queActualizar").val("conAL");
}

function nuevoCliente() {
    $(".nav-tabs a:first").tab("show");
    nuevo("cliente");
    $("#llama").val("kardex");
    $("#tituloh").html("Cliente");
    //cliente detalle almacen
    $("#queActualizar").val("cliDA");
    $("#modalempresa").modal("show");
}

function limpiaEmpaque() {
    llenaEmpaqueModal();
    $("#nombreE").val("");
    $("#id_empaque").val(0);
    /*  $("#empaqueB").val(0);
              $("#empaqueB").selectpicker("refresh"); */
}

function grabarAlmacen() {
    var consignado = $("#consignadoKardex").prop("selectedIndex");
    var contenedor = $("#contenedorKadex").val();
    var poliza = $("#polizaKardex").val();
    var referencia = $("#referencia").val();
    var pesoT = $("#pesoT").val();
    var volumenT = $("#volumenT").val();
    var bultosT = $("#bultosT").val();
    var fechaI = $("#fechaI").val();
    var cntClientes = $("#cntClientes").val();
    var placa = $("#placaKardex").val();

    if (consignado == -1 || consignado == 0) {
        alertify.alert("Campo Vacio", "Debe de Seleccionar consignado");
        return false;
    } else if (contenedor.trim() == "") {
        alertify.alert("Campo Vacio", "Debe de ingresar Contenedor");
        return false;
    } else if (poliza.trim() == "") {
        alertify.alert("Campo Vacio", "Debe de ingresar Poliza");
        return false;
    } else if (referencia.trim() == "") {
        alertify.alert("Campo Vacio", "Debe de ingresar Referencia");
        return false;
    } else if (pesoT.trim() == "" || pesoT == 0) {
        alertify.alert("Campo Vacio", "Debe de ingresar Peso");
        return false;
    } else if (volumenT.trim() == "" || volumenT == 0) {
        alertify.alert("Campo Vacio", "Debe de ingresar Volumen");
        return false;
    } else if (bultosT.trim() == "" || bultosT == 0) {
        alertify.alert("Campo Vacio", "Debe de ingresar Bultos");
        return false;
    } else if (cntClientes.trim() == "" || cntClientes == 0) {
        alertify.alert("Campo Vacio", "Debe de ingresar Cantidad de Clientes");
        return false;
    } else if (fechaI.trim() == "") {
        alertify.alert("Campo Vacio", "Debe de ingresar Fecha Ingreso Almacen");
        return false;
    }
    var formAlmacen = new FormData($("#formAlmacen")[0]);
    $.ajax({
        url: "../ajax/kardex.php?op=guardaryeditar",
        type: "POST",
        data: formAlmacen,
        contentType: false,
        processData: false,
        success: function (datos) {
            datos = JSON.parse(datos);
            if (datos.idkardex > 0) {
                $("#Tkardex").DataTable().ajax.reload();
                $("#idAlmacenD").val(datos.idkardex);
                alertify.success("Proceso Realizado con exito");
                $("#btnNuevoDetalle").prop("disabled",false);
                $("#grabaAlmacen").prop("disabled", true);
            } else {
                alertify.error("Proceso no se pudo realizar") + " " + datos;
            }
        },
    });
}

function listarKardex() {
    tablaK = $("#Tkardex").dataTable({
        aProcessing: true, //Activamos el procesamiento del datatables
        aServerSide: true, //Paginacion y fltrado realizado por el servidor
        dom: "Bfrtip", //Definimos los elementos de control de tabla
        buttons: ["copyHtml5", "excelHtml5", "pdfHtml5"],
        ajax: {
            url: "../ajax/kardex.php?op=listarK",
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            },
        },
        bDestroy: true,
        iDisplayLenth: 10, //paginacion
        order: [
            [8, "desc"]
        ], //order los datos
    });
}

function ListarAlmacen(idAlmacen) {
    nuevoAlma();
    $.post(
        "../ajax/kardex.php?op=mostrarA", {
            idAlmacen: idAlmacen,
        },

        function (data, status) {
            data = JSON.parse(data);
            if (data.id_almacen > 0) {
                ocultaAlma(true);
                $("#idAlmacen").val(data.id_almacen);
                $("#idAlmacenD").val(data.id_almacen);
                $("#codigoAlmacen").val(data.codigo);
                $("#consignadoKardex").val(data.id_consignado);
                $("#consignadoKardex").selectpicker("refresh");
                $("#consignadoKardex").val(data.contenedor_placa);
                $("#poliza").val(data.poliza);
                $("#referencia").val(data.referencia);
                $("#pesoT").val(data.peso);
                $("#volumenT").val(data.volumen);
                $("#bultosT").val(data.bultos);
                $("#cntClientes").val(data.cant_clientes);
                $("#fechaI").val(data.fechaI);
                $("#btnNuevoDetalle").removeAttr("disabled");
                $("#grabaAlmacen").removeAttr("disabled");
                nuevoDetalle("false");
                listarTablaDA(idAlmacen);
            } else {
                alertify.alert("Error", "Ha ocurrido un error");
            }
        }
    );
}

function grabaDetalle() {
    var cliente = $("#cliente").prop("selectedIndex");
    var peso = $("#peso").val();
    var volumen = $("#volumen").val();
    var bultos = $("#bultos").val();
    var embalaje = $("#embalajeD").prop("selectedIndex");
    var merca = $("#mercaderia").val();

    if (cliente == -1 || cliente == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar el Cliente");
        return false;
    } else if (peso == 0) {
        alertify.alert("Campo Vacio", "Debe de colocar el Peso");
        return false;
    } else if (volumen == 0) {
        alertify.alert("Campo Vacio", "Debe de colocar el Volumen");
        return false;
    } else if (bultos == 0) {
        alertify.alert("Campo Vacio", "Debe de colocar los bultos");
        return faslse;
    } else if (embalaje == -1 || embalaje == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar Embalaje");
        return false;
    } else if (merca.trim() == "") {
        alertify.alert("Campo Vacio", "Debe de Ingresar Mercaderia");
        return false;
    }
    formDAlmacen = new FormData($("#formAlmacenDetalle")[0]);
    $.ajax({
        url: "../ajax/detalleAlmacen.php?op=guardaryeditar",
        type: "POST",
        data: formDAlmacen,
        contentType: false,
        processData: false,
        success: function (datos) {
            if (datos > 0) {
                $("#Tdetalle").DataTable().ajax.reload();
                $("#Tkardex").DataTable().ajax.reload();
                alertify.success("Proceso Realizado con exito");
                $("#btnNuevoDetalle").removeAttr("disabled");
                nuevoDetalle("false");
            } else {
                alertify.error("Proceso no se pudo realizar") + " " + datos;
            }
        },
    });
}

function listarTablaDA(idAlmacenD) {
    tablaDA = $("#Tdetalle").dataTable({
        aProcessing: true, //Activamos el procesamiento del datatables
        aServerSide: true, //Paginacion y fltrado realizado por el servidor
        dom: "Bfrtip", //Definimos los elementos de control de tabla
        buttons: ["copyHtml5", "excelHtml5", "pdfHtml5"],
        ajax: {
            url: "../ajax/detalleAlmacen.php?op=listarDA",
            type: "post",
            data: {
                idAlmacenD: idAlmacenD,
            },
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            },
        },
        bDestroy: true,
        iDisplayLenth: 10, //paginacion
        order: [
            [0, "desc"]
        ], //order los datos
    });
}

function mostrarDetalleA(iddetallealmacen) {
    nuevoDetalle("true");
    $.post(
        "../ajax/detalleAlmacen.php?op=mostrarDetalleA", {
            iddetallealmacen: iddetallealmacen,
        },
        function (data, status) {
            data = JSON.parse(data);
            if (data.id_detalle > 0) {
                $("#iddetallealmacen").val(data.id_detalle);

                $("#idAlmacenD").val(data.id_almacen);
                $("#cliente").val(data.id_cliente);
                $("#cliente").selectpicker("refresh");

                $("#nohbl").val(data.nohbl);
                $("#peso").val(data.peso);
                $("#volumen").val(data.volumen);
                $("#bultos").val(data.bultos);
                $("#ubicacion").val(data.ubicacion);
                $("#dut").val(data.dut);
                $("#embalajeD").val(data.id_embalaje);
                $("#embalajeD").selectpicker("refresh");
                if (data.liberado == "1") {
                    $("#liberado").prop("checked", "true");
                } else {
                    $("#liberado").removeAttr("checked");
                }
                $("#resa").val(data.resa);
                $("#dti").val(data.dti);
                $("#ncancel").val(data.no_cancel);
                $("#norden").val(data.no_orden);
                $("#linea").val(data.linea);
                $("#mercaderia").val(data.mercaderia);
                $("#observaciones").val(data.observaciones);
            } else {
                alertify.alert("Error", "Ha ocurrido un error");
            }
        }
    );
}

function anulaDetalle(iddetallealmacen) {
    var confirm = alertify
        .confirm("", "Desea Anular Detalle", null, null)
        .set("labels", {
            ok: "Anular",
            cancel: "Cancelar",
        });

    confirm.set({
        transition: "slide",
    });

    confirm.set("onok", function () {
        $.post(
            "../ajax/detalleAlmacen.php?op=anularDetalle", {
                iddetallealmacen: iddetallealmacen,
            },
            function (data) {
                if (data > 0) {
                    $("#Tkardex").DataTable().ajax.reload();
                    alertify.alert("", "Detalle Anulado");
                }
            }
        );
    });
}

function sumaCifImpuesto() {
    var cif = $("#cifCalculo").val();
    var impuesto = $("#impuestoCalculo").val();
    var baseS = 0;

    if (cif.trim() == "") {
        cif = 0;
    }
    if (impuesto.trim() == "") {
        impuesto = 0;
    }
    baseS = parseFloat(cif) + parseFloat(impuesto);
    $("#bSeguroCalculo").val(baseS);
}

function CancelarCalculoMostrado() {
    $("#calculoAlmacen").hide();
}

function CargaCalculoNuevo(id_detalleA_calculo) {
    $("#plantillaCalculoAlmacen").hide();
    $("#calculoAlmacen").show();
    $("#btngrabarCalculo").prop("disabled",true);
    
    limpiaNuevoCalculo();
    $.post(
        "../ajax/calculoAlmacen.php?op=MostrarCalculoNuevo", {
            id_detalleA_calculo: id_detalleA_calculo,
        },

        function (data, status) {
            data = JSON.parse(data);
            if (data.id_detalle > 0) {
                // $("#idAlmacen").val(data.id_almacen);
                $("#id_detalleA_calculo").val(data.id_detalle);
                $("#polizaEntradaCalculo").val(data.poliza);
                $("#pesoCalculo").val(data.peso);
                $("#VolumenCalculo").val(data.volumen);
                $("#bultosCalculoTotal").val(data.bultos);

                $("#bultosCalculoPen").val(data.bultos);

                $("#clientesCuadrilla").val(data.cant_clientes);
                $("#CantClientes").val(data.cant_clientes);
                $("#delCalculoA").val(data.fechaI);
                listarClienteCalculo(data.id_detalle);
                $("#clienteCalculoA").prop("selectedIndex", 2);
                $("#clienteCalculoA").selectpicker("refresh");
                llenaPlantillaBM("#plantilla");
                $("calculoAlmacen").show();
                $("#porcentajefinanciado").val(data.financiacion);
                buscarDatosclienteCalculo(data.id_cliente);
                $("#alCalculoA").datepicker("setDate", "0");

                calcularDias();
                llenacantidadCalculo(id_detalleA_calculo);
                llenaDescuentos();
            } else {
                alertify.alert("Error", "Ha ocurrido un error");
            }
        }
    );
}

function buscarDatosclienteCalculo(clienteCalculoA) {
    $.post(
        "../ajax/calculoAlmacen.php?op=datosCliente", {
            clienteCalculoA: clienteCalculoA,
        },
        function (data, status) {
            data = JSON.parse(data);
            if (data.id_empresa > 0) {
                $("#direccionCalculo").val(data.direccion);
                $("#nitCalculo").val(data.identificacion);
            } else {
                alertify.alert("Error", "Ha ocurrido un error");
            }
        }
    );
}

function listarClienteCalculo(id_detalleA_calculo) {
    $.post(
        "../ajax/calculoAlmacen.php?op=listarCliente", {
            id_detalleA_calculo: id_detalleA_calculo,
        },
        function (data, status) {
            $("#clienteCalculoA").html(data);
            $("#clienteCalculoA").selectpicker("refresh");
            $("#clienteCalculoA").prop("selectedIndex", 2);
            $("#clienteCalculoA").selectpicker("refresh");
        }
    );
}

function limpiaNuevoCalculo() {
    $("#clienteCalculoA").val(0);
    $("#clienteCalculoA").selectpicker("refresh");

    $("#dutCalculo").val("");
    $("#polizaSalida").val("");
    $("#ordenSalida").val("");
    $("#tipoCambioCalculo").val(0);
    $("#cifCalculo").val(0);
    $("#cifgtdolar").val(0);
    $("#impuestoCalculo").val(0);
    $("#bSeguroCalculo").val(0);
    $("#bultosCalculoTotal").val(0);
    $("#bultosCalculoPen").val(0);
    $("#clientesCuadrilla").val(0);
    $("#CantClientes").val(0);
    $("#volumenCalculo").val(0);
    $("#pesoCalculo").val(0);
    $("#plantilla").val(0);
    $("#plantilla").selectpicker("refresh");
    $("#financiado").val(0);
    $("#porcentajefinanciado").val(0);
    $("#subtotal").val(0);
    $("#iva").val(0);
    $("#total").val(0);
    $("#TcalculosALmacenP").DataTable().clear().draw();
    $("#diasLibre").val(0);
    $("#aplicaF").prop("checked", false);
    $("#descuentoValor").val(0);
    $("#isrCalculo").val(0);
    $("#alcaldiaCalculo").val(0);
}

function calcularDias() {
    var delCalculoA = $("#delCalculoA").val();
    var alCalculoA = $("#alCalculoA").val();
    $("#totalDias").val(0);

    $.post(
        "../ajax/calculoAlmacen.php?op=contarDias", {
            delCalculoA: delCalculoA,
            alCalculoA: alCalculoA,
        },
        function (data, status) {
            $("#totalDias").val(data);
            calculardiaslmacenaje();
        }
    );
}



function calcularCifDolares() {
    var tc = $("#tipoCambioCalculo").val();
    var cif = $("#cifgtdolar").val();
    var res = 0;
    if (tc.trim() == "") {
        tc = 0;
    }
    if (cif.trim() == "") {
        cif = 0;
    }
    res = parseFloat(tc) * parseFloat(cif);
    res = res.toFixed(3);
    $("#cifCalculo").val(res);
    sumaCifImpuesto();
}

function limpiarPlantillaG() {
    $("#nombrePlantillaG").val("");
    $("#tarifaMinimaG").val(0);
    $("#diasLibresPlantillaG").val(0);
    $("#grabarNuevaP").removeAttr("disabled");
    $("#idplantillaG").val(0);
    $("#omitirDiasLibre").removeAttr("checked");
    $("#monedaPlantillaG").val(0);
    $("#monedaPlantillaG").selectpicker("refresh");
}

function grabarPlnatillaAlmacen() {
    var nombre = $("#nombrePlantillaG").val();
    var tarifa = $("#tarifaMinimaG").val();
    var diaslibres = $("#diasLibresPlantillaG").val();
    var moneda = $("#monedaPlantillaG").prop("selectedIndex");

    if (nombre.trim() == "") {
        alertify.alert("Campo Vacio", "Debe de colocar el nombre");
        return false;
    } else if (tarifa.trim() == "" || tarifa == 0) {
        alertify.alert("Campo Vacio", "Debe de colocar Tarifa Minima");
        return false;
    } else if (moneda == -1 || moneda == 0) {
        alertify.alert("Campo Vacio", "Debe de seleccionar la Moneda");
        return false;
    } else if (diaslibres.trim() == "" || diaslibres == 0) {
        alertify.alert("Campo Vacio", "Debe de colocar Dias Libres de Almacenaje");
        return false;
    }
    var frmPlantilla = new FormData($("#frmNuevaPlantillaA")[0]);
    $.ajax({
        url: "../ajax/plantillaCalculoAlmacen.php?op=guardaryeditar",
        type: "POST",
        data: frmPlantilla,
        contentType: false,
        processData: false,
        success: function (datos) {
            if (datos > 0) {
                alertify.success("Proceso Realizado con exito");
                $("#grabarNuevaP").prop("disabled", "true");
                llenaPlantillaBM("#plantillaBG");
                llenaPlantillaBM("#plantilla");
                llenaPlantillaBM("#agregarPlantilla");
            } else {
                alertify.error("Proceso no se pudo realizar") + " " + datos;
            }
        },
    });
}
//

function llenaPlantillaBM(selecPlantilla) {
    $(selecPlantilla).empty();
    $.post(
        "../modelos/pais.php?op=selectN&tabla=plantilla_calculoa&campo=nombre", {
            id: "id_plantilla",
            tipoe: "",
        },
        function (data, status) {
            $(selecPlantilla).html(data);
            $(selecPlantilla).selectpicker("refresh");
            $(selecPlantilla).val(0);
            $(selecPlantilla).selectpicker("refresh");
        }
    );
}

function llenaMoneda() {
    $("#monedaPlantillaG").empty();
    $.post("../modelos/pais.php?op=llenaMoneda", {}, function (data, status) {
        $("#monedaPlantillaG").html(data);
        $("#monedaPlantillaG").selectpicker("refresh");
        $("#monedaPlantillaG").val(0);
        $("#monedaPlantillaG").selectpicker("refresh");
    });
}

function cargaNombrePlantilla(quienLLama) {
    if (quienLLama == 1) {
        var idplantillaG = $("#plantillaBG").val();
        limpiarPlantillaG();
        $.post(
            "../ajax/plantillaCalculoAlmacen.php?op=mostrarP", {
                idplantillaG: idplantillaG,
            },
            function (data, status) {
                data = JSON.parse(data);
                if (data.id_plantilla >= 1) {
                    $("#nombrePlantillaG").val(data.nombre);
                    $("#monedaPlantillaG").selectpicker("refresh");
                    $("#monedaPlantillaG").val(data.moneda);
                    $("#monedaPlantillaG").selectpicker("refresh");
                    $("#diasLibresPlantillaG").val(data.dias_libres);
                    $("#idplantillaG").val(data.id_plantilla);
                    $("#tarifaMinimaG").val(data.tarifa_minima);
                    if (data.omitir_almacenaje == "1") {
                        $("#omitirDiasLibreG").prop("checked", true);
                    } else {
                        $("#omitirDiasLibreG").prop("checked", false);
                    }
                    $("#grabarNuevaP").removeAttr("disabled");
                }
            }
        );
    } else {
        var idplantillaG = $("#agregarPlantilla").val();
        $.post(
            "../ajax/plantillaCalculoAlmacen.php?op=mostrarP", {
                idplantillaG: idplantillaG,
            },
            function (data, status) {
                data = JSON.parse(data);
                if (data.id_plantilla >= 1) {
                    $("#monedaPlantillaG").selectpicker("refresh");
                    $("#monedaPlantillaG").val(data.moneda);
                    $("#monedaPlantillaG").selectpicker("refresh");
                    $("#diasLibresPlantillaMP").val(data.dias_libres);
                    $("#idplantillaMP").val(data.id_plantilla);
                    $("#idMonedaPlantillaMP").val(data.moneda);

                    $("#tarifaMinimaMP").val(data.signo + " " + data.tarifa_minima);
                    if (data.omitir_almacenaje == "1") {
                        $("#omitirDias").prop("checked", true);
                    } else {
                        $("#omitirDias").prop("checked", false);
                    }
                    listarDetallePlantillaA(data.id_plantilla);
                    //$('#TplantillaG').DataTable().ajax.reload();
                }
            }
        );
    }
}

function llenaCatalogoCalculoA() {
    $("#catalogoPlantillaAlmacen").empty();
    $.post(
        "../modelos/pais.php?op=selectN&tabla=catalogo&campo=nombre", {
            id: "id_catalogo",
            tipoe: "",
        },
        function (data, status) {
            $("#catalogoPlantillaAlmacen").html(data);
            $("#catalogoPlantillaAlmacen").selectpicker("refresh");
            $("#catalogoPlantillaAlmacen").val(0);
            $("#catalogoPlantillaAlmacen").selectpicker("refresh");
        }
    );
}

function nuevoCatalogoCalculoA() {
    $("#llamaCalculoA").val("calculoA");
    llenaCatalogoModal();
    limpiarmodalCatalogo();
}

function nuevoDetallePlantilla() {
    limpiarDetallePlantilla();
    $("#btnGrabarDetallePlantilla").removeAttr("disabled");
}

function limpiarDetallePlantilla() {
    $("#catalogoPlantillaAlmacen").val(0);
    $("#catalogoPlantillaAlmacen").selectpicker("refresh");
    $("#minimoDetallePlantillaA").val(0);
    $("#tarifaDetallePlantillaA").val(0);
    $("#porcentajeDetallePA").val(0);
    $("#porPeso").prop("checked", false);
    $("#porVolumen").prop("checked", false);
    $("#porDia").prop("checked", false);
    $("#iddetallePlantilla").val(0);
    $("#btnGrabarDetallePlantilla").prop("disabled", "true");
}

function grabarDetallePlantilla() {

    var idcatalogo = $("#catalogoPlantillaAlmacen").prop("selectedIndex");
    var idplantilla = $("#idplantillaMP").val();

    if (idplantilla == 0 || idplantilla.trim() == "") {
        alertify.alert("Campo Vacio", "Debe de Seleccionar una Plantilla");
        return false;
    } else if (idcatalogo == -1 || idcatalogo == 0) {
        alertify.alert("Campo Vacio", "Debe de Seleccionar una Descripciòn");
        return false;
    }
    var frmPlantilla = new FormData($("#frmDetallePlnatillaA")[0]);
    $.ajax({
        url: "../ajax/detalle_plantillaA.php?op=guardaryeditar",
        type: "POST",
        data: frmPlantilla,
        contentType: false,
        processData: false,
        success: function (datos) {
            if (datos > 0) {
                alertify.success("Proceso Realizado con exito");
                $("#btnGrabarDetallePlantilla").prop("disabled", "true");
                $("#TplantillaG").DataTable().ajax.reload();
                listarDetallePlantillaA(idplantilla);

                limpiarDetallePlantilla();
            } else {
                alertify.error("Proceso no se pudo realizar") + " " + datos;
            }
        },
    });
}

function nuevaPlantillaCalculo() {
    $("#btnGrabarDetallePlantilla").prop("disabled", "true");
}

function listarDetallePlantillaA(idplantillaMP) {
    $("#TplantillaG").dataTable({
        aProcessing: true, //Activamos el procesamiento del datatables
        aServerSide: true, //Paginacion y fltrado realizado por el servidor
        dom: "Bfrtip", //Definimos los elementos de control de tabla
        buttons: ["copyHtml5", "excelHtml5", "pdfHtml5"],
        ajax: {
            url: "../ajax/detalle_plantillaA.php?op=listarDP",
            type: "post",
            dataType: "json",
            data: {
                idplantillaMP: idplantillaMP,
            },
            error: function (e) {
                console.log(e.responseText);
            },
        },
        bDestroy: true,
        iDisplayLenth: 10, //paginacion
        order: [
            [0, "desc"]
        ], //order los datos
    });
}

function mostrarDetallePlantilla(iddetallePlantilla) {
    $.post(
        "../ajax/detalle_plantillaA.php?op=mostrarDP", {
            iddetallePlantilla: iddetallePlantilla,
        },

        function (data, status) {
            data = JSON.parse(data);
            if (data.id_detalle >= 1) {
                $("#iddetallePlantilla").val(data.id_detalle);
                $("#catalogoPlantillaAlmacen").val(data.id_catalogo);
                $("#catalogoPlantillaAlmacen").selectpicker("refresh");
                $("#minimoDetallePlantillaA").val(data.minimo);
                $("#tarifaDetallePlantillaA").val(data.tarifa);
                $("#porcentajeDetallePA").val(data.porcentaje);

                if (data.por_peso == "1") {
                    $("#porPeso").prop("checked", true);
                } else {
                    $("#porPeso").prop("checked", false);
                }

                if (data.por_volumen == "1") {
                    $("#porVolumen").prop("checked", true);
                } else {
                    $("#porVolumen").prop("checked", false);
                }
                if (data.por_dia == "1") {
                    $("#porDia").prop("checked", true);
                } else {
                    $("#porDia").prop("checked", false);
                }
                $("#btnGrabarDetallePlantilla").removeAttr("disabled");
            }
        }
    );
}

function eliminarDetallePlantilla(iddetallePlantilla) {
    var idplantilla = $("#idplantillaMP").val();
    $.post(
        "../ajax/detalle_plantillaA.php?op=eliminaDetalleP", {
            iddetallePlantilla: iddetallePlantilla,
        },
        function (data, status) {
            data = JSON.parse(data);
            if (data >= 1) {
                listarDetallePlantillaA(idplantilla);
                Swal.fire("Eliminado con Exito!", "Aceptar!", "success");
            }
        }
    );
}

function nuevaPlantillaCalculo() {
    $("#plantillaCalculoAlmacen").show();
    $("#calculoAlmacen").hide();
}

function cancelarPlantillaCalculo() {
    $("#plantillaCalculoAlmacen").hide();
    $("#calculoAlmacen").show();
}

function cargaCalulosPlantilla() {
    // enviar fecha desde hasta
    // enviar peso y volumen
    // base para seguro
    //bultos y clientes para cuadrilla

    var plantilla = $("#plantilla").val();
    //$("#diaslPC").val(data.dias_libres);
    //$("#TotalMinimo").val(data.tarifa_minima);
    //$("#diascompletoPC").val(1);

    $("#TcalculosALmacenP").dataTable({
        aProcessing: true, //Activamos el procesamiento del datatables
        aServerSide: true, //Paginacion y fltrado realizado por el servidor
        dom: "Brti", //Definimos los elementos de control de tabla
        buttons: ["pdfHtml5"],
        ajax: {
            url: "../ajax/calculoAlmacen.php?op=llenaTablacalculo",
            type: "post",
            dataType: "json",
            data: {
                plantilla: plantilla,
            },
            error: function (e) {
                console.log(e.responseText);
            },
        },
        bDestroy: true,
        iDisplayLenth: 10, //paginacion
        order: [
            [0, "desc"]
        ], //order los datos
        /*  "columnDefs": [
                {
                    "targets": [ 8 ],
                    "visible": false,
                    "searchable": false
                }
            ] */
    });
}

function sumarcalculo() {
    var cif = $("#cifCalculo").val();
    var impuesto = $("#impuestoCalculo").val();
    var fechaf = $("#alCalculoA").val();
    var idplantilla = $("#plantilla").val();

    if (cif == 0 || cif.trim() == "") {
        alertify.alert("Error", "Debe de Ingresar el Valor CIF");
        return false;
    }
    if (impuesto == 0 || impuesto.trim() == "") {
        alertify.alert("Error", "Debe de ingresar el valor Impuesto");
        return false;
    }
    if (fechaf.trim() == "") {
        alertify.alert("Error", "Debe de ingresar la fecha Final del Calculo");
        return false;
    }
    if (idplantilla == 0) {
        alertify.alert("Error", "Debe de seleccionar una plantilla");
        return false;
    }

    var valor = document.getElementsByName("Descripcion[]");

    var total = 0;
    var contval = 0;
    var iddetalle;
    var sumaotros = 0;
    var iva = 0;
    var subtotal = 0;

    var valor1 = 0;
    var total1 = 0;

    contval = valor.length;

    //for (var i = 0; i < valor.length; i++) {
    //    iddetalle = document.getElementById("TcalculosALmacenP").rows[i + 1].cells[0]
    //        .innerText;
    //    contval = contval - 1;
    //    ejecutarFormulas(iddetalle, $("#valorSumar"+iddetalle).val(), function (resp) {});
    //contval = $("#valorDescripcion"+i).val();
    //total = total + parseFloat(contval);
    //}
    $("input[name='id_detalle[]']").each(function (indice, elemento) {
        //console.log('El elemento con el índice '+indice+' contiene '+$(elemento).val());
        iddetalle = $(elemento).val();
        ejecutarFormulas(
            iddetalle,
            $("#valorSumar" + iddetalle).val(),
            function (resp) {}
        );
        /*     for (var i = 0; i < cont.length; i++) {
                valor = $("#valorDescripcion"+i).val();
                total = total + parseFloat(valor);
            } */
    });
    /* for (var i = 0; i < valor.length; i++) {
        iddetalle = document.getElementById("TcalculosALmacenP").rows[i + 1].cells[0].innerText;
        subtotal = parseFloat($("#valorDescripcion"+iddetalle).val());
        sumaotros = sumaotros + parseFloat($("#ivaDescripcion"+iddetalle).val());
      } */

    /*  $("input[name='ivaDescripcion[]']").each(function (indice, elemento) {
        valor1 = $(elemento).val();
        total1 = total1 + parseFloat(valor1);
      });
      $("#iva").val(total1);
     iva = $("#iva").val();
     subtotal = $("#subtotal").val(); */
}

function sumarValores() {
    var total = 0;
    var valor = 0;
    var valor1 = 0;

    var total1 = 0;

    var valor2 = 0;
    var total2 = 0;
    var iddescuento =0;
    var valDescuento=0;
    var temp =0;

    iddescuento = $("#descuento").prop("selectedIndex");

   
    $("#subtotal").val(0);
    $("#iva").val(0);
    $("#financiado").val(0);
    // var oi=0;  //Objeto indicie
    // var thisObj;
    // var objs = document.getElementsByName("valorDescripcion[]");
    // for (oi=0;oi<objs.length;oi++) {
    //     thisObj = objs[oi];
    //          alert(thisObj.value);
    //  }
    if ($("#aplicaF").prop("checked")) {
        $("#financiado").val(
            parseFloat($("#total").val()) *
            parseFloat($("#porcentajefinanciado").val() / 100)
        );
        //
        $("#financiado").val($("#financiado").val());
    }

    $("input[name='valorDescripcion[]']").each(function (indice, elemento) {
        //console.log('El elemento con el índice '+indice+' contiene '+$(elemento).val());
        valor = $(elemento).val();
        total = total + parseFloat(valor);
        /*     for (var i = 0; i < cont.length; i++) {
                valor = $("#valorDescripcion"+i).val();
                total = total + parseFloat(valor);
            } */
    });
    $("input[name='valorSumar[]']").each(function (indice, elemento) {
        //console.log('El elemento con el índice '+indice+' contiene '+$(elemento).val());
        valor2 = $(elemento).val();
        total2 = total2 + parseFloat(valor2);
        /*     for (var i = 0; i < cont.length; i++) {
                valor = $("#valorDescripcion"+i).val();
                total = total + parseFloat(valor);
            } */
    });
    $("input[name='ivaDescripcion[]']").each(function (indice, elemento) {
        //console.log('El elemento con el índice '+indice+' contiene '+$(elemento).val());
        valor1 = $(elemento).val();
        total1 = total1 + parseFloat(valor1);
        /*     for (var i = 0; i < cont.length; i++) {
                valor = $("#valorDescripcion"+i).val();
                total = total + parseFloat(valor);
            } */
    });

    $("#iva").val(total1);
    $("#subtotal").val(parseFloat(total) + parseFloat(total2));

    var financiado = parseFloat($("#financiado").val());

    if (financiado == "" || isNaN(financiado)){
        financiado =0;
    }
    $("#total").val(
        parseFloat(total1) + parseFloat(total) + financiado
    );
    if (iddescuento == -1 || iddescuento == 0){
        $("#descuentoValor").val(0);
    }else{
        valDescuento = $("#descuento option:selected").html()
        $("#descuentoValor").val(parseFloat($("#total").val())* (parseFloat(valDescuento)/100)); 
        $("#descuentoValor").val(numerosDecimal($("#descuentoValor").val())) 
    }

    $("#grantotal").val(parseFloat($("#total").val())-parseFloat($("#descuentoValor").val()));

    /* if ($("#aplicaF").prop("checked")) {
        $("#financiado").val(
            parseFloat($("#total").val()) *
            parseFloat($("#porcentajefinanciado").val() / 100)
        );
        //
        $("#financiado").val($("#financiado").val());
    } */
    /*    $("input[name='ivaDescripcion[]']").each(function (indice, elemento) {    
        valor1 = $(elemento).val();
        total1 = total1 + parseFloat(valor1);
    });
      $("#iva").val(total1); */
}

function calcularIvaTotal(subtotal, iddetalle) {
    var valor;
    var elemento = $("#ivaDescripcion" + iddetalle);
    $.post(
        "../ajax/calculoAlmacen.php?op=calculariva", {
            subtotal: subtotal,
        },
        function (data, status) {
            elemento.val(data);
        }
    );
    return valor;
}

/* 
function funcionAsync (datos, callback){
    jQuery.ajax({
    type: 'POST',
    url: ajaxurl,
    data: datos,
    success: function (data) {
        callback(null, data);
    },
    error: function (errorThrown) {callback(errorThown);}
    });
  } */
/*  Y para la ejecución de la función :

funcionAsync(mis_datos, function(errorLanzado, datosDevueltos){
    if(errorLanzado) // Ha habido un error, deberías manejarlo :/
    return;
    // Tu código para hacer algo con datosDevueltos va aquí
  }); */
function verificaOcultarchk(iddetalle) {
    if ($('#ocultar' + iddetalle).prop('checked')) {
        $('#prorratear' + iddetalle).prop('checked', false);
    }
}

function verificarProrratearcheck(iddetalle) {
    if ($('#prorratear' + iddetalle).prop('checked')) {
        $('#ocultar' + iddetalle).prop('checked', false);
    }
}

function ejecutarFormulas(iddetalle, otrovalor, callback) {
    var delCalculoA = $("#delCalculoA").val();
    var alCalculoA = $("#alCalculoA").val();
    var impuestoCalculo = $("#impuestoCalculo").val();
    var bSeguroCalculo = $("#bSeguroCalculo").val();
    var pesoCalculo = $("#pesoCalculo").val();
    var volumenCalculo = $("#volumenCalculo").val();
    var bultosCalculoPen = $("#bultosCalculoPen").val();
    var clientesCuadrilla = $("#clientesCuadrilla").val();
    var diaslPC = $("#diaslPC").val();
    var TotalMinimo = $("#TotalMinimo").val();
    var diascompletoPC = $("#diascompletoPC").val();
    var diasAlmacenaje = $("#diasAlmacenaje").val();
    var totalDias = $("#totalDias").val();
    var tipoCambioCalculo = $("#tipoCambioCalculo").val();

    var valor;
    var cifCalculo = $("#cifCalculo").val();
    $.ajax({
        async: true,
        cache: false,
        dataType: "html",
        type: "POST",
        url: "../ajax/calculoAlmacen.php?op=calcular",
        data: {
            delCalculoA: delCalculoA,
            alCalculoA: alCalculoA,
            impuestoCalculo: impuestoCalculo,
            bSeguroCalculo: bSeguroCalculo,
            pesoCalculo: pesoCalculo,
            volumenCalculo: volumenCalculo,
            bultosCalculoPen: bultosCalculoPen,
            clientesCuadrilla: clientesCuadrilla,
            diaslPC: diaslPC,
            TotalMinimo: TotalMinimo,
            diascompletoPC: diascompletoPC,
            diasAlmacenaje: diasAlmacenaje,
            totalDias: totalDias,
            tipoCambioCalculo: tipoCambioCalculo,
            iddetalle: iddetalle,
            cifCalculo: cifCalculo,
            otrovalor: otrovalor,
            'ocultar[]': $("#ocultar").serialize()
        },
        success: function (respuesta) {
            respuesta = JSON.parse(respuesta);
            $("#valorDescripcion" + iddetalle).val(respuesta.valor);
            $("#ivaDescripcion" + iddetalle).val(respuesta.iva);
            sumarValores();
        },
        beforeSend: function () {},
    });
    return valor;
}
function nuevoCalculo() {
    limpiatotales();
    $("#btngrabarCalculo").prop("disabled",false);
    $("#plantilla").val(0);
    $("#plantilla").selectpicker("refresh");
    $("#aplicaF").prop("checked", false);
    $("#exentoIva").prop("checked", false);
    cargaPlantillaparaCalculo();
    cargaCalulosPlantilla();
}
function limpiatotales(){
    $("#isrCalculo").val(0);
    $("#alcaldiaCalculo").val(0);
    $("#financiado").val(0);
    $("#descuentoValor").val(0);
    $("#subtotal").val(0);
    $("#iva").val(0);
    $("#total").val(0);
}
function calcularTotal() {
    limpiatotales();
    var plantilla = $("#plantilla").prop("selectedIndex");
    var cif = $("#cifCalculo").val();
    var impuesto = $("#impuestoCalculo").val();
    var fechaf = $("#alCalculoA").val();

    if (cif == 0 || cif.trim() == "") {
        alertify.alert("Error", "Debe de Ingresar el Valor CIF");
        return false;
    }
    if (impuesto == 0 || impuesto.trim() == "") {
        alertify.alert("Error", "Debe de ingresar el valor Impuesto");
        return false;
    }
    if (fechaf.trim() == "") {
        alertify.alert("Error", "Debe de ingresar la fecha Final del Calculo");
        return false;
    }
    if (plantilla ==0 || plantilla == -1){
        alertify.alert ("Campo Vacio","Debe de seleccionar una Plantilla");
        return false ;
    }
    var frmPlantilla = new FormData($("#frmCalculoAlmacen")[0]);
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "../ajax/calculoAlmacen.php?op=CalcularTotal",
        data: frmPlantilla,
        contentType: false,
        processData: false,
        success: function (resp) {
            // $("tbodyDetaplantilla tr").remove();
            $("#TcalculosALmacenP > tbody").empty();
            $('#tbodyDetaplantilla').append(resp);
            sumarValores() ;
        }
    });
}

function cargaPlantillaparaCalculo() {
    var idplantillaG = $("#plantilla").val();
    $.post(
        "../ajax/plantillaCalculoAlmacen.php?op=mostrarP", {
            idplantillaG: idplantillaG,
        },
        function (data, status) {
            data = JSON.parse(data);
            if (data.id_plantilla >= 1) {
                $("#diaslPC").val(data.dias_libres);
                $("#diasLibre").val(data.dias_libres);
                $("#TotalMinimo").val(data.tarifa_minima);
                if (data.omitir_almacenaje == "1") {
                    $("#diascompletoPC").val(1);
                } else {
                    $("#diascompletoPC").val(0);
                }
                calculardiaslmacenaje();
            }
        }
    );
}

function calculardiaslmacenaje() {
    var tdias = $("#totalDias").val();
    var diasl = $("#diasLibre").val();
    var diasa = 0;
    if (tdias == "") {
        tdias = 0;
    }

    if (diasl == "") {
        diasl = 0;
    }
    diasa = tdias - diasl;
    if (diasa < 0) {
        diasa = 0;
    }
    $("#diasAlmacenaje").val(diasa);
}

function nuevocalculoMismoCliente() {
    $("#isrCalculo").val(0);
    $("#alcaldiaCalculo").val(0);
    $("#financiado").val(0);
    $("#subtotal").val(0);
    $("#iva").val(0);
    $("#aplicaF").prop("checked", false);
    $("#exentoIva").prop("checked", false);
    $("#descuentoValor").val(0);
    $("#total").val(0);
    $("#plantilla").val(0);
    $("#plantilla").selectpicker("refresh");
    $("#descuento").val(0);
    $("#descuento").selectpicker("refresh");
}

function grabarCalculo() {
    var cif = $("#cifCalculo").val();
    var impuesto = $("#impuestoCalculo").val();
    var fechaf = $("#alCalculoA").val();
    var idplantilla = $("#plantilla").val();

    if (cif == 0 || cif.trim() == "") {
        alertify.alert("Error", "Debe de Ingresar el Valor CIF");
        return false;
    }
    if (impuesto == 0 || impuesto.trim() == "") {
        alertify.alert("Error", "Debe de ingresar el valor Impuesto");
        return false;
    }
    if (fechaf.trim() == "") {
        alertify.alert("Error", "Debe de ingresar la fecha Final del Calculo");
        return false;
    }
    if (idplantilla == 0) {
        alertify.alert("Error", "Debe de seleccionar una plantilla");
        return false;
    }
    var frmCalculoAlmacen = new FormData($("#frmCalculoAlmacen")[0]);

    $.ajax({
        url: "../ajax/calculoAlmacen.php?op=guardaryeditar",
        type: "POST",
        data: frmCalculoAlmacen,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta == 1) {
                Swal.fire({
                    icon: "success",
                    title: "",
                    text: "Calculo Ingresado con Exito",
                });
                llenacantidadCalculo($("#id_detalleA_calculo").val());
            }
        },
        beforeSend: function () {},
    });
}

function llenacantidadCalculo(id_detalleA_calculo) {
    $.post(
        "../ajax/calculoAlmacen.php?op=llenaCalculos", {
            id_detalleA_calculo: id_detalleA_calculo,
        },
        function (data, status) {
            $("#cntCalculo").html(data);
            $("#cntCalculo").selectpicker("refresh");
            $("#cntCalculo").val(0);
            $("#cntCalculo").selectpicker("refresh");
        }
    );
}

function lleDatosCalculo(id_calculo) {
    $.post(
        "../ajax/calculoAlmacen.php?op=buscaCalculo", {
            id_calculo: id_calculo,
        },
        function (data, status) {
            data = JSON.parse(data);
            if (data.id_calculo > 0) {
                $("#id_calculo").val(data.id_catalogo);
                $("#clienteCalculoA").val(data.id_cliente);
                $("#ClienteCalculoA").selectpicker("refresh");
                $("#plantilla").val(data.id_plantilla);
                $("#plantilla").selectpicker("refresh");

                $("#direccionCalculo").val(data.direccion);
                $("#nitCalculo").val(data.identificacion);
                $("#totalDias").val(data.total_dias);
                $("#diasAlmacenaje").val(data.dias_almacen);
                $("#diasLibre").val(data.dias_libres);
                $("#delCalculoA").val(data.del);
                $("#alCalculoA").val(data.al);
                $("#dutCalculo").val(data.dut);
                $("#polizaSalida").val(data.poliza_salida);
                $("#ordenSalida").val(data.orden_salida);
                $("#tipoCambioCalculo").val(data.tipo_cambio);
                $("#cifgtdolar").val(data.cif_dolares);
                $("#cifCalculo").val(data.cif);
                $("#impuestoCalculo").val(data.impuesto);
                $("#bSeguroCalculo").val(data.base_seguro);
                $("#bultosCalculoPen").val(data.bultos_retirados);
                $("#pesoCalculo").val(data.peso);
                $("#volumenCalculo").val(data.volumen);
                $("#CantClientes").val(data.cntClientes);
                $("#clientesCuadrilla").val(data.cnt_cuadrilla);
                $("#descuento").val(data.id_descuento);
                $("#descuento").selectpicker("refresh");
                $("#descuentoValor").val(data.descuento_valor);
                $("#financiado").val(data.financiacion_valor);
                $("#financiado").number(true, 2);
                $("#porcentajefinanciado").val(data.financiacion_porcentaje);
                if (data.aplica_financiacion == 1) {
                    $("#aplicaF").prop("checked", true);
                } else {
                    $("#aplicaF").prop("checked", false);
                }
                $("#subtotal").val(data.subtotal);
                $("#iva").val(data.iva);
                if (data.exento_iva == 1) {
                    $("#exentoIva").prop("checked", true);
                } else {
                    $("#exentoIva").prop("checked", false);
                }
                $("#total").val(data.total);
                $("#isrCalculo").val(data.isr);
                $("#alcaldiaCalculo").val(data.alcaldia);
                cargaPlantillaCalculoGrabado(id_calculo);
            } else {
                alertify.error("Proceso no se pudo realizar");
            }
        }
    );
}

function cargaPlantillaCalculoGrabado(id_calculo) {
    //idcalculo valor a enviar
    $("#TcalculosALmacenP").dataTable({
        aProcessing: true, //Activamos el procesamiento del datatables
        aServerSide: true, //Paginacion y fltrado realizado por el servidor
        dom: "Brti", //Definimos los elementos de control de tabla
        buttons: ["pdfHtml5"],
        ajax: {
            url: "../ajax/calculoAlmacen.php?op=buscaCalculoDetalle",
            type: "post",
            dataType: "json",
            data: {
                id_calculo: id_calculo,
            },
            error: function (e) {
                console.log(e.responseText);
            },
        },
        bDestroy: true,
        iDisplayLenth: 10, //paginacion
        order: [
            [0, "desc"]
        ], //order los datos
        /*  "columnDefs": [
                {
                    "targets": [ 8 ],
                    "visible": false,
                    "searchable": false
                }
            ] */
    });
}
init();