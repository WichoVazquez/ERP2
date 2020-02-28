<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$_POST['search'] = trim($_POST['search']); 
	$id=$_POST['search'];
	require("../Objetos/detalle_ordencompra.php");
	require("../Objetos/unidad.php");
	$link=conect();
	
	$detalle=new detalle_ordencompra();
	$detalle->conexion($link);
	$array=$detalle->busqueda_detalle($id);
	$total=0;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "<table class='myTable'>
						<th>Producto</th>
						<th>Unidad</th>
						<th>Cantidad</th>
						<th>Precio</th>
						<th>Monto</th>
						<th>Promoción</th>
						<th>Observaciones</th>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
       {
                $preciounit=$arrdet[$renglones][4];
                $preciototal=$preciounit;
                $total+=$preciototal;
                echo "<tr>";              
                echo "<td><input type='checkbox' value='".$arrdet[$renglones][0]."'></td>".//detalle_cotizacion_id
                "<td>" .$arrdet[$renglones][1]. "</td>". //producto_id
                "<td>" .$arrdet[$renglones][5]. "</td>". //material_descripcion
                "<td>" .$arrdet[$renglones][2]. "</td>". //cantidad
                "<td>" .$arrdet[$renglones][6]. "</td>". //prefijo
                "<td title='".$arrdet[$renglones][4]."' multip='".$arrdet[$renglones][6]."'>".number_format($preciounit, 2, '.', ''). "</td>" .
                "<td>".number_format($preciototal, 2, '.', '')."</td>".
                "</tr>";
        }
						echo "</table>";
						
	}
	else
	{
		echo "Búsqueda sin Resultados";
	}
			
		
?>