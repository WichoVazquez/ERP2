
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);



require_once("../Conexion/conexion_prueba_local.php");
require("../Objetos/orden_compra.php");
require("../Objetos/parametros.php");
require("../Objetos/proveedor.php");
require("../mail/notificacion_compras.php");


$link=conect();
$orden=new Orden_compra();
$orden->conexion($link); 

$parametros=new Parametros();
$parametros->conexion($link); 

$proveedor=new Proveedor();
$proveedor->conexion($link); 


	if($arr -> {'accion'}=="InsertarOrden")
	{
	$id=$orden->insert(
	$arr -> {'usuario_orden'},
	$arr -> {'proveedor_id'},
	$arr -> {'req_id'},
	$arr -> {'status'}

	);
	echo $id;
	}
	else if ($arr->{'accion'}=="ConfirmarOrden")
	{

		$id_parametros=null;
		$folio_parametros =null;
		

			$id=$orden->update(
			$arr -> {'orden_id'}, 
			$arr -> {'fechaini_orden'}, 
			$arr -> {'fechafin_orden'}, 
			$arr->	{'obs_orden'},
			$arr->	{'departamento'},
			$arr->	{'proveedor_id'},
			$arr->	{'proveedor_contacto'},
			$arr->	{'proveedor_email'},
			$arr->	{'proveedor_tel'},
			$arr->	{'status'},
			$arr->	{'condiciones'},
			$arr->	{'certificado'},
			$arr->	{'contacto_entrega'},
			$arr->	{'domicilio_entrega'},
			$arr->	{'tipo_orden'}
			);

		


		echo $id;
	}	else if ($arr->{'accion'}=="Update_status_Orden")
	{
			$id=$orden->update_status_autoriza( 
			$arr -> {'status'},
			$arr -> {'orden'}, 
			$arr -> {'obs'},
			$arr -> {'usuario'}
			);
		echo $id;
	}
	else if ($arr->{'accion'}=="obtenerCorreo")
	{
		
		 $array=$proveedor->detalle_contacto_compras($arr -> {'proveedor'});
	
		echo json_encode($array);
	}
	else if ($arr->{'accion'}=="EnviarOrdenCompra")
	{
		$id=$orden->update_status(
			$arr->	{'status'},
			$arr-> {'orden_id'}, 
			""
			);
	enviarOrdenCompra($arr -> {'orden_id'}, $arr->{'usuario'}, $arr->{'password'}, $arr->{'usuario'}, $arr->{'body_mail'});
	
	}


?>
   