<? 
	require("../Objetos/pantalla.php");
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$pantalla=new Pantalla();
	$pantalla->conexion($link);
	$array=$pantalla->busqueda_parametros($_POST['pantalla'], 0, 1);
	echo "<ul style='margin:0;padding:0;list-style-type:none;list-style-position:outside; background-color:#FFF; height:100px;'>";
	if($array!=null)
	{
   
   
 	for($renglones=0; $renglones<count($array);$renglones++)
	{

    
    echo"<li><a href=\"javascript:ponerValor({id:'".$array[$renglones][0]."', nombre:'".$array[$renglones][1]."', desc:'".$array[$renglones][2]."', area:'".$array[$renglones][3]."', url:'".$array[$renglones][4]."' })\" class='texto_lista_chico'>".$array[$renglones][1]."&nbsp</li>";
	}
  
}else
	echo "<li class='texto_lista_chico'>No hay Sugerencias</li>";

echo "</ul>";
?>