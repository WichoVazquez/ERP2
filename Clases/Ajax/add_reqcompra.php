
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require_once("../Conexion/conexion_prueba_local.php");
require("../Objetos/requisicion_compra.php");
require("../Objetos/detalle_reqcompra.php");
require("../mail/notificacion_requisicion.php");

$array=array(); 

$link=conect();
$req=new Req_compra();
$req->conexion($link); 

$req_detalle=new Detalle_reqcompra();
$req_detalle->conexion($link); 


	if($arr -> {'accion'}=="InsertarReq")
	{
	$id=$req->insert(
		$arr -> {'cliente'}, 
		$arr -> {'usuario'}, 
		$arr -> {'fecha_req'}, 
		$arr -> {'observaciones'},
		$arr -> {'empresa_id'}
		);
	echo $id;
	}
	else if ($arr->{'accion'}=="UpdateReq")
	{
			$id=$req->update(
			$arr -> {'req_id'}, 
			$arr -> {'estado'}, 
			$arr -> {'cliente_id'}, 
			$arr->{'fecha_req'},
			$arr->{'proyecto'},
			$arr->{'descripcion'},
			$arr->{'lugar_entrega'},
			$arr->{'observaciones'},
			$arr -> {'empresa_id'},
			$arr -> {'departamento'}
			);

$subject_autorizar = "Solicitud de Aprobacion para Requisicion de Compra";
$subject = "Notificacion de Nueva Requisicion de Compra";

/************** COMPRAS PAARA APROBACION ****************/

			enviar_requisicion($arr -> {'req_id'}, 'SanchezA2', 'SanchezA2', 1, "Requisicion generada por el Departamento de ".$arr -> {'dpto_text'}." con FOLIO: ".$arr -> {'req_id'}, $subject_autorizar);


/************** USUARIO *********************************/

			enviar_requisicion($arr -> {'req_id'}, $arr -> {'usuario'}, $arr -> {'usuario'}, 1, "
				Se genero SATISFACTORIAMENTE su Requisicion por el Departamento de ".$arr -> {'dpto_text'}." con FOLIO: ".$arr -> {'req_id'}, $subject);

		echo $id;
	}	else if ($arr->{'accion'}=="Update_status_Req")
	{
			$id=$req->update_status( 
			$arr -> {'status'},
			$arr -> {'orden'}, 
			$arr -> {'obs'},
			$arr -> {'usuario'}
			);
			$subject = "Notificacion de Autorizacion de  Requisicion de Compra";
			enviar_requisicion($arr -> {'orden'}, $arr -> {'usuario_req'}, $arr -> {'usuario_req'}, 1, "
				Se AUTORIZO la requisicion con FOLIO: ".$arr -> {'folio_req'}, $subject);
		echo $id;
	}else if ($arr->{'accion'}=="ObtieneRequisiciones")
	{
		 
		 $array=$req->ObtieneRequisiciones();
		
		echo json_encode($array);
	}else if ($arr->{'accion'}=="obtenerDetalleRequisicion")
	{
		
		 $array=$req_detalle->busqueda_detalle($arr -> {'idrequisicion'});
		
		echo json_encode($array);
	}else 	if($arr -> {'accion'}=="InsertarReq_OS")
	{
	$id=$req->InsertarReq_OS($arr -> {'cliente_id'}, $arr -> {'usuario_id'}, $arr -> {'fecha_req'}, $arr -> {'proyecto'}, $arr -> {'descripcion'}, $arr -> {'lugar_entrega'}, $arr -> {'observaciones'}, $arr -> {'empresa_id'}, $arr -> {'estado'} );
	echo $id;
	}






?>
   