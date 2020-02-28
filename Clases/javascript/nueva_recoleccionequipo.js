

var cantidad_actual=0;
var nuevacotizacion=true;
var no_cotizacion;
var no_pedido=0;
var descuentos=0;
var aumentos=0;
var descuentototal=false;
var aplicar_total=false;
var empresa_id;
var cambios=false;
var folio=0;
var moneda=1;
var tipocotizacion=0;
//var 

function selectEmpresa(sel)
{
	var empresa_id=$("#empresa").val();
	$('#continuar-cotizacion').hide();
	if(empresa_id!="0")
	{
		$('#panelcliente').show();
		$('#sucursal').hide();
		$('#contrato').hide();
		$("#contrato_mtotales").hide();
		$("#contrato_mrestantes").hide();
		$("#contrato_montototal").hide();
		$("#contrato_montorestante").hide();
		//$("#empresa").attr('disabled','disabled');
	}
	else
	{
		$('#panelcliente').hide();
	}
}

function selectMoneda(sel)
{
	
	
					moneda=$('#moneda option:selected').attr("tipo_cambio"); 
					
					console.log('tipo de cambio'+moneda);
					$('#productos >tbody >tr').each(
						function() 
						{
						   //var detalle_id=$(this).find("input[type=checkbox]").val();

						   var precio_base=($(this).find("td").eq(5).attr("title"))*1;
							var multip=($(this).find("td").eq(5).attr("multip"))*1;
						   var precio_total=($(this).find("td").eq(6).html())*1;
						   $(this).find("td").eq(5).html(($(this).find("td").eq(5).html()*multip*moneda).toFixed(2));
						   $(this).find("td").eq(5).attr("multip", multip);
						   $(this).find("td").eq(6).html(($(this).find("td").eq(3).html()*	precio_base*multip*moneda).toFixed(2));
});

}

function ponerValorCliente(str){
  document.getElementById('cliente').value=str.desc;
  document.getElementById('cliente').title=str.id;
  document.getElementById('cliente').setAttribute("idcliente",str.id);
  document.getElementById('livecliente').innerHTML="";
  document.getElementById("livecliente").style.border="0px";
  document.getElementById('contacto').value="Seleccione un Contacto";
   document.getElementById('sucursal').value="Seleccione un Contacto";
  console.log('$( "#cliente" ).attr("idcliente")');

  //Habilitar Seleccion de Productos
  //alert("Activa Botones");
  //document.getElementById('agregar-producto').removeAttribute('disabled');
  //$('#attach-file').show();
 
}

function ponerValorMaterial(str){



  document.getElementById('producto').value=str.desc;
  //$("#producto").attr("idproducto", str.id);
  document.getElementById('producto').setAttribute("idproducto", str.id);
  //$("#cantidad").attr("disabled", "enabled");
  document.getElementById('cantidad').removeAttribute("readonly");
  //$("#cantidad").attr("unidad", str.unidad);
  document.getElementById('cantidad').setAttribute("unidad", str.unidad);
  document.getElementById('cantidad').setAttribute("title", str.unidad);
  //document.getElementById('cantidad-promo').removeAttribute("readonly");
  document.getElementById('preciobase').value=str.precio;
  document.getElementById('preciounit').value=str.precio;
  document.getElementById('livesearch').innerHTML="";
  document.getElementById("livesearch").style.border="0px";



  calcularMontos($("#cantidad").val());
  
}

function calcularMontos(cant)
{
	var charpos = cant.search("[^0-9]"); //deberia aceptar decimales
	if(cant.length > 0 &&  charpos >= 0) 
	{ $("#cantidad").val("0");
	  return;
	}
	precio_c=document.getElementById('preciounit').value;
	cantidad_c=cant;
	total_c=precio_c*cantidad_c;
	document.getElementById('total').value=total_c.toFixed(2);
	document.getElementById('cantidad_prestamo').value=cant;
	//document.getElementById('total').value=Math.round (total_c*100) / 100;
	$("#cantidad-promo").removeAttr("readonly");
}
function calcularMontosServicio(cant)
{
	var charpos = cant.search("[^0-9]"); //deberia aceptar decimales
	if(cant.length > 0 &&  charpos >= 0) 
	{ $("#cantidad-servicio").val("0");
	  return;
	}
	document.getElementById('preciounit-servicio').value = document.getElementById('preciobase-servicio').value;
	precio_c=document.getElementById('preciounit-servicio').value;
	cantidad_c=cant;
	total_c=precio_c*cantidad_c;
	document.getElementById('total-servicio').value=total_c.toFixed(2);
	//document.getElementById('tot6al').value=Math.round (total_c*100) / 100;
	$("#cantidad-promo-servicio").removeAttr("readonly");
}

function calcularMontosProductos(cant)
{
	var charpos = cant.search("[^0-9]"); //deberia aceptar decimales
	if(cant.length > 0 &&  charpos >= 0) 
	{ $("#cantidad").val("0");
	  return;
	}
	document.getElementById('preciounit').value = document.getElementById('preciobase').value;
	precio_c=document.getElementById('preciounit').value;
	cantidad_c=cant;
	total_c=precio_c*cantidad_c;
	document.getElementById('total').value=total_c.toFixed(2);
	//document.getElementById('tot6al').value=Math.round (total_c*100) / 100;
	$("#cantidad-promo").removeAttr("readonly");
}

function calcularPromo(cant)
{
	var charpos = cant.search("[^0-9]"); //deberia aceptar decimales
	if(cant.length > 0 &&  charpos >= 0) 
	{ $("#cantidad-promo").val("0");
	  return;
	}
	preciobase=document.getElementById('preciobase').value;
	document.getElementById('preciounit').value=preciobase;
	var precio_u=document.getElementById('preciounit').value;
	precio_u=precio_u*1;//transformar a numero
	//console.log("entro a calcular promo");
	if(document.getElementById('aumento').checked==true)
	{
		cant=cant*1;
	}
	else
	{
		
		cant=cant*-1
		
	}
	
	//console.log("cant="+cant);
	if(document.getElementById('porcen').checked==true)
	{
		precio_u=(precio_u)+(precio_u*(cant/100));
		console.log("precio_u con porcentaje="+precio_u);
	}
	else
	{
		precio_u=precio_u+cant;
		console.log("precio_u sin porcentaje="+precio_u);
	}
	//document.getElementById('preciounit').value=Math.round (precio_u*100) / 100;
	document.getElementById('preciounit').value=precio_u.toFixed(2);
    calcularMontos(document.getElementById('cantidad').value);
}

function calcularPromoServicio(cant)
{
	var charpos = cant.search("[^0-9]"); //deberia aceptar decimales
	if(cant.length > 0 &&  charpos >= 0) 
	{ $("#cantidad-promo-servicio").val("0");
	  return;
	}
	preciobase=document.getElementById('preciobase-servicio').value;
	document.getElementById('preciounit-servicio').value=preciobase;
	var precio_u=document.getElementById('preciounit-servicio').value;
	precio_u=precio_u*1;//transformar a numero
	console.log("entro a calcular promo");
	if(document.getElementById('aumento-servicio').checked==true)
	{
		cant=cant*1;
	}
	else
	{
		
		cant=cant*-1
		
	}
	
	//console.log("cant="+cant);
	if(document.getElementById('porcen-servicio').checked==true)
	{
		precio_u=(precio_u)+(precio_u*(cant/100));
		console.log("precio_u con porcentaje="+precio_u);
	}
	else
	{
		precio_u=precio_u+cant;
		console.log("precio_u sin porcentaje="+precio_u);
	}
	//document.getElementById('preciounit').value=Math.round (precio_u*100) / 100;
	document.getElementById('preciounit').value=precio_u.toFixed(2);
    calcularMontos(document.getElementById('cantidad').value);
}
function calcularPromot(cant)
{
	var charpos = cant.search("[^0-9]"); //deberia aceptar decimales
	if(cant.length > 0 &&  charpos >= 0) 
	{ $("#cantidad-promot").val("0");
	  return;
	}
	totalbase=document.getElementById('mtotal').value;
	
	totalresult=totalbase*1;//transformar a numero
	//console.log("entro a calcular promo");
	if(document.getElementById('aumentot').checked==true)
	{
		cant=cant*1;
		descuentototal=true;
	}
	else
	{
		cant=cant*-1;
		descuentototal=true;
	}
	if(cant==0)
		descuentototal=false;
	//console.log("cant="+cant);
	totalresult=(totalresult)+(totalresult*(cant/100));	
	//document.getElementById('preciounit').value=Math.round (precio_u*100) / 100;
	document.getElementById('mtotalaumento').value=totalresult.toFixed(2);
}

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

function showResult(str)
{


$("#cantidad").attr("readonly", "readonly");
$("#cantidad-promo").attr("readonly", "readonly");
if(str.length==0)
{
	document.getElementById('livesearch').innerHTML="";
    document.getElementById("livesearch").style.border="0px";
}
else
{
xmlhttp=objetoAjax();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
xmlhttp.open("POST","../Clases/Ajax/selectmaterial_id.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("material="+str);  
}



}

function savePedido()
{	



var arr={
	accion: 	"CrearPedido",
cotizacion_id: $("#id_cot").val(),
sucursal_cot:$("#sucursales").attr("idsucursal"),
fechaini_cot:$( "#datepicker1" ).val(),
fechafin_cot:$( "#datepicker2" ).val(),
obs_ped:$( "#observaciones_ped" ).val(),
usuario_cot:$("#usuario").val(),
folioOS: $( "#folio_OS" ).val(),
status: 5   //falta parametrizar en todos lados
}; 

hilo=$.post(
		 '../Clases/Ajax/crear_pedido_sumario.php',
		 JSON.stringify(arr),
		 function(msg) {
			no_cotizacion=$.trim(msg);
			no_pedido= $.trim(msg);

			// eeeee
			
			//console.log(no_cotizacion);
			$("#pedidono").val(msg);
			console.log("Se crearon los pedidos locamente chido:"+no_pedido);

		}
		);

}

function confirmPedido()
{	



var arr={
	accion: 	"ConfirmarPedido",
pedido: $("#pedidono").val(), 
sucursal_cot:$("#sucursales").attr("idsucursal"),
fechaini_cot:$( "#datepicker1" ).val(),
fechafin_cot:$( "#datepicker2" ).val(),
obs_ped:$( "#observaciones_ped" ).val(),
folioOS: $( "#folio_OS" ).val(),
status: 5
}; 

hilo=$.post(
		 '../Clases/Ajax/crear_pedido_sumario.php',
		 JSON.stringify(arr),
		 function(msg) {
		 	var message=$.trim(msg);
console.log("EL MENSAJE CHAFA DE CONFIRM: "+message);
if(!isNaN(message))
{
						alert("Se guardó satisfactiamente la Recolección");
				window.location.href = 'ordenes_salida_busqueda_usuario.php';
}
else
							alert("Error al guardar la Recolección");

		}
		);

}

function showResultCliente(str)
{
 
if(str.length==0)
{
	document.getElementById('livecliente').innerHTML="";
    document.getElementById("livecliente").style.border="0px";
}
else
{
xmlhttp=objetoAjax();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livecliente").innerHTML=xmlhttp.responseText;
    document.getElementById("livecliente").style.border="1px solid #A5ACB2";
    }
  }

xmlhttp.open("POST","../Clases/Ajax/selectcliente_id.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("cliente="+str);  
}
}

function saveCotizacion(varia){

						for(x=($('#Orden >tbody >tr').length)-1;x>-1;x--){
							
								   if($("#Orden >tbody >tr input:radio")[x].checked)
								   {
									   	$("#empresa_cot").val($("#Orden >tbody >tr").eq(x).find("td").eq(1).html());
									   	$("#id_cot").val($("#Orden >tbody >tr").eq(x).find("td").eq(2).html());
									   	$("#cliente_cot").val($("#Orden >tbody >tr").eq(x).find("td").eq(3).html());
									   	$("#fechaini_cot").val($("#Orden >tbody >tr").eq(x).find("td").eq(4).html());
									   	$("#fechafin_cot").val($("#Orden >tbody >tr").eq(x).find("td").eq(5).html());
									   	$("#obs_cot").val($("#Orden >tbody >tr").eq(x).find("td").eq(6).html());


																																		
									   	$("#cotizacion").val($("#Orden >tbody >tr").eq(x).find("input[type=radio]").val());

									   }
						}
//		
//alert(agregados);
$('#orders-contain_cotizacion').show();

}





  $(function() {
 $('#agregar-cotizacion').show();
$('#ref-pago').hide();
$('#descuentototal').hide();
 $('#panelchecktotal5').hide();
  	$('#orders-contain_cotizacion').hide();
	   $( '#dialog-form' ).tooltip();
	   $( '#dialog-servicios' ).tooltip();
	   $('#panelcliente').hide();
	   $('#varcot').hide();
	   $('#products-contain').hide();
	   $('#descuentototal').hide();
	   $('#divguardar').hide();
	   //document.getElementById('agregar-producto').setAttribute('disabled', 'disabled');//document.getElementById('quitar-producto').setAttribute('disabled', 'disabled');
	 //  $('#agregar-producto').hide();//boton Agregar escondido
	   $('#agregar-cotizacion').hide();
	   $('#agregar-servicio').hide();//boton Agregar escondido
	   $('#quitar-producto').hide();//boton Quitar escondido
	   //$('#attach-file').hide();//boton Adjuntar escondido
	   $('#formato').hide();
	   $('#sucursal').hide();
			IniciaTodo();

	  var producto = $( "#producto" ),
		cantidad=$("#cantidad"),
		preciobase=$("#preciobase"),
		precio=$("#preciounit"),
		total=$("#total"),
		aumento=$("#cantidad-promo"),
      	allFields = $( [] ).add( producto ).add( cantidad ).add( precio ).add( preciobase).add(total).add(aumento).add($("#observaciones"));




	$( "#dialog_mail" ).dialog({
      autoOpen: false,
      height: 300,
      width: 400,
      modal: true,
      buttons: {
        "Aceptar": 
					function() 
					{
						enviarCotizacion({user: $("#passmail").val(), msg:$("#msgmail").val()});
						
					}
		,
        "Cancelar": function() {
					  	$( this ).dialog( "close" );
					},
		"Adjuntar": function() {
					  	adjuntar($(this));
					}			
					
      },
      close: function() {
        			$("#passmail").val("");
					$("#msgmail").html("");
      }
    });
		
			$( "#Mostrar_todo" ).dialog({
      autoOpen: false,
      height: 400,
      width: 800,
      modal: true,
      buttons: {
        "Aceptar": 
					function() 
					{
						console.log("ENTRE AL BOTON");

//borrar producto de base de datos DETALLE-COTIZACION
     for(x=($('#Orden_sumario >tbody >tr').length)-1;x>-1;x--){
									
										
										
						if($("#Orden_sumario >tbody >tr input:checkbox")[x].checked)
										   {
											
											 
							  document.getElementById('producto').value=$("#Orden_sumario >tbody >tr").eq(x).find("td").eq(1).html();
							  document.getElementById('producto').setAttribute("idproducto", $("#Orden_sumario >tbody >tr").eq(x).find("input[type=checkbox]").val());
							  document.getElementById('cantidad').setAttribute("unidad", $("#Orden_sumario >tbody >tr").eq(x).find("td").eq(2).html());
							  document.getElementById('cantidad').value=$("#Orden_sumario >tbody >tr").eq(x).find("td").eq(3).html();						
							  document.getElementById('preciobase').value=$("#Orden_sumario >tbody >tr").eq(x).find("td").eq(4).html();
							  document.getElementById('preciounit').value=$("#Orden_sumario >tbody >tr").eq(x).find("td").eq(4).html();
							  document.getElementById('cantidad_prestamo').value=$("#Orden_sumario >tbody >tr").eq(x).find("input[type=text]").val();




							saveProducto($( this ));
													 
					 }
				}


						




						$( this ).dialog( "close" );



					}
		,
        "Cancelar": function() {
					  	$( this ).dialog( "close" );
					},

      },
      close: function() {
        			$("#passmail").val("");
					$("#msgmail").html("");
      }
    });
		
 
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 500,
      width: 850,
      modal: true,
      buttons: {
        "Agregar": function() 
					{
					
				
								if ($("#pedidono").val()==0)
										console.log("El pedido no tiene NO");	
									else 				
										saveProducto($( this ));

				
					},

        "Cancelar": function() {
					  	$( this ).dialog( "close" );
					}
      },

      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 	
 	$( "#dialog-servicios" ).dialog({
      autoOpen: false,
      height: 500,
      width: 500,
      modal: true,
      buttons: {
        "Agregar": 
					function() 
					{
						
						if(($("#total-servicio").val()*1)>0)
						{
							//console.log("debe salvar producto");
							saveServicio($( this ));
						}
					}
		,
        "Cancelar": function() {
					  	$( this ).dialog( "close" );
					}
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
	
    $("#agregar-producto")
      .button()
      .click(function() {
      	if ($("#pedidono").val()==0)
      		savePedido();
      //	$('#dialog-form-cotizaciones').hide();
						      $("#agregar-cotizacion").hide();
										      	$('#agregar-servicio').hide();
												$("#cantidad").attr("readonly", "readonly");
												$("#cantidad").val("1");
												$("#cantidad-promo").attr("readonly", "readonly");
												$("#cantidad-promo").val("0");
												$("#total").val("0");
												$("#cantidad_prestamo").val("0");
												$('#producto').each(function(){
										this.value = $(this).attr('value');
										$(this).addClass('text-label');
										$(this).focus(function(){
											if(this.value == $(this).attr('title')) {
												this.value = '';
												$(this).removeClass('text-label');
											}
										});
									 
										$(this).blur(function(){
											if(this.value == '') {
												this.value = $(this).attr('title');
												$(this).addClass('text-label');
											}
						    	  });
		});    
		 
        $( "#dialog-form" ).dialog( "open" );
      });




      $("#agregar-servicio")
      .button()
      .click(function() {
		
		$("#cantidad-servicio").val("1");
		$("#cantidad-promo-servicio").attr("readonly", "readonly");
		$("#cantidad-promo-servicio").val("0");
		$("#total-servicio").val("0");    
        $( "#dialog-servicios" ).dialog( "open" );
      });
	$("#quitar-producto" )
      .button()
      .click(function() {
      	/*if($('#productos >tbody >tr').length>0)
      	{
      		$("#products-contain").hide();
      		$("#quitar-producto").hide();
      	}
      	else
      	{
      	*/	
			for(x=($('#productos >tbody >tr').length)-1;x>-1;x--){
			
				var isChecked = $("#productos >tbody >tr input:checkbox")[x].checked;
				
				   if(isChecked)
				   {
					 //console.log("Entra en que va aborrar producto");
					 var inputi=$("#productos >tbody >tr").eq(x).find("input[type=checkbox]");//igual a el iddetalle
					 
					 det_cot=inputi.val();
					 console.log("Obtiene valor para borrar producto"+inputi.val());
					 var arr={detalle: det_cot};
					 deleteProducto(arr);
					 //console.log("borro producto");
					 $('#productos >tbody >tr').eq(x).remove();
					 //borrar producto de base de datos DETALLE-COTIZACION
				   }
			}
		/*}*/	
      });



    $("#agregar-recoleccion")
      .button()
      .click(function() {
      	if ($("#pedidono").val()==0)
      		savePedido();
      //	$('#dialog-form-cotizaciones').hide();
						      $("#agregar-cotizacion").hide();
										      	$('#agregar-servicio').hide();
										      	$('#preciobase').hide();
										      	$('#aumento').hide();
										      	$('#descuento').hide();
										      	$('#porcen').hide();
										      	$('#real').hide();	
										      	$('#cantidad-promo').hide();	
										      	$('#preciounit').hide();	
										      	$('#total').hide();	


												$("#cantidad").attr("readonly", "readonly");
												$("#cantidad").val("1");
												$("#cantidad-promo").attr("readonly", "readonly");
												$("#cantidad-promo").val("0");
												$("#total").val("0");
												$('#producto').each(function(){
										this.value = $(this).attr('value');
										$(this).addClass('text-label');
										$(this).focus(function(){
											if(this.value == $(this).attr('title')) {
												this.value = '';
												$(this).removeClass('text-label');
											}
										});
									 
										$(this).blur(function(){
											if(this.value == '') {
												this.value = $(this).attr('title');
												$(this).addClass('text-label');
											}
						    	  });
		});    
		 
        $( "#dialog-form" ).dialog( "open" );
      });


	  $("#vista-previa" )
      .button()
      .click(function() {
      	 $('<iframe id="attach-files" src="../Clases/pdf/createremision.php?cot='+$("#cotizacion").val()+'" />').dialog({
                open: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
    },
				beforeClose:function(e, m) {
                    //Pagina(1);
				},
				title: 'Vista Previa',
		position: {
					my: "center top",
					at: "center top",
					of: window
				},
                autoOpen: true,
                width: 750,
                height: 600,
                modal: true,
                resizable: false,
                autoResize: true,
                overlay: {
                    opacity: 0.5,
					
                    background: "white",
					
                }
				
            }).width(700).height(650).css("background", "#ffffff");
      });
	  /*$('#attach-file')
	  .button()
	  .click(function(e) {e.preventDefault();adjuntar($(this));});*/
	  $('#aplicar-desmuento')
	  .button()
	  .click(
	  		function(e) 
			{
					e.preventDefault();
					$("#cantidad-promot").attr("readonly","readonly");
					$("#mtotalaumento").attr("readonly","readonly"); 
					$("#agregar-producto").hide();
					$("#agregar-servicio").hide();
					$("#quitar-producto").hide();
					var multip=($("#mtotalaumento").val())/($("#mtotal").val());
					var moneda=$("#moneda").attr("tipo_cambio")*1;
					$('#productos >tbody >tr').each(
						function() 
						{
						   //var detalle_id=$(this).find("input[type=checkbox]").val();

						   var precio_base=($(this).find("td").eq(5).attr("title"))*1;

						   var precio_total=($(this).find("td").eq(6).html())*1;
						   $(this).find("td").eq(5).html(($(this).find("td").eq(5).html()*multip*moneda).toFixed(2));
						   $(this).find("td").eq(5).attr("multip", multip);
						   
						   $(this).find("td").eq(6).html(($(this).find("td").eq(3).html()*precio_base*multip*moneda).toFixed(2));	//mas exacto
						  //5 y 6 aumentarle el desmuento
						  var arr={detalle:$(this).find("input[type=checkbox]").val(), precio: precio_base,  multiplo:multip}
						 $.post(
						 '../Clases/Ajax/desmuento_detalle_producto.php',
						 JSON.stringify(arr),
							 function(msg) {
								var message=$.trim(msg);
								//if(message=="Error")
			
								//det_cot=message;
							}
						);
						  
						}
					); 
					$("#checktotal").hide();
					$("#aplicar-desmuento").hide();
		  			//aplicar descuento o aumento a toda la tabla
	  });
	  $("#continuar-cotizacion")
      .button()
      .click(function() {
		  if(descuentos>0)
		  {
			  //alert("La cotización contiene descuentos, se requiere autorización del Gerente para su inmediato envío");
			  //actualizacion del estado a "1" de "por autorizar
			  autorizarCotizacion();
		  }
		  else
		  {
			  //alert("La cotización no contiene descuentos");
			  //confirmacion y posterior envío
			  $( "#dialog_mail" ).dialog( "open" );

			  //enviarCotizacion(); //este procedimiento lo paso al dialog de mail
		  }
		//a borrar y mostrar mensaje de error
	  });
	  $("#guardar-cotizacion")
      .button()
      .click(function() {
		  		$( "#empresa" ).attr("disabled", "disabled");
				var msg_cot;
				
				var arr={cotizacion: no_cotizacion, estado: 0, cliente: $( "#cliente" ).attr("idcliente"), usuario: $( "#usuario" ).val(),  empresa: $( "#empresa" ).val(), folio:$( "#folio" ).val(), moneda: $( "#moneda" ).val(), cambio_dia: moneda, observaciones:"" , contacto:$( "#contacto" ).attr("idcontacto"), mensaje:$("#mensaje").val(), dias_entrega:$("#dias_entrega").val(), condiciones: $("#condiciones").val(), tipocot: tipocotizacion}
			hilo=$.post(
				 '../Clases/Ajax/update_cotizacion.php',
				 JSON.stringify(arr),
				 function(msg) {
					msg_cot=$.trim(msg);
					if(!isNaN(msg_cot))
						$( "#folio" ).val(msg_cot);
					else
						alert("Error BD:"+msg_cot);
					//if(message=="Error")
		
					
				}
			);
			hilo.done(	
						
						function(){
							
							checkChanges(false);
						}
			);
				
		  		
		  });

  $("#Guardar")
      .button()
      .click(function() {	


confirmPedido();

	
		  		

		  });

 $("#Cancelar")
      .button()
      .click(function() {
				
				window.location.href = 'ordenes_salida_busqueda_usuario.php';
		  		
		  });
      
       $("#Guardar-Borrador")
      .button()
      .click(function() {

				alert("Se Guardó como borrador");
				window.location.href = 'ordenes_salida_busqueda_usuario.php';
		  		
		  });

  $( "#dialog-form-cotizaciones" ).dialog({
      autoOpen: false,
      height: 400,
      width: 700,
      modal: true,
      buttons: {
        "Agregar": 
					function() 
					{
						
						console.log("manda producto a html");
						saveCotizacion($( this ));

							$( this ).dialog( "close" );
						
					}
		,
        "Cancelar": function() {
					  	$( this ).dialog( "close" );
				//		validarTabla();
					}
      },
      close: function() {
       // allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });

	
      $("#agregar-cotizacion")
      .button()
      .click(function() {
					 
        IniciaTodo();

		
      });



      $("#agregar-detalle-cot")
      .button()
      .click(function() {
					 
        IniciaDetalleCotizacion();

		
      });





	});
  
function IniciaTodo(){

		   $('#agregar-recoleccion').show();//boton Agregar escondido
	   $('#agregar-cotizacion').show();
	$('#panelchecktotal').show();
	



			var arr1={
			accion: "obtenerCotizacion",
			idusuario: $("#usuario").val()	
			}
			
					$("#Orden tbody").empty();
					
						
			hilo=$.post(
				 '../Clases/Ajax/add_cotizacion.php',
				 JSON.stringify(arr1),
				 function(msg) {
					var message=msg;

					//console.log ("si entre aqui pero nose que onda"+message);

					var aDetalle = JSON.parse( message );


					var checked="";

					if(aDetalle != null)
					{
						for(x=0;x<(aDetalle.length);x++){

						   
						   $( "#Orden tbody" ).append( "<tr>" +
						  "<td><input type='radio' name='idcotizacionCheck' value='"+ aDetalle[x][1]+"'></td>" +
						  "<td>" +  aDetalle[x][0]+ "</td>" +
						  "<td>" +  aDetalle[x][1] + "</td>" +
						  "<td>" + aDetalle[x][2] + "</td>" +					  
						  "<td>" + aDetalle[x][3] + "</td>" +					  
						  "<td>" + aDetalle[x][4] + "</td>" +	
						   "<td>"+ aDetalle[x][5] +  "</td>" +
						"</tr>" );
						   
		  				}
						
										
						$( "#dialog-form-cotizaciones" ).dialog( "open" );
						
					}else
					{ alert("No existen Cotizaciones a asignar");
					}
							
				}
			);	
		
}
function IniciaDetalleCotizacion(){
		 //boton Agregar escondido

			var arr1={
			accion: "obtenerDetalleCotizacion",
			idcotizacion: $("#cotizacion").val()
			}
			
					$("#Orden_sumario tbody").empty();
					
						
			hilo=$.post(
				 '../Clases/Ajax/add_cotizacion.php',
				 JSON.stringify(arr1),
				 function(msg) {
					var message=msg;

					console.log ("si entre aqui pero nose que onda"+message);

					var aDetalle = JSON.parse( message );


					var checked="";

					if(aDetalle != null)
					{
						for(x=0;x<(aDetalle.length);x++){
						   $( "#Orden_sumario tbody" ).append( "<tr>" +
						  "<td><input type='checkbox' name='idcotizacionCheck' checked value='"+ aDetalle[x][9]+"'></td>" +
						  "<td>" +  aDetalle[x][7]+ "</td>" +
						  "<td>" +  aDetalle[x][8] + "</td>" +
						  "<td>" + aDetalle[x][2] + "</td>" +					  
						  "<td>" + aDetalle[x][4] + "</td>" +					  
						  "<td>" + aDetalle[x][4] + "</td>" +	
						  "<td><input type='text' name='idrecoleccion' id='idrecoleccion' value='"+ aDetalle[x][2]+"'></td>" +

					
						"</tr>" );
						   
		  				}
						
						if ($("#pedidono").val()==0)
				      		savePedido();
      //	$('#dialog-form-cotizaciones').hide();
						      $("#agregar-cotizacion").hide();
										  $('#agregar-servicio').hide();
												$("#cantidad").attr("readonly", "readonly");
												$("#cantidad").val("1");
												$("#cantidad-promo").attr("readonly", "readonly");
												$("#cantidad-promo").val("0");
												$("#total").val("0");
												$('#producto').each(function(){
															this.value = $(this).attr('value');
															$(this).addClass('text-label');
															$(this).focus(function(){
																if(this.value == $(this).attr('title')) {
																	this.value = '';
																	$(this).removeClass('text-label');
																}
															});
														 
															$(this).blur(function(){
																if(this.value == '') {
																	this.value = $(this).attr('title');
																	$(this).addClass('text-label');
																}
											    	  });
												});    
										
			$( "#Mostrar_todo" ).dialog( "open" );
						
					}else
					{ alert("No existen Cotizaciones a asignar");
					}
							
				}
			);	
		
}

 function adjuntar(form){	
 			
     			
            $('<iframe id="attach-files" src="adjuntar_archivos.php?cot='+$("#cotizacion").val()+'" />').dialog({
                open: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
    },
				beforeClose:function(e, m) {
                    //Pagina(1);
				},
				title: 'Adjuntar Archivos',
                autoOpen: true,
                width: 550,
                height: 500,
                modal: true,
                resizable: false,
                autoResize: true,
                overlay: {
                    opacity: 0.5,
					
                    background: "white",
					
                }
				
            }).width(500).height(500).css("background", "#ffffff");
			
}

function saveProducto(varia){//arr{cotizacion,producto, cantidad, precio}
		//añadir producto a base de datos DETALLE-COTIZACION
		console.log("El peddo chido recarga:"+$("#pedidono").val());

		    var multip=$( "#preciounit" ).val()/$("#preciobase").val();
			var arr={
				accion: "recoleccion",
				pedido: $("#pedidono").val(), 
				producto: $( "#producto" ).attr("idproducto"), 
				cantidad: $( "#cantidad" ).val(), 
				precio: $( "#preciobase" ).val(), 
				observaciones: $( "#observaciones" ).val(), 
				multiplo: 1, 
				tipocot: 0,
				cantidad_prestamo: $("#cantidad_prestamo").val(),
				estatus_detalle: 7
			}
			//saveProducto(arr);//ME DEBERIA REGRESAR EL DETALLE_PRODUCTO_ID PARA AGREGARLO A LA TABLA
        	/*a.-Muestra Tabla de Productos y Boton de Quitar*/
			var det_cot;
			hilo=$.post(
				 '../Clases/Ajax/add_pedido_detalle_producto.php',
				 JSON.stringify(arr),
				 function(msg) {
					var message=$.trim(msg);
					//if(message=="Error")
					console.log("det_cot antes:"+message);
					det_cot=message;
				}
			);
			hilo.done(	
			function(){
					console.log("det_cot="+det_cot);
					$('#products-contain').show();
					$('#quitar-producto').show();
					/**/
					var desc=($("#preciounit").val()*1)/($("#preciobase").val());
					console.log("desc="+desc);
					console.log("Muestra Panel");
					manejoAumentos(0);
					manejoDescuentos(0);
					if(desc<1)
					{
						//console.log("quita descuento");
						manejoDescuentos(1);
					}
					else if(desc>1)
					{
						manejoAumentos(1);
					}
					$( "#productos tbody" ).append( "<tr>" +
					  "<td><input type='checkbox' value='"+det_cot+"'></td>" +
					  "<td>" + $( "#producto" ).val()+ "</td>" +
					  "<td>" + $( "#cantidad" ).val() + "</td>" +
					  "<td>" + $( "#cantidad" ).attr("unidad") + "</td>" +
					  "<td>" + $( "#observaciones" ).val() + "</td>" +
					  "<td>" + $( "#cantidad_prestamo" ).val() + "</td>" +
					"</tr>" );
					
					
					mtotal=$("#mtotal").val();
					mtotal=mtotal*1+$( "#total" ).val()*1;
					$("#mtotal").val(mtotal.toFixed(2));
					varia.dialog( "close" );
					//si se hizo un aumento o descuento actualizar el monto total aumentado
			}
		);	
}
function saveServicio(varia){//arr{cotizacion,producto, cantidad, precio}

 if(document.getElementById('tipo-servicio').checked==true)
  {
  	 tipocotizacion = 1;
  }
		//añadir producto a base de datos DETALLE-COTIZACION
		    var multip=$( "#preciounit-servicio" ).val()/$("#preciobase-servicio").val();
			var arr={cotizacion: no_cotizacion, servicio: $( "#servicio" ).val(), cantidad: $( "#cantidad-servicio" ).val(), precio: $( "#preciobase-servicio" ).val(), observaciones: $( "#observaciones-servicio" ).val(), multiplo: multip, tipocot: 1}
			//saveProducto(arr);//ME DEBERIA REGRESAR EL DETALLE_PRODUCTO_ID PARA AGREGARLO A LA TABLA
        	/*a.-Muestra Tabla de Productos y Boton de Quitar*/
			var det_cot;
			hilo=$.post(
				 '../Clases/Ajax/add_detalle_servicio.php',
				 JSON.stringify(arr),
				 function(msg) {
					var message=$.trim(msg);
					//if(message=="Error")

					det_cot=message;
				}
			);
			hilo.done(	
			function(){
					console.log("det_cot="+det_cot);
					$('#products-contain').show();
					$('#quitar-producto').show();
					/**/
					var desc=($("#preciounit-servicio").val()*1)/($("#preciobase-servicio").val());
					console.log("desc="+desc);
					console.log("Muestra Panel SERVICIOS");
					manejoAumentos(0);
					manejoDescuentos(0);
					if(desc<1)
					{
						//console.log("quita descuento");
						manejoDescuentos(1);
						
					}
					else if(desc>1)
					{
						manejoAumentos(1);
					}
					$( "#productos tbody" ).append( "<tr>" +
					  "<td><input type='checkbox' value='"+det_cot+"'></td>" +
					  "<td>" + $( "#servicio" ).val()+ "</td>" +
					  "<td>" + $( "#cantidad-servicio" ).val() + "</td>" +
					   "<td> servicio </td>" +
					  "<td title='"+$("#preciobase-servicio").val()+"' multip='"+desc+"'>" + $( "#preciounit-servicio" ).val()*moneda + "</td>" +
					  "<td>" + $( "#total-servicio" ).val()*moneda + "</td>" +
					  "<td>" + $( "#observaciones" ).val() + "</td>" +
					"</tr>" );
					
					
					mtotal=$("#mtotal").val();
					mtotal=mtotal*1+$( "#total-servicio" ).val()*1;
					$("#mtotal").val(mtotal.toFixed(2));
					varia.dialog( "close" );
					//si se hizo un aumento o descuento actualizar el monto total aumentado
			}
		);	
}

function deleteProducto(detalle){

         $.post(
				'../Clases/Ajax/delete_detalle_ordensalida.php',
				 JSON.stringify(detalle),
				 function(msg) {
					
					var message=$.trim(msg);
					console.log("EL MESSAGE DELETE:"+message);
					if (message!="OK") {
						if(typeof msgError == "undefined")
						msgError=msg;
						else
            			msgError=msgError+"\n"+msg;
						console.log('a borrar:'+msgError);
						console.log('Ya tiene mensaje de error');
        			}
					
				}
		);	
}

function manejoDescuentos(cant)
{console.log("entra a descuentos");
	descuentos+=cant;
	if(descuentos>0)
	{
		//console.log("hay descuentos");
		
		$('#descuentototal').hide();
		$('#panelchecktotal').hide();
		//esconder panel de descuento general
		//cambiar texto de boton?
	}
	else
	{
		//console.log("no hay descuentos");
		if(aumentos==0)
		{
		  console.log("muestra");
		  $('#panelchecktotal').show();
		}
		 else
		{ 
			console.log("esconde");
		 	$('#panelchecktotal').hide();
		}
		if($("#checktotal").checked)
		{
			$('#cantidad-promot').val("0");
			$('#descuentototal').show();
		}
		//mostrar panel de descuento general
		//cambiar texto de boton?
	}
}

function manejoAumentos(cant)
{
	console.log("entra a aumentos");
	aumentos+=cant;
	if(aumentos>0)
	{
		//console.log("hay descuentos");
		
		$('#descuentototal').hide();
		$('#panelchecktotal').hide();
		//esconder panel de descuento general
		//cambiar texto de boton?
	}
	else
	{
		 if(descuentos==0)
		 {
		  console.log("muestra");	 
		  $('#panelchecktotal').show();
		 }
		 else
		 {
			 console.log("esconde");
		 	$('#panelchecktotal').hide();
		 }
		//console.log("no hay descuentos");
		if($("#checktotal").checked)
		{
			$('#cantidad-promot').val("0");
			$('#descuentototal').show();
		}
		//mostrar panel de descuento general
		//cambiar texto de boton?
	}
}

function activatePanelTotal(checkbocs)
{
	
	if(checkbocs.checked&&descuentos==0&&aumentos==0)
	{
		$('#descuentototal').show();
	}
	else
	{
		$('#descuentototal').hide();
	}
}

function activatePanelTotallity(checkbocs)
{
	
	if(checkbocs.checked)
	{
		$('#sucursal').show();
	}
	else
	{
		$('#sucursal').hide();
	}
}

function activatePanelTotallity_contrato(checkbocs)
{
	
	if(checkbocs.checked)
	{
		$('#contrato').show();
	}
	else
	{
		$('#contrato').hide();
		$("#contrato_mtotales").hide();
		$("#contrato_mrestantes").hide();
		$("#contrato_montototal").hide();
		$("#contrato_montorestante").hide();

	}
}


function checkChanges(flag)
{
	cambios=flag;
	if(!cambios)
	{
		$('#formato').show();
		$('#continuar-cotizacion').show();
	}
	else
	{
		$('#formato').hide();
		$('#continuar-cotizacion').hide();
	}
}
function autorizarCotizacion()
{
	var msg_cot;
	console.log("Cual es el contacto"+$( "#contacto" ).attr("idcontacto"));
	var arr={cotizacion: no_cotizacion, estado: 1, cliente: $( "#cliente" ).attr("idcliente"), usuario: $( "#usuario" ).val(),  empresa: $( "#empresa" ).val(), folio:$( "#folio" ).val(), moneda: $( "#moneda" ).val(), cambio_dia: moneda, observaciones:"" , contacto:$( "#contacto" ).attr("idcontacto"), mensaje:$("#mensaje").val(), dias_entrega:$("#dias_entrega").val(), condiciones: $("#condiciones").val(), tipocot: tipocotizacion}
			hilo=$.post(
				 '../Clases/Ajax/update_cotizacion.php',
				 JSON.stringify(arr),
				 function(msg) {
					msg_cot=$.trim(msg);
					if(!isNaN(msg))
					{
					console.log("Guardo Autorizacion:"+msg_cot);
					}
					else
						alert("Error BD:"+msg_cot);
					//if(message=="Error")
		
					
				}
			);
			hilo.done(	
						
						function(){
							
							checkChanges(false);
							window.location.href = 'VENTAS.php';
							alert("La cotización se ha enviado para su autorización");
						}
			);
}

function enviarCotizacion(mail)
{   //alert("Estos valores obtuve:"+mail.user+","+mail.msg);
	var msg_cot;
	var flag=false;
	var arr={cotizacion: no_cotizacion, estado: 2, cliente: $( "#cliente" ).attr("idcliente"), usuario: $( "#usuario" ).val(),  empresa: $( "#empresa" ).val(), folio:$( "#folio" ).val(), moneda: $( "#moneda" ).val(), cambio_dia: moneda, observaciones:"" , contacto:$( "#contacto" ).attr("idcontacto"), mensaje:$("#mensaje").val(), dias_entrega:$("#dias_entrega").val(), condiciones: $("#condiciones").val(), password: mail.user, body_mail: mail.msg, tipocot: tipocotizacion}
			hilo=$.post(
				 '../Clases/Ajax/update_cotizacion.php',
				 JSON.stringify(arr),
				 function(msg) {
					msg_cot=$.trim(msg);
					
					if(msg_cot=="OK")
					{
						flag=true;
					}
					else
						alert("Error BD:"+msg_cot);
				}
			);
			hilo.done(	
						
						function(){
							if(flag)
							{
							checkChanges(false);
							window.location.href = 'VENTAS.php';
							alert("Se ha enviado la cotización");
							}
							
						}
			);
}

function showResultContacto(str)
{
 
	if(str.length==0)
	{
		document.getElementById('livecontacto').innerHTML="";
		document.getElementById("livecontacto").style.border="0px";
	}
	else
	{
		xmlhttp=objetoAjax();
		clienteid=$("#cliente").attr("idcliente");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			
			document.getElementById("livecontacto").innerHTML=xmlhttp.responseText;
			document.getElementById("livecontacto").style.border="1px solid #A5ACB2";
			}
			else
			document.getElementById("livecontacto").innerHTML="cargando...";
		  }
		xmlhttp.open("POST","../Clases/Ajax/selectcontacto_id.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("contacto="+str+"&cliente="+clienteid);  
	}
}

function ponerValorContacto(str){
  document.getElementById('contacto').value=str.desc;
  document.getElementById('contacto').title=str.id;
  document.getElementById('contacto').setAttribute("idcontacto",str.id);
  document.getElementById('livecontacto').innerHTML="";
  document.getElementById("livecontacto").style.border="0px";
   if(nuevacotizacion)//si se va a crear una nueva cotizacion
  {  
    saveCot(str.id);
	nuevacotizacion=false;
	$('#divguardar').show();
	checkChanges(true);
  }
  else
  {
	  checkChanges(true);
  }
	$('#agregar-producto').show();

  if(document.getElementById('tipo-servicio').checked==true)
  {
  	 $('#agregar-servicio').show();
  }
 
  $('#tipo-estandar').attr("disabled", "disabled");
  $('#tipo-servicio').attr("disabled", "disabled");
  //Habilitar Seleccion de Productos
  //alert("Activa Botones");
  //document.getElementById('agregar-producto').removeAttribute('disabled');
}


function ponerValorSucursal(str){
  document.getElementById('sucursales').value=str.desc;
  document.getElementById('sucursales').title=str.id;
  document.getElementById('sucursales').setAttribute("idsucursal",str.id);
  document.getElementById('livesucursal').innerHTML="";
  document.getElementById("livesucursal").style.border="0px";
  console.log('$( "#sucursal" ).attr("idsucursal")');
   if(nuevacotizacion)//si se va a crear una nueva cotizacion
  {  
    saveCot(str.id);
	nuevacotizacion=false;
	$('#divguardar').show();
	checkChanges(true);
  }
  else
  {
	  checkChanges(true);
  }
	$('#agregar-producto').show();

  if(document.getElementById('tipo-servicio').checked==true)
  {
  	 $('#agregar-servicio').show();
  }
 
  $('#tipo-estandar').attr("disabled", "disabled");
  $('#tipo-servicio').attr("disabled", "disabled");
  //Habilitar Seleccion de Productos
  //alert("Activa Botones");
  //document.getElementById('agregar-producto').removeAttribute('disabled');
}



function showResultSucursal(str)
{
 
	if(str.length==0)
	{
		document.getElementById('livesucursal').innerHTML="";
		document.getElementById("livesucursal").style.border="0px";
	}
	else
	{
		xmlhttp=objetoAjax();
		clienteid=$("#cliente").attr("idcliente");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			
			document.getElementById("livesucursal").innerHTML=xmlhttp.responseText;
			document.getElementById("livesucursal").style.border="1px solid #A5ACB2";
			}
			else
			document.getElementById("livesucursal").innerHTML="cargando...";
		  }
		xmlhttp.open("POST","../Clases/Ajax/selectsucursal.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("sucursal="+str+"&cliente="+clienteid);  
	}
}



function ponerValorContrato(str){

	$("#contrato_mtotales").show();
	$("#contrato_mrestantes").show();
	$("#contrato_montototal").show();
	$("#contrato_montorestante").show();	
  document.getElementById('contratos').value=str.desc;
  document.getElementById('contratos').title=str.id;
  document.getElementById('contratos').setAttribute("idcontrato",str.id);
  document.getElementById('contrato_mtotales').value=str.montos;
  document.getElementById('contrato_mrestantes').value=str.montos;
  document.getElementById('livecontrato').innerHTML="";
  document.getElementById("livecontrato").style.border="0px";
  console.log('$( "#contrato" ).attr("idcontrato")');
}



function showResultContratos(str)
{
 
	if(str.length==0)
	{
		document.getElementById('livecontrato').innerHTML="";
		document.getElementById("livecontrato").style.border="0px";
	}
	else
	{
		xmlhttp=objetoAjax();
		clienteid=$("#cliente").attr("idcliente");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			
			document.getElementById("livecontrato").innerHTML=xmlhttp.responseText;
			document.getElementById("livecontrato").style.border="1px solid #A5ACB2";
			}
			else
			document.getElementById("livecontrato").innerHTML="cargando...";
		  }
		xmlhttp.open("POST","../Clases/Ajax/selectcontrato.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("contrato="+str+"&cliente="+clienteid);  
	}
}

