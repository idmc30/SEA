<?php

require 'controller/class.inputfilter.php';

//La carpeta donde buscaremos los controladores
$carpetaControladores = "controller/";
//Si no se indica un controlador, este es el controlador que se usará
$controladorPredefinido = "panel";
 
//Si no se indica una accion, esta accion es la que se usará
$accionPredefinida = "panel";

$filter = new InputFilter();

if(! empty($_GET['page']))
      $controlador = $filter->process($_GET['page']);
else
      $controlador = $controladorPredefinido;
 
if(! empty($_GET['action']))
      $accion = $filter->process($_GET['action']) . 'Action';
else
      $accion = $accionPredefinida;
 
//un poco de limpieza
$controlador = preg_replace('/[^a-zA-Z0-9]/', '', $controlador);
$accion = '_' . preg_replace('/[^a-zA-Z0-9]/', '', $accion);
 
//Ya tenemos el controlador y la accion
 
//Formamos el nombre del fichero que contiene nuestro controlador
$controlador = $carpetaControladores . $controlador . '-controller.php';
 
//Incluimos el controlador o detenemos todo si no existe
if(is_file($controlador))
      require_once $controlador;
else
      die('La pagina no existe - 404 not found');
 
//Llamamos la accion o detenemos todo si no existe
if(is_callable($accion))
      $accion();
else
      die('La accion no existe - 404 not found');

  // Incluimos footer :P    

?>