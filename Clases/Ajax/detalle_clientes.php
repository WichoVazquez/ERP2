<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$_POST['id'] = trim($_POST['id']); 
	$id=$_POST['id'];
	require("../Objetos/usuario.php");

	$link=conect();
	
	$detalle=new Usuario();
	$detalle->conexion($link);
	$array=$detalle->detalle_cliente($id);
	$total=0;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "<table class='myTable'>
						<th>Vendedor</th>
						<th>Clientes</th>

					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{			
				

					echo "<tr>";
								
								
								echo "<td>".$array[$renglones][0]."</td>"; //unidad
								echo "<td>".$array[$renglones][1]."</td>";//cantidad
							
						echo "</tr>";
			 
		}
						echo "</table>";
						
						
	}
	else
	{
		echo "No tiene clientes";
	}
			
		
?>