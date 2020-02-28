<?
      class Empresa
	{
	  private $link;	
	  function __construct()
	  {
		 
	  }
	  function conexion($link_bd)
	  {
		  $link=$link_bd;
	  }
	  function insert($RazonSocial,$rfc, $DomicilioFiscal)
	  {   
	  	  $id=0;
          $sql = "
		  insert into EMPRESA
		  (empresa_razonsocial,
		   empresa_rfc,
		   empresa_domicilio_fiscal
		  )
		   values
		  ('".$RazonSocial."',
		  '".$rfc."',
		  ".$DomicilioFiscal."
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
	  
	  function busqueda_parametros($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select empresa_id, empresa_razonsocial, empresa_rfc, empresa_domicilio_fiscal from EMPRESA";
		  if(!empty($search))
		  {
		   $sql=$sql." where (empresa_razonsocial like '%".$search."%' OR empresa_rfc like '%".$search."%') ";
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
		  $sql="select empresa_id, empresa_razonsocial, empresa_rfc, empresa_domicilio_fiscal from EMPRESA";
		  if(!empty($search))
		  {
		 $sql=$sql." where (empresa_domicilio_fiscal like '%".$search."%' OR empresa_razonsocial like '%".$search."%' OR empresa_rfc like '%".$search."%' ";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
		  $sql="delete from EMPRESA where empresa_id=".$id."";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	  function update( $empresa_clave, $RazonSocial,$rfc	)
		{
		$sql = "UPDATE EMPRESA set  empresa_razonsocial='".$RazonSocial."', empresa_rfc ='". $rfc ."' where empresa_id=".$empresa_clave;

echo "$sql";

		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
	  
	  function detalle($search)
	  {
		  $sql = "select * from EMPRESA where empresa_id='".$search."'";
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
	   function razonSocial_duplicado($rasonSocial)
	  {
		  $sql="select empresa_id from EMPRESA where empresa_razonsocial='".$rasonSocial."'";
		  $res=mysql_query($sql);
		  if(mysql_num_rows ($res)>0){
			
		  	return true;
		  }
		  else
		  {
		  	return false;
		  }
	  }
	  

	  
	  function rfc_duplicado($rfc)
	  {

		  $sql="select empresa_id from EMPRESA where empresa_rfc='".$rfc."'";
		  $res=mysql_query($sql);
		  if(mysql_num_rows ($res)>0){
			
		  	return true;
		  }
		  else
		  {
		  	return false;
		  }
	  }

	   function busqueda_empresa_id($search)
	  {
		  
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT empresa_id, empresa_razonsocial, empresa_rfc from EMPRESA ";
		  if(!empty($search))
		  {
		   	$sql=$sql." where (empresa_razonsocial like '%".$search."%' OR empresa_rfc like '%".$search."%')";



		  }
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