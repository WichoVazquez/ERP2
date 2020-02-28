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
			require("../Clases/Objetos/domicilio.php");
			require("../Clases/Objetos/proveedor.php");
			require("../Clases/Objetos/generales.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
			$generales=new Generales();
			$generales->conexion($link);
			$proveedor=new Proveedor();
			$proveedor->conexion($link);
			$provarray=$proveedor->detalle($id);
			$domarray=$domicilio->detalle($provarray[3]);//domicilio_id
			$gralarray=$generales->detalle($provarray[4]);//generales_id
			
			echo "
  			<form  method='post' name='myform' id='myform' onsubmit=\"return validarDatosProveedor(false)\"  action=\"proveedor_edicion.php?user=".$id."&gral=".$provarray[4]."&dom=".$provarray[3]."\">
			 <span class='Titulo'>Editar Proveedor</span>
			  <div id='separa3'></div>
         <table border='0' style='padding-top:10px;'>
	  <tr>  
   
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Razón Social</td>
          <td width='100' colspan=3>".$provarray[1]."</td>
		</tr>
		<tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>RFC</td>
          <td width='100'>".$provarray[2]."</td>  
		</tr>

		
      	<tr>
<td height='20' colspan=4><span class='Subtitulo'>Domicilio: &nbsp;</td> 
		<tr>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Calle</td>
          <td width='100'><input type='text' name='calle'  required maxlength='50' value='".$domarray[1]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Número Ext</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_ext' required maxlength='20' value='".$domarray[2]."'>	</td>
		</tr>
		<tr>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Número Int</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_int' maxlength='20' value='".$domarray[3]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Colonia</td>
          <td width='100'><input type='text' name='colonia' maxlength='50' required value='".$domarray[4]."'></td>
		</tr>
		<tr>
		<td class='texto_chico_tabla' style='font-size:12px;'>Municipio</td>
          <td width='100' style='font-size:12px;'><input type='text' name='municipio' required maxlength='50' value='".$domarray[5]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Ciudad</td>
          <td width='100'><input type='text' name='ciudad' required maxlength='50' value='".$domarray[6]."'></td>
		</tr>
		<tr>
		<td class='texto_chico_tabla' style='font-size:12px;'>Estado</td>
          <td width='100'><input type='text' name='estado' required maxlength='10' value='".$domarray[7]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>CP</td>
          <td width='100'><input type='text' name='cp' required onkeypress=\"return NumEntero(event)\"  maxlength='5' value='".$domarray[8]."'></td>
		</tr>

		</tr>
	<td height='20' colspan=4><span class='Subtitulo'>Contacto Principal: &nbsp;</td>
		
		
      	<tr>
              <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Nombre</td>
              <td width='100'><input type='text' name='nombre' id='nombre' required  maxlength='50' value='".$gralarray[1]."'></td>
              <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Apellido Paterno</td>
              <td width='100'><input type='text' name='apel_p' id='apel_p'  required  maxlength='50' value='".$gralarray[2]."'></td>
        </tr>
		
        <tr>
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Apellido Materno</td>
          <td width='100'><input type='text' name='apel_m' id='apel_m' required maxlength='50' value='".$gralarray[3]."'></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Correo Electr&oacute;nico</td>
          <td width='100'><input type='text' name='email'  id='email' required   maxlength='50' value='".$gralarray[8]."'></td>
        </tr>
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Telefono (Trabajo)</td>
          <td width='100'><input type='text' name='tel_trabajo' id='tel_trabajo' required maxlength='12' value='".$gralarray[4]."'></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Extensión (Trabajo)</td>
          <td width='100'><input type='text' name='ext_tel_trabajo'  maxlength='12' value='".$gralarray[5]."'></td>
		</tr>
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Telefono (Casa)</td>
          <td width='100'><input type='text' name='tel_casa' id='tel_casa' required maxlength='12' value='".$gralarray[6]."'></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Celular</td>
          <td width='100'><input type='text' name='tel_cel' maxlength='12' value='".$gralarray[7]."'></td>
		</tr>

		<tr>
		<td colspan='5'>
			<div id=\"error\"  class='error1'>
			</div>
		</td>
		</tr>
		
		<tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input  class='botones-metro' type='submit' name='Guardar' value='Guardar'>            </td>
        </tr>
      </table>
  </form>
		  ";
		}else
		{ 
			require("../Clases/Objetos/domicilio.php");
			require("../Clases/Objetos/proveedor.php");
			require("../Clases/Objetos/generales.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$generales=new Generales();
			$generales->conexion($link);
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
			$proveedor=new Proveedor();
			$proveedor->conexion($link);
			
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
							
							/*$res_prov=$proveedor->update(
							$_GET['user'],
							$_POST[$provarray[0]],
							$_POST[$provarray[1]],
							$_POST[$provarray[2]]);
							if($res_prov=="OK")
							{*/
								echo "<br>
						   		<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Proveedor ha sido actualizado</p>";
							/*}
							else
							{
								echo "
								<br>
								<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR:El Proveedor no se ha podido actualizar</p>";
							}*/
						}//domicilio		
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
					} //generales else
		
		
		
		} //else
		
		
?>

</body>
</html>
