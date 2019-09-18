function habilitarUsuarios(idusuario) {

    swal({
        text: 'Esta seguro que desea habilitar al usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f51b5',
        cancelButtonColor: '#ff4081',
        confirmButtonText: 'Great ',
        buttons: {
            cancel: {
                text: "Cancel",
                value: null,
                visible: true,
                className: "btn btn-danger",
                closeModal: true,
            },
            confirm: {
                text: "Aceptar",
                value: true,
                visible: true,
                className: "btn btn-primary",
                closeModal: true
            }
        }
    }).then(function(result) {
        if (result) {

            activarUsuarios(idusuario);
        }
    })
}

var activarUsuarios = function(idusuario) {
    var options = {
        type: 'POST',
        url: 'index.php?page=registroManual&action=habilitarUsuario',
        data: {
            'codusuario': idusuario
        },
        dataType: 'json',
        success: function(response) {
            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            });

            listarUsuarios();
        }
    };
    $.ajax(options);
};

function deshabilitarUsuarios(idusuario) {

    swal({
        text: 'Esta seguro que desea deshabilitar al usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f51b5',
        cancelButtonColor: '#ff4081',
        confirmButtonText: 'Great ',
        buttons: {
            cancel: {
                text: "Cancel",
                value: null,
                visible: true,
                className: "btn btn-danger",
                closeModal: true,
            },
            confirm: {
                text: "Aceptar",
                value: true,
                visible: true,
                className: "btn btn-primary",
                closeModal: true
            }
        }
    }).then(function(result) {
        if (result) {

            eliminarUsuarios(idusuario);
        }
    })
}

var eliminarUsuarios = function(idusuario) {
    var options = {
        type: 'POST',
        url: 'index.php?page=registroManual&action=deshabilitarUsuario',
        data: {
            'codusuario': idusuario
        },
        dataType: 'json',
        success: function(response) {
            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            });

            listarUsuarios();

        }
    };
    $.ajax(options);
};


$(document).ready(() => {
    listarUsuarios();
})
var listarUsuarios = function() {
    var options = {
        type: 'POST',
        url: 'index.php?page=registroManual&action=listarUsuario',
        data: {},
        dataType: 'html',
        success: function(response) {
            $('#tabladt').dataTable().fnDestroy();
            $("#listadousuarios").html(response);
            $('#tabladt').DataTable({
                "bLengthChange": false,
                "lengthMenu": [10],
                "language": spanish_datatable
            });


        }
    };
    $.ajax(options);
};

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
    event.preventDefault();
    if (event.which == 13) {
        term = $('#txtDNI').val();
        if (term.length >= 0) {
            ValidarDNI(term);
        }
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

                swal({
                    title: 'El usuario ya esta registrado',
                    icon: 'warning',
                    timer: 2000,
                    button: false
                }).then(
                    function() {},
                    function(dismiss) {
                        if (dismiss === 'timer') {
                            console.log('I was closed by the timer')
                        }
                    }
                )
                $("#txtDNI").val("");
                $("#txtnombreApellidos").val("");
            }
        });
}

function VerificarDNI(term) {
    var options = {
        type: 'GET',
        url: "http://7196073ed36e.sn.mynetname.net:8010/ws_pj/index.php?page=reniec&action=consultarxdni",
        data: { 'term': term },
        dataType: 'json',
        beforeSend: function() {
            $('#exampleModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#exampleModal').modal('show');

        },
        success: function(response) {
            $('#exampleModal').modal('hide');
            reniec_ws = response;
            $('#txtnombreApellidos').val(response.nombres + ' ' + response.apellidopaterno + ' ' + response.apellidomaterno);
            $("#txtnombres").val(response.nombres);
            $("#txtapeparterno").val(response.apellidopaterno);
            $("#txtapematerno").val(response.apellidomaterno);
        }
    };
    $.ajax(options).fail(function(jqXHR, textStatus, errorThrown) {
        reniec_ws = null;


        let mensaje = "";
        if (jqXHR.status === 0) {

            // alert('Not connect: Verify Network.');
            mensaje = "No se pudo conectae: Verifique la red.";

            // swal("Good job!", "You clicked the button!", "warning")

        } else if (jqXHR.status == 404) {

            // alert('Requested page not found [404]');
            mensaje = "Página solicitada no encontrada [404]"

        } else if (jqXHR.status == 500) {

            // alert('Error interno del servidor reniec [500].');
            mensaje = "Error interno del servidor reniec [500].";

        } else if (textStatus === 'parsererror') {

            // alert('Requested JSON parse failed.');
            mensaje = "Dni no encontrado";


        } else if (textStatus === 'timeout') {

            // alert('Time out error.');
            mensaje = "Error de tiempo de espera.";

        } else if (textStatus === 'abort') {

            // alert('Ajax request aborted.');
            mensaje = "Solicitud de Ajax abortada";

        } else {

            alert('Uncaught Error: ' + jqXHR.responseText);

        }
        $('#exampleModal').modal('hide');
        swal({
            title: "información!",
            text: mensaje,
            icon: "warning",
            showCancelButton: true,
            closeOnConfirm: false
        });

    });




    ;
}

$(document).ready(() => {
    $("#frmRegistro").validate({
        rules: {
            txtDNI: 'required',
            txtnombreApellidos: 'required',
            txtContrasena: 'required'
        },
        messages: {
            txtDNI: 'Ingrese su DNI',
            txtnombreApellidos: 'El campo DNI no esta completo',
            txtContrasena: 'Ingrese una contraseña',
        }
    });
});

$(document).on('submit', '#frmRegistro', function(event) {
    event.preventDefault();
    AceptarUsuario();
});

function LimpiarCampos() {
    document.getElementById("txtIdPersona").value = "";
    document.getElementById("txtDNI").value = "";
    document.getElementById("txtnombreApellidos").value = "";
    document.getElementById("txtCorreo").value = "";
    document.getElementById("txtTelefono").value = "";
    document.getElementById("txtAnexo").value = "";
    document.getElementById("txtContrasena").value = "";
}

function AceptarUsuario() {
    var datax = $('#frmRegistro').serializeArray();
    $.ajax({
            method: "POST",
            url: 'index.php?page=registroManual&action=registrarUsuario',
            data: datax
        })
        .done(function(text) {
            if (text.substring(0, 2) != "Us") {
                swal({
                    title: text,
                    icon: 'success',
                    timer: 3000,
                    button: false
                }).then(
                    function() {},
                )
                listarUsuarios();
                LimpiarCampos();
            } else {
                swal({
                    title: text,
                    icon: 'warning',
                    timer: 3000,
                    button: false
                }).then(
                    function() {
                        document.getElementById("txtIdPersona").value = "";
                        document.getElementById("txtDNI").value = "";
                    },
                )
            }
        });
}