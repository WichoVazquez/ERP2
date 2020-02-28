<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_material_historial.js");
	encabezado_BIG();
?>
			<h2>
<a  href="ALMACEN.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				HISTORIAL DE ENTRADAS / SALIDAS</h2>
<p></p>

 <div>
  
 Buscar:<INPUT type="text" name="nombre" id="search" onKeyUp="Pagina('1')">
<select id='filter' name='filter' style='width: 200px; max-width:200px;' onChange="Pagina('1')">";

<?
require_once("../Clases/Conexion/conexion_prueba_local.php");	
  require("../Clases/Objetos/almacen.php");
  	$link=conect();
  $almacen=new Almacen();
  $almacen->conexion($link);
    $array=$almacen->detalle_almacen_taller();
    $renglones=0;
    echo "<option value='-1'>Todos</option>";
    for($renglones=0; $renglones<count($array);$renglones++)
      {
        echo "<option value='".$array[$renglones][0]."' almacen_tipo='".$array[$renglones][2]."'>".$array[$renglones][1]."</option>";
      }

         echo   "</select>";

?>

</div>
 <div id="sentencias" class="content">
 <?
 require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/material.php");
	require_once("../Clases/Objetos/almacen_material.php");
	$link=conect();
	$material=new Material();
	$material->conexion($link);
	$almacen_material=new Almacen_material();
	$almacen_material->conexion($link);
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$filter=-1;
	$array=$almacen_material->busqueda_parametros_historial("", $RegistrosAEmpezar, $RegistrosAMostrar, $filter);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);	
		 echo "
				<table class='myTable'>
					

						<th>ID</td>

						
						<th>Material</td>
						<th>Presentacion</td>
						<th>Existencia</td>
						<th>Almacén</td>
						<th>Usuario</td>
						<th>Fecha</td>
						<th>Cantidad E/S</td>
						<th>MOVIMIENTO</td>
						<th>NOTA</td>
			
				";
					$cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{
			if($array[$renglones][14]>0)
							echo "<tr>";
			else
							echo "<tr style='color: red'>";

							echo "<td>".$array[$renglones][7]."</td>";
							echo "<td>".$array[$renglones][2]."</td>";
							echo "<td>".$array[$renglones][10]."</td>";
							echo "<td>".$array[$renglones][3]."</td>";
									//if(($array[$renglones][14]>0)&&($array[$renglones][16]!=NULL))
								//echo "<td>VH PRODUCCIÓN</td>";
							//else if(($array[$renglones][14]<0)&&($array[$renglones][16]))
							//	echo "<td>VH ALMACÉN</td>";
							//else if($array[$renglones][15])
								echo "<td>".$array[$renglones][18]."</td>";

							/* HIST */ 

							echo "<td>".$array[$renglones][13]."</td>";
							echo "<td>".$array[$renglones][12]."</td>";
							echo "<td><center>".$array[$renglones][14]."</center></td>";

							if($array[$renglones][15]){
																echo "<td>COMPRAS</td>";
															echo "<td><center><a href='../Clases/pdf/create_nota_entrada.php?req=".$array[$renglones][17]."' target='_NEW'>NOTA DE ENTRADA</a></center></td>";	
															}
								else if (($array[$renglones][14]<0)&&($array[$renglones][16]!=NULL)){
																echo "<td>VENTAS</td>";
																echo "<td><center><a href='../Clases/pdf/create_nota_salida_almacen.php?req=".$array[$renglones][19]."' target='_NEW'>NOTA DE SALIDA</a></center></td>";	
														}
														else{
																		echo "<td>VENTAS</td>";
																		echo "<td></td>";												
																				}
			/*				echo "<td class='texto_chico_tabla'><a href=\"javascript:detalle_material(".$array[$renglones][0].")\">Ver</a></td>"; */
							
						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$almacen_material->cuenta_resultado("");
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


<?
//Inicia Pie de Página
piepagina();
?>

