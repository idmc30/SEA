<?php
session_start();
require 'model/mOrganizador.php';
require 'model/mTipoOrganizador.php';
require 'model/mPersona.php';
require 'model/mRepresentante.php';
/* 
   1.- Irwin Morales 09/04/2018 registro de organizador
*/
// $_SESSION['idsesion']=100; 

function _registroAction()
{
  $tipoOrg= new TipoOrganizador();
  $persona= new Persona();
  $ltipoOrg= $tipoOrg->listarTipoOrganizador();
  $lpersona= $persona->consultarPersona() ;
	require 'view/mantenimiento/organizador/vOrganizador.php';
}
/**
 * idmc 03/05/2019 
 */
function _representanteAction(){
   
   $id_organizador=$_GET['idorganizador'];
   $representante= new Representante();
   $lrepresentante= $representante->listarRepresentante($id_organizador);
   require 'view/mantenimiento/organizador/vRepresentante.php';
}

function _deleteRepresentanteAction(){
   
  $id_sesion_update_aud= $_SESSION['idsesion'];
  list($secs, $microsec) = explode('.',  microtime(true)); //se extrae los microsegundos
  $fecha_update_aud=date("Y-m-d H:i:s.").$microsec;
  $evpar_id=$_POST['codeventoparti'];
  try {
    //code...
    
    $representante= new Representante();
    $update= $representante->eliminarRepresentante($id_sesion_update_aud,$fecha_update_aud,$evpar_id);
    $response['tipo']="success";
    $response['msj']="Se asigno correctamente";

  } catch (Exception $e) {
    $response['tipo']="error";
    $response['msj']="No se pudo asignar";
  }


  header('Content-Type: application/json');
  echo json_encode($response);
}

/**
 * fin de idmc 03/05/2019 
 */


function _registrarRepresetanteAction(){
try {
  $estadorepresentante='A';
  $idorganizador=$_POST['codorganizador'];
  $idusuario=$_POST['codusuario'];
  $idsesionregistroaud= $_SESSION['idsesion']; 
  list($secs, $microsec) = explode('.',  microtime(true)); //se extrae los microsegundos
  $fechaCreate=date("Y-m-d H:i:s.").$microsec;
  
  $organizador= new Organizador();
  $registrar =$organizador->insertarRepresentante($estadorepresentante,$idorganizador,$idusuario,$idsesionregistroaud,$fechaCreate);
  $response = array();
  $response['tipo']="success";
  $response['msj']="Se asigno correctamente";
  
} catch (Exception $e) {
  //throw $th;
  $response['tipo']="error";
  $response['msj']="No se pudo asignar";
  
}
  header('Content-Type: application/json');
  echo json_encode($response);
}
function _getModalidadContractualAction(){
  
  $idModalidadContractual=$_POST['id'];
  $persona= new Persona();
  $getPersona=$persona->consultarModalidadContractualPersona($idModalidadContractual);
  $response = array();
  $response['idModalidad']=$getPersona->id_modalidad_contractual;
  $response['nombreModalidad']=$getPersona->nombre_modalidad_contractual;
  header('Content-Type: application/json');
  echo json_encode($response);
   
}
function _eliminarOrganizadorAction(){
	$id_organizador=$_POST['id'];
	$estadoOrganizador='i';
	$idUsuarioUpdate=$_SESSION['idsesion']; 
	list($secs, $microsec) = explode('.',  microtime(true)); //se extrae los microsegundos
	$fechaUpdate=date("Y-m-d H:i:s.").$microsec;
	
		 try {			
		   $organizador= new Organizador();
			 $eliminar= $organizador->eliminarOrganizador($idUsuarioUpdate,$fechaUpdate,$estadoOrganizador,$id_organizador);
			 $response['msj']="Se eliminó con exito";
			 $response['tipo']="success";
			 
		 } catch (Exception $e) {
			 //throw $th;
			 $response['msj']="No se pudo eliminar";
			 $response['tipo']="warning";
		 }
		 header('Content-Type: application/json');
		 echo json_encode($response);
    }
function _getOrganizadorAction(){
	
	$id=$_POST['id'];
	$organizador= new Organizador();
	$getOrganizador=$organizador->getOrganizador($id);
	$response = array();
	$response['idOrganizador']=$getOrganizador->id_organizador;
	$response['telefOrganizador']=$getOrganizador->telefono_organizador;
	$response['anexoOrganizador']=$getOrganizador->anexo_organizador;
  $response['nombreOrganizador']=$getOrganizador->nombre_organizador;
  $response['idTipoOrganizador']=$getOrganizador->id_tipo_organizador;
  $response['nombreTipOrganizador']=$getOrganizador->nombre_tipo_organizador;
	header('Content-Type: application/json');
	echo json_encode($response);
	 
}


function _listarOrganizadorAction(){
  
  $organizador= new Organizador();
  $lorganizador=$organizador->listarOrganizadores();
  require 'view/mantenimiento/organizador/tabOrganizador.php';
   
}

function _registrarOrganizadorAction()
{
 
   try {
     list($secs, $microsec) = explode('.',  microtime(true)); //se extrae los microsegundos
     $telefono = (!empty($_POST['txttelefono'])) ?  $_POST['txttelefono'] : null ;
     $anexo= (!empty($_POST['txtanexo'])) ?  $_POST['txtanexo'] : null ;
     $nombre = $_POST['txtnombre'];
     $idtipoorganizador= $_POST['cmbtipoorga'];
     $idsesionregistroaud= $_SESSION['idsesion']; 
     $fechaCreate=date("Y-m-d H:i:s.").$microsec;
   
     $response = array();
  
     $organizador= new Organizador();
  
      if (!empty($_POST['codorganizador'])) {
  
        $fechaUpdate=date("Y-m-d H:i:s.").$microsec;
        $idsesionupdateaud= $_SESSION['idsesion']; 
        
        $idorganizador=$_POST['codorganizador'];
  
        $update = $organizador->modificarOrganizador($telefono,$anexo,$nombre,$idtipoorganizador,$idsesionupdateaud,$fechaUpdate,$idorganizador);    
        $response['tipo']="success";
        $response['msj']="Se actualizó  con exito";
        
        }else{
          $registrar= $organizador->insertarOrganizador($telefono,$anexo,$nombre,$idtipoorganizador,$idsesionregistroaud,$fechaCreate);
          $response['tipo']="success";
          $response['msj']="Se registró  con exito";
      }
    
   } catch (Exception $e) {
    $response['tipo']="error";
    $response['msj']="No se pudo completar la acción";
   }
				
  header('Content-Type: application/json');
  echo json_encode($response);
}

