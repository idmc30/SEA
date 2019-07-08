/** 
 * 021.-DValdera 18/04/2019  
 */

$(document).ready(() => {
    document.getElementById("txtDNI").readOnly = true;
    document.getElementById("txtProfesion").readOnly = true;
    document.getElementById("txtNombres").readOnly = true;
    document.getElementById("txtCorreo").readOnly = true;
    document.getElementById("txtApellidos").readOnly = true;
    document.getElementById("txtCelular").readOnly = true;
    document.getElementById("txtSexo").readOnly = true;
    document.getElementById("txtAnexo").readOnly = true;
    document.getElementById("txtDireccion").readOnly = true;
    document.getElementById("cboModalidadContractual").disabled = true;
    document.getElementById("txtFechaNacimiento").readOnly = true;
});

function soloNumeros(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = "8-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
};

$(document).ready(() => {
    term = document.getElementById("txtDNI").value;
    VerificarDNI(term);
});

function cambiarEstadoCampos(estado) {
    document.getElementById("txtCorreo").readOnly = estado;
    document.getElementById("txtProfesion").readOnly = estado;
    document.getElementById("cboModalidadContractual").disabled = estado;
    document.getElementById("txtCelular").readOnly = estado;
    document.getElementById("txtAnexo").readOnly = estado;
    document.getElementById("txtProfesion").autofocus;
}

function EditarPerfil() {
    var estado = false;
    cambiarEstadoCampos(estado);

    $('#btnEditar').attr("hidden", true);
    $('#btnGuardar').attr("hidden", false);
}

function GuardarPerfil() {
    var estado = true;
    cambiarEstadoCampos(estado);

    $('#btnEditar').attr("hidden", false);
    $('#btnGuardar').attr("hidden", true);

    RegistrarPerfil();
}

function VerificarDNI(term) {
    var options = {
        type: 'GET',
        url: "http://172.17.128.37/ws_pj/index.php?page=reniec&action=consultarxdni",
        data: { 'term': term },
        dataType: 'json',
        success: function(response) {
            reniec_ws = response;
            $('#txtNombres').val(response.nombres);
            $('#txtApellidos').val(response.apellidopaterno + ' ' + response.apellidomaterno);
            $('#txtSexo').val(response.sexo);
            $('#txtFechaNacimiento').val(response.fechanacimiento);
            $('#txtDireccion').val(response.direccion);
            $('#txtFoto').val(response.res_foto);
            var image = new Image();
            image = document.getElementById("imagen");
            image.src = 'data:image/png;base64,' + response.res_foto;
        }
    };
    $.ajax(options).fail(function(jqXHR, textStatus, errorThrown) {
        reniec_ws = null;
    });
}

function RegistrarPerfil() {
    dni = document.getElementById("txtDNI").value;
    profesion = document.getElementById("txtProfesion").value;
    nombres = document.getElementById("txtNombres").value;
    correo = document.getElementById("txtCorreo").value;
    apellidos = document.getElementById("txtApellidos").value;
    celular = document.getElementById("txtCelular").value;
    sexo = document.getElementById("txtSexo").value;
    anexo = document.getElementById("txtAnexo").value;
    direccion = document.getElementById("txtDireccion").value;
    modalidad = document.getElementById("cboModalidadContractual").value;
    fecha = document.getElementById("txtFechaNacimiento").value;
    foto = document.getElementById("txtFoto").value;
    $.ajax({
            method: "POST",
            url: 'index.php?page=perfil&action=actualizarPerfil',
            data: {
                'dni': dni,
                'profesion': profesion,
                'nombres': nombres,
                'correo': correo,
                'apellidos': apellidos,
                'celular': celular,
                'sexo': sexo,
                'anexo': anexo,
                'direccion': direccion,
                'modalidad': modalidad,
                'fecha': fecha,
                'foto': foto
            }
        })
        .done(function(text) {
            // if(text.substring(0,2) =="Pe"){
            swal({
                    title: text,
                    icon: 'success',
                    timer: 2000,
                    button: false
                }).then(
                    function() {},
                    // handling the promise rejection
                    function(dismiss) {
                        if (dismiss === 'timer') {
                            console.log('I was closed by the timer')
                        }
                    }
                )
                // }
        });
}