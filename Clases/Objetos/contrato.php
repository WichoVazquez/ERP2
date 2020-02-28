<?
      class Contrato
	{
	  private $link;	
	  function __construct()
	  {
		 
	  }
	  function conexion($link_bd)
	  {
		  $link=$link_bd;
	  }
	  function insert($clave_id, $cliente_id, $Descripcion, $fecha_ini, $fecha_fin, $contrato_monto )
	  {   
	  	  $id=0;
          $sql = "
		  insert into CONTRATO
		  (contrato_id,
		   cliente_id,
		   contrato_descripcion,
		   fecha_inicio,
		   fecha_terminacion,
		   contrato_mt
		  )
		   values
		  ('".$clave_id."',
		  	".$cliente_id.",
		  	'".$Descripcion."',
		  '".$fecha_ini."',
		  '".$fecha_fin."',
		  ".$contrato_monto."
		  )";

		  $res=mysql_query($sql);
		  if($res)
		  		  
			  $id="OK";
		  else{
			  $id=0;
			  printf("Error:".mysql_error());
		  }
		  return $id;
		 //return $sql;
	
	  }
	
	  function busqueda_parametros($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT CONTRATO.contrato_id, CLIENTE.cliente_razonsocial , CONTRATO.fecha_inicio, CONTRATO.fecha_terminacion,contrato_mt from CONTRATO, CLIENTE WHERE CONTRATO.cliente_id = CLIENTE.cliente_id";
		  if(!empty($search))
		  {
		   $sql=$sql." and  (CONTRATO.contrato_id like '%".$search."%' OR CLIENTE.contrato_descripcion like '%".$search."%'";
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
		  $sql="SELECT CONTRATO.contrato_id, CLIENTE.cliente_razonsocial , CONTRATO.fecha_inicio, CONTRATO.fecha_terminacion,contrato_mt from CONTRATO, CLIENTE WHERE CONTRATO.cliente_id = CLIENTE.cliente_id";
		  if(!empty($search))
		  {
		   $sql=$sql." and  (CONTRATO.contrato_id like '%".$search."%' OR CLIENTE.contrato_descripcion like '%".$search."%'";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
		  $sql="delete from CONTRATO where contrato_id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	  function update( $contrato_clave, $cliente_id, $descripcion,$fecha_ini, $fecha_fin, $contrato_monto	)
		{
		$sql = "UPDATE CONTRATO set  contrato_descripcion='".$descripcion."', fecha_inicio='".$fecha_ini."', fecha_terminacion ='". $fecha_fin ."', contrato_mt =".$contrato_monto." where contrato_id='".$contrato_clave."' and cliente_id=".$cliente_id;
		echo "UPDATE: ".$sql;
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
	  
	  function detalle($search)
	  {
		  $sql = "select * from CONTRATO where contrato_id='".$search."'";
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

	  	  function contrato_Duplicado($contrato)
	  {
	  	 $sql="select CONTRATO.contrato_id from CONTRATO where CONTRATO.contrato_id='".$contrato."'";

		  $res=mysql_query($sql);
		  if(mysql_num_rows ($res)>0){
			
		  	return true;
		  }
		  else
		  {
		  	return false;
		  }
	  }
	

	  function busqueda_contrato_id($cliente)
	  {
		  
		  
		  $sql="SELECT CONTRATO.contrato_id,  CONTRATO.contrato_descripcion, FORMAT(CONTRATO.contrato_mt,2) as montos
FROM CONTRATO, CLIENTE
WHERE CLIENTE.cliente_id = CONTRATO.cliente_id 
AND (CLIENTE.cliente_id LIKE '$cliente' and CONTRATO.cliente_id LIKE '$cliente') ";

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

}

?>