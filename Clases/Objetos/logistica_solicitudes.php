<?
      class Logistica_solicitudes
        {
          private $link;        
          function __construct()
          {
                 
          }
          function conexion($link_bd)
          {
                  $link=$link_bd;
          }
		  
		      
		  
		  function insertDetalle(
                   $ruta_id,
				   $pedido_detalle_id,
				   $cantidad
                   )
          {   


          
                  $id=0;
          $sql = "
                  insert into RUTA_DETALLE
                  (
                   ruta_id,
				   PedidoDetalle_id,
				   cantidadEnrutada
                  )
                   values
                  (".$ruta_id.",".$pedido_detalle_id.",".$cantidad.")";


                  $res=mysql_query($sql);
                  if($res){
                             //hace la suma de surtido de la tabla de pedido detalle
							  $sql = "update  DETALLE_PEDIDO set cantidad_enrutada = cantidad_enrutada +".$cantidad." where detalle_pedido_id=".$pedido_detalle_id;
				  
                  $res=mysql_query($sql);  
				  			if  ($res)
							{  
                          $id=mysql_insert_id();
						  }
						  else
						  {
						  $id=$sql. "Error:".mysql_error();
                          printf($sql. "Error:".mysql_error());
						  }
					}
						  
                  else
                  {
                          $id=0;
                          printf($sql. "Error:".mysql_error());
                  }
                  return $id;
          }

      function insertDetalle_recoleccion(
                   $ruta_id,
           $pedido_detalle_id,
           $cantidad
                   )
          {   
                  $id=0;
          $sql = "
                  insert into RUTA_DETALLE
                  (
                   ruta_id,
                   PedidoDetalle_id
                  )
                   values
                  (
                   ".$ruta_id.",".$pedido_detalle_id.")";

                  $res=mysql_query($sql);
                  if($res){
                             //hace la suma de surtido de la tabla de pedido detalle
                $sql = "UPDATE  DETALLE_PEDIDO set detalle_pedido_status = 8  where 
                detalle_pedido_id=".$pedido_detalle_id." and 
                cantidad_prestamo=".$cantidad;
         
                  $res=mysql_query($sql);  
                if  ($res)
              {  
                          $id=mysql_insert_id();
              }
              else
              {
              $id=$sql. "Error:".mysql_error();
                          printf($sql. "Error:".mysql_error());
              }
          }
              
                  else
                  {
                          $id=0;
                          printf($sql. "Error:".mysql_error());
                  }
                  return $id;
          }		  
          function insert(
                   $id_detalle_pedido,
                   $fecha_entrega,
                   $destino,
                   $observaciones,
                   $id_usuario,
                   $cantidad
                   )
          {   
                  $id=0;
              $sql = "INSERT into logistica_solicitudes
                  (
                   id_detalle_pedido,
                   fecha_entrega,
                   fecha_reg,
                   destino,
                   observaciones, 
                   id_usuario,
                   cantidad
                  )
                   values
                  (
                   ".$id_detalle_pedido.", 
                   '".$fecha_entrega."',
                   NOW(),
                   '".$destino."',
                   '".$observaciones."',
                   '".$id_usuario."',
                   ".$cantidad."
                   )";
                  $res=mysql_query($sql);
                  if($res)
                                  
                          $id=mysql_insert_id();
						  
                        //  printf("Errora:".$id);
                  else
                  {
                          $id=0;
                          printf("Error:".mysql_error());
                  }
                  return $id;
          }
		  
		  

    function deleteDetalle($id)
          {
                        //hace la suma de surtido de la tabla de pedido detalle
		  		$sql = "UPDATE DETALLE_PEDIDO as dp
inner join RUTA_DETALLE as dr on dp.detalle_pedido_id= dr.PedidoDetalle_id
inner join DETALLE_COTIZACION as dc on dp.detalle_cotizacion_id = dc.detalle_cotizacion_id
set dr.cantidadEntregada=0, dp.cantidad_enrutada = dp.cantidad_enrutada-dr.cantidadEnrutada
where dr.ruta_id=".$id;
				  
                 
                  $res=mysql_query($sql);
                  $renglones=mysql_affected_rows();
                  if($res)
				  {
					 $sql="delete from RUTA_DETALLE where ruta_id=".$id."";
                 	 $res=mysql_query($sql);  
				  		if  ($res)
							{  
                          return "OK";
						  }
						  else
						  {
						 return $sql.mysql_error();
						  }
						
					}
                  else 
                        return $sql.mysql_error();
          }
		  
		  

          
          function delete($id)
          {
                  $sql="update RUTA set ruta_estatus=1 where ruta_id=".$id."";
                  $res=mysql_query($sql);
                  $renglones=mysql_affected_rows();
                  if($res&&$renglones==1)
				  {
                        //hace la suma de surtido de la tabla de pedido detalle
					$sql = "UPDATE DETALLE_PEDIDO as dp
inner join RUTA_DETALLE as dr on dp.detalle_pedido_id= dr.PedidoDetalle_id
inner join DETALLE_COTIZACION as dc on dp.detalle_cotizacion_id = dc.detalle_cotizacion_id
set dr.cantidadEntregada=0, dp.cantidad_enrutada = dp.cantidad_enrutada-dr.cantidadEnrutada
where dr.ruta_id=".$id;
				  
                 	 $res=mysql_query($sql);  
				  		if  ($res)
							{  
                          return "OK";
						  }
						  else
						  {
						 return $sql.mysql_error();
						  }
						
					}
                  else 
                        return $sql.mysql_error();
          }
          
function update_status(
          $idRuta,
				  $ruta_estatus
                )
                {
                 $sql = "update RUTA
                  set ruta_estatus=".$ruta_estatus." where ruta_id=".$idRuta;
                  $res=mysql_query($sql);
                  if($res)
                                  
                          $id=mysql_insert_id();
						  
                        //  printf("Errora:".$id);
                  else
                  {
                          $id=0;
                        printf("Error:".mysql_error());
                  }
                  return $id;                       
}
                
     
          
          
         
          
          function busqueda_parametros( $search, $inicio, $fin, $filter)
          {
                  $search= str_replace(' ', '%', $search);
                  $sql=" SELECT 
                   LOGISTICA_SOLICITUDES.id_logistica_solicitud, 
                   LOGISTICA_SOLICITUDES.id_usuario, 
                   MATERIAL.material_descripcion, 
                   UNIDADES.prefijo,
                   LOGISTICA_SOLICITUDES.cantidad, 
                   LOGISTICA_SOLICITUDES.fecha_entrega, 
                   LOGISTICA_SOLICITUDES.destino, 
                   LOGISTICA_SOLICITUDES.observaciones, 
                   LOGISTICA_SOLICITUDES.id_usuario_rev, 
                   LOGISTICA_SOLICITUDES.fecha_rev, 
                   LOGISTICA_SOLICITUDES.status 
                   FROM 
                   LOGISTICA_SOLICITUDES, 
                   DETALLE_PEDIDO, 
                   MATERIAL, 
                   UNIDADES 
                   WHERE 
                   DETALLE_PEDIDO.detalle_pedido_id = LOGISTICA_SOLICITUDES.id_detalle_pedido AND DETALLE_PEDIDO.producto_id = MATERIAL.material_id AND UNIDADES.id_unidad = MATERIAL.id_unidad 
                    ";
				  
                 
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($res))
                          {
                                  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
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
                  $sql="SELECT  *
                  FROM
                   LOGISTICA_SOLICITUDES ";
                 				
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  return $renglones;
          }
          
          function detalle($search)
          {
                  $sql = "SELECT 
                  CLIENTE.cliente_razonsocial, 
                  PEDIDO.folio_pedido, 
                  date( PEDIDO.pedido_fecha_entrega ) , 
                  MATERIAL.material_descripcion, 
                  DETALLE_PEDIDO.cantidad - DETALLE_PEDIDO.cantidad_enrutada + RUTA_DETALLE.cantidadEnrutada, 
                  RUTA_DETALLE.cantidadEnrutada, 
                  RUTA_DETALLE.PedidoDetalle_id,
                  RUTA_DETALLE.cantidadEntregada
FROM RUTA_DETALLE, RUTA, CLIENTE, MATERIAL, COTIZACION, DETALLE_PEDIDO, PEDIDO
WHERE COTIZACION.cotizacion_id = PEDIDO.cotizacion_id
AND COTIZACION.cliente_id = CLIENTE.cliente_id
AND PEDIDO.pedido_id = DETALLE_PEDIDO.pedido_id
AND RUTA.ruta_id = RUTA_DETALLE.ruta_id
AND DETALLE_PEDIDO.producto_id = MATERIAL.material_id
AND DETALLE_PEDIDO.detalle_pedido_id = RUTA_DETALLE.PedidoDetalle_id
AND RUTA.ruta_id =".$search."";



                $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($res))
                          {
                                  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5],$row[6],$row[7]);
                                  //echo "".$array[$cont_array][0];
                                  $cont_array++;
                          }
                          return $array;
                  }
                  else
                          return null;
          }
		  
		  
		  // funciones de entrega
		  
		   function busqueda_parametros_entrega( $search, $inicio, $fin, $filter)
          {
                  $search= str_replace(' ', '%', $search);
                  $sql="SELECT  RUTA.ruta_id ,  transporte.transporte_nombre ,  case RUTA.ruta_estatus 
                  when 1 then 'En Ruta' 
                  when 2 then 'Cancelado' 
                  when 3 then 'Entregado' end as estatus, RUTA.transporte_id, RUTA.fecha_creacion FROM ruta INNER JOIN  transporte ON  RUTA.transporte_id =  transporte.transporte_id where RUTA.ruta_estatus>0 ";
				  
                  if(!empty($search))
                  {
                      $sql=$sql."AND (RUTA.ruta_id like '%".$search."%' or  transporte.transporte_nombre like '%".$search."%')"; 
					  if($filter>-1)
                        $sql=$sql." and  RUTA.ruta_estatus=".($filter );
                 		 
                  }else
				  {
				 	 if($filter>-1)
                        $sql=$sql." and  RUTA.ruta_estatus=".($filter );
                 		
				  }
                 				   $sql=$sql." order by RUTA.ruta_id DESC, RUTA.ruta_estatus ";
						    
                  $sql=$sql." LIMIT $inicio, $fin";


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
          
          function cuenta_resultado_entrega($search, $filter)
          {
                  $search= str_replace(' ', '%', $search);
                  $sql="SELECT  RUTA.ruta_id  FROM RUTA, transporte where RUTA.ruta_estatus<>2 ";
                  if(!empty($search))
                  {
                      $sql=$sql."and (RUTA.ruta_id like '%".$search."%' or  transporte.transporte_nombre like '%".$search."%')"; 
					  if($filter>0)
                        $sql=$sql." AND  RUTA.ruta_estatus=".($filter );
                 		 
                  }else
				  {
				 	 if($filter>0)
                        $sql=$sql." and RUTA.ruta_estatus=".($filter );
                 		
				  }  
						
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  return $renglones;
          }
		  
		  
		  
		  
		 function updateGeneral(
                  $idRuta,
				  $Observaciones
                )
                {
                 $sql = "update RUTA
                  set ruta_observaciones='".$Observaciones."', ruta_estatus=3 where ruta_id=".$idRuta;
                  $res=mysql_query($sql);
                  if($res)
                                  
                          $id="0";
						  
                        //  printf("Errora:".$id);
                  else
                  {
                          $id=mysql_error();
                          printf("Error:".mysql_error());
                  }
                  return $id;
                        
                }
				
				
				
		function updateEntrega(
                   $id_detalle,
				   $cantidad_enrutada,
				   $cantidad_entregada,
				   $observaciones,
           $status
                   )
          {   
        //         $sql = "call detalle_entrega(".$id_detalle.",".$cantidad_enrutada.",".$cantidad_entregada.",'".$observaciones."',".$status.")"; 

		   $sql = "UPDATE RUTA_DETALLE, DETALLE_PEDIDO 
                  set RUTA_DETALLE.cantidadEntregada=".$cantidad_entregada.", 
                  DETALLE_PEDIDO.cantidad_entregada=".$cantidad_entregada.",
                  RUTA_DETALLE.ruta_detalle_estatus = ".$status." 
                   where RUTA_DETALLE.detalle_ruta_id=".$id_detalle." and DETALLE_PEDIDO.detalle_pedido_id= RUTA_DETALLE.PedidoDetalle_id";

                  $res=mysql_query($sql);
                  if($res)
                                  
                          $id=mysql_insert_id();
        
                        //  printf("Errora:".$id);
                  else
                  {
                          $id=0;
                          printf("Error:".mysql_error());
                  }
                  return $id;
          }
				
				
		  function updateEntrega_recoleccion(
                   $id_detalle,
       $cantidad_enrutada,
       $cantidad_entregada,
       $observaciones
                   )
          {   

 $sql = "UPDATE PEDIDO
                  set PEDIDO.pedido_estado=1, 
                  FROM PEDIDO INNER JOIN DETALLE_PEDIDO
                   where PEDIDO.pedido_id =  DETALLE_PEDIDO.detalle_pedido_id=".$id_detalle;
                  $res=mysql_query($sql);
                  if($res)
                                  
                          $id=mysql_insert_id();
        
                                           //  printf("Errora:".$id);
                  else
                  {
                          $id=0;
                          printf("Error:".mysql_error());
                  }     //  printf("Errora:".$id);

 $sql = "UPDATE DETALLE_PEDIDO
                  set cantidad=".$cantidad_entregada.", 
                  detalle_pedido_status = 15
                   where detalle_pedido_id=".$id_detalle;

               

                  $res=mysql_query($sql);
                  if($res)
                                  
                          $id=mysql_insert_id();
        
                        //  printf("Errora:".$id);
                  else
                  {
                          $id=0;
                          printf("Error:".mysql_error());
                  }
                  return $id;

          }
    
		 function detalleEntrega($search,$IdOS)
          {
                  $sql ="SELECT
RUTA_DETALLE.detalle_ruta_id, /* 0 */
RUTA_DETALLE.PedidoDetalle_id,
CLIENTE.cliente_razonsocial,
MATERIAL.material_descripcion,
RUTA_DETALLE.cantidadEnrutada, /* 4 */
RUTA_DETALLE.cantidadEntregada,
RUTA.ruta_observaciones,
TRANSPORTE.transporte_nombre,
PEDIDO.pedido_id,
PEDIDO.pedido_estado,          /* 9*/
PEDIDO.folio_pedido,
DETALLE_PEDIDO.cantidad_recoger,
DETALLE_PEDIDO.detalle_pedido_id
FROM
RUTA_DETALLE, RUTA, CLIENTE, MATERIAL, TRANSPORTE, COTIZACION, DETALLE_PEDIDO, PEDIDO
where
COTIZACION.cotizacion_id = PEDIDO.cotizacion_id and
COTIZACION.cliente_id = CLIENTE.cliente_id and
TRANSPORTE.transporte_id = RUTA.transporte_id and
PEDIDO.pedido_id = DETALLE_PEDIDO.pedido_id and
RUTA.ruta_id = RUTA_DETALLE.ruta_id AND
DETALLE_PEDIDO.producto_id = MATERIAL.material_id and
DETALLE_PEDIDO.detalle_pedido_id = RUTA_DETALLE.PedidoDetalle_id and
RUTA.ruta_id = ".$search." AND DETALLE_PEDIDO.pedido_id=".$IdOS." 
ORDER BY PEDIDO.pedido_estado ASC
";
 $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($res))
                          {
                                  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12]);
                                  //echo "".$array[$cont_array][0];
                                  $cont_array++;
                          }
                          return $array;
                  }
                  else
                          return null;
          }

function sumarioEntrega($search)
          {
                  $sql ="SELECT
CLIENTE.cliente_razonsocial,
PEDIDO.pedido_id,
PEDIDO.folio_pedido,
PEDIDO.pedido_fecha_entrega,
PEDIDO.pedido_estado,
TRANSPORTE.transporte_nombre,
case DETALLE_PEDIDO.detalle_pedido_status 
when 3 then 'Entrega' 
else 'Recolección'
end as tipo,
RUTA_DETALLE.folio_OE,
RUTA_DETALLE.ruta_detalle_estatus
FROM
RUTA_DETALLE, RUTA, CLIENTE, COTIZACION, DETALLE_PEDIDO, PEDIDO, TRANSPORTE  
where
COTIZACION.cotizacion_id = PEDIDO.cotizacion_id and
COTIZACION.cliente_id = CLIENTE.cliente_id and
PEDIDO.pedido_id = DETALLE_PEDIDO.pedido_id and
RUTA.ruta_id = RUTA_DETALLE.ruta_id AND
DETALLE_PEDIDO.detalle_pedido_id = RUTA_DETALLE.PedidoDetalle_id and RUTA.transporte_id = TRANSPORTE.transporte_id AND RUTA.ruta_id = ".$search. " 
GROUP BY DETALLE_PEDIDO.pedido_id, RUTA_DETALLE.folio_OE 
";



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
				
	function ObtieneOrdenes_recoleccion()
          {
      
     $sql="SELECT 
dp.detalle_pedido_id
,sp.folio_pedido
,c.cliente_razonsocial
,date(sp.pedido_fecha_entrega)
,m.material_descripcion,
dp.cantidad_enrutada,
dp.cantidad_recoger,
dp.cantidad_prestamo,
dp.fecha_recoleccion,
dp.cantidad - dp.cantidad_enrutada
 from 
DETALLE_PEDIDO as dp, 
PEDIDO as sp,
MATERIAL as m,
COTIZACION as sc,
CLIENTE as c
where 
(dp.detalle_pedido_status =7 OR
dp.detalle_pedido_status =3) and
dp.pedido_id= sp.pedido_id and
dp.producto_id=m.material_id and
sp.cotizacion_id=sc.cotizacion_id and
sc.cliente_id=c.cliente_id 
order by sp.pedido_fecha_entrega desc
";
     
    //  $sql=$sql." LIMIT $inicio, $fin";
      $res=mysql_query($sql);
      $renglones=mysql_num_rows($res);
      $cont_array=0;
      $array=array(); // create new empty array
      
      if($renglones>0)
      {
        
        while($row=mysql_fetch_row($res))
          {
          $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9]);
          //echo "".$array[$cont_array][0];
          $cont_array++;
        }
        return $array;
      }
      else
          return null;
                  
                 
          }

 function ObtieneOrdenes()
          {
      
     $sql="SELECT 
dp.detalle_pedido_id
,sp.folio_pedido
,c.cliente_razonsocial
,date(sp.pedido_fecha_entrega)
,m.material_descripcion,
dp.cantidad_enrutada,
dp.cantidad_recoger,
dp.cantidad_prestamo,
dp.fecha_recoleccion,
dp.cantidad,
dp.cantidad-dp.cantidad_enrutada
 from 
DETALLE_PEDIDO as dp, 
PEDIDO as sp,
MATERIAL as m,
COTIZACION as sc,
CLIENTE as c
where 
dp.detalle_pedido_status =3 and
dp.pedido_id= sp.pedido_id and
dp.producto_id=m.material_id and
sp.cotizacion_id=sc.cotizacion_id and
sc.cliente_id=c.cliente_id and 
dp.cantidad_enrutada<dp.cantidad
order by sp.pedido_fecha_entrega desc
";
     
    //  $sql=$sql." LIMIT $inicio, $fin";
      $res=mysql_query($sql);
      $renglones=mysql_num_rows($res);
      $cont_array=0;
      $array=array(); // create new empty array
      
      if($renglones>0)
      {
        
        while($row=mysql_fetch_row($res))
          {
          $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10]);
          //echo "".$array[$cont_array][0];
          $cont_array++;
        }
        return $array;
      }
      else
          return null;
                  
                 
          }


function ObtieneOrdenes_sumario()
          {
      
     $sql="SELECT 
sp.pedido_id,
sp.folio_pedido,
c.cliente_razonsocial,
date(sp.pedido_fecha_entrega),
dp.detalle_pedido_status,
date(sp.pedido_fecha_recoleccion),
case dp.detalle_pedido_status when 3 then 'Entrega' when 7 then 'Recolección'  end as tipo,
d.domicilio_calle,
d.domicilio_num_ext,
d.domicilio_colonia,
d.domicilio_municipio,
d.domicilio_cp
 from 
DETALLE_PEDIDO as dp, 
PEDIDO as sp,
COTIZACION as sc,
CLIENTE as c,
DOMICILIO as d
where 
(dp.detalle_pedido_status =7 OR
dp.detalle_pedido_status =3) and
dp.pedido_id= sp.pedido_id and
sp.cotizacion_id=sc.cotizacion_id and
sc.cliente_id=c.cliente_id and 
dp.cantidad_enrutada<dp.cantidad and
d.domicilio_id = c.cliente_domicilio_fiscal
group by dp.fecha_recoleccion, dp.pedido_id   
order by sp.pedido_fecha_entrega desc 
";
     
    //  $sql=$sql." LIMIT $inicio, $fin";
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
 function obtenerOrden_Detalle($orden_id)
          {
      
     $sql="SELECT 
dp.detalle_pedido_id
,sp.folio_pedido
,c.cliente_razonsocial
,date(sp.pedido_fecha_entrega)
,m.material_descripcion,
dp.cantidad_enrutada,
dp.cantidad_recoger,
dp.cantidad_prestamo,
dp.fecha_recoleccion,
dp.cantidad,
dp.cantidad-dp.cantidad_enrutada,
case dp.detalle_pedido_status when 3 then 'Entrega' when 7 then 'Recolección'  end as tipo
,date(sp.pedido_fecha_recoleccion)
 from 
DETALLE_PEDIDO as dp, 
PEDIDO as sp,
MATERIAL as m,
COTIZACION as sc,
CLIENTE as c
where 
(dp.detalle_pedido_status =7 or 
dp.detalle_pedido_status =3) and 
dp.pedido_id= sp.pedido_id and
dp.producto_id=m.material_id and
sp.cotizacion_id=sc.cotizacion_id and
sc.cliente_id=c.cliente_id and 
dp.cantidad_enrutada<dp.cantidad and
dp.pedido_id = ".$orden_id." 
order by sp.pedido_fecha_entrega desc
";
     
    //  $sql=$sql." LIMIT $inicio, $fin";
      $res=mysql_query($sql);
      $renglones=mysql_num_rows($res);
      $cont_array=0;
      $array=array(); // create new empty array
      
      if($renglones>0)
      {
        
        while($row=mysql_fetch_row($res))
          {
          $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12]);
          //echo "".$array[$cont_array][0];
          $cont_array++;
        }
        return $array;
      }
      else
          return null;
                  
                 
          }

function Obtiene_Rutas($idpedido)
          {
      
     $sql="SELECT 
sp.pedido_id,
sp.folio_pedido,
c.cliente_razonsocial,
date(sp.pedido_fecha_entrega),
dp.detalle_pedido_status,
dp.fecha_recoleccion,
case dp.detalle_pedido_status when 3 then 'Entrega' when 8 then 'Recolección'  end as tipo
 from 
DETALLE_PEDIDO as dp, 
PEDIDO as sp,
COTIZACION as sc,
CLIENTE as c
where 
sp.pedido_id = ".$idpedido." and
(dp.detalle_pedido_status =8 OR
dp.detalle_pedido_status =3) and
dp.pedido_id= sp.pedido_id and
sp.cotizacion_id=sc.cotizacion_id and
sc.cliente_id=c.cliente_id 
group by dp.fecha_recoleccion   
order by sp.pedido_fecha_entrega desc 
";
     
    //  $sql=$sql." LIMIT $inicio, $fin";

      $res=mysql_query($sql);
      $renglones=mysql_num_rows($res);
      $cont_array=0;
      $array=array(); // create new empty array
      
      if($renglones>0)
      {
        
        while($row=mysql_fetch_row($res))
          {
          $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
          //echo "".$array[$cont_array][0];
          $cont_array++;
        }
        return $array;
      }
      else
          return null;
                  
                 
          }
function updateEntrega_OE(
                   $idOS,
                   $folioOE
                   )
          {   
          $sql = "UPDATE RUTA_DETALLE, DETALLE_PEDIDO 
          set RUTA_DETALLE.folio_OE='".$folioOE."' 
          where  DETALLE_PEDIDO.pedido_id=".$idOS." AND RUTA_DETALLE.PedidoDetalle_id = DETALLE_PEDIDO.detalle_pedido_id
           ";
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
    
function GuardaFactura(
                   $idRutaDetalle,
                   $factura_no
                   )
          {   
          $sql = "UPDATE RUTA_DETALLE 
          set RUTA_DETALLE.factura='".$factura_no."' 
          where  RUTA_DETALLE.detalle_ruta_id=".$idRutaDetalle."";
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
	//fin
   }

?>