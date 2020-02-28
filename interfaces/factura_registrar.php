<?php

$conexion=mysql_connect('localhost', 'promex_master', 'MePrendio') or
  die("Problemas en la conexion");

mysql_select_db("promex",$conexion) or
  die("Problemas en la selección de la base de datos");


      
      $order = "INSERT INTO factura
      (factura_fecha, factura_status, factura_descripcion, pedido_id)
      VALUES(CURDATE( ),'$_POST[status]', '$_POST[descripcion]', '$_POST[pedido_id]')";
      $result = mysql_query($order);
      if($result){
    echo("<br>FACTURA REGISTRADA ");
		} 
else{
    echo("<br>FACTURA NO REGISTRADA");
	}



?>