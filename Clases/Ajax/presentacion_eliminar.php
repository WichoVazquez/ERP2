<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/presentacion.php");
	$presentacion=new Presentacion();
	$presentacion->conexion($link);
	//$array=$presentacion->detalle($id);
	
	$res=$presentacion->delete($id);
	
	
		if($res=="OK")
		{
			echo "<p>Presentacion ".$id." fue eliminado</p>";
		}
		else
		{
			echo "<p>Presentacion ".$id." no fue eliminado, Error BD: ".$res."</p>";
		}
	
			
		
?>