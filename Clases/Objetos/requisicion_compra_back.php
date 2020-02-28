<?
      class Req_compra
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
		   $cliente_id,
		   $usuario_id,
		   $fecha_req,
		   $observaciones,
		   $empresa_id
		   )
	  {   
	  	  $id=0;
	  	  $orden_edo=0;

          $sql = "INSERT into REQ_COMPRA
		  (
		   usuario_id,
		   fecha_creacion,
		   fecha_req,
		   cliente_id,
		   observaciones,
		   empresa_id
		  )
		   values
		  (
		  '".$usuario_id."',
		   NOW(),
		   '".$fecha_req."',
		   '".$cliente_id."',
		   '".$observaciones."',
		   ".$empresa_id."
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

	  function InsertarReq_OS(
		   $cliente_id,
		   $usuario_id,
		   $fecha_req,
		   $proyecto,
		   $descripcion,
		   $lugar_entrega,
		   $observaciones,
		   $empresa_id,
		   $estado

		   )
	  {   
	  	  $id=0;
	  	  $orden_edo=0;

          $sql = "
		  INSERT into REQ_COMPRA
		  (
		   usuario_id,
		   fecha_creacion,
		   fecha_req,
		   cliente_id,
		   proyecto,
		   descripcion,
		   lugar_entrega,
		   observaciones,
		   empresa_id,
		   folio,
		   req_edo
		  )
		   values
		  (
		  '".$usuario_id."',
		   NOW(),
		   '".$fecha_req."',
		   '".$cliente_id."',
		   '".$observaciones."',
		   '".$proyecto."',
			'".$descripcion."',
			'".$lugar_entrega."', 
			'".$observaciones."',
			".$empresa_id.", 
		   ".$estado."
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
		  $sql="delete from ORDEN_COMPRA where orden_compra_id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }


	
	  function update(
	  	  $req_id,
	  	  $estado,
	   	 $cliente_id,
		   	$fecha_req,
		   	$proyecto,
		   	$descripcion,
		   	$lugar_entrega,
		  	 $observaciones,
		  	 $empresa_id,
		  	 $departamento
		)

		{


			  $sql = "SELECT parametro_1 from PARAMETROS where parametro_var='".$departamento."'";
                  //echo "$sql";
                  $res=mysql_query($sql);
                  if($res&&mysql_num_rows($res)>0)                  {
                          $row=mysql_fetch_row($res);
                          $folio_previo =  $row[0];
                  }

      $folio = $departamento."-".$folio_previo;
                 

			list($month,$day,$year)=explode("/",$fecha_req);
			$insertdate = $year."-".$month."-".$day;

			$folio_nuevo = $folio_previo + 1;
			$sql = "UPDATE PARAMETROS set parametro_1=".$folio_nuevo."  where parametro_var='".$departamento."'";
		 $res=mysql_query($sql);


			$sql = "UPDATE REQ_COMPRA set 
			fecha_req='".$insertdate."', 
			req_edo=".$estado.", 
			cliente_id='".$cliente_id."',
			proyecto='".$proyecto."',
			descripcion='".$descripcion."',
			lugar_entrega='".$lugar_entrega."', 
			observaciones='".$observaciones."',
			empresa_id=".$empresa_id.", 
			folio='".$folio."'"
			;
			$sql=$sql." where req_id=".$req_id."";
			
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
		
	  function update_status($edo, $req_compra, $obs, $usuario)
	  {
		  $sql = "UPDATE REQ_COMPRA set req_edo=".$edo.", observaciones='".$obs."' , 	usuario_id_autoriza='".$usuario."', fecha_autoriza=NOW() ";
		
		   $sql=$sql." where req_id=".$req_compra."";
		//   echo "$sql";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res/*&&$renglones==1*/)
			return "OK";
		  else 
			return mysql_error();
	  }
	  
	  function busqueda_parametros_usuario($user, $search, $inicio, $fin, $filter)
	  {

		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT 
		  REQ_COMPRA.req_id, 
		  REQ_COMPRA.fecha_creacion,  
		  REQ_COMPRA.fecha_req,
		  REQ_COMPRA.cliente_id, 
		  REQ_COMPRA.usuario_id,
				EMPRESA.empresa_razonsocial,
		  REQ_COMPRA.observaciones,
		  REQ_COMPRA.req_edo,
		  REQ_COMPRA.folio
		  from REQ_COMPRA  
		  LEFT JOIN EMPRESA ON EMPRESA.empresa_id=REQ_COMPRA.empresa_id";

		  if($filter>0)
		  	$sql=$sql." WHERE  REQ_COMPRA.req_edo=".$filter;
		  else
		  	$sql=$sql." WHERE  REQ_COMPRA.req_edo<>0";		
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
	  
	  function cuenta_resultado_usuario($user,$search, $filter)
	  {
		$search= str_replace(' ', '%', $search);
		  $sql="SELECT 
		  REQ_COMPRA.req_id, 
		  REQ_COMPRA.fecha_creacion,  
		  REQ_COMPRA.fecha_req,
		  REQ_COMPRA.cliente_id, 
		  REQ_COMPRA.usuario_id,
		  EMPRESA.empresa_razonsocial,
		  REQ_COMPRA.observaciones,
		  REQ_COMPRA.req_edo 
		  from REQ_COMPRA  
		  LEFT JOIN EMPRESA ON EMPRESA.empresa_id=REQ_COMPRA.empresa_id";

		 
		if($filter>0)
		  	$sql=$sql." WHERE  REQ_COMPRA.req_edo=".$filter;
		  else
		  	$sql=$sql." WHERE  REQ_COMPRA.req_edo<>0";		
		  
			
		 
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function detalle($search)
	  {
		  $sql = "SELECT 
		  REQ_COMPRA.req_id, 
		  REQ_COMPRA.fecha_creacion, 
		  REQ_COMPRA.fecha_req, 
		  REQ_COMPRA.cliente_id, 
		  REQ_COMPRA.usuario_id, 
		  REQ_COMPRA.usuario_id_autoriza, 
		  REQ_COMPRA.observaciones, 
		  REQ_COMPRA.req_edo,
		  EMPRESA.empresa_razonsocial,
		  REQ_COMPRA.proyecto,
		  REQ_COMPRA.descripcion,
		  REQ_COMPRA.lugar_entrega,
		  REQ_COMPRA.empresa_id,
		  REQ_COMPRA.folio
		  from REQ_COMPRA 
		  LEFT JOIN EMPRESA ON EMPRESA.empresa_id=REQ_COMPRA.empresa_id
		  where 
		  REQ_COMPRA.req_id=".$search."";

		
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

	  function detalle_req($search)
	  {
		  $sql = "SELECT
		  DETALLE_REQCOMPRA.detalle_reqcompra_id,
		  DETALLE_REQCOMPRA.req_compra_id,
		  DETALLE_REQCOMPRA.almacen_id,
		  DETALLE_REQCOMPRA.detalle_reqcompra_cantidad,
		  DETALLE_REQCOMPRA.producto_id,
		  UNIDADES.prefijo,
		  MATERIAL.material_descripcion
		   from DETALLE_REQCOMPRA, MATERIAL, UNIDADES
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
		  function update_status_compras($edo, $orden_compra, $obs, $fecha_entrega)
	  {

	  		list($month,$day,$year)=explode("/",$fecha_entrega);
			$insertdate = $year."-".$month."-".$day." 00:00:00";


		  $sql = "UPDATE ORDEN_COMPRA set fecha_entrega_prometida='".$insertdate."' , orden_edo=".$edo."";
		  if($obs=="")
		  	$sql=$sql.", orden_observaciones='".$obs."'";
		   $sql=$sql." where orden_compra_id=".$orden_compra."";
		   echo "$sql";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res/*&&$renglones==1*/)
			return "OK";
		  else 
			return mysql_error();
	  }


	  	  function detalle_compras($search)
	  {
		  $sql = "SELECT 
		  DETALLE_COMPRA.detalle_id,
		  MATERIAL.material_descripcion,
		  DETALLE_COMPRA.detalle_compra_cantidad,
		  DETALLE_COMPRA.detalle_compra_cantidad_s,
		  DETALLE_COMPRA.producto_id,
		  DETALLE_COMPRA.costo
		  from ORDEN_COMPRA, DETALLE_COMPRA, MATERIAL  
		  where MATERIAL.material_id = DETALLE_COMPRA.producto_id AND ORDEN_COMPRA.orden_compra_id = DETALLE_COMPRA.orden_compra_id AND ORDEN_COMPRA.orden_compra_id=".$search."";

		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;
	  }
	  


	  function update_almacenGeneral(
	  	   $orden_id,		  
		   $obs,
		   $fecha_recibo,
		   $factura_compra,
		   $usuario_id
		)

		{
			
		// convierto fecha a fechaMySQL
			
			list($year,$month,$day)=explode("-",$fecha_recibo);
			$insertdate = $year."-".$month."-".$day." 00:00:00";

			$sql = "update ORDEN_COMPRA set fecha_entrega='".$insertdate."' , factura_proveedor='".$factura_compra."', orden_edo=8, usuario_id_almacen='".$usuario_id."', orden_observaciones='".$obs."'";
			
			$sql=$sql." where orden_compra_id=".$orden_id."";
			
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}


 function ObtieneRequisiciones()
          {
		  
		 $sql="SELECT 
		  REQ_COMPRA.req_id, 
		  REQ_COMPRA.fecha_creacion,  
		  REQ_COMPRA.fecha_req,
		  REQ_COMPRA.cliente_id, 
		  REQ_COMPRA.usuario_id,
		  EMPRESA.empresa_razonsocial,
		  REQ_COMPRA.observaciones,
		  REQ_COMPRA.req_edo,
		  REQ_COMPRA.folio
		  from REQ_COMPRA  
		  LEFT JOIN EMPRESA ON EMPRESA.empresa_id=REQ_COMPRA.empresa_id
		  where REQ_COMPRA.req_edo=2";
		 
		//  $sql=$sql." LIMIT $inicio, $fin";



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



 function busqueda_detalle($search)
	  {
		  $sql = "SELECT 
		  REQ_COMPRA.req_id, 
		  REQ_COMPRA.fecha_creacion, 
		  REQ_COMPRA.fecha_req, 
		  REQ_COMPRA.cliente_id, 
		  REQ_COMPRA.usuario_id, 
		  REQ_COMPRA.usuario_id_autoriza, 
		  REQ_COMPRA.observaciones, 
		  REQ_COMPRA.req_edo,
		  EMPRESA.empresa_razonsocial,
		  REQ_COMPRA.proyecto,
		  REQ_COMPRA.descripcion,
		  REQ_COMPRA.lugar_entrega,
		  REQ_COMPRA.empresa_id,
		  REQ_COMPRA.folio,
		  REQ_COMPRA.proveedor_id
		  from REQ_COMPRA 
		  LEFT JOIN EMPRESA ON EMPRESA.empresa_id=REQ_COMPRA.empresa_id
		  where 
		  REQ_COMPRA.req_id=".$search."";

		
		 				  //echo "$sql";
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

	}

?>