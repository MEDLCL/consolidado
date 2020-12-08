var tabla;

function init() {
    llenasucursales();
    cargapais();
}

function llenasucursales() {
    tabla = $('#listadosucursal').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginacion y fltrado realizado por el servidor
        dom: 'Bfrtip', //Definimos los elementos de control de tabla
        buttons: ['copyHtml5', 'excelHtml5', 'pdfHtml5'],
        "ajax": {
            url: '../ajax/sucursal.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLenth": 5, //paginacion
        "order": [
                [0, "desc"]
            ] //order los datos

    });
}

function mostrarsucursal(idsucursal) {
    $.post("../ajax/sucursal.php?op=mostrar", {
            idsucursal: idsucursal
        },
        function(data, status) {
            limpiar();
            $("#actualizadatos").addClass("btn btn-warning");
            $("#actualizadatos").html("Actualizar");

            data = JSON.parse(data);
            $("#razons").val(data.razons);
            $("#nombrec").val(data.nombrec);
            $("#Telefono").val(data.Telefono);
            $("#pais").val(data.idpais);
            $("#pais").selectpicker('refresh');
            $("#identificacion").val(data.identificacion);
            $("#logo_actual").val(data.logo);
            $("#logo_muestra").attr("src", "../logos/" + data.logo);
            $("#direccion").val(data.direccion);
            $("#idsucursal").val(data.id_sucursal);
        })
}

function editarinsertar() {
    var form = new FormData($("#formsucursal")[0]);
    var razons = $("#razons").val();
    var nombrec = $("#nombrec").val();
    var telefono = $("#Telefono").val();
    var pais = $("#pais").prop("selectedIndex");
    var dni = $("#identificacion").val();
    var dir = $("#direccion").val();
    if (razons.trim() == "") {
        alertify.alert("Campo Obligatorio", "Debe de ingresar Razon social");
        return false;
    } else if (nombrec.trim() == "") {
        alertify.alert("Campo Obligatorio", "Debe de ingresar Nombre Comercial");
        return false;
    } else if (telefono.trim() == "") {
        alertify.alert("Campo Obligatorio", "Debe de ingresar un Telefono");
        return false;
    } else if (pais == -1) {
        alertify.alert("Campo Obligatorio", "Debe de seleccionar un Pais");
        return false;
    } else if (dni.trim() == "") {
        alertify.alert("Campo Obligatorio", "Debe de ingresar el No de Identificacion");
        return false;
    } else if (dir.trim() == "") {
        alertify.alert("Campo Obligatorio", "Debe de ingresar la direccion");
        return false;
    }

    $.ajax({
        url: "../ajax/sucursal.php?op=guardaryeditar",
        type: "POST",
        data: form,
        contentType: false,
        processData: false,
        success: function(datos) {
            if (datos == 1) {
                limpiar();
                $('#listadosucursal').DataTable().ajax.reload();
                alertify.success("Proceso Realizado con exito");
                $("#modalsucursal").modal("hide");
            } else {
                alertify.error("Proceso no se pudo realizar") + " " + datos;
            }
        }
    });

}

function limpiar() {
    $("#formsucursal")[0].reset();
    $("#idsucursal").val("");
    $("#logo_muestra").attr("src", "");
    $("#actualizadatos").removeClass("btn btn-warning");
    $("#actualizadatos").addClass("btn btn-succes");
    $("#actualizadatos").html("Grabar")
    $("#pais").val(0);
    $("#pais").selectpicker('refresh');

}

function activar(idsucursal) {
    var confirm = alertify.confirm('Activando', 'Desea Activar Sucursal', null, null).set('labels', { ok: 'Activar', cancel: 'Cancelar' });

    confirm.set({ transition: 'slide' });

    confirm.set('onok', function() {
        $.post(
            '../ajax/sucursal.php?op=activar', { idsucursal: idsucursal },
            function(data, status) {
                if (data == 1) {
                    $('#listadosucursal').DataTable().ajax.reload();
                    alertify.alert("", "Sucursal Activada");
                } else {
                    alertify.alert("", "No se pudo activar");
                }
            }
        );
    });
}

function inactivar(idsucursal) {
    var confirm = alertify.confirm('', 'Desea Desactivar Sucursal', null, null).set('labels', { ok: 'Desactivar', cancel: 'Cancelar' });

    confirm.set({ transition: 'slide' });

    confirm.set('onok', function() {
        $.post(
            '../ajax/sucursal.php?op=Desactivar', { idsucursal: idsucursal },
            function(data, status) {
                if (data == 1) {
                    $('#listadosucursal').DataTable().ajax.reload();
                    alertify.alert("", "Sucursal inactiva");
                } else {
                    alertify.alert("", "No se pudo inactivar");
                }
            }
        );
    });
}

function cargapais(){
    $.post (
        '../modelos/pais.php?op=pais&tabla=pais&campo=nombre',{},
        function(data,status){
            $('#pais').html(data);
            $("#pais").val(0);
            $("#pais").selectpicker('refresh');
        }
    );
}
init();