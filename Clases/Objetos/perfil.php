<?
class Perfil{
	private $link;	
	function __construct(){
	}
	  
	function conexion($link_bd){
		$link=$link_bd;
	}
	
	function insert($nombre, $descripcion){
		$sql = "insert into PERFIL(
    				perfil_nombre,
		   			perfil_descripcion
		  		)
		   		values
		  			('".$nombre."',
		   			'".$descripcion."'
		  			)";
		$res=mysql_query($sql);
		if($res){
			$id=mysql_insert_id();
		}
		else{
			printf("Error:".mysql_error());
		}
		return $id;
	}

	function busqueda_parametros($search, $inicio, $fin){
		$search= str_replace(' ', '%', $search);
		$sql="select   perfil_id, perfil_nombre, perfil_descripcion from PERFIL";
		if(!empty($search)){
			$sql=$sql." where perfil_nombre like '%".$search."%' OR perfil_descripcion like '%".$search."%'";
		}
		$sql=$sql." LIMIT $inicio, $fin";
		$res=mysql_query($sql);
		$renglones=mysql_num_rows($res);
		$cont_array=0;
		$array=array(); // create new empty array
		  
		if($renglones>0){
			while($row=mysql_fetch_row($res)){
				$array[$cont_array]=array($row[0], $row[1], $row[2]);
				//echo "".$array[$cont_array][0];
				$cont_array++;
			}
			return $array;
		}
		else
			return null;
	}
	
		function busqueda_perfil(){

		$sql="select   perfil_id, perfil_nombre, perfil_descripcion from PERFIL";
		
		$res=mysql_query($sql);
		$renglones=mysql_num_rows($res);
		$cont_array=0;
		$array=array(); // create new empty array
		  
		if($renglones>0){
			while($row=mysql_fetch_row($res)){
				$array[$cont_array]=array($row[0], $row[1], $row[2]);
				//echo "".$array[$cont_array][0];
				$cont_array++;
			}
			return $array;
		}
		else
			return null;
	}

	function cuenta_resultado($search){
		$search= str_replace(' ', '%', $search);
		$sql="select perfil_id from PERFIL";
		if(!empty($search)){
			$sql=$sql." where (perfil_nombre like '%".$search."%' OR perfil_descripcion like '%".$search."%')";
		}
		$res=mysql_query($sql);
		$renglones=mysql_num_rows($res);
		return $renglones;
	}
	  
	function delete($id){
		$sql="delete from PERFIL where perfil_id=".$id."";
		$res=mysql_query($sql);
		$renglones=mysql_affected_rows();
		if($res&&$renglones==1)
			return "OK";
		else 
			return mysql_error();
	}
	  
	function update($perfil_id,$nombre,$descripcion){
		
		 $sql="delete from PERFIL_PANTALLA where perfil_id=".$perfil_id;
		  $res=mysql_query($sql);
		  $renglones=mysql_affected_rows();
		  
		 $sql = "update PERFIL set perfil_nombre='".$nombre."', perfil_descripcion='".$descripcion."' where perfil_id=".$perfil_id;
			$res=mysql_query($sql);
			$renglones=mysql_affected_rows();
			if($res/*&&$renglones==1*/)
				return "OK";
			else 
				return mysql_error();
		
	}
	  
	function detalle($search){
		$sql = "select * from PERFIL where perfil_id=".$search."";
		$res=mysql_query($sql);
		if($res&&mysql_num_rows($res)==1){
			$row=mysql_fetch_row($res);
			return $row;
		}
		else{
			return null;
		}
	}
}

?>