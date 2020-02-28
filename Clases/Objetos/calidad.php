<?
      class Calidad
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

                   $cliente_id,
                   $usuario_id,
                   $empresa_id
                   )
          {   
                  $id=0;
          $sql = "
                  insert into CALIDAD
                  (
                   cliente_id,
                   usuario_id,
                   empresa_id
                  )
                   values
                  (
                   '".$cliente_id."',
                   '".$usuario_id."',
                   ".$empresa_id."
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
                  $sql="delete from COTIZACION where cotizacion_id='".$id."'";
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

                
          function update_status($status, $pedido, $obs)
          {
                  $sql = "UPDATE DETALLE_PEDIDO set  detalle_pedido_status=3";
                  if($obs=="")
                        $sql=$sql.", detalle_pedido_obs='".$obs."'";
                   $sql=$sql." WHERE pedido_id=".$pedido." AND detalle_pedido_status=2";
                  // echo "QUERY: ".$sql;
                  $res=mysql_query($sql);
                  $renglones=mysql_affected_rows();
                  if($res/*&&$renglones==1*/)
                        return "OK";
                  else 
                        return mysql_error();
          }
          
          function last_folio($user, $empresa)
          {
                  $sql = "SELECT cotizacion_folio from COTIZACION where usuario_id='".$user."' and empresa_id=".$empresa."   and cotizacion_folio<>0 ORDER BY cotizacion_folio DESC";
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
                  PEDIDO.pedido_id, 
                  PEDIDO.cotizacion_id, 
                  PEDIDO.sucursal_id, 
                  COTIZACION.cliente_id, 
                  COTIZACION.usuario_id, 
                  COTIZACION.empresa_id,
                  PEDIDO.pedido_fecha_creacion, 
                  PEDIDO.pedido_fecha_entrega, 
                  PEDIDO.pedido_estado, 
                  PEDIDO.pedido_obs, 
                  PEDIDO.contrato_id, 
                  PEDIDO.partida_id,
                  PEDIDO.folio_pedido,
                   DETALLE_PEDIDO.detalle_pedido_status,
                   CLIENTE.cliente_razonsocial,
                   EMPRESA.empresa_razonsocial

                  FROM PEDIDO, COTIZACION, DETALLE_PEDIDO, USUARIO, GENERALES,CLIENTE,DOMICILIO,EMPRESA
                   " ;
                  if(!empty($search))
                  {
                   $sql=$sql.", COTIZACION, SUCURSAL, EMPRESA, GENERALES, DOMICILIO where (COTIZACION.cotizacion_id like '%".$search."%' OR 
                    USUARIO.usuario_id like '%".$search."%' OR CLIENTE.cliente_id like '%".$search."%'  OR 
                    CLIENTE.cliente_razonsocial like '%".$search."%' OR EMPRESA.empresa_id like '%".$search."%' OR 
                    EMPRESA.empresa_razonsocial like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%'  OR
                     GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  
                     DOMICILIO.domicilio_colonia like '%".$search."%'  OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR
                     DOMICILIO.domicilio_estado like '%".$search."%' )  AND USUARIO.generales_id=GENERALES.generales_id AND
                     CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND
                     EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id PEDIDO.pedido_estado=2 and PEDIDO.cotizacion_id = COTIZACION.cotizacion_id and pedido.pedido_id=detalle_pedido.pedido_id AND COTIZACION.cliente_id=CLIENTE.cliente_id AND
                (SELECT COUNT(*) FROM DETALLE_PEDIDO WHERE detalle_pedido_status=2) > 0 ";
                  }
                  else
                   $sql=$sql." where USUARIO.generales_id=GENERALES.generales_id AND
                     CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND
                     EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id AND PEDIDO.pedido_estado>=1 and PEDIDO.cotizacion_id = COTIZACION.cotizacion_id and
  PEDIDO.PEDIDO_ID=DETALLE_PEDIDO.pedido_id and detalle_pedido_status=2   ";




                  $sql=$sql."
                  GROUP BY PEDIDO.pedido_id 
                   LIMIT $inicio, $fin";
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($res))
                          {
                                  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12], $row[13], $row[14], $row[15]);
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
                  $sql="SELECT PEDIDO.pedido_id from PEDIDO";
                  if(!empty($search))
                  {
                   $sql=$sql.", CLIENTE, USUARIO, EMPRESA, GENERALES, DOMICILIO where (COTIZACION.cotizacion_id like '%".$search."%' OR USUARIO.usuario_id like '%".$search."%' OR CLIENTE.cliente_id like '%".$search."%'  OR CLIENTE.cliente_razonsocial like '%".$search."%' OR EMPRESA.empresa_id like '%".$search."%' OR EMPRESA.empresa_razonsocial like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%'  OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%'  OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' )  AND USUARIO.generales_id=GENERALES.generales_id AND CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id AND COTIZACION.cotizacion_edo<>0";
                  }
                  else
                   $sql=$sql." where PEDIDO.pedido_estado=2";
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  return $renglones;
          }
          
          function busqueda_parametros_usuario($user, $search, $inicio, $fin, $filter)
          {
                  $search= str_replace(' ', '%', $search);
                  $sql="SELECT COTIZACION.cotizacion_id, COTIZACION.cotizacion_edo, COTIZACION.cliente_id, COTIZACION.empresa_id, COTIZACION.cotizacion_folio, COTIZACION.cotizacion_fecha_modificacion, COTIZACION.cotizacion_fecha_envio, COTIZACION.cotizacion_observaciones, COTIZACION.contacto_ventas_id from COTIZACION";
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
                  $sql = "SELECT COTIZACION.cotizacion_id, COTIZACION.cotizacion_edo, COTIZACION.cliente_id, COTIZACION.usuario_id, COTIZACION.empresa_id, COTIZACION.cotizacion_folio, COTIZACION.cotizacion_fecha_modificacion, COTIZACION.cotizacion_fecha_envio, COTIZACION.moneda_id, COTIZACION.cotizacion_divisa_dia, COTIZACION.cotizacion_observaciones, COTIZACION.contacto_ventas_id, COTIZACION.cotizacion_mensaje, CLIENTE.cliente_razonsocial, EMPRESA.empresa_razonsocial,  GENERALES.nombre, GENERALES.apel_p, GENERALES.apel_m,GENERALES.email,
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
                  FROM PEDIDO, MATERIAL, DETALLE_PEDIDO,CLIENTE, COTIZACION WHERE PEDIDO.pedido_id=DETALLE_PEDIDO.pedido_id AND MATERIAL.material_id=DETALLE_PEDIDO.producto_id 
                  AND PEDIDO.cotizacion_id=COTIZACION.cotizacion_id AND COTIZACION.cliente_id=cliente.cliente_id and PEDIDO.pedido_id= '$Osalida' ";
                   

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