// JavaScript Document
$(function() {
	$('.delEmpresa').click(function(e) {e.preventDefault();eliminar($(this),0);});
	$('.editEmpresa').click(function(e) {e.preventDefault();editar($(this),0);});
	$('#add_Empresa').click(function(e) {e.preventDefault();registrar($(this));});

	 

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
	  width: 200,
	  height: 100,
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
	ajax.open("POST","../Clases/Ajax/busquedaempresa.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+bus+"&pag="+nropagina);
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
			$('<iframe id="sitedel" src="../Clases/Ajax/empresa_eliminar.php?id='+idedit+'" />').dialog({
				open: function(event, ui){ 
		$(this).parents(".ui-dialog:first").find(".ui-widget-header")
			.removeClass("ui-widget-header").addClass("ui-widget-header-custom");
	},
				beforeClose:function(e, m) {
					Pagina(1);
				},
				title: 'Eliminar Empresa',
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
			$('<iframe id="siteedit" src="empresa_edicion.php?id='+idedit+'" />').dialog({
				open: function(event, ui){ 
		$(this).parents(".ui-dialog:first").find(".ui-widget-header")
			.removeClass("ui-widget-header").addClass("ui-widget-header-custom");
	},
				beforeClose:function(e, m) {
					Pagina(1);
				},
			//	title: 'Editar Empresa',
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
				
			}).width(650).height(500);
}

function registrar(form){	
			
	 
			$('<iframe id="sitedel" src="empresa_registro.php" />').dialog({
				open: function(event, ui){ 
		$(this).parents(".ui-dialog:first").find(".ui-widget-header")
			.removeClass("ui-widget-header").addClass("ui-widget-header-custom");
	},
				beforeClose:function(e, m) {
					Pagina(1);
				},
				//title: 'Registro Empresa',
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

				
			}).width(640).height(500).css("background", "#ffffff");
}// JavaScript Document