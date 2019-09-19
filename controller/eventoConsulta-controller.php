<?php
session_start();
require 'model/mEvento.php';
require 'model/mEspecialidad.php';
require 'model/mTipoEvento.php';
require 'model/mOrganizador.php';
require 'model/mPublicoObjetivo.php';
require 'model/mLugar.php';
require 'model/mCosto.php';
require 'model/mParticipante.php';
require 'model/mUsuario.php';


//se agrego estas funciones para consultar evento para la consulta 17/09/2019
function _consultaAction(){

	require 'view/eventos/evento_consulta/vEventoConsulta.php';
}


function _listareventosConsultaAction(){

	list($dia_i, $mes_i, $anio_i) = explode('/', $_POST['fecha_inicial']);
	$fecha_inicial = $anio_i.'-'.$mes_i.'-'.$dia_i;


	list($dia_f, $mes_f, $anio_f) = explode('/', $_POST['fecha_final']);
	$fecha_final = $anio_f.'-'.$mes_f.'-'.$dia_f;

	$eventos = new Evento();

	$leventos = $eventos->listarEventosxFecha($fecha_inicial, $fecha_final);

	$nro =1;

	$organizador=new Organizador();
	
	require 'view/eventos/evento_consulta/tablaEventosConsulta.php';
	
}



function _detalleAction(){

	$id_evento = base64_decode($_GET['key']);
	$id_evento_padre= base64_decode($_GET['key']);
	
	$participantes= new Participante();
	$lparticipantes = $participantes->listarParticipantesxEvento2($id_evento); 


	$eventos = new Evento();

	$oevento = $eventos->obtenerEventoxId($id_evento);

	$organizadores = new Organizador();

	$lorganizadores = $organizadores->listarOrganizadoresxEvento($id_evento);
	$nro_org = 1;

	$especialidades = new Especialidad();

	$lespecialidades = $especialidades->listarEspecialidadesEvento($id_evento);
	$nro_esp = 1;


	$publicoObjetivos = new PublicoObjetivo();
	$lpobjectivos = $publicoObjetivos->listarPublicoObjetivoxIdEvento($id_evento);
	$nro_pob = 1;

	list($anio_i, $mes_i, $dia_i) = explode('-', $oevento->evento_fecha_inicio);

	$oevento_fecha_inicio = $dia_i.'/'.$mes_i.'/'.$anio_i;

	list($anio_f, $mes_f, $dia_f) = explode('-', $oevento->evento_fecha_final);

	$oevento_fecha_final = $dia_f.'/'.$mes_f.'/'.$anio_f;

	$hora_am_pm = date('h:i a ', strtotime($oevento->evento_hora_inicio));

	$suma_costos = $oevento->costo_ponente_costo_evento + $oevento->costo_break_costo_evento + $oevento->costo_certificado_costo_evento;

 

	require 'view/eventos/evento_consulta/vDetalleEventoConsulta.php';
}