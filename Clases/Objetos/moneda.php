<?
      class Moneda
	{
	  private $link;	
	  function __construct()
	  {
		 
	  }
	  function conexion($link_bd)
	  {
		  $link=$link_bd;
	  }
	  function insert($Descripcion,$Prefijo, $TipoCambio )
	  {   
	  	  $id=0;
          $sql = "
		  insert into MONEDA
		  (moneda_descripcion,
		   moneda_prefijo,
		   moneda_tipo_cambio
		  )
		   values
		  ('".$Descripcion."',
		  ' ".$Prefijo."',".$TipoCambio.
		  ")";
		  $res=mysql_query($sql);
		  if($res)
		  		  
			  $id=mysql_insert_id();
		  else{
			  $id=0;
			  printf("Error:".mysql_error());
		  }
		  return $id;
		 //return $sql;
	
	  }
	  function moneda_duplicado($descripcion)
	  {
		  $sql="select moneda_id from MONEDA where moneda_descripcion='".$descripcion."'";
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
		  $sql="select moneda_id, moneda_descripcion, moneda_prefijo, moneda_tipo_cambio from MONEDA";
		  if(!empty($search))
		  {
		   $sql=$sql." where moneda_id like '%".$search."%' OR moneda_descripcion like '%".$search."%' OR moneda_prefijo like '%".$search."%' ";
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
	   
	 	  
	  function cuenta_resultado($search)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select moneda_id, moneda_descripcion, moneda_prefijo, moneda_tipo_cambio from MONEDA";
		  if(!empty($search))
		  {
		   $sql=$sql." where (moneda_id like '%".$search."%' OR moneda_descripcion like '%".$search."%' OR moneda_prefijo like '%".$search."%' ";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
		  $sql="delete from MONEDA where moneda_id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	  function update( $moneda_clave, $descripcion,$prefijo, $tipocambio	)
		{
		$sql = "update MONEDA set moneda_descripcion='".$descripcion."', moneda_Prefijo='".$prefijo."', moneda_tipo_cambio =". $tipocambio ." where Moneda_Id=".$moneda_clave;
	
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
	  
	  function detalle($search)
	  {
		  $sql = "select * from MONEDA where moneda_id='".$search."'";
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