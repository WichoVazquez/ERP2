<?

$path = get_include_path() . PATH_SEPARATOR . '/usr/lib/php';
set_include_path($path);

require_once 'Mail.php';
//var_dump(class_exists('System', false));


 $from = "meenrios@gmail.com";
 $to = "fjrios@global-drilling.com";
 $subject = "Hi!";
 $body = "Hi,\n\nHow are you?";
 
 $host = "ssl://smtp.gmail.com";
 $port = "465";
 $username = "meenrios@gmail.com";
 $password = "josueesminombre";
 
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);
 $smtp = Mail::factory('smtp',
   array ('host' => $host,
   	 'port' => $port,
     'auth' => true,
     'username' => $username,
     'password' => $password));
 
 echo "hasta aqui funciona";
 $mail = $smtp->send($to, $headers, $body);
 
  if (PEAR::isError($mail)) 
  {
    echo("<p>" . $mail->getMessage() . "</p>");
  } 
  else
  {
	echo("<p>Message successfully sent!</p>");
  }

 ?>
 
 