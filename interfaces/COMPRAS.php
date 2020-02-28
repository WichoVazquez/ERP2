<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	encabezado_test();
?>
			<h2>Compras</h2>
				<section>
					<?
	$link=conect();
	$pantalla=new Pantalla();
	$pantalla->conexion($link);
	$array=$pantalla->obtiene_pantalla($_SESSION["perfil"],"COMPRAS");
    
    $cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{

			crea_article($array[$renglones][0],$array[$renglones][2],"",$array[$renglones][1]);	
			 
		}
					/*
crea_article("proveedor_busqueda.php","proveedor","", "PROVEEDORES");
crea_article("compra_busqueda_usuario.php","ordenold","", "ORDENES DE COMPRA");
*/

?>
				</section>
<!--				<ul>
						<table>

 ¿

						<tr>

						<td>
							<li>
								<a href="proveedor_busqueda.php" title="Proveedores">
								<img src="public/images/proveedor.png" alt="Actualizar" class="imagecat" />
						PROVEEDORES
								</a>

								</li>

						</td>

						<td>
							<li>
								<a href="compra_busqueda_usuario.php" title="Orden de Compras">
								<img src="public/images/ordenold.png" alt="Actualizar" class="imagecat" />
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ORDENES DE COMPRA
								</a>

								</li>

						</td>
				
						

					


					</tr>


</table>
	</ul>
 -->
<?
//Inicia Pie de Página
piepagina();
?>
