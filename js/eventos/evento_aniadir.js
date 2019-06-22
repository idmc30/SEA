var modalaniadir = function(){

	var options = {
		type: 'POST',
		url:'index.php?page=evento&action=modalaniadir',
		dataType: 'html',
		success: function(response){

			$('#div_modales').html(response);
			$('#modal_form').modal('show');
			
		}
	};
	$.ajax(options);
};

$(document).on('click', '#btn_aniadir', function(event) {
	event.preventDefault();
	/* Act on the event */

	modalaniadir();

});


$(document).on('click', '.btn_addcarac', function(event) {
	event.preventDefault();
	/* Act on the event */


	$('#div_caract').append(' <div class="form-group row">'+
			'<div class="col-sm-3">'+
                '<select class="form-control">'+
                  '<option>Ponente</option>'+
                  '<option>Moderador</option>'+
                  '<option>Fecha Inicio</option>'+
                  '<option>Fecha Fin</option>'+
                '</select>              '+
              '</div>'+
              '<div class="col-sm-8">'+
                '<select class="form-control">'+
                  '<option selected disabled>Seleccionar...</option>'+                
                '</select>'+
              '</div>'+
              '<div class="col-sm-1">'+
                '<button class="btn btn-dark btn-sm btn_addcarac" ><i class="fa fa-plus"></i></button>'+
              '</div>'+
            '</div>');

	


});