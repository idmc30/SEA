<?php
require 'model/mPersona.php';
require 'model/mUsuario.php';


function _formAction(){
	require 'view/usuario/vRegistro.php';
}

function _consultarPersonaByDNIAction(){
	$dni = $_POST['txtDNI'];
	$objPersona = new Persona();
	$persona = $objPersona->consultarPersonaByDNI($dni);
	$response = array();
	if($persona){
		$response['respuesta'] = "registrado";
	}
	else
	{
		$response['dni'] = $dni;
		$response['respuesta'] = "no_registrado";
	}
	header('Content-Type: application/json');
	echo json_encode($response);
}


function _registrarUsuarioAction(){
	$id_persona = $_POST['txtIdPersona'];
	$dni = $_POST['txtDNI'];
	$nombre=$_POST['txtnombres'];
	$ap_paterno=$_POST['txtapeparterno'];
	$ap_materno=$_POST['txtapematerno'];
    $correo = $_POST['txtCorreo'];
	$telefono = $_POST['txtTelefono'];
	$contrasena = $_POST['txtContrasena'];
	$objPersona = new Persona();
	$objUsuario = new Usuario();
	$respuesta = array();
		$persona = $objPersona->consultarPersonaByDNI($dni);
		$usuario = $objUsuario->consultarUsuarioByID($persona);
		if ($persona == NULL && $usuario == NULL){
			$objPersona->registrarPersona($dni, $nombre, $ap_paterno, $ap_materno, $correo, $telefono);
				$idpersona = $objPersona->consultarPersonaByDNI($dni);
				$objUsuario->registrarUsuario($contrasena, $dni, $idpersona);
				$respuesta['accion'] = "true";
		}
		else
		{
			$respuesta['accion'] = "false";
		}
		$respuesta['link'] = "index.php?page=login&action=form";
		header('Content-Type: application/json');
		echo json_encode($respuesta);
}
