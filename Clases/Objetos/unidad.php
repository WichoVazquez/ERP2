<?php
      class Unidad
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
	   	  $prefijo
		 )
	  {   
	  	  $id=0;
          $sql = "
		  INSERT into UNIDADES
		  (prefijo)
		   values
		  ('".$prefijo."')";
		  $res=mysql_query($sql);
		  if($res)
		  		  
			  $id=mysql_insert_id();
		  else{
			  $id=0;
			  printf("Error:".mysql_error());
		  }
		  return $id;
	
	  }
	  function insert_presentaciones(
	   	  $descripcion
		 )
	  {   
	  	  $id=0;
          $sql = "INSERT into PRESENTACIONES
		  (descripcion)
		   values
		  ('".$descripcion."')";
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
	   	   $id_unidad,
		   $descripcion
		)
		{
			$sql = "UPDATE UNIDADES set prefijo='".$descripcion."' where id_unidad='".$id_unidad."'";
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}

		function detalle()
	  {

		  $sql = "SELECT id_unidad, prefijo from UNIDADES";

		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0],$row[1]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;
	  }
	  
		function detalle_r($id)
	  {

		  $sql = "SELECT * from UNIDADES where id_unidad=".$id."";

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

	  function delete($id)
	  {
		  $sql="delete from UNIDADES where id_unidad=".$id."";
		  //echo "$sql";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }

 function busqueda_parametros($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT 
		  id_unidad, 
		  prefijo 
		  from UNIDADES";
		  if(!empty($search))
		  {
		   $sql=$sql." where prefijo like '%".$search."%' ";
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
				  $array[$cont_array]=array($row[0], $row[1]);
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
	  $sql="SELECT 
		  id_unidad, 
		  prefijo 
		  from UNIDADES";
		  if(!empty($search))
		  {
		   $sql=$sql." where prefijo like '%".$search."%' ";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  

	  function detalle_presentaciones_total()
	  {

		  $sql = "SELECT id_presentacion, descripcion from PRESENTACIONES";

		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0],$row[1]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;
	  }

	  function detalle_prefijo($search)
	  {

		  $sql = "SELECT id_unidad, prefijo from UNIDADES where prefijo='".$search."'";

		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0],$row[1]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;
	  }

	   function detalle_presentaciones($search)
	  {

		  $sql = "SELECT id_presentacion, descripcion from PRESENTACIONES where	descripcion='".$search."'";

		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0],$row[1]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;
	  }

	  	  function detalle_id($search)
	  {

		  $sql = "SELECT id_unidad, prefijo from UNIDADES where id_unidad=".$search;

		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0],$row[1]);
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