<?php
      class Operador
	{
	  private $link;	
	  function __construct()
	  {
		 
	  }
	  function conexion($link_bd)
	  {
		  $link=$link_bd;
	  }
	  function insert($nombre, $apellido_p, $apellido_m, $permiso, $licencia_no, $vigencia )
	  {   
	  	  $id=0;
          $sql = "
		  insert into operador
		  (nombre,
		   apellido_p,
		   apellido_m,
		   permiso,
		   licencia_no,
		   vigencia
		  )
		   values
		  ('".$nombre."','".$apellido_p."','".$apellido_m."','".$permiso."','".$licencia_no."','".$vigencia."')";
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
	  function operador_duplicado($licencia_no)
	  {
		  $sql="select operador_id from operador where licencia_no='".$Licencia_no."'";
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
		  $sql="select operador_id, nombre, apellido_p, apellido_m, permiso, licencia_no, vigencia from operador";
		  if(!empty($search))
		  {
		   $sql=$sql." where operador_id like '%".$search."%' OR nombre like '%".$search."%' OR licencia_no like '%".$search."%' ";
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
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3],$row[4],$row[5],$row[6]);
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
		  $sql="select operador_id, nombre, apellido_p, apellido_m, permiso, licencia_no, vigencia from operador";
		  if(!empty($search))
		  {
		   $sql=$sql." where (operador_id like '%".$search."%' OR nombre like '%".$search."%' OR licencia_no like '%".$search."%' ";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
		  $sql="delete from operador where operador_id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }

	  function ObtieneOperador()
          {
		  
		 $sql="SELECT operador_id, nombre, apellido_p, apellido_m, permiso, licencia_no, vigencia from operador";
		 
		//  $sql=$sql." LIMIT $inicio, $fin";
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
	  
	  function update( $operador_clave, $nombre, $apellido_p, $apellido_m, $permiso, $licencia_no, $vigencia)
		{
		$sql = "update operador set nombre='".$nombre."', apellido_p='".$apellido_p."', apellido_m='".$apellido_m."', permiso='".$permiso."', licencia_no='".$licencia_no."', vigencia='".$vigencia."' where operador_id=".$operador_clave;
	
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
	  
	  function detalle($search)
	  {
		  $sql = "select * from operador where operador_id='".$search."'";
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

	  function busqueda_operador($search)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT *
		  FROM OPERADOR where operador_id='".$search."'";
		  
		  $sql=$sql."  ";
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