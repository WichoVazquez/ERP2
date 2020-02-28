<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/prospecto.php");
	require("../Objetos/domicilio.php");
	$prospecto=new Prospecto();
	$prospecto->conexion($link);

	$array=$prospecto->detalle($id);

	$domicilio=new Domicilio();
	$domicilio->conexion($link);

	$res_pros_doc = $prospecto -> delete_doc($id);

if ($res_pros_doc=="OK")
{
	
	$res_pros=$prospecto->delete($id);
	
	if($res_pros=="OK")
	{
		
		$res=$domicilio->delete($array[3]);
		if($res=="OK")
			echo "<p>Prospecto ".$id." fue eliminado</p>";
		else
			echo "<p>Prospecto ".$id."  no fue eliminado, Error BD (Domicilio): ".$res."</p>";
	}
	else
		echo "<p>Error BD (Cliente): ".$res."</p>";
	
}
else
	echo "<p>Error BD (Prospecto): ".$res_pros_doc."</p>";


		
?>