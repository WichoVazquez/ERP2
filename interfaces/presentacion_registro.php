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
			echo "  <form  method='post' name='myform' id='content'  action='presentacion_registro.php'>
			 <span class='Titulo'>Registro de Presentaciones</span>
			 <div id='separa3'></div>
      <table border='0' style='padding-top:10px;'>
	 
		<tr>  
          <td width='100' style='font-size:12px;'>Descripción</td>
          <td width='100'> <input type='text'  id='prefijo' name='prefijo' required maxlength='500' ></td>  
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
			require("../Clases/Objetos/presentacion.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$presentacion=new Presentacion();
			$presentacion->conexion($link);

		$result_insert=$presentacion->insert(
		$_POST['prefijo']);
	
		if($result_insert!=0)

			
				{
					echo "<br>
						   <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>La Presentacion ha sido registrada</p>";
				}
				else
				{
					echo  "
							<br>
							<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: La Presentacion no se ha podido registrar</p>";
							
				}
	
		}
?>
</body>
</html>
