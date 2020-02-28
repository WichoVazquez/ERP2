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
	require("../Objetos/cotizacion.php");
	$link=conect();
	$cotizacion=new Cotizacion();
	$cotizacion->conexion($link);
	$array=$cotizacion->busqueda_parametros_usuario($user,$id, $RegistrosAEmpezar, $RegistrosAMostrar, $filter);
    ;
if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
						<thead>
						<tr>
						<th></th>
						<th></th>
						<th>Usuario</th>
      <th>PDF</th>
						<th>Folio</th>
						<th>Estado</th>
						<th>Cliente</th>
						<th>Empresa</th>
						<th>Fecha Modif.</th>
						<th>Fecha Creación</th>
						</tr>
						</thead>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
								if($array[$renglones][1]<=5)
								{
									echo "<td><a class='editCot' href='editar_cotizacion.php?id=".$array[$renglones][0]."' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\" title=\"Editar cotizacion\"/></a></td>";

									echo "<td><a class='delCot' href=\"javascript:eliminar('".$array[$renglones][0]."',1)\" idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar cotizacion\"/></a></td>";
								}
								else 
								{
									echo "<td></td>";
								       echo "<td><a class='cancelCot' href=\"javascript:cancelar('".$array[$renglones][0]."',3)\" idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar cotizacion\"/></a></td>";
								}
        echo "<td>".$array[$renglones][11]."</td>";
								echo "<td><a href='../Clases/pdf/createremision.php?cot=".$array[$renglones][0]."' target='_NEW'>PDF</a></td>";	
								echo "<td><a href='javascript:detalle_cotizacion(".$array[$renglones][0].")'>".$array[$renglones][4]."</a></td>";
								echo "<td>";
								switch($array[$renglones][1])
								{
									case 0: echo "Borrador";break;
									case 1: echo "<a href=\"javascript:cambiar_statusDG({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."'})\">Por Autorizar</a>";break;
									//case 2: echo "<a href=\"javascript:confirmar({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."'})\">Enviado</a>";break;
									case 2: echo "<a href=\"javascript:cambiar_status({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."'})\">Enviado</a>";break;
									case 3: echo "<label style='color:red;'>Cancelado</label>";break;
									case 4: echo "No Autorizado";break;
									case 5: echo "<a href=\"javascript:envio({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."', usuario:'".$user."', contacto:'".$array[$renglones][8]."'})\" alt='Enviar Cotizacion'>Autorizado</a>";break;
									case 6: echo "Confirmado";break;
									case 7: echo "Facturado";break;
									case 8: echo "Pagado";break;
									case 9: echo "Recotizado";break;
								}
								echo "</td>";
								echo "<td><a href=\"javascript:detalle_cliente('".$array[$renglones][2]."')\">".$array[$renglones][9]."</a></td>";
								echo "<td><a href=\"javascript:detalle_empresa(".$array[$renglones][3].")\">".$array[$renglones][10]."</a></td>";
								echo "<td>".$array[$renglones][5]."</td>";
								if($array[$renglones][6]!="")
									echo "<td>".$array[$renglones][6]."</td>";
								else
									echo "<td>No Enviado</td>"; 	
						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$cotizacion->cuenta_resultado_usuario($user,$id, $filter);
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