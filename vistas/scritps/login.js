function init() {

}

function ingresar() {
    var codigol = $('#codigol').val();
    var logina = $("#logina").val();
    var passa = $("#clavea").val();


    if (codigol.trim() == "") {
        alertify.alert("Campo Vacio", "Debe de ingresar el codigo");
        return false;
    } else if (logina.trim() == "") {
        alertify.alert("Campo Vacio", "Debe de ingresar la usuario");
        return false;
    } else if (passa.trim() == '') {
        alertify.alert("Campo Vacio", "Debe de ingresar el password");
    } else {
        var frmacceso = new FormData($("#frmAcceso")[0]);
        $.ajax({
            type: "POST",
            url: "../ajax/login.php?op=ingreso",
            data: frmacceso,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    $(location).attr("href", "principal.php");
                } else {
                    alertify.alert("Acceso", "Datos incorrectos");
                }
            },
            error: function() {

            }
        });

    }
}


init();