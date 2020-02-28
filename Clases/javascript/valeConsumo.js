var no_cotizacion;
$(function() {
	$('.delOrd').click(function(e) {e.preventDefault();eliminar($(this),0);});
	//$('.editCot').click(function(e) {e.preventDefault();editar($(this),0);});
	$('.cancelOrd').click(function(e) {e.preventDefault();cancelar($(this),0);});
	//$('#add_usuario').click(function(e) {e.preventDefault();registrar($(this));});
	$( '#dialog' ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      },
	  width: 400,
      height: 300,
	  overlay: {
                    opacity: 0.5,
					
                    background: "white",
					
      }
	  
	  
	}).width(400).height(400).css("background", "#ffffff");
	
	$( "#dialog-status" ).dialog({
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
    });

    $("#datepicker").datepicker();
    	$( "#dialog-status-compras" ).dialog({
      autoOpen: false,
      height: 400,
      width: 500,
      modal: true,
      buttons: {
        "Aceptar": 
					function() 
					{
						
						update_status_compras(-1);
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
    });
});
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
	document.getElementById("sentencias").innerHTML="cargando...";  
	ajax.onreadystatechange=function()
	  {
		  if (ajax.readyState==4 && ajax.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=ajax.responseText;
			}
	  }
	ajax.open("POST","../Clases/Ajax/busquedaValeConsumo.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+bus+"&pag="+nropagina);
}
 


function detalle_orden(id)
{
	$("#dialog").attr("title", "Detalle de Cotizacion")
	ajax=objetoAjax();
	ajax.onreadystatechange=function()
	  {
		  if (ajax.readyState==4 && ajax.status==200)
			{
				document.getElementById("dialog").innerHTML=ajax.responseText;
				$("#dialog").dialog("open");
			}
	  }
	ajax.open("POST","../Clases/Ajax/detalleorden.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+id);
}



function cambiar_status(edo){	
		no_orden=edo.id;
		$("#dialog-status").dialog( "open" );
}

function update_status(estado)
{
	console.log("no_orden:"+no_orden);
	observaciones="";
	if(estado!=3)
	{
		estado= $( "#select-status" ).val();
		observaciones= $( "#observaciones" ).val();
	}
	var arr={
		orden: no_orden, 
		status: estado,  
		obs: observaciones
	};
	hilo=$.post(
				 '../Clases/Ajax/update_vale_status.php',
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
					alert("Se ha modificado el estado de la orden de compra");
					
					//$("#dialog-status").dialog("close");
					//si se hizo un aumento o descuento actualizar el monto total aumentado
			}
		);
}

