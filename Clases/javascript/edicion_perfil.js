/*campos del perfil */
var nombre_perfil;
var descripcion_perfil
/* Almacenar las pantallas seleccionadas*/
var OP_GUARDAR = 7;
var idCheckBoxCHK = 'chk-';
var idCheckBoxOPC = '-opc';
// arrays a guardar
var arrayGuardarRegsIds = Array(); // ids de pantalla
var arrayGuardarRegsAltas = Array(); // 1/0 alta
var arrayGuardarRegsBajas = Array(); // 1/0 baja
var arrayGuardarRegsConsultas = Array(); // 1/0 consulta
var arrayGuardarRegsEdicions = Array(); // 1/0 edicion

var arrayGuardarRegsOpc = Array();
var arrayCheckBoxChecked = Array();

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

  $('#opc-almacen_busqueda').hide();
  $('#opc-cliente_busqueda').hide();
  $('#opc-cotizacion_busqueda').hide();
  $('#opc-empresa_busqueda').hide();
  $('#opc-material_busqueda').hide();
  $('#opc-matriz_busqueda').hide();
  $('#opc-menu_almacen').hide();
  $('#opc-menu_calidad').hide();
  $('#opc-menu_catalogos').hide();
  $('#opc-menu_compras').hide();
  $('#opc-menu_facturacion').hide();
  $('#opc-menu_taller').hide();
  $('#opc-menu_trafico').hide();
  $('#opc-menu_ventas').hide();
  $('#opc-moneda_busqueda').hide();
  $('#opc-pantalla_busqueda').hide();
  $('#opc-pedidos_busqueda').hide();
  $('#opc-perfiles_busqueda').hide();
  $('#opc-precio_busqueda').hide();
  $('#opc-prospecto_busqueda').hide();
  $('#opc-proveedor_busqueda').hide();
  $('#opc-reportes_ventas').hide();
  $('#opc-transporte_busqueda').hide();
  $('#opc-usuario_busqueda').hide();

  $("#dialog-form" ).dialog({
    autoOpen: false,
    height: 400,
    width: 500,
    modal: true,
    buttons: {
      "Aceptar": 
      function() {
//        if(($("#total").val()*1)>0) {
          console.log("debe obtener pantallas");
          console.log('boton aceptar');
        getPantallas($(this));
//        }
      },
      "Cancelar": function() {
        $( this ).dialog( "close" );
      }
    },
    close: function() {
 //     allFields.val( "" ).removeClass( "ui-state-error" ); 
    }
  }); 
  
  $("#edit_pantallas").button().click(function() {
      $( "#dialog-form" ).dialog( "open" );
  });

  // Boton guardar perfil y relacion perfil-pantallas
  $("#guardar-perfil").button().click(function() {
    console.log("ENTRE A GUARDAR: perfil: "+$( "#nombre" ).val()+"descripcion: "+$( "#descripcion" ).val());
    guardarPerfil();
  });

  /* Fin del boton guardar perfil y relacion perfil-pantallas*/

  /* seleccion de todos los modulos (checkboxs) de cada Menu */
  $('#checkMain_menu_catalogos').on('click',function(){
    $('.checkAll_Catalogos').attr('checked',($(this).is(':checked')) ? true:false);
  });
  $('#checkMain_menu_ventas').on('click',function(){
    $('.checkAll_Ventas').attr('checked',($(this).is(':checked')) ? true:false);
  });
  $('#checkMain_menu_compras').on('click',function(){
    $('.checkAll_Compras').attr('checked',($(this).is(':checked')) ? true:false);
  });
  $('#checkMain_menu_facturacion').on('click',function(){
    $('.checkAll_Facturacion').attr('checked',($(this).is(':checked')) ? true:false);
  });
  $('#checkMain_menu_almacen').on('click',function(){
    $('.checkAll_Almacen').attr('checked',($(this).is(':checked')) ? true:false);
  });
  $('#checkMain_menu_taller').on('click',function(){
    $('.checkAll_Taller').attr('checked',($(this).is(':checked')) ? true:false);
  });
  $('#checkMain_menu_calidad').on('click',function(){
    $('.checkAll_Calidad').attr('checked',($(this).is(':checked')) ? true:false);
  });
  $('#checkMain_menu_trafico').on('click',function(){
    $('.checkAll_Trafico').attr('checked',($(this).is(':checked')) ? true:false);
  });
  /* fin de seleccion de checkbox */

  $(':checkbox').on('click',function(){
    mostrarABCTodos();
  });

});

/* Itera en cada checkbox para mostrar u ocultar el ABC de un Modulo(y son un chingo...)*/
function mostrarABCTodos(){
  console.log('mostrarABCTodos()');
  arrIdChecked = [];
  arrIdUnChecked = [];

  arrCheckBoxChecked = $('input[type=checkbox]:checked').map(function(){
      return $(this).attr('id');
  }).get();
//  alert("checados: "+arrCheckBoxChecked.length+ ': '+arrCheckBoxChecked);
  for(i=0; i < arrCheckBoxChecked.length; i++){
      var split = arrCheckBoxChecked[i].split('-');
      arrIdChecked[i] = split[1];
//      alert($('#opc-'+arrIdChecked[i]));
      $('#opc-'+arrIdChecked[i]).show();
  }

  arrCheckBoxUnChecked = $('input[type=checkbox]:not(:checked)').map(function(){
      return $(this).attr('id');
  }).get();
//  alert("no checados "+arrCheckBoxUnChecked.length+ ': '+arrCheckBoxUnChecked);
  for(i=0; i < arrCheckBoxUnChecked.length; i++){
      var split = arrCheckBoxUnChecked[i].split('-');
      arrIdUnChecked[i] = split[1];
      // Deseleccionamos lo seleccionado y ocultamos el ABC
      $("input[id^='id-"+arrIdUnChecked[i]+"']").attr('checked', false);
      $('#opc-'+arrIdUnChecked[i]).hide();
  }
}
/*
  if ($('#chk-proveedores_busqueda').is(":checked"))
    $('#proveedores-opc').show();
  else
    $('#proveedores-opc').hide();
  if ($('#chk-cliente_busqueda').is(":checked"))
    $('#clientes-opc').show();
  else
    $('#clientes-opc').hide();
  if ($('#chk-almacen_busqueda').is(":checked"))
    $('#almacen-opc').show();
  else
    $('#almacen-opc').hide();
  if ($('#chk-material_busqueda').is(":checked"))
    $('#material-opc').show();
  else
    $('#material-opc').hide();
  if ($('#chk-empresa_busqueda').is(":checked"))
    $('#empresa-opc').show();
  else
    $('#empresa-opc').hide();
  if ($('#chk-matriz_busqueda').is(":checked"))
    $('#matriz-opc').show();
  else
    $('#matriz-opc').hide();
*/

function guardarPerfil(){
  console.log("Entre a guardarPerfil()");
  var arr={
    perfil_nombre: $("#nombre").val(),
    perfil_descripcion: $("#descripcion").val()
  }

  hilo=$.post('../Clases/Ajax/crear_perfil.php',
    JSON.stringify(arr),
    function(msg) {
      msg_perfil=$.trim(msg);
      console.log("MENSAJE DE INSERT Perfil:"+msg_perfil);
//      window.location.href = 'CATALOGOS.php';

      if(msg_perfil>0){
        console.log("Perfil Generado: "+msg_perfil);
        guardarPerfilPantallas();
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

function guardarPerfilPantallas(){
  console.log("Entre a guardarPerfilPantallas()");
  //getPantallas();
  for (var i=0; i<arrayGuardarRegsIds.length; i++) {
    var arr={
      perfil_id: msg_perfil,
      pantalla_id: arrayGuardarRegsIds[i],
      alta: arrayGuardarRegsAltas[i],
      baja: arrayGuardarRegsBajas[i],
      consulta: arrayGuardarRegsConsultas[i],
      modificacion: arrayGuardarRegsEdicions[i]
    }
    console.log(arr);
    hilo=$.post('../Clases/Ajax/add_perfil_pantalla.php',
      JSON.stringify(arr),
      function(msg) {
        msg_compra=$.trim(msg);
        console.log("MENSAJE DE INSERT Perfil_Pantalla:"+msg_compra);
        alert("Perfil Generado");
//      window.location.href = 'CATALOGOS.php';

      //if(message=="Error")
      //console.log("det_cot antes:"+message);
      }
    );
  }

  hilo.done(
    function(){
      window.location.href = 'perfil_busqueda.php';
//      checkChanges(false);
    }
  );
}

function getPantallas(ventana){
  console.log('getPantallas(ventana)');
  j=0;;
  arrayCheckBoxChecked = [];
  arrayCheckBoxChecked = $('input[id^="chk-"]:checked'); //objetos checkbox que comienzan con 'opc-'(Modulos)
  console.log('tamaño: '+arrayCheckBoxChecked.length);
  for (i=0;i<arrayCheckBoxChecked.length;i++){
    console.log('id:'+arrayCheckBoxChecked[i].id);
    opcion = arrayCheckBoxChecked[i].id.split('-')[1];
    console.log('opcion:'+opcion);
    arrayGuardarRegsIds[i]=arrayCheckBoxChecked[i].value;  //id en la db de la pantalla

    arrayGuardarRegsAltas[i] = ( $("input[id^='id-"+opcion+"_alta']").is(':checked') ) ? 1:0;
    arrayGuardarRegsBajas[i] = ( $("input[id^='id-"+opcion+"_baja']").is(':checked') ) ? 1:0;
    arrayGuardarRegsConsultas[i] = ( $("input[id^='id-"+opcion+"_consulta']").is(':checked') ) ? 1:0;
    arrayGuardarRegsEdicions[i] = ( $("input[id^='id-"+opcion+"_edicion']").is(':checked') ) ? 1:0;
  }
    ventana.dialog("close");
}
//----------------------------------------------------------
//  alert('getPantallas');
/*  j=0;;
  arrayCheckBoxChecked = [];
  arrayCheckBoxChecked = $('input[type=checkbox]:checked');
  
  for (i=0;i<arrayCheckBoxChecked.length;i++){
    var id=arrayCheckBoxChecked[i].id;  //id de la opcion

    if (id.indexOf('id-')==0){
      arrayGuardarRegsIds[j]=arrayCheckBoxChecked[i].value;
      var opcion = arrayCheckBoxChecked[i].id.split('_');
      arrayGuardarRegsOpc[j]=opcion[2];
      j++;
    }
  }
  ventana.dialog("close");
} */