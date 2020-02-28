<?

 if(!isset($_SESSION['user']))
{
  require("../Clases/Sesion/checarSesion.php");
  checarSesion();
  //checa perfil de usuario
}
 $user=$_SESSION['user'];
 

require_once("index_header.php");
  $user=sesiones_start();
  librerias();
  librerias_dateP();
  scripts_head("../Clases/javascript/facturar.js");

  encabezado_BIG();
  ?>


      <h2>

        <a  href="FACTURACION.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>
        Órdenes para Facturar</h2>
<p></p>
 <div>
  <form action="generar_reporte_facturacion.php" method="post"/> 
  <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')">
    <input type="submit" value="Generar Reporte">
  </form>
<?
   require("../Clases/Objetos/empresa.php");
   require_once("../Clases/Conexion/conexion_prueba_local.php");
   $link=conect();
   $empresa=new Empresa();
   $empresa->conexion($link);
   $array=$empresa->busqueda_parametros("",0,10);
   echo "<LABEL class='ui-widget' for='empresa'>Empresa:</LABEL>
   <select name='empresa' id='empresa' class='ui-widget' style='max-width:250px;' onChange='selectEmpresa(this)'>";
   if($array!=null)
   {
    
     for($renglones=0; $renglones<count($array);$renglones++)
     {
       echo "<option value='".$array[$renglones][0]."'>".$array[$renglones][1]."</option>";
     }
   }
   else
   {
    echo "<option value='0'>Sin Resultados</option>";
   }
   echo "</select>";
   
?>

</DIV>
 <BR>

 <div id='sentencias' class='content'>
   <?
 
  require_once("../Clases/Objetos/facturar.php");
 
  $factura=new Facturar();
  $factura->conexion($link);
  $RegistrosAMostrar=30;//esto deberia ser dinamico, tiempo??
  $RegistrosAEmpezar=0;
  $PagAct=1;
  $filter=3;
 $array=$factura->busqueda_parametros_usuario( "", $RegistrosAEmpezar, $RegistrosAMostrar, $filter);
    
  if($array!=null)
  { 
     //echo "".count($array);
     echo "
        <table class='myTable'>
            <th>GUÍA</th>
            <th>O.S.</th>
            <th>RAZON SOCIAL</th>
            <th>EMPRESA</th>
            <th>STATUS</th>
            <th></th>            
          ";
    for($renglones=0; $renglones<count($array);$renglones++)
    {
          echo "<tr>";
                echo "<td>".$array[$renglones][7]."</td>";
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
     echo "<td><a href='factura_crear.php?id=".$array[$renglones][6]."&cliente=".$array[$renglones][1]."&empresa=".$array[$renglones][2]."&noCot=".$array[$renglones][4]."&idcliente=".$array[$renglones][5]."&folioOE=".$array[$renglones][7]."&folioOS=".$array[$renglones][0]."'>FACTURAR</a></td>"; 

                
                
            echo "</tr>";
       
    }
            echo "</table>";
            $NroRegistros=$factura->cuenta_resultado_usuario("",$filter);
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
</div>



 
<?
//Inicia Pie de Página
piepagina();
?>
