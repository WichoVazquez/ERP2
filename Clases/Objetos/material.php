<?php
      class Material
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
		   $tipo,
		   $unidad,
		   $maquila,
		   $idsae,
		   $flete,
		   $id_presentacion)
	  {   
	  	  $id=0;
          $sql = "
		  insert into MATERIAL
		  (material_descripcion,
		   material_tipo,
		   id_unidad,
		   material_precio,
		   material_maquila,
		   idSAE,
		   flete,
		   id_presentacion)
		   values
		  ('".$descripcion."',
		   ".$tipo.",
		   ".$unidad.", 0, ".$maquila.",'".$idsae."','".$flete."',
		   ".$id_presentacion.")";
		  $res=mysql_query($sql);
		  if($res)
		  		  
			  $id=mysql_insert_id();
		  else{
			  $id=0;
			  printf("Error:".mysql_error());
		  }
		  return $id;
	
	  }
	  	  function insert_material(
	   	$descripcion,
		   $tipo,
		   $unidad,
		   $maquila,
		   $idsae,
		   $flete,
		   $id_presentacion)
	  {   
	  	  $id=0;
          $sql = "
		  insert into MATERIAL
		  (material_descripcion,
		   material_tipo,
		   id_unidad,
		   material_maquila,
		   idSAE,
		   flete,
		   id_presentacion)
		   values
		  ('".$descripcion."',
		   ".$tipo.",
		   ".$unidad.",".$maquila.",'".$idsae."','".$flete."',
		   ".$id_presentacion.")";
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
		  $sql = "select * from MATERIAL where material_id=".$search;
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

	  function almacenes_rafa($producto){
	  	$sql="SELECT 
	  	  MATERIAL.material_id,
          ALMACEN.nombre,
          ALMACEN_MATERIAL.cantidad_actual
          FROM MATERIAL,ALMACEN,ALMACEN_MATERIAL 
          where 
          MATERIAL.material_id=ALMACEN_MATERIAL.material_id AND
          ALMACEN.almacen_id=ALMACEN_MATERIAL.almacen_id
          AND ALMACEN.tipo=0
          AND ALMACEN.almacen_id!=19
          AND MATERIAL.material_id=".$producto.";
          ";
          //echo "el puto query:".$sql;
          $res=mysql_query($sql);
                  $renglones=mysql_num_rows($res);
                  $cont_array=0;
                  $array=array(); // create new empty array
                  
                  if($renglones>0)
                  {
                          
                    while($row=mysql_fetch_row($res))
                          {
                             $array[$cont_array]=array($row[0],$row[1],$row[2]);
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
			  $sql="select MATERIAL.material_id, MATERIAL.material_descripcion,MATERIAL.material_tipo, MATERIAL.material_unidad, ALMACEN.descripcion from MATERIAL,  ALMACEN";
		  if(!empty($search))
		  {
		   $sql=$sql.", ALMACEN_MATERIAL where (MATERIAL.material_descripcion like '%".$search."%'  OR MATERIAL.material_unidad like '%".$search."%' OR  ALMACEN.descripcion like '%".$search."%') AND ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id ";
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
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4]);
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
		  ALMACEN_MATERIAL.almacen_material_id,
		  MATERIAL.flete
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


	 function update(
	  	 $material_id,
	  	   $material_descripcion,
		   $material_tipo,
		   $material_unidad,
		   $material_maquila,
		   $flete,
		   $idsae
		)
		{
			$sql = "UPDATE MATERIAL set  
			material_descripcion='".$material_descripcion."', 
			material_tipo=".$material_tipo.", 
			id_unidad=".$material_unidad.", 
			material_maquila=".$material_maquila.", 
			flete='".$flete."', 
			idSAE='".$idsae."' 
			WHERE material_id=".$material_id."";
		//	echo "sql material: ".$sql;
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return (mysql_error()."query".$sql);
			
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
	  
	  function busqueda_material_id($search)
	  {
		  
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT MATERIAL.material_id, MATERIAL.material_descripcion, UNIDADES.prefijo, MATERIAL.material_precio, ALMACEN_MATERIAL.cantidad_actual, PRESENTACIONES.descripcion from MATERIAL, UNIDADES, ALMACEN_MATERIAL, ALMACEN, PRESENTACIONES  where ";
		  if(!empty($search))
		  {
		   $sql=$sql." (MATERIAL.idSAE like '%".$search."%' OR MATERIAL.material_descripcion like '%".$search."%') and";
		  }
		  $sql=$sql." MATERIAL.id_unidad=UNIDADES.id_unidad and 
		  ALMACEN_MATERIAL.material_id = MATERIAL.material_id AND 
		  MATERIAL.id_presentacion = PRESENTACIONES.id_presentacion AND
		  ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id";

		 // echo "el query loco este:".$sql;
		  $res=mysql_query($sql);

		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;
	  }
	  
	  
	  function material_Duplicado($material)
	  {
	  	 $sql="select MATERIAL.material_id from material where material_descripcion='".$material."'";

		  $res=mysql_query($sql);
		  if(mysql_num_rows ($res)>0){
			
		  	return true;
		  }
		  else
		  {
		  	return false;
		  }
	  }
	    function material_SAE($material)
	  {
	  	 $sql="select MATERIAL.idSAE from material where idSAE='".$material."'";

		  $res=mysql_query($sql);
		  if(mysql_num_rows ($res)>0){
			
		  	return true;
		  }
		  else
		  {
		  	return false;
		  }
	  }
	   function material_Duplicado_Editado($material)
	  {
	  	 $sql="select MATERIAL.material_id from material where material_descripcion='".$material."'";

		  $res=mysql_query($sql);
		  if(mysql_num_rows ($res)>1){
			
		  	return true;
		  }
		  else
		  {
		  	return false;
		  }
	  }


	   function cuenta_resultado_sinstock($search)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT 
			  ALMACEN_MATERIAL.almacen_material_id,
			  ALMACEN.nombre,
			  MATERIAL.material_descripcion,
			  ALMACEN_MATERIAL.cantidad_actual,
			  ALMACEN_MATERIAL.minimo,
			  MATERIAL.material_tipo,
			  MATERIAL.id_unidad, 
			  MATERIAL.material_id, 
			  ALMACEN.almacen_id,
			  ALMACEN.descripcion from MATERIAL,  ALMACEN, ALMACEN_MATERIAL  
			  where ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id and (ALMACEN_MATERIAL.cantidad_actual=0 OR ALMACEN_MATERIAL.cantidad_actual<=ALMACEN_MATERIAL.minimo)";
	
		  if(!empty($search))
		  {
		   $sql="SELECT 
			  ALMACEN_MATERIAL.almacen_material_id,
			  ALMACEN.nombre,
			  MATERIAL.material_descripcion,
			  ALMACEN_MATERIAL.cantidad_actual,
			  ALMACEN_MATERIAL.minimo,
			  MATERIAL.material_tipo,
			  MATERIAL.material_unidad, 
			  MATERIAL.id_unidad, 
			  ALMACEN.almacen_id,
			  ALMACEN.descripcion FROM MATERIAL,  ALMACEN, ALMACEN_MATERIAL  
			  WHERE (MATERIAL.material_descripcion like '%".$search."%' OR MATERIAL.material_unidad like '%".$search."%' OR  ALMACEN.descripcion like '%".$search."%') AND ALMACEN_MATERIAL.material_id=MATERIAL.material_id AND ALMACEN_MATERIAL.almacen_id = ALMACEN.almacen_id and (ALMACEN_MATERIAL.cantidad_actual=0 OR ALMACEN_MATERIAL.cantidad_actual<=ALMACEN_MATERIAL.minimo)";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  } 

	}

?>