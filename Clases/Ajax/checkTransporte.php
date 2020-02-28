<?
$value = file_get_contents('php://input');
$arr=json_decode($value);
require("../Objetos/transporte.php");
require("../Conexion/conexion_prueba_local.php");
$link=conect();
$transporte=new Transporte();
$transporte->conexion($link);
if(($arr -> {'validacion'}== "placas" and $transporte->placas_duplicado($arr -> {'placas'}) ) )
	echo "duplicado";
else
	echo "ok"


?>