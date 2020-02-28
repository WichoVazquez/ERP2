<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_empresa.js");
	encabezado();
?>
			<h2>
				<a  href="CATALOGOS.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>

				Catálogo - Empresas</h2>
<p></p>

 <div><form action="generar_reporte_empresas.php" method="post"/>

 Buscar:<INPUT name="nombre" type="text"  id="search" onKeyUp="Pagina('1')"><a id="add_Empresa" href="empresa_registro.php"  title="Registro Empresa"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></A></div>
 <div id="sentencias" class="content">
 <?
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/empresa.php");
	$link=conect();
	$empresa=new empresa();
	$empresa->conexion($link);
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$empresa->busqueda_parametros("", $RegistrosAEmpezar, $RegistrosAMostrar);
    
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
					
						<th></th>
						<th></th>
						<th>Clave</th>
						<th>Razon Social</th>
						<th>RFC</th>
				
					";
		$cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
					$var_emp=$array[$renglones][0]-2;
							echo "<td><a  class='editEmpresa' href='#' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\"  title=\"Editar Empresa\"/></a></td>";
							echo"<td><a class='delEmpresa' href='#' idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar Empresa\"/></a></td>";
							echo "<td>".$var_emp."</td>";
							echo "<td>".$array[$renglones][1]."</td>";
							echo "<td>".$array[$renglones][2]."</td>";
					
							
						 // echo "<td>Ver</td>";
							
						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$empresa->cuenta_resultado("");
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

