


<?php
		if(!isset($_POST['Guardar']))
		{
			echo "<form name='myforma' action='proveedor_excel.php' method='POST' enctype='multipart/form-data'>
			
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
			$data->setOutputEncoding('utf-8');			
			//$data->read('hoja_uno.xls');
			$data->read($_FILES["file"]["name"]);
			error_reporting(E_ALL ^ E_NOTICE);
		echo "a ver si entro PROVEEDORES";	
			require("../Clases/Objetos/domicilio.php");
			require("../Clases/Objetos/proveedor.php");
			require("../Clases/Objetos/generales.php");
			
			require_once("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
			$proveedor=new Proveedor();
			$proveedor->conexion($link);	
			$generales=new Generales();
			$generales->conexion($link);


			for ($i = 5; $i <= $data->sheets[0]['numRows']; $i++) {
//				for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
//					$string = $data->sheets[0]['cells'][$i][4];
//					echo $string;

if($data->sheets[0]['cells'][$i][1]!=null)
{
				$result_gen=$generales->insert(
					$data->sheets[0]['cells'][$i][12],    	// 12
					"",    
					"",
					$data->sheets[0]['cells'][$i][14], 		//tel trabajo
					$data->sheets[0]['cells'][$i][15],  	//ext trabajo
					0,  									//tel casa
					0,  									//tel_cel
					$data->sheets[0]['cells'][$i][13]);   	//email
					if($result_gen!=0)
					{

					$res_dom=$domicilio->insert(
					$data->sheets[0]['cells'][$i][4], //calle
					$data->sheets[0]['cells'][$i][6],  //numbext
					$data->sheets[0]['cells'][$i][7],  //numint
					$data->sheets[0]['cells'][$i][5],  //colonia
					$data->sheets[0]['cells'][$i][8],	//municipio
					$data->sheets[0]['cells'][$i][9],	//ciudad
					$data->sheets[0]['cells'][$i][10],	//estado
					$data->sheets[0]['cells'][$i][11]);	//cp	
					if($res_dom!=0)
					{						
						$res_prov=$proveedor->insert(
						$data->sheets[0]['cells'][$i][1],   //Clave
						$data->sheets[0]['cells'][$i][2],	//razonsocial
						$data->sheets[0]['cells'][$i][3],	//RFC
						$res_dom,
						$result_gen
						);	

					//domicilio
						if($res_prov!=0)
						{
							echo "\"".$data->sheets[0]['cells'][$i][1]."\", ".$data->sheets[0]['cells'][$i][2]."\"  ";
						}
						else
						{
							echo "\"".$data->sheets[0]['cells'][$i][1]."\", ".$data->sheets[0]['cells'][$i][2]."\"NO SE GRABO PROVEEDOR ";
							$domicilio->delete($res_dom);
						}
					}//domicilio	
										
				} //generalkes
				echo "<p></p>";
				echo "\n";
			} //for
	
	}//iff
}
		
?>

