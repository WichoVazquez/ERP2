<?php
require_once('index_header.php');
librerias();
$user=sesiones_start();
encabezado_BIG();
scripts_head('../Clases/javascript/busqueda_pantalla.js');
?>

<?// Inicia Página
if(!isset($_SESSION['user']))
{
  require("../Clases/Sesion/checarSesion.php");
  checarSesion();
  //checa perfil de usuario
}
 $user=$_SESSION['user'];

?>

<h2>
				<a  href="USUARIO.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>

	Catálogo - Pantallas</h2>
<p></p>

 Buscar:<INPUT name="nombre" type="text"  id="search" onKeyUp="Pagina('1')"><a id="add_Empresa" href="pantalla_registro.php"  title="Registro pantalla"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></A></div>
 <div id="sentencias" class="content">

 <br>
 <div id="sentencias" class="content">
 <?php
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
//	require("../Clases/Objetos/pantalla.php");
	$link=conect();
	$pantalla=new Pantalla();
	$pantalla->conexion($link);
	$RegistrosAMostrar=50;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$pantalla->busqueda_parametros("", $RegistrosAEmpezar, $RegistrosAMostrar);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
					<tr>
						<th>ID</th>
						<th>No. Menu</th>
						<th>Nombre</th>
						<th>Descripcion</th>
						<th>Menu Padre</th>
						<th>URL</th>
						<th>Imagen</th>
					</tr>";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
						echo "<tr>";
					//		echo "<td><a class='editScr' href='#' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\"  title=\"Editar Usuario\"/></a></td>";
					//		echo"<td><a class='delScr' href='#' idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar pantalla\"/></a></td>";
							echo "<td>".$array[$renglones][0]."</td>";
							echo "<td>".$array[$renglones][1]."</td>";
							echo "<td>".$array[$renglones][2]."</td>";
							echo "<td>".$array[$renglones][3]."</td>";
							if ($array[$renglones][4] != '')
								echo "<td>".$array[$renglones][4]."</td>";
							else
								echo "<td>Menu</td>";
							echo "<td>".$array[$renglones][5]."</td>";
							echo "<td>".$array[$renglones][6]."</td>";
						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$pantalla->cuenta_resultado("");
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
 <div id="dialog" title="Información">
 </div>
<?php
//Inicia Pie de Página
piepagina();
?>

