<?

	require_once("../Conexion/conexion_prueba_local.php");
	$link=conect(); 
	$id=$_POST['id'];
	require("../Objetos/perfil_pantalla.php");
	
	$titulo="";
	$perfil_pantalla=new Perfil_Pantalla();
	$perfil_pantalla->conexion($link);
	$array1=$perfil_pantalla->busqueda_pantallasPerfil($id);
// 	echo " 
// 		<table border='0' style='padding-top:10px;'>";
// 		//select pan.pantalla_nombre, per.alta, per.baja, per.consulta, per.modificacion from PERFIL_PANTALLA
// 		if ($array1!=null){
// 			for($i=0; $i<count($array1);$i++){
// 				if($titulo !=$array1[$i][0])
// 				{
// 				echo "<tr> 
// 				<td > ". $array1[$i][0] .
// "				</td>
// 				</tr>";
// 				$titulo=$array1[$i][0];
// 				}
// 				echo "
// 					<tr>
// 					<td>
// 					</td>
// 					<td>
// 					<div style='padding-left:20px;'>".$array1[$i][1]."</div>
// 						<div style='padding-left:30px;''>
							
// 						</div>
// 						</tr></td>";
// 				//	"<input type='checkbox' id='checkMain_".$array1[$i][6]."'>".$array1[$i][3]."<br>";
// 			}
// 		}
// 	echo "</table>";
?>