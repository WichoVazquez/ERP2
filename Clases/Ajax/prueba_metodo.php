<?
echo "Entro";
require_once("../Conexion/conexion_prueba_local.php");
include('../Conexion/ftpfunc.php');
require_once("../Objetos/config.php");
require_once("../Objetos/usuario.php");
require_once("../Objetos/contacto_ventas.php");
require_once("../Objetos/generales.php");
require("../pdf/prueba_metodo.php");
$link=conect();
$usuario=new Usuario();
$usuario->conexion($link);
//echo "id: $usu";
//echo "tamaño:".sizeof($arr_usu);
$config=new Configuracion();
$config->conexion($link);
$folio=salvaCotizacion(438);
echo "folio:".$folio;
if(file_exists ( "../pdf/tmp/cotizacion".$folio.".pdf"))
 echo "si existe";
if(file_exists ( "../../upload/javierrios/438"))
 echo "si existe directorio";

if (!copy("../pdf/tmp/cotizacion".$folio.".pdf", "../../upload/javierrios/438/cotizacion".$folio.".pdf")) 
    echo "failed to copy $file...\n";
?>