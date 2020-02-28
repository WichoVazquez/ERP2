<?
require_once("mailer.php");
require_once("../Conexion/conexion_prueba_local.php");
include('../Conexion/ftpfunc.php');
require_once("../Objetos/config.php");
require_once("../Objetos/usuario.php");
require_once("../Objetos/contacto_ventas.php");
require_once("../Objetos/generales.php");
require("../pdf/create_orden_compra.php");


function enviarNotificacionAutorizacion( $id, $estado, $obs, $usu)
{
	$link=conect();
	$usuario=new Usuario();
	$usuario->conexion($link);
	$arr_usu=$usuario->print_generales($usu);
	//echo "id: $usu";
	//echo "tamaño:".sizeof($arr_usu);
	$config=new Configuracion();
	$config->conexion($link);
	$arr_conf=$config->detalle();
	
	$mailer=new Mailer();
	
	$mailer->ponerValores($arr_conf[0],$arr_conf[1], true, $arr_conf[2], $arr_conf[3], "Notificaciones");
	if($estado==4)
	{
		//echo "Entro a No Autorizado";
		$body="Estimado ".$arr_usu[0].": 
		\n
		\nLa cotizacion no.".$id." NO fue autorizada debido al siguientes motivos:
		\n".$obs."
		\n ---------------- 
		\n Este mensaje se envió desde una dirección de correo electrónico que solo envía notificaciones y no acepta mensajes de correo electrónico entrantes. No responda a este mensaje.";
		return $mailer->enviarMail("Cotizacion NO autorizada", $body, $arr_usu[3], $arr_usu[0], null);
	}
	if($estado==5)
	{
		echo "Entro a Autorizado";
		$body="Estimado ".$arr_usu[0].": 
		\n
		\nLa cotizacion no.".$id." fue autorizada, favor de enviarla lo antes posible al cliente.
		\n ---------------- 
		\n Este mensaje se envió desde una dirección de correo electrónico que solo envía notificaciones y no acepta mensajes de correo electrónico entrantes. No responda a este mensaje.";
		return $mailer->enviarMail("Cotizacion autorizada", $body, $arr_usu[3], $arr_usu[0], null);
	}
	
}



function enviarOrdenCompra($cot, $usu, $pass, $contacto, $msg)
{

	//	echo "<br> cot: ".$cot."<br>  usu: ".$usu. "<br>  pass: ".$pass." <br> contacto: ".$contacto."<br>  mensaje: ".$msg;
	//conexion de BD
	$link=conect();
	//objetos
	$usuario=new Usuario();
	$usuario->conexion($link);
	$gral=new Generales();
	$gral->conexion($link);
	$config=new Configuracion();
	$config->conexion($link);
	$contact=new Contacto_Ventas();
	$contact->conexion($link);
	//arreglos
	$idusuario=$usuario->detalle($usu);
	$idcontacto=$contact->detalle($contacto);
	$arr_usu=$gral->detalle($idusuario[2]);
	$arr_contact=$gral->detalle($idcontacto[2]);
	$arr_conf=$config->detalle();
	$mailer=new Mailer();
	$mailer->ponerValores('smtp.gmail.com','587', true, "notificaciones@mogel.com.mx", "Mogel2018!", $arr_usu[1]." ".$arr_usu[2]);
		$pdf=new PDF();
	    $folio=$pdf->printandsave($cot);
		$nombrepdf="orden_compra".$folio.".pdf";
		$adjuntos=array();
		array_push($adjuntos, "../pdf/tmp/".$nombrepdf);

		
	
		return $mailer->enviarMail("Notificacion de Orden de Compra", $msg, $arr_contact[8], $arr_contact[1]." ".$arr_contact[2], $adjuntos);
	
	
	return "OK";
	
}


?>