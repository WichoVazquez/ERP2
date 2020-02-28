<?
      class Reporte
        {
          private $link;        
          function __construct()
          {
                 
          }
          function conexion($link_bd)
          {
                  $link=$link_bd;
          }


          function reporte_cotizacion($user) 
          {

            $qry=mysql_query("SELECT DAY(cotizacion_fecha_modificacion) AS DIA, MONTH(cotizacion_fecha_modificacion) AS MES,  SUM(precio_venta * cantidad) AS TOTAL FROM DETALLE_COTIZACION, COTIZACION, USUARIO, USUARIO_CLIENTE WHERE COTIZACION.cotizacion_edo=6 AND DETALLE_COTIZACION.cotizacion_id = COTIZACION.cotizacion_id AND USUARIO_CLIENTE.usuario_id='$user' AND USUARIO_CLIENTE.usuario_id=COTIZACION.usuario_id GROUP BY DIA, MES  ");
          
    
                  $renglones=mysql_num_rows($qry);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($qry))
                          {
                                  $array[$cont_array]=array($row[0], $row[1], $row[2]);
                                  //echo "".$array[$cont_array][0];
                                  $cont_array++;
                          }
                          return $array;
                  }
                  else
                          return null;
            }
        

function reporte_OrdenSalida($user) 
          {

            $qry=mysql_query("SELECT DAY(pedido_fecha_creacion) AS DIA, MONTH(pedido_fecha_creacion) AS MES,  SUM(precio_venta * cantidad) AS TOTAL FROM detalle_pedido, pedido, usuario, usuario_cliente WHERE detalle_pedido.detalle_pedido_status=3 AND detalle_pedido.pedido_id = pedido.pedido_id AND usuario_cliente.usuario_id='$user' AND usuario_cliente.usuario_id=usuario.usuario_id GROUP BY DIA  ");
          
    
                  $renglones=mysql_num_rows($qry);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($qry))
                          {
                                  $array[$cont_array]=array($row[0], $row[1], $row[2]);
                                  //echo "".$array[$cont_array][0];
                                  $cont_array++;
                          }
                          return $array;
                  }
                  else
                          return null;
            }

function reporte_Facturado($user) 
          {

            $qry=mysql_query("SELECT DAY(factura_fecha) AS DIA, MONTH(factura_fecha) AS MES,  SUM(precio_venta * cantidad) AS TOTAL FROM detalle_pedido, pedido, factura, usuario,usuario_cliente WHERE
             factura.pedido_id= detalle_pedido.pedido_id AND factura.pedido_id=pedido.pedido_id AND factura.factura_status<2 AND usuario_cliente.usuario_id='$user' AND usuario_cliente.usuario_id=usuario.usuario_id  GROUP BY DIA , MES ");
          
    
                  $renglones=mysql_num_rows($qry);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($qry))
                          {
                                  $array[$cont_array]=array($row[0], $row[1], $row[2]);
                                  //echo "".$array[$cont_array][0];
                                  $cont_array++;
                          }
                          return $array;
                  }
                  else
                          return null;
            }

function reporte_Entregado($user) 
          {

            $qry=mysql_query("SELECT DAY(ruta.fecha_creacion) AS DIA, MONTH(ruta.fecha_creacion) AS MES,  SUM(precio_venta * cantidad) AS TOTAL FROM detalle_pedido, pedido, ruta_detalle, ruta, usuario,usuario_cliente WHERE
             ruta_detalle.PedidoDetalle_id=pedido.pedido_id AND ruta.ruta_id=ruta_detalle.ruta_id AND ruta.ruta_estatus=3 AND usuario_cliente.usuario_id='$user' AND usuario_cliente.usuario_id=usuario.usuario_id AND detalle_pedido.pedido_id=pedido.pedido_id  GROUP BY DIA , MES ");
          
    
                  $renglones=mysql_num_rows($qry);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($qry))
                          {
                                  $array[$cont_array]=array($row[0], $row[1], $row[2]);
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