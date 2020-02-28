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
			require("../Clases/Objetos/empresa.php");
			require("../Clases/Conexion/conexion_prueba_local.php");

			$link=conect();
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
			$empresa=new Empresa();
			$empresa->conexion($link);
			$provarray=$empresa->detalle($id);
			$domarray=$domicilio->detalle($provarray[3]);//domicilio_id

		
			
			echo "
  			<form  method='post' name='myform' id='myform' action=\"empresa_edicion.php?id=".$id."&dom=".$provarray[3]."\">
			 <span class='Titulo'>Editar Empresa</span>
			  <div id='separa3'></div>
			  <img src='../upload/empresas/".$id."/".$id.".png' alt='Smiley face'  width='260' height='70'> 
      <table border='0' style='padding-top:10px;'>

	  <tr>  
      		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Razon Social</td>
          <td width='100' colspan='3'><input type='text' name='razon' id='razon' required maxlength='60' value='".$provarray[1]."'></td>

        


		</tr>
		<tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>RFC</td>
          <td width='100'><input type='text' name='rfc' id='rfc' required maxlength='60' value='".$provarray[2]."'></td>  
		</tr>
		
		
		 <tr>
        
			<td height='20' colspan=4><span class='Subtitulo'>Domicilio: &nbsp;</td> 
          
        </tr>
		
		<tr>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Calle</td>
          <td width='100'><input type='text' name='calle' required maxlength='50' value='".$domarray[1]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Número Ext</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_ext' required maxlength='20' value='".$domarray[2]."'>	</td>
		</tr>
		<tr>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Número Int</td>
          <td width='100' style='font-size:12px;'><input type='text' name='num_int' maxlength='50' value='".$domarray[3]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Colonia</td>
          <td width='100'><input type='text' name='colonia' required maxlength='20' value='".$domarray[4]."'></td>
		</tr>
		<tr>
		<td class='texto_chico_tabla' style='font-size:12px;'>Municipio</td>
          <td width='100' style='font-size:12px;'><input type='text' name='municipio' required maxlength='50' value='".$domarray[5]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Ciudad</td>
          <td width='100'><input type='text' name='ciudad' required maxlength='50' value='".$domarray[6]."'></td>
		  
		</tr>
		<tr>
		<td class='texto_chico_tabla' style='font-size:12px;'>Estado</td>
          <td width='100'><input type='text' name='estado' required maxlength='50' value='".$domarray[7]."'></td>
		  <td class='texto_chico_tabla' style='font-size:12px;'>CP</td>
          <td width='100'><input type='text' name='cp' required onkeypress=\"return NumEntero(event)\" maxlength='5' value='".$domarray[8]."'></td>
		</tr>
		<tr>
		</tr>
		
		 <td colspan='5'>
			<div id=\"error\" style='color:#FF0000; font-size:10px' color='#FF3366'>
			</div>
		</td>";


		echo "
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
			require("../Clases/Objetos/empresa.php");
			require("../Clases/Objetos/domicilio.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
			$empresa=new Empresa();
			$empresa->conexion($link);			

    $res_emp=$empresa->update(
   $_GET['id'],
   $_POST['razon'],
   $_POST['rfc']
   );

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
			
						echo "<br>
						<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>La Empresa ha sido actualizada</p>";					
			}//domicilio		
			else
			{
				echo "<br>
					  <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: El Domicilio de la Empresa no se ha podido actualizar ".$res_cli."</p>";
			}


					
		
		
		
		} //else
		
		
?>

</body>
</html>
