<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 
<link rel="stylesheet" href="public/css/estilos-ajax.css" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="../Clases/Verificadores/general.js"> </script>


</head>

 <?php

	/*iniciarSession();
	$nivel=$_SESSION["nivel"];
	if($nivel==0)
	{
	*/	
		if(!isset($_POST['Guardar']))
		{
			echo "  <form  method='post' name='myform' id='content' onsubmit=\"return validarDatosOperador(true)\" action='operador_registro.php'>
			 <span class='Titulo'>Registro de Operadores</span>
			 <div id='separa3'></div>
      <table border='0' style='padding-top:10px;'>
	  <tr>  
          
		  <td width='100' style='font-size:12px;'>Nombre</td>
          <td width='100'><input type='text'  name='nombre' id='nombre' required ></td>
		</tr>
		<tr>  
          <td width='100' style='font-size:12px;'>Apellido paterno</td>
          <td width='100'> <input type='text'  id='apellido_p' name='apellido_p' required></td>  
        </tr>
		<tr>  
          <td width='100' style='font-size:12px;'>Apellido materno</td>
          <td width='100'> <input type='text' id='apellido_m' name='apellido_m'></td>  
        </tr>
        <tr>  
          <td width='100' style='font-size:12px;'>Tipo de permiso</td>
          <td width='100'> <input type='text'  id='permiso' name='permiso' required></td>  
        </tr>
        <tr>  
          <td width='100' style='font-size:12px;'>No Licencia</td>
          <td width='100'> <input type='text'  id='licencia_no' name='licencia_no' required></td>  
        </tr>
        <tr>  
          <td width='100' style='font-size:12px;'>Vigencia de la Licencia</td>
          <td width='100'> <input type='date'  id='vigencia' name='vigencia' required></td>  
        </tr>
		
      	<tr>
		
		<td colspan='5'>
			<div id=\"error\"  class='error1'>
			</div>
		</td>
		</tr>
		<tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input class='botones-metro'  type='submit' name='Guardar' value='Guardar'>            </td>
        </tr>
      </table>
</form> ";
		}else
		{ 
			require("../Clases/Objetos/operador.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$operador=new Operador();
			$operador->conexion($link);

		$result_insert=$operador->insert(
		$_POST['nombre'],
		$_POST['apellido_p'],
		$_POST['apellido_m'],
		$_POST['permiso'],
        $_POST['licencia_no'],
        $_POST['vigencia']);


		echo  $result_insert;
		if($result_insert!=0)

			
				{
					echo "<br>
						   <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El operador ha sido registrado</p>";
				}
				else
				{
					echo  "
							<br>
							<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: El operador no se ha podido registrar</p>";
							
				}
	
		}
?>
</body>
</html>
