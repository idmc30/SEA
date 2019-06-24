function EditUsuario(idusu) {

    // $("#txtDNI").prop("disabled", true);
    // $("#txtDNI").prop("disabled", true);

    getUsuarios(idusu);

}
var getUsuarios = function(idusu) {
    var options = {
        type: 'POST',
        url: 'index.php?page=usuario&action=getUsuario',
        data: {
            'cod': idusu
        },
        dataType: 'json',
        success: function(response) {



            $("#txtIdPersona").val(response.codper);
            $("#txtIdUsu").val(response.codusu);
            $("#cmbRol").val(response.codperfil).change();
            $("#txtDNI").val(response.dni);
            $("#txtapepaterno").val(response.apepaterno);
            $("#txtapematerno").val(response.apematerno);
            $("#txtnombres").val(response.nombres);
            $("#txtCorreo").val(response.correo);
            $("#txtTelefono").val(response.telef);
            $("#txtAnexo").val(response.anexo);
            $("#btnregistrarse").attr('value', 'Actualizar');




        }
    };
    $.ajax(options);
};



$(document).ready(() => {
    listarUsuarios();
});



$(document).on('submit', '#frmNuevoUsuario', function(event) {
    event.preventDefault();
    /* Act on the event */

    var formElement = document.getElementById("frmNuevoUsuario");
    var formData = new FormData(formElement);

    registrarUsuariosPerfil(formData);
});

var registrarUsuariosPerfil = function(formData) {
    var options = {
        type: 'POST',
        url: 'index.php?page=usuario&action=registrarUsuarios',
        data: formData,
        processData: false, // tell jQuery not to process the data
        contentType: false, // tell jQuery not to set contentType       
        dataType: 'json',
        success: function(response) {

            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            })
        }
    };
    $.ajax(options);
};



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
                "bLengthChange": true,
                "lengthMenu": [10],
                "language": spanish_datatable
            });


        }
    };
    $.ajax(options);
};

$(document).ready(() => {
    $("#frmNuevoUsuario").validate({
        rules: {
            cmbRol: 'required',
            txtDNI: 'required',
            txtapepaterno: 'required',
            txtapematerno: 'required',
            txtnombres: 'required',
            txtContrasena: 'required'
        },
        messages: {
            cmbRol: 'Debe seleccionar un perfil',
            txtDNI: 'Ingrese su DNI',
            txtapepaterno: 'Requerido',
            txtapematerno: 'Requerido',
            txtnombres: 'Requerido',
            txtContrasena: 'Requerido',
        }
    });
});