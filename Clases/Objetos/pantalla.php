<?php

 
class Pantalla
{
	  private $link;
	
	  
	  function __construct(){
		 
	  }
	  function conexion($link_bd) {
		  $link=$link_bd;
	  }
	  function insert($no_menu,$nombre,$descripcion,$padre,$url,$clave){   
          $sql = "insert into PANTALLA(no_menu_orden,pantalla_nombre,pantalla_descripcion, id_pantalla_padre,pantalla_url,nombre_imagen)values('".$no_menu."','".$nombre."','".$descripcion."','".$padre."','".$url."','".$clave."')";
		  $res=mysql_query($sql);
		  if($res)
		  		  
			  return "OK";
		  else{
			  return mysql_error();
		  }
		  
	
	  }
	  
	  
	  function busqueda_parametros($search, $inicio, $fin)
	  {
		  $search= str_replace(' ', '%', $search);
		  $sql="select   p.pantalla_id, p.no_menu_orden, p.pantalla_nombre, p.pantalla_descripcion, pp.pantalla_nombre, p.pantalla_url, p.nombre_imagen 
		   from PANTALLA as p inner join pantalla as pp on p.id_pantalla_padre = pp.pantalla_id ";
		  if(!empty($search))
		  {
		   $sql=$sql." where p.pantalla_nombre like '%".$search."%' OR p.pantalla_descripcion like '%".$search."%' OR p.id_pantalla_padre like '%".$search."%' OR p.pantalla_url like '%".$search."%'";
		  }
		  $sql=$sql." ORDER BY p.no_menu_orden ,p.id_pantalla_padre, p.pantalla_nombre ASC";
		  $sql=$sql." LIMIT $inicio, $fin";
		  $res=mysql_query($sql) or die (mysql_error());
		  $renglones=mysql_num_rows($res);
		  $cont_array=0;
		  $array=array(); // create new empty array
		  
		  if($renglones>0)
		  {
			  
			  while($row=mysql_fetch_row($res))
  			  {
				  $array[$cont_array]=array($row[0], $row[1], $row[2], $row[3], $row[4],$row[5],$row[6]);
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
		  $sql="select pantalla_id from PANTALLA";
		  if(!empty($search))
		  {
		   $sql=$sql." where (pantalla_nombre like '%".$search."%' OR pantalla_descripcion like '%".$search."%' OR pantalla_padre like '%".$search."%' OR pantalla_url like '%".$search."%')";
		  }
		  $res=mysql_query($sql);
		  $renglones=mysql_num_rows($res);
		  return $renglones;
	  }
	  
	  function delete($id)
	  {
		  $sql="delete from PANTALLA where pantalla_id=".$id."";
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  if($res&&$renglones==1)
		  	return "OK";
		  else 
		  	return mysql_error();
	  }
	  
	  function update(
	  	   $pantalla_id,
	  	   $no_menu,
	  	   $nombre,
		   $descripcion,
		   $padre,
		   $url,
		   $clave
		)
		{
			$sql = "update PANTALLA set pantalla_nombre='".$nombre."', pantalla_descripcion='".$descripcion."', pantalla_padre='".$padre."', pantalla_url='".$url."', clv_pantalla='".$clave."' where pantalla_id=".$pantalla_id;
		  	$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
		  	if($res/*&&$renglones==1*/)
				return "OK";
			  else 
				return mysql_error();
			
		}
	  
	  function detalle($search)
	  {
		  $sql = "select * from PANTALLA where pantalla_id=".$search."";
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
	   /*obtiene items de acuerdo al perfil y a la pantalla padre*/
	function obtiene_menu($id){
		$sql="SELECT P.pantalla_url, P.pantalla_nombre FROM `PANTALLA` as P inner join PERFIL_PANTALLA PP on P.pantalla_id= PP.pantalla_id where PP.perfil_id= ";
$sql=$sql.$id . "  and P.id_pantalla_padre =0 ORDER BY P.NO_MENU_ORDEN";
		$res=mysql_query($sql);
		$renglones=mysql_num_rows($res);
		$cont_array=0;
		$array=array(); // create new empty array
		
		if($renglones>0){
			while($row=mysql_fetch_row($res)){
			$array[$cont_array]=array($row[0], $row[1]);
			//echo "".$array[$cont_array][0];
			
			$cont_array++;
			}
			
			return $array;
		
		}
		else
			return null;
			
	}
	  /*obtiene items de acuerdo al perfil y a la pantalla padre*/
	function obtiene_pantalla($id, $pantalla_nombre){
		$sql="SELECT P.pantalla_url, P.pantalla_nombre, P.nombre_imagen
FROM `PANTALLA` as P
inner join PERFIL_PANTALLA PP on P.pantalla_id= PP.pantalla_id 
inner join PANTALLA as P1 on P.id_pantalla_padre= P1.pantalla_id
where PP.perfil_id=".$id ." AND P1.pantalla_nombre ='". $pantalla_nombre ."' ORDER BY P.no_menu_orden";
		$res=mysql_query($sql);
		$renglones=mysql_num_rows($res);
		$cont_array=0;
		$array=array(); // create new empty array
		
		if($renglones>0){
			while($row=mysql_fetch_row($res)){
			$array[$cont_array]=array($row[0], $row[1],$row[2]);
			//echo "".$array[$cont_array][0];
			
			$cont_array++;
			}
			
			return $array;
		
		}
		else
			return null;
			
	}
/*obtiene items de un perfil*/
	function busqueda_Perfil($id){
		$sql="SELECT P.pantalla_id,P.id_pantalla_padre,P.pantalla_nombre, ifNull(PP.pantalla_id,0)
FROM `PANTALLA` as P
left join PERFIL_PANTALLA PP on P.pantalla_id= PP.pantalla_id and PP.perfil_id=";
$sql=$sql.$id . " where  P.no_menu_orden > 0 ORDER BY id_pantalla_padre,no_menu_orden";
		$res=mysql_query($sql);
		$renglones=mysql_num_rows($res);
		$cont_array=0;
		$array=array(); // create new empty array
		
		if($renglones>0){
			while($row=mysql_fetch_row($res)){
			$array[$cont_array]=array($row[0], $row[1], $row[2], $row[3]);
			//echo "".$array[$cont_array][0];
			
			$cont_array++;
			}
			
			/*return $array;*/
		//	echo "antes del arbol";
			 crearArbol($array,$cont_array);
			//return $tableString;
			//echo $vResult;
			//;
		}
		else
			return null;
			
	}

	  /*OBTIENE TODOS LOS ITEMS PARA generar arbol de permisos*/
	function busqueda_All(){
		$sql="SELECT `pantalla_id`,`id_pantalla_padre`,`pantalla_nombre`,0
		FROM `PANTALLA` WHERE  PANTALLA.no_menu_orden > 0  ORDER BY id_pantalla_padre,no_menu_orden";
		$res=mysql_query($sql);
		$renglones=mysql_num_rows($res);
		$cont_array=0;
		$array=array(); // create new empty array
		
		if($renglones>0){
			while($row=mysql_fetch_row($res)){
			$array[$cont_array]=array($row[0], $row[1], $row[2], $row[3]);
			//echo "".$array[$cont_array][0];
			
			$cont_array++;
			}
			
			/*return $array;*/
		//	echo "antes del arbol";
			 crearArbol($array,$cont_array);
			//return $tableString;
			//echo $vResult;
			//;
		}
		else
			return null;
			
	}

}



//Pinta Tabla de arbol
function crearArbol($arr, $totReg){
	$res="";
	echo "<table id='Permisos' >";
	$res=createNode($arr, 0, $totReg,0);
	echo"</table>";
}

function createNode($arrNode , $nidPadre, $totReg, $cont ){
	
	
	
	for ( $i = 0; $i < $totReg; $i++) {
   		
		if ($nidPadre == $arrNode[$i][1])
		{
		echo "<tr>";
		for ($j=0; $j<$cont; $j++)
		{

		echo "<td width='20'></td>";
		}
		echo "<td colspan='".(5-$cont) ."'>";
			if($arrNode[$i][3]==0)
			{
				echo "<input type='checkbox' id='chk_".$arrNode[$i][2]."' name ='chk_".$arrNode[$i][2]."' value='".$arrNode[$i][0]."' />".$arrNode[$i][2];
			}
			else
			{
				echo "<input type='checkbox' id='chk_".$arrNode[$i][2]."' name ='chk_".$arrNode[$i][2]."' value='".$arrNode[$i][0]."' checked='true'/>".$arrNode[$i][2];
		
			}

	//	echo "<input type='checkbox' id='chk_".$arrNode[$i][2]."' name ='chk_".$arrNode[$i][2]."' value='".$arrNode[$i][0]."' checked='true'/>".$arrNode[$i][2];
		echo "<td></tr>";
		
		 createNode($arrNode, $arrNode[$i][0], $totReg, $cont+1);
			
			
		}
	}

	return true;
}


?>