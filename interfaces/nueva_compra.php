

<?// Inicia Página

require_once("index_header.php");
 $user=sesiones_start();
  librerias();
  scripts_head("../Clases/javascript/nueva_ordencompra.js");

  encabezado();
 $id=$_GET["id"];
 

?>

  <script>
  $(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
  });



  </script>


<H2>
<a  href="compra_busqueda_usuario_almacen.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>
  Nueva Requisición de Compra</H2>
  <DIV id="varcot">
<?
//aqui le asigno a un input invisible el usuario y el no. de cotizacion
echo "<input id='usuario' value='".$user."'/>";
echo "<input id='cotizacion' value=''/>";
echo "<input id='folio' value='0'/>";
?>  
</DIV>  
<p><LABEL class="ui-widget" for="datepicker"> Fecha Requerida: <input name="datepicker" type="text" id="datepicker" /></p>

<br>
<LABEL class="ui-widget" for="orden_mensaje">Observaciones:</LABEL>
<br>
<TEXTAREA id="orden_mensaje" style="width:450px;" maxlength="500"></TEXTAREA>
<br>
<br>
<div id="sentencias" class="content">
 <?
    require_once("../Clases/Conexion/conexion_prueba_local.php");
require_once("../Clases/Objetos/material.php");
  require_once("../Clases/Objetos/almacen_material.php");
 $link=conect();
  $material=new Material();
  $material->conexion($link);
  $almacen_material=new Almacen_material();
  $almacen_material->conexion($link);
  $RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
  $RegistrosAEmpezar=0;
  $PagAct=1;
  $array=$almacen_material->busqueda_parametros_pruebasMSS($id, $RegistrosAEmpezar, $RegistrosAMostrar);

 //echo "id ".$id;
  if($array!=null)
  { 
     //echo "".count($array);
     echo "
        <table class='myTable' id='prueba_compra'>
          
            <th></td>

            <th>ID</td>
            
            <th>Material</td>
            <th>Cantidad</td>
            <th>Stock Mínimo</td>
            
        ";
          $cont=0;
    for($renglones=0; $renglones<count($array);$renglones++)
    {
      $prueba=$array[$renglones][0];
          echo "<tr>";
            echo "<td><input type='checkbox' name='checkmaterial' value='".$array[$renglones][0]."' idedit='".$array[$renglones][0]."' checked></td>";
            echo "<td>".$array[$renglones][0]."</td>";
              
              echo "<td>".$array[$renglones][2]."</td>";
              echo "<td><input type='text' name='cantidad' value='1' size='5'  /></td>";
              echo "<td>".$array[$renglones][4]."</td>";
              
      /*        echo "<td class='texto_chico_tabla'><a href=\"javascript:detalle_material(".$array[$renglones][0].")\">Ver</a></td>"; */
              
            echo "</tr>";
       
    }
            echo "</table>";

            


  }
  else
  {
    echo "Búsqueda sin Resultados";
  }
  
  
 ?>
 </div>
<DIV id="divguardar" style="padding-top:10px; padding-bottom:10px;">
<BUTTON id="guardar-orden">Guardar</BUTTON>

</DIV>


<?
//Inicia Pie de Página
piepagina();
?>
