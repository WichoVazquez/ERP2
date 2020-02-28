$(function() {
	$('.delPer').click(function(e) {e.preventDefault();eliminar($(this),0);});
	
    $('.despliegaPer').click(function(e) {e.preventDefault();verPermisos($(this),0);});
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
	document.getElementById("sentencias").innerHTML="cargando...";  
	ajax.onreadystatechange=function()
	  {
		  if (ajax.readyState==4 && ajax.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=ajax.responseText;
			}
	  }
	ajax.open("POST","../Clases/Ajax/busquedaperfil.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+bus+"&pag="+nropagina);
}
 


function eliminar(form, ind){		
    if(ind==0){ 
		var $this = form;
		var idedit=($this.attr('idedit'));
   }
   else{ 	 
		var idedit=""+form;  
	}
	
	
    var horizontalPadding = 15;
    var verticalPadding = 15;
    $('<iframe id="sitedel" src="../Clases/Ajax/perfil_eliminar.php?id='+idedit+'" />').dialog({
        open: function(event, ui){ 
            $(this).parents(".ui-dialog:first").find(".ui-widget-header")
                .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
        },
		beforeClose:function(e, m) {
            Pagina(1);
		},
		title: 'Eliminar Perfil',
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

function detalle_permisos(id)
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
	ajax.open("POST","../Clases/Ajax/perfil_ver_pantallas.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("funcion=2&id="+id);
}



/*function verPermisos(form, ind){
    if(ind==0){ 
        var $this = form;
        var idedit=($this.attr('idedit'));
    }
   else{     
        var idedit=""+form;  
    }
    var horizontalPadding = 15;
    var verticalPadding = 15;
    $('<iframe id="sitever" src="../Clases/Ajax/perfil_ver_pantallas.php?id='+idedit+'" />').dialog({
        open: function(event, ui){ 
            $(this).parents(".ui-dialog:first").find(".ui-widget-header")
                .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
        },
        beforeClose:function(e, m) {
            Pagina(1);
        },
        title: 'Permisos de Pantallas',
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
}*/

function registrar(form){	
           /* $('<iframe id="sitedel" src="perfil_registro.php" />').dialog({
                open: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
    },
				beforeClose:function(e, m) {
                    Pagina(1);
				},
				title: 'Registro perfil',
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
				
            }).width(500).height(500).css("background", "#ffffff");*/
}

function editar(form, ind){ 
   /* if(ind==0){ 
        var $this = form;
        var idedit=($this.attr('idedit'));
    } 
    else{
        var idedit=""+form;  
    }    
    $('<iframe id="sitedel" src="perfil_edicion.php?id='+idedit'" />').dialog({
        open: function(event, ui){ 
            $(this).parents(".ui-dialog:first").find(".ui-widget-header")
                .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
        },
        beforeClose:function(e, m) {
            Pagina(1);
        },
        title: 'Editar perfil',
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
    }).width(500).height(500).css("background", "#ffffff");*/
}