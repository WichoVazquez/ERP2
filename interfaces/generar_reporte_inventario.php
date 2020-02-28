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

$registros=mysql_query("SELECT DISTINCT ALMACEN_MATERIAL.solicitud,
				  MATERIAL.idSAE,
				  MATERIAL.material_descripcion,
				  ALMACEN.nombre,
				  ALMACEN_MATERIAL.cantidad_actual,
				  ALMACEN_MATERIAL.minimo,
				  ALMACEN_MATERIAL.maximo
				  FROM MATERIAL, ALMACEN,ALMACEN_MATERIAL,UNIDADES
				  WHERE (ALMACEN.nombre like '%$name%' or MATERIAL.idSAE like '%$name%' or MATERIAL.material_descripcion
				  like '%$name%' or minimo like '%$name%' ) AND
				  MATERIAL.material_id=ALMACEN_MATERIAL.material_id AND UNIDADES.id_unidad=MATERIAL.id_unidad AND
				  ALMACEN.almacen_id=ALMACEN_MATERIAL.almacen_id  order by solicitud desc,material_descripcion ;",$conexion) or
  die(mysql_error());
$cant=mysql_num_fields($registros) or
  die(mysql_error());
  
  
for($f=0;$f<$cant;$f++)
{
$cabecera.=mysql_field_name($registros,$f).";";
$cabecera =  str_replace ( 'idSAE' ,  'IDSAE' ,  $cabecera );
$cabecera =  str_replace ( 'nombre' ,  'ALMACEN' ,  $cabecera );
$cabecera =  str_replace ( 'cantidad_actual' ,  'CANTIDAD ACTUAL' ,  $cabecera );
$cabecera =  str_replace ( 'material_descripcion' ,  'MATERIAL' ,  $cabecera );
$cabecera =  str_replace ( 'minimo' ,  'MINIMO' ,  $cabecera );
$cabecera =  str_replace ( 'solicitud' ,  'CANTIDAD SOLICITADA' ,  $cabecera );
$cabecera =  str_replace ( 'maximo' ,  'MAXIMO' ,  $cabecera );
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
