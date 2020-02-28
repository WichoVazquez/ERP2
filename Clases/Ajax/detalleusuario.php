<?
			require("../Conexion/conexion_prueba_local.php");
			$link=conect();
			//require("../Objetos/domicilio.php");
			require("../Objetos/generales.php");
			require("../Objetos/usuario.php");
			/*$domicilio=new Domicilio();
			$domicilio->conexion($link);*/
			$generales=new Generales();
			$generales->conexion($link);
			$usuario=new Usuario();
			$usuario->conexion($link);
			$_POST['search'] = trim($_POST['search']); 
			$id=$_POST['search'];
			
			$usuarray=$usuario->detalle($id);
			
			$array=$generales->detalle($usuarray[2]);
			//$array=$domicilio->detalle($usuarray[3]);
			
			echo "<table border='0'  width='300'>";
			echo "<tr class='texto_chico_tabla' width='100' style='font-size:12px;'>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Rol:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$usuarray[4]."</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Estado:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$usuarray[5]."</td>";		
			echo "<table border='0'  width='300'>";
			echo "<tr class='texto_chico_tabla' width='100' style='font-size:12px;'>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Nombre:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[1]."</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Apellido Paterno:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[2]."</td>";		
			echo "</tr>";
			echo "<tr class='texto_chico_tabla' width='100' style='font-size:12px;'>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Apellido Materno:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[3]."</td>";		
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Tel.(Trabajo):</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[4]."</td>";
			echo "</tr>";
			echo "<tr class='texto_chico_tabla' width='100' style='font-size:12px;'>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Extensión:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[5]."</td>";		
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Tel.(Casa):</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[6]."</td>";		
			echo "</tr>";
			echo "<tr class='texto_chico_tabla' width='100' style='font-size:12px;'>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>Tel.(Celular):</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[7]."</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;font-weight: bold;'>e-mail:</td>";
			echo "<td class='texto_chico_tabla' width='100' style='font-size:12px;'>".$array[8]."</td>";		
			echo "</tr>";
			echo "</table>";
?>