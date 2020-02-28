<?
      class Detalle_reqcompra
	{
	  private $link;	
	  function __construct()
	  {
		 
	  }
	  function conexion($link_bd)
	  {
		  $link=$link_bd;
	  }
	  function insert(
		   $orden_id,
		   $producto_id,
		   $cantidad,
		   $observaciones
		   )
	  {   
	  	//$almacen_material_id=1;
          $sql = "INSERT into DETALLE_REQCOMPRA
		  (
		   producto_id,
		   detalle_reqcompra_cantidad,
		   req_compra_id,
		   almacen_id,
		   observaciones
		  )
		   values
		  (".$producto_id.",
		   ".$cantidad.",
		   ".$orden_id.",
		   1,
		   '".$observaciones."'
		  )";
		  $res=mysql_query($sql);
		  if($res)
		  		  
			  return mysql_insert_id();
		  else{
			  return mysql_error();
		  }
		  
	
	  }
	  
	  function busqueda_parametros($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select  detalle_cotizacion_id, producto_id, cantidad, cotizacion_id, precio_venta, observaciones from DETALLE_COTIZACION";
		  if(!empty($search))
		  {
		   $sql=$sql." where perfil_nombre like '%".$search."%' OR perfil_descripcion like '%".$search."%'";
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
				  $array[$cont_array]=array($row[0], $row[1], $row[2]);
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
		  $sql="select perfil_id from PERFIL";
		  if(!empty($search))
		  {
		   $sql=$sql." where (perfil_nombre like '%".$search."%' OR perfil_descripcion like '%".$search."%')";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
		  $sql="delete from DETALLE_COTIZACION where detalle_cotizacion_id=".$id."";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	  function delete_by_orden($id)
	  {
		  $sql="delete from DETALLE_COMPRA where orden_compra_id=".$id."";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }


	  function update(
	  	   $detalle_cotizacion_id,
	  	   $producto_id,
		   $cantidad,
		   $cotizacion_id,
		   $precio_venta
		)
		{
			$sql = "update DETALLE_COTIZACION set producto_id=".$nombre.", cantidad=".$descripcion.", cotizacion_id=".$cotizacion_id.", precio_venta=".$precio_venta." where perfil_id=".$perfil_id;
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
		
	  function update_price(
	  	   $detalle_cotizacion_id,
		   $precio_venta,//<-- esta de mas el precio
		   $multiplo
		)
		{
			$sql = "update DETALLE_COTIZACION set  precio_venta=".$precio_venta.", multiplo=".$multiplo." where detalle_cotizacion_id=".$detalle_cotizacion_id;
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}	
	  
	  function detalle($search)
	  {
		  $sql = "SELECT
		  DETALLE_REQCOMPRA.detalle_reqcompra_id,
		  PEDIDO.folio_pedido,
		  DETALLE_REQCOMPRA.req_compra_id,
		  DETALLE_REQCOMPRA.almacen_id,
		  DETALLE_REQCOMPRA.detalle_reqcompra_cantidad,
		  DETALLE_REQCOMPRA.producto_id,
		  UNIDADES.prefijo,
		  MATERIAL.material_descripcion
		   from DETALLE_REQCOMPRA, MATERIAL, UNIDADES, PEDIDO$link = mysql_connect('localhost', 'globaldr_master', 'MePrendio7!');
		  where 
			DETALLE_REQCOMPRA.producto_id = MATERIAL.material_id AND
			MATERIAL.id_unidad = UNIDADES.id_unidad AND
		    req_compra_id=".$search."";
		
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
	  
	  function busqueda_detalle($search)
	  {

		 		  $sql = "SELECT
		  DETALLE_REQCOMPRA.detalle_reqcompra_id,
		  DETALLE_REQCOMPRA.req_compra_id,
		  DETALLE_REQCOMPRA.almacen_id,
		  DETALLE_REQCOMPRA.detalle_reqcompra_cantidad,
		  DETALLE_REQCOMPRA.producto_id,
		  UNIDADES.prefijo,
		  MATERIAL.material_descripcion,
		  MATERIAL.material_id,
		  PRESENTACIONES.descripcion,
		  DETALLE_REQCOMPRA.observaciones
		   from DETALLE_REQCOMPRA, MATERIAL, UNIDADES, PRESENTACIONES
		  where 
			DETALLE_REQCOMPRA.producto_id = MATERIAL.material_id AND
			MATERIAL.id_unidad = UNIDADES.id_unidad AND 
			MATERIAL.id_presentacion = PRESENTACIONES.id_presentacion AND 
		    req_compra_id=".$search."";
				 // echo "$sql";
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

 	function update_almacen(
	  	   $detalle_orden_compra_id,
		   $cantidad_surtida,
		   $costo_detalle
		)
		{
			$sql = "update DETALLE_COMPRA set  costo=".$costo_detalle.", detalle_compra_cantidad_s=".$cantidad_surtida." where detalle_id=".$detalle_orden_compra_id;
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}	



	}

?>