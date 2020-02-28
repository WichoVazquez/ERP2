
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/detalle_cotizacion.php");
require("../Objetos/servicio.php");


$link=conect();

$servicio = new Servicio();
$servicio->conexion($link);
$detalle_cotizacion=new Detalle_Cotizacion();
$detalle_cotizacion->conexion($link);
// echo "SERVICIO: ".$arr -> {'servicio'}." PRECIO: ".$arr -> {'precio'};
$serv_id=$servicio->insert($arr -> {'servicio'}, $arr -> {'precio'});

if ($serv_id!=0)
{
$cot=$detalle_cotizacion->insert( $serv_id,  $arr -> {'cantidad'},$arr -> {'cotizacion'}, $arr -> {'precio'} , $arr -> {'observaciones'}, $arr -> {'multiplo'}, $arr -> {'tipocot'});
}
else
{
	$cot=0;
}

echo $cot;
?>
   