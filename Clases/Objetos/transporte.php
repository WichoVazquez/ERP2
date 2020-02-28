	<?
      class Transporte
	{
	  private $link;	
	  function __construct()
	  {
		 
	  }
	  function conexion($link_bd)
	  {
		  $link=$link_bd;
	  }
	  function insert($Nombre,$Placas )
	  {   
	  	  $id=0;
          $sql = "
		  insert into TRANSPORTE
		  (transporte_Nombre,
		   transporte_Placas
		  )
		   values
		  ('".$Nombre."',
		  '".$Placas."')";
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
	  
	  function insert_remolque($Nombre,$Placas )
	  {   
	  	  $id=0;
          $sql = "
		  insert into REMOLQUE
		  (remolque_Nombre,
		   remolque_Placas
		  )
		   values
		  ('".$Nombre."',
		  '".$Placas."')";
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
	  
	  function placas_duplicado($placas)
	  {
		  $sql="select Transporte_Id from TRANSPORTE where transporte_Placas='".$placas."'";
		  $res=mysql_query($sql);
		  if(mysql_num_rows ($res)>0){
			
		  	return true;
		  }
		  else
		  {
		  	return false;
		  }
	  }
	  
	  
	 
 function ObtieneTransporte()
          {
		  
		 $sql="SELECT transporte_id,	transporte_nombre, transporte_placas from TRANSPORTE";
		 
		//  $sql=$sql." LIMIT $inicio, $fin";
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

          function ObtieneRemolque()
          {
		  
		 $sql="SELECT remolque_id,	remolque_nombre, remolque_placas from REMOLQUE";
		 
		//  $sql=$sql." LIMIT $inicio, $fin";
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
	  
	  function busqueda_parametros($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select Transporte_Id,transporte_Nombre, transporte_Placas from TRANSPORTE";
		  if(!empty($search))
		  {
		   $sql=$sql." where transporte_Nombre like '%".$search."%' OR transporte_Placas like '%".$search."%' ";
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
	   
	    function busqueda_parametros_remolque($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select remolque_Id,remolque_Nombre, remolque_Placas from REMOLQUE";
		  if(!empty($search))
		  {
		   $sql=$sql." where remolque_Nombre like '%".$search."%' OR remolque_Placas like '%".$search."%' ";
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
		  $sql="select Transporte_Id, transporte_Nombre, transporte_Placas from TRANSPORTE";
		  if(!empty($search))
		  {
		   $sql=$sql." where (Transporte_Id like '%".$search."%' OR transporte_Nombre like '%".$search."%' OR transporte_Placas like '%".$search."%' ";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
		  $sql="delete from TRANSPORTE where Transporte_Id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }

	  function delete_remolque($id)
	  {
		  $sql="delete from REMOLQUE where remolque_Id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	  function update( $transporte_id, $nombre,$placas)
		{
		$sql = "update TRANSPORTE set transporte_Nombre='".$nombre."', transporte_Placas='".$placas."' where Transporte_Id=".$transporte_id;
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
			//  return $sql;
				return mysql_error();
			
		}

		function update_remolque( $transporte_id, $nombre,$placas)
		{
		$sql = "update REMOLQUE set remolque_Nombre='".$nombre."', remolque_Placas='".$placas."' where remolque_Id=".$transporte_id;
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
			//  return $sql;
				return mysql_error();
			
		}
	  
	  function detalle($search)
	  {
		  $sql = "select * from TRANSPORTE where Transporte_Id='".$search."'";
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
	  
	  function detalle_remolque($search)
	  {
		  $sql = "select * from REMOLQUE where remolque_Id='".$search."'";
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