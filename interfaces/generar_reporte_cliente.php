<?php

$nomarchivo='prueba1.xls';



$conexion=mysql_connect('localhost', 'promex_master', 'MePrendio') or
  die("Problemas en la conexion");

mysql_select_db("promex",$conexion) or
  die("Problemas en la selección de la base de datos");
  
$_POST['nombre']; 
$name = $_POST['nombre']; 


$datos='';
$cabecera='';
$registros=mysql_query("SELECT cliente.cliente_id,cliente.cliente_razonsocial,cliente.cliente_rfc,  domicilio.domicilio_calle, 
  domicilio.domicilio_colonia, domicilio.domicilio_num_ext, domicilio.domicilio_num_int, domicilio.domicilio_municipio, domicilio.domicilio_ciudad,
  domicilio.domicilio_estado , domicilio.domicilio_cp  FROM cliente,domicilio WHERE 
  (cliente_id LIKE '%$name%' or cliente_rfc like '%$name%' or cliente_razonsocial like '%$name%') and 
  domicilio.domicilio_id = cliente.cliente_domicilio_fiscal ;",$conexion) or
  die(mysql_error());
$cant=mysql_num_fields($registros) or
  die(mysql_error());
  
  
for($f=0;$f<$cant;$f++)
{
$cabecera.=mysql_field_name($registros,$f).";";
$cabecera =  str_replace ( 'cliente_id' ,  'CLAVE' ,  $cabecera );
$cabecera =  str_replace ( 'cliente_razonsocial' ,  'RAZON_SOCIAL' ,  $cabecera );
$cabecera =  str_replace ( 'cliente_rfc' ,  'RFC' ,  $cabecera );
$cabecera =  str_replace ( 'domicilio_calle' ,  'CALLE' ,  $cabecera );
$cabecera =  str_replace ( 'domicilio_colonia' ,  'COLONIA' ,  $cabecera );
$cabecera =  str_replace ( 'domicilio_num_ext' ,  'No. Ext.' ,  $cabecera );
$cabecera =  str_replace ( 'domicilio_num_int' ,  'No. Int.' ,  $cabecera );
$cabecera =  str_replace ( 'domicilio_municipio' ,  'MUNICIPIO' ,  $cabecera );
$cabecera =  str_replace ( 'domicilio_ciudad' ,  'CIUDAD' ,  $cabecera );
$cabecera =  str_replace ( 'domicilio_estado' ,  'ESTADO' ,  $cabecera );
$cabecera =  str_replace ( 'domicilio_cp' ,  'CODIGO POSTAL' ,  $cabecera );
}

while($fila = mysql_fetch_row($registros)) 
{ 
  $linea = NULL;
  foreach($fila as $valor) 
  {           
    if ((!isset($valor)) || ($valor == ""))
    { 
      $valor = ";"; 
	  
    }
    else 
    { 
      $valor = str_replace('"', '""', $valor); 
	$valor = '' . $valor . ';' . ""; 
    } 
    $valor = stripslashes($valor);
    $linea .= $valor; 
  } 
  $datos .= trim($linea)."\n"; 

} 

$datos = str_replace("\r","",$datos);
        
if ($datos == "") 
{ 
  $datos = "\n (0) registros encontrados!\n";                         
}

print "$cabecera\n$datos";

        
header("Content-type: application/vnd.ms-excel") ;
header("Pragma: no-cache"); 
header("Expires: 0"); 
header ("Cache-Control: no-cache, must-revalidate");   

header ("Content-Disposition: attachment; filename=\"prueba.csv\"" );
?>
