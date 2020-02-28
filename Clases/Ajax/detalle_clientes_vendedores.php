<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$_POST['id'] = trim($_POST['id']); 
	$id=$_POST['id'];
	require("../Objetos/usuario_cliente.php");

	$link=conect();
	
	$detalle=new Usuario_cliente();
	$detalle->conexion($link);
	$array=$detalle->detalle_cliente($id);
	$total=0;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "<table class='myTable'>
						
						<th>Clientes</th>

					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{			
				

					echo "<tr>";
								
								
						
								echo "<td>".$array[$renglones][1]."</td>";//razonsocial
							
						echo "</tr>";
			 
		}
						echo "</table>";
						
						
	}
	else
	{
		echo "No tiene clientes";
	}
			
		
?>