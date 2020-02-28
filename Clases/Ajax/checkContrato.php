<?
$value = file_get_contents('php://input');
$arr=json_decode($value);
require("../Objetos/contrato.php");
require("../Conexion/conexion_prueba_local.php");
$link=conect();
$contrato=new Contrato();
$contrato->conexion($link);
if(($arr -> {'validacion'}== "clave" and $contrato->contrato_Duplicado($arr -> {'clave'})))
	echo "duplicado";
else
	echo "ok"


?>