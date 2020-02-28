<?
	
	$cliente=$_POST['cliente'];
	require("../Objetos/sucursal.php");
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$sucursal=new Sucursal();
	$sucursal->conexion($link);
	$array=$sucursal->busqueda_sucursal_id($cliente);
	echo "<ul style='margin:0;padding:0;list-style-type:none;list-style-position:outside; background-color:#FFF; height:100px;'>";
	$cliente=$_POST['cliente'];
	if($array!=null)
	{
   
   
 	for($renglones=0; $renglones<count($array);$renglones++)
	{

    echo"<li><a href=\"javascript:ponerValorSucursal({id:'".$array[$renglones][0]."', desc:'".$array[$renglones][1]."'}
    )\" class='texto_lista_chico'>".$array[$renglones][1]."</li>";
	
	

	}

  
}else
	echo "<li class='texto_lista_chico'>No hay Sugerencias</li>";

	
echo "</ul>";
?>