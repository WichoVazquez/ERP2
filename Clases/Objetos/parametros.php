<? class Parametros
{
  private $link;	
  function __construct()
  {
     
  }
  function conexion($link_bd)
  {
      $link=$link_bd;
  }
  function update_folio_compras(
    $id_parametro,
    $folio,
    $anio
    )
  	{   

      $folio = $folio + 1;

      $sql = "UPDATE PARAMETROS set 
      parametro_1=".$folio.",
      parametro_2=".$anio."
      WHERE  parametro_var = '".$id_parametro."'";
      $res=mysql_query($sql);
      if($res)
              
          $id=1;
      else{
          $id=0;
          printf("Error:".mysql_error());
      }
      return $id;
  }
      function detalle($tipo)
  {
    $sql="SELECT 
    parametro_id,
    parametro_var,
    parametro_1,
    parametro_2,
    descripcion,
    tipo
    from PARAMETROS 
    where tipo = '".$tipo."'
    order by descripcion asc";
   
      $res=mysql_query($sql);
      $renglones=mysql_num_rows($res);
      $cont_array=0;
      $array=array(); // create new empty array
      
      if($renglones>0)
      {
        
        while($row=mysql_fetch_row($res))
          {
          $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
        
          $cont_array++;
        }
        return $array;
      }
      else
          return null;
    }
  
  function folio_orden($folio)
  {
	  $sql="SELECT 
    parametro_id,
    parametro_var,
    parametro_1,
    parametro_2
    from PARAMETROS where parametro_var = '".$folio."'";
	  $res=mysql_query($sql);
	  if($res&&mysql_num_rows($res)>0)
	  {
		  $row=mysql_fetch_row($res);
		  return $row;
	  }
	  else
	  {
		  return null;
	  }
  }


}
?> 