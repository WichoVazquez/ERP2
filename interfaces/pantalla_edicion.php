
<div id="mensaje" style="font-size:10px">
</div>
 <?php

		require("../Clases/Objetos/pantalla.php");
		require("../Clases/Conexion/conexion_prueba_local.php");
		$link=conect();
		$pantalla=new Pantalla();
		$pantalla->conexion($link);
		if(!isset($_POST['Guardar']))
		{
			$id=$_GET['id'];
			
			$array=$pantalla->detalle($id);
			
			echo "
  			<form  method='post' name='myform' action=\"pantalla_edicion.php?id=".$id."\">
       <table border='0' style='padding-top:10px;'>
	  <tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Nombre</td>
          <td width='100'> <input type='text' id='nombre' name='nombre' maxlength='10' value='".$array[1]."'></td>
		  
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Descripción</td>
          <td width='100'><input type='text' name='desc' id='desc' maxlength='50' value='".$array[2]."'></td>
		</tr>
		<tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Area.</td>
          <td width='100'> <input type='text' id='area' name='area' maxlength='20' value='".$array[3]."'></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*URL</td>
          <td width='100'><input type='text' name='url' id='url' maxlength='50' value='".$array[4]."'></td>  
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
		}else
		{ 
			
			$res=$pantalla->update(
			$_GET['id'],
			$_POST['nombre'],
			$_POST['desc'],
			$_POST['area'],
			$_POST['url']
			);
			if($res=="OK")
			{
				echo "<br>
					  <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>La Pantalla se ha actualizado</p>";
				
			}//domicilio		
			else
			{
				echo "<br>
					  <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: La Pantalla no se ha podido actualizar ".$res."</p>";
			}
		}
		
		
?>


