<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/transporte.php");
	
	$transporte=new transporte();
	$transporte->conexion($link);
		
	$res=$transporte->delete_remolque($id);
	
	if($res=="OK")
	{
		
				echo "<p>El Remolque con id ".$id." fue eliminado</p>";
			}
		
	else
	{
		echo "<p>Error BD: ".$res." El remolque no pudo ser eliminado</p>";
	}
			
		
?>
