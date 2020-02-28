<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />



<link rel="stylesheet" href="public/css/estilos-ajax.css" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="../Clases/Verificadores/general.js"> </script>



</head>
<body>

 <?php

	/*iniciarSession();
	$nivel=$_SESSION["nivel"];
	if($nivel==0)
	{
	*/	
		if(!isset($_POST['Guardar']))
		{
			echo "  

			<form  method='post' name='myform' onsubmit=\"return validarDatosEmpresa(true)\" action='empresa_registro.php'>
			 <span class='Titulo'>Registro de Empresa</span>
			 <div id='separa3'></div>
      <table border='0' style='padding-top:10px;' valign='top'>
	  <tr>  
          
		  <td class='texto_chico_t3abla' width='100' style='font-size:12px;'>Razon Social</td>
          <td width='100'><input type='text' name='rs' id='rs' maxlength='50'  onBlur=\"return validarRSEmpresa(this.value)\" required></td>
		</tr>
		<tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>RFC</td>
          <td width='100'> <input type='text' id='rfc' name='rfc' maxlength='13'  onBlur=\"return validarRFCEmpresa(this.value)\" required></td>  
        </tr>
				
        	<td height='20' colspan=4><span class='Subtitulo'>Domicilio: &nbsp;</td> 
        	
		<tr>
		  <td style='font-size:12px;'>Calle</td>
          <td width='100'><input type='text' name='calle' id='calle'required maxlength='50'></td>
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
          <td width='100'><input type='text' name='ciudad' id='ciudad' required' maxlength='50'></td>
		</tr>
		<tr>
		<td  style='font-size:12px;'>Estado</td>
          <td width='100'><input type='text' name='estado' id='estado'  required maxlength='50'></td>
		  <td  style='font-size:12px;' >CP</td>
          <td width='100'><input type='number' name='cp' required maxlength='5' onkeypress=\"return NumEntero(event)\" id='cp' ></td>
		</tr>

		<tr>
		<td colspan='5'>
			<div id=\"error\" style='color:#FF0000; font-size:10px' color='#FF3366'>
			</div>
		</td>
		</tr>


		
		
     ";


echo "              

<tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input class='botones-metro' type='submit' name='Guardar' value='Guardar'>            </td>
        </tr>

 </table>
</form> ";
		}else
		{ 
			require("../Clases/Objetos/domicilio.php");			
			require("../Clases/Objetos/empresa.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$empresa=new empresa();
			$empresa->conexion($link);
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
		
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
									$result_insert=$empresa->insert(
									$_POST['rs'],
									$_POST['rfc'],
									$res_dom,
									$result_gen);
									
									if($result_insert!=0)
									{
									//	echo  $result_insert;
										echo "<br>
										<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>La Empresa ha sido registrada</p>";
									}else{
										echo  "
										<br>
										<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: La Empresa no se ha podido registrar </p>";
									}
								}//domicilio		
								else
								{
									echo "<br>
										  <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: El Domicilio de la Empresa no se ha podido registrar</p>";
								}

		
		}
?>
</body>
</html>
