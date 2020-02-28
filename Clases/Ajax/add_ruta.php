
<?

$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/logistica.php");

$array=array(); 

$link=conect();
$ruta=new Logistica();
$ruta->conexion($link);


	if($arr -> {'accion'}=="guardarRuta")
	{
		$id=$ruta->insert( $arr -> {'transporte'}, $arr -> {'operador'}, $arr -> {'remolque'});
	
		echo $id;
	}
	else if ($arr->{'accion'}=="guardarDetalle")
	{
		
		$id=$ruta->insertDetalle( $arr -> {'idRuta'},$arr->{'idPedido'},$arr->{'Cantidad'});
	
		echo $id;
	}
	else if ($arr->{'accion'}=="guardarDetalle_recoleccion")
	{
		$id=$ruta->insertDetalle_recoleccion( $arr -> {'idRuta'},$arr->{'idPedido'},$arr->{'Cantidad'});
	
		echo $id;
	}else if ($arr->{'accion'}=="obtenerOrden")
	{
		 $array=$ruta->ObtieneOrdenes();
		
		echo json_encode($array);
	}else if ($arr->{'accion'}=="obtenerRecoleccion")
	{
		 $array=$ruta->ObtieneOrdenes_recoleccion();
		
		echo json_encode($array);
	}else if ($arr->{'accion'}=="obtenerOrden_Detalle")
	{
		 $array=$ruta->obtenerOrden_Detalle($arr->{'id_orden'});
		
		echo json_encode($array);
	}else if ($arr->{'accion'}=="obtenerRutas")
	{
		 $array=$ruta->Obtiene_Rutas($arr->{'idPedido'});
		
		echo json_encode($array);
	}else if ($arr->{'accion'}=="obtenerRutas_editar")
	{
		 $array=$ruta->Obtiene_Rutas_editar($arr->{'idRuta'});
		
		echo json_encode($array);
	}else if ($arr->{'accion'}=="detalleEntrega")
	{
		 $array=$ruta->detalleEntrega( $arr -> {'idRuta'},$arr->{'idPedido'});
		
		echo json_encode($array);
	}else if ($arr->{'accion'}=="actualizarRuta")
	{
		$id=$ruta->update_status( $arr -> {'idRuta'},$arr->{'estatus'});
	
		echo $id;
	}else if ($arr->{'accion'}=="guardarEntrega")
	{
		$idh=$ruta->updateEntrega( $arr -> {'idRutaEntrega'},$arr->{'cantidad_enrutada'},$arr->{'cantidad_entregada'},$arr->{'observaciones'},$arr->{'status'});
	
		echo $idh;
	}else if ($arr->{'accion'}=="ConfirmarNota")
	{
		$id=$ruta->ConfirmarNota( $arr -> {'idRutaEntrega'},$arr->{'cantidad_nota_salida'},$arr->{'usuario_nota_salida'},$arr->{'status'});
	
		echo $id;
	}else if ($arr->{'accion'}=="guardarGeneral")
	{
		$id=$ruta->updateGeneral( $arr -> {'idRutaEntrega'},$arr->{'observaciones'});
	
		echo $id;
	}else if ($arr->{'accion'}=="guardarEntrega_recoleccion")
	{

		$id=$ruta->updateEntrega_recoleccion( $arr -> {'idRutaEntrega'},$arr->{'cantidad_enrutada'},$arr->{'cantidad_entregada'});
	
		echo $id;
	}else if ($arr->{'accion'}=="actualizarOERuta")
	{

		$id=$ruta->updateEntrega_OE($arr -> {'idRutaDetalle'}, $arr->{'folioOE'});
	
		echo $id;
	}else if ($arr->{'accion'}=="obtenerSumarios")
	{
		 $array=$ruta->ObtieneOrdenes_sumario();
		
		echo json_encode($array);
	}else if ($arr->{'accion'}=="GuardaFactura")
	{

		$id=$ruta->GuardaFactura($arr -> {'idRutaDetalle'}, $arr->{'factura_no'});
	
		echo $id;
	}else if ($arr->{'accion'}=="Status_rafa")
	{

		$id=$ruta->Status_rafa($arr -> {'idRutaEntrega'}, $arr->{'statusreg'});
	
		echo $id;
	}
	
?>
   