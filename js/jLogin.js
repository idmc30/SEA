function soloNumeros(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = "8-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}

$(document).ready(() => {
    $("#frmLogin").validate({
        rules: {
            txtDNI: 'required',
            txtContrasena: 'required'
        },
        messages: {
            txtDNI: 'Ingrese su DNI',
            txtContrasena: 'Ingrese una contraseña',
        }
    });
});

$(document).on('submit', '#frmLogin', function(event) {
    event.preventDefault();
    IngresoLogin();
});

function IngresoLogin() {
    var datax = $('#frmLogin').serializeArray();
    $.ajax({
            method: "POST",
            url: 'index.php?page=login&action=validaIngreso',
            data: datax
        })
        .done(function(text) {
            if (text.respuesta != "SR") {
                if (text.respuesta == "ingreso") {
                    window.location.href = text.link;
                } else {
                    swal({
                        title: 'DNI o contraseña invalido',
                        icon: 'warning',
                        timer: 2000,
                        button: false
                    }).then(
                        function() {},
                        // handling the promise rejection
                        function(dismiss) {
                            if (dismiss === 'timer') {
                                console.log('I was closed by the timer')
                            }
                        }
                    )
                }
            } else {
                swal({
                    title: 'El usuario no se encuentra registrado',
                    icon: 'warning',
                    timer: 2000,
                    button: false
                }).then(
                    function() {},
                    // handling the promise rejection
                    function(dismiss) {
                        if (dismiss === 'timer') {
                            console.log('I was closed by the timer')
                        }
                    }
                )
            }
        });
}