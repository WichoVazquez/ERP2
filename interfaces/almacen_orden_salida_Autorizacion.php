<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();	
	librerias_DataT();
		scripts_head("../Clases/javascript/almacen_orden_salida_Autorizacion.js");
	encabezado_BIG();
	?>
	<h2>
<a  href="VENTAS.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
		Asignación de Pedidos</h2>
<p></p>

 <div>
  <form action="generar_reporte_ordenSalida.php" method="post"/> 
 Buscar:<INPUT type="text" name="nombre" id="search" onKeyUp="Pagina('1')">
 
</div>
<br>
 <div id="sentencias" class="content">

	<?
	//inventario;

    //ordenes de salida
	require_once("../Clases/Conexion/conexion_prueba_local.php");	
	require_once("../Clases/Objetos/almacen-taller.php");
	$link=conect();
	$almacen_taller=new Almacen_Taller();
	$almacen_taller->conexion($link);
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$resultPedidos=$almacen_taller->result_pedidos_Autorizacion("", $RegistrosAEmpezar, $RegistrosAMostrar);
	;
	if($array!=null)
	{
	
		echo "
				<table class='myTable'>	


					<th>Cotización</th>
					<th>Folio O.S.</th>
					<th>CLIENTE</th>
					<th>Fecha de inicio</th>
					<th>Fecha de entrega</th>
					<th>Estado</th>
					
				";
			
	for($renglones=0; $renglones<count($array);$renglones++)
		{
				echo "<tr>";
							echo "<td>".$array[$renglones][7]."</td>";
							echo "<td>".$array[$renglones][6]."</td>";
							echo "<td>".$array[$renglones][2]."</td>";
							echo "<td>".$array[$renglones][3]."</td>";
							echo "<td>".$array[$renglones][4]."</td>";
							echo "<td>".$array[$renglones][5]."</td>";
						

						echo "</tr>";	
						
			 
		}
						echo "</table>";
						$NroRegistros=$almacen_taller->cuenta_resultado("");
						$PagAnt=$PagAct-1;
						$PagSig=$PagAct+1;
						$PagUlt=$NroRegistros/$RegistrosAMostrar;
						
						//verificamos residuo para ver si llevará decimales
						$Res=$NroRegistros%$RegistrosAMostrar;
						// si hay residuo usamos funcion floor para que me
						// devuelva la parte entera, SIN REDONDEAR, y le sumamos
						// una unidad para obtener la ultima pagina
						if($Res>0) $PagUlt=floor($PagUlt)+1;
						
						//desplazamiento
						if($PagAct>1) echo "<a onclick=\"Pagina('$PagAnt')\"  style=\"text-decoration:none;
						cursor:pointer;\"><img src='../images/back_button.png'/></a> ";
						 if($PagAct<$PagUlt) echo " <a onclick=\"Pagina('$PagSig')\" style=\"text-decoration:none;cursor:pointer;\"><img src='../images/next_button.png'/></a> ";
						 
						 echo "<strong>Pagina ".$PagAct." de ".$PagUlt."</strong>&nbsp;";
						 echo "<a onclick=\"Pagina('1')\" class=\"link_regreso\" style=\"text-decoration:none;
						 cursor:pointer;\">Primero &nbsp;</a> ";
						 echo "<a onclick=\"Pagina('$PagUlt')\" class=\"link_regreso\" style=\"text-decoration:none;
						 cursor:pointer;\">Ultimo &nbsp;</a>";
	}
	else
	{
		echo "Búsqueda sin Resultados";
	}
	
	
	
 ?>
</div>


 
<?
//Inicia Pie de Página
piepagina();
?>