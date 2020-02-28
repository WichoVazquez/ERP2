<?
      class Proveedor
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
	   	   $proveedor_id,
		   $razonsocial,
		   $rfc,
		   $domicilio_id,
		   $generales_id
		   )
	  {   
	  	  $id=0;
          $sql = "
		  insert into PROVEEDOR
		  (proveedor_rs,
		   proveedor_rfc,
		   domicilio_id,
		   generales_id
		  )
		   values
		  ('".$razonsocial."',
		   '".$rfc."',
		   ".$domicilio_id.",
		   ".$generales_id."
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
	  function razonSocial_duplicado($rasonSocial)
	  {
		  $sql="select proveedor_id from PROVEEDOR where proveedor_rs='".$rasonSocial."'";
		  $res=mysql_query($sql);
		  if(mysql_num_rows ($res)>0){
			
		  	return true;
		  }
		  else
		  {
		  	return false;
		  }
	  }
	  

	  
	  function rfcl_duplicado($rfc)
	  {
		  $sql="select proveedor_id from PROVEEDOR where proveedor_rfc='".$rfc."'";
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
		  $sql="select PROVEEDOR.proveedor_id, PROVEEDOR.proveedor_rs,PROVEEDOR.proveedor_rfc, PROVEEDOR.domicilio_id from PROVEEDOR";
		  if(!empty($search))
		  {
		   $sql=$sql.",  DOMICILIO where (PROVEEDOR.proveedor_id like '%".$search."%' OR PROVEEDOR.proveedor_rs like '%".$search."%' OR PROVEEDOR.proveedor_rfc like '%".$search."%'  OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%' OR DOMICILIO.domicilio_municipio like '%".$search."%' OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' OR DOMICILIO.domicilio_cp like '%".$search."%') AND PROVEEDOR.domicilio_id=DOMICILIO.domicilio_id";
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
		  $sql="select PROVEEDOR.proveedor_id from PROVEEDOR";
		  if(!empty($search))
		  {
		   $sql=$sql.",  DOMICILIO where (PROVEEDOR.proveedor_id like '%".$search."%' OR PROVEEDOR.proveedor_rs like '%".$search."%' OR PROVEEDOR.proveedor_rfc like '%".$search."%'  OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%' OR DOMICILIO.domicilio_municipio like '%".$search."%' OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' OR DOMICILIO.domicilio_cp like '%".$search."%') AND PROVEEDOR.domicilio_id=DOMICILIO.domicilio_id";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
	  		
	  		/* $sql="select domicilio_id from proveedor where proveedor_id='".$id."'";
		  $res=mysql_query($sql);
		  $domicilio_id=mysql_result($res, 0);
		  
		   $sql="select generales_id from proveedor where proveedor_id='".$id."'";
		  $res=mysql_query($sql);
		   $generales_id=mysql_result($res, 0);
		   
		  $sql= "delete from PROVEEDOR where proveedor_id='".$id."'" ;
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  {
			//  $sql="delete FROM generales WHERE generales_id=".$generales_id;
			   $res=mysql_query("delete FROM generales WHERE generales_id='".$generales_id."'");
			  $renglones=mysql_affected_rows();
			  if($res&&$renglones==1)
			  {
				//$sql=;*/
		//		$res=mysql_query("delete FROM domicilio WHERE domicilio_id='".$domicilio_id."'");
		 $sql= "delete from PROVEEDOR where proveedor_id='".$id."'" ;
		  $res=mysql_query($sql);
		
				$renglones=mysql_affected_rows();
				  if($res&&$renglones==1)
				  	{
				 		return "OK";
					}else 
		  			return mysql_error();		
			/* }else 
		  	return mysql_error();
		  }
		  else 
		  return mysql_error();*/
	  }
	  
	  function update(
	  	   $proveedor_clave,
	  	   $proveedor_id,
		   $razonsocial,
		   $rfc
		)
		{
			$sql = "update PROVEEDOR set proveedor_id='".$proveedor_id."', proveedor_rs='".$razonsocial."', proveedor_rfc='".$rfc."' where proveedor_id='".$proveedor_clave."'";
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
	  
	  function detalle($search)
	  {
		  $sql = "select * from PROVEEDOR where proveedor_id='".$search."'";
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

	  function busqueda_proveedor_id($search)
	  {
		  
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT 
		  PROVEEDOR.proveedor_id, 
		  PROVEEDOR.proveedor_rs,
		  PROVEEDOR.proveedor_rfc,  
GENERALES.nombre,
GENERALES.apel_p,
GENERALES.apel_m,
GENERALES.email,
GENERALES.tel_trabajo 
from PROVEEDOR, GENERALES WHERE PROVEEDOR.generales_id=GENERALES.generales_id";
		  if(!empty($search))
		  {
		   $sql=$sql." AND (PROVEEDOR.proveedor_rs like '%".$search."%')";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7]);
				  //echo "".$array[$cont_array][0];
				  $cont_array++;
			  }
			  return $array;
		  }
		  else
		  	  return null;
	  }
	  
	  	  function detalle_print($search)
	  {
		  $sql = "SELECT 
		  PROVEEDOR.proveedor_id, 
		  PROVEEDOR.proveedor_rs,
		  PROVEEDOR.proveedor_rfc, 
		  DOMICILIO.domicilio_calle,  /* 4  */
		  DOMICILIO.domicilio_num_ext, /* 5  */
		  DOMICILIO.domicilio_num_int, /* 6  */
		  DOMICILIO.domicilio_municipio, /* 7  */
		  DOMICILIO.domicilio_ciudad, /* 8  */
		  DOMICILIO.domicilio_estado, /* 9  */
		  DOMICILIO.domicilio_cp  from PROVEEDOR, DOMICILIO where DOMICILIO.domicilio_id=PROVEEDOR.domicilio_id AND proveedor_id='".$search."'";
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


 function detalle_contacto_compras($search)
	  {
		  $sql = "SELECT GENERALES.email 
		  from PROVEEDOR, GENERALES where PROVEEDOR.proveedor_id='".$search."' and GENERALES.generales_id = PROVEEDOR.generales_id";
		


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

	}





?>