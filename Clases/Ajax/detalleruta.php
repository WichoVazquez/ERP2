<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	//$_POST['search'] = trim($_POST['search']); 
	$id=$_POST['search'];
	require("../Objetos/logistica.php");
	$link=conect();
	
	$detalle=new Logistica();
	$detalle->conexion($link);
	$array=$detalle->detalle($id);
	$total=0;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "<table class='myTable'>
						<th>Cliente</th>
						<th>Orden de Salida</th>
						<th>F. Creaci¨®n</th>
						<th>F. Entrega</th>
						<th>Material</th>
						
						<th>Cantidad en Ruta</th>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{			
				
			
					echo "<tr>";
								echo "<td>".$array[$renglones][0]."</td>"; 
								echo "<td>".$array[$renglones][1]."</td>";
								echo "<td>".$array[$renglones][8]."</td>"; 
								echo "<td>".$array[$renglones][2]."</td>"; 
								echo "<td>".$array[$renglones][3]."</td>";
								//echo "<td>".$array[$renglones][4]."</td>"; 
								echo "<td>".$array[$renglones][5]."</td>"; 
						echo "</tr>";
			 
		}
						echo "</table>";
						
	}
	else
	{
		echo "No existe detalle de esta cotizaci¨®n";
	}
			
		
?>