<?php
      class Precios
	{
	  private $link;
	  function __construct()
	  {
		 
	  }
	  function conexion($link_bd)
	  {
		  $link=$link_bd;
	  }

	  
	  function detalle_generales($search)
	  {
		  $sql = "select * from MATERIAES where materiales_id=".$search;
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
	  function busqueda_parametros($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
			  $sql="SELECT MATERIAL.material_id, MATERIAL.material_descripcion,MATERIAL.material_tipo, MATERIAL.material_precio  from MATERIAL";
		

		  if(!empty($search))
		  {
		   $sql=$sql." WHERE (MATERIAL.material_descripcion like '%".$search."%')";
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
		  $sql="select MATERIAL.material_id from MATERIAL";
		 
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  } 

		function detalle($search)
	  {
		  $sql = "SELECT  
		  MATERIAL.material_id, 
		  MATERIAL.material_descripcion,
		  MATERIAL.material_tipo, 
		  MATERIAL.material_precio
		  from MATERIAL where MATERIAL.material_id=".$search;


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


	  	  function update(
	  	   $material_id,
	  	   $material_precio
		)
		{
			$sql = "UPDATE MATERIAL set  material_precio=".$material_precio." where material_id=".$material_id."";
			
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
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

		function detalle_unicos()
	  {

		  $sql = "SELECT DISTINCT material_unidad FROM material";

		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;
	  }
	    function update_precios(
	  	   $IDSAE,
	  	   $material_precio
		)
		{
			$sql = "UPDATE MATERIAL set  material_precio=".$material_precio." where idSAE='".$IDSAE."'";
	
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}

	}

?>