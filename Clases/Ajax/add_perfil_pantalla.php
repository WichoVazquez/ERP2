<? 
  $value = file_get_contents('php://input');
  $arr=json_decode($value);
  //echo $arr -> {'almacen'};
	require("../Objetos/perfil_pantalla.php");
	require_once("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$perfil=new Perfil_Pantalla();
	$perfil->conexion($link);
/*	$res=$perfil->busqueda_perfil_pantalla(
		$arr -> {'perfil_id'}, 
		$arr -> {'pantalla_id'}
	);
	echo '<br>resultado: '.$res;
	if ($res == null) {*/
		/*echo 'insert:';
		$res=$perfil->insert(
		$arr -> {'perfil_id'}, 
		$arr -> {'pantalla_id'}
		);*/
			echo 'insert:';
		$res=$perfil->insertVarios(
		$arr -> {'perfil_id'}, 
		$arr -> {'pantalla_id'}
		);
/*	}
	else{
		$res='Perfil ya existe';
	}*/
	echo $res;
?>