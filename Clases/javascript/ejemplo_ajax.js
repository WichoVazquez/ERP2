// JavaScript Document
$().ready(function() {

if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	/*document.getElementById("menubar").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";  
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				if(xmlhttp.responseText != "" && xmlhttp.responseText.substring(0, 9) != "redirect:"){
					
					document.getElementById("menubar").innerHTML=xmlhttp.responseText;
				}
				else if (xmlhttp.responseText.substring(0, 9) == "redirect:" && xmlhttp.responseText != "") {
                    window.location = xmlhttp.responseText.substr(9);
                }
				
			}
	  }
	xmlhttp.open("GET","menuadmin.php",true);
	xmlhttp.send();*/
	
});

function SearchUser()
{
	var bus=document.getElementById("nick").value;  
	if (bus.length==0)
	  { 
	  document.getElementById("sentencias").innerHTML="El resultado se mostrara aqui";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	document.getElementById("sentencias").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";  
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","searchuser.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus);
	//xmlhttp.send();
}

function openSearchEntrega()
{
	var bus=document.getElementById("search").value;  
	var filter=document.getElementById("type").value;
	var period=document.getElementById("typeperiod").value;
	var extra="";
	switch(period)
	{
		case "1": extra="&extra="+document.getElementById("periodomes").value+"-"+document.getElementById("periodoyear").value;break;
		case "2": extra="&extra="+document.getElementById("date_p").value+"&extra2="+document.getElementById("date_p2").value;break;s 
		default:break;
	}
	document.getElementById("sentencias").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";
	if (bus.length==0)
	  {
		  //$("#sentencias").css(background-color:"#DBE9FF").show(); 
		  document.getElementById("sentencias").innerHTML="El resultado se mostrara aqui";
		  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	document.getElementById("sentencias").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";  
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","searchentrega.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus+"&filter="+filter+extra);
	//xmlhttp.send();
}

function openSearchTrans()
{
	
	var bus=document.getElementById("search").value;  
	if (bus.length==0)
	  { 
	  document.getElementById("sentencias").innerHTML="El resultado se mostrara aqui";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");	
	  }
	document.getElementById("sentencias").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";  
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","searchtrans.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus);
	//xmlhttp.send();
}

function openSearchComp()
{
	var bus=document.getElementById("search").value;  
	if (bus.length==0)
	  { 
	  document.getElementById("sentencias").innerHTML="El resultado se mostrara aqui";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	document.getElementById("sentencias").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";  
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","searchcomp.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus);
	//xmlhttp.send();
}


function openSelectComp()
{
	var bus=document.getElementById("search").value;  
	if (bus.length==0)
	  { 
	  document.getElementById("resultado").innerHTML="El resultado se mostrara aqui";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	document.getElementById("resultado").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";  
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("resultado").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","selectcomp.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus);
	//xmlhttp.send();
}

function openSearchOrigen()
{
	var bus=document.getElementById("search").value;  
	if (bus.length==0)
	  { 
	  document.getElementById("sentencias").innerHTML="El resultado se mostrara aqui";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	document.getElementById("sentencias").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";  
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","searchorigen.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus);
	//xmlhttp.send();
}

function openSearchOrder()
{
	var bus=document.getElementById("search").value;  
	if (bus.length==0)
	  { 
	  document.getElementById("sentencias").innerHTML="El resultado se mostrara aqui";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	document.getElementById("sentencias").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>"; 
	xmlhttp.onreadystatechange=function()
	  {
		  
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("sentencias").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","searchorden.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus);
	//xmlhttp.send();
}

function openSearchEntrada()
{
	var bus=document.getElementById("search").value;  
	if (bus.length==0)
	  {
		   
	  document.getElementById("sentencias").innerHTML="El resultado se mostrara aqui";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	document.getElementById("sentencias").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","searchentrada.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus);
	//xmlhttp.send();
}

function openSearchSalida()
{
	var bus=document.getElementById("search").value;  
	if (bus.length==0)
	  { 
	  document.getElementById("sentencias").innerHTML="El resultado se mostrara aqui";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	document.getElementById("sentencias").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","searchsalida.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus);
	//xmlhttp.send();
}

function openSearchDestination()
{
	var bus=document.getElementById("search").value;  
	if (bus.length==0)
	  { 
	  document.getElementById("sentencias").innerHTML="El resultado se mostrara aqui";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	document.getElementById("sentencias").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("sentencias").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","searchdestiny.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus);
	//xmlhttp.send();
}

function openSelectOrigen()
{
	var bus=document.getElementById("searchorigen").value;  
	if (bus.length==0)
	  { 
	  document.getElementById("resultadoorigen").innerHTML="El resultado se mostrara aqui";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	document.getElementById("resultadoorigen").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("resultadoorigen").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","selectorigen.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus);
	//xmlhttp.send();
}

function openSelectDestiny()
{
	var bus=document.getElementById("searchdestiny").value;  
	if (bus.length==0)
	  { 
	  document.getElementById("resultadodestino").innerHTML="El resultado se mostrara aqui";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	document.getElementById("resultadodestino").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("resultadodestino").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","selectdestiny.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus);
	//xmlhttp.send();
}

function openSelectOrden()
{
	var bus=document.getElementById("searchorden").value;
	var quan=document.getElementById("cantidad_en").value;
	var charpos = quan.search("[^0-9]"); 
	if(quan.length > 0 &&  charpos >= 0) 
	{ 
		quan="";
	}  
	if (bus.length==0)
	  { 
	  document.getElementById("resultadoorden").innerHTML="El resultado se mostrará aqui";
	  return;
	  }
	if (quan.length==0)
	  { 
	  document.getElementById("resultadoorden").innerHTML="Introduzca Cantidad Válida en Campo \"Cantidad\"!!";
	  return;
	  }  
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	document.getElementById("resultadoorden").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";  
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("resultadoorden").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","selectorden.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus+"&quan="+quan);
	//xmlhttp.send("search="+bus);
	//xmlhttp.send();
}

function openSelectOrigenbyOrder()
{
	var bus=document.getElementById("searchorigen").value;
	var quan=document.getElementById("cantidad_en").value;
	var charpos = quan.search("[^0-9]"); 
	if(quan.length > 0 &&  charpos >= 0) 
	{ 
		quan="";
	}  
	if (bus.length==0)
	  { 
	  document.getElementById("resultadoorigen").innerHTML="El resultado se mostrará aqui";
	  return;
	  }
	if (quan.length==0)
	  { 
	  document.getElementById("resultadoorigen").innerHTML="Introduzca Cantidad Válida en Campo \"Cantidad\"!!";
	  return;
	  }  
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	document.getElementById("resultadoorigen").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("resultadoorigen").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","selectorigenbyquan.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus+"&quan="+quan);
	//xmlhttp.send("search="+bus);
	//xmlhttp.send();
}


function openSelectTrans()
{
	var bus=document.getElementById("search").value;  
	if (bus.length==0)
	  { 
	  document.getElementById("resultadotrans").innerHTML="El resultado se mostrara aqui";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	document.getElementById("resultadotrans").innerHTML="<img id=\"progress\" src=\"images/ajax-loader.gif\"/>";
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("resultadotrans").innerHTML=xmlhttp.responseText;
			}
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","selecttrans.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+bus);
	//xmlhttp.send();
}

function updateDateSalida()
{
	var c=document.getElementById("variableescondida").value;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
		  if(xmlhttp.responseText != "" && xmlhttp.responseText.substring(0, 7) != "correct"){
					
					alert("Error: No se pudo actualizar la fecha");
					hidewindow("dialogdatesalida");
		  }else if (xmlhttp.responseText.substring(0, 7) == "correct"){
					hidewindow("dialogdatesalida");
					openSearchSalida();
					
	  	  }
	  }
	//xmlhttp.open("GET","searchuser.php?search="+bus+"&filter="+filter,true);  
	xmlhttp.open("POST","updatesalida.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("update="+c);
	//xmlhttp.send();
}

function changePeriod(){
	var period=document.getElementById("typeperiod").value;
	switch(period){
		case "0": $("#periodo").css({visibility:"hidden", position: "absolute" }).show(); $("#dates").css({visibility:"hidden", position: "absolute" }).show();break; 
		case "1": $("#periodo").css({visibility:"visible", position: "relative" }).show();$("#dates").css({visibility:"hidden", position: "absolute" }).show();break;
		case "2": $("#periodo").css({visibility:"hidden", position: "absolute" }).show();$("#dates").css({visibility:"visible", position: "relative" }).show();break; 
		default:break;
	}
}

function showDialogCompany(){
	var upwindow=window.innerHeight/2;
	var leftwindow=window.innerWidht/4;
	$("#dialogcompany").css({visibility:"visible", display:"none", position: "absolute", top:upwindow , left:leftwindow }).show();
}

function showUpdateSalida(c){
	var upwindow=window.innerHeight/2;
	var leftwindow=window.innerWidth/4;
	document.getElementById("variableescondida").value=c;
	$("#dialogdatesalida").css({visibility:"visible", display:"none", position: "absolute", top:upwindow , left:leftwindow, height:"100px", width:"200px" }).show();
	
}

function showDialogTrans(){
	var upwindow=window.innerHeight/2;
	var leftwindow=window.innerWidth/4;
	$("#dialogtrans").css({visibility:"visible", display:"none", position: "absolute", top:upwindow, left:leftwindow }).show();
}

function showDialogOrigen(){
	var upwindow=(window.innerHeight/2)+5;
	var leftwindow=(window.innerWidth/4)+5;
	document.getElementById("searchorigen").value="";
	$("#dialogorigen").css({visibility:"visible", display:"none", position: "absolute", top:upwindow, left:leftwindow }).show();
}

function showDialogOrden(){
	var upwindow=(window.innerHeight/2)+10;
	var leftwindow=(window.innerWidth/4)+10;
	document.getElementById("searchorden").value="";
	$("#dialogorden").css({visibility:"visible", display:"none",  position: "absolute", top:upwindow , left:leftwindow }).show();
}

function showDialogDestiny(){
	var upwindow=(window.innerHeight/2)+10;
	var leftwindow=(window.innerWidth/4)+10;
	$("#dialogdestiny").css({visibility:"visible", display:"none",  position: "absolute", top:upwindow , left:leftwindow }).show();
}

function hidewindow(str){
	$('#'+str).css({visibility:"hidden"});
}

//no funciona este procedimiento desde ajax
function redireccion()
{
	window.location='login.php';
}

function confirmacion(c) {
	if(confirm("¿Está seguro de Eliminar a "+c+"?"))
		return true;
	 else
	 	return false;	
} 