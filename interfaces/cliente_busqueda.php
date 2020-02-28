<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_cliente.js");
	encabezado();
?>
			<h2>
				<a  href="CLIENTE.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Catálogo - Clientes</h2>
<p></p>

 <div>
  <form action="generar_reporte_cliente.php" method="post"/> 
 Buscar:<INPUT type="text" name="nombre" id="search" onKeyUp="Pagina('1')"><a id="add_cliente" href="cliente_registro.php"  title="Registro Cliente"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></A>
</div>
 <br>
 <div id="sentencias" class="content">
 <?
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/cliente.php");
	$link=conect();
	$cliente=new Cliente();
	$cliente->conexion($link);
	$RegistrosAMostrar=40;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$cliente->busqueda_parametros("", $RegistrosAEmpezar, $RegistrosAMostrar);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
					
						<th></th>
						<th></th>
						<th>Clave</th>
						<th>Razón Social</th>
						<th>RFC</th>
						<th>Domiclio</th>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
				echo "<tr>";
							echo "<td><a  class='editCli' href='#' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\"  title=\"Editar Cliente\"/></a></td>";
							echo"<td><a class='delCli' href='#' idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar Cliente\"/></a></td>";
							echo "<td>".$array[$renglones][0]."</td>";
							echo "<td>".$array[$renglones][1]."</td>";
							echo "<td>".$array[$renglones][2]."</td>";
							
							echo "<td><a href=\"javascript:detalle_domicilio(".$array[$renglones][3].")\">Ver</a></td>";
							
						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$cliente->cuenta_resultado("");
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
