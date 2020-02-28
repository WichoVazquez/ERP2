<?php
@session_start();
function conect()
{
	$link =  mysql_connect('localhost', 'root', '');
	mysql_query("SET NAMES 'utf8'"); //Lee caracteres especiales y ascentos.
    if (!$link) {
    die('No pudo conectarse: ' . mysql_error());
}
mysql_select_db('globaldr_ERP');
echo 'Conectado satisfactoriamente';
return $link;
}

function cerrar()
{
	mysql_close();
}
echo conect();


?>

<!--<?php
$consulta = "SELECT * FROM usuario";
mysql_select_db('globaldr_ERP');
$datos=mysql_query($consulta);
while($fila=mysql_fetch_array($datos)){
	echo "<p>";
	echo $fila['usuario_id'];
	echo "<p>";
	echo $fila['usuario_password'];
}
?>-->