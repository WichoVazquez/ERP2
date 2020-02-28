<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/material.php");
	require("../Objetos/almacen_material.php");
	$material=new Material();
	$material->conexion($link);
	$almacen_material=new Almacen_material();
	$almacen_material->conexion($link);
	
	$res=$almacen_material->delete($id);
	
	if($res=="OK")
	{
	
		if($res=="OK")
		{
			echo "<p>El Registro ".$id." fue eliminado</p>";
		}
		else
		{
			echo "<p>El Registro ".$id." no fue eliminado, Error BD: ".$res."</p>";
		}
	}
	else
	{
		echo "<p>Error BD: ".$res."</p>";
	}
			
		
?>