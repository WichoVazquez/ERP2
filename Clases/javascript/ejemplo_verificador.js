// JavaScript Document
function verificarUsuario(formulario) { 


if(!(formulario.nombre_u.value.length>0))
{
	alert("Introduzca Nombre");
	formulario.nombre_u.focus();
	return (false);
}

if(!validateAlphaspace(formulario.nombre_u.value))
{
	formulario.nombre_u.focus();
	return (false);
}
if(!(formulario.ap_pat_u.value.length>0))
{
	alert("Introduzca Apellido Paterno");
	formulario.ap_pat_u.focus();
	return (false);
}

if(!validateAlphaspace(formulario.ap_pat_u.value))
{
	formulario.ap_pat_u.focus();
	return false;
}

if(!(formulario.ap_mat_u.value.length>0))
{
	alert("Introduzca Apellido Materno");
	formulario.ap_mat_u.focus();
	return (false);
}

if(!validateAlphaspace(formulario.ap_mat_u.value))
{
	formulario.ap_mat_u.focus();
	return false;
}

if(!(formulario.nick_u.value.length>0))
{
	alert("Introduzca Usuario");
	formulario.nick_u.focus();
	return false;
}

if(!(formulario.pwd_u.value.length>0))
{
	alert("Introduzca Contraseña");
	formulario.pwd_u.focus();
	return false;
}

if(!(formulario.c_pwd_u.value.length>0))
{
	alert("Introduzca Confirmación Contraseña");
	formulario.c_pwd_u.focus();
	return false;
}
	
if(!(formulario.pwd_u.value.length>5))
{
	alert("Las Contraseñas deben contener al menos 6 caracteres");
	formulario.pwd_u.focus();
	return false;	
}

	
if(!(formulario.c_pwd_u.value.length>5))
{
	alert("Las Contraseñas deben contener al menos 6 caracteres");
	formulario.c_pwd_u.focus();
	return false;	
}

<!--e mail-->



if(!validatePasswords(formulario.pwd_u.value, formulario.c_pwd_u.value))
{
	formulario.pwd_u.focus();
	formulario.pwd_u.select();
	return false;
}

if(!(formulario.mail_u.value.length>0))
{
	alert("Introduzca Correo");
	formulario.mail_u.focus();
	return (false);
}

if(!validateMail(formulario.mail_u.value)){
	 alert("Introduzca un correo válido");
	 formulario.mail_u.focus();
	 return false;
 }
<!---->

return true;
}


function verificarTransportista(formulario) { 

if(!(formulario.clave_t.value.length>0))
{
	alert("Introduzca Clave");
	formulario.clave_t.focus();
	return (false);
}

if(!(formulario.rs_t.value.length>0))
{
	alert("Introduzca Razón Social");
	formulario.rs_t.focus();
	return (false);
}

<!---->

return true;
}

function verificarOrigen(formulario) { 

if(!(formulario.clave_o.value.length>0))
{
	alert("Introduzca Clave");
	formulario.clave_o.focus();
	return (false);
}

if(!(formulario.cantidad_o.value.length>0))
{
	alert("Introduzca Cantidad");
	formulario.cantidad_o.focus();
	return (false);
}else
{
	var charpos = formulario.cantidad_o.search("[0-9]"); 
	if(password1.length > 0 &&  charpos >= 0) 
	{ 
		strError = "Cantidad: Sólo se permiten números"; 
	  alert(strError + "\n [Error en la posición " + eval(charpos+1)+"]");
	  return false;
	}
}
<!---->

return true;
}


function validateMail(email){
	// a very simple email validation checking. 
// you can add more complex email checking if it helps 
    if(email.length <= 0)
	{
	  return true;
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

function validatePasswords(password1, password2){
	// a very simple email validation checking. 
// you can add more complex email checking if it helps 
    var charpos = password1.search("[^A-Za-z0-9]"); 
	if(password1.length > 0 &&  charpos >= 0) 
	{ 
		strError = "Contraseña: Caracteres permitidos A-Z,a-z,0-9"; 
	  alert(strError + "\n [Error en la posición " + eval(charpos+1)+"]");
	  return false;
	}
	
	if(password1!=password2){
		alert("No coinciden contraseñas");
		return false;
	}
	return true;
}

function checkPasswords(formulario){
	// a very simple email validation checking. 
// you can add more complex email checking if it helps 
	if(!(formulario.n_pwd_u.value.length>0))
	{
		alert("Introduzca Contraseña Actual");
		formulario.n_pwd_u.focus();
		return false;	
	}
	
	if(!(formulario.pwd_u.value.length>0))
	{
		alert("Introduzca Nueva Contraseña");
		formulario.pwd_u.focus();
		return false;	
	}
	
	if(!(formulario.c_pwd_u.value.length>0))
	{
		alert("Introduzca Confirmacion Contraseña");
		formulario.c_pwd_u.focus();
		return false;	
	}
	
	if(!(formulario.n_pwd_u.value.length>5))
	{
		alert("Las Contraseñas deben contener al menos 6 caracteres");
		formulario.n_pwd_u.focus();
		return false;	
	}
	
	if(!(formulario.pwd_u.value.length>5))
	{
		alert("Las Contraseñas deben contener al menos 6 caracteres");
		formulario.pwd_u.focus();
		return false;	
	}
	
	if(!(formulario.c_pwd_u.value.length>5))
	{
		alert("Las Contraseñas deben contener al menos 6 caracteres");
		formulario.c_pwd_u.focus();
		return false;	
	}
	
	if(!validatePasswords(formulario.pwd_u.value, formulario.c_pwd_u.value))
	{
		formulario.pwd_u.focus();
		formulario.pwd_u.select();
		return false;
	}

	return true;   
}

function validateAlphaspace(objValue){
	objValue=trim(objValue);
	
	var charpos = objValue.search("[^A-Za-z/^\s*|\s*$/g]"); 
	  if(objValue.length > 0 &&  charpos >= 0) 
	  { 
		  
		  strError = "Solo se permiten caracteres alfabeticos ";                            
		alert(strError + "\n [Error en la posición: " + eval(charpos+1)+"]"); 
		return false; 
	  }
	return true;		  
}

function trim (myString)
{
	
	return myString.replace(" ","");
}

