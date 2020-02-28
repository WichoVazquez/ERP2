
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/detalle_pedido.php");


$link=conect();
$detalle_pedido=new Detalle_Pedido();
$detalle_pedido->conexion($link);
$detalle=$detalle_pedido->delete($arr -> {'detalle'});
echo $detalle;
?>
   