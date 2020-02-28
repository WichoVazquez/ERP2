<?
	
	$cliente=$_POST['cliente'];
	require("../Objetos/contrato.php");
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$contrato=new Contrato();
	$contrato->conexion($link);
	$array=$contrato->busqueda_contrato_id($cliente);
	echo "<ul style='margin:0;padding:0;list-style-type:none;list-style-position:outside; background-color:#FFF; height:100px;'>";

	if($array!=null)
	{
   
   
 	for($renglones=0; $renglones<count($array);$renglones++)
	{

    echo"<li><a href=\"javascript:ponerValorContrato({id:'".$array[$renglones][0]."', desc:'".$array[$renglones][1]."', montos:'".$array[$renglones][2]."'}
    )\" class='texto_lista_chico'>'".$array[$renglones][1]."' $ ".$array[$renglones][2]."</li>";
	
	

	}

  
}else
	echo "<li class='texto_lista_chico'>No hay Sugerencias</li>";

	
echo "</ul>";
?>