//<a id="exportarAsistentes" href="index.php?page=asistencia&action=exportarAsistentes&evento=<?php echo base64_encode($idEvento) ?>" target="_blank" style="color:#f39c12; font-size: 25px" data-toggle="tooltip" title="" class="btn btn-export btn-rounded btn-icon" data-original-title="Exportar"><i class="mdi mdi-file-excel"></i></a>



// $(document).on('click', '#btn_additem', function(event) {
//     event.preventDefault();
//     var key = $(this).data('id');
//     modaladditem(key);

// });


$(document).ready(function() {
    let key = $("#codigo_evento").val();
    // let decodedData = window.atob(key); 
    $('#exportarAsistentes').attr('href', "index.php?page=asistencia&action=exportarAsistentes&evento="+key);
    // listarItems(key)
});
