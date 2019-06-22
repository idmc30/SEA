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







$(document).ready(function() {
    let key = $("#codigo_evento").val();
    listarItems(key)
});

var listarItems = function(key) {

    var options = {
        type: 'POST',
        url: 'index.php?page=evento&action=listaItems',
        data: {
            'key': key,
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


$(document).ready(function() {
    $('.fechas').datepicker({
        language: "es",
        autoclose: true,
        todayHighlight: true
    });
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

$(document).on('click', '#btn_additem', function(event) {
    event.preventDefault();
    /* Act on the event */
    var key = $(this).data('id');
    modaladditem(key);

});


$(document).on('click', '.btn_addcarac', function(event) {
    event.preventDefault();
    /* Act on the event */

    var superior = $(this).parent('div');
    console.log(superior);


    // $('#div_caract').append(' <div class="form-group row">'+
    // 		'<div class="col-sm-3">'+
    //                '<select class="form-control">'+
    //                  '<option>Ponente</option>'+
    //                  '<option>Moderador</option>'+
    //                  '<option>Fecha Inicio</option>'+
    //                  '<option>Fecha Fin</option>'+
    //                '</select>              '+
    //              '</div>'+
    //              '<div class="col-sm-8">'+
    //                '<select class="form-control">'+
    //                  '<option selected disabled>Seleccionar...</option>'+                
    //                '</select>'+
    //              '</div>'+
    //              '<div class="col-sm-1">'+
    //                '<button class="btn btn-dark btn-sm btn_addcarac" ><i class="fa fa-plus"></i></button>'+
    //              '</div>'+
    //            '</div>');




});


var registraritem = function(key, tipo, nombre, descripcion, fecha_i, hora_i, fecha_f, hora_f, idEventoUpdate, key_update) {

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
            'keyupdate': key_update
        },
        dataType: 'json',
        success: function(response) {

            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            })

            let key = $("#codigo_evento").val();
            listarItems(key);


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

    $('#modal_form').modal('hide');

    registraritem(key, tipo, nombre, descripcion, fecha_i, hora_i, fecha_f, hora_f, idEventoUpdate, key_update);
});


var tablaitems = function(key) {

    var options = {
        type: 'POST',
        url: 'index.php?page=evento&action=tablaitems',
        data: {
            'key': key,
        },
        dataType: 'json',
        success: function(response) {

            $('#tablaitems').html(response);

        }
    };
    $.ajax(options);
};