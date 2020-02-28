
<?php



switch($_POST["action"]){
	case "okCompleto": ok_completo(); break;
	case "okIncompleto": ok_incompleto(); break;
	case "guardar_solicitud_compras": solicitarCompras(); break;
}
/*comienzan las funciones*/

function ok_completo(){
	$user=$_POST['usuario'];
	$detallePedido_id=$_POST['idDetPed'];
	$cantidadUpdate=$_POST['cantiadUpd'];
	$resultado=$_POST['resultado'];
	$cantidadSurtida=$_POST['cantSurtida'];
	$id_pedido=$_POST['Idpedido'];
	$idProducto=$_POST['idProducto'];
	$cantidadUpdate=$_POST['cantiadUpd'];
	$idAlmacen=$_POST['almacen'];
	$total=$cantidadUpdate + $cantidadSurtida;
	require("../Conexion/conexion_prueba_local.php");	
	$link=conect();
	$qery=mysql_query("SELECT ALMACEN_MATERIAL.cantidad_actual from ALMACEN_MATERIAL where ALMACEN_MATERIAL.material_id='$idProducto' and ALMACEN_MATERIAL.almacen_id='$idAlmacen'");
	$fetchh=mysql_fetch_array($qery);


	if ($fetchh){
	$actual=$fetchh['cantidad_actual'];
	$totally=$actual + $cantidadUpdate;

//echo "UPDATE  almacen_material SET  almacen_material.cantidad_actual =  '$totally' WHERE  almacen_material.material_id ='$idProducto' and almacen_material.almacen_id='$idAlmacen'";
	$qery1=mysql_query("UPDATE  ALMACEN_MATERIAL SET  ALMACEN_MATERIAL.cantidad_actual =  '$totally' WHERE  ALMACEN_MATERIAL.material_id ='$idProducto' and ALMACEN_MATERIAL.almacen_id='$idAlmacen'");

	}
	else{
	//	echo "INSERT INTO  almacen_material(almacen_id, material_id, cantidad_actual) VALUES  ('$idAlmacen', '$idProducto', 				'$cantidadUpdate' 		)";

			$qery1=mysql_query("INSERT INTO  ALMACEN_MATERIAL(almacen_id, material_id, cantidad_actual) VALUES  (
				'$idAlmacen',
				'$idProducto',
				'$cantidadUpdate'
				)");
	}

	$sql="UPDATE DETALLE_PEDIDO set cantidad_surtida_produccion='$total', detalle_pedido_status=0, almacen_id='$idAlmacen' WHERE  detalle_pedido_id='$detallePedido_id'";
	$res=mysql_query($sql);
	if($res)
		{	echo "Material completado correctamente";	}
		else
			{
		 	 $id_recot=0;
			 printf("Error:".mysql_error());
			}
/* HISTORICO */
						$query_historial=mysql_query("INSERT INTO  HISTORICO(cantidad, id_producto, id_almacen, usuario, id_pedido ) VALUES  (
				$cantidadUpdate,
				$idProducto,
				1,
				'$user',
				$id_pedido
				)");

		  revisar_status_pedido($id_pedido);
 }
		 
 
 function ok_incompleto(){
 	$user=$_POST['usuario'];
	$detallePedido_id=$_POST['idDetPed'];
	$cantidadUpdate=$_POST['cantiadUpd'];
	$resultado=$_POST['resultado'];
	$cantidadSurtida=$_POST['cantSurtida'];
	$idProducto=$_POST['idProducto'];
	$user=$_POST['usuario'];
	$total=$cantidadUpdate+$cantidadSurtida;
	$idAlmacen=$_POST['almacen'];
	require("../Conexion/conexion_prueba_local.php");	
	$link=conect();
	$qery=mysql_query("SELECT ALMACEN_MATERIAL.cantidad_actual from ALMACEN_MATERIAL where ALMACEN_MATERIAL.material_id='$idProducto' and ALMACEN_MATERIAL.almacen_id='$idAlmacen'");
	$fetchh=mysql_fetch_array($qery);
	//echo "$totally";
	if ($fetchh){
		$actual=$fetchh['cantidad_actual'];
		$totally=$actual + $cantidadUpdate;
		$qery1=mysql_query("UPDATE  ALMACEN_MATERIAL SET  ALMACEN_MATERIAL.cantidad_actual =  '$totally' WHERE  ALMACEN_MATERIAL.material_id ='$idProducto'  and ALMACEN_MATERIAL.almacen_id='$idAlmacen'");
	}
	else{
			$qery1=mysql_query("INSERT INTO  ALMACEN_MATERIAL(almacen_id, material_id, cantidad_actual) VALUES  (
				'$idAlmacen',
				'$idProducto',
				'$cantidadUpdate'
				)");
	}

	$sql="UPDATE DETALLE_PEDIDO set cantidad_surtida_produccion=".$total." where detalle_pedido_id=".$detallePedido_id;
	$res=mysql_query($sql);
	if($res)
		{ 
			echo "Cantidad actualizada.";
		}
		else
			{
		 	 $id_recot=0;
			 printf("Error:".mysql_error());
			}
	
	/* HISTORICO */
						$query_historial=mysql_query("INSERT INTO  HISTORICO(cantidad, id_producto, id_almacen, usuario, id_pedido ) VALUES  (
				$cantidadUpdate,
				$idProducto,
				1,
				'$user',
				$id_pedido
				)");
						

 }
 function solicitarCompras(){
	$almacenID=$_POST['idAlmacen'];
	$usuarioID=$_POST['idUsuario'];
	$productoID=$_POST['idProducto'];
	$cantidadSol=$_POST['cantidadSol'];
	$observaciones=$_POST['observ'];
	$id_pedido=$_POST['idPedido'];
	$folio=$_POST['folio'];

	require("../Conexion/conexion_prueba_local.php");	
	$link=conect();

$qry2=mysql_query("INSERT INTO taller_solicitud (taller_solicitud_id, taller_id, fecha_creacion, usuario_id_solicitante, almacen_id,
 usuario_id_autorizador, fecha_autorizacion, motivo, pedido_id, status, folio) VALUES 
(NULL, '1', CURDATE( ), '', '$almacenID', '', NULL, '$observaciones', '$id_pedido', '0', '$folio')");

$qryfetch=mysql_query("select taller_solicitud_id from taller_solicitud where folio= '$folio'");
$fetch=mysql_fetch_array($qryfetch);
$taller_solicitud_id=$fetch['taller_solicitud_id'];

$qry3=mysql_query("INSERT INTO detalle_taller_solicitud (detalle_taller_solicitud_id, producto_id, cantidad_solicitada)
 VALUES ('$taller_solicitud_id', '$productoID', '$cantidadSol')");

$qry1=("UPDATE  almacen_material SET  solicitud =  '$cantidadSol' WHERE  almacen_material.almacen_material_id like '$productoID' ");
	if($qry1=1 && $qry3=1 && $qry2==1)
echo "SE HA PEDIDO EL MATERIAL AL INVENTARIO EXITOSAMENTE!";
else
  echo "FALLO EL  PEDIDO DE MATERIAL AL INVENTARIO";
 }
 function revisar_status_pedido($id_pedido){
 
			$num_completos=0; // numero de prioductos completos
			$query1="SELECT detalle_pedido_status from DETALLE_PEDIDO   where detalle_pedido_status=1 and pedido_id=".$id_pedido;
			$result1 = mysql_query($query1);
			$num_completos = mysql_num_rows($result1);
			
			
			$num_incompletos=0; //numero de productos incompletos
			$query2="SELECT detalle_pedido_status from DETALLE_PEDIDO   where detalle_pedido_status=0 and pedido_id=".$id_pedido;
			$result2 = mysql_query($query2);
			$num_incompletos = mysql_num_rows($result2);
			
			$total_prod_pedido=0; // numero total de productos en el pedido
			$query3="SELECT detalle_pedido_status from DETALLE_PEDIDO   where pedido_id=".$id_pedido;
			$result3 = mysql_query($query3);
			$total_prod_pedido = mysql_num_rows($result3);
			
			if($num_completos==$total_prod_pedido){ // el pedido esta COMPLETO por lo tanto actualiza el estado del pedido
				$sql_upd="UPDATE PEDIDO set pedido_estado= 1 where pedido_id=".$id_pedido;
				$res_upd=mysql_query($sql_upd);
				if($res_upd)
					{ 
						echo "El pedido a sido completado";
					}
					else
						{
						 printf("Error:".mysql_error());
						}
			
			}else{
				if($num_completos<$total_prod_pedido){ // El pedido aun no ha sido completado
					$sql_upd1="UPDATE PEDIDO set pedido_estado= 1 where pedido_id=".$id_pedido;
					$res_upd1=mysql_query($sql_upd1);
			
				}
			}
					
}
?>
   