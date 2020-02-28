<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	
	require("../Objetos/contrato.php");
	$contrato=new Contrato();
	$contrato->conexion($link);

	
	$res=$contrato->delete($id);
	
	if($res=="OK")
	

			echo "<p>El Contrato ".$id." fue eliminado</p>";
		
	else
		
			echo "<p>El Contrato ".$id." no fue eliminado, Error BD: ".$res."</p>";
		
	

			
		
?>