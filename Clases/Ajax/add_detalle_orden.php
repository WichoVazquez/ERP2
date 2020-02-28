
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/detalle_ordencompra.php");


$link=conect();
$detalle_orden=new Detalle_ordencompra();
$detalle_orden->conexion($link); 	

	if($arr -> {'accion'}=="InsertarDetalleOrden")
	{
	$id=$detalle_orden->insert( 
	$arr -> {'orden_id'},  
	$arr -> {'producto_id'},
	$arr -> {'producto_descripcion'},
	$arr -> {'cantidad'},
	$arr -> {'costo'},
	$arr -> {'unidad'}
	);
	echo $id;
	}
?>
   