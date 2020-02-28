<?
	
	$cliente=$_POST['cliente'];
	require("../Objetos/contacto_ventas.php");
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$contacto=new Contacto_Ventas();
	$contacto->conexion($link);
	$array=$contacto->busqueda_contacto_id($cliente);
	echo "<ul style='margin:0;padding:0;list-style-type:none;list-style-position:outside; background-color:#FFF; height:100px;'>";
	$contacto=$_POST['contacto'];
	$cliente=$_POST['cliente'];
	if($array!=null)
	{
   
   
 	for($renglones=0; $renglones<count($array);$renglones++)
	{

    echo"<li><a href=\"javascript:ponerValorContacto({id:'".$array[$renglones][0]."', desc:'".$array[$renglones][1]."&nbsp;".$array[$renglones][2]."&nbsp;".$array[$renglones][3]."'}
    	)\" class='texto_lista_chico'>".$array[$renglones][1]."&nbsp;".$array[$renglones][2]."&nbsp;".$array[$renglones][3]."</li>";
	

	}

  
}else
	echo "<li class='texto_lista_chico'>No hay Sugerencias</li>";

	
echo "</ul>";
?>