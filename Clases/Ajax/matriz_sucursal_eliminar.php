<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/sucursal.php");
	require("../Objetos/domicilio.php");
	require("../Objetos/generales.php");
	$sucursal=new Sucursal();
	$sucursal->conexion($link);
	$array=$sucursal->detalle($id);
	$domicilio=new Domicilio();
	$domicilio->conexion($link);
	$generales=new Generales();
	$generales->conexion($link);
	$res=$sucursal->delete($id);
	
	if($res=="OK")
	{
		$res=$domicilio->delete($array[4]);
		if($res=="OK")
		{
			
			$res=$generales->delete($array[5]);
			if($res=="OK")
			{
				echo "<p>Matriz/Sucursal ".$id." fue eliminado</p>";
			}
			else
			{
				echo "<p>Matriz/Sucursal ".$id." fue eliminado, Error BD: ".$res."</p>";
			}
		}
		else
		{
			echo "<p>Matriz/Sucursal ".$id." fue eliminado, Error BD: ".$res."</p>";
		}
	}
	else
	{
		echo "<p>Error BD: ".$res."</p>";
	}
		
?>