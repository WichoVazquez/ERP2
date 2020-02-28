/*campos del perfil */
var nombre_perfil;
var descripcion_perfil
/* Almacenar las pantallas seleccionadas*/




function objetoAjax(){
 if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
  else
    {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  return xmlhttp;
}

$(function() {
  //Opciones de Alta, Baja y Consulta ocultas inicialmente

 
  $("#dialog-form" ).dialog({
    autoOpen: false,
    height: 400,
    width: 500,
    modal: true,
    buttons: {
      "Aceptar":   function() {
//"Cancelar": function() {
        $( this ).dialog( "close" );
      },
      "Cancelar": function() {
        $( this ).dialog( "close" );
      }
    },
    close: function() {
 //     allFields.val( "" ).removeClass( "ui-state-error" ); 
    }
  }); 
  
  $("#add_pantallas").button().click(function() {
      $( "#dialog-form" ).dialog( "open" );
  });

  // Boton guardar perfil y relacion perfil-pantallas
  $("#guardar-perfil").button().click(function() {
    console.log("ENTRE A GUARDAR: perfil: "+$( "#nombre" ).val()+"descripcion: "+$( "#descripcion" ).val());
    guardarPerfil();
  });

  /* Fin del boton guardar perfil y relacion perfil-pantallas*/

  

  // $(':checkbox').on('click',function(){
  //   mostrarABCTodos();
  // });

});


function editarPerfil(id_editar)
{
var arr={
    accion:'actualizarPerfil',
    perfil_id:id_editar,
    perfil_nombre: $("#nombre").val(),
    perfil_descripcion: $("#descripcion").val()

  }

  hilo=$.post('../Clases/Ajax/editar_perfil.php',
    JSON.stringify(arr),
    function(msg) {
      msg_perfil=$.trim(msg);
     // console.log("MENSAJE DE INSERT Perfil:"+msg_perfil);
//      window.location.href = 'CATALOGOS.php';

      if(msg_perfil='ok'){
       // console.log("Perfil Generado: "+msg_perfil);
        guardarPerfilPantallas(id_editar);
       // window.location.href = 'perfil_busqueda.php';
      }
      else
        alert('El Perfil no modifico');
      //console.log("det_cot antes:"+message);
    }
  );
}



function EliminarPermisos(id_editar){
 // console.log("Entre a guardarPerfil()");
  var arr={
    accion:'eliminarPermisos',
    perfil_id:id_editar
  }

  hilo=$.post('../Clases/Ajax/editar_perfil.php',
    JSON.stringify(arr),
    function(msg) {
      msg_perfil=$.trim(msg);
     // console.log("MENSAJE DE INSERT Perfil:"+msg_perfil);
//      window.location.href = 'CATALOGOS.php';

       if(msg_perfil='ok'){
        msg_perfil=id_editar;
       // console.log("Perfil Generado: "+msg_perfil);
        //guardarPerfilPantallas();
      }
      else
        alert('No se Actualizaron los permisos del Perfil');
    }
  );

  hilo.done(
    function(){
      guardarPerfilPantallas(id_editar);
      window.location.href = 'perfil_busqueda.php';
    }
  );
}


function guardarPerfil(){
 // console.log("Entre a guardarPerfil()");
  var arr={
    perfil_nombre: $("#nombre").val(),
    perfil_descripcion: $("#descripcion").val()
  }

  hilo=$.post('../Clases/Ajax/crear_perfil.php',
    JSON.stringify(arr),
    function(msg) {
      msg_perfil=$.trim(msg);
     // console.log("MENSAJE DE INSERT Perfil:"+msg_perfil);
//      window.location.href = 'CATALOGOS.php';

      if(msg_perfil>0){
     //   console.log("Perfil Generado: "+msg_perfil);
        guardarPerfilPantallas(msg_perfil);
      }
      else
        alert('El Perfil ya existe');
      //console.log("det_cot antes:"+message);
    }
  );

/*  hilo.done(
    function(){
      checkChanges(false);
    }
  );*/
}

function guardarPerfilPantallas(idPerfil){
  console.log("Entre a guardarPerfilPantallas()");
  //getPantallas();
   var result="";  
	  for(x=($('#Permisos >tbody >tr').length)-1;x>-1;x--){
		
    var isChecked = $("#Permisos >tbody >tr input:checkbox")[x].checked;
     

    if(isChecked)
    {

      result= result+ $("#Permisos >tbody >tr").eq(x).find("input[type=checkbox]").val()+"|" ;
			
			
		}

}  
  
 console.log(result);
    
     var arr1={
       perfil_id:idPerfil, 
       pantalla_id:result
       }

   //    console.log($("#Permisos >tbody >tr").eq(x).find("input[type=checkbox]").val())
      hilo=$.post(
        '../Clases/Ajax/add_perfil_pantalla.php',
        JSON.stringify(arr1),
        function(msg) {
         var message=$.trim(msg);
          console.log(message);
         // if(x==-1)
          window.location.href = 'perfil_busqueda.php';
       //          
       }
      );  

  
}




