<?
$value = file_get_contents('php://input');
$arr=json_decode($value);
require("../Objetos/usuario.php");
require("../Conexion/conexion_prueba_local.php");
$link=conect();
$cliente=new Cliente();
$cliente->conexion($link);
if($cliente->cliente_duplicado($arr -> {'rfc'}))
echo "duplicado";
else
echo "ok"

?>