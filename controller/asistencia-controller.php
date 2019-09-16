<?php
session_start();
require 'model/mEvento.php';
require 'model/mTiempoAsistenciaParticipante.php';
require 'model/mControlAsistencia.php';
require 'model/mPersona.php';
require 'model/mUsuario.php';
require 'model/mParticipante.php';
require 'model/mTipoPersona.php';

function _controlAction(){

	$idEvento = $_GET['idEvento'];

	$objEvento = new Evento();
	$objUsuario = new Usuario();

	$listaEventoActivo = $objEvento->listarEventosActivos();

	$listaUsuarios = $objUsuario->listarUsuariosParaPonentes();

	require 'view/asistencia/vEventoAsistencia.php';
}

function _asistenciaAction(){
	setlocale(LC_ALL, 'es_ES');
	$monthNum  = date("n");
	$dateObj   = DateTime::createFromFormat('!m', $monthNum);
	$monthName = strftime('%B', $dateObj->getTimestamp());

	$idEvento = $_GET['idEvento'];

	$objEvento = new Evento();
	$objControlAsistencia = new ControlAsistencia();

	$evento = $objEvento->consultarEventoByID($idEvento);

	$idEventoPertenece = $objEvento->consultarEventoPertenece($idEvento);

	$id_evepar = $objEvento->consultarEveParById($idEventoPertenece);
	$validarApertura = $objControlAsistencia->validarAperturaByRepresentante($id_evepar);
	$response = array();
	$response['representante'] = $validarApertura->evpart_id;
	$response['estado'] = $validarApertura->estado_asistencia;

	$objTiempoAsistenciaParticipante = new TiempoAsistenciaParticipante();

	require 'view/asistencia/vControlAsistencia.php';
}

function _detalleAction()
{   
	$evento= new Evento();
	$tipopersona= new TipoPersona();
	$ltipopersona=$tipopersona->listarTipoPersona();
	$levento= $evento->listarEventosActivos();
	require 'view/asistencia/vDetalleAsistencia.php';
}


function _listarDetalleAsistenciaAction(){

	$idEvento = $_POST['idEvento'];
	$objControlAsistencia = new ControlAsistencia();
	$ldetalle = $objControlAsistencia->listarParticipantes($idEvento);
	require 'view/asistencia/tabDetalleAsistencia.php';
}



function _entradaAsistenciaAction()
{
	$dni = $_POST['dni'];
	$idEvento = $_POST['idEvento'];

	$objEvento = new Evento();
	$objControlAsistencia = new ControlAsistencia();

	$idEventoPertenece = $objEvento->consultarEventoPertenece($idEvento);

	$inscripcion = $objEvento->consultarAsistenteByDNI($dni, $idEventoPertenece);
	$validarAsistencia = $objControlAsistencia->consultarEntradaById($inscripcion);

	if ($inscripcion) {
		if ($validarAsistencia) {
			echo 'El usuario ya registro su entrada';
		}
		else{
			$tipoAsistencia = 'A';
			$objControlAsistencia->registrarAsistenciaEntrada($inscripcion, $idEvento, $tipoAsistencia, $_SESSION['idsesion']);
			echo 'Entrada registrada correctamente';
		}
	}else{
		echo 'El usuario no se ha registrado en el evento';
	}
};

function _salidaAsistenciaAction()
{
	$dni = $_POST['dni'];
	$idEvento = $_POST['idEvento'];

	$objEvento = new Evento();
	$objControlAsistencia = new ControlAsistencia();

	$idEventoPertenece = $objEvento->consultarEventoPertenece($idEvento);

	$inscripcion = $objEvento->consultarAsistenteByDNI($dni, $idEventoPertenece);

	$validarEntrada = $objControlAsistencia->consultarEntradaById($inscripcion);
	$validarSalida = $objControlAsistencia->consultarSalidaById($inscripcion);

	$ultimoRegistro = $objControlAsistencia->ultimoPermiso($validarEntrada);

	$permisoEntrada = $objControlAsistencia->consultarPermisoEntrada($ultimoRegistro);
	$permisosAsistentes = $objControlAsistencia->consultarPermisoAsistentes($validarEntrada);

	if ($inscripcion) {
		if ($validarSalida) {
			echo 'El usuario ya registro su salida';
		}else{
			if ($validarEntrada){
				if ($permisosAsistentes > 0) {
					if ($permisoEntrada) {
						$objControlAsistencia->registrarAsistenciaSalida($validarEntrada,$_SESSION['idsesion']);
						echo 'Salida registrada correctamente';
					}else{
						echo 'El usuario ya registro su permiso de entrada';
					}
				}else{
					$objControlAsistencia->registrarAsistenciaSalida($validarEntrada,$_SESSION['idsesion']);
					echo 'Salida registrada correctamente';
				}
			}else{
				echo 'El usuario no ha registrado su entrada';
			}
		}
	}else{
		echo 'El usuario no se ha registrado en el evento';
	}

};

function _SalidaPermisoAction()
{
	$dni = $_POST['dni'];
	$idEvento = $_POST['idEvento'];

	$objEvento = new Evento();
	$objControlAsistencia = new ControlAsistencia();

	$idEventoPertenece = $objEvento->consultarEventoPertenece($idEvento);

	$inscripcion = $objEvento->consultarAsistenteByDNI($dni, $idEventoPertenece);
	
	$validarEntrada = $objControlAsistencia->consultarEntradaById($inscripcion);
	$ultimoRegistro = $objControlAsistencia->ultimoPermiso($validarEntrada);
	$permisoSalida = $objControlAsistencia->consultarPermiso($ultimoRegistro);

	if ($inscripcion) {
		if ($validarEntrada) {
			if ($permisoSalida) {
				echo 'El usuario ya registro su permiso salida';
			}else{
				$objControlAsistencia->registrarPermisoSalida($validarEntrada, $_SESSION['idsesion']);
				echo 'Permiso de salida registrado';
			}
		}else{
			echo 'El usuario no ha registrado su entrada';
		}
	}else{
		echo 'El usuario no se ha registrado en el evento';
	}
};

function _EntradaPermisoAction()
{
	$dni = $_POST['dni'];
	$idEvento = $_POST['idEvento'];

	$objEvento = new Evento();
	$objControlAsistencia = new ControlAsistencia();

	$idEventoPertenece = $objEvento->consultarEventoPertenece($idEvento);

	$inscripcion = $objEvento->consultarAsistenteByDNI($dni, $idEventoPertenece);

	$validarEntrada = $objControlAsistencia->consultarEntradaById($inscripcion);
	$ultimoRegistro = $objControlAsistencia->ultimoPermiso($validarEntrada);
	$permisoSalida = $objControlAsistencia->consultarPermiso($ultimoRegistro);
	$permisoEntrada = $objControlAsistencia->consultarPermisoEntrada($ultimoRegistro);

	if ($inscripcion){
		if ($validarEntrada) {
			if ($permisoSalida){
				if ($permisoEntrada) {
					echo 'El usuario ya registro su permiso entrada';
				}else{
					$objControlAsistencia->registrarPermisoEntrada($validarEntrada, $_SESSION['idsesion']);
					echo 'Permiso de entrada registrado';
				}
			}else{
				echo 'El usuario no ha registrado su permiso de salida';
			}
		}else{
			echo 'El usuario no ha registrado su entrada';
		}
	}else{
		echo 'El usuario no se ha registrado en el evento';
	}
};

function _aperturaAsistenciaAction()
{
	$dni = $_POST['dni'];
	$idEvento = $_POST['idEvento'];

	$objEvento = new Evento();
	$objControlAsistencia = new ControlAsistencia();

	$idEventoPertenece = $objEvento->consultarEventoPertenece($idEvento);

	$apertura = $objEvento->consultarRepresentanteByDNI($dni, $idEventoPertenece);

	if ($apertura) {
		$tipoAsistencia = 'R';
		$objControlAsistencia->registrarAsistenciaEntrada($apertura, $idEvento, $tipoAsistencia, $_SESSION['idsesion']);
		echo 'Control de asistencia aperturado';
	}
	else{
		echo 'El DNI ingresado no es del representante';
	}

}

function _cerrarAsistenciaAction()
{
	$dni = $_POST['dni'];
	$idEvento = $_POST['idEvento'];

	$objEvento = new Evento();
	$objControlAsistencia = new ControlAsistencia();

	$idEventoPertenece = $objEvento->consultarEventoPertenece($idEvento);

	$cierre = $objEvento->consultarRepresentanteByDNI($dni, $idEventoPertenece);
	$validarEntrada = $objControlAsistencia->consultarEntradaById($cierre);

	if ($cierre) {
		$objControlAsistencia->registrarAsistenciaSalida($validarEntrada,$_SESSION['idsesion']);
		echo 'Control de asistencia cerrado';
	}
	else{
		echo 'El DNI ingresado no es del representante';
	}
}

function _listarParticipantesAction()
{
	$idEvento = $_POST['idEvento'];

	$objControlAsistencia = new ControlAsistencia();

	$listarParticipantesAsistentes = $objControlAsistencia->listarParticipantes($idEvento);

	require 'view/asistencia/tabAsistenciaParticipante.php';
}

function _listarPermisosAction()
{
	$idAsistencia = $_POST['id_asistencia'];

	$objControlAsistencia = new ControlAsistencia();

	$listarPermisos = $objControlAsistencia->listarPermisos($idAsistencia);

	require 'view/asistencia/tabPermisos.php';
}

function _desactivarAsistenciaAction()
{
	$idAsistencia = $_POST['id_asistencia'];

	$objControlAsistencia = new ControlAsistencia();

	$objControlAsistencia->eliminarAsistencia($idAsistencia, $_SESSION['idsesion']);

	echo 'Asistencia eliminada correctamente';
}


function _reprogramaEventoAction()
{
	$idEvento = $_POST['idEvento'];
	$fechaInicio = $_POST['fechaInicio'];
	$fechaFin = $_POST['fechaFin'];
	$horaEvento = $_POST['horaEvento'];
	list($ms)=explode('.',microtime(true));
	list($dia,$mes,$ano)=explode('/',$fechaInicio);
	list($dia1,$mes1,$ano1)=explode('/',$fechaFin);
	list($hora)=explode(' ',$horaEvento);
	$nuevaFechaInicio = $ano.'-'.$mes.'-'.$dia;
	$nuevaFechaFin = $ano1.'-'.$mes1.'-'.$dia1;
	$nuevaHoraEvento = $hora.'.'.$ms;
	$comentario = $_POST['comentario'];

	$objEvento = new Evento();
	$objEvento->reprogramarEvento($idEvento, $nuevaFechaInicio, $nuevaFechaFin, $nuevaHoraEvento, $comentario, $_SESSION['idsesion']);
	echo 'Evento reprogramado correctamente';
}

function _cancelarEventoAction()
{
	$idEvento = $_POST['idEvento'];
	$comentarioCancelar = $_POST['comentarioCancelar'];

	$objEvento = new Evento();
	$objEvento->cancelarEvento($idEvento, $comentarioCancelar, $_SESSION['idsesion']);
	echo 'Evento cancelado correctamente';
}

function _exportarAsistentesAction(){
	$idEvento = base64_decode($_GET['evento']);

	$objEvento = new Evento();
	$objControlAsistencia = new ControlAsistencia();

	$evento = $objEvento->consultarEventoByID($idEvento);

	$idEventoPertenece = $objEvento->consultarEventoPertenece($idEvento);
	
	$listaIncritos = $objControlAsistencia->listaInscritosEvento($idEventoPertenece);
	$lrepresentante = $objControlAsistencia->listaRepresentanteEvento($idEventoPertenece);
	
	require 'view/asistencia/exportarAsistentes.php';
}