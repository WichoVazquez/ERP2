<?// Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	encabezado_test();
?>
			<h2>Administración</h2>

				<section>
					<?

					$link=conect();
	$pantalla=new Pantalla();
	$pantalla->conexion($link);
	$array=$pantalla->obtiene_pantalla($_SESSION["perfil"],"ADMIN");//$_SESSION["user"]
    
    $cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{

			crea_article($array[$renglones][0],$array[$renglones][2],"",$array[$renglones][1]);	//echo "<li><a href='".$array[$renglones][0]."' data-clone='".$array[$renglones][1]."'>".$array[$renglones][1]."</a></li>";

			
			 
		}
/*crea_article("empresa_busqueda.php","empresa","", "EMPRESAS");
crea_article("moneda_busqueda.php","moneda","", "MONEDAS");
crea_article("USUARIO.php","usuario","", "USUARIOS");*/

?>
				</section>

	<!-- P			
						<table>



						<tr>


						<td>
							<li>
								<a href="empresa_busqueda.php" title="PROMEX, DESI ..">
								<img src="public/images/empresa.png" alt="Actualizar" class="imagecat" />
							EMPRESAS                        </a>
							</li> 
						</td>
				




					

						<td>					
									<li>
						<a href="moneda_busqueda.php" title="Moneda y Tipo de Cambio">
							<img src="public/images/moneda.png" alt="Actualizar" class="imagecat" />
							MONEDAS                      </a>
					</li> 
	


						<td>
									<li>
											<a href="USUARIO.php" title="Ususarios del sistema">
										<img src="public/images/usuario.png" alt="Actualizar" class="imagecat" />
							USUARIOS                        </a>
									</li> 

						</td>
						</tr>			
					</tr>



					<tr>
 TERCER BLOQUE

					<tr>

					



						</tr>			



</table>
	</ul>

 -->

<?
//Inicia Pie de Página
piepagina();
?>
			  

