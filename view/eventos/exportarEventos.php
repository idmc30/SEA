<?php 
require_once('PHPExcel/PHPExcel.php');
require_once('PHPExcel/PHPExcel/IOFactory.php'); 
require_once('PHPExcel/PHPExcel/Writer/Excel5.php');

$inputFileName='PHPExcel/Formato/eventos.xls';
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load($inputFileName);

$objPHPExcel->setActiveSheetIndex(0);		
$objSheet = $objPHPExcel->getActiveSheet();

$objSheet->getCell('B1')->setValue(strtoupper('CORTE SUPERIOR DE JUSTICIA DE LAMBAYEQUE'));
$objSheet->getCell('B2')->setValue(strtoupper('LISTA DE EVENTOS DESDE '.$fechaInicial.'-'.$fechaFinal));

$num_celda = 5;
$contador = 1;
foreach ($leventos as $eventos):
	$objSheet->getCell('A'.$num_celda)->setValue($contador);
	$objSheet->getCell('B'.$num_celda)->setValue(($eventos->evento_nombre));
	$objSheet->getCell('E'.$num_celda)->setValue(($eventos->evento_descripcion));
		$lorganizadores= $organizador->listarOrganizadoresxEvento($eventos->evento_id);
		if ($lorganizadores){
			foreach ($lorganizadores as $organizadores):
				$objSheet->getCell('H'.$num_celda)->setValue(($organizadores->nombre_organizador));
			endforeach;
		}else{
			$objSheet->getCell('H'.$num_celda)->setValue('No tiene organizador');
		}
	$objSheet->getCell('K'.$num_celda)->setValue(($eventos->evento_fecha_inicio));
	$objSheet->getCell('L'.$num_celda)->setValue((($eventos->evento_certificado == true) ? 'Si' : 'No' ));
	$objSheet->getCell('M'.$num_celda)->setValue(($eventos->evento_estado_nombre));
	$objSheet->getCell('N'.$num_celda)->setValue(($eventos->evento_tipo_nombre));
	$num_celda=$num_celda+1;
	$contador++;
endforeach;


$nombre_servicio = 'ListaEventos';

header('Content-Type: application/vnd.ms-excel;charset=utf-8');
header('Content-Disposition: attachment;filename="'.$nombre_servicio.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
ob_end_clean();
$objWriter->save('php://output');

?>