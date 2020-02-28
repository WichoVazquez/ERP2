<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/perfil.php");
	require("../Objetos/perfil_pantalla.php");

	$perfil_pantalla=new Perfil_Pantalla();
	$perfil_pantalla->conexion($link);
	$array=$perfil_pantalla->deleteTodoPerfil($id);

	$perfil=new Perfil();
	$perfil->conexion($link);
	$array=$perfil->delete($id);

	if($array=="OK")
	{
		echo "<p>Perfil ".$id." fue eliminado</p>";
	}
	else
	{
		echo "<p>Error BD: ".$array."</p>";
	}		
		
?>