<?php 
@session_start();
function conect()
{
$link = mysql_connect('localhost', 'root', ''); 
 //$link = mysql_connect('localhost', 'mogel_master', 'MePrendio'); 
mysql_query("SET NAMES 'utf8'"); //Lee caracteres especiales y ascentos.
if (!$link) { 
die('Could not connect: '.mysql_error()); 
}

//echo 'Connected successfully'; 
mysql_select_db("globaldr_ERP");
//mysql_select_db("mogel");

return $link;
}

function cerrar()
{
mysql_close();
}
?>