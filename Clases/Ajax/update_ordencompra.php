
<?

$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/orden_compra.php");


$link=conect();
$orden_compra=new Orden_compra();
$orden_compra->conexion($link);

echo "entre al update_ord";
$compra=$orden_compra->update(
	$arr -> {'orden_id'}, 
	$arr -> {'estado'}, 
	$arr -> {'proveedor_id'}, 
	$arr -> {'usuario_id'},
	$arr -> {'moneda'},
	$arr -> {'cambio_dia'},
	$arr -> {'observaciones'},
	$arr -> {'fecha_entrega'}
	);
echo $compra;

?>
   