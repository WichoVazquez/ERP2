<?
	 class Domicilio
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
	   	   $calle,
		   $num_ext,
		   $num_int,
		   $colonia,
		   $municipio,
		   $ciudad,
		   $estado,
		   $cp)
	  {   
		  $id;	
          $sql = "
		  insert into DOMICILIO
		  (domicilio_calle,
		   domicilio_num_ext,
		   domicilio_num_int,
		   domicilio_colonia,
		   domicilio_municipio,
		   domicilio_ciudad,
		   domicilio_estado,
		   domicilio_cp
		  )
		   values
		  ('".$calle."',
		   '".$num_ext."',
		   '".$num_int."',
		   '".$colonia."',
		   '".$municipio."',
		   '".$ciudad."',
		   '".$estado."',
		   '".$cp."'
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
		  $sql="delete from DOMICILIO where domicilio_id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	  function update(
	  	   $id,
	   	   $calle,
		   $num_ext,
		   $num_int,
		   $colonia,
		   $municipio,
		   $ciudad,
		   $estado,
		   $cp)
	  {   
		  	
          $sql = "
		  update DOMICILIO 
		  set domicilio_calle= '".$calle."',
		   domicilio_num_ext= '".$num_ext."',
		   domicilio_num_int= '".$num_int."',
		   domicilio_colonia= '".$colonia."',
		   domicilio_municipio= '".$municipio."',
		   domicilio_ciudad= '".$ciudad."',
		   domicilio_estado= '".$estado."',
		   domicilio_cp = '".$cp."'
		  where domicilio_id=".$id;
		  //echo "sql dom ".$sql;
		  $res=mysql_query($sql);
		  if($res)
				return "OK";
		  else
		  {
			  
			  return mysql_error();
		  }
	  }
	  
	  function detalle($search)
	  {
		  $sql = "select * from DOMICILIO where domicilio_id=".$search;
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