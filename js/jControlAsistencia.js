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

$(document).ready(() => {
    var asistencia = $('select[name=cmbAsistencia]').val();

    id_apertura = $('#txtApertura').val();
    estado = $('#txtEstado').val();
    if (asistencia != 0) {
        if (id_apertura == '') {
            document.getElementById("txtDNI").disabled = true;
        } else {
            if (estado == "3") {
                document.getElementById("txtDNI").disabled = true;
                $("#cmbAsistencia").prop("disabled", true);
            } else {
                document.getElementById("txtDNI").disabled = false;
                $("#cmbAsistencia").prop("disabled", false);
            }
        }
    } else {
        document.getElementById("txtDNI").disabled = true;
    }

    idEvento = $('#txtIdEvento').val();
    listaParticipantes(idEvento);
});

$("select[name=cmbAsistencia]").change(function() {
    var asistencia = $('select[name=cmbAsistencia]').val();
    document.getElementById("txtDNI").disabled = false;

});

$(document).on('keyup', '#txtDNI', function(event) {
    if (event.which == 13) {
        dni = $('#txtDNI').val();
        idEvento = $('#txtIdEvento').val();
        var asistencia = $('select[name=cmbAsistencia]').val();
        switch (asistencia) {
            case "1":
                $.ajax({
                        method: "POST",
                        url: 'index.php?page=asistencia&action=aperturaAsistencia',
                        data: { 'dni': dni, 'idEvento': idEvento }
                    })
                    .done(function(text) {
                        swal({
                            title: text,
                            icon: 'success',
                            timer: 3000,
                            button: false
                        }).then(
                            function() {
                                location.reload();
                            },
                        )
                    });
                break;

            case "2":
                $.ajax({
                        method: "POST",
                        url: 'index.php?page=asistencia&action=entradaAsistencia',
                        data: { 'dni': dni, 'idEvento': idEvento }
                    })
                    .done(function(text) {
                        listaParticipantes(idEvento);
                        swal({
                            title: text,
                            icon: 'success',
                            timer: 3000,
                            button: false
                        }).then(
                            function() {
                                document.getElementById("txtDNI").value = "";
                                document.getElementById("txtDNI").autofocus;
                            },
                        )
                    });
                break;

            case "3":
                $.ajax({
                        method: "POST",
                        url: 'index.php?page=asistencia&action=salidaAsistencia',
                        data: { 'dni': dni, 'idEvento': idEvento }
                    })
                    .done(function(text) {
                        listaParticipantes(idEvento);
                        swal({
                            title: text,
                            icon: 'success',
                            timer: 3000,
                            button: false
                        }).then(
                            function() {
                                document.getElementById("txtDNI").value = "";
                                document.getElementById("txtDNI").autofocus;
                            },
                        )
                    });
                break;

            case "4":
                $.ajax({
                        method: "POST",
                        url: 'index.php?page=asistencia&action=SalidaPermiso',
                        data: { 'dni': dni, 'idEvento': idEvento }
                    })
                    .done(function(text) {
                        swal({
                            title: text,
                            icon: 'success',
                            timer: 3000,
                            button: false
                        }).then(
                            function() {
                                document.getElementById("txtDNI").value = "";
                                document.getElementById("txtDNI").autofocus;
                            },
                        )
                    });
                break;

            case "5":
                $.ajax({
                        method: "POST",
                        url: 'index.php?page=asistencia&action=EntradaPermiso',
                        data: { 'dni': dni, 'idEvento': idEvento }
                    })
                    .done(function(text) {
                        swal({
                            title: text,
                            icon: 'success',
                            timer: 3000,
                            button: false
                        }).then(
                            function() {
                                document.getElementById("txtDNI").value = "";
                                document.getElementById("txtDNI").autofocus;
                            },
                        )
                    });
                break;

            case "6":
                $.ajax({
                        method: "POST",
                        url: 'index.php?page=asistencia&action=cerrarAsistencia',
                        data: { 'dni': dni, 'idEvento': idEvento }
                    })
                    .done(function(text) {
                        swal({
                            title: text,
                            icon: 'success',
                            timer: 3000,
                            button: false
                        }).then(
                            function() {
                                location.reload();
                            },
                        )
                    });
                break;

            default:
                document.getElementById("txtDNI").disabled = true;
                break;
        }
    }
});

var listaParticipantes = function(idEvento) {
    var options = {
        type: 'POST',
        url: 'index.php?page=asistencia&action=listarParticipantes',
        data: {
            'idEvento': idEvento
        },
        dataType: 'html',
        success: function(response) {
            $('#tabladt').dataTable().fnDestroy();
            $("#listaParticipante").html(response);
        }
    };
    $.ajax(options);
};

function VerificarDNI(term) {
    var options = {
        type: 'GET',
        url: "http://172.17.128.37:8043/ws_pj/index.php?page=reniec&action=consultarxdni",
        data: { 'term': term },
        dataType: 'json',
        success: function(response) {
            reniec_ws = response;
            var hora = moment().format('HH:mm');
            $('#nombre_completo').html(response.nombres + ' ' + response.apellidopaterno + ' ' + response.apellidomaterno);
            if (hora >= '12:00') {
                $('#hora').html(hora + ' pm');
            } else {
                $('#hora').html(hora + ' am');
            }
            var image = new Image();
            image = document.getElementById("imagen");
            image.src = 'data:image/png;base64,' + response.res_foto;
        }
    };
    $.ajax(options).fail(function(jqXHR, textStatus, errorThrown) {
        reniec_ws = null;
    });
}

function controlPermisos(id_asistencia, nombreCompleto) {
    $('#nombreAsistente').html(nombreCompleto);
    var options = {
        type: 'POST',
        url: 'index.php?page=asistencia&action=listarPermisos',
        data: {
            'id_asistencia': id_asistencia
        },
        dataType: 'html',
        success: function(response) {
            $('#tabladt').dataTable().fnDestroy();
            $("#listaPpermiso").html(response);
        }
    };
    $.ajax(options);
}

var desactivarAsistencias = function(id_asistencia, idEvento) {
    $.ajax({
            method: "POST",
            url: 'index.php?page=asistencia&action=desactivarAsistencia',
            data: { 'id_asistencia': id_asistencia }
        })
        .done(function(text) {
            swal({
                title: text,
                icon: 'success',
                timer: 3000,
                button: false
            }).then(
                function() {
                    listaParticipantes(idEvento);
                },
            )
        });
};

function desactivarAsistencia(id_asistencia, idEvento) {
    swal({
        text: 'Esta seguro que desea desactivar la asitencia?',
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

            desactivarAsistencias(id_asistencia, idEvento);
        }
    })
}