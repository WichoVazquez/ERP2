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
	scripts_head("../Clases/javascript/busqueda_entrega.js");
	encabezado();
?>
</DIV>

<div class='categoryboxBIG'>
			<h2>
<a  href="TRAFICO.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Búsqueda de Rutas</h2>
<p></p>
 <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')">&nbsp;
 <select id="filter" onChange="Pagina('1')">
 <option value="-1">Todos</option>
 <option value="0">Enrutados</option>
 <option value="2">Entregado</option> 
 </select>
 </div>
 <br>
 <div id="sentencias" class="content">
 <?
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/logistica.php");
	$link=conect();
	$logistica=new Logistica();
	$logistica->conexion($link);
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$filter=-1;
	$array=$logistica->busqueda_parametros_entrega("", $RegistrosAEmpezar, $RegistrosAMostrar, $filter);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
						
						<th>Ruta</th>
						<th>Transporte</th>
						<th>Fecha Creacion</th>
						<th>Estatus</th>						
						<th></th>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
	//				if($array[$renglones][2]  != "Entregado")
	//				{
								echo "<td>".$array[$renglones][0]."</td>";
								echo "<td>".$array[$renglones][1]."  <b>".$array[$renglones][5]."</b></td>";
								echo "<td>".$array[$renglones][4]."</td>";
								echo "<td><a class='editEntrega' href='edicion_entrega_sumario.php?id=".$array[$renglones][0]."&idTransporte1=".$array[$renglones][3]."' style='text-decoration:underline;'>".$array[$renglones][2]."</a></td>";
								echo "<td><a href=\"javascript:detalleRuta(".$array[$renglones][0].")\">Detalle</a></td>";
					
	//				}else
	/*				{
								
								echo "<td>".$array[$renglones][0]."</td>";
								echo "<td>".$array[$renglones][1]."</td>";
								echo "<td>".$array[$renglones][4]."</td>";
								echo "<td>".$array[$renglones][2]."</td>";
								echo "<td><a href=\"javascript:detalleRuta(".$array[$renglones][0].")\">Detalle</a></td>";
						//		echo "<td><a class='editEntrega' href='vista_entrega.php?id=".$array[$renglones][0]."&idTransporte1=".$array[$renglones][3]."' style='text-decoration:underline;'>Detalle</a></td>";
						}		
		*/						
								
								
						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$logistica->cuenta_resultado_entrega( "", $filter);
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


 <div id="dialog_r" title="Información">
 </div>
<?
//Inicia Pie de Página
piepagina();
?>

</div>
</body>
</html>