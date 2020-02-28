<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();	
//	librerias_DataT();
scripts_head("../Clases/javascript/taller_almacen_busquedas.js");
	//scripts_head("../Clases/javascript/busqueda_cliente.js");



	encabezado_BIG();

		echo "<input id='usuario' type='hidden' value='".$user."'/>";
	?>
	<h2>
<a  href="ALMACEN.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
		Pedidos</h2>
<p></p>

 <div>


 Buscar:<INPUT type="text" name="nombre" id="search" onKeyUp="Pagina('1')">
 <button id="crear_orden_transportes"> Crear Solicitud de Transportes </button>
</div>
<br>


<DIV id="dialog_solicitudes_logistica" title="Solcitud a Transportes">


<table>
  
<tr>
<td>
<LABEL for="datepicker">Fecha Solicitada:</LABEL>
    <INPUT type="date" id="datepicker" >
</td>
</tr>
<tr>
<td>
<LABEL for="descripcion_solicitud">Observaciones:</LABEL>
    <INPUT type="text" id="descripcion_solicitud" >
</td>
</tr>

</table>
</DIV>



 <div id="sentencias" class="content">

	<?
	//inventario;

    //ordenes de salida
	require_once("../Clases/Conexion/conexion_prueba_local.php");	
	require_once("../Clases/Objetos/almacen-taller.php");
	$link=conect();
	$almacen_taller=new Almacen_Taller();
	$almacen_taller->conexion($link);
	$RegistrosAMostrar=50;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$resultPedidos=$almacen_taller->result_pedidos("", $RegistrosAEmpezar, $RegistrosAMostrar);
	;
	if($array!=null)
	{
	
		echo "
				<table class='myTable' id='pedidos_tabla'>	

  <THEAD>
   <TR>
					<th>Cotización</th>
					<th>Folio</th>
					<th>CLIENTE</th>
					<th>Fecha de inicio</th>
					<th>Fecha de entrega</th>
					<th>Estado</th>
					<th>Solicitud de Transporte</th>
					<th>Solicitudes de Transporte</th>
					 </TR>
 </THEAD>
    <TBODY>
					
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
							echo "<td>".$array[$renglones][10]."</td>";
							echo "<td><a href='#'>VER</a></td>";
							//echo "<td><a href='../Clases/pdf/create_nota_salida.php?req=".$array[$renglones][0]."' target='_NEW'>VER</a></td>";
						
					//	if ($array[$renglones][5])

						echo "</tr>";	
						
			 
		}
						echo " </TBODY>
						</table>";
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


<DIV id="dialog_instrucciones4" title="Instrucciones: ">

<TABLE >
    <THEAD>
      <TR>
           
      
        <TH><h1>Paso #1: </h1></TH>
        
        
      </TR>
    </THEAD>
    <TBODY>
  <td><img src='../imagenes/almacen2.png'  height="400" width="550" /></td>
  
    </TBODY>
  </TABLE>

</DIV>
 
<?
//Inicia Pie de Página
piepagina();
?>