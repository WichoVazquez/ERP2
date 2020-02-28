
<?

$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/detalle_ordencompra.php");
require("../Objetos/orden_compra.php");

$array=array(); 

$link=conect();


	if($arr -> {'accion'}=="guardarGeneral")
	{

		$orden_compra=new Orden_compra();
		$orden_compra->conexion($link);

			$id=$ruta->update_almacenGeneral( 
				$arr -> {'idOrden'},
				$arr -> {'observaciones'},
				$arr -> {'fecha_recibo'},
				$arr -> {'factura_compra'},
				$arr -> {'usuario_almacen'}
				);
		
			echo $id;

	}else 

	if ($arr->{'accion'}=="guardarDetalle")
	{

		$detalle_compra=new Detalle_ordencompra();
		$detalle_compra->conexion($link);


			$id=$detalle_compra->update_almacen( 
				$arr->{'idOrdenDetalle'},
				$arr->{'cantidad_recibida'},
				$arr->{'costo_detalle'}
				);
				echo $id;
	}

echo $id;

?>
   