<?
require_once("mailer.php");
require_once("../Conexion/conexion_prueba_local.php");
include('../Conexion/ftpfunc.php');
require_once("../Objetos/config.php");
require_once("../Objetos/usuario.php");
require_once("../Objetos/contacto_ventas.php");
require_once("../Objetos/generales.php");
require("../pdf/create_req_compra.php");


function enviar_pedido($cot, $usu, $pass, $contacto, $msg, $subject)
{


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
		
		return $mailer->enviarMail_requisicion($subject, $msg, $arr_usu[8], utf8_decode($arr_usu[1])." ".utf8_decode($arr_usu[2]), $adjuntos);
	
	return "OK";
	
}

?>