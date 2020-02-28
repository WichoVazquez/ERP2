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
			require("../Clases/Objetos/moneda.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$moneda=new Moneda();
			$moneda->conexion($link);
			$provarray=$moneda->detalle($id);
			echo "
  			<form  method='post' name='myform' id='myform' action=\"moneda_edicion.php?clave=".$id."&desc=".$provarray[1]."\">
			
			 <span class='Titulo'>Editar Moneda</span>
			  <div id='separa3'></div>
			 
      <table border='0' style='padding-top:10px;'>
	  <tr>  
          
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Descripcion</td>
      	 <td width='100'>".$provarray[1]."</td>
		</tr>
        <tr>
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Prefijo</td>
          
          <td width='100'> <input type='text' id='prefijo' name='prefijo' required maxlength='10' value='".$provarray[2]."'></td>  
		</tr>
		<tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Tipo de Cambio</td>
          <td width='100'> <input type='text' id='tipocambio' name='tipocambio'  required onkeypress=\"return NumDecimal(event, this)\"  maxlength='6' value='".$provarray[3]."'></td>  
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
			require("../Clases/Objetos/moneda.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			
		
			$moneda=new Moneda();
			$moneda->conexion($link);
			
			$result_edit=$moneda->update(
			$_GET['clave'],
		$_GET['desc'],
		$_POST['prefijo'],
		$_POST['tipocambio']);
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
						   		<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Tipo de Moneda ha sido actualizado</p>";
							}
							else
							{
								echo "
								<br>
								<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR:El Tipo de Moneda no se ha podido actualizar</p>";
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
