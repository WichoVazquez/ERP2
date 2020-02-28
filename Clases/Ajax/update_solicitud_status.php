
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/taller_solicitud.php");


$link=conect();
$taller_sol=new Taller_solicitud();
$taller_sol->conexion($link);



	$cot=$taller_sol->update_status( 
	$arr -> {'taller_solicitud_id'},
	$arr -> {'status'}
	);

	echo "OK";

?>
   