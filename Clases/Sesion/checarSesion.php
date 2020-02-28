<?php
    function checarSesionInicio()
    {
        session_start();
        if(!isset($_SESSION["user"]))
        {
            session_destroy();
            header("location:interfaces/login.php");
            exit;
        }

    }
	function checarSesion()
    {
        session_start();
        if(!isset($_SESSION["user"]))
        {
            session_destroy();
            header("location:../interfaces/login.php");
            exit;
        }

    }
	
	function cerrarSesion()
	{	
		
		session_destroy();
	}
	
	/*function checarSession()
    {
        session_start();
        if(!isset($_SESSION["user"]))
        {
            session_destroy();
 
        }

    }*/
	
	function usuario_almacen()
    {
        session_start();
        if(!isset($_SESSION["user"]))
        {
            session_destroy();
 
        }
		else
		{
			
		}

    }

?>
