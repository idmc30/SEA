<?php  
session_start();
/**
 * 01 DValdera 25/04/2019 controlador de registro manual
*/
// require 'model/mPersona.php';
require 'model/mUsuario.php';
require 'model/mPersona.php';


function _formAction()
{
	$objUsuario = new Usuario();
	// $objPersona = new Persona();
	$listaUsuario = $objUsuario->listarUsuarios();
	require 'view/registro/vUsuario.php';
}

/**
 * idmc 02/05/2019 
 */

function _deshabilitarUsuarioAction(){

   $idUsuario=$_POST['codusuario'];
	 $id_sesion_update_aud=  $_SESSION['idsesion'];
	 list($secs, $microsec) = explode('.',  microtime(true)); //se extrae los microsegundos
	 $fecha_update=date("Y-m-d H:i:s.").$microsec;

	$usuario= new Usuario();
	$eliminarUsuario= $usuario->eliminarUsuario($id_sesion_update_aud,$fecha_update,$idUsuario);

	$response= array();
	// $getUsuario= $usuario->getUsuario($idUsuario);
	// $response['codpersona']=$getUsuario->id_persona;
	
	// $idpersona= $response['codpersona'];

	// $persona= new Persona();
	// $eliminarPersona= $persona->eliminarPersona($id_sesion_update_aud,$fecha_update,$idpersona);
	$response['msj']="Se eliminó con exito";
	$response['tipo']="success";
	
	header('Content-Type: application/json');
	echo json_encode($response);
}

function _habilitarUsuarioAction(){

   	$idUsuario=$_POST['codusuario'];
	$id_sesion_update_aud=  $_SESSION['idsesion'];
	list($secs, $microsec) = explode('.',  microtime(true)); //se extrae los microsegundos
	$fecha_update=date("Y-m-d H:i:s.").$microsec;

	$usuario= new Usuario();
	$eliminarUsuario= $usuario->activarUsuario($id_sesion_update_aud,$fecha_update,$idUsuario);

	$response= array();
	$response['msj']="Se activo con exito";
	$response['tipo']="success";
	
	header('Content-Type: application/json');
	echo json_encode($response);
}

function _listarUsuarioAction(){

	$usuario= new Usuario();
	$lusuario=$usuario->listarUsuarios();
  require 'view/registro/tabUsuarios.php';
}
/**
 * fin de modificacion 02/05/2019
 */
function _registrarUsuarioAction(){
	$id_persona = $_POST['txtIdPersona'];
	$dni = $_POST['txtDNI'];
	list($nombre1, $nombre2, $ap_paterno, $ap_materno) = explode(' ',$_POST['txtnombreApellidos']);
	$nombre = $nombre1.' '.$nombre2;
	$correo = $_POST['txtCorreo'];
	$telefono = $_POST['txtTelefono'];
	$contrasena = $_POST['txtContrasena'];
	$anexo = $_POST['txtAnexo'];
	$objPersona = new Persona();
	$objUsuario = new Usuario();
	$persona = $objPersona->consultarPersonaByDNI($dni);
	$usuario = $objUsuario->consultarUsuarioByID($persona);
	if ($persona == NULL){
		$objPersona->registrarPersonaManual($dni, $nombre, $ap_paterno, $ap_materno, $correo, $telefono, $anexo, $_SESSION['idsesion']);
		if ($usuario == NULL) {
			$idpersona = $objPersona->consultarPersonaByDNI($dni);
			$objUsuario->registrarUsuarioManual($contrasena, $dni, $idpersona, $_SESSION['idsesion']);
			echo "Registrado satisfactoriamente";
		}
		else
		{
			echo "Usuario ya se encuentra registrado";
		}
	}
	else
	{
		echo "La persona ya se encuentra registrado";
	}
}
?>