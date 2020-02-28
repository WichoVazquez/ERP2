
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/orden_compra.php");


$link=conect();
$orden_compra=new Orden_compra();
$orden_compra->conexion($link);


if ($arr -> {'status'}==7)
	$cot=$orden_compra->update_status_compras( 
	$arr -> {'status'},
	$arr -> {'orden'}, 
	$arr -> {'obs'},
	$arr -> {'fecha_entrega'}
	);
else
	$cot=$orden_compra->update_status( 
	$arr -> {'status'},
	$arr -> {'orden'}, 
	$arr -> {'obs'}
	);





if($cot=="OK")
	echo "OK";
else
	echo $cot;	
?>
   