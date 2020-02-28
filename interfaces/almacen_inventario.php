<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_material_inventario.js");
	encabezado_BIG();
?>
			<h2>
<a  href="ALMACEN.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				INVENTARIO</h2>
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
	$array=$almacen_material->busqueda_parametros("", $RegistrosAEmpezar, $RegistrosAMostrar, $filter);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);	
		 echo "
				<table class='myTable'>
					

						<th>ID</td>

						
						<th>Material</td>
						<th>Descripcion</td>
						<th>Unidad</td>
						<th>Existencia</td>
						<th>Presentacion</td>
						<th>Almacén</td>
						
				";
					$cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{

			if ($array[$renglones][3]<=0){
				echo "<tr style='color: red'>";

						echo "<td >".$array[$renglones][7]."</td>";
	
							
							echo "<td >".$array[$renglones][2]."</td>";
							echo "<td>".$array[$renglones][4]."</td>";
							echo "<td >".$array[$renglones][10]."</td>";
					        	echo "<td > <center >".$array[$renglones][3]." </center></td>";		
					        echo "<td >".$array[$renglones][11]."</td>";
							echo "<td >".$array[$renglones][1]."</td>";
						
							
						echo "</tr>";
					       	}else{ 
					       		echo "<tr>";
					       		echo "<td>".$array[$renglones][7]."</td>";
	
							
							echo "<td>".$array[$renglones][2]."</td>";
							echo "<td>".$array[$renglones][4]."</td>";
							echo "<td>".$array[$renglones][10]."</td>";
					        	echo "<td> <center>".$array[$renglones][3]." </center></td>";
					        echo "<td >".$array[$renglones][11]."</td>";
					        	echo "<td>".$array[$renglones][1]."</td>";
						
							
						echo "</tr>";
}
					/*echo "<tr>";

						echo "<td>".$array[$renglones][0]."</td>";
	
							
							echo "<td>".$array[$renglones][2]."</td>";
							echo "<td>".$array[$renglones][10]."</td>";
							//echo "<td>".$array[$renglones][3]."</td>";
							if ($array[$renglones][3]<=0) 
					        	echo "<td style='color: red'> <center >".$array[$renglones][3]." </center></td>";		
					       	else 
					        	echo "<td> <center>".$array[$renglones][3]." </center></td>";
					        	
							echo "<td>".$array[$renglones][1]."</td>";
						
							
						echo "</tr>";*/
			//}
			 
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

