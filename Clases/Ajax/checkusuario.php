<?
$value = file_get_contents('php://input');
$arr=json_decode($value);
require("../Objetos/usuario.php");
require("../Conexion/conexion_prueba_local.php");
$link=conect();
$usuario=new Usuario();
$usuario->conexion($link);
if($usuario->usuario_duplicado($arr -> {'user'}))
echo "duplicado";
else
echo "ok"

?>