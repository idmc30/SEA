//08/05/2019 idmc 
function modalOrganizadores(idEvento) {

    listarOrganizadores(idEvento);
}

//08/05/2019 idmc 
var listarOrganizadores = function(idEvento) {

    var options = {
        type: 'POST',
        url: 'index.php?page=evento&action=listarOrganizadores',
        data: {
            'codEvento': idEvento,
        },
        dataType: 'html',
        success: function(response) {
            $("#modalOrganizadores").html(response)
            $('#modal_organizadores').modal('show');

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

var mostrareventos = function(fecha_inicial, fecha_final) {

    var options = {
        type: 'POST',
        url: 'index.php?page=evento&action=listareventos',
        data: {
            'fecha_inicial': fecha_inicial,
            'fecha_final': fecha_final,
        },
        dataType: 'html',
        success: function(response) {
            $('#exportarEventos').attr('href', "index.php?page=evento&action=exportarEventos&fecha_inicial=" + fecha_inicial + "&fecha_final=" + fecha_final);
            $('#tabladt').dataTable().fnDestroy();
            $('#tabla_busqueda').html(response);
            $('#tabladt').DataTable({

                "language": spanish_datatable
            });
        }
    };
    $.ajax(options);
};





$(document).on('click', '#btn_mostrar', function(event) {
    event.preventDefault();
    /* Act on the event */

    var fecha_inicial = $('#fecha_inicial').val();
    var fecha_final = $('#fecha_final').val();

    //comparando fechas 
    /*primero creamos un objeto de tipo Date  como argumento el String de la fecha
    . Cuando tengas el objeto Date ya puedes obtener el tiempo con el método getTime del objeto Date

      new Date(año, mes, día, hora, minutos, segundos, milisegundos);
     */


    /** Format Fechas */

    var splitFechaInicial = fecha_inicial.split('/');
    var splitFechaFinal = fecha_final.split('/');

    var anioFechInicial = splitFechaInicial[2];
    var mesFechInicial = splitFechaInicial[1];
    var diaFechaInicial = splitFechaInicial[0];

    var anioFechFinal = splitFechaFinal[2];
    var mesFechFinal = splitFechaFinal[1];
    var diaFechaFinal = splitFechaFinal[0];

    //pasamos parametros a Date
    var objFechaInicial = new Date(anioFechInicial, mesFechInicial, diaFechaInicial);
    var objFechaFinal = new Date(anioFechFinal, mesFechFinal, diaFechaFinal);

    //obteniendo el tiempo con el getTime
    var FechaFinal = objFechaFinal.getTime();
    var FechaInicial = objFechaInicial.getTime();

    // comparando fechas 
    if (FechaFinal < FechaInicial) {

        swal({
            title: 'La fecha final no puede ser menor a la fecha Inicial',
            icon: 'warning',
            allowOutsideClick: false,
        })

    } else {


        if (isNaN(FechaFinal) || isNaN(FechaInicial)) {

            swal({
                title: 'Debe Ingresar una Fecha valida',
                icon: 'warning',
                allowOutsideClick: false,
            })

        } else {
            mostrareventos(fecha_inicial, fecha_final);
        }
    }




});



function eliminar(cod) {

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
            eliminarEvento(cod);
        }
    })


}

var eliminarEvento = function(cod) {
    var options = {
        type: 'POST',
        url: 'index.php?page=evento&action=updateEstadosEvento',
        data: {
            'key': cod
        },
        dataType: 'json',
        success: function(response) {

            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            })

            var fecha_inicial = $('#fecha_inicial').val();
            var fecha_final = $('#fecha_final').val();

            mostrareventos(fecha_inicial, fecha_final);


        }
    };
    $.ajax(options);
};



$(document).ready(() => {

    $("#frmOrganizador").validate({
        rules: {
            cmbtipoorga: 'required',
            txtnombre: 'required'


        },
        messages: {
            cmbtipoorga: 'Debe seleccionar un tipo de organizador',
            txtnombre: 'Debe ingresar un nombre',


        }
    });

});