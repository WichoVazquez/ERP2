<?php
require_once('index_header.php');
librerias();
$user=sesiones_start();
encabezado_test();

?>
			<h2>TRANSPORTES</h2>
				<section>
<?php

					$link=conect();
	$pantalla=new Pantalla();
	$pantalla->conexion($link);
	$array=$pantalla->obtiene_pantalla($_SESSION["perfil"],"TRANSPORTES");
    
    $cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{

			crea_article($array[$renglones][0],$array[$renglones][2],"",$array[$renglones][1]);	
			 
		}

/*					
crea_article("logistica_busqueda.php","9","", "ASIGNACIÓN DE RUTAS");
crea_article("entrega_busqueda.php","proveedor","", "ORDENES DE ENTREGA");
crea_article("transporte_busqueda.php","transporte","", "TRANSPORTES");
crea_article("operador_busqueda.php", "operador","", "OPERADORES");*/


?>
							</section>
				<!--
				<ul>
						<table>

 

						<tr>


						<td>
							<li>
								<a href="logistica_busqueda.php" title="Rutas">
								<img src="public/images/9.png" alt="Actualizar" class="imagecat" />
						RUTAS								</a>								</li>						</td>
				<td>
							<li>
								<a href="entrega_busqueda.php" title="Entrega">
								<img src="public/images/proveedor.png" alt="Actualizar" class="imagecat" />
						ORDENES DE ENTREGA								</a>								</li>						</td>

					</td>

											</td>
												<td>
							<li>
								<a href="transporte_busqueda.php" title="Transportes">
								<img src="public/images/transporte.png" alt="Actualizar" class="imagecat" />
							TRANSPORTES                        </a>
							</li> 
						</td>	



					</tr>


</table>
	</ul>
 -->
<?php
//Inicia Pie de Página
piepagina();
?>
