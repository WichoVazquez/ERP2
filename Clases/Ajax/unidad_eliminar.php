<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/unidad.php");
	$unidad=new Unidad();
	$unidad->conexion($link);
	//$array=$unidad->detalle($id);
	
	$res=$unidad->delete($id);
	
	
		if($res=="OK")
		{
			echo "<p>Unidad ".$id." fue eliminado</p>";
		}
		else
		{
			echo "<p>Unidad ".$id." no fue eliminado, Error BD: ".$res."</p>";
		}
	
			
		
?>