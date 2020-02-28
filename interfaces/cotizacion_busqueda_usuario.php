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
	scripts_head("../Clases/javascript/busqueda_cotizacion_usuario.js");
	
	encabezado();
?>
</DIV>
<div class='categoryboxBIG'>
			<h2>
				<a  href="VENTAS.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Búsqueda-Cotizaciones</h2>
<p></p>
 <form action="generar_reporte_cotizacion.php" method="post"/> 
 <div>Buscar:<INPUT type="text" name="nombre" id="search" onKeyUp="Pagina('1')"><a id="add_cotizacion" href="nueva_cotizacion.php"  title="Registro Usuario">
	<img src='../imagenes/add.png' style="alignment-adjust:middle;"/></A>
 
 <select id="filter" name="filter" default="-1"; onChange="Pagina('1')">
 <option value="-1">Todos</option>
 <option value="0">Borrador</option>
 <option value="1">Por Autorizar</option>
 <option value="2">Enviado</option>
 <option value="3">Cancelado</option>
 <option value="4">No Autorizado</option>
 <option value="5">Autorizado</option>
 <option value="6">Confirmado</option>

 </select> 
 </div>

<DIV id="dialog_instrucciones2" title="Instrucciones: ">
	<TABLE >
    <THEAD>
      <TR>
           
      
        <TH><h1>Paso #1: </h1></TH>
        <TH><h1>Paso #2: </h1></TH>
        
        
      </TR>
    </THEAD>
    <TBODY>
  <td><img src='../imagenes/ventas1.png'  height="400" width="550" /></td>
  <td><img src='../imagenes/ventas3.png'  height="400" width="550" /> </td>
  
    </TBODY>
  </TABLE>
 

</DIV>


</form>
<br>
 <div id="sentencias" class="content">
 <?
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/cotizacion.php");
	
	$link=conect();
	$cotizacion=new Cotizacion();
	$cotizacion->conexion($link);
	$RegistrosAMostrar=40;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$filter=-1;
	$array=$cotizacion->busqueda_parametros_usuario($user, "", $RegistrosAEmpezar, $RegistrosAMostrar, $filter);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
						<thead>
						<tr>
						<th></th>
						<th></th>
						<th>Usuario</th>
      <th>PDF</th>
						<th>Folio</th>
						<th>Estado</th>
						<th>Cliente</th>
						<th>Empresa</th>
						<th>Fecha Modif.</th>
						<th>Fecha Creación</th>
						</tr>
						</thead>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
								if($array[$renglones][1]<=5)
								{
									echo "<td><a class='editCot' href='editar_cotizacion.php?id=".$array[$renglones][0]."' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\" title=\"Editar cotizacion\"/></a></td>";

									echo "<td><a class='delCot' href=\"javascript:eliminar('".$array[$renglones][0]."',1)\" idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar cotizacion\"/></a></td>";
								}
								else 
								{
									echo "<td></td>";
								       echo "<td><a class='cancelCot' href=\"javascript:cancelar('".$array[$renglones][0]."',3)\" idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar cotizacion\"/></a></td>";
								}
        echo "<td>".$array[$renglones][11]."</td>";
								echo "<td><a href='../Clases/pdf/createremision.php?cot=".$array[$renglones][0]."' target='_NEW'>PDF</a></td>";	
								echo "<td><a href='javascript:detalle_cotizacion(".$array[$renglones][0].")'>".$array[$renglones][4]."</a></td>";
								echo "<td>";
								switch($array[$renglones][1])
								{
									case 0: echo "Borrador";break;
									case 1: echo "<a href=\"javascript:cambiar_statusDG({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."'})\">Por Autorizar</a>";break;
									//case 2: echo "<a href=\"javascript:confirmar({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."'})\">Enviado</a>";break;
									case 2: echo "<a href=\"javascript:cambiar_status({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."'})\">Enviado</a>";break;
									case 3: echo "<label style='color:red;'>Cancelado</label>";break;
									case 4: echo "No Autorizado";break;
									case 5: echo "<a href=\"javascript:envio({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."', usuario:'".$user."', contacto:'".$array[$renglones][8]."'})\" alt='Enviar Cotizacion'>Autorizado</a>";break;
									case 6: echo "Confirmado";break;
									case 7: echo "Facturado";break;
									case 8: echo "Pagado";break;
									case 9: echo "Recotizado";break;
								}
								echo "</td>";
								echo "<td><a href=\"javascript:detalle_cliente('".$array[$renglones][2]."')\">".$array[$renglones][9]."</a></td>";
								echo "<td><a href=\"javascript:detalle_empresa(".$array[$renglones][3].")\">".$array[$renglones][10]."</a></td>";
								echo "<td>".$array[$renglones][5]."</td>";
								if($array[$renglones][6]!="")
									echo "<td>".$array[$renglones][6]."</td>";
								else
									echo "<td>No Enviado</td>"; 	
						echo "</tr>";
			 
		}
						echo "</table>";
						$id=0;
						$NroRegistros=$cotizacion->cuenta_resultado_usuario($user, $id, $filter);
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
	$res_sucursalesDG=$sucursal->lista_sucursal();
?>


<DIV id="dialog-status" title="Confirmar Cotización">
  <FORM>
  <FIELDSET>
  	<LABEL style="width:50px;" for="select-status">Estado:</LABEL>
    <SELECT id="select-status"  onChange="habilitar('1')" class='ui-widget' style='max-width:100px;'>
    <option value="6">Aprobado</option>
    <option value="9">No Aprobado</option>
    </SELECT>


   
	<br>
	<br>
	INGRESAR  ORDEN DE COMPRA:
	<br>
	<br>
	<INPUT name="archivo" type="file" id="archivo" required />
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

<DIV id="dialog-statusDG" title="Autorizar">
  <FORM>
  <FIELDSET>
  	<LABEL style="width:50px;" for="select-status">Estado:</LABEL>
    <SELECT id="select-status"  onChange="habilitar('1')" class='ui-widget' style='max-width:100px;'>
    <option value="5">Autorizar</option>
    <option value="4">No Autorizado</option>
    </SELECT>
    	<div id="no_sale_obs">
        <br>
        <LABEL style="width:50px;" for="observaciones">Observaciones:</LABEL>
        <INPUT type="textarea" name="observaciones" id="observaciones" class="text ui-widget-content ui-corner-all" style="width:100px;" maxlength="300" />
    </div>
  </FIELDSET>
  </FORM>
</DIV>
<div id="dialog_mail">
    		</tr>
            </table>
            
    </div>



<div class="clear"></div>


<div class="clear"></div>
 <div id="dialog" title="Información">
 </div>
<?php
//Inicia Pie de Página
piepagina();
?>
