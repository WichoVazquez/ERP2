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
	$search=$_POST['search'];
	require("../Objetos/logistica.php");
	$link=conect();
	$logistica=new Logistica();
	$logistica->conexion($link);
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
					if($array[$renglones][2]  != "Entregado")
					{
								echo "<td>".$array[$renglones][0]."</td>";
								echo "<td>".$array[$renglones][1]."</td>";
								echo "<td>".$array[$renglones][4]."</td>";
								echo "<td><a class='editEntrega' href='edicion_entrega_SUMARIO.php?id=".$array[$renglones][0]."&idTransporte1=".$array[$renglones][3]."' style='text-decoration:underline;'>".$array[$renglones][2]."</a></td>";
								echo "<td><a href=\"javascript:detalleRuta(".$array[$renglones][0].")\">Detalle</a></td>";
					
					}else
					{
								
								echo "<td>".$array[$renglones][0]."</td>";
								echo "<td>".$array[$renglones][1]."</td>";
								echo "<td>".$array[$renglones][4]."</td>";
								echo "<td>".$array[$renglones][2]."</td>";
								echo "<td><a href=\"javascript:detalleRuta(".$array[$renglones][0].")\">Detalle</a></td>";
						//		echo "<td><a class='editEntrega' href='vista_entrega.php?id=".$array[$renglones][0]."&idTransporte1=".$array[$renglones][3]."' style='text-decoration:underline;'>Detalle</a></td>";
						}		
								
								
								
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