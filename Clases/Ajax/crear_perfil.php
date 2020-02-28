
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require_once("../Conexion/conexion_prueba_local.php");
require("../Objetos/perfil.php");


$link=conect();
$orden=new Perfil();
$orden->conexion($link); 
$comp=$orden->insert(
	$arr -> {'perfil_nombre'},
	$arr -> {'perfil_descripcion'}
	);
echo $comp;
?>
   