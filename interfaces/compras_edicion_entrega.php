<?php

 $id=$_GET["id"];
 $proveedor=$_GET["proveedor"];
 $req_id=$_GET["req_id"];

  

require_once("index_header.php");
  $user=sesiones_start();
  librerias();

  scripts_head("../Clases/Verificadores/general.js");
  scripts_head("../Clases/javascript/busqueda_entrega_almacen.js");
  encabezado_BIG();
  require_once("../Clases/Conexion/conexion_prueba_local.php");
  require("../Clases/Objetos/orden_compra.php");
  require("../Clases/Objetos/almacen.php");
 
 ?>

   <script>
  $(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
  });



  </script>
	<h2><a  href="compra_busqueda_usuario_almacen.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>Confirmación de Productos por Orden de Compras</h2>
<p></p>
<FORM>
<FIELDSET>

<table>

<tr>
  <td>
    <h1>Orden de Compra No. <INPUT  name="id_req" id="id"  readonly style="width:60px;background-color:#D3D3D3" IDREQBUSCA="null"   <? echo " value='".$id."'" ?> />
    </h1>    
</td>
<td>
      <LABEL style="width:100px; " for="req_no">Requisición No:</LABEL>


        <INPUT type="text" name="req_no" id="req_no"  readonly style="width:50px; background-color:#D3D3D3;" IDEMPRESACOT="null" <? echo " value='".$req_id."'" ?>/>
   
   
       </td>  

</tr>

</table>



<table>

<tr>

   

   <td  style="width:100px;"> 

  <LABEL style="width:100px;" for="proveedor">Proveedor:</LABEL>
      </td>

    <td  style="width:100px;"> 
      <INPUT type="text" name="cliente_req" id="proveedor"  readonly style="width:300px; background-color:#D3D3D3;" IDCLIENTECOT="null" <? echo " value='".$proveedor."'" ?>/>

    </td>  

</tr>

</table>



<DIV id="panelTransporte" style="padding-top:10px;">



<?php 
echo "<input id='usuario' value='".$user."'/>";
	$link=conect();
	$orden_compra=new Orden_compra();
	$orden_compra->conexion($link);
  $almacen=new Almacen();
  $almacen->conexion($link);
	$array=$orden_compra->detalle_compras($id);
	$array_observaciones=$orden_compra->detalle($id);
?>
 
</DIV>
</FIELDSET> 
</FORM>


<DIV id="orders-contain" class="ui-widget">

<?


	if($array!=null)
	{	


?>
  <TABLE id="Orden1" class="ui-widget ui-widget-content">
    <THEAD>
      <TR class="ui-widget-header">
      	  <th>ID</th>
          <th>Producto</th>
          <th>Unidad</th>
          <th>Descripción</th>
          <th>Cantidad Solicitada</th>
          <th>Cantidad Recibida</th>
          <th>Lote</th>
          <th>Laboratorio</th>

        
      </TR>
    </THEAD>
    <TBODY>
 <?


		for($renglones=0; $renglones<count($array);$renglones++)
		{			
				
			
						echo "<tr>";
						echo "<td>".$array[$renglones][0]."</td>";
						echo "<td>".$array[$renglones][1]."</td>"; 
            echo "<td>".$array[$renglones][7]."</td>"; 
            echo "<td>".$array[$renglones][6]."</td>"; 
						echo "<td>".$array[$renglones][2]."</td>";						
						echo "<td>"." <input type='text' name='cant_surtida' id='cant_surtida' id_producto='".$array[$renglones][8]."'  insumos='".$array[$renglones][9]."' value='".$array[$renglones][2]."' size='5'  onkeypress=\"return NumEntero(event)\"/>"."</td>"; 
            echo "<td><input type='text' name='lote' id='lote' value='' size='5'/></td>"; 
            echo "<td><a href=\"javascript:crear_orden({id:'".$array[$renglones][0]."'})\">Crear Orden</a>
                </td>";    
						echo "</tr>";	
			 
		}
					
?>
    </TBODY>
  </TABLE>
  <br> 

  <td>
 <label>Factura/Remisión:</label>  
 <?php
   echo " <input type=\"text\"  name=\"factura_compra\" id=\"factura_compra\" value='".$array_observaciones[9]."'  >";
  ?>
   </td>
 <LABEL class="ui-widget" for="datepicker"> Fecha de Recibo: <input name="datepicker" type="text" id="datepicker" /></label> 
 <br>
 <br> 
 <label>Observaciones Generales</label>  
 <?php
   echo " <input type=\"text\"  name=\"observaciones\" id=\"observaciones\" style='width: 500px'value='".$array_observaciones[5]."'  >";
  ?>

 
 <br>
 <br> 


    <select id='almacen' name='almacen' style='width: 200px; max-width:200px;'>";

<?
    $array=$almacen->detalle_almacen_taller();
    $renglones=0;
    for($renglones=0; $renglones<count($array);$renglones++)
      {
        echo "<option value='".$array[$renglones][0]."' almacen_tipo='".$array[$renglones][2]."'>".$array[$renglones][1]."</option>";
      }

         echo   "</select>";

?>


</DIV>

<DIV id="dialog_lab" title="Enviar Muestra al Laboratorio">

<br />
<table>
  <tr>
    <td valign="top" align="right">
    <LABEL for="Cantidad_Lab">Cantidad:</LABEL>
    <INPUT type="text" id="Cantidad_Lab" >
    </td>
</tr> 

</table>
</DIV>


<br />
<br />

<DIV id="divguardar" style="padding-top:10px; padding-bottom:10px;">
<?
echo "<BUTTON id='guardar-entrega'  onClick='GuardarDetalle(".$_GET['id'].")'>Guardar</BUTTON>";


	}
else

	echo "NO SE CUENTAN CON REGISTROS DE LA ORDEN DE COMPRA.";

?>



</DIV>




<?
//Inicia Pie de Página
piepagina();
?>