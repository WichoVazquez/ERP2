<?
if(!isset($_SESSION['user']))
{
  require("../Sesion/checarSesion.php");
  checarSesion();
  //checa perfil de usuario
}
 $user=$_SESSION['user'];
 
  require("../Conexion/conexion_prueba_local.php");
	$link=conect();
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	if(isset($_POST['pag'])){
		  $RegistrosAEmpezar=($_POST['pag']-1)*$RegistrosAMostrar;
		  $PagAct=$_POST['pag'];
	
	}else{
		$RegistrosAEmpezar=0;
		$PagAct=1;
	}
	
	if(isset($_POST['filtro'])){
		  $filter=$_POST['filtro'];
	
	}else{
		$filter=$_POST['filtro'];
	}
	$_POST['search'] = trim($_POST['search']); 
	$search=$_POST['search'];
	
	require("../Objetos/facturar.php");
  $factura=new Facturar();
  $factura->conexion($link);
 $array=$factura->busqueda_parametros_usuario($search, $RegistrosAEmpezar, $RegistrosAMostrar, $filter);
    
   
  if($array!=null)
  { 
     //echo "".count($array);
     echo "
        <table class='myTable'>
            <th>PEDIDO</th>
            <th>RAZON SOCIAL</th>
            <th>EMPRESA</th>
            <th>STATUS</th>
            <th></th>            
          ";
    for($renglones=0; $renglones<count($array);$renglones++)
    {
          echo "<tr>";
                
                echo "<td>".$array[$renglones][0]."</td>";
                echo "<td>".$array[$renglones][1]."</td>";
                echo "<td>".$array[$renglones][2]."</td>";
                
    
  echo "<td>";
      switch($array[$renglones][3])
      {
        case 0:echo "Confirmado";break;
        case 1:echo "Entregado";break;
        case 2:echo "Cancelado";break;
      }
      echo "</td>";
echo "<td><a href='factura_crear.php?id=".$array[$renglones][0]."&cliente=".$array[$renglones][1]."
     &empresa=".$array[$renglones][2]." &noCot=".$array[$renglones][4]." &idcliente=".$array[$renglones][5]."' >FACTURAR</a></td>"; 

                
            echo "</tr>";
       
    }
            echo "</table>";
            $NroRegistros=$factura->cuenta_resultado_usuario($search, $filter);
          $PagAnt=$PagAct-1;
          $PagSig=$PagAct+1;
          $PagUlt=$NroRegistros/$RegistrosAMostrar;
          $Res=$NroRegistros%$RegistrosAMostrar;

          if($Res>0) $PagUlt=floor($PagUlt)+1;
          
          //desplazamiento
          if($PagAct>1) echo "<a onclick=\"Pagina('$PagAnt')\"  style=\"text-decoration:none;
          cursor:pointer;\"><img src='../imagenes/carousel_previous_button.gif'/></a> ";
           if($PagAct<$PagUlt) echo " <a onclick=\"Pagina('$PagSig')\" style=\"text-decoration:none;cursor:pointer;\"><img src='../imagenes/carousel_next_button.gif'/></a> ";
           
           echo "<strong>Pagina ".$PagAct." de ".$PagUlt."</strong>&nbsp;";
           echo "<a onclick=\"Pagina('1')\" class=\"link_regreso\" style=\"text-decoration:none;
           cursor:pointer;\">Primero &nbsp;</a> ";
           echo "<a onclick=\"Pagina('$PagUlt')\" class=\"link_regreso\" style=\"text-decoration:none;
           cursor:pointer;\">Ultimo &nbsp;</a>
           <br>";
  }
  else
  {
    echo "Búsqueda sin Resultados";
  }
  
 ?>
