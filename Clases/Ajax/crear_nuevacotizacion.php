
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

require("../Conexion/conexion_prueba_local.php");
require("../Objetos/cotizacion.php");
include('../Conexion/ftpfunc.php');

$link=conect();
$cotizacion=new Cotizacion();
$cotizacion->conexion($link); 

$cot=$cotizacion->insert($arr -> {'cliente'},$arr -> {'contacto'}, $arr -> {'usuario'}, $arr -> {'empresa'}, $arr -> {'tipocot'}, $arr -> {'fecha_ini'}, $arr -> {'puesto'});
CreaDirectorios($arr -> {'usuario'}, $cot);
echo $cot;
?>
   