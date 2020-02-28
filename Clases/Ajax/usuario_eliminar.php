<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/usuario.php");
	$usuario=new Usuario();
	$usuario->conexion($link);
	$array=$usuario->delete($id);
	if($array=="OK")
	{
		echo "<p>Usuario ".$id." fue eliminado</p>";
	}
	else
	{
		echo "<p>Error BD: ".$array."</p>";
	}		
		
?>