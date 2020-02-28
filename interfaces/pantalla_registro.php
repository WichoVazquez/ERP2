<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 
<link rel="stylesheet" href="public/css/estilos-ajax.css" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="../Clases/Verificadores/general.js"> </script>


</head>

<div id="mensaje" style="font-size:10px">
</div>
 <?php
 require('../Clases/Objetos/pantalla.php');
 require('../Clases/Conexion/conexion_prueba_local.php');

	/*iniciarSession();
	$nivel=$_SESSION["nivel"];
	if($nivel==0)
	{
	*/	
		if(!isset($_POST['Guardar'])){
			echo "
  <form  method='post' name='myform'  action='pantalla_registro.php'>
      <table border='0' style='padding-top:10px;'>
      <tr>
      <td class='texto_chico_tabla' width='100' style='font-size:12px;'>No men&uacute;</td>
      <td width='100'><input type='number' name='no_menu' maxlength='2'></td>
      </tr>
	  <tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Nombre</td>
          <td width='100'> <input type='text' id='nombre' name='nombre' maxlength='10'></td>
		</tr>
		<tr>  
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Descripci&oacute;n</td>
          <td width='100'><input type='text' name='desc' id='desc' maxlength='50'></td>
		</tr>
		<tr>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Pantalla padre</td>
		  <td width='100'><input type='number' name='padre' id='padre' maxlength='2'></td>
		</tr>
		<tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*URL.</td>
          <td width='100'> <input type='text' id='url' name='url'></td>
        </tr>
        <tr>  
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Imagen</td>
          <td width='100'><input type='text' name='clave' id='clave' maxlength='50'></td>  
        </tr>
		<tr>
			<td height='30'>&nbsp;</td>
		</tr>
        <tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input type='submit' name='Guardar' value='Guardar'>
            </td>
        </tr>
      </table>
  </form>
		  ";
		}
		else{
			$link=conect();
			$pantalla=new Pantalla();
			$pantalla->conexion($link);

			$res=$pantalla->insert($_POST['no_menu'],$_POST['nombre'],$_POST['desc'], $_POST['padre'], $_POST['url'], $_POST['clave']);

		if($res=="OK"){
				echo "<br><p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>La pantalla se dio de alta</p>";				
			}

			else{
				echo "<br><p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: La pantalla no se ha podido dar de alta</p>";
			}
			}

		
					
		
?>


			
