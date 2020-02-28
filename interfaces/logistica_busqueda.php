<?

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
	scripts_head("../Clases/javascript/busqueda_ruta.js");
	encabezado();
?>
</DIV>
<div class='categoryboxBIG'>
			<h2>
<a  href="TRAFICO.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Búsqueda-Ruta</h2>
<p></p>
 <form action="generar_reporte_trafico.php" method="post"/> 
 <div>Buscar:<INPUT type="text" name="nombre" id="search" onKeyUp="Pagina('1')"><a id="add_compra" href="nueva_ruta.php"  title="Registro Ruta"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></A>&nbsp;
 <select id="filter" onChange="Pagina('1')">
 <option value="-1">Todos</option>
 <option value="1">Borrador</option>
 <option value="2">En ruta</option>
 <option value="3">Cancelado</option> 
 </select>
 <!--<input type="submit" value="Generar Reporte">-->
 </div>
 <br>
 <div id="sentencias" class="content">
 <?
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/logistica.php");
	$link=conect();
	$logistica=new Logistica();
	$logistica->conexion($link);
	$RegistrosAMostrar=30;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$filter=-1;
	$array=$logistica->busqueda_parametros_usuario("", $RegistrosAEmpezar, $RegistrosAMostrar, $filter);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
						<th></th>
						<th></th>
						<th>Ruta</th>
						<th>Transporte</th>
						<TH>Remolque</th>
						<th>Operador</th>
						<th>Fecha Creación</th>
						<th>Estatus</th>						
						<th>Detalle de la Ruta</th>
						<th>Notas de Salida</th>
						<th>Aviso de Embarque</th>
						<th>Carta Porte</th>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
					if ($array[$renglones][2] != "Cancelado")
					{
								echo "<td><a class='editCot' href='edicion_ruta.php?id=".$array[$renglones][0]."&idTransporte1=".$array[$renglones][5]."&operador=".$array[$renglones][2]."&remolque=".$array[$renglones][7]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\" title=\"Editar Ruta\"/></a></td>";
								echo "<td><a class='delCot' href=\"javascript:eliminar('".$array[$renglones][0]."',1)\" idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Cancelar Ruta\"/></a></td>";
					}
					else
					{
					echo "<td> </td> <td> </td>";
					}			
								echo "<td>".$array[$renglones][0]."</td>";
								echo "<td>".$array[$renglones][1]."</td>";
								echo "<td>".$array[$renglones][6]."</td>";
								echo "<td>".$array[$renglones][2]."</td>";
								echo "<td>".$array[$renglones][3]."</td>";
								echo "<td>".$array[$renglones][4]."</td>";
								echo "<td><center><a href=\"javascript:detalleRuta(".$array[$renglones][0].")\">DETALLE</a></center></td>";
							    echo "<td><center><a href='../Clases/pdf/create_nota_salida.php?req=".$array[$renglones][0]."' target='_NEW'>PDF</a></center></td>";
								echo "<td><center><a href='../Clases/pdf/create_aviso_embarque.php?req=".$array[$renglones][0]."' target='_NEW'>PDF</a></center></td>";
								echo "<td><center><a href='../Clases/pdf/create_carta_porte.php?req=2' target='_NEW'>PDF</a></center></td>";
								echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$logistica->cuenta_resultado_usuario( "", $filter);
					$PagAnt=$PagAct-1;
					$PagSig=$PagAct+1;
					$PagUlt=$NroRegistros/$RegistrosAMostrar;
					$Res=$NroRegistros%$RegistrosAMostrar;

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
</div>


 <div id="dialog" title="Información">
 </div>
<?
//Inicia Pie de Página
piepagina();
?>

