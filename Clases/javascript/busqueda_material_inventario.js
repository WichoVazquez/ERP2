$(function() {
	$('.delMat').click(function(e) {e.preventDefault();eliminar($(this),0);});
	$('.editMat').click(function(e) {e.preventDefault();editar($(this),0);});
	$('#add_material').click(function(e) {e.preventDefault();registrar($(this));});
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
	  
	}).width(400).height(400).css("background", "#ffffff");;
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
 	var busdos=document.getElementById("filter").value;  
	document.getElementById("sentencias").innerHTML="cargando...";  
	ajax.onreadystatechange=function()
	  {
		  if (ajax.readyState==4 && ajax.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=ajax.responseText;
			}
	  }
	ajax.open("POST","../Clases/Ajax/busquedamaterial_inventario.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+bus+"&filtro="+busdos+"&pag="+nropagina);
}
 
function detalle_generales(id)
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
	ajax.open("POST","../Clases/Ajax/detallegenerales.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+id);
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
            $('<iframe id="sitedel" src="../Clases/Ajax/material_eliminar.php?id='+idedit+'" />').dialog({
                open: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
    },
				beforeClose:function(e, m) {
                    Pagina(1);
				},
				title: 'Eliminar Material',
								position: {
					my: "center top",
					at: "center top",
					of: window
				},
				autoOpen: true,
                width: 300,
                height: 100,
				modal: true,
				resizable: false,
				autoResize: true,
				overlay: {
					opacity: 0.5,
					
					background: "white",
					
				},
                buttons: {
					"OK": function() {
						$(this).dialog("close");
					}
				}
				
            }).width(200).height(100).css("background", "#ffffff");
}

function editar(form, ind){	
 		if(ind==0){ 
			var $this = form;
			var idedit=($this.attr('idedit'));
		   }else
		   { 
			 
			 var idedit=""+form;  
		   }
            $('<iframe id="siteedit" src="material_edicion.php?id='+idedit+'" />').dialog({
                open: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
    },
				beforeClose:function(e, m) {
                    Pagina(1);
				},
			//	title: 'Editar Material',
				autoOpen: true,
				position: {
					my: "center top",
					at: "center top",
					of: window
				},
				width: 700,
				modal: true,
				resizable: true,
				autoResize: true,
				
			}).width(650).height(450);
}

function registrar(form){	
 			
     
            $('<iframe id="sitedel" src="material_registro.php" />').dialog({
                open: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
    },
				beforeClose:function(e, m) {
                    Pagina(1);
				},
			//	title: 'Registro Material',
				position: {
					my: "center top",
					at: "center top",
					of: window
				},
				width: 700,
				modal: true,
				resizable: false,
				autoResize: false,
				height: 500

				
			}).width(650).height(550).css("background", "#ffffff");
}// JavaScript Document

function detalle_inventario(id)
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
	ajax.open("POST","../Clases/Ajax/detalleInventarioA.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search=");
}
function entrada_inventario(id)
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
	ajax.open("POST","../Clases/Ajax/entradaInventarioA.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search=");
}
function salida_inventario(id)
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
	ajax.open("POST","../Clases/Ajax/salidaInventarioA.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search=");
}