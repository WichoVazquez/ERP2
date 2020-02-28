<?php
      class Taller_solicitud
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
		   $taller_id,
		   $usuario_id_solicitante,
		   $almacen_id,
		   $status
		   )
	  {  

          $sql = "INSERT INTO  TALLER_SOLICITUD(
	taller_id,
	usuario_id_solicitante,
	almacen_id,
	status
	)
	VALUES (
	'$taller_id',  
	'$usuario_id_solicitante',  
	'$almacen_id', 
	'$status'
	)";	


		  $res=mysql_query($sql);

			  if($res)
		  		  
			  $id=mysql_insert_id();
		  else{
			  $id=0;

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
		  $sql="delete from ALMACEN where almacen_id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_errno();
	  }
	  
	   function update_status(
	   	   $taller_solicitud_id,
	  	   $status
		)
		{

$sql = "SELECT DETALLE_TALLER_SOLICITUD where 	taller_solicitud_id=".$taller_solicitud_id;





			/*************************************************************/


			$sql = "UPDATE TALLER_SOLICITUD set  status='".$status."' where 	taller_solicitud_id=".$taller_solicitud_id;
	  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}

		  function detalle_solicitudes($search)
          {
                  $sql = "SELECT 
                  DETALLE_TALLER_SOLICITUD.detalle_taller_solicitud_id, 
                  MATERIAL.material_descripcion, 
                  DETALLE_TALLER_SOLICITUD.cantidad_solicitada,
                  PRESENTACIONES.descripcion 
FROM TALLER_SOLICITUD, DETALLE_TALLER_SOLICITUD, MATERIAL, PRESENTACIONES 
WHERE TALLER_SOLICITUD.taller_solicitud_id = DETALLE_TALLER_SOLICITUD.taller_solicitud_id
AND DETALLE_TALLER_SOLICITUD.producto_id = MATERIAL.material_id
AND MATERIAL.id_presentacion = PRESENTACIONES.id_presentacion 
AND TALLER_SOLICITUD.taller_solicitud_id =".$search."";



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