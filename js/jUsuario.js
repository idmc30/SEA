$(document).ready(() => {
    listarUsuarios();
});


var listarUsuarios = function() {
    var options = {
        type: 'POST',
        url: 'index.php?page=usuario&action=listarUsuariosROl',
        data: {},
        dataType: 'html',
        success: function(response) {
            // console.log(response);

            $('#tabladt').dataTable().fnDestroy();
            $("#listadousuarios").html(response);
            //$('#tabladt').dataTable();
            $('#tabladt').DataTable({
                "bLengthChange": false,
                "lengthMenu": [10],
                "language": spanish_datatable
            });


        }
    };
    $.ajax(options);
};