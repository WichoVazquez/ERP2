
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require_once("../Conexion/conexion_prueba_local.php");
require("../Objetos/laboratorio.php");
require("../Objetos/laboratorio_adicionales.php");

$array=array(); 

$link=conect();
$laboratorio=new Laboratorio();
$laboratorio->conexion($link); 
$Laboratorio_adicionales=new Laboratorio_adicionales();
$Laboratorio_adicionales->conexion($link);

	if ($arr -> {'accion'}=="InsertarLaboratorioDetalle")
	{
	$id=$laboratorio->insert(
		$arr -> {'tipo'}, 
		$arr -> {'cantidad'}, 
		$arr -> {'idDetalle'}, 
		$arr -> {'usuario'},
		$arr -> {'id_unidad'},
		$arr -> {'servicio_lab'},
		$arr -> {'observaciones_lab'},
		$arr -> {'lote_lab'}
		);
	echo $id;
	}
	else if ($arr->{'accion'}=="obtenerOrdenes_Laboratorio")
	{

		
		 $array=$laboratorio->obtenerOrdenes_Laboratorio(
		 	$arr -> {'idDetalle'});
		 echo json_encode($array);
		 
	}
	else if ($arr -> {'accion'}=="InsertarLaboratorioProductos")
	{
	$id=$Laboratorio_adicionales->insert(
		$arr -> {'tipo'}, 
		$arr -> {'cantidad'}, 
		$arr -> {'id_producto'}, 
		$arr -> {'usuario'},
		$arr -> {'id_unidad'},
		$arr -> {'servicio_lab'},
		$arr -> {'observaciones_lab'},
		$arr -> {'lote_lab'}
		);
	echo $id;
	}


?>
   