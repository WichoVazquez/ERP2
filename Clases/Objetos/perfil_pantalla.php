<?
      class Perfil_Pantalla
	{
	  private $link;	
	  function __construct()
	  {
		 
	  }
	  function conexion($link_bd)
	  {
		  $link=$link_bd;
	  }

	  function insert($perfil_id,$pantalla_id){   
          $sql = "insert into PERFIL_PANTALLA(
			perfil_id,
			pantalla_id
		  )
		   values
		  (".$perfil_id.",
		   ".$pantalla_id."
		  )";
		  $res=mysql_query($sql);
		  if($res) 
			  return "OK";
		  else{
			  return mysql_error();
		  }
	  }

	  function insertVarios($perfil_id,$pantalla_id){ 
	  	$result ='true'  ;
	  	$ids = explode("|", $pantalla_id);

	  	foreach ($ids as &$valor) {

  			$sql = "insert into PERFIL_PANTALLA(
			perfil_id,
			pantalla_id
		  )
		   values
		  (".$perfil_id.",
		   ".$valor.")";  			
			
			
			$res=mysql_query($sql);
  		 if($res) 
			  $result = "OK";
		   else{
			  return mysql_error();
		   }
         } 
		  
		  
	  }
	  
	  
	  function busqueda_parametros($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select   perfil_id, perfil_nombre, perfil_descripcion from PERFIL";
		  if(!empty($search))
		  {
		   $sql=$sql." where perfil_nombre like '%".$search."%' OR perfil_descripcion like '%".$search."%'";
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
				  $array[$cont_array]=array($row[0], $row[1], $row[2]);
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
		  $sql="select perfil_id from PERFIL";
		  if(!empty($search))
		  {
		   $sql=$sql." where (perfil_nombre like '%".$search."%' OR perfil_descripcion like '%".$search."%')";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
		  $sql="delete from PERFIL_PANTALLA where perfil_pantalla_id=".$id."";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }

	  // todos los perfil_pantalla de un perfil_id
	  function deleteTodoPerfil($id)
	  {	
		  $sql="delete from PERFIL_PANTALLA where perfil_id=".$id."";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	
	  
	  function detalle($search)
	  {
		  $sql = "select * from PERFIL where perfil_id=".$search."";
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

	 

	   function busqueda_perfil_pantalla($id_pantalla, $id_perfil){
		  $sql="select top 1 perfil_pantalla_id from PERFIL_PANTALLA";
		  if( !empty($id_pantalla) && !empty($id_perfil) ){
		  	$sql=$sql." where perfil_id = ".$id_perfil." AND pantalla_id = ".$id_pantalla."";
		  }
		  $res=mysql_query($sql);
		  if ($res > 0)
		  	return $res;
		  else
		  	return null;
	  }

	  	//Todas las pantallas pertenecientes a un perfil dado
	function busqueda_pantallasPerfil($id_perfil){
		$sql="SELECT IFNULL( pan1.pantalla_nombre,  '' ) , pan.pantalla_nombre FROM PERFIL_PANTALLA per
INNER JOIN PANTALLA pan ON per.pantalla_id = pan.pantalla_id
LEFT JOIN PANTALLA pan1 ON pan.id_pantalla_padre = pan1.pantalla_id";
	  	$sql=$sql."  where per.perfil_id=";
	  	$sql=$sql.$id_perfil."  order by pan.id_pantalla_padre , pan.no_menu_orden";


		$res=mysql_query($sql);
		$renglones=mysql_num_rows($res);
		$cont_array=0;
		$array=array(); // create new empty array
		  
		if($renglones>0){
			while($row=mysql_fetch_row($res)){
				$array[$cont_array]=array($row[0], $row[1]);
				$cont_array++;
			}
			crearArbol($array,$cont_array);
			//return $array;
		}
		else
			return null;
	}

}
function crearArbol($arr, $totReg){
	$res="";
	echo "<table id='Permisos' >";
	echo  $arr[0][0];
	$res=createNode($arr, $arr[0][0], $totReg,0);
	echo"</table>";


}

function createNode($arrNode , $nidPadre, $totReg, $cont ){
	
	
	
	for ( $i = 0; $i < $totReg; $i++) {
   		
		if ($nidPadre == $arrNode[$i][0])
		{
		echo "<tr>";
		for ($j=0; $j<$cont; $j++)
		{

		echo "<td width='20'></td>";
		}
		echo "<td colspan='".(5-$cont) ."'>";
		echo $arrNode[$i][1];
		echo "<td></tr>";
		
		 createNode($arrNode, $arrNode[$i][1], $totReg, $cont+1);
			
			
		}
	}

	return true;
}

?>