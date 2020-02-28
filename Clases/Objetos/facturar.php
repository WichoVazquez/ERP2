<?
      class Facturar
        {
          private $link;        
          function __construct()
          {
                 
          }

          function conexion($link_bd)
          {
                  $link=$link_bd;
          }
      
          

 function result_detalle_pedido2($idPedido,$folioOE) //filtro para almacen
      
          {
        $result_detalle=array();


        
       
        $sql="SELECT DISTINCT  
            DETALLE_PEDIDO.producto_id,
          DETALLE_PEDIDO.cantidad ,
          DETALLE_PEDIDO.precio_venta,
          DETALLE_PEDIDO.multiplo,
          MATERIAL.material_descripcion,
          MATERIAL.material_maquila,
          UNIDADES.prefijo,
          PEDIDO.pedido_estado,
          DETALLE_PEDIDO.cantidad_surtida,
          DETALLE_PEDIDO.detalle_pedido_id,
          DETALLE_PEDIDO.pedido_id,
          DETALLE_PEDIDO.cantidad,
          ALMACEN_MATERIAL.cantidad_actual,
          DETALLE_PEDIDO.facturado,
          MATERIAL.idSAE,
          RUTA_DETALLE.factura,
          RUTA_DETALLE.detalle_ruta_id
          from MATERIAL, UNIDADES, DETALLE_PEDIDO, PEDIDO, ALMACEN_MATERIAL, DETALLE_COTIZACION, RUTA_DETALLE 
          where detalle_pedido.pedido_id =".$idPedido."  AND MATERIAL.material_id=detalle_pedido.producto_id AND 
          UNIDADES.id_unidad=MATERIAL.id_unidad AND PEDIDO.pedido_id=DETALLE_PEDIDO.pedido_id AND almacen_material.material_id = MATERIAL.material_id and RUTA_DETALLE.PedidoDetalle_id  = DETALLE_PEDIDO.detalle_pedido_id AND RUTA_DETALLE.folio_OE ='".$folioOE."'  ";

          $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                    while($row=mysql_fetch_row($res))
                          {
                             $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10]
                                    , $row[11], $row[12], $row[13], $row[14], $row[15], $row[16]);
                                  //echo "".$array[$cont_array][0];
                                  $cont_array++;
                          }
                          return $array;
                  }
                  else
                          return null;
        
          }
         
          
          
          function busqueda_parametros($search, $inicio, $fin)
          {
                  $search= str_replace(' ', '%', $search);
                 $sql="SELECT  PEDIDO.pedido_id ,  CLIENTE.cliente_razonsocial , RUTA.ruta_estatus when 0 then 'Enrutado'  end as estatus, 
                  DETALLE_PEDIDO.detalle_cotizacion_id 
                  FROM PEDIDO, CLIENTE, EMPRESA, RUTA, DOMICILIO, CONTACTO_VENTAS, COTIZACION, DETALLE_PEDIDO, DETALLE_COTIZACION";
         
                  if(!empty($search))
                  {
                   $sql=$sql." (where PEDIDO.pedido_id '%$search%' or  CLIENTE.cliente_razonsocial like '%$search%') AND RUTA.ruta_estatus= '0' 
                  and DOMICILIO.domicilio_id = CLIENTE.cliente_domicilio_fiscal and 
                  CLIENTE.cliente_id=CONTACTO_VENTAS.cliente_id and COTIZACION.cotizacion_edo like '5' and 
                  DETALLE_COTIZACION.detalle_cotizacion_id=DETALLE_PEDIDO.detalle_cotizacion_id and PEDIDO.pedido_id=DETALLE_PEDIDO.pedido_id";
                  }
                 
                
           $sql=$sql." order by PEDIDO.pedido_id ASC";
                  $sql=$sql." LIMIT $inicio, $fin";
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($res))
                          {
                                  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3]);
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
                  $sql="SELECT  RUTA.ruta_id  FROM RUTA INNER JOIN  transporte ON  RUTA.transporte_id =  transporte.transporte_id ";
                  if(!empty($search))
                  {
                   $sql=$sql." where RUTA.ruta_id like '%$search%' or  transporte.transporte_nombre like '%$search%'";
                  }
          

          
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  return $renglones;
          }
          
         function busqueda_parametros_usuario($search, $inicio, $fin, $filter)
          {
                  $search= str_replace(' ', '%', $search);
                 $sql="SELECT PEDIDO.folio_pedido ,  CLIENTE.cliente_razonsocial, EMPRESA.empresa_razonsocial , PEDIDO.pedido_estado, COTIZACION.cotizacion_id, CLIENTE.cliente_id, PEDIDO.pedido_id, RUTA_DETALLE.folio_OE
                        FROM PEDIDO, CLIENTE, EMPRESA, DOMICILIO, COTIZACION, DETALLE_PEDIDO, RUTA_DETALLE
                        WHERE (PEDIDO.folio_pedido like '%$search%' or CLIENTE.cliente_razonsocial like '%$search%' or EMPRESA.empresa_razonsocial like '%$search%') AND
                        EMPRESA.empresa_id=COTIZACION.empresa_id AND DETALLE_PEDIDO.detalle_pedido_status=3 and 
                        CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id and CLIENTE.cliente_id=COTIZACION.cliente_id and 
                        PEDIDO.pedido_id=DETALLE_PEDIDO.pedido_id AND  COTIZACION.cotizacion_id=PEDIDO.cotizacion_id and DETALLE_PEDIDO.detalle_pedido_id = RUTA_DETALLE.PedidoDetalle_id 
                        GROUP BY PEDIDO.pedido_id,DETALLE_PEDIDO.pedido_id,RUTA_DETALLE.folio_OE";
      
                 
                //  $sql=$sql." LIMIT $inicio, $fin";     
                  $res=mysql_query($sql)or die(mysql_error());
                  $renglones=mysql_num_fields($res) or die(mysql_error());
                  $cont_array=0;
                  $array=array(); // create new empty array
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($res))
                          {
                                  
                                  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4],$row[5],$row[6],$row[7]);
                                  //echo "".$array[$cont_array][0];
                                  $cont_array++;
                          }
                          return $array;
                  }
                  else
                          return null;
          }


         


          
             function cuenta_resultado_usuario($search, $filter)
          {
                  $search= str_replace(' ', '%', $search);
                  $sql="SELECT  RUTA.ruta_id  FROM RUTA,transporte where RUTA.ruta_estatus<>2 ";
                    
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  return $renglones;
          }
          



          
        }


?>
