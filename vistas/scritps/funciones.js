function validaCorreo(email) {
    var regex = (/^([a-zA-Z0-9_+-])+\@(([a-zZ-a0-9])+\.)+([a-zA-Z0-9]{2,4})+/);
    return regex.test(email);

}

function validaCheck(check) {
    var cont;
    cont = 0;
    check.each(function() {
        if (this.checked) {
            cont = cont + 1;
        }
    });
    return cont;
}

function mayusculas(e) {
    return e.value = e.value.toUpperCase();
}

function salir() {
    $.ajax({
        type: "POST",
        url: "../ajax/login.php?op=salir",
        data: '',
        contentType: false,
        processData: false,
        success: function(data) {
            if (data == 1) {
                $(location).attr("href", "../../index.php");
            } else {
                $(location).attr("href", "../../index.php");
            }
        },
        error: function() {

        }
    });
}