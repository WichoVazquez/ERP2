<?php

 $id=$_GET["id"];
  $idTransporte=$_GET["idTransporte1"];
  

require_once("index_header.php");
  $user=sesiones_start();
  librerias();

  scripts_head("../Clases/Verificadores/general.js");
  require_once("../Clases/Conexion/conexion_prueba_local.php");
  require("../Clases/Objetos/logistica.php");
  	scripts_head("../Clases/javascript/busqueda_entrega_sumario.js");
  encabezado_BIG();
  
 ?>
<H2>
<a  href="nota_salida_busqueda.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>
Confirmación de Notas de Salida</H2>
<FORM>
<FIELDSET>



<DIV id="panelTransporte" style="padding-top:10px;">
	<LABEL class="ui-widget"><b>Ruta:</b> <? echo $id; ?></LABEL>
	<br>
<LABEL class="ui-widget"><b>Transporte:</b></LABEL>
<?php 
	$link=conect();
	$logistica=new logistica();
	$logistica->conexion($link);
	$array_sum=$logistica->sumarioEntrega($id);

echo"<LABEL class=\"ui-widget\">".$array_sum[0][5]."</LABEL>";

?>
 
</DIV>
</FIELDSET> 
</FORM>

<DIV id="orders-contain-sumario" class="ui-widget">
 <H1>Detalle:</H1>
  <TABLE id="Orden_sumario" class="ui-widget ui-widget-content">
    <THEAD>
      <TR class="ui-widget-header ">
      	<th>Tipo</th>
          <th>Cliente</th>
          <th>Folio Pedido</th>
          <th>No. Nota de Salida</th>
          <th>Fecha de Entrega</th>
          <th> </th>
          <th> </th>
      </TR>
    </THEAD>
    <TBODY>
<?


	if($array_sum!=null)
	{	
		for($renglones_sumario=0; $renglones_sumario<count($array_sum);$renglones_sumario++)
		{			
				
			
					echo "<tr>";
					echo "<td>".$array_sum[$renglones_sumario][6]."</td>";
								echo "<td>".$array_sum[$renglones_sumario][0]."</td>";
								echo "<td>".$array_sum[$renglones_sumario][2]."</td>";
									echo "<td>".$array_sum[$renglones_sumario][7]."</td>";
								echo "<td>".$array_sum[$renglones_sumario][3]."</td>"; 		

if ($array_sum[$renglones_sumario][6]!="Recolección")

{
		if ($array_sum[$renglones_sumario][8]==0)
			$status_OE = "DETALLE";
		else
			$status_OE = "CONFIRMAR NOTA";

									echo "<td><a class='editEntrega' href='edicion_notas_salida.php?id=".$id."&ID_OS=".$array_sum[$renglones_sumario][1]."&TIPO=".$array_sum[$renglones_sumario][6]."' style='text-decoration:underline;'>".$status_OE."</a></td>";
}
else
{
	if ($array_sum[$renglones_sumario][2]==0)
	{
				$status_OE = "GENERAR O.S.";
													echo "<td><a class='editEntrega' href='nueva_orden_salida_recoleccion.php?id=".$id."&ID_OS=".$array_sum[$renglones_sumario][1]."' style='text-decoration:underline;'>".$status_OE."</a></td>";
			}
	else
		{
			$status_OE = "O.S. GENERADA";
												echo "<td><a class='editEntrega' href='edicion_entrega.php?id=".$id."&ID_OS=".$array_sum[$renglones_sumario][1]."&TIPO=".$array_sum[$renglones_sumario][6]."' style='text-decoration:underline;'>".$status_OE."</a></td>";

		}


}
/*
echo "<td><a href='../Clases/pdf/create_req_compra.php?req=".$array_sum[$renglones_sumario][1]."' target='_NEW'>PDF</a></td>";
*/
echo "<td><a href='../Clases/pdf/create_nota_salida.php?req=2' target='_NEW'>PDF</a></td>";
						echo "</tr>";
			 
		}
					
					
						
	}
	
?>
    </TBODY>
  </TABLE>
 
</DIV>






<DIV id="divguardar" style="padding-top:10px; padding-bottom:10px;">

</DIV>




<?
//Inicia Pie de Página
piepagina();
?>