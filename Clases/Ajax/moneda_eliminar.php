<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/moneda.php");
	
	$moneda=new moneda();
	$moneda->conexion($link);
	//$array=$moneda->detalle($id);
		
	$res=$moneda->delete($id);
	
	if($res=="OK")
	{
		/*$res=$domicilio->delete($array[3]);
		if($res=="OK")
		{
			$res=$generales->delete($array[4]);
		
			
			if($res=="OK")
			{*/
				echo "<p>El Tipo de Moneda con id ".$id." fue eliminado</p>";
			}
		/*	else
			{
				echo "<p>El Tipo de Moneda con id ".$id." fue eliminado, Error BD: ".$res."</p>";
			}
		}
	}*/
	else
	{
		echo "<p>El Tipo de Moneda no fue eliminado  Error BD: ".$res."</p>";
	}
			
		
?>
