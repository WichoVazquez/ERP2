<?php
$value = file_get_contents('php://input');
$arr=json_decode($value);
require("../Objetos/empresa.php");
require("../Conexion/conexion_prueba_local.php");
$link=conect();
$empresa=new Empresa();
$empresa->conexion($link);
if(($arr -> {'validacion'}== "rs" and $empresa->razonSocial_duplicado($arr -> {'rs'}) )
 or ($arr -> {'validacion'}== "rfc" and $empresa->rfc_duplicado($arr -> {'rfc'})) )
	echo "duplicado";
else
	echo "ok"

?>