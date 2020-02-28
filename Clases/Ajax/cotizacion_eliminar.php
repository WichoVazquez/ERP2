<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/cotizacion.php");
	require("../Objetos/detalle_cotizacion.php");
	$detalle=new Detalle_Cotizacion();
	$detalle->conexion($link);
	$detalle->delete_by_cotizacion($id);
	$cotizacion=new Cotizacion();
	$cotizacion->conexion($link);
	$array=$cotizacion->delete($id);
	if($array=="OK")		
		echo "<p>Cotizacion ".$id." fue eliminada</p>";
	else 
		echo "<p>Error BD en cotizacion: ".$array."</p>"; 	
		
		
?>