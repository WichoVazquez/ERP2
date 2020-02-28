<?// Inicia Página
require_once("index_header.php");
  $user=sesiones_start();
  librerias();
	require_once("../Clases/Conexion/conexion_prueba_local.php");	
	$link=conect();

 $almacenID=$_POST['almacen'];
 $cantidad=$_POST['dig_cantidad'];
 $producto=$_POST['producto'];
 $datepicker=$_POST['datepicker'];
 $folio=$_POST['folio'];

 $observaciones='';

$qry2=mysql_query("INSERT INTO taller_solicitud (taller_solicitud_id, taller_id, fecha_creacion, usuario_id_solicitante, almacen_id,
 usuario_id_autorizador, fecha_autorizacion, motivo, pedido_id, status, folio, tipo) VALUES 
(NULL, '1', CURDATE( ), '', '$almacenID', '', NULL, '$observaciones', NULL, '0', '$folio', '0')");

$qry=mysql_query("SELECT taller_solicitud.taller_solicitud_id from taller_solicitud where folio LIKE '$folio'");
$fetch=mysql_fetch_array($qry);
$taller_solicitud_id=$fetch['taller_solicitud_id'];

$qryfetch1=mysql_query("SELECT material.material_id from material where material_descripcion like '$producto'");
$fetch1=mysql_fetch_array($qryfetch1);
$productoID=$fetch1['material_id'];


$qry3=mysql_query("INSERT INTO detalle_taller_solicitud (detalle_taller_solicitud_id, producto_id, cantidad_solicitada)
 VALUES ('$taller_solicitud_id', '$productoID', '$cantidad')");


if ($qry2==1&&$qry3==1) {
	echo "REGISTRO EXISTOSO";
}
else
echo "NO EXISTOSO";

?>