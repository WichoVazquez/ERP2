<?php
require_once('index_header.php');
librerias();
$user=sesiones_start();
encabezado_BIG();
scripts_head('../Clases/javascript/busqueda_operador.js')

?>


			<h2>
				<a  href="TRAFICO.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>


				Catálogo - Operadores</h2>
<p></p>
 <div>

 	Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')"><a id="add_Operador" href="operador_registro.php"  title="Registro operador"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></A></div>
 <div id="sentencias" class="content">
 
 <?php
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/operador.php");
	$link=conect();
	$operador=new Operador();
	$operador->conexion($link);
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$operador->busqueda_parametros("", $RegistrosAEmpezar, $RegistrosAMostrar);
    
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
					
						<th></th>
						<th></th>
						<th>Clave</th>
						<th>Nombre</th>
						<th>Apellido Paterno</th>
						<th>Apellido Materno</th>
						<th>Tipo de permiso</th>
						<th>Numero de Licencia</th>
						<th>Vigencia</th>
					";
		$cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{
						echo "<tr>";
							echo "<td><a  class='editOperad' href='#' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\"  title=\"Editar operador\"/></a></td>";
							echo"<td><a class='delOperad' href='#' idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar operador\"/></a></td>";
							echo "<td>".$array[$renglones][0]."</td>";
							echo "<td>".$array[$renglones][1]."</td>";
							echo "<td>".$array[$renglones][2]."</td>";
							echo "<td>".$array[$renglones][3]."</td>";
							echo "<td>".$array[$renglones][4]."</td>";
							echo "<td>".$array[$renglones][5]."</td>";
							echo "<td>".$array[$renglones][6]."</td>";
							
						 // echo "<td>Ver</td>";
							
						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$operador->cuenta_resultado("");
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



<?php
//Inicia Pie de Página
piepagina();
?>
