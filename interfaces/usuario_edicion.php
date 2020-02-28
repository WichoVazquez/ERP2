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

		
		if(!isset($_POST['Guardar']))
		{
			require("../Clases/Conexion/conexion_prueba_local.php");
	require("../Clases/Objetos/perfil.php");
	$link=conect();
	$perfil=new Perfil();
	$perfil->conexion($link);
	
	$array=$perfil->busqueda_perfil();



			$id=$_GET['id'];
			require("../Clases/Objetos/generales.php");
			require("../Clases/Objetos/domicilio.php");
			require("../Clases/Objetos/usuario.php");
			//require("../Clases/Conexion/conexion_prueba_local.php");
			
			$generales=new Generales();
			$generales->conexion($link);
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
			$usuario=new Usuario();
			$usuario->conexion($link);
			$usuarray=$usuario->detalle($id);
			$gralarray=$generales->detalle($usuarray[2]);//generales_id
			$domarray=$domicilio->detalle($usuarray[3]);//domicilio_id
			/*if(($usuarray[4]==0||$usuarray[4]==1)&&$_SESSION['rol']!=0){
				echo "<br>
										<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR:El Usuario no puede ser modificado por el custodio</p>";
			}
			else{*/
			echo "
  			<form  method='post' name='myform' action=\"usuario_edicion.php?user=".$id."&gral=".$usuarray[2]."&dom=".$usuarray[3]."\">
     <span class='Titulo'>Editar Usuario</span>
			  <div id='separa3'></div>
      <table border='0' style='padding-top:10px;'>
	  <tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Usuario</td>
          <td width='100'><input type='text' id='nick' name='nick' onkeyup=\"usuario_repetido('".$usuarray[0]."')\" maxlength='10' value='".$usuarray[0]."' ></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Correo Electr&oacute;nico</td>
          <td width='100'><input type='text' name='email'  id='email' maxlength='50' value='".$gralarray[8]."'></td>
                    <td  style='font-size:12px;'>Perfil</td>
          <td width='200'>
		  	<select name='rol' style='width:200px;'>";
			
if($array!=null)
	{	
		$cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{
if ($array[$renglones][0] == $usuarray[5])
	 		echo "<option value='".$array[$renglones][0]."' selected>".$array[$renglones][1]."</option>";
		else
			echo "<option value='".$array[$renglones][0]."'>".$array[$renglones][1]."</option>";
		 
		}
	}



            echo"</select>
		  </td>
		</tr>
		<tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Contrase&ntilde;a</td>
          <td width='100'> <input type='text' id='pwd' name='pwd' maxlength='20' value='".$usuarray[1]."'></td>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Confirmar Contrase&ntilde;a</td>
          <td width='100'><input type='text'  id='c_pwd' name='c_pwd' onkeyup=\"validatePasswords('')\" maxlength='20' value='".$usuarray[1]."'></td>

        </tr>
		<tr>
		  
		</tr>
		<tr>
			<td height='30'>&nbsp;</td>
		</tr>
      	<tr>
              <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Nombre</td>
              <td width='100'><input type='text' name='nombre' maxlength='50' value='".$gralarray[1]."'></td>
              <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Apellido Paterno</td>
              <td width='100'><input type='text' name='apel_p' maxlength='50' value='".$gralarray[2]."'></td>
               <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Apellido Materno</td>
          <td width='100'><input type='text' name='apel_m' maxlength='50' value='".$gralarray[3]."'></td>
        </tr>

		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Telefono (Trabajo)</td>
          <td width='100'><input type='text' name='tel_trabajo' maxlength='12' value='".$gralarray[4]."'></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Extensión (Trabajo)</td>
          <td width='100'><input type='text' name='ext_tel_trabajo' maxlength='12' value='".$gralarray[5]."'></td>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Telefono (Casa)</td>
          <td width='100'><input type='text' name='tel_casa' maxlength='12' value='".$gralarray[6]."'></td>
          </tr>
        <tr>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Celular</td>
          <td width='100'><input type='text' name='tel_cel' maxlength='12' value='".$gralarray[7]."'></td>
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
          <td width='100'><input type='text' name='calle' maxlength='50' value='".$domarray[1]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Número Ext</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_ext' maxlength='20' value='".$domarray[2]."'>	</td>
          		  <td class='texto_chico_tabla' style='font-size:12px;'>Número Int</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_int' maxlength='50' value='".$domarray[3]."'></td>
		</tr>
		<tr>

		  <td class='texto_chico_tabla' style='font-size:12px;'>Colonia</td>
          <td width='100'><input type='text' name='colonia' maxlength='20' value='".$domarray[4]."'></td>

		<td class='texto_chico_tabla' style='font-size:12px;'>Municipio</td>
          <td width='100' style='font-size:12px;'><input type='text' name='municipio' maxlength='50' value='".$domarray[5]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Ciudad</td>
          <td width='100'><input type='text' name='ciudad' maxlength='50' value='".$domarray[6]."'></td>
		  
		</tr>
		<tr>
		<td class='texto_chico_tabla' style='font-size:12px;'>Estado</td>
          <td width='100'><input type='text' name='estado' maxlength='20' value='".$domarray[7]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>CP</td>
          <td width='100'><input type='text' name='cp' maxlength='5' value='".$domarray[8]."'></td>
		</tr>
		<tr>
		</tr>
		<tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input class='botones-metro'  type='submit' name='Guardar' value='Guardar'>
            </td>
        </tr>
      </table>
  </form>
		  ";
			//}
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
			
				   
					$result_gen=$generales->update(
					$_GET['gral'],
					$_POST['nombre'],
					$_POST['apel_p'],
					$_POST['apel_m'],
					$_POST['tel_trabajo'],
					$_POST['ext_tel_trabajo'],
					$_POST['tel_casa'],
					$_POST['tel_cel'],
					$_POST['email']);
					if($result_gen=="OK")
					{
						
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
													
								



							$res_usu=$usuario->update(
							$_GET['user'],
							$_POST['nick'],
							$_POST['pwd'],
							$_POST['rol']);
							if($res_usu=="OK")
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
								  <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: El Domicilio del Usuario no se ha podido actualizar</p>";
						}
					}//generales
					else
					{
						echo "<br>
								  <p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: los datos del Usuario no se han podido registrar</p>";
					}
				
					
			
		}
		
		
?>
