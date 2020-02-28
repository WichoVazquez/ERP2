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
	require("../Objetos/cotizacion.php");
	$link=conect();
	$cotizacion=new Cotizacion();
	$cotizacion->conexion($link);
	$array=$cotizacion->busqueda_parametros($id, $RegistrosAEmpezar, $RegistrosAMostrar);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
						<th>Id.</th>
						<th>Folio</th>
						<th>Estado</th>
						<th>Cliente</th>
						<th>Usuario</th>
						<th>Empresa</th>

						<th>Fecha Modificación</th>
						<th>Fecha Creación</th>
							<th>Fecha Entrega</th>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
								echo "<td><a href='../Clases/pdf/createremision.php?cot=".$array[$renglones][0]."' target='_NEW'>".$array[$renglones][0]."</a></td>";
									echo "<td><a href='javascript:detalle_cotizacion(".$array[$renglones][0].")'>".$array[$renglones][4]."</a></td>";
								echo "<td>";
								switch($array[$renglones][1])
								{
									case 0: echo "Borrador";break;
									case 1: echo "<a href=\"javascript:cambiar_status({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."', usuario:'".$array[$renglones][3]."'})\">Por Autorizar</a>";break;
									//case 2: echo "<a href=\"javascript:confirmar({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."'})\">Enviado</a>";break;
									case 2: echo "Enviado";break;
									case 3: echo "Cancelado";break;
									case 4: echo "<a href=\"javascript:cambiar_status({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."', usuario:'".$array[$renglones][3]."'})\">No Autorizado</a>";break;
									case 5: echo "Autorizado";break;
									case 6: echo "Confirmado";break;
									case 7: echo "Facturado";break;
									case 8: echo "Pagado";break;
								}
								echo "</td>";
								echo "<td><a href='javascript:detalle_cliente(".$array[$renglones][2].")'>Ver</a></td>";
								echo "<td><a href='javascript:detalle_usuario(\"".$array[$renglones][3]."\")'>".$array[$renglones][3]."</a></td>";
					
								echo "<td>".$array[$renglones][5]."</td>";
								echo "<td>".$array[$renglones][6]."</td>";
								if($array[$renglones][7]!="")
									echo "<td>".$array[$renglones][7]."</td>";
								else
									echo "<td>No Enviado</td>"; 	
								echo "<td>".$array[$renglones][8]."</td>";
						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$cotizacion->cuenta_resultado($id);
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
					cursor:pointer;\"><img src='../imagenes/carousel_previous_button.gif'/></a> ";
					 if($PagAct<$PagUlt) echo " <a onclick=\"Pagina('$PagSig')\" style=\"text-decoration:none;cursor:pointer;\"><img src='../imagenes/carousel_next_button.gif'/></a> ";
					 
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