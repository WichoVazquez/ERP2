<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	encabezado_test();
?>
			<h2>
				<a  href="VENTAS.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Clientes</h2>
	<section>
					<?

$link=conect();
	$pantalla=new Pantalla();
	$pantalla->conexion($link);
	$array=$pantalla->obtiene_pantalla($_SESSION["perfil"],"CLIENTE");
    
    $cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{

			crea_article($array[$renglones][0],$array[$renglones][2],"",$array[$renglones][1]);	
			 
		}
					/*
crea_article("cliente_busqueda.php","5","", "CLIENTES");
crea_article("matriz_sucursal_busqueda.php","proveedor","", "LUGARES DE DESTINO");
*/


?>
<!--				<ul>
						<table>

 PRIMER BLOQUE

						<tr>


				
						<td>
							<li>
								<a href="cliente_busqueda.php" title="Clientes">
								<img src="public/images/5.png" alt="Actualizar" class="imagecat" />
							CLIENTES                        </a>
							</li> 
						</td>

						<td>
									<li>
											<a href="matriz_sucursal_busqueda.php" title="Destinos">
										<img src="public/images/proveedor.png" alt="Actualizar" class="imagecat" />
							LUGARES DE DESTINO                        </a>
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


