<?php 
/**
 * 01.- Irwin Morales 20/06/2019 
 */
session_start();
require 'model/mRol.php';
require 'model/mUsuario.php';
require 'model/mPersona.php';


function _formAction(){
    $rol= new Rol();
    $lrol= $rol->listarRolesActivos();

	
	require 'view/configuracion/vUsuarios.php';
}

function _getUsuarioAction(){
    $codusuario= $_POST['cod'];

    $usuario = new Usuario();
    $getUsuario=$usuario->getUsuariosPerfil($codusuario);
    $response= array();

    $response['codusu']=$getUsuario->id_usuario;
    $response['pass']=$getUsuario->contrasena;
    $response['dni']=$getUsuario->dni_usuario;
    $response['codper']=$getUsuario->id_persona;
    $response['codperfil']=$getUsuario->id_rol_usuario;
    $response['nombres']=$getUsuario->nombre_persona;
    $response['apepaterno']=$getUsuario->ape_paterno;
    $response['apematerno']=$getUsuario->ape_materno;
    $response['correo']=$getUsuario->correo_persona;
    $response['telef']=$getUsuario->telefono_persona;
    $response['anexo']=$getUsuario->anexo;

    header('Content-Type: application/json');
	echo json_encode($response);
   

}


function _listarUsuariosROlAction(){
   
    $usuario = new Usuario();
    $lusuario= $usuario->listarUsuariosPerfil();


    require 'view/configuracion/tabUsuarios.php';
}



function _registrarUsuariosAction(){

    $perfil= $_POST['cmbRol'];
    $dni = $_POST['txtDNI'];
    $apepaterno=$_POST['txtapepaterno'];
    $apematerno=$_POST['txtapematerno'];
    $nombres=$_POST['txtnombres'];
    $correo=$_POST['txtCorreo'];
    $telefono=$_POST['txtTelefono'];
    $anexo=$_POST['txtAnexo'];
    $contrasena=$_POST['txtContrasena'];

	$objPersona = new Persona();
    $objUsuario = new Usuario();
    
	$persona = $objPersona->consultarPersonaByDNI($dni);
    $usuario = $objUsuario->consultarUsuarioByID($persona);
    
	if ($persona == NULL){
		$objPersona->registrarPersonaManual($dni, $nombres, $apepaterno, $apematerno, $correo, $telefono, $anexo, $_SESSION['idsesion']);
		if ($usuario == NULL) {
			$idpersona = $objPersona->consultarPersonaByDNI($dni);
			$objUsuario->insertUsuario($contrasena, $dni, $idpersona,$perfil ,$_SESSION['idsesion']);
          
            $response['msj']="Registrado satisfactoriamente";
            $response['tipo']="success";
		}
		else
		{
            
            $response['msj']="Usuario ya se encuentra registrado";
            $response['tipo']="info";
		}
	}
	else
	{
        
        $response['msj']="La persona ya se encuentra registrado";
        $response['tipo']="info";
	}

    header('Content-Type: application/json');
    echo json_encode($response);
}
