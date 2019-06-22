<?php
session_start();
require 'model/mEvento.php';

$_SESSION['idsesion']=4;

function _listaeventosAction()
{
	$idUsuario=$_SESSION['idsesion']; 
	$evento = new Evento();
	$lmisevento=$evento->listarMisEventos($idUsuario);
	require 'view/inscripcion/vEventosUsuario.php';
}