<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/almacen.php");
	require("../Objetos/domicilio.php");
	$almacen=new Almacen();
	$almacen->conexion($link);
	$array=$almacen->detalle($id);
	$domicilio=new Domicilio();
	$domicilio->conexion($link);
	$res=$almacen->delete($id);
	
	if($res=="OK")
	{
		$res=$domicilio->delete($array[3]);
		if($res=="OK")
		{
			echo "<p>Almacen ".$id." fue eliminado</p>";
		}
		else
		{
			echo "<p>Almacen ".$id." fue eliminado, Error BD: ".$res."</p>";
		}
	}
	else
	{
		echo "<p>Error BD: ".$res."</p>";
	}
			
		
?>