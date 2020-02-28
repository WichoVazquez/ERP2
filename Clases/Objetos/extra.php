
function generar_orden_compra()
{
  
  
  var datepickervalue = document.getElementById("datepicker").value;
      if(datepickervalue != ""){
        var no_orden;
        
        var arr={
          
          accion: "InsertarReq_OS",
          estado: 1, 
          cliente_id: 0, 
          usuario_id: $( "#usuario" ).val(),
          fecha_req: $("#datepicker").val(),
          proyecto: "",
          descripcion: "",
          lugar_entrega: "",
          observaciones:$("#orden_mensaje").val(),
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

                      for(x=($('#prueba_compra >tbody >tr').length)-1;x>-1;x--){

                        
                              var isChecked_autorizacion = $("#prueba_compra >tbody >tr input:checkbox")[x].checked;
                              //console.log("numero de detalle pedido id "+$("#prueba_compra >tbody >tr").eq(x).find("input[type=checkbox]").attr("detalle_pedido_id"));
                                     if(isChecked_autorizacion)
                                     {
                                        var arr={
                                          accion: "Insertar_DetalleReq",
                                          no_orden_compra: no_orden, 
                                          producto: $("#prueba_compra >tbody >tr").eq(x).find("input[type=checkbox]").val(), 
                                          cantidad: $("#prueba_compra >tbody >tr").eq(x).find("input[type=text]").val(),
                                          pedido_id: 0

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
                      //var var1=$("#pedido_id").val();
                      //console.log("var1 "+var1);
                      //var var2=$("#var_2").val();
                      //console.log("var2 "+var2);
                      alert("Se creó la Requisición No. "+no_orden);
                      //window.location.href = 'http://localhost/sistemaMogel/interfaces/almacen_detalle_ordenSalida.php?var='+var1+'&var2='+var2+'';
      });
  }else{
   alert("Ingresa Fecha");
   $( this ).dialog( "open" );
}




}