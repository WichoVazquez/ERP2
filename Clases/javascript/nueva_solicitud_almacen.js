

var cantidad_actual=0;
var nueva_ordencompra=true;
var no_orden;
var descuentos=0;
var aumentos=0;
var descuentototal=false;
var aplicar_total=false;
var empresa_id;
var cambios=false;
var folio=0;
var moneda=1;
//var 

function detalleRuta(id)
{
	
	$("#dialog").attr("title", "Materiales Solicitados")
	ajax=objetoAjax();
	ajax.onreadystatechange=function()
	  {
		  if (ajax.readyState==4 && ajax.status==200)
			{
				document.getElementById("dialog").innerHTML=ajax.responseText;
				$("#dialog").dialog("open");
			}
	  }
	ajax.open("POST","../Clases/Ajax/detalle_solicitud_materiales.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+id);
}

function selectEmpresa(sel)
{
	var empresa_id=$("#empresa").val();
	$('#continuar-cotizacion').hide();
	if(empresa_id!="0")
	{
		$('#panelcliente').show();
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


function ponerValorMaterial(str){
  document.getElementById('producto').value=str.desc;
  //$("#producto").attr("idproducto", str.id);
  document.getElementById('producto').setAttribute("idproducto", str.id);
  document.getElementById('producto_id_txt').value= str.id;
  //$("#cantidad").attr("disabled", "enabled");
  document.getElementById('cantidad').removeAttribute("readonly");
  //$("#cantidad").attr("unidad", str.unidad);
  document.getElementById('cantidad').setAttribute("unidad", str.unidad);
  document.getElementById('cantidad').setAttribute("title", str.unidad);
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
		cant=cant*-1;
		
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
	totalbase=document.getElementById('mtotal').value
	
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


  $(function() {
	   $( document ).tooltip();

    	$("#datepicker").datepicker();
  
	   $('#panelproveedor').show();
	   $('#varcot').hide();
	   $('#products-contain').hide();
	   $('#descuentototal').hide();
	   $('#divguardar').hide();
	   //document.getElementById('agregar-producto').setAttribute('disabled', 'disabled');//document.getElementById('quitar-producto').setAttribute('disabled', 'disabled');
	   $('#agregar-producto').show();//boton Agregar escondido
	   $('#quitar-producto').show();//boton Quitar escondido
	   $('#attach-file').hide();//boton Adjuntar escondido
	   $('#formato').hide();
	   /*$("#moneda").change(function () {
		  var str = "";
		  $("select option:selected").each(function () {
				str += $(this).text() + " ";
			  });
		  $("div").text(str);
		})*/
	  var producto = $( "#producto" ),
		cantidad=$("#cantidad"),
      	allFields = $( [] ).add( producto ).add( cantidad ).add($("#observaciones"));

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
	  width: 700,
      height: 400,
	  overlay: {
                    opacity: 0.5,
					
                    background: "white",
					
      }
	  
	  
	}).width(700).height(400).css("background", "#ffffff");
		
 
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 500,
      modal: true,
      buttons: {
        "Agregar": 
					function() 
					{
						
						if(($("#total").val()*1)>0)
						{
							//console.log("debe salvar producto");
							saveProducto($( this ));
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
		$("#cantidad").attr("readonly", "readonly");
		$("#cantidad").val("0");
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
					 var menos=$("#productos >tbody >tr").eq(x).find("td").eq(6).html();
					  var preciob=$("#productos >tbody >tr").eq(x).find("td").eq(5).attr('title');
					  var preciou=$("#productos >tbody >tr").eq(x).find("td").eq(5).html();
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
			  enviarCotizacion();
		  }
		//a borrar y mostrar mensaje de error
	  });
	  $("#guardar-orden")
      .button()
      .click(function() {
	  		
		  			console.log("ENTRE A GUARDAR: no_orden: "+no_orden+"proveedor: "+$( "#proveedor" ).attr("idproveedor")+"usuario: "+$( "#usuario" ).val()+"moneda: "+$( "#moneda" ).val()+"observaciones: "+$("#orden_mensaje").val()+"fecha: "+$("#datepicker").val());

				var msg_compra;
				var arr={
					orden_id: no_orden, 
					estado: 1, 
					proveedor_id: $( "#proveedor" ).attr("idproveedor"), 
					usuario_id: $( "#usuario" ).val(),
					moneda: $( "#moneda" ).val(), 
					cambio_dia: moneda, 
					observaciones:$("#orden_mensaje").val(), 
					fecha_entrega: $("#datepicker").val()
				}
			hilo=$.post(
				 '../Clases/Ajax/update_ordencompra.php',
				 JSON.stringify(arr),
				 function(msg) {
					msg_compra=$.trim(msg);
					console.log("MENSAJE DE UPDATE:"+msg_compra);
					alert("Orden de Compra Generada");
						window.location.href = 'COMPRAS.php';
						

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
	});
 

function saveProducto(varia){//arr{cotizacion,producto, cantidad, precio}
		//añcadir producto a base de datos DETALLE-COTIZACION
		    console.log("Numero de orden:"+no_orden);
		    var multip=$( "#preciounit" ).val()/$("#preciobase").val();
			var arr={
				no_orden_compra: no_orden, 
				producto: $( "#producto" ).attr("idproducto"), 
				cantidad: $( "#cantidad" ).val()
			}
			//saveProducto(arr);//ME DEBERIA REGRESAR EL DETALLE_PRODUCTO_ID PARA AGREGARLO A LA TABLA
        	/*a.-Muestra Tabla de Productos y Boton de Quitar*/
			var det_ord;
			hilo=$.post(
				 '../Clases/Ajax/add_detalle_orden.php',
				 JSON.stringify(arr),
				 function(msg) {
					var message=$.trim(msg);
					//if(message=="Error")
					//console.log("det_cot antes:"+message);
					det_ord=message;
				}
			);
			hilo.done(	
			function(){
					console.log("det_ord="+det_ord);
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
					  "<td><input type='checkbox' value='"+det_ord+"'></td>" +
					  "<td>" + $( "#producto" ).attr("idproducto")+ "</td>" +
					  "<td>" + $( "#producto" ).val()+ "</td>" +
					  "<td>" + $( "#cantidad" ).val() + "</td>" +
					  "<td>" + $( "#cantidad" ).attr("unidad") + "</td>" +
					  "<td title='"+$("#preciobase").val()+"' multip='"+desc+"'>" + $( "#preciounit" ).val()*moneda + "</td>" +
					  "<td>" + $( "#total" ).val()*moneda + "</td>" +
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
	//	$('#formato').show();
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
	var arr={
					orden: no_orden, 
					estado: 1, 
					proveedor: $( "#proveedor" ).attr("idproveedor"), 
					usuario: $( "#usuario" ).val(),
					moneda: $( "#moneda" ).val(), 
					cambio_dia: moneda, 
					observaciones:$("#orden_mensaje").val(), 
					fecha_entrega: $("#fecha_entrega").val()
				}


			hilo=$.post(
				 '../Clases/Ajax/update_cotizacion.php',
				 JSON.stringify(arr),
				 function(msg) {
					msg_cot=$.trim(msg);
					console.log("Guardo Autorizacion:"+msg_cot);
					//if(message=="Error")
					//console.log("det_cot antes:"+message);
					
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

function Pagina(nropagina){
 	ajax=objetoAjax();
 	var bus=document.getElementById("search").value;  
	document.getElementById("sentencias").innerHTML="cargando...";  
	ajax.onreadystatechange=function()
	  {
		  if (ajax.readyState==4 && ajax.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=ajax.responseText;
			}
	  }
	ajax.open("POST","../Clases/Ajax/busquedaSolicitudMaterial.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+bus+"&pag="+nropagina);
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

