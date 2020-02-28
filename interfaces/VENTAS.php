<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	encabezado_test();
?>
			<h2>Ventas</h2>

				<section>
					<?

					$link=conect();
	$pantalla=new Pantalla();
	$pantalla->conexion($link);
	$array=$pantalla->obtiene_pantalla($_SESSION["perfil"],"VENTAS");
    
    $cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{

			crea_article($array[$renglones][0],$array[$renglones][2],"",$array[$renglones][1]);	
			 
		}
					/*
crea_article("cotizacion_busqueda_usuario.php","suite","", "COTIZACIONES");
crea_article("ordenes_salida_busqueda_usuario.php","orden","", "ORDENES DE SALIDA");
crea_article("recoleccion_equipo_busqueda_usuario.php","extintores","", "RECOLECCION DE EQUIPO");

crea_article("prospecto_busqueda.php","1","", "PROSPECTOS");
crea_article("CLIENTE.php","cliente","", "CLIENTES");
crea_article("contrato_busqueda.php","noticias","", "CONTRATOS");
crea_article("precios_busqueda.php","precio","", "ASIGNACION DE PRECIOS");
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
								<a href="prospecto_busqueda.php" title="Contratos">
								<img src="public/images/1.png" alt="Actualizar" class="imagecat" />
						PROSPECTOS
								</a>

								</li>

						</td>
						<td>
							<li>
								<a href="cotizacion_busqueda_usuario.php" title="Clientes">
								<img src="public/images/suite.png" alt="Cotizaciones" class="imagecat" />
							COTIZACIONES                        </a>
							</li> 
						</td>

						<td>
							<li>
								<a href="ordenes_salida_busqueda_usuario.php" title="Ordenes de Salida de Almacén">
							<img src="public/images/orden.png" alt="Ordenes de Salida" class="imagecat" />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ORDENES DE SALIDA                      </a>
							</li> 
						</td>
					</tr>


		<tr>
						<td>
							<li>
								<a href="CLIENTE.php" title="Clientes">
								<img src="public/images/cliente.png" alt="Actualizar" class="imagecat" />
							CLIENTES                        </a>
							</li> 
						</td>
						<td>
							<li>
								<a href="contrato_busqueda.php" title="Contratos">
								<img src="public/images/noticias.png" alt="Contratos" class="imagecat" />
						CONTRATOS
								</a>

								</li>
						<td>					
									<li>
						<a href="precios_busqueda.php" title="Precios">
							<img src="public/images/precio.png" alt="Actualizar" class="imagecat" />
							PRECIOS                        </a>
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


