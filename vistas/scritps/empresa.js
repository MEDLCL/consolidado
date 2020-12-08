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
    '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
    '<td >'+nombre +'</td>'+
    '<td >'+apellido +'</td>'+
    '<td >'+correo +'</td>'+
    '<td >'+telefono +'</td>'+
    '<td >'+puesto +'</td>'+
    '</tr>';
    $('#Tcontactos').append(fila);
}

init();