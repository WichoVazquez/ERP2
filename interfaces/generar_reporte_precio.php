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
$registros=mysql_query("SELECT material.idSAE, material.material_descripcion, material.material_precio FROM material WHERE 
  (material_id LIKE '%$name%' or material.material_descripcion like '%$name%' or material_precio like '%$name%');",$conexion) or
  die(mysql_error());
$cant=mysql_num_fields($registros) or
  die(mysql_error());
  
  
for($f=0;$f<$cant;$f++)
{
$cabecera.=mysql_field_name($registros,$f).";";
$cabecera =  str_replace ( 'idSAE' ,  'idSAE' ,  $cabecera );
$cabecera =  str_replace ( 'nombre' ,  'ALMACEN' ,  $cabecera );
$cabecera =  str_replace ( 'cantidad_actual' ,  'CANTIDAD' ,  $cabecera );
$cabecera =  str_replace ( 'material_precio' ,  'PRECIO' ,  $cabecera );
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
