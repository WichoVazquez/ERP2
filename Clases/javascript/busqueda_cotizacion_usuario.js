var no_cotizacion;
var user;
var contact;
$(function() {
	$('.delCot').click(function(e) {e.preventDefault();eliminar($(this),0);});
	//$('.editCot').click(function(e) {e.preventDefault();editar($(this),0);});
	$('.cancelCot').click(function(e) {e.preventDefault();cancelar($(this),0);});
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
	  width: 800,
      height: 400,
	  overlay: {
                    opacity: 0.5,
					
                    background: "white",
					
      }
	  
	  
	}).width(800).height(400).css("background", "#ffffff");
	
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
	
$( "#dialog-statusDG" ).dialog({
      autoOpen: false,
      height: 300,
      width: 400,
      modal: true,
      buttons: {
        "Aceptar": 
					function() 
					{
						
						update_status(2);
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
	
$( "#dialog_instrucciones2" ).dialog({
      autoOpen: false,
      height: 600,
      width: 1200,
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
	
	$( "#dialog_mail" ).dialog({
      autoOpen: false,
      height: 300,
      width: 400,
      modal: true,
      buttons: {
        "Aceptar": 
					function() 
					{
						update_status(5);
						
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
	var filter=document.getElementById("filter").value;   
	document.getElementById("sentencias").innerHTML="cargando...";  
	ajax.onreadystatechange=function()
	  {
		  if (ajax.readyState==4 && ajax.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=ajax.responseText;
			}
	  }
	ajax.open("POST","../Clases/Ajax/busquedacotizacion_usuario.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+bus+"&pag="+nropagina+"&filtro="+filter);
}
 




function detalle_cliente(id)
{
	ajax=objetoAjax();
	ajax.onreadystatechange=function()
	  {
		  if (ajax.readyState==4 && ajax.status==200)
			{
				document.getElementById("dialog").innerHTML=ajax.responseText;
				$("#dialog").dialog("open");
			}
	  }
	ajax.open("POST","../Clases/Ajax/detallecliente.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+id);
}

function detalle_empresa(id)
{
	ajax=objetoAjax();
	ajax.onreadystatechange=function()
	  {
		  if (ajax.readyState==4 && ajax.status==200)
			{
				document.getElementById("dialog").innerHTML=ajax.responseText;
				$("#dialog").dialog("open");
			}
	  }
	ajax.open("POST","../Clases/Ajax/detalleempresa.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+id);
}

function detalle_usuario(id)
{
	ajax=objetoAjax();
	ajax.onreadystatechange=function()
	  {
		  if (ajax.readyState==4 && ajax.status==200)
			{
				document.getElementById("dialog").innerHTML=ajax.responseText;
				$("#dialog").dialog("open");
			}
	  }
	ajax.open("POST","../Clases/Ajax/detalleusuario.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+id);
}

function detalle_cotizacion(id)
{
	$("#dialog").attr("title", "Detalle de Cotizacion");
	ajax=objetoAjax();
	ajax.onreadystatechange=function()
	  {
		  if (ajax.readyState==4 && ajax.status==200)
			{
				document.getElementById("dialog").innerHTML=ajax.responseText;
				$("#dialog").dialog("open");
			}
	  }
	ajax.open("POST","../Clases/Ajax/detallecotizacion.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+id);
}


function cancelar(form, ind){
		if (confirm("Está seguro que desea cancelar la cotización?") == true){ 
 if(ind==0){ 
			var $this = form;
			var idedit=($this.attr('idedit'));
		   }else
		   { 
			 
			 var idedit=""+form;  
			}
			no_cotizacion=idedit;
			update_status(3);
  }
  else
   console.log("No cancela");

			
}

function eliminar(form, ind){
		
if (confirm("Está seguro que desea eliminar la cotización?") == true){ 
 if(ind==0){ 
   var $this = form;
   var idedit=($this.attr('idedit'));
     }else
     { 
    
    var idedit=""+form;  
    
   }
            var horizontalPadding = 15;
            var verticalPadding = 15;
            $('<iframe id="sitedel" src="../Clases/Ajax/cotizacion_eliminar.php?id='+idedit+'" />').dialog({
                open: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
    },
    beforeClose:function(e, m) {
                    Pagina(1);
    },
    title: 'Eliminar Cotización',
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
    
            }).width(350).height(350).css("background", "#ffffff");

} //if
else{
        console.log("Elimine"); 
       }

}


function editar(form, ind){	
 		if(ind==0)
		{ 
			var $this = form;
			var idedit=($this.attr('idedit'));
		   }else
		   { 
			 
			 var idedit=""+form;  
		   }
            $('<iframe id="siteedit" src="cotizacion_edicion.php?id='+idedit+'" />').dialog({
                open: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
    },
				beforeClose:function(e, m) {
                    Pagina(1);
				},
				title: 'Editar Usuario',
                autoOpen: true,
                width: 500,
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

function cambiar_status(cotizcion_numero){	
		no_cotizacion=cotizcion_numero.id;
		$("#no_sale_obs").hide();
		$("#dialog-status").dialog( "open" );

}

function cambiar_statusDG(cotizcion_numero){	
		no_cotizacion=cotizcion_numero.id;
		$("#no_sale_obs").hide();
		$("#dialog-statusDG").dialog( "open" );

}

function envio(edo)
{
	no_cotizacion=edo.id;
	user=edo.usuario;
	contact=edo.contacto;
	//console.log("2.- id de contacto:"+edo.contacto);
	$("#dialog_mail").dialog( "open" );
}

function habilitar(edo)
{	
		if ($( "#select-status" ).val()==6)
		{
				$("#no_sale_obs").hide();
				$("#datos_pedido").show();
		}
		else
		{
				$("#no_sale_obs").show();
				$("#datos_pedido").hide();
		}
}

function update_status(estado,select)
{
	//console.log("estado"+estado);
	
	observaciones="";
	
	var arr;
	if (estado==3)
	{
		arr={cotizacion: no_cotizacion, status: estado,  obs: observaciones};
	}
	else 
		if(estado!=2)
		{
			estado= $( "#select-status" ).val();
			observaciones= $( "#observaciones" ).val();

			arr={cotizacion: no_cotizacion, status: estado,  obs: observaciones};
		}
		else
		{
			pass=$( "#passmail" ).val();
			mensaje= $( "#msgmail" ).val();
			console.log("id de contacto:"+contact);
			arr={cotizacion: no_cotizacion, status: estado, usuario:user, password: pass, contacto: contact, msg: mensaje };
		}
		
	hilo=$.post(
				 '../Clases/Ajax/update_cotizacion_status.php',
				 JSON.stringify(arr),
				 function(msg) {
					var message=$.trim(msg);
					//if(message=="Error")
					console.log("det_cot antes:"+message);
					
				}
			);
			hilo.done(	
			function(){
					if(estado!=2)
					{
						Pagina(1);
						alert("Se ha modificado el estado de la cotizacion");
						$( "#dialog_instrucciones2" ).dialog( "open" );
						
					}
					else
					{
						Pagina(1);
						alert("Se ha enviado la cotizacion");
						$( "#dialog_instrucciones2" ).dialog( "open" );
						
					}
					
					//$("#dialog-status").dialog("close");
					//si se hizo un aumento o descuento actualizar el monto total aumentado
			}
		);
}

