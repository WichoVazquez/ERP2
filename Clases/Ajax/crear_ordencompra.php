
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require_once("../Conexion/conexion_prueba_local.php");
require("../Objetos/orden_compra.php");


$link=conect();
$orden=new Orden_compra();
$orden->conexion($link); 
$comp=$orden->insert(
	$arr -> {'proveedor'},
	$arr -> {'usuario'},
	$arr -> {'orden_observaciones'}
	);
echo $comp;
?>
   