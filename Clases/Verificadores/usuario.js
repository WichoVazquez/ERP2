
var errorUsuario=false;
var errorMail=false;
var errorPWD=false;

function verificarUsuario(valor)
{
	if($("#nick").val().length>4&&$("#email").val().length>0&&$("#pwd").val().length>0&&$("#c_pwd").val().length>0)
	{
		if(!errorUsuario&&!errorMail&&!errorPWD)
		{
			
			return true;
		}
		else
		{
			$("#mensaje").html("*Verifique los campos");
			$("#mensaje").css( "color", "#FF3366" );
			return false;
		}
	}
	else
	{
		$("#mensaje").html("*Verifique los campos");
			$("#mensaje").css( "color", "#FF3366" );
		return false;
	}
}
function usuario_repetido(usuario){
	usuario=$("#nick").val();
	if(usuario.length>4)
	{
			hilo=$.post(
				 '../Clases/Ajax/checkusuario.php',
				 JSON.stringify({"user": usuario }),
				 function(msg) {
					 var message=$.trim(msg);
					 if(message=="duplicado")
					 {
						 //console.log("duplicado:"+msg);
						 $("#nick").css( "background-color", "#FF3366" );
						 $("#mensaje").html("*Nombre de Usuario ya esta asignado");
						 $("#mensaje").css( "color", "#FF3366" );
						 errorUsuario=true;
					 }
					 else
				 	 {   
					 	 //console.log("No duplicado"+msg);
						$("#nick").css( "background-color", "#33CC99" );
						$("#mensaje").html("");
						errorUsuario=false;
						//$("#mensaje").css( "background-color", "#FFF" );
					 }
				}
		);
	}else
		errorUsuario=true;
		
}

function mail_repetido(mail){
	mail=$("#email").val();
	
	if(validateMail(mail))
	{
			hilo=$.post(
				 '../Clases/Ajax/checkmail.php',
				 JSON.stringify({"mail": mail }),
				 function(msg) {
					 var message=$.trim(msg);
					 if(message=="duplicado")
					 {
						 $("#email").css( "background-color", "#FF3366" );
						 $("#mensaje").html("*Correo Electronico ya esta asignado a un Usuario");
						 $("#mensaje").css( "color", "#FF3366" );
						 errorMail=true;	
					 }
					 else
				 	 {   
						$("#email").css( "background-color", "#FFF" );
						$("#mensaje").html("");
						$("#mensaje").css( "color", "#FFF" );
						errorMail=false;	
					 }
				}
		);
		
	}else
		errorMail=true;	
		
}

function validateMail(email){
    if(email.length <= 0)
	{
	  return false;
	}
    var splitted = email.match("^(.+)@(.+)$");
    if(splitted == null) return false;
    if(splitted[1] != null )
    {
      var regexp_user=/^[\w-_\.]*?$/;
      if(splitted[1].match(regexp_user) == null) return false;
    }
    if(splitted[2] != null)
    {
      var regexp_domain=/^[\w-\.]*\.[A-Za-z]{2,4}$/;
      if(splitted[2].match(regexp_domain) == null) 
      {
	    var regexp_ip =/^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
	    if(splitted[2].match(regexp_ip) == null) return false;
      }// if
      return true;
    }
return false;
}

function validatePasswords(valor){
	var password1=$("#pwd").val();
	var password2=$("#c_pwd").val();
    var charpos = password1.search("[^A-Za-z0-9]"); 
	if(password1.length<6)
	{
		$("#pwd").css( "background-color", "#FF3366" );
	  	$("#mensaje").html("*Introduzca Contraseña");
	  	$("#mensaje").css( "color", "#FF3366" );
		console.log("no ha introducido contraseña");
	  	errorPWD=true;
	} else
	if(password1.length > 0 &&  charpos >= 0) 
	{  
	  $("#pwd").css( "background-color", "#FF3366" );
	  $("#mensaje").html("*Contraseña No Válida: Caracteres permitidos A-Z,a-z,0-9");
	  $("#mensaje").css( "color", "#FF3366" );
	  console.log("Contraseña No Valida");
	  errorPWD=true;
	}
	else
	if(password1!=password2){
		$("#c_pwd").css( "background-color", "#FF3366" );
		$("#mensaje").html("*No coinciden contraseñas");
	  	$("#mensaje").css( "color", "#FF3366" );
		errorPWD=true;
	}
	else
	{
		$("#pwd").css( "background-color", "#FFF" );
		$("#c_pwd").css( "background-color", "#FFF" );
		$("#mensaje").html("");
		$("#mensaje").css( "color", "#FFF" );
		errorPWD=false;
	}
	//return true;
}

