
<?

$value = file_get_contents('php://input');
$arr=json_decode($value);



require("../Conexion/conexion_prueba_local.php");
require("../Objetos/detalle_ordencompra.php");
require("../Objetos/orden_compra.php");
require("../Objetos/almacen_material.php");


$array=array(); 

$link=conect();


	if($arr -> {'accion'}=="guardarGeneral")
	{

		$orden_compra=new Orden_compra();
		$orden_compra->conexion($link);
		$id=$orden_compra->update_almacenGeneral( 
				$arr -> {'idOrden'},
				$arr -> {'observaciones'},
				$arr -> {'fecha_recibo'},
				$arr -> {'factura_compra'},
				$arr -> {'usuario_almacen'}
				);
		
		

	}else 

	if ($arr->{'accion'}=="guardarDetalle")
	{

		$detalle_compra=new Detalle_ordencompra();
		$detalle_compra->conexion($link);
		$almacen_material=new Almacen_material();
		$almacen_material->conexion($link);




			$id=$detalle_compra->update_almacen( 
				$arr->{'idOrdenDetalle'},
				$arr->{'cantidad_recibida'},
				$arr->{'lote'},
				$arr->{'almacen'},
				$arr->{'usuario'},
				$arr->{'id_producto'}
				);

		if ($arr->{'insumos'}==0)

		$res_alm=$almacen_material->update_compras(
				$arr->{'almacen'},
				$arr->{'cantidad_recibida'},
				$arr->{'idOrdenDetalle'}
				);




	else


			echo "ERROR EN UPDATE ALMACEN";



	}

echo $id;

?>
   