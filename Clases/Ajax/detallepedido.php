<?
	require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$_POST['search'] = trim($_POST['search']); 
	$id=$_POST['search'];
	require("../Objetos/pedido.php");
	require("../Objetos/unidad.php");
	$link=conect();
	
	$detalle=new Pedido();
	$detalle->conexion($link);
	$array=$detalle->detalle_pedido($id);
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
						<th>Observaciones</th>
					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{			
				
					$precio=$array[$renglones][4]*$array[$renglones][6];//precio*multiplo
					$monto=$precio*$array[$renglones][2];//precio*cantidad
					$total+=$monto;
					//$promocion=$array[$renglones][6]-1;
					//$promocion*=100;
					//$uniarray=$unidad->detalle_id($matarray[2]);
					//$promocion=$array[$renglones][6]mod1
					//if (($promocion/1)<1) $promocion=promocion*-1
					echo "<tr>";
								
								echo "<td title='".$array[$renglones][1]."'>".$array[$renglones][7]."</td>";//descripcion producto(id_producto)
								echo "<td>".$array[$renglones][8]."</td>"; //unidad
								echo "<td>".$array[$renglones][2]."</td>";//cantidad
								echo "<td>".number_format($precio, 2, '.', '')."</td>";//precio
								echo "<td>".number_format($monto, 2, '.', '')."</td>";//monto
								echo "<td>".$array[$renglones][5]."</td>";//Observaciones
						echo "</tr>";
			 
		}
						echo "</table>";
						echo "Total:".number_format($total, 2, '.', '');
						
	}
	else
	{
		echo "Error en cargar detalle del Pedido";
	}
			
		
?>