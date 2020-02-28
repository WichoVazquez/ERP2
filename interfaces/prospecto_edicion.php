<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="public/css/estilos-ajax.css" type="text/css"/>
<link rel="stylesheet" href="public/css/estilos-google.css" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="../Clases/Verificadores/general.js"> </script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="public/js/googlemaps_script.js"></script>  
 <?php

		

		if(!isset($_POST['Guardar']))
		{
			$id=$_GET['id'];
			$carta_doc = "";
			$material_doc = "";
			$visita_doc = "";
			$cotizacion_doc = "";
			require("../Clases/Objetos/domicilio.php");
			require("../Clases/Objetos/generales.php");
			require("../Clases/Objetos/prospecto.php");
			require("../Clases/Objetos/cliente.php");
			require_once("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
			$generales=new Generales();
			$generales->conexion($link);
			$prospecto=new Prospecto();
			$prospecto->conexion($link);
			$cliente=new Cliente();
			$cliente->conexion($link);

			$prosarray=$prospecto->detalle($id);
			
			$domarray=$domicilio->detalle($prosarray[3]);//domicilio_id
			$prosarray_docs=$prospecto->detalle_documentos($prosarray[0]);

			$cliarray=$cliente->detalle_contacto($id);


			$gralarray=$generales->detalle($cliarray[5]);

			if ($prosarray_docs[0])
				$carta_doc = "checked";
			if ($prosarray_docs[1])
				$material_doc = "checked";
			if ($prosarray_docs[2])
				$visita_doc = "checked";
			if ($prosarray_docs[3])
				$cotizacion_doc = "checked";
			
			echo "

			 <span class='Titulo'>Editar Prospecto</span>
			  <div id='separa3'></div>
      <table border='0' style='padding-top:10px;'>
	  <tr>  
	   <tr>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Clave</td>
          <td width='100' >".$prosarray[0]."</td>
		   <td   class='texto_chico_tabla' width='100' style='font-size:12px;'>RFC</td>
          <td width='100'>".$prosarray[2]."</td>  
		</tr>
     <tr>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Razón Social</td>
          <td width='100' colspan=3>".$prosarray[1]."</td>
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

		<tr>
        <td>
		<br>
        </td>
          			<form  method='post' name='myform'  id='myform'  action=\"prospecto_edicion.php?idedit=".$id."&gral=".$cliarray[5]."&dom=".$prosarray[3]."\">
		</tr>
		
			<td height='20' colspan=4><span class='Subtitulo'>Domicilio: &nbsp;</td> 
			
			<tr>
		
		<tr>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Calle</td>
          <td width='100'><input type='text' name='calle' id='calle' required maxlength='50' value='".$domarray[1]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Número Ext</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_ext' required maxlength='20' value='".$domarray[2]."'>	</td>
		</tr>
		<tr>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Número Int</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_int' maxlength='50' value='".$domarray[3]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Colonia</td>
          <td width='100'><input type='text' name='colonia' id='colonia' required maxlength='20' required value='".$domarray[4]."'></td>
		</tr>
		<tr>
		<td class='texto_chico_tabla' style='font-size:12px;'>Municipio</td>
          <td width='100' style='font-size:12px;'><input type='text' name='municipio' id='municipio' required  maxlength='50' value='".$domarray[5]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Ciudad</td>
          <td width='100'><input type='text' name='ciudad' required maxlength='50' value='".$domarray[6]."'></td>
		  
		</tr>
		<tr>
		<td class='texto_chico_tabla' style='font-size:12px;'>Estado</td>
          <td width='100'><input type='text' name='estado' required maxlength='10' value='".$domarray[7]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>CP</td>
          <td width='100'><input type='text' name='cp' id='cp'  required onkeypress=\"return NumEntero(event)\"  maxlength='5' value='".$domarray[8]."'></td>
		
		</tr>";


echo"
<td height='20' colspan=4><span class='Subtitulo'>Contacto: &nbsp;</td> 

<tr>
   <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Nombre</td>
   <td width='100'><input type='text' name='nombre' maxlength='50' value='".$gralarray[1]."'></td>

 <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Correo Electr&oacute;nico</td>
 <td width='100'><input type='text' name='email' id='email' maxlength='50' value='".$gralarray[8]."'></td>
        </tr>
        <tr>
         <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Apellido Paterno</td>
          <td width='100'><input type='text' name='apel_p' maxlength='50' value='".$gralarray[2]."'></td>
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Apellido Materno</td>
          <td width='100'><input type='text' name='apel_m' maxlength='50' value-='".$gralarray[3]."'></td>
        </tr>
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Telefono (Trabajo)</td>
          <td width='100'><input type='text' name='tel_trabajo' maxlength='12' value='".$gralarray[4]."'></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Extensión (Trabajo)</td>
          <td width='100'><input type='text' name='ext_tel_trabajo' maxlength='12' value='".$gralarray[5]."'></td>
		</tr>
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Telefono (Casa)</td>
          <td width='100'><input type='text' name='tel_casa' maxlength='12' value='".$gralarray[6]."'></td>
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Celular</td>
          <td width='100'><input type='text' name='tel_cel' maxlength='12' value='".$gralarray[7]."'></td>
		</tr>
        <tr>
";

echo "
<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>
		 Carta de Presentación
		  </td>
		<td width='100'>
		<INPUT type='checkbox' id='carta' name='carta' ".$carta_doc."/> 
		</td>

		
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>
		 Material Multimedia
		  </td>
		  <td width='100'>
		<INPUT type='checkbox' id='material' name='material' ".$material_doc."/> 
		</td>
</tr>
<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>
		 Visita al Cliente
		  </td>
		<td width='100'>
		<INPUT type='checkbox' id='visita' name='visita' ".$visita_doc."/> 
		</td>

		
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>
		Cotización
				  </td>
		  <td width='100'>
		<INPUT type='checkbox' id='cotiza' name='cotiza' ".$cotizacion_doc."/> 
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
			require("../Clases/Objetos/domicilio.php");
			require("../Clases/Objetos/prospecto.php");
			require("../Clases/Objetos/generales.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
			$generales=new Generales();
			$generales->conexion($link);
			$prospecto=new Prospecto();
			$prospecto->conexion($link);

			$carta = 0;
			$material = 0;
			$visita = 0;
			$cotiza = 0;
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
				
					if ($_POST['carta'])
							$carta = 1;
					if ($_POST['material'])
							$material = 1;					
					if ($_POST['visita'])
							$visita = 1;		
					if ($_POST['cotiza'])
							$cotiza = 1;

				$res_pros=$prospecto->update(
							$carta,
							$material,
							$visita,
							$cotiza,
							$_GET['idedit']
							);
				if($res_pros=="OK")
				{
					echo "<br>
						   <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Prospecto ha sido actualizado</p>";
				}
				else
				{
					echo "
							<br>
							<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR:El Prospecto no se ha podido actualizar</p>";
				}
			}//domicilio		
			else
			{
				echo "<br>
					  <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: El Domicilio del Prospecto no se ha podido actualizar ".$res_cli."</p>";
			}

		}
		else
			{
				echo "<br>
					  <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: Los Datos Generales del Prospecto no se ha podido actualizar ".$res_cli."</p>";
			}



		}
		
		
?>

</body>
</html>
