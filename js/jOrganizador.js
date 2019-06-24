function desactivar(idparticipanteEvento) {

    // alert(idparticipanteEvento);
    swal({
        // title: msj,
        text: 'Esta seguro que desea eliminar al representate?',
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
                text: "Aceptar",
                value: true,
                visible: true,
                className: "btn btn-primary",
                closeModal: true
            }
        }
    }).then(function(result) {
        // console.log(result);
        if (result) {

            eliminarRepresentante(idparticipanteEvento);
        }
    })
}

var eliminarRepresentante = function(idparticipanteEvento) {
    var options = {
        type: 'POST',
        url: 'index.php?page=organizador&action=deleteRepresentante',
        data: {
            'codeventoparti': idparticipanteEvento,
        },
        dataType: 'json',
        success: function(response) {

            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            })


            location.reload();
        }
    };
    $.ajax(options);
};

$(document).on('click', '#btnregistrarReprese', function(event) {
    event.preventDefault();

    let representante = $("#cmbrepresentante").select2("val");

    if (representante != null) {
        representante = $("#cmbrepresentante").select2("val").split('-');
        let idusuario = representante[2];
        let codigoOrganizador = $("#idorganizadortxt").val();
        registrarRepresentante(codigoOrganizador, idusuario);
        limpiarModal();


    } else {
        swal({
            title: "Tiene que Seleccionar un representante",
            icon: "warning",
            allowOutsideClick: false,
        })

    }

    // registrarRepresentante(formData);

});

function limpiarModal() {
    $('#cmbrepresentante').val('0').trigger('change.select2');
    $("#idorganizadortxt").val("");
}
var registrarRepresentante = function(codigoOrganizador, idUsuario) {
    var options = {
        type: 'POST',
        url: 'index.php?page=organizador&action=registrarRepresetante',
        data: {
            'codorganizador': codigoOrganizador,
            'codusuario': idUsuario,
        },
        dataType: 'json',
        success: function(response) {

            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            })
            listarOrganizador();
        }
    };
    $.ajax(options);
};

function asignar(idOrganizador) {
    // alert(idOrganizador);
    $("#idorganizadortxt").val(idOrganizador);
}


$("select[name=cmbrepresentante]").change(() => {

    let representante = $("#cmbrepresentante").select2("val").split('-');

    let idModalidad = representante[1];

    modalidadContractual(idModalidad);
});


var modalidadContractual = function(idModalidad) {
    var options = {
        type: 'POST',
        url: 'index.php?page=organizador&action=getModalidadContractual',
        data: {
            'id': idModalidad
        },
        dataType: 'json',
        success: function(response) {

            $("#exampleInputUsername1").val(response.nombreModalidad);

            // console.log(response);
            // listarOrganizador();
        }
    };
    $.ajax(options);
};

function eliminar(id) {
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
            eliminarOrganizador(id);
        }
    })
}


var eliminarOrganizador = function(cod) {
    var options = {
        type: 'POST',
        url: 'index.php?page=organizador&action=eliminarOrganizador',
        data: {
            'id': cod
        },
        dataType: 'json',
        success: function(response) {
            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            })


            listarOrganizador();
        }
    };
    $.ajax(options);
};



function editar(id) {

    editarOrganizador(id);

}

var editarOrganizador = function(cod) {
    var options = {
        type: 'POST',
        url: 'index.php?page=organizador&action=getOrganizador',
        data: {
            'id': cod
        },
        dataType: 'json',
        success: function(response) {
            $("#txtnombre").val(response.nombreOrganizador);
            $("#txttelefono").val(response.telefOrganizador);
            $("#txtanexo").val(response.anexoOrganizador);
            $("#codorganizador").val(response.idOrganizador);
            $("#cmbtipoorga").val(response.idTipoOrganizador).change();
            $("#btnorganizador").attr('value', 'Actualizar');

        }
    };
    $.ajax(options);
};

$(document).on('submit', '#frmOrganizador', function(event) {
    event.preventDefault();
    /* Act on the event */
    var formElement = document.getElementById("frmOrganizador");
    var formData = new FormData(formElement);


    registrarOrganizador(formData);
    $("#btnorganizador").attr('value', 'Guardar');
});

var registrarOrganizador = function(formData) {

    var options = {
        type: 'POST',
        url: 'index.php?page=organizador&action=registrarOrganizador',
        data: formData,
        processData: false, // tell jQuery not to process the data
        contentType: false, // tell jQuery not to set contentType		
        dataType: 'json',
        success: function(response) {
            limpiar()
            listarOrganizador();
            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            }).then(function() {
                // listardependencias();
            }).catch(swal.noop)
        }
    };
    $.ajax(options);
};


$(document).ready(() => {
    listarOrganizador();
    limpiar();

});

function limpiar() {

    $("#txtnombre").val("");
    $("#txttelefono").val("");
    $("#txtanexo").val("");
    $("#codorganizador").val("");
    $("#cmbtipoorga").val(0).change();
}

var listarOrganizador = function() {
    var options = {
        type: 'POST',
        url: 'index.php?page=organizador&action=listarOrganizador',
        data: {},
        dataType: 'html',
        success: function(response) {
            $('#tabladt').dataTable().fnDestroy();
            $("#lorganizador").html(response);
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