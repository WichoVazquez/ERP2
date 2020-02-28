var no_cotizacion;
var user;
var contact;


 $(function() {

	$("#crear_orden_transportes" ).show();
$("#dialog_solicitudes_logistica" ).hide();

	$("#crear_orden_transportes" )
      .button()
      .click(function() {

     console.log("hola sin funciona esta cosa");
      $("#dialog_solicitudes_logistica" ).dialog( "open" );



 });
 $( "#dialog_instrucciones4" ).dialog({
      autoOpen: true,
      height: 600,
      width: 600,
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

 $( "#dialog_instrucciones5" ).dialog({
      autoOpen: true,
      height: 600,
      width: 600,
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

$( "#dialog_solicitudes_logistica" ).dialog({
      autoOpen: false,
      height:300,
      width: 700,
      modal: true,
      buttons: { "Aceptar": function() 
     {
      Insentar_solicitudes_laboratorio();
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
  ajax.open("POST","../Clases/Ajax/busquedaalmacen_orden_salida.php",true);
  ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  ajax.send("search="+bus+"&pag="+nropagina);
}

function Insentar_solicitudes_laboratorio()
{
 var bandera = 0;


       for(x=($('#pedidos_tabla >tbody >tr').length)-1;x>-1;x--){

         var status_almacen = 1;
         var isChecked = $("#pedidos_tabla >tbody >tr input:checkbox")[x].checked;
    
  if(isChecked)
          {
     
            console.log("SI ENTRE AQUI:"+$("#pedidos_tabla >tbody >tr").eq(x).find("input[type=checkbox]").val());
     

 var arr={
      accion: "Insert_solicitudes",
      id_pedido: $("#pedidos_tabla >tbody >tr").eq(x).find("input[type=checkbox]").val(),
      id_usuario: $("#usuario").val(),
      fecha_sol: $("#datepicker").val(),
      descripcion: $("#descripcion_solicitud").val()
      };

     hilo=$.post(
        '../Clases/Ajax/add_ruta_solicitudes.php',
        JSON.stringify(arr),
        function(msg) {
        no_orden=$.trim(msg);
        console.log("INGRESAMOS SOLICITUD"+msg);    
       });

  } //if checked

  




  }    // for

  if(bandera)
{           
alert("Los productos fueron asignados"); 
  }
    

}