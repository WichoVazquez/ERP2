<?
			require("../Conexion/conexion_prueba_local.php");
			$link=conect();
			require("../Objetos/domicilio.php");
			$domicilio=new Domicilio();
			$domicilio->conexion($link);
			$_POST['search'] = trim($_POST['search']); 
			$id=$_POST['search'];
			$array=$domicilio->detalle($id);
			
			echo "<table border='0'  width='300'>";
			echo "<tr class='texto_chico_tabla' width='100' style='font-size:12px;'>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Calle:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[1]."</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>No.:</td>";
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