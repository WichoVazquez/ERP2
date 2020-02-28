<?
      class Cotizacion
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
				           $contacto_id,
                   $usuario_id,
                   $empresa_id,
                   $tipocot,
                   $fecha_ini,
                   $puesto
                   )
          {   
                  $id=0;
          $sql = "INSERT INTO COTIZACION
                  (
                   cliente_id,
				   contacto_ventas_id,
                   usuario_id,
                   empresa_id,
                   cotizacion_tipo,
                   cotizacion_fecha_envio,
                   puesto
                  )
                   values
                  (
                   '".$cliente_id."',
                    ".$contacto_id.",
                   '".$usuario_id."',
                   ".$empresa_id.",
                   ".$tipocot.", 
                   '".$fecha_ini."',
                   '".$puesto."'
                  )";
           //   echo "SQL COTIZACION: ".$sql;
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
                  insert into COTIZACION
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
        				   $condiciones,
                   $tipocot,
                   $vigencia,
                   $fecha_ini,
                   $precio_cotizacion,
                   $lab,
                   $capacidad_entrega,
                   $muestra_existencia,
                   $muestra_flete
                )
                {
                 // echo "si entro aqui";
           $sql = "UPDATE COTIZACION set cotizacion_edo=".$edo.", cliente_id='".$cliente_id."', usuario_id='".$usuario_id."', empresa_id=".$empresa_id.", cotizacion_folio=".$folio.", moneda_id=".$moneda.", cotizacion_divisa_dia=".$cambio_dia.", cotizacion_observaciones='".$obs."', contacto_ventas_id=".$contacto.", cotizacion_mensaje='".$mensaje."', cotizacion_dias_entrega='".$dias_entrega."', cotizacion_condiciones_pago='".$condiciones."', cotizacion_vigencia='".$vigencia."', cotizacion_tipo=".$tipocot.", cotizacion_fecha_envio='".$fecha_ini."', precio_cotizacion='".$precio_cotizacion."', lab='".$lab."', capacidad_entrega='".$capacidad_entrega."', muestra_existencia=".$muestra_existencia.", muestra_flete=".$muestra_flete."  ";
                       //echo "sql ".$sql;
                  //      if($edo==2)
                  //              $sql=$sql.", cotizacion_fecha_envio=NOW()";
                        $sql=$sql." where cotizacion_id=".$cotizacion_id."";
                        //echo "sql ".$sql;
                        $res=mysql_query($sql);
                        $renglones=mysql_affected_rows();
                        if($res/*&&$renglones==1*/)
                                return "OK";
                          else 
                                return mysql_error()." sentencia:".$sql;
                        
                }
                
          function update_status($edo, $cotizacion, $obs)
          {
				
                  $sql = "update COTIZACION set cotizacion_edo=".$edo."";
                  if($obs=="")
                        $sql=$sql.", cotizacion_observaciones='".$obs."'";
                   $sql=$sql." where cotizacion_id=".$cotizacion."";
                  $res=mysql_query($sql);
                  $renglones=mysql_affected_rows();
				 // var_dump(exit);
                  if($res/*&&$renglones==1*/)
                        return "OK";
                  else 
                        return mysql_error();
          }
        
          function last_folio($user, $empresa)
          {
                  $sql = "SELECT cotizacion_folio from COTIZACION where empresa_id=".$empresa."   and cotizacion_folio<>0 ORDER BY cotizacion_folio DESC";
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
          
          function busqueda_parametros($search, $inicio, $fin)
          {
                  $search= str_replace(' ', '%', $search);
                  $sql="select COTIZACION.cotizacion_id, COTIZACION.cotizacion_edo, COTIZACION.cliente_id, COTIZACION.usuario_id, COTIZACION.empresa_id,COTIZACION.cotizacion_folio, COTIZACION.cotizacion_fecha_modificacion, COTIZACION.cotizacion_fecha_envio, COTIZACION.cotizacion_observaciones from COTIZACION";
                  if(!empty($search))
                  {
                   $sql=$sql.", CLIENTE, USUARIO, EMPRESA, GENERALES, DOMICILIO where (COTIZACION.cotizacion_id like '%".$search."%' OR USUARIO.usuario_id like '%".$search."%' OR CLIENTE.cliente_id like '%".$search."%'  OR CLIENTE.cliente_razonsocial like '%".$search."%' OR EMPRESA.empresa_id like '%".$search."%' OR EMPRESA.empresa_razonsocial like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%'  OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%'  OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' )  AND USUARIO.generales_id=GENERALES.generales_id AND CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id AND COTIZACION.cotizacion_edo<>0";
                  }
                  else
                   $sql=$sql." where COTIZACION.cotizacion_edo<>0";
                  $sql=$sql." LIMIT $inicio, $fin";
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
          
          function cuenta_resultado($search)
          {
                  $search= str_replace(' ', '%', $search);
                  $sql="select COTIZACION.cotizacion_id from COTIZACION";
                  if(!empty($search))
                  {
                   $sql=$sql.", CLIENTE, USUARIO, EMPRESA, GENERALES, DOMICILIO where (COTIZACION.cotizacion_id like '%".$search."%' OR USUARIO.usuario_id like '%".$search."%' OR CLIENTE.cliente_id like '%".$search."%'  OR CLIENTE.cliente_razonsocial like '%".$search."%' OR EMPRESA.empresa_id like '%".$search."%' OR EMPRESA.empresa_razonsocial like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%'  OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%'  OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' )  AND USUARIO.generales_id=GENERALES.generales_id AND CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id AND COTIZACION.cotizacion_edo<>0";
                  }
                  else
                   $sql=$sql." where COTIZACION.cotizacion_edo<>0";
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  return $renglones;
          }
          
          function busqueda_parametros_usuario($user, $search, $inicio, $fin, $filter)
          {

                  $search= str_replace(' ', '%', $search);
                  $sql="SELECT 
                  MAX(COTIZACION.cotizacion_id), 
                  COTIZACION.cotizacion_edo, 
                  COTIZACION.cliente_id, 
                  COTIZACION.empresa_id, 
                  COTIZACION.cotizacion_folio, 
                  COTIZACION.cotizacion_fecha_modificacion, 
                  COTIZACION.cotizacion_fecha_envio, 
                  COTIZACION.cotizacion_observaciones, 
                  COTIZACION.contacto_ventas_id, 
                  CLIENTE.cliente_razonsocial, 
                  EMPRESA.empresa_razonsocial,
                  COTIZACION.usuario_id from COTIZACION, EMPRESA, CLIENTE ";
                  if(!empty($search))
                  {
                   $sql=$sql.", USUARIO, GENERALES, DOMICILIO where (COTIZACION.cotizacion_id like '%".$search."%' OR USUARIO.usuario_id like '%".$search."%' OR CLIENTE.cliente_id like '%".$search."%'  OR CLIENTE.cliente_razonsocial like '%".$search."%' OR EMPRESA.empresa_id like '%".$search."%' OR EMPRESA.empresa_razonsocial like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%'  OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%'  OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' )  AND USUARIO.generales_id=GENERALES.generales_id AND CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id  AND CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id ";
                  }
                  else{
                    $sql=$sql." WHERE CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id ";
                  }

                
                  if($filter>=0)
                        $sql=$sql." AND COTIZACION.cotizacion_edo=".$filter;
                  else
                        $sql=$sql." AND COTIZACION.cotizacion_edo>=0";          
                  $sql=$sql." GROUP BY COTIZACION.cotizacion_id ORDER BY COTIZACION.cotizacion_id DESC LIMIT $inicio, $fin";

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
                       
                  }
               
                 $cont_array=0;
                 $array_completo=array(); 

                 for($x=0; $x<count($array);$x++)
                 {
                              $sql = "SELECT 
                            COTIZACION.cotizacion_id, 
                            COTIZACION.cotizacion_edo, 
                            COTIZACION.cliente_id, 
                            COTIZACION.empresa_id, 
                            COTIZACION.cotizacion_folio, 
                            COTIZACION.cotizacion_fecha_modificacion, 
                            COTIZACION.cotizacion_fecha_envio, 
                            COTIZACION.cotizacion_observaciones, 
                            COTIZACION.contacto_ventas_id, 
                            CLIENTE.cliente_razonsocial, 
                            EMPRESA.empresa_razonsocial,
                  COTIZACION.usuario_id from COTIZACION , CLIENTE, USUARIO, EMPRESA, DOMICILIO where    CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND 
                                    EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id and COTIZACION.cotizacion_id = ".$array[$x][0]."";
                             
                            $res=mysql_query($sql);
                            $renglones=mysql_num_rows($res);
                          
                            // create new empty array
                            
                            if($renglones>0)
                            {
                                    
                                    while($row=mysql_fetch_row($res))
                                    {
                                            $array_completo[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11]);
                                            //echo "".$array[$cont_array][0];
                                            $cont_array++;
                                    }
                                    
                            }
                       

                 }
                 return $array_completo;
  }
          
          function cuenta_resultado_usuario($user,$search, $filter)
          {
                  $search= str_replace(' ', '%', $search);
                  $sql="SELECT 
                  MAX(COTIZACION.cotizacion_id), 
                  COTIZACION.cotizacion_edo, 
                  COTIZACION.cliente_id, 
                  COTIZACION.empresa_id, 
                  COTIZACION.cotizacion_folio, 
                  COTIZACION.cotizacion_fecha_modificacion, 
                  COTIZACION.cotizacion_fecha_envio, 
                  COTIZACION.cotizacion_observaciones, 
                  COTIZACION.contacto_ventas_id, 
                  CLIENTE.cliente_razonsocial, 
                  EMPRESA.empresa_razonsocial,
                  COTIZACION.usuario_id from COTIZACION, EMPRESA, CLIENTE ";
               
                    $sql=$sql." WHERE CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id ";
                  


                  if($filter>=0)
                        $sql=$sql." AND COTIZACION.cotizacion_edo=".$filter;
                  else
                        $sql=$sql." AND COTIZACION.cotizacion_edo<>0"; 

                             $sql=$sql." GROUP BY COTIZACION.cotizacion_id ORDER BY COTIZACION.cotizacion_id DESC"; 
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  return $renglones;
          }
          
          function detalle($search)
          {
                  $sql = "SELECT 
                  COTIZACION.cotizacion_id, 
                  COTIZACION.cotizacion_edo, 
                  COTIZACION.cliente_id, 
                  COTIZACION.usuario_id, 
                  COTIZACION.empresa_id, 
                  COTIZACION.cotizacion_folio, 
                  COTIZACION.cotizacion_fecha_modificacion, 
                  date(COTIZACION.cotizacion_fecha_envio), 
                  COTIZACION.moneda_id, 
                  COTIZACION.cotizacion_divisa_dia, 
                  COTIZACION.cotizacion_observaciones, /*10*/
                  COTIZACION.contacto_ventas_id, 
                  COTIZACION.cotizacion_mensaje, 
                  CLIENTE.cliente_razonsocial, 
                  EMPRESA.empresa_razonsocial,  
                  GENERALES.nombre, 
                  GENERALES.apel_p, 
                  GENERALES.apel_m,
                  GENERALES.email,
                  COTIZACION.cotizacion_dias_entrega, 
                  COTIZACION.cotizacion_condiciones_pago, /*20*/
                  COTIZACION.cotizacion_vigencia,
                  COTIZACION.cotizacion_tipo,
                  COTIZACION.precio_cotizacion,   /*23*/
                  COTIZACION.lab,
                  COTIZACION.capacidad_entrega,
                  EMPRESA.iniciales,    /* 26 */
                  COTIZACION.muestra_existencia,
                  COTIZACION.muestra_flete,
                  COTIZACION.puesto
                  from COTIZACION, CLIENTE, EMPRESA,GENERALES,CONTACTO_VENTAS 
                  where  GENERALES.generales_id=CONTACTO_VENTAS.generales_id AND CONTACTO_VENTAS.contacto_ventas_id=COTIZACION.contacto_ventas_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id AND cotizacion_id=".$search."";
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
			
			function recotizar($id)
			{
				$sql="INSERT into COTIZACION(cotizacion_edo, cliente_id, usuario_id, empresa_id, cotizacion_folio, contacto_ventas_id, moneda_id, cotizacion_divisa_dia, cotizacion_mensaje, cotizacion_dias_entrega, cotizacion_vigencia, cotizacion_condiciones_pago) select 0,cliente_id, usuario_id, empresa_id, cotizacion_folio, contacto_ventas_id, moneda_id, cotizacion_divisa_dia, cotizacion_mensaje, cotizacion_dias_entrega, cotizacion_condiciones_pago, cotizacion_vigencia from COTIZACION where cotizacion_id=".$id."";
				$res=mysql_query($sql);
				  if($res)
				  {
						$id_recot=mysql_insert_id();
						$sql="update COTIZACION set cotizacion_edo=9, cotizacion_recotizada=".$id_recot." where cotizacion_id=".$id;
						$res=mysql_query($sql);
						if($res)
						{
							
						}
						else
						{
							$id_recot=0;
							printf("Error:".mysql_error());
						}
				  }
				  else
				  {
						  $id=0;
						  printf("Error:".mysql_error());
				  }
				  return $id_recot;
				
			}

          function p_sin_aprobar($user)
          {
                  // las cotizaciones pendientes por aprobar
                  $sql="SELECT COTIZACION.cotizacion_id FROM COTIZACION  WHERE COTIZACION.cotizacion_edo=2 and COTIZACION.usuario_id='".$user."' ";
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  return $renglones;
          }

          function p_pendientes()
          {
                  // las cotizaciones pendientes por aprobar
                  $sql="SELECT COTIZACION.cotizacion_id FROM COTIZACION  WHERE COTIZACION.cotizacion_edo<>6";
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  return $renglones;
          }
		
		}
    

?>