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
$registros=mysql_query("SELECT  ruta.ruta_id ,  transporte.transporte_nombre ,  case ruta.ruta_estatus when 0 then 'Enrutado' when 1 then 'Cancelado' 
  when 2 then 'Entregado' end as ESTATUS, cliente.cliente_razonsocial, pedido.pedido_id, detalle_pedido.cantidad_surtida, material.material_descripcion 
   FROM ruta, transporte, almacen, cliente, pedido, material, almacen_material,detalle_pedido, domicilio, detalle_cotizacion, cotizacion, ruta_detalle 
  where (transporte_nombre LIKE '%$name%' or material_descripcion like '%$name%' or cantidad_surtida like '%$name%' or '%$name%') and 
  almacen_material.material_id = material.material_id and almacen_material.almacen_id = almacen.almacen_id and ruta.transporte_id=transporte.transporte_id
  and detalle_pedido.pedido_id = pedido.pedido_id and  domicilio.domicilio_id = cliente.cliente_domicilio_fiscal and cotizacion.cotizacion_id = pedido.cotizacion_id
  and ruta_detalle.ruta_id=ruta.ruta_id and ruta_detalle.PedidoDetalle_id= detalle_pedido.detalle_pedido_id
  and almacen_material.almacen_material_id=detalle_cotizacion.producto_id and cotizacion.cliente_id= cliente.cliente_id and
   detalle_cotizacion.detalle_cotizacion_id= detalle_pedido.detalle_cotizacion_id;",$conexion) or
  die(mysql_error());
$cant=mysql_num_fields($registros) or
  die(mysql_error());
  
  
for($f=0;$f<$cant;$f++)
{
$cabecera.=mysql_field_name($registros,$f).";";
$cabecera =  str_replace ( 'ruta_id' ,  'RUTA' ,  $cabecera );
$cabecera =  str_replace ( 'ruta_estatus' ,  'ESTATUS' ,  $cabecera );
$cabecera =  str_replace ( 'transporte_nombre' ,  'TRANSPORTE' ,  $cabecera );
$cabecera =  str_replace ( 'cliente_razonsocial' ,  'CLIENTE' ,  $cabecera );
$cabecera =  str_replace ( 'pedido_id' ,  'O. SALIDA' ,  $cabecera );
$cabecera =  str_replace ( 'cantidad_surtida' ,  'CANTIDAD SURTIDA' ,  $cabecera );
$cabecera =  str_replace ( 'material_descripcion' ,  'MATERIAL' ,  $cabecera );
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
