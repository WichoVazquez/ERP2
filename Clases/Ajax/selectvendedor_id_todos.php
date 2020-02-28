<? 
$user=$_POST['vendedor'];

	require("../Objetos/usuario.php");
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$usuario=new Usuario();
	$usuario->conexion($link);
	$array=$usuario->busqueda_usuario_id_todos($user,0,1);
	echo "<ul style='margin:0;padding:0;list-style-type:none;list-style-position:outside; background-color:#FFF; height:100px;'>";
	if($array!=null)
	{
   
   
 	for($renglones=0; $renglones<count($array);$renglones++)
	{

    
    echo"<li><a href=\"javascript:ponerValorVendedor({id:'".$array[$renglones][0]."', desc:'".$array[$renglones][5]." ".$array[$renglones][6]." ".$array[$renglones][7]."'})\" class='texto_lista_chico'>".$array[$renglones][5]." ".$array[$renglones][6]." ".$array[$renglones][7]."</li>";
	}
  
}else
	echo "<li class='texto_lista_chico'>No hay Sugerencias</li>";

echo "</ul>";
?>