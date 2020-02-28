var no_cotizacion;
var detalle_compra;
$(function() {

$( "#dialog_lab" ).dialog({
      autoOpen: false,
      height:200,
      width: 600,
      modal: true,
      buttons: {
        "Aceptar": 
					function() 
					{
      GuardarOrden(detalle_compra);
						$( this ).dialog( "close" );
					}
		,
        "Cancelar": function() {
					  	$( this ).dialog( "close" );
					}
			
					
      },
      close: function() {
     $( this ).dialog( "close" );
      }
    });


	$('#usuario').hide();


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
	  width: 700,
      height: 300,
	  overlay: {
                    opacity: 0.5,
                    background: "white",
					
      }
	  
	  
	}).width(700).height(400).css("background", "#ffffff");

	
/*	
	
	 $("#guardar-entrega")
      .button()
      .click(function() {
				alert("Orden de Entrega Confirmada");

		
      });
	
	*/
	
	
});



function GuardarDetalle(ordenGral)
{	
console.log("ESTA COSA JALA:"+$("#Orden1 >tbody >tr").eq(0).find("td").eq(0).html());
	if (validarDatos())
		{
			console.log("entre al if:"+$('#Orden1 >tbody >tr').length);
			for(x=($('#Orden1 >tbody >tr').length)-1;x>-1;x--){
									console.log("entre al for:"+x);
         console.log("INSUMOS: "+$("#Orden1 >tbody >tr").eq(x).find("input[name=cant_surtida]").attr("insumos"));
									


										var arr1={
										accion: "guardarDetalle", 
										idOrdenDetalle: $("#Orden1 >tbody >tr").eq(x).find("td").eq(0).html(),
										cantidad_recibida: $("#Orden1 >tbody >tr").eq(x).find("input[name=cant_surtida]").val(),
          lote: $("#Orden1 >tbody >tr").eq(x).find("input[name=lote]").val(),
										almacen: $("#almacen").val(),
          usuario: $("#usuario").val(),
          id_producto: $("#Orden1 >tbody >tr").eq(x).find("input[name=cant_surtida]").attr("id_producto"),
          insumos: $("#Orden1 >tbody >tr").eq(x).find("input[name=cant_surtida]").attr("insumos")
										}
										
          
										hilo=$.post(
											 '../Clases/Ajax/update_orden_detalle.php',
											 JSON.stringify(arr1),
											 function(msg) {
												var message=$.trim(msg);
					console.log("el mensaje :"+message);												
											}
											);	
			}

												GuardarGeneral(ordenGral);
		}
		
	else
	{
			alert("La cantidad surtida es incorrecta");
	}

}

function GuardarGeneral(idordengeneral)
{
	console.log("general");
		var arr2={
		accion: "guardarGeneral", 
		factura_compra: $("#factura_compra").val(),
		idOrden:idordengeneral,
		observaciones: $('#observaciones').val(),
		fecha_recibo: $("#datepicker").val(),
		usuario_almacen: $('#usuario').val()
		}
		
		hilo=$.post(
			 '../Clases/Ajax/update_orden_detalle.php',
			 JSON.stringify(arr2),
			 function(msg) {
				var message=$.trim(msg);
				console.log("si acabo general"+message);
				if (message =="OK")
					window.location.href = 'compra_busqueda_usuario_almacen.php';
				else
					alert("se genero un error al registrar la entrada de material "+ message);

				}
		);	
}

function GuardarOrden(detalle_producto)
{
 console.log("Orden_Compra ENTRAMOS");
  var arr2={
  accion: "InsertarLaboratorioDetalle", 
  tipo: 0,
  cantidad: $("#Cantidad_Lab").val(),
  idDetalle: detalle_producto,
  usuario: $('#usuario').val()
  }
  
  hilo=$.post(
    '../Clases/Ajax/add_laboratorio.php',
    JSON.stringify(arr2),
    function(msg) {
    var message=$.trim(msg);
    console.log("Saliendo Lab:"+message);

    }
  ); 
}

function Salir()
{
	window.location.href = 'entrega_busqueda.php';
}


function validarDatos(){
	
	for(x=($('#Orden1 >tbody >tr').length)-1;x>-1;x--){
			
			
		if (parseInt($("#Orden1 >tbody >tr").eq(x).find("input[name=cant_surtida]").val()) > parseInt($("#Orden1 >tbody >tr").eq(x).find("td").eq(2).html()))
			{

				return false;
			}		
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



function crear_orden(detalle_producto){ 

 detalle_compra = detalle_producto.id;
  $("#dialog_lab").dialog( "open" );

}