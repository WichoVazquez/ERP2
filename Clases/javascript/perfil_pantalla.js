

var cantidad_actual=0;

function ponerValorPerfil(str){
  document.getElementById('perfil').value=str;
  document.getElementById('liveperfil').innerHTML="";
  document.getElementById("liveperfil").style.border="0px";
}

function ponerValor(str){
  document.getElementById('pantalla').value=str.id;
  document.getElementById('nombre').value=str.nombre;
  document.getElementById('desc').value=str.desc;
  document.getElementById('area').value=str.area;
  document.getElementById('url').value=str.url;
  
  document.getElementById('livesearch').innerHTML="";
  document.getElementById("livesearch").style.border="0px";
}

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

function showResult(str)
{
 
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
xmlhttp.open("POST","../Clases/Ajax/selectpantalla_id.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("pantalla="+str);  
}
}

function showResultPerfil(str)
{
 
if(str.length==0)
{
	document.getElementById('liveperfil').innerHTML="";
  document.getElementById("liveperfil").style.border="0px";
}
else
{
xmlhttp=objetoAjax();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("liveperfil").innerHTML=xmlhttp.responseText;
    document.getElementById("liveperfil").style.border="1px solid #A5ACB2";
    }
  }
xmlhttp.open("POST","../Clases/Ajax/selectperfil_id.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("perfil="+str);  
}
}


function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function borrarIngresado (index){
			
			for(xx=($('#pantallas >tbody >tr').length)-1;xx>-1;xx--){
				
				console.log('En pila y en posicion:'+xx+'valor:'+$('#pantallas >tbody >tr').eq(xx).find("td").eq(1).html()+' y el valor enviado:'+index);
				if(index==$('#pantallas >tbody >tr').eq(xx).find("td").eq(1).html())
				{
					console.log('En pila y en posicion:'+xx+' a borrar:'+$('#pantallas >tbody >tr').eq(xx).find("td").eq(1).html());
					$('#pantallas >tbody >tr').eq(xx).remove();
				}
				
			}
			//alert("salió del for");
  }	
  
  function esNumero(valor){
	  console.log('entra a verificar si es numero'+valor);
	  var charpos = valor.search("[^0-9]"); 
	if(valor.length > 0 &&  charpos >= 0) 
	{ console.log('No es numero');
	  return false;
	  
	}
	return true;
  }	

  $(function() {
	  var pantalla = $( "#pantalla" ),
		nombre=$("#nombre"),
		desc=$("#desc"),
		area=$("#area"),
		url=$("#url"),
      	allFields = $( [] ).add( pantalla ).add( nombre ).add( desc ).add( area ).add( url );
		
		 
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 350,
      width: 350,
      modal: true,
      buttons: {
        "Agregar Pantalla": function() {
			
          
		    $( "#pantallas tbody" ).append( "<tr>" +
			  "<td><input type='checkbox'></td>" +
              "<td>" + pantalla.val()+ "</td>" +
              "<td>" + nombre.val() + "</td>" +
			  "<td>" + desc.val() + "</td>" +
              "<td>" + area.val() + "</td>" +
			  "<td>" + url.val() + "</td>" +
            "</tr>" );
            $( this ).dialog( "close" );
          
        },
        "Cancelar": function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 	
	
    $( "#crear-pantalla" )
      .button()
      .click(function() {
		$('#pantalla').each(function(){
				this.value = $(this).attr('title');
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
	$("#borrar-pantalla" )
      .button()
      .click(function() {
		for(x=($('#pantallas >tbody >tr').length)-1;x>-1;x--){
		
			var isChecked = $("#pantallas >tbody >tr input:checkbox")[x].checked;
			
			   if(isChecked)
			   {
				 $('#pantallas >tbody >tr').eq(x).remove();
			   }
		}
      });
	  $("#continuar-pantalla" )
      .button()
      .click(function() {
		var toDelete = new Array;
		var msgError;
		var hilo;
		var contador_array=0;
			//$('#insumos >tbody >tr').eq(x).;

		$('#pantallas >tbody >tr').each(function() {
					 var arr={pantalla: $(this).find("td").eq(1).html(), perfil:$("#perfil").val()};
		//guardarInsumo(JSON.stringify(arr));
		hilo=$.post(
				 '../Clases/Ajax/add_perfil_pantalla.php',
				 JSON.stringify(arr),
				 function(msg) {
					
					var message=$.trim(msg);
					if (message!="OK") {
						if(typeof msgError === "undefined")
						msgError=msg;
						else
            			msgError=msgError+"\n"+msg;
						console.log('a borrar:'+msgError);
						console.log('Ya tiene mensaje de error');
        			}

					else
					{
						toDelete[contador_array]=msg;
						console.log('a borrar:'+contador_array+'valor:'+toDelete[contador_array]);
						contador_array++;
					}
					
				}
		);	
						
		});
		console.log("va a checar  a eliminar");
		hilo.done(function(){
		 if(toDelete.length>0){	 
			 for(x=0;x<toDelete.length;x++)
			 {
				 console.log('Ya en array: a borrar:'+x+'valor:'+toDelete[x]);
				 borrarIngresado (toDelete[x]);
			 }
			 if(!(typeof msgError === "undefined")&&msgError.length>0)
			    $("#status_regis").html("Completado con Errores:"+msgError);
			    
			 else
			    $("#status_regis").html("Registro Completo");
		 }
		 else
		 	$("#status_regis").html(msgError);
		});
		//a borrar y mostrar mensaje de error
		
      });
	  //$( "#fecha" ).datepicker();
  });
// JavaScript Document