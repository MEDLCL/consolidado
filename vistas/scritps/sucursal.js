var tabla;

function init() {
    llenasucursales();
}

function llenasucursales() {
    $('#listadosucursal').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginacion y fltrado realizado por el servidor
        dom: 'Bfrtip', //Definimos los elementos de control de tabla
        buttons: ['copyHtml5', 'excelHtml5'],
        "ajax": {
            url: '../ajax/sucursalajax.php?op=listar',
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
    $.post("../ajax/sucursalajax.php?op=mostrar", { idsucursal: idsucursal },
        function(data, status) {
            data = JSON.parse(data);
            $("#razons").val(data.razon_social);
            $("#nombrec").val(data.nombre_comercial);


        })
}

function limpiar() {
    $("#formsucursal")[0].reset();
}
init();