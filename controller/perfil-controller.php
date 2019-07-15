<?php
session_start();
require 'model/mPersona.php';
require 'model/mUsuario.php';
require 'model/mModalidadContractual.php';
require 'model/mEvento.php';
// require 'model/mParticipanteEvento.php';
/** 
 * 01.- Diego Valdera 09/04/2019 registro y edicion de perfil
*/

function _perfilAction(){

	$id_usuario_login = $_SESSION['idsesion'];

	$objUsuario = new Usuario();
	$objPersona = new Persona();
	$objModaliadContractual = new ModalidadContractual();
	$objEvento = new Evento();

	$modalidadContractual = $objModaliadContractual->consultarModalidadContractual();
	$dniUsuario = $objUsuario->consultarDNIPersonaByID($id_usuario_login);
	$persona = $objPersona->consultarDatosPersonaByDNI($dniUsuario);

	$response = array();

	$response['dni'] = $persona->dni_persona;
	$response['nombres'] = $persona->nombre_persona;
	$response['appaterno'] = $persona->ape_paterno;
	$response['apmaterno'] = $persona->ape_materno;
	$response['sexo'] = $persona->sexo;
	$response['fechnac'] = $persona->fech_nac;
	$response['direccion'] = $persona->direccion_persona;
	$response['correo'] = $persona->correo_persona;
	$response['telefono'] = $persona->telefono_persona;
	$response['profesion'] = $persona->profesion_persona;
	$response['foto'] = $persona->foto_persona;
	$response['anexo'] = $persona->anexo;
	$response['modalidadContractual'] = $persona->id_modalidad_contractual;

	$eventoParticipante = $objEvento->consultarParticipanteByID($id_usuario_login);
	$cantidadAsistencia = $objEvento->cantidadAsistenciaByID($id_usuario_login);
	$cantidadCertificado = $objEvento->cantidadCertificadoByID($id_usuario_login);
	// var_dump($id_usuario_login);

	require 'view/usuario/vPerfil.php';
}

function _actualizarPerfilAction(){

	$dni = $_POST['dni'];
	list($ap_paterno, $ap_materno) = explode(' ',$_POST['apellidos']);
	$profesion = $_POST['profesion'];
	$nombres = $_POST['nombres'];
	$correo = $_POST['correo'];
	$celular = $_POST['celular'];
	$sexo = $_POST['sexo'];
	if ($sexo == "FEMENINO") { $id_sexo = 'F'; }else{ $id_sexo = 'M'; }
	$fecha_nacimiento = $_POST['fecha'];
	$foto = $_POST['txtFoto'];
	$direccion = $_POST['direccion'];
	$modalidad_contractual = $_POST['modalidad'];
	$anexo = $_POST['anexo'];

	$objPersona = new Persona();

	$id_persona = $objPersona->consultarPersonaByDNI($dni);
	if ($id_persona){
		$objPersona->actualizarPerfilPersonaByDNI($dni, $ap_paterno, $ap_materno, $profesion, $nombres, $correo, $celular, $id_sexo, $fecha_nacimiento, $foto, $direccion, $modalidad_contractual, $_SESSION['idsesion'], $anexo);
			echo "Perfil actualizado satisfactoriamente";
	}
	else
	{
		echo 'No se pudo actualizar perfil';
	}
}
?>
