<?
$value = file_get_contents('php://input');
$arr=json_decode($value);
require("../Objetos/almacen.php");
require("../Conexion/conexion_prueba_local.php");
$link=conect();
$almacen=new Almacen();
$almacen->conexion($link);
if(($arr -> {'validacion'}== "nombre" and $almacen->almacen_Duplicado($arr -> {'nombre'}) ) )
	echo "duplicado";
else
	echo "ok"


?>