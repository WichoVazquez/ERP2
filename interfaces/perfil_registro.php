<?// Inicia Página
require_once("index_header.php");
  $user=sesiones_start();
  librerias();
  scripts_head("../Clases/javascript/nuevo_perfil.js");
  encabezado();
?>
		<H2>
<a  href="perfil_busqueda.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
			Nuevo Perfil</H2>
<div>
		<DIV id="panelPerfil" style="padding-top:10px;">
			<form><fieldset>
				<label class="ui-widget" for="nombre"> Nombre: </label>
				<input type="text" name="nombre" id="nombre" style='width:300px;' maxlength='100'>
				<br>
				<LABEL class="ui-widget" for="descripcion1">Descripción:</LABEL>
	<br>
				<input type="text"  id="descripcion" name="descripcion" style="height:50px; width:450px;" maxlength="500">
				<br>
			</fieldset></form>
		</DIV>
		<button id="add_pantallas">Agregar Permisos </button>
		
<div id="botones" style="padding-top:10px;">
			<BUTTON id="guardar-perfil" title="Guardar cambios">Guardar</BUTTON>

		</div>	
		<FOOTER class="footer">
			<P>&copy; 3013 Mogel Fluídos, S.A. de C.V., Todos los derechos reservados.::..</P>
		</FOOTER>
	
		<DIV id="dialog-form" title="Ingresar Permisos">
			<form> <fieldset>
						<?
											
						require_once("../Clases/Conexion/conexion_prueba_local.php");
						require_once("../Clases/Objetos/pantalla.php");
						$link=conect();
						$pantalla=new Pantalla();
						$pantalla->conexion($link);
						$PagAct=1;
						$array=$pantalla->busqueda_All();

					?>
			</fieldset> </form>
		</DIV>	
 </div>			

</BODY>
</HTML>

	