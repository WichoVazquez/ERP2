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
	require("../Objetos/usuario.php");
	$usuario=new Usuario();
	$usuario->conexion($link);
	
	$array=$usuario->busqueda_parametros($id, $RegistrosAEmpezar, $RegistrosAMostrar);
	;
	if($array!=null)
	{	
	 //echo "".count($array);
	 echo "
			<table class='celda-titulo'>
				<tr>
					<th style='color:#FFF; font-size:12px;'></th>
					<th style='color:#FFF; font-size:12px;'>Usuario</th>
					<th style='color:#FFF; font-size:12px;'>Datos</th>
					<th style='color:#FFF; font-size:12px;'>Domicilio</th>
					<th style='color:#FFF; font-size:12px;'>Rol</th>
					<th style='color:#FFF; font-size:12px;'>Estado</th>
					<th style='color:#FFF; font-size:12px;'>Perfil</th>
				</tr>";
	for($renglones=0; $renglones<count($array);$renglones++)
	{
				if($cont==0){ 
					echo "<tr bgcolor='#99CCFF'>";
					$cont++;
				}
				else{
					echo "<tr bgcolor='#FFFAE'>";
					$cont--;
				}
						echo "<td class='texto_chico_tabla'><input type='checkbox'></td>";
						echo "<td class='texto_chico_tabla'>".$array[$renglones][0]."</td>";
						echo "<td class='texto_chico_tabla'><a 	href=\"javascript:detalle_generales(".$array[$renglones][1].")\">Ver</a></td>";
					echo "<td class='texto_chico_tabla'><a href=\"javascript:detalle_domicilio(".$array[$renglones][2].")\">Ver</a></td>";
					echo "<td class='texto_chico_tabla'>";
						echo "<td class='texto_chico_tabla'>";
						switch($array[$renglones][3])
						{
							case 0: echo "Administrador";break;
							case 1: echo "Custodio";break;
							case 2: echo "Usuario";break;
						}
						echo "</td>";
	
						echo "<td class='texto_chico_tabla'>";
						switch($array[$renglones][4])
						{
							case 0: echo "Activo";break;
						}
						echo "</td>";
						echo "<td class='texto_chico_tabla'>";
	
						if($array[$renglones][5]=="0"||$array[$renglones][5]=="1")
						{
							echo "Sin Perfil";
						}
						else
							echo "Ver Perfil";
						echo "</td>";
					echo "</tr>";
		 
	}
					echo "</table>";
					$NroRegistros=$usuario->cuenta_resultado("");
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
					 
					 echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>&nbsp;";
					 echo "<a onclick=\"Pagina('1')\" class=\"link_regreso\" style=\"text-decoration:none;
					 cursor:pointer;\">Primero &nbsp;</a> ";
					 echo "<a onclick=\"Pagina('$PagUlt')\" class=\"link_regreso\" style=\"text-decoration:none;
					 cursor:pointer;\">Ultimo &nbsp;</a>";
	}
			
		
?>