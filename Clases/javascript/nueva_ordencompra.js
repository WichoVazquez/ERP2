

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

function ponerValorProveedor(str){
  document.getElementById('proveedor').value=str.desc;
  document.getElementById('proveedor').title=str.id;
  document.getElementById('proveedor').setAttribute("idproveedor",str.id);
  document.getElementById('liveproveedor').innerHTML="";
  document.getElementById("liveproveedor").style.border="0px";
  //Habilitar Seleccion de Productos
  //alert("Activa Botones");
  //document.getElementById('agregar-producto').removeAttribute('disabled');

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
if(str.length===0)
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

function saveOrden(str)
{
var arr={
	accion: "InsertarReq",
	cliente: str,
	usuario: $("#usuario").val(),
	fecha_req: $("#datepicker").val(),
	observaciones: $("#orden_mensaje").val(),
 empresa_id: 3
	};
hilo=$.post(
		 '../Clases/Ajax/add_reqcompra.php',
		 JSON.stringify(arr),
		 function(msg) {
			no_orden=$.trim(msg);
			//console.log(no_orden);
			$("#orden").val(msg);
			console.log("Creo la Requisición y la carpeta de archivos"+msg);
		}
		);

}



function showResultProveedor(str)
{
 
if(str.length===0)
{
	document.getElementById('liveproveedor').innerHTML="";
    document.getElementById("liveproveedor").style.border="0px";
}
else
{
xmlhttp=objetoAjax();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("liveproveedor").innerHTML=xmlhttp.responseText;
    document.getElementById("liveproveedor").style.border="1px solid #A5ACB2";
    }
  }
xmlhttp.open("POST","../Clases/Ajax/selectproveedor_id.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("proveedor="+str);  
}
}

  $(function() {
	 
$("#PROVEEDOR_noestara").hide()
    	$("#datepicker").datepicker();
 
	   $('#panelproveedor').show();
	   $('#varcot').hide();
	   $('#products-contain').hide();
	   $('#descuentototal').hide();
	   $('#divguardar').hide();
	   $('#agregar-producto').hide();//boton Agregar escondido
	   $('#quitar-producto').hide();//boton Quitar escondido
	   $('#attach-file').hide();//boton Adjuntar escondido
	   $('#formato').hide();
	  var producto = $( "#producto" ),
		cantidad=$("#cantidad"),
		preciobase=$("#preciobase"),
		precio=$("#preciounit"),
		total=$("#total"),
		aumento=$("#cantidad-promo"),
      	allFields = $( [] ).add( producto ).add( cantidad ).add( precio ).add( preciobase).add(total).add(aumento).add($("#observaciones"));
		
	
IniciaOrdenCompra();

 
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 500,
      modal: true,
      buttons: {
        "Agregar": 
					function() 
					{
						

							console.log("debe salvar producto");
							saveProducto($( this ));
						
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
	  		
		  		//generar_orden_compra();	
				
		  		
		 var msg_compra;
				var arr={
					accion: "UpdateReq",
					req_id: no_orden, 
					estado: 1, 
          cliente_id: 0, 
          usuario_id: $( "#usuario" ).val(),
          fecha_req: $("#datepicker").val(),
          proyecto: "",
          descripcion: "",
          lugar_entrega: "",
          observaciones:$("#orden_mensaje").val(),
          empresa_id: 3
					
					
				}
			hilo=$.post(
				 '../Clases/Ajax/add_reqcompra.php',
				 JSON.stringify(arr),
				 function(msg) {
					msg_compra=$.trim(msg);
					console.log("MENSAJE DE UPDATE:"+msg_compra);
					alert("Requisición de compra Generada");

						
						

					//if(message=="Error")
					//console.log("det_cot antes:"+message);
					
				}
			);
			hilo.done(	
						function() {
var isChecked;
 // para cada checkbox "chequeado"
  $("#prueba_compra >tbody >tr input[type=checkbox]:checked").each(function(){

    // buscamos el td más cercano en el DOM hacia "arriba"
    // luego encontramos los td adyacentes a este
    //$(this).closest('td').siblings().each(function(){

      // obtenemos el texto del td 
      //console.log($(this).text());
      //console.log("---->      ");
      console.log($(this).val());
   //});
     isChecked =$(this).val();

    console.log("valor de ischecked "+isChecked);

    var arr={
                                          accion: "Insertar_DetalleReq",
                                          no_orden_compra: no_orden, 
                                          producto: isChecked, 
                                          cantidad: $("#cantidad"),
                                          observaciones:$("#orden_mensaje").val(),
                                          pedido_id: 0

                                          }

                                          var det_ord;
                                          hilo_EXTRA=$.post(
                                             '../Clases/Ajax/add_detalle_reqorden.php',
                                             JSON.stringify(arr),
                                             function(msg) {
                                              var message=$.trim(msg);
                                              det_ord=message;

                                            });

    

  });
 
  
      });
			
				//$( "#dialog_instrucciones44" ).dialog( "open" );
		  		
		 
      
	});
});

function generar_orden_compra()
{
  
  
  var datepickervalue = document.getElementById("datepicker").value;
      if(datepickervalue != ""){
        var no_orden;
        console.log("fecha "+datepickervalue);
        var arr={
          
          accion: "InsertarReq_OS",
          estado: 1, 
          cliente_id: 0, 
          usuario_id: $( "#usuario" ).val(),
          fecha_req: datepickervalue,
          proyecto: "",
          descripcion: "",
          lugar_entrega: "",
          observaciones:$("#orden_mensaje").val(),
          empresa_id: 3
         
          
        }
        
hilo=$.post(
     '../Clases/Ajax/add_reqcompra.php',
     JSON.stringify(arr),
     function(msg) {
      no_orden=$.trim(msg);
      console.log("Creo la Compra y la carpeta de archivos"+msg);
    }
    );
      hilo.done(              
            function(){

                      //for(x=($('#prueba_compra >tbody >tr').length)-1;x>-1;x--){

                        
                              var isChecked_autorizacion = $("#idedit").checked;
                              //console.log("numero de detalle pedido id "+$("#prueba_compra >tbody >tr").eq(x).find("input[type=checkbox]").attr("detalle_pedido_id"));
                                     if(isChecked_autorizacion)
                                     {
                                        var arr={
                                          accion: "Insertar_DetalleReq",
                                          no_orden_compra: no_orden, 
                                          producto: $("#idedit"), 
                                          cantidad: $("#cantidad"),
                                          observaciones:$("#orden_mensaje").val(),
                                          pedido_id: 0

                                          }

                                          var det_ord;
                                          hilo_EXTRA=$.post(
                                             '../Clases/Ajax/add_detalle_reqorden.php',
                                             JSON.stringify(arr),
                                             function(msg) {
                                              var message=$.trim(msg);
                                              det_ord=message;

                                            });
                                     }// IF
                                    
                      //}  //for de Explosion
                      //var var1=$("#pedido_id").val();
                      //console.log("var1 "+var1);
                      //var var2=$("#var_2").val();
                      //console.log("var2 "+var2);
                      alert("Se creó la Requisición No. "+no_orden);
                      //window.location.href = 'http://localhost/sistemaMogel/interfaces/almacen_detalle_ordenSalida.php?var='+var1+'&var2='+var2+'';
      });
  }else{
   alert("Ingresa Fecha");
   $( this ).dialog( "open" );
}




}

function IniciaOrdenCompra(){
		  $('#agregar-producto').show();
  $('#attach-file').show();
  if(nueva_ordencompra)//si se va a crear una nueva cotizacion
  {
    console.log("Entre al SaveOrden: "+"0");
    saveOrden(0);
	nueva_ordencompra=false;
	$('#divguardar').show();
	checkChanges(true);
  }
  else
  {
  	checkChanges(true);
	console.log("No entre a SaveOrden"+str.id);
  }
  $('#agregar-producto').show();
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
					$( "#moneda" ).hide();
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
		  $('#panelchecktotal').hide();
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
		  $('#panelchecktotal').hide();
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

function enviarCotizacion()
{
	var msg_cot;
	var flag=false;
	var arr={cotizacion: no_orden, estado: 2, cliente: $( "#cliente" ).attr("idcliente"), usuario: $( "#usuario" ).val(),  empresa: $( "#empresa" ).val(), folio:$( "#folio" ).val(), moneda: $( "#moneda" ).val(), cambio_dia: moneda, observaciones:"" , contacto:$( "#contacto" ).attr("idcontacto"), mensaje:$("#mensaje").val()}
			hilo=$.post(
				 '../Clases/Ajax/update_ordencompra.php',
				 JSON.stringify(arr),
				 function(msg) {
					msg_compra=$.trim(msg);
					if(!isNaN(msg))
					{
						console.log("Guardo Autorizacion:"+msg_compra);
						flag=true;
					}
					else
						alert("Error BD:"+msg_compra);
				}
			);
			hilo.done(	
						
						function(){
							if(flag)
							{
							checkChanges(false);
							window.location.href = 'COMPRAS.php';
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