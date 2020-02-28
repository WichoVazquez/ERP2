<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 

<link rel="stylesheet" href="public/css/estilos-ajax.css" type="text/css"/>
<script src="../Clases/Verificadores/general.js"> </script>



</head>

 <?php
		
	
	
		if(!isset($_POST['Guardar']))
		{	
			$id=$_GET['id'];
			require("../Clases/Objetos/operador.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$operador=new Operador();
			$operador->conexion($link);
			$provarray=$operador->detalle($id);
			echo "
  			<form  method='post' name='myform' id='myform' action=\"operador_edicion.php?clave=".$id."&desc=".$provarray[1]."\">
			
			 <span class='Titulo'>Editar Operador</span>
			  <div id='separa3'></div>
			 
      <table border='0' style='padding-top:10px;'>
	  <tr>  
          
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Nombre</td>
      	 <td width='100'> <input type='text' id='nombre' name='nombre' required value='".$provarray[1]."'></td>
		</tr>
        <tr>
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Apellido paterno</td>          
          <td width='100'> <input type='text' id='apellido_p' name='apellido_p' required value='".$provarray[2]."'></td>  
		</tr>
		<tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Apellido materno</td><td width='100'> <input type='text' id='apellido_m' name='apellido_m' value='".$provarray[3]."'></td>  
		</tr>
		<tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>permiso</td>
          <td width='100'> <input type='text' id='permiso' name='permiso' required maxlength='1' value='".$provarray[4]."'></td>  
		</tr>
		<tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Numero de Licencia</td><td width='100'> <input type='text' id='licencia_no' name='licencia_no' required maxlength='12' value='".$provarray[5]."'></td>  
		</tr>
		<tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Vigencia de la licencia</td><td width='100'> <input type='text' id='vigencia' name='vigencia' value='".$provarray[6]."'></td>  
		</tr>		
      			<tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input class='botones-metro' type='submit' name='Guardar' value='Guardar'>
            </td>
        </tr>
      </table>
  </form>
		  ";
		}else
		{ 
			require("../Clases/Objetos/operador.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			
		
			$operador=new Operador();
			$operador->conexion($link);
			
			$result_edit=$operador->update(
		$_GET['clave'],
		$_POST['nombre'],
		$_POST['apellido_p'],
		$_POST['apellido_m'],
		$_POST['permiso'],
        $_POST['licencia_no'],
        $_POST['vigencia']);
//		echo  $result_edit;
			
					if($result_edit=="OK")
					{		
					/*	
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
							
							$res_prov=$proveedor->update(
							$_GET['user'],
							$_POST['clave'],
							$_POST['rs'],
							$_POST['rfc']);
							if($res_prov=="OK")
							{*/
								
								echo "<br>
						   		<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El operador ha sido actualizado</p>";
							}
							else
							{
								echo "
								<br>
								<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR:El operador no se ha podido actualizar</p>";
							}
						/*}//domicilio		
						else
						{
							echo "<br>
					  		<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: El Domicilio del Proveedor no se ha podido actualizar ".$res_cli."</p>";
					    }
					} // generales
					else
					{
						echo "<br>
								  <p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: los datos Generales del Proveedor no se han podido registrar</p>";
					} //generales else*/
		
		
		
		} //else
		
		
?>

</body>
</html>
