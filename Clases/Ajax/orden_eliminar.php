<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/orden_compra.php");
	require("../Objetos/detalle_ordencompra.php");

	$detalle_orden=new detalle_ordencompra();
	$detalle_orden->conexion($link);
	$detalle_orden->delete_by_orden($id);

	$orden=new Orden_compra();
	$orden->conexion($link);
	$array=$orden->delete($id);
	if($array=="OK")		
		echo "<p>Orden de compra ".$id." fue eliminada</p>";
	else 
		echo "<p>Error BD en Orden de Compra: ".$array."</p>"; 	
		
		
?>