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

$registros=mysql_query("SELECT DISTINCT PEDIDO.pedido_id, PEDIDO.cotizacion_id,  PEDIDO.folio_pedido, PEDIDO.pedido_fecha_creacion, 
          PEDIDO.pedido_fecha_entrega, case PEDIDO.pedido_estado when 0 then 'SIN ATENDER' when 1 then 'LISTO'  end as pedido_estado 
          FROM DETALLE_PEDIDO, pedido where (pedido.pedido_id like '%$name%' or cotizacion_id like '%$name%'or pedido.pedido_fecha_creacion like '%$name%')
           AND  pedido.pedido_id = DETALLE_PEDIDO.pedido_id AND DETALLE_PEDIDO.detalle_pedido_status<=3 ;",$conexion) or
  die(mysql_error());
$cant=mysql_num_fields($registros) or
  die(mysql_error());
  
  
for($f=0;$f<$cant;$f++)
{
$cabecera.=mysql_field_name($registros,$f).";";
$cabecera =  str_replace ( 'pedido_id' ,  'ORDEN DE SALIDA' ,  $cabecera );
$cabecera =  str_replace ( 'cotizacion_id' ,  ' NO. COTIZACION' ,  $cabecera );
$cabecera =  str_replace ( 'folio_pedido' ,  'FOLIO' ,  $cabecera );
$cabecera =  str_replace ( 'pedido_fecha_creacion' ,  'FECHA DE CREACION' ,  $cabecera );
$cabecera =  str_replace ( 'pedido_fecha_entrega' ,  'FECHA DE ENTREGA' ,  $cabecera );
$cabecera =  str_replace ( 'pedido_estado' ,  'STATUS' ,  $cabecera );
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
    $rest=substr($linea, -2);  

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
