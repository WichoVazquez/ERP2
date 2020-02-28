
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require_once("../Conexion/conexion_prueba_local.php");
require("../Objetos/taller_solicitud.php");
require("../Objetos/detalle_taller_solicitud.php");
require("../mail/notificacion_requisicion.php");

$array=array(); 

$link=conect();
$taller_sol=new Taller_solicitud();
$taller_sol->conexion($link); 

$taller_detalle=new Detalle_taller_solicitud();
$taller_detalle->conexion($link); 


	if($arr -> {'accion'}=="InsertarSolicitud")
	{
	$id=$taller_sol->insert(
		$arr -> {'taller_id'}, 
		$arr -> {'usuario'}, 
		$arr -> {'almacen_id'}, 
		$arr -> {'status'}
		);
	echo $id;
	}
	else if ($arr->{'accion'}=="InsertarDetalleSolicitud")
	{
			$id=$taller_detalle->insert(
			$arr -> {'taller_solicitud_id'}, 
			$arr -> {'producto_id'}, 
			$arr -> {'cantidad_solicitada'}
			);
/*
$subject_autorizar = "Solicitud de Aprobacion para Requisicion de Compra";
$subject = "Notificacion de Nueva Requisicion de Compra";


			enviar_requisicion($arr -> {'req_id'}, 'SanchezA2', 'SanchezA2', 1, "Requisicion generada por el Departamento de ".$arr -> {'dpto_text'}." con FOLIO: ".$arr -> {'req_id'}, $subject_autorizar);




			enviar_requisicion($arr -> {'req_id'}, $arr -> {'usuario'}, $arr -> {'usuario'}, 1, "
				Se genero SATISFACTORIAMENTE la requisición de Material al Allmacén", $subject);
*/
		echo $id;
	}	




?>
   