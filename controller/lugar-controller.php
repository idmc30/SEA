<?php 
session_start();
require 'model/mLugar.php';
/** 
 * 01.- Irwin Morales 09/04/2019 registo de lugar
*/
function _registroAction()
{
	$manteactivo = 'active';
	require 'view/mantenimiento/lugar/vLugar.php';
}

function _registrarLugarAction(){
	$id_lugar = $_POST['txtIdLugar'];
	$nombre = $_POST['txtNombreLugar'];
	$ubicacion = $_POST['txtUbicacion'];
	$referencia = $_POST['txtReferencia'];
	$id_usuario = $_SESSION['cod_usuario'];
	$objLugar = new Lugar();
	try{
		$lugar = $objLugar->consultarLugarById($id_lugar);
		if ($lugar != NULL) {
			$objLugar->actualizarLugar($nombre, $ubicacion, $referencia, $id_lugar, $_SESSION['idsesion']);
			echo "Lugar editado satisfactoriamente";
		}
		else
		{
			$objLugar->registrarLugar($nombre, $ubicacion, $referencia, $_SESSION['idsesion']);
			echo "Lugar registrado satisfactoriamente";
		}
	}catch(Exception $e){
		echo "Lo sentimos, intentelo nuevamente";
	}
}

function _consultarLugarAction(){
	$objLugar = new Lugar();
	$listaLugar = $objLugar->consultarLugar();
	require 'view/mantenimiento/lugar/tabLugar.php';
}

function _consultarLugarByIdAction(){
	$id_lugar = $_POST['id_lugar'];
	$objLugar = new Lugar();
	$lugar = $objLugar->consultarLugarById($id_lugar);
	if($lugar == NULL){
		$lugar = array();
	}
	
	
	echo json_encode($lugar); 
}

function _eliminarLugarAction(){
	$id_lugar = $_POST['id_lugar'];
	$estado = $_POST['estado'];
	$objLugar = new Lugar();
	$objLugar->eliminarLugar($id_lugar, $estado, $_SESSION['idsesion']);
	echo "Lugar eliminado satisfactoriamente";
}
?>