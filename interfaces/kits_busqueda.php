<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="description" content="SISTEMA PROMEX">

<link rel="stylesheet" type="text/css" href="public/css/reset.css"/>


<link rel="stylesheet" type="text/css" href="public/css/960.min.css"/>
<link rel="stylesheet" type="text/css" href="public/css/text.css"/>
<link rel="stylesheet" type="text/css" href="public/css/style.css" media="screen"/> 
<!-- css lightbox 
<link rel="stylesheet" type="text/css" href="public/css/lightbox.css" media="screen" />
<!--  css forms-->
<link rel="stylesheet" type="text/css" href="public/css/zebra_form.css"/>
<link rel="shortcut icon" href="public/images/favicon_prom.png"/>
<link rel="image_src" href="public/images/keyphercom_slogan.png"/>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> -->
<script type="text/javascript" src="public/js/zebra_form.js"></script>
<script type="text/javascript" src="public/js/modernizr.js"></script>
<script src="public/js/prefixfree.min.js"></script>    
<!--<noscript>
<link rel="stylesheet" href="public/css/mobile.min.css" />
</noscript>
<script src="/public/js/resolutions.js"></script>
<script src="/public/js/adapt.min.js"></script>-->
<script type="text/javascript" src="	"></script>
<script type="text/javascript" src="public/js/jquery.vticker-min.js"></script>
<!--<script type="text/javascript" src="public/js/jquery.timer.js" ></script>
<script type="text/javascript" src="public/js/jquery.dwdinanews.0.1.js" ></script>-->
<script type="text/javascript" src="public/js/effects.js" ></script>
<script type="text/javascript" src="public/js/functions.js" ></script>
<script type="text/javascript" src="public/js/googleplus.js" ></script>
<!--Google analitycs codec-->




<link href="../Clases/Diseño/standard_page.css"  rel="stylesheet" type="text/css">
<link href="../Clases/Diseño/fuente_page.css"  rel="stylesheet" type="text/css">
<title>Busqueda Material</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="../Clases/javascript/busqueda_material.js"></script>
</head>
<body>
<div id="contentall" class="container_12">
		<nav class="grid_7 omega">
				<ul>
						<li><a href="/" title="Inicio">Inicio</a></li>
						<li><a href="login.php?error=3" title="´Salir">Cerrar Sesion</a></li>
				</ul> 
		</nav>
	<header class="grid_12">
		<div id="logo" class="suffix_1 grid_4 alpha logo-tabla">
<table>
	<th>
			<h1>
				<a href="/" title="MOGEL FLUÍDOS SA de CV" >
					<img src="public/images/logo.png" alt="PROMEX" />
				</a>
			</h1>
	</th>
	<th>
	</th>
</table>
</div>	
	</header> 
	<div class="clear"></div>
	<section class="pagetitle grid_12">
			<ul>
						<li><a href="CATALOGOS.php" title="Inicio" class="active">CATÁLOGOS</a></li>
						<li><a href="/" title="VENTAS">VENTAS</a></li>
						<li><a href="/" title="COMPRAS">COMPRAS</a></li>
						<li><a href="/" title="ALMACEN">ALMACEN</a></li>
						<li><a href="/" title="FACTURACION">FACTURACION</a></li>
						<li><a href="/" title="REPORTES">REPORTES</a></li>
				</ul> 
	</section>                    

	<section id="rightbox" class="grid_4">
		<div class="categorybox">
			<h2>Catálogo - Materiales</h2>
<p></p>

 <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')"><a id="add_material" href="material_registro.php"  title="Registro Material"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></A></div>
 <div id="sentencias" class="content">
 <?
 require("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/material.php");
	require_once("../Clases/Objetos/almacen_material.php");
	$link=conect();
	$material=new Material();
	$material->conexion($link);
	$almacen_material=new Almacen_material();
	$almacen_material->conexion($link);
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$almacen_material->busqueda_parametros("", $RegistrosAEmpezar, $RegistrosAMostrar);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
					
						<th></td>
						<th></td>
						<th>ID</td>
						<th>Almacen</td>
						<th>Material</td>
						<th>Cantidad</td>
						
				";
					$cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
						echo "<td><a  class='editMat' href='#' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\"  title=\"Editar Material\"/></a></td>";
						echo"<td><a class='delMat' href='#' idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoratio	n:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar Material\"/></a></td>";
						echo "<td>".$array[$renglones][0]."</td>";
							echo "<td>".$array[$renglones][1]."</td>";
							echo "<td>".$array[$renglones][2]."</td>";
							echo "<td>".$array[$renglones][3]."</td>";
							
			/*				echo "<td class='texto_chico_tabla'><a href=\"javascript:detalle_material(".$array[$renglones][0].")\">Ver</a></td>"; */
							
						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$material->cuenta_resultado("");
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


</div>
</section>

<div class="clear"></div>

<div class="clear"></div>

<?
//Inicia Pie de Página
piepagina();
?>
