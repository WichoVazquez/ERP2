<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="public/css/estilos-ajax.css" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="../Clases/Verificadores/general.js"> </script>

<script type="text/javascript">
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

function ponerValorEmpresa(str){
  document.getElementById('empresa').value=str.desc;
  document.getElementById('empresa').title=str.id;
  document.getElementById('empresa').setAttribute("idempresa",str.id);
  document.getElementById('liveempresa').innerHTML="";
  document.getElementById("liveempresa").style.border="0px";

 
}

function showResultEmpresa(str)
{
 $('#usuario').val();
if(str.length==0)
{
	document.getElementById('liveempresa').innerHTML="";
    document.getElementById("liveempresa").style.border="0px";
}
else
{
xmlhttp=objetoAjax();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("liveempresa").innerHTML=xmlhttp.responseText;
    document.getElementById("liveempresa").style.border="1px solid #A5ACB2";
    }
  }
  console.log("CADENA: "+str);

xmlhttp.open("POST","../Clases/Ajax/selectempresa_id.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("empresa="+str);  

}
}

</script>

</head>
<body>
 <?php

		
		if(!isset($_POST['Guardar']))
		{
			$id=$_GET['id'];
			require("../Clases/Objetos/domicilio.php");
			require("../Clases/Objetos/almacen.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
			$almacen=new Almacen();
			$almacen->conexion($link);
			$almarray=$almacen->detalle($id);
			$domarray=$domicilio->detalle($almarray[3]);//domicilio_id
			
			echo "
  			<form  method='post' name='myform'  id='myform'  action=\"almacen_edicion.php?user=".$id."&dom=".$almarray[3]."\">
			 <span class='Titulo'>Edicion de Almacen</span>
			  <div id='separa3'></div>
      <table border='0' style='padding-top:10px;'>
	  <tr>  
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Nombre</td>
          <td width='100'>".$almarray[1]."</td>
	
          <td class='texto_chico_tabla' width='200' style='font-size:12px;'>Descripcion</td>
          <td width='100'>".$almarray[2]."</td>  
<tr>
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Empresa</td>

          <td width='100'> <INPUT type='text' name='empresa' id='empresa' class='text ui-widget-content ui-corner-all' onKeyUp='showResultEmpresa(this.value)' maxlength='20' idempresa='0' /><DIV id='liveempresa' class='texto_lista_chico' style='position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100;'></DIV>
          </td>
  </tr>


		</tr>
		<tr>
        <td>
		<br>
     
		 <tr>
	
			<td height='20' colspan=4><span class='Subtitulo'>Domicilio: &nbsp;</td> 
	
		
		<tr>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Calle</td>
          <td width='100'><input type='text' name='calle'  required maxlength='50' value='".$domarray[1]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Número Ext</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_ext'  required  maxlength='20' value='".$domarray[2]."'>	</td>
		</tr>
		<tr>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Número Int</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_int' maxlength='50' value='".$domarray[3]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Colonia</td>
          <td width='100'><input type='text' name='colonia'  required  maxlength='20' value='".$domarray[4]."'></td>
		</tr>
		<tr>
		<td class='texto_chico_tabla' style='font-size:12px;'>Municipio</td>
          <td width='100' style='font-size:12px;'><input type='text' name='municipio'  required  maxlength='50' value='".$domarray[5]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Ciudad</td>
          <td width='100'><input type='text' name='ciudad'  required  maxlength='50' value='".$domarray[6]."'></td>
		  
		</tr>
		<tr>
		<td class='texto_chico_tabla' style='font-size:12px;'>Estado</td>
          <td width='100'><input type='text' name='estado' required  maxlength='10' value='".$domarray[7]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>CP</td>
          <td width='100'><input type='text' name='cp' required onkeypress=\"return NumEntero(event)\" maxlength='5' value='".$domarray[8]."'></td>
		</tr>
				<tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input  class='botones-metro' type='submit' name='Guardar' value='Guardar'>
            </td>
        </tr>
      </table>
  </form>
		  ";
		}else
		{ 
			require("../Clases/Objetos/domicilio.php");
			require("../Clases/Objetos/almacen.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
			$almacen=new Almacen();
			$almacen->conexion($link);
			$res_dom=$domicilio->update(
			$_GET['dom'],
			$_POST['calle'],
			$_POST['num_ext'],
			$_POST['num_int'],
			$_POST['colonia'],
			$_POST['municipio'],
			$_POST['ciudad'],
			$_POST['estado'],
			$_POST['cp']);
			if($res_dom=="OK")
			{
				
			/*	$res_alm=$almacen->update(
				$_POST['clave'],
				$_POST['nombre'],
				$_POST['descripcion']);
				if($res_alm=="OK")
				{*/
					echo "<br>
						   <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Almacen ha sido actualizado</p>";
				/*}
				else
				{
					echo "
							<br>
							<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR:El Almacen no se ha podido actualizar</p>";
				}*/
			}//domicilio		
			else
			{
				echo "<br>
					  <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: El Domicilio del Almacen no se ha podido actualizar ".$res_alm."</p>";
			}
		}
		
		
?>

</body>
</html>
