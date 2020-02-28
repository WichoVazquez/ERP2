<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_prospecto.js");
	//scripts_head("../Clases/javascript/busqueda_cliente.js");
	encabezado_BIG();
?>
			<h2>
				<a  href="VENTAS.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Ventas - Prospectos</h2>
<p></p>

 <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')"><a id="add_prospecto" href="prospecto_registro.php"  title="Registro Prospecto"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></A></div>
 <div id="sentencias" class="content">
 <?
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/prospecto.php");
	$link=conect();
	$prospecto=new Prospecto();
	$prospecto->conexion($link);
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$prospecto->busqueda_parametros("", $RegistrosAEmpezar, $RegistrosAMostrar);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
					
						<th></th>
						<th></th>
						<th>Clave</th>
						<th>Prospecto</th>
						<th>Fecha Prospecto</th>
						<th>Carta Presentacion</th>
						<th>Material Multimedia</th>
						<th>Visita Cliente</th>
						<th>Cotización</th>
						<th>Seguimiento</th>

					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
				echo "<tr>";
							echo "<td><a  class='editPros' href='#' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\"  title=\"Editar Prospecto\"/></a></td>";
							echo"<td><a class='delPros' href='#' idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar Prospecto\"/></a></td>";
							echo "<td>".$array[$renglones][0]."</td>";
							echo "<td>".$array[$renglones][1]."</td>";
							echo "<td>".$array[$renglones][2]."</td>";
				for($i=3; $i<7; $i++)
				{
						if ($array[$renglones][$i]==0)
							echo "<td><img src=\"../imagenes/tache10.png\"  title=\"No existe\"/ height=20 with=18></td>";
						else
							echo "<td><img src=\"../imagenes/palomita.gif\"  title=\"Si existe\"/ height=20 with=18></td>";
				}

							echo "<td><a href=\"javascript:detalle_domicilio(".$array[$renglones][3].")\">Ver</a></td>";
							
				echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$prospecto->cuenta_resultado("");
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

