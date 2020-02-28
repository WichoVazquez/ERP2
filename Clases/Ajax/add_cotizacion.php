
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require_once("../Conexion/conexion_prueba_local.php");
require("../Objetos/pedido.php");
require("../Objetos/cliente.php");

$array=array(); 

$link=conect();

$ordensalida=new Pedido();
$ordensalida->conexion($link);

$cliente_result=new Cliente();
$cliente_result->conexion($link);

	
	if($arr -> {'accion'}=="guardarRuta")
	{
		$id=$ordensalida->insert( $arr -> {'transporte'});
	
		echo $id;
	}else if ($arr->{'accion'}=="guardarDetalle")
	{
		$id=$ordensalida->insertDetalle( $arr -> {'idRuta'},$arr->{'idPedido'},$arr->{'Cantidad'});
	
		echo $id;
	}else if ($arr->{'accion'}=="obtenerCotizacion")
	{
		 
		 $array=$ordensalida->ObtieneCotizaciones($arr -> {'idusuario'});
		
		echo json_encode($array);
	}else if ($arr->{'accion'}=="obtenerDetalleCotizacion")
	{
		
		 $array=$ordensalida->busqueda_detalle($arr -> {'idcotizacion'});
		
		echo json_encode($array);
	}else if ($arr->{'accion'}=="actualizarRuta")
	{
		$id=$ordensalida->update( $arr -> {'idRuta'},$arr->{'transporte'});
	
		echo $id;
	}else if ($arr->{'accion'}=="guardarEntrega")
	{
		$id=$ordensalida->updateEntrega( $arr -> {'idRutaEntrega'},$arr->{'cantidad_enrutada'},$arr->{'cantidad_entregada'},$arr->{'observaciones'});
	
		echo $id;
	}else if ($arr->{'accion'}=="guardarGeneral")
	{
		$id=$ordensalida->updateGeneral( $arr -> {'idRutaEntrega'},$arr->{'observaciones'});
	
		echo $id;
	}else if ($arr->{'accion'}=="obtenerCorreo")
	{
		
		 $array=$cliente_result->detalle_contacto_ventas($arr -> {'cliente'});
	
		echo json_encode($array);
	}


?>
   