<?
$value = file_get_contents('php://input');
$arr=json_decode($value);
require("../Objetos/cliente.php");
require("../Conexion/conexion_prueba_local.php");
$link=conect();
$cliente=new Cliente();
$cliente->conexion($link);
if(($arr -> {'validacion'}== "rs" and $cliente->rs_duplicado($arr -> {'rs'}) ) 
or ($arr -> {'validacion'}== "rfc" and $cliente->rfc_duplicado($arr -> {'rfc'}))
or ($arr -> {'validacion'}== "clave" and $cliente->cliente_duplicado($arr -> {'clave'}))
 )
	echo "duplicado";
else
	echo "ok"


?>