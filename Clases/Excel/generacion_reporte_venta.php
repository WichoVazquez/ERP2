<?
	//$value = file_get_contents('php://input');
	//$arr=json_decode($value);
	require_once("../Conexion/conexion_prueba_local.php");
	require_once("../Objetos/cotizacion.php");
	$link=conect();
	$cotizacion=new Cotizacion();
	$cotizacion->conexion($link);
	
	/*
	 $criterio=$_GET['criterio'];
	 $status=$_GET['status'];
	 $fecha=$_GET['fecha'];
	 $fecha1=$_GET['fecha1'];
	 $fecha2=$_GET['fecha2'];
	 $mes=$_GET['mes'];
	 $ano=$_GET['ano'];
	*/
	//echo "Si entra:".$_GET['fecha'];
	$array=null;
	
	//echo "Si hace switch con:".$arr->{'criterio'}*1;
	/*switch($arr->{'criterio'}*1)
	{
		case 0:
				$array=$cotizacion->exportResult($arr->{'status'}, $arr->{'fecha'}, null, null, null);break;
		case 1: $array=$cotizacion->exportResult($arr->{'status'}, $arr->{'fecha1'}, $arr->{'fecha2'}, null, null);break;
		case 2: $array=$cotizacion->exportResult($arr->{'status'}, null, null, $arr->{'mes'}, $arr->{'ano'});break;
		default: $array=null;break;
	}*/
	switch($_GET['criterio'])
	{
		case 0:
				$array=$cotizacion->exportResult($_GET['status'], $_GET['fecha'], null, null, null)
				;
				//echo "array".$array;				
				break;
				
		case 1: $array=$cotizacion->exportResult($_GET['status'], $_GET['fecha1'], $_GET['fecha2'], null, null);break;
		
		case 2: $array=$cotizacion->exportResult($_GET['status'], null, null, $_GET['mes'], $_GET['ano']);break;
		default: $array=null;break;
	}
	
	if($array!=null||!empty($array))
	{
			date_default_timezone_set("America/Mexico_City");
			$newdate =  strtotime($date);
			ob_end_clean();
			require_once("PHPExcel.php");
			require_once("PHPExcel/Writer/Excel2007.php");	
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("Mogel Fluídos, S.A. de C.V."); //esto debe cambiar a algo más dinámico
			$objPHPExcel->getProperties()->setTitle("Reporte Ventas");
			$objPHPExcel->getProperties()->setSubject("Reporte Ventas");
			$objPHPExcel->getProperties()->setDescription("Reporte de Ventas Generado");
			$objPHPExcel->setActiveSheetIndex(0);
			$cont=1;
			$objPHPExcel->getActiveSheet()->SetCellValue("A".$cont, "No.");
			$objPHPExcel->getActiveSheet()->SetCellValue("B".$cont, "Empresa");
			$objPHPExcel->getActiveSheet()->setCellValue("C".$cont, "Usuario");
			$objPHPExcel->getActiveSheet()->setCellValue("D".$cont, "Folio");
			$objPHPExcel->getActiveSheet()->setCellValue("E".$cont, "Estatus");
			$objPHPExcel->getActiveSheet()->setCellValue("F".$cont, "Cliente");
			$objPHPExcel->getActiveSheet()->setCellValue("G".$cont, "RFC Cliente");
			$objPHPExcel->getActiveSheet()->setCellValue("H".$cont, "Monto Total");
			$objPHPExcel->getActiveSheet()->setCellValue("I".$cont, "Divisa");
			$objPHPExcel->getActiveSheet()->setCellValue("J".$cont, "Fecha de Creación o Modificiación");
			$objPHPExcel->getActiveSheet()->setCellValue("K".$cont, "Fecha de Envio");
			
			for($renglones=0; $renglones<count($array);$renglones++)
			{
				$cont++;
				$objPHPExcel->getActiveSheet()->SetCellValue("A".$cont, $array[$renglones][0]);
				$objPHPExcel->getActiveSheet()->SetCellValue("B".$cont, $array[$renglones][1]);
				$objPHPExcel->getActiveSheet()->setCellValue("C".$cont, $array[$renglones][2]);
				$objPHPExcel->getActiveSheet()->setCellValue("D".$cont, $array[$renglones][3]);
				$estado="";
				switch($array[$renglones][4])
				{
					case 0: $estado= "Borrador";break;
					case 1: $estado= "Por Autorizar";break;
					//case 2: echo "<a href=\"javascript:confirmar({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."'})\">Enviado</a>";break;
					case 2: $estado= "Enviado";break;
					case 3: $estado= "Cancelado";break;
					case 4: $estado= "No Autorizado";break;
					case 5: $estado= "Autorizado";break;
					case 6: $estado= "Confirmado";break;
					case 7: $estado= "Facturado";break;
					case 8: $estado= "Pagado";break;
					default: $estado= "N/D";break;
				}
				$objPHPExcel->getActiveSheet()->setCellValue("E".$cont, $estado);
				$objPHPExcel->getActiveSheet()->setCellValue("F".$cont, $array[$renglones][5]);
				$objPHPExcel->getActiveSheet()->setCellValue("G".$cont, $array[$renglones][6]);
				$objPHPExcel->getActiveSheet()->setCellValue("H".$cont, $array[$renglones][7]);
				$objPHPExcel->getActiveSheet()->setCellValue("I".$cont, $array[$renglones][8]);
				$objPHPExcel->getActiveSheet()->setCellValue("J".$cont, $array[$renglones][9]);
				$objPHPExcel->getActiveSheet()->setCellValue("K".$cont, $array[$renglones][10]);
			}
			
			$objPHPExcel->getActiveSheet()->setTitle('Reporte');
			$objPHPExcel->getSecurity()->setLockWindows(true);
			$objPHPExcel->getSecurity()->setLockStructure(true);
			
			// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="reporteVentas'.$newdate.'.xls"');
			header('Cache-Control: max-age=0');
			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
	}
	else
	{
		echo "Error al generar reporte".$array;
	}
	
?>