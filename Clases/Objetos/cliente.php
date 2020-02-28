<?
      class Cliente
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
		   $razonsocial,
		   $rfc,
		   $domicilio_id
		   )
	  {   
	  	  $id=0;
          $sql = "
		  insert into CLIENTE
		  (cliente_id,
		   cliente_razonsocial,
		   cliente_rfc,
		   cliente_domicilio_fiscal
		  )
		   values
		  ('".$cliente_id."',
		   '".$razonsocial."',
		   '".$rfc."',
		   ".$domicilio_id."
		  )";
		  $res=mysql_query($sql);
		  if($res)
		  		  
			  $id=1;
		  else{
			  $id=0;
			  printf("Error:".mysql_error());
		  }
		  return $id;
	
	  }
	  function cliente_duplicado($cliente)
	  {
		  $sql="select cliente_id from CLIENTE where cliente_id='".$cliente."'";
		  $res=mysql_query($sql);
		  if(mysql_num_rows ($res)>0){
			
		  	return true;
		  }
		  else
		  {
		  	return false;
		  }
	  }
	  
	  function rfc_duplicado($rfc)
	  {
		  $sql="select cliente_rfc from CLIENTE where cliente_rfc='".$rfc."'";
		  $res=mysql_query($sql);
		  if(mysql_num_rows ($res)>0){
			
		  	return true;
		  }
		  else
		  {
		  	return false;
		  }
	  }
	  
	  function rs_duplicado($rs)
	  {
		  $sql="select cliente_rfc from CLIENTE where cliente_razonsocial='".$rs."'";
		  $res=mysql_query($sql);
		  if(mysql_num_rows ($res)>0){
			
		  	return true;
		  }
		  else
		  {
		  	return false;
		  }
	  }
	  function busqueda_parametros($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT CLIENTE.cliente_id, CLIENTE.cliente_razonsocial,CLIENTE.cliente_rfc, CLIENTE.cliente_domicilio_fiscal from CLIENTE";
		  if(!empty($search))
		  {
		   $sql=$sql.",  DOMICILIO where (CLIENTE.cliente_id like '%".$search."%' OR CLIENTE.cliente_razonsocial like '%".$search."%' OR CLIENTE.cliente_rfc like '%".$search."%'  OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%' OR DOMICILIO.domicilio_municipio like '%".$search."%' OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' OR DOMICILIO.domicilio_cp like '%".$search."%') AND CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id";
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
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;
	  }
	  
	  function busqueda_cliente_id($search, $user)
	  {
		  
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT CLIENTE.cliente_id, CLIENTE.cliente_razonsocial,CLIENTE.cliente_rfc  from CLIENTE";
		  if(!empty($search))
		  {
		   $sql=$sql." where (CLIENTE.cliente_id like '%".$search."%' OR CLIENTE.cliente_razonsocial like '%".$search."%' OR CLIENTE.cliente_rfc like '%".$search."%')";
		  }

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


	  function busqueda_cliente_id_todos($search, $user)
	  {
		  
		  $search= str_replace(' ', '%', $search);
		  $sql="select CLIENTE.cliente_id, CLIENTE.cliente_razonsocial,CLIENTE.cliente_rfc  from CLIENTE";
		  if(!empty($search))
		  {
		   $sql=$sql." where (CLIENTE.cliente_id like '%".$search."%' OR CLIENTE.cliente_razonsocial like '%".$search."%' OR CLIENTE.cliente_rfc like '%".$search."%')";
		  }
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
		  $sql="select CLIENTE.cliente_id from CLIENTE";
		  if(!empty($search))
		  {
		   $sql=$sql.",  DOMICILIO where (CLIENTE.cliente_id like '%".$search."%' OR CLIENTE.cliente_razonsocial like '%".$search."%' OR CLIENTE.cliente_rfc like '%".$search."%'  OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%' OR DOMICILIO.domicilio_municipio like '%".$search."%' OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' OR DOMICILIO.domicilio_cp like '%".$search."%') AND CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
		  $sql="delete from CLIENTE where cliente_id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	  function update(
	  	   $cliente_clave,
	  	   $cliente_id,
		   $razonsocial,
		   $rfc
		)
		{
			$sql = "update CLIENTE set cliente_id='".$cliente_id."', cliente_razonsocial='".$razonsocial."', cliente_rfc='".$rfc."' where cliente_id='".$cliente_clave."'";
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
	  
	  function detalle($search)
	  {
		  $sql = "select * from CLIENTE where cliente_id='".$search."'";
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
	  	  function detalle_print($search)
	  {
		  $sql = "SELECT 
		  CLIENTE.cliente_id, 
		  CLIENTE.cliente_razonsocial,
		  CLIENTE.cliente_rfc,
		  DOMICILIO.domicilio_calle,  /* 4  */
		  DOMICILIO.domicilio_num_ext, /* 5  */
		  DOMICILIO.domicilio_num_int, /* 6  */
		  DOMICILIO.domicilio_municipio, /* 7  */
		  DOMICILIO.domicilio_ciudad, /* 8  */
		  DOMICILIO.domicilio_estado, /* 9  */
		  DOMICILIO.domicilio_cp  from CLIENTE, DOMICILIO where DOMICILIO.domicilio_id=CLIENTE.cliente_domicilio_fiscal AND cliente_id='".$search."'";
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

	  function detalle_contacto($search)
	  {
		  $sql = "SELECT CLIENTE.cliente_id, CLIENTE.cliente_razonsocial, CLIENTE.cliente_rfc, CLIENTE.cliente_domicilio_fiscal, CLIENTE.status, CONTACTO_VENTAS.generales_id, GENERALES.email 
		  from CLIENTE, CONTACTO_VENTAS, GENERALES where CLIENTE.cliente_id='".$search."' AND CONTACTO_VENTAS.cliente_id = CLIENTE.cliente_id and GENERALES.generales_id = CONTACTO_VENTAS.generales_id";
		
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

	  function detalle_contacto_ventas($search)
	  {
		  $sql = "SELECT CLIENTE.cliente_id, CLIENTE.cliente_razonsocial, CLIENTE.cliente_rfc, CLIENTE.cliente_domicilio_fiscal, CLIENTE.status, CONTACTO_VENTAS.generales_id, GENERALES.email 
		  from CLIENTE, CONTACTO_VENTAS, GENERALES where CLIENTE.cliente_id='".$search."' AND CONTACTO_VENTAS.cliente_id = CLIENTE.cliente_id and GENERALES.generales_id = CONTACTO_VENTAS.generales_id";
		


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


	}

?>