
<?// Inicia Página
require_once("index_header.php");
  $user=sesiones_start();
  librerias();
 scripts_head("../Clases/javascript/editar_ruta.js");
  scripts_head("../Clases/Verificadores/general.js");
  encabezado_BIG();
$user=sesiones_start();

 $id=$_GET["id"];
 $idTransporte1=$_GET["idTransporte1"];
 $operador=$_GET["operador"];
 $idRemolque=$_GET["remolque"];
?>




<H2>
  <a  href="logistica_busqueda.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../Imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>
  Editar Ruta
  </H2>

<div id="Mostrar_todo">
<FORM>
  <FIELDSET>
     <H1>PEDIDOS PARA EMBARCAR:</H1>
    <table id="Orden_sumario" class='myTable'>
      <thead>
           
           <th>Tipo </th>
          <th>Folio Pedido</th>
          <th>Cliente</th>
          <th>Destino</th>
          <th>Fecha Entrega</th>         
          <th>Estatus</th>
      </thead>
      <tbody>
<?
$inicio_orden_sumario=0; 

require_once("../Clases/Conexion/conexion_prueba_local.php");
  require("../Clases/Objetos/logistica.php");
$link=conect();
   $logistica=new Logistica();
  $logistica->conexion($link);

$array_ordenes=$logistica->ObtieneOrdenes_sumario();


for($renglones_ord=0; $renglones_ord<count($array_ordenes);$renglones_ord++)
    {

        $tipo_pedido = 0;

        echo  "<tr>".
           "<td> 
           <b> "  . $array_ordenes[$renglones_ord][6] .  " </b></td>" .
           "<td>" . $array_ordenes[$renglones_ord][1]. "</td>" .
           "<td>" . $array_ordenes[$renglones_ord][2] . "</td>" .
           "<td>" . $array_ordenes[$renglones_ord][7] . " "
           . $array_ordenes[$renglones_ord][8] . " "
           . $array_ordenes[$renglones_ord][9] . " "
           . $array_ordenes[$renglones_ord][10] . " "
          . $array_ordenes[$renglones_ord][11] . " 
           </td>" .                
           "<td>" . $array_ordenes[$renglones_ord][5] . "</td>" .      
        "<td>";

if (($array_ordenes[$renglones_ord][6]=="Entrega" )||($array_ordenes[$renglones_ord][6]=="Producción" ))
   $tipo_pedido = 1;  // 1 es para Entrega y cero para Recarga

//if ($inicio_orden_sumario)
     echo  "   <BUTTON id='boton_sumario' name='boton_sumario' class='detalleorden' tipo_ordensalida=".$tipo_pedido." idordensalida='". $array_ordenes[$renglones_ord][0]."' style='alignment-baseline:middle'>AGREGAR</BUTTON>";




       echo " </td>" . 

         "</tr>";
    }


$inicio_orden_sumario=1;
?>



      </tbody>
    </table>

  </FIELDSET>
  </FORM>

</div>


<FORM>
<FIELDSET>
<h1>INFORMACIÓN DE EMBARQUE:</h1>
<DIV id="panelTransporte" style="padding-top:10px;">
<LABEL class="ui-widget" for="proveedor">Tractocamion:</LABEL>
 <select id="transporte"  class="text"> 

 <?php


 require("../Clases/Objetos/transporte.php");
	
	$transporte=new Transporte();
	$transporte->conexion($link);
 
	
	$array=$transporte->ObtieneTransporte($idTransporte1);
    
	if($array!=null)
	{	
		
			 echo "<option value='0'>Seleccione Transporte</option>";
		$cont=0;
		for($renglones=0; $renglones<count($array);$renglones++)
		{
			if ($idTransporte1 == $array[$renglones][0])
    echo "<option value='".$array[$renglones][0]."' selected>".$array[$renglones][2]." / ".$array[$renglones][1]."</option>";
    else     
    echo "<option value='".$array[$renglones][0]."'>".$array[$renglones][2]." / ".$array[$renglones][1]."</option>";
 		//echo "<option value='".$array[$renglones][0]."'>".$array[$renglones][2]." / ".$array[$renglones][1]."</option>";			 
		}
	}
 ?>
 </select>
 <LABEL for="remolquees">Remolques:</LABEL>
           
 <select id='remolque'  class="text"> 

 <?php


 
  
  $array=$transporte->ObtieneRemolque($idRemolque);
    
  if($array!=null)
  { 
    
       echo "<option value='0'>Seleccione Remolque</option>";
    $cont=0;
    for($renglones=0; $renglones<count($array);$renglones++)
    {
    if ($idRemolque == $array[$renglones][0])
    echo "<option value='".$array[$renglones][0]."' selected>".$array[$renglones][2]." / ".$array[$renglones][1]."</option>";
    else     
    echo "<option value='".$array[$renglones][0]."'>".$array[$renglones][2]." / ".$array[$renglones][1]."</option>";
    //echo "<option value='".$array[$renglones][0]."'>".$array[$renglones][2]." / ".$array[$renglones][1]."</option>";       
    }     
    }
  
 ?>
 </select>


<LABEL class="ui-widget" for="operador_ruta">Operador:</LABEL>
<!-- <input type="text" id="operador_ruta" class="text" style="width:300px;"> -->

<?
require("../Clases/Objetos/operador.php");
   $link=conect();
   $operador=new Operador();
   $operador->conexion($link);
   $array_operador=$operador->busqueda_operador("",0,10);
   echo "
   <select name='operador_ruta' id='operador_ruta' class='ui-widget' style='max-width:200px;'>";
   if($array_operador!=null)
   {
     echo "<option value='0'>Seleccione Transportista-</option>";
     for($renglones=0; $renglones<count($array_operador);$renglones++)
     {
$nombre_transportista = $array_operador[$renglones][1]." ".$array_operador[$renglones][2]." ".$array_operador[$renglones][3];
		if ($operador == $nombre_transportista)
       echo "<option value='".$nombre_transportista."' selected>".$nombre_transportista."</option>";
     else
       echo "<option value='".$nombre_transportista."'>".$nombre_transportista."</option>";
     
      // echo "<option value='".$nombre_transportista."'>".$nombre_transportista."</option>";
     }
   }
   else
   {
    echo "<option value='0'>Sin Resultados</option>";
   }
   echo "</select>";
   
?>
<br>
       

</DIV>
</FIELDSET> 
</FORM>



<DIV id="dialog-form" title="Ingresar Orden">
  <FORM>
  <FIELDSET>
  	<LABEL style="padding-up:-10px;">Seleccionar los Productos</LABEL>
    <table id="Orden" class='myTable'>
      <thead>
   
           <th>&nbsp;</th>
           <th>Tipo </th>
          <th>Folio Pedido</th>
          <th>Cliente</th>
          <th>Fecha Entrega</th>
          <th>Producto</th>
          <th>Cantidad </th>
          <th>Cantidad Embarcada</th>
          <th>Cantidad por Embarcar </th>
      </thead>
      <tbody>
      </tbody>
    </table>
  </FIELDSET>
  </FORM>
</DIV>

<DIV id="dialog-form-recoleccion" title="Ingresar Orden">
  <FORM>
  <FIELDSET>
    <LABEL style="padding-up:-10px;">Selecciona los Pedidos</LABEL>
    <table id="Orden-recoleccion" class='myTable'>
      <thead>
          <th>&nbsp;</th>
          <th>Tipo </th>
          <th>Folio Pedido</th>
          <th>Cliente</th>
          <th>Fecha Recoleccion</th>
          <th>Producto</th>
          <th>Cantidad Recoger </th>
          <th>Cantidad Prestamo </th>
      </thead>
      <tbody>
      </tbody>
    </table>
  </FIELDSET>
  </FORM>
</DIV>


<DIV id="orders-contain">
 <H1>Pedidos:</H1>
  <TABLE id="Orden1" class='myTable'>
    <THEAD>
      <TR>
      		 <th>&nbsp;</th>
           <th>Tipo </th>
          <th>Folio Pedido</th>
          <th>Cliente</th>
          <th>Fecha Entrega</th>
          <th>Producto</th>
          <th>Cantidad Pendiente </th>
          <th>Cantidad Surtir </th>
          <th>Cantidad Recoger </th>
          <th>Cantidad Prestamo </th>
          <th>Fecha Recoleccion</th>
      </TR>
    </THEAD>
    <TBODY>

    </TBODY>
  </TABLE>
</DIV>

<DIV id="orders-contain-ruta">
 <H1>RUTA No. 

  <input id='id_ruta' value='<?php echo $id ?>'/>
  
 </H1>
   <FORM>
  <FIELDSET>
  <TABLE id="Orden1_ruta" class='myTableRED'>
    <THEAD>
      <TR>
         <th> </th>
           <th>Tipo </th>
          <th>Folio Pedido</th>
          <th>Cliente</th>
          <th>Fecha Entrega</th>        
          <th>Folio Nota Salida</th>
          
      </TR>
    </THEAD>
    <TBODY>

    </TBODY>
  </TABLE>
     
  </FIELDSET>
  </FORM>
</DIV>





<BUTTON id="guardar-ruta">GUARDAR</BUTTON> 
<BUTTON id="quitar-orden">QUITAR</BUTTON> 
<BUTTON id="cancelar-ruta">CANCELAR</BUTTON> 

<br />
<BUTTON id="imprime-ruta">IMPRIMIR PLAN DE EMBARQUES</BUTTON>
<br />

<DIV id="divguardar" style="padding-top:10px; padding-bottom:10px;">
<BUTTON id="guardar-orden" >Guardar</BUTTON>
</DIV>

<DIV id="dialog" title="Detalle de la Orden">

    <LABEL style="padding-up:-10px;">Detalle de la Orden</LABEL>
    
  
</DIV>




<?
//Inicia Pie de Página
piepagina();
?>