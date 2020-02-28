<?php

# FUNCIONES FTP
# CONSTANTES 
define("SERVER","localhost"); //IP o Nombre del Servidor
define("PORT",21); //Puerto
define("USER","usuarioftp"); //Nombre de Usuario
define("PASSWORD","meenthebest"); //Contraseña de acceso
define("PASV",true); //Activa modo pasivo
$url="";
# FUNCIONES

function ConectarFTP(){
//Permite conectarse al Servidor FTP
$id_ftp=ftp_connect(SERVER,PORT); //Obtiene un manejador del Servidor FTP
ftp_login($id_ftp,USER,PASSWORD); //Se loguea al Servidor FTP
ftp_pasv($id_ftp,PASV); //Establece el modo de conexión
return $id_ftp; //Devuelve el manejador a la función
}

function SubirArchivo($archivo_remoto,$archivo_local,$usr, $cot){
//Sube archivo de la maquina Cliente al Servidor (Comando PUT)
$id_ftp=ConectarFTP();

$ret=ftp_nb_put($id_ftp,$archivo_remoto,$archivo_local,FTP_BINARY);
while ($ret == FTP_MOREDATA) {
   
   // Do whatever you want
   echo ".";

   // Continue uploading...
   $ret = ftp_nb_continue($my_connection);
}
if ($ret != FTP_FINISHED) {
   echo "There was an error uploading the file...";
   exit(1);
}



//Sube un archivo al Servidor FTP en modo Binario
ftp_quit($id_ftp); //Cierra la conexion FTP
}



function ObtenerRuta($ruta){
//Obriene ruta del directorio del Servidor FTP (Comando PWD)
$id_ftp=ConectarFTP(); //Obtiene un manejador y se conecta al Servidor FTP
//ftp_chdir($id_ftp, "admin");
$Directorio=ftp_pwd($id_ftp); //Devuelve ruta actual p.e. "/home/willy"

ftp_quit($id_ftp); //Cierra la conexion FTP
return $Directorio; //Devuelve la ruta a la función
}

function VerificarDirectorio($usr,$cotizacion)
{
	$id_ftp=ConectarFTP();
	if(ftp_chdir($id_ftp, $usr))
	{
		if(ftp_chdir($id_ftp, $cotizacion))
			echo "<p>".ftp_pwd()."</p>";
		else	
			ftp_mkdir($id_ftp, $cotizacion);
	}
	else
	{
		ftp_mkdir($id_ftp, $usr);
		ftp_chdir($id_ftp,$usr);
		ftp_mkdir($id_ftp, $cotizacion);
	}
	/*if (!ftp_chdir($id_ftp, $usr)) {
		ftp_mkdir($id_ftp, $usr."/cotizaciones/".$cotizacion);
	}
	else
	{
		if(!ftp_chdir($id_ftp, "cotizaciones"))
		{
			ftp_mkdir($id_ftp, "cotizaciones/".$cotizacion);
		}
		else
		{
			if(!ftp_chdir($id_ftp, $cotizacion))
			  ftp_mkdir($id_ftp, $cotizacion);
		}
		
		
	}*/
	
	echo "El directorio Verificar Directorio es: " . ftp_pwd($id_ftp);

}

function VerificarDirectorioTemporal($usr,$fecha)
{
	$id_ftp=ConectarFTP();
	
	if (ftp_chdir($id_ftp, $usr."/temp")) {
		if(ftp_chdir($id_ftp, $fecha))
     		echo "El directorio actual es: " . ftp_pwd($id_ftp) . "\n";
		else
		{
			ftp_mkdir($id_ftp, $fecha);
			echo "El directorio actual es: " . ftp_pwd($id_ftp) . "\n";
		}
	 
	 $url=$usr;
	} else { 
		ftp_mkdir($id_ftp, $usr."/temp/".$fecha);
		/*if (ftp_chdir($id_ftp, $usr."/temp"))
		{
			ftp_mkdir($id_ftp, $cotizacion);
			echo "Se creo directorio: " . ftp_pwd($id_ftp) . "\n";
		}
		else
			echo "No se pudo crear al directorio\n  ";
	   */
}

}
?>