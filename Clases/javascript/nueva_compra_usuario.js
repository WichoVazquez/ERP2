

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
  //document.getElementById('agregar_producto').removeAttribute('disabled');
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
  document.getElementById('costobase').value=str.precio;
  document.getElementById('preciounit').value=str.precio;
  document.getElementById('existencia').value=str.cantidad_act;
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
	//document.getElementById('total').value=Math.round (total_c*100) / 100;
	$("#cantidad-promo").removeAttr("readonly");
}
function calcularMontosServicio(cant)
{
	var charpos = cant.search("[^0-9]"); //deberia aceptar decimales
	if(cant.length > 0 &&  charpos >= 0) 
	{ $("#cantidad_producto_nuevo").val("0");
	  return;
	}
	document.getElementById('preciounit-servicio').value = document.getElementById('costobase_producto_nuevo').value;
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
	document.getElementById('preciounit').value = document.getElementById('costobase').value;
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
	costobase=document.getElementById('costobase').value;
	document.getElementById('preciounit').value=costobase;
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
	costobase=document.getElementById('costobase_producto_nuevo').value;
	document.getElementById('preciounit-servicio').value=costobase;
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
		accion:"InsertarOrden",
	usuario_orden:$("#usuario").val(),
	proveedor_id:$( "#proveedor" ).attr("idproveedor"),
	req_id: $("#requisicion").val(),
	status:0
	};
	hilo=$.post(
				'../Clases/Ajax/add_ordencompra.php',
				JSON.stringify(arr),
				function(msg) {
				no_cotizacion=$.trim(msg);
				no_pedido= $.trim(msg);

				// eeeee
				
				$("#ordenno").val($.trim(msg));
				console.log("Se creo la orden de compra sumario chido:"+$("#ordenno").val());

			}
			);

}

function confirmPedido()
{

var depto = "";
console.log("FECHA INI:"+$( "#datepicker1" ).val()+"y FECHA FIN:"+$( "#datepicker2" ).val()+"PARAMETROS: "+document.getElementById('tipo_orden').value);
if ($( "#datepicker1" ).val()<=$( "#datepicker2" ).val()) {
	if (($( "#proveedor" ).val()!="")&&($("#condiciones").val()!="")&&($("#certificado").val()!="")&&($("#contacto_entrega").val()!="")&&($("#domicilio_entrega").val()!="")) {
if ($( "#empresa_req" ).val().trim() == "MOGEL FLUÍDOS S.A. de C.V.")
 depto = "VH-MF";
else
 depto = "VH-GD";

console.log("depto: "+depto);
console.log("tipo: "+$("#tipo_orden").val());

var arr={
accion: "ConfirmarOrden",
orden_id: $("#ordenno").val(),
fechaini_orden:$( "#datepicker1" ).val(),
fechafin_orden:$( "#datepicker2" ).val(),
obs_orden:$( "#observaciones_ped" ).val(),
proveedor_id: $( "#proveedor" ).attr("idproveedor"),
proveedor_contacto: $( "#contacto" ).val(),
proveedor_email: $( "#email_contacto").val(),
proveedor_tel: $( "#tel_contacto" ).val(),
status: 1,
departamento: depto,
condiciones: $("#condiciones").val(),
certificado: $("#certificado").val(),
contacto_entrega: $("#contacto_entrega").val(),
domicilio_entrega: $("#domicilio_entrega").val(),
tipo_orden: $("#tipo_orden").val()

};

hilo=$.post(
	'../Clases/Ajax/add_ordencompra.php',
	JSON.stringify(arr),
	function(msg) {
		var message=$.trim(msg);
console.log("EL MENSAJE CHAFA DE CONFIRM: "+message);
if(message=="OK")
{
						alert("Se guardó satisfactiamente la Orden de Compra");
						$( "#dialog_instrucciones44" ).dialog("open");
				
}
else
							alert("Error al guardar Pedido");

		}
		);
}else{
	alert("Faltan Campos por Llenar");
}
}else{
	alert("Favor de Revisar las Fechas");
}
}

function showResultCliente(str)
{
 
if(str.length===0)
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

function saveCompra(varia){

					for(x=($('#Orden >tbody >tr').length)-1;x>-1;x--){
							
								if($("#Orden >tbody >tr input:radio")[x].checked)
								{  
								$("#id_req").val($("#Orden >tbody >tr").eq(x).find("td").eq(1).html());
        $("#empresa_req").val($("#Orden >tbody >tr").eq(x).find("td").eq(2).html());
									$("#usuario_req").val($("#Orden >tbody >tr").eq(x).find("td").eq(3).html());
									$("#fechaini_req").val($("#Orden >tbody >tr").eq(x).find("td").eq(4).html());
									$("#fechafin_req").val($("#Orden >tbody >tr").eq(x).find("td").eq(5).html());
									$("#obs_req").val($("#Orden >tbody >tr").eq(x).find("td").eq(6).html());



																																		
								$("#requisicion").val($("#Orden >tbody >tr").eq(x).find("input[type=radio]").val());

								}
						}
//		
//alert(agregados);
$('#orders-contain_cotizacion').show();



}





  $(function() {
  	$('#agregar-req').show();
$('#ref-pago').hide();
$('#descuentototal').hide();
 $('#panelchecktotal5').hide();
  	$('#orders-contain_cotizacion').hide();
	   $( '#dialog-form' ).tooltip();
	   $( '#dialog_producto_nuevo' ).tooltip();
	   $('#panelcliente').hide();
	   $('#varcot').hide();
	   $('#products-contain').hide();
	   $('#descuentototal').hide();
	   $('#divguardar').hide();
	   //document.getElementById('agregar_producto').setAttribute('disabled', 'disabled');//document.getElementById('quitar-producto').setAttribute('disabled', 'disabled');
	 //  $('#agregar_producto').hide();//boton Agregar escondido

	   $('#agregar_producto_nuevo').show();//boton Agregar escondido
	   $('#quitar-producto').hide();//boton Quitar escondido
	   //$('#attach-file').hide();//boton Adjuntar escondido
	   $('#formato').hide();
	   $('#sucursal').hide();
			IniciaTodo();

	  var producto = $( "#producto" ),
		cantidad=$("#cantidad"),
		costobase=$("#costobase"),
		precio=$("#preciounit"),
		total=$("#total"),
		aumento=$("#cantidad-promo"),
      	allFields = $( [] ).add( producto ).add( cantidad ).add( precio ).add( costobase).add(total).add(aumento).add($("#observaciones"));


      	$( "#dialog_instrucciones44" ).dialog({
      autoOpen: false,
      height: 600,
      width: 600,
      modal: true,
      buttons: {
        "Aceptar": 
          function() 
          {
          window.location.href = 'compra_busqueda_usuario.php';
            
            
            
          }
    ,
        "Cancelar": function() {
           window.location.href = 'compra_busqueda_usuario.php';
          }
      
          
      },
      close: function() {
               window.location.href = 'compra_busqueda_usuario.php';
      }
    });

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
						for(x=($('#Orden_sumario >tbody >tr').length)-1;x>-1;x--){
						  	if($("#Orden_sumario >tbody >tr input:checkbox")[x].checked)
										   {
						if ($("#Orden_sumario >tbody >tr").eq(x).find("input[id=id_costo_orden]").val()=="")
      {
       
       alert("Favor de Ingresar  el COSTO");
      }
      else{
						console.log("ENTRE AL BOTON");

//borrar producto de base de datos DETALLE-COTIZACION
     for(x=($('#Orden_sumario >tbody >tr').length)-1;x>-1;x--){
									
										
										
						if($("#Orden_sumario >tbody >tr input:checkbox")[x].checked)
										   {
		      var multip=$( "#preciounit" ).val()/$("#costobase").val();
   var arr={
    accion: "InsertarDetalleOrden",
    orden_id: $("#ordenno").val(),
    producto_id: $("#Orden_sumario >tbody >tr").eq(x).find("input[type=checkbox]").val(), 
    producto_descripcion: $("#Orden_sumario >tbody >tr").eq(x).find("td").eq(1).html(),
    cantidad: $("#Orden_sumario >tbody >tr").eq(x).find("input[id=id_cantidad_orden]").val(), 
    costo: $("#Orden_sumario >tbody >tr").eq(x).find("input[id=id_costo_orden]").val(),
    unidad: $("#Orden_sumario >tbody >tr").eq(x).find("td").eq(2).html()
   }
   //saveProducto(arr);//ME DEBERIA REGRESAR EL DETALLE_PRODUCTO_ID PARA AGREGARLO A LA TABLA
         /*a.-Muestra Tabla de Productos y Boton de Quitar*/
   var det_cot;
   hilo=$.post(
     '../Clases/Ajax/add_detalle_orden.php',
     JSON.stringify(arr),
     function(msg) {
     var message=$.trim(msg);
     //if(message=="Error")
     console.log("det_cot antes:"+message);
     det_cot=message;
    }
   );

     console.log("det_cot="+det_cot);
     $('#products-contain').show();
     $("#Guardar-Borrador").hide();
     $('#quitar-producto').show();
     /**/
     var desc=($("#preciounit").val()*1)/($("#costobase").val());
     console.log("desc="+desc);
     console.log("Muestra Panel");

     $( "#productos tbody" ).append( "<tr>" +
       "<td><input type='checkbox' value='"+det_cot+"'></td>" +
       "<td>" + $("#Orden_sumario >tbody >tr").eq(x).find("td").eq(1).html() + "</td>" +
       "<td>" + $("#Orden_sumario >tbody >tr").eq(x).find("input[id=id_cantidad_orden]").val() + "</td>" +
       "<td>" + $("#Orden_sumario >tbody >tr").eq(x).find("td").eq(2).html() + "</td>" +
       "<td>" + $("#Orden_sumario >tbody >tr").eq(x).find("input[id=id_costo_orden]").val() + "</td>" +
     "</tr>" );
     
 

     

						/*					 
							  document.getElementById('producto').value=$("#Orden_sumario >tbody >tr").eq(x).find("td").eq(1).html();
							  document.getElementById('producto').setAttribute("idproducto", $("#Orden_sumario >tbody >tr").eq(x).find("input[type=checkbox]").val());
					
							  document.getElementById('cantidad').setAttribute("unidad", $("#Orden_sumario >tbody >tr").eq(x).find("td").eq(2).html());
							  document.getElementById('cantidad').value=$("#Orden_sumario >tbody >tr").eq(x).find("input[id=id_cantidad_orden]").val();
						
							  document.getElementById('costobase').value=$("#Orden_sumario >tbody >tr").eq(x).find("input[id=id_costo_orden]").val();
							  
*/

	//						saveProducto($( this ));
													 
					 }
				}
						$( this ).dialog( "close" );
						}
				}
				}
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
      width: 650,
      modal: true,
      buttons: {
        "Agregar": 
					function() 
					{
						
		
									if ($("#ordenno").val()==0)
									
											console.log("El pedido no tiene NO");				
									else 
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
 	
 	$( "#dialog_producto_nuevo" ).dialog({
      autoOpen: false,
      height: 500,
      width: 500,
      modal: true,
      buttons: {
        "Agregar": 
					function() 
					{
						
	
							saveServicio($( this ));
			
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
	
    $("#agregar_producto")
      .button()
      .click(function() {
      
      		console.log("PEDIDO: "+$("#ordenno").val());

      	if ($("#ordenno").val()==0)
      		savePedido();
      //	$('#dialog-form-req').hide();
			$("#agregar-req").hide();
		
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




      $("#agregar_producto_nuevo")
      .button()
      .click(function() {



      		console.log("PEDIDO: "+$("#ordenno").val());

      	if ($("#ordenno").val()==0)
      		savePedido();
      //	$('#dialog-form-req').hide();
			$("#agregar-req").hide();
		
		$("#producto_desc").val("");
		$("#cantidad_producto_nuevo").val("1");
		$("#costobase_producto_nuevo").val("");
	  
        $( "#dialog_producto_nuevo" ).dialog( "open" );

       
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



  


	  $("#vista-previa" )
      .button()
      .click(function() {
      	 $('<iframe id="attach-files" src="../Clases/pdf/createremision.php?cot='+$("#requisicion").val()+'" />').dialog({
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
					$("#agregar_producto").hide();
					$("#agregar_producto_nuevo").hide();
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
			  $( "#dialog_mail" ).dialog( "open" );

			  //enviarCotizacion(); //este procedimiento lo paso al dialog de mail
		  }
		//a borrar y mostrar mensaje de error
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


  $( "#dialog-form-req" ).dialog({
      autoOpen: false,
      height: 650,
      width: 700,
      modal: true,
      buttons: {
        "Agregar": 
					function() 
					{
						
						console.log("manda producto a html");
						saveCompra($( this ));

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

	
      $("#agregar-req")
      .button()
      .click(function() {
					 
        IniciaTodo();

		
      });

      $("#agregar_detalle_req")
      .button()
      .click(function() {
					 
        IniciaDetalleOrden();

		
      });
	});
  
function IniciaTodo(){
		   $('#agregar_producto').show();//boton Agregar escondido
	   $('#agregar-req').show();
	$('#panelchecktotal').show();


			var arr1={
			accion: "ObtieneRequisiciones"
			}
			
					$("#Orden tbody").empty();
					
						
			hilo=$.post(
				 '../Clases/Ajax/add_reqcompra.php',
				 JSON.stringify(arr1),
				 function(msg) {
					var message=msg;

					console.log ("si entre aqui pero nose que onda"+message);

					var aDetalle = JSON.parse( message );


					var checked="";

					if(aDetalle != null)
					{
						for(x=0;x<(aDetalle.length);x++){

						   
						   $( "#Orden tbody" ).append( "<tr>" +
						  "<td><input type='radio' name='idReqCheck' value='"+ aDetalle[x][0]+"'></td>" +
						  "<td>" + aDetalle[x][8] + "</td>" +
						  "<td>" + aDetalle[x][5] + "</td>" +
						  "<td>" + aDetalle[x][4] + "</td>" +					  
						  "<td>" + aDetalle[x][1] + "</td>" +					  
						  "<td>" + aDetalle[x][2] + "</td>" +	
						   "<td>"+ aDetalle[x][6] +  "</td>" +
						"</tr>" );
						   
		  				}
						
										
						$( "#dialog-form-req" ).dialog( "open" );
						
					}else
					{ alert("No existen Cotizaciones a asignar");
					}
							
				}
			);	
		
}

function IniciaDetalleOrden(){
		 //boton Agregar escondido

			var arr1={
			accion: "obtenerDetalleRequisicion",
			idrequisicion: $("#requisicion").val()
			}
			
					$("#Orden_sumario tbody").empty();
					
						
			hilo=$.post(
				 '../Clases/Ajax/add_reqcompra.php',
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
						  "<td><input type='checkbox' name='idReqCheck'  value='"+ aDetalle[x][7]+"'></td>" +
						  "<td>" +  aDetalle[x][6]+ "</td>" +
						  "<td>" +  aDetalle[x][5] + "</td>" +
						  "<td>"+ " <input type='stext' name='id_cantidad_orden' id='id_cantidad_orden' value='"+aDetalle[x][3] +"' size='5'  onkeypress=\"return NumDecimal(event)\" />" +  "</td>" +
						   "<td>"+ " $ <input type='text' name='id_costo_orden' id='id_costo_orden' value='' size='5'  onkeypress=\"return NumDecimal(event)\" />" +  "</td>" +
					
						"</tr>" );
						   
		  				}
						
						if ($("#ordenno").val()==0)
				      		savePedido();
      //	$('#dialog-form-req').hide();
						      $("#agregar-req").hide();
   
										
			$( "#Mostrar_todo" ).dialog( "open" );
						
					}else
					{ alert("No existen Cotizaciones a asignar");
					}
							
				}
			);	
		
}
 function adjuntar(form){	
 			
     			
            $('<iframe id="attach-files" src="adjuntar_archivos.php?cot='+$("#requisicion").val()+'" />').dialog({
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

function saveProducto(varia){
		console.log("El peddo chido:"+$("#ordenno").val());

		    var multip=$( "#preciounit" ).val()/$("#costobase").val();
			var arr={
				accion: "InsertarDetalleOrden",
				orden_id: $("#ordenno").val(),
				producto_id: $( "#producto" ).attr("idproducto"), 
				producto_descripcion: $( "#producto" ).val(),
				cantidad: $( "#cantidad" ).val(), 
				costo: $( "#costobase" ).val(),
				unidad: $( "#cantidad" ).attr("unidad")
			}
			//saveProducto(arr);//ME DEBERIA REGRESAR EL DETALLE_PRODUCTO_ID PARA AGREGARLO A LA TABLA
        	/*a.-Muestra Tabla de Productos y Boton de Quitar*/
			var det_cot;
			hilo=$.post(
				 '../Clases/Ajax/add_detalle_orden.php',
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
					$("#Guardar-Borrador").hide();
					$('#quitar-producto').show();
					/**/
					var desc=($("#preciounit").val()*1)/($("#costobase").val());
					console.log("desc="+desc);
					console.log("Muestra Panel");

					$( "#productos tbody" ).append( "<tr>" +
					  "<td><input type='checkbox' value='"+det_cot+"'></td>" +
					  "<td>" + $( "#producto" ).val()+ "</td>" +
					  "<td>" + $( "#cantidad" ).val() + "</td>" +
					  "<td>" + $( "#cantidad" ).attr("unidad") + "</td>" +
					  "<td>" + $( "#costobase" ).val() + "</td>" +
					"</tr>" );
					
				
					varia.dialog( "close" );
					//si se hizo un aumento o descuento actualizar el monto total aumentado
			}
		);	
}

function saveServicio(varia){//arr{cotizacion,producto, cantidad, precio}


		//añadir producto a base de datos DETALLE-COTIZACION

			var arr={

				accion: "InsertarDetalleOrden",
				orden_id: $("#ordenno").val(), 
				producto_id: "NULL", 
				producto_descripcion: $( "#producto_desc" ).val(),
				cantidad: $( "#cantidad_producto_nuevo" ).val(),
				costo: $( "#costobase_producto_nuevo" ).val(),
				unidad: $( "#unidad_producto_nuevo" ).val()

			}
			//saveProducto(arr);//ME DEBERIA REGRESAR EL DETALLE_PRODUCTO_ID PARA AGREGARLO A LA TABLA
        	/*a.-Muestra Tabla de Productos y Boton de Quitar*/
			var det_cot;
			hilo=$.post(
				 '../Clases/Ajax/add_detalle_orden.php',
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
					var desc=($("#preciounit-servicio").val()*1)/($("#costobase_producto_nuevo").val());
					console.log("desc="+desc);
					console.log("Muestra Panel SERVICIOS");

									$( "#productos tbody" ).append( "<tr>" +
					  "<td><input type='checkbox' value='"+det_cot+"'></td>" +
					  "<td>" + $( "#producto_desc" ).val()+ "</td>" +
					  "<td>" + $( "#cantidad_producto_nuevo" ).val() + "</td>" +
					  "<td> "+$( "#unidad_producto_nuevo" ).val()+" </td>" +
					  "<td>" + $( "#costobase_producto_nuevo" ).val() + "</td>" +
					"</tr>" );
					
	
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
		showResultSucursal(" ");
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
	$('#agregar_producto').show();

  if(document.getElementById('tipo-servicio').checked==true)
  {
  	 $('#agregar_producto_nuevo').show();
  }
 
  $('#tipo-estandar').attr("disabled", "disabled");
  $('#tipo-servicio').attr("disabled", "disabled");
  //Habilitar Seleccion de Productos
  //alert("Activa Botones");
  //document.getElementById('agregar_producto').removeAttribute('disabled');
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
	$('#agregar_producto').show();

  if(document.getElementById('tipo-servicio').checked==true)
  {
  	 $('#agregar_producto_nuevo').show();
  }
 
  $('#tipo-estandar').attr("disabled", "disabled");
  $('#tipo-servicio').attr("disabled", "disabled");
  //Habilitar Seleccion de Productos
  //alert("Activa Botones");
  //document.getElementById('agregar_producto').removeAttribute('disabled');
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
		xmlhttp.send("sucursal="+str+"&cliente="+$("#cliente_req").val());  
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

function ponerValorProveedor(str){
  document.getElementById('proveedor').value=str.desc;
  document.getElementById('proveedor').title=str.id;
  document.getElementById('proveedor').setAttribute("idproveedor",str.id);

  document.getElementById('contacto').value=str.contacto;
  document.getElementById('email_contacto').value=str.email_contacto;
  document.getElementById('tel_contacto').value=str.tel_contacto;

  document.getElementById('liveproveedor').innerHTML="";
  document.getElementById("liveproveedor").style.border="0px";

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