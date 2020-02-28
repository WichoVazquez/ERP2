<?
      class Usuario_cliente
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
		   $cliente_id
		   )
	  {   
	  	  $id=0;
          $sql = "
		  insert into USUARIO_CLIENTE
		  (usuario_id,
		   cliente_id
		  )
		   values
		  ('".$usuario_id."',
		   '".$cliente_id."'
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

 function busqueda_parametros()
	  {
		 
		  $sql="SELECT USUARIO_CLIENTE.usuario_id, GENERALES.nombre, GENERALES.apel_p from USUARIO, GENERALES, USUARIO_CLIENTE
		     WHERE
					USUARIO_CLIENTE.usuario_id = USUARIO.usuario_id AND
					GENERALES.generales_id = USUARIO.generales_id
			GROUP BY USUARIO_CLIENTE.usuario_id
			ORDER BY USUARIO_CLIENTE.usuario_id ASC

					";
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

 function detalle_cliente($usuario)
	  {
		 
		 $sql="SELECT USUARIO_CLIENTE.usuario_id, CLIENTE.cliente_razonsocial FROM USUARIO_CLIENTE, CLIENTE where USUARIO_CLIENTE.cliente_id = CLIENTE.cliente_id and usuario_id='".$usuario."'";

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
	}

?>