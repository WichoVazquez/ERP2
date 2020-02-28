<?php
      class Servicio
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
	   	   $descripcion,
		   $precio
		   )
	  {   
	  	  $id=0;
          $sql = "INSERT INTO SERVICIO (
          servicio_descripcion,
		   servicio_precio
			)
		   values
		  ('".$descripcion."',
		   ".$precio."
		   )";
		// echo "SQL servicios:".$sql;
		  $res=mysql_query($sql);
		  if($res)
		  		  
			  $id=mysql_insert_id();
		  else{
			  $id=0;
			  printf("Error:".mysql_error());
		  }
		  return $id;
	
	  }
	  
	  function busqueda_material($search)
	  {
		  $sql = "SELECT * from SERVICIO where servicio_id=".$search;
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
	  
	  	  function cuenta_resultado($search)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select MATERIAL.material_id from MATERIAL";
		  if(!empty($search))
		  {
		   $sql=$sql.", ALMACEN_MATERIAL where (MATERIAL.material_descripcion like '%".$search."%'  OR MATERIAL.material_unidad like '%".$search."%' OR  ALMACEN.descripcion like '%".$search."%') AND ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id ";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  } 

		function detalle($search)
	  {
		  $sql = "SELECT 
		  MATERIAL.material_id, 
		  MATERIAL.material_descripcion, 
		  MATERIAL.id_unidad, 
		  MATERIAL.material_tipo, 
		  ALMACEN_MATERIAL.cantidad_actual,  
		  ALMACEN.nombre, 
		  ALMACEN_MATERIAL.minimo, 
		  ALMACEN_MATERIAL.maximo, 
		  ALMACEN_MATERIAL.almacen_material_id
		  from MATERIAL, ALMACEN, ALMACEN_MATERIAL where ALMACEN_MATERIAL.almacen_material_id=".$search." and ALMACEN_MATERIAL.material_id = MATERIAL.material_id AND ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id";


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
		  $sql="DELETE from MATERIAL where material_id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }

		
	  
	  function busqueda_material_id($search)
	  {
		  
		  $search= str_replace(' ', '%', $search);
		  $sql="select MATERIAL.material_id, MATERIAL.material_descripcion, UNIDADES.prefijo, MATERIAL.material_precio from MATERIAL, UNIDADES where ";
		  if(!empty($search))
		  {
		   $sql=$sql." (MATERIAL.material_id like '%".$search."%' OR MATERIAL.material_descripcion like '%".$search."%') and";
		  }
		  $sql=$sql." MATERIAL.material_tipo=2 and MATERIAL.id_unidad=UNIDADES.id_unidad";
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
	  
	  
	  
	   
	  

	}

?>