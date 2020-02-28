$(function() {
	$('.delCli').click(function(e) {e.preventDefault();eliminar($(this),0);});
	$('.editCli').click(function(e) {e.preventDefault();editar($(this),0);});
	$('#agregar_prod').click(function(e) {e.preventDefault();registrar($(this));});



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
		ajax.open("POST","../Clases/Ajax/busquedaFactura.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+bus+"&pag="+nropagina+"&filtro="+filter);
}
 


function detalle_domicilio(id)
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
	ajax.open("POST","../Clases/Ajax/detalledomicilio.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("funcion=2&search="+id);
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
            $('<iframe id="sitedel" src="../Clases/Ajax/cliente_eliminar.php?id='+idedit+'" />').dialog({
                open: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
    },
				beforeClose:function(e, m) {
                    Pagina(1);
				},
				title: 'Eliminar Cliente',
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
}

function editar(form, ind){	
 		if(ind==0){ 
			var $this = form;
			var idedit=($this.attr('idedit'));
			var cliente=($this.attr('cliente'));
			var empresa=($this.attr('empresa'));
			var noCot=($this.attr('noCot'));
			var idcliente=($this.attr('idcliente'));
			var longitud=idcliente.length;
			

		   }else
		   { 
			 var cliente=""+form;
			 var idedit=""+form; 
			 var empresa=""+form; 
			 var noCot=""+form;
			 var idcliente=""+form;
			 var longitud=idcliente.length;

			 
		   }

    	$('<iframe id="siteedit" src="factura_crear.php?id='+idedit+'&cliente='+cliente+'&empresa='+empresa+'&noCot='+noCot+'&idcliente='+idcliente+'" />').dialog({
                open: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");

    },
    			


				beforeClose:function(e, m) {
                    Pagina(1);
				},
			//	title: 'Editar Cliente',
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

function activatePanelTotallity(checkbocs, checktotal)
{

	ajax=objetoAjax();

	if(checkbocs.checked)
	{
		console.log("entre")
		var chekado=document.getElementById("checktotal").value;
		console.log('valor'+chekado);
    ajax.open("POST","../Clases/Ajax/update_facturado.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("chekado="+chekado);


	}
	else
	{
		console.log("noooo")
		var chekado=document.getElementById("checktotal").value;
		console.log('valor'+chekado)

	}




}
    
// JavaScript Document
