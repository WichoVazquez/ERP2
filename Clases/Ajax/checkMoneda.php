<?
$value = file_get_contents('php://input');
$arr=json_decode($value);
require("../Objetos/moneda.php");
require("../Conexion/conexion_prueba_local.php");
$link=conect();
$moneda=new Moneda();
$moneda->conexion($link);
if(($arr -> {'validacion'}== "descripcion" and $moneda->moneda_duplicado($arr -> {'descripcion'}) ) )
	echo "duplicado";
else
	echo "ok"


?>