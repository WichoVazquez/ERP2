<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	//$_POST['search'] = trim($_POST['search']); 
	$id=$_POST['search'];
	require("../Objetos/taller_solicitud.php");
	$link=conect();
	
	$detalle=new Taller_solicitud();
	$detalle->conexion($link);
	$array=$detalle->detalle_solicitudes($id);
	$total=0;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "<table class='myTable'>
						<th>Material</th>
						<th>Presentacion</th>
						<th>Cantidad</th>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{			
				
			
					echo "<tr>";
								echo "<td>".$array[$renglones][1]."</td>"; 
								echo "<td>".$array[$renglones][3]."</td>";
								echo "<td>".$array[$renglones][2]."</td>"; 
						echo "</tr>";
			 
		}
						echo "</table>";
						
	}
	else
	{
		echo "No existe detalle de esta cotización";
	}
			
		
?>