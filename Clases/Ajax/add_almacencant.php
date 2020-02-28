<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require_once("../Conexion/conexion_prueba_local.php");
require_once("../Objetos/material.php");


$array=array(); 

$link=conect();
$material=new material();
$material->conexion($link);

//echo "si llego";
	if($arr -> {'accion'}=="cantidadAlmacenes")
	{
		 $array=$material->almacenes_rafa($arr -> {'idproducto'});
		
		echo json_encode($array);
	}

?>