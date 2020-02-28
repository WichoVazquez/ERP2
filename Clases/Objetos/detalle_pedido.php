<?
	class Detalle_Pedido
	{
		private $link;
		
		function __construct()
		{
		}
		
		function conexion($link_bd)
		{
			$link=$link_bd;
		}
		
		function insert_empty_cot($pedido, $cot)
		{
			$sql="INSERT into DETALLE_PEDIDO(pedido_id, detalle_cotizacion_id, detalle_pedido_status) 
			SELECT ".$pedido.", DETALLE_COTIZACION.detalle_cotizacion_id, MATERIAL.material_maquila from DETALLE_COTIZACION, MATERIAL 
			where    MATERIAL.material_id = DETALLE_COTIZACION.producto_id and DETALLE_COTIZACION.cotizacion_id=".$cot;
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
		

		function update_envio($pedido_detalle_id, $status,$almacen_id)
		{
			$sql="UPDATE DETALLE_PEDIDO SET 
			detalle_pedido_status=".$status." ,
			almacen_id=".$almacen_id." 
			WHERE detalle_pedido_id=".$pedido_detalle_id." ";
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
		}

		 function insert_detalle_pedido(
		   $producto_id,
		   $cantidad,
		   $pedido_id,
		   $precio_venta,
		   $observaciones,
		   $multiplo,
		   $tipoped,
		   $status
		   )
	  {   
          $sql = "		  INSERT into DETALLE_PEDIDO
		  (
		   producto_id,
		   cantidad,
		   pedido_id,
		   precio_venta,
		   detalle_pedido_obs,
		   multiplo,
		   pedido_tipo,
		   detalle_pedido_status
		  )
		   values
		  (".$producto_id.",
		   ".$cantidad.",
		   ".$pedido_id.",
		   ".$precio_venta.",
		   '".$observaciones."',
		   ".$multiplo.",
		   ".$tipoped.",
		   ".$status."
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

		 function insert_detalle_pedido_recoleccion(
		   $producto_id,
		   $cantidad,
		   $pedido_id,
		   $precio_venta,
		   $observaciones,
		   $multiplo,
		   $tipoped,
		   $cantidad_p,
		   $estatus_detalle
		   )
	  {   
          $sql = "
		  insert into DETALLE_PEDIDO
		  (
		   producto_id,
		   cantidad,
		   cantidad_recoger,
		   pedido_id,
		   precio_venta,
		   detalle_pedido_obs,
		   multiplo,
		   pedido_tipo,
		   cantidad_prestamo,
		   detalle_pedido_status
		  )
		   values
		  (".$producto_id.",
		  	".$cantidad.",
		   ".$cantidad.",
		   ".$pedido_id.",
		   ".$precio_venta.",
		   '".$observaciones."',
		   ".$multiplo.",
		   ".$tipoped.",
		   ".$cantidad_p.",
		   ".$estatus_detalle."
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
		  $sql="delete from DETALLE_PEDIDO where detalle_pedido_id=".$id."";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones>0)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	   function detalle($search)
          {
                  $sql = "SELECT 
                  DETALLE_PEDIDO.cantidad,
                   UNIDADES.prefijo,
                   MATERIAL.material_descripcion
FROM DETALLE_PEDIDO, MATERIAL, PEDIDO, UNIDADES
WHERE PEDIDO.pedido_id = DETALLE_PEDIDO.pedido_id
AND DETALLE_PEDIDO.producto_id = MATERIAL.material_id
AND MATERIAL.id_unidad = UNIDADES.id_unidad
AND PEDIDO.pedido_id =".$search."";

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

	    function Obtiene_detalle_pedido($id)
          {
      
     $sql="SELECT 
     DETALLE_PEDIDO.detalle_pedido_id,
		   DETALLE_PEDIDO.producto_id,
		   DETALLE_PEDIDO.cantidad,
		   DETALLE_PEDIDO.pedido_id,
		   DETALLE_PEDIDO.precio_venta,
		   DETALLE_PEDIDO.detalle_pedido_obs,
		   DETALLE_PEDIDO.multiplo,
		   DETALLE_PEDIDO.pedido_tipo,
		   DETALLE_PEDIDO.detalle_pedido_status,  /* 8 */
		   MATERIAL.material_descripcion,
		   UNIDADES.prefijo
 from 
DETALLE_PEDIDO, MATERIAL, UNIDADES
WHERE
DETALLE_PEDIDO.producto_id = MATERIAL.material_id AND 
MATERIAL.id_unidad = UNIDADES.id_unidad AND 
DETALLE_PEDIDO.pedido_id = ".$id."

";
   $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10] );
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