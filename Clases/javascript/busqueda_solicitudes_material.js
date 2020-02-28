var no_cotizacion;
var almacen_material_id;
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
	ajax.open("POST","../Clases/Ajax/busquedaSolicitudMaterial.php",true);
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

function update_status_poritem(estado)
{
	console.log("no_orden:"+no_orden);
 console.log("almacen_material_id:"+almacen_material_id);
	observaciones="";

	var arr={
		orden: no_orden, 
  almacen_material_id: almacen_material_id,
  cantidad: $("#cantidad_surtir").val(),
		status: 1
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


function update_status(status)
{

console.log("status:"+no_orden);
 
 var arr;

   estado= $( "#select-status" ).val();

   arr={
    taller_solicitud_id: no_orden, 
    status: estado};
  
 hilo=$.post(
     '../Clases/Ajax/update_solicitud_status.php',
     JSON.stringify(arr),
     function(msg) {
     var message=$.trim(msg);
     //if(message=="Error")
     console.log("det_cot antes:"+message);
     
    }
   );
   hilo.done( 
   function(){

      alert("Se ha surtido Satisfactoriamente la Solicitud de Materiales");

   }
  );
}