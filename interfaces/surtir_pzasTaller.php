<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_material.js");
	//encabezado();
	echo "<input id='usuario' type='hidden' value='".$user."'/>";
?>

<script src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js" type="text/javascript">
</script>
<script type="text/javascript">

    function showCheck() {
        //element = document.getElementById("check_solicitar");
        //check = document.getElementById("bot_ok");
        console.log("EL ID:"+$( "#almacen" ).val());
		 cant = document.getElementById("cantidad");
		 cant_surt = document.getElementById("cantidad_surt");
		 cantidad_dig = document.getElementById("dig_cantidad");
		 idDetallePedido = document.getElementById("pedidoDetalleId");
		 idPedido = document.getElementById("idPedido");
		 idProducto=document.getElementById("idProducto");
		 usuario = document.getElementById("usuario");
		 almacen_id =  $( "#almacen" ).val();
		 result = cant.value-cant_surt.value -  cantidad_dig.value;
		 if(result==0  && cantidad_dig.value!=0)
		 {
					$.ajax({
					type: "POST",
					url: '../Clases/Ajax/registrar_taller_compras.php',
					data: {
						idProducto:idProducto.value,
						idDetPed: idDetallePedido.value,
						cantiadUpd: cantidad_dig.value,
						resultado: "0",
						cantSurtida: cant_surt.value,
						Idpedido: idPedido.value,
						usuario: usuario.value,
						action: "okCompleto",
						almacen: almacen_id},
						success: function( respuesta ){
						alert(respuesta);
						window.parent.location.reload();
						window.parent.Shadowbox.close();
						}
					});
					
			
		 }

		 else {
			if (result<0  || cantidad_dig.value==0){
				alert("Cantidad Invalida, favor de verificar");
			}
			else{
				if(result>=1){
					
					 $.ajax({
					type: "POST",
					url: '../Clases/Ajax/registrar_taller_compras.php',
					data: {
						Idpedido: idPedido.value,
						idProducto:idProducto.value,
						idDetPed: idDetallePedido.value,
						cantiadUpd: cantidad_dig.value,
						resultado: "0",
						cantSurtida: cant_surt.value,
						usuario: usuario.value,
						action: "okIncompleto",
						almacen: almacen_id	},
						success: function( respuesta ){
						alert(respuesta);
						window.parent.location.reload();
						window.parent.Shadowbox.close();
						}
					});
				}
			}
		 }
		 
    }


function habilitaDeshabilita()
{

	element = document.getElementById("datos_compras");
    check = document.getElementById("check_sol");
        if (check.checked) {
            element.style.display='block';
			
        }
        else {
            element.style.display='none';
        }
	
 
}
function guardar_solicitud_compras(){
	almacenId = document.getElementById("almacen");
	usuarioId="usuario1";
	
	productoId=document.getElementById("idProducto");
	cantSolicitada=document.getElementById("cantidadSolicitada");
	observaciones=document.getElementById("obs");
	$.ajax({
		type: "POST",
		url: '../Clases/Ajax/registrar_taller_compras.php',
		data: {
			idAlmacen: almacenId.value,
			idUsuario: usuarioId,
			idProducto: productoId.value ,
			cantidadSol: cantSolicitada.value,
			observ: observaciones.value,
			idPedido: idPedido.value,
			folio: folio.value,

			action: "guardar_solicitud_compras"	},
		success: function( respuesta ){
			alert(respuesta);
		}
	});
	
}

</script>

<?php
	$cantActual=0;
	$idAlmacen2="";
	$idProd=$_GET['var'];
	$cantidad=$_GET['var2'];
	$cantidadSurt=$_GET['var3'];
	$descripcion=$_GET['var4'];
	$almacenes='';//lista de almacenes 
	$almacen_exist='';//lista de almacenes donde hay material del pedido
	$detallePedidoId=$_GET['var5'];
	$Idpedido=$_GET['var6'];
	require_once("../Clases/Conexion/conexion_prueba_local.php");	
	$link=conect();

	

	//lista de almacenes 
	$qry_almacenes = mysql_query("SELECT almacen_id, nombre FROM ALMACEN");
	while($res = mysql_fetch_object($qry_almacenes)){	
		$idAlmacen=$res->almacen_id;
		$nombreAlmacen=$res->nombre;
		$almacenes.='<option value="'.$idAlmacen.'">'.$nombreAlmacen.'</option>';
	}
	
	//lista de almacenes donde hay material del pedido
	
	$qry_almacenes2 = mysql_query("SELECT
					ALMACEN_MATERIAL.almacen_id,
					ALMACEN_MATERIAL.material_id,
					ALMACEN_MATERIAL.cantidad_actual,
					ALMACEN.almacen_id,
					ALMACEN.nombre
					FROM ALMACEN,ALMACEN_MATERIAL     WHERE
					ALMACEN.almacen_id=ALMACEN_MATERIAL.almacen_id");
	
if ($qry_almacenes2)
{
	while($res2 = mysql_fetch_object($qry_almacenes2)){	
		$idAlmacen2=$res2->almacen_id;
		$nombreAlmacen2=$res2->nombre;
	}

	if ($idAlmacen2){

		$qry =mysql_query("SELECT ALMACEN_MATERIAL.cantidad_actual from ALMACEN_MATERIAL WHERE ALMACEN_MATERIAL.material_id like '$idProd' and 
		  ALMACEN_MATERIAL.almacen_id= '$idAlmacen2' ");


		$fetch= mysql_fetch_array($qry);
		$cantActual= $fetch['cantidad_actual'];
	}

}

  
	
	echo '

 
<FORM>
  <FIELDSET>
		<h1 align="left" class="tittle">Producto a Producir </h1>
		  <div id="separa3"></div>  

			  <table width="700" height="55" border="0">
			   <tr>
						<td width="90">Producto:</td>
						<td colspan="3" class="result">'.$descripcion.'</td>
					  </tr>
					  <tr>
		
			  <tr>
				<td width="120">Cantidad de Producto Solicitado:</td>
				<td width="50" class="result">'.$cantidad.'</td>
				<td width="120">Cantidad a Producir:</td>';




			echo '

							<td width="100"><input name="dig_cantidad" id="dig_cantidad" type="text" class="text ui-widget-content ui-corner-all"  width="100" /></td>
							<td width="55"><input type="button" id="bot_ok" name="bot_ok" value="OK" onClick="javascript:showCheck()"></td>
			';



echo '
			  </tr>

			  </tr>
			  <tr>
				<td>Cantidad de Producto Surtido:</td>
				<td class="result">'.$cantidadSurt.'</td>
';

echo '				
				<td></td>
			  </tr>
			  </table>


			  <table>
			  <h1 align="left" class="tittle">Almacén de Envío</h1>
			 <tr>
						<td width="83">Almacen:</td>
						<td width="293"><select name="almacen" id="almacen" size="1">
						  '.$almacenes.'
						</select></td>
					  
					  </tr>
			</table>
				
			
				<input type="hidden" id="cantidad" value="'.$cantidad.'">
				<input type="hidden" id="cantidad_surt" value="'.$cantidadSurt.'">
				<input type="hidden" id="pedidoDetalleId" value="'.$detallePedidoId.'">
				<input type="hidden" id="idProducto" value="'.$idProd.'">
				<input type="hidden" id="idPedido" value="'.$Idpedido.'">
				
				
				<div id="check_solicitar" style="display: none;"  >
				  <input type="checkbox" id="check_sol" name="check_sol" value"0" onchange="javascript:habilitaDeshabilita()"/>
				  Solicitar a Compras
				</div>
				<div  id="datos_compras" style="display: none;">	
					<table width="614" border="0">
					  <tr>
						<td width="90">Producto:</td>
						<td colspan="3" class="result">'.$descripcion.'</td>
					  </tr>
					  <tr>
						<td>Cantidad:</td>
						<td width="126"><input name="cantidadSolicitada" id="cantidadSolicitada" type="text"  class="text ui-widget-content ui-corner-all"  width="100" /></td>
						<td width="83">Almacen:</td>
						<td width="293"><select name="almacen" id="almacen" size="1">
						  '.$almacenes.'
						</select></td>
					  </tr>
					  <tr>
						<td>Observaciones</td>
						<td colspan="3"><textarea name="obs" id="obs" style="width:430px;" maxlength="500" ></textarea></td>
					  </tr>
					  <tr>
						<td colspan="4" align="center"><input type="button" name="bot_guarda_compras" id="bot_guarda_compras" value="Aceptar" onClick="javascript:guardar_solicitud_compras()"></td>
					  </tr>
					</table>
			   </div>
	    </FIELDSET> 
	</FORM>
 
 ';	
	
?>

