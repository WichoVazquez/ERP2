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
	if(isset($_POST['filter'])){
		  $filter=$_POST['filter'];
	
	}else{
		$filter=-1;
	}
	$_POST['search'] = trim($_POST['search']); 
	$id=$_POST['search'];
	require("../Objetos/laboratorio.php");
	$link=conect();
	$laboratorio=new Laboratorio();
	$laboratorio->conexion($link);					
	$RegistrosAMostrar=40;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	//$filter=-1;
	$array=$laboratorio->busqueda_parametros($id, $RegistrosAEmpezar, $RegistrosAMostrar, $filter);

    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
						<th>No. Orden</th>
						<th>Lote</th>		
						<th>Producto</th>				
						<th>Cantidad de la Muestra</th>				
						<th>Cantidad Analizada</th>
						<th>Usuario Solictante</th>
						<th>Usuario Análisis</th>
						<th>Fecha Solicitud</th>
						<th>Fecha Analisis</th>
						<th>Estado</th>
						<th>PDF</th>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
								echo "<td>".$array[$renglones][0]."</td>";			
								echo "<td>".$array[$renglones][13]."</td>";				
								echo "<td>".$array[$renglones][10]."</td>";	
								echo "<td>".$array[$renglones][3]." ".$array[$renglones][12]."</td>";	
								echo "<td>".$array[$renglones][4]."</td>";
								echo "<td>".$array[$renglones][5]."</td>";
								echo "<td>".$array[$renglones][6]."</td>";
								echo "<td>".$array[$renglones][7]."</td>";
								echo "<td>".$array[$renglones][8]."</td>";
								echo "<td>";

if ($array[$renglones][9]==0)
{
								echo "<a href=\"javascript:cambiar_status({
									id:'".$array[$renglones][0]."', 
									producto:'".$array[$renglones][10]."',
									cantidad_analizar:'".$array[$renglones][3]."', 
									usuario_solicitante:'".$array[$renglones][5]."',
								})\">Pendiente</a>";
								echo "<td></td>";
}
else
{
								echo "Terminado";
							echo "<td><a href='../Clases/pdf/createremision.php?cot=1' target='_NEW'>".$array[$renglones][11]."</a></td>";		
	}
								echo "</td>";

						

						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$laboratorio->cuenta_resultado("");
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
					if($PagAct>1) echo "<a  href='#' onclick=\"Pagina('$PagAnt')\"  style=\"text-decoration:none;
					cursor:pointer;\"><img src='../imagenes/carousel_previous_button.gif'/></a> ";
					 if($PagAct<$PagUlt) echo " <a  href='#' onclick=\"Pagina('$PagSig')\" style=\"text-decoration:none;cursor:pointer;\"><img src='../imagenes/carousel_next_button.gif'/></a> ";
					 
					 echo "<strong>Pagina ".$PagAct." de ".$PagUlt."</strong>&nbsp;";
					 echo "<a onclick=\"Pagina('1')\" class=\"link_regreso\" style=\"text-decoration:none;
					 cursor:pointer;\">Primero &nbsp;</a> ";
					 echo "<a onclick=\"Pagina('$PagUlt')\" class=\"link_regreso\" style=\"text-decoration:none;
					 cursor:pointer;\">Ultimo &nbsp;</a>
					 <br>";
	}
	else
	{
		echo "Búsqueda sin Resultados";
	}
	
?>