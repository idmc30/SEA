<?php 
session_start();
// $_SESSION['idsesion']=150;
/**
 * 01.- Irwin Morales 24/04/2019 funciones inscripcion manual de evento
 */
require 'model/mEvento.php';
require 'model/mPersona.php';
require 'model/mTipoParticipante.php';
require 'model/mParticipante.php';
require 'model/mOrganizador.php';
require 'model/mUsuario.php';

function _formAction()
{
	 $evento= new Evento();
	 $levento= $evento->listarEventosActivos();

	 $tipoParticipante= new TipoParticpante();
	 $ltipoParticipante= $tipoParticipante->listarTipoParticipante();

	 $organizador= new Organizador();
	 $lorganizador= $organizador->listarOrganizadores();

	 $usuario = new Usuario();
	 $lusuario=$usuario->listarUsuarios();


	require 'view/registro/vInscripcion.php';
}

/**
 * idmc 02/05/2018 lista de participante por evento en la vista inscripcion manual
 */
function _listarParticipantesByEventoAction(){
	
	$idEvento=$_POST['idevento'];
	 
	$participanteEvento= new Participante();
	$lparticipantes= $participanteEvento->listarParticipantesxEvento($idEvento);
		
	require 'view/registro/tabRegistradosxEventos.php';
}

function _registrarInscripcionAction(){

	$id_usuario = $_POST['cmbusuario'];
	$id_evento = $_POST['cmbevento'];
	$id_tipo_participante = $_POST['cmbtipo'];
	$codigoOrganizador=$_POST['cmborganizador'];
	$certificado_participante_evento = $_POST['certificado'];
	list($secs, $microsec) = explode('.',  microtime(true)); //se extrae los microsegundos
  $fecha_registro=date("Y-m-d H:i:s.").$microsec;

	$id_sesion_registro_aud =$_SESSION['idsesion']; 

	$participante_tipo_representante=1;
	
	 try {
    if($id_tipo_participante==$participante_tipo_representante){
			$id_organizador = $codigoOrganizador;
		}else{
			$id_organizador = null;
		}


		 if($certificado_participante_evento=='si'){

			$certificado_participante_evento='TRUE';

		 }else{
			 $certificado_participante_evento='FALSE';
		 }
		 
		 $response= array();
	
		 $participanteEvento = new Participante();
	// 	 $evento= new Evento();//idmc 26-04-2019
		 
		 $validacion= $participanteEvento->validarAsistencia($id_usuario,$id_evento);
	
		 $valor_consulta=0;
		if($validacion==$valor_consulta){		 
			 
			 
			$registrar = $participanteEvento->registrarParticipantexEvento($id_evento, $id_usuario, $certificado_participante_evento, $fecha_registro, $id_sesion_registro_aud, $id_tipo_participante, $id_organizador);
			$response['msj']="Se agrego Correctamente";
			$response['tipo']="success";
		}else{
			 
			 $response['msj']="Ya se encuentra inscrito al evento";
			 $response['tipo']="warning";
	
		}
		 //code...
	 } catch (Exception $e) {
		 //throw $th;
		 $response['msj']="No se pudo registrar";
		 $response['tipo']="warning";
	 }
	 
	
	 header('Content-Type: application/json');
	 echo json_encode($response);
	
}

/**
 * idmc 26-04-2019 
 */
function _consultarEstadoCertificadoAction(){
   
   $id_evento= $_POST['id'];
	$evento= new Evento();
	$getEvento=$evento->consultarEstadoCerficadoxEvento($id_evento);
	
	$response= array();
	$response['estado']=$getEvento->evento_certificado;
	header('Content-Type: application/json');
	echo json_encode($response);
}


function _desinscribirAction(){
	$idParticipanteEvento=$_POST['cod'];
	$idsesionupdateaud=$_SESSION['idsesion']; 
	$response= array();
	
	$participanteEvento= new Participante(); 
	$eliminar=$participanteEvento->eliminarParticipanteEvento($idsesionupdateaud,$idParticipanteEvento);
	
	$response['msj']="Se eliminó Correctamente";
	$response['tipo']="success";
	header('Content-Type: application/json');
	echo json_encode($response);
}



function _consultarPersonaAction(){
	
	$dni= $_POST['dni'];
	$persona= new Persona();
	$getPersona=$persona->consultarDatosPersonaDNI($dni);
	$response = array();
	$response['idUsuario']=$getPersona->id_usuario;
	$response['nombrePersona']=$getPersona->nombre_persona;
	$response['ape_paterno']=$getPersona->ape_paterno;
    $response['ape_materno']=$getPersona->ape_materno;
	header('Content-Type: application/json');
	echo json_encode($response);
}