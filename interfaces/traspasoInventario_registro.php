<?
 function conexion($link_bd)
          {
                  $link=$link_bd;
          }

$conexion=mysql_connect('localhost', 'promex_master', 'MePrendio') or
  die("Problemas en la conexion");

  mysql_select_db("promex",$conexion) or
  die("Problemas en la selección de la base de datos");

$canti=$_POST['text_cantidad'];
$idMaterial=$_POST['material']; 
$almacen_entrada=$_POST['almacen_entrada'];
$almacen_salida=$_POST['almacen_id'];
 echo"$almacen_entrada";

$qry =mysql_query("SELECT almacen_material.cantidad_actual from almacen_material WHERE almacen_material.almacen_material_id = '$idMaterial' and 
  almacen_material.almacen_id= '$almacen_salida' ",$conexion) or
  die(mysql_error()); 
$fetch= mysql_fetch_array($qry)or
  die(mysql_error());

  $v1= $fetch['cantidad_actual'];
  
  $result= $v1-$canti;
 
  $result1=$v1+$canti;
  
  $qry1=mysql_query("UPDATE almacen_material SET cantidad_actual = '$result' 
    WHERE almacen_material.material_id = '$idMaterial' and  almacen_id='$almacen_salida' ",$conexion)
 or die(mysql_error()); 
 echo "el almacen de salida $almacen_salida tiene ahora $result";
  if($qry1=1)
  echo "SE HA MODIFICADO EL INVENTARIO EXITOSAMENTE!";
else
  echo "FALLO LA MODIFICICACION DEL INVENTARIO";



 $qry =mysql_query("SELECT almacen_material.cantidad_actual from almacen_material WHERE almacen_material.material_id ='$idMaterial' and 
almacen_material.almacen_id='$almacen_entrada' ",$conexion) or
  die(mysql_error()); 
$fetch= mysql_fetch_array($qry)or
  die(mysql_error());
   $v2= $fetch['cantidad_actual'];
   echo "cantidad actual del almacen de entrada $almacen_entrada $v1";
    $result1=$v2+$canti;
  

 $qry2=mysql_query("UPDATE almacen_material SET almacen_material.almacen_id = '$almacen_entrada', cantidad_actual = '$result1' WHERE almacen_material.material_id ='$idMaterial' and 
almacen_id='$almacen_entrada' ",$conexion) or die(mysql_error()); 
 echo "al almacen de entrada $almacen_entrada tiene ahora $result1";
 
 if($qry2=1)
  echo "SE HA MODIFICADO EL INVENTARIO EXITOSAMENTE!";
else
  echo "FALLO LA MODIFICICACION DEL INVENTARIO";



?>