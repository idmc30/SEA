<?php

session_start();
require 'model/mEvento.php';

function _panel(){
	$evento= new Evento();
	$levento= $evento->listarEventoPortada();
	require 'view/panel/vPortada.php';
}

function _buscarAction(){

	$palabra_busqueda = strtoupper($_POST['search']);
	$busqueda= '%'.$palabra_busqueda.'%';
	$evento_x_pagina=12;
	$pagina=$_GET['pagina'];
	$iniciar=($pagina-1)*$evento_x_pagina;
	
	$evento=new Evento();
	$resultado_limit=$evento->buscarEventos($iniciar,$busqueda);
	$numero_filas=count($resultado_limit);
 
	$paginas= $numero_filas/$evento_x_pagina;
	$paginas= ceil($paginas);
	$numero_pagina=$_GET['pagina'];
  if(!$numero_pagina){
 	header('location: index.php?page=panel&action=buscar&pagina=1');
 }
 
	require 'view/panel/vActividades.php';
}

function _actividadesAction()
{
	$evento=new Evento();
	$levento=$evento->listarEvento();
	$numero_filas=count($levento);
	$evento_x_pagina=12;
	$paginas= $numero_filas/$evento_x_pagina;
	$paginas= ceil($paginas);
	$numero_pagina=$_GET['pagina'];
	if(!$numero_pagina){
		header('location: index.php?page=panel&action=actividades&pagina=1');
	}
	if(is_numeric($numero_pagina)){

		if($numero_pagina>$paginas ||  $numero_pagina<0){
			header('location: index.php?page=panel&action=actividades&pagina=1');
		}else{
	
			$iniciar=($_GET['pagina']-1)*$evento_x_pagina;
			$resultado_limit=$evento->listarEventosInicio($iniciar);
		}
	}else{
		header('location: index.php?page=panel&action=actividades&pagina=1');
	}
	require 'view/panel/vActividades.php';
}
