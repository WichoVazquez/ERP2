<?
      class Contacto_Ventas
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
		   $generales_id
		   )
	  {   
          $sql = "
		  insert into CONTACTO_VENTAS
		  (
		   cliente_id,
		   generales_id
		  )
		   values
		  (
		   '".$cliente_id."',
		   ".$generales_id."
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
		  $sql="select CONTACTO_VENTAS.contacto_ventas_id, CONTACTO_VENTAS.cliente_id, CONTACTO_VENTAS.generales_id from CONTACTO_VENTAS";
		  if(!empty($search))
		  {
		   $sql=$sql.", GENERALES, CLIENTE where (CLIENTE.cliente_id like '%".$search."%' OR CLIENTE.cliente_razonsocial like '%".$search."%' OR CLIENTE.cliente_rfc like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%' OR GENERALES.apel_m like '%".$search."%'  OR GENERALES.tel_trabajo like '%".$search."%'  OR GENERALES.tel_casa like '%".$search."%' OR GENERALES.tel_cel like '%".$search."%' OR GENERALES.email like '%".$search."%') AND CONTACTO_VENTAS.generales_id=GENERALES.generales_id AND CONTACTO_VENTAS.cliente_id=CLIENTE.cliente_id";
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
		  $sql="select SUCURSAL.sucursal_id from SUCURSAL";
		  if(!empty($search))
		  {
		   $sql=$sql.", GENERALES, DOMICILIO where (USUARIO.usuario_id like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%' OR GENERALES.apel_m like '%".$search."%'  OR GENERALES.tel_trabajo like '%".$search."%'  OR GENERALES.tel_casa like '%".$search."%' OR GENERALES.tel_cel like '%".$search."%' OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%' OR DOMICILIO.domicilio_municipio like '%".$search."%' OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' OR DOMICILIO.domicilio_cp like '%".$search."%') AND USUARIO.generales_id=GENERALES.generales_id AND USUARIO.domicilio_id=DOMICILIO.domicilio_id";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
		  $sql="delete from CONTACTO_VENTAS where cliente_id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	  function update(
	  	   $contacto_ventas_id,
	  	   $cliente_id,
		   $generales_id		)
		{
			$sql = "update CONTACTO_VENTAS set cliente_id=".$cliente_id.", generales_id=".$generales_id." where contacto_ventas_id='".$sucursal_id."'";
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
	  
	  function detalle($search)
	  {
		  $sql = "select * from CONTACTO_VENTAS where contacto_ventas_id=".$search."";
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
	  
	  function busqueda_contacto_id($cliente)
	  {
		  
		  
		  $sql="SELECT CONTACTO_VENTAS.contacto_ventas_id, GENERALES.nombre, GENERALES.apel_p, GENERALES.apel_m, GENERALES.generales_id, CONTACTO_VENTAS.generales_id, CLIENTE.cliente_id
FROM CONTACTO_VENTAS, GENERALES, CLIENTE
WHERE GENERALES.generales_id = CONTACTO_VENTAS.generales_id
AND (CLIENTE.cliente_id LIKE '$cliente' and CONTACTO_VENTAS.cliente_id LIKE '$cliente') ";

		  
	
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