<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	encabezado_test();
?>
			<h2>Almacén</h2>
				<section>
					<?

					$link=conect();
	$pantalla=new Pantalla();
	$pantalla->conexion($link);
	$array=$pantalla->obtiene_pantalla($_SESSION["perfil"],"ALMACÉN");
    
    $cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{

			crea_article($array[$renglones][0],$array[$renglones][2],"",$array[$renglones][1]);	
			 
		}

/*"compra_busqueda_usuario_almacen.php","ordenold","", "ENTRADAS");
crea_article("almacen_inventario.php","inventarioold","", "INVENTARIO");
crea_article("SALIDAS.php","orden","", "SALIDAS");
crea_article("material_sinstock_busqueda.php","cliente","", "MATERIAL SIN STOCK");
crea_article("almacen_busqueda.php","almacen","", "ALMACEN Y TALLER");
crea_article("material_busqueda.php","material","", "PRODUCTO Y MATERIAL");
*/
?>
				</section>
<!--


				<ul>
						<table>

 PRIMER BLOQUE 

						<tr>

						<td>
							<li>
								<a href="compra_busqueda_usuario_almacen.php" title="Ordenes de Salida">
								<img src="public/images/ordenold.png" alt="Actualizar" class="imagecat" />

							<span with='200'>ENTRADAS</span>

								</a>

								</li>

						</td>
						
				
						<td>
							<li>
								<a href="almacen_inventario.php" title="Inventario">
								<img src="public/images/inventarioold.png" alt="Actualizar" class="imagecat" />
							INVENTARIO                        
								</a>
							</li> 
						</td>

						<td>
							<li>
								<a href="almacen_orden_salida.php" title="Ordenes de Salida">
								<img src="public/images/orden.png" alt="Actualizar" class="imagecat" />

							<span with='200'>SALIDAS</span>

								</a>

								</li>

						</td>



					</tr>


		
		<tr>	
			<td>
							<li>
								<a href="material_sinstock_busqueda.php" title="Material por Stock">
								<img src="public/images/cliente.png" alt="Actualizar" class="imagecat" />
							                 
							<span with='200'>MATERIAL SIN STOCK   </span>    
						</a>
							</li> 
						</td>
						
						<td>
							<li>
								<a href="almacen_busqueda.php" title="Almacénes en Diferentes Localidades">
							<img src="public/images/almacen.png" alt="Actualizar" class="imagecat" />
							ALMACEN Y TALLER                    </a>
							</li> 
						</td>


						<td>
							<li>
								<a href="material_busqueda.php" title="Productos y Materiales">
								<img src="public/images/material.png" alt="Actualizar" class="imagecat" />
							PRODUCTO Y MATERIAL                        </a>
							</li> 
						</td>

		</tr>	


 TERCER BLOQUE


</table>
	</ul>
 -->
<?
//Inicia Pie de Página
piepagina();
?>


