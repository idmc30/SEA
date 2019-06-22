function editar(key) {

    modaladditemUpdate(key);
}

var modaladditemUpdate = function(key) {

    var options = {
        type: 'POST',
        url: 'index.php?page=evento&action=editarItem',
        data: {
            'key': key
        },
        dataType: 'html',
        success: function(response) {
            // $("#btn_guardar").text("Actualizar");
            $("#btn_guardar").empty();
            $("#btn_guardar").append("some Text");
            $('#div_modales').html(response);
            $('#modal_form').modal('show');

            $('.fechas').datepicker({
                language: "es",
                autoclose: true,
                todayHighlight: true
            });
            $('.timer').inputmask("hh:mm", {
                placeholder: "HH:MM",
            });


        }
    };
    $.ajax(options);
};


function eliminar(key) {
    swal({
        title: 'Desea Eliminar?',
        text: "¡No podrás revertir esto!",
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
                text: "OK",
                value: true,
                visible: true,
                className: "btn btn-primary",
                closeModal: true

            }
        }
    }).then(function(result) {
        if (result) {
            eliminarEvento(key);
        }
    })

}

var eliminarEvento = function(key) {

    var options = {
        type: 'POST',
        url: 'index.php?page=evento&action=updateEstadosEvento',
        data: {
            'key': key,
        },
        dataType: 'json',
        success: function(response) {

            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            })

            let key = $("#codigo_evento").val();
            listarItems(key)


        }
    };
    $.ajax(options);
};



$(document).on('click', '#btn_guardar', function(event) {
    event.preventDefault();
    /* Act on the event */

    var tipo = $('#tipo').val();
    var nombre = $('#nombre').val();
    var descripcion = $('#descripcion').val();
    var fecha_i = $('#fecha_i').val();
    var hora_i = $('#hora_i').val();
    var fecha_f = $('#fecha_f').val();
    var hora_f = $('#hora_f').val();
    var key = $('#key_evento').val();
    var idEventoUpdate = $("#txtcodevento").val();
    var key_update = $("#codigo_evento").val(); //$(this).data('id');
    var key_primer_padre = $("#keyEventoPrimerPadre").val()

    $('#modal_form').modal('hide');

    registraritem(key, tipo, nombre, descripcion, fecha_i, hora_i, fecha_f, hora_f, idEventoUpdate, key_update, key_primer_padre);
});

var registraritem = function(key, tipo, nombre, descripcion, fecha_i, hora_i, fecha_f, hora_f, idEventoUpdate, key_update, key_primer_padre) {

    var options = {
        type: 'POST',
        url: 'index.php?page=evento&action=registraritem',
        data: {
            'key': key,
            'tipo': tipo,
            'nombre': nombre,
            'descripcion': descripcion,
            'fecha_i': fecha_i,
            'hora_i': hora_i,
            'fecha_f': fecha_f,
            'hora_f': hora_f,
            'codEventoUpdate': idEventoUpdate,
            'keyupdate': key_update,
            'keyprimerpadre': key_primer_padre
        },
        dataType: 'json',
        success: function(response) {

            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            })


            let key = $("#codigo_evento").val();
            //consultar el iddelprimerpadre
            let primerPadreKey = $("#keyEventoPrimerPadre").val();
            listarItems(key, primerPadreKey)

        }
    };
    $.ajax(options);
};



$(document).on('click', '#btn_additem', function(event) {
    event.preventDefault();
    /* Act on the event */
    var key = $(this).data('id');
    modaladditem(key);

});

var modaladditem = function(key) {

    var options = {
        type: 'POST',
        url: 'index.php?page=evento&action=modaladditem',
        data: {
            'key': key
        },
        dataType: 'html',
        success: function(response) {

            $('#div_modales').html(response);
            $('#modal_form').modal('show');

            $('.fechas').datepicker({
                language: "es",
                autoclose: true,
                todayHighlight: true
            });
            $('.timer').inputmask("hh:mm", {
                placeholder: "HH:MM",
                // insertMode: false, 
                // showMaskOnHover: false,
                // hourFormat: 24
            });


        }
    };
    $.ajax(options);
};




$(document).ready(function() {
    let key = $("#codigo_evento").val();
    let primerPadreKey = $("#keyEventoPrimerPadre").val();
    listarItems(key, primerPadreKey)

});

var listarItems = function(key, keyPrimerPadre) {

    var options = {
        type: 'POST',
        url: 'index.php?page=evento&action=listaItemsHijos',
        data: {
            'key': key,
            'keyPrimerPadre': keyPrimerPadre
        },
        dataType: 'html',
        success: function(response) {


            $('#tablaitem').dataTable().fnDestroy();
            $('#listado_Items_evento').html(response);
            $('#tablaitem').DataTable({
                "bLengthChange": false,
                "lengthMenu": [10],
                "language": spanish_datatable
            });

        }
    };
    $.ajax(options);
};