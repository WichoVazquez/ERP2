
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/detalle_pedido.php");


$link=conect();
$detalle_pedido=new Detalle_Pedido();
$detalle_pedido->conexion($link); 

if ($arr -> {'accion'} == "entrega")


$ped=$detalle_pedido->insert_detalle_pedido( 
$arr -> {'producto'},  
$arr -> {'cantidad'},
$arr -> {'pedido'}, 
$arr -> {'precio'} , 
$arr -> {'observaciones'}, 
$arr -> {'multiplo'}, 
$arr -> {'tipocot'}, 
$arr -> {'status'}
);

else

$ped=$detalle_pedido->insert_detalle_pedido_recoleccion( 
$arr -> {'producto'},  
$arr -> {'cantidad'},
$arr -> {'pedido'}, 
$arr -> {'precio'} , 
$arr -> {'observaciones'}, 
$arr -> {'multiplo'}, 
$arr -> {'tipocot'},
$arr -> {'cantidad_prestamo'},
$arr -> {'estatus_detalle'}
);

echo $ped;
?>
   