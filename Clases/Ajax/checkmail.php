<?
$value = file_get_contents('php://input');
$arr=json_decode($value);
require("../Objetos/generales.php");
require("../Conexion/conexion_prueba_local.php");
$link=conect();
$generales=new Generales();
$generales->conexion($link);
if($generales->email_duplicado($arr -> {'mail'}))
 echo "duplicado";
else
 echo "ok";

?>