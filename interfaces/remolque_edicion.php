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

		$id=0;
		if(!isset($_POST['Guardar']))
		{
			$id=$_GET['id'];
			require("../Clases/Objetos/transporte.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$transporte=new Transporte();
			$transporte->conexion($link);
			$provarray=$transporte->detalle_remolque($id);
			
			
			echo  "
  			<form  method='post' name='myform' id='myform' action=\"remolque_edicion.php?id=".$id."&placas=".$provarray[2]."\">
			
				 <span class='Titulo'>Editar Remolque</span>
				 <div id='separa3'></div>
      <table border='0' style='padding-top:10px;'>
	  <tr>  
          
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Nombre</td>
          <td width='100'><input type='text' name='nombre'  id='nombre'  required maxlength='200' value='".$provarray[1]."'\"></td>

    </tr>
     <tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Placas</td>
          <td width='100'> <input type='text' id='placas' name='placas' value=".$provarray[2]." required onBlur=\"return validarPlacas(this.value)\" maxlength='10'></td>  
     </tr>


		</tr>
			
      			<tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input  class='botones-metro' type='submit' name='Guardar' value='Guardar'>
            </td>
        </tr>
      </table>
  </form>
		  ";
		}else
		{ 
			require("../Clases/Objetos/transporte.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			
			$transporte=new Transporte();
			$transporte->conexion($link);
		
			$result_edit=$transporte->update_remolque(
			$_GET['id'],
		$_POST['nombre'],
		$_GET['placas']);

			
					if($result_edit=="OK")
					{		
					
								echo "<br>
						   		<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Remolque ha sido actualizado</p>";
							}
							else
							{
								echo "
								<br>
								<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR:El Remolque no se ha podido actualizar </p>";
							}
		
		
		
		}
		
		
?>

</body>
</html>
