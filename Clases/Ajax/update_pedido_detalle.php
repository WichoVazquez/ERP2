<?

$value = file_get_contents('php://input');
$arr=json_decode($value);


require("../Conexion/conexion_prueba_local.php");
require("../Objetos/detalle_pedido.php");
require("../mail/notificacion_pedido.php");


$array=array(); 

$link=conect();



 if ($arr->{'accion'}=="EnviaNotificacion")
 {

 $subject = "Notificacion de ASIGNACION DE PEDIDO.";
if ($arr->{'status'}=="0"){
 // VA AL ALMACÉN
   enviar_pedido($arr -> {'folio'}, 'DelacruzJ', 'DelacruzJ', 1, "Se realizo Asignacion de Pedido al ALMACEN con FOLIO: ".$arr -> {'folio'}, $subject);
   enviar_pedido($arr -> {'folio'}, 'ValenciaJ', 'ValenciaJ', 1, "Se realizo Asignacion de Pedido al ALMACEN con FOLIO: ".$arr -> {'folio'}, $subject);
   enviar_pedido($arr -> {'folio'}, 'TaboaC', 'TaboaC', 1, "Se realizo Asignacion de Pedido a PRODUCCION con FOLIO: ".$arr -> {'folio'}, $subject);

  }
else
{
   enviar_pedido($arr -> {'folio'}, 'GuillenJ', 'GuillenJ', 1, "Se realizo Asignacion de Pedido a PRODUCCION con FOLIO: ".$arr -> {'folio'}, $subject);
  enviar_pedido($arr -> {'folio'}, 'NatarenG', 'NatarenG', 1, "Se realizo Asignacion de Pedido a PRODUCCION con FOLIO: ".$arr -> {'folio'}, $subject);
  enviar_pedido($arr -> {'folio'}, 'TaboaC', 'TaboaC', 1, "Se realizo Asignacion de Pedido a PRODUCCION con FOLIO: ".$arr -> {'folio'}, $subject);



 }
}
else{
  $pedido_detalle=new Detalle_pedido();
  $pedido_detalle->conexion($link);
  $ped=$pedido_detalle->update_envio( 
    $arr -> {'id_detalle_pedido'},
    $arr -> {'status'},
    $arr -> {'almacen_id'}
    );
  
echo $ped;
}
?>
   