<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/proveedor.php");
	require("../Objetos/domicilio.php");
	require("../Objetos/generales.php");
	
	
	$proveedor=new Proveedor();
	$proveedor->conexion($link);
	$array=$proveedor->detalle($id);
	$domicilio=new Domicilio();
	$domicilio->conexion($link);
	$generales=new Generales();
	$generales->conexion($link);
	
	
	$res=$proveedor->delete($id);
	
	if($res=="OK")
	{
		$res=$domicilio->delete($array[3]);
		if($res=="OK")
		{
			$res=$generales->delete($array[4]);
		
			
			if($res=="OK")
			{
				echo "<p>Proveedor ".$id." fue eliminado</p>";
			}
			else
			{
				echo "<p>Proveedor ".$id." fue eliminado, Error BD: ".$res."</p>";
			}
		}
	}
	else
	{
		echo "<p>Error BD: ".$res."</p>";
	}
			
		
?>