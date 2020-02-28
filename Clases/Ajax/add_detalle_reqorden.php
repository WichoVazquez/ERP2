
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/detalle_reqcompra.php");


$link=conect();
$detalle_reqorden=new Detalle_reqcompra();
$detalle_reqorden->conexion($link); 	




	if($arr -> {'accion'}=="Insertar_DetalleReq")
	{
		$id=$detalle_reqorden->insert( 
			$arr -> {'no_orden_compra'},
			$arr -> {'producto'},  
			$arr -> {'cantidad'},
			$arr -> {'observaciones'}
			);
		echo $id;
	}
	else if ($arr->{'accion'}=="UpdateReq")
	{
		
		$id=$detalle_reqorden->insertDetalle( $arr -> {'idRuta'},$arr->{'idPedido'},$arr->{'Cantidad'});
	
		echo $id;
	}





?>
   