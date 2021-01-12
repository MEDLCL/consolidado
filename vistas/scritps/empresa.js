function init(){

}
var cont = 0;
function registrarc(){
    var nombre = $("#Nombre").val();
    var apellido = $("#Apellido").val();
    var correo = $("#Correo").val();
    var telefono = $("#telefonoc").val();
    var puesto = $("#puesto").val();

    var fila ='<tr class="filas" id ="fila'+cont +'">'+
    '<td><button type="button" class="btn btn-danger" onclick="eliminarfila('+cont+')"><span class="fa fa-trash-o"></span></button></td>'+
    '<td >'+nombre +'</td>'+
    '<td >'+apellido +'</td>'+
    '<td >'+correo +'</td>'+
    '<td >'+telefono +'</td>'+
    '<td >'+puesto +'</td>'+
    '</tr>';

    cont++;
    $('#Tcontactos').append(fila);
}
//funcion para eliminar fila de la tabla contactos
function eliminarfila(cont){
    $("#fila"+cont).remove();
}

function limpiar (){
    $("#").val();
    $("#").val();
    $("#").val();
    $("#").val();
    $("#").val();
    $("#").val();
    $("#").val();
    $("#").val();
    $("#").val();
    $("#").val();
    $("#").val();
    $("#").val();
}
init();