<?
      class Almacen_Taller
        {
          private $link;        
          function __construct()
          {
                 
          }
          function conexion($link_bd)
          {
                  $link=$link_bd;
          }
          


	   function update_almacen_taller(
	   	$orden,
	   	$almacen_material_id,
		   $cantidad,
		   $status
		)	
		{

			$sql = "UPDATE TALLER_SOLICITUD set cantidad_surtida=".$cantidad.", status=".$status." where taller_solicitud_id=".$orden."";
		  	$res=mysql_query($sql);


			$sql = "UPDATE ALMACEN_MATERIAL set cantidad_actual=cantidad_actual-".$cantidad." where almacen_material_id=".$almacen_material_id."";
		  	$res=mysql_query($sql);


			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
	  		




 function result_pedidos($search, $inicio, $fin)
		  
          {
          		$search= str_replace(' ', '%', $search);
				$sql="SELECT 
				PEDIDO.pedido_id, 
				PEDIDO.cotizacion_id, 
				CLIENTE.cliente_razonsocial, 
				PEDIDO.pedido_fecha_creacion, 
				PEDIDO.pedido_fecha_entrega,
				PEDIDO.pedido_estado, 
				PEDIDO.folio_pedido, 
				COTIZACION.cotizacion_folio, 
				SUM(DP.cantidad_surtida), 
				SUM(DP.cantidad),
					PEDIDO.logistica_solicitud,
                     (SELECT COUNT(*) from DETALLE_PEDIDO DT where DT.cantidad_surtida_produccion <> DT.cantidad AND DP.almacen_id<>1 AND DP.detalle_pedido_status<>15 AND DT.`pedido_id` = DP.`pedido_id`) SUMATORIA
					FROM DETALLE_PEDIDO DP, PEDIDO, CLIENTE, COTIZACION where (
						DP.detalle_pedido_status=1 or 
						DP.detalle_pedido_status=0 or 
						DP.detalle_pedido_status=3 or
						DP.detalle_pedido_status=2)  and 
					PEDIDO.pedido_id = DP.pedido_id and 
					COTIZACION.cliente_id=CLIENTE.cliente_id AND 
					PEDIDO.cotizacion_id=COTIZACION.cotizacion_id 
					GROUP BY PEDIDO.pedido_id, DP.almacen_id, DP.detalle_pedido_status ORDER BY PEDIDO.pedido_id DESC";

					 if(!empty($search))
		  {
		   $sql="SELECT 
				PEDIDO.pedido_id, 
				PEDIDO.cotizacion_id, 
				CLIENTE.cliente_razonsocial, 
				PEDIDO.pedido_fecha_creacion, 
				PEDIDO.pedido_fecha_entrega,
				PEDIDO.pedido_estado, 
				PEDIDO.folio_pedido, 
				COTIZACION.cotizacion_folio, 
				SUM(DP.cantidad_surtida), 
				SUM(DP.cantidad),
					PEDIDO.logistica_solicitud,
                     (SELECT COUNT(*) from DETALLE_PEDIDO DT where DT.cantidad_surtida_produccion <> DT.cantidad AND DP.almacen_id<>1 AND DP.detalle_pedido_status<>15 AND DT.`pedido_id` = DP.`pedido_id`) SUMATORIA
					FROM DETALLE_PEDIDO DP, PEDIDO, CLIENTE, COTIZACION where CLIENTE.cliente_razonsocial like '%".$search."%' AND (
						DP.detalle_pedido_status=1 or 
						DP.detalle_pedido_status=0 or 
						DP.detalle_pedido_status=3 or
						DP.detalle_pedido_status=2)  and 
					PEDIDO.pedido_id = DP.pedido_id and 
					COTIZACION.cliente_id=CLIENTE.cliente_id AND 
					PEDIDO.cotizacion_id=COTIZACION.cotizacion_id 
					GROUP BY PEDIDO.pedido_id ORDER BY PEDIDO.pedido_id DESC
					
					";

		  }
				$sql=$sql." LIMIT $inicio, $fin";
				  $res=mysql_query($sql);
				  $renglones=mysql_num_rows($res);
				  $cont_array=0;
				  $array=array(); // create new empty array
				  	
					  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11]);
				  $edo=''; $etiqueta='';
			  if($row[8]==$row[9]){
						$edo='verde';
							$etiqueta='Listo';
					} 
		     else if ($row[8]==0)

					{
							$edo='rojo';
						$etiqueta='Sin atender';

						}
				else  if ($row[11]>0){
						$edo='amarillo_almacen';
						$etiqueta='Surtido Parcial';
				}
				else
				{

						$edo='medio';
						$etiqueta='Surtido Parcial';
				}		

				  		$array[$cont_array][5]='
				  		<center>
				  		<a href="almacen_detalle_ordenSalida.php?var='.$row[0].'&var2='.$row[1].'">
				  		<img src="../imagenes/'.$edo.'.png"  title="'.$etiqueta.'"/>
				  		</a>
				  		</center>';

				  //echo "".$array[$cont_array][0];

				  		if ($array[$cont_array][10]==0)
										$solicitudes_transportes = 	"<center><INPUT type='checkbox' id='checkenvio'  name='checkenvio' value='".$row[0]."' /></center>" ;
								else
									$solicitudes_transportes = 	"<center><INPUT type='checkbox' id='checkenvio' style='opacity:0; position:absolute; left:9999px;'  name='checkenvio' value='".$row[0]."' /></center>" ;				

								$array[$cont_array][10] = 	$solicitudes_transportes;

				  $cont_array++;
			  }
			  

					return $array;
		  }
		  else
		  	  return null;
		  
		  
	  }
function result_pedidos_Autorizacion($search, $inicio, $fin)
		  
          {
          		$search= str_replace(' ', '%', $search);
				$sql="SELECT PEDIDO.pedido_id, 
				PEDIDO.cotizacion_id, 
				CLIENTE.cliente_razonsocial, 
				PEDIDO.pedido_fecha_creacion, 
				PEDIDO.pedido_fecha_entrega,
				PEDIDO.pedido_estado, 
				PEDIDO.folio_pedido, 
				COTIZACION.cotizacion_folio, 
				SUM(DETALLE_PEDIDO.cantidad_surtida), 
				SUM(DETALLE_PEDIDO.cantidad) 
					FROM DETALLE_PEDIDO, PEDIDO, CLIENTE, COTIZACION where (
					DETALLE_PEDIDO.detalle_pedido_status=15)  and 
					PEDIDO.pedido_id = DETALLE_PEDIDO.pedido_id and 
					PEDIDO.pedido_estado = 1 and 
					COTIZACION.cliente_id=CLIENTE.cliente_id AND 
					PEDIDO.cotizacion_id=COTIZACION.cotizacion_id AND
					CLIENTE.cliente_razonsocial like '%".$search."%'
					GROUP BY PEDIDO.pedido_id";

				$sql=$sql." LIMIT $inicio, $fin";
				  $res=mysql_query($sql);
				  $renglones=mysql_num_rows($res);
				  $cont_array=0;
				  $array=array(); // create new empty array
				  
					  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4],$row[5],$row[6],$row[7],$row[8],$row[9]);
				  $edo=''; $etiqueta='';
			  if($row[8]==$row[9]){
						$edo='verde';
							$etiqueta='Listo';
					} 
		     else if ($row[8]==0)

					{
							$edo='rojo';
						$etiqueta='Sin atender';

						}
				else
				
				{

						$edo='medio';
						$etiqueta='Surtido Parcial';
				}		

				  		$array[$cont_array][5]='<center><a href="almacen_detalle_ordenSalida_Autorizacion.php?var='.$row[0].'&var2='.$row[1].'"><img src="../imagenes/'.$edo.'.png"  title="'.$etiqueta.'"/></a>	</center>';

				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  

					}

						
			  return $array;
		  
		  
	  }
 function result_pedidos_taller_busqueda($search, $inicio, $fin)
		  
          {
          		$search= str_replace(' ', '%', $search);
				$sql="SELECT 
				PEDIDO.pedido_id, 
				PEDIDO.cotizacion_id, 
				CLIENTE.cliente_razonsocial, 
				PEDIDO.pedido_fecha_creacion, 
					PEDIDO.pedido_fecha_entrega,
					PEDIDO.pedido_estado, 
					PEDIDO.folio_pedido, 
					COTIZACION.cotizacion_folio, 
					SUM(DETALLE_PEDIDO.cantidad_surtida), 
					SUM(DETALLE_PEDIDO.cantidad),
					PEDIDO.logistica_solicitud
					FROM DETALLE_PEDIDO, PEDIDO, CLIENTE, COTIZACION where (
						DETALLE_PEDIDO.detalle_pedido_status=1 or 
						DETALLE_PEDIDO.detalle_pedido_status=2 or 
						DETALLE_PEDIDO.detalle_pedido_status=3) and 
					PEDIDO.pedido_id = DETALLE_PEDIDO.pedido_id and 
					COTIZACION.cliente_id=CLIENTE.cliente_id AND 
					PEDIDO.cotizacion_id=COTIZACION.cotizacion_id  
					 GROUP BY PEDIDO.pedido_id";

				$sql=$sql." LIMIT $inicio, $fin";
				  $res=mysql_query($sql);
				  $renglones=mysql_num_rows($res);
				  $cont_array=0;
				  $array=array(); // create new empty array
				  
					  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10]);
				  $edo=''; $etiqueta='';
			  if($row[8]==$row[9]){
						$edo='verde';
							$etiqueta='Listo';
					} 
		     else if ($row[8]==0)

					{
							$edo='rojo';
						$etiqueta='Sin atender';

						}
				else
				
				{

						$edo='medio';
						$etiqueta='Surtido Parcial';
				}		

				  		$array[$cont_array][5]='<center><a href="taller_detalle_ordensalida.php?var='.$row[0].'&var2='.$row[1].'"><img src="../imagenes/'.$edo.'.png"  title="'.$etiqueta.'"/></a></center>';
				  //echo "".$array[$cont_array][0];
				  				if ($array[$cont_array][10]==0)
										$solicitudes_transportes = 	"<center><INPUT type='checkbox' id='checkenvio'  name='checkenvio' value='".$row[0]."' /></center>" ;
								else
									$solicitudes_transportes = 	"<center><INPUT type='checkbox' id='checkenvio' style='opacity:0; position:absolute; left:9999px;'  name='checkenvio' value='".$row[0]."' /></center>" ;				

								$array[$cont_array][10] = 	$solicitudes_transportes;
				  $cont_array++;
			  }
			  

					}

						
			  return $array;
		  
		  
	  }
   	  function cuenta_resultado($search)
	  {
		  $search= str_replace(' ', '%', $search);
				$sql= "SELECT DISTINCT PEDIDO.pedido_id, PEDIDO.cotizacion_id,  PEDIDO.folio_pedido, PEDIDO.pedido_fecha_creacion, 
					PEDIDO.pedido_fecha_entrega, PEDIDO.pedido_estado, CLIENTE.cliente_razonsocial,COTIZACION.cotizacion_folio 
					FROM DETALLE_PEDIDO, PEDIDO, CLIENTE, COTIZACION where (PEDIDO.pedido_id like'%".$search."%' or PEDIDO.cotizacion_id like '%".$search."%'or PEDIDO.pedido_fecha_creacion like '%".$search."%')
					 AND  PEDIDO.pedido_id = DETALLE_PEDIDO.pedido_id 
					 AND  PEDIDO.cotizacion_id = COTIZACION.cotizacion_id 
					 AND 	COTIZACION.cliente_id = CLIENTE.cliente_id
					 and  DETALLE_PEDIDO.detalle_pedido_status<=3";
		
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }

	     	  function cuenta_resultado_taller($search)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT PEDIDO.pedido_id from PEDIDO where pedido_id like '%".$search."%'";
		
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
  
   function result_detalle_pedido1($id_pedido) //para almacen
		  
          {
				$output="";
				$edo='';
				$qry = mysql_query("SELECT PEDIDO.pedido_id, 
					PEDIDO.cotizacion_id,  
					PEDIDO.folio_pedido, 
					PEDIDO.pedido_fecha_creacion, 
					PEDIDO.pedido_fecha_entrega,
					PEDIDO.pedido_estado, 
					PEDIDO.pedido_obs, 
					PEDIDO.sucursal_id, 
					CLIENTE.cliente_id,
					CLIENTE.cliente_razonsocial 
				 FROM PEDIDO, COTIZACION, CLIENTE
				 WHERE PEDIDO.cotizacion_id=COTIZACION.cotizacion_id and COTIZACION.cliente_id = CLIENTE.cliente_id and 
				 PEDIDO.pedido_id =".$id_pedido."");
				$resultado=array();
				if($resu1t = mysql_fetch_object($qry)){
					$resultado['pedidoId']= $resu1t->pedido_id;
					$resultado['cotizacionId']= $resu1t->cotizacion_id;
					$resultado['folioPedido']=  $resu1t->folio_pedido;
					$resultado['fechaCreacion']= $resu1t->pedido_fecha_creacion;
					$resultado['fechaEntrega']= $resu1t->pedido_fecha_entrega;
					$resultado['cliente_razonsocial']=$resu1t->cliente_razonsocial;
					$edo=$resu1t->pedido_estado;
					$resultado['observaciones']=$resu1t->pedido_obs;
					$sucursal=$resu1t->sucursal_id;
					$resultado['sucursalName']=$resu1t->sucursal_id;


					if ($resu1t->sucursal_id){

					$qry_sucursal=mysql_query("SELECT SUCURSAL.clave_nombre, CLIENTE.cliente_razonsocial FROM SUCURSAL, CLIENTE where  SUCURSAL.cliente_id = CLIENTE.cliente_id and SUCURSAL.sucursal_id=".$sucursal);
					
					if($resu1t_suc = mysql_fetch_object($qry_sucursal)){
						$resultado['sucursalName']=$resu1t_suc->clave_nombre;
						$resultado['razonsocial']=$resu1t_suc->cliente_razonsocial;
					}
					}
					if($edo==0){
						//$etiqueta='<img src="../imagenes/rojo.png"  title="Cambiar estado" onClick=cambiar_edo()/>';
						$etiqueta='
							<div class="result">
								  Sin atender
							</div>
						';
						
					}else{
						if($edo==1){
							//$etiqueta='<img src="../imagenes/amarillo.png"  title="Cambiar estado"/>';
							$etiqueta='
							<div class="result">
								  En proceso
								
							</div>
						';
						} else{
							//$etiqueta='<img src="../imagenes/verde.png"  title="Cambiar estado"/>';
							$etiqueta='
							<div class="result">
								Listo
							</div>
						';
						}
					}
					$resultado['pedidoEdo']= $etiqueta;
					
					}
					
					
				return $resultado;
          }
		


 function result_detalle_pedido2($v1,$tipo_pedido) //filtro para almacen
		  
          {
				$result_detalle=array();


				
				$output="";
				$qry = mysql_query("SELECT DETALLE_PEDIDO.detalle_pedido_id , 
		  		  DETALLE_PEDIDO.producto_id,
				  DETALLE_PEDIDO.cantidad,
				  DETALLE_PEDIDO.pedido_id ,
				  DETALLE_PEDIDO.precio_venta,
				  DETALLE_PEDIDO.detalle_pedido_obs,
				  DETALLE_PEDIDO.multiplo,
				  MATERIAL.material_descripcion,
				  MATERIAL.material_maquila,
				  UNIDADES.prefijo,
				  PEDIDO.pedido_estado,
				  DETALLE_PEDIDO.cantidad_surtida,
				  DETALLE_PEDIDO.cantidad_surtida_produccion,
				  DETALLE_PEDIDO.detalle_pedido_id,
				  DETALLE_PEDIDO.pedido_id,
				  ALMACEN_MATERIAL.cantidad_actual,
				  DETALLE_PEDIDO.pedido_tipo,
				  MATERIAL.idSAE,
				  MATERIAL_TIPO.nombre ,	
				  ALMACEN.tipo
				  from DETALLE_PEDIDO, MATERIAL, UNIDADES, PEDIDO, ALMACEN_MATERIAL, MATERIAL_TIPO, ALMACEN  
				  where 
				  MATERIAL.material_id=DETALLE_PEDIDO.producto_id AND 
				  UNIDADES.id_unidad=MATERIAL.id_unidad and 	
				  PEDIDO.pedido_id=DETALLE_PEDIDO.pedido_id AND 
				  ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND
				  MATERIAL.material_tipo = MATERIAL_TIPO.material_tipo AND
				  ALMACEN.almacen_id = DETALLE_PEDIDO.almacen_id AND 
				  DETALLE_PEDIDO.pedido_id=".$v1." 
				  GROUP BY DETALLE_PEDIDO.detalle_pedido_id, ALMACEN_MATERIAL.cantidad_actual
				  ");
				
				$edo=''; $etiqueta='';
				
				while($res = mysql_fetch_object($qry)){	
					$result_detalle['clave']= $res->producto_id;
					$result_detalle['claveSAE']= $res->idSAE;
					$result_detalle['producto']= $res->material_descripcion;
					$result_detalle['cantidad']= $res->cantidad;
					$result_detalle['unidad']= $res->prefijo;
					$result_detalle['observ']= $res->detalle_pedido_obs;
					$status_prod=$res->pedido_estado;
					$result_detalle['cantidadSurt']=$res->cantidad_surtida;
					$result_detalle['cantidad_producida']=$res->cantidad_surtida_produccion;
					$result_detalle['detallePedidoId']=$res->detalle_pedido_id;
					$result_detalle['pedidoID']=$res->pedido_id;
					$maquila['material_maquila']=$res->material_maquila;
					$cantidadPedida['cantidad']=$res->cantidad;
					$cantidad_actual['cantidad_actual']=$res->cantidad_actual;
					$result_detalle['pedido_tipo']=$res->pedido_tipo;
					$idProd=$result_detalle['clave'];
					$result_detalle['material_tipo']= $res->nombre;
					$result_detalle['tipo']= $res->tipo;
					if ($status_prod<=1 && $maquila['material_maquila']==0 && $result_detalle['cantidadSurt']==0){
								$edo='rojo'; //-----Incompleto
								if ($result_detalle['tipo']==0)
								$etiqueta='<a rel="shadowbox;width=960;height=340;"  href="surtir_pzas.php?var='.$result_detalle['clave'].'&var2='.$result_detalle['cantidad'].'&var3='.$result_detalle['cantidadSurt'].'&var4='.$result_detalle['producto'].'&var5='.$result_detalle['detallePedidoId'].'&var6='.$result_detalle['pedidoID'].'&var_tipo='.$result_detalle['pedido_tipo'].'"><img src="../imagenes/rojo.png"  title="Incompleto"/></a>';
						else
										$etiqueta='<img src="../imagenes/amarillo_almacen.png"  title="Incompleto"/>';

								if ($tipo_pedido != $result_detalle['pedido_tipo'])

									$etiqueta_envío = 	"<INPUT type='checkbox' id='checkenvio' cant_mat='".$result_detalle['cantidad']."' cant_exis='".$cantidad_actual['cantidad_actual']."' cant_surt='".$result_detalle['cantidadSurt']."'  id_mat='".$result_detalle['clave']."'  name='checkenvio' value='".$result_detalle['detallePedidoId']."' />" ;
										/*$etiqueta_envío = 	"<INPUT type='checkbox' id='checkenvio'  name='checkenvio' cantidad='".$result_detalle['cantidad']."' value='".$result_detalle['detallePedidoId']."' />" ;*/
								else
									$etiqueta_envío = 	"<INPUT type='checkbox' id='checkenvio' style='opacity:0; position:absolute; left:9999px;'  name='checkenvio' cantidad='".$result_detalle['cantidad']."' value='".$result_detalle['detallePedidoId']."' />" ;						
								$val_td='';
					}

					else{
							if($status_prod>=1 && $maquila['material_maquila']==0 && $result_detalle['cantidadSurt']==$cantidadPedida['cantidad'] ){ //-----Completo
								$edo='verde';
								$etiqueta='<img src="../imagenes/verde.png"  title="Completo"/>';

							}
							else {

								if ($status_prod<=1 && $maquila['material_maquila']==0 && $result_detalle['cantidadSurt']<$cantidadPedida['cantidad'])
								{

									$edo='medio';
									if ($result_detalle['tipo']==0)
									$etiqueta='<a rel="shadowbox;width=960;height=340;"  href="surtir_pzas.php?var='.$result_detalle['clave'].'&var2='.$result_detalle['cantidad'].'&var3='.$result_detalle['cantidadSurt'].'&var4='.$result_detalle['producto'].'&var5='.$result_detalle['detallePedidoId'].'&var6='.$result_detalle['pedidoID'].'&var_tipo='.$result_detalle['pedido_tipo'].'"><img src="../imagenes/medio.png"  title="Incompleto"/></a>';
								else
										$etiqueta='<img src="../imagenes/rojo.png"  title="Incompleto"/>';

								if ($tipo_pedido != $result_detalle['pedido_tipo'])
										$etiqueta_envío = 	"<INPUT type='checkbox' id='checkenvio' cant_mat='".$result_detalle['cantidad']."' cant_exis='".$cantidad_actual['cantidad_actual']."' cant_surt='".$result_detalle['cantidadSurt']."'  id_mat='".$result_detalle['clave']."'  name='checkenvio' value='".$result_detalle['detallePedidoId']."' />" ;
								else
									$etiqueta_envío = 	"<INPUT type='checkbox' id='checkenvio' style='opacity:0; position:absolute; left:9999px;'  name='checkenvio' cantidad='".$result_detalle['cantidad']."' value='".$result_detalle['detallePedidoId']."' />" ;						
								$val_td='';
								}
								else{
									if($maquila['material_maquila']==1 )
									$edo='taller';
									$etiqueta='<img src="../imagenes/taller1.png"  title="En Taller"/>';
									}
								}
									$etiqueta_envío="";
					}  //else
							

							if ($result_detalle['tipo']==0)
					{
						$negrita_abre = '<b>';
						$negrita_cierra = '</b>';
					}
					else
					{
						$negrita_abre = '';
						$negrita_cierra = '';
					}

						$etiqueta_envío = 	"<INPUT type='checkbox' id='checkenvio' cant_mat='".$result_detalle['cantidad']."' cant_exis='".$cantidad_actual['cantidad_actual']."' cant_surt='".$result_detalle['cantidadSurt']."'  id_mat='".$result_detalle['clave']."'  name='checkenvio' value='".$result_detalle['detallePedidoId']."' />" ;

					$output.='<tr>  
									
							<td><center>'.$etiqueta_envío.'</center></td>
							<td>'.$negrita_abre.$result_detalle['material_tipo'].$negrita_cierra.'</td>
							<td>'.$negrita_abre.$result_detalle['producto'].$negrita_cierra.'</td><!--  //material_descripcion -->
							<td>'.$negrita_abre.$result_detalle['cantidad'].$negrita_cierra.'</td><!--  //cantidad -->
							<td>'.$negrita_abre.$result_detalle['unidad'].$negrita_cierra.'</td><!--  //prefijo-->
							<td>'.$negrita_abre.$result_detalle['cantidadSurt'].$negrita_cierra.'</td>
							<td>'.$negrita_abre.$result_detalle['cantidad_producida'].$negrita_cierra.'</td>
							<td><center>'.$etiqueta.'</center></td>
							<td>'.$negrita_abre.$cantidad_actual['cantidad_actual'].$negrita_cierra.'</td>

									
							<td><a href="javascript:crear_orden({id:'.$result_detalle['detallePedidoId'].'})">Crear Orden</a></td>

									<td><center><a href="javascript:ver_ordenes({id:'.$result_detalle['detallePedidoId'].'})">Ver</a></center></td>
						
					
					';


				
				}//FIN WHILE
				return $output;
          }
		  
	function result_detalle_pedido2_AUTORIZACION($v1,$tipo_pedido) //filtro para almacen
		  
          {
				$result_detalle=array();


				
				$output="";
				$qry = mysql_query("SELECT DETALLE_PEDIDO.detalle_pedido_id , 
		  		  DETALLE_PEDIDO.producto_id,
				  DETALLE_PEDIDO.cantidad,
				  DETALLE_PEDIDO.pedido_id,
				  DETALLE_PEDIDO.precio_venta,
				  DETALLE_PEDIDO.detalle_pedido_obs,
				  DETALLE_PEDIDO.multiplo,
				  MATERIAL.material_descripcion,
				  MATERIAL.material_maquila,
				  UNIDADES.prefijo,
				  PEDIDO.pedido_estado,
				  DETALLE_PEDIDO.cantidad_surtida,
				  DETALLE_PEDIDO.detalle_pedido_id,
				  DETALLE_PEDIDO.pedido_id,
				  ALMACEN_MATERIAL.cantidad_actual,
				  DETALLE_PEDIDO.pedido_tipo,
				  MATERIAL.idSAE,
				  MATERIAL_TIPO.nombre,
				  DETALLE_PEDIDO.detalle_pedido_status 
				  from DETALLE_PEDIDO, MATERIAL, UNIDADES, PEDIDO, ALMACEN_MATERIAL, MATERIAL_TIPO 
				  where DETALLE_PEDIDO.pedido_id=".$v1." AND 
				  MATERIAL.material_id=DETALLE_PEDIDO.producto_id AND 
				  UNIDADES.id_unidad=MATERIAL.id_unidad and 
				  PEDIDO.pedido_id=DETALLE_PEDIDO.pedido_id AND 
				  ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND 
				  MATERIAL.material_tipo = MATERIAL_TIPO.material_tipo  
				  GROUP BY DETALLE_PEDIDO.detalle_pedido_id, ALMACEN_MATERIAL.cantidad_actual");
				
				$edo=''; $etiqueta='';
				
				while($res = mysql_fetch_object($qry)){	
					$result_detalle['clave']= $res->producto_id;
					$result_detalle['claveSAE']= $res->idSAE;
					$result_detalle['producto']= $res->material_descripcion;
					$result_detalle['cantidad']= $res->cantidad;
					$result_detalle['unidad']= $res->prefijo;
					$result_detalle['observ']= $res->detalle_pedido_obs;
					$status_prod=$res->pedido_estado;
					$result_detalle['cantidadSurt']=$res->cantidad_surtida;
					$result_detalle['cantidad_producida']=$res->cantidad_surtida;
					$result_detalle['detallePedidoId']=$res->detalle_pedido_id;
					$result_detalle['pedidoID']=$res->pedido_id;
					$maquila['material_maquila']=$res->material_maquila;
					$cantidadPedida['cantidad']=$res->cantidad;
					$cantidad_actual['cantidad_actual']=$res->cantidad_actual;
					$result_detalle['pedido_tipo']=$res->pedido_tipo;
					$idProd=$result_detalle['clave'];
					$result_detalle['material_tipo']= $res->nombre;
					$result_detalle['detalle_pedido_status']= $res->detalle_pedido_status;

					if ($status_prod<=1 && $maquila['material_maquila']==0 && $result_detalle['cantidadSurt']<$cantidadPedida['cantidad']){
						$edo='rojo'; //-----Incompleto
						$etiqueta='<img src="../imagenes/rojo.png"  title="Incompleto"/>';

						$val_td='';
					}else{
						if($status_prod>=1 && $maquila['material_maquila']==0 && $result_detalle['cantidadSurt']==$cantidadPedida['cantidad'] ){ //-----Completo
							$edo='verde';
							$etiqueta='<img src="../imagenes/verde.png"  title="Completo"/>';

						}
						else{
							if($maquila['material_maquila']==1 )
							$edo='taller';
							$etiqueta='<img src="../imagenes/taller1.png"  title="En Taller"/>';
					
							}

$etiqueta_envío="";
					}  //else
				if (($result_detalle['detalle_pedido_status']==15))
						$etiqueta_envío = 	"
						<INPUT type='checkbox' id='checkenvio'  name='checkenvio' value='".$result_detalle['detallePedidoId']."' />
						
						" ;
						else
						$etiqueta_envío = 	"
						<INPUT type='checkbox' id='checkenvio'  name='checkenvio'  style='opacity:0; position:absolute; left:9999px;'   value='".$result_detalle['detallePedidoId']."' />
						
						" ;
					$output.='<tr>  
									<td><center>'.$etiqueta_envío.'</center></td>
							
						
							<td>'.$result_detalle['material_tipo'].'</td>
							<td>'.$result_detalle['producto'].'</td><!--  //material_descripcion -->
							<td>'.$result_detalle['cantidad'].'</td><!--  //cantidad -->
							<td>'.$result_detalle['unidad'].'</td><!--  //prefijo-->
						
							
							<td>'.$cantidad_actual['cantidad_actual'].'</td>
						
						</tr>
					   <input type="hidden" id="id_'.$result_detalle['clave'].'" value="'.$result_detalle['detallePedidoId'].'">
					
					';
				

				}//FIN WHILE
				return $output;
          }
		  
   function resultInventario($search, $inicio, $fin)
		  
          {
				 $search= str_replace(' ', '%', $search);

				$sql ="SELECT
				  ALMACEN_MATERIAL.solicitud,
				  MATERIAL.material_id,
				  MATERIAL.idSAE,
				  MATERIAL.material_descripcion,
				  ALMACEN.almacen_id,
				  ALMACEN.nombre,
				  ALMACEN_MATERIAL.almacen_material_id,
				  ALMACEN_MATERIAL.cantidad_actual,
				  ALMACEN_MATERIAL.minimo,
				  ALMACEN_MATERIAL.maximo,
				  UNIDADES.prefijo,
				  MATERIAL_TIPO.nombre 
				  FROM MATERIAL, ALMACEN,ALMACEN_MATERIAL,UNIDADES, MATERIAL_TIPO 
				  WHERE (MATERIAL.material_id like '%".$search."%' or MATERIAL.idSAE like '%".$search."%' or MATERIAL.material_descripcion
				  like '%".$search."%' ) AND
				  MATERIAL.material_id=ALMACEN_MATERIAL.material_id AND UNIDADES.id_unidad=MATERIAL.id_unidad AND
				  ALMACEN.almacen_id=ALMACEN_MATERIAL.almacen_id  order by solicitud desc,material_descripcion";
	
				  $sql=$sql." LIMIT $inicio, $fin";
				  $res=mysql_query($sql);
				  $renglones=mysql_num_rows($res);
				  $cont_array=0;
				  $array=array(); // create new empty array
				  
					  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0],$row[1], $row[2], $row[3], $row[3], $row[4],$row[5] ,$row[6] ,$row[7],$row[8],$row[9]);
				 $sol='';
			  if($row[0]==0){
									$array[$cont_array][0]='<td>';
					}	
					else{
									$array[$cont_array][0]='<td style="background: #760a02; center no-repeat;" align="center"><font color="white">'.$row[0];
					}

				  //echo "".$array[$cont_array][0];

				  $cont_array++;
			  }

			  
}
         return $array;
          }
		  
		  
		  
		  
		  
		   function result_pedidos_taller($search, $inicio, $fin) // para taller   
		  
          {
				$search= str_replace(' ', '%', $search);
				$sql= "SELECT DISTINCT 
				PEDIDO.pedido_id, 
				PEDIDO.cotizacion_id,  
				PEDIDO.folio_pedido, 
				DATE(PEDIDO.pedido_fecha_creacion), 
				DATE(PEDIDO.pedido_fecha_entrega), 
					PEDIDO.pedido_estado,
					 CLIENTE.cliente_razonsocial,
					 COTIZACION.cotizacion_folio,
                     (SELECT COUNT(*) from DETALLE_PEDIDO DT where DT.cantidad_surtida <> DT.cantidad AND DT.`pedido_id` = DP.`pedido_id`) SUMATORIA
					FROM DETALLE_PEDIDO DP, PEDIDO, CLIENTE, COTIZACION where (PEDIDO.pedido_id like'%".$search."%' or PEDIDO.cotizacion_id like '%".$search."%'or PEDIDO.pedido_fecha_creacion like '%".$search."%') AND PEDIDO.pedido_id = DP.pedido_id 
					 AND  PEDIDO.cotizacion_id = COTIZACION.cotizacion_id 
					 AND 	COTIZACION.cliente_id = CLIENTE.cliente_id
					 and  DP.detalle_pedido_status<=3";

				  $sql=$sql." LIMIT $inicio, $fin";
				 
				  $res=mysql_query($sql);
				  $renglones=mysql_num_rows($res);
				  $cont_array=0;
				  $array=array(); // create new empty array
				  
					  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4],$row[5],$row[6],$row[7],$row[8]);
				  $edo=''; $etiqueta='';
			  if($row[5]==0){
						$edo='rojo';
						$etiqueta='Sin atender';
					} else if($row[8]>0){

							$edo='amarillo_almacen';
							$etiqueta='Listo';

						}
						else 
						{
							$edo='verde';
							$etiqueta='Listo';
						}
				  		$array[$cont_array][5]='
				  		<center>
				  		<a href="taller_detalle_ordensalida.php?var='.$row[0].'&var2='.$row[1].'">

				  		<img src="../imagenes/'.$edo.'.png"  title="'.$etiqueta.'"/>

				  		</a>
				  		</center>';

				 
				  $cont_array++;
			  }
			  

					}

						
			  return $array;

          }
		  
		   function result_detalle_pedido_taller($v2) //para taller detalle de pedido
		  
        {
				$result_detalle=array();
				
				$output="";
				$qry = mysql_query("SELECT DETALLE_COTIZACION.detalle_cotizacion_id , 
		  		  DETALLE_COTIZACION.producto_id,
				  DETALLE_COTIZACION.cantidad ,
				  DETALLE_COTIZACION.cotizacion_id ,
				  DETALLE_COTIZACION.precio_venta,
				  DETALLE_COTIZACION.observaciones,
				  DETALLE_COTIZACION.multiplo,
				  MATERIAL.material_descripcion,
				  UNIDADES.prefijo,
				  PEDIDO.pedido_estado,
				  DETALLE_PEDIDO.cantidad_surtida,
				  DETALLE_PEDIDO.detalle_pedido_id,
				  DETALLE_PEDIDO.pedido_id,
				  MATERIAL.material_maquila,
				  MATERIAL_TIPO.nombre 
				  from DETALLE_COTIZACION, MATERIAL, UNIDADES, DETALLE_PEDIDO, PEDIDO, MATERIAL_TIPO 
				  where DETALLE_COTIZACION.cotizacion_id=".$v2." 
				  AND MATERIAL.material_id=DETALLE_COTIZACION.producto_id AND 
				  MATERIAL.material_tipo = MATERIAL_TIPO.material_tipo AND
				  UNIDADES.id_unidad=MATERIAL.id_unidad AND PEDIDO.pedido_id=DETALLE_PEDIDO.pedido_id");
				
				$edo=''; $etiqueta='';
				
				while($res = mysql_fetch_object($qry)){	
					$result_detalle['clave']= $res->producto_id;
					$result_detalle['producto']= $res->material_descripcion;
					$result_detalle['cantidad']= $res->cantidad;
					$result_detalle['unidad']= $res->prefijo;
					$result_detalle['observ']= $res->observaciones;
					$status_prod=$res->pedido_estado;
					$result_detalle['cantidadSurt']=$res->cantidad_surtida;
					$result_detalle['detallePedidoId']=$res->detalle_pedido_id;
					$result_detalle['pedidoID']=$res->pedido_id;
					$maquila['material_maquila']=$res->material_maquila;
					$cantidadPedida['cantidad']=$res->cantidad;
				$result_detalle['material_tipo']= $res->nombre;
					

					if ($status_prod<=1 && $maquila['material_maquila']==1 && $result_detalle['cantidadSurt']<$cantidadPedida['cantidad']){
						$edo='rojo'; //-----Incompleto
						$etiqueta='<a rel="shadowbox;width=650;height=340;"  href="surtir_pzasTaller.php?var='.$result_detalle['clave'].'&var2='.$result_detalle['cantidad'].'&var3='.$result_detalle['cantidadSurt'].'&var4='.$result_detalle['producto'].'&var5='.$result_detalle['detallePedidoId'].'&var6='.$result_detalle['pedidoID'].'"><img src="../imagenes/rojo.png"  title="Incompleto"/></a>';
						
						$val_td='';
					}else{
						if($status_prod>=1 && $maquila['material_maquila']==1 && $result_detalle['cantidadSurt']==$cantidadPedida['cantidad']){ //-----Completo
							$edo='verde';
							$etiqueta='<img src="../imagenes/verde.png"  title="Completo"/>';
						}

						else{
							if($maquila['material_maquila']==0 )
							$edo='almacen';
							$etiqueta='<img src="../imagenes/almacen1.png"  title="En Almacen"/>';
					
							}

						}

								
					$output.='<tr>  
							
							<td>'.$result_detalle['clave'].'</td><!-- //producto_id -->
							<td>'.$result_detalle['material_tipo'].'</td>
							<td>'.$result_detalle['producto'].'</td><!--  //material_descripcion -->
							<td>'.$result_detalle['cantidad'].'</td><!--  //cantidad -->
							<td>'.$result_detalle['unidad'].'</td><!--  //prefijo-->
							<td>'.$result_detalle['cantidadSurt'].'</td>
							<td><center>'.$etiqueta.'</center></td>
							
							<td>'.$result_detalle['observ'].'</td>
							
						</tr>
					   <input type="hidden" id="id_'.$result_detalle['clave'].'" value="'.$result_detalle['detallePedidoId'].'">
					
					';
				
				}//FIN WHILE
				return $output;
          }
		  
		  function result_detalle_pedido_taller_1($v1,$tipo_pedido) //filtro para almacen
		  
          {
				$result_detalle=array();


				
				$output="";
				$qry = mysql_query("SELECT  DETALLE_PEDIDO.detalle_pedido_id , 
		  		  DETALLE_PEDIDO.producto_id,
				  DETALLE_PEDIDO.cantidad,
				  DETALLE_PEDIDO.pedido_id ,
				  DETALLE_PEDIDO.precio_venta,
				  DETALLE_PEDIDO.detalle_pedido_obs,
				  DETALLE_PEDIDO.multiplo,
				  MATERIAL.material_descripcion,
				  MATERIAL.material_maquila,
				  UNIDADES.prefijo,
				  PEDIDO.pedido_estado,
				  DETALLE_PEDIDO.cantidad_surtida,
				  DETALLE_PEDIDO.cantidad_surtida_produccion,
				  DETALLE_PEDIDO.detalle_pedido_id,
				  DETALLE_PEDIDO.pedido_id,
				  ALMACEN_MATERIAL.cantidad_actual,
				  DETALLE_PEDIDO.pedido_tipo,
				  MATERIAL.idSAE,
				  MATERIAL_TIPO.nombre,	
				  ALMACEN.tipo
				  from DETALLE_PEDIDO, MATERIAL, UNIDADES, PEDIDO, ALMACEN_MATERIAL, MATERIAL_TIPO, ALMACEN 
				  where 
				   MATERIAL.material_id=DETALLE_PEDIDO.producto_id AND 
				  UNIDADES.id_unidad=MATERIAL.id_unidad and PEDIDO.pedido_id=DETALLE_PEDIDO.pedido_id AND 
				  MATERIAL.material_tipo = MATERIAL_TIPO.material_tipo AND
				  ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND
				  ALMACEN.almacen_id = DETALLE_PEDIDO.almacen_id AND
				  DETALLE_PEDIDO.pedido_id=".$v1." 
				  GROUP BY DETALLE_PEDIDO.detalle_pedido_id,ALMACEN_MATERIAL.cantidad_actual");
				
				$edo=''; $etiqueta='';
				
				while($res = mysql_fetch_object($qry)){	
					$result_detalle['clave']= $res->producto_id;
					$result_detalle['claveSAE']= $res->idSAE;
					$result_detalle['producto']= $res->material_descripcion;
					$result_detalle['cantidad']= $res->cantidad;
					$result_detalle['unidad']= $res->prefijo;
					$result_detalle['observ']= $res->detalle_pedido_obs;
					$status_prod=$res->pedido_estado;
					$result_detalle['cantidadSurt']=$res->cantidad_surtida;
					$result_detalle['cantidad_producida']=$res->cantidad_surtida_produccion;
					$result_detalle['detallePedidoId']=$res->detalle_pedido_id;
					$result_detalle['pedidoID']=$res->pedido_id;
					$maquila['material_maquila']=$res->material_maquila;
					$cantidadPedida['cantidad']=$res->cantidad;
					$cantidad_actual['cantidad_actual']=$res->cantidad_actual;
					$result_detalle['pedido_tipo']=$res->pedido_tipo;
					$idProd=$result_detalle['clave'];
					$result_detalle['material_tipo']= $res->nombre;
					$result_detalle['tipo']= $res->tipo;
	//									if ($status_prod<=1 && $maquila['material_maquila']==0 && $result_detalle['cantidadSurt']==0){
					if ($status_prod<=1 &&  $result_detalle['cantidadSurt']==0){
						$edo='rojo'; //-----Incompleto

						if ($result_detalle['tipo']==1)
									$etiqueta='<a rel="shadowbox;width=700;height=340;"  href="surtir_pzasTaller.php?var='.$result_detalle['clave'].'&var2='.$result_detalle['cantidad'].'&var3='.$result_detalle['cantidadSurt'].'&var4='.$result_detalle['producto'].'&var5='.$result_detalle['detallePedidoId'].'&var6='.$result_detalle['pedidoID'].'&var_tipo='.$result_detalle['pedido_tipo'].'">
						<img src="../imagenes/rojo.png"  title="Incompleto"/>
						</a>';
						else
										$etiqueta='<img src="../imagenes/amarillo_almacen.png"  title="Incompleto"/>';


						if ($tipo_pedido != $result_detalle['pedido_tipo'])
						$etiqueta_envío = 	"
						<INPUT type='checkbox' id='checkenvio'  name='checkenvio' value='".$result_detalle['detallePedidoId']."' />
						" ;
						else
							$etiqueta_envío = 	"
						<INPUT type='checkbox' id='checkenvio' style='opacity:0; position:absolute; left:9999px;'  name='checkenvio' value='".$result_detalle['detallePedidoId']."' />
						" ;
						$val_td='';
					}else{
						if($status_prod>=1 && $maquila['material_maquila']==0 && $result_detalle['cantidadSurt']==$cantidadPedida['cantidad'] ){ //-----Completo
							$edo='verde';
							$etiqueta='<img src="../imagenes/verde.png"  title="Completo"/>';
							}
							else {

								if ($status_prod<=1 && $maquila['material_maquila']==0 && $result_detalle['cantidadSurt']<$cantidadPedida['cantidad'])
								{

									$edo='medio';
									if ($result_detalle['tipo']==1)
											$etiqueta='<a rel="shadowbox;width=960;height=340;"  href="surtir_pzasTaller.php?var='.$result_detalle['clave'].'&var2='.$result_detalle['cantidad'].'&var3='.$result_detalle['cantidadSurt'].'&var4='.$result_detalle['producto'].'&var5='.$result_detalle['detallePedidoId'].'&var6='.$result_detalle['pedidoID'].'&var_tipo='.$result_detalle['pedido_tipo'].'"><img src="../imagenes/medio.png"  title="Incompleto"/></a>';
								else
												$etiqueta='<img src="../imagenes/rojo.png"  title="Incompleto"/>';

								if ($tipo_pedido != $result_detalle['pedido_tipo'])
										$etiqueta_envío = 	"<INPUT type='checkbox' id='checkenvio'  name='checkenvio' value='".$result_detalle['detallePedidoId']."' />" ;
								else
									$etiqueta_envío = 	"<INPUT type='checkbox' id='checkenvio' style='opacity:0; position:absolute; left:9999px;'  name='checkenvio' value='".$result_detalle['detallePedidoId']."' />" ;						
								$val_td='';
								}
								else{
									if($maquila['material_maquila']==1 )
									$edo='taller';
									$etiqueta='<img src="../imagenes/verde.png"  title="En Taller"/>';
									}
								}
									$etiqueta_envío="";
					}  //else



		if ($result_detalle['tipo']==1)
					{
						$negrita_abre = '<b>';
						$negrita_cierra = '</b>';
					}
					else
					{
						$negrita_abre = '';
						$negrita_cierra = '';
					}

					$output.='<tr>  
								
				
							<td>'.$negrita_abre.$result_detalle['material_tipo'].$negrita_cierra.'</td>
							<td>'.$negrita_abre.$result_detalle['producto'].$negrita_cierra.'</td><!--  //material_descripcion -->
							<td>'.$negrita_abre.$result_detalle['cantidad'].$negrita_cierra.'</td><!--  //cantidad -->
							<td>'.$negrita_abre.$result_detalle['unidad'].$negrita_cierra.'</td><!--  //prefijo-->
							<td>'.$negrita_abre.$result_detalle['cantidadSurt'].$negrita_cierra.'</td>
							<td>'.$negrita_abre.$result_detalle['cantidad_producida'].$negrita_cierra.'</td>
							<td><center>'.$etiqueta.'</center></td>
							
							<td>'.$negrita_abre.$cantidad_actual['cantidad_actual'].$negrita_cierra.'</td>
							<td><a href="javascript:crear_orden({id:'.$result_detalle['detallePedidoId'].'})">Crear Orden</a></td>
							<td><center><a href="javascript:ver_ordenes({id:'.$result_detalle['detallePedidoId'].'})">Ver</a></center></td>
						
						</tr>
					   <input type="hidden" id="id_'.$result_detalle['clave'].'" value="'.$result_detalle['detallePedidoId'].'">
					
					';
				
				}//FIN WHILE
				return $output;
          }
		  
		
 function resultSolicitudes($search, $inicio, $fin)
		  
          {
				 $search= str_replace(' ', '%', $search);

				$sql ="SELECT
				  TALLER_SOLICITUD.taller_solicitud_id,
				  TALLER_SOLICITUD.fecha_creacion,
				  TALLER_SOLICITUD.folio,
				  ALMACEN.nombre,		 
				  TALLER_SOLICITUD.status				
				  FROM TALLER_SOLICITUD, ALMACEN
				  WHERE   			
				  ALMACEN.almacen_id=TALLER_SOLICITUD.almacen_id
				
				  ";
				
				  $sql=$sql." LIMIT $inicio, $fin";
				  $res=mysql_query($sql);
				  $renglones=mysql_num_rows($res);
				  $cont_array=0;
				  $array=array(); // create new empty array
				  
					  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0],$row[1], $row[2], $row[3], $row[4]);
				 

				  //echo "".$array[$cont_array][0];

				  $cont_array++;
			  }

			  
}
         return $array;
          }
		  

	  	  function detalle_solicitud_material($id)
	  {
		  $sql = "SELECT 
		  DETALLE_TALLER_SOLICITUD.detalle_taller_solicitud_id,
		  MATERIAL.material_descripcion,
		  DETALLE_TALLER_SOLICITUD.cantidad_solicitada,
		  DETALLE_TALLER_SOLICITUD.producto_id,
		  ALMACEN_MATERIAL.cantidad_actual		  
		  from DETALLE_TALLER_SOLICITUD, TALLER_SOLICITUD, MATERIAL, ALMACEN_MATERIAL  
		  where MATERIAL.material_id = DETALLE_TALLER_SOLICITUD.producto_id AND ALMACEN_MATERIAL.material_id = DETALLE_TALLER_SOLICITUD.producto_id AND TALLER_SOLICITUD.taller_solicitud_id = DETALLE_TALLER_SOLICITUD.DETALLE_TALLER_SOLICITUD
		  AND DETALLE_TALLER_SOLICITUD.detalle_taller_solicitud_id=".$id." ";

		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  
		
	  }


function resultVales($search, $inicio, $fin)
		  
          {
				 $search= str_replace(' ', '%', $search);

				$sql ="SELECT
				  TALLER_SOLICITUD.taller_solicitud_id,
				  TALLER_SOLICITUD.fecha_creacion,
				  TALLER_SOLICITUD.folio,
				  DETALLE_TALLER_SOLICITUD.cantidad_solicitada,
				  DETALLE_TALLER_SOLICITUD.producto_id,
				  ALMACEN.nombre,
				  MATERIAL.material_descripcion,
				  TALLER_SOLICITUD.status
				  FROM  TALLER_SOLICITUD, DETALLE_TALLER_SOLICITUD, MATERIAL, ALMACEN
				  WHERE (TALLER_SOLICITUD.taller_solicitud_id like '%".$search."%' or TALLER_SOLICITUD.fecha_creacion like '%".$search."%' or MATERIAL.material_descripcion
				  like '%".$search."%' ) AND MATERIAL.material_id=DETALLE_TALLER_SOLICITUD.producto_id  AND DETALLE_TALLER_SOLICITUD=taller_solicitud_id AND
				  ALMACEN.almacen_id=TALLER_SOLICITUD.almacen_id AND TALLER_SOLICITUD.tipo=1  ";
				
				  $sql=$sql." LIMIT $inicio, $fin";
				  $res=mysql_query($sql);
				  $renglones=mysql_num_rows($res);
				  $cont_array=0;
				  $array=array(); // create new empty array
				  
					  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0],$row[1], $row[2], $row[3], $row[4], $row[5],$row[6], $row[7]);
				 

				  //echo "".$array[$cont_array][0];	

				  $cont_array++;
			  }

			  
}
         return $array;
          }

		  
}
		
	  function update_status($edo, $orden_compra, $obs)
	  {
		  $sql = "UPDATE ORDEN_COMPRA set orden_edo=".$edo."";
		  if($obs=="")
		  	$sql=$sql.", orden_observaciones='".$obs."'";
		   $sql=$sql." where orden_compra_id=".$orden_compra."";
		   echo "$sql";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res/*&&$renglones==1*/)
			return "OK";
		  else 
			return mysql_error();
	  }



?>