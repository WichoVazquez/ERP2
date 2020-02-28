<?php
      class Almacen
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
		   $name,
		   $descripcion,
		   $domicilio_id,
		   $tipo
		   )
	  {  

          $sql = "insert INTO 
		  ALMACEN(
	nombre,
	descripcion,
	domicilio_id,
	tipo,
	id_empresa
	)
	VALUES (
	'$name',  '$descripcion',  '$domicilio_id',  '$tipo', 3
	)";	
		  $res=mysql_query($sql);
		  if($res)
		  		  
			  $id=1;
		  else{
			  $id=0;
			  printf("Error:".mysql_error());
			
			  echo "$name";
			  echo "$domicilio_id";
		  }
		  return $id;
	
	  }

	  function busqueda_parametros($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT ALMACEN.almacen_id,ALMACEN.nombre,   ALMACEN.descripcion,ALMACEN.domicilio_id  from ALMACEN";
		  if(!empty($search))
		  {
		       $sql=$sql.",  DOMICILIO where (ALMACEN.almacen_id like '%".$search."%' OR ALMACEN.nombre like '%".$search."%' OR ALMACEN.descripcion like '%".$search."%'	) AND ALMACEN.domicilio_id=DOMICILIO.domicilio_id";
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
		  $sql="select ALMACEN.almacen_id from ALMACEN";
		  if(!empty($search))
		  {
		   $sql=$sql.",  DOMICILIO where (ALMACEN.almacen_id like '%".$search."%' OR ALMACEN.nombre like '%".$search."%' OR ALMACEN.descripcion like '%".$search."%'	) AND ALMACEN.domicilio_id=DOMICILIO.domicilio_id";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
		  $sql="delete from ALMACEN where almacen_id=".$id."";
		  //echo "$sql";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	   function update(
	   	   $almacen_id,
	  	   $nombre,
		   $descripcion
		)
		{
			$sql = "UPDATE ALMACEN set  nombre='".$nombre."', descripcion='".$descripcion."' where almacen_id='".$almacen_id."'";
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
	  
	  function detalle($search)
	  {
		  $sql = "SELECT * from ALMACEN where almacen_id='".$search."'";
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
	  	  function detalle_tabla()
	  {
		  $sql = "select ALMACEN.almacen_id, ALMACEN.nombre from ALMACEN";
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0], $row[1]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;
	  }
	   function detalle_tabla_talleres()
	  {
		  $sql = "SELECT ALMACEN.almacen_id, ALMACEN.nombre from ALMACEN";
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0], $row[1]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;
	  }
	   function detalle_almacen_taller()
	  {
		  $sql = "select ALMACEN.almacen_id, ALMACEN.nombre, ALMACEN.tipo from ALMACEN";
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
	  function solo_almacen()
	  {
		  $sql = "select ALMACEN.almacen_id, ALMACEN.nombre, ALMACEN.tipo from ALMACEN where ALMACEN.tipo=0";
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
	  function almacen_Duplicado($almacen)
	  {
	  	 $sql="select ALMACEN.almacen_id from ALMACEN where ALMACEN.nombre='".$almacen."'";
		  $res=mysql_query($sql);
		  if(mysql_num_rows ($res)>0){
			
		  	return true;
		  }
		  else
		  {
		  	return false;
		  }
	  }
	  
	  
	}

?>