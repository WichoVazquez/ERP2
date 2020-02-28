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
	$_POST['search'] = trim($_POST['search']); 
	$id=$_POST['search'];
	require("../Objetos/proveedor.php");
	$proveedor=new Proveedor();
	$proveedor->conexion($link);
	
	$array=$proveedor->busqueda_parametros($id, $RegistrosAEmpezar, $RegistrosAMostrar);
	
	if($array!=null)
	{	
	 //echo "".count($array);
	 echo "
				<table class='myTable'>
					<tr>
						<th></th>
						<th></th>
						<th>Clave</th>
						<th>Razón Social</th>
						<th>RFC</th>
						
					</tr>";
	$cont;
	for($renglones=0; $renglones<count($array);$renglones++)
	{
		/*		if($cont==0){ 
					echo "<tr bgcolor='#99CCFF'>";
					$cont++;
				}
				else{
					echo "<tr>";
					$cont--;
				}*/
				echo "<tr>";
						echo "<td><a  class='editProv' href=\"javascript:editar('".$array[$renglones][0]."',1)\" idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\"  title=\"Editar Proveedor\"/></a></td>";
							echo"<td><a class='delProv' href=\"javascript:eliminar('".$array[$renglones][0]."',1)\" idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar Proveedor\"/></a></td>";
							echo "<td>".$array[$renglones][0]."</td>";
							echo "<td>".$array[$renglones][1]."</td>";
							echo "<td>".$array[$renglones][2]."</td>";
							
		 
	}
					echo "</table>";
					$NroRegistros=$proveedor->cuenta_resultado("");
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