<?
require("../Conexion/conexion_prueba_local.php");
require("../Objetos/cotizacion.php");
require("../Objetos/config.php");
require("../mail/mailer.php");
$link=conect();
$cotizacion=new Cotizacion();
$cotizacion->conexion($link);
$id=$_POST["id"];
$cotizacion=$cotizacion->detalle($id);
$config=new Configuracion();
$config->conexion($link);
$config->detalle();
$mailer=new Mailer();
$mailer->ponerValores($config[0],$config[1],true,$config[2],$config[3],$config[4]);
/*if(empty($_POST['oper']))// si es una notificacion de autorizacion de cotizacion
{*/
	if($array[1]==4)
	{
		$body="Estimado ".$cotizacion[15].": 
		\n
		\nLa cotizacion No.".$cotizacion[0]." NO fue autorizada debido al siguientes motivos:
		\n".$cotizacion[10]."
		\n ---------------- 
		\n Este mensaje se envió desde una dirección de correo electrónico que solo envía notificaciones y no acepta mensajes de correo electrónico entrantes. No responda a este mensaje.";
		$mailer->enviarMail("Cotizacion NO autorizada", $body, $cotizacion[18], $cotizacion[19], null);
	}
	if($array[1]==5)
	{
		$body="Estimado ".$cotizacion[15].": 
		\n
		\nLa cotizacion no.".$cotizacion[0]." fue autorizada, favor de enviarla lo antes posible al cliente.
		\n ---------------- 
		\n Este mensaje se envió desde una dirección de correo electrónico que solo envía notificaciones y no acepta mensajes de correo electrónico entrantes. No responda a este mensaje.";
		$mailer->enviarMail("Cotizacion autorizada", $body, $cotizacion[18], $cotizacion[19], null);
	}
/*}
else //sino
{
	switch($_POST['oper'])//con oper se que notificacion enviar
	{
		case 1: 
		
		enviarCotizacion($id, $cotizacion[18], $_POST["pass"], $cotizacion[11], $_POST['body']);break;//enviar cotizacion
		default:
	}
}*/
?>