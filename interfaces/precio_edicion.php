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
			$id=$_GET['id'];

	
			require("../Clases/Objetos/material.php");
			require("../Clases/Objetos/precios.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();

			$material=new Material();
			$material->conexion($link);
			$precio=new Precios();
			$precio->conexion($link);

			$precioarray=$precio->detalle($id);
			

			echo "
  			<form  method='post' name='myform' action=\"precio_edicion.php?id=".$id."\">
 <span class='Titulo'>Editar Precio</span>
			  <div id='separa3'></div>
    <table border='0' style='padding-top:10px;'>


	  <tr>    
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Descripcion</td>
          <td width='100'><input type='text' name='descripcion' id='descripcion' maxlength='50' value='".$precioarray[1]."'></td>
		</tr>      
		<tr>  
		  
		</tr>
			
		
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Precio: $</td>
          <td width='100'><input type='text' name='precio' id='precio' maxlength='50' value='".$precioarray[3]."'></td>
	  <tr>
		
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input  class='botones-metro' type='submit' name='Guardar' value='Guardar'>
            </td>
              </tr>
        </tr>
      </table>
  </form>
		  ";
		}else
		{ 
			
			require("../Clases/Objetos/material.php");
			require("../Clases/Objetos/precios.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$material=new Material();
			$material->conexion($link);
			$precios=new Precios();
			$precios->conexion($link);

			$res_precios=$precios->update(
			$_GET['id'],
			$_POST['precio']
			);
				if($res_precios=="OK")
				{
					echo "<br>
						   <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Precio del Material ha sido actualizado</p>";
				}
				else
				{
					echo "
							<br>
							<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR:El Precio del Material no se ha podido actualizar</p>";
				}

}// if Unidad Medida

?>

