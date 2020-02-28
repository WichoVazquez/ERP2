<?
      class Orden_compra
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
		   $usuario_id,
	   	   $proveedor_id,
		   $req_id,
		   $orden_edo
		   )
	  {   

if($proveedor_id=="0")
	$proveedor_id = "NULL";


          $sql = "
		  INSERT into ORDEN_COMPRA
		  (
		   proveedor_id,
		   usuario_id,
		   req_id,
		   orden_edo,
		   fecha_compra
		  )
		   values
		  (
		   ".$proveedor_id.",
		  '".$usuario_id."',
		  ".$req_id.",
		   ".$orden_edo.",
		   NOW()

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

	  function insert_empty($usuario_id)
	  {   
	  	  $id=0;
          $sql = "
		  insert into COTIZACION
		  (usuario_id
		  )
		   values
		  (
		  	'".$usuario_id."'
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
	  	   $orden_id,
	  	 $fechaini_orden,
	   	$fechafin_orden,
		   $obs_orden,
		   $departamento,
		   $proveedor_id,
		   $proveedor_contacto,
		   $proveedor_email,
		   $proveedor_tel,
		   $status,
		   $condiciones,
		   $certificado,
		   $contacto_entrega,
		   $domicilio_entrega,
		   $tipo_orden

		)

		{
			
		// convierto fecha a fechaMySQL

			if($proveedor_id=="0")
				$proveedor_id = "NULL";
/*
			list($month,$day,$year)=explode("/",$fechaini_orden);
			$insertdate_ini = $year."-".$month."-".$day."";

			list($month,$day,$year)=explode("/",$fechafin_orden);
			$insertdate_fin = $year."-".$month."-".$day."";
*/

$sql = "SELECT parametro_1 from PARAMETROS where parametro_var='".$departamento."'";
               
                  $res=mysql_query($sql);
                  if($res&&mysql_num_rows($res)>0)                  {
                          $row=mysql_fetch_row($res);
                          $folio_previo =  $row[0];
                           $folio = $departamento."-16-06".$folio_previo;
                  }

     
                 

			$folio_nuevo = $folio_previo + 1;
			$sql = "UPDATE PARAMETROS set parametro_1=".$folio_nuevo."  where parametro_var='".$departamento."'";
		 $res=mysql_query($sql);


			$sql = "UPDATE ORDEN_COMPRA set 
			fecha_compra='".$fechaini_orden."', 
			fecha_entrega_prometida='".$fechafin_orden."', 
			orden_observaciones='".$obs_orden."',
			folio_orden='".$folio."' , 
			proveedor_id=".$proveedor_id.", 
			proveedor_contacto='".$proveedor_contacto."' , 
			proveedor_email='".$proveedor_email."' , 
			proveedor_tel='".$proveedor_tel."' ,
			condiciones='".$condiciones."' ,
			certificado='".$certificado."' ,
			contacto_entrega='".$contacto_entrega."' ,
			domicilio_entrega='".$domicilio_entrega."' ,
			orden_edo=".$status." ,
			tipo_orden='".$tipo_orden."'";

			
			$sql=$sql." where orden_compra_id=".$orden_id."";
	
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
		
	  function update_status($edo, $orden_compra, $obs)
	  {
		  $sql = "UPDATE ORDEN_COMPRA set orden_edo=".$edo."";
		  if($obs!="")
		  	$sql=$sql.", orden_observaciones='".$obs."'";
		   $sql=$sql." where orden_compra_id=".$orden_compra."";
		   
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res/*&&$renglones==1*/)
			return "OK";
		  else 
			return mysql_error();
	  }
	  

	  
	  function busqueda_parametros($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select COTIZACION.cotizacion_id, COTIZACION.cotizacion_edo, COTIZACION.cliente_id, COTIZACION.usuario_id, COTIZACION.empresa_id,COTIZACION.cotizacion_folio, COTIZACION.cotizacion_fecha_modificacion, COTIZACION.cotizacion_fecha_envio, COTIZACION.cotizacion_observaciones from COTIZACION";
		  if(!empty($search))
		  {
		   $sql=$sql.", CLIENTE, USUARIO, EMPRESA, GENERALES, DOMICILIO where (COTIZACION.cotizacion_id like '%".$search."%' OR USUARIO.usuario_id like '%".$search."%' OR CLIENTE.cliente_id like '%".$search."%'  OR CLIENTE.cliente_razonsocial like '%".$search."%' OR EMPRESA.empresa_id like '%".$search."%' OR EMPRESA.empresa_razonsocial like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%'  OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%'  OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' )  AND USUARIO.generales_id=GENERALES.generales_id AND CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id AND COTIZACION.cotizacion_edo<>0";
		  }
		  else
		   $sql=$sql." where COTIZACION.cotizacion_edo<>0";
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
	  
	  function cuenta_resultado($search)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select COTIZACION.cotizacion_id from COTIZACION";
		  if(!empty($search))
		  {
		   $sql=$sql.", CLIENTE, USUARIO, EMPRESA, GENERALES, DOMICILIO where (COTIZACION.cotizacion_id like '%".$search."%' OR USUARIO.usuario_id like '%".$search."%' OR CLIENTE.cliente_id like '%".$search."%'  OR CLIENTE.cliente_razonsocial like '%".$search."%' OR EMPRESA.empresa_id like '%".$search."%' OR EMPRESA.empresa_razonsocial like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%'  OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%'  OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' )  AND USUARIO.generales_id=GENERALES.generales_id AND CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id AND COTIZACION.cotizacion_edo<>0";
		  }
		  else
		   $sql=$sql." where COTIZACION.cotizacion_edo<>0";
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function busqueda_parametros_usuario($user, $search, $inicio, $fin, $filter)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT 
		  ORDEN_COMPRA.orden_compra_id, 
		  ORDEN_COMPRA.orden_edo,  
		  DATE(ORDEN_COMPRA.fecha_compra), 
		  DATE(ORDEN_COMPRA.fecha_entrega_prometida), 
		  DATE(ORDEN_COMPRA.fecha_entrega),
		  ORDEN_COMPRA.orden_observaciones,
				PROVEEDOR.proveedor_rs,
				PROVEEDOR.proveedor_id,
				ORDEN_COMPRA.orden_edo,
				ORDEN_COMPRA.folio_orden,
				ORDEN_COMPRA.req_id
		   from ORDEN_COMPRA, PROVEEDOR WHERE ";
		
		  if($filter>0)
		  	$sql=$sql."ORDEN_COMPRA.orden_edo=".$filter;
		  else
		  	$sql=$sql."PROVEEDOR.proveedor_id = ORDEN_COMPRA.proveedor_id AND ORDEN_COMPRA.orden_edo<>0";		
		  $sql=$sql." ORDER BY ORDEN_COMPRA.orden_edo ASC LIMIT $inicio, $fin";
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
	  
	  function cuenta_resultado_usuario($user,$search, $filter)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select ORDEN_COMPRA.orden_compra_id from ORDEN_COMPRA";
		  if(!empty($search))
		  {
		   $sql=$sql.", PROVEEDOR where (PROVEEDOR.proveedor_rs like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%'  OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%'  OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' ) AND USUARIO.generales_id=GENERALES.generales_id AND PROVEEDOR.domicilio_id=DOMICILIO.domicilio_id AND PROVEEDOR.proveedor_id=ORDEN_COMPRA.proveedor_id and USUARIO.usuario_id=ORDEN_COMPRA.usuario_id AND COTIZACION.cotizacion_edo<>0";
		  }
		  else
		   	$sql=$sql." where ORDEN_COMPRA.usuario_id='".$user."'";
		  if($filter>0)
		  	$sql=$sql." AND ORDEN_COMPRA.orden_edo=".$filter;
		  else
		  	$sql=$sql." AND ORDEN_COMPRA.orden_edo<>0";		
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function detalle($search)
	  {
		  $sql = "SELECT 
		  ORDEN_COMPRA.orden_compra_id,          /*  0  */
		  ORDEN_COMPRA.usuario_id, 
		  ORDEN_COMPRA.proveedor_id, 
		  ORDEN_COMPRA.fecha_compra, 
		  ORDEN_COMPRA.fecha_entrega_prometida,  /*  4  */
		  ORDEN_COMPRA.orden_observaciones,      /*  5  */
		  ORDEN_COMPRA.orden_edo,
		  PROVEEDOR.proveedor_rs,  
		  PROVEEDOR.proveedor_id,
		  ORDEN_COMPRA.factura_proveedor,
		  ORDEN_COMPRA.req_id,			/*  10  */
		  ORDEN_COMPRA.folio_orden,
		  ORDEN_COMPRA.proveedor_contacto,
		  ORDEN_COMPRA.proveedor_email,
		  ORDEN_COMPRA.proveedor_tel,             /*  14  */
		  REQ_COMPRA.empresa_id,
		  ORDEN_COMPRA.condiciones, /*16*/
		  ORDEN_COMPRA.certificado,
		  ORDEN_COMPRA.contacto_entrega,
		  ORDEN_COMPRA.domicilio_entrega
		  from ORDEN_COMPRA, PROVEEDOR, REQ_COMPRA
		  where ORDEN_COMPRA.proveedor_id=PROVEEDOR.proveedor_id AND ORDEN_COMPRA.req_id=REQ_COMPRA.req_id 
		  AND ORDEN_COMPRA.orden_compra_id=".$search."";
		
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


	  function update_status_autoriza($edo, $orden_compra, $obs, $usuario)
	  {
		  $sql = "UPDATE ORDEN_COMPRA set 
		  orden_edo=".$edo.",
		  usuario_id_autoriza='".$usuario."', 
		  fecha_autoriza=NOW() ";
		
		   $sql=$sql." where orden_compra_id=".$orden_compra."";
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
		  DETALLE_COMPRA.producto_desc,
		  DETALLE_COMPRA.detalle_compra_cantidad,
		  DETALLE_COMPRA.detalle_compra_cantidad_s,
		  DETALLE_COMPRA.producto_id,
		  DETALLE_COMPRA.costo,
		  MATERIAL.idSAE,
		  UNIDADES.prefijo,
		  MATERIAL.material_id,
		  MATERIAL.material_maquila
		  from ORDEN_COMPRA, DETALLE_COMPRA, UNIDADES, MATERIAL
		  where  ORDEN_COMPRA.orden_compra_id = DETALLE_COMPRA.orden_compra_id AND 
		  MATERIAL.material_id = DETALLE_COMPRA.producto_id AND
		  UNIDADES.id_unidad=MATERIAL.id_unidad AND  
		  ORDEN_COMPRA.orden_compra_id=".$search."";

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

			$sql = "update ORDEN_COMPRA set fecha_entrega='".$insertdate."' , factura_proveedor='".$factura_compra."', orden_edo=4, usuario_id_almacen='".$usuario_id."', orden_observaciones='".$obs."'";
			
			$sql=$sql." where orden_compra_id=".$orden_id."";
			
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}




	}

?>