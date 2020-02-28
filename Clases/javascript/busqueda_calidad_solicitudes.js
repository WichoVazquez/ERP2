var no_cotizacion;
var no_calidad;
var user;
var	no_orden_laboratorio;
var	product_descripcion;
var	cantidad_analizar;
var	usuario_solicitante;



$(function() {

$("#dialog_lab").hide();
$( "#dialog_lab" ).dialog({
      autoOpen: false,
      height:300,
      width: 700,
      modal: true,
      buttons: {
        "Aceptar": 
					function() 
					{
      GuardarOrden();
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
	  width: 960,
      height: 300,
	  overlay: {
                    opacity: 0.5,
					
                    background: "white",
					
      }
	  
	  
	}).width(400).height(400).css("background", "#ffffff");
	
	$( "#dialog-status" ).dialog({
      autoOpen: false,
      height: 400,
      width: 800,
      modal: true,
      buttons: {
        "Guardar": 
					function() 
					{
						if ($( "#datepicker" ).val()!="") {
						if (($("#cantidad_analizada").val())<=($("#cantidad_solicitada").val())) {
							if ($("#archivo").val()!="") {
						console.log("prueba subir archivo "+$("#archivo").val());
													
						update_status(1);
						
						$( this ).dialog( "close" );
					}else{
						alert("Agrega Certificado de Laboratorio");					}
					}else{
						alert("Revisar Cantidad Analizada");
					}
				}else{
					alert("Ingresa una Fecha");
					}
				}
		,
        "Cancelar": function() {
					  	$( this ).dialog( "close" );
					}
      },
      close: function() {
		  //allFields.val( "" ).removeClass( "ui-state-error" );
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
 	var fil=document.getElementById("filter").value;  
	document.getElementById("sentencias").innerHTML="cargando...";  
	ajax.onreadystatechange=function()
	  {
		  if (ajax.readyState==4 && ajax.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=ajax.responseText;
			}
	  }
	ajax.open("POST","../Clases/Ajax/busquedacalidadsolicitudes.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+bus+"&pag="+nropagina+"&filter="+fil);
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
	ajax.open("POST","../Clases/Ajax/detallecotizacion.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+id);
}




function cambiar_status(edo){	
		no_calidad=edo.id;
		no_orden_laboratorio=edo.id;
	 product_descripcion = edo.producto;
	 cantidad_analizar = edo.cantidad_analizar;
	 usuario_solicitante = edo.usuario_solicitante;

		user=edo.usuario;
		

				console.log("Usuario!!:"+edo.usuario_solicitante);

		$("#no_orden_laboratorio").val(no_orden_laboratorio);
		$("#solicitante_orden_laboratorio").val(usuario_solicitante);
		$("#producto_orden_laboratorio").val(product_descripcion);
		$("#cantidad_solicitada").val(cantidad_analizar);

		$("#dialog-status").dialog( "open" );
}

function update_status(estado)
{
	//console.log("cotizacion:"+no_cotizacion);
	observaciones="";


	var arr={
		accion: "UpdateLaboratorioProductos", 
		id_laboratorio: no_orden_laboratorio, 
		cantidad: $("#cantidad_analizada").val(),
		certificado: $("#archivo").val(), 
		usuario: $("#usuario").val(),
		status: estado,
		fecha_rev: $("#datepicker").val()
	};
	hilo=$.post(
				 '../Clases/Ajax/update_calidad_status.php',
				 JSON.stringify(arr),
				 function(msg) {
					var message=$.trim(msg);
					if(message=="OK")
					{			
						alert("Se ha guardado correctamente el Certificado de Laboratorio");
						window.parent.location.reload();
					}
					else
						alert("Error:"+message);
						

				}
			
);
}


function detalle_sucursal(id)
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
	ajax.open("POST","../Clases/Ajax/detallesucursal.php",true);
	ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajax.send("search="+id);
}

function crear_orden(){ 

 

 $("#dialog_lab").dialog( "open" );

}

function GuardarOrden(detalle_producto)
{
 console.log("Orden Lab ENTRAMOS: "+$('#unidad_medida').val());
 console.log("Orden Lab ENTRAMOS el LOTE: "+$('#lote_lab').val());
  var arr2={
  accion: "InsertarLaboratorioProductos", 
  tipo: 0,
  cantidad: $("#Cantidad_Lab").val(),
  id_producto: $( "#producto" ).attr("idproducto"),
  usuario: $('#usuario').val(),
  id_unidad: $('#unidad_medida').val(),
  servicio_lab: $('#servicio_lab').val(),
  observaciones_lab: $('#observaciones_lab').val(),
   lote_lab: $('#lote_lab').val()

  }
  
  hilo=$.post(
    '../Clases/Ajax/add_laboratorio.php',
    JSON.stringify(arr2),
    function(msg) {
    var message=$.trim(msg);
    console.log("Saliendo Lab:"+message);
    alert("Se cre¨® Orden Laboratorio. "+message);
    window.location.href = 'calidad_solicitudes_busqueda.php';
    }
  ); 
}

function showResult(str)
{
$("#cantidad").attr("readonly", "readonly");
$("#cantidad-promo").attr("readonly", "readonly");
if(str.length==0)
{
	document.getElementById('livesearch').innerHTML="";
    document.getElementById("livesearch").style.border="0px";
}
else
{
xmlhttp=objetoAjax();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
xmlhttp.open("POST","../Clases/Ajax/selectmaterial_id.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("material="+str);  
}
}


function ponerValorMaterial(str){
  document.getElementById('producto').value=str.desc;
  //$("#producto").attr("idproducto", str.id);
  document.getElementById('producto').setAttribute("idproducto", str.id);
  //$("#cantidad").attr("disabled", "enabled");

//document.getElementById('existencia').removeAttribute("readonly");
  document.getElementById('livesearch').innerHTML="";
  document.getElementById("livesearch").style.border="0px";

  
}