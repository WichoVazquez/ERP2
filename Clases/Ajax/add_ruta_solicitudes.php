
<?

$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/logistica_solicitudes.php");

$array=array(); 

$link=conect();
$logistica_solicitudes=new Logistica_solicitudes();
$logistica_solicitudes->conexion($link);


	if($arr -> {'accion'}=="Insert_solicitudes")
	{
		$id=$logistica_solicitudes->insert( 
			$arr -> {'id_detalle_pedido'}, 
			$arr -> {'fecha_entrega'}, 
			$arr -> {'destino'}, 
			$arr -> {'observaciones'}, 
			$arr -> {'id_usuario'}, 
			$arr -> {'cantidad'} 
			);
	
		echo $id;
	}
	
	
?>
   