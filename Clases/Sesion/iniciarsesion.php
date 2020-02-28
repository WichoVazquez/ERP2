<?php
    require_once("../Conexion/conexion_prueba_local.php");
    require_once("../Objetos/usuario.php");

    $link=conect();
    $usuario=new Usuario();
    $usuario->conexion($link);
    $row=$usuario->ingresar($_POST['id'], $_POST['pass']);
    
    if($row==null)
    {
        $link="../../interfaces/login.php?error=1";
    }
    else
    {
		
        session_destroy();
		 
        $user=$row[0];
       // $rol=$row[4];
		$perfil=$row[2];
        $perfil_nombre = $row[3];

		session_cache_limiter('private');
		$cache_limiter = session_cache_limiter();
		session_cache_expire(30);
		$cache_expire = session_cache_expire();
        session_start();
	    //declaro las variables de la sesion       	       
     	$_SESSION['user']=$user;
		$_SESSION['perfil']=$perfil; 
        $_SESSION['perfil_nombre']=$perfil_nombre; 

       	$link="../../interfaces/inicio.php";
        
    }
         echo"<script>document.location=\"$link\";</script>";
		
?>
