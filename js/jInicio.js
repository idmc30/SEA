function darDeBaja(idUsuario, idEvento) {
    swal({
        title: 'Desea salir de Evento?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f51b5',
        cancelButtonColor: '#ff4081',
        confirmButtonText: 'Great ',
        buttons: {
            cancel: {
                text: "NO",
                value: null,
                visible: true,
                className: "btn btn-danger",
                closeModal: true,
            },
            confirm: {
                text: "SI",
                value: true,
                visible: true,
                className: "btn btn-primary",
                closeModal: true

            }
        }
    }).then(function(result) {
        if (result) {
            salirdeEvento(idUsuario, idEvento);
        }
    })


}



var salirdeEvento = function(idUsuario, idEvento) {
    var options = {
        type: 'POST',
        url: 'index.php?page=inicio&action=desinscribir',
        data: {
            'idusu': idUsuario,
            'idevento': idEvento
        },
        dataType: 'json',
        success: function(response) {

            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            })

            listarEventos();
        }
    };
    $.ajax(options);
};


function modadalEvento(idEvento) {
    // $("#exampleModal-2").show();
    $('#exampleModal-2').modal('show');
    // alert(idEvento);
    $.post("index.php?page=inicio&action=getEventoInicio", { id: idEvento }, function(response) {
        console.log(response)
        $("#labelnombre").text(response.nombreEvento);
        $("#pdescripcion").text(response.descripcion);
        $("#fechainiciob").text(response.fechaInicio);
        $("#horab").text(response.hora);
        $("#lugarb").text(response.lugar);
        $("#labelcostoevento").text(response.costoevento);
        $("#labelcostrocertificado").text(response.costocertificado);

    })
}

function Inscribirse(idUsuario, idEvento) {


    swal({
        title: 'Desea Inscribirse al Evento?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f51b5',
        cancelButtonColor: '#ff4081',
        confirmButtonText: 'Great ',
        buttons: {
            cancel: {
                text: "NO",
                value: null,
                visible: true,
                className: "btn btn-danger",
                closeModal: true,
            },
            confirm: {
                text: "SI",
                value: true,
                visible: true,
                className: "btn btn-primary",
                closeModal: true

            }
        }
    }).then(function(result) {
        if (result) {
            $.post('index.php?page=inscripcionManual&action=consultarEstadoCertificado', { id: idEvento }, function(response) {

                let estado = response.estado; //estado del evento si cuenta con certificado o no 

                if (estado) { //el evento cuenta con certificado
                    //verificamos si desea certificado
                    swal({
                        title: 'Desea Certificado?',
                        text: "",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3f51b5',
                        cancelButtonColor: '#ff4081',
                        confirmButtonText: 'Great ',
                        buttons: {
                            cancel: {
                                text: "NO",
                                value: null,
                                visible: true,
                                className: "btn btn-danger",
                                closeModal: true,
                            },
                            confirm: {
                                text: "SI",
                                value: true,
                                visible: true,
                                className: "btn btn-primary",
                                closeModal: true

                            }
                        }
                    }).then(function(result) {
                        if (result) {
                            let certificado_true = "SI";
                            registrarInscripcion(idUsuario, idEvento, certificado_true)
                        } else {
                            let certificado_false = "NO";
                            registrarInscripcion(idUsuario, idEvento, certificado_false)
                        }
                    })


                } else { //el evento no cuenta con certificado
                    registrarInscripcion(idUsuario, idEvento, null)
                }

            });

        }
    })
}


var registrarInscripcion = function(idUsuario, idEvento, certificado) {
    var options = {
        type: 'POST',
        url: 'index.php?page=inicio&action=registrarInscripcion',
        data: {
            'idusu': idUsuario,
            'idevento': idEvento,
            'certificado': certificado
        },
        dataType: 'json',
        success: function(response) {

            swal({
                title: response.msj,
                icon: response.tipo,
                allowOutsideClick: false,
            })

            listarEventos();
        }
    };
    $.ajax(options);
};

$(document).ready(() => {
    listarEventos();
});

var listarEventos = function() {
    var options = {
        type: 'POST',
        url: 'index.php?page=inicio&action=listarEventos',
        data: {},
        dataType: 'html',
        success: function(response) {
            $('#tabladt').dataTable().fnDestroy();
            $("#listadoEventos").html(response);
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