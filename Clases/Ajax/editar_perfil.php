<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/perfil.php");
require("../Objetos/perfil_pantalla.php");

$array=array(); 

$link=conect();
$perfil=new Perfil();
$perfil_pantalla=new perfil_pantalla();
$perfil_pantalla->conexion($link);
$perfil->conexion($link);

	
	if($arr -> {'accion'}=="actualizarPerfil")
	{
		$id=$perfil->update( $arr -> {'perfil_id'},$arr -> {'perfil_nombre'},$arr -> {'perfil_descripcion'});
	
		echo $id;
	}else if ($arr->{'accion'}=="eliminarPermisos")
	{
		$id=$perfil_pantalla->deleteTodoPerfil( $arr -> {'perfil_id'});
	
		echo $id;
	}


?>