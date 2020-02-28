<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/logistica.php");
	$detalle=new Logistica();
	$detalle->conexion($link);
	$array=$detalle->delete($id);
	if($array=="OK")		
		echo "<p>La ruta ".$id." fue cancelada</p>";
	else 
		echo "<p>Error BD en ruta: ".$array."</p>"; 	
				
?>