
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require_once("../Conexion/conexion_prueba_local.php");
require("../Objetos/notas_salida.php");

$array=array(); 

$link=conect();
$laboratorio=new Laboratorio();
$laboratorio->conexion($link); 

	if($arr -> {'accion'}=="InsertarNotaSalidaDetalle")
	{
	$id=$laboratorio->insert(
		$arr -> {'tipo'}, 
		$arr -> {'cantidad'}, 
		$arr -> {'idDetalle'}, 
		$arr -> {'usuario'});
	echo $id;
	}
	else if ($arr->{'accion'}=="obtenerOrdenes_Laboratorio")
	{

		
		 $array=$laboratorio->obtenerOrdenes_Laboratorio(
		 	$arr -> {'idDetalle'});
		 echo json_encode($array);
		 
	}

?>
   