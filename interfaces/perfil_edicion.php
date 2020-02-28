<?// Inicia Página
	require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/nuevo_perfil.js");
	encabezado();
?>

<?php
	require("../Clases/Objetos/perfil.php");
	require_once("../Clases/Conexion/conexion_prueba_local.php");
	$link=conect();
	$perfil=new Perfil();
	$perfil->conexion($link);
	if(!isset($_POST['Guardar'])){
		$id=$_GET['id'];
		$array=$perfil->detalle($id);
	}
?>

		<H2><a  href="perfil_busqueda.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>Editar Perfil</H2>
<div>
		<DIV id="panelPerfil" style="padding-top:10px;">
			<form><fieldset>
				<label class="ui-widget" for="nombre"> Nombre: </label>
		<? echo "<input type='text' name='nombre' id='nombre' maxlength='300' style='width:300px;' value='".$array[1]."'>"; ?>
				<br>
				<LABEL class="ui-widget" for="descripcion">Descripción:</LABEL>
				<br>
		<? echo "
				<input type='text' id='descripcion' style='width:450px;' maxlength='150' value='".$array[2]."'>"; ?>
				<br>
			</fieldset></form>
		</DIV>
		<button id="add_pantallas">Editar Permisos </button>
		<div id="botones" style="padding-top:10px;">
			<?
			echo "<BUTTON id='guardar-perf'  onClick='editarPerfil(".$_GET['id'].")'>Guardar</BUTTON>";
			?>

		</div>	
		<FOOTER class="footer">
			<P>&copy; 3013 Mogel Fluídos, S.A. de C.V., Todos los derechos reservados.::..</P>
		</FOOTER>
	
		<DIV id="dialog-form" title="Ingresar Permisos">
			<form> <fieldset>
			
					<?				
						
						//require_once("../Clases/Conexion/conexion_prueba_local.php");
					//	require("../Clases/Objetos/pantalla.php");
						$link=conect();
						$pantalla=new Pantalla();
						$pantalla->conexion($link);
						$PagAct=1;
						$array=$pantalla->busqueda_Perfil($id);

					?>
				
					</fieldset> </form>
		</DIV>
 </div>			

</BODY>
</HTML>

