<?// Inicia Página
require_once("index_header.php");

	librerias();
	encabezado_login();
?>



<div class="container">
	<section id="content">
		

		<form action="../Clases/Sesion/iniciarsesion.php" target="_self" method="POST">

 <?php   
    if(isset($_GET["error"]))
	  {
		switch ($_GET["error"])
		{
		case 1:
					echo"<p><FONT color=\"RED\" face=\"arial\" size=\"-1\">Usuario y/o Contrase&ntilde;a Incorrectos</font></p>";
					break;
		case 2:
					echo"<p><FONT color=\"RED\" face=\"arial\" size=\"-1\">Favor de confirmar Usuario</font></p>";
					break;	
		case 3:
					require("../Clases/Sesion/checarSesion.php");
					cerrarSesion();



			}
		   
	  }
	?>


			<h1>Login</h1>
			<div>
				<input type="text" placeholder="Usuario" required="" id="username" name="id" />
			</div>
			<div>
				<input type="password" placeholder="Password" required="" id="password" name="pass" />
			</div>
			<div>
				<input type="submit" value="Entrar" />
				<a href="#">Recuperar Password?</a>
			</div>
		</form><!-- form -->

	</section><!-- content -->
</div><!-- container -->
</body>


