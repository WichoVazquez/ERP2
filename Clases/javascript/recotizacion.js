var cantidad_actual=0;
var nuevacotizacion=true;
var no_cotizacion;
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


function selectMoneda(sel)
{
	
	
					moneda=$("#moneda option:selected").attr("tipo_cambio"); 
					
					console.log('tipo de cambio'+moneda);
					$('#productos >tbody >tr').each(
						function() 
						{

						   var precio_base=($(this).find("td").eq(5).attr("title"))*1;
							var multip=($(this).find("td").eq(5).attr("multip"))*1;
						   var precio_total=($(this).find("td").eq(6).html())*1;
						   $(this).find("td").eq(5).html(($(this).find("td").eq(5).html()*multip*moneda).toFixed(2));
						   $(this).find("td").eq(5).attr("multip", multip);
						   $(this).find("td").eq(6).html(($(this).find("td").eq(3).html()*	precio_base*multip*moneda).toFixed(2));
});

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
  if (str.precio > 0 ){
  document.getElementById('preciobase').value=str.precio;
  document.getElementById('preciounit').value=str.precio;
}

  document.getElementById('existencia').value=str.cantidad_act;
  document.getElementById('livesearch').innerHTML="";
  document.getElementById("livesearch").style.border="0px";
  
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
	//document.getElementById('total').value=Math.round (total_c*100) / 100;
	$("#cantidad-promo").removeAttr("readonly");
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
		/*if(descuentotal)
		{
			$("#cantidad-promo").val("0");
	  		return;
		}*/
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



$(function() {

$('#descuentototal').hide();
$('#varcot').hide();

var producto = $( "#producto" ),
		cantidad=$("#cantidad"),
		precio=$("#preciounit"),
		total=$("#total"),
		aumento=$("#cantidad-promo"),
     allFields = $( [] ).add( producto ).add( cantidad ).add( precio ).add( preciobase).add(total).add(aumento).add($("#observaciones"));
		descuentos=descuentos+$("#no_descuentos").val()*1;
		

			
						 


	$( "#dialog_mail" ).dialog({
      autoOpen: false,
      height: 370,
      width: 600,
      modal: true,
      buttons: {
         "Aceptar":function(){
						enviarCotizacion({user: $("#passmail").val(), msg:$("#msgmail").val()});
					},
        "Cancelar": function() {
				$( this ).dialog( "close" );
					}
			
					
      },
      close: function() {
     $("#passmail").val("");
					$("#msgmail").html("");
      }
    });
 
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 500,
      modal: true,
      buttons: {
        "Agregar":function(){
						
						if(($("#total").val()*1)>0)
						{
							//console.log("debe salvar producto");
							saveProducto($( this ));
						}
					},
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
					if(this.value === ''){
						this.value = $(this).attr('title');
						$(this).addClass('text-label');
					}
    });
		} );
 $("#dialog-form").dialog( "open" );
      });
	$("#quitar-producto" )
      .button()
      .click(function() {

			for(x=($('#productos >tbody >tr').length)-1;x>-1;x--){
			
				var isChecked = $("#productos >tbody >tr input:checkbox")[x].checked;
				
			if(isChecked)
			{
			
				var inputi=$("#productos >tbody >tr").eq(x).find("input[type=checkbox]");//igual a el iddetalle
					 
					 det_cot=inputi.val();
					 var menos=$("#productos >tbody >tr").eq(x).find("td").eq(5).html();
					  var preciob=$("#productos >tbody >tr").eq(x).find("td").eq(4).attr('title');
					  var preciou=$("#productos >tbody >tr").eq(x).find("td").eq(4).html();
					  var desc=(preciou*1)/(preciob*1);
					  if(desc<1)
					  {
						console.log("quita descuentos");  
					  	manejoDescuentos(-1);
					  }
					 //console.log("Valor de monto tolal"+menos);
					 var mtotal=$("#mtotal").val();
					 mtotal=mtotal*1-menos*1;
					$("#mtotal").val(mtotal.toFixed(2));
					if(mtotal==0)
					{
						$('#descuentototal').hide();
					}
					 //console.log("Obtiene valor para borrar producto"+inputi.val());
					 var arr={detalle: det_cot};
					 deleteProducto(arr);
					 //console.log("borro producto");
					 $('#productos >tbody >tr').eq(x).remove();
					 //borrar producto de base de datos DETALLE-COTIZACION
				   }
			}
		/*}*/	
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
      });
	  $('#attach-file')
	  .button()
	  .click(function(e) {e.preventDefault();adjuntar($(this));});
	  $('#aplicar-desmuento')
	  .button()
	  .click(
	  		function(e) 
			{
					
					e.preventDefault();
					$("#cantidad-promot").attr("readonly","readonly");
					$("#mtotalaumento").attr("readonly","readonly"); 
					$("#agregar-producto").hide();
					$("#quitar-producto").hide();
					var multip=($("#mtotalaumento").val())/($("#mtotal").val());
					var moneda=$('#moneda option:selected').attr("tipo_cambio")*1;
					$('#productos >tbody >tr').each(
						function() 
						{
						   //var detalle_id=$(this).find("input[type=checkbox]").val();

						   
						   
						   var precio_base=($(this).find("td").eq(5).attr("title"))*1;

						   var precio_total=($(this).find("td").eq(6).html())*1;
						   
						   $(this).find("td").eq(5).html(($(this).find("td").eq(5).attr("title")*multip*moneda).toFixed(2));
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
								//console.log("det_cot antes:"+message);
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
			  $( "#dialog_adjuntar" ).dialog( "open" );

			  //enviarCotizacion(); //este procedimiento lo paso al dialog de mail
		  }
		//a borrar y mostrar mensaje de error
	  });
	  $("#guardar-cotizacion")
      .button()
      .click(function() {
		  		$( "#empresa" ).attr("disabled", "disabled");
				var msg_cot;
				var arr={cotizacion: $( "#cotizacion" ).val(), estado: $( "#estado" ).val(), cliente: $( "#cliente" ).attr("idcliente"), usuario: $( "#usuario" ).val(),  empresa: $( "#empresa" ).attr("idempresa"), folio:$( "#folio" ).val(), moneda: $( "#moneda" ).val(), cambio_dia: $( "#moneda option:selected" ).attr("tipo_cambio"), observaciones:"" , contacto:$( "#contacto" ).attr("idcontacto"), mensaje:$("#mensaje").val(),  dias_entrega:$("#dias_entrega").val(), condiciones: $("#condiciones").val(), tipocot: tipocotizacion, vigencia: $("#vigencia").val(), fecha_ini: $("#datepicker").val(), precio_cotizacion: $("#precio_cotizacion").val(), lab: $("#lab").val(), capacidad_entrega: $("#capacidad_entrega").val()
}
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
					//console.log("det_cot antes:"+message);
					
				}
			);
			hilo.done(	
						
						function(){
							
							checkChanges(false);
						}
			);
				
		  		
		  });


$( "#dialog_adjuntar" ).dialog({
      autoOpen: false,
      height: 150,
      width: 250,
      modal: true,
      buttons: {
        "NO": 
					function() 
					{
						$( this ).dialog( "close" );

						var arr1={
							accion : "obtenerCorreo", 
							cliente: $( "#cliente" ).attr("idcliente") 
						}
						console.log("las variables: "+$( "#cliente" ).attr("idcliente") );
			hilo=$.post(
				 '../Clases/Ajax/add_cotizacion.php',
				 JSON.stringify(arr1),
				 function(msg) {
					var message=msg;

					console.log ("si entre aqui pero nose que onda"+message);

					var aCorreos = JSON.parse( message );

					console.log("ESTO ES EL EMAIL:"+aCorreos[0][6]);

					$("#tomail").val(aCorreos[0][6]+";");

							}
						);

						 


						$( "#dialog_mail" ).dialog( "open" );
					}
		,

		"SI": function() {
					  	adjuntar($(this));
					}			
					
      },
      close: function() {
        			$("#passmail").val("");
					$("#msgmail").html("");
      }
    });
		

	});
  
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
		    var multip=$( "#preciounit" ).val()/$("#preciobase").val();
			var arr={cotizacion: $( "#cotizacion" ).val(), producto: $( "#producto" ).attr("idproducto"), cantidad: $( "#cantidad" ).val(), precio: $( "#preciobase" ).val(), observaciones: $( "#observaciones" ).val(), multiplo: multip, tipocot: 0}
			//saveProducto(arr);//ME DEBERIA REGRESAR EL DETALLE_PRODUCTO_ID PARA AGREGARLO A LA TABLA
        	/*a.-Muestra Tabla de Productos y Boton de Quitar*/
			var det_cot;
			hilo=$.post(
				 '../Clases/Ajax/add_detalle_producto.php',
				 JSON.stringify(arr),
				 function(msg) {
					var message=$.trim(msg);
					//if(message=="Error")
					//console.log("det_cot antes:"+message);
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
					preciounitario_formateado = parseFloat($( "#preciounit" ).val())*moneda;
total_formateado = $( "#total" ).val()*moneda;
					$( "#productos tbody" ).append( "<tr>" +
					  "<td><input type='checkbox' value='"+det_cot+"'></td>" +
					  "<td>" + $( "#producto" ).val()+ "</td>" +
					  "<td>" + $( "#cantidad" ).val() + "</td>" +
					  "<td>" + $( "#cantidad" ).attr("unidad") + "</td>" +
							"<td title='"+$("#preciobase").val()+"' multip='"+desc+"'>$ " +CommaFormatted(preciounitario_formateado.toFixed(2))+ "</td>" +
					  "<td>$ " + CommaFormatted(total_formateado.toFixed(2)) + "</td>" +
					  "<td>" + $( "#observaciones" ).val() + "</td>" +
					"</tr>" );
					
					
					mtotal=$("#mtotal").val();
					mtotal=mtotal*1+$( "#total" ).val()*1;
					$("#mtotal").val(mtotal.toFixed(2));
					varia.dialog( "close" );
					//si se hizo un aumento o descuento actualizar el monto total aumentado
			}
		);	
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
	var arr={cotizacion: $( "#cotizacion" ).val(), estado: 1, cliente: $( "#cliente" ).attr("idcliente"), usuario: $( "#usuario" ).val(),  empresa: $( "#empresa" ).attr("idempresa"), folio:$( "#folio" ).val(), moneda: $( "#moneda" ).val(), cambio_dia: $( "#moneda option:selected" ).attr("tipo_cambio"), observaciones:"" , contacto:$( "#contacto" ).attr("idcontacto"), mensaje:$("#mensaje").val(), dias_entrega:$("#dias_entrega").val(), condiciones: $("#condiciones").val(), tipocot: tipocotizacion, vigencia: $("#vigencia").val(), fecha_ini: $("#datepicker").val(), precio_cotizacion: $("#precio_cotizacion").val(), lab: $("#lab").val(), capacidad_entrega: $("#capacidad_entrega").val()
}
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
{
	var msg_cot;
	var flag=false;
	var arr={cotizacion: $( "#cotizacion" ).val(), estado:2, cliente: $( "#cliente" ).attr("idcliente"), usuario: $( "#usuario" ).val(),  empresa: $( "#empresa" ).attr("idempresa"), folio:$( "#folio" ).val(), moneda: $( "#moneda" ).val(), cambio_dia: $( "#moneda option:selected" ).attr("tipo_cambio"), observaciones:"" , contacto:$( "#contacto" ).attr("idcontacto"), mensaje:$("#mensaje").val(), dias_entrega:$("#dias_entrega").val(), condiciones: $("#condiciones").val(), password: mail.user, body_mail: mail.msg, tipocot: tipocotizacion, vigencia: $("#vigencia").val(), fecha_ini: $("#datepicker").val(), precio_cotizacion: $("#precio_cotizacion").val(), lab: $("#lab").val(), capacidad_entrega: $("#capacidad_entrega").val()
}
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
  //Habilitar Seleccion de Productos
  //alert("Activa Botones");
  //document.getElementById('agregar-producto').removeAttribute('disabled');
}	
function CommaFormatted(amount)
{
	var delimiter = ","; // replace comma if desired
	amount = new String(amount);
	var a = amount.split('.',2)
	var d = a[1];
	var i = parseInt(a[0]);
	if(isNaN(i)) { return ''; }
	var minus = '';
	if(i < 0) { minus = '-'; }
	i = Math.abs(i);
	var n = new String(i);
	var a = [];
	while(n.length > 3)
	{
		var nn = n.substr(n.length-3);
		a.unshift(nn);
		n = n.substr(0,n.length-3);
	}
	if(n.length > 0) { a.unshift(n); }
	n = a.join(delimiter);
	if(d.length < 1) { amount = n; }
	else { amount = n + '.' + d; }
	amount = minus + amount;
	return amount;
}