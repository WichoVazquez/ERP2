<? 
	require("../Objetos/material.php");
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$material=new Material();
	$material->conexion($link);
	$array=$material->busqueda_material_id($_POST['material']);
	echo "<ul style='margin:0;padding:0;list-style-type:none;list-style-position:outside; background-color:#FFF; height:250px;'>";
	if($array!=null)
	{
 	for($renglones=0; $renglones<count($array);$renglones++)
	{
    echo"
    <li>
    <a href=\"javascript:ponerValorMaterial({
     id:'".$array[$renglones][0]."', 
     desc:'".str_replace('"'," ",$array[$renglones][1])." / ".$array[$renglones][5]."' , 
     unidad:'".$array[$renglones][5]."', precio:'".$array[$renglones][3]."', 
     cantidad_act:'".$array[$renglones][4]."'
    })\" class='texto_lista_chico'>
    ".str_replace('"'," ",$array[$renglones][1])." / ".$array[$renglones][5]."
    </a>
    </li>";
	}
  
}else
	echo "<li class='texto_lista_chico'>No hay Sugerencias</li>";

echo "</ul>";
?>