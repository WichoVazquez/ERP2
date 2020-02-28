<?php
 if(!isset($_SESSION['user']))
{
  require("../Clases/Sesion/checarSesion.php");
  checarSesion();
  //checa perfil de usuario
}
 $user=$_SESSION['user'];
 $id=$_GET["id"];
//  $idTransporte=$_GET["idTransporte1"];
  $idOS = $_GET["ID_OS"];
  $tipo_pedido= $_GET["TIPO"]; 
  
echo "<input id='tipo_pedido_ruta' value='".$tipo_pedido."'/>";
echo "<input id='usuario' value='".$user."'/>";

require_once("index_header.php");
  $user=sesiones_start();
  librerias();

  scripts_head("../Clases/Verificadores/general.js");
  require_once("../Clases/Conexion/conexion_prueba_local.php");
  require("../Clases/Objetos/logistica.php");
  	scripts_head("../Clases/javascript/busqueda_notas_salida.js");
  encabezado_BIG();
  

	$link=conect();
	$logistica=new logistica();
	$logistica->conexion($link);
	$array_sum=$logistica->sumarioEntrega($id);
	$array=$logistica->detalleEntrega($id,$idOS);

  

 ?>
<H2>
<a  <? echo "href='edicion_entrega_sumario.php?id=".$id."&idTransporte1=".$array[0][7]."'"; ?>
 title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" />
        </a>
 Confirmar Notas de Salida</H2>
<FORM>
<FIELDSET>


<DIV id="panelTransporte" style="padding-top:10px;">
	<LABEL class="ui-widget"><b>Ruta:</b> <? echo $id; ?></LABEL>
	<br>

	<LABEL class="ui-widget"><b>Tipo:</b> <? echo 	$tipo_pedido; ?></LABEL>
	<br>

<LABEL class="ui-widget"><b>Transporte:</b></LABEL>
<?php 

	if($array!=null)
	{
echo"<LABEL class=\"ui-widget\">".$array[0][7]."</LABEL>";
}
?>
 
</DIV>
</FIELDSET> 
</FORM>

<DIV id="orders-contain-sumario" class="ui-widget">
 <H1>Detalle:</H1>
  <TABLE id="Orden_sumario" class="ui-widget ui-widget-content">
    <THEAD>
      <TR class="ui-widget-header ">
      	
          <th>Cliente</th>
          <th>No. O.S.</th>
          <th>Folio O.S.</th>
          <th>Fecha de Entrega</th>
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
					
								echo "<td>".$array_sum[$renglones_sumario][1]."</td>"; 
								echo "<td>".$array_sum[$renglones_sumario][2]."</td>";
								echo "<td>".$array_sum[$renglones_sumario][3]."</td>"; 							
								echo "<td><a  class='detalleorden' href='#' no_ruta=".$id." idordensalida='". $array_sum[$renglones_sumario][1]."' style='text-decoration:underline;'>  DETALLE  </a></td>"; 
						echo "</tr>";
			 
		}
					
					
						
	}
	
?>
    </TBODY>
  </TABLE>
 
</DIV>


<DIV id="orders-contain" class="ui-widget">
 <H1>Detalle:</H1>
  <TABLE id="Orden1" class="ui-widget ui-widget-content">
    <THEAD>
      <TR class="ui-widget-header ">
          <th>Producto</th>
          <th>Cantidad a Embarcar</th>
          <th>Cantidad Confirmada</th>
      </TR>
    </THEAD>
    <TBODY>
<?


	if($array!=null)
	{	
		for($renglones=0; $renglones<count($array);$renglones++)
		{			
					echo "<tr>";
					
							//	echo "<td>".$array[$renglones][2]."</td>"; 
					
								echo "<td>".$array[$renglones][3]."</td>";
								echo "<td><center>".$array[$renglones][4]."</center></td>"; 							
							echo "<td idrutadetalle='".$array[$renglones][0]."'>"." <input type='text' name='enr".$renglones."' id='enr".$renglones."' value='".$array[$renglones][4]."' size='5'  onkeypress=\"return NumEntero(event)\"/>"."</td>"; 
								 
						echo "</tr>";	 
		}			
	}
	
?>
    </TBODY>
  </TABLE>
</DIV>


<DIV id="orders-contain-recoleccion" class="ui-widget">
 <H1>Detalle:</H1>
  <TABLE id="Orden1_recoleccion" class="ui-widget ui-widget-content">
    <THEAD>
      <TR class="ui-widget-header ">
      <th>No. Ruta Detalle</th>
          <th>Cliente</th>
          <th>Folio O.S.</th>
          <th>Producto</th>
          <th>Cantidad a Recoger </th>
          <th>Cantidad Recogida </th>
          <th>No. Detalle </th>
      </TR>
    </THEAD>
    <TBODY>
<?


	if($array!=null)
	{	
		for($renglones=0; $renglones<count($array);$renglones++)
		{			
					echo "<tr>";
								echo "<td>".$array[$renglones][0]."</td>";
								echo "<td>".$array[$renglones][2]."</td>"; 
								echo "<td>".$array[$renglones][10]."</td>"; 
								echo "<td>".$array[$renglones][3]."</td>";
								echo "<td>".$array[$renglones][11]."</td>"; 							
								echo "<td>"." <input type='text' name='enr".$renglones."' id='enr".$renglones."' value='".$array[$renglones][11]."' size='5'  onkeypress=\"return NumEntero(event)\"/>"."</td>"; 
								echo "<td>".$array[$renglones][12]."</td>";


						echo "</tr>";	 
		}			
	}
	
?>
    </TBODY>
  </TABLE>
</DIV>

<DIV id="divguardar" style="padding-top:10px; padding-bottom:10px;">
<?
echo "<BUTTON id='confirmar_nota_salida'  onClick='ConfirmarNota(".$_GET['id'].")'>Confirmar Nota de Salida</BUTTON>";
?>


<?
echo "<BUTTON id='guardar-entrega-recoleccion'  onClick='GuardarEntrega_recoleccion(".$_GET['id'].")'>Generar Orden de Salida</BUTTON>";
?>

</DIV>

<?
//Inicia Pie de Página
piepagina();
?>