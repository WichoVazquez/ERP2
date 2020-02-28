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
			echo "  <form  method='post' name='myform' id='content' onsubmit=\"return validarDatosMoneda(true)\" action='moneda_registro.php'>
			 <span class='Titulo'>Registro de Moneda</span>
			 <div id='separa3'></div>
      <table border='0' style='padding-top:10px;'>
	  <tr>  
          
		  <td width='100' style='font-size:12px;'>Descripcion</td>
          <td width='100'><input type='text'  name='desc' id='desc' required onBlur=\"return validarDescripcionMoneda(this.value)\" maxlength='20' ></td>
		</tr>
		<tr>  
          <td width='100' style='font-size:12px;'>Prefijo</td>
          <td width='100'> <input type='text'  id='prefijo' name='prefijo' required maxlength='10' ></td>  
        </tr>
		<tr>  
          <td width='100' style='font-size:12px;'>Tipo de Cambio</td>
          <td width='100'> <input type='number' step='0.01'  id='tipocambio' name='tipocambio' required onkeypress=\"return NumDecimal(event, this)\" maxlength='6'></td>  
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
			require("../Clases/Objetos/moneda.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$moneda=new moneda();
			$moneda->conexion($link);

		$result_insert=$moneda->insert(
		$_POST['desc'],
		$_POST['prefijo'],
		$_POST['tipocambio']);
		echo  $result_insert;
		if($result_insert!=0)

			
				{
					echo "<br>
						   <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Tipo de Moneda ha sido registrado</p>";
				}
				else
				{
					echo  "
							<br>
							<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: El Tipo de Moneda no se ha podido registrar</p>";
							
				}
	
		}
?>
</body>
</html>
