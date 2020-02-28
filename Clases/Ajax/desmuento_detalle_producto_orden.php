
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/detalle_ordencompra.php");


$link=conect();
$detalle_cotizacion=new Detalle_Cotizacion();
$detalle_cotizacion->conexion($link); 
$cot=$detalle_cotizacion->update_price( $arr -> {'detalle'},  $arr -> {'precio'},   $arr -> {'multiplo'}); //esta de mas el precio otra vez
echo $cot;
?>
   