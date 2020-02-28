<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_precio.js");
	encabezado();
?>
			<h2>
				<a  href="VENTAS.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Catálogo - Precios</h2>
<p></p>
 <div><form action="generar_reporte_precio.php" method="post"/>
  Buscar::<INPUT name="nombre" type="text"  id="search" onKeyUp="Pagina('1')"></div>
 <div id="sentencias" class="content">
 <?
 require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/material.php");
	require_once("../Clases/Objetos/almacen_material.php");
	require_once("../Clases/Objetos/precios.php");
	$link=conect();
	$material=new Material();
	$material->conexion($link);
	$precios=new Precios();
	$precios->conexion($link);
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$precios->busqueda_parametros("", $RegistrosAEmpezar, $RegistrosAMostrar);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
				
						<th></th>
		
						<th>ID</th>
						<th>Material</th>
				
						<th>Precio</th>
						
					";
					$cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
						echo "<td><a  class='editPrecio' href='#' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\"  title=\"Editar Material\"/></a></td>";
	/*					echo"<td style='border:1px solid #333;'><a class='delPrecio' href='#' idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoratio	n:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar Material\"/></a></td>";*/
						echo "<td>".$array[$renglones][0]."</td>";
							echo "<td>".$array[$renglones][1]."</td>";
					//		echo "<td>".$array[$renglones][2]."</td>";
							echo "<td>".$array[$renglones][3]."</td>";
							
			/*				echo "<td><a href=\"javascript:detalle_material(".$array[$renglones][0].")\">Ver</a></td>"; */
							
						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$precios->cuenta_resultado("");
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

