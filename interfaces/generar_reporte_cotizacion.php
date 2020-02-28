<?php

$nomarchivo='prueba1.xls';



$conexion=mysql_connect('localhost', 'promex_master', 'MePrendio') or
  die("Problemas en la conexion");

mysql_select_db("promex",$conexion) or
  die("Problemas en la selección de la base de datos");
  
$_POST['nombre']; 
$_POST['filter'];
$name = $_POST['nombre']; 
$filter=$_POST['filter'];
$datos='';
$cabecera='';
$registros="SELECT COTIZACION.cotizacion_id, CASE COTIZACION.cotizacion_edo when 0 then 'Borradores' when 1 then 'PorAutorizar' when 2 then 'Enviado' when 3 then 'Cancelado' when 4 then 'No Autorizado' when 5 then 'Autorizado' when 6 then 'Confirmado' when 7 then 'Facturado' when 8 then 'Pagado' when 9 then 'Recotizado' end as Estado , CLIENTE.cliente_razonsocial, EMPRESA.empresa_razonsocial, COTIZACION.cotizacion_folio, COTIZACION.cotizacion_fecha_modificacion, COTIZACION.cotizacion_fecha_envio, COTIZACION.cotizacion_observaciones from COTIZACION, CLIENTE, USUARIO, EMPRESA, DOMICILIO where (COTIZACION.cotizacion_id like '%$name%' OR COTIZACION.cotizacion_folio like '%$name%' OR CLIENTE.cliente_id like '%$name%'  OR CLIENTE.cliente_razonsocial like '%$name%' OR EMPRESA.empresa_id like '%$name%' OR EMPRESA.empresa_razonsocial like '%$name%' OR DOMICILIO.domicilio_calle like '%$name%' OR  DOMICILIO.domicilio_colonia like '%$name%'  OR DOMICILIO.domicilio_ciudad like '%$name%' OR DOMICILIO.domicilio_estado like '%$name%' ) AND CLIENTE.cliente_domicilio_fiscal=DOMICILIO.domicilio_id AND CLIENTE.cliente_id=COTIZACION.cliente_id AND EMPRESA.empresa_id=COTIZACION.empresa_id AND USUARIO.usuario_id=COTIZACION.usuario_id  " ;
if ($filter>=0) {
  $registros=$registros."AND COTIZACION.cotizacion_edo='$filter'";
}
 
$registros=mysql_query($registros);
$cant=mysql_num_fields($registros) or
  die(mysql_error());
  
for($f=0;$f<$cant;$f++)
{
$cabecera.=mysql_field_name($registros,$f).";";
$cabecera =  str_replace ( 'cotizacion_id' ,  'NO. COTIZACIO' ,  $cabecera );
$cabecera =  str_replace ( 'cotizacion_edo' ,  'RAZON_SOCIAL' ,  $cabecera );
$cabecera =  str_replace ( 'cliente_razonsocial' ,  'CLIENTE' ,  $cabecera );
$cabecera =  str_replace ( 'empresa_razonsocial' ,  'EMPRESA' ,  $cabecera );
$cabecera =  str_replace ( 'cotizacion_folio' ,  'FOLIO' ,  $cabecera );
$cabecera =  str_replace ( 'cotizacion_fecha_modificacion' ,  'FECHA DE MODIFICACION' ,  $cabecera );
$cabecera =  str_replace ( 'cotizacion_fecha_envio' ,  'FECHA ENVIO' ,  $cabecera );
$cabecera =  str_replace ( 'cotizacion_observaciones' ,  'OBSERVACIONES' ,  $cabecera );

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
