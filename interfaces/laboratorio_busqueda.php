
<? // Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_laboratorio.js");
	encabezado_BIG();
?>


			<h2>
<a  href="CALIDAD.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Búsqueda Análisis de Laboratorio</h2>
<p></p>
 <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')"> <select id="filter" name="filter" default="-1"; onChange="Pagina('1')"></div>

 <option value="-1">Todos</option>
 <option value="0">Pendientes</option>
 <option value="1">Autorizados</option>

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
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
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
						<th>No.</th>
						<th>Cliente</th>			
						<th>Empresa</th>				
						<th>Nombre Comercial</th>
						<th>Descripción</th>
						<th>Cantidad Muestra</th>
						<th>Unidad</th>
							<th>Estado</th>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
								echo "<td>".$array[$renglones][12]."</td>";						
								echo "<td><a href='javascript:detalle_cliente(".$array[$renglones][3].")'>".$array[$renglones][14]."</a></td>";
								echo "<td><a href=\"javascript:detalle_empresa(".$array[$renglones][5].")\">".$array[$renglones][15]."</a></td>";
								echo "<td>".$array[$renglones][6]."</td>";
								echo "<td>".$array[$renglones][7]."</td>";	
								echo "<td>".$array[$renglones][9]."</td>";
								echo "<td>";
								$Osalida=$array[$renglones][0];

								switch($array[$renglones][8])
								{
									case 1: echo "<a href=\"javascript:cambiar_status({id:'".$array[$renglones][0]."', usuario:'".$array[$renglones][4]."'})\">Pendiente</a>";break;
									//case 2: echo "<a href=\"javascript:confirmar({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."'})\">Enviado</a>";break;
									case 3: echo "<a href=\"javascript:cambiar_status({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."', usuario:'".$array[$renglones][4]."'})\">Autorizado</a>";break;


								}
								echo "</td>";
						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$calidad->cuenta_resultado("");
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
	
	

 
 echo '




<DIV id="dialog-status" title="Ingresar Producto">
  <FORM>
  <FIELDSET>
  
    <table id="Orden" class="myTable">
      <thead>
   ';
	require_once("../Clases/Objetos/calidad.php");
	//$link=conect();
	$calidad=new Calidad();
	$calidad->conexion($link);	
	$array1=$calidad->busqueda_calidad($Osalida);
    ;
echo "
<b>Folio O.S.:</b> ".$array1[0][0]."
<br>
<b>Cliente:</b>  ".$array1[0][4]."
<br>
<b>Fecha Entrega:</b> ".$array1[0][2]."
<br>

";

if($array1!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
				
			          <th>Producto</th>
			          <th>Cantidad Surtida</th>
			          <th>Cantidad Inspeccionada</th>
			          <th>1</th>
			          <th>2</th>
			          <th>3</th>
			          <th>4</th>
			          <th>5</th>
			          <th>6</th>
			          <th>7</th>
			          <th>8</th>
			          <th>Observaciones</th>

					";
		for($renglones=0; $renglones<count($array1);$renglones++)
		{
					echo "<tr>";
					
								echo "<td>".$array1[$renglones][1]."</td>";
								echo "<td>".$array1[$renglones][3]."</td>";
								echo "<td><INPUT type='text' id='Cantidad_lista'  style='width:50px;' value=".$array1[$renglones][3]."> </td>";
								echo "<td><INPUT type='checkbox'id='checktotal1' name='checktotal1' checked /></td>";
								echo "<td><INPUT type='checkbox'id='checktotal2' name='checktotal2' checked /></td>";
								echo "<td><INPUT type='checkbox'id='checktotal3' name='checktotal3' checked /></td>";
								echo "<td><INPUT type='checkbox'id='checktotal4' name='checktotal4' checked /></td>";
								echo "<td><INPUT type='checkbox'id='checktotal5' name='checktotal5' checked /></td>";
								echo "<td><INPUT type='checkbox'id='checktotal6' name='checktotal6' checked /></td>";
								echo "<td><INPUT type='checkbox'id='checktotal7' name='checktotal7' checked /></td>";
								echo "<td><INPUT type='checkbox'id='checktotal8' name='checktotal8' checked /></td>";
								echo "<td><INPUT type='text' id='Obs_lista'  style='width:150px;' value=''> </td>";
						echo "</tr>";
			 
		}
						echo "</table>";

}



   ?>
          
      </thead>
      <tbody>
      </tbody>
    </table>
  </FIELDSET>
  </FORM>
</DIV>




<div id="dialog" title="Información">
 </div>
 
<?
//Inicia Pie de Página
piepagina();
?>
