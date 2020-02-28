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
			echo "  <form  method='post' name='myform'  id='myform'  onsubmit=\"return validarDatosTransporte(true)\" action='transporte_registro.php'>
			 <span class='Titulo'>Registro de Transporte</span>
			 <div id='separa3'></div>
      <table border='0' style='padding-top:10px;'>
	  <tr>  
          
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Nombre</td>
          <td width='100'><input type='text' name='nombre' id='nombre' required maxlength='100'></td>
		</tr>
		<tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Placas</td>
          <td width='100'> <input type='text' id='placas' name='placas' required onBlur=\"return validarPlacas(this.value)\" maxlength='10'></td>  
        </tr>
			<tr>
		
		<td colspan='5'>
			<div id=\"error\"  class='error1'>
			</div>
		</td>
		</tr>
		<tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input class='botones-metro' type='submit' name='Guardar' value='Guardar'>            </td>
        </tr>
      </table>
</form> ";
		}else
		{ 
			require("../Clases/Objetos/transporte.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$transporte=new Transporte();
			$transporte->conexion($link);
			

		$result_insert=$transporte->insert(
		$_POST['nombre'],
		$_POST['placas']);
		//echo  $result_insert;
		if($result_insert!=0)
	
			
				{
					echo "<br>
						   <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Transporte ha sido registrado</p>";
				}
				else
				{
					echo  "
							<br>
							<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: El Transporte no se ha podido registrar</p>";
							
				}
	
		}
?>
</body>
</html>
