<?
	
	$empresa=$_POST['empresa'];

	require("../Objetos/empresa.php");
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$empresa=new Empresa();
	$empresa->conexion($link);

	$array=$empresa->busqueda_empresa_id($empresa);
	echo "<ul style='margin:0;padding:0;list-style-type:none;list-style-position:outside; background-color:#FFF; height:100px;'>";

	if($array!=null)
	{
   
   
 	for($renglones=0; $renglones<count($array);$renglones++)
	{

    echo"<li><a href=\"javascript:ponerValorEmpresa({id:'".$array[$renglones][0]."', desc:'".$array[$renglones][1]."'})\" class='texto_lista_chico'>".$array[$renglones][1]."</li>";
	

	}

  
}else
	echo "<li class='texto_lista_chico'>No hay Sugerencias</li>";

	
echo "</ul>";
?>