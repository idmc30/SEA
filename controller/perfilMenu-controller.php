<?php

session_start();
require 'model/mRol.php';
require_once 'model/mMenu.php';
require_once 'model/mAcceso.php';
  
function _formAction(){
    $rol= new Rol();
    $lrol= $rol->listarRolesActivos();

	
	require 'view/configuracion/vPerfilMenu.php';
}


function _listarMenuAction(){
   
    $idPerfil= $_POST['codperfil'];
    $menu = new Menu();
    $acceso= new Acceso();
    $lmenu = $menu->listarMenuNavegacion($idPerfil);
    
	require 'view/configuracion/tabMenu.php';
}
$retVal = (condition) ? a : b ;

function _accesoAction(){
  
    list($secs, $microsec) = explode('.',  microtime(true)); //se extrae los microsegundos
    
    $idrol= $_POST['codperfil'];
    $idmenu= $_POST['codmenu'];
    $accion= $_POST['accion'];
    $idsession= $_SESSION['idsesion'];
    $fecharegistroaud=date("Y-m-d H:i:s.").$microsec;

    $acceso=  new Acceso();
    $response= array();

   if ($accion=='insert') {

       $estadoacceso= 'A';
       $nacceso= $acceso->insertarAcceso($estadoacceso,$idrol, $idmenu,$idsession,$fecharegistroaud);
       $response['tipo']="success";
       $response['msj']="Se asigno correctamente";
   }

   if ($accion=='delete') {
       # code...
       $estadoacceso= 'I';
       $fechaupdateaud=date("Y-m-d H:i:s.").$microsec;
       $uresponse=$acceso->eliminarAcceso($estadoacceso,$idrol,$idmenu,$idsession,$fechaupdateaud);
       $response['tipo']="success";
       $response['msj']="Se quito correctamente";
   }
   

 header('Content-Type: application/json');
 echo json_encode($response);


}