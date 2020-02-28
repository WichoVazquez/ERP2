var errorRFC=true;
var errorRS=true;
var errorClave=true;
var errorAlmacen=true;
var errorMaterial=true;
var errorMoneda=true;
var errorTransporte=true;
var errorPlacas=true;


function NumEntero(e) {
var key;

	if(window.event) // IE
	{
	key = e.keyCode;
	}
	else if(e.which) // Netscape/Firefox/Opera
	{
	key = e.which;
	}

		
	if ((key < 48 || key > 57))
    {
    	if( (key == 8 )) // Detectar  backspace (retroceso)
        	{ return true; }
	    else 
    	    { 
			return false; }
    }
	
	return true;
	

}

function NumDecimal(e, field) {
	
   key = e.keyCode ? e.keyCode : e.which
  // backspace
  if (key == 8) return true
  // 0-9
  if (key > 47 && key < 58) {
    if (field.value == "") return true
    regexp = /.[0-9]{2}$/
    return !(regexp.test(field.value))
  }
  // .
  if (key == 46) {
    if (field.value == "") return false
    regexp = /^[0-9]+$/
    return regexp.test(field.value)
  }
  // other key
  return false

}


function validarEmail( email ) {

    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	
    if ( !expr.test(email) && email.length > 0 ){
		$("#email").css( "border-color", "#FF0000" );
		$("#error").html("El correo electronico no es valido.");
		return false;
	}else
	{
		$("#email").css( "border-color", "#CCCCCC" );
		$("#error").html("");	
		return true;
	}        
}

/******************* validaciones de Proveedor ***************************/


function validarRSProveedor(rs)
{
	//rs=$("#rs").val();
	
	if(rs.length> 0) 
	{
			hilo=$.post(
				 '../Clases/Ajax/checkProveedor.php',
				 JSON.stringify({"rs": rs ,"validacion":"rs"}),
				 function(msg) {
					 var message=$.trim(msg);
					 if(message=="duplicado")
					 {
						 $("#rs").css( "border-color", "#FF0000" );
						 $("#error").html("Ya existe la Razon Social, verifique.");
						
						 errorRS=true;
					 }
					 else
				 	 {   
						 $("#rs").css( "border-color", "#CCCCCC" );
						$("#error").html("");
						errorRS=false;
					 }
				}
		);
	}else{
			 $("#rs").css( "border-color", "#CCCCCC" );
			$("#error").html("");
		errorRS=false;
	}
}
function validarRFCProveedor(rfc)
{
//	rfc=$("#rfc").val();
	
	if(rfc.length> 0) 
	{
			hilo=$.post(
				 '../Clases/Ajax/checkProveedor.php',
				 JSON.stringify({"rfc": rfc ,"validacion":"rfc"}),
				 function(msg) {
					 var message=$.trim(msg);
					 if(message=="duplicado")
					 {
						 $("#rfc").css( "border-color", "#FF0000" );
						 $("#error").html("Ya esta dado de alta el RFC, verifique.");
						
						 errorRFC=true;
					 }
					 else
				 	 {   
						 $("#rfc").css("border-color", "#CCCCCC" );
						$("#error").html("");
						errorRFC=false;
					 }
				}
		);
	}else{
		 $("#rfc").css( "border-color", "#CCCCCC" );
		$("#error").html("");
		errorRFC=false;
	}
}

function validarDatosProveedor(nuevo)
{
		
	if (nuevo){
		if(!errorRS){
			$("#rs").css("border-color", "#CCCCCC" );
			if(!errorRFC){
				$("#rfc").css("border-color", "#CCCCCC" );
			}else{
				$("#error").html("El RFC es incorrecto.");
				$("#rfc").css("border-color", "#FF0000" );
				return false;
			}
		}else{
			$("#error").html("La Razon Social es incorrecta.");
			$("#rs").css("border-color", "#FF0000" );
			return false;
		}
	}
	
	
	return validarEmail($("#email").val());

	
	
}

/**************************** validacion Cliente ************************************/

function validarRSCliente(rs)
{
//	rs=$("#razonsocial").val();
	
	if(rs.length> 0) 
	{
			hilo=$.post(
				 '../Clases/Ajax/checkcliente.php',
				 JSON.stringify({"rs": rs ,"validacion":"rs"}),
				 function(msg) {
					 var message=$.trim(msg);
					 if(message=="duplicado")
					 {
						 $("#rs").css("border-color", "#FF0000" );;
						 $("#error").html("Ya existe la Razon Social, verifique.");
						
						 errorRS=true;
					 }
					 else
				 	 {   
						$("#rs").css("border-color", "#CCCCCC" );
						$("#error").html("");
						errorRS=false;
					 }
				}
		);
	}else{
		$("#rs").css("border-color", "#CCCCCC" );
		$("#error").html("");
		errorRS=false;
	}
}
function validarRFCCliente(rfc)
{
	//rfc=$("#rfc").val();
	
	if(rfc.length> 0) 
	{
			hilo=$.post(
				 '../Clases/Ajax/checkcliente.php',
				 JSON.stringify({"rfc": rfc ,"validacion":"rfc"}),
				 function(msg) {
					 var message=$.trim(msg);
					 if(message=="duplicado")
					 {
						 $("#rfc").css("border-color", "#FF0000" );
						 $("#error").html("Ya esta dado de alta el RFC, verifique.");
						
						 errorRFC=true;
					 }
					 else
				 	 {   
						$("#rfc").css("border-color", "#CCCCCC" );
						$("#error").html("");
						errorRFC=false;
					 }
				}
		);
	}else{
		$("#rfc").css("border-color", "#CCCCCC" );
		$("#error").html("");
		errorRFC=false;
	}
}

function validarClaveCliente(clave)
{
	//rfc=$("#rfc").val();
	
	if(clave.length> 0) 
	{
			hilo=$.post(
				 '../Clases/Ajax/checkcliente.php',
				 JSON.stringify({"clave": clave ,"validacion":"clave"}),
				 function(msg) {
					 var message=$.trim(msg);
					 if(message=="duplicado")
					 {
						 $("#clave").css("border-color", "#FF0000" );
						 $("#error").html("La clave de cliente ya esta dada de alta, verifique.");
						
						 errorClave=true;
					 }
					 else
				 	 {   
						$("#clave").css("border-color", "#CCCCCC" );
						$("#error").html("");
						errorClave=false;
					 }
				}
		);
	}else{
		$("#clave").css("border-color", "#CCCCCC" );
		$("#error").html("");
		errorClave=false;
	}
}

function validarDatosCliente(nuevo)
{
		
	if (nuevo){
		
		if(!errorRS){
			$("#rs").css("border-color", "#CCCCCC" );
			if(!errorRFC){
				$("#rfc").css("border-color", "#CCCCCC" );
				if(!errorClave){
				$("#clave").css("border-color", "#CCCCCC" );			
				
				}else{
					$("#error").html("La clave de cliente ya esta dada de alta, verifique.");
					$("#clave").css("border-color", "#FF0000" );
					return false;
				}
				
			}else{
				$("#error").html("Ya esta dado de alta el RFC, verifique.");
				$("#rfc").css("border-color", "#FF0000" );
				return false;
			}
		}else{
			$("#error").html("Ya existe la Razon Social, verifique.");
			$("#rs").css("border-color", "#FF0000" );
			return false;
		}
	}
	
}

/**************************** validacion Almacen ************************************/

function validarNombreAlmacen(nombre)
{
//	rs=$("#razonsocial").val();
	
	if(nombre.length> 0) 
	{
			hilo=$.post(
				 '../Clases/Ajax/checkAlmacen.php',
				 JSON.stringify({"nombre": nombre ,"validacion":"nombre"}),
				 function(msg) {
					 var message=$.trim(msg);
					 if(message=="duplicado")
					 {
						 $("#nombre").css("border-color", "#FF0000" );;
						 $("#error").html("Ya esta registrado el Almacen, verifique.");
						
						 errorAlmacen=true;
					 }
					 else
				 	 {   
						$("#nombre").css("border-color", "#CCCCCC" );
						$("#error").html("");
						errorAlmacen=false;
					 }
				}
		);
	}else{
		$("#nombre").css("border-color", "#CCCCCC" );
		$("#error").html("");
		errorAlmacen=false;
	}
}

function validarDatosAlmacen(nuevo)
{
		
	if (nuevo){
		

		if(!errorAlmacen){
		$("#nombre").css("border-color", "#CCCCCC" );	
			
		
		}else{
			$("#error").html("Ya esta registrado el Almacen, verifique.");
			$("#nombre").css("border-color", "#FF0000" );
			return false;
		}
				
			
	}
	
}


/**************************** validacion Material ************************************/

function validarMaterial(material)
{
//	rs=$("#razonsocial").val();
	
	
		if(material.length> 0) 
		{
				hilo=$.post(
					 '../Clases/Ajax/checkMaterial.php',
					 JSON.stringify({"material": material ,"validacion":"material"}),
					 function(msg) {
						
						 var message=$.trim(msg);
						// alert(message);
					
						 if(message=="duplicado")
						 {
							 $("#descripcion").css("border-color", "#FF0000" );;
							 $("#error").html("Ya esta registrada la descripcion del material, verifique.");
							
							 errorMaterial=true;
						 }
						 else
						 {   
							$("#descripcion").css("border-color", "#CCCCCC" );
							$("#error").html("");
							errorMaterial=false;
						 }
					}
			);
		}else{
			$("#descripcion").css("border-color", "#CCCCCC" );
			$("#error").html("");
			errorMaterial=false;
		}
	
}


function validarMaterialSae(material)
{
//	rs=$("#razonsocial").val();
	
	
		if(material.length> 0) 
		{
				hilo=$.post(
					 '../Clases/Ajax/checkMaterial.php',
					 JSON.stringify({"material": material ,"validacion":"materialSae"}),
					 function(msg) {
						
						 var message=$.trim(msg);
						// alert(message);
					
						 if(message=="duplicado")
						 {
							 $("#idsae").css("border-color", "#FF0000" );;
							 $("#error").html("Ya esta registrado el id SAE, verifique.");
							
							 errorMaterial=true;
						 }
						 else
						 {   
							$("#idsae").css("border-color", "#CCCCCC" );
							$("#error").html("");
							errorMaterial=false;
						 }
					}
			);
		}else{
			$("#idsae").css("border-color", "#CCCCCC" );
			$("#error").html("");
			errorMaterial=false;
		}
	
}

function validarMaterialEditado(material, id)
{
//	rs=$("#razonsocial").val();
	
	if(material.length> 0) 
	{
			hilo=$.post(
				 '../Clases/Ajax/checkMaterial.php',
				 JSON.stringify({"material": material ,"validacion":"materialeditado"}),
				 function(msg) {
					
					 var message=$.trim(msg);
					// alert(message);
				
					 if(message=="duplicado")
					 {
						 $("#descripcion").css("border-color", "#FF0000" );;
						 $("#error").html("Ya esta registrada la descripcion del material, verifique.");
						
						 errorMaterial=true;
					 }
					 else
				 	 {   
						$("#descripcion").css("border-color", "#CCCCCC" );
						$("#error").html("");
						errorMaterial=false;
					 }
				}
		);
	}else{
		$("#descripcion").css("border-color", "#CCCCCC" );
		$("#error").html("");
		errorMaterial=false;
	}
}


function validarDatosMaterial(nuevo)
{
		
			
			if(!errorMaterial){
			$("#material").css("border-color", "#CCCCCC" );	
				
			
			}else{
				$("#error").html("Ya esta registrada la descripcion del material, verifique.");
				$("#material").css("border-color", "#FF0000" );
				return false;
			}	
		
	
}

function habilitarGuardar()
{
	alert ('guardartrue');
	guardar=true;
}

/**************************** validacion Empresa ************************************/

function validarRSEmpresa(rs)
{
//	rs=$("#razonsocial").val();
	
	if(rs.length> 0) 
	{
			hilo=$.post(
				 '../Clases/Ajax/checkEmpresa.php',
				 JSON.stringify({"rs": rs ,"validacion":"rs"}),
				 function(msg) {
					 var message=$.trim(msg);
					 if(message=="duplicado")
					 {
						 $("#rs").css("border-color", "#FF0000" );;
						 $("#error").html("Ya existe la Empresa, verifique.");
						
						 errorRS=true;
					 }
					 else
				 	 {   
						$("#rs").css("border-color", "#CCCCCC" );
						$("#error").html("");
						errorRS=false;
					 }
				}
		);
	}else{
		$("#rs").css("border-color", "#CCCCCC" );
		$("#error").html("");
		errorRS=false;
	}
}
function validarRFCEmpresa(rfc)
{
	//rfc=$("#rfc").val();
	
	if(rfc.length> 0) 
	{
			hilo=$.post(
				 '../Clases/Ajax/checkEmpresa.php',
				 JSON.stringify({"rfc": rfc ,"validacion":"rfc"}),
				 function(msg) {
					 var message=$.trim(msg);
					 if(message=="duplicado")
					 {
						 $("#rfc").css("border-color", "#FF0000" );
						 $("#error").html("Ya esta dado de alta el RFC, verifique.");
						
						 errorRFC=true;
					 }
					 else
				 	 {   
						$("#rfc").css("border-color", "#CCCCCC" );
						$("#error").html("");
						errorRFC=false;
					 }
				}
		);
	}else{
		$("#rfc").css("border-color", "#CCCCCC" );
		$("#error").html("");
		errorRFC=false;
	}
}

function validarDatosEmpresa(nuevo)
{
		
	if (nuevo){
		
		if(!errorRS){
			$("#rs").css("border-color", "#CCCCCC" );
			if(!errorRFC){
				$("#rfc").css("border-color", "#CCCCCC" );
				
			}else{
				$("#error").html("Ya esta dado de alta el RFC, verifique.");
				$("#rfc").css("border-color", "#FF0000" );
				return false;
			}
		}else{
			$("#error").html("Ya existe la Razon Social, verifique.");
			$("#rs").css("border-color", "#FF0000" );
			return false;
		}
	}
	
}

/**************************** validacion Moneda ************************************/

function validarDescripcionMoneda(descripcion)
{
//	rs=$("#razonsocial").val();
	
	if(descripcion.length> 0) 
	{
			hilo=$.post(
				 '../Clases/Ajax/checkMoneda.php',
				 JSON.stringify({"descripcion": descripcion ,"validacion":"descripcion"}),
				 function(msg) {
					 var message=$.trim(msg);
					 if(message=="duplicado")
					 {
						 $("#desc").css("border-color", "#FF0000" );;
						 $("#error").html("Ya esta registrado el tipo de moneda, verifique.");
						
						 errorMoneda=true;
					 }
					 else
				 	 {   
						$("#desc").css("border-color", "#CCCCCC" );
						$("#error").html("");
						errorMoneda=false;
					 }
				}
		);
	}else{
		$("#desc").css("border-color", "#CCCCCC" );
		$("#error").html("");
		errorMoneda=false;
	}
}

function validarDatosMoneda(nuevo)
{
		
	if (nuevo){
		

		if(!errorMoneda){
		$("#desc").css("border-color", "#CCCCCC" );	
			
		
		}else{
			$("#error").html("Ya esta registrado el tipo de moneda, verifique.");
			$("#desc").css("border-color", "#FF0000" );
			return false;
		}
				
			
	}
	
}
/**************************** validacion Transporte ************************************/

function validarPlacas(placas)
{
//	rs=$("#razonsocial").val();
	
	if(placas.length> 0) 
	{
			hilo=$.post(
				 '../Clases/Ajax/checkTransporte.php',
				 JSON.stringify({"placas": placas ,"validacion":"placas"}),
				 function(msg) {
					 var message=$.trim(msg);
					 if(message=="duplicado")
					 {
						 $("#placas").css("border-color", "#FF0000" );;
						 $("#error").html("Ya estan registradas las placas, verifique.");
						
						 errorPlacas=true;
					 }
					 else
				 	 {   
						$("#placas").css("border-color", "#CCCCCC" );
						$("#error").html("");
						errorPlacas=false;
					 }
				}
		);
	}else{
		$("#placas").css("border-color", "#CCCCCC" );
		$("#error").html("");
		errorPlacas=false;
	}
}

function validarDatosTransporte(nuevo)
{
		
	if (nuevo){
		

		if(!errorPlacas){
		$("#placas").css("border-color", "#CCCCCC" );	
			
		
		}else{
			$("#error").html("Ya estan registradas las placas, verifique.");
			$("#placas").css("border-color", "#FF0000" );
			return false;
		}
				
			
	}
	
}

function validarClaveContrato(clave)
{
	//rfc=$("#rfc").val();
	
	if(clave.length> 0) 
	{
			hilo=$.post(
				 '../Clases/Ajax/checkContrato.php',
				 JSON.stringify({"clave": clave ,"validacion":"clave"}),
				 function(msg) {
					 var message=$.trim(msg);
					 if(message=="duplicado")
					 {
						 $("#clave").css("border-color", "#FF0000" );
						 $("#error").html("La clave de contrato ya esta dada de alta, verifique.");
						
						 errorClave=true;
					 }
					 else
				 	 {   
						$("#clave").css("border-color", "#CCCCCC" );
						$("#error").html("");
						errorClave=false;
					 }
				}
		);
	}else{
		$("#clave").css("border-color", "#CCCCCC" );
		$("#error").html("");
		errorClave=false;
	}
}

