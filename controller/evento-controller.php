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

function _registroAction(){

	$tipoeventos = new TipoEvento();

	$ltiposeventos = $tipoeventos->consultarTipoEvento();

	$organizadores = new Organizador();

	$lorganizadores = $organizadores->listarOrganizadores();

	$especialidades = new Especialidad();

	$lespecialidades= $especialidades->listarEspecialidadesxEstado('A');

	$publicoObjetivos = new PublicoObjetivo();

	$lpobjectivos = $publicoObjetivos->listarPublicoObjetivo();

	$lugares = new Lugar();

	$listar_lugares = $lugares->consultarLugar(); 

	$usuarios = new Usuario();

	$lrepresentantes = $usuarios->listarUsuarios();

	require 'view/eventos/vRegistroEvento.php';
}




/**
 * idmc 09
 */
function _updateEstadosEventoAction(){

	$id_evento = base64_decode($_POST['key']);
	$estado_eliminado=6;
	$evento= new Evento();
	$delete=$evento->eliminarEvento($estado_eliminado,$id_evento);
	$msj="Se eliminó correctamente";
	$tipo_msj="success";

	$response = array();

	$response['msj'] = $msj;
	$response['tipo_msj'] = $tipo_msj;
  header('Content-Type: application/json');
  echo json_encode($response);	

}


/**
 * idmc 08/05/2019 se agrego la funcion para listar organizadores por evento
 */
function _listarOrganizadoresAction(){
	 $id_evento= $_POST['codEvento'];
	 
	 $organizador= new Organizador();
	 $lorganizadores= $organizador->listarOrganizadoresxEvento($id_evento);
	 
	require 'view/eventos/vModalOrganizadores.php';
}


function _registrarAction(){
	
	$imagen = $_FILES['img'];

	$tipo_evento_id = $_POST['tipo_evento'];
	$evento_nombre = $_POST['nombre'];
	$es_padre = 'false';
	$id_padre = null;
	$evento_descripcion = $_POST['descripcion'];
	$id_organizador = $_POST['organizador'];
	$representante = $_POST['representante'];	
	$evento_fecha_inicio = $_POST['fechainicioevento'];
	$evento_fecha_final = $_POST['fechafinevento'];
	$lugar_id = $_POST['lugar'];
	$evento_certificado_publico = ($_POST['certificado'] == 'si') ? 'true' : 'false' ; 
	$evento_costo_publico = (!empty($_POST['costo_certificado_publico'])) ? $_POST['costo_certificado_publico'] : null ;  
	$cant_modulos = $_POST['cantmodulos'];
	$costo_ponente_costo_evento =(!empty($_POST['costoponente'])) ? $_POST['costoponente'] : null ;
	$costo_break_costo_evento =(!empty($_POST['costobreak'])) ? $_POST['costobreak'] : null ;
	$costo_certificado_costo_evento = (!empty($_POST['costocertificado'])) ? $_POST['costocertificado'] : null ;
	// $nombre = $_POST['nombre'];

	$evento_comentario = '';

	$foto_evento = null;
	$fecha_reprogramacion = null;
	$evento_estado = 1;
	// $id_sesion_registro_aud = $_SESSION['idsesion'];
	$id_sesion_registro_aud = $_SESSION['idsesion'];

	list($secs, $microsec) = explode('.',  microtime(true)); //se extrae los microsegundos
   	$fecha_registro_aud = date("Y-m-d H:i:s.").$microsec; //se añade microsegundos a la fh de registro


	$prev_hora_inicio_evento = strtotime($_POST['hora']);
	$evento_hora_inicio = date("H:i", $prev_hora_inicio_evento);
	$evento_hora_final = null;

	$eventos = new Evento();

	$procede = true;

	$evento_nivel = 1;

	$registrarEvento = $eventos->registrarEvento($evento_nombre, $evento_descripcion, $tipo_evento_id, $es_padre, $id_padre, $evento_estado, $evento_fecha_inicio, $evento_fecha_final, $evento_hora_inicio, $evento_hora_final, $evento_foto, $evento_fecha_reprogramacion, $evento_hora_reprogramacion, $evento_certificado_publico, $evento_comentario, $lugar_id, $id_sesion_registro_aud, $fecha_registro_aud, $evento_costo_publico, $evento_hora_inicio_control, $evento_nivel,null);


	if ($registrarEvento == true) {

		$participantes = new Participante();

		$id_evento = $eventos->obtenerIdEventoxDetalle($evento_nombre, $id_sesion_registro_aud, $fecha_registro_aud);
		

		if ($id_evento == true) {
		
		$evpar_fecha_registro = date("Y-m-d");
		$tipopar_id = 1; //referencia a que el participante sera de tipo REPRESENTANTE

		$evento_pertenece = $eventos->updateEventoPertenece($id_evento,$id_evento); //asignando el codigo de evento al que pertenece
		
		$registrarOrganizador = $participantes->registrarParticipantexEvento($id_evento, $representante, true, $evpar_fecha_registro, $id_sesion_registro_aud, $tipopar_id, $id_organizador);
			
			# definimos la carpeta destino
		    $carpetaDestino="evento_afiches/";

		    # si hay algun archivo que subir
		    if(isset($imagen) && $imagen["name"]){

		    	#verifica si la carpeta destino existe
		    	if(file_exists($carpetaDestino) || @mkdir($carpetaDestino)){
						
					$origen=$imagen["tmp_name"];
					$destino=$carpetaDestino.$id_evento.'_'.$imagen["name"];

					// move_uploaded_file($origen, $destino)
					$carga_imagen = move_uploaded_file($origen, $destino);

				}
						
		    }

		}else{
			$msj = 'Ocurrió un problema en el registro';
			$tipo_msj = 'error';
			$procede = false;
		}	

	}else{

		$tipo_msj = 'error';
		$msj = 'Ocurrió un problema en el registroasdsa';
		$procede = false;

	}

	//registro detalle 

	if ($carga_imagen == true) {

		$actualizar_imagen = $eventos->actualizarImagenEvento($destino, $id_evento);

		if ($actualizar_imagen == true) {
			
			// print_r($especialidades);
			$costos = new Costo();

			$registrarCostos = $costos->registrarCostos($costo_ponente_costo_evento, $costo_break_costo_evento, $costo_certificado_costo_evento, $id_evento, $id_sesion_registro_aud, $fecha_registro_aud);


			if ($registrarCostos == true) {

				$lespecialidades = explode(',', $_POST['especialidades']);

				for ($i=0; $i < count($lespecialidades); $i++) { 
					$id_especialidad = $lespecialidades[$i];
					$registrar_esp = $eventos->registrarEventoEspecialidad($id_evento, $id_especialidad, $id_sesion_registro_aud, $fecha_registro_aud);
				}

				$lpobjetivo = explode(',', $_POST['pobjetivo']);

				for ($i=0; $i < count($lpobjetivo); $i++) { 
					$id_pobjetivo = $lpobjetivo[$i];
					$registrar_pob = $eventos->registrarEventoPobjectivo($id_evento, $id_pobjetivo, $id_sesion_registro_aud, $fecha_registro_aud);
				}

				if ($registrar_esp == true && $registrar_pob == true) {
					$msj = 'Evento registrado';
					$tipo_msj = 'success';
				}else{
					$msj = 'Ocurrió un problema en el registro de detalles';
					$tipo_msj = 'error';
					$procede = false;
				}

			} else {

				$msj = 'Ocurrió un problema al registrar costos';
				$tipo_msj = 'error';
				$procede = false;

			}


		}else{

			$msj = 'Ocurrió un problema al cargar la imagen';
			$tipo_msj = 'error';
			$procede = false;
		}


	}else{
		$tipo_msj = 'error';
		$msj = 'Ocurrió un problema en el registro';
		$procede = false;
	}


	$response = array();

	$response['msj'] = $msj;
	$response['tipo_msj'] = $tipo_msj;
	$response['procede'] = $procede;
	$response['url_redirect'] = 'index.php?page=evento&action=lista';

    header('Content-Type: application/json');
    echo json_encode($response);	
}



function _editarAction(){
	
	$id_evento = base64_decode($_GET['key']);

	$tipoeventos = new TipoEvento();

	$ltiposeventos = $tipoeventos->consultarTipoEvento();

	$organizadores = new Organizador();

	$lorganizadores = $organizadores->listarOrganizadores();

	$especialidades = new Especialidad();

	$lespecialidades= $especialidades->listarEspecialidadesxEstado('A');

	$publicoObjetivos = new PublicoObjetivo();

	$lpobjectivos = $publicoObjetivos->listarPublicoObjetivo();

	$lugares = new Lugar();

	$listar_lugares = $lugares->consultarLugar(); 

	$usuarios = new Usuario();

	$lrepresentantes = $usuarios->listarUsuarios();

	$eventos = new Evento();

	$oevento = $eventos->obtenerEventoxId($id_evento);

	$participantes = new Participante();

	$evpar_tipo = 1; //solo mostrar representantes

	$oparticipante = $participantes->listarParticipantesxTipo($evpar_tipo, $id_evento);

	//debido a que aun registrara solo un representante por orgaizador, se tomara el indice 0

	$id_organizador = $oparticipante[0]->id_organizador;
	$id_representante = $oparticipante[0]->id_usuario;

	list($anio_i, $mes_i, $dia_i) = explode('-', $oevento->evento_fecha_inicio);

	$oevento_fecha_inicio = $dia_i.'/'.$mes_i.'/'.$anio_i;

	list($anio_f, $mes_f, $dia_f) = explode('-', $oevento->evento_fecha_final);

	$oevento_fecha_final = $dia_f.'/'.$mes_f.'/'.$anio_f;	

	// $hora_amp_pm = date($oevento->hora_inicio_evento);
	$hora_amp_pm = date('h:i A', strtotime($oevento->hora_inicio_evento));


	$leventoEsp = $especialidades->listarEspecialidadesEvento($id_evento);

	foreach ($leventoEsp as $even_esp) {
		$levento_esp[] = $even_esp->id_especialidad;
	}

	$leventoPObj = $publicoObjetivos->listarPublicoObjetivoxIdEvento($id_evento);

	foreach ($leventoPObj as $even_pob) {
		$levento_pob[] = $even_pob->id_publico_objetivo;
	}

	list($repo, $imagen) = explode('/', $oevento->evento_foto);



	require 'view/eventos/vEdicionEvento.php';
}

function _actualizarAction(){

	$id_evento = base64_decode($_POST['key']);
	$imagen = $_FILES['img'];
	$es_padre = 'false';
	$id_padre = null;
	$id_tipo_evento = $_POST['tipo_evento'];
	$nombre_evento = $_POST['nombre'];
	$descripcion_evento = $_POST['descripcion'];
	$evento_comentario = $_POST['evento_comentario'];

	$id_organizador = $_POST['organizador'];
	$eventofecha_inicio = $_POST['fechainicioevento'];
	$eventofecha_final = $_POST['fechafinevento'];
	$lugar_id = $_POST['lugar'];
	$evento_certificado = ($_POST['certificado'] == 'si') ? 'true' : 'false' ; 
	$costo_certificado_publico = $_POST['costo_certificado_publico'];
	$cant_modulos = $_POST['cantmodulos'];
	$costo_ponente_costo_evento = $_POST['costoponente'];
	$costo_break_costo_evento = $_POST['costobreak'];
	$costo_certificado_costo_evento = $_POST['costocertificado'];
	$nombre = $_POST['nombre'];
	$eventohora_final = null;

	$evento_foto = null;
	$eventofecha_reprogramacion = null;
	$eventohora_reprogramacion = null;

	// $id_sesion_update_aud = $_SESSION['idsesion'];
	$id_sesion_update_aud = $_SESSION['idsesion'];

	list($secs, $microsec) = explode('.',  microtime(true)); //se extrae los microsegundos
   	$fecha_update_aud = date("Y-m-d H:i:s.").$microsec; //se añade microsegundos a la fh de registro


	$prev_hora_inicio_evento = strtotime($_POST['hora']);
	$eventohora_inicio = date("H:i", $prev_hora_inicio_evento);

	$eventohorainicio_control = $_POST['eventohorainicio_control'];


	$eventos = new Evento();


	// $actualizarEvento = $eventos->actualizarEvento($id_evento, $nombre_evento, $descripcion_evento, $fecha_inicio_evento, $fecha_final_evento, $hora_inicio_evento, $hora_final_evento, $certificado_evento, $id_lugar, $id_organizador, $id_tipo_evento, $costo_certificado_publico, $cant_modulos, $id_sesion_update_aud, $fecha_update_aud);

	$actualizarEvento = $eventos->actualizarEvento($nombre_evento, $descripcion_evento, $id_tipo_evento, $es_padre, $id_padre, 1, $eventofecha_inicio, $eventofecha_final, $eventohora_inicio, $eventohora_final, $eventofecha_reprogramacion, $eventohora_reprogramacion, $evento_certificado, $evento_comentario, $lugar_id, $id_sesion_update_aud, $fecha_update_aud, $costo_certificado_publico, $eventohorainicio_control, $id_evento);


	$procede = true;



	if ($imagen['tmp_name'] != null) {

		$oevento = $eventos->obtenerEventoxId($id_evento);

		$oimagen_evento = $oevento->evento_;

		if (file_exists($oimagen_evento)) {
		    unlink($oimagen_evento);
		}


			# definimos la carpeta destino
		    $carpetaDestino="evento_afiches/";

		    # si hay algun archivo que subir
		    if(isset($imagen) && $imagen["name"]){

		    	#verifica si la carpeta destino existe
		    	if(file_exists($carpetaDestino) || @mkdir($carpetaDestino)){
						
					$origen=$imagen["tmp_name"];
					$destino=$carpetaDestino.$id_evento.'_'.$imagen["name"];

					// move_uploaded_file($origen, $destino)
					$carga_imagen = move_uploaded_file($origen, $destino);

				}
						
		    }

		}


	    if ($carga_imagen == true) { //si la carga de imagen al repo se hizo correctamente
			$resubirImagen = $eventos->actualizarImagenEvento($destino, $id_evento);		    	
	    }else{
	    	$procede = false;
	    	$msj = 'Ocurrió un error en la actualizacion';
	    	$tipo_msj = 'error';		    	
	    }

	    $costos = new Costo();

	    $oIdCostoEvento = $costos->obtenerCostoxIdEvento($id_evento);

	    $id_costo_evento = $oIdCostoEvento->id_costo_evento;

	    // $actualizarCostos = $costos->actualizarcostosEvento($id_evento, $costo_ponente_costo_evento, $costo_break_costo_evento, $costo_certificado_costo_evento, $id_sesion_update_aud, $fecha_update_aud);
	    $actualizarCostos = $costos->actualizarcostos($id_costo_evento, $costo_ponente_costo_evento, $costo_break_costo_evento, $costo_certificado_costo_evento, $id_evento, $id_sesion_update_aud, $fecha_update_aud);

	    $deleteEspecialidadesPrev = $eventos->eliminarEspecialidadesxEvento($id_evento);

	    if ($deleteEspecialidadesPrev == true) {
			$lespecialidades = explode(',', $_POST['especialidades']);

			for ($i=0; $i < count($lespecialidades); $i++) { 
				$id_especialidad = $lespecialidades[$i];
				$registrar_esp = $eventos->registrarEventoEspecialidad($id_evento, $id_especialidad, $id_sesion_update_aud, $fecha_update_aud);
			}
	    }else{
	    	$procede = false;
	    	$msj = 'Ocurrió un error en la actualizacion';
	    	$tipo_msj = 'error';
	    }

	    $deletePuObjPrev = $eventos->eliminarPublicoObjetivoxEvento($id_evento);
		if ($deletePuObjPrev == true) {
			$lpobjetivo = explode(',', $_POST['pobjetivo']);

			for ($i=0; $i < count($lpobjetivo); $i++) { 
				$id_pobjetivo = $lpobjetivo[$i];
				$registrar_pob = $eventos->registrarEventoPobjectivo($id_evento, $id_pobjetivo, $id_sesion_update_aud, $fecha_update_aud);
			}				
		}else{
	    	$procede = false;
	    	$msj = 'Ocurrió un error en la actualizacion';
	    	$tipo_msj = 'error';				
		}

		
	


	if ($procede = true) {

		$msj = 'Evento actualizado correctamente';
		$tipo_msj = 'success';

	}



	$response['msj'] = $msj;
	$response['tipo_msj'] = $tipo_msj;
	$response['procede'] = $procede;
	$response['url_redirect'] = 'index.php?page=evento&action=detalle&key='.base64_encode($id_evento);

    header('Content-Type: application/json');
    echo json_encode($response);


}
	
	//09/05/2019 idmc listado de items por evento
	function _listaItemsAction(){

	 $id_evento = base64_decode($_POST['key']);
	 $id_evento_pertenece_padre= $_POST['key']; //idmc
	 $id_evento_pertenece=false;

	 $eventos = new Evento();
   $litems=$eventos->listarItemsxEvento($id_evento);
		
	 require 'view/eventos/tabListadoItems.php';
	}

	function _listaItemsHijosAction(){

		$id_evento = base64_decode($_POST['key']);
		$id_evento_pertenece= $_POST['keyPrimerPadre']; //idmc
		$id_evento_pertenece_padre= false;
 
		$eventos = new Evento();
		$litems=$eventos->listarItemsxEvento($id_evento);
		 
		require 'view/eventos/tabListadoItems.php';
	 }

	//09/05/2019 idmc listado de items por evento
	function _itemAction(){

		$id_evento = base64_decode($_GET['key']);
		$id_evento_primer_padre= $_GET['eventopadre'];
	
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

		// $hora_am_pm = date("G:i", strtotime($oevento->evento_hora_inicio));
		$hora_am_pm = date('h:i a ', strtotime($oevento->evento_hora_inicio));

		require 'view/eventos/vDetalleItem.php';
	}



function _detalleAction(){

	$id_evento = base64_decode($_GET['key']);
	$id_evento_padre= base64_decode($_GET['key']);
	
	$participantes= new Participante();
	$lparticipantes = $participantes->listarParticipantesxEvento($id_evento); 


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

	// $hora_am_pm = date("G:i", strtotime($oevento->evento_hora_inicio));
	$hora_am_pm = date('h:i a ', strtotime($oevento->evento_hora_inicio));

	$suma_costos = $oevento->costo_ponente_costo_evento + $oevento->costo_break_costo_evento + $oevento->costo_certificado_costo_evento;

 

	require 'view/eventos/vDetalleEvento.php';
}

function _listaAction(){

	require 'view/eventos/vListaEvento.php';
}

function _listareventosAction(){

	list($dia_i, $mes_i, $anio_i) = explode('/', $_POST['fecha_inicial']);
	$fecha_inicial = $anio_i.'-'.$mes_i.'-'.$dia_i;


	list($dia_f, $mes_f, $anio_f) = explode('/', $_POST['fecha_final']);
	$fecha_final = $anio_f.'-'.$mes_f.'-'.$dia_f;

	$eventos = new Evento();

	$leventos = $eventos->listarEventosxFecha($fecha_inicial, $fecha_final);

	$nro =1;

	//idmc 08/05/2019 se agrego el metodo para contar cuantos organizadores tiene cada evento
	$organizador=new Organizador();
	

	require 'view/eventos/tablaeventos.php';
	

}


function _moduloAction(){
	$id_evento = base64_decode($_GET['key']);

	$eventos = new Evento();

	$oevento = $eventos->obtenerEventoxId($id_evento);
	
	require 'view/eventos/vModulo.php';
}

function _modaladditemAction(){

	$titulo_modal = 'AÑADIR ';

	$eventotipos = new TipoEvento();

	$ltipos = $eventotipos->consultarTipoEvento();

	$key = base64_decode($_POST['key']);
	// print_r($ltipos);

	require 'view/eventos/vModalAniadir.php';
}


/**
 * idmc 09/05/2019
 */
function _editarItemAction(){
	
	$id_evento = base64_decode($_POST['key']);
	$evento= new Evento();
	$eventotipos = new TipoEvento();
	$ltipos = $eventotipos->consultarTipoEvento();
	$getEvento= $evento->obtenerEventoxId($id_evento);

	$response = array();
	$response['codEvento']=$getEvento->evento_id;
	$response['idtipoEvento']=$getEvento->evento_tipo_id;
	$response['nombreTipoEvento']=$getEvento->evento_tipo_nombre;
	$response['nombreEvento']=$getEvento->evento_nombre;
	$response['descripcionEvento']=$getEvento->evento_descripcion;
	$response['fechaInicioEvento']=$getEvento->evento_fecha_inicio;
	$response['fechaFinal']=$getEvento->evento_fecha_final;
	$response['horainicio']=$getEvento->evento_hora_inicio;
	$response['horafinal']=$getEvento->evento_hora_final;

  
	require 'view/eventos/vModalAniadir.php';
}



function _registrarItemAction(){

	$eventos = new Evento();
	

	$tipo_evento_id = $_POST['tipo'];
	$evento_nombre = $_POST['nombre'];
	$evento_descripcion = $_POST['descripcion'];
	$evento_fecha_inicio = $_POST['fecha_i'];
	$evento_hora_inicio = $hora_inicio = (empty($_POST['hora_i'])) ? null : $_POST['hora_i']; 
	$evento_fecha_final = $_POST['fecha_f'];
	$evento_hora_final = $hora_fin = (empty($_POST['hora_f'])) ? null : $_POST['hora_f'];  //$_POST['hora_f'];
	$id_sesion_registro_aud = $_SESSION['idsesion'];

	// var_dump($evento_hora_inicio);

	$idEventoUpdate=base64_decode($_POST['codEventoUpdate']);

			list($secs, $microsec) = explode('.',  microtime(true)); //se extrae los microsegundos
			$fecha_registro_aud = date("Y-m-d H:i:s.").$microsec; //se añade microsegundos a la fh de registro
			// $evento_nivel = $_POST['nivel'];

			$es_padre = 'false';
			$evento_estado = '1';
	
			if (empty(!$idEventoUpdate)) {
				
				$id_padre=base64_decode($_POST['keyupdate']);
				$idsesion_update_aud=$_SESSION['idsesion']; 
				list($secs, $microsec) = explode('.',  microtime(true)); //se extrae los microsegundos
				$fechaupdate_aud=date("Y-m-d H:i:s.").$microsec;


				$updateItem=$eventos->actualizarEvento($evento_nombre,$evento_descripcion,$tipo_evento_id,$es_padre,$id_padre,$evento_estado,$evento_fecha_inicio,$evento_fecha_final,$evento_hora_inicio,$evento_hora_final,$eventofecha_reprogramacion,$eventohora_reprogramacion,$evento_certificado_publico,$evento_comentario,$lugar_id,$idsesion_update_aud,$fechaupdate_aud,$evento_costo_publico,$evento_hora_inicio_control,$idEventoUpdate);
				$response['tipo']="success";
				$response['msj']="Se actualizó correctamente";

			} else{
				// echo "Registra";
				$id_padre = base64_decode($_POST['key']);
        $key_primer_padre= ($_POST['keyprimerpadre']) ? base64_decode($_POST['keyprimerpadre']) : $id_padre ; //IDMC
				$oevento = $eventos->obtenerEventoxId($id_padre);

	
				$evento_nivel = ($oevento->evento_nivel) + 1;
			
				$registrarItem= $eventos->registrarEvento($evento_nombre, $evento_descripcion, $tipo_evento_id, $es_padre, $id_padre, $evento_estado, $evento_fecha_inicio, $evento_fecha_final, $evento_hora_inicio, $evento_hora_final, $evento_foto, $evento_fecha_reprogramacion, $evento_hora_reprogramacion, $evento_certificado_publico, $evento_comentario, $lugar_id, $id_sesion_registro_aud, $fecha_registro_aud, $evento_costo_publico, $evento_hora_inicio_control, $evento_nivel,$key_primer_padre);
				
				$response['tipo']="success";
				$response['msj']="Se agregó correctamente";
			}

	
	header('Content-Type: application/json');
  echo json_encode($response);
	


}


function _tablaitemsAction(){

	// $key = base64_decode($_POST['key']);

	// $eventos = new Evento();



	// $litems = $evento->

	require 'view/eventos/tablaeventos.php';;
}

function _exportarEventosAction(){

	$fechaInicial = $_GET['fecha_inicial'];
	$fechaFinal = $_GET['fecha_final'];

	list($dia_i, $mes_i, $anio_i) = explode('/', $_GET['fecha_inicial']);
	$fecha_inicial = $anio_i.'-'.$mes_i.'-'.$dia_i;


	list($dia_f, $mes_f, $anio_f) = explode('/', $_GET['fecha_final']);
	$fecha_final = $anio_f.'-'.$mes_f.'-'.$dia_f;

	$eventos = new Evento();

	$leventos = $eventos->listarEventosxFecha($fecha_inicial, $fecha_final);

	$nro =1;

	$organizador=new Organizador();
	

	require 'view/eventos/exportarEventos.php';
}