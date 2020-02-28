<?php

$nomarchivo='cotizacion.xls';

$conexion=mysql_connect('localhost', 'globaldr_master', 'MePrendio7!') or
  die("Problemas en la conexion");
mysql_query("SET NAMES 'utf8'");
mysql_select_db("globaldr_erp",$conexion) or
  die("Problemas en la selección de la base de datos");
 
/*
$conexion=mysql_connect('localhost', 'globaldr_master', 'MePrendio7!') or
  die("Problemas en la conexion");
mysql_query("SET NAMES 'utf8'"); 
mysql_select_db("globaldr_ERP",$conexion) or
  die("Problemas en la selección de la base de datos");
   */
$cot=trim($_GET['cot']);


$datos='';
$cabecera='';
$registros="SELECT 
          CLIENTE.cliente_razonsocial, 
          MATERIAL.idSAE,
          MATERIAL.material_descripcion,
          PRESENTACIONES.descripcion,
          UNIDADES.prefijo,
          DETALLE_COTIZACION.cantidad,
          DETALLE_COTIZACION.precio_venta,
          DETALLE_COTIZACION.cantidad*DETALLE_COTIZACION.precio_venta as TOTAL          
          from DETALLE_COTIZACION, MATERIAL, UNIDADES, COTIZACION, CLIENTE, PRESENTACIONES
          where 
          MATERIAL.material_id=DETALLE_COTIZACION.producto_id AND 
          PRESENTACIONES.id_presentacion=MATERIAL.id_presentacion AND
          UNIDADES.id_unidad=MATERIAL.id_unidad AND
          COTIZACION.cotizacion_id = DETALLE_COTIZACION.cotizacion_id AND
          COTIZACION.cliente_id = CLIENTE.cliente_id AND
          DETALLE_COTIZACION.cotizacion_id=".$cot."  

          " ;

$registros=mysql_query($registros);
$cant=mysql_num_fields($registros) or
  die(mysql_error());
  
for($f=0;$f<$cant;$f++)
{
$cabecera.=mysql_field_name($registros,$f).";";
$cabecera =  str_replace ( 'cliente_razonsocial' ,  'CLIENTE' ,  $cabecera );
$cabecera =  str_replace ( 'idSAE' ,  'NOMBRE COMERCIAL' ,  $cabecera );
$cabecera =  str_replace ( 'material_descripcion' ,  'DESCRIPCION' ,  $cabecera );
$cabecera =  str_replace ( 'descripcion' ,  'PRESENTACION' ,  $cabecera );
$cabecera =  str_replace ( 'prefijo' ,  'UNIDAD' ,  $cabecera );
$cabecera =  str_replace ( 'cantidad' ,  'CANTIDAD' ,  $cabecera );
$cabecera =  str_replace ( 'precio_venta' ,  'PRECIO' ,  $cabecera );
$cabecera =  str_replace ( 'TOTAL' ,  'TOTAL' ,  $cabecera );

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

header ("Content-Disposition: attachment; filename=\"cotizacion.csv\"" );
?>