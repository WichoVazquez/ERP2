

var no_orden;
var cambios=false;
var agregados="";
var cantidad;
var tipo_pedido = "";
var guardar_tipo= "";
	var idRuta=0;
	var id_orden_sumario=0;
	var tipo_ordensalida = 0;

//var 


function objetoAjax(){
 if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
  return xmlhttp;
}

function selectTransporte(sel)
{
	var transporte_id=$("#transporte").val();

	if(transporte_id!="-1")
	{
		CreaRutaSumario(); //Iniciamos todo
		$("#transporte").attr('disabled','disabled');
		$("#id_ruta").attr('disabled','disabled');
		$("#operador_ruta").attr('disabled', 'disabled');
	}

}

function saveOrden(str) // esta funcion es para cuando pasará de Status 3-4 y de 7-8
{	
var arr={
	proveedor: str,
	usuario: $("#usuario").val(),
	orden_observaciones: $("#orden_mensaje").val()
	};
hilo=$.post(
		 '../Clases/Ajax/crear_ordencompra.php',
		 JSON.stringify(arr),
		 function(msg) {
			no_orden=$.trim(msg);
			//console.log(no_orden);
			$("#orden").val(msg);
			console.log("Creo la Compra y la carpeta de archivos"+msg);
		}
		);

}

$(function() {



  	 $('#Mostrar_todo').show();
  	 
  	 $('#orders-contain-ruta').hide();

  	 $('#guardar-ruta').hide();
  	 $('#imprime-ruta').hide();
  	 $('#cancelar-ruta').hide();

$( '#dialog' ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "Fadeout",
        duration: 1000
      },
	  width: 900,
      height: 400,
	  overlay: {
                    opacity: 0.5,
					
                    background: "white"
					
      }
	  
	  
	}).width(700).height(400).css("background", "#ffffff");

			$('#guardar-ruta')
			.button()
			   .click(function() {

			var OEvacias = 1;

   for(x=($('#Orden1_ruta >tbody >tr').length)-1;x>-1;x--){

				  		var arr={
						accion: "actualizarOERuta",
						idRutaDetalle: $("#Orden1_ruta >tbody >tr").eq(x).find("input[type=checkbox]").val(),
						folioOE: $("#Orden1_ruta >tbody >tr").eq(x).find("input[type=text]").val()

						};

						hilo=$.post(
							 '../Clases/Ajax/add_ruta.php',
							 JSON.stringify(arr),
							 function(msg) {
								var mensajin=$.trim(msg);
								console.log("#guardar-ruta: "+mensajin);
							});

				  
			}
			


				
						var arr={
						accion: "actualizarRuta", 
						idRuta: $("#id_ruta").val(),
						estatus: 1
						};

						hilo=$.post(
							 '../Clases/Ajax/add_ruta.php',
							 JSON.stringify(arr),
							 function(msg) {
								var mensajin=$.trim(msg);
								console.log("#guardar-ruta: "+mensajin);
							}

							);
							alert("Se guardó satisfactiamente la Ruta");
				   window.location.href = 'logistica_busqueda.php';
							$('#imprime-ruta').show();
							
				


			      });

			$('#imprime-ruta')
			.button()
			      .click(function() {

												

										 $('#imprime-ruta').show();

			      });

			$('#cancelar-ruta')
			.button()
			      .click(function() {

												

				window.location.href = 'logistica_busqueda.php';
										

			      });

   $("#inicio_ruta")
      .button()
      .click(function() {

			//$('#orders-contain-ruta').show();
if ($("#operador_ruta").val()==0 || $("#transporte").val()==0)	
	alert("Seleccione Transporte y Transportista para continuar");
	else		
			{

				CreaRutaSumario();
										$("#transporte").attr('disabled','disabled');
										$("#operador").attr('disabled','disabled');
										$("#id_ruta").attr('disabled','disabled');
										$("#operador_ruta").attr('disabled','disabled');
										 $("#inicio_ruta").hide();
			
										 $('#orders-contain-ruta').show();
			}


      });


	 $('.detalleorden').click(function(e) {
	 	e.preventDefault();


	 	Detalle_Ordenes($(this),0);
	 
	 });

	 	 $('.detalleembarque').click(function(e) {
	 	
	 });
	
	   $('#agregar-orden').show();//boton Agregar escondido
	  $('#agregar-recoleccion').show();//boton Agregar escondido
	   $('#editar-orden').show();//boton Agregar escondido
	   
	   if(cambios)
	   {
	   $('#quitar-orden').show();//boton Quitar escondido
	      $('#divguardar').show();
	   $('#orders-contain').show();
	   }else
	   {
		   
	  $('#quitar-orden').hide();//boton Quitar escondido
	      $('#divguardar').hide();
	   $('#orders-contain').hide();
	   }
		
		validarTabla();
	

    $( "#dialog" ).dialog({
      autoOpen: false,
      height: 400,
      width: 950,
      modal: true,
      buttons: {
        
        "Cancelar": function() {
					  	$( this ).dialog( "close" );
					
					}
      },
      close: function() {
       // allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });


    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 950,
      modal: true,
      buttons: {
        "Agregar": function() 
					{
						if ($("#operador_ruta").val()==0 || $("#transporte").val()==0)	
									alert("Seleccione Transporte y Transportista para continuar");
						else
					{							

								if ($("#id_ruta").val()==0)
								{

									var arr={
														accion: "guardarRuta", 
														transporte: $("#transporte").val(),
														operador: $("#operador_ruta").val(),
														operador: $("#operador").val(),
														remolque: $("#remolque").val()
													}

												
													hilo=$.post(
														 '../Clases/Ajax/add_ruta.php',
														 JSON.stringify(arr),
														 function(msg) {
															var message=$.trim(msg);
														//window.location.href = 'LOGISTICA.php';
															idRuta= message;
															console.log("EL  IDRUTA"+idRuta);
															$("#id_ruta").val(idRuta);
															$("#transporte").attr('disabled','disabled');
															$("#id_ruta").attr('disabled','disabled');
															$("#operador_ruta").attr('disabled','disabled');
															$("#operador").attr('disabled','disabled');
															$("#remolque").attr('disabled','disabled');
										 				$("#inicio_ruta").hide();		
										 				$('#orders-contain-ruta').show();
														});	
											hilo.done(function(){

															console.log("ya entre a ver que pes");
															var pos	=0;
															agregados="|";
																for(x=($('#Orden >tbody >tr').length)-1;x>-1;x--)
																{
																	console.log("La mugre busqueda:"+$("#Orden >tbody >tr").eq(x).find("input[type=checkbox]").val());
																	if($("#Orden >tbody >tr input:checkbox")[x].checked)
																		   {
																			   	console.log("ya entre a este otro......");
																							Crear_RutaDetalle();
																			} // If is checked
																} // del for
														if (ValidadOrden_Tabla()==0)
																ImprimeRegistroRuta();
															});
												$( this ).dialog( "close" );

								}

								else

								{
												console.log("debe salvar producto: "+$("#id_ruta").val());
													saveOrden($( this ));
															 $( this ).dialog( "close" );
															}
							 }
						
					}
		,
        "Cancelar": function() {
					  	$( this ).dialog( "close" );
						validarTabla();
					}
      },
      close: function() {
       // allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });


        $( "#dialog-form-recoleccion" ).dialog({
      autoOpen: false,
      height: 400,
      width: 950,
      modal: true,
      buttons: {
        "Agregar": function() 
					{
						
	if ($("#operador_ruta").val()==0 || $("#transporte").val()==0)	
									alert("Seleccione Transporte y Transportista para continuar");
						else
					{							

								if ($("#id_ruta").val()==0)
								{
													var arr={
														accion: "guardarRuta", 
														transporte: $("#transporte").val(),
														operador: $("#operador_ruta").val()
													}
														hilo=$.post(
														 '../Clases/Ajax/add_ruta.php',
														 JSON.stringify(arr),
														 function(msg) {
															var message=$.trim(msg);

															idRuta= message;
															console.log("EL  IDRUTA"+idRuta);
															$("#id_ruta").val(idRuta);
															$("#transporte").attr('disabled','disabled');
															$("#id_ruta").attr('disabled','disabled');
															$("#operador_ruta").attr('disabled','disabled');
										 				$("#inicio_ruta").hide();		
										 				$('#orders-contain-ruta').show();
														});	
											hilo.done(function(){
												console.log("ya entre a ver que pes");
												var pos	=0;
												agregados="|";
													for(x=($('#Orden-recoleccion >tbody >tr').length)-1;x>-1;x--)
													{
														console.log("La mugre busqueda:"+$("#Orden-recoleccion >tbody >tr").eq(x).find("input[type=checkbox]").val());
														if($("#Orden-recoleccion >tbody >tr input:checkbox")[x].checked)
															   {
															   	console.log("ya entre a este otro......");
																			Crear_RutaDetalle();
																			} // If is checked

														} // del for

													ImprimeRegistroRuta();

											});

												$( this ).dialog( "close" );
								}
								else

							{								
								console.log("debe salvar producto recoleccion");
								saveOrden_recoleccion($( this ));
							 $( this ).dialog( "close" );
							}
						
					}

				}
		,
        "Cancelar": function() {
					  	$( this ).dialog( "close" );
						validarTabla();
					}
      },
      close: function() {
       // allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 	
	
      $("#agregar-orden")
      .button()
      .click(function() {
					  
			var arr1={
			accion: "obtenerOrden",
			}
			
					
					$("#Orden tbody").empty();
					
						
			hilo=$.post(
				 '../Clases/Ajax/add_ruta.php',
				 JSON.stringify(arr1),
				 function(msg) {
					var message=msg;
				
				var aDetalle = JSON.parse( message );
					var checked;

					if(aDetalle != null)
					{
						for(x=0;x<(aDetalle.length);x++){
				
						   if (agregados != "" && agregados.indexOf("|"+aDetalle[x][0]+".")!=-1)
						   {
								cantidad= agregados.substring(agregados.indexOf("|"+aDetalle[x][0]+".")+aDetalle[x][0].length+2,agregados.indexOf("|",agregados.indexOf("|"+aDetalle[x][0]+".")+aDetalle[x][0].length+2));



								checked="checked";
						   }else{
								cantidad=0;
								checked="";
						   }
						   
						   tipo_pedido = "Entregar";



						   $( "#Orden tbody" ).append( "<tr>" +
						  "<td><input type='checkbox' value='"+ aDetalle[x][0] + "' "+ checked +"></td>" +
						  "<td><b>" +  tipo_pedido + "</b></td>" +
						  "<td>" +  aDetalle[x][1]+ "</td>" +
						  "<td>" +  aDetalle[x][2] + "</td>" +
						  "<td>" + aDetalle[x][3] + "</td>" +					  
						  "<td>" + aDetalle[x][4] + "</td>" +				
						  "<td>"+ aDetalle[x][9] +  "</td>" +	  
						  "<td>"+ aDetalle[x][5] +  "</td>" +	 
						   "<td>"+ " <input type='text' name='enr"+x+"' id='enr"+x+"' value='"+aDetalle[x][10] +"' size='5'  onkeypress=\"return NumEntero(event)\" />" +  "</td>" +
						"</tr>" );


						   
		  				}
						
										
						$( "#dialog-form" ).dialog( "open" );
						
					}else
					{ alert("No existen Ordenes de Salida para asignar");
					}
							
				}
			);	
		
        
		
      });
	  
      $("#agregar-recoleccion")
      .button()
      .click(function() {
					  
			var arr1={
			accion: "obtenerRecoleccion"
			}
			
					
					$("#Orden tbody").empty();
					
						
			hilo=$.post(
				 '../Clases/Ajax/add_ruta.php',
				 JSON.stringify(arr1),
				 function(msg) {
					var message=msg;
				
					var aDetalle = JSON.parse( message );
					var checked;

					if(aDetalle != null)
					{
						for(x=0;x<(aDetalle.length);x++){
				
						   if (agregados != "" && agregados.indexOf("|"+aDetalle[x][0]+".")!=-1)
						   {
								cantidad= agregados.substring(agregados.indexOf("|"+aDetalle[x][0]+".")+aDetalle[x][0].length+2,agregados.indexOf("|",agregados.indexOf("|"+aDetalle[x][0]+".")+aDetalle[x][0].length+2));
								checked="checked";
						   }else{
								cantidad=0;
								checked="checked";
						   }
						   
						   tipo_pedido = "Recoger";

						   $( "#Orden tbody" ).append( "<tr>" +
						  "<td><input type='checkbox' value='"+ aDetalle[x][0] + "' "+ checked +"></td>" +
						  "<td><b>" +  tipo_pedido + "</b></td>" +
						  "<td>" +  aDetalle[x][1]+ "</td>" +
						  "<td>" +  aDetalle[x][2] + "</td>" +
						  "<td>" + aDetalle[x][3] + "</td>" +					  
						  "<td>"+ aDetalle[x][9] +  "</td>" +	  
						  "<td>"+ aDetalle[x][5] +  "</td>" +	 
						   "<td>"+ " <input type='text' name='enr"+x+"' id='enr"+x+"' value='"+aDetalle[x][10] +"' size='5'  onkeypress=\"return NumEntero(event)\" />" +  "</td>" +
						"</tr>" );
						   
		  				}
						
										
						$( "#dialog-form" ).dialog( "open" );
						
					}else
					{ alert("No existen Recolecciones a asignar");
					}
							
				}
			);	
		
        
		
      });


	  
	$("#quitar-orden" )
      .button()
      .click(function() {
      	for(x=($('#Orden1_ruta >tbody >tr').length)-1;x>-1;x--){
			
				var isChecked = $("#Orden1_ruta >tbody >tr input:checkbox")[x].checked;
				
				   if(isChecked)
				   {
					
					 
					agregados= agregados.replace("|"+$("#Orden1_ruta >tbody >tr").eq(x).find("input[type=checkbox]").val()+"."+$("#Orden1_ruta >tbody >tr").eq(x).find("td").eq(6).html()+"|","|");
				
					 $('#Orden1_ruta >tbody >tr').eq(x).remove();
					 //borrar producto de base de datos DETALLE-COTIZACION
				   }
			}
						  
      validarTabla();
      });
	  
	

	 
	  $("#guardar-orden")
      .button()
      .click(function() {
		
												if($("#transporte").val()>0)
												{
															  
															  
													var arr={
														accion: "guardarRuta", 
														transporte: $("#transporte").val() 
													}
															 
													var idRuta;
												
													hilo=$.post(
														 '../Clases/Ajax/add_ruta.php',
														 JSON.stringify(arr),
														 function(msg) {
															var message=$.trim(msg);
														//window.location.href = 'LOGISTICA.php';
															idRuta= message;
														}
													);	
															
													hilo.done(	
																
																function(){
																	
																	for(x=($('#Orden1 >tbody >tr').length)-1;x>-1;x--)


																	{
																	


																			if ($("#Orden >tbody >tr").eq(x).find("td").eq(1).html()=='<b>Recoger</b>')
																			{

																							guardar_tipo = "guardarDetalle_recoleccion";

																					}
																			else{

																							guardar_tipo = "guardarDetalle";
																			}

																		console.log("tipo :"+guardar_tipo);


																		console.log("Por que no entra aqui esta cosa?"+idRuta+"otra :"+$("#Orden1 >tbody >tr").eq(x).find("input[type=checkbox]").val()+"y otra más:"+$("#Orden1 >tbody >tr").eq(x).find("input[type=text]").val());


																		var arr1={
																		accion: guardar_tipo, 
																		idRuta: idRuta,
																		idPedido:$("#Orden1 >tbody >tr").eq(x).find("input[type=checkbox]").val(),
																		Cantidad:$("#Orden1 >tbody >tr").eq(x).find("input[type=text]").val()
																		}
																		
																		hilo=$.post(
																			 '../Clases/Ajax/add_ruta.php',
																			 JSON.stringify(arr1),
																			 function(msg) {
																				var message=$.trim(msg);

																				if(x==-1)
																				window.location.href = 'logistica_busqueda.php';
																				
																			}
																			);	
																	
																	}
																	
																//	--
																	
																}

	
																); 
															  }
															  else
															  {
																  alert('Falta elegir transporte');
															  }
											});
															 
	  });
  
  
/*function GuardarRuta(){
	
	alert($("#transporte").val() );
			 var arr={
				accion: "guardarRuta", 
				transporte: $("#transporte").val() 
			}
					 
	
		
			 hilo=$.post(
				 '../Clases/Ajax/add_ruta.php',
				 JSON.stringify(arr),
				 function(msg) {
					var message=$.trim(msg);
				window.location.href = 'logistica_busqueda.php';
					return message;
					
				}
			);	
}*/
  
  
  


function validarTabla()
{
	//alert($('#productos >tbody >tr').length);
			if($('#Orden1 >tbody >tr').length==0)
      	{
      		$("#orders-contain").hide();
      	
      		$("#divguardar").hide();
      	}
      	else
      	{
								$("#orders-contain").show();
      
      		$("#divguardar").show();
		}
}

function saveOrden(varia){
	

	$('#orders-contain-ruta').show();			
//		$("#Orden1 tbody").empty();
	console.log("ya entre a ver que pes");
	var pos	=0;
	agregados="|";
		for(x=($('#Orden >tbody >tr').length)-1;x>-1;x--)
		{
			console.log("La mugre busqueda:"+$("#Orden >tbody >tr").eq(x).find("input[type=checkbox]").val());
			if($("#Orden >tbody >tr input:checkbox")[x].checked)
				   {
					   	console.log("ya entre a este otro......");
						Crear_RutaDetalle();
					} // If is checked

		} // del for


if (ValidadOrden_Tabla()==0)
		ImprimeRegistroRuta();

	
} // fncion
function saveOrden_recoleccion(varia){
	

	$('#orders-contain-ruta').show();			
//		$("#Orden1 tbody").empty();
	console.log("ya entre a ver que pes");
	var pos	=0;
	agregados="|";
		for(x=($('#Orden-recoleccion >tbody >tr').length)-1;x>-1;x--)
		{
			console.log("La mugre busqueda:"+$("#Orden-recoleccion >tbody >tr").eq(x).find("input[type=checkbox]").val());
			if($("#Orden-recoleccion >tbody >tr input:checkbox")[x].checked)
				   {
					   	console.log("ya entre a este otro......");
									Crear_RutaDetalle();
					} // If is checked

		} // del for
//if (ValidadOrden_Tabla()==0)
		ImprimeRegistroRuta();
	
} // fncion

function CreaRutaSumario()
{
													var arr={
														accion: "guardarRuta", 
														transporte: $("#transporte").val(),
														operador: $("#operador_ruta").val(),
														remolque: $("#remolque").val()
													}

												
													hilo=$.post(
														 '../Clases/Ajax/add_ruta.php',
														 JSON.stringify(arr),
														 function(msg) {
															var message=$.trim(msg);
														//window.location.href = 'LOGISTICA.php';
															idRuta= message;
															console.log("EL  IDRUTA"+idRuta);
															$("#id_ruta").val(idRuta);
														}
													);	

}




function Crear_RutaDetalle(){

var accion_temp="";
var id_pedido = "";
var candidad_pedido = "";
console.log("TIPO DE ORDEN GRABA DETALLLE: "+tipo_ordensalida);
if (tipo_ordensalida==1)
{
		accion_temp = "guardarDetalle";
		id_pedido = $("#Orden >tbody >tr").eq(x).find("input[type=checkbox]").val();
		candidad_pedido = $("#Orden >tbody >tr").eq(x).find("input[type=text]").val();
}
	else
{
		accion_temp = "guardarDetalle_recoleccion"; 
		id_pedido = $("#Orden-recoleccion >tbody >tr").eq(x).find("input[type=checkbox]").val();
		candidad_pedido = $("#Orden-recoleccion >tbody >tr").eq(x).find("input[type=text]").val();
}

console.log("VER QUE TIENE ESTO:"+$("#Orden >tbody >tr").eq(x).find("input[type=checkbox]").val());

console.log("VER QUE TIENE ESTO RECOLECCION:"+id_pedido+" la cantidad: "+candidad_pedido+" LA RUTA: "+$("#id_ruta").val());

	var arr1={
		accion: accion_temp, 
		idRuta: $("#id_ruta").val(),
		idPedido:id_pedido,
		Cantidad:candidad_pedido,
		tipo_orden: tipo_ordensalida 
			}
																	
		hilo=$.post(
			'../Clases/Ajax/add_ruta.php',
			JSON.stringify(arr1),
			function(msg) {
				var message=$.trim(msg);
				console.log("LLEGUE AL FINAL"+message);
			} // JSON
	);	

		$('#orders-contain-ruta').show();
}


function ImprimeRegistroRuta()

{
$('#guardar-ruta').show();
$('#cancelar-ruta').show();
$('#quitar-orden').show();

var recoleccionOE = "style='opacity:0; position:absolute; left:9999px;'";

	var arr2={
			accion: "obtenerRutas", 
				idPedido: id_orden_sumario
			}
																	
				hilo=$.post(
		 '../Clases/Ajax/add_ruta.php',
		 JSON.stringify(arr2),
			 function(msg) {
						var message=msg;
				var aDetalle = JSON.parse( message );
							var checked;
console.log("segun hasta aqui llega");
						if(aDetalle != null)
							{
										for(x=0;x<(aDetalle.length);x++){
																							// termina funcion loca acá no ma
										var fecha_recoleccion = aDetalle[x][5];
										if(aDetalle[x][5] == null)
												fecha_recoleccion = "N/A";

											var fecha_entrega = aDetalle[x][3];
											
										if(aDetalle[x][3] == null)
												fecha_entrega = "N/A";
											console.log("Tipo que no se :"+aDetalle[x][6]);

var ImprimirOE = "Imprimir";

if (aDetalle[x][6]=='Recolección'){
 recoleccionOE = " opacity:0; position:absolute; left:9999px; ";
ImprimirOE = "Ver detalle";}

										$( "#Orden1_ruta tbody" ).append( "<tr>" +

												 "<td><input type='checkbox' value='"+ aDetalle[x][0] + "'></td>" +
													"<td><b>" +  aDetalle[x][6] + "</b></td>" +
												 "<td>" +  aDetalle[x][1]+ "</td>" +
													"<td>" +  aDetalle[x][2] + "</td>" +
													"<td>" + fecha_entrega + "</td>" +										
													"<td>"+ " <input type='text' style='width=150px; "+recoleccionOE+"' name='enr"+x+"' id='enr"+x+"' value='' size='10' width='150'  />" +  "</td>" +		
													
															"</tr>" );
																										   	
											}			 // del iff aDetalle
								} //del For aDetalle
		}); // JSON
}

function validarSeleccion(){
	
	for(x=($('#Orden >tbody >tr').length)-1;x>-1;x--){
			
			var isChecked = $("#Orden >tbody >tr input:checkbox")[x].checked;
				
				   if(isChecked)
				   {
					   if(isNaN(parseInt($("#Orden >tbody >tr").eq(x).find("input[type=text]").val()))||parseInt($("#Orden >tbody >tr").eq(x).find("input[type=text]").val()) == 0 || parseInt($("#Orden >tbody >tr").eq(x).find("td").eq(6).html())< parseInt($("#Orden >tbody >tr").eq(x).find("input[type=text]").val()))
					  
					  
																																					  						 {
					
									return false;																												  						 }
					   
	
				   
				}
	}
	return true;
}

  function activarEdicion(value)
  {
	  if (value=="true")
	  {
		  cambios=true;
	  }
	  else
	  {
		  cambios=false;
	  }	 
  }
  

function deleteProducto(detalle){
         $.post(
				'../Clases/Ajax/delete_detalle_producto.php',
				 JSON.stringify(detalle),
				 function(msg) {
					
					var message=$.trim(msg);
					if (message!="OK") {
						if(typeof msgError === "undefined")
						msgError=msg;
						else
            			msgError=msgError+"\n"+msg;
						console.log('a borrar:'+msgError);
						console.log('Ya tiene mensaje de error');
        			}
					
				}
		);	
		 
}


function Detalle_Ordenes(form)
{
	var $this = form;
	console.log("orden_id_detalles"+$this.attr('idordensalida')+" tipo: "+$this.attr('tipo_ordensalida'));
	id_orden_sumario = $this.attr('idordensalida');
	tipo_ordensalida= $this.attr('tipo_ordensalida');

if (tipo_ordensalida==1)
			Detalle_Entregas();
else
			Detalle_Recoleccion();

 }

function detalleRuta(form)
{
	var $this = form;
	

}



function Detalle_Entregas()
{
console.log("entre a ENTREGAS");
				var arr1={
			accion: "obtenerOrden_Detalle",
			id_orden: id_orden_sumario
			}
				
			$("#Orden tbody").empty();
					
						
			hilo=$.post(
				 '../Clases/Ajax/add_ruta.php',
				 JSON.stringify(arr1),
				 function(msg) {
					var message=msg;
				
					var aDetalle = JSON.parse( message );
					var checked;

					if(aDetalle != null)
					{
						for(x=0;x<(aDetalle.length);x++){
				
						   if (agregados != "" && agregados.indexOf("|"+aDetalle[x][0]+".")!=-1)
						   {
								cantidad= agregados.substring(agregados.indexOf("|"+aDetalle[x][0]+".")+aDetalle[x][0].length+2,agregados.indexOf("|",agregados.indexOf("|"+aDetalle[x][0]+".")+aDetalle[x][0].length+2));
								checked="checked";
						   }else{
								cantidad=0;
								checked="checked";
						   }
						   

						   $( "#Orden tbody" ).append( "<tr>" +
						  "<td><input type='checkbox' value='"+ aDetalle[x][0] + "' "+ checked +"></td>" +
						  "<td><b>" +  aDetalle[x][11] + "</b></td>" +
						  "<td>" +  aDetalle[x][1]+ "</td>" +
						  "<td>" +  aDetalle[x][2] + "</td>" +
						  "<td>" + aDetalle[x][3] + "</td>" +					  
						  "<td>" + aDetalle[x][4] + "</td>" +				
						  "<td>"+ aDetalle[x][9] +  "</td>" +	  
						  "<td>"+ aDetalle[x][5] +  "</td>" +	 
						   "<td>"+ " <input type='text' name='enr"+x+"' id='enr"+x+"' value='"+aDetalle[x][10] +"' size='5'  onkeypress=\"return NumEntero(event)\" />" +  "</td>" +
						 

						"</tr>" );
						   
		  				}
						
										
						$( "#dialog-form" ).dialog( "open" );
						
					}else
					{ alert("No existen Ordenes de Salida para asignar");
					}
							
				}
			);	
}


function Detalle_Recoleccion()
{
console.log("Entre a RECOLECCION");
				var arr1={
			accion: "obtenerOrden_Detalle",
			id_orden: id_orden_sumario
			}
				
			$("#Orden-recoleccion tbody").empty();
					
						
			hilo=$.post(
				 '../Clases/Ajax/add_ruta.php',
				 JSON.stringify(arr1),
				 function(msg) {
					var message=msg;
				
					var aDetalle = JSON.parse( message );
					var checked;

					if(aDetalle != null)
					{
						for(x=0;x<(aDetalle.length);x++){
				
						   if (agregados != "" && agregados.indexOf("|"+aDetalle[x][0]+".")!=-1)
						   {
								cantidad= agregados.substring(agregados.indexOf("|"+aDetalle[x][0]+".")+aDetalle[x][0].length+2,agregados.indexOf("|",agregados.indexOf("|"+aDetalle[x][0]+".")+aDetalle[x][0].length+2));
								checked="checked";
						   }else{
								cantidad=0;
							
						   }
						   

						   $( "#Orden-recoleccion tbody" ).append( "<tr>" +
						  "<td><input type='checkbox' checked value='"+ aDetalle[x][0] + "'></td>" +
						  "<td><b>" +  aDetalle[x][11] + "</b></td>" +
						  "<td>" + aDetalle[x][1] + "</td>" +
						  "<td>" + aDetalle[x][2] + "</td>" +
						  "<td>" + aDetalle[x][12] + "</td>" +					  
						  "<td>" + aDetalle[x][4] + "</td>" +				
						  "<td>" + aDetalle[x][6] +  "</td>" +	  
						   "<td>"+ " <input type='text' name='enr"+x+"' id='enr"+x+"' value='"+aDetalle[x][6] +"' size='5'   onkeypress=\"return NumEntero(event)\" />" +  "</td>" +
						   
						    "<td></td>" +	
						    "<td></td>" +	
						   "<td></td>" +	

						"</tr>" );
						   
		  				}
						
										
						$( "#dialog-form-recoleccion" ).dialog( "open" );
						
					}else
					{ alert("No existen Ordenes de Salida para asignar");
					}
							
				}
			);	
}

function ValidadOrden_Tabla()
{

	var Imprime_var = 0;

 	for(x=($('#Orden1_ruta >tbody >tr').length)-1;x>-1;x--){

		 		if ($("#Orden1_ruta >tbody >tr").eq(x).find("input[type=checkbox]").val()==id_orden_sumario)
		 		{
		 				console.log("Ahora si son iguales");
		 				Imprime_var = 1;
		 		}

 	}
console.log(" EL ID ORDEN: "+id_orden_sumario+"IMRPMIMEEEEE...."+Imprime_var);
 	return Imprime_var;

}


function Validad_surtido()
{

console.log("Validad_surtido()");
				var arr1={
			accion: "obtenerSumarios"
			}			
						
			hilo=$.post(
				 '../Clases/Ajax/add_ruta.php',
				 JSON.stringify(arr1),
				 function(msg) {
					var message=msg;
				
					var aDetalle = JSON.parse( message );
					var checked;

					if(aDetalle != null)
					{
						for(x=0;x<(aDetalle.length);x++){
				
						   if (agregados != "" && agregados.indexOf("|"+aDetalle[x][0]+".")!=-1)
						   {
								cantidad= agregados.substring(agregados.indexOf("|"+aDetalle[x][0]+".")+aDetalle[x][0].length+2,agregados.indexOf("|",agregados.indexOf("|"+aDetalle[x][0]+".")+aDetalle[x][0].length+2));
								checked="checked";
						   }else{
								cantidad=0;
							
						   }
						   

						   $( "#Orden-recoleccion tbody" ).append( "<tr>" +
						  "<td><input type='checkbox' checked value='"+ aDetalle[x][0] + "'></td>" +
						  "<td><b>" +  aDetalle[x][11] + "</b></td>" +
						  "<td>" + aDetalle[x][1] + "</td>" +
						  "<td>" + aDetalle[x][2] + "</td>" +
						  "<td>" + aDetalle[x][12] + "</td>" +					  
						  "<td>" + aDetalle[x][4] + "</td>" +				
						  "<td>" + aDetalle[x][6] +  "</td>" +	  
						   "<td>"+ " <input type='text' name='enr"+x+"' id='enr"+x+"' value='"+aDetalle[x][6] +"' size='5'   onkeypress=\"return NumEntero(event)\" />" +  "</td>" +
						   
						    "<td></td>" +	
						    "<td></td>" +	
						   "<td></td>" +	

						"</tr>" );
						   
		  				}
						
										
						$( "#dialog-form-recoleccion" ).dialog( "open" );
						
					}else
					{ alert("No existen Ordenes de Salida para asignar");
					}
							
				}
			);	

}

