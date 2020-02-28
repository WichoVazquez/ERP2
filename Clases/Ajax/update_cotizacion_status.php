
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/cotizacion.php");
require("../mail/notificacion.php");
$link=conect();
$cotizacion=new Cotizacion();
$cotizacion->conexion($link);
$cot=$cotizacion->update_status( $arr -> {'status'},$arr -> {'cotizacion'}, $arr -> {'obs'}, $arr -> {'suc'}, $arr -> {'f_inicio'}, $arr -> {'f_entrega'});

if($cot=="OK")
{

	if($arr -> {'status'}==4||$arr -> {'status'}==5)
		echo enviarNotificacionAutorizacion( $arr -> {'cotizacion'}, $arr -> {'status'},$arr -> {'obs'},$arr->{'usuario'},$arr->{'fecha_rev'});
	if($arr -> {'status'}==2)
	{
		
		echo enviarCotizacion($arr -> {'cotizacion'}, $arr -> {'usuario'}, $arr -> {'password'}, $arr -> {'contacto'}, $arr -> {'msg'}, $arr -> {'fecha_rev'});
		
	}
	if($arr -> {'status'}==6)
	{
	
		require("../Objetos/pedido.php");
		require("../Objetos/detalle_pedido.php");
		$pedido=new Pedido();
		$pedido->conexion($link);
		$id_pedido=$pedido->insert_pedido($arr -> {'cotizacion'}, $arr -> {'suc'}, $arr -> {'f_inicio'}, $arr -> {'f_entrega'});         
		if($id_pedido!=0)
		{
			$detalle_pedido=new Detalle_Pedido();
			$detalle_pedido->conexion($link);
			$detalle_pedido->insert_empty_cot($id_pedido,$arr -> {'cotizacion'});
			//enviar notificacion de pedido
		}
	}
}
else
	echo $cot;	
?>
   