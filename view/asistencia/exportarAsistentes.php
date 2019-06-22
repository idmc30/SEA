<?php 
require_once('PHPExcel/PHPExcel.php');
require_once('PHPExcel/PHPExcel/IOFactory.php'); 
require_once('PHPExcel/PHPExcel/Writer/Excel5.php');

$inputFileName='PHPExcel/Formato/asistentes.xls';
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load($inputFileName);

$objPHPExcel->setActiveSheetIndex(0);		
$objSheet = $objPHPExcel->getActiveSheet();

$objSheet->getCell('B1')->setValue(strtoupper('CORTE SUPERIOR DE JUSTICIA DE LAMBAYEQUE'));
$objSheet->getCell('B2')->setValue(strtoupper('LISTA DE ASISTENTES DEL EVENTO'. strtoupper($evento->evento_nombre)));

$num_celda = 5;
$contador = 1;
foreach ($listaIncritos as $inscritos):
	$objSheet->getCell('A'.$num_celda)->setValue($contador);
	$objSheet->getCell('B'.$num_celda)->setValue($inscritos->ape_paterno.' '.$inscritos->ape_materno);
	$objSheet->getCell('D'.$num_celda)->setValue($inscritos->nombre_persona);
	$objSheet->getCell('F'.$num_celda)->setValue($inscritos->dni_persona);
	list($horaentrada, $milisegundo) = explode('.',$inscritos->hora_entrada_asistencia);
	$objSheet->getCell('G'.$num_celda)->setValue($horaentrada);
	list($horasalida, $milisegundo) = explode('.',$inscritos->hora_salida_asistencia);
	$objSheet->getCell('H'.$num_celda)->setValue($horasalida);
	$id_personal = $objControlAsistencia->consultarPersonalByDNI($inscritos->dni_persona);
	if ($id_personal) {
		$objSheet->getCell('I'.$num_celda)->setValue('Interno');
	}else{
		$objSheet->getCell('I'.$num_celda)->setValue('Externo');
	}
		//se va convertir a minutos las horas de entrada y salida de la asistencia
		list($horaE, $minutosE, $segundosE) = explode(':',$horaentrada);
		list($horaS, $minutosS, $segundosS) = explode(':',$horasalida);

		$minutosEntradaTotales= ($horaE * 60) + $minutosE;
		$minutosSalidaTotales= ($horaS * 60) + $minutosS;
		$minutosAsistidos = $minutosSalidaTotales - $minutosEntradaTotales;
		
		//listando los permisos para extraer la hora de salida y entrada de los permisos
		$listaPermisos = $objControlAsistencia->listarPermisos($inscritos->asist_id);
		foreach ($listaPermisos as $permisos):
			//se esta convirtiendo a minutos la hora de salida y entrada de los permisos
			list($horaPE, $minutosPE, $segundosPE) = explode(':',$permisos->hora_entrada_permiso);
			list($horaPS, $minutosPS, $segundosPS) = explode(':',$permisos->hora_salida_permiso);

			$minutosPermisoEntradaTotales= ($horaPE * 60) + $minutosPE;
			$minutosPermisoSalidaTotales= ($horaPS * 60) + $minutosPS;
			$minutosPermiso = $minutosPermisoEntradaTotales - $minutosPermisoSalidaTotales;
			$suma_minutos_permiso+=$minutosPermiso;
		endforeach;

		$tiempoTotalAsistido = $minutosAsistidos - $suma_minutos_permiso;

		//convertir de minutos a horas
		$minutos = $tiempoTotalAsistido%60;//sacamos el resto pra obtener los minutos
		$horas = $tiempoTotalAsistido/60; //sacamos la cantidad de horas y luego sacammos la parte entera
		list($horaEntera,$horaDecimal) = explode('.',$horas);

	$objSheet->getCell('K'.$num_celda)->setValue($horaEntera.' horas '.$minutos.' minutos');

	//calculando la asistencia del representante
	foreach ($lrepresentante as $representanteEvento):
		if ($representanteEvento->tipo_asistente == 'R') {
			list($horaEntrada, $milisegundo) = explode('.',$inscritos->hora_entrada_asistencia);
			list($horaSalida, $milisegundo) = explode('.',$inscritos->hora_salida_asistencia);
			list($horaEn, $minutosEn, $segundosEn) = explode(':',$horaEntrada);
			list($horaSa, $minutosSa, $segundosSa) = explode(':',$horaSalida);

			$minutosEntradaTotalesRepresentante= ($horaEn * 60) + $minutosEn;
			$minutosSalidaTotalesRepresentante= ($horaSa * 60) + $minutosSa;
			$minutosDuracionPonencia = $minutosSalidaTotalesRepresentante - $minutosEntradaTotalesRepresentante;
		}
	endforeach;

	$porcentajeDurado = ($tiempoTotalAsistido * 100)/$minutosDuracionPonencia;

	$objSheet->getCell('L'.$num_celda)->setValue(round($porcentajeDurado,2).'%');
	if ($inscritos->evpar_certificado == 'TRUE') {
		$objSheet->getCell('M'.$num_celda)->setValue('SI');
	}else{
		$objSheet->getCell('M'.$num_celda)->setValue('NO');
	}
	$asistio = $objControlAsistencia->listarParticipantesByDNI($inscritos->evento_id, $inscritos->dni_persona);
	if ($asistio) {
		$objSheet->getCell('N'.$num_celda)->setValue('ASISTIO');
	}else{
		$objSheet->getCell('N'.$num_celda)->setValue('FALTO');
	}
	$num_celda=$num_celda+1;
	$contador++;
endforeach;

// var_dump($tiempoTotalAsistido);

$nombre_servicio = 'ListaAsistentes';

header('Content-Type: application/vnd.ms-excel;charset=utf-8');
header('Content-Disposition: attachment;filename="'.$nombre_servicio.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
ob_end_clean();
$objWriter->save('php://output');

?>