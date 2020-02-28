
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/almacen-taller.php");


$link=conect();
$orden_compra=new Almacen_Taller();
$orden_compra->conexion($link);



	$cot=$orden_compra->update_almacen_taller( 
	$arr -> {'orden'},
	$arr -> {'almacen_material_id'}, 
	$arr -> {'cantidad'},
	$arr -> {'status'}
	);





if($cot=="OK")
	echo "OK";
else
	echo $cot;	
?>
   