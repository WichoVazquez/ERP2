<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<xml:namespace ns="urn:schemas-microsoft-com:vml" prefix="v" />
<link href="../Clases/Diseño/standard_page.css"  rel="stylesheet" type="text/css">
<link href="../Clases/Diseño/fuente_page.css"  rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="../Clases/Verificadores/usuario.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Registro Kits</title>
Registro Kits
</head>
<body>
<div id="mensaje" style="font-size:10px">
</div>
 <?php

	/*iniciarSession();
	$nivel=$_SESSION["nivel"];
	if($nivel==0)
	{
	*/	
		if(!isset($_POST['Guardar']))

		{
			
			require("../Clases/Conexion/conexion_prueba_local.php");
			require("../Clases/Objetos/kits.php");
			require("../Clases/Objetos/material.php");
			$link=conect();
			$kits=new Kits();
			$kits->conexion($link);
			$material=new Material();
			$material->conexion($link);

			
			echo "
  		<form  method='post' name='myform' action='material_registro.php'>
      	<table border='0' style='padding-top:10px;'>
	  	<tr>    




		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Descripcion</td>
          <td width='100'><input type='text' name='descripcion' id='descripcion' maxlength='50'></td>
		</tr>      
		<tr>

		  <tr>";

echo "<td class='texto_chico_tabla' style='font-size:12px;'>Unidad Medida</td>";

if(!isset($_POST['unidad_nueva']))
											{
												
												echo "
											     <td width='100'>
													  	<select name='unidad' style='max-width:100px;'>";

													$array=$unidad->detalle();
													$renglones=0;
													for($renglones=0; $renglones<count($array);$renglones++)
														{
															
															echo "<option value='".$array[$renglones][0]."'";




														echo 	">".$array[$renglones][1]."</option>";
														}

											 	echo "</select>	<input type='submit' name='unidad_nueva' value='+' class='button'>";

											}
											else
											{

											echo "<td width='100'><input type='text' name='unidad' id='unidad' maxlength='50'></td>";
}
      echo "    
		  		</td>  
		  <td class='texto_chico_tabla' style='font-size:12px;'>Tipo</td>
          <td width='100'>
		  	<select name='tipo' style='max-width:100px;'>
              <option value='0'>Herramienta</option>
			  <option value='1'>Material</option>
			  <option value='2' selected='selected'>Producto</option>
            </select>
		  </td>
		  
		</tr>
			
		
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Cantidad</td>
          <td width='100'><input type='text' name='cantidad' id='cantidad' maxlength='50'></td>
	  
		<td class='texto_chico_tabla' style='font-size:12px;'>Almacen</td>
          <td width='100'>
		  	<select name='almacen' style='max-width:100px;'>";


		$array=$almacen->detalle_tabla();
		$renglones=0;
		for($renglones=0; $renglones<count($array);$renglones++)
			{
				echo "<option value='".$array[$renglones][0]."'>".$array[$renglones][1]."</option>";
			}

         echo   "</select>
		  </td>
		  		  
		</tr>
		
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Minimo</td>
          <td width='100'><input type='text' name='minimo' id='minimo' maxlength='50'></td>
	
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>*Maximo</td>
          <td width='100'><input type='text' name='maximo' id='maximo' maxlength='50'></td>
		
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
			require("../Clases/Objetos/almacen.php");
			require("../Clases/Objetos/almacen_material.php");
			require("../Clases/Objetos/material.php");
			require("../Clases/Objetos/unidad.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$almacen=new Almacen();
			$almacen->conexion($link);
			$almacen_material=new Almacen_material();
			$almacen_material->conexion($link);
			$material=new Material();
			$material->conexion($link);
			$unidad=new Unidad();
			$unidad->conexion($link);

$unidadarray=$unidad->detalle_id($_POST['unidad']);
if($unidadarray!=null)
{
	$res_unidad = $_POST['unidad'];
}
else
{
	$res_unidad = $unidad->insert($_POST['unidad']);
}


if($res_unidad!=0)
{
			$result_mat=$material->insert(
			$_POST['descripcion'],
			$_POST['tipo'],
			$res_unidad);
			if($result_mat!=0)
			{
				
				$res_alm=$almacen_material->insert(
				$_POST['almacen'],
				$result_mat,
				$_POST['cantidad'],
				$_POST['maximo'],
				$_POST['minimo']);
				if($res_alm!=0)
				    {
						echo "<br>
							   <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Material ha sido registrado</p>";
					}
					else
					{
						echo "
								<br>
								<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: El Material no se ha podido registrar en el alamcén</p>";
					}
				}//domicilio		
				else
				{
					echo "
								<br>
								<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: El Material no se ha podido registrar</p>";
			     }		
}
else

{
	echo "
							<br>
							<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR:La unidad no se ha podido actualizar</p>";
}
		}
		
		
?>
</body>
</html>
