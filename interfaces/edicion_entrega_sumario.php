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
<a  href="entrega_busqueda.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../Imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>
 Recepción de Ruta</H2>
 <?php 
	$link=conect();
	$logistica=new logistica();
	$logistica->conexion($link);
	$array_sum=$logistica->sumarioEntrega($id);


?>

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

    <td width="120" height="39">Folio Nota Salida.
     <div class="result">
    <?php echo $array_sum[0][7]; ?>
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
			$status_OE = "PENDIENTE POR CAPTURAR";
		else if ($array_sum[$renglones_sumario][8]==1)
			$status_OE = "ENTREGADO";
		else if ($array_sum[$renglones_sumario][8]==2)
			$status_OE = "CANCELADO";

									echo "<td><a class='editEntrega' href='edicion_entrega.php?id=".$id."&ID_OS=".$array_sum[$renglones_sumario][1]."&TIPO=".$array_sum[$renglones_sumario][6]."&STATUS=".$status_OE."&OE=".$array_sum[$renglones_sumario][7]."' style='text-decoration:underline;'>".$status_OE."</a></td>";
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

	/*							echo "<td><a  class='detalleorden' href='#' no_ruta=".$id." idordensalida='". $array_sum[$renglones_sumario][1]."' style='text-decoration:underline;'>  DETALLE  </a></td>"; 
	*/
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