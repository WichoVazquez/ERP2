
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/detalle_cotizacion.php");


$link=conect();
$detalle_cotizacion=new Detalle_Cotizacion();
$detalle_cotizacion->conexion($link); 
$cot=$detalle_cotizacion->insert( $arr -> {'producto'},  $arr -> {'cantidad'},$arr -> {'cotizacion'}, $arr -> {'precio'} , $arr -> {'observaciones'}, $arr -> {'multiplo'}, $arr -> {'tipocot'});
echo $cot;
?>
   