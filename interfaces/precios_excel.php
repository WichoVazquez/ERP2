
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

</head>
<body>

<?php
		if(!isset($_POST['Guardar']))
		{
			echo "<form name='myforma' action='precios_excel.php' method='POST' enctype='multipart/form-data'>
			
              <input name='file' type='file' id='file'><br>
			  
			  <td colspan='4' align='center' style='padding-top:20px;'> 
			  
              <input type='submit' name='Guardar' value='Guardar'>
			  
            </td>
               </form>
		";
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
			echo "a ver si entro PRECIOS - MATERIALES";	

	
			require("../Clases/Objetos/precios.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
		
			$link=conect();

			$precios=new Precios();
			$precios->conexion($link);

			

			for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {




					$result_mat=$precios->update_precios(
						mb_convert_encoding($data->sheets[0]['cells'][$i][1], "UTF-8", "ISO-8859-9"),
						$data->sheets[0]['cells'][$i][3]
						);			//IDSAE
					
					//domicilio
						if($result_mat=="OK")
			
							echo mb_convert_encoding("\"".$data->sheets[0]['cells'][$i][1]."\", ".$data->sheets[0]['cells'][$i][2]."\"  ", "UTF-8", "ISO-8859-9");
			
						else
					
							echo mb_convert_encoding("\"".$data->sheets[0]['cells'][$i][1]."\", ".$data->sheets[0]['cells'][$i][2]."\"NO SE GRABO MATERIAL ", "UTF-8", "ISO-8859-9");
						
							echo "<p></p>";
				echo "\n";
					}//domicilio	
										
		



	
		} //UNIDAD
		
?>

</body>
</html>

