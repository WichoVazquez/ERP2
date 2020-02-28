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

$qry =mysql_query("SELECT almacen_material.cantidad_actual from almacen_material WHERE almacen_material.material_id = '$idMaterial' ",$conexion) or
  die(mysql_error()); 
$fetch= mysql_fetch_array($qry)or
  die(mysql_error());
	$v1= $fetch['cantidad_actual'];
	$result= $v1- $canti;


$qry1=mysql_query("UPDATE almacen_material SET cantidad_actual = '$result' WHERE almacen_material.material_id = '$idMaterial' ",$conexion)
 or die(mysql_error()); 
if($qry1=1)
	echo "SE HA MODIFICADO EL INVENTARIO EXITOSAMENTE!";
else
	echo "FALLO LA MODIFICICACION DEL INVENTARIO";

?>