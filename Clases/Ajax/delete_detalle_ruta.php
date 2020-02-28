<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/logistica.php");



$link=conect();
$detalle_ruta=new Logistica();
$detalle_ruta->conexion($link);

$mat=$detalle_ruta->deleteDetalle($arr);
	
echo $mat;
?>
   