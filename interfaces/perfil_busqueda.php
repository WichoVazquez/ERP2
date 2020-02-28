<?// Inicia Página
 if(!isset($_SESSION['user']))
{
  require("../Clases/Sesion/checarSesion.php");
  checarSesion();
  //checa perfil de usuario
}
 $user=$_SESSION['user'];

require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_perfil.js");
	encabezado_BIG();
?>

<h2>
				<a  href="USUARIO.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>

	Catálogo - Perfiles</h2>
<p></p>
 <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')"> <a id="add_perfil" href="perfil_registro.php"  title="Registro Perfil"   style="text-decoration:none;"><img src='../imagenes/add.png' /></A></div>
 <BR>
 <div id="sentencias" class="content">
 <?
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require("../Clases/Objetos/perfil.php");
	$link=conect();
	$perfil=new Perfil();
	$perfil->conexion($link);
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$perfil->busqueda_parametros("", $RegistrosAEmpezar, $RegistrosAMostrar);
    ;
	if($array!=null){	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
					<tr>
						<th>Editar</th>
						<th>Borrar</th>
					
						<th>Nombre</th>
						<th>Descripción</th>
					</tr>";
		for($renglones=0; $renglones<count($array);$renglones++){	
			echo "<tr>";
				echo "<td><a href='perfil_edicion.php?id=".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\"  title=\"Editar Perfil\"/></a></td>";
				echo "<td><a class='delPer' href='#' idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar perfil\"/></a></td>";
			
				echo "<td>".$array[$renglones][1]."</td>";
				echo "<td>".$array[$renglones][2]."</td>";
			echo "</tr>";

						
		}
		echo "</table>";
		$NroRegistros=$perfil->cuenta_resultado("");
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
		if($PagAct>1) 
			echo "<a onclick=\"Pagina('$PagAnt')\"  style=\"text-decoration:none;cursor:pointer;\"><img src='../images/back_button.png'/></a> ";
		
		if($PagAct<$PagUlt) 
			echo " <a onclick=\"Pagina('$PagSig')\" style=\"text-decoration:none;cursor:pointer;\"><img src='../images/next_button.png'/></a> ";
		 
		echo "<strong>Pagina ".$PagAct." de ".$PagUlt."</strong>&nbsp;";
		echo "<a onclick=\"Pagina('1')\" class=\"link_regreso\" style=\"text-decoration:none;
			cursor:pointer;\">Primero &nbsp;</a> ";
		echo "<a onclick=\"Pagina('$PagUlt')\" class=\"link_regreso\" style=\"text-decoration:none;
		 	cursor:pointer;\">Ultimo &nbsp;</a>";
	}
	else{
		echo "Búsqueda sin Resultados";
	}
	
	
?>
 </div>


 
<?
//Inicia Pie de Página
piepagina();
?>

