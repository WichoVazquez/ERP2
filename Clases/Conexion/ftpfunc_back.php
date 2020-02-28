<?php

# FUNCIONES FTP
# CONSTANTES 
/*define("SERVER","ftp.global-drilling.com"); //IP o Nombre del Servidor
define("PORT",21); //Puerto
define("USER","usuarioftp@mogel.com.mx"); //Nombre de Usuario @mogel.com.mx
define("PASSWORD","ftppromex2013"); //Contraseña de acceso
define("PASV",true); //Activa modo pasivo*/
define("SERVER","127.0.0.1"); //IP o Nombre del Servidor
define("PORT",21); //Puerto
define("USER","usuarioftp@mogel.com.mx"); //Nombre de Usuario
define("PASSWORD","ftppromex2013"); //Contraseña de acceso
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

function SubirArchivo($archivo_remoto,$archivo_local, $url){
//Sube archivo de la maquina Cliente al Servidor (Comando PUT)
$id_ftp=ConectarFTP();
ftp_chdir($id_ftp, $url);
//echo "QUE SHOW:".ftp_pwd($id_ftp);
$upload=ftp_put($id_ftp, $archivo_local, $archivo_remoto, FTP_BINARY);

if(!$upload)
{
	print 'No se puede subir Archivo';
} else { 
    print 'Completo';
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
		if(!ftp_chdir($id_ftp, $cotizacion))
			ftp_mkdir($id_ftp, $cotizacion);
	}
	else
	{
		ftp_mkdir($id_ftp, $usr);
		ftp_chdir($id_ftp,$usr);
		ftp_mkdir($id_ftp, $cotizacion);
		//echo "Directorio actual despues de crearlos".ftp_pwd($id_ftp);
	}
	
	
}

function CreaDirectorios($usr,$cotizacion)
{
	$id_ftp=ConectarFTP();

		//ftp_mkdir($id_ftp, $usr);
		ftp_chdir($id_ftp,$usr);
		ftp_mkdir($id_ftp, $cotizacion);
		//echo "Directorio actual despues de crearlos".ftp_pwd($id_ftp);
}


?>