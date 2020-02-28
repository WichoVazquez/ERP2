$(function() {


	$("dialog-status").hide();
 $("#usuario").hide();
$('.Guardar').click(function(e) {e.preventDefault();GuardaXML(0);});

	$("#Generar_factura" )
      .button()
      .click(function() {
			$("#dialog-status").dialog( "open" );
			console.log("QUIERO ABRIR EL DIALOG STATUS");
      });




	$( "#dialog-status" ).dialog({
      autoOpen: false,
      height: 300,
      width: 450,
      modal: true,
      buttons: {
        "Aceptar": 
					function() 
					{
						GuardaFactura();
					
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



});


function GuardaXML(ind)
{


 $('<iframe id="attach-files" src="../Clases/Ajax/generar_xml_sinSQL.php/>').dialog({
                open: function(event, ui){ 
        $(this).parents(".ui-dialog:first").find(".ui-widget-header")
            .removeClass("ui-widget-header").addClass("ui-widget-header-custom");
          
    },
				beforeClose:function(e, m) {
                    //Pagina(1);
				},
				title: 'Generar XMLHT',
		position: {
					my: "center top",
					at: "center top",
					of: window
				},
                autoOpen: true,
                width: 850,
                height: 600,
                modal: true,
                resizable: false,
                autoResize: true,
                overlay: {
                    opacity: 0.5,
					
                    background: "white",
					
                }
				
            }).width(700).height(650).css("background", "#ffffff");

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


function activatePanelTotallity(checkbocs, checktotal)
{


for(x=($('#Orden1 >tbody >tr').length)-1;x>-1;x--)
{
																	

	var isChecked = $("#productos >tbody >tr input:checkbox")[x].checked;
  if(isChecked){
				var arr1={
				idPedido:$("#Orden1 >tbody >tr").eq(x).find("input[type=checkbox]").val(),
				Cantidad:$("#Orden1 >tbody >tr").eq(x).find("input[type=text]").val()
				}
																						
				hilo=$.post(
				'../Clases/Ajax/add_ruta.php',
				JSON.stringify(arr1),
						function(msg) {
								var message=$.trim(msg);


				}
				);	
  }
}


// ----------------------------------------------- el otro pex



}

function GuardaFactura()
{
	console.log("GuardaFactura()");
		for(x=($('#Orden_sumario >tbody >tr').length)-1;x>-1;x--)
		{
			if($("#Orden_sumario >tbody >tr input:checkbox")[x].checked)
				   {
								
				   	var arr1={
		accion: "GuardaFactura", 
		idRutaDetalle: $("#Orden_sumario >tbody >tr").eq(x).find("input[type=checkbox]").val(),
		factura_no: $("#nofactura").val()
			}
																	
		hilo=$.post(
			'../Clases/Ajax/add_ruta.php',
			JSON.stringify(arr1),
			function(msg) {
				var message=$.trim(msg);
				console.log("LLEGUE AL FINAL"+message);
			}); // JSON
							

			$("#Orden_sumario >tbody >tr").eq(x).find("td").eq(5).html($("#nofactura").val());

			} // If is checked

		} // del for
}

    
// JavaScript Document
