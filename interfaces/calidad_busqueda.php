
<? // Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	librerias_dateP();
	scripts_head("../Clases/javascript/busqueda_calidad.js");
	encabezado_BIG();

	echo "<input id='usuario' type='hidden' value='".$user."'/>";
?>


			<h2>
<a  href="CALIDAD.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Búsqueda Órdenes a Laboratorio</h2>
<p></p>
 <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')"> <select id="filter" name="filter" default="-1"; onChange="Pagina('1')"></div>

 <option value="-1">Todos</option>
 <option value="0">Pendientes</option>
 <option value="1">Terminados</option>

 </select>
 <br>
 <br>
 <div id="sentencias" class="content">

 <?
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/laboratorio.php");
	$link=conect();
	$laboratorio=new Laboratorio();
	$laboratorio->conexion($link);					
	$RegistrosAMostrar=40;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$filter=-1;
	$array=$laboratorio->busqueda_parametros("", $RegistrosAEmpezar, $RegistrosAMostrar, $filter);

    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
						<th>No. Orden</th>
						<th>Lote</th>		
						<th>Producto</th>				
						<th>Cantidad de la Muestra</th>				
						<th>Cantidad Analizada</th>
						<th>Usuario Solictante</th>
						<th>Usuario Análisis</th>
						<th>Fecha Solicitud</th>
						<th>Fecha Analisis</th>
						<th>Estado</th>
						<th>PDF</th>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
								echo "<td>".$array[$renglones][0]."</td>";			
								echo "<td>".$array[$renglones][13]."</td>";				
								echo "<td>".$array[$renglones][10]."</td>";	
								echo "<td>".$array[$renglones][3]." ".$array[$renglones][12]."</td>";	
								echo "<td>".$array[$renglones][4]."</td>";
								echo "<td>".$array[$renglones][5]."</td>";
								echo "<td>".$array[$renglones][6]."</td>";
								echo "<td>".$array[$renglones][7]."</td>";
								echo "<td>".$array[$renglones][8]."</td>";
								echo "<td>";

if ($array[$renglones][9]==0)
{
								echo "<a href=\"javascript:cambiar_status({
									id:'".$array[$renglones][0]."', 
									producto:'".$array[$renglones][10]."',
									cantidad_analizar:'".$array[$renglones][3]."', 
									usuario_solicitante:'".$array[$renglones][5]."',
								})\">Pendiente</a>";
								echo "<td></td>";
}
else
{
								echo "Terminado";
							echo "<td><a href='../Clases/pdf/createremision.php?cot=1' target='_NEW'>".$array[$renglones][11]."</a></td>";		
	}
								echo "</td>";

						

						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$laboratorio->cuenta_resultado("");
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
					if($PagAct>1) echo "<a  href='#' onclick=\"Pagina('$PagAnt')\"  style=\"text-decoration:none;
					cursor:pointer;\"><img src='../imagenes/carousel_previous_button.gif'/></a> ";
					 if($PagAct<$PagUlt) echo " <a  href='#' onclick=\"Pagina('$PagSig')\" style=\"text-decoration:none;cursor:pointer;\"><img src='../imagenes/carousel_next_button.gif'/></a> ";
					 
					 echo "<strong>Pagina ".$PagAct." de ".$PagUlt."</strong>&nbsp;";
					 echo "<a onclick=\"Pagina('1')\" class=\"link_regreso\" style=\"text-decoration:none;
					 cursor:pointer;\">Primero &nbsp;</a> ";
					 echo "<a onclick=\"Pagina('$PagUlt')\" class=\"link_regreso\" style=\"text-decoration:none;
					 cursor:pointer;\">Ultimo &nbsp;</a>
					 <br>";
	}
	else
	{
		echo "Búsqueda sin Resultados";
	}
	

   ?>

<DIV id="dialog-status" title="Análisis de Laboratorio">
<h1>CERTIFICADO DE LABORATORIO: </h1>
 <br>
    <LABEL style="width:50px;" for="no_orden_laboratorio">No. Orden de Laboratorio:</LABEL>
    <INPUT type="textarea" name="no_orden_laboratorio" id="no_orden_laboratorio"  style="width:100px; background-color:#D3D3D3;" readonly maxlength="300" />

 
    <LABEL style="width:50px;" for="solicitante_orden_laboratorio">Solicitante:</LABEL>
    <INPUT type="textarea" name="solicitante_orden_laboratorio" id="solicitante_orden_laboratorio"  style="width:100px; background-color:#D3D3D3;" readonly maxlength="300" value="ButronJ"/>

<br>
 <br>
    <LABEL style="width:50px;" for="producto_orden_laboratorio">Producto:</LABEL>
    <INPUT type="textarea" name="producto_orden_laboratorio" id="producto_orden_laboratorio"  style="width:220px; background-color:#D3D3D3;" readonly maxlength="300" value=""/>

    Fecha de entrega: <input type='text' id='datepicker'>
<br>
 <br>
     <LABEL style="width:50px;" for="cantidad_solicitada">Cantidad para Análisis:</LABEL>
    <INPUT type="textarea" name="cantidad_solicitada" id="cantidad_solicitada"  style="width:130px; background-color:#D3D3D3;" readonly  maxlength="300" />
    <LABEL style="width:50px;" for="cantidad_analizada">Cantidad Analizada:</LABEL>
    <INPUT type="textarea" name="cantidad_analizada" id="cantidad_analizada" requiered  style="width:100px; "  maxlength="300" />


<br>
	<br>
	<b>SUBIR CERTIFICADO DE LABORATORIO: </b>
	<br>
	<br>
	<INPUT name="archivo" type="file" id="archivo" required />

</DIV>




<div id="dialog" title="Información">
 </div>
 
 <DIV id="dialog_instrucciones44" title="Instrucciones: ">

<TABLE >
    <THEAD>
      <TR>
           
      
        <TH><h1>Paso Siguiente: </h1></TH>
        
        
      </TR>
    </THEAD>
    <TBODY>
  <td><img src='../imagenes/laboratorio2.png'  height="400" width="550" /></td>
  
    </TBODY>
  </TABLE>

</DIV>
<?
//Inicia Pie de Página
piepagina();
?>
