<?php

 $id=$_GET["id"];
 //echo "$id";

  

require_once("index_header.php");
  $user=sesiones_start();
  librerias();

  scripts_head("../Clases/Verificadores/general.js");
  scripts_head("../Clases/javascript/busqueda_entrega_almacen.js");
  encabezado_BIG();
  require_once("../Clases/Conexion/conexion_prueba_local.php");
  require("../Clases/Objetos/almacen-taller.php");
  require("../Clases/Objetos/material.php");
  require("../Clases/Objetos/almacen.php");
 ?>

   <script>
  $(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
  });



  </script>
	<h2>Surtir Material</h2>
<p></p>
<FORM>
<FIELDSET>

<DIV id="panelTransporte" style="padding-top:10px;">


<?php 
echo "<input id='usuario' value='".$user."'/>";
	$link=conect();
	$almacen_taller=new Almacen_Taller();
	$almacen_taller->conexion($link);
  $almacen=new Almacen();
  $almacen->conexion($link);
  $material=new Material();
  $material->conexion($link);
	$array=$almacen_taller->detalle_solicitud_material($id);

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
          <th>Cantidad Solicitada</th>
          <th>Cantidad Recibida</th>
         
      </TR>
    </THEAD>
    <TBODY>
 <?


		for($renglones=0; $renglones<count($array);$renglones++)
		{			
				
			
						echo "<tr>";
								echo "<td>".$array[$renglones][0]."</td>";
								echo "<td>".$array[$renglones][1]."</td>"; 
								echo "<td>".$array[$renglones][2]."</td>";						
								echo "<td>"." <input type='text' name='cant_surtida' id='cant_surtida' value='".$array[$renglones][2]."' size='5'  onkeypress=\"return NumEntero(event)\"/>"."</td>"; 
                echo "<td>".$array[$renglones][3]."</td>";
								 
						echo "</tr>";	
			 
		}
					
					
						

?>
    </TBODY>
  </TABLE>
  <br> 

<td class='texto_chico_tabla' style='font-size:12px;'>Almacen de Entrada: </td>
          <td width='100'>
        <select name='almacen' style='max-width:300px;'>";

<?
    $array=$almacen->detalle_tabla();
    $renglones=0;
    for($renglones=0; $renglones<count($array);$renglones++)
      {
        echo "<option value='".$array[$renglones][0]."'>".$array[$renglones][1]."</option>";
      }
?>

    </select>
      </td>
            
    </tr>

 
 
  <br>
   <br>
 <LABEL class="ui-widget" for="datepicker"> Fecha de Surtido: <input name="datepicker" type="text" id="datepicker" /></label> 
 <br>
 <br> 





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