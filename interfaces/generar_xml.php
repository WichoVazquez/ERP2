<?php
$idPedido=$_POST['idPedido'];
$descripcion=$_POST['descripcion'];
$idcliente=$_POST['idcliente'];
$Nidcliente=$_POST['Nidcliente'];

$conexion=mysql_connect('localhost', 'promex_master', 'MePrendio') or
  die("Problemas en la conexion");

mysql_select_db("promex",$conexion) or
  die("Problemas en la selección de la base de datos");
      
   
if ($Nidcliente==!NULL)

{
  $qryTemp=mysql_query("INSERT INTO `promex`.`cliente` (`cliente_id`, `cliente_razonsocial`, `cliente_rfc`, `cliente_domicilio_fiscal`, `status`, `cliente_generales`)
   VALUES ('30001', 'TEMP', 'TEMP', '82', '0', '0')");
  $qry =mysql_query("SELECT contacto_ventas.contacto_ventas_id from contacto_ventas where cliente_id='$idcliente' ");
$fetch= mysql_fetch_array($qry);
 $contacto_ventas= $fetch['contacto_ventas_id'];

$qry2=mysql_query("SELECT cotizacion.cotizacion_id FROM cotizacion where cliente_id= '$idcliente' ");
$cont_array=0;
$indice=0;
 $array=array(); // create new empty array
while($row=mysql_fetch_row($qry2))
                          {
                                  
                                  $array[$cont_array]=array($row[0]);
                                  $v=$array[$cont_array]=array($row[0]);
                                 $qry1=mysql_query("UPDATE cotizacion SET  cliente_id =  30001 WHERE  cotizacion.cotizacion_id like '$v[0]'");
                                  $cont_array++;
                                 
                          }

              $qry3=mysql_query("UPDATE  contacto_ventas SET  cliente_id =  30001 WHERE  contacto_ventas.contacto_ventas_id = '$contacto_ventas' ");
              $qry4=mysql_query("SELECT sucursal.sucursal_id from sucursal where cliente_id='$idcliente' ");
              $fetch= mysql_fetch_array($qry4);
              $Idsucursal= $fetch['sucursal_id'];
              $qry9=mysql_query("SELECT contrato.contrato_id from contrato where cliente_id='$idcliente'");
              $fetch1= mysql_fetch_array($qry9);
              $idcontrato=$fetch1['contrato_id'];
                  if ($Idsucursal>0 && $idcontrato>0) 
                  {
                        $qry5=mysql_query("UPDATE  sucursal SET  cliente_id =  30001 WHERE  sucursal.sucursal_id = '$Idsucursal' ");
                        $qry10=mysql_query("UPDATE  contrato SET  cliente_id =  30001 WHERE  contrato.contrato_id = '$idcontrato' ");
                        $qry6=mysql_query("UPDATE  cliente SET  cliente_id =  '$Nidcliente' WHERE  cliente.cliente_id = '$idcliente' ");
                        $qry8=mysql_query("UPDATE  contacto_ventas SET  cliente_id =  '$Nidcliente' WHERE  contacto_ventas.contacto_ventas_id = '$contacto_ventas' ");
                        $qry7=mysql_query("UPDATE  sucursal SET  cliente_id =  '$Nidcliente' WHERE  sucursal.sucursal_id = '$Idsucursal' ");
                        $qry12=mysql_query("UPDATE  contrato SET  cliente_id =  '$Nidcliente' WHERE  contrato.contrato_id = '$idcontrato' ");

                  }
                  elseif ($Idsucursal>0 && $idcontrato==NULL) {
                        $qry5=mysql_query("UPDATE  sucursal SET  cliente_id =  30001 WHERE  sucursal.sucursal_id = '$Idsucursal' ");
                        $qry6=mysql_query("UPDATE  cliente SET  cliente_id =  '$Nidcliente' WHERE  cliente.cliente_id = '$idcliente' ");
                        $qry8=mysql_query("UPDATE  contacto_ventas SET  cliente_id =  '$Nidcliente' WHERE  contacto_ventas.contacto_ventas_id = '$contacto_ventas' ");
                        $qry7=mysql_query("UPDATE  sucursal SET  cliente_id =  '$Nidcliente' WHERE  sucursal.sucursal_id = '$Idsucursal' ");
                       
                  }
                  elseif($Idsucursal==NULL && $idcontrato>0){
                 
                        $qry10=mysql_query("UPDATE  contrato SET  cliente_id =  30001 WHERE  contrato.contrato_id = '$idcontrato' ");
                        $qry6=mysql_query("UPDATE  cliente SET  cliente_id =  '$Nidcliente' WHERE  cliente.cliente_id = '$idcliente' ");
                        $qry8=mysql_query("UPDATE  contacto_ventas SET  cliente_id =  '$Nidcliente' WHERE  contacto_ventas.contacto_ventas_id = '$contacto_ventas' ");
                        $qry12=mysql_query("UPDATE  contrato SET  cliente_id =  '$Nidcliente' WHERE  contrato.contrato_id = '$idcontrato' ");

                  }

                  else
                  {
                        $qry6=mysql_query("UPDATE  cliente SET  cliente_id =  '$Nidcliente' WHERE  cliente.cliente_id = '$idcliente' ");
                        $qry8=mysql_query("UPDATE  contacto_ventas SET  cliente_id =  '$Nidcliente' WHERE  contacto_ventas.contacto_ventas_id = '$contacto_ventas' ");

                        echo "Se HA actualizado el Numero del SAE exitosamente sin sucursal";
                  }



$qry20=mysql_query("SELECT cotizacion.cotizacion_id FROM cotizacion where cliente_id= 30001 ");
$cont_array1=0;
 $array=array(); // create new empty array
while($row1=mysql_fetch_row($qry20))
                          {
                                  
                                  $array[$cont_array1]=array($row1[0]);
                                  $vv=$array[$cont_array1]=array($row1[0]);
                                 $qry11=mysql_query("UPDATE cotizacion SET  cliente_id =  $Nidcliente WHERE  cotizacion.cotizacion_id like '$vv[0]'");
                                  $cont_array1++;
                                 
                          }

                          $qrydel=mysql_query("DELETE FROM cliente WHERE cliente.cliente_id = 30001");

                            if ($qrydel==1)
                             {
                               $order = "INSERT INTO factura
                                  (factura_fecha, factura_status, factura_descripcion, pedido_id)
                                  VALUES(CURDATE( ),'$_POST[status]', '$descripcion', '$idPedido')";
                                  $result = mysql_query($order);
                                  echo("FACTURA RIGASTRADA Y CAMBIO DEL IDSAE CCORRECTO");

                              }
                              else
                                echo "HUBO UN EROOR";
  

                                           

 }




else

  {
        $order = "INSERT INTO factura
      (factura_fecha, factura_status, factura_descripcion, pedido_id)
      VALUES(CURDATE( ),'$_POST[status]', '$descripcion', '$idPedido')";
      $result = mysql_query($order);
      $fac=mysql_query("SELECT FACTURA.factura_id FROM factura where factura.pedido_id= '$idPedido'");
      $facfetch= mysql_fetch_array($fac);
      $idfactura=$facfetch['factura_id'];
      $update=mysql_query("UPDATE  detalle_pedido SET  factura_id =  '$idfactura' WHERE  detalle_pedido.pedido_id ='$idPedido' ") ;


      if($result=1)
      {
$txt= '<?xml version="1.0" standalone="yes"?>  <DATAPACKET Version="2.0"><METADATA><FIELDS><FIELD attrname="CVE_CLPV" fieldtype="string" WIDTH="10"/><FIELD attrname="NUM_ALMA" fieldtype="i4"/><FIELD attrname="CVE_PEDI" fieldtype="string" WIDTH="20"/><FIELD attrname="ESQUEMA" fieldtype="i4"/><FIELD attrname="DES_TOT" fieldtype="r8"/><FIELD attrname="DES_FIN" fieldtype="r8"/><FIELD attrname="CVE_VEND" fieldtype="string" WIDTH="5"/><FIELD attrname="COM_TOT" fieldtype="r8"/><FIELD attrname="NUM_MONED" fieldtype="i4"/><FIELD attrname="TIPCAMB" fieldtype="r8"/><FIELD attrname="STR_OBS" fieldtype="string" WIDTH="255"/><FIELD attrname="ENTREGA" fieldtype="string" WIDTH="25"/><FIELD attrname="SU_REFER" fieldtype="string" WIDTH="20"/><FIELD attrname="TOT_IND" fieldtype="r8"/><FIELD attrname="MODULO" fieldtype="string" WIDTH="4"/><FIELD attrname="CONDICION" fieldtype="string" WIDTH="25"/><FIELD attrname="dtfield" fieldtype="nested"><FIELDS><FIELD attrname="CANT" fieldtype="r8"/><FIELD attrname="CVE_ART" fieldtype="string" WIDTH="20"/><FIELD attrname="DESC1" fieldtype="r8"/><FIELD attrname="DESC2" fieldtype="r8"/><FIELD attrname="DESC3" fieldtype="r8"/><FIELD attrname="IMPU1" fieldtype="r8"/><FIELD attrname="IMPU2" fieldtype="r8"/><FIELD attrname="IMPU3" fieldtype="r8"/><FIELD attrname="IMPU4" fieldtype="r8"/><FIELD attrname="COMI" fieldtype="r8"/><FIELD attrname="PREC" fieldtype="r8"/><FIELD attrname="NUM_ALM" fieldtype="i4"/><FIELD attrname="STR_OBS" fieldtype="string" WIDTH="255"/><FIELD attrname="REG_GPOPROD" fieldtype="i4"/><FIELD attrname="REG_KITPROD" fieldtype="i4"/><FIELD attrname="NUM_REG" fieldtype="i4"/><FIELD attrname="COSTO" fieldtype="r8"/><FIELD attrname="TIPO_PROD" fieldtype="string" WIDTH="1"/><FIELD attrname="TIPO_ELEM" fieldtype="string" WIDTH="1"/><FIELD attrname="MINDIRECTO" fieldtype="r8"/><FIELD attrname="TIP_CAM" fieldtype="r8"/><FIELD attrname="FACT_CONV" fieldtype="r8"/><FIELD attrname="UNI_VENTA" fieldtype="string" WIDTH="10"/><FIELD attrname="IMP1APLA" fieldtype="i4"/><FIELD attrname="IMP2APLA" fieldtype="i4"/><FIELD attrname="IMP3APLA" fieldtype="i4"/><FIELD attrname="IMP4APLA" fieldtype="i4"/><FIELD attrname="PREC_SINREDO" fieldtype="r8"/><FIELD attrname="COST_SINREDO" fieldtype="r8"/><FIELD attrname="LINK_FIELD" fieldtype="ui4" hidden="true" linkfield="true"/></FIELDS><PARAMS CHANGE_LOG="1 0 4 2 0 4 3 0 4"/></FIELD></FIELDS><PARAMS CHANGE_LOG="1 0 4 1 1 64 1 1 64 1 1 64"/></METADATA><ROWDATA><ROW RowState="4" CVE_CLPV="      2139" NUM_ALMA="1" CVE_PEDI="" ESQUEMA="0" DES_TOT="0" DES_FIN="0" CVE_VEND="JSH" COM_TOT="0" NUM_MONED="1" TIPCAMB="1" STR_OBS="" MODULO="FACT" CONDICION=""><dtfield><ROWdtfield RowState="4" CANT="1" CVE_ART="MA001" DESC1="0" DESC2="0" DESC3="0" IMPU1="0" IMPU2="0" IMPU3="0" IMPU4="16" COMI="0" PREC="7500" NUM_ALM="1" STR_OBS="PREVENTIVO A MOTOR DE COMBUSTION MCA VOLKS WAGEN 1600" REG_GPOPROD="0" COSTO="0" TIPO_PROD="S" TIPO_ELEM="N" TIP_CAM="1" UNI_VENTA="NO APLICA" IMP1APLA="0" IMP2APLA="0" IMP3APLA="0" IMP4APLA="1" PREC_SINREDO="7500" COST_SINREDO="0" LINK_FIELD="1"/><ROWdtfield RowState="4" CANT="1" CVE_ART="MA001" DESC1="0" DESC2="0" DESC3="0" IMPU1="0" IMPU2="0" IMPU3="0" IMPU4="16" COMI="0" PREC="9140" NUM_ALM="1" STR_OBS="PREVENTIVO A MOTOBOMBA ELECTRICA MARCA SIEMENS 15HP" REG_GPOPROD="0" COSTO="0" TIPO_PROD="S" TIPO_ELEM="N" TIP_CAM="1" UNI_VENTA="NO APLICA" IMP1APLA="0" IMP2APLA="0" IMP3APLA="0" IMP4APLA="1" PREC_SINREDO="9140" COST_SINREDO="0" LINK_FIELD="2"/><ROWdtfield RowState="4" CANT="15" CVE_ART="MA001" DESC1="0" DESC2="0" DESC3="0" IMPU1="0" IMPU2="0" IMPU3="0" IMPU4="16" COMI="0" PREC="100" NUM_ALM="1" STR_OBS="PREVENTIVO DE HIDRANTES   **SERVICIO DE MANTENIMIENTO PREVENTIVO Y CORRECTIVO A SISTEMAS CONTRA INCENDIO, DETECCION TEMPRANA DE HUMO Y EXTINTORES CONTRATO: SG/CNS/23/2013. CORRESPONDIENTE A &#013;&#010;ANTONIO DELGIN MADRIGAL #665" REG_GPOPROD="0" COSTO="0" TIPO_PROD="S" TIPO_ELEM="N" TIP_CAM="1" UNI_VENTA="NO APLICA" IMP1APLA="0" IMP2APLA="0" IMP3APLA="0" IMP4APLA="1" PREC_SINREDO="100" COST_SINREDO="0" LINK_FIELD="3"/></dtfield></ROW></ROWDATA></DATAPACKET>';
$archivo= 'factura';
$ar= fopen($archivo.".mod","w+");
print "$txt";
fwrite($ar,$txt);        
header("Pragma: no-cache"); 
header("Expires: 0"); 
header ("Cache-Control: no-cache, must-revalidate");   
header ("Content-Disposition: attachment; filename=\"factura.mod\"" );
    } 
else{
    echo("FACTURA NO REGISTRADA");
  }

}

?>
