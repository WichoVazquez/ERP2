<?
			require("../Conexion/conexion_prueba_local.php");
			$link=conect();
			require("../Objetos/material.php");
			$material=new Domicilio();
			$material->conexion($link);
			$_POST['search'] = trim($_POST['search']); 
			$id=$_POST['search'];
			$array=$material->detalle($id);
			echo "No. ".$array[0];
			
			echo "<table border='0'  width='300'>";
			echo "<tr class='texto_chico_tabla' width='100' style='font-size:12px;'>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Descripcion:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[1]."</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Unidad</td>";
			switch ($array[2]) {
				case '1':
					$unidad = "Herramienta" ;
					break;
				case '2':
					$unidad = "Material";
						break;
				case '3':
					$unidad = "Producto";
							break;
				
				default:
					# code...
					break;
			}
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[2]."</td>";		
			echo "</tr>";
			echo "<tr class='texto_chico_tabla' width='100' style='font-size:12px;'>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>No. Int.:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[3]."</td>";		
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Colonia:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[4]."</td>";
			echo "</tr>";
			echo "<tr class='texto_chico_tabla' width='100' style='font-size:12px;'>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Municipio:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[5]."</td>";		
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Ciudad:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[6]."</td>";		
			echo "</tr>";
			echo "<tr class='texto_chico_tabla' width='100' style='font-size:12px;'>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Estado:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[7]."</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>C.P.:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[8]."</td>";		
			echo "</tr>";
			echo "</table>";
?>