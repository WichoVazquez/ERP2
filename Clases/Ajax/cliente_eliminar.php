<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/cliente.php");
	require("../Objetos/domicilio.php");
	require("../Objetos/contacto_ventas.php");
	$cliente=new Cliente();
	$cliente->conexion($link);
	$array=$cliente->detalle($id);
	$domicilio=new Domicilio();
	$domicilio->conexion($link);
	$contacto=new Contacto_ventas();
	$contacto->conexion($link);

$res1=$contacto->delete($id);

if ($res1 == "OK"){
	$res=$cliente->delete($id);
	
	if($res=="OK")
	{

		$res=$domicilio->delete($array[3]);
		
		if($res=="OK" and $res1=="OK")
		{
			echo "<p>Cliente ".$id." fue eliminado</p>";
		}
		else
		{
			echo "<p>Cliente ".$id." fue eliminado, Error BD: ".$res."</p>";
		}
	}
	else
	{
		echo "<p>Error BD: ".$res."</p>";
	}
			
}	

else
{
	echo "<p>El contacto de Ventas del Cliente ".$id." no fue eliminado</p>";
}

?>