<?
      class Prospecto
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
		   cliente_domicilio_fiscal,
		   status
		  )
		   values
		  ('".$cliente_id."',
		   '".$razonsocial."',
		   '".$rfc."',
		   ".$domicilio_id.",
		   1
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
	   function insert_prospecto(
	   		$carta,
	   		$material,
	   		$visita,
	   		$cotiza,
	   	   $cliente_id
		   )
	  {   
	  	  $id=0;
          $sql = "
		  insert into PROSPECTO
		  (cliente_id,
		   fecha_prospecto,
		   carta_presentacion,
		   material_multimedia,
		   visita_cliente,
		   cotizacion
		  )
		   values
		  ('".$cliente_id."',
		  	NOW(),
		   ".$carta.",
		   ".$material.",
		   ".$visita.",
		   ".$cotiza."
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
	  
	  function rfc_duplicado($cliente)
	  {
		  $sql="select cliente_rfc from CLIENTE where cliente_rfc='".$cliente."'";
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
		  $sql="SELECT CLIENTE.cliente_id, CLIENTE.cliente_razonsocial, PROSPECTO.fecha_prospecto, PROSPECTO.carta_presentacion, PROSPECTO.material_multimedia, PROSPECTO.visita_cliente, PROSPECTO.cotizacion
			FROM CLIENTE, PROSPECTO
			WHERE CLIENTE.status =1
			AND PROSPECTO.cliente_id = CLIENTE.cliente_id";
		  if(!empty($search))
		  {
		   $sql=$sql." and CLIENTE.cliente_razonsocial like '%".$search."%'";
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
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;
	  }
	  
	  function busqueda_cliente_id($search)
	  {
		  
		  $search= str_replace(' ', '%', $search);
		  $sql="select CLIENTE.cliente_id, CLIENTE.cliente_razonsocial,CLIENTE.cliente_rfc from CLIENTE where status=1";
		  if(!empty($search))
		  {
		   $sql=$sql." where (CLIENTE.cliente_id like '%".$search."%' OR CLIENTE.cliente_razonsocial like '%".$search."%' OR CLIENTE.cliente_rfc like '%".$search."%') and status=1";
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
	  
	  
	  function cuenta_resultado()
	  {
		
		  $sql="SELECT CLIENTE.cliente_id 
			FROM CLIENTE
			WHERE CLIENTE.status = 1 ";
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
		  $sql="DELETE from CLIENTE where CLIENTE.cliente_id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  	  function delete_doc($id)
	  {
		  $sql="DELETE from PROSPECTO where PROSPECTO.cliente_id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	  function update(
	   		$carta,
	   		$material,
	   		$visita,
	   		$cotiza,
	   	    $cliente_id
		   )
		{
			$sql = "UPDATE PROSPECTO 
			SET  
			PROSPECTO.carta_presentacion = ".$carta.", 
			PROSPECTO.material_multimedia = ".$material.", 
			PROSPECTO.visita_cliente = ".$visita.",
			PROSPECTO.cotizacion = ".$cotiza." 
			WHERE PROSPECTO.cliente_id='".$cliente_id."'";

		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
	  
	  function detalle($search)
	  {
		  $sql = "SELECT * 
		  FROM CLIENTE 
		  WHERE cliente_id='".$search."'";
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
	  	  function detalle_documentos($search)
	  {
		  $sql = "SELECT PROSPECTO.carta_presentacion, PROSPECTO.material_multimedia, PROSPECTO.visita_cliente, PROSPECTO.cotizacion 
		  FROM PROSPECTO 
		  WHERE PROSPECTO.cliente_id='".$search."'";
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