<?php 

session_start();
require 'model/mPublicoObjetivo.php';


function _registroAction()
{
	require 'view/mantenimiento/publico_objetivo/vPublicoObjetivo.php';
}
function _eliminarPublicoObjetivoAction(){
	$id_publico_objetivo=$_POST['id'];
	$estadoPuObj='I';
	$idUsuarioUpdate=$_SESSION['idsesion']; 
	list($secs, $microsec) = explode('.',  microtime(true));
	$fechaUpdate=date("Y-m-d H:i:s.").$microsec;
	$response = array();
		 try {			
			 $publicoObjetivo= new PublicoObjetivo();
			 $eliminar= $publicoObjetivo->eliminarPublicoObjetivo($id_publico_objetivo, $estadoPuObj,$idUsuarioUpdate,$fechaUpdate);
			 $response['msj']="Se eliminó con exito";
			 $response['tipo']="success";
			 
		 } catch (Exception $e) {
			 $response['msj']="No se pudo eliminar";
			 $response['tipo']="warning";
		 }
		 header('Content-Type: application/json');
		 echo json_encode($response);
}
function _getPublicoObjetivoAction(){
	
	$id=$_POST['id'];
	$publicoObjetivo= new PublicoObjetivo();
	$getPubObjetivo=$publicoObjetivo->getPublicoObjetivo($id);
	$response = array();
	$response['idPuObj']=$getPubObjetivo->id_publico_objetivo;
	$response['nombrePuObj']=$getPubObjetivo->nombre_publico_objetivo;
	$response['descripcionPuObj']=$getPubObjetivo->descripcion_publico_objetivo;
	$response['estadoPuObj']=$getPubObjetivo->estado_publico_objetivo;
	header('Content-Type: application/json');
	echo json_encode($response);
	 
}
function _registrarPublicoObjetivoAction(){
	
	$_SESSION['idsesion'];
   $nombre=$_POST['txtnombre'];
   $descripcion=$_POST['textareadescripcion'];
   list($secs, $microsec) = explode('.',  microtime(true));
   
   $response = array();
   $publicoObjetivo= new PublicoObjetivo();
		try {
			if (!empty($_POST['txtidpublicoobjetivo'])) {
			
				$idUsuarioUpdate=$_SESSION['idsesion']; 
				$fechaUpdate=date("Y-m-d H:i:s.").$microsec;
				$id_publico_objetivo=$_POST['txtidpublicoobjetivo'];
				$actualizar= $publicoObjetivo->modificarPublicoObjetivo($nombre,$descripcion,$id_publico_objetivo,$idUsuarioUpdate,$fechaUpdate);
				$response['tipo']="success";
				$response['msj']="Se actualizó  con exito";
			}else{
				$idUsuarioCreate= $_SESSION['idsesion']; 
                $fechaCreate=date("Y-m-d H:i:s.").$microsec;
				$registrar= $publicoObjetivo->insertarPublicoObjetivo($nombre,$descripcion,$idUsuarioCreate,$fechaCreate);
				
				$response['msj']="Se registró con exito";
				$response['tipo']="success";
				}
				
		} catch (Exception $e) {

			$response['msj']="No se pudo registrar";
			$response['tipo']="warning";
		}
   
  
   header('Content-Type: application/json');
   echo json_encode($response);
	
}
function _listarPublicoObjetivoAction(){
	
	$publicoObjetivo= new PublicoObjetivo();
	$lPublcoObjetivo=$publicoObjetivo->listarPublicoObjetivo();
	require 'view/mantenimiento/publico_objetivo/tabPublicoObjetivo.php';
}




