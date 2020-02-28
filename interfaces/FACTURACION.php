<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	encabezado_test();
?>
			<h2>FACTURACION</h2>
				<section>
					<?

$link=conect();
	$pantalla=new Pantalla();
	$pantalla->conexion($link);
	$array=$pantalla->obtiene_pantalla($_SESSION["perfil"],"FACTURACION");
    
    $cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{

			crea_article($array[$renglones][0],$array[$renglones][2],"",$array[$renglones][1]);	
			 
		}
//crea_article("factura_busqueda.php","pantalla","", "FACTURAR");

?>
<!--				</section>
				<ul>
						<table>



						
				
						


						<td>
							<li>
								<a href="factura_busqueda.php" title="Generar Factura">
								<img src="public/images/pantalla.png" alt="Actualizar" class="imagecat" />
							FACTURAR                        </a>
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
