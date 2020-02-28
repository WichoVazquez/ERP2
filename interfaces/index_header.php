<?php

require_once("inicio_pendientes.php");
require_once("../Clases/Conexion/conexion_prueba_local.php");	


function noticias(){


$usuario = $_SESSION["user"];

	$count_noticias = 0;
	


	// COTIZACIONES

	$count_noticias = $count_noticias + cot_sin_aprobar($usuario);

	$count_noticias = $count_noticias + ventas_sin_facturar($usuario);

	//MATERIAL

	// $count_noticias = $count_noticias + mat_sin_stock();

	$count_noticias = $count_noticias + mat_minimo();

	// CLIENTES

	$count_noticias = $count_noticias + prospectos_activos();


	return $count_noticias;

}
function lib_jquery(){
	links_style_head("//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js");
}
function librerias(){

$favicon="favicon_mogel.ico";

echo "
<!DOCTYPE html>
<html lang='es'>
<head>
<meta charset='utf-8'/>
<meta name='description' content='SISTEMA DE ADMINISTRACIÓN MOGEL'>
<title>
  MOGEL    
</title>

<link rel='shortcut icon' href='public/images/".$favicon."'/>";
links_style_head("public/css/navigation.css");
links_style_head("public/css/960.min.css");
links_style_head("public/css/text.css");
links_style_head("public/css/style.css' media='screen");
// links_style_head("http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css");
links_style_head("../Clases/Diseno/jquery-ui.css");
//links_style_head("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css");
//scripts_head("public/js/prefixfree.min.js");
// scripts_head("public/	js/jquery.vticker-min.js");
// scripts_head("public/js/effects.js");
// scripts_head("public/js/functions.js");
//scripts_head("../Clases/jquery/jquery-1.8.2.min.js");
scripts_head("public/js/jquery-1.9.1.js");
scripts_head("public/js/jquery-ui.js");
// scripts_head("../Clases/jquery/js/jquery-1.9.1.js");
// scripts_head("../Clases/jquery/js/jquery-ui-1.10.3.custom.min.js");




}

function librerias_DataT (){
	echo '
		<style type="text/css" title="currentStyle">
			@import "../DataTable/demo_page.css";
			@import "../DataTable/demo_table_jui.css";
			@import "../DataTable/smoothness/jquery-ui-1.8.4.custom.css";
		</style>
		<script type="text/javascript" language="javascript" src="../DataTable/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="../DataTable/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				oTable = $("#example").dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});
				oTable = $("#example2").dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});
				
			} );
		</script>
	';
}
function librerias_dateP(){
	echo'
	
		
		<script src="../Clases/jquery/DatePicker/jquery.ui.core.js"></script>
		<script src="../Clases/jquery/DatePicker/jquery.ui.widget.js"></script>
		<script src="../Clases/jquery/DatePicker/jquery.ui.datepicker.js"></script>
		
		<script>
	$(function() {
		$( "#datepicker" ).datepicker();
		$( "#datepicker2" ).datepicker();
	});
	</script>
	';
}




function lib_shadow(){
	echo" 
	<link href='../Clases/jquery/shadow/shadowbox.css' rel='stylesheet' type='text/css'/>
	<script src='../Clases/jquery/shadow/shadowbox.js' type='text/javascript'/>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
	<script type='text/javascript'>
	Shadowbox.init({
	overlayColor: '#000',
	overlayOpacity: '0.6',
	});
	</script>
";

}



function cotizaciones(){
	
}

function encabezado_login(){
echo "
</head>
<body>
<div id='contentall' class='container_12'>
		<nav class='grid_7 omega'>
				<ul>
						
						<li><a href='login.php?error=3' title='´Salir'></a></li>
				</ul> 
		</nav>





	<header id='grid_header'>
		
						<article class='imagen_logo'>
						<a href='inicio.php' title='MOGEL SA de CV' >
							<img src='public/images/logo.jpg' alt='MOGEL' />
						</a>
						</article>
							</header> 


	<div class='clear'></div>

	<nav id='rolling-nav'>
    <ul>
        <li><a href='CATALOGOS.php' data-clone=''></a></li>


    </ul>
	</nav> "
;}
function encabezado()
{
//*	echo $_SESSION["user"];
echo "
</head>
<body>
<div id='contentall' class='container_12'>
		<nav class='grid_7 omega'>
				<ul>
						
						<li><a href='login.php?error=3' title='´Salir'>Cerrar Sesion</a></li>
				</ul> 
		</nav>





	<header id='grid_header'>
		
						<article class='imagen_logo'>
						<a href='inicio.php' title='MOGEL SA de CV' >
							<img src='public/images/logo.jpg' alt='MOGEL' />
						</a>
						</article>

						<article class='header_nombre'>";
echo $_SESSION["user"];
echo "							
						</article>
					
						<article class='header_news'>
";	
							require_once("index_header.php");
							$noticias = noticias();
								if ($noticias==0)
								echo "<a href='#' title='Notifiaciones' ><img src='public/images/news1.png' alt='Pendientes' /></a>";
								else{
								echo "<a href='inicio.php' title='Notifiaciones' ><img src='public/images/news2.png' alt='Pendientes' /></a>";
								echo $noticias;}
echo "						
						</article>

						<article class='header_perfil'>
							<b> Perfil: </b>".$_SESSION['perfil_nombre']."
						</article>

	</header> 


	<div class='clear'></div>

	<nav id='rolling-nav'>
    <ul>";
    	require("../Clases/Objetos/pantalla.php");
    	$link=conect();
	$pantalla=new PantalLa();
	$pantalla->conexion($link);
	$array=$pantalla->obtiene_menu($_SESSION['perfil']);//$_SESSION["user"]
    
    $cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{
			echo "<li><a href='".$array[$renglones][0]."' data-clone='".$array[$renglones][1]."'>".$array[$renglones][1]."</a></li>";

			
			 
		}

        /*<li><a href='CATALOGOS.php' data-clone='ADMIN'>ADMIN</a></li>
        <li><a href='VENTAS.php' data-clone='Ventas'>Ventas</a></li>
        <li><a href='COMPRAS.php' data-clone='Compras'>Compras</a></li>
        <li><a href='FACTURACION.php' data-clone='Facturación'>Facturación</a></li>
        <li><a href='ALMACEN.php' data-clone='Almacén'>Almacén</a></li>
        <li><a href='TALLER.php' data-clone='Taller'>Taller</a></li>
        <li><a href='CALIDAD.php' data-clone='Calidad'>Calidad</a></li>
        <li><a href='TRAFICO.php' data-clone='Tráfico'>Tráfico</a></li>*/

    echo "</ul>
	</nav>              
     
	<section id='rightbox' class='grid_4'>
		<div class='categorybox'>
";

return null;
}


function piepagina(){

	echo "
		</div>
		</section>
		<div id='dialog' title='Información'></div>
		<footer class='grid_12'>
			<p>&copy; 2014 MOGEL Fluídos, S.A. de C.V., Todos los derechos reservados.::..</p>
		</footer>
		</div> 
		</body>
		</html>
		";
}


function sesiones_start(){
	 if(!isset($_SESSION['user']))
	{
	  require("../Clases/Sesion/checarSesion.php");
	  checarSesion();
	  //checa perfil de usuario
	}
 return $_SESSION['user'];
}


function scripts_head($str_script){
	echo "<script type='text/javascript' src='".$str_script."?v=".filemtime($str_script)."'></script>";
}
function scripts_google($str_script){
	echo "<script type='text/javascript' src='".$str_script."'></script>";
}

function links_style_head($str_link){
	echo "<LINK rel='stylesheet' type='text/css' href='".$str_link."'/>";
}



function encabezado_BIG()
{
//*	echo $_SESSION["user"];
echo "
</head>
<body>
<div id='contentall' class='container_12'>
		<nav class='grid_7 omega'>
				<ul>
						
						<li><a href='login.php?error=3' title='´Salir'>Cerrar Sesion</a></li>
				</ul> 
		</nav>





	<header id='grid_header'>
		
						<article class='imagen_logo'>
						<a href='inicio.php' title='MOGEL SA de CV' >
							<img src='public/images/logo.jpg' alt='MOGEL' />
						</a>
						</article>

						<article class='header_nombre'>";
echo $_SESSION["user"];
echo "							
						</article>
					
						<article class='header_news'>
";	
							require_once("index_header.php");
							$noticias = noticias();
								if ($noticias==0)
								echo "<a href='#' title='Notifiaciones' ><img src='public/images/news1.png' alt='Pendientes' /></a>";
								else{
								echo "<a href='inicio.php' title='Notifiaciones' ><img src='public/images/news2.png' alt='Pendientes' /></a>";
								echo $noticias;}
echo "						
						</article>

						<article class='header_perfil'>
							<b> Perfil: </b>".$_SESSION['perfil_nombre']."
						</article>

	</header> 


	<div class='clear'></div>

	<nav id='rolling-nav'>
    <ul>";
    	require("../Clases/Objetos/pantalla.php");
    	$link=conect();
	$pantalla=new PantalLa();
	$pantalla->conexion($link);
	$array=$pantalla->obtiene_menu($_SESSION['perfil']);//$_SESSION["user"]
    
    $cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{
			echo "<li><a href='".$array[$renglones][0]."' data-clone='".$array[$renglones][1]."'>".$array[$renglones][1]."</a></li>";

			
			 
		}

        /*<li><a href='CATALOGOS.php' data-clone='ADMIN'>ADMIN</a></li>
        <li><a href='VENTAS.php' data-clone='Ventas'>Ventas</a></li>
        <li><a href='COMPRAS.php' data-clone='Compras'>Compras</a></li>
        <li><a href='FACTURACION.php' data-clone='Facturación'>Facturación</a></li>
        <li><a href='ALMACEN.php' data-clone='Almacén'>Almacén</a></li>
        <li><a href='TALLER.php' data-clone='Taller'>Taller</a></li>
        <li><a href='CALIDAD.php' data-clone='Calidad'>Calidad</a></li>
        <li><a href='TRAFICO.php' data-clone='Tráfico'>Tráfico</a></li>*/

    echo "</ul>
	</nav>              
     
	<section id='rightbox' class='grid_4'>
		<div class='categoryboxBIG'>
";
}

function encabezado_test()
{
//*	echo $_SESSION["user"];
echo "
</head>
<body>
<div id='contentall' class='container_12'>
		<nav class='grid_7 omega'>
				<ul>
						
						<li><a href='login.php?error=3' title='´Salir'>Cerrar Sesion</a></li>
				</ul> 
		</nav>





	<header id='grid_header'>
		
						<article class='imagen_logo'>
						<a href='inicio.php' title='MOGEL SA de CV' >
							<img src='public/images/logo.jpg' alt='MOGEL' />
						</a>
						</article>

						<article class='header_nombre'>";
echo $_SESSION["user"];
echo "							
						</article>
					
						<article class='header_news'>
";	
							require_once("index_header.php");
							$noticias = noticias();
								if ($noticias==0)
								echo "<a href='#' title='Notifiaciones' ><img src='public/images/news1.png' alt='Pendientes' /></a>";
								else{
								echo "<a href='inicio.php' title='Notifiaciones' ><img src='public/images/news2.png' alt='Pendientes' /></a>";
								echo $noticias;}
echo "						
						</article>

						<article class='header_perfil'>
								<b> Perfil: </b>".$_SESSION['perfil_nombre']."
						</article>

	</header> 


	<div class='clear'></div>

	<nav id='rolling-nav'>
    <ul>";
    require("../Clases/Objetos/pantalla.php");
    	$link=conect();
	$pantalla=new Pantalla();
	$pantalla->conexion($link);
	$array=$pantalla->obtiene_menu($_SESSION['perfil']);//$_SESSION["user"]
    
    $cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{
			echo "<li><a href='".$array[$renglones][0]."' data-clone='".$array[$renglones][1]."'>".$array[$renglones][1]."</a></li>";

			
			 
		}
       
       /* <li><a href='CATALOGOS.php' data-clone='ADMIN'>ADMIN</a></li>
        <li><a href='VENTAS.php' data-clone='Ventas'>Ventas</a></li>
        <li><a href='COMPRAS.php' data-clone='Compras'>Compras</a></li>
        <li><a href='FACTURACION.php' data-clone='Facturación'>Facturación</a></li>
        <li><a href='ALMACEN.php' data-clone='Almacén'>Almacén</a></li>
        <li><a href='TALLER.php' data-clone='Taller'>Taller</a></li>
        <li><a href='CALIDAD.php' data-clone='Calidad'>Calidad</a></li>
        <li><a href='TRAFICO.php' data-clone='Tráfico'>Tráfico</a></li>*/

 echo "   </ul>
	</nav>              
     
	<section id='rightbox' class='grid_4'>
		<div class='categorybox_test'>
";

return null;
}
?>