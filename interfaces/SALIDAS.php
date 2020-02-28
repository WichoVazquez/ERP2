<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	encabezado_test();
?>
			<h2>
<a  href="ALMACEN.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>


				Salidas de Almacén</h2>
				<section>
					<?
					$link=conect();
	$pantalla=new Pantalla();
	$pantalla->conexion($link);
	$array=$pantalla->obtiene_pantalla($_SESSION["perfil"],"SALIDAS DE ALMACÉN");
    
    $cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)	
		{

			crea_article($array[$renglones][0],$array[$renglones][2],"",$array[$renglones][1]);	
			 
		}

					/*
crea_article("almacen_orden_salida.php","orden","", "ORDENES DE SALIDA");
crea_article("almacen_solicitud_material_busqueda.php","pantalla","", "SOLICITUDES DE MATERIAL");
crea_article("almacen_vales_consumo_busqueda.php","noticias","", "VALES DE CONSUMO");

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
								<a href="taller_ordenes_salida.php" title="Ordenes de Salida">
								<img src="public/images/orden.png" alt="Actualizar" class="imagecat" />
							ORDENES DE SALIDA                        </a>
							</li> 
						</td>

						<td>
									<li>
											<a href="taller_solicitud_material.php" title="Solicitud de Material">
										<img src="public/images/pantalla.png" alt="Actualizar" class="imagecat" />
							SOLICITUD DE MATERIAL                        </a>
									</li> 

						</td>
							<td>
									<li>
											<a href="taller_vales_consumo.php" title="Vale de Consumo">
										<img src="public/images/noticias.png" alt="Actualizar" class="imagecat" />
							VALE DE CONSUMO                        </a>
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


