<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/transporte.php");
	
	$transporte=new transporte();
	$transporte->conexion($link);
		
	$res=$transporte->delete($id);
	
	if($res=="OK")
	{
		
				echo "<p>El Transporte con id ".$id." fue eliminado</p>";
			}
		
	else
	{
		echo "<p>Error BD: ".$res." El transporte no pudo ser eliminado</p>";
	}
			
		
?>
