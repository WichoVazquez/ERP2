<?php
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/operador.php");
	
	$operador=new Operador();
	$operador->conexion($link);
	//$array=$operador->detalle($id);
		
	$res=$operador->delete($id);
	
	if($res=="OK")
	{
		/*$res=$domicilio->delete($array[3]);
		if($res=="OK")
		{
			$res=$generales->delete($array[4]);
		
			
			if($res=="OK")
			{*/
				echo "<p>El Tipo de operador con id ".$id." fue eliminado</p>";
			}
		/*	else
			{
				echo "<p>El Tipo de operador con id ".$id." fue eliminado, Error BD: ".$res."</p>";
			}
		}
	}*/
	else
	{
		echo "<p>El Tipo de operador no fue eliminado  Error BD: ".$res."</p>";
	}
			
		
?>
