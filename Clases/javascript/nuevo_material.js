

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
var kit=false;
var id_material=0;
//var 






function ponerValorMaterial(str){
  document.getElementById('producto').value=str.desc;
  //$("#producto").attr("idproducto", str.id);
  document.getElementById('producto').setAttribute("descproducto", str.desc);
  document.getElementById('producto').setAttribute("idproducto", str.id);
  //$("#cantidad").attr("disabled", "enabled");
//  document.getElementById('cantidad').removeAttribute("readonly");
  //$("#cantidad").attr("unidad", str.unidad);
  //document.getElementById('cantidad-promo').removeAttribute("readonly");
//  document.getElementById('preciobase').value=str.precio;
  //document.getElementById('preciounit').value=str.precio;
  document.getElementById('livesearch').innerHTML="";
  document.getElementById("livesearch").style.border="0px";
   
  //$('#divguardar').show();
}

function ponerCantidad(cant){
	document.getElementById('cantidad').setAttribute("intcantidad", cant);  
}

function ponerObservacion(cant){
  document.getElementById('observaciones').setAttribute("observ", cant);  
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
//$("#cantidad").attr("readonly", "readonly");
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
	   $( document ).tooltip();

    
  
	
	
	    $('#products-contain').hide();
	   $('#divguardar').hide();
		if (kit){  
			$('#agregar-producto').show();
        } else {   
			$('#agregar-producto').hide();
        } 
   
	   $('#quitar-producto').hide();//boton Quitar escondido
	   
	  var producto = $( "#producto" ),
		cantidad=$("#cantidad"),
		precio=$("#preciobase"),
		precio=$("#preciounit"),
		total=$("#total"),
		aumento=$("#cantidad-promo"),
      	allFields = $( [] ).add( producto ).add( cantidad ).add($("#observaciones"));
		
		
 
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 500,
      modal: true,
      buttons: {
        "Agregar": 
					function() 
					{
						
						
							//console.log("debe salvar producto");
								$( this ).dialog( "close" );
							saveProducto($( this ));
						
					}
		,
        "Cancelar": function() {
					  	$( this ).dialog( "close" );
						validarTabla();
					}
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 	
	
    $("#agregar-producto")
      .button()
      .click(function() {
		$("#cantidad").val("0");		
        $( "#dialog-form" ).dialog( "open" );
      });
	  
	  
	$("#quitar-producto" )
      .button()
      .click(function() {
		
    
			for(x=($('#productos >tbody >tr').length)-1;x>-1;x--){
			
				var isChecked = $("#productos >tbody >tr input:checkbox")[x].checked;
				
				   if(isChecked)
				   {
				
					 $('#productos >tbody >tr').eq(x).remove();
					 //borrar producto de base de datos DETALLE-COTIZACION
				   }
			}
						  
      validarTabla();
				
		/*}*/	
      });

	
	  $("#guardar-orden")
      .button()
      .click(function() {
		  		console.log("ENTRE A GUARDAR:"+no_orden+"proveedor: "+$( "#proveedor" ).attr("idproveedor")+"fecha:"+$("#datepicker").val());
				var msg_cot;
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
					msg_cot=$.trim(msg);
						window.location.href = 'COMPRAS.php';
						alert("Orden de Compra Generada");

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
  
  function mayara()
  {
	  alert("encje");
	  if($("#checktotal").is(':checked'))
	  {
		  kit=true;
	  }else
	  {
		  kit=false;}
		  alert(kit);
  }
  
  function activarKit(vkit,nIdMaterial)
  {
	  if (vkit=="on")
	  {
		  kit=true;
		  id_material=nIdMaterial;
	  }
	  else
	  {
		  kit=false;
	  }	 
  }
  

  
function almacenarDetalle()
{
	
	for(x=($('#productos >tbody >tr').length)-1;x>-1;x--){
			
			var arr={
				material_id: id_material, 
				cantidad: $("#productos >tbody >tr").eq(x).find("td").eq(3).html(), 
				observaciones: $("#productos >tbody >tr").eq(x).find("td").eq(4).html(),
				producto_id:$("#productos >tbody >tr").eq(x).find("td").eq(1).html()
			}
					 
	
		
			//saveProducto(arr);//ME DEBERIA REGRESAR EL DETALLE_PRODUCTO_ID PARA AGREGARLO A LA TABLA
        	/*a.-Muestra Tabla de Productos y Boton de Quitar*/
		
			 hilo=$.post(
				 '../Clases/Ajax/add_detalle_material.php',
				 JSON.stringify(arr),
				 function(msg) {
					var message=$.trim(msg);
					//alert(message);
					
				}
			);	
	}
	
	 $("#msgTitulo").text("Los componentes del Producto fueron guardados satisfactoriamente");
	 $('#agregar-producto').hide();
	 $('#quitar-producto').hide();
	 $('#products-contain').hide();	 
      $("#divguardar").hide();
	 
}

function saveProducto(varia){//arr{cotizacion,producto, cantidad, precio}

					$('#products-contain').show();
					$('#quitar-producto').show();
//					

					$( "#productos tbody" ).append( "<tr>" +
					  "<td><input type='checkbox' value='1'></td>" +
					  "<td>" + $( "#producto" ).attr("idproducto")+ "</td>" +
					  "<td>" + $( "#producto" ).attr("descproducto")+ "</td>" +
					  "<td>" + $( "#cantidad" ).attr("intcantidad") + "</td>" +
					  "<td>" + $( "#observaciones" ).attr("observ") + "</td>" +
			
					"</tr>" );
					
							
validarTabla();
					
					varia.dialog( "close" );
}

function validarTabla()
{
			if($('#productos >tbody >tr').length==0)
      	{
      		$("#products-contain").hide();
      		$("#quitar-producto").hide();
      		$("#divguardar").hide();
      	}
      	else
      	{
			$("#products-contain").show();
      		$("#quitar-producto").show();
      		$("#divguardar").show();
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



