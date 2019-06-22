<?php

require 'model/mEspecialidad.php'; //estoy llamando a el modelo en la rama modelo no de la rama controladores ahora voy a añadir un obtener especialidad por ID pero desde el modelo 

function _listarEspeAction(){
    
    $id_especialidad=$_POST['codigo'];
	$especialidades = new Especialidad();
	// $lespecialidades = $especialidades->listarEspecialidades();
	$lespecialidades = $especialidades->obtenerEspecialidadxId($id_especialidad);

	// print_r($lespecialidades); //ontas xd!
	// echo "Hola que haces";

}

/*
idmc 29-04-2019
*/


function _registrarAction(){
	$especialidades = new Especialidad();

	$nombre_especialidad = $_POST['nombre_especialidad'];
	$abreviatura_especialidad = $_POST['abreviatura_especialidad'];
	$estado_especialidad = $_POST['estado_especialidad'];
	$id_sesion_registro_aud = $_POST['id_sesion_registro_aud'];
	$fecha_registro_aud = $_POST['fecha_registro_aud'];


	$registrar = $especialidades->registrarEspecialidad($nombre_especialidad, $abreviatura_especialidad, $estado_especialidad, $id_sesion_registro_aud, $fecha_registro_aud);

	print_r($registrar);
}
