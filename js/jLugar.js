function AceptarLugar() {
    if (verificarFormulario()) {
        var datax = $('#frmLugar').serializeArray();
        $.ajax({
                method: "POST",
                url: 'index.php?page=lugar&action=registrarLugar',
                data: datax
            })
            .done(function(text) {
                swal({
                    title: text,
                    icon: 'success',
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

                if (text.substring(0, 2) != "Lo") {
                    listarLugar();
                    LimpiarCampos();
                }
            });
    }
}

function verificarFormulario() {
    correcto = true;
    msj = "Llenar todo el formulario";

    var nombre = $('#txtNombreLugar').val();
    var ubicacion = $('#txtUbicacion').val();
    var referencia = $('#txtReferencia').val();

    if (nombre == '') {
        correcto = false;
        $('#txtNombreLugar').css('border-color', 'red');
    } else {
        $('#txtNombreLugar').css('border-color', '');
    }

    if (ubicacion == '') {
        correcto = false;
        $('#txtUbicacion').css('border-color', 'red');
    } else {
        $('#txtUbicacion').css('border-color', '');
    }

    if (referencia == '') {
        correcto = false;
        $('#txtReferencia').css('border-color', 'red');
    } else {
        $('#txtReferencia').css('border-color', '');
    }

    if (!correcto) {
        swal({
            title: 'ALERTA!',
            text: msj,
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
    }
    return correcto;
}

function LimpiarCampos() {
    document.getElementById("txtIdLugar").value = 0;
    document.getElementById("txtNombreLugar").value = "";
    document.getElementById("txtUbicacion").value = "";
    document.getElementById("txtReferencia").value = "";
}

$(document).ready(function() {
    listarLugar();
});

function listarLugar() {
    var options = {
        type: 'POST',
        url: 'index.php?page=lugar&action=consultarLugar',
        dataType: 'html',
        success: function(response) {
            $('#tabladt').dataTable().fnDestroy();
            $("#tbodys").html(response);
            $('#tabladt').DataTable({
                "bLengthChange": false,
                "lengthMenu": [10],
                "language": spanish_datatable
            });
        }
    };
    $.ajax(options);
}

function EditaLugar(id_lugar) {
    $.ajax({
            method: "POST",
            url: 'index.php?page=lugar&action=consultarLugarById',
            data: { 'id_lugar': id_lugar }
        })
        .done(function(text) {
            if (text != '[]') {
                var json = JSON.parse(text);
                $('#txtIdLugar').val(json.id_lugar);
                $('#txtNombreLugar').val(json.nombre_lugar);
                $('#txtUbicacion').val(json.ubicacion_lugar);
                $('#txtReferencia').val(json.referencia_lugar);
            }
        });
}

function EliminarLugar(id_lugar, estado) {
    var msj = '';
    if (estado == 'I') { msj = '¿Esta seguro de eliminar el lugar?' }
    swal({
        text: msj,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f51b5',
        cancelButtonColor: '#ff4081',
        confirmButtonText: 'Great ',
        buttons: {
            cancel: {
                text: "Cancelar",
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
        console.log(result);
        if (result) {
            ProcesoCambiarEstadoLugar(id_lugar, estado);
        }
    })
}

function ProcesoCambiarEstadoLugar(id_lugar, estado) {
    $.ajax({
            method: "POST",
            url: 'index.php?page=lugar&action=eliminarLugar',
            data: { 'id_lugar': id_lugar, 'estado': estado }
        })
        .done(function(text) {
            swal({
                title: text,
                icon: 'success',
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
            listarLugar();
        })
}