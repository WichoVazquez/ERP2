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
	librerias_dateP();
	scripts_head("../Clases/javascript/busqueda_pedido_usuario.js");
	
	encabezado();
?>
</DIV>
<div class='categoryboxBIG'>
			<h2>
				<a  href="VENTAS.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Búsqueda-Pedidos</h2>
<p></p>
 <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')"><a id="add_cotizacion" href="nueva_orden_salida.php"  title="Registro Usuario"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></a>&nbsp;
 <select id="filter" onChange="Pagina('1')">
 <option value="-1">Todos</option>
 <option value="0">Borrador</option>
 <option value="1">Confirmada</option>
 <option value="2">Facturada</option>
 </select>
 </div>
 <br>
 <div id="sentencias" class="content">
 <?
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/pedido.php");
	
	$link=conect();
	$orden_salida=new Pedido();
	$orden_salida->conexion($link);
	$RegistrosAMostrar=60;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$filter=-1;
	$array=$orden_salida->busqueda_parametros_usuario($user, "" , $RegistrosAEmpezar, $RegistrosAMostrar,$filter);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
						<thead>
						<tr>
						<th>Editar</th>
						<th>Borrar</th>
						<th>Detalle</th>
						<th>Empresa</th>
						<th>Folio Pedido</th>
						<th>Folio Cotización</th>
						<th>Cliente</th>
						<th>Fecha Inicial</th>
						<th>Fecha Entrega</th>
						<th>Estado</th>
						</tr>
						</thead>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{

					echo "<tr>";
								if($array[$renglones][11]==0)
								{

									echo "<td><a class='editCot' href='editar_orden_salida.php?id=".$array[$renglones][0]."' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\" title=\"Editar  Orden de Salida\"/></a></td>";

									echo "<td><a class='delCot' href=\"javascript:eliminar('".$array[$renglones][0]."',1)\" idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar Orden de Salida\"/></a></td>";
								}
								else
								{
									echo "<td></td>";
									echo "<td></td>";
								}
							echo "<td><a href='javascript:detalle_pedido(".$array[$renglones][0].")'>DETALLE</a></td>";	
									echo "<td>".$array[$renglones][10]."</td>";	 //EEMPRESA
									echo "<td><center>".$array[$renglones][6]."</center></td>";   //FOLIO ORDEN
									//echo "<td>".$array[$renglones][13]."</td>";   //id COTIZACION
         echo "<td><center><a href='../Clases/pdf/createremision.php?cot=".$array[$renglones][14]."' target='_NEW'>".$array[$renglones][13]."</a></center></td>"; // id cotizacion
									echo "<td>".$array[$renglones][12]."</td>";	 //CLIENTE
									echo "<td>".$array[$renglones][3]."</td>";	 //FECHA INICIO
									echo "<td>".$array[$renglones][4]."</td>";	 //FECHA ENTREGA

								if ($array[$renglones][11]==1){
									echo "<td style='color: red'>";
								switch($array[$renglones][11])
								{

									case 0: echo "Borrador";break;
									case 1: echo "Confirmada";break;
									case 2: echo "Finalizada";break;
								}
								echo "</td>";
				
					       	}else{ 
								echo "<td >";
								switch($array[$renglones][11])
								{

									case 0: echo "Borrador";break;
									case 1: echo "Confirmada";break;
									case 2: echo "Finalizada";break;
								}
								echo "</td>";
							}

						echo "</tr>";
			 
		}
						echo "</table>";
						$id=0;
						$NroRegistros=$orden_salida->cuenta_resultado_usuario($user, $id, $filter);
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
	
 ?>
</div>

<?php
	//require("../Clases/Conexion/conexion_prueba_local.php");
	require("../Clases/Objetos/sucursal.php");
	$sucursal=new Sucursal();
	$sucursal->conexion($link);
	$res_sucursales=$sucursal->lista_sucursal();
?>
 <div id="dialog" title="Información">
 </div>

<DIV id="dialog-status" title="Confirmar Venta">
  <FORM>
  <FIELDSET>
  	<LABEL style="width:50px;" for="select-status">Estado:</LABEL>
    <SELECT id="select-status"  onChange="habilitar('1')" class='ui-widget' style='max-width:100px;'>
    <option value="6">Confirmado</option>
    <option value="9">No Vendido</option>
    </SELECT>
    <div id="datos_pedido">
			<br>
			<LABEL class='ui-widget' for='sucursal'><br><br>Sucursal:</LABEL>
			<?php
				echo $res_sucursales;
				
			?>
			
	</div>
	<div id="no_sale_obs">
        <br>
        <LABEL style="width:50px;" for="observaciones">Observaciones:</LABEL>
        <INPUT type="textarea" name="observaciones" id="observaciones" class="text ui-widget-content ui-corner-all" style="width:100px;" maxlength="300" />
    </div>
	
  </FIELDSET>
  </FORM>
</DIV>
<div id="dialog_mail">
    		<br />
    		<LABEL><strong>Datos Correo Electrónico</strong></LABEL>
            <br />
            <LABEL for="passmail">Contraseña:</LABEL>
            <INPUT type="password" name="passmail" id="passmail" class="text ui-widget-content ui-corner-all"  value=""  style="width:100px;"/>
            <br />
            <table>
            <tr>
            <td valign="top" align="right">
            <LABEL for="msgmail">Mensaje:</LABEL>
            </td>
            <td style="padding-left:15px;">
            <textarea name="msgmail" id="msgmail" class="text ui-widget-content ui-corner-all" style="width:200px; hight:250px;"/></textarea>
            </td>
            </tr>
            </table>
    </div>


<div class="clear"></div>


<?php
//Inicia Pie de Página
piepagina();
?>
