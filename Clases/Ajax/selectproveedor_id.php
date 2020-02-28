<? 
	require("../Objetos/proveedor.php");
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$proveedor=new Proveedor();
	$proveedor->conexion($link);
	$array=$proveedor->busqueda_proveedor_id($_POST['proveedor']);
	echo "<ul style='margin:0;padding:0;list-style-type:none;list-style-position:outside; background-color:#FFF; height:100px;'>";
	if($array!=null)
	{
 	for($renglones=0; $renglones<count($array);$renglones++)
	{
    echo"<li><a href=\"javascript:ponerValorProveedor({
    	id:'".$array[$renglones][0]."', 
    	desc:'".$array[$renglones][1]."',
    	contacto:'".$array[$renglones][3]." ".$array[$renglones][4]." ".$array[$renglones][5]."',
    	email_contacto:'".$array[$renglones][6]."',
    	tel_contacto:'".$array[$renglones][7]."'

    })\" class='texto_lista_chico'>".$array[$renglones][1]."&nbsp;&nbsp;(".$array[$renglones][2].")</li>";
	}
  
}else
	echo "<li class='texto_lista_chico'>No hay Sugerencias</li>";

echo "</ul>";
?>