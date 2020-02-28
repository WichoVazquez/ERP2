<?php
require_once('class.phpmailer.php');
class Mailer
{

		protected $host;
		protected $puerto;
		protected $autenticacion;
		protected $usuario;
		protected $password;
		protected $nombreusuario;
		
		public function __construct()
		{
			$this->host="smtp.gmail.com";
			$this->puerto=587;
			$this->autenticacion=true;
			$this->usuario="notificaciones@mogel.com.mx";
			$this->password="Mogel2018";
			$this->nombreusuario="NOTIFICACION DE SISTEMA";
		}
		
		 function ponerValores($host_t, $puerto_t, $autenticacion_t, $usuario_t, $password_t, $nombreusuario_t)
		{

			$this->host=$host_t;
			$this->puerto=intval($puerto_t);
			$this->autenticacion=$autenticacion_t;
			$this->usuario=$usuario_t;
			$this->password=$password_t;
			$this->nombreusuario=$nombreusuario_t;
			
			
		}

		function enviarMail($asunto, $body, $address, $nombreadress, $attached)
		{	
			$mail= new PHPMailer();
			$mail->SMTPDebug  = 1;
			$mail->IsSMTP(); // telling the class to use SMTP

			try {
					
					$mail->Host       = $this->host; // SMTP server
												// enables SMTP debug information (for testing)
												// 1 = errors and messages
												// 2 = messages only
					$mail->SMTPAuth   = $this->autenticacion;                  // enable SMTP authentication
					$mail->Host       = $this->host;      // sets GMAIL as the SMTP server
					$mail->Port		 			 = $this->puerto;                  // set the SMTP port for the GMAIL server
					$mail->Username   = $this->usuario;  // GMAIL username
					$mail->Password   = $this->password;            // GMAIL password


		
					$mail->SetFrom($this->usuario, $this->nombreusuario);
					
					$mail->AddReplyTo($this->usuario,$this->nombreusuario);
					
					$mail->Subject    = $asunto;
					//$body= eregi_replace("[\]",'',$body);
					//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
					$mail->MsgHTML($body);
					$mail->AddAddress($address, $nombreadress);
					if ($attached!=NULL && sizeof($attached)>0)
					{
						foreach($attached as $adjunto)
						{
							$mail->AddAttachment($adjunto); 
						}
							//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
					}
					if(!$mail->Send())
					{
						echo $mail->ErrorInfo;
					}
					else
					{
						echo "OK";
					}
			} catch (phpmailerException $e) {
				echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
				echo $e->getMessage(); //Boring error messages from anything else!
			}
		
		}


		function enviarMail_requisicion($asunto, $body, $address, $nombreadress, $attached)
		{	
			$mail= new PHPMailer();
			$mail->SMTPDebug  = 1;
			$mail->IsSMTP(); // telling the class to use SMTP

			try {
					
					$mail->Host       = $this->host; // SMTP server
												// enables SMTP debug information (for testing)
												// 1 = errors and messages
												// 2 = messages only
					$mail->SMTPAuth   = $this->autenticacion;                  // enable SMTP authentication
					$mail->Host       = $this->host;      // sets GMAIL as the SMTP server
					$mail->Port		 			 = $this->puerto;                  // set the SMTP port for the GMAIL server
					$mail->Username   = $this->usuario;  // GMAIL username
					$mail->Password   = $this->password;            // GMAIL password


		
					$mail->SetFrom($this->usuario, $this->nombreusuario);
					
					$mail->AddReplyTo($this->usuario,$this->nombreusuario);
					
					$mail->Subject    = $asunto;
					//$body= eregi_replace("[\]",'',$body);
					//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
					$mail->MsgHTML($body);
					$mail->AddAddress($address, $nombreadress);
					if ($attached!=NULL && sizeof($attached)>0)
					{
						foreach($attached as $adjunto)
						{
							$mail->AddAttachment($adjunto); 
						}
							//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
					}
					if(!$mail->Send())
					{
						echo $mail->ErrorInfo;
					}
					else
					{
						echo "OK";
					}
			} catch (phpmailerException $e) {
				echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
				echo $e->getMessage(); //Boring error messages from anything else!
			}
		
		}

	//		enviarMail("ola", "holi","juanantonio.butron@soetecnologia.com","juanantonio.butron@soetecnologia.com",NULL );
		
}

?>