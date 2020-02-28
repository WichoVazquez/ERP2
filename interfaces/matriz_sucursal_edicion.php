<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="public/css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="public/css/estilos-ajax.css" type="text/css"/>
<link rel="stylesheet" href="public/css/estilos-google.css" type="text/css"/>

<script src="../Clases/jquery/jquery-1.8.2.min.js"></script>
<script src="../Clases/jquery/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"> </script>
<script src="../Clases/jquery/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="public/js/googlemaps_script.js"></script>

<script>
		$.validationEngine.defaults.scroll = false;
		jQuery(document).ready(function(){		
			jQuery("#myform").validationEngine();
		});
</script>

</head>
<body>

 <?php

	/*iniciarSession();
	$nivel=$_SESSION["nivel"];
	if($nivel==0)
	{
	*/	$id=$_GET['id'];
		require("../Clases/Objetos/generales.php");
		require("../Clases/Objetos/domicilio.php");
		require("../Clases/Objetos/sucursal.php");
		require("../Clases/Objetos/cliente.php");
		require("../Clases/Conexion/conexion_prueba_local.php");
		$link=conect();
		$generales=new Generales();
		$generales->conexion($link);
		$domicilio=new Domicilio();
		$domicilio->conexion($link);
		$sucursal=new Sucursal();
		$sucursal->conexion($link);
					$cliente=new Cliente();
			$cliente->conexion($link);
			$cliarray=$cliente->detalle_contacto($id);
		$sucarray=$sucursal->detalle_matriz_suc($id);
		$gralarray=$generales->detalle($sucarray[5]);//generales_id
		$domarray=$domicilio->detalle($sucarray[4]);//domicilio_id

		if(!isset($_POST['Guardar']))
		{
			echo "

  <span class='Titulo'>Editar Lugar Destino</span>
<div id='separa3'></div>
  <table border='0' style='padding-top:10px;'>
      <table border='0' style='padding-top:10px;'>
	  <tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Cliente/Matriz</td>
          <td width='100'> <input type='text' id='cliente' name='cliente'  required maxlength='10' value='".$cliarray[1]."'></td>
		  
	  </tr>
	  <tr>
		  <td class='texto_chico_ta	bla' style='font-size:12px;'>Nombre del Lugar Destino</td>
          <td width='100'>
		  <input type='text' id='clave' name='clave' maxlength='50' value='".$sucarray[3]."'>
		  </td>
		  <div id='razon' value='".$sucarray[3]."'> </div>
	  </tr>
  
	 <tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>
		 <BUTTON id='muestra-mapas'>Ubicación</BUTTON>
          </td>	
      </tr>

          
 </table>         	
         	
			        <div id='MAPA_GOOGLE'>
			        <div align='center' id='full-direction'></div>
			        <div align='center' id='latitud'></div>
			        <div align='center' id='longitud'></div>
			        <div class='contenedor-mapa'>
			        <div id='mapa'></div>
			        </div>
			        </div>
		
		

<table border='0' style='padding-top:10px;'>

  <form  method='post' name='myform' id='myform' action='matriz_sucursal_edicion.php?user=".$id."&gral=".$sucarray[5]."&dom=".$sucarray[4]."'>


	  <td height='20' colspan=4><span class='Subtitulo'>Domicilio: &nbsp;</td> 
      
	  <tr>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Calle</td>
          <td width='100'><input type='text' name='calle' id='calle' required maxlength='50' value='".$domarray[1]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Número Ext</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_ext'  required maxlength='20' value='".$domarray[2]."'>	</td>
		</tr>
		<tr>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Número Int</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_int'  required maxlength='50' value='".$domarray[3]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Colonia</td>
          <td width='100'><input type='text' name='colonia' id='colonia' required maxlength='20' value='".$domarray[4]."'></td>
		</tr>
		<tr>
		<td class='texto_chico_tabla' style='font-size:12px;'>Municipio</td>
          <td width='100' style='font-size:12px;'><input type='text' name='municipio' id='municipio'  required maxlength='50' value='".$domarray[5]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Ciudad</td>
          <td width='100'><input type='text' name='ciudad' maxlength='50'  required value='".$domarray[6]."'></td>
		  
		</tr>
		<tr>
		<td class='texto_chico_tabla' style='font-size:12px;'>Estado</td>
          <td width='100'><input type='text' name='estado'  required maxlength='10' value='".$domarray[7]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>CP</td>
          <td width='100'><input type='text' name='cp' id='cp' onkeypress=\"return NumEntero(event)\" maxlength='5' value='".$domarray[8]."'></td>
		</tr>
		<td height='20' colspan=4><span class='Subtitulo'>Contacto Principal: &nbsp;</td>
	
      	<tr>
              <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Nombre</td>
              <td width='100'><input type='text' name='nombre'  required maxlength='50' value='".$gralarray[1]."'></td>
              <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Apellido Paterno</td>
              <td width='100'><input type='text' name='apel_p'  required maxlength='50' value='".$gralarray[2]."'></td>
        </tr>
        <tr>
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Apellido Materno</td>
          <td width='100'><input type='text' name='apel_m'  maxlength='50' value='".$gralarray[3]."'></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Correo Electr&oacute;nico</td>
          <td width='100'><input type='text' name='email' id='email' onBlur=\"return validarEmail(this.value)\" required maxlength='50' value='".$gralarray[8]."'></td>
        </tr>
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Telefono (Trabajo)</td>
          <td width='100'><input type='text' name='tel_trabajo'  required maxlength='12' value='".$gralarray[4]."'></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Extensión (Trabajo)</td>
          <td width='100'><input type='text' name='ext_tel_trabajo' maxlength='12' value='".$gralarray[5]."'></td>
		</tr>
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Telefono (Casa)</td>
          <td width='100'><input type='text' name='tel_casa' required maxlength='12' value='".$gralarray[6]."'></td>
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
            	<input  class='botones-metro' type='submit' name='Guardar' value='Guardar'>
            </td>
        </tr>
      </table>
  </form>
		  ";
		}else
		{ 
			//require("../Clases/Objetos/generales.php");
			//require("../Clases/Objetos/domicilio.php");
			//require("../Clases/Objetos/sucursal.php");
			//require("../Clases/Conexion/conexion_prueba_local.php");
			//$link=conect();
			//$generales=new Generales();
			//$generales->conexion($link);
			//$domicilio=new Domicilio();
			//$domicilio->conexion($link);
			//$sucursal=new Sucursal();
			//$sucursal->conexion($link);
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
					
					$res_suc=$sucursal->update(
					$_GET['user'],
					$_POST['tipo'],
					$_POST['clave'],
					$_POST['cliente']);
					if($res_suc=="OK")
					{
						echo "<br>
							   <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Lugar de Destino ha sido actualizado</p>";
					}
					else
					{
						echo "<br>
							  <p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: El Lugar de Destino no se ha podido registrar:".$res_suc."</p>";
						$domicilio->delete($res_dom);
						$generales->delete($result_gen);
								
					}
				}//domicilio		
				else
				{
					echo "<br>
						  <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: El Domicilio del lugar de destino no se han podido actualizar</p>";
						  $generales->delete($result_gen);
				}
			}//generales
			else
			{
				echo "<br>
						  <p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: los datos del lugar de destino no se han podido actualizar</p>";
						  
			}
								
			
		}
		
		
?>

</body>
</html>
