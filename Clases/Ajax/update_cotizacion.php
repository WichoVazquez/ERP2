
<?
$value = file_get_contents('php://input');
$arr=json_decode($value);

//echo "Debugear";
require("../Conexion/conexion_prueba_local.php");
require("../Objetos/cotizacion.php");
require("../mail/notificacion.php");
//echo "Debugeadas las implementaciones";

$link=conect();
$cotizacion=new Cotizacion();
$cotizacion->conexion($link);
$folio=$arr -> {'folio'};
$contacto=$arr -> {'contacto'};
if($contacto=="")
$contacto="null";
//echo "antes de entrar";
if($folio=="0")
{
	$folio=$cotizacion->last_folio($arr -> {'usuario'}, $arr -> {'empresa'});
	//echo "folio aqui: $folio";
	
	$folio++;
	//echo "folio despues: $folio";
}
//echo "el folio es:$folio";
$cot=$cotizacion->update($arr -> {'cotizacion'}, $arr -> {'estado'}, $arr -> {'cliente'}, $arr -> {'usuario'}, $arr -> {'empresa'}, $folio, $arr -> {'moneda'},$arr -> {'cambio_dia'},$arr -> {'observaciones'}, $contacto, $arr -> {'mensaje'},  $arr -> {'dias_entrega'},  $arr -> {'condiciones'}, $arr -> {'tipocot'}, $arr -> {'vigencia'}, $arr -> {'fecha_ini'}, $arr -> {'precio_cotizacion'}, $arr -> {'lab'}, $arr -> {'capacidad_entrega'}, 	$arr -> {'muestra_existencia'}, $arr -> {'muestra_flete'}
	);
//echo "entro a update "+$cot;

if($cot=="OK")
{
 if ($arr -> {'estado'}==2)
 {
  enviarCotizacion($arr -> {'cotizacion'}, $arr->{'usuario'}, $arr->{'password'}, $contacto, $arr->{'body_mail'});
 
 }
 else
  echo $folio;
}
else
 echo $cot; 
?>
   