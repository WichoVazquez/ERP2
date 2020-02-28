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
  <form  method='post' name='myform' onsubmit=\"return validarDatosCliente(true)\" action='prospecto_registro.php'>
  <span class='Titulo'>Registro de Prospecto</span>
  	  <div id='separa3'></div>
      <table border='0' style='padding-top:10px;'>
	  <tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Clave</td>
          <td width='100'> <input type='text' id='clave' name='clave' required onBlur=\"return validarClaveCliente(this.value)\" maxlength='10'></td>
		  
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Razón Social</td>
          <td width='100'><input type='text' name='rs' id='rs' required  onBlur=\"return validarRSCliente(this.value)\" maxlength='50'></td>
		</tr>
		<tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>R.F.C.</td>
          <td width='100'> <input type='text' id='rfc' name='rfc' required onBlur=\"return validarRFCCliente(this.value)\" maxlength='12'></td>  
        </tr>
		<tr>
     
		
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
          <td width='100'><input type='text' name='cp' required onkeypress=\"return NumEntero(event)\" maxlength='5' id='cp' ></td>
		</tr>
	<tr>
		
		<td colspan='5'>
			<div id=\"error\"  class='error1'>
			</div>
		</td>
		</tr>

<td height='20' colspan=4><span class='Subtitulo'>Contacto: &nbsp;</td> 

<tr>
              <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Nombre</td>
              <td width='100'><input type='text' name='nombre' maxlength='50'></td>
 <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Correo Electr&oacute;nico</td>
 <td width='100'><input type='text' name='email' id='email' maxlength='50'></td>

             
        </tr>
        <tr>
         <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Apellido Paterno</td>
              <td width='100'><input type='text' name='apel_p' maxlength='50'></td>
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Apellido Materno</td>
          <td width='100'><input type='text' name='apel_m' maxlength='50'></td>
        </tr>
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Telefono (Trabajo)</td>
          <td width='100'><input type='text' name='tel_trabajo' maxlength='12'></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Extensión (Trabajo)</td>
          <td width='100'><input type='text' name='ext_tel_trabajo' maxlength='12'></td>
		</tr>
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Telefono (Casa)</td>
          <td width='100'><input type='text' name='tel_casa' maxlength='12'></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Celular</td>
          <td width='100'><input type='text' name='tel_cel' maxlength='12'></td>
		</tr>


<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>
		 Carta de Presentación
		  </td>
		<td width='100'>
		<INPUT type='checkbox' id='carta' name='carta' /> 
		</td>

		
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>
		 Material Multimedia
		  </td>
		  <td width='100'>
		<INPUT type='checkbox' id='material' name='material' /> 
		</td>
</tr>
<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>
		 Visita al Cliente
		  </td>
		<td width='100'>
		<INPUT type='checkbox' id='visita' name='visita' /> 
		</td>

		
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>
		Cotización
				  </td>
		  <td width='100'>
		<INPUT type='checkbox' id='cotiza' name='cotiza' /> 
		</td>
</tr> 






		<tr>
		<tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input  class='botones-metro'  type='submit' name='Guardar' value='Guardar'>
            </td>
        </tr>
      </table>
  </form>
		  ";
		}

		else
		{ 


			require("../Clases/Objetos/domicilio.php");
			require_once("../Clases/Objetos/prospecto.php");
			require("../Clases/Objetos/generales.php");
			require("../Clases/Objetos/contacto_ventas.php");
			require_once("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
			$prospecto=new Prospecto();
			$prospecto->conexion($link);
			$contacto=new Contacto_Ventas();
			$contacto->conexion($link);
			$generales=new Generales();
			$generales->conexion($link);

			$carta = 0;
			$material = 0;
			$visita = 0;
			$cotiza = 0;


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
							
							$res_pros=$prospecto->insert(
							$_POST['clave'],
							$_POST['rs'],
							$_POST['rfc'],
							$res_dom);
							
							if($res_pros!=0)
							{
								

								if ($_POST['carta'])
										$carta = 1;
								if ($_POST['material'])
										$material = 1;					
								if ($_POST['visita'])
										$visita = 1;		
								if ($_POST['cotiza'])
										$cotiza = 1;

								$res_pros_d=$prospecto->insert_prospecto(
										$carta,
										$material,
										$visita,
										$cotiza,
										$_POST['clave']
										);

								$res_con=$contacto->insert(
								$_POST['clave'],
								$result_gen
								);

								if($res_pros_d!=0 && $res_con!=0)
								{
									echo "<br>
									   <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Prospecto ha sido registrado</p>";
								}

								else
								{        //Prospecto_Documentos
									echo "
										<br>
										<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: El Prospecto no se ha podido registrar</p>";
										$domicilio->delete($res_dom);
								}

							}
							else
								{ //Prospecto
							echo "<br>
								  <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: El Prospecto no se ha podido registrar </p>";
							}


											}//domicilio		
						else
						{
							echo "<br>
								  <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: El Domicilio del Prospecto no se ha podido registrar</p>";
						}

				}

				else
				{
					echo "<br>
					<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: los datos del Usuario no se han podido registrar, email duplicado</p>
					<a href='usuario_registro.php'><img src='images/regresar.jpg'  width='80' alt='Agregar otro usuario'></a>";
				}

		}
		
		
?>
</body>
</html>
