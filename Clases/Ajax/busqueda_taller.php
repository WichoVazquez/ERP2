<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$RegistrosAMostrar=40;//esto deberia ser dinamico, tiempo??
	if(isset($_POST['pag'])){
		  $RegistrosAEmpezar=($_POST['pag']-1)*$RegistrosAMostrar;
		  $PagAct=$_POST['pag'];
	
	}else{
		$RegistrosAEmpezar=0;
		$PagAct=1;
	}
	$_POST['search'] = trim($_POST['search']); 
	$search=$_POST['search'];

	require_once("../Objetos/almacen-taller.php");
	$almacen_taller=new Almacen_Taller();
	$almacen_taller->conexion($link);
	
	$array=$resultPedidos=$almacen_taller->result_pedidos_taller($search, $RegistrosAEmpezar, $RegistrosAMostrar);		
	;
	if($array!=null)
	{
	
		echo "	
			
				<table class='myTable' id='pedidos_tabla'>	

  <THEAD>
   <TR>
					<th>Cotización</th>
					<th>Pedido</th>
					<th>CLIENTE</th>
					<th>Fecha de inicio</th>
					<th>Fecha de entrega</th>
					<th>Estado</th>
										 </TR>
 </THEAD>
    <TBODY>
			";
	for($renglones=0; $renglones<count($array);$renglones++)
		{
				echo "<tr>";
							echo "<td>".$array[$renglones][1]."</td>";
							echo "<td>".$array[$renglones][2]."</td>";
							echo "<td>".$array[$renglones][6]."</td>";
							echo "<td>".$array[$renglones][3]."</td>";
							echo "<td>".$array[$renglones][4]."</td>";
							echo "<td>".$array[$renglones][5]."</td>";
						echo "</tr>";	
			 
		}
						echo "</table>";
						$NroRegistros=$almacen_taller->cuenta_resultado($search);
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
		
		