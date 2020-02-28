<? // Inicia Página
require_once("index_header.php");
  $user=sesiones_start();
//  librerias();
 // scripts_head("../Clases/javascript/nuevacotizacion.js");
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
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

function ponerValorCliente(str){
  document.getElementById('cliente').value=str.desc;
  document.getElementById('cliente').title=str.id;
  document.getElementById('cliente').setAttribute("idcliente",str.id);
  document.getElementById('livecliente').innerHTML="";
  document.getElementById("livecliente").style.border="0px";

  console.log('$( "#cliente" ).attr("idcliente")');

  //Habilitar Seleccion de Productos
  //alert("Activa Botones");
  //document.getElementById('agregar-producto').removeAttribute('disabled');
  //$('#attach-file').show();
 	console.log("que pedo otra vez poner");
}

function showResultCliente(str)
{
 $('#usuario').val();
if(str.length==0)
{
	document.getElementById('livecliente').innerHTML="";
    document.getElementById("livecliente").style.border="0px";
}
else
{
xmlhttp=objetoAjax();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livecliente").innerHTML=xmlhttp.responseText;
    document.getElementById("livecliente").style.border="1px solid #A5ACB2";
    }
  }

console.log("que pedo aqui show");

xmlhttp.open("POST","../Clases/Ajax/selectcliente_id.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("cliente="+str+"&usuario="+$('#usuario').val());  

}
}
</script>


</head>
<body>

 <?php
echo "<input type='hidden' id='usuario' value='".$user."'/>";
	/*iniciarSession();
	$nivel=$_SESSION["nivel"];
	if($nivel==0)
	{
	*/	
		if(!isset($_POST['Guardar']))
		{
			echo "
  <form  method='post' name='myform'  id='myform'  action='matriz_sucursal_registro.php'>
      <table border='0' style='padding-top:10px;'>
 	<span class='Titulo'>Registro de Lugar Destino</span>
 	<div id='separa3'></div>
	  <tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Cliente/Matriz</td>
          <td width='100'> <INPUT type='text' name='cliente' id='cliente' class='text ui-widget-content ui-corner-all' onKeyUp='showResultCliente(this.value)' maxlength='20' idcliente='0' /><DIV id='livecliente' class='texto_lista_chico' style='position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100;'></DIV></td>
		

		
          <td width='100'>
		  	<select name='tipo' style='max-width:100px; display: none;' value= '1'>
              <option value='1' selected='selected'>Sucursal</option>
            </select>
		  </td>
	  </tr>
	  <tr>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Nombre del Lugar Destino</td>
          <td width='100'>
		  <input type='text' id='clave' name='clave' maxlength='50'>
		  </td>
	  </tr>
		<td height='20' colspan=4><span class='Subtitulo'>Domicilio: &nbsp;</td> 
        	
		<tr>
		  <td style='font-size:12px;'>Calle</td>
          <td width='100'><input type='text' name='calle' id='calle' required maxlength='50'></td>
		  <td  style='font-size:12px;'>Número Ext</td>
          <td width='100' style='font-size:12px;'><input type='text' required id='num_ext' name='num_ext' maxlength='20'>	</td>

		</tr>
		<tr>
		  <td  style='font-size:12px;'>Número Int</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_int' maxlength='50'></td>
		  <td  style='font-size:12px;'>Colonia</td>
          <td width='100'><input type='text' name='colonia' id='colonia' required maxlength='50'></td>
		</tr>
		<tr>
		<td style='font-size:12px;'>Municipio</td>
          <td width='100' style='font-size:12px;'><input type='text' id='municipio' name='municipio' required maxlength='50'></td>
		  <td  style='font-size:12px;'>Ciudad</td>
          <td width='100'><input type='text' name='ciudad' id='ciudad' required maxlength='50'></td>
		</tr>
		<tr>
		<td  style='font-size:12px;'>Estado</td>
          <td width='100'><input type='text' name='estado' id='estado'  required maxlength='10'></td>
		  <td  style='font-size:12px;' >CP</td>
          <td width='100'><input type='text' name='cp'  onkeypress=\"return NumEntero(event)\" maxlength='5' id='cp' ></td>
		</tr>
		
		<td height='20' colspan=4><span class='Subtitulo'>Contacto Principal: &nbsp;</td>
		
      	
		<tr>
              <td  width='100' style='font-size:12px;'>Nombre</td>
              <td width='100'><input type='text' required name='nombre' id='nombre' maxlength='50'></td>
              <td  width='100' style='font-size:12px;'>Apellido Paterno</td>
              <td width='100'><input type='text'  required name='apel_p' id='apel_p' maxlength='50'></td>
        </tr>

        <tr>
          <td width='100' style='font-size:12px;'>Apellido Materno</td>
          <td width='100'><input type='text'   name='apel_m' id='apel_m' maxlength='50'></td>
          <td width='100' style='font-size:12px;'>Correo Electr&oacute;nico</td>
          <td width='100'><input type='text'  onBlur=\"return validarEmail(this.value)\" required name='email' id='email' maxlength='50' ></td>
		</tr>
        </tr>
        
		<tr>
		<td width='100' style='font-size:12px;'>Telefono (Trabajo)</td>
          <td width='100'><input type='text'   name='tel_trabajo' id='tel_trabajo' maxlength='12'></td>
		  <td width='100' style='font-size:12px;'>Ext. (Trabajo)</td>
          <td width='100'><input type='text' name='ext_tel_trabajo' maxlength='12'></td>
		</tr>
		<tr>
		<td width='100' style='font-size:12px;'>Telefono (Casa)</td>
          <td width='100'><input type='text'  name='tel_casa' id='tel_casa' maxlength='12'></td>
		  <td width='100' style='font-size:12px;'>Celular</td>
          <td width='100'><input type='text' name='tel_cel' maxlength='12'></td>
		</tr>	
		<tr>
		
		<td colspan='5'>
			<div id=\"error\"  class='error1'>
			</div>
		</td>
		</tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input  class='botones-metro'  type='submit' name='Guardar' value='Guardar'>
            </td>
        </tr>
      </table>
  </form>
		  ";


		}else
		{ 
			require_once("../Clases/Objetos/generales.php");
			require_once("../Clases/Objetos/domicilio.php");
			require_once("../Clases/Objetos/sucursal.php");
			require_once("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$generales=new Generales();
			$generales->conexion($link);
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
			$sucursal=new Sucursal();
			$sucursal->conexion($link);

$cliente=$_POST['cliente'];
$qry =mysql_query("SELECT CLIENTE.cliente_id, CLIENTE.cliente_razonsocial from CLIENTE where cliente_razonsocial='$cliente' ");
$fetch= mysql_fetch_array($qry);
 $cliente_id= $fetch['cliente_id'];

			if(!$generales->email_duplicado($_POST['email']))
			{
					$result_gen=$generales->insert(
					$_POST['nombre'],
					$_POST['apel_p'],
					$_POST['apel_m'],
					$_POST['tel_trabajo'],
					$_POST['ext_tel_trabajo'],
					$_POST['tel_casa'],
					$_POST['tel_cel'],
					$_POST['email']);
					if($result_gen!=0)
					{
						
						$res_dom=$domicilio->insert(
						$_POST['calle'],
						$_POST['num_ext'],
						$_POST['num_int'],
						$_POST['colonia'],
						$_POST['municipio'],
						$_POST['ciudad'],
						$_POST['estado'],
						$_POST['cp']);
						if($res_dom!=0)
						{
							
							$res_suc=$sucursal->insert(
							$_POST['tipo'],
							$_POST['clave'],
							$cliente_id,
							$result_gen,
							$res_dom);
							if($res_suc=="OK")
							{
								echo "<br>
									   <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>La Matriz/Sucursal ha sido registrado</p>";
							}
							else
							{
								echo "<br>

									  <p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: La sucursal no se ha podido registrar:".$res_suc."</p>";
								$domicilio->delete($res_dom);
								$generales->delete($result_gen);
							  
							}
						}//domicilio		
						else
						{
							echo "<br>
								  <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: El Domicilio de la sucursal no se ha podido registrar</p>";
								  $generales->delete($result_gen);
						}
					}//generales
					else
					{
						echo "<br>
								  <p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: los datos del Sucursal no se han podido registrar</p>";
								  
					}
								
			}
			else
			{
				echo "<br>
							  <p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: los datos del contacto de Sucursal no se han podido registrar, email duplicado</p>";
									
			}
		}
		
		
?>
<div id='livesearch' class='texto_lista_chico' style='position:absolute; overflow:auto; height:50px; padding-top:0px; background-color:#FFF;z-index:100;'></div>
</body>
</html>
