<? 
	require("../Objetos/perfil.php");
	require_once("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$perfil=new Perfil();
	$perfil->conexion($link);
	$array=$perfil->busqueda_parametros($_POST['perfil'],0,1);
	echo "<ul style='margin:0;padding:0;list-style-type:none;list-style-position:outside; background-color:#FFF; height:100px;'>";
	if($array!=null)
	{
   
   
 	for($renglones=0; $renglones<count($array);$renglones++)
	{

    
    echo"<li><a href=\"javascript:ponerValorPerfil('".$array[$renglones][0]."')\" class='texto_lista_chico'>".$array[$renglones][1]."&nbsp</li>";
	}
  
}else
	echo "<li class='texto_lista_chico'>No hay Sugerencias</li>";

echo "</ul>";
?>