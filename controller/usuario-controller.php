<?php 
/**
 * 01.- Irwin Morales 20/06/2019 
 */
session_start();
require 'model/mRol.php';
require 'model/mUsuario.php';


function _formAction(){
    $rol= new Rol();
    $lrol= $rol->listarRolesActivos();

	
	require 'view/configuracion/vUsuarios.php';
}


function _listarUsuariosROlAction(){
   
    $usuario = new Usuario();
    $lusuario= $usuario->listarUsuariosPerfil();


    require 'view/configuracion/tabUsuarios.php';
}
