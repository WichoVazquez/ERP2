<?
      class Sucursal
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
		   $tipo,
		   $nombre,
		   $cliente_id,
		   $generales_id,
		   $domicilio_id
		   )
	  {   
          $sql = "
		  insert into SUCURSAL
		  (cliente_id,
		   tipo_establecimiento,
		   clave_nombre,
		   domicilio_id,
		   generales_id
		  )
		   values
		  ('".$cliente_id."',
		  1,
		   '".$nombre."',
		   ".$domicilio_id.",
		   ".$generales_id."
		  )";
		
		  $res=mysql_query($sql);
		  if($res)
		  		  
			  return "OK";
		  else{
			  return mysql_error();
		  }
		  
	
	  }
	  
	  function busqueda_parametros($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select SUCURSAL.sucursal_id,  SUCURSAL.tipo_establecimiento, SUCURSAL.clave_nombre, SUCURSAL.cliente_id, SUCURSAL.domicilio_id, SUCURSAL.generales_id, CLIENTE.cliente_razonsocial from SUCURSAL, CLIENTE where CLIENTE.cliente_id = SUCURSAL.cliente_id";
		  if(!empty($search))
		  {
		   $sql=$sql."select SUCURSAL.sucursal_id,  SUCURSAL.tipo_establecimiento, SUCURSAL.clave_nombre, SUCURSAL.cliente_id, SUCURSAL.domicilio_id, SUCURSAL.generales_id, CLIENTE.cliente_razonsocial from SUCURSAL, CLIENTE, GENERALES, DOMICILIO where (SUCURSAL.clave_nombre like '%".$search."%' OR CLIENTE.cliente_id like '%".$search."%' OR CLIENTE.cliente_razonsocial like '%".$search."%' OR CLIENTE.cliente_rfc like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%' OR GENERALES.apel_m like '%".$search."%'  OR GENERALES.tel_trabajo like '%".$search."%'  OR GENERALES.tel_casa like '%".$search."%' OR GENERALES.tel_cel like '%".$search."%' OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%' OR DOMICILIO.domicilio_municipio like '%".$search."%' OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' OR DOMICILIO.domicilio_cp like '%".$search."%') AND SUCURSAL.generales_id=GENERALES.generales_id AND SUCURSAL.domicilio_id=DOMICILIO.domicilio_id and SUCURSAL.cliente_id=CLIENTE.cliente_id";
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
	  function cuenta_resultado($search)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select SUCURSAL.sucursal_id from SUCURSAL";
		  if(!empty($search))
		  {
		   $sql=$sql.", GENERALES, DOMICILIO, CLIENTE where (SUCURSAL.clave_nombre like '%".$search."%' OR CLIENTE.cliente_id like '%".$search."%' OR CLIENTE.cliente_razonsocial like '%".$search."%' OR CLIENTE.cliente_rfc like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%' OR GENERALES.apel_m like '%".$search."%'  OR GENERALES.tel_trabajo like '%".$search."%'  OR GENERALES.tel_casa like '%".$search."%' OR GENERALES.tel_cel like '%".$search."%' OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%' OR DOMICILIO.domicilio_municipio like '%".$search."%' OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' OR DOMICILIO.domicilio_cp like '%".$search."%') AND SUCURSAL.generales_id=GENERALES.generales_id AND SUCURSAL.domicilio_id=DOMICILIO.domicilio_id and SUCURSAL.cliente_id=CLIENTE.cliente_id";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
		  $sql="delete from SUCURSAL where sucursal_id=".$id."";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	  function update(
	  	   $sucursal_id,
		   $tipo,
		   $nombre,
	  	   $cliente_id
		)
		{
			$sql = "UPDATE SUCURSAL set tipo_establecimiento=".$tipo.", clave_nombre='".$nombre."', cliente_id='".$cliente_id."' where sucursal_id=".$sucursal_id;
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
	  
	  function detalle_matriz_suc($search)
	  {
		  $sql = "select * from SUCURSAL where sucursal_id=".$search."";
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
	  
	  function lista_sucursal(){

			  $output="
				
				<br><br>Fecha de entrega: <input type='text' id='datepicker2'>
			  ";
		return $output;
	  }

	  function busqueda_sucursal_id($cliente)
	  {
		  
		  
		  $sql="SELECT  SUCURSAL.sucursal_id, SUCURSAL.clave_nombre, CLIENTE.cliente_id
		FROM SUCURSAL, CLIENTE
		WHERE CLIENTE.cliente_id = SUCURSAL.cliente_id
		AND CLIENTE.cliente_razonsocial = '".$cliente."' ";

		 
	
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
	}

?>