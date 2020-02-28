<?// Inicia Página


require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_material_sinstock.js");
	encabezado_BIG();
?>
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
	$array=$almacen_material->busqueda_parametros_sinstock("", $RegistrosAEmpezar, $RegistrosAMostrar, $filter);
	//$prueba=$array[0];
	//print_r($array[0]);
	//var_dump($array[0]);
	?>
			<h2>
<a  href="ALMACEN.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Materiales Sin Stock</h2>
<p></p>

 <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')" > <BUTTON id="generar_orden_compra">GENERAR REQUISICIÓN DE COMPRAS</BUTTON> 
<select id='filter' name='filter' style='width: 200px; max-width:200px;' onChange="Pagina('1')">";

<?
require_once("../Clases/Conexion/conexion_prueba_local.php");	
  require("../Clases/Objetos/almacen.php");
  	$link=conect();
  $almacen=new Almacen();
  $almacen->conexion($link);
    $arraydos=$almacen->detalle_almacen_taller();
    $renglonesdos=0;
    echo "<option value='-1'>Todos</option>";
    for($renglonesdos=0; $renglonesdos<count($arraydos);$renglonesdos++)
      {
        echo "<option value='".$arraydos[$renglonesdos][0]."' almacen_tipo='".$arraydos[$renglonesdos][2]."'>".$arraydos[$renglonesdos][1]."</option>";
      }

         echo   "</select>";

?>
 </div>
 <br>
 <div id="sentencias" class="content">
 <?
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable' id='productos'>
					
						<th></td>

						<th>ID</td>
						<th>Almacen</td>
						<th>Material</td>
						<th>Cantidad</td>
						<th>Stock Mínimo</td>
						
				";
					$cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{
			$prueba=$array[$renglones][0];
					echo "<tr>";
						echo "<td><input type='checkbox' name='checkmaterial' value='".$array[$renglones][0]."' idedit='".$array[$renglones][0]."'></td>";
						echo "<td>".$array[$renglones][0]."</td>";
							echo "<td>".$array[$renglones][1]."</td>";
							echo "<td>".$array[$renglones][2]."</td>";
							echo "<td>".$array[$renglones][3]."</td>";
							echo "<td>".$array[$renglones][4]."</td>";
							
			/*				echo "<td class='texto_chico_tabla'><a href=\"javascript:detalle_material(".$array[$renglones][0].")\">Ver</a></td>"; */
							
						echo "</tr>";
			 
		}
						echo "</table>";

						


						$NroRegistros=$material->cuenta_resultado_sinstock("");
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
