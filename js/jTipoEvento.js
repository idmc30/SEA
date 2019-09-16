function AceptarTipoEvento() {
    if (verificarFormulario()) {
        var datax = $('#frmTipoEvento').serializeArray();
        $.ajax({
                method: "POST",
                url: 'index.php?page=tipoEvento&action=registrarTipoEvento',
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
                    listarTipoEvento();
                    LimpiarCampos();
                }
            });
    }
}

function verificarFormulario() {
    correcto = true;
    msj = "Llenar todo el formulario";

    var nombre = $('#txtNombreTipoEvento').val();
    var descripcion = $('#txtDescripcionTipoEvento').val();

    if (nombre == '') {
        correcto = false;
        $('#txtNombreTipoEvento').css('border-color', 'red');
    } else {
        $('#txtNombreTipoEvento').css('border-color', '');
    }

    if (descripcion == '') {
        correcto = false;
        $('#txtDescripcionTipoEvento').css('border-color', 'red');
    } else {
        $('#txtDescripcionTipoEvento').css('border-color', '');
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
    document.getElementById("txtIdTipoEvento").value = 0;
    document.getElementById("txtNombreTipoEvento").value = "";
    document.getElementById("txtDescripcionTipoEvento").value = "";
}

$(document).ready(function() {
    listarTipoEvento();
});

function listarTipoEvento() {
    var options = {
        type: 'POST',
        url: 'index.php?page=tipoEvento&action=consultarTipoEvento',
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

function EditaTipoEvento(id_tipo_evento) {
    $.ajax({
            method: "POST",
            url: 'index.php?page=tipoEvento&action=consultarTipoEventoById',
            data: { 'id_tipo_evento': id_tipo_evento }
        })
        .done(function(text) {
            if (text != '[]') {
                var json = JSON.parse(text);
                $('#txtIdTipoEvento').val(json.evento_tipo_id);
                $('#txtNombreTipoEvento').val(json.evento_tipo_nombre);
                $('#txtDescripcionTipoEvento').val(json.evento_tipo_descripcion);
            }
        });
}

function EliminarTipoEvento(id_tipo_evento, estado) {
    var msj = '';
    if (estado == 'FALSE') { msj = '¿Esta seguro de eliminar el tipo de evento?' }
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
            ProcesoCambiarEstadoTipoEvento(id_tipo_evento, estado);
        }
    })
}

function ProcesoCambiarEstadoTipoEvento(id_tipo_evento, estado) {
    $.ajax({
            method: "POST",
            url: 'index.php?page=tipoEvento&action=eliminarTipoEvento',
            data: { 'id_tipo_evento': id_tipo_evento, 'estado': estado }
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
            listarTipoEvento();
        })
}