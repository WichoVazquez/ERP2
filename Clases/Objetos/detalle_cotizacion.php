<?
      class Detalle_Cotizacion
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
		   $producto_id,
		   $cantidad,
		   $cotizacion_id,
		   $precio_venta,
		   $observaciones,
		   $multiplo,
		   $tipocot
		   )
	  {   
          $sql = "
		  insert into DETALLE_COTIZACION
		  (
		   producto_id,
		   cantidad,
		   cotizacion_id,
		   precio_venta,
		   observaciones,
		   multiplo,
		   cotizacion_tipo
		  )
		   values
		  (".$producto_id.",
		   ".$cantidad.",
		   ".$cotizacion_id.",
		   ".$precio_venta.",
		   '".$observaciones."',
		   ".$multiplo.",
		   ".$tipocot."
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
		  if($res&&$renglones>1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	  function delete_by_cotizacion($id)
	  {
		  $sql="delete from DETALLE_COTIZACION where cotizacion_id=".$id."";
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
		  $sql = "select * from DETALLE_COTIZACION where detalle_cotizacion_id=".$search."";
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
	  
	  function busqueda_detalle($search, $almacen_id)
	  {
		  $sql = "SELECT 
		    DETALLE_COTIZACION.detalle_cotizacion_id , 
		  		DETALLE_COTIZACION.producto_id,
				  DETALLE_COTIZACION.cantidad,
				  DETALLE_COTIZACION.cotizacion_id ,
				  DETALLE_COTIZACION.precio_venta,
				  DETALLE_COTIZACION.observaciones,
				  DETALLE_COTIZACION.multiplo,
				  MATERIAL.material_descripcion, /* 7 */
				  UNIDADES.prefijo,
				  MATERIAL.idSAE,
				  PRESENTACIONES.descripcion,
				  MATERIAL.flete,
				  ALMACEN_MATERIAL.cantidad_actual,
				  MATERIAL.flete
				  from DETALLE_COTIZACION 
				  LEFT JOIN ALMACEN_MATERIAL ON ALMACEN_MATERIAL.material_id=DETALLE_COTIZACION.producto_id
				  LEFT JOIN ALMACEN ON  ALMACEN.almacen_id = ALMACEN_MATERIAL.almacen_id
				  INNER JOIN MATERIAL ON MATERIAL.material_id=DETALLE_COTIZACION.producto_id  
				  INNER JOIN UNIDADES ON UNIDADES.id_unidad=MATERIAL.id_unidad 
				  INNER JOIN PRESENTACIONES ON PRESENTACIONES.id_presentacion = MATERIAL.id_presentacion 
				  WHERE 
				  DETALLE_COTIZACION.cotizacion_id=".$search." ";

				  if ($almacen_id>0)
				  	$sql = $sql." AND ALMACEN_MATERIAL.almacen_id = ".$almacen_id."";
				  else
				  	$sql = $sql." AND ALMACEN_MATERIAL.almacen_id = 1";
				  //echo "$sql";
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12], $row[13] );
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;
	  }
	  
	  function recotizar_productos($id, $id_recot)
	  {
		  $sql = "INSERT into DETALLE_COTIZACION(producto_id, cantidad, cotizacion_id, precio_venta, observaciones, multiplo) select producto_id, cantidad, ".$id_recot.", precio_venta, observaciones, multiplo from DETALLE_COTIZACION where cotizacion_id=".$id;
		  $res=mysql_query($sql);
		  if($res)
		  {
			 return mysql_affected_rows();
		  }
		  else
		  {
			 return mysql_error(); 
		  }
	  }
	}

?>