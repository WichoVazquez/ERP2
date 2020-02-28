<?
require("../Clases/Objetos/generales.php");
require("../Clases/Objetos/domicilio.php");
require("../Clases/Objetos/usuario.php");
require("../Clases/Conexion/conexion_prueba_local.php");
$link=conect();
$generales=new Generales();
$generales->conexion($link);
$result_gen=$generales->insert(
		   "Javier",
		   "Rios",
		   "",
		   "111111",
		   "333",
		   "",
		   "",
		   "javirios@javi.com");
if($result_gen!=0)
	printf("El valor insertado es:".$result_gen);
else
	printf("Error, no se pudo hacer la operacion");
	$domicilio=new Domicilio();
	$domicilio->conexion($link);
	$res_dom=$domicilio->insert(
		   "calle",
		   "num_ext",
		   "num_int",
		   "colonia",
		   "municipio",
		   "ciudad",
		   "estado",
		   "cp");
	if($res_dom!=0)
		printf("El valor insertado es en domicilio:".$res_dom);
	else
		printf("Error, no se pudo hacer la operacion");
	$usuario=new Usuario();
	$usuario->conexion($link);
	$res_usu=$usuario->insert(
		   "Admin",
		   "Admin123",
		   $result_gen,
		   $res_dom,
		   0);
	if($res_usu!=0)
		printf("El valor insertado es(usuario):".$res_usu);
	else
		printf("Error, no se pudo hacer la operacion");	   

?>