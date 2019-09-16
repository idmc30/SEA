$(document).on('click', '.estadoUsuario', function() {
    let evento = $(this).is(':checked');
    let idusuario = $(this).data('idusuario');

    if (evento) {
        var accion = "activo"
        habilitarUsuario(idusuario, accion);
    } else {
        var accion = "inactivo"
        habilitarUsuario(idusuario, accion);
    }
});

var habilitarUsuario = function(idusu, accion) {
    var options = {
        type: 'POST',
        url: 'index.php?page=usuario&action=estadosUsuario',
        data: {
            'cod': idusu,
            'action': accion

        },
        dataType: 'json',
        success: function(response) {
            listarUsuarios();
            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            })
        }
    };
    $.ajax(options);
};

function EditUsuario(idusu) {
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

            let sexo = response.sexo;
            if (sexo != null) {
                $("#cmbsexo").val(response.sexo).change();
            } else {
                $("#cmbsexo").val(0).change();
            }

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
    var formElement = document.getElementById("frmNuevoUsuario");
    var formData = new FormData(formElement);

    registrarUsuariosPerfil(formData);
});

var registrarUsuariosPerfil = function(formData) {
    var options = {
        type: 'POST',
        url: 'index.php?page=usuario&action=registrarUsuarios',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {

            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            })
            listarUsuarios();
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
            $('#tabladt').dataTable().fnDestroy();
            $("#listadousuarios").html(response);
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
            txtContrasena: 'required',
            cmbsexo: 'required',
        },
        messages: {
            cmbRol: 'Debe seleccionar un perfil',
            txtDNI: 'Ingrese su DNI',
            txtapepaterno: 'Requerido',
            txtapematerno: 'Requerido',
            txtnombres: 'Requerido',
            txtContrasena: 'Requerido',
            cmbsexo: 'Requerido',
        }
    });
});