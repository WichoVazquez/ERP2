var no_cotizacion;
var user;
var contact;


 $(function() {
  
  $("#products_contain_logistica" ).hide();
	$("#enviar-taller" ).show();
	$("#dialog_lab").hide();
  $("#dialog_transportes").hide();
  $("#dialog_nota_salida").hide();
  $("#dialog_ordenes").hide();

$( "#dialog_lab" ).dialog({
      autoOpen: false,
      height:400,
      width: 700,
      modal: true,
      buttons: {
        "Aceptar": 
					function() 
					{
      GuardarOrden(detalle_compra);
        $( this ).dialog( "close" );
	$( "#dialog_instrucciones44" ).dialog( "open" );
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

$( "#dialog_instrucciones44" ).dialog({
      autoOpen: false,
      height: 600,
      width: 600,
      modal: true,
      buttons: {
        "Aceptar": 
          function() 
          {

            $( this ).dialog( "close" );
            $( "#dialog_lab" ).dialog( "close" );
            
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
    
$( "#dialog_instrucciones6" ).dialog({
      autoOpen: true,
      height: 600,
      width: 1200,
      modal: true,
      buttons: {
        "Aceptar": 
          function() 
          {
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

$( "#dialog_nota_salida" ).dialog({
      autoOpen: false,
      height:300,
      width: 700,
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

  $( "#dialog_instrucciones4" ).dialog({
      autoOpen: true,
      height: 600,
      width: 1200,
      modal: true,
      buttons: {
        "Aceptar": 
          function() 
          {
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

$( "#dialog_transportes" ).dialog({
      autoOpen: false,
      height:300,
      width: 700,
      modal: true,
      buttons: {
        "Aceptar": 
     function() 
     {
      GuardarTransportes(detalle_compra);
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

$( "#products_contain_logistica" ).dialog({
      autoOpen: false,
      height:500,
      width: 700,
      modal: true,
      buttons: {
        "Aceptar": 
     function() 
     {
      GuardarTransportes();
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

$( "#dialog_orden_det" ).dialog({
      autoOpen: false,
      height: 570,
      width: 960,
      modal: true,
      buttons: {
        "Aceptar": 
          function() 
          {
            generar_orden_compra();
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

 $( "#dialog_instrucciones3" ).dialog({
      autoOpen: false,
      height: 600,
      width: 1200,
      modal: true,
      buttons: {
        "Aceptar": 
          function() 
          {
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

$( "#dialog_ordenes" ).dialog({
      autoOpen: false,
      height:600,
      width: 900,
      modal: true,
      buttons: {
        "Aceptar": 
     function() 
     {
     
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

$("#generar_orden_compra" )
      .button()
      .click(function() {
console.log("entra AQUI 1");

                var bandera = 0;
                var cantidad_detalle;
                var cantidad_p;
                var existencia_p;


          $("#orden_compra_det tbody").empty();

        for(x=($('#productos >tbody >tr').length)-1;x>-1;x--){
console.log("entra AQUI 2 "+x);
          var isChecked = $("#productos >tbody >tr input:checkbox")[x].checked;
          console.log("entra AQUI 3 "+isChecked);
                if(isChecked)
                 {
                  console.log("cantidad "+$("#productos >tbody >tr").eq(x).find("td").eq(3).html());
                  console.log("cantidad "+$("#productos >tbody >tr").eq(x).find("td").eq(8).html());
                  cantidad_p=($("#productos >tbody >tr").eq(x).find("input[type=checkbox]").attr("cant_mat")*1);
                  existencia_p=($("#productos >tbody >tr").eq(x).find("input[type=checkbox]").attr("cant_exis")*1);
                  cantidad_s=($("#productos >tbody >tr").eq(x).find("input[type=checkbox]").attr("cant_surt")*1);
                 // cantidad_r=($("#productos >tbody >tr").eq(x).find("input[type=checkbox]").attr("cant_req")*1);
                  //cantidad_detalle = $("#productos >tbody >tr").eq(x).find("input[type=checkbox]").attr("cant_mat");
                  //cantidad_detalle = ($("#productos >tbody >tr").eq(x).find("input[type=checkbox]").eq(4).html()*1)-($("#productos >tbody >tr").eq(x).find("input[type=checkbox]").eq(9).html()*1);
                  cantidad_detalle = existencia_p-cantidad_p-cantidad_s;

                  console.log("cantidad_p "+cantidad_p);
                    console.log("existencia_p "+existencia_p);
                      console.log("cantidad_s "+cantidad_s);
               $( "#orden_compra_det tbody" ).append( "<tr>" +
              "<td><input type='checkbox' value='"+ $("#productos >tbody >tr").eq(x).find("input[type=checkbox]").attr("id_mat") + "' detalle_pedido_id='"+ $("#productos >tbody >tr").eq(x).find("input[type=checkbox]").val() + "' cantidad_s='"+ cantidad_detalle +"' checked></td>" +
              "<td>" +  $("#productos >tbody >tr").eq(x).find("td").eq(1).html()+ "</td>" +
              "<td>" +  $("#productos >tbody >tr").eq(x).find("td").eq(2).html() + "</td>" +
              "<td>" +  $("#productos >tbody >tr").eq(x).find("td").eq(3).html() + "</td>" +  
              "<td>" + $("#productos >tbody >tr").eq(x).find("td").eq(8).html() + "</td>" +  
              "<td>" +  $("#productos >tbody >tr").eq(x).find("td").eq(5).html() + "</td>" +  
              
              
              
              "<td>"+ " <input type='text' name='enr"+x+"' id='enr"+x+"' value='"+cantidad_detalle +"' size='5'  onkeypress=\"return NumEntero(event)\" />" +  "</td>" +          
            "</tr>" );
               $("#productos >tbody >tr input:checkbox")[x].checked = false;
              }
            }
          
          
          $("#dialog_orden_det").dialog( "open" );
          
  

      });

$("#enviar-autorizacion" )
      .button()
      .click(function() {

        if ( ($('#almacen option:selected').attr("almacen_tipo")==1))

              status_almacen = 1;
             else
              status_almacen = 0;


        for(x=($('#productos >tbody >tr').length)-1;x>-1;x--){

                  var status_almacen = 1;
                  var isChecked = $("#productos >tbody >tr input:checkbox")[x].checked;
        
        if(isChecked)
                 {
          
                      console.log("SI ENTRE AQUI:"+$("#productos >tbody >tr").eq(x).find("input[type=checkbox]").val());

console.log("EL STATUS ES: "+status_almacen+" DEL MATERIAL: "+$("#productos >tbody >tr").eq(x).find("td").eq(2).html());
    if (status_almacen<2)
    {

              var arr={
                accion: "EnviaTaller",
                id_detalle_pedido: $("#productos >tbody >tr").eq(x).find("input[type=checkbox]").val(),
                status: status_almacen,
                almacen_id : 2
                };

              hilo=$.post(
                   '../Clases/Ajax/update_pedido_detalle.php',
                   JSON.stringify(arr),
                   function(msg) {
                    no_orden=$.trim(msg);
                    
                    //$("#orden").val(msg);
                    console.log("CAMBIO DE STATUS"+msg);
                    
                  }
                  );


  $("#productos >tbody >tr").eq(x).find("input[type=checkbox]").hide();
  $("#productos >tbody >tr input:checkbox")[x].checked = false;
               
          }
          

    } //if checked




    }    // for


      hilo.done(  
      function(){
        console.log("EL STATUS: "+$('#almacen option:selected').attr("almacen_tipo"));
            var arr={
                accion: "EnviaNotificacion",
                folio: $("#folio").val(),
                status: $('#almacen option:selected').attr("almacen_tipo")
                };

              hilo2=$.post(
                   '../Clases/Ajax/update_pedido_detalle.php',
                   JSON.stringify(arr),
                   function(msg) {
                    no_orden=$.trim(msg);
                    
                    //$("#orden").val(msg);
                    console.log("NOTIFICACION ENVIADA"+msg);
                    
                  }
                  );

        
        alert("Los productos fueron asignados"); 
          
      }
    );
});
	$("#enviar-taller" )
      .button()
      .click(function() {


var bandera = 0;

 if ( ($('#almacen option:selected').attr("almacen_tipo")==1))

              status_almacen = 1;
             else
              status_almacen = 0;


      	for(x=($('#productos >tbody >tr').length)-1;x>-1;x--){

									var status_almacen = 1;
									var isChecked = $("#productos >tbody >tr input:checkbox")[x].checked;
				
		    if(isChecked)
				  			 {
					
					 						console.log("SI ENTRE AQUI:"+$("#productos >tbody >tr").eq(x).find("input[type=checkbox]").val());
/*
            if ( ($('#almacen option:selected').attr("almacen_tipo")==1))

              status_almacen = 1;
             else
              status_almacen = 0;
*/
					
		/*													if ( ($('#almacen option:selected').attr("almacen_tipo")==1))

				{
				if (($("#productos >tbody >tr").eq(x).find("td").eq(2).html()=="REC") || ($("#productos >tbody >tr").eq(x).find("td").eq(2).html()=="NVO"))
					{
						status_almacen=1;
					}
					else
						alert("El producto: "+$("#productos >tbody >tr").eq(x).find("td").eq(3).html()+" no corresponde a Taller");
				}

				else
				{
							if ($("#productos >tbody >tr").eq(x).find("td").eq(2).html()=="REC")
					{
						alert("El producto: "+$("#productos >tbody >tr").eq(x).find("td").eq(3).html()+" no corresponde a Almacén");
					}
					else
						status_almacen=0;
				}
				*/
console.log("EL STATUS ES: "+status_almacen+" DEL MATERIAL: "+$("#productos >tbody >tr").eq(x).find("td").eq(2).html());
		if (status_almacen<2)
		{

							var arr={
								accion: "EnviaTaller",
								id_detalle_pedido: $("#productos >tbody >tr").eq(x).find("input[type=checkbox]").val(),
								status: status_almacen,
								almacen_id : $( "#almacen" ).val()
								};

							hilo=$.post(
									 '../Clases/Ajax/update_pedido_detalle.php',
									 JSON.stringify(arr),
									 function(msg) {
										no_orden=$.trim(msg);
										
										//$("#orden").val(msg);
										console.log("CAMBIO DE STATUS"+msg);
										
									}
									);

bandera = 1;
	$("#productos >tbody >tr").eq(x).find("input[type=checkbox]").hide();
	$("#productos >tbody >tr input:checkbox")[x].checked = false;
						   
					}
					

		} //if checked




		}    // for


      hilo.done(  
      function(){
        console.log("EL STATUS: "+$('#almacen option:selected').attr("almacen_tipo"));
            var arr={
                accion: "EnviaNotificacion",
                folio: $("#folio").val(),
                status: $('#almacen option:selected').attr("almacen_tipo")
                };

              hilo2=$.post(
                   '../Clases/Ajax/update_pedido_detalle.php',
                   JSON.stringify(arr),
                   function(msg) {
                    no_orden=$.trim(msg);
                    
                    //$("#orden").val(msg);
                    console.log("NOTIFICACION ENVIADA"+msg);
                    
                  }
                  );

        if(bandera){   

        alert("Los productos fueron asignados"); 
        $( "#dialog_instrucciones3" ).dialog( "open" ); 
    }
          
      }
    );

      });

 $("#enviar_transporte" )
      .button()
      .click(function() {

        $("#productos_logistica tbody").empty();

       var bandera = 0;
      for(x=($('#productos >tbody >tr').length)-1;x>-1;x--){
         var isChecked = $("#productos >tbody >tr input:checkbox")[x].checked;
         if(isChecked){
              $( "#productos_logistica tbody" ).append( "<tr>" +
              "<td>"+$("#productos >tbody >tr").eq(x).find("td").eq(1).html()+"</td>" +
              "<td>"+$("#productos >tbody >tr").eq(x).find("td").eq(2).html()+"</td>" +
              "<td>"+$("#productos >tbody >tr").eq(x).find("td").eq(4).html()+"</td>" +
              "<td>"+ " <input type='text' name='enr"+x+"' id='enr"+x+"' value='"+$("#productos >tbody >tr").eq(x).find("input[type=checkbox]").attr("cantidad")+"' id_detalle_pedido='"+$("#productos >tbody >tr").eq(x).find("input[type=checkbox]").attr("cantidad")+"'   onkeypress=\"return NumEntero(event)\" />" +  "</td>" + 
            "</tr>" );
              bandera=1;
         }
       }
         
       if (bandera)
            $("#products_contain_logistica").dialog( "open" );
           else
            alert("No se seleccionaron Productos");
      });

	$("#enviar-almacen" ).hide();
	$("#enviar-almacen" )
      .button()
      .click(function() {

      	for(x=($('#productos >tbody >tr').length)-1;x>-1;x--){
			
				     var isChecked = $("#productos >tbody >tr input:checkbox")[x].checked;
				
				   if(isChecked)
				   {
					
					 console.log("SI ENTRE AQUI:"+$("#productos >tbody >tr").eq(x).find("input[type=checkbox]").val());

					console.log("BUSCANDO ESTA MADRE:"+$("#productos >tbody >tr").eq(x).find("td").eq(1).html());
					
    	var arr={
						id_detalle_pedido: $("#productos >tbody >tr").eq(x).find("input[type=checkbox]").val(),
						status: 0			
						};

					hilo=$.post(
							 '../Clases/Ajax/update_pedido_detalle.php',
							 JSON.stringify(arr),
							 function(msg) {
								no_orden=$.trim(msg);
        console.log("CAMBIO DE STATUS"+msg);				
							});

									$("#productos >tbody >tr").eq(x).find("input[type=checkbox]").hide();
				   }

			}
	
    
      });

 $("#agregar-producto")
      .button()
      .click(function() {
      
			$("#agregar-cotizacion").hide();
			$('#agregar-servicio').hide();
			$("#cantidad").attr("readonly", "readonly");
			$("#cantidad").val("1");
			$("#cantidad-promo").attr("readonly", "readonly");
			$("#cantidad-promo").val("0");
			$("#total").val("0");
												$('#producto').each(function(){
										this.value = $(this).attr('value');
										$(this).addClass('text-label');
										$(this).focus(function(){
											if(this.value == $(this).attr('title')) {
												this.value = '';
												$(this).removeClass('text-label');
											}
										});
									 
										$(this).blur(function(){
											if(this.value == '') {
												this.value = $(this).attr('title');
												$(this).addClass('text-label');
											}
						    	  });
		});    
		 
        $( "#dialog-form" ).dialog( "open" );
    
    
      });
    
 $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 500,
      width: 650,
      modal: true,
      buttons: {
        "Agregar": 
					function() 
					{
						
		
							
									
						console.log("El pedido no tiene NO");				
									 $( "#productos tbody" ).append( "<tr>" +
						  "<td></td>" +
						  "<td>REC</td>" +
						  "<td>" +  $("#producto").val()+ "</td>" +
						  "<td>" +  $("#cantidad").val() + "</td>" +
						  "<td>PIEZA</td>" +					  
						  "<td>" +  $("#cantidad").val() + "</td>" +			  
						  "<td><img src='../imagenes/verde.png'  title='Completo'/></td>" +	
						"</tr>" );

					}
		,
        "Cancelar": function() {
					  	$( this ).dialog( "close" );
					}
      },
      close: function() {
//        allFields.val( "" ).removeClass( "ui-state-error" );
console.log("se cerro esto chingon");
      }
    });








 });





function habilitar_datos_compras(edo)
{
	alert("ok");
		if ($( "#C1" ).checked = false)
		{
				$("#datos_compras").hide();
			
		}
		else
		{
				$("#datos_compras").show();
			
		}
}


function generar_orden_compra()
{
  
  for(x=($('#orden_compra_det >tbody >tr').length)-1;x>-1;x--){
    if ($("#orden_compra_det >tbody >tr").eq(x).find("input[type=text]").val()<=0) {
                          alert("Cantidad Invalida");
                          $( this ).dialog( "open" ); 
                        }else{
  var datepickervalue = document.getElementById("datepickers2").value;
      if(datepickervalue != ""){
        var no_orden;
        
        var arr={
          
          accion: "InsertarReq_OS",
          estado: 1, 
          cliente_id: document.getElementById('cliente').value, 
          usuario_id: $( "#usuario" ).val(),
          fecha_req: $("#datepickers2").val(),
          proyecto: $("#proyecto").val(),
          descripcion: $("#descripcion").val(),
          lugar_entrega: $("#lugar_entrega").val(),
          observaciones:$("#especificaciones").val(),
          empresa_id: 0
         
          
        }
hilo=$.post(
     '../Clases/Ajax/add_reqcompra.php',
     JSON.stringify(arr),
     function(msg) {
      no_orden=$.trim(msg);
      console.log("Creo la Compra y la carpeta de archivos"+msg);
    }
    );
      hilo.done(              
            function(){

                      for(x=($('#orden_compra_det >tbody >tr').length)-1;x>-1;x--){

                        
                              var isChecked_autorizacion = $("#orden_compra_det >tbody >tr input:checkbox")[x].checked;
                              console.log("numero de detalle pedido id "+$("#orden_compra_det >tbody >tr").eq(x).find("input[type=checkbox]").attr("detalle_pedido_id"));
                                     if(isChecked_autorizacion)
                                     {
                                        var arr={
                                          accion: "Insertar_DetalleReq",
                                          no_orden_compra: no_orden, 
                                          producto: $("#orden_compra_det >tbody >tr").eq(x).find("input[type=checkbox]").val(), 
                                          cantidad: $("#orden_compra_det >tbody >tr").eq(x).find("input[type=text]").val(),
                                          pedido_id: $("#orden_compra_det >tbody >tr").eq(x).find("input[type=checkbox]").attr("detalle_pedido_id")

                                          }

                                          var det_ord;
                                          hilo_EXTRA=$.post(
                                             '../Clases/Ajax/add_detalle_reqorden.php',
                                             JSON.stringify(arr),
                                             function(msg) {
                                              var message=$.trim(msg);
                                              det_ord=message;

                                            });
                                     }// IF
                                    
                      }  //for de Explosion
                      var var1=$("#pedido_id").val();
                      console.log("var1 "+var1);
                      var var2=$("#var_2").val();
                      console.log("var2 "+var2);
                      alert("Se creó la Requisición No. "+no_orden);
                      window.location.href = 'http://mogel.com.mx/sistema_mogel/interfaces/almacen_detalle_ordenSalida.php?var='+var1+'&var2='+var2+'';
      });
  }else{
   alert("Ingresa Fecha");
   $( this ).dialog( "open" );
}
}
}


}


function update_status(estado)
{
	//console.log("estado"+estado);
	
	observaciones="";
	
	var arr;
	if(estado!=2)
	{
		estado= $( "#select-status" ).val();
		observaciones= $( "#observaciones" ).val();
		sucursal=$("#sucursal").val();
		fecha_ini=$("#datepicker").val();
		var str=fecha_ini;
		var fecha=str.split("/");
	    fecha_ini=fecha[2]+"-"+fecha[0]+"-"+fecha[1];
		
		fecha_entrega=$("#datepicker2").val();
		var str2=fecha_ini;
		var fecha2=str.split("/");
	    fecha_entrega=fecha2[2]+"-"+fecha2[0]+"-"+fecha2[1];
		arr={cotizacion: no_cotizacion, status: estado,  obs: observaciones, suc: sucursal, f_inicio: fecha_ini, f_entrega: fecha_entrega};
	}
	else
	{
		pass=$( "#passmail" ).val()
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
						
					}
					else
					{
						Pagina(1);
						alert("Se ha enviado la cotizacion");
						
					}
					
					//$("#dialog-status").dialog("close");
					//si se hizo un aumento o descuento actualizar el monto total aumentado
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
  document.getElementById('cantidad').removeAttribute("readonly");
  //$("#cantidad").attr("unidad", str.unidad);
  document.getElementById('cantidad').setAttribute("unidad", str.unidad);
  document.getElementById('cantidad').setAttribute("title", str.unidad);
  //document.getElementById('cantidad-promo').removeAttribute("readonly");
  document.getElementById('preciobase').value=str.precio;
  document.getElementById('preciounit').value=str.precio;
  document.getElementById('livesearch').innerHTML="";
  document.getElementById("livesearch").style.border="0px";
 // calcularMontos($("#cantidad").val());
  
}

function crear_orden(detalle_producto){ 

 detalle_compra = detalle_producto.id;

 $("#dialog_lab").dialog( "open" );

}

function crear_solicitud_transportes(detalle_producto){ 

 detalle_compra = detalle_producto.id;

 $("#dialog_transportes").dialog( "open" );

}

function crear_nota_salida(detalle_producto){ 

 detalle_compra = detalle_producto.id;

 $("#dialog_nota_salida").dialog( "open" );

}

function visualizar_ordenes(detalle_producto){ 

 detalle_compra = detalle_producto.id;

 $("#dialog_ordenes").dialog( "open" );

}

function GuardarOrden(detalle_producto)
{
 console.log("Orden Lab ENTRAMOS: "+$('#unidad_medida').val());
 console.log("Orden Lab ENTRAMOS el LOTE: "+$('#lote_lab').val());
  var arr2={
  accion: "InsertarLaboratorioDetalle", 
  tipo: 0,
  cantidad: $("#Cantidad_Lab").val(),
  idDetalle: detalle_producto,
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
    alert("Se creó Orden Laboratorio. "+message);
    
    }
  ); 
}

function GuardarOrden_Adicionales(detalle_producto)
{
 console.log("Orden Lab ENTRAMOS: "+$('#unidad_medida').val());
  var arr2={
  accion: "InsertarLaboratorioProductos", 
  tipo: 0,
  cantidad: $("#Cantidad_Lab").val(),
  id_producto: id_producto,
  usuario: $('#usuario').val(),
  id_unidad: $('#unidad_medida').val(),
  servicio_lab: $('#servicio_lab').val(),
  observaciones_lab: $('#observaciones_lab').val()

  }
  
  hilo=$.post(
    '../Clases/Ajax/add_laboratorio.php',
    JSON.stringify(arr2),
    function(msg) {
    var message=$.trim(msg);
    console.log("Saliendo Lab:"+message);
    alert("Se creó Orden Laboratorio. "+message);
    
    }
  ); 
}

function GuardarTransportes()
{
 var bandera = 0;
       for(x=($('#productos_logistica >tbody >tr').length)-1;x>-1;x--){

       var arr={
        accion: "Insert_solicitudes",
        id_detalle_pedido: $("#productos_logistica >tbody >tr").eq(x).find("input[type=text]").attr("id_detalle_pedido"),
        fecha_entrega: $("#datepicker").val(),
        destino:  $("#destino_transportes").val(),
        observaciones: $("#observaciones").val(),
        id_usuario : $("#usuario").val(),
        cantidad: $("#productos_logistica >tbody >tr").eq(x).find("input[type=text]").val()
        };

       hilo=$.post(
          '../Clases/Ajax/add_ruta_solicitudes.php',
          JSON.stringify(arr),
          function(msg) {
          no_orden=$.trim(msg);
          
          //$("#orden").val(msg);
          console.log("CAMBIO DE STATUS"+msg);
          
         }
         );

     bandera = 1;
     $("#productos >tbody >tr input:checkbox")[x].checked = false;
         

  }    // for

           
   alert("Solicitud a Transporte Generada");
}

function ver_ordenes(detalle_producto)
{

 var status_txt = "";

 console.log ("Detalle producto: "+detalle_producto.id);
   var arr1={
   accion: "obtenerOrdenes_Laboratorio",
   idDetalle: detalle_producto.id
   }  
     $("#Ordenes_laboratorio tbody").empty();
       
   hilo=$.post(
     '../Clases/Ajax/add_laboratorio.php',
     JSON.stringify(arr1),
     function(msg) {
     var message=msg;
     var aDetalle = JSON.parse( message );

     if(aDetalle != null)
     {
      for(x=0;x<(aDetalle.length);x++){
      
       if (aDetalle[x][9]==0)
         status_txt = "<b>Pendiente</b>";
        else
         status_txt = "TERMINADO";


         $( "#Ordenes_laboratorio tbody" ).append( "<tr>" +
        "<td>" + aDetalle[x][0]+ "</td>" +
        "<td>" + aDetalle[x][1] + "</td>" +
        "<td>" + aDetalle[x][10] + "</td>" +       
        "<td>" + aDetalle[x][3] + "</td>" +    
        "<td>" + aDetalle[x][4] +  "</td>" +   
        "<td>" + aDetalle[x][5] +  "</td>" +  
        "<td>" + aDetalle[x][6] +  "</td>" +
        "<td>" + aDetalle[x][7] +  "</td>" +
        "<td>" + aDetalle[x][8] +  "</td>" +
        "<td>" + status_txt +  "</td>" +
        "<td>" + aDetalle[x][11] +  "</td>" +
      "</tr>" );       
        }
               
      $("#dialog_ordenes").dialog( "open" );     
     }
       
    }
   ); 
}