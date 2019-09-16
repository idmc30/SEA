<?php
session_start();
require 'model/mEvento.php';
require 'model/mParticipante.php';

function _inicioAction(){

	require 'view/vInicio.php';
}

function _listarEventosAction(){
	$idUsuario= $_SESSION['idsesion'];

	$evento= new Evento();
	$participanteEvento = new Participante();
	
	$leventos= $evento->listarEventoInicio();

	require 'view/tabInicio.php';
}

function _desinscribirAction(){

	$idsesionupdateaud=$_SESSION['idsesion'];
	$idUsuario=$_POST['idusu'];
	$idEvento=$_POST['idevento']; 

	$participanteEvento= new Participante(); 
	$idParticipanteEvento= $participanteEvento->consultarIdParticipanteEvento($idUsuario,$idEvento);
	$eliminar=$participanteEvento->eliminarParticipanteEvento($idsesionupdateaud,$idParticipanteEvento);
	
	$response= array();
	$response['msj']="Accion realizada Correctamente";
	$response['tipo']="success";
	header('Content-Type: application/json');
	echo json_encode($response);
}


function _registrarInscripcionAction(){
	 
	$asistente=3;
	 
	$id_usuario = $_POST['idusu'];
	$id_evento = $_POST['idevento'];
	$id_tipo_participante = $asistente;
	$id_organizador = null;
	$certificado_participante_evento = ($_POST['certificado']=="SI") ? 'TRUE' : 'FALSE' ;
	list($secs, $microsec) = explode('.',  microtime(true)); 
  $fecha_registro=date("Y-m-d H:i:s.").$microsec;

	$id_sesion_registro_aud =$_SESSION['idsesion']; 

	$participanteEvento = new Participante();

	$registrar = $participanteEvento->registrarParticipantexEvento($id_evento, $id_usuario, $certificado_participante_evento, $fecha_registro, $id_sesion_registro_aud, $id_tipo_participante, $id_organizador);
	
			$response['msj']="Se agrego Correctamente";
			$response['tipo']="success";
			header('Content-Type: application/json');
			echo json_encode($response);		
}


function _getEventoInicioAction(){
	$idEvento = $_POST['id'];
	$evento = new Evento();
	$getEvento= $evento->obtenerEventoxId($idEvento);
	$response= array();
	$response['nombreEvento']=$getEvento->evento_nombre;
	$response['descripcion']=$getEvento->evento_descripcion;
	$response['fechaInicio']=$getEvento->evento_fecha_inicio;
	$response['hora']=$getEvento->evento_hora_inicio;
	$response['lugar']=$getEvento->nombre_lugar;
	$response['costoevento']=$getEvento->evento_costo_publico;
	$response['costocertificado']=$getEvento->costo_certificado_publico;
	
	header('Content-Type: application/json');
  echo json_encode($response);
}


function _listarEventosInicioAction(){
	$idUsuario= $_SESSION['idsesion'];


	$evento= new Evento();
	$participanteEvento = new Participante();
	
	$leventos= $evento->listarEvento();


	require 'view/tabInicio.php';
}

function _listarEventosPrincipalAction(){

	require 'view/mantenimiento/tabEventosPrincipal.php';
}