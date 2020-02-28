      
<?php


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
  $_POST['search'] = trim($_POST['search']); 
  $search=$_POST['search'];

  require_once("../Objetos/almacen-taller.php");
  $link=conect();
  $almacen_taller=new Almacen_Taller();
  $almacen_taller->conexion($link);
  $RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
  $RegistrosAEmpezar=0;
  $PagAct=1;
  $array=$resultSolicitudes=$almacen_taller->resultSolicitudes($search, $RegistrosAEmpezar, $RegistrosAMostrar);
  ; //echo $;

 
  if($array!=null)
  {
  
    echo "  
      
      
    <table class='myTable'> 
  
      <th>Folio</th>

   <th>Fecha de creacion</th>
   <th>Almacén Solicitado</th>
   <th> DETALLE </th>
   <th>Status</th>

      ";

  for($renglones=0; $renglones<count($array);$renglones++)
    {
          echo "<tr>";
                
                echo "<td>".$array[$renglones][0]."</td>";


        echo "<td>".$array[$renglones][1]."</td>";
        echo "<td><center>".$array[$renglones][3]."</center></td>";
        echo "<td>";
        switch($array[$renglones][4])
        {
         
         case 1: echo "<a href=\"javascript:cambiar_status({id:'".$array[$renglones][0]."', nombre:'".$array[$renglones][0]."', cantidad:'".$array[$renglones][3]."', almacen_material_id:'".$array[$renglones][0]."', status:'".$array[$renglones][0]."'})\">Pendiente</a>";break;
         case 2: echo "Surtido";break;

        }
        echo "</td>";
          echo "<td><center><a href=\"javascript:detalleRuta(".$array[$renglones][0].")\">DETALLE</a></center></td>";
            echo "</tr>";
       
    }
            echo "</table>";        
          $NroRegistros=$almacen_taller->cuenta_resultado("");
          $PagAnt=$PagAct-1;
          $PagSig=$PagAct+1;
          $PagUlt=$NroRegistros/$RegistrosAMostrar;
          
          //verificamos residuo para ver si llevará decimales
          $Res=$NroRegistros%$RegistrosAMostrar;
          // si hay residuo usamos funcion floor para que me
          // devuelva la parte entera, SIN REDONDEAR, y le sumamos
          // una unidad para obtener la ultima pagina
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
  