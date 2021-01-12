var tabla;

function init() {
    //cargarpermisos(0);
    llenasucursal();
    llenadepto();
    llenapuesto();
    $("#datosusuario").hide();
    llenausuarios();
}

function llenausuarios() {
    tabla = $('#Tusuarios').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginacion y fltrado realizado por el servidor
        dom: 'Bfrtip', //Definimos los elementos de control de tabla
        buttons: ['copyHtml5', 'excelHtml5', 'pdfHtml5'],
        "ajax": {
            url: '../ajax/usuario.php?op=listar',
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

function cargarpermisos(idusuario) {
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "../ajax/usuario.php?op=permisos&idup=" + idusuario,
        data: idusuario,
        success: function(resp) {
            $('#tablapermisos').append(resp);
        }
    });
}

function llenasucursal() {
    $.post(
        '../modelos/pais.php?op=selectP&tabla=sucursal&campo=razons', {
            id: "id_sucursal"
        },
        function(data, status) {
            $('#sucursal').html(data);
            $("#sucursal").selectpicker('refresh');
        }
    );
}

function llenadepto() {
    $.post(
        '../modelos/pais.php?op=selectP&tabla=depto&campo=nombre', {
            id: "id_depto"
        },
        function(data, status) {
            $('#depto').html(data);
            $("#depto").selectpicker('refresh');


        }
    );
}

function llenapuesto() {
    $.post(
        '../modelos/pais.php?op=selectP&tabla=puesto&campo=nombre', {
            id: "id_puesto"
        },
        function(data, status) {
            $('#puesto').html(data);
            $("#puesto").selectpicker('refresh');
        }
    );
}

function nuevousuario() {
    limpiar();
    $("#datosusuario").show();
    $("#tablausuario").hide();
    cargarpermisos(0);
}

function grabarusuario() {
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var correo = $("#correo").val();
    var acceso = $("#acceso").val();
    var pass = $("#pass").val();
    var sucursal = $("#sucursal").prop("selectedIndex");
    var depto = $("#depto").prop("selectedIndex");
    var puesto = $("#puesto").prop("selectedIndex");
    var cont = 0;
    if (nombre.trim() == "") {
        alertify.alert("Campo en blanco", "Debe de ingresar el Nombre");
        return false;
    } else if (apellido.trim() == "") {
        alertify.alert("Campo en blanco", "Debe de ingresar Apellido");
        return false;
    } else if (validaCorreo(correo) == false) {
        alertify.alert("Correo No valido", "Debe de ingresar Correo valido");
        return false;
    } else if (correo.trim() == "") {
        alertify.alert("Campo en blanco", "Debe de ingresar Correo");
        return false;

    } else if (acceso.trim() == "") {
        alertify.alert("Campo en blanco", "Debe de ingresar Login");
        return false;
    } else if (pass.trim() == "") {
        alertify.alert("Campo en blanco", "Debe de ingresar Password");
        return false;
    } else if (sucursal == -1) {
        alertify.alert("Campo en blanco", "Debe de seleccionar Sucursal");
        return false;
    } else if (depto == -1) {
        alertify.alert("Campo en blanco", "Debe de seleccionar Departamento");
        return false;
    } else if (puesto == -1) {
        alertify.alert("Campo en blanco", "Debe de seleccionar Puesto");
        return false;
    } else {
        $("#formusuario input[type= checkbox]").each(function() {
            if (this.checked) {
                cont = cont + 1;
            }
        });
        if (cont == 0) {
            alertify.alert("", "Debe de seleccionar almenos una opcion de Menu");
            return false;
        }
        var form = new FormData($("#formusuario")[0]);

        $.ajax({
            url: "../ajax/usuario.php?op=guardaryeditar",
            type: "POST",
            data: form,
            contentType: false,
            processData: false,
            success: function(datos) {
                if (datos) {
                    $('#Tusuarios').DataTable().ajax.reload();
                    alertify.success(datos);
                    $("#datosusuario").hide();
                    $("#tablausuario").show();
                } else {
                    alertify.error("Usuario no registrado");
                }
            }
        });
    }

}

function cargatablausuarios() {
    tabla = $('#listadosucursal').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginacion y fltrado realizado por el servidor
        dom: 'Bfrtip', //Definimos los elementos de control de tabla
        buttons: ['copyHtml5', 'excelHtml5', 'pdfHtml5'],
        "ajax": {
            url: '../ajax/usuario.php?op=listar',
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

function limpiar() {

    $("#nombre").val("");
    $("#idusuario").val(0);
    $("#apellido").val("");
    $("#correo").val("");
    $("#acceso").val("");
    $("#pass").val("");
    $("#avatar_muestra").attr("src", "");
    $("#avatar_actual").val("");
    $("#sucursal").val(0);
    $("#sucursal").selectpicker('refresh');
    $("#depto").val(0);
    $("#depto").selectpicker('refresh');
    $("#puesto").val(0);
    $("#puesto").selectpicker("refresh");
    $('#tablapermisos').html('');

}

function mostrarUsuario(idusuario) {
    limpiar();

    $.post("../ajax/usuario.php?op=mostrar", { idusuario: idusuario },
        function(data, status) {

            data = JSON.parse(data);
            $("#datosusuario").show();
            $("#tablausuario").hide();

            $("#nombre").val(data['nombre']);
            $("#apellido").val(data.apellido);
            $("#correo").val(data.correo);
            $("#acceso").val(data.acceso);
            $("#sucursal").val(data.id_sucursal);
            $("#sucursal").selectpicker('refresh');
            $("#depto").val(data.id_depto);
            $("#depto").selectpicker('refresh');
            $("#puesto").val(data.id_puesto);
            $("#puesto").selectpicker('refresh');
            $("#avatar_actual").val(data.avatar);
            $("#avatar_muestra").attr("src", "../img/avatar/" + data.avatar);
            $("#idusuario").val(data.id_usuario);
            cargarpermisos(data.id_usuario);
        })
}

function cancelar() {
    $("#datosusuario").hide();
    $("#tablausuario").show();
}

function desactivar(idusuario) {
    $.post("../ajax/usuario.php?op=desactivar", { idusuario: idusuario },
        function(data, status) {
            if (status == "success") {
                $('#Tusuarios').DataTable().ajax.reload();
                alertify.success("Usuario Desactivado");
            }
        })
}

function activar(idusuario) {
    $.post("../ajax/usuario.php?op=activar", { idusuario: idusuario },
        function(data, status) {
            if (status == "success") {
                $('#Tusuarios').DataTable().ajax.reload();
                alertify.success("Usuario Activado");
            }
        })
}
init();