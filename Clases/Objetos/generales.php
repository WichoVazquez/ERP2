<?
      class Generales
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
	   	   $nombre,
		   $apel_p,
		   $apel_m,
		   $tel_trabajo,
		   $ext_tel_trabajo,
		   $tel_casa,
		   $tel_cel,
		   $email)
	  {   
	  	  $id=0;
          $sql = "
		  insert into GENERALES
		  (nombre,
		   apel_p,
		   apel_m,
		   tel_trabajo,
		   ext_tel_trabajo,
		   tel_casa,
		   tel_cel,
		   email
		  )
		   values
		  ('".$nombre."',
		   '".$apel_p."',
		   '".$apel_m."',
		   '".$tel_trabajo."',
		   '".$ext_tel_trabajo."',
		   '".$tel_casa."',
		   '".$tel_cel."',
		   '".$email."'
		  )";
		  $res=mysql_query($sql);
		  if($res)
		  		  
			  $id=mysql_insert_id();
		  else{
			  $id=0;
			  printf("Error:".mysql_error());
		  }
		  return $id;
	
	  }
	  
	  function update(
	  	   $id,
	   	   $nombre,
		   $apel_p,
		   $apel_m,
		   $tel_trabajo,
		   $ext_tel_trabajo,
		   $tel_casa,
		   $tel_cel,
		   $email)
	  {   
	  	  
          $sql = "
		  update GENERALES
		   set nombre='".$nombre."',
		   apel_p = '".$apel_p."',
		   apel_m = '".$apel_m."',
		   tel_trabajo = '".$tel_trabajo."',
		   ext_tel_trabajo = '".$ext_tel_trabajo."',
		   tel_casa = '".$tel_casa."',
		   tel_cel = '".$tel_cel."',
		   email = '".$email."'
		   where generales_id=".$id;
		  // echo "sql generales ".$sql;
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
		  $sql = "select * from GENERALES where generales_id=".$search;
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
	  
	  function email_duplicado($email)
	  {
		  $sql = "select email from GENERALES where email='".$email."'";
		  $res=mysql_query($sql);
		  if(mysql_num_rows ($res)>0)
		  	return true;
		  else
		  	return false;
	  }
	  
	  function delete($id)
	  {
		  $sql="delete from GENERALES where generales_id=".$id."";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	}

?>