<?
$value = file_get_contents('php://input');
$arr=json_decode($value);
require("../Objetos/material.php");
require("../Conexion/conexion_prueba_local.php");
$link=conect();
$material=new Material();
$material->conexion($link);
if(($arr -> {'validacion'}== "material" and $material->material_Duplicado($arr -> {'material'}) ) 
or ($arr -> {'validacion'}== "materialeditado" and $material->material_Duplicado_Editado($arr -> {'material'}) ))
	echo "duplicado";
else if ($arr->{'validacion'}=="materialSae")
{
	if($material->material_SAE($arr -> {'material'}))
	{
	echo "duplicado";
	}
	else
	{
	echo "ok";
	}
}
	
else

	echo "ok"


?>