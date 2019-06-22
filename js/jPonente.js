// function ponente(id_evento) {
//     $("#txtIdEventoPonente").val(id_evento);
// }

function reprograma(id_evento, nombreEvento) {
    $("#txtIdEventoReprograma").val(id_evento);
    $('#nombreEvento').html(nombreEvento);
}

function cancelar(id_evento, nombreEvento) {
    $("#txtIdEventoCancelar").val(id_evento);
    $('#nombreEventoCancela').html(nombreEvento);
}

function limpiarModalPonente() {
    $('#cboPonente').val("0").trigger('change.select2');
}

function RegistrarPonente() {
    var ponente = document.getElementById("cboPonente").value;
    var idEvento = $('#txtIdEventoPonente').val();
    $.ajax({
        method: "POST",
        url: 'index.php?page=asistencia&action=registrarPonente',
        data: {'ponente': ponente, 'idEvento': idEvento}
    })
    .done(function(text) {
        if (text.respuesta == "true") {
            window.location.href = text.link;
        }else{
            swal({
                title: text,
                // text: 'I will close in 2 seconds.',
                icon: 'success',
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
            $('#ponente').modal('hide');
            limpiarModalPonente();
        }
    })
}

function CerrarRegistrarPonente() {
    $('#ponente').modal('hide');
    limpiarModalPonente();
}

function limpiarModalReprograma() {
    $("#fechaInicioEvento").val("");
    $("#fechaFinEvento").val("");
    $("#HoraEvento").val("");
    $("#comentario").val("");
}

function Reprograma() {
    var fechaInicio = $('#fechaInicioEvento').val();
    var fechaFin = $('#fechaFinEvento').val();
    var horaEvento = $('#HoraEvento').val();
    var comentario = $('#comentario').val();
    var idEvento = $('#txtIdEventoReprograma').val();
    $.ajax({
        method: "POST",
        url: 'index.php?page=asistencia&action=reprogramaEvento',
        data: {'fechaInicio': fechaInicio, 'fechaFin': fechaFin, 'horaEvento': horaEvento, 'comentario': comentario, 'idEvento': idEvento}
    })
    .done(function(text) {
        swal({
            title: text,
            // text: 'I will close in 2 seconds.',
            icon: 'success',
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
        $('#reprogramar').modal('hide');
        limpiarModalReprograma();
    })
}

function CerrarReprograma() {
    $('#reprogramar').modal('hide');
    limpiarModalReprograma();
}

function limpiarModalCancelar() {
    $("#comentarioCancelacion").val("");
}

function CancelarEvento() {
    var comentarioCancelar = $('#comentarioCancelacion').val();
    var idEvento = $('#txtIdEventoCancelar').val();
    $.ajax({
        method: "POST",
        url: 'index.php?page=asistencia&action=cancelarEvento',
        data: {'comentarioCancelar': comentarioCancelar, 'idEvento': idEvento}
    })
    .done(function(text) {
        swal({
            title: text,
            icon: 'success',
            timer: 2000,
            button: false
        }).then(
            function() {
                location.reload();
            }
        )
        $('#cancelar').modal('hide');
        limpiarModalCancelar();

    })
}