
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
	$almacen_id = $_POST['almacen_id'];
	$material_id = $_POST['material_id'];
	$cantidad_actual = $_POST['cantidad_nueva'];
	$total=$cantidadUpdate + $cantidadSurtida;
	require("../Conexion/conexion_prueba_local.php");	
	$link=conect();
	$sql="update DETALLE_PEDIDO set cantidad_surtida=".$total." where detalle_pedido_id=".$detallePedido_id;
	$res=mysql_query($sql);
		 if ($res){
				$sql2="UPDATE DETALLE_PEDIDO set detalle_pedido_status=3 where detalle_pedido_id=".$detallePedido_id; // Status Completo
				$res2=mysql_query($sql2);

				if ($res2){
				$sql3="UPDATE ALMACEN_MATERIAL set cantidad_actual=".$cantidad_actual." WHERE almacen_id = ".$almacen_id." AND material_id = ".$material_id."";
				 // Status Completo
				$res3=mysql_query($sql3);

				if($res3)	
					{	echo "Cantidad surtida correctamente";	}
					else
						{
						 $id_recot=0;
						 printf("Error:".mysql_error());
						}

		 }
		}
$cantidad_almacen = $cantidadUpdate * -1;
		/* HISTORICO */
							$departamento = "NOTA_SALIDA";
							$sql = "SELECT parametro_1 from PARAMETROS where parametro_var='".$departamento."'";
               
                  $res=mysql_query($sql);
                  if($res&&mysql_num_rows($res)>0)                  {
                          $row=mysql_fetch_row($res);
                          $folio_previo =  $row[0];
                  }

     
                 

			$folio_nuevo = $folio_previo + 1;
			$sql = "UPDATE PARAMETROS set parametro_1=".$folio_nuevo."  where parametro_var='".$departamento."'";
		 $res=mysql_query($sql);


						$query_historial=mysql_query("INSERT INTO  HISTORICO(cantidad, id_producto, id_almacen, usuario, id_pedido, nota_salida ) VALUES  (
				$cantidad_almacen,
				$material_id,
				1,
				'$user',
				$detallePedido_id,
				$folio_nuevo
				)");
		
		  revisar_status_pedido($id_pedido);
 }
		 
 
 function ok_incompleto(){
 	$user=$_POST['usuario'];
	$detallePedido_id=$_POST['idDetPed'];
	$cantidadUpdate=$_POST['cantiadUpd'];
	$resultado=$_POST['resultado'];
	$cantidadSurtida=$_POST['cantSurtida'];
	$almacen_id = $_POST['almacen_id'];
	$material_id = $_POST['material_id'];
	$id_pedido=$_POST['Idpedido'];
	$cantidad_actual = $_POST['cantidad_nueva'];
	$total=$cantidadUpdate+$cantidadSurtida;
	require("../Conexion/conexion_prueba_local.php");	
	$link=conect();
	$sql="update DETALLE_PEDIDO set cantidad_surtida=".$total." where detalle_pedido_id=".$detallePedido_id;
	$res=mysql_query($sql);
	if ($res){
				$sql3="UPDATE ALMACEN_MATERIAL set cantidad_actual=".$cantidad_actual." WHERE almacen_id = ".$almacen_id." AND material_id = ".$material_id."";
				 // Status Completo
				$res3=mysql_query($sql3);
					if($res3)
						{ 
							echo "Cantidad surtida correctamente. ";
						}
						else
							{
						 	 $id_recot=0;
							 printf("Error:".mysql_error());
							}
$cantidad_almacen = $cantidadUpdate * -1;
		/* HISTORICO */
		$departamento = "NOTA_SALIDA";
		$sql = "SELECT parametro_1 from PARAMETROS where parametro_var='".$departamento."'";
               
                  $res=mysql_query($sql);
                  if($res&&mysql_num_rows($res)>0){
                          $row=mysql_fetch_row($res);
                          $folio_previo =  $row[0];
                  }
                  
			$folio_nuevo = $folio_previo + 1;
			$sql = "UPDATE PARAMETROS set parametro_1=".$folio_nuevo."  where parametro_var='".$departamento."'";
		 $res=mysql_query($sql);


						$query_historial=mysql_query("INSERT INTO  HISTORICO(cantidad, id_producto, id_almacen, usuario, id_pedido, nota_salida ) VALUES  (
				$cantidad_almacen,
				$material_id,
				1,
				'$user',
				$detallePedido_id,
				$folio_nuevo
				)");
		
	}
		
 }
 function solicitarCompras(){
	$almacenID=$_POST['idAlmacen'];
	$usuarioID=$_POST['idUsuario'];
	$productoID=$_POST['idProducto'];
	$cantidadSol=$_POST['cantidadSol'];
	$observaciones=$_POST['observ'];
	require("../Conexion/conexion_prueba_local.php");	
	$link=conect();

	$qry=mysql_query("UPDATE ALMACEN_MATERIAL SET  solicitud =  '$cantidadSol' WHERE  almacen_material.almacen_material_id like '$productoID'");
	if($qry=1)
  echo "SE HA SOLICITADO EL MATERIAL A COMPRAS CORRECTAMENTE!";
else
  echo "FALLO LA SOLICITUD A COMPRAS";
	
 }
 function revisar_status_pedido($id_pedido){
 
			$num_completos=0; // numero de prioductos completo
			$query1="select detalle_pedido_status from DETALLE_PEDIDO   where detalle_pedido_status=1 and pedido_id=".$id_pedido;
			$result1 = mysql_query($query1);
			$num_completos = mysql_num_rows($result1);
			
			
			$num_incompletos=0; //numero de productos incompletos
			$query2="select detalle_pedido_status from DETALLE_PEDIDO   where detalle_pedido_status=0 and pedido_id=".$id_pedido;
			$result2 = mysql_query($query2);
			$num_incompletos = mysql_num_rows($result2);
			
			$total_prod_pedido=0; // numero total de productos en el pedido
			$query3="select detalle_pedido_status from DETALLE_PEDIDO   where pedido_id=".$id_pedido;
			$result3 = mysql_query($query3);
			$total_prod_pedido = mysql_num_rows($result3);
			
			if($num_completos==$total_prod_pedido){ // el pedido esta COMPLETO por lo tanto actualiza el estado del pedido
				$sql_upd="update PEDIDO set pedido_estado= 2 where pedido_id=".$id_pedido;
				$res_upd=mysql_query($sql_upd);
				if($res_upd)
					{ 
						echo " El Pedido a sido completado " ;
					}
					else
						{
						 printf("Error:".mysql_error());
						}
			
			}else{
				if($num_completos<$total_prod_pedido){ // El pedido aun no ha sido completado
					$sql_upd1="update PEDIDO set pedido_estado= 1 where pedido_id=".$id_pedido;
					$res_upd1=mysql_query($sql_upd1);
					if($res_upd1)
						{ 
							//echo " El Pedido aún no ha sido completado";
							echo " ";
						}
						else
							{
							 printf("Error:".mysql_error());
							}
				}
			}
					
}
?>
   