var no_cotizacion;
$(function() {
 $("#usuario").hide();
	 $('.detalleorden').click(function(e) {
	 	e.preventDefault();
	 	Detalle_Entregas($(this),0);
	 });
$("#orders-contain-sumario").hide();
$("#tipo_pedido_ruta").hide();
$("#confirmar_nota_salida").show();

console.log(" a  que cosa:"+$("#tipo_pedido_ruta").val());
$("#orders-contain").show();
if ($("#tipo_pedido_ruta").val()=="Recolección")
{
	$("#guardar-entrega").hide();
	$("#orders-contain").hide();
	$("#guardar-entrega-recoleccion").show();
	$("#orders-contain-recoleccion").show();
	}
else
	{
$("#guardar-entrega").show();
$("#orders-contain").show();
$("#guardar-entrega-recoleccion").hide();
$("#orders-contain-recoleccion").hide();

	}



	$("#dialog").dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      },
	  width: 700,
      height: 300,
	  overlay: {
                    opacity: 0.5,
					
                    background: "white"
					
      }
	  
	  
	}).width(700).height(400).css("background", "#ffffff");



	
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 950,
      modal: true,
      buttons: {
        "Agregar": 
					function() 
					{
						
							console.log("debe salvar producto");
						//	saveOrden($( this ));
							 	$( this ).dialog( "close" );
						
					}
		,
        "Cancelar": function() {
					  	$( this ).dialog( "close" );
				
					}
      },
      close: function() {
       // allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });

	/*$( "#dialog-status" ).dialog({
      autoOpen: false,
      height: 400,
      width: 500,
      modal: true,
      buttons: {
        "Aceptar": 
					function() 
					{
						
						update_status(-1);
						$( this ).dialog( "close" );
					}
		,
        "Cancelar": function() {
					  	$( this ).dialog( "close" );
					}
      },
      close: function() {
        			Pagina(1);
      }
    });*/
	
	
	
	 $("#guardar-entrega")
      .button()
      .click(function() {
		//		alert("Orden de Entrega Confirmada");
	
      });
	
	 $("#guardar-entrega-recoleccion")
      .button()
      .click(function() {
				alert("Nota de Salida Confirmada");
	
      });
	
	
	
	
});


function ConfirmarNota(pedidoGral)
{	

						 
	//	alert("Nota de Salida Confirmada");
	//	window.location.href = 'nota_salida_busqueda.php';	

   for(x=($('#Orden1 >tbody >tr').length)-1;x>-1;x--)
{


        var arr1={
        accion: "ConfirmarNota",
        idRutaEntrega: +$("#Orden1 >tbody >tr").eq(x).find("td").eq(2).attr("idrutadetalle"),
        cantidad_nota_salida:$("#Orden1 >tbody >tr").eq(x).find("input[type=text]").val(),
        usuario_nota_salida: $("#usuario").val(),
        status: 10
        }
        hilo=$.post(
          '../Clases/Ajax/add_ruta.php',
          JSON.stringify(arr1),
          function(msg) {
          var message=$.trim(msg);

          console.log("MENSAJE "+message);
     

        //   window.location.href = 'entrega_busqueda.php';
    

         }
         );
 
}
  
            alert("Orden de Entrega Confirmada");
            window.location.href = 'edicion_entrega_sumario.php?id='+pedidoGral+'&idTransporte1='+$("#transporte").val();
 
}



function GuardarEntrega_recoleccion(pedidoGral)
{	


	for(x=($('#Orden1_recoleccion >tbody >tr').length)-1;x>-1;x--){
													
								var arr1={
								accion: "guardarEntrega_recoleccion", 
								idRutaEntrega: $("#Orden1_recoleccion >tbody >tr").eq(x).find("td").eq(6).html(),
								cantidad_enrutada:$("#Orden1_recoleccion >tbody >tr").eq(x).find("td").eq(4).html(),
								cantidad_entregada:$("#Orden1_recoleccion >tbody >tr").eq(x).find("input[type=text]").val()
								}
								
								hilo=$.post(
									 '../Clases/Ajax/add_ruta.php',
									 JSON.stringify(arr1),
									 function(msg) {
										var message=$.trim(msg);
										if(x==-1)
											GuardarGeneral(pedidoGral);
								}
									);	
	}
	

		alert("Se ha generado una nueva Orden de Salida para Asignar");


}

function GuardarGeneral(idruta)
{
		var arr1={
		accion: "guardarGeneral", 
		idRutaEntrega:idruta,
		observaciones:$("#observaciones").val()
		}
		
		hilo=$.post(
			 '../Clases/Ajax/add_ruta.php',
			 JSON.stringify(arr1),
			 function(msg) {
				var message=$.trim(msg);
				if (message !="1")
					window.location.href = 'entrega_busqueda.php';
				else
					alert("se genero un error al registrar la entrega "+ message);
				}
		);	
}

function Salir()
{
	window.location.href = 'entrega_busqueda.php';
}


function validarDatos(){
	
	for(x=($('#Orden1 >tbody >tr').length)-1;x>-1;x--){
			
			
		if(isNaN(parseInt($("#Orden1 >tbody >tr").eq(x).find("input[type=text]").val()))|| parseInt($("#Orden1 >tbody >tr").eq(x).find("td").eq(4).html())< parseInt($("#Orden1 >tbody >tr").eq(x).find("input[type=text]").val())){
				return false;																												  		}		
	}
	return true;
}



function objetoAjax(){
 if (window.XMLHttpRequest)
	  {
		// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {
		// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
  return xmlhttp;
}

function Pagina(nropagina){
 	ajax=objetoAjax();
 	var bus=document.getElementById("search").value;
	var filter=document.getElementById("filter").value;   
	document.getElementById("sentencias").innerHTML="cargando...";  
	ajax.onreadystatechange=function()
	  {
		  if (ajax.readyState==4 && ajax.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=ajax.responseText;
			}
	  }
	ajax.open("POST","../Clases/Ajax/busquedaentrega.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+bus+"&pag="+nropagina+"&filtro="+filter);
}
 



function detalleRuta(id)
{
	
	$("#dialog").attr("title", "Detalle de Ruta");
	ajax=objetoAjax();
	ajax.onreadystatechange=function()
	  {
		  if (ajax.readyState==4 && ajax.status==200)
			{
				document.getElementById("dialog").innerHTML=ajax.responseText;
			$("#dialog").dialog("open");
			}
	  }
	ajax.open("POST","../Clases/Ajax/detalleruta.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+id);
}




function eliminar(form, ind){
		
 if(ind==0){ 
			var $this = form;
			var idedit=($this.attr('idedit'));
		   }else
		   { 
			 
			 var idedit=""+form;  
			 
			}
            var horizontalPadding = 15;
            var verticalPadding = 15;
            $('<iframe id="sitedel" src="../Clases/Ajax/ruta_eliminar.php?id='+idedit+'" />').dialog({
                open: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
    },
				beforeClose:function(e, m) {
                    Pagina(1);
				},
				title: 'Cancelar Ruta',
                autoOpen: true,
                width: 350,
                height: 150,
                modal: true,
                resizable: false,
                autoResize: true,
                overlay: {
                    opacity: 0.5,
					
                    background: "white",
					
                }
				
            }).width(200).height(150).css("background", "#ffffff");
}




function Detalle_Entregas(form)
{
		var $this = form;
console.log("entre a ENTREGAS");
				var arr1={
			accion: "detalleEntrega",
			idRuta: $this.attr('no_ruta'),
			idPedido: $this.attr('idordensalida')
			}
				
			$("#Orden1 tbody").empty();
					
						
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
				
						   
						   $( "#Orden1 tbody" ).append( "<tr>" +
						  "<td><input type='checkbox' value='"+ aDetalle[x][0] + "' checked></td>" +
						  "<td> <b> " +  aDetalle[x][2] + " </b></td>" +
						  "<td>" +  aDetalle[x][3]+ "</td>" +
						  "<td>" +  aDetalle[x][4] + "</td>" +
						
						   "<td>"+ " <input type='text' name='enr"+x+"' id='enr"+x+"' value='"+aDetalle[x][4] +"' size='5'  onkeypress=\"return NumEntero(event)\"/>" +  "</td>" +
						   
						   "<td>"+ "  <input type='text' name='obs' id='obs"+x+"' value='"+aDetalle[x][6] +"' size='20' maxlength='50' >" +  "</td>" +

						"</tr>" );
						   
		  				}
						
										
					//	$( "#dialog" ).dialog( "open" );
						
					}else
					{ alert("No existen Ordenes de Salida para asignar");
					}
							
				}
			);	
}


function update_status(estado)
{
 //console.log("no_orden:"+no_orden);
 observaciones="";
 
 var arr={
  accion: "Update_status_Req",
  orden: no_orden, 
  status: $( "#select-status" ).val(),  
  obs: $( "#observaciones" ).val(),
  usuario: $("#usuario").val()
 };
 hilo=$.post(
     '../Clases/Ajax/add_reqcompra.php',
     JSON.stringify(arr),
     function(msg) {
     var message=$.trim(msg);
     //if(message=="Error")
     console.log("det_ord antes:"+message);
     //det_cot=message;
    }
   );
   hilo.done( 
   function(){
     alert("Se ha modificado el estado de la Requisición de compra");
     
     //$("#dialog-status").dialog("close");
     //si se hizo un aumento o descuento actualizar el monto total aumentado
   }
  );
}