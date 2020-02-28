<? // Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	librerias_DataT();
	
	encabezado();
?>
			
				
	
			
			
			<h1>Ordenes de Salida</h1>
<?
require_once("../Clases/Conexion/conexion_prueba_local.php");
require_once("../Clases/Objetos/pedido.php");
$link=conect();
$pedido=new Pedido();
$pedido->conexion($link);
$array=$pedido->select();
if($array!=null)
{
	 echo "
				<table class='myTable' id='example' >
						<thead>
						<tr>
							<th>Folio</th>
							<th>Cotización</th>
							<th>Contrato</th>
							<th>Partida</th>
							<th>Sucursal</th>
							<th>Fecha Inclusión</th>
							<th>Fecha Entrega</th>
							<th>Estado</th>
							<th>Observaciones</th>
						</tr>
						</thead>
						<tbody>
					";
	for($renglones=0; $renglones<count($array);$renglones++)
		{
			echo "<tr class='gradeA'>";
			echo "<td>".$array[$renglones][0]."</a></td>";
			if(!empty($array[$renglones][1]))
			{
				echo "<td>".$array[$renglones][1]."</a></td>";
			}
			else
				echo "<td>N/A</td>";
			if(!empty($array[$renglones][7]))
			{
				echo "<td>".$array[$renglones][7]."</a></td>";
			}
			else
				echo "<td>N/A</td>";
			if(!empty($array[$renglones][8]))
			{
				echo "<td>".$array[$renglones][8]."</a></td>";
			}
			else
				echo "<td>N/A</td>";
			if(!empty($array[$renglones][2]))
			{
				echo "<td>".$array[$renglones][2]."</a></td>";
			}
			else
				echo "<td><a href=''>N/D</a></td>";
			echo "<td>".$array[$renglones][3]."</a></td>";
			echo "<td>".$array[$renglones][4]."</a></td>";
			echo "<td>";
			switch($array[$renglones][5])
			{
				case 0:echo "Creado";break;
			}
			echo "</td>";
			echo "<td>".$array[$renglones][6]."</a></td>";		
			echo "</tr>";
		}
		echo "</tbody></table>";
}
else
	{
		echo "Búsqueda sin Resultados";
	}
?>	
<?
//Inicia Pie de Página
piepagina();
?>


