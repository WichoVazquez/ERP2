var no_cotizacion;
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
        effect: "Fadeout",
        duration: 1000
      },
	  width: 900,
      height: 400,
	  overlay: {
                    opacity: 0.5,
					
                    background: "white",
					
      }
	  
	  
	}).width(700).height(400).css("background", "#ffffff");
	
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
	ajax.open("POST","../Clases/Ajax/busquedalogistica.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+bus+"&pag="+nropagina+"&filtro="+filter);
}
 



function detalleRuta(id)
{
	
	$("#dialog").attr("title", "Detalle de Ruta")
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



