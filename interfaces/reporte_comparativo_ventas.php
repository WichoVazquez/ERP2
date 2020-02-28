

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
  scripts_google("https://www.google.com/jsapi");
  scripts_head("../Clases/javascript/reportesventas.js");
  
  encabezado_BIG();

?>

<?
  echo "<input id='usuario' type='hidden' value='".$user."'/>";
?>

<script type="text/javascript">

  $(function() {
 var fecha = $( "#datepicker" ).datepicker({dateFormat: 'dd/mm/yy'}).val();
  $( "#datepicker2" ).datepicker({dateFormat: 'dd/mm/yy'}).val();
  
  
  });


</script>


 
<div class='categoryboxBIG'>
      <h2>Reporte de Ventas</h2>
<p></p>

<?
   require("../Clases/Objetos/empresa.php");
   require_once("../Clases/Conexion/conexion_prueba_local.php");
   $link=conect();
   $empresa=new Empresa();
   $empresa->conexion($link);
   $array=$empresa->busqueda_parametros("",0,10);
   echo "<LABEL class='ui-widget' for='empresa'>Empresa:</LABEL>
   <select name='empresa' id='empresa' class='ui-widget' style='max-width:300px;' onChange='selectEmpresa(this)'>";
   if($array!=null)
   {
     //echo "<option value='0'>-Todas-</option>";
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
<br>
<br>

<div id="selec">
  <label for="filter-criterio" class="ui-widget" >Selecciona un criterio</label>
  <select id="filter-criterio" onchange="cambiarCriterio(0)">

 <option value="0" selected>Por rango de días</option>
 <option value="1">Por Periodo</option>
</select>



<label id="label-date1" for="datepicker" style="padding-left:40px;">Fecha:</label>
<input type="text" name="datepicker" id="datepicker" />

<label id="label-date2" for="datepicker2" style="padding-left:40px;">Fecha: </label>
<input type="text" name="datepicker2" id="datepicker2" />


<label id="label-fmes" for="filter-mes">Mes</label>

<select id="filter-mes">
 <option value="0">Todo el Año</option>
 <option value="1">Enero</option>
 <option value="2">Febrero</option>
 <option value="3">Marzo</option>
 <option value="4">Abril</option>
 <option value="5">Mayo</option>
 <option value="6">Junio</option>
 <option value="7">Julio</option>
 <option value="8">Agosto</option>
 <option value="9">Septiembre</option>
 <option value="10">Octubre</option>
 <option value="11">Noviembre</option>
 <option value="12">Diciembre</option>
</select>
<label id="label-fano" for="filer-ano">Año</label>
<select id="filter-ano">
 <option value="2013">2013</option>
 <option value="2014">2014</option>
 <option value="2015">2015</option>
 <option value="2016">2016</option>
 <option value="2017">2017</option>
 <option value="2018">2018</option>
 <option value="2019">2019</option>
 <option value="2020">2020</option>
 </select>
 <label id="label-fmes-nuevo" for="filter-mes-nuevo">Mes</label>

 <select id="filter-mes-nuevo">
 <option value="0">Todo el Año</option>
 <option value="1">Enero</option>
 <option value="2">Febrero</option>
 <option value="3">Marzo</option>
 <option value="4">Abril</option>
 <option value="5">Mayo</option>
 <option value="6">Junio</option>
 <option value="7">Julio</option>
 <option value="8">Agosto</option>
 <option value="9">Septiembre</option>
 <option value="10">Octubre</option>
 <option value="11">Noviembre</option>
 <option value="12">Diciembre</option>
</select>
<label id="label-fano-nuevo" for="filer-ano-nuevo">Año</label>
<select id="filter-ano-nuevo">
 <option value="2013">2013</option>
 <option value="2014">2014</option>
 <option value="2015">2015</option>
 <option value="2016">2016</option>
 <option value="2017">2017</option>
 <option value="2018">2018</option>
 <option value="2019">2019</option>
 <option value="2020">2020</option>
 </select>

<br>
<div id="filtros_1">
<br>
<LABEL class="ui-widget" for="cliente">Cliente:</LABEL>
<INPUT type="text" name="cliente" id="cliente" class="text ui-widget-content ui-corner-all" onKeyUp="showResultCliente(this.value)" width="300px"  idcliente=0 style="width:300px"  />
<DIV id="livecliente" class="texto_lista_chico" style="width:400px; position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100;"></DIV>
<br>
<br>

<INPUT type="hidden" name="vendedor" id="vendedor" class="text ui-widget-content ui-corner-all" onKeyUp="showResultVendedor(this.value)" width="200px"  style="width:300px" idvendedor=0 />
<DIV id="livevendedor" class="texto_lista_chico" style="width:400px; position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100;"></DIV>
<!--  A QUI VA EL DETALLE DE LAS COTIZACIONES-->

<div id="Filtros_varios">

<!-- Estas cosas de sucursales y la ctm -->
<table>

  <tr >
   
    <td style="width:300px"><input type="checkbox" id="epv_check" name="epv_check" onChange="activatePanelTotallity(this)" value="0" checked> <LABEL class="ui-widget" for="vendedor">EPV:</LABEL></option>

    </td>
 
     <td style="width:300px"><input type="checkbox" id="mat_check" name="mat_check" value="0"  checked onChange="activatePanelTotallity(this)">   <LABEL class="ui-widget" for="producto">Tipo de Productos:</LABEL></option></td>

     <td style="width:300px"><input type="checkbox" id="ser_check" name="ser_check" value="0" onChange="activatePanelTotallity(this)"  checked><LABEL class="ui-widget" for="servicio">Servicios:</LABEL></option></td>
       

  </tr>


<tr style="">
<td style="width:300px;  "  valign='top'>

<!-- Estas cosas de sucursales y la ctm -->

    <div id="Mostrar_Vendedores">
     
    <FORM>
      <FIELDSET>
       
        <table id="Orden_vendedores" class='myTableRED'>
          <thead>
                <th> </th>
              <th>Nombre </th>


          </thead>
          <tbody>

    <?

      require_once("../Clases/Objetos/usuario_cliente.php");
      $link=conect();
      $usuario_cliente=new Usuario_cliente();
      $usuario_cliente->conexion($link);
     
      $usuario_cliente_array=$usuario_cliente->busqueda_parametros();
        
      if($usuario_cliente_array!=null)
      { 
         //echo "".count($array);

        for($renglones_user=0; $renglones_user<count($usuario_cliente_array);$renglones_user++)
        {
            echo "<tr>";
            echo "<td>
         <input type='checkbox' name='idcotizacionCheck' checked value='".$usuario_cliente_array[$renglones_user][0]."'>
                  </td>";
            echo "<td>".$usuario_cliente_array[$renglones_user][1]." ".$usuario_cliente_array[$renglones_user][2]."</td>";
            echo "</tr>";
        }
      }
    ?>



          </tbody>
        </table>
      
      </FIELDSET>
      </FORM>

    </div>

</td>
<td style="width:300px; "  valign='top'>

<!-- Estas cosas de sucursales y la ctm -->
            <div id="Mostrar_Productos">
           
            <FORM>
              <FIELDSET>
               
                <table id="Orden_productos" class='myTableRED'>
                  <thead>
                        <th> </th>
                      <th>Descripción </th>


                  </thead>
                  <tbody>

               <?
              require("../Clases/Objetos/material_tipo.php");
              $material_tipo=new Material_tipo();
              $material_tipo->conexion($link);
                  $array_mat=$material_tipo->detalle_Materiales("Materiales/Equipo");
                          $renglones=0;
                          for($renglones=0; $renglones<count($array_mat);$renglones++)
                            {
                              echo "<tr><td><input type='checkbox' name='productos' value='".$array_mat[$renglones][0]."' checked></option></td><td>".$array_mat[$renglones][2]."</td></tr>" ;
                            }
               ?>

                  </tbody>
                </table>
              
              </FIELDSET>
              </FORM>

            </div>
</td>
<td style="width:300px; float:left"  valign='top'>

<!-- Estas cosas de sucursales y la ctm -->
            <div id="Mostrar_Servicios">
              
            <FORM>
              <FIELDSET>
               
                <table id="Orden_servicios" class='myTableRED'>
                  <thead>
                        <th> </th>
                      <th>Descripción </th>


                  </thead>
                  <tbody>
            <?

                  $array_mat=$material_tipo->detalle_Materiales("Servicios");
                          $renglones=0;
                          for($renglones=0; $renglones<count($array_mat);$renglones++)
                            {
                              echo "<tr><td><input type='checkbox' name='productos' value='".$array_mat[$renglones][0]."' checked></option></td><td>".$array_mat[$renglones][2]."</td></tr>" ;
                            }
               ?>

                  </tbody>
                </table>
              
              </FIELDSET>
              </FORM>

            </div>
</td>


</tr>
            </table>

</div>  <!-- termina el mega dic -->

</div>

<button id="buscar">GENERAR</button>
<br>
<br>
<div id="dashboard">
        <div id="chart" style='width: 800px; height: 300px;'></div>
        <div id="control" style='width: 800px; height: 50px;'></div>
    </div>

<br>

<DIV id="reporte_general" style="padding-top:10px;">
<?
$user=$_SESSION['user'];
  require_once("../Clases/Conexion/conexion_prueba_local.php");
  require_once("../Clases/Objetos/reportes.php");
  $link=conect();
  $reporte=new Reporte();
  $reporte->conexion($link);
 $array=$reporte->reporte_cotizacion($user);
 $array1=$reporte->reporte_OrdenSalida($user);
 $arrayf=$reporte->reporte_Facturado($user);
 $arrayE=$reporte->reporte_Entregado($user);
 $array3=array();
 $j=0;
 $k=0;
 $i=0;
 $l=0;
 $m=0;
 $n=0;


for ($l=1; $l <=32 ; $l++) { 

  $array3[$l][0]=$l;
  $array3[$l][1]=0;
  $array3[$l][2]=0;
  $array3[$l][3]=0;
  $array3[$l][4]=0;
  $array3[$l][5]=0;
  
}

for ($i=1; $i <= 32; $i++) 
{ 
  

    for ($j=0; $j <count($array) ; $j++) 
    { 
      if ($array3[$i][0]== $array[$j][0]) 
      {
        
        $array3[$i][1]=$array[$j][1];
        $array3[$i][2]=$array[$j][2];
      }
      

    }

       
    for ($k=0; $k <count($array1) ; $k++) 
    { 
      if ($array3[$i][0]== $array1[$k][0]) 
      {
        
        $array3[$i][3]=$array1[$k][2];
      
      }
   
    }

      for ($m=0; $m <count($arrayf) ; $m++) 
    { 
      if ($array3[$i][0]== $arrayf[0][0]) 
      {
        
        $array3[$i][4]=$arrayf[$m][2];
      
      }
   
    }

    for ($n=0; $n <count($arrayE) ; $n++) 
    { 
      if ($array3[$i][0]== $arrayE[0][0]) 
      {
        
        $array3[$i][5]=$arrayE[$n][2];
      
      }
   
    }

    //fin for

}

echo "
        <table class='myTable'>
            <th>DIA</th>
            <th>MES</th>
            <th>Tot.V(Cotizaciones)</th>
            <th>Tot.V(O.S)</th>
            <th>Tot.V(Fact)</th>
            <th>Tot.V(Entregado)</th>
               
          ";
for($renglones=1; $renglones<count($array3);$renglones++)
            {
                echo "<tr>";
                
                echo "<td>".$array3[$renglones][0]."</td>";
                echo "<td>".$array3[$renglones][1]."</td>";
                echo "<td>".$array3[$renglones][2]."</td>";
                 echo "<td>".$array3[$renglones][3]."</td>";
                echo "<td>".$array3[$renglones][4]."</td>";
                echo "<td>".$array3[$renglones][5]."</td>";
                echo "</tr>";
               
             }
              echo "</table>";




?>

<BR>
  <BR>

</div>
 
<div id="busy-state">
<img src="../imagenes/busy.gif" />
</div>
</div>
<div id="chart_div" style="width: 900px; height: 500px;"></div>
<?
//Inicia Pie de Página
piepagina();
?>
