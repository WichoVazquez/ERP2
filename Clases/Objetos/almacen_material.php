<?php
      class Almacen_material
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
	   	   $almacen_id,
		   $material_id,
		   $cantidad,
		   $maximo,
		   $minimo)
	  {   
	  		$id=0;
          $sql = "INSERT into ALMACEN_MATERIAL
		  (almacen_id,
		   material_id,
		   cantidad_actual,
		   maximo,
		   minimo)
		   values
		  (".$almacen_id.",
		   ".$material_id.",
		   ".$cantidad.",
		   ".$maximo.",
		   ".$minimo.")";

		  $res=mysql_query($sql);
		  if($res)
		  		  
			  $id=mysql_insert_id();
		  else{
			  $id=0;
			  printf("Error:".mysql_error());
		  }
		  return $id;
	  	  
	  	  
	
	  }
	  
	  function detalle_generales($search)
	  {
		  $sql = "select * from ALMACEN_MATERIAL where almacen_material_id=".$search;
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
	   function update(
	   		$almacen_material_id,
	   		$cantidad_actual,
		   $maximo,
		   $minimo
		)	
		{
			$sql = "UPDATE ALMACEN_MATERIAL set cantidad_actual=".$cantidad_actual.",  maximo=".$maximo." ,minimo=".$minimo." where almacen_material_id=".$almacen_material_id."";
			//echo "sql _almacen_material: ".$sql;
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}

		function update_rafa(
	   		
	   		$cantidad_actual
		   
		)	
		{
			$sql = "UPDATE ALMACEN_MATERIAL set cantidad_actual=".$cantidad_actual." where material_id=1002";
			//echo "sql _almacen_material: ".$sql;
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}

			   function update_compras(
	   		$almacen_material_id,
			$cantidad,
			$detalle_compra_id
		)
		{



			$sql = "UPDATE ALMACEN_MATERIAL set   cantidad_actual=cantidad_actual + ".$cantidad." where almacen_id=".$almacen_material_id." and 
				material_id = (SELECT DETALLE_COMPRA.producto_id FROM DETALLE_COMPRA where DETALLE_COMPRA.detalle_id = ".$detalle_compra_id.")";
			echo "QUERY COMPLETO:".$sql;
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
		function delete($id)
	  {
		  $sql="delete from ALMACEN_MATERIAL where almacen_material_id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }

function busqueda_parametros($search, $inicio, $fin, $filter)
	  {
		  $search= str_replace(' ', '%', $search);
			  $sql="SELECT 
			  ALMACEN_MATERIAL.almacen_material_id,
			  ALMACEN.nombre,
			  MATERIAL.material_descripcion,
			  ALMACEN_MATERIAL.cantidad_actual,
			  MATERIAL.IdSAE,
			  MATERIAL.material_tipo,
			  MATERIAL.id_unidad, 
			  ALMACEN_MATERIAL.material_id, 
			  ALMACEN.almacen_id,
			  ALMACEN.descripcion,
			  UNIDADES.prefijo,
			  PRESENTACIONES.descripcion
			  from MATERIAL,  ALMACEN, ALMACEN_MATERIAL, PRESENTACIONES, UNIDADES  
			  where ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id AND PRESENTACIONES.id_presentacion = MATERIAL.id_presentacion AND UNIDADES.id_unidad = MATERIAL.id_unidad";
		  if(!empty($search))
		  {
		   $sql="SELECT 
			  ALMACEN_MATERIAL.almacen_material_id,
			  ALMACEN.nombre,
			  MATERIAL.material_descripcion,
			  ALMACEN_MATERIAL.cantidad_actual,
			  MATERIAL.IdSAE,
			  MATERIAL.material_tipo, 
			  MATERIAL.id_unidad, 
			  ALMACEN_MATERIAL.material_id, 
			  ALMACEN.almacen_id,
			  ALMACEN.descripcion,
			  UNIDADES.prefijo,
			  PRESENTACIONES.descripcion
			  from MATERIAL,  ALMACEN, ALMACEN_MATERIAL, PRESENTACIONES, UNIDADES   where (MATERIAL.material_descripcion like '%".$search."%'  OR
			   PRESENTACIONES.descripcion  like '%".$search."%' OR  ALMACEN.descripcion like '%".$search."%' OR  MATERIAL.IdSAE like '%".$search."%') AND 
			   ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id  AND PRESENTACIONES.id_presentacion= MATERIAL.id_presentacion AND UNIDADES.id_unidad = MATERIAL.id_unidad";
		  }

                  if($filter>=0)
                        $sql=$sql." AND ALMACEN.almacen_id=".$filter;




		  $sql=$sql." LIMIT $inicio, $fin";
		 //echo "sql ".$sql;
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

	  function busqueda_parametros_pruebasMSS($search)
	  {
		  $search= str_replace(' ', '%', $search);
			  $sql="SELECT 
			  ALMACEN_MATERIAL.almacen_material_id,
			  ALMACEN.nombre,
			  MATERIAL.material_descripcion,
			  ALMACEN_MATERIAL.cantidad_actual,
			  ALMACEN_MATERIAL.minimo,
			  MATERIAL.material_tipo,
			  MATERIAL.id_unidad, 
			  MATERIAL.material_id, 
			  ALMACEN.almacen_id,
			  ALMACEN.descripcion from MATERIAL,  ALMACEN, ALMACEN_MATERIAL  
			  where ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id and (ALMACEN_MATERIAL.cantidad_actual=0 OR ALMACEN_MATERIAL.cantidad_actual<=ALMACEN_MATERIAL.minimo)";
		  

		  $sql=$sql."AND ALMACEN_MATERIAL.almacen_material_id=".$search."";
		 //echo "sql ".$sql;
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

function busqueda_parametros_historial($search, $inicio, $fin, $filter)
	  {
		  $search= str_replace(' ', '%', $search);
			  $sql="SELECT 
					ALMACEN_MATERIAL.almacen_material_id,
			  ALMACEN.nombre,
			  MATERIAL.material_descripcion,
			  ALMACEN_MATERIAL.cantidad_actual,
			  MATERIAL.IdSAE,
			  MATERIAL.material_tipo,
			  MATERIAL.id_unidad, 
			  MATERIAL.material_id, 
			  ALMACEN.almacen_id,
			  ALMACEN.descripcion,
			  PRESENTACIONES.descripcion, /* 10 */
			  HISTORICO.id_historico,
			  HISTORICO.fecha,
			  HISTORICO.usuario,
			  HISTORICO.cantidad,
			  HISTORICO.id_compra,
			  HISTORICO.id_pedido,
			  DETALLE_COMPRA.orden_compra_id,
			  ALMACEN.nombre,
			  HISTORICO.id_historico
			  from MATERIAL,  ALMACEN, ALMACEN_MATERIAL, PRESENTACIONES, HISTORICO
			  left join DETALLE_COMPRA on HISTORICO.id_compra = DETALLE_COMPRA.detalle_id    
			  where 
			  ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND 
			  ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id AND 
			  PRESENTACIONES.id_presentacion = MATERIAL.id_presentacion AND
			  HISTORICO.id_producto = ALMACEN_MATERIAL.material_id AND
			  HISTORICO.id_almacen = ALMACEN_MATERIAL.almacen_id
			  ";
		  if(!empty($search))
		  {
		   $sql="SELECT 
			  ALMACEN_MATERIAL.almacen_material_id,
			  ALMACEN.nombre,
			  MATERIAL.material_descripcion,
			  ALMACEN_MATERIAL.cantidad_actual,
			  MATERIAL.IdSAE,
			  MATERIAL.material_tipo, 
			  MATERIAL.id_unidad, 
			  MATERIAL.material_id, 
			  ALMACEN.almacen_id,
			  ALMACEN.descripcion,
			  PRESENTACIONES.descripcion,
			  HISTORICO.id_historico,
			  HISTORICO.fecha,
			  HISTORICO.usuario,
			  HISTORICO.cantidad,
			  HISTORICO.id_compra,
			  HISTORICO.id_pedido,
			  DETALLE_COMPRA.orden_compra_id,
			  ALMACEN.nombre
			  from MATERIAL,  ALMACEN, ALMACEN_MATERIAL, PRESENTACIONES, HISTORICO
			  left join DETALLE_COMPRA on HISTORICO.id_compra = DETALLE_COMPRA.detalle_id  
			  where (MATERIAL.material_descripcion like '%".$search."%'  OR
			   PRESENTACIONES.descripcion  like '%".$search."%' OR  ALMACEN.descripcion like '%".$search."%' OR  MATERIAL.IdSAE like '%".$search."%') AND 
			   ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id  AND PRESENTACIONES.id_presentacion= MATERIAL.id_presentacion  AND
			  HISTORICO.id_producto = ALMACEN_MATERIAL.material_id AND
			  HISTORICO.id_almacen = ALMACEN_MATERIAL.almacen_id";
		  }

                  if($filter>=0)
                        $sql=$sql." AND ALMACEN.almacen_id=".$filter;




		  $sql=$sql." ORDER BY FECHA DESC LIMIT $inicio, $fin";
		 
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12], $row[13], $row[14], $row[15], $row[16], $row[17], $row[18], $row[19]);
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
$sql="SELECT 
					ALMACEN_MATERIAL.almacen_material_id,
			  ALMACEN.nombre,
			  MATERIAL.material_descripcion,
			  ALMACEN_MATERIAL.cantidad_actual,
			  MATERIAL.IdSAE,
			  MATERIAL.material_tipo,
			  MATERIAL.id_unidad, 
			  MATERIAL.material_id, 
			  ALMACEN.almacen_id,
			  ALMACEN.descripcion,
			  PRESENTACIONES.descripcion, /* 10 */
			  HISTORICO.id_historico,
			  HISTORICO.fecha,
			  HISTORICO.usuario,
			  HISTORICO.cantidad,
			  HISTORICO.id_compra,
			  HISTORICO.id_pedido,
			  DETALLE_COMPRA.orden_compra_id
			  from MATERIAL,  ALMACEN, ALMACEN_MATERIAL, PRESENTACIONES, HISTORICO
			  left join DETALLE_COMPRA on HISTORICO.id_compra = DETALLE_COMPRA.detalle_id   
			  where 
			  ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND 
			  ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id AND 
			  PRESENTACIONES.id_presentacion = MATERIAL.id_presentacion AND
			  HISTORICO.id_producto = ALMACEN_MATERIAL.material_id AND
			  HISTORICO.id_almacen = ALMACEN_MATERIAL.almacen_id";
		  if(!empty($search))
		  {
		   $sql="SELECT 
			  ALMACEN_MATERIAL.almacen_material_id,
			  ALMACEN.nombre,
			  MATERIAL.material_descripcion,
			  ALMACEN_MATERIAL.cantidad_actual,
			  MATERIAL.IdSAE,
			  MATERIAL.material_tipo, 
			  MATERIAL.id_unidad, 
			  MATERIAL.material_id, 
			  ALMACEN.almacen_id,
			  ALMACEN.descripcion,
			  PRESENTACIONES.descripcion,
			  HISTORICO.id_historico,
			  HISTORICO.fecha,
			  HISTORICO.usuario,
			  HISTORICO.cantidad,
			  HISTORICO.id_compra,
			  HISTORICO.id_pedido
			  from MATERIAL,  ALMACEN, ALMACEN_MATERIAL, PRESENTACIONES, HISTORICO   where (MATERIAL.material_descripcion like '%".$search."%'  OR
			   PRESENTACIONES.descripcion  like '%".$search."%' OR  ALMACEN.descripcion like '%".$search."%' OR  MATERIAL.IdSAE like '%".$search."%') AND 
			   ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id  AND PRESENTACIONES.id_presentacion= MATERIAL.id_presentacion  AND
			  HISTORICO.id_producto = ALMACEN_MATERIAL.material_id AND
			  HISTORICO.id_almacen = ALMACEN_MATERIAL.almacen_id";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  } 
function busqueda_parametros_sinstock($search, $inicio, $fin, $filter)
	  {
		  $search= str_replace(' ', '%', $search);
			  $sql="SELECT 
			  ALMACEN_MATERIAL.almacen_material_id,
			  ALMACEN.nombre,
			  MATERIAL.material_descripcion,
			  ALMACEN_MATERIAL.cantidad_actual,
			  ALMACEN_MATERIAL.minimo,
			  MATERIAL.material_tipo,
			  MATERIAL.id_unidad, 
			  MATERIAL.material_id, 
			  ALMACEN.almacen_id,
			  ALMACEN.descripcion from MATERIAL,  ALMACEN, ALMACEN_MATERIAL  
			  where ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id and (ALMACEN_MATERIAL.cantidad_actual=0 OR ALMACEN_MATERIAL.cantidad_actual<=ALMACEN_MATERIAL.minimo)";
		  if(!empty($search))
		  {
		   $sql="SELECT 
			  ALMACEN_MATERIAL.almacen_material_id,
			  ALMACEN.nombre,
			  MATERIAL.material_descripcion,
			  ALMACEN_MATERIAL.cantidad_actual,
			  ALMACEN_MATERIAL.minimo,
			  MATERIAL.material_tipo, 
			  MATERIAL.id_unidad, 
			  ALMACEN.almacen_id,
			  ALMACEN.descripcion FROM MATERIAL,  ALMACEN, ALMACEN_MATERIAL  
			  WHERE  ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id and (ALMACEN_MATERIAL.cantidad_actual=0 OR ALMACEN_MATERIAL.cantidad_actual<=ALMACEN_MATERIAL.minimo) and MATERIAL.material_descripcion like '%".$search."%'";
		  }
		   if($filter>=0)
                        $sql=$sql." AND ALMACEN.almacen_id=".$filter;
		  $sql=$sql." LIMIT $inicio, $fin";
		 
		  $res=mysql_query($sql) or die($sql."<br/><br/>".mysql_error());;
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


function detalle($id)
	  {
			  $sql="SELECT 
			  ALMACEN_MATERIAL.almacen_material_id,
			  ALMACEN.nombre,
			  MATERIAL.material_descripcion,
			  ALMACEN_MATERIAL.cantidad_actual,
			  MATERIAL.material_tipo,
			  MATERIAL.id_unidad, /* 5 */
			  MATERIAL.material_id, 
			  ALMACEN.almacen_id,
			  ALMACEN_MATERIAL.maximo,
			  ALMACEN_MATERIAL.minimo,			  
			  ALMACEN.descripcion,  /* 10 */
		  MATERIAL.material_maquila,
		  MATERIAL.idSAE,
		  MATERIAL.flete,
		  MATERIAL.id_presentacion  /* 14 */
		  from MATERIAL,  ALMACEN, ALMACEN_MATERIAL  
			  where ALMACEN_MATERIAL.almacen_material_id=".$id." and ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id ";
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

	  function detalle_rafa($id)
	  {
			  $sql="SELECT 
			  ALMACEN_MATERIAL.almacen_material_id,
			  ALMACEN.nombre,
			  MATERIAL.material_descripcion,
			  ALMACEN_MATERIAL.cantidad_actual,
			  MATERIAL.material_tipo,
			  MATERIAL.id_unidad, 
			  MATERIAL.material_id, 
			  ALMACEN.almacen_id,
			  ALMACEN_MATERIAL.maximo,
			  ALMACEN_MATERIAL.minimo,			  
			  ALMACEN.descripcion,  /* 10 */
		  MATERIAL.material_maquila,
		  MATERIAL.idSAE,
		  MATERIAL.flete  
		  from MATERIAL,  ALMACEN, ALMACEN_MATERIAL  
			  where MATERIAL.material_id=1002 and ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id ";
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
	  
	  function detalle_cantidad($id, $almacen_id)
	  {
			  $sql="SELECT 
			  ALMACEN_MATERIAL.almacen_material_id,
			  ALMACEN_MATERIAL.cantidad_actual,
			  ALMACEN.almacen_id,
			  ALMACEN_MATERIAL.maximo,
			  ALMACEN_MATERIAL.minimo
		  from  MATERIAL, ALMACEN, ALMACEN_MATERIAL, DETALLE_COTIZACION  
			  where 
			  DETALLE_COTIZACION.producto_id = MATERIAL.material_id AND 
			  ALMACEN_MATERIAL.material_id = MATERIAL.material_id AND  
			  ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id AND 
			  DETALLE_COTIZACION.detalle_cotizacion_id = ".$id."  AND
			  ALMACEN.almacen_id=".$almacen_id." ";
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
	  
	  //aqui se agrega la informacion de kits
	    function insertDetalle(
			$material_id,
		   $producto_id,
		   $cantidad,
		   $observaciones
		   )
	  {   
	  
          $sql = "INSERT into DETALLE_MATERIAL
		  (
		   material_id,
		   detalle_material_cantidad,
		   detalle_material_observaciones,
		   detalle_producto_id
		  )
		   values
		  (".$material_id.",
		   ".$cantidad.",
		   '".$observaciones."',
		   ".$producto_id."
		  )";
		  
		  $res=mysql_query($sql);
		  if($res)
		  		  
			  return mysql_insert_id();
		  else{
			  return mysql_error();
		  }
		  
	
	  }
	  
	  //consulta de detalle de kit
	function consulta_detalle($id)
	  {
			  $sql="SELECT DETALLE_MATERIAL.detalle_material_id, MATERIAL.material_id, MATERIAL.material_descripcion, detalle_material_cantidad, detalle_material_observaciones FROM DETALLE_MATERIAL inner join MATERIAL on DETALLE_MATERIAL.detalle_producto_id = MATERIAL.material_id WHERE DETALLE_MATERIAL.material_id=".$id;
		
		 $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0],$row[1], $row[2], $row[3], $row[4]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;
	  }
	  	 
	
	  function deleteDetalle($id)
	  {
		  $sql="DELETE from DETALLE_MATERIAL where material_id=".$id."";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones>=1)
		  	return "OK";
		  else 
		  	return mysql_error();
		  //return $sql;
	  }

          function p_sinstock()
          {
                  // las cotizaciones pendientes por aprobar
                  $sql="SELECT ALMACEN_MATERIAL.material_id
FROM ALMACEN_MATERIAL
WHERE ALMACEN_MATERIAL.cantidad_actual =0";

                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  return $renglones;
          }

	function p_minimo()
          {
                  // las cotizaciones pendientes por aprobar
                  $sql="SELECT ALMACEN_MATERIAL.material_id
FROM ALMACEN_MATERIAL
WHERE  ALMACEN_MATERIAL.cantidad_actual<ALMACEN_MATERIAL.minimo";

                  $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  return $renglones;
          }
	}

?>