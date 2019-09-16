$(document).on('change', '#certificado', function(event) {
    event.preventDefault();

    let certificado = $(this).val();

    if (certificado == 'no') {
        $("#div_costo_certificado").hide("slow");
    } else {
        $("#div_costo_certificado").show("slow");
    }

})

$(document).ready(function() {
    $('.fechas').datepicker({
        language: "es",
        autoclose: true,
        todayHighlight: true
    });
    $('#timepicker-example').datetimepicker({
        format: 'LT'
    });

    $('.moneda').inputmask({
        alias: "currency",
        prefix: "",
        groupSeparator: ",",
        alias: "numeric",
        placeholder: "0",
        autoGroup: !0,
        digits: 2,
        digitsOptional: !1,
        clearMaskOnLostFocus: !1
    });


});

var registrar = function(formData) {

    var options = {
        type: 'POST',
        url: 'index.php?page=evento&action=registrar',
        data: formData,
        processData: false, 
        contentType: false,      
        dataType: 'json',
        success: function(response) {
            swal({

                title: '',
                text: response.msj,
                icon: response.tipo_msj,
                allowOutsideClick: false,
            }).then(function() {    
                if (response.procede == true) {
                    window.location.href = response.url_redirect;
                }
            }).catch(swal.noop)
        }
    };
    $.ajax(options);
};


$(document).on('submit', '#form_registro', function(event) {
    event.preventDefault();

    var formElement = document.getElementById("form_registro");
    var formData = new FormData(formElement);


    var especialidades = $('#especialidades').val();
    formData.append("especialidades", especialidades);

    var pobjetivo = $('#pobjetivo').val();
    formData.append('pobjetivo', pobjetivo);


    var fecha_inicial = $('#fechainicioevento').val();
    var fecha_final = $('#fechafinevento').val();

    var splitFechaInicial = fecha_inicial.split('/');
    var splitFechaFinal = fecha_final.split('/');

    var anioFechInicial = splitFechaInicial[2];
    var mesFechInicial = splitFechaInicial[1];
    var diaFechaInicial = splitFechaInicial[0];

    var anioFechFinal = splitFechaFinal[2];
    var mesFechFinal = splitFechaFinal[1];
    var diaFechaFinal = splitFechaFinal[0];

    var objFechaInicial = new Date(anioFechInicial, mesFechInicial, diaFechaInicial);
    var objFechaFinal = new Date(anioFechFinal, mesFechFinal, diaFechaFinal);

    var FechaFinal = objFechaFinal.getTime();
    var FechaInicial = objFechaInicial.getTime();

    if (FechaFinal < FechaInicial) {

        swal({
            title: 'La fecha final no puede ser menor a la fecha Inicial',
            icon: 'warning',
            allowOutsideClick: false,
        })

    } else {

        registrar(formData);
    }

});

$(document).ready(() => {

    $("#form_registro").validate({
        rules: {
            tipo_evento: 'required',
            nombre: 'required',
            descripcion: 'required',
            organizador: 'required',
            representante: 'required',
            especialidades: 'required',
            pobjetivo: 'required',
            fechainicioevento: 'required',
            fechafinevento: 'required',
            hora: 'required',
            lugar: 'required',
            subir_imagen: 'required'
        },
        messages: {
            tipo_evento: 'Seleccione un tipo de Evento',
            nombre: 'Ingrese un nombre',
            descripcion: 'Ingrese una descripcion',
            organizador: 'Seleccione un organizador',
            representante: 'Seleccione un representante',
            especialidades: 'Seleccione una especialidad',
            pobjetivo: 'Seleccione un público objetivo',
            fechainicioevento: 'Ingrese fecha de inicio del evento',
            fechafinevento: 'Ingrese fecha fin del evento',
            hora: 'Ingrese una hora',
            lugar: 'Seleccione un lugar',
            subir_imagen: 'Seleccione una imagen'
        }
    });

});