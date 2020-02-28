<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/laboratorio.php");
require("../Objetos/laboratorio_adicionales.php");

$link=conect();
$laboratorio=new Laboratorio();
$laboratorio->conexion($link);
$Laboratorio_adicionales=new Laboratorio_adicionales();
$Laboratorio_adicionales->conexion($link);
	

if ($arr -> {'accion'}=="UpdateLaboratorioDetalle")
	{
	$lab=$laboratorio->update_status( 
 $arr -> {'id_laboratorio'},
 $arr -> {'cantidad'}, 
 $arr -> {'certificado'},
 $arr -> {'usuario'},
 $arr -> {'status'},
 $arr -> {'fecha_rev'}
 );


echo $lab;
	}
	else if ($arr->{'accion'}=="obtenerOrdenes_Laboratorio")
	{

		
		 $array=$laboratorio->obtenerOrdenes_Laboratorio(
		 	$arr -> {'idDetalle'});
		 echo json_encode($array);
		 
	}
	else if ($arr -> {'accion'}=="UpdateLaboratorioProductos")
	{
	$lab=$Laboratorio_adicionales->update_status( 
 $arr -> {'id_laboratorio'},
 $arr -> {'cantidad'}, 
 $arr -> {'certificado'},
 $arr -> {'usuario'},
 $arr -> {'status'},
 $arr -> {'fecha_rev'}
 );


echo $lab;
	}
?>