<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/pantalla.php");
	$pantalla=new Pantalla();
	$pantalla->conexion($link);
	$array=$pantalla->delete($id);
	if($array=="OK")
	{
		echo "<p>Pantalla ".$id." fue eliminado</p>";
	}
	else
	{
		echo "<p>Error BD: ".$array."</p>";
	}		
		
?>