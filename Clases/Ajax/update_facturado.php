<?php
require("../Conexion/conexion_prueba_local.php");
  //checa perfil de usuario
$clave=$_POST['chekado'];
  
  $link=conect();
  $qry1=mysql_query("SELECT detalle_pedido.facturado FROM detalle_pedido WHERE detalle_pedido.producto_id = ".$clave." ");
  $fetch=mysql_fetch_array($qry1);
  $actual=$fetch['facturado'];
  $var=1;
  $total= $actual+$var;

  
  $qry=mysql_query("UPDATE  detalle_pedido SET  facturado =  '$total' WHERE  detalle_pedido.producto_id =".$clave."   ") ;

  if ($qry==1) {
    echo "salio bien";
  }

 else
  echo "ERROR";
  
  ?>