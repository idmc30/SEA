<?php
session_start();
require 'model/mUsuario.php';

function _formAction(){
	require 'view/usuario/vLogin.php';
}


function _cerrarAction(){
	unset($_SESSION['sis_migracion_user']);
   
	header("location: index.php?page=login&action=form");
}

function _validaIngresoAction(){
  
	$dni = $_POST['txtDNI'];
  	$contrasena = $_POST['txtContrasena'];
  
	if($dni != NULL && $contrasena != NULL){
		$objUsuario = new Usuario();
		$usuarioRegistro = $objUsuario->consultarUsuarioByDNI($dni);
		$response = array();
		if ($usuarioRegistro) {
			$usuariologin = $objUsuario->consultarIngresoUsuario($dni, $contrasena);
			$datosUsuario = $objUsuario->consultarUsuarioByDNI($dni);
			$response = array();
			$response['idPerfil'] = $datosUsuario->id_rol_usuario;
	
			if($usuariologin){
				$response['respuesta'] = "ingreso";
				$_SESSION['idsesion'] = $usuariologin;
				$_SESSION['idperfil'] = $response['idPerfil'];
				$response['link'] = "index.php?page=inicio&action=inicio";
			}
			else
			{
				$response['respuesta'] = "error";
			}
		}
		else
		{
			$response['respuesta'] = "SR";
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	else
	{
		header("location: index.php?page=login&action=form");
	}
}
?>