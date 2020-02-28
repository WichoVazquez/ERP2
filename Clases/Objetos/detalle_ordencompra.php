<?
      class Detalle_ordencompra
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
		   $producto_descripcion,
		   $cantidad,
		   $costo,
		   $unidad
		   )
	  {   
	  	$almacen_material_id=1;
     $sql = "INSERT into DETALLE_COMPRA
		  (
		   orden_compra_id,
		   producto_id,
		   producto_desc,
		   detalle_compra_cantidad,
		   costo,
		   unidad
		  )
		   values
		  (".$orden_id.",
		  	".$producto_id.",
		  	'".$producto_descripcion."',
		   ".$cantidad.",
		   ".$costo.",
		   '".$unidad."'
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
	  
	  function busqueda_detalle($search)
	  {

		  $sql = "SELECT 
		  		DETALLE_COMPRA.detalle_id , 
		  		DETALLE_COMPRA.producto_id,
				DETALLE_COMPRA.detalle_compra_cantidad,
				DETALLE_COMPRA.orden_compra_id,
				DETALLE_COMPRA.producto_desc,
				DETALLE_COMPRA.costo,
				DETALLE_COMPRA.unidad,
				MATERIAL.idSAE,
				PRESENTACIONES.descripcion,
				DETALLE_COMPRA.detalle_compra_cantidad_s,
				MATERIAL.material_descripcion
				from DETALLE_COMPRA, MATERIAL, PRESENTACIONES				where 
				MATERIAL.id_presentacion = PRESENTACIONES.id_presentacion AND 
				MATERIAL.material_id = DETALLE_COMPRA.producto_id AND 

				DETALLE_COMPRA.orden_compra_id=".$search."	";
				 // echo "$sql";
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

 	function update_almacen(
	  	 $detalle_orden_compra_id,
		   $cantidad_surtida,
					$lote,
					$almacen,
					$usuario,
					$id_producto
		)
		{

				$query_historial=mysql_query("INSERT INTO  HISTORICO(cantidad, id_producto, id_almacen, usuario, id_compra ) VALUES  (
				$cantidad_surtida,
				$id_producto,
				$almacen,
				'$usuario',
				$detalle_orden_compra_id
				)");



			$sql = "UPDATE DETALLE_COMPRA set  detalle_compra_cantidad_s=".$cantidad_surtida.", lote='".$lote."'  where detalle_id=".$detalle_orden_compra_id;
			
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return $lote;
			  else 
				return mysql_error();
			
		}	



	}

?>