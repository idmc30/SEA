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
            eliminarPublicoObjetivo(cod);
        }
    })
}


var eliminarPublicoObjetivo = function(cod) {
    var options = {
        type: 'POST',
        url: 'index.php?page=publicoObjetivo&action=eliminarPublicoObjetivo',
        data: {
            'id': cod
        },
        dataType: 'json',
        success: function(response) {
            let tipo = response.tipo
            if (tipo == 'success') {
                swal({
                    title: response.msj,
                    icon: response.tipo,
                    allowOutsideClick: false,
                })
            } else {
                swal({
                    title: response.msj,
                    icon: response.tipo,
                    allowOutsideClick: false,
                })
            }

            listarPublicoObjetivo();

        }
    };
    $.ajax(options);
};

function editar(nuem) {
    getPublicoObjetivo(nuem);

}
var getPublicoObjetivo = function(cod) {
    var options = {
        type: 'POST',
        url: 'index.php?page=publicoObjetivo&action=getPublicoObjetivo',
        data: {
            'id': cod
        },
        dataType: 'json',
        success: function(response) {
            $("#txtnombre").val(response.nombrePuObj);
            $("#textareadescripcion").val(response.descripcionPuObj);
            $("#txtidpublicoobjetivo").val(response.idPuObj);

        }
    };
    $.ajax(options);
};

$(document).ready(() => {
    listarPublicoObjetivo();

});


var listarPublicoObjetivo = function() {
    var options = {
        type: 'POST',
        url: 'index.php?page=publicoObjetivo&action=listarPublicoObjetivo',
        data: {},
        dataType: 'html',
        success: function(response) {

            $("#lpublicoObjetivo").html(response);
            $('#tabladt').DataTable({
                "bLengthChange": false,
                "lengthMenu": [10],
                "language": spanish_datatable
            });
        }
    };
    $.ajax(options);
};

$(document).on('submit', '#frmPublicoObjetivo', function(event) {
    event.preventDefault();
    var formElement = document.getElementById("frmPublicoObjetivo");
    var formData = new FormData(formElement);

    registrarPublicoObjetivo(formData);
});

var registrarPublicoObjetivo = function(formData) {
    var options = {
        type: 'POST',
        url: 'index.php?page=publicoObjetivo&action=registrarPublicoObjetivo',
        data: formData,
        processData: false,
        contentType: false,	
        dataType: 'json',
        success: function(response) {
            limpiar();
            let tipo = response.tipo
            if (tipo == 'success') {
                swal({
                    title: response.msj,
                    icon: response.tipo,
                    allowOutsideClick: false,
                })
            } else {
                swal({
                    title: response.msj,
                    icon: response.tipo,
                    allowOutsideClick: false,
                })
            }

            listarPublicoObjetivo();
        }
    };
    $.ajax(options);
};


function limpiar() {
    $("#txtnombre").val("");
    $("#textareadescripcion").val("");
    $("#txtidpublicoobjetivo").val("");
}

$(document).ready(() => {

    $("#frmPublicoObjetivo").validate({
        rules: {
            txtnombre: 'required',
            textareadescripcion: 'required'
        },
        messages: {
            txtnombre: 'Debe ingresar un nombre',
            textareadescripcion: 'Debe ingresar una descripción',

        }
    });

});