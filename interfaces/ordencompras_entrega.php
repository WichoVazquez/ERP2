<?php

 $id=$_GET["id"];
  $idTransporte=$_GET["idTransporte1"];
  

require_once("index_header.php");
  $user=sesiones_start();
  librerias();

  scripts_head("../Clases/Verificadores/general.js");
  require_once("../Clases/Conexion/conexion_prueba_local.php");
  require("../Clases/Objetos/logistica.php");
  	scripts_head("../Clases/javascript/busqueda_entrega.js");
  encabezado();
  
 ?>

<FORM>
<FIELDSET>

<DIV id="panelTransporte" style="padding-top:10px;">
<LABEL class="ui-widget">Transporte:</LABEL>
<?php 
	$link=conect();
	$logistica=new logistica();
	$logistica->conexion($link);
	$array=$logistica->detalleEntrega($id);
	if($array!=null)
	{
echo"<LABEL class=\"ui-widget\">".$array[0][7]."</LABEL>";
}
?>
 
</DIV>
</FIELDSET> 
</FORM>


<DIV id="orders-contain" class="ui-widget">
 <H1>Ordenes de Salida:</H1>
  <TABLE id="Orden1" class="ui-widget ui-widget-content">
    <THEAD>
      <TR class="ui-widget-header ">
      <th>rutaid</th>
          <th>Cliente</th>
          <th>Articulo</th>
          <th>Cantidad a Surtir </th>
          <th>Cantidad Entregada </th>
          <th>Observaciones </th>
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
								echo "<td>".$array[$renglones][3]."</td>";
								echo "<td>".$array[$renglones][4]."</td>"; 							
								echo "<td>"." <input type='text' name='enr".$renglones."' id='enr".$renglones."' value='".$array[$renglones][5]."' size='5'  onkeypress=\"return NumEntero(event)\"/>"."</td>"; 
								echo "<td>"." <input type='text' name='obs' id='obs".$renglones."' value='".$array[$renglones][8]."' size='20' maxlength='50' >"."</td>"; 
						echo "</tr>";
			 
		}
					
					
						
	}
	
?>
    </TBODY>
  </TABLE>
  <br>
 <br> 
 <label>Observaciones Generales</label>  
 <?php
   echo " <input type=\"text\" name=\"observaciones\" id=\"observaciones\" value='".$array[0][6]."'>";
  ?>

</DIV>



<br />
<br />

<DIV id="divguardar" style="padding-top:10px; padding-bottom:10px;">
<?
echo "<BUTTON id='guardar-entrega'  onClick='GuardarEntrega(".$_GET['id'].")'>Guardar</BUTTON>";
?>
</DIV>




<?
//Inicia Pie de Página
piepagina();
?>