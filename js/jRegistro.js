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
};

$(document).on('keyup', '#txtDNI', function(event) {
    if (event.which == 13) {
        term = $('#txtDNI').val();
        document.getElementById('txtCorreo').focus();
        ValidarDNI(term);
    }
});

function ValidarDNI(term) {
    var datax = $('#frmRegistro').serializeArray();
    $.ajax({
            method: "POST",
            url: 'index.php?page=registro&action=consultarPersonaByDNI',
            data: datax
        })
        .done(function(text) {
            var term = text.dni;
            if (text.respuesta != "registrado") {
                VerificarDNI(term);
            } else {
                document.getElementById('txtDNI').focus();
                $('#txtDNI').val('');
                swal({
                    title: 'Usted ya esta registrado',
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

function VerificarDNI(term) {
    var options = {
        type: 'GET',
        url: "http://172.17.133.188/ws_pj/index.php?page=reniec&action=consultarxdni",
        data: { 'term': term },
        dataType: 'json',
        success: function(response) {
            reniec_ws = response;
            $('#txtnombreApellidos').val(response.nombres + ' ' + response.apellidopaterno + ' ' + response.apellidomaterno);
        }
    };
    $.ajax(options).fail(function(jqXHR, textStatus, errorThrown) {
        reniec_ws = null;
    });
}

$(document).ready(() => {
    $("#frmRegistro").validate({
        rules: {
            txtDNI: 'required',
            txtnombreApellidos: 'required',
            txtCorreo: 'required',
            txtTelefono: 'required',
            txtContrasena: 'required'
        },
        messages: {
            txtDNI: 'Ingrese su DNI',
            txtnombreApellidos: 'El campo DNI no esta completo',
            txtCorreo: 'Ingrese su correo',
            txtTelefono: 'Ingrese su telefono',
            txtContrasena: 'Ingrese una contraseña',
        }
    });
});

$(document).on('submit', '#frmRegistro', function(event) {
    event.preventDefault();
    AceptarUsuario();
});

function AceptarUsuario() {
    var datax = $('#frmRegistro').serializeArray();
    $.ajax({
            method: "POST",
            url: 'index.php?page=registro&action=registrarUsuario',
            data: datax
        })
        .done(function(text) {
            if (text.accion == "true") {
                swal({
                    text: 'Usuario registrado correctamente',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3f51b5',
                    cancelButtonColor: '#ff4081',
                    confirmButtonText: 'Great ',
                    buttons: {
                        confirm: {
                            text: "Aceptar",
                            value: true,
                            visible: true,
                            className: "btn btn-primary",
                            closeModal: true
                        }
                    }
                }).then(function(result) {
                    console.log(result);
                    if (result) {
                        window.location.href = text.link;
                    }
                })
            } else {
                swal({
                    text: 'Usuario ya se encuentra registrado',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3f51b5',
                    cancelButtonColor: '#ff4081',
                    confirmButtonText: 'Great ',
                    buttons: {
                        confirm: {
                            text: "Aceptar",
                            value: true,
                            visible: true,
                            className: "btn btn-primary",
                            closeModal: true
                        }
                    }
                }).then(function(result) {
                    console.log(result);
                    if (result) {
                        window.location.href = text.link;
                    }
                })
            }
        });
}