<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	encabezado_test();
?>
			<h2>Laboratorio</h2>
				<section>
					<?

$link=conect();
	$pantalla=new Pantalla();
	$pantalla->conexion($link);
	$array=$pantalla->obtiene_pantalla($_SESSION["perfil"],"LABORATORIO");
    
    $cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{

			crea_article($array[$renglones][0],$array[$renglones][2],"",$array[$renglones][1]);	
			 
		}
//crea_article("calidad_busqueda.php","proveedor","", "ORDENES DE SALIDA");


?>
				</section>
<!--				<ul>
						<table>

 PRIMER BLOQUE

						<tr>


						<td>
							<li>
								<a href="calidad_busqueda.php" title="Control de Calidad">
								<img src="public/images/proveedor.png" alt="Actualizar" class="imagecat" />
						ORDENES DE SALIDA
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
