<?php

 $id=$_GET["id"];
//  $idTransporte=$_GET["idTransporte1"];
  $idOS = $_GET["ID_OS"];
  $tipo_pedido= $_GET["TIPO"];
  $TRANSPORTE = "";
  $status_OE= $_GET["STATUS"];
  $FOLIO_OE= $_GET["OE"];
echo "<input id='tipo_pedido_ruta' value='".$tipo_pedido."'/>";
echo "<input type='hidden' id='folio_oe_var' value='".$FOLIO_OE."'/>";



  require_once("index_header.php");
  $user=sesiones_start();
  librerias();

  scripts_head("../Clases/Verificadores/general.js");
  require_once("../Clases/Conexion/conexion_prueba_local.php");
  require("../Clases/Objetos/logistica.php");
  	scripts_head("../Clases/javascript/busqueda_entrega.js");
  encabezado_BIG();
  

	$link=conect();
	$logistica=new logistica();
	$logistica->conexion($link);
	$array_sum=$logistica->sumarioEntrega($id);
	$array=$logistica->detalleEntrega($id,$idOS,$FOLIO_OE);

 ?>
 
 <style type="text/css" media="screen">
#separa3{
	margin:10px 0 10px 0;
	background:#8A0808;
	height:2px;
	width:800px;
	}
.tittle{
	color:#8A0808;
	text-shadow: 0.01em 0.01em 0.008em #333;
	}
.result{
	color:#8A0808;
	font-size:14px;
	font-weight:bold;	
}
#letraP{
	font-size:10px;
	font-weight:bold;	
}
#bot_return
{
float:left;
background:#fff;
width:320px;
}
#subtitulo
{
float:left;
background:#fff;
width:420px;
}
   </style>	
<H2>

<? echo "<input id='transporte' type='hidden' value='".$array[0][7]."'/>"; ?>

<a  <? 

$TRANSPORTE = $array[0][7];

echo "href='edicion_entrega_sumario.php?id=".$id."&idTransporte1=".$TRANSPORTE."'"; ?>
 title="Regresar"  style="text-decoration:none;">
        <img src='../Imagenes/back-imagen.png'  height="30" width="30" />
        </a>
 Órden de Entrega</H2>

<div id="separa3"></div>  
<div>
<table width="800" border="0">
  <tr>
    <td width="120" height="39">Ruta:<div class="result">
     <?php echo $id;?>
     </div>
    </td>

    

     <td>
      Personal Operativo:
      <div class="result">
        <?php echo $array_sum[0][10]; ?>
      </div>
    </td>   
  </tr>

<tr>
<td width="120" >
	Transporte:
      <div class="result">
        <?php echo $array_sum[0][5]; ?>
      </div>
</td>
 <td width="130">Fecha de Embarque<div class="result"> 
      <?php echo $array_sum[0][9]; ?>
    </div></td>

</tr>

</table>

</div>
 <div id="separa3"></div>



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
          <th>Cantidad a Surtir </th>
          <th>Cantidad Entregada </th>
          <th>Observaciones </th>
      </TR>
    </THEAD>
    <TBODY>
<?


	if($array!=null)
	{	
  $EntregadoOE_Cancelar = "style='opacity:0; position:absolute; left:9999px;'";
  $EntregadoOE_Parcial = "style='opacity:0; position:absolute; left:9999px;'";

		for($renglones=0; $renglones<count($array);$renglones++)
		{			
					echo "<tr>";

            $EntregadoOE = "";

								echo "<td>".$array[$renglones][3]."</td>";
								echo "<td>".$array[$renglones][4]."</td>"; 							
								
                if (($status_OE=="ENTREGADO")||($status_OE=="CANCELADO"))
                 { 


                  $EntregadoOE = "style='opacity:0; position:absolute; left:9999px;'";
                                 
                  echo "<td idrutadetalle='".$array[$renglones][0]."'>".$array[$renglones][5]." <input type='text' name='enr".$renglones."' id='enr".$renglones."' value='".$array[$renglones][4]."' size='5' style='opacity:0; position:absolute; left:9999px;'  onkeypress=\"return NumEntero(evenWWt)\"/>"."</td>"; 

                  echo "<td>".$array[$renglones][6]." <input type='text' name='obs' id='obs".$renglones."' value='".$array[$renglones][6]."' size='20' ".$EntregadoOE." maxlength='50' ></td>"; 

                  if ($array[$renglones][5]<$array[$renglones][4])
                   $EntregadoOE_Cancelar = "";

                  if ($status_OE=="CANCELADO")
                   $EntregadoOE_Parcial = "";

                                  }
                else{
                  echo "<td idrutadetalle='".$array[$renglones][0]."'>"." <input type='text' name='enr' id='enr".$renglones."' value='".$array[$renglones][4]."' size='5'  onkeypress=\"return NumEntero(event)\"/>"."</td>"; 

								echo "<td>"." <input type='text' name='obs' id='obs".$renglones."' value='' size='20' maxlength='50' ></td>"; 

						echo "</tr>";	 
                }
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
echo "<BUTTON id='guardar-entrega' ".$EntregadoOE."  onClick='GuardarEntrega(".$_GET['id']."); Registro_status_r(".$id.");'>Guardar</BUTTON>";
?>


<?
echo "<BUTTON id='guardar-entrega-recoleccion'  onClick='GuardarEntrega_recoleccion(".$_GET['id'].")'>Generar Orden de Salida</BUTTON>";
?>

</DIV>

<?
//Inicia Pie de Página
piepagina();
?>