// $(document).ready(() => {
//     var asistencia = $('select[name=cmbAsistencia]').val();


//     listaParticipantes(idEvento);
// });


$("select[name=cmbevento]").change(function() {
    var idevento = $('select[name=cmbevento]').val();
    listaParticipantes(idevento);

});

var listaParticipantes = function(idEvento) {
    var options = {
        type: 'POST',
        url: 'index.php?page=asistencia&action=listarDetalleAsistencia',
        data: {
            'idEvento': idEvento
        },
        dataType: 'html',
        success: function(response) {
            $('#tabladt').dataTable().fnDestroy();
            $("#listadodetalleasistencia").html(response);
            $('#tabladt').DataTable({
                "bLengthChange": false,
                "lengthMenu": [10],
                "language": spanish_datatable
            });
        }
    };
    $.ajax(options);
};