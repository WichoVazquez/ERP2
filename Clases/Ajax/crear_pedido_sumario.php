
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require_once("../Conexion/conexion_prueba_local.php");
require("../Objetos/pedido.php");
	

$link=conect();
$pedido=new Pedido();
$pedido->conexion($link); 



if($arr -> {'accion'}=="CrearPedido")
	{

		if (!$arr -> {'sucursal_cot'})
		$sucursal_id = 0;

			if($arr -> {'status'}==5)

				$pedido_no=$pedido->insert_pedido_sumario_recoleccion(
					$arr -> {'cotizacion_id'},
					$arr -> {'sucursal_cot'},
					$arr -> {'fechaini_cot'},
					$arr -> {'fechafin_cot'},
					$arr -> {'obs_ped'},
					$arr -> {'folioOS'},
					$arr -> {'usuario_cot'},
					$arr -> {'status'}
					);

					else

				$pedido_no=$pedido->insert_pedido_sumario(
					$arr -> {'cotizacion_id'},
					$arr -> {'sucursal_cot'},
					$arr -> {'fechaini_cot'},
					$arr -> {'fechafin_cot'},
					$arr -> {'obs_ped'},
					$arr -> {'folioOS'},
					$arr -> {'usuario_cot'}
					);
		echo $pedido_no;
}else 

if ($arr->{'accion'}=="ConfirmarPedido")
	{
		$pedido_no=$pedido->update_pedido_sumario_recoleccion(
					$arr -> {'pedido'},
					$arr -> {'sucursal_cot'},
					$arr -> {'fechaini_cot'},
					$arr -> {'fechafin_cot'},
					$arr -> {'obs_ped'},
					$arr -> {'folioOS'},
					$arr -> {'status'}
					);
	
		echo $pedido_no;
	}
	

?>
   