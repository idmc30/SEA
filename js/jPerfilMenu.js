$(document).on('change', '#cmbRol', function() {
    // event.preventDefault();
    let idPerfil = $("#cmbRol").select2("val");
    listarMenus(idPerfil);


});


var listarMenus = function(codperfil) {
    var options = {
        type: 'POST',
        url: 'index.php?page=perfilMenu&action=listarMenu',
        data: {
            'codperfil': codperfil
        },
        dataType: 'html',
        success: function(response) {
            $("#listadoMenus").html(response);
        }
    };
    $.ajax(options);
};


$(document).on('click', '.agregarMenu', function() {
    let evento = $(this).is(':checked');
    let idmenu = $(this).data('idmenysubmen');


    // var idmeusubmenu = $(this).data('idmenysubmen');
    let idPerfil = $("#cmbRol").select2("val");
    if (evento) {
        var accion = "insert"
        insertarPerfilMenu(idPerfil, idmenu, accion);
    } else {
        var accion = "delete"
        insertarPerfilMenu(idPerfil, idmenu, accion);
    }
});


var insertarPerfilMenu = function(idPerfil, idmenu, accion) {
    var options = {
        type: 'POST',
        url: 'index.php?page=perfilMenu&action=acceso',
        data: {
            'codperfil': idPerfil,
            'codmenu': idmenu,
            'accion': accion
        },
        dataType: 'json',
        success: function(response) {
            // console.log(response);
            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            })
        }
    };
    $.ajax(options);
};