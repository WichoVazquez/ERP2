<?
include('../Clases/Conexion/ftpfunc.php');
require_once("index_header.php");
$user=sesiones_start();
$cot=trim($_GET['cot']);

VerificarDirectorio($user, $cot);
$url="$user/$cot/";
//echo "$url";
if(!empty($_FILES["archivo"]["name"]))
{ //Comprueba si la variable "archivo" se ha definido
$url="$user/$cot/";
SubirArchivo($_FILES["archivo"]["tmp_name"], $_FILES["archivo"]["name"], $url); 
//basename obtiene el nombre de archivo sin la ruta
unset($_FILES["archivo"]); //Destruye la variable "archivo"
}
?>
     
<HTML>
<HEAD>

<TITLE>Adjuntar Archivos</TITLE>
<STYLE>
    body { font-size: 62.5%; }
    /*label, input { display:block;  }*/
    input.text { margin-bottom:12px; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
	div#uploaded-files { width: 400px; margin: 20px 0; }
    div#uploaded-files table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#uploaded-files table td, div#uploaded-files table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
	.text-label {
    color: #cdcdcd;
    font-weight: bold;
	}
  </STYLE>
  <LINK rel="stylesheet" href="../Clases/Diseño/jquery-ui.css" />
</HEAD>
<BODY>
<FORM action="<?php echo "adjuntar_archivos.php?cot=".$cot;?>" method="post" name="form_ftp" id="form_ftp" enctype="multipart/form-data">
<INPUT name="archivo" type="file" id="archivo" />
<INPUT name="Submit" type="submit" value="Subir Archivo"/>
</font><FONT size="2" face="Verdana, Tahoma, Arial"> </FONT> </p>
</FORM>
</div>
<div id="uploaded-files" class="ui-widget">
<H1>Archivos:</H1>
  <TABLE id="archivos" class="ui-widget ui-widget-content">
    <THEAD>
      <TR class="ui-widget-header ">
        <TH>&nbsp;</TH>
        <TH>Nombre</TH>
        <TH>Tamaño</TH>
        <TH>Fecha</TH>
      </TR>
    </THEAD>
    <TBODY>
    <?
$id_ftp=ConectarFTP(); //Obtiene un manejador y se conecta al Servidor FTP 
//$ruta=ObtenerRuta(); //Obtiene la ruta actual en el Servidor FTP
//echo "<b>El directorio actual es: </b> ".$ruta;
ftp_chdir($id_ftp,$url);
$lista=ftp_nlist($id_ftp,ftp_pwd($id_ftp)); //Devuelve un array con los nombres de ficheros
$lista=array_reverse($lista); //Invierte orden del array (ordena array)
while ($item=array_pop($lista)) //Se leen todos los ficheros y directorios del directorio
{
$tamano=number_format(((ftp_size($id_ftp,$item))/1024),2)." Kb"; 
//Obtiene tamaño de archivo y lo pasa a KB
if(($tamano=="-0.00 Kb") )// Si es -0.00 Kb se refiere a un directorio
{ 
$item="<i>".$item."</i>";
$tamano="&nbsp;";
$fecha="&nbsp;";
}else{

$fecha=date("d/m/y h:i:s", ftp_mdtm($id_ftp,$item));
//Filemtime obtiene la fecha de modificacion del fichero; y date le da el formato de salida
}
?>

<TR>
<TD><INPUT type="checkbox" /></font></TD> 
<TD><FONT size="2" face="Verdana, Tahoma, Arial"><? echo $item ?></FONT></TD>
<TD align="right"><FONT size="2" face="Verdana, Tahoma, Arial"><? echo $tamano ?></FONT></TD>
<TD align="right"><FONT size="2" face="Verdana, Tahoma, Arial"><? echo $fecha ?></FONT></TD>
</TR>
<? } ?>
    </TBODY>
  </TABLE>
<button id='quitar_archivo'>Quitar Archivo</button>