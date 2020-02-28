
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
	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require("../Clases/Objetos/perfil.php");
	$link=conect();
	$perfil=new Perfil();
	$perfil->conexion($link);
	
	$array=$perfil->busqueda_perfil();

			echo "
  <form  method='post' name='myform' onsubmit=\"return verificarUsuario('valor')\" action='usuario_registro.php'>
  <span class='Titulo'>Registro Usuario</span>
			 <div id='separa3'></div>
      <table border='0' style='padding-top:10px;'>

	  <tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Usuario</td>
          <td width='100'> <input type='text' id='nick' name='nick' maxlength='10' onkeyup=\"usuario_repetido('')\" required></td>
		  
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Correo Electr&oacute;nico</td>
          <td width='100'><input type='text' name='email' id='email' maxlength='50' required ></td>
           <td class='texto_chico_tabla' style='font-size:12px;'>Perfil</td>
          <td width='100'>
		  	<select name='rol' style='max-width:400px;'>";
		  	if($array!=null)
	{	
		
			 echo "<option value='-1'>Seleccione Perfil</option>";
		$cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{
 		echo "<option value='".$array[$renglones][0]."'>".$array[$renglones][1]."</option>";			 
		}
	}
 /*			if($_SESSION['rol']==0)
			{
             
			  echo "<option value='0'>Administrador</option>
			  
              <option value='1'>Custodio</option>";
			}
			  echo "<option value='2' selected='selected'>Usuario</option>*/
         echo"</select>
		  </td>
		</tr>
		<tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Contrase&ntilde;a</td>
          <td width='100'> <input type='text' id='pwd' name='pwd' maxlength='20' required></td>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Confirmar Contrase&ntilde;a</td>
          <td width='100'><input type='text'  id='c_pwd' name='c_pwd' onkeyup=\"validatePasswords('')\" maxlength='20' required></td>
        </tr>
		<tr>
		 
		</tr>
		<tr>
			<td height='30'>&nbsp;</td>
		</tr>
      	<tr>
              <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Nombre</td>
              <td width='100'><input type='text' name='nombre' maxlength='50' required></td>
              <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Apellido Paterno</td>
              <td width='100'><input type='text' name='apel_p' maxlength='50' required></td>
              <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Apellido Materno</td>
          <td width='100'><input type='text' name='apel_m' maxlength='50'></td>
        </tr>
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Telefono (Trabajo)</td>
          <td width='100'><input type='text' name='tel_trabajo' maxlength='12'></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Extensión (Trabajo)</td>
          <td width='100'><input type='text' name='ext_tel_trabajo' maxlength='12'></td>
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Telefono (Casa)</td>
          <td width='100'><input type='text' name='tel_casa' maxlength='12'></td>
		</tr>
		<tr>
		
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
		  <td class='texto_chico_tabla' style='font-size:12px;'>Calle</td>
          <td width='100'><input type='text' name='calle' maxlength='50'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Número Ext</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_ext' maxlength='20'>	</td>
           <td class='texto_chico_tabla' style='font-size:12px;'>Número Int</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_int' maxlength='50'></td>
		</tr>
		<tr>
		 
		  <td class='texto_chico_tabla' style='font-size:12px;'>Colonia</td>
          <td width='100'><input type='text' name='colonia' maxlength='20'></td>
          <td class='texto_chico_tabla' style='font-size:12px;'>Municipio</td>
          <td width='100' style='font-size:12px;'><input type='text' name='municipio' maxlength='50'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Ciudad</td>
          <td width='100'><input type='text' name='ciudad' maxlength='50'></td>
		</tr>
		<tr>
		<td class='texto_chico_tabla' style='font-size:12px;'>Estado</td>
          <td width='100'><input type='text' name='estado' maxlength='10'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>CP</td>
          <td width='100'><input type='text' name='cp' maxlength='5'></td>
		</tr>
		<tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input class='botones-metro'  type='submit' name='Guardar' value='Guardar'>
            </td>
        </tr>
      </table>
  </form>
		  ";
		}else
		{ 
			require("../Clases/Objetos/generales.php");
			require("../Clases/Objetos/domicilio.php");
			require("../Clases/Objetos/usuario.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$generales=new Generales();
			$generales->conexion($link);
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
			$usuario=new Usuario();
			$usuario->conexion($link);
			//if(!$generales->email_duplicado($_POST['email']))
			//{
				if(!$usuario->usuario_duplicado($_POST['nick']))
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
							
							$res_usu=$usuario->insert(
							$_POST['nick'],
							$_POST['pwd'],
							$result_gen,
							$res_dom,
							$_POST['rol']);
							if($res_usu!=0)
							{
								echo "<br>
									   <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Usuario ha sido registrado</p>";
							}
							else
							{
								echo "
										<br>
										<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: El Usuario no se ha podido registrar</p>";
							}
						}//domicilio		
						else
						{
							echo "<br>
								  <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: El Domicilio del Usuario no se ha podido registrar</p>";
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
								  <p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: los datos del Usuario no se han podido registrar, Usuario Duplicado</p>";
				}
					
			/*}
			else
			{
				echo "<br>
							  <p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: los datos del Usuario no se han podido registrar, email duplicado</p>
									<a href='usuario_registro.php'><img src='images/regresar.jpg'  width='80' alt='Agregar otro usuario'></a>";
			}*/
		}
		
		
?>
