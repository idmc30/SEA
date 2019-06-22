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
    	alias : "currency", 
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



var actualizar = function(formData){

    var options = {
        type: 'POST',
        url:'index.php?page=evento&action=actualizar',
        data:  formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType      
        dataType: 'json',
        success: function(response){
            swal({
                title: '',
                text: response.msj,
                icon: response.tipo_msj,                
                allowOutsideClick : false,          
            }).then(function () {
                // console.log('recargando....');       
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
    /* Act on the event */

    var formElement = document.getElementById("form_registro");
    var formData = new FormData(formElement);


    var especialidades = $('#especialidades').val();
    formData.append("especialidades", especialidades);

    var pobjetivo = $('#pobjetivo').val();
    formData.append('pobjetivo', pobjetivo);

    actualizar(formData);


});