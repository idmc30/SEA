$(document).on('change', '#cmbtipo', function(event) {
    event.preventDefault();
    /* Act on the event */
    var nombreTipo = $('select[name=cmbtipo] :selected').text();
    // alert(nombreTipo);
    if (nombreTipo == 'REPRESENTANTE') {

        $("#estado_certificado").hide("slow")
        $("#certificadofalse").prop("checked", true)

        $("#estado_tipo_organizador").show("slow");

    } else {
        $("#estado_certificado").show("slow")
        $("#certificadofalse").prop("checked", true)
        $("#estado_tipo_organizador").hide("slow");
    }

})


// window.addEventListener("keyup", ValidarInscipcion);





function desinscribirParticipante(codParticipanteEvento) {


    swal({
        // title: msj,
        text: 'Esta seguro que desea desinscribir?',
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

            desinscribirParticipanteEvento(codParticipanteEvento);
        }
    })
}
var desinscribirParticipanteEvento = function(codParticipanteEvento) {
    var options = {
        type: 'POST',
        url: 'index.php?page=inscripcionManual&action=desinscribir',
        data: {
            'cod': codParticipanteEvento,

        },
        dataType: 'json',
        success: function(response) {
            // console.log(response);
            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            })
            let codEvento = $('select[name=cmbevento]').val();
            listarInscritoxEvento(codEvento);

        }
    };
    $.ajax(options);
};

$(document).on('change', '#cmbevento', function(event) {
        event.preventDefault();
        /* Act on the event */
        var codEvento = $('select[name=cmbevento]').val();
        // limpiar();
        listarInscritoxEvento(codEvento);
        consultarEstadoCertificado(codEvento);
    })
    /** 
     * idmc 26-04-2016 se agrego el consultar estado de cetificado por evento 
     */
var consultarEstadoCertificado = function(id) {
    var options = {
        type: 'POST',
        url: 'index.php?page=inscripcionManual&action=consultarEstadoCertificado',
        data: {
            'id': id
        },
        dataType: 'json',
        success: function(response) {
            let estado = response.estado;

            if (estado) {

                $("#certificadotrue").prop("checked", true);
                $("#estado_certificado").show("slow")
            } else {
                $("#estado_certificado").hide("slow")
                $("#certificadofalse").prop("checked", true);
            }


        }
    };
    $.ajax(options);
};

var listarInscritoxEvento = function(idEvento) {
    var options = {
        type: 'POST',
        url: 'index.php?page=inscripcionManual&action=listarParticipantesByEvento',
        data: {
            'idevento': idEvento
        },
        dataType: 'html',
        success: function(response) {
            // console.log(response);

            $('#tabladt').dataTable().fnDestroy();
            $("#listadoinscritos").html(response);
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

$(document).on('submit', '#frminscripcion', function(event) {
    event.preventDefault();
    /* Act on the event */

    var formElement = document.getElementById("frminscripcion");
    var formData = new FormData(formElement);

    registrarInscripcion(formData);
});

var registrarInscripcion = function(formData) {
    var options = {
        type: 'POST',
        url: 'index.php?page=inscripcionManual&action=registrarInscripcion',
        data: formData,
        processData: false, // tell jQuery not to process the data
        contentType: false, // tell jQuery not to set contentType       
        dataType: 'json',
        success: function(response) {
            // limpiar();
            let tipo = response.tipo
            if (tipo == 'success') {
                swal({
                    title: response.msj,
                    icon: response.tipo,
                    allowOutsideClick: false,
                })
                limpiar();
            } else {
                swal({
                    title: response.msj,
                    icon: response.tipo,
                    allowOutsideClick: false,
                })
            }

            let codEvento = $('select[name=cmbevento]').val();
            listarInscritoxEvento(codEvento);
        }
    };
    $.ajax(options);
};



function ValidarInscipcion() {
    let dni = document.getElementById("cmbusuario").value;
    let longitud = dni.length;
    let longitudMaxima = 8;
    if (longitud == longitudMaxima) {
        getUsuario(dni);
    } else {

    }

}

var getUsuario = function(dni) {
    var options = {
        type: 'POST',
        url: 'index.php?page=inscripcionManual&action=consultarPersona',
        data: {
            'dni': dni
        },
        dataType: 'json',
        success: function(response) {
            let apepaterno = response.ape_paterno;
            let apematerno = response.ape_materno;
            let nombres = response.nombrePersona;
            let cod = response.idUsuario;
            $("#txtid").val(cod);
            if (cod != null) {
                $("#txtParticipante").val(apepaterno + ' ' + apematerno + ' ' + nombres);
            } else {
                swal({
                    // title: msj,
                    text: 'Este dni no se encuentra registrado.Desea Agregarlo?',
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
                        window.location.href = "index.php?page=inscripcionManual&action=form";

                    }
                })
            }



        }
    };
    $.ajax(options);
};


function limpiar() {
    // $('#cmbevento').val('0').trigger('change.select2');
    $("#txtDNI").val("");
    $("#txtParticipante").val("");
    // $("#txtid").val("");

}


$(document).ready(() => {

    $("#frminscripcion").validate({
        rules: {
            cmbevento: 'required',
            txtDNI: 'required',
            cmbtipo: 'required',
            cmborganizador: 'required'

        },
        messages: {
            cmbevento: 'Seleccione un evento',
            txtDNI: 'Ingrese un Dni',
            cmbtipo: 'Seleccione un tipo',
            cmborganizador: 'Seleccione el Organizador'

        }
    });

});