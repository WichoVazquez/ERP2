<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_usuario.js");
	encabezado();
?>

			<h2>
				<a  href="USUARIO.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Catálogo - Usuarios
			</h2>
<p></p>
<form action="generar_reporte_usuario.php" method="post"/> 
 <div>

 	Buscar:<INPUT type="text" name="nombre" id="search" onKeyUp="Pagina('1')"><a id="add_usuario" href="usuario_registro.php"  title="Registro Usuario"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></A>
</div> <div id="sentencias" class="content">
 
<br>


 <?
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/usuario.php");
	$link=conect();
	$usuario=new Usuario();
	$usuario->conexion($link);
	$RegistrosAMostrar=40;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$usuario->busqueda_parametros("", $RegistrosAEmpezar, $RegistrosAMostrar);
	
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
				
						<th></th>
						<th></th>
						<th>Usuario</th>
						<th>Datos</th>
						<th>Domicilio</th>
						<th>Estado</th>
						<th>Perfil</th>
						<th>Clientes</th>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
								echo "<td><a  class='editUsu' href='#' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\"  title=\"Editar Usuario\"/></a></td>";
								echo"<td><a class='delUsu' href='#' idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar producto\"/></a></td>";
								echo "<td>".$array[$renglones][0]."</td>";
								echo "<td><a href='javascript:detalle_generales(".$array[$renglones][1].")'>Ver</a></td>";
								echo "<td><a href=\"javascript:detalle_domicilio(".$array[$renglones][2].")\">Ver</a></td>";

								
							echo "<td>";
							switch($array[$renglones][3])
							{
								case 0: echo "Activo";break;
							}
							echo "</td>";
							echo "<td>";

							if($array[$renglones][4]=="0"||$array[$renglones][4]=="1")
							{
								echo "Sin Perfil";
							}
							else
								echo "<a href=\"javascript:detalle_permisos(".$array[$renglones][4].")\">".$array[$renglones][5]."</a>";



						echo "<td><a href=\"javascript:detalle_clientes_vendedor('".$array[$renglones][0]."')\">Ver</a></td>";
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

