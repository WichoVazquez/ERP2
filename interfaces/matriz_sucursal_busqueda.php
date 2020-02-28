<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_sucursal.js");
	encabezado();
?>
			<h2>
				<a  href="CLIENTE.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Catálogo - Lugares de Destinos</h2>
<p></p>

 <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')"><a id="add_sucursal" href="matriz_sucursal_registro.php"  title="Registro Sucursal"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></A></div>
 <div id="sentencias" class="content">
 <?
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/sucursal.php");
	$link=conect();
	$sucursal=new Sucursal();
	$sucursal->conexion($link);
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$sucursal->busqueda_parametros("", $RegistrosAEmpezar, $RegistrosAMostrar);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
					
						<th></th>
						<th></th>
						<th>ID</th>
						<th>Cliente</th>
						<th>Lugar Destino</th>
						<th>Cliente</th>
						<th>Domicilio</th>
						<th>Contacto</th>
				";
					for($renglones=0; $renglones<count($array);$renglones++)
					{
								echo "<tr>";
							echo "<td><a class='editSuc' href='#' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\"  title=\"Editar Sucursal\"/></a></td>";
							echo"<td><a class='delSuc' href='#' idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar producto\"/></a></td>";
							echo "<td>".$array[$renglones][0]."</td>";
							echo "<td>".$array[$renglones][6]."</td>"; //lugares de destino
							echo "<td>".$array[$renglones][2]."</td>";
							echo "<td><a 	href=\"javascript:detalle_cliente('".$array[$renglones][3]."')\">".$array[$renglones][3]."</a></td>";
							echo "<td><a 	href=\"javascript:detalle_domicilio(".$array[$renglones][4].")\">Ver</a></td>";
							echo "<td><a href=\"javascript:detalle_generales(".$array[$renglones][5].")\">Ver</a></td>";
							echo "</tr>";
			 
						}
						echo "</table>";
						$NroRegistros=$sucursal->cuenta_resultado("");
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
