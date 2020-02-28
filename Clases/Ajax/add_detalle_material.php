
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/almacen_material.php");



$link=conect();
$detalle_material=new Almacen_material();
$detalle_material->conexion($link);

$mat=$detalle_material->insertDetalle( 
	$arr -> {'material_id'}, 
	$arr -> {'producto_id'}, 
	$arr -> {'cantidad'},
	$arr -> {'observaciones'}
	);
	
echo $mat;
?>
   