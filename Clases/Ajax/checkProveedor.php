<?php
$value = file_get_contents('php://input');
$arr=json_decode($value);
require("../Objetos/proveedor.php");
require("../Conexion/conexion_prueba_local.php");
$link=conect();
$proveedor=new Proveedor();
$proveedor->conexion($link);
if(($arr -> {'validacion'}== "rs" and $proveedor->razonSocial_duplicado($arr -> {'rs'}) ) or ($arr -> {'validacion'}== "rfc" and $proveedor->rfcl_duplicado($arr -> {'rfc'})) )
	echo "duplicado";
else
	echo "ok"

?>