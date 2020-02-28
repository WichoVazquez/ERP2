<?

 if(!isset($_SESSION['user']))
{
  require("../Sesion/checarSesion.php");
  checarSesion();
  //checa perfil de usuario
}
 $user=$_SESSION['user'];
 

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
	require_once("../Objetos/pedido.php");
	
	$link=conect();
	$orden_salida=new Pedido();
	$orden_salida->conexion($link);

	$array=$orden_salida->busqueda_parametros_usuario($user, "", $RegistrosAEmpezar, $RegistrosAMostrar, $filter);
    ;
		if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
						<thead>
						<tr>
						<th>Editar</th>
						<th>Borrar</th>
						<th>Detalle</th>
						<th>Empresa</th>
						<th>Folio Pedido</th>
						<th>Folio Cotización</th>
						<th>Cliente</th>
						<th>Fecha Inicial</th>
						<th>Fecha Entrega</th>
						<th>Estado</th>
						</tr>
						</thead>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
								if($array[$renglones][11]==0)
								{

									echo "<td><a class='editCot' href='editar_orden_salida.php?id=".$array[$renglones][0]."' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\" title=\"Editar  Orden de Salida\"/></a></td>";

									echo "<td><a class='delCot' href=\"javascript:eliminar('".$array[$renglones][0]."',1)\" idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar Orden de Salida\"/></a></td>";
								}
								else
								{
									echo "<td></td>";
									echo "<td></td>";
								}
							echo "<td><a href='javascript:detalle_pedido(".$array[$renglones][0].")'>DETALLE</a></td>";	
									echo "<td>".$array[$renglones][10]."</td>";	 //EEMPRESA
									echo "<td><center>".$array[$renglones][6]."</center></td>";   //FOLIO ORDEN
									//echo "<td>".$array[$renglones][13]."</td>";   //id COTIZACION
         echo "<td><center><a href='../Clases/pdf/createremision.php?cot=".$array[$renglones][14]."' target='_NEW'>".$array[$renglones][13]."</a></center></td>"; // id cotizacion
									echo "<td>".$array[$renglones][12]."</td>";	 //CLIENTE
									echo "<td>".$array[$renglones][3]."</td>";	 //FECHA INICIO
									echo "<td>".$array[$renglones][4]."</td>";	 //FECHA ENTREGA

								echo "<td>";
								switch($array[$renglones][11])
								{
									case 0: echo "Borrador";break;
									case 1: echo "Confirmada";break;
									case 2: echo "Facturada";break;
								}
								echo "</td>";


						echo "</tr>";
			 
		}
						echo "</table>";
						$id=0;
						$NroRegistros=$orden_salida->cuenta_resultado_usuario($user, $id, $filter);
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