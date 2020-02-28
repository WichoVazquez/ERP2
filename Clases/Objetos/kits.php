<?
      class Kit
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

	   	   $kit_desc,
		   $tipo_kit,
		   $usuario_id
		   )
	  {   
	  	$fecha = date("Y-m-d H:i:s");
	  	  $id=0;
          $sql = "
		  insert into KITS
		  (
		   descripcion,
		   tipo,
		   fecha_alta,
		   usuario_id
		  )
		   values
		  (
		   '".$kit_desc."',
		   '".$tipo_kit."',
		   '".$fecha."',
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
		  $sql="delete from COTIZACION where cotizacion_id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	  function update(
	  	   $kits_id,
	  	   $kits_descripcion,
	  	   $precio
	  	   )
		{
			$sql = "UPDATE KITS set cotizacion_edo=".$edo.", cliente_id='".$cliente_id."', usuario_id='".$usuario_id."', empresa_id=".$empresa_id.", cotizacion_folio=".$folio.", moneda_id=".$moneda.", cotizacion_divisa_dia=".$cambio_dia.", cotizacion_observaciones='".$obs."' where cotizacion_id='".$cotizacion_id."'";
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
		
	  function update_status($edo, $cotizacion)
	  {
		  $sql = "update COTIZACION set cotizacion_edo=".$edo." where cotizacion_id=".$cotizacion_id."";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res/*&&$renglones==1*/)
			return "OK";
		  else 
			return mysql_error();
	  }
	  
	  function last_folio($user, $empresa)
	  {
		  $sql = "select cotizacion_folio from COTIZACION where usuario_id='".$user."' and empresa_id=".$empresa."   and cotizacion_folio<>0 ORDER BY cotizacion_folio DESC";
		  //echo "$sql";
		  $res=mysql_query($sql);
		  if($res&&mysql_num_rows($res)>0)
		  {
			  $row=mysql_fetch_row($res);
			  return $row[0];
		  }
		  else
		  {
			  return 0;
		  }
	  }
	  
	  function busqueda_parametros($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT COTIZACION.cotizacion_id, COTIZACION.cotizacion_edo, COTIZACION.cliente_id, COTIZACION.usuario_id, COTIZACION.empresa_id,COTIZACION.cotizacion_folio, COTIZACION.cotizacion_fecha_modificacion, COTIZACION.cotizacion_fecha_envio, COTIZACION.cotizacion_observaciones from COTIZACION";
		  if(!empty($search))
		  {
		   $sql=$sql.", CLIENTE, USUARIO, EMPRESA, GENERALES, DOMICILIO where (USUARIO.usuario_id like '%".$search."%' OR CLIENTE.cliente_id like '%".$search."%'  OR CLIENTE.cliente_razonsocial like '%".$search."%' OR EMPRESA.empresa_id like '%".$search."%' OR EMPRESA.empresa_razonsocial like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%'  OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%'  OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' )  AND USUARIO.generales_id=GENERALES.generales_id AND CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id";
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
		   $sql=$sql.", CLIENTE, USUARIO, EMPRESA, GENERALES, DOMICILIO where (USUARIO.usuario_id like '%".$search."%' OR CLIENTE.cliente_id like '%".$search."%'  OR CLIENTE.cliente_razonsocial like '%".$search."%' OR EMPRESA.empresa_id like '%".$search."%' OR EMPRESA.empresa_razonsocial like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%'  OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%'  OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' ) AND USUARIO.generales_id=GENERALES.generales_id AND CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function busqueda_parametros_usuario($user, $search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select COTIZACION.cotizacion_id, COTIZACION.cotizacion_edo, COTIZACION.cliente_id, COTIZACION.usuario_id, COTIZACION.empresa_id,COTIZACION.cotizacion_folio, COTIZACION.cotizacion_fecha_modificacion, COTIZACION.cotizacion_fecha_envio, COTIZACION.cotizacion_observaciones from COTIZACION";
		  if(!empty($search))
		  {
			$sql=$sql.", CLIENTE, USUARIO, EMPRESA where (USUARIO.usuario_id like '%".$search."%' OR CLIENTE.cliente_id like '%".$search."%'  OR CLIENTE.cliente_razonsocial like '%".$search."%' OR EMPRESA.empresa_id like '%".$search."%' OR EMPRESA.empresa_razonsocial like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%'  OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%'  OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' ) AND USUARIO.generales_id=GENERALES.generales_id AND CLIENTE.domicilio_id=DOMICILIO.domicilio_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id AND COTIZACION.usuario_id='".$user."'";
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
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;	  }
	  
	  function detalle($search)
	  {
		  $sql = "select * from COTIZACION where cotizacion_id='".$search."'";
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