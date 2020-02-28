<?
      class Laboratorio
        {
          private $link;        
          function __construct()
          {
                 
          }
          function conexion($link_bd)
          {
                  $link=$link_bd;
          }
          function insert(// no incluyo ni estado, ni fecha de envio debido a que estas variables seran actualizadas una vez el proceso de llenado de cotizacion

                   $tipo,
                   $cantidad,
                   $idDetalle,
                   $usuario,
                   $id_unidad,
                   $servicio_lab,
                   $observaciones_lab,
                   $lote_lab
                   )
          {   
                  $id=0;
          $sql = "INSERT into LABORATORIO
                  (
                   tipo_orden,
                   cantidad,
                   id_detalle,
                   id_usuario,
                   fecha_ini,
                   id_unidad,
                   servicio,
                   observaciones,
                   lote
                  )
                   values
                  (
                   ".$tipo.",
                   ".$cantidad.",
                   ".$idDetalle.",
                   '".$usuario."',
                   NOW(),
                   ".$id_unidad.",
                   '".$servicio_lab."',
                   '".$observaciones_lab."',
                   '".$lote_lab."'

                  )";

                  $res=mysql_query($sql);
                  if($res)
                                  
                          $id=mysql_insert_id();
                  else
                  {
                          $id=0;
                          printf("Error:".mysql_error());
                  }
                  return $id;
          }

          function insert_adicionales(// no incluyo ni estado, ni fecha de envio debido a que estas variables seran actualizadas una vez el proceso de llenado de cotizacion

                   $tipo,
                   $cantidad,
                   $id_producto,
                   $usuario,
                   $id_unidad,
                   $servicio_lab,
                   $observaciones_lab
                   )
          {   
                  $id=0;
          $sql = "INSERT into LABORATORIO_ADICIONALES
                  (
                   tipo_orden,
                   cantidad,
                   id_producto,
                   id_usuario,
                   fecha_ini,
                   id_unidad,
                   servicio,
                   observaciones
                  )
                   values
                  (
                   ".$tipo.",
                   ".$cantidad.",
                   ".$id_producto.",
                   '".$usuario."',
                   NOW(),
                   ".$id_unidad.",
                   '".$servicio_lab."',
                   '".$observaciones_lab."'

                  )";

                  $res=mysql_query($sql);
                  if($res)
                                  
                          $id=mysql_insert_id();
                  else
                  {
                          $id=0;
                          printf("Error:".mysql_error());
                  }
                  return $id;
          }

          function insert_empty($usuario_id)
          {   
                  $id=0;
          $sql = "
                  insert into CALIDAD
                  (usuario_id
                  )
                   values
                  (
                        '".$usuario_id."'
                  )";
                  $res=mysql_query($sql);
                  if($res)
                                  
                          $id=mysql_insert_id();
                  else
                  {
                          $id=0;
                          printf("Error:".mysql_error());
                  }
                  return $id;
          }

          
          function delete($id)
          {
                  $sql="delete from LABORATORIO where laboratorio_id='".$id."'";
                  $res=mysql_query($sql);
                  $renglones=mysql_affected_rows();
                  if($res&&$renglones==1)
                        return "OK";
                  else 
                        return mysql_error();
          }
          
          function update(
                   $cotizacion_id,
                   $edo,
                   $cliente_id,
                   $usuario_id,
                   $empresa_id,
                   $folio,
                   $moneda,
                   $cambio_dia,
                   $obs,
                   $contacto,
                   $mensaje,
				   $dias_entrega,
				   $condiciones
                )
                {
                        $sql = "update COTIZACION set cotizacion_edo=".$edo.", cliente_id='".$cliente_id."', usuario_id='".$usuario_id."', empresa_id=".$empresa_id.", cotizacion_folio=".$folio.", moneda_id=".$moneda.", cotizacion_divisa_dia=".$cambio_dia.", cotizacion_observaciones='".$obs."', contacto_ventas_id=".$contacto.", cotizacion_mensaje='".$mensaje."', cotizacion_dias_entrega=".$dias_entrega.", cotizacion_condiciones_pago='".$condiciones."'";
                        if($edo==2)
                                $sql=$sql.", cotizacion_fecha_envio=NOW()";
                        $sql=$sql." where cotizacion_id=".$cotizacion_id."";
                        $res=mysql_query($sql);
                        $renglones=mysql_affected_rows();
                        if($res/*&&$renglones==1*/)
                                return "OK";
                          else 
                                return mysql_error()." sentencia:".$sql;
                        
                }

                
          function update_status(
            $id_laboratorio, 
            $cantidad,
            $certificado,
            $usuario,
            $status,
            $fecha_rev
            )
          {
                  $sql = "UPDATE LABORATORIO set  
                  cantidad_rev=".$cantidad.",
                  status=".$status.",
                  id_usuario_rev='".$usuario."',
                  fecha_rev='".$fecha_rev."'
                  ";

                  if($certificado!="")
                        $sql=$sql.", certificado='".$certificado."' ";

                   $sql=$sql." WHERE id_laboratorio=".$id_laboratorio."";
                
                  $res=mysql_query($sql);
                  $renglones=mysql_affected_rows();
                  if($res/*&&$renglones==1*/)
                        return "OK";
                  else 
                        return mysql_error();
          }
          
          function last_folio($user, $empresa)
          {
                  $sql = "select cotizacion_folio from COTIZACION where usuario_id='".$user."' and empresa_id=".$empresa."   and cotizacion_folio<>0 ORDER BY cotizacion_folio DESC";
                  //echo "$sql";
                  $res=mysql_query($sql);
                  if($res&&mysql_num_rows($res)>0)
                  {
                          $row=mysql_fetch_row($res);
                          return $row[0];
                  }
                  else
                  {
                          return 0;
                  }
          }
          
          function busqueda_parametros($search, $inicio, $fin, $filter)
          {
                  $search= str_replace(' ', '%', $search);
                  $sql="SELECT
                  LABORATORIO.id_laboratorio,
                  LABORATORIO.tipo_orden,
                  LABORATORIO.id_detalle,
                  LABORATORIO.cantidad,
                  LABORATORIO.cantidad_rev,
                  LABORATORIO.id_usuario,
                  LABORATORIO.id_usuario_rev,
                  DATE(LABORATORIO.fecha_ini),
                  DATE(LABORATORIO.fecha_rev),
                  LABORATORIO.status,
                  MATERIAL.material_descripcion,
                  LABORATORIO.certificado,
                  UNIDADES.prefijo,
                  LABORATORIO.lote
                  FROM LABORATORIO, MATERIAL, DETALLE_PEDIDO, UNIDADES  WHERE LABORATORIO.id_detalle=DETALLE_PEDIDO.detalle_pedido_id AND DETALLE_PEDIDO.producto_id = MATERIAL.material_id AND LABORATORIO.id_unidad = UNIDADES.id_unidad  AND LABORATORIO.id_usuario like '%".$search."%' 
                   " ;
                 

                  if($filter>=0)
                        $sql=$sql." AND LABORATORIO.status=".$filter;


                       //$sql=$sql." GROUP BY LABORATORIO_ADICIONALES.id_laboratorio_adicional" ;

                   
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($res))
                          {
                                  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12], $row[13]);
                                  //echo "".$array[$cont_array][0];
                                  $cont_array++;
                          }
                          return $array;
                  }
                  else
                          return null;
          }

          function obtenerOrdenes_Laboratorio($idDetalle)
          {
                  $sql="SELECT
                  LABORATORIO.id_laboratorio,
                  LABORATORIO.tipo_orden,
                  LABORATORIO.id_detalle,
                  LABORATORIO.cantidad,
                  LABORATORIO.cantidad_rev,
                  LABORATORIO.id_usuario,
                  LABORATORIO.id_usuario_rev,
                  DATE(LABORATORIO.fecha_ini),
                  DATE(LABORATORIO.fecha_rev),
                  LABORATORIO.status,
                  MATERIAL.material_descripcion,
                  LABORATORIO.certificado
                  FROM LABORATORIO, MATERIAL, DETALLE_PEDIDO  WHERE LABORATORIO.id_detalle=DETALLE_PEDIDO.detalle_pedido_id AND DETALLE_PEDIDO.producto_id = MATERIAL.material_id AND LABORATORIO.id_detalle = ".$idDetalle."
                   " ;     
                            
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($res))
                          {
                                  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11]);
                                  //echo "".$array[$cont_array][0];
                                  $cont_array++;
                          }
                          return $array;
                  }
                  else
                          return null;
          }          
          function cuenta_resultado($search)
          {
                  $search= str_replace(' ', '%', $search);
                 $sql="SELECT
                  LABORATORIO.id_laboratorio,
                  LABORATORIO.tipo_orden,
                  LABORATORIO.id_detalle,
                  LABORATORIO.cantidad,
                  LABORATORIO.cantidad_rev,
                  LABORATORIO.id_usuario,
                  LABORATORIO.id_usuario_rev,
                  DATE(LABORATORIO.fecha_ini),
                  DATE(LABORATORIO.fecha_rev),
                  LABORATORIO.status,
                  MATERIAL.material_id
                  FROM LABORATORIO, MATERIAL
                  
                   " ;
                  if(!empty($search))
                  {
                   $sql=$sql."";
                  }
                  else
                   $sql=$sql."
                     ";

                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  return $renglones;
          }
          
          function busqueda_parametros_usuario($user, $search, $inicio, $fin, $filter)
          {
                  $search= str_replace(' ', '%', $search);
                  $sql="select COTIZACION.cotizacion_id, COTIZACION.cotizacion_edo, COTIZACION.cliente_id, COTIZACION.empresa_id, COTIZACION.cotizacion_folio, COTIZACION.cotizacion_fecha_modificacion, COTIZACION.cotizacion_fecha_envio, COTIZACION.cotizacion_observaciones, COTIZACION.contacto_ventas_id from COTIZACION";
                  if(!empty($search))
                  {
                        $sql=$sql.", CLIENTE, USUARIO, EMPRESA where (COTIZACION.cotizacion_id like '%".$search."%' OR COTIZACION.cotizacion_folio like '%".$search."%' OR CLIENTE.cliente_id like '%".$search."%'  OR CLIENTE.cliente_razonsocial like '%".$search."%' OR EMPRESA.empresa_id like '%".$search."%' OR EMPRESA.empresa_razonsocial like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%'  OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%'  OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' ) AND USUARIO.generales_id=GENERALES.generales_id AND CLIENTE.domicilio_id=DOMICILIO.domicilio_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id AND COTIZACION.usuario_id='".$user."'";
                  }
                  else
                        $sql=$sql." where COTIZACION.usuario_id='".$user."'";
                  if($filter>=0)
                        $sql=$sql." AND COTIZACION.cotizacion_edo=".$filter;
                  else
                        $sql=$sql." AND COTIZACION.cotizacion_edo<>0";          
                  $sql=$sql." ORDER BY COTIZACION.cotizacion_id DESC LIMIT $inicio, $fin";
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($res))
                          {
                                  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
                                  //echo "".$array[$cont_array][0];
                                  $cont_array++;
                          }
                          return $array;
                  }
                  else
                          return null;
          }
          
          function cuenta_resultado_usuario($user,$search, $filter)
          {
                  $search= str_replace(' ', '%', $search);
                  $sql="select COTIZACION.cotizacion_id from COTIZACION";
                  if(!empty($search))
                  {
                   $sql=$sql.", CLIENTE, USUARIO, EMPRESA, GENERALES, DOMICILIO where (COTIZACION.cotizacion_id like '%".$search."%' OR USUARIO.usuario_id like '%".$search."%' OR CLIENTE.cliente_id like '%".$search."%'  OR CLIENTE.cliente_razonsocial like '%".$search."%' OR EMPRESA.empresa_id like '%".$search."%' OR EMPRESA.empresa_razonsocial like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%'  OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%'  OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' )  AND USUARIO.generales_id=GENERALES.generales_id AND CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id AND COTIZACION.cotizacion_edo<>0";
                  }
                  else
                   $sql=$sql." where COTIZACION.usuario_id='".$user."'";
                  if($filter>=0)
                        $sql=$sql." AND COTIZACION.cotizacion_edo=".$filter;
                  else
                        $sql=$sql." AND COTIZACION.cotizacion_edo<>0";  
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  return $renglones;
          }
          
          function detalle($search)
          {
                  $sql = "select COTIZACION.cotizacion_id, COTIZACION.cotizacion_edo, COTIZACION.cliente_id, COTIZACION.usuario_id, COTIZACION.empresa_id, COTIZACION.cotizacion_folio, COTIZACION.cotizacion_fecha_modificacion, COTIZACION.cotizacion_fecha_envio, COTIZACION.moneda_id, COTIZACION.cotizacion_divisa_dia, COTIZACION.cotizacion_observaciones, COTIZACION.contacto_ventas_id, COTIZACION.cotizacion_mensaje, CLIENTE.cliente_razonsocial, EMPRESA.empresa_razonsocial,  GENERALES.nombre, GENERALES.apel_p, GENERALES.apel_m,GENERALES.email,
COTIZACION.cotizacion_dias_entrega, COTIZACION.cotizacion_condiciones_pago from COTIZACION, CLIENTE, EMPRESA,GENERALES,CONTACTO_VENTAS where  GENERALES.generales_id=CONTACTO_VENTAS.generales_id AND CONTACTO_VENTAS.contacto_ventas_id=COTIZACION.contacto_ventas_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id AND cotizacion_id=".$search."";
                  $res=mysql_query($sql);
                  if($res&&mysql_num_rows($res)==1)
                  {
                          $row=mysql_fetch_row($res);
                          return $row;
                  }
                  else
                  {
                          return null;
                  }
          }
		  function exportResult($edo, $fecha_inicio, $fecha_fin, $mes, $ano)
			{
				$sentencia_date="COTIZACION.cotizacion_fecha_modificacion";
				$sql="select COTIZACION.cotizacion_id,COTIZACION.empresa_id,COTIZACION.usuario_id, COTIZACION.cotizacion_folio, COTIZACION.cotizacion_edo,CLIENTE.cliente_razonsocial,CLIENTE.cliente_rfc,(select sum(DETALLE_COTIZACION.cantidad*DETALLE_COTIZACION.precio_venta*DETALLE_COTIZACION.multiplo*COTIZACION.cotizacion_divisa_dia) FROM DETALLE_COTIZACION where DETALLE_COTIZACION.cotizacion_id=COTIZACION.cotizacion_id),MONEDA.moneda_prefijo, COTIZACION.cotizacion_fecha_modificacion, COTIZACION.cotizacion_fecha_envio, COTIZACION.cotizacion_fecha_envio from COTIZACION, CLIENTE, MONEDA where COTIZACION.cotizacion_edo<>0 and COTIZACION.cliente_id=CLIENTE.cliente_id and MONEDA.moneda_id=COTIZACION.moneda_id";
				  if($edo!=-1)
				  {
					  $sql=$sql." and COTIZACION.cotizacion_edo=".$edo;
					  if($edo==2||$edo==6)
						$sentencia_date="COTIZACION.cotizacion_fecha_envio";
						
				  }
				  else
				  {
				  }
				  if($fecha_inicio!=null)
				  {
					  if($fecha_fin!=null)
					  {
						  
							$sql=$sql." and (".$sentencia_date." between '".$fecha_inicio."' and '".$fecha_fin."')";
						  
					  }
					  else
						$sql=$sql." and DATE_FORMAT(".$sentencia_date.",'%d/%m/%Y') ='".$fecha_inicio."'";
						
				  }
				  if($ano!=null)
				  {
					  if($mes!=0)
						$sql=$sql." and MONTH(".$sentencia_date.")=".$mes;
					  $sql=$sql." and YEAR(".$sentencia_date.")=".$ano;
				  }
				  //echo "$sql";
				  $res=mysql_query($sql);
				  $renglones=mysql_num_rows($res);
				  $cont_array=0;
				  $array=array(); // create new empty array
				  
				  if($renglones>0)
				  {
						  
						  while($row=mysql_fetch_row($res))
						  {
								  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8],$row[9], $row[10]);
								  //echo "".$array[$cont_array][0];
								  $cont_array++;
						  }
						  return $array;
				  }
				  else
						  return null;
				
			}

      function busqueda_calidad($Osalida)
          {
                
                  $sql="SELECT PEDIDO.folio_pedido, MATERIAL.material_descripcion, PEDIDO.pedido_fecha_entrega, DETALLE_PEDIDO.cantidad_surtida, CLIENTE.cliente_razonsocial
                  FROM PEDIDO, MATERIAL, DETALLE_PEDIDO,CLIENTE, COTIZACION WHERE pedido.pedido_id=DETALLE_PEDIDO.pedido_id AND MATERIAL.material_id=DETALLE_PEDIDO.producto_id 
                  AND pedido.cotizacion_id=COTIZACION.cotizacion_id AND COTIZACION.cliente_id=cliente.cliente_id and pedido.pedido_id= '$Osalida' ";
                   

                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($res))
                          {
                                  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4]);
                                  //echo "".$array[$cont_array][0];
                                  $cont_array++;
                          }
                          return $array;
                  }
                  else
                          return null;
          }
          
    }
		
		

?>