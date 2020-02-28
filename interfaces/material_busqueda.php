<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_material.js");
	encabezado_BIG();
?>
			<h2>
<a  href="ALMACEN.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Catálogo - Materiales</h2>
<p></p>

 <div>
  
 Buscar:<INPUT type="text" name="nombre" id="search" onKeyUp="Pagina('1')"><a id="add_material" href="material_registro.php"  title="Registro Material"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></A>

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
	$array=$almacen_material->busqueda_parametros("", $RegistrosAEmpezar, $RegistrosAMostrar, $filter);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
					
						<th></td>
						<th></td>
						<th>ID</td>

						
						<th>Nombre Comercial</td>
						<th>Descripción</td>
						<th>Unidad</td>
						<th>Existencia</td>
						<th>Presentacion</td>
						<th>Almacén</td>
						
				";
					$cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
						echo "<td><a  class='editMat' href='#' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\"  title=\"Editar Material\"/></a></td>";
						echo"<td><a class='delMat' href='#' idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoratio	n:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar Material\"/></a></td>";
						echo "<td>".$array[$renglones][7]."</td>";
	
							
							echo "<td>".$array[$renglones][2]."</td>";
							echo "<td>".$array[$renglones][4]."</td>";
							echo "<td>".$array[$renglones][10]."</td>";


							echo "<td>".$array[$renglones][3]."</td>";
							echo "<td>".$array[$renglones][11]."</td>";
							echo "<td>".$array[$renglones][1]."</td>";
							
			/*				echo "<td class='texto_chico_tabla'><a href=\"javascript:detalle_material(".$array[$renglones][0].")\">Ver</a></td>"; */
							
						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$material->cuenta_resultado("");
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

