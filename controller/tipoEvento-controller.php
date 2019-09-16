
<?php 
session_start();
require 'model/mTipoEvento.php';

function _registroAction()
{
	$manteactivo = 'active';
	require 'view/mantenimiento/tipo_evento/vTipoEvento.php';
}

function _registrarTipoEventoAction(){
	$id_tipo_evento = $_POST['txtIdTipoEvento'];
	$nombre = $_POST['txtNombreTipoEvento'];
	$descripcion = $_POST['txtDescripcionTipoEvento'];
	$objTipoEvento = new TipoEvento();
	try{
		$tipoEvento = $objTipoEvento->consultarTipoEventoById($id_tipo_evento);
		if ($tipoEvento != NULL) {
			$objTipoEvento->actualizarTipoEvento($nombre, $descripcion, $id_tipo_evento, $_SESSION['idsesion']);
			echo "Tipo de evento editado satisfactoriamente";
		}
		else
		{
			$objTipoEvento->registrarTipoEvento($nombre, $descripcion, $_SESSION['idsesion']);
			echo "Tipo de evento registrado satisfactoriamente";
		}
	}catch(Exception $e){
		echo "Lo sentimos, intentelo nuevamente";
	}
}

function _consultarTipoEventoAction(){
	$objTipoEvento = new TipoEvento();
	$listaTipoEvento = $objTipoEvento->consultarTipoEvento();
	require 'view/mantenimiento/tipo_evento/tabTipoEvento.php';
}

function _consultarTipoEventoByIdAction(){
	$id_tipo_evento = $_POST['id_tipo_evento'];
	$objTipoEvento = new TipoEvento();
	$tipoEvento = $objTipoEvento->consultarTipoEventoById($id_tipo_evento);
	if($tipoEvento == NULL){
		$tipoEvento = array();
	}
	echo json_encode($tipoEvento); 
	
}

function _eliminarTipoEventoAction(){
	$id_tipo_evento = $_POST['id_tipo_evento'];
	$estado = 'FALSE';
	$objTipoEvento = new TipoEvento();
	$objTipoEvento->eliminarTipoEvento($id_tipo_evento, $estado, $_SESSION['idsesion']);
	echo "Tipo evento eliminado satisfactoriamente";
}
?>