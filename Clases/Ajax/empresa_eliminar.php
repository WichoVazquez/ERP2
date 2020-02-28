<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_GET['id'];
	require("../Objetos/empresa.php");
	
	$empresa=new Empresa();
	$empresa->conexion($link);
	//$array=$moneda->detalle($id);
		
	$res=$empresa->delete($id);
	
	if($res=="OK")
	{
		
				echo "<p>La Empresa con id ".$id." fue eliminada</p>";
			}
		
	else
	{
		echo "<p>La Empresa no fue eliminada  Error BD: ".$res."</p>";
	}
			
		
?>
