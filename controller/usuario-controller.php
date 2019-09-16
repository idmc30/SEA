<?php 

session_start();
require 'model/mRol.php';
require 'model/mUsuario.php';
require 'model/mPersona.php';


function _formAction(){
    $rol= new Rol();
    $lrol= $rol->listarRolesActivos();

	
	require 'view/configuracion/vUsuarios.php';
}


function _estadosUsuarioAction(){

    $idusuario= $_POST['cod'];
    $accion = $_POST['action'];
    $idsession=$_SESSION['idsesion'];
    list($secs, $microsec) = explode('.',  microtime(true)); 
    $fecha_update_aud=date("Y-m-d H:i:s.").$microsec;
 
    $usuario=new Usuario();

    if ($accion=='activo') {
      
        $habilitarUsuario= $usuario->activarUsuario($idsession,$fecha_update_aud,$idusuario);
        $response['msj']="Usuario activo";
        $response['tipo']="success";
    }

    if($accion=='inactivo'){
       $deshabilitarUsuario= $usuario->eliminarUsuario($idsession,$fecha_update_aud,$idusuario);
       $response['msj']="Usuario inactivo";
       $response['tipo']="success";
    }
    
    header('Content-Type: application/json');
	echo json_encode($response);

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
    $response['sexo']=$getUsuario->sexo;

    header('Content-Type: application/json');
	echo json_encode($response);

}

function _listarUsuariosROlAction(){
   
    $objUSuario = new Usuario();
    $lusuario= $objUSuario->listarUsuariosPerfil();
   
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
    $contrasena='123456';
    $codpersona=$_POST['txtIdPersona'];
    $idusuario=$_POST['txtIdUsu'];
    $sexo=$_POST['cmbsexo'];
    
    

	$objPersona = new Persona();
    $objUsuario = new Usuario();
    
	$persona = $objPersona->consultarPersonaByDNI($dni);
    $usuario = $objUsuario->consultarUsuarioByID($persona);
    
    if (!empty($codpersona) && !empty($idusuario)) {

       $updateUsuario=$objUsuario->updatetUsuario($perfil,$_SESSION['idsesion'],$idusuario);
       $updatePersona=$objPersona->updatePersona($dni,$nombres,$apepaterno,$apematerno,$sexo,$correo,$telefono,$anexo,$_SESSION['idsesion'],$codpersona);
       $response['msj']="Modificado satisfactoriamente";
       $response['tipo']="success";
    
    } else 
    {

        if ($persona == NULL){
            $objPersona->insertPersona($dni,$nombres,$apepaterno,$apematerno,$sexo,$correo,$telefono,$anexo,$_SESSION['idsesion']);
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
    }


    header('Content-Type: application/json');
    echo json_encode($response);
}
