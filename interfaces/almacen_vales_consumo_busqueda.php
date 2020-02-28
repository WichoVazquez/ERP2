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
	scripts_head("../Clases/javascript/valeConsumo.js");
	encabezado_BIG();
	echo "<input id='preciobase'  type='hidden'/>";


?>	


  <script>
  $(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
  });



  </script>


<h2>
<a  href="SALIDAS.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
	Surtir Vales de Consumo</h2>
<p></p>
 <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')">&nbsp;
 <select id="filter" onChange="Pagina('1')">
 <option value="-1">Todos</option>
 <option value="1">Por Autorizar</option>
 <option value="2">Enviado</option>
 <option value="3">Cancelado</option>
 <option value="4">No Autorizado</option>
 <option value="5">Autorizado</option>
 <option value="6">Confirmado</option>
 </select>
 </div>
 <div id="sentencias" class="content">
 <?
 	require_once("../Clases/Conexion/conexion_prueba_local.php");	
	require_once("../Clases/Objetos/almacen-taller.php");
	$link=conect();
	$almacen_taller=new Almacen_Taller();
	$almacen_taller->conexion($link);
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$resultSolicitudes=$almacen_taller->resultVales("", $RegistrosAEmpezar, $RegistrosAMostrar);
	;	//echo $;
	if($array!=null)
	{
	
		echo "	
			
			
		<table class='myTable'>	
	

			<th>Producto</th>
			<th>Status</th>
			<th>Fecha de creacion</th>
			<th>Cantidad Solicitada</th>
			<th>Almacen Solicitado</th>
			<th>Folio</th>
			";
	for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
								
								echo "<td>".$array[$renglones][6]."</td>";

								echo "<td>";
								switch($array[$renglones][7])
								{
									
									case 0: echo "<a class='editEntrega' href='almacen_surtir_material.php?id=".$array[$renglones][0]."' style='text-decoration:underline;'>Sin Atender</a>";break;
									case 1: echo "<a href=\"javascript:cambiar_status({id:'".$array[$renglones][0]."', status:'".$array[$renglones][7]."'})\">En Proceso</a>";break;
									case 2: echo "Cancelado";break;
									case 3: echo "<a href=\"javascript:cambiar_status({id:'".$array[$renglones][0]."', status:'".$array[$renglones][7]."'})\">Terminado</a>";break;

								}
								echo "</td>";

								echo "<td>".$array[$renglones][1]."</td>";
							    echo "<td>".$array[$renglones][3]."</td>";
								echo "<td>".$array[$renglones][5]."</td>";
								echo "<td>".$array[$renglones][2]."</td>";
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
	
 echo '
</div>




<DIV id="dialog-status" title="Ingresar Producto">
  <FORM>
  <FIELDSET>
  	<LABEL style="width:50px;" for="select-status">Estado:</LABEL>
    <SELECT id="select-status"  class="ui-widget" style="max-width:100px;"">
    <option value="1">En proceso</option>
    <option value="3">Termiando</option>
      <option value="4">Cancelado</option>
    <option value="5">Terminado</option>
    </SELECT>
    <br>

    <LABEL style="width:50px;" for="observaciones">Observaciones:</LABEL>
    <INPUT type="textarea" name="observaciones" id="observaciones" class="text ui-widget-content ui-corner-all" style="width:100px;" maxlength="300" />
  </FIELDSET>
  </FORM>
</DIV>


<div class="clear"></div>
 <div id="dialog" title="Información">
 </div>
';
 ?>

<?
//Inicia Pie de Página
piepagina();
?>

