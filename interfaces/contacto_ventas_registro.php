
<div id="mensaje" style="font-size:10px">
</div>
 <?php

	/*iniciarSession();
	$nivel=$_SESSION["nivel"];
	if($nivel==0)
	{
	*/	
		if(!isset($_POST['Guardar']))
		{
			echo "
  <form  method='post' name='myform' action='contacto_ventas_registro.php'>
      <table border='0' style='padding-top:10px;'>
	  <tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Cliente</td>
          <td width='100'> <input type='text' id='cliente' name='cliente' maxlength='10' onkeyup=\"showResult(this.value)\"></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Correo Electr&oacute;nico</td>
          <td width='100'><input type='text' name='email' id='email' maxlength='50' onkeyup=\"mail_repetido('')\"></td>
		</tr>
		<tr>
		  <td colspan='4'><div id='livesearch' class='texto_lista_chico' style='position:absolute; overflow:auto; height:50px; padding-top:0px; background-color:#FFF;z-index:100;'></div></td>
		</tr>
		<tr>
			<td height='30'>&nbsp;</td>
		</tr>
      	<tr>
              <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Nombre</td>
              <td width='100'><input type='text' name='nombre' maxlength='50'></td>
              <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Apellido Paterno</td>
              <td width='100'><input type='text' name='apel_p' maxlength='50'></td>
        </tr>
        <tr>
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Apellido Materno</td>
          <td width='100'><input type='text' name='apel_m' maxlength='50'></td>
        </tr>
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Telefono (Trabajo)</td>
          <td width='100'><input type='text' name='tel_trabajo' maxlength='12'></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Extensión (Trabajo)</td>
          <td width='100'><input type='text' name='ext_tel_trabajo' maxlength='12'></td>
		</tr>
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Telefono (Casa)</td>
          <td width='100'><input type='text' name='tel_casa' maxlength='12'></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Celular</td>
          <td width='100'><input type='text' name='tel_cel' maxlength='12'></td>
		</tr>
        <tr>
        <td height='30'>&nbsp;</td>
        <tr>
        <tr>  
        </tr>
        <tr>
        	<td>
            </td>
        </tr>
		
		<tr>
		</tr>
		<tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input type='submit' name='Guardar' value='Guardar'>
            </td>
        </tr>
      </table>
  </form>
		  ";
		}else
		{ 
			require("../Clases/Objetos/generales.php");
			require("../Clases/Objetos/contacto_ventas.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$generales=new Generales();
			$generales->conexion($link);
			$contacto=new Contacto_Ventas();
			$contacto->conexion($link);
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
						
							
							$res_con=$contacto->insert(
							$_POST['cliente'],
							$result_gen
							);
							if($res_con=="OK")
							{
								echo "<br>
									   <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Contacto ha sido registrado</p>";
							}
							else
							{
								echo "
										<br>
										<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: El Contacto no se ha podido registrar:".$res_con."</p>";
								$generales->delete($result_gen);
							}
						
					}//generales
					else
					{
						echo "<br>
								  <p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: los datos del Usuario no se han podido registrar</p>";
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
