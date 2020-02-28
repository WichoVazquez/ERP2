
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require_once("../Conexion/conexion_prueba_local.php");
require("../Objetos/solicitud_transporte.php");

$array=array(); 

$link=conect();
$solicitud_transporte=new Solicitud_transporte();
$solicitud_transporte->conexion($link); 

	if($arr -> {'accion'}=="InsertTransportes")
	{
	$id=$solicitud_transporte->InsertTransportes(
		$arr -> {'id_detalle_pedido'}, 
		$arr -> {'id_transporte'}, 
		$arr -> {'id_remolque'}, 
		$arr -> {'fecha_entrega'}, 
		$arr -> {'destino'}, 
		$arr -> {'observaciones'}, 
		$arr -> {'id_usuario'}
		);
	echo $id;
	}
	else if ($arr->{'accion'}=="obtenerSolicitudes_Transporte")
	{

		
		 $array=$solicitud_transporte->obtenerSolicitudes_Transporte(
		 	$arr -> {'idDetalle'});
		 echo json_encode($array);
		 
	}

?>
   