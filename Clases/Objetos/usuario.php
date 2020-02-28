<?
      class Usuario
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
	   	   $usuario_id,
		   $password,
		   $generales_id,
		   $domicilio_id,
		   $perfil)
	  {   
	  	  $id=0;
          $sql = "
		  insert into USUARIO
		  (usuario_id,
		   usuario_password,
		   generales_id,
		   domicilio_id,
		   perfil_id
		  )
		   values
		  ('".$usuario_id."',
		   '".$password."',
		   ".$generales_id.",
		   ".$domicilio_id.",
		   ".$perfil."
		  )";
		  $res=mysql_query($sql);
		  if($res)
		  		  
			  $id=1;
		  else{
			  $id=0;
			  printf("Error:".mysql_error());
		  }
		  return $id;
	
	  }
	  function usuario_duplicado($usuario)
	  {
		  $sql="select usuario_id from USUARIO where usuario_id='".$usuario."'";
		  $res=mysql_query($sql);
		  if(mysql_num_rows ($res)>0){
			
		  	return true;
		  }
		  else
		  {
		  	return false;
		  }
	  }


function detalle_cliente($id)
	  {
		  
		  $sql="SELECT USUARIO_CLIENTE.usuario_id, CLIENTE.cliente_razonsocial FROM USUARIO_CLIENTE, CLIENTE where USUARIO_CLIENTE.cliente_id = CLIENTE.cliente_id";
		 
		  
	
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




	  function busqueda_parametros($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select USUARIO.usuario_id, USUARIO.generales_id, USUARIO.domicilio_id,  USUARIO.usuario_status, USUARIO.perfil_id , PERFIL.perfil_nombre, GENERALES.nombre, GENERALES.apel_p from USUARIO";
		  if(!empty($search))
		  {
		   $sql=$sql.", GENERALES, PERFIL, DOMICILIO where (USUARIO.usuario_id like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%' OR GENERALES.apel_m like '%".$search."%'  OR GENERALES.tel_trabajo like '%".$search."%'  OR GENERALES.tel_casa like '%".$search."%' OR GENERALES.tel_cel like '%".$search."%' OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%' OR DOMICILIO.domicilio_municipio like '%".$search."%' OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' OR DOMICILIO.domicilio_cp like '%".$search."%') AND USUARIO.generales_id=GENERALES.generales_id AND USUARIO.domicilio_id=DOMICILIO.domicilio_id and PERFIL.perfil_id = USUARIO.perfil_id";
		  }
		  else
		  	$sql = $sql.", GENERALES, PERFIL 
					WHERE PERFIL.perfil_id = USUARIO.perfil_id
					AND GENERALES.generales_id = USUARIO.generales_id";
		  $sql=$sql." LIMIT $inicio, $fin";
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
	  function cuenta_resultado($search)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select USUARIO.usuario_id from USUARIO";
		  if(!empty($search))
		  {
		   $sql=$sql.", GENERALES, DOMICILIO where (USUARIO.usuario_id like '%".$search."%' OR GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%' OR GENERALES.apel_m like '%".$search."%'  OR GENERALES.tel_trabajo like '%".$search."%'  OR GENERALES.tel_casa like '%".$search."%' OR GENERALES.tel_cel like '%".$search."%' OR GENERALES.email like '%".$search."%' OR DOMICILIO.domicilio_calle like '%".$search."%' OR  DOMICILIO.domicilio_colonia like '%".$search."%' OR DOMICILIO.domicilio_municipio like '%".$search."%' OR DOMICILIO.domicilio_ciudad like '%".$search."%' OR DOMICILIO.domicilio_estado like '%".$search."%' OR DOMICILIO.domicilio_cp like '%".$search."%') AND USUARIO.generales_id=GENERALES.generales_id AND USUARIO.domicilio_id=DOMICILIO.domicilio_id";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
		  $sql="delete from USUARIO where usuario_id='".$id."'";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	  function update(
	  	   $id,
	  	   $usuario_id,
		   $password,
		   $rol
		   //, $perfil
		)
		{
			$sql = "update USUARIO set usuario_id='".$usuario_id."', usuario_password='".$password."', perfil_id=".$rol." where usuario_id='".$id."'";
			//echo "sql usuario ".$sql;
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
	  
	  function detalle($search)
	  {
		  $sql = "select * from USUARIO where usuario_id='".$search."'";
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

	  function ingresar($user, $password)
	  {
		  $sql = "SELECT 
		  	USUARIO.usuario_id AS usuario, 
		  	USUARIO.usuario_password AS PASSWORD , 
			USUARIO.perfil_id AS perfil_id, 
			PERFIL.perfil_nombre AS perfil_nombre
			FROM USUARIO, PERFIL WHERE 
		  usuario_id='".$user."' and 
		  usuario_password='".$password."' and 
		  usuario_status=0 and
		  PERFIL.perfil_id = USUARIO.perfil_id
		  ";
	
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
	  
	  function print_generales($search)
	  {
		  $sql = "SELECT 
		  GENERALES.nombre,
		  GENERALES.apel_p,
		  GENERALES.apel_m,
		  GENERALES.email 
		  FROM USUARIO,GENERALES where USUARIO.usuario_id='".$search."' AND GENERALES.generales_id=USUARIO.generales_id";
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


	  function busqueda_usuario_id_todos($search)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT 
		  USUARIO.usuario_id, 
		  USUARIO.generales_id, 
		  USUARIO.domicilio_id,  
		  USUARIO.usuario_status, 
		  USUARIO.perfil_id, 
		  GENERALES.nombre, 
		  GENERALES.apel_p, 
		  GENERALES.apel_m   /* 7 */
		  FROM USUARIO, GENERALES where";
		  if(!empty($search))
		  {
		   $sql=$sql."  (GENERALES.nombre like '%".$search."%' OR GENERALES.apel_p like '%".$search."%' OR GENERALES.apel_m like '%".$search."%') AND 
		   ";
		  }
		  $sql=$sql." USUARIO.generales_id=GENERALES.generales_id ";
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

	  function busqueda_usuario_perfil($search)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="SELECT 
		  USUARIO.usuario_id, 
		  USUARIO.generales_id, 
		  USUARIO.domicilio_id,  
		  USUARIO.usuario_status, 
		  USUARIO.perfil_id, 
		  GENERALES.nombre, 
		  GENERALES.apel_p, 
		  GENERALES.apel_m   /* 7 */
		  FROM USUARIO, GENERALES, PERFIL where USUARIO.generales_id=GENERALES.generales_id and USUARIO.perfil_id = PERFIL.perfil_id and PERFIL.perfil_nombre = 'Transportista' ";
		  
		  $sql=$sql."  ";
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
	  
	}

?>