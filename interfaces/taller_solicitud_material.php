<?

 if(!isset($_SESSION['user']))
{
  require("../Clases/Sesion/checarSesion.php");
  checarSesion();
  //checa perfil de usuario
}
 $user=$_SESSION['user'];
 $id=0;

require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/nueva_solicitud_almacen.js");
	encabezado_BIG();
	echo "<input id='preciobase'  type='hidden'/>";


?>	<h2>Búsqueda-Solicitud de Material a Almacén</h2>
<p></p>
 <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')"><a id="add_compra" href="solicitud_materiales.php"  title="Nueva Solicitud de Material"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></A>&nbsp;
 <div id="sentencias" class="content">

<BR>
			
<?php
	require_once("../Clases/Conexion/conexion_prueba_local.php");	
	require_once("../Clases/Objetos/almacen-taller.php");
	$link=conect();
	$almacen_taller=new Almacen_Taller();
	$almacen_taller->conexion($link);
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$resultSolicitudes=$almacen_taller->resultSolicitudes("", $RegistrosAEmpezar, $RegistrosAMostrar);
	;	//echo $;w
	if($array!=null)
	{
	
		echo "	
			
			
		<table class='myTable'>	
	
			<th>Folio</th>
			<th>Fecha de creacion</th>
			<th>Almacen Solicitado</th>
			<th>Detalle</th>
			<th>Status</th>
			";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
				echo"<tr>";
							echo "<td>".$array[$renglones][0]."</td>";
							echo "<td>".$array[$renglones][1]."</td>";
							echo "<td>".$array[$renglones][3]."</td>";
								echo "<td><center><a href=\"javascript:detalleRuta(".$array[$renglones][0].")\">DETALLE</a></center></td>";
							if ($array[$renglones][4]==1)
							echo "<td style='color: red'>Pendiente</td>";
						else
								echo "<td>Surtido</td>";
						

						echo "</tr>";	
						
			 
		}
						echo "</table>";
						$NroRegistros=$almacen_taller->cuenta_resultado("");
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
	
		
		
<?
//Inicia Pie de Página
piepagina();
?>


