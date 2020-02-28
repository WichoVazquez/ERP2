<?
/*require("../clases/bds/conexion.php");
require("../clases/config/examina_idproducto.php");
$objetoConexion=new conexion();
$objetoConexion->conectar();
$examinaid=new examina_idproducto();



$sql="SELECT CONSUMO_MATERIAL.consumo_material_id, MATERIAL_ALMACEN.almacen_id,CONSUMO_MATERIAL.fecha_consumo_material, CONSUMO_MATERIAL.cantidad_consumo_material, MATERIAL.material_unidad,MATERIAL.material_descripcion, CONSUMO_MATERIAL.consumo_observaciones,  CONSUMO_MATERIAL.usuario_nickname FROM CONSUMO_MATERIAL, MATERIAL_ALMACEN, MATERIAL WHERE CONSUMO_MATERIAL.material_almacen_id=MATERIAL_ALMACEN.material_almacen_id and MATERIAL.material_id=MATERIAL_ALMACEN.material_id ORDER BY CONSUMO_MATERIAL.consumo_material_id DESC";
$resultado=$objetoConexion->consulta($sql);
  
if($resultado>0&&mysql_num_rows ( $resultado )>0)
{
	*/
require_once("PHPExcel.php");
require_once("PHPExcel/Writer/Excel2007.php");	
//algunos datos sobre autoría
date_default_timezone_set("America/Mexico_City");
$newdate =  strtotime($date);
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Global Drilling de México, S.A. de C.V.");
$objPHPExcel->getProperties()->setLastModifiedBy("Global Drilling de México, S.A. de C.V.");
$objPHPExcel->getProperties()->setTitle("Reporte Excel");
$objPHPExcel->getProperties()->setSubject("Consumo Insumos");
$objPHPExcel->getProperties()->setDescription("Descripción");
$objPHPExcel->setActiveSheetIndex(0);
$cont=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A".$cont, "Folio");
$objPHPExcel->getActiveSheet()->SetCellValue("B".$cont, "Almacen");
$objPHPExcel->getActiveSheet()->setCellValue("C".$cont, "Fecha");
$objPHPExcel->getActiveSheet()->setCellValue("D".$cont, "Cantidad");
$objPHPExcel->getActiveSheet()->setCellValue("E".$cont, "Unidad");
$objPHPExcel->getActiveSheet()->setCellValue("F".$cont, "Concepto");
$objPHPExcel->getActiveSheet()->setCellValue("G".$cont, "Observaciones");
$objPHPExcel->getActiveSheet()->setCellValue("H".$cont, "Autorizado por:");


//iteramos para los resultados
/*while($row=mysql_fetch_row($resultado)){*/
	 $cont++;
	
	
    $objPHPExcel->getActiveSheet()->SetCellValue("A".$cont, $row[0]);
    $objPHPExcel->getActiveSheet()->SetCellValue("B".$cont, $row[1]);
	$objPHPExcel->getActiveSheet()->setCellValue("C".$cont, $row[2]);
	$objPHPExcel->getActiveSheet()->setCellValue("D".$cont, $row[3]);
    $objPHPExcel->getActiveSheet()->setCellValue("E".$cont, $row[4]);
	$objPHPExcel->getActiveSheet()->setCellValue("F".$cont, $row[5]);
    $objPHPExcel->getActiveSheet()->setCellValue("G".$cont, $row[6]);
	$objPHPExcel->getActiveSheet()->setCellValue("H".$cont, $row[7]);
	
//}

$objPHPExcel->getActiveSheet()->setTitle('Reporte');
$objPHPExcel->getSecurity()->setLockWindows(true);
$objPHPExcel->getSecurity()->setLockStructure(true);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteConsumoInsumos'.$newdate.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
//}
?>