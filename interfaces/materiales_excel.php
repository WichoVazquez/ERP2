
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

</head>
<body>

<?php
		if(!isset($_POST['Guardar']))
		{
			echo "<form name='myforma' action='materiales_excel.php' method='POST' enctype='multipart/form-data'>
			
              <input name='file' type='file' id='file'><br>
			  
			  <td colspan='4' align='center' style='padding-top:20px;'> 
			  
              <input type='submit' name='Guardar' value='Guardar'>
			  
            </td>
               </form>
		";
		echo "ENTRE AQUI";
		}
		else
		{
		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		
			require_once 'Excel/reader.php';
			$data = new Spreadsheet_Excel_Reader();
			$data->setUTFEncoder('iconv');
			$data->setOutputEncoding('UTF-8');			
			
			$data->read($_FILES["file"]["name"]);
			error_reporting(E_ALL ^ E_NOTICE);
			echo "a ver si entro MATERIALES";	

	
			require("../Clases/Objetos/almacen_material.php");
			require("../Clases/Objetos/material.php");
			require("../Clases/Objetos/unidad.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
		
			$link=conect();

			$almacen_material=new Almacen_material();
			$almacen_material->conexion($link);
			$material=new Material();
			$material->conexion($link);
			$unidad=new Unidad();
			$unidad->conexion($link);
			

			for ($i = 4; $i <= $data->sheets[0]['numRows']; $i++) {

//echo mb_convert_encoding("\"".$data->sheets[0]['cells'][$i][3]." \", ".$data->sheets[0]['cells'][$i][4]."\"  ", "UTF-8", "ISO-8859-9");

//UNIDAD MEDIDA
				$unidadarray=$unidad->detalle_prefijo($data->sheets[0]['cells'][$i][4]);
				if($unidadarray!=null)				{
			
					$res_unidad = $unidadarray[0][0];
					}	
				else				{
					$res_unidad = $unidad->insert($data->sheets[0]['cells'][$i][4]);
			
				}

//PRESENTACIONES

if ($res_unidad!=0){
				$presentaciones_array=$unidad->detalle_presentaciones($data->sheets[0]['cells'][$i][5]);
				if($presentaciones_array!=null)				{
					$res_presentaciones = $presentaciones_array[0][0];
					}	
				else				{
					$res_presentaciones = $unidad->insert_presentaciones($data->sheets[0]['cells'][$i][5]);
		
				}
			}

				if($res_presentaciones!=0)
				{
//MATERIALES
					echo "MATERIALES";
					$result_mat=$material->insert_material(
						mb_convert_encoding($data->sheets[0]['cells'][$i][2], "UTF-8", "ISO-8859-9"),		//DESCRIPCION
						$data->sheets[0]['cells'][$i][9],										//TIPO
						$res_unidad,							//Unidad
						0,										//MAQUILA
						mb_convert_encoding($data->sheets[0]['cells'][$i][3], "UTF-8", "ISO-8859-9"),										//SAE
						mb_convert_encoding($data->sheets[0]['cells'][$i][6], "UTF-8", "ISO-8859-9"),	 //FLETE
						$res_presentaciones  //ID PRESENTACION
						);		
	//ALMACEN	 
						if($result_mat!=0)
						{
							$res_alm=$almacen_material->insert(
							17,		//ALMACEN
							$result_mat,			//MATERIAL_ID
							$data->sheets[0]['cells'][$i][7],	//CANTIDAD
							0,		//MAXIMO
							0     //MINIMO
							);		
						if($res_alm!=0)
						{
							echo mb_convert_encoding("\"".$data->sheets[0]['cells'][$i][3]."\", ".$data->sheets[0]['cells'][$i][2]."\"  ", "UTF-8", "ISO-8859-9");
						}
						else
						{
							echo mb_convert_encoding("\"".$data->sheets[0]['cells'][$i][3]."\", ".$data->sheets[0]['cells'][$i][2]."\"NO SE GRABO MATERIAL ", "UTF-8", "ISO-8859-9");
							$res_alm->delete($result_mat);
						}
					}//domicilio	
										
				} //UNIDAD



				echo "<p></p>";
				echo "\n";
			} //for
		}
		
?>

</body>
</html>

