

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
var mtotal=0;
var mtotal_pesos=0;
var mtotal_dlls=0;
var tipocotizacion=0;
var bandera_salida = 0;
var muestra_existencia_ban = 0;
var muestra_flete_ban = 0;
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
		 document.getElementById('cliente').value="Seleccione un Cliente";
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

   console.log("TIPO MONEDA:"+$('#moneda option:selected').val()); 

   if($('#moneda option:selected').val()==1)
     		 document.getElementById("precio_cotizacion").value="En Moneda Nacional más el I.V.A.";
   else
        document.getElementById("precio_cotizacion").value="En Dólares Americanos más el I.V.A.";



					console.log('tipo de cambio'+moneda);
/*
					$('#productos >tbody >tr').each(
						function() 
						{

						   var precio_base=($(this).find("td").eq(4).attr("title"))*1;
							var multip=($(this).find("td").eq(4).attr("multip"))*1;
						   var precio_total=($(this).find("td").eq(5).html())*1;

						   console.log("Imprimiendo lo de la moneda:"+$(this).find("td").eq(4).html());
						   console.log("Cantidad:"+$(this).find("td").eq(2).html());
						   console.log("total:"+$(this).find("td").eq(5).html());

						   $(this).find("td").eq(4).html(($(this).find("td").eq(4).html()*multip*moneda).toFixed(2));
						   $(this).find("td").eq(4).attr("multip", multip);

						   $(this).find("td").eq(4).html(($(this).find("td").eq(2).html()*	precio_base*multip*moneda).toFixed(2));
						   $(this).find("td").eq(5).html(($(this).find("td").eq(4).html()*$(this).find("td").eq(2).html()).toFixed(2));
});
*/

}

function ponerValorCliente(str){
  document.getElementById('cliente').value=str.desc;
  document.getElementById('cliente').title=str.id;
  document.getElementById('cliente').setAttribute("idcliente",str.id);
  document.getElementById('livecliente').innerHTML="";
  document.getElementById("livecliente").style.border="0px";
  document.getElementById('contacto').value="Seleccione un Contacto";
 
  console.log('$( "#cliente" ).attr("idcliente")');

 
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
//document.getElementById('existencia').removeAttribute("readonly");
  document.getElementById('existencia').value=str.cantidad_act;
  document.getElementById('livesearch').innerHTML="";
  document.getElementById("livesearch").style.border="0px";
  calcularMontos($("#cantidad").val());
 
  cantiAlmacen(str.id);
}

function cantiAlmacen(producto){
	var arr1={
			accion: "cantidadAlmacenes",
			idproducto: producto
			
			}
			
			console.log("EL PRODUCTO"+producto);
			
			hilo=$.post(
				 '../Clases/Ajax/add_almacencant.php',
				 JSON.stringify(arr1),
				 function(msg) {
					var message=msg;
					
					var aDetalle = JSON.parse( message );
					for(x=0;x<(aDetalle.length);x++){
						console.log("entre aqui pro q paso "+aDetalle[x][0])
					$( "#cAlmacen tbody" ).append( "<tr>" +
					  "<td>"+aDetalle[x][1]+"</td>" +
					  "<td>"+aDetalle[x][2]+"</td>" +
					  
					  "</tr>" );
					}
					}
					);
			
}


 

 function mostExist(producto,almacen){
	var arr1={      
			accion: "cantidadAlmacenesP",
			idproducto: producto,
			almacen: almacen
			
			}
			
			console.log("EL PRODUCTO"+producto);
			
			hilo=$.post(
				 '../Clases/Ajax/add_almacencant.php',
				 JSON.stringify(arr1),
				 function(msg) {
					var message=msg;
					
					/*var aDetalle = JSON.parse( message );
					for(x=0;x<(aDetalle.length);x++){
						console.log("entre aqui pro q paso "+aDetalle[x][0])
					$( "#cAlmacen tbody" ).append( "<tr>" +
					  "<td>"+aDetalle[x][1]+"</td>" +
					  "<td>"+aDetalle[x][2]+"</td>" +
					  
					  "</tr>" );*/
					//}
					}
					);
			
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
	$("#cAlmacen tbody").empty();
	document.getElementById('existencia').value="";
	
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

function saveCot(str)
{	

 if(document.getElementById('tipo-servicio').checked==true)
  {
  	 tipocotizacion = 1;
  }


var arr={cliente: $("#cliente").attr("idcliente"), usuario:$("#usuario").val(), empresa: $("#empresa").val(), contacto:$( "#contacto" ).attr("idcontacto"), tipocot: tipocotizacion, fecha_ini: $("#datepicker").val(), puesto: $("#puesto").val()}; 
hilo=$.post(
		 '../Clases/Ajax/crear_nuevacotizacion.php',
		 JSON.stringify(arr),
		 function(msg) {
			no_cotizacion=$.trim(msg);
			//console.log(no_cotizacion);
			$("#cotizacion").val(msg);
			console.log("Creo la cotizacion y la carpeta de archivos"+msg);
		}
		);

}



function showResultCliente(str)
{

  if (document.getElementById('cliente').value=="Seleccione un Cliente")
 document.getElementById('cliente').value="";
 $('#usuario').val();
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

if (str=="Seleccione un Cliente") 
	str=" ";

xmlhttp.open("POST","../Clases/Ajax/selectcliente_id.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("cliente="+str+"&usuario="+$('#usuario').val());  

}
}

  $(function() {


window.onbeforeunload = function() {
  if (bandera_salida)
   console.log("SALIMOS");
  else
   return 'Please press the Logout button to logout.';
            }

    //$( "#datepicker" ).datepicker( "setDate", new Date());
//$("#cAlmacen")

  		$('#usuario_cliente_check').hide();
    $('#generar_excel').hide();
    $('#tipo-estandar').hide();
	   $( '#dialog-form' ).tooltip();
	   $( '#dialog-servicios' ).tooltip();
	   $('#panelcliente').hide();
	   $('#varcot').hide();
	   $('#products-contain').hide();
	   $('#descuentototal').hide();
	   $('#divguardar').hide();
	   //document.getElementById('agregar-producto').setAttribute('disabled', 'disabled');//document.getElementById('quitar-producto').setAttribute('disabled', 'disabled');
	   $('#agregar-producto').hide();//boton Agregar escondido
	   $('#agregar-servicio').hide();//boton Agregar escondido
	   $('#quitar-producto').hide();//boton Quitar escondido
	   //$('#attach-file').hide();//boton Adjuntar escondido
	   $('#formato').hide();
	   /*$("#moneda").change(function () {
		  var str f= "";
		  $("select option:selected").each(function () {
				str += $(this).text() + " ";
			  });
		  $("div").text(str);
		})*/
	  var producto = $( "#producto" ),
		cantidad=$("#cantidad"),
		preciobase=$("#preciobase"),
		precio=$("#preciounit"),
		total=$("#total"),
		aumento=$("#cantidad-promo"),
      	allFields = $( [] ).add( producto ).add( cantidad ).add( precio ).add( preciobase).add(total).add(aumento).add($("#observaciones"));

$("#generar_excel" )
      .button()
      .click(function() {
        $('<iframe id="attach-files" src="generar_reporte_cotizacion_especial.php?cot='+$("#cotizacion").val()+'" />').dialog({close: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
            console.log('Reporte_A_Generar'+$("#cotizacion").val())
    },
    beforeClose:function(e, m) {
                    //Pagina(1);
    },
    title: 'REPORTE EN EXCEL GENERADO',
  position: {
     my: "center top",
     at: "center top",
     of: window
    },
                autoOpen: false,
                width: 250,
                height: 300,
                modal: true,
                resizable: false,
                autoResize: true,
                overlay: {
                    opacity: 0.5,
     
                    background: "white"
     
                }
    
            }).width(250).height(300).css("background", "#ffffff");
      });

 


	$( "#dialog_mail" ).dialog({
      autoOpen: false,
      height: 500,
      width: 600,
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
					}
			
					
      },
      close: function() {
        			$("#passmail").val("");
					$("#msgmail").html("");
      }
    });
		
$( "#dialog_instrucciones1" ).dialog({
      autoOpen: false,
      height: 500,
      width: 600,
      modal: true,
      buttons: {
        "Aceptar": 
					function() 
					{
						window.location.href = 'cotizacion_busqueda_usuario.php';
						
					}
		,
        "Cancelar": function() {
					  	window.location.href = 'cotizacion_busqueda_usuario.php';
					}
			
					
      },
      close: function() {
        			 allFields.val( "" ).removeClass( "ui-state-error" );
      }
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
					$("#tomail_2").val();
					$("#tomail_3").val();

							}
						);

						 


						$( "#dialog_mail" ).dialog( "open" );
					}
		,

		"SI": function() {
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
     $("#tomail_2").val();
	 $("#tomail_3").val();

       }
      );

       


      $( "#dialog_mail" ).dialog( "open" );
					  	adjuntar($(this));
					}			
					
      },
      close: function() {
        			$("#passmail").val("");
					$("#msgmail").html("");
      }
    });
		
	
		
 
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 600,
      width: 550,
      modal: true,
      buttons: {
        "Agregar": 
					function() 
					{
						document.getElementById('existencia').value="";
						$("#cAlmacen tbody").empty();
					if ($( "#producto" ).val()=="undefined"){ 
						alert("Favor de Ingresar un Producto Valido");
					
					}else{
					
      if ( ($("#preciobase").val()=="")||($("#cantidad").val()=="") || ($( "#producto" ).attr("idproducto")==0)  )
						{
							
       alert("Favor de Ingresar PRODUCTO, PRECIO y CANTIDAD");
						}
      else{
       saveProducto($( this ));
       var muestra_existencia_ban_yo  = $( "#almacen" ).val();
       console.log("idproducto"+$( "#producto" ).attr("idproducto"));
       console.log("idproducto"+muestra_existencia_ban_yo);
   }
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
      	$('#agregar-servicio').hide();
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
		  if(document.getElementById('tipo-servicio').checked==true)
  				{
  					 $('#agregar-servicio').show();
  				}
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

			for(x=($('#productos >tbody >tr').length)-1;x>-1;x--){
			
				var isChecked = $("#productos >tbody >tr input:checkbox")[x].checked;
				
				   if(isChecked)
				   {
					 //console.log("Entra en que va aborrar producto");
					 var inputi=$("#productos >tbody >tr").eq(x).find("input[type=checkbox]");//igual a el iddetalle
					 
					 det_cot=inputi.val();
					  var menos=$("#productos >tbody >tr").eq(x).find("td").eq(5).attr('monto');
					  var preciob=$("#productos >tbody >tr").eq(x).find("td").eq(4).attr('title');
					  var preciou=$("#productos >tbody >tr").eq(x).find("td").eq(4).html();
					  var desc=(preciou*1)/(preciob*1);
					  if(desc<1)
					  {
						console.log("quita descuentos");  
					  	manejoDescuentos(-1);
					  }
					 console.log("Valor de monto tolal"+menos);

					 
					 mtotal=mtotal*1-menos*1;
					 console.log("mtotal="+mtotal);
					 $("#mtotal").val(CommaFormatted(mtotal.toFixed(2)));
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
      	 $('<iframe id="attach-files" src="../Clases/pdf/createremision.php?cot='+$("#cotizacion").val()+'&dias='+$("#dias_entrega").val()+'" />').dialog({
                open: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
            console.log('dias'+$("#dias_entrega").val())
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
                width: 850,
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
						   $(this).find("td").eq(5).html(($(this).find("td").eq(5).html()*multip).toFixed(2));
						   $(this).find("td").eq(5).attr("multip", multip);
						   
						   $(this).find("td").eq(6).html(($(this).find("td").eq(3).html()*precio_base*multip).toFixed(2));	//mas exacto
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

    if(document.getElementById('check_existencias').checked==true)
    muestra_existencia_ban = $( "#almacen" ).val();
	
    else
    muestra_existencia_ban = 0;

   if(document.getElementById('check_flete').checked==true)
    muestra_flete_ban = 1;
    else
    muestra_flete_ban = 0;

	console.log("que mamada es esto "+muestra_existencia_ban);
      			$( "#checkvendedor" ).attr("disabled", "disabled");
      			$( "#usuario_cliente_check" ).attr("disabled", "disabled");
		  					$( "#empresa" ).attr("disabled", "disabled");
									var msg_cot;
				
				var arr={cotizacion: no_cotizacion, estado: 0, cliente: $( "#cliente" ).attr("idcliente"), usuario: $( "#usuario" ).val(),  empresa: $( "#empresa" ).val(), folio:$( "#folio" ).val(), moneda: $( "#moneda" ).val(), cambio_dia: moneda, observaciones:"" , contacto:$( "#contacto" ).attr("idcontacto"), mensaje:$("#mensaje").val(), dias_entrega:$("#dias_entrega").val(), condiciones: $("#condiciones").val(), tipocot: tipocotizacion, vigencia: $("#vigencia").val(), fecha_ini: $("#datepicker").val(), precio_cotizacion: $("#precio_cotizacion").val(), lab: $("#lab").val(), capacidad_entrega: $("#capacidad_entrega").val(), muestra_existencia: muestra_existencia_ban, muestra_flete: muestra_flete_ban

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
       alert("Cotizacion Guardada satisfactoriamente");
       //mostExist($( "#producto" ).attr("idproducto"), muestra_existencia_ban);
      
						}
			);
				

			
		  		
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
			var arr={cotizacion: no_cotizacion, producto: $( "#producto" ).attr("idproducto"), cantidad: $( "#cantidad" ).val(), precio: $( "#preciobase" ).val(), observaciones: $( "#observaciones" ).val(), multiplo: multip, tipocot: 0}
			//saveProducto(arr);//ME DEBERIA REGRESAR EL DETALLE_PRODUCTO_ID PARA AGREGARLO A LA TABLA
        	/*a.-Muestra Tabla de Productos y Boton de Quitar*/
			var det_cot;
			hilo=$.post(
				 '../Clases/Ajax/add_detalle_producto.php',
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
preciounitario_formateado = parseFloat($( "#preciounit" ).val());
total_formateado = $( "#total" ).val()*1;


  

					$( "#productos tbody" ).append( "<tr>" +
					  "<td><input type='checkbox' value='"+det_cot+"'></td>" +
					  "<td>" + $( "#producto" ).val()+ "</td>" +
					  "<td>" + $( "#cantidad" ).val() + "</td>" +
					  "<td>" + $( "#cantidad" ).attr("unidad") + "</td>" +
					  "<td title='"+$("#preciobase").val()+"' multip='"+desc+"'>$ " +CommaFormatted(preciounitario_formateado.toFixed(2))+ "</td>" +
					  "<td monto='"+total_formateado+"'>$ " + CommaFormatted(total_formateado.toFixed(2)) + "</td>"  + 
					  "<td>" + $( "#observaciones" ).val() + "</td>" +
					"</tr>" );
					
					
     console.log("mtotal: "+$("#mtotal").val());
     mtotal=mtotal*1+$( "#total" ).val()*1;
     mtotal_pesos = mtotal_pesos + $( "#total" ).val()*1;
     $("#mtotal").val(CommaFormatted(mtotal.toFixed(2)));
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
					  "<td title='"+$("#preciobase-servicio").val()+"' multip='"+desc+"'>" + $( "#preciounit-servicio" ).val() + "</td>" +
					  "<td>" + $( "#total-servicio" ).val() + "</td>" +
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
				'../Clases/Ajax/delete_detalle_producto.php',
				 JSON.stringify(detalle),
				 function(msg) {
					
					var message=$.trim(msg);
					if (message!="OK") {
						if(typeof msgError === "undefined")
						msgError=msg;
						else
            			msgError=msgError+"\n"+msg+"\n"+message;
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
		  $('#panelchecktotal').hide(); //lo oculte
		}
		 else
		{ 
			console.log("esconde");
		 	$('#panelchecktotal').hide();
		}
		if($("#checktotal").checked)
		{
			$('#cantidad-promot').val("0");
			$('#descuentototal').hide();
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
			$('#descuentototal').hide();
		}
		//mostrar panel de descuento general
		//cambiar texto de boton?
	}
}

function activatePanelTotal(checkbocs)
{
	
	if(checkbocs.checked&&descuentos==0&&aumentos==0)
	{
		$('#descuentototal').hide();
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
  $('#generar_excel').show();
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
	var arr={cotizacion: no_cotizacion, estado: 1, cliente: $( "#cliente" ).attr("idcliente"), usuario: $( "#usuario" ).val(),  empresa: $( "#empresa" ).val(), folio:$( "#folio" ).val(), moneda: $( "#moneda" ).val(), cambio_dia: moneda, observaciones:"" , contacto:$( "#contacto" ).attr("idcontacto"), mensaje:$("#mensaje").val(), dias_entrega:$("#dias_entrega").val(), condiciones: $("#condiciones").val(), tipocot: tipocotizacion, vigencia: $("#vigencia").val(), precio_cotizacion: $("#precio_cotizacion").val(), lab: $("#lab").val(), capacidad_entrega: $("#capacidad_entrega").val(), muestra_existencia: muestra_existencia_ban, muestra_flete: muestra_flete_ban}
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
{   
	var msg_cot;
	var flag=false;
	var arr={cotizacion: no_cotizacion, estado: 2, cliente: $( "#cliente" ).attr("idcliente"), usuario: $( "#usuario" ).val(),  empresa: $( "#empresa" ).val(), folio:$( "#folio" ).val(), moneda: $( "#moneda" ).val(), cambio_dia: moneda, observaciones:"" , contacto:$( "#contacto" ).attr("idcontacto"), mensaje:$("#mensaje").val(), dias_entrega:$("#dias_entrega").val(), condiciones: $("#condiciones").val(), password: mail.user, body_mail: mail.msg, tipocot: tipocotizacion, vigencia: $("#vigencia").val(), fecha_ini: $("#datepicker").val(), precio_cotizacion: $("#precio_cotizacion").val(), lab: $("#lab").val(), capacidad_entrega: $("#capacidad_entrega").val(), muestra_existencia: muestra_existencia_ban, muestra_flete: muestra_flete_ban}
			hilo=$.post(
				 '../Clases/Ajax/update_cotizacion.php',
				 JSON.stringify(arr),
				 function(msg) {
					msg_cot=$.trim(msg);
					
					if(msg_cot=="OK")
					{
						 bandera_salida = 1;
						flag=true;
					}
					else
						;//alert("Error BD:"+msg_cot);
				}
			);
			hilo.done(	
						
						function(){
							//if(flag)
						//	{
							checkChanges(false);
							alert("Se ha enviado la cotización");
							$( "#dialog_instrucciones1" ).dialog( "open" );
       
						//	}
							
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

function activarvendedores(checkbocs)
{
	
	if(checkbocs.checked)
	{
		$('#usuario_cliente_check').show();
		
	}
	else
	{
		$('#usuario_cliente_check').hide();
	}
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