<?php
	//Agregamos la libreria para leer
	require 'PHPExcel/Classes/PHPExcel/IOFactory.php';
	
	// Creamos un objeto PHPExcel
	$objPHPExcel = new PHPExcel();
	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	$objPHPExcel = $objReader->load('Plantilla_Parte_trabajo.xls');
	// Indicamos que se pare en la hoja uno del libro
	$objPHPExcel->setActiveSheetIndex(0);
	
	//Modificamos los valoresde las celdas A2, B2 Y C2
	$objPHPExcel->getActiveSheet()->SetCellValue('B8', 'Nombre cliente');
	$objPHPExcel->getActiveSheet()->SetCellValue('B10', 'Nombre calle');

	
	//Guardamos los cambios
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2003');
	$objWriter->save("Archivo_salida.xls");

?>
