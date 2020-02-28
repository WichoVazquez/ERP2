

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
	 //  $( document ).tooltip();
//alert('hola');
    
  
//	$('#agregar-producto').show();
	
	   $('#quitar-producto').hide();//boton Quitar escondido
	      
	   $('#divguardar').hide();
		if (kit){  
			$('#agregar-producto').show();
			$('#products-contain').show();
			validarTabla();
        } else {   
			$('#agregar-producto').hide();
			
			$('#products-contain').hide();
        } 
   
	   
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
 });

	

  
  function activarKit(vkit)
  {
	//  alert('activo');
	  if (vkit=="on")
	  {
		  kit=true;
		  
	  }
	  else
	  {
		  kit=false;
	  }	 
  }
  

  
function almacenarDetalle(idMaterial)
{
	
deleteProducto(idMaterial);

	for(x=($('#productos >tbody >tr').length)-1;x>-1;x--){
			
			var arr={
				material_id: idMaterial, 
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
	
	 $("#msgTitulo").text("Los componentes fueron guardados correctamente");
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
	//alert($('#productos >tbody >tr').length);
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
			 hilo=$.post(
				 '../Clases/Ajax/delete_detalle_material.php',
				 JSON.stringify(detalle),
				 function(msg) {
					var message=$.trim(msg);
				//	alert(message);
					
				}
		);
}