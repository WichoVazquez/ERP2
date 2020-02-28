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
	scripts_head("../Clases/javascript/busqueda_req_compras_usuario_auto.js");
	encabezado_BIG();
	echo "<input id='preciobase'  type='hidden'/>";

 echo "<input id='usuario' value='".$user."'/>";
?>	


  <script>
  $(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
  });



  </script>


<h2>
<a  href="ALMACEN.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
	Autorización de Requisiciones de Compras</h2>
<p></p>
 <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')"></A>&nbsp;
 <select id="filter" onChange="Pagina('1')">
 <option value="-1">Todos</option>
 <option value="0">Borrador</option>
 <option value="1">Por Autorizar</option>
 <option value="2">Autorizado</option>
 <option value="3">Cancelado</option>
 </select>
 </div>
 <br>
 <div id="sentencias" class="content">
 <?
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/requisicion_compra.php");
	$link=conect();
	$req_compra=new Req_compra();
	$req_compra->conexion($link);
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$filter=-1;
	$array=$req_compra->busqueda_parametros_usuario($user, "", $RegistrosAEmpezar, $RegistrosAMostrar, $filter);
    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				 <table class='myTable'>
      <th></th>
      <th></th>
      <th>PDF</th>
      <th>Folio</th>
      <th>Estado</th>
      <th>Cliente</th>   
      <th>Usuario</th>  
      <th>Fecha Creación</th>
      <th>Fecha Requerida</th>
      <th>Observaciones</th> 
					";				
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
								echo "<td><a class='editCot' href='nueva_req_compra_edicion.php?id=".$array[$renglones][0]."' idedit='".$array[$renglones][0]."' style='text-decoration:underline;'><img src=\"../imagenes/b_edit.png\" title=\"Editar Orden de Compra\"/></a></td>";

								if($array[$renglones][1]==1)
									echo "<td><a class='delOrd' href=\"javascript:eliminar('".$array[$renglones][0]."',1)\" idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Eliminar Orden\"/></a></td>";
								else
									echo "<td><a class='cancelCot' href=\"javascript:cancelar('".$array[$renglones][0]."',1)\" idedit='".$array[$renglones][0]."' onClick=\'window.parent.refDialog.dialog('close');\' style='text-decoration:underline;'><img src=\"../imagenes/b_drop.png\" title=\"Cancelar Orden\"/></a></td>";

								echo "<td><a href='../Clases/pdf/create_req_compra.php?req=".$array[$renglones][0]."' target='_NEW'>PDF</a></td>";	
         echo "<td>".$array[$renglones][8]."</td>";

								echo "<td>";
								switch($array[$renglones][7])
								{
									case 0: echo "Borrador";break;
									case 1: echo "<a href=\"javascript:cambiar_status({id:'".$array[$renglones][0]."', status:'".$array[$renglones][1]."', usuario_req:'".$array[$renglones][4]."', folio_req:'".$array[$renglones][8]."'})\">Por Autorizar</a>";break;
									case 2: echo "Autorizado";break;
									case 3: echo "Cancelado";break;

								}
								echo "</td>";
								echo "<td>".$array[$renglones][5]."</td>";
								echo "<td>".$array[$renglones][4]."</td>";
								echo "<td>".$array[$renglones][1]."</td>";
								echo "<td>".$array[$renglones][2]."</td>";
								echo "<td>".$array[$renglones][6]."</td>";
						echo "</tr>";
			 
		}
						echo "</table>";
					
					$NroRegistros=$req_compra->cuenta_resultado_usuario($user, $id, $filter);
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

</div>
</section>
<DIV id="dialog-status" title="Ingresar Producto">
  <FORM>
  <FIELDSET>
  	<LABEL style="width:50px;" for="select-status">Estado:</LABEL>
    <SELECT id="select-status"  class='ui-widget' style='max-width:100px;'>
    <option value="2">Autorizar</option>
    <option value="3">No Autorizar</option>
    </SELECT>
    <br>
    <LABEL style="width:50px;" for="observaciones">Observaciones:</LABEL>
    <INPUT type="textarea" name="observaciones" id="observaciones" class="text ui-widget-content ui-corner-all" style="width:100px;" maxlength="300" />
  </FIELDSET>
  </FORM>
</DIV>

<DIV id="dialog-status-compras" title="Ingresar Producto">
  <FORM>
  <FIELDSET>
  	<LABEL style="width:50px;" for="select-status-compras">Estado:</LABEL>
    <SELECT id="select-status-compras"  class='ui-widget' style='max-width:100px;'>
    <option value="7">Autorizar</option>
    <option value="6">Cancelar</option>
    </SELECT>
    <p><LABEL class="ui-widget" for="datepicker"> Fecha de Entrega: <input name="datepicker" type="text" id="datepicker" /></p>
    <br>
    <LABEL style="width:50px;" for="observaciones-compras">Observaciones:</LABEL>
    <INPUT type="textarea" name="observaciones-compras" id="observaciones" class="text ui-widget-content ui-corner-all" style="width:100px;" maxlength="300" />
  </FIELDSET>
  </FORM>
</DIV>

<DIV id="dialog_instrucciones44" title="Instrucciones: ">

<TABLE >
    <THEAD>
      <TR>
           
      
        <TH><h1>Paso Siguiente: </h1></TH>
        
        
      </TR>
    </THEAD>
    <TBODY>
  <td><img src='../imagenes/compras2.png'  height="400" width="550" /></td>
  
    </TBODY>
  </TABLE>

</DIV>



<div class="clear"></div>

<div class="clear"></div>
 <div id="dialog" title="Información">
 </div>
<footer class="grid_12">

	<p>&copy; 2013 Mogel Fluídos, S.A. de C.V., Todos los derechos reservados.::..</p>
</footer>
 </div>
</body>
</html>
