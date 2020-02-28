<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	if(isset($_POST['pag'])){
		  $RegistrosAEmpezar=($_POST['pag']-1)*$RegistrosAMostrar;
		  $PagAct=$_POST['pag'];
	
	}else{
		$RegistrosAEmpezar=0;
		$PagAct=1;
	}
if(isset($_POST['filtro'])){
		  $filter=$_POST['filtro'];
	
	}else{
		$filter=-1;
	}
	
	$_POST['search'] = trim($_POST['search']); 
	$id=$_POST['search'];
	require("../Objetos/material.php");
	$material=new Material();
	$material->conexion($link);


	require("../Objetos/almacen_material.php");
	$almacen_material=new Almacen_material();
	$almacen_material->conexion($link);
	
	$array=$almacen_material->busqueda_parametros($id, $RegistrosAEmpezar, $RegistrosAMostrar, $filter);
	
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
					 if($PagAct<$PagUlt) echo " <a onclick=\"Pagina('$PagSig')\" style=\"text-decoration:none;cursor:pointer;\"><img src='../imagenes/next_button.png'/></a> ";
					 
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