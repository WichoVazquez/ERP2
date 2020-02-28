<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	encabezado_test();
?>
			<h2>
				<a  href="CATALOGOS.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>

				Usuarios</h2>

				<section>
					<?

					$link=conect();
	$pantalla=new Pantalla();
	$pantalla->conexion($link);
	$array=$pantalla->obtiene_pantalla($_SESSION["perfil"],"USUARIO");
    
    $cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{

			crea_article($array[$renglones][0],$array[$renglones][2],"",$array[$renglones][1]);	
			 
		}
					/*
crea_article("usuario_busqueda.php","usuario","", "USUARIOS");
crea_article("perfil_busqueda.php","perfiles","", "PERFILES");
crea_article("pantalla_busqueda.php","pantalla","", "PANTALLA");
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
											<a href="usuario_busqueda.php" title="Ususarios del sistema">
										<img src="public/images/usuario.png" alt="Actualizar" class="imagecat" />
							USUARIO                        </a>
									</li> 

						</td>
						<td>					
									<li>
						<a href="perfil_busqueda.php" title="Perfiles de Usuarios">
							<img src="public/images/perfiles.png" alt="Actualizar" class="imagecat" />
							PERFILES                        </a>
					</li> 
									

						</td>
						<td>					
									<li>
						<a href="pantalla_busqueda.php" title="Perfiles - Pantallas">
							<img src="public/images/pantalla.png" alt="Actualizar" class="imagecat" />
							PANTALLA                        </a>
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


