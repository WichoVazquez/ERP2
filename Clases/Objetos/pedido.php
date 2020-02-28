<?
class Pedido
{
  private $link;
  
  function __construct()
  {
  }
  
  function conexion($link_bd)
  {
    $link=$link_bd;
  }
  
  function insert_empty_cot($cotizacion)
  {
    $sql=
       "INSERT INTO PEDIDO
      (
        cotizacion_id,
        pedido_fecha_entrega
      )
      values
      (".$cotizacion.",
       date_add(CURRENT_TIMESTAMP, INTERVAL (select cotizacion_dias_entrega from COTIZACION where cotizacion_id=".$cotizacion.") DAY)
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
  
    function insert_pedido($cotizacion, $suc, $f_inicio, $f_entrega)
    {
      $sql="INSERT INTO PEDIDO (
        cotizacion_id,
        sucursal_id,                   
        pedido_fecha_creacion, 
        pedido_fecha_entrega) 
        VALUES(".$cotizacion.",".$suc.",'".$f_inicio."','".$f_entrega."')";
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
    
        function insert_pedido_sumario($cotizacion, $suc, $f_inicio, $f_entrega, $obs_pedido, $folioOS, $usuario)
    {
      $sql="INSERT INTO PEDIDO (
        cotizacion_id,
        sucursal_id,                   
        pedido_fecha_creacion, 
        pedido_fecha_entrega,
        pedido_obs,
        folio_pedido,
        usuario_id) 

        VALUES(".$cotizacion.",".$suc.",'".$f_inicio."','".$f_entrega."','".$obs_pedido."','".$folioOS."','".$usuario."')";
  
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


     function insert_pedido_sumario_recoleccion($cotizacion, $suc, $f_inicio, $f_recoleccion, $obs_pedido, $folioOS, $usuario)
    {
      $sql="INSERT INTO PEDIDO (
        cotizacion_id,
        sucursal_id,                   
        pedido_fecha_creacion, 
        pedido_fecha_recoleccion,
        pedido_obs,
        folio_pedido,
        usuario_id) 

        VALUES(".$cotizacion.",".$suc.",'".$f_inicio."','".$f_recoleccion."','".$obs_pedido."','".$folioOS."','".$usuario."')";
  
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
    
  function select()
  {
    $sql="SELECT * FROM PEDIDO";
    $res=mysql_query($sql);
      $renglones=mysql_num_rows($res);
      $cont_array=0;
      $array=array(); // create new empty array
      
      if($renglones>0)
      {
        
        while($row=mysql_fetch_row($res))
          {
          $array[$cont_array]=array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8]);
          //echo "".$array[$cont_array][0];
          $cont_array++;
        }
        return $array;
      }
      else
          return null;
  }

      function busqueda_detalle($search)
    {
      $sql = "SELECT 
          DETALLE_COTIZACION.detalle_cotizacion_id , 
          DETALLE_COTIZACION.producto_id,
          DETALLE_COTIZACION.cantidad ,
          DETALLE_COTIZACION.cotizacion_id ,
          DETALLE_COTIZACION.precio_venta,
          DETALLE_COTIZACION.observaciones,
          DETALLE_COTIZACION.multiplo,
          MATERIAL.material_descripcion,
          UNIDADES.prefijo,
          MATERIAL.material_id,
          MATERIAL_TIPO.nombre
          from DETALLE_COTIZACION, MATERIAL, UNIDADES, MATERIAL_TIPO
          where DETALLE_COTIZACION.cotizacion_id=".$search." 
          AND MATERIAL.material_id=DETALLE_COTIZACION.producto_id AND 
          UNIDADES.id_unidad=MATERIAL.id_unidad AND MATERIAL.material_tipo = MATERIAL_TIPO.material_tipo";
    
      $res=mysql_query($sql);
      $renglones=mysql_num_rows($res);
      $cont_array=0;
      $array=array(); // create new empty array
      
      if($renglones>0)
      {
        
        while($row=mysql_fetch_row($res))
          {
          $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8] , $row[9], $row[10]);
          //echo "".$array[$cont_array][0];
          $cont_array++;
        }
        return $array;
      }
      else
          return null;
    }
 function detalle_pedido($search)
    {
      $sql = "SELECT 
          DETALLE_PEDIDO.detalle_pedido_id, 
          DETALLE_PEDIDO.producto_id,
          DETALLE_PEDIDO.cantidad,
          DETALLE_PEDIDO.pedido_id ,
          DETALLE_PEDIDO.precio_venta,
          PEDIDO.pedido_obs,
          DETALLE_PEDIDO.multiplo,
          MATERIAL.material_descripcion,
          UNIDADES.prefijo,
          MATERIAL.material_id,
          MATERIAL_TIPO.nombre,
          DETALLE_PEDIDO.cantidad_surtida
          from DETALLE_PEDIDO, MATERIAL, UNIDADES, MATERIAL_TIPO, PEDIDO
          where 
          MATERIAL.material_id=DETALLE_PEDIDO.producto_id AND 
          DETALLE_PEDIDO.pedido_id=PEDIDO.pedido_id AND
          UNIDADES.id_unidad=MATERIAL.id_unidad AND 
          MATERIAL.material_tipo = MATERIAL_TIPO.material_tipo and DETALLE_PEDIDO.pedido_id=".$search." ";
    
      $res=mysql_query($sql);
      $renglones=mysql_num_rows($res);
      $cont_array=0;
      $array=array(); // create new empty array
      
      if($renglones>0)
      {
        
        while($row=mysql_fetch_row($res))
          {
          $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8] , $row[9], $row[10], $row[11]);
          //echo "".$array[$cont_array][0];
          $cont_array++;
        }
        return $array;
      }
      else
          return null;
    }
function detalle_pedido_nota($search)
    {
      $sql = "SELECT HISTORICO.id_historico, 
      HISTORICO.id_producto, 
      HISTORICO.cantidad, 
      MATERIAL.material_descripcion, 
      UNIDADES.prefijo, 
      MATERIAL.material_id, 
      MATERIAL_TIPO.nombre, 
      (HISTORICO.cantidad*-1), 
      PRESENTACIONES.descripcion, 
      HISTORICO.fecha, 
      HISTORICO.nota_salida 
      from MATERIAL, UNIDADES, MATERIAL_TIPO, HISTORICO, PRESENTACIONES where MATERIAL.material_id=HISTORICO.id_producto AND UNIDADES.id_unidad=MATERIAL.id_unidad AND PRESENTACIONES.id_presentacion = MATERIAL.id_presentacion AND MATERIAL.material_tipo = MATERIAL_TIPO.material_tipo and HISTORICO.id_historico=".$search." ";
    
      $res=mysql_query($sql);
      $renglones=mysql_num_rows($res);
      $cont_array=0;
      $array=array(); // create new empty array
      
      if($renglones>0)
      {
        
        while($row=mysql_fetch_row($res))
          {
          $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8] , $row[9], $row[10]);
          //echo "".$array[$cont_array][0];
          $cont_array++;
        }
        return $array;
      }
      else
          return null;
    }
 function busqueda_detalleRecargas($search)
    {
      $sql = "SELECT 
          DETALLE_COTIZACION.detalle_cotizacion_id , 
          DETALLE_COTIZACION.producto_id,
          DETALLE_COTIZACION.cantidad ,
          DETALLE_COTIZACION.cotizacion_id ,
          DETALLE_COTIZACION.precio_venta,
          DETALLE_COTIZACION.observaciones,
          DETALLE_COTIZACION.multiplo,
          MATERIAL.material_descripcion,
          UNIDADES.prefijo,
          MATERIAL.material_id,
          MATERIAL_TIPO.material_tipo
          from DETALLE_COTIZACION, MATERIAL, UNIDADES,  MATERIAL_TIPO 
          where DETALLE_COTIZACION.cotizacion_id=".$search."
          AND MATERIAL.material_id=DETALLE_COTIZACION.producto_id AND 
          UNIDADES.id_unidad=MATERIAL.id_unidad AND

          ";
    
      $res=mysql_query($sql);
      $renglones=mysql_num_rows($res);
      $cont_array=0;
      $array=array(); // create new empty array
      
      if($renglones>0)
      {
        
        while($row=mysql_fetch_row($res))
          {
          $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8] , $row[9]);
          //echo "".$array[$cont_array][0];
          $cont_array++;
        }
        return $array;
      }
      else
          return null;
    }
    function cuenta_resultado($user)
    {
     
      $sql="SELECT PEDIDO.pedido_id
      FROM PEDIDO, COTIZACION
      WHERE PEDIDO.pedido_estado = 1 and PEDIDO.cotizacion_id = COTIZACION.cotizacion_id and COTIZACION.usuario_id='".$user."' ";
      $res=mysql_query($sql);
      $renglones=mysql_num_rows($res);
      return $renglones;
    }


   function busqueda_parametros_usuario($usuario, $search, $inicio, $fin, $filter)
          {
                  $search= str_replace(' ', '%', $search);
                  $sql="SELECT 
                  PEDIDO.pedido_id,
                  PEDIDO.cotizacion_id,
                  PEDIDO.sucursal_id,
                  DATE(PEDIDO.pedido_fecha_creacion),
                  DATE(PEDIDO.pedido_fecha_entrega),
                  PEDIDO.pedido_obs,
                  PEDIDO.folio_pedido,   /*6*/
                  COTIZACION.empresa_id,
                  COTIZACION.contacto_ventas_id,
                  COTIZACION.usuario_id,
                  EMPRESA.empresa_razonsocial, /*10*/
                  PEDIDO.pedido_estado,
                  CLIENTE.cliente_razonsocial,
                  COTIZACION.cotizacion_folio,
                  COTIZACION.cotizacion_id
                  FROM COTIZACION, PEDIDO, EMPRESA, CLIENTE where COTIZACION.cotizacion_id = PEDIDO.cotizacion_id  and  COTIZACION.empresa_id = EMPRESA.empresa_id AND CLIENTE.cliente_id=COTIZACION.cliente_id " ;

                  if(!empty($search))
                  {
                   $sql=$sql." SELECT PEDIDO.pedido_id,
                  PEDIDO.cotizacion_id,
                  PEDIDO.sucursal_id,
                  DATE(PEDIDO.pedido_fecha_creacion),
                  DATE(PEDIDO.pedido_fecha_entrega),
                  PEDIDO.pedido_obs,
                  PEDIDO.folio_pedido,
                  COTIZACION.empresa_id,
                  COTIZACION.contacto_ventas_id,
                  COTIZACION.usuario_id,
                  EMPRESA.empresa_razonsocial,
                  PEDIDO.pedido_estado,
                  CLIENTE.cliente_razonsocial,
                  COTIZACION.cotizacion_folio,
                  COTIZACION.cotizacion_id
                  FROM COTIZACION, PEDIDO , 
                   CLIENTE, 
                   USUARIO, 
                   EMPRESA, 
                   GENERALES, 
                   DOMICILIO where (
                    COTIZACION.cotizacion_id like '%".$search."%' OR 
                    USUARIO.usuario_id like '%".$usuario."%' OR 
                    CLIENTE.cliente_id like '%".$search."%'  OR 
                    CLIENTE.cliente_razonsocial like '%".$search."%' OR 
                    EMPRESA.empresa_id like '%".$search."%' OR 
                    EMPRESA.empresa_razonsocial like '%".$search."%' OR 
                    GENERALES.nombre like '%".$search."%' OR 
                    GENERALES.apel_p like '%".$search."%'  OR 
                    GENERALES.email like '%".$search."%' OR 
                    DOMICILIO.domicilio_calle like '%".$search."%' OR  
                    DOMICILIO.domicilio_colonia like '%".$search."%'  OR 
                    DOMICILIO.domicilio_ciudad like '%".$search."%' OR 
                    DOMICILIO.domicilio_estado like '%".$search."%' ) AND 
          USUARIO.generales_id=GENERALES.generales_id AND 
          CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND 
          CLIENTE.cliente_id=COTIZACION.cliente_id AND 
          EMPRESA.empresa_id=COTIZACION.empresa_id AND 
          USUARIO.usuario_id=COTIZACION.usuario_id AND 
          PEDIDO.cotizacion_id = COTIZACION.cotizacion_id";
                  }
                  if($filter>=0)
                        $sql=$sql." AND PEDIDO.pedido_estado=".$filter;
                  else
                        $sql=$sql." AND PEDIDO.pedido_estado<5";

                 

                  $sql=$sql."  LIMIT $inicio, $fin";
      
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                          while($row=mysql_fetch_row($res))
                          {
                                  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12], $row[13], $row[14]);
                                  //echo "".$array[$cont_array][0];
                                  $cont_array++;
                          }
                          return $array;
                  }
                  else
                          return null;
          }
            function busqueda_parametros_usuario_recoleccion($usuario, $search, $inicio, $fin)
          {
                  $search= str_replace(' ', '%', $search);
                  $sql="SELECT 
                  PEDIDO.pedido_id,
                  PEDIDO.cotizacion_id,
                  PEDIDO.sucursal_id,
                  PEDIDO.pedido_fecha_creacion,
                  PEDIDO.pedido_fecha_entrega,
                  PEDIDO.pedido_obs,
                  PEDIDO.folio_pedido,   /*6*/
                  COTIZACION.empresa_id,
                  COTIZACION.contacto_ventas_id,
                  COTIZACION.usuario_id,
                  EMPRESA.empresa_razonsocial, /*10*/
                  PEDIDO.pedido_estado,
                  CLIENTE.cliente_razonsocial
                  FROM COTIZACION, PEDIDO, EMPRESA, CLIENTE where COTIZACION.cotizacion_id = PEDIDO.cotizacion_id and COTIZACION.usuario_id='".$usuario."' and  COTIZACION.empresa_id = EMPRESA.empresa_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND PEDIDO.pedido_estado >= 5" ;

                  if(!empty($search))
                  {
                   $sql=$sql." SELECT PEDIDO.pedido_id,
                  PEDIDO.cotizacion_id,
                  PEDIDO.sucursal_id,
                  PEDIDO.pedido_fecha_creacion,
                  PEDIDO.pedido_fecha_entrega,
                  PEDIDO.pedido_obs,
                  PEDIDO.folio_pedido,
                  COTIZACION.empresa_id,
                  COTIZACION.contacto_ventas_id,
                  COTIZACION.usuario_id,
                  EMPRESA.empresa_razonsocial,
                  PEDIDO.pedido_estado,
                  CLIENTE.cliente_razonsocial
                  FROM COTIZACION, PEDIDO , 
                   CLIENTE, 
                   USUARIO, 
                   EMPRESA, 
                   GENERALES, 
                   DOMICILIO where (
                    COTIZACION.cotizacion_id like '%".$search."%' OR 
                    USUARIO.usuario_id like '%".$usuario."%' OR 
                    CLIENTE.cliente_id like '%".$search."%'  OR 
                    CLIENTE.cliente_razonsocial like '%".$search."%' OR 
                    EMPRESA.empresa_id like '%".$search."%' OR 
                    EMPRESA.empresa_razonsocial like '%".$search."%' OR 
                    GENERALES.nombre like '%".$search."%' OR 
                    GENERALES.apel_p like '%".$search."%'  OR 
                    GENERALES.email like '%".$search."%' OR 
                    DOMICILIO.domicilio_calle like '%".$search."%' OR  
                    DOMICILIO.domicilio_colonia like '%".$search."%'  OR 
                    DOMICILIO.domicilio_ciudad like '%".$search."%' OR 
                    DOMICILIO.domicilio_estado like '%".$search."%' )  AND 
          USUARIO.generales_id=GENERALES.generales_id AND 
          CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND 
          CLIENTE.cliente_id=COTIZACION.cliente_id AND 
          EMPRESA.empresa_id=COTIZACION.empresa_id AND 
          USUARIO.usuario_id=COTIZACION.usuario_id AND 
          PEDIDO.cotizacion_id = COTIZACION.cotizacion_id  AND PEDIDO.pedido_estado >= 5";
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
                                  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12]);
                                  //echo "".$array[$cont_array][0];
                                  $cont_array++;
                          }
                          return $array;
                  }
                  else
                          return null;
          }

           function cuenta_resultado_usuario($usuario,$search, $filter)
          {
                  $search= str_replace(' ', '%', $search);
                  $sql="SELECT 
                  PEDIDO.pedido_id
                  

                  FROM COTIZACION, PEDIDO where COTIZACION.cotizacion_id = PEDIDO.cotizacion_id and COTIZACION.usuario_id='".$usuario."'";

                  if(!empty($search))
                  {
                   $sql=$sql." SELECT PEDIDO.pedido_id
                 
                  FROM COTIZACION, PEDIDO , 
                   CLIENTE, 
                   USUARIO, 
                   EMPRESA, 
                   GENERALES, 
                   DOMICILIO where (
                    COTIZACION.cotizacion_id like '%".$search."%' OR 
                    USUARIO.usuario_id like '%".$usuario."%' OR 
                    CLIENTE.cliente_id like '%".$search."%'  OR 
                    CLIENTE.cliente_razonsocial like '%".$search."%' OR 
                    EMPRESA.empresa_id like '%".$search."%' OR 
                    EMPRESA.empresa_razonsocial like '%".$search."%' OR 
                    GENERALES.nombre like '%".$search."%' OR 
                    GENERALES.apel_p like '%".$search."%'  OR 
                    GENERALES.email like '%".$search."%' OR 
                    DOMICILIO.domicilio_calle like '%".$search."%' OR  
                    DOMICILIO.domicilio_colonia like '%".$search."%'  OR 
                    DOMICILIO.domicilio_ciudad like '%".$search."%' OR 
                    DOMICILIO.domicilio_estado like '%".$search."%' )  AND 
          USUARIO.generales_id=GENERALES.generales_id AND 
          CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND 
          CLIENTE.cliente_id=COTIZACION.cliente_id AND 
          EMPRESA.empresa_id=COTIZACION.empresa_id AND 
          USUARIO.usuario_id=COTIZACION.usuario_id AND 
          PEDIDO.cotizacion_id = COTIZACION.cotizacion_id";
                  }
               
                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  return $renglones;
          }


  function ObtieneCotizaciones($usuario)
          {
      
     $sql="SELECT 
     EMPRESA.empresa_razonsocial,
     COTIZACION.cotizacion_id,
     CLIENTE.cliente_razonsocial,
     COTIZACION.cotizacion_fecha_modificacion,
     COTIZACION.cotizacion_fecha_envio,
     COTIZACION.cotizacion_observaciones,
     COTIZACION.cotizacion_folio
 from 
COTIZACION, EMPRESA, CLIENTE  
WHERE (COTIZACION.cotizacion_edo =6) AND
COTIZACION.empresa_id = EMPRESA.empresa_id AND 
COTIZACION.cliente_id = CLIENTE.cliente_id 
ORDER BY COTIZACION.cotizacion_id DESC
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

  function Obtiene_detalle_pedido($id)
          {
      
     $sql="SELECT 
     EMPRESA.empresa_id,
     EMPRESA.empresa_razonsocial,
     COTIZACION.cotizacion_id,
     CLIENTE.cliente_id,
     CLIENTE.cliente_razonsocial,
     COTIZACION.cotizacion_fecha_modificacion,
     COTIZACION.cotizacion_fecha_envio,
     COTIZACION.cotizacion_observaciones,
     COTIZACION.cotizacion_folio,  /* 8 */
     PEDIDO.pedido_id,
     date(PEDIDO.pedido_fecha_creacion),
     date(PEDIDO.pedido_fecha_entrega),
     PEDIDO.pedido_obs
 from 
COTIZACION, EMPRESA, CLIENTE, PEDIDO
WHERE 
COTIZACION.empresa_id = EMPRESA.empresa_id AND 
PEDIDO.cotizacion_id=COTIZACION.cotizacion_id AND 
COTIZACION.cliente_id = CLIENTE.cliente_id AND 
PEDIDO.pedido_id = ".$id."
";

     
    //  $sql=$sql." LIMIT $inicio, $fin";

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

     function update_pedido_sumario_recoleccion(
      $pedido, 
      $suc, 
      $f_inicio, 
      $f_entrega, 
      $obs_pedido, 
      $folioOS, 
      $status
      )
    {
      $sql="UPDATE PEDIDO SET 
        sucursal_id = ".$suc.", 
        pedido_fecha_creacion = '".$f_inicio."', 
        pedido_fecha_entrega = '".$f_entrega."', 
        pedido_obs = '".$obs_pedido."', 
        folio_pedido = '".$folioOS."', 
        pedido_estado = ".$status." 
    WHERE 
        pedido_id = ".$pedido."";
      $res=mysql_query($sql);
      
      return $pedido; 
    }
    function detalle($search)
          {
                  $sql = "SELECT 
                  PEDIDO.pedido_fecha_creacion, 
                  COTIZACION.cotizacion_id, 
                  COTIZACION.cliente_id, 
                  CLIENTE.cliente_razonsocial, 
                  DOMICILIO.domicilio_calle,    /* 4  */
                  DOMICILIO.domicilio_ciudad,   /* 5  */
                  DOMICILIO.domicilio_colonia,  /* 6  */
                  PEDIDO.folio_pedido,          /* 7  */
                  COTIZACION.usuario_id,         /* 8  */ 
                  DOMICILIO.domicilio_num_ext, /* 9  */
                  DOMICILIO.domicilio_num_int, /* 10  */
                  DOMICILIO.domicilio_municipio,/* 11  */
                  DOMICILIO.domicilio_estado, /* 12  */
                  DOMICILIO.domicilio_cp/* 13  */
FROM COTIZACION, CLIENTE, PEDIDO, DOMICILIO
WHERE COTIZACION.cotizacion_id = PEDIDO.cotizacion_id
AND CLIENTE.cliente_id = COTIZACION.cliente_id
AND DOMICILIO.domicilio_id = CLIENTE.cliente_domicilio_fiscal
AND PEDIDO.pedido_id =".$search."";
                  $res=mysql_query($sql);
                  if($res)
                  {
                          $row=mysql_fetch_row($res);
                          return $row;
                  }
                  else
                  {
                          return null;
                  }
          }
          function nuevo_folio()
          {
                  $sql = "SELECT max(pedido_id)+1 FROM PEDIDO";
                  $res=mysql_query($sql);
                  if($res)
                  {
                          $row=mysql_fetch_row($res);
                          return $row;
                  }
                  else
                  {
                          return null;
                  }
          }
           function delete($id)
          {
                  $sql="DELETE from PEDIDO where pedido_id='".$id."'";
                  $res=mysql_query($sql);
                  $renglones=mysql_affected_rows();
                  if($res&&$renglones==1)
                        return "OK";
                  else 
                        return mysql_error();
          }

}
?>