<?

 //$id=$_GET["id"];

 //echo "Error:".$id;
 //$array=$cotizacion->detalle($id);


  require_once("index_header.php");
  $user=sesiones_start();
 
  librerias();
  scripts_head("../Clases/javascript/busqueda_material.js");
  scripts_head("../Clases/javascript/taller-almacen.js");	
  
  lib_shadow();
  encabezado_BIG();

	$v1=$_GET['var'];
	$v2=$_GET['var2'];
  $tipo_ped=0; //Es cero por que estamos en Almacen

echo "<input id='usuario' type='hidden' value='".$user."'/>";

	require_once("../Clases/Conexion/conexion_prueba_local.php");	
	require("../Clases/Objetos/almacen-taller.php");
  require("../Clases/Objetos/unidad.php");
	$link=conect();
	$almacen_taller=new Almacen_Taller();
	$almacen_taller->conexion($link);
  $unidad=new Unidad();
  $unidad->conexion($link);
	$resultPedidos=$almacen_taller->result_detalle_pedido1($v1);
	$resultDetalles=$almacen_taller->result_detalle_pedido_taller_1($v1,$tipo_ped);
	
	
?>
  
   <style type="text/css" media="screen">
#separa3{
	margin:10px 0 10px 0;
	background:#8A0808;
	height:2px;
	width:800px;
	}
.tittle{
	color:#8A0808;
	text-shadow: 0.01em 0.01em 0.008em #333;
	}
.result{
	color:#8A0808;
	font-size:14px;
	font-weight:bold;	
}
#letraP{
	font-size:10px;
	font-weight:bold;	
}
#bot_return
{
float:left;
background:#fff;
width:320px;
}
#subtitulo
{
float:left;
background:#fff;
width:420px;
}
   </style>	


<h2>
<a  href="taller_ordenes_salida.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>
  Detalle de Ordenes de Producción</h2>

<div id="separa3"></div>     


<DIV>
<?
/*$perfil=$_POST['perfil'];
echo "perfil:".$perfil;*/
?>


<div>
<table width="800"  border="0">
  <tr>
    <td width="120" height="39">Folio Pedido<div class="result">
     <?php echo $resultPedidos['folioPedido']; ?>
   </div>
 </td>
  
   
 <td width="500" style="width:500px;">Cliente:
    <div class="result">
      <?php echo $resultPedidos['cliente_razonsocial']; ?>
    </div></td>

	<td width="175">
<? if ($resultPedidos['sucursalName'])
    echo "Destino";
?>
	

  <div class="result">
    <?php echo $resultPedidos['sucursalName']; ?>
  </div></td>

	<td></td>
   
  </tr>
  </table>
    <table width="700"  border="0">
  <tr>
    <td width="137" rowspan="2">Estado de orden                    
    <div><?php echo $resultPedidos['pedidoEdo'];?></div> </td>
    <td></td>
 <td  width="230" style="width:230px;">Observaciones
    <div class="result"><?php echo $resultPedidos['observaciones']; ?></div></td>
        <td width="230" style="width:230px;">Fecha de Inicio<div class="result"> 
      <?php echo $resultPedidos['fechaCreacion']; ?>
    </div></td>
    <td width="230" style="width:230px;">Fecha de Entrega
    <div class="result">
      <?php echo $resultPedidos['fechaEntrega']; ?>
    </div></td>
  </tr>
</table>


</div>
 <div id="separa3"></div>
</DIV>



<div id="general-form">
<DIV id="products-contain">
  <H1>Productos:</H1>
<!--  <BUTTON id="agregar-producto">Agregar Producto</BUTTON> -->
  <TABLE id="productos" class='myTableRED'>
    <THEAD>
      <TR>
         
        <TH>Clave</TH>
        <TH>Producto</TH>
        <TH>Cant.</TH>
        <TH>Unidad</TH>
        <TH>Cantidad <br>Surtida</TH>
        <TH>Cantidad <br>Producida</TH>
        <TH>Status</TH>
        <TH>Existencia</TH>
        <TH>Laboratorio</TH>
        <TH>Ordenes de Laboratorio</TH>
       
    
      </TR>
    </THEAD>
    <TBODY>
	<?php
	
		echo $resultDetalles;
		
	?>
    </TBODY>
  </TABLE>
  
  

 
   
  
</DIV>

<DIV id="dialog_lab" title="Enviar Muestra al Laboratorio">

<br />
<table>
  <tr>
    <td valign="top" align="right">
    <LABEL for="Cantidad_Lab">Cantidad:</LABEL>
    <INPUT type="text" id="Cantidad_Lab" >
    <LABEL for="Cantidad_Lab">Unidad de Medida:</LABEL>

    <select name='unidad_medida' id='unidad_medida'  style='max-width:200px;'>

<?
                          $array=$unidad->detalle();
                          $renglones=0;
                          for($renglones=0; $renglones<count($array);$renglones++)
                            {
                              
                              echo "<option value='".$array[$renglones][0]."'";




                            echo  ">".$array[$renglones][1]."</option>";
                            }

?>

    </select>
    <br>  
    </td>

</tr> 
<tr>
<td>
<LABEL for="servicio_lab">Servicio Solicitado:</LABEL>
    <INPUT type="text" id="servicio_lab" >
</td>
</tr>
<tr>
<td>
<LABEL for="servicio_lab">Lote:</LABEL>
    <INPUT type="text" id="servicio_lab" >
</td>
</tr>
<tr>
<td>
<LABEL for="servicio_lab">Fecha del Muestreo del Material:</LABEL>
    <INPUT type="text" id="servicio_lab" >
</td>
</tr>
<tr>
<td>
<LABEL for="servicio_lab">Origen de la Muestra:</LABEL>
    <INPUT type="text" id="servicio_lab" >
</td>
</tr>
<tr>
<td>
<LABEL for="observaciones_lab">Observaciones:</LABEL>
    <INPUT type="text" id="observaciones_lab" >
</td>
</tr>

</table>
</DIV>

<?

?>


<DIV id="dialog_ordenes" title="Ordenes a Laboratorio">
<br />
<table id="Ordenes_laboratorio" class='myTable'>
      <thead>  
            <th>No. Orden</th>
            <th>Lote</th>   
            <th>Producto</th>       
            <th>Cantidad de la Muestra</th>  
            <th>Cantidad Analizada</th>
            <th>Usuario Solictante</th>
            <th>Usuario Análisis</th>
            <th>Fecha Solicitud</th>
            <th>Fecha Análisis</th>
            <th>Estado</th>
            <th>PDF</th>
           
      </thead>
      <tbody>
      <?

           ?>
      </tbody>
    </table>
</DIV>

 <BUTTON id="enviar-almacen">ENVIAR A ALMACÉN</BUTTON> 

<DIV id="status_regis" class="ui-widget">
</DIV>

</div>
<DIV id="dialog-form" title="Ingresar Producto" height="700">
  <FORM>
  <FIELDSET>
  
    
    <LABEL style="width:50px;" for="producto">Producto:</LABEL>
    <INPUT type="text" name="producto" id="producto" class="text ui-widget-content ui-corner-all" onKeyUp="showResult(this.value)" style="width:500px;" IDPRODUCTO="0" value=""/>
    &nbsp;&nbsp;&nbsp;<DIV id="livesearch" class="ui-widget" style="position:absolute; overflow:auto; width:500px; padding-top:0px;background-color:#FFF;z-index:100;"></DIV>
    <BR>
    <LABEL style="width:50px;" for="cantidad">Cantidad:</LABEL>
    <INPUT type="text" name="cantidad" id="cantidad" class="text ui-widget-content ui-corner-all"  value="0" onKeyUp="calcularMontos(this.value)" style="width:100px;"  readonly="readonly"/>

    <br>

 <LABEL style="width:50px;" for="observaciones">Observaciones:</LABEL>
    <TEXTAREA type="textarea" name="observaciones" id="observaciones" class="text ui-widget-content ui-corner-all" style="width:500px;" maxlength="300" /></textarea>


    <LABEL style="width:50px;" for="preciobase"></LABEL>
    <INPUT type="hidden" name="preciobase" id="preciobase" class="text ui-widget-content ui-corner-all"  style="width:100px;"  readonly />
    <BR>
    <INPUT  type="hidden" name="promo" id="aumento" class="radio ui-widget-content" checked="checked"/><LABEL for="aumento"></LABEL>
    <INPUT type="hidden" name="promo" id="descuento" class="ui-widget-content" />
    <LABEL for="descuento"></LABEL>
    <BR>
    <INPUT type="hidden" name="valor" id="porcen" class="ui-widget-content" checked="checked"/>
    <LABEL for="porcen"></LABEL>
    <INPUT type="hidden" name="valor" id="real" class="ui-widget-content" />
    <LABEL for="real"></LABEL>
  <BR>
    <BR>
    <LABEL style="width:50px;" for="cantidad-promo"></LABEL><INPUT type="hidden" name="cantidad-promo" id="cantidad-promo" class="text ui-widget-content ui-corner-all"  style="width:100px;" value="0"  onKeyUp="calcularPromo(this.value)" readonly="readonly"/>
    <BR>
    <LABEL style="width:50px;" for="preciounit"></LABEL>
    <INPUT type="hidden" name="preciunit" id="preciounit" class="text ui-widget-content ui-corner-all"  style="width:100px;" readonly />
    <LABEL style="width:50px;" for="total"></LABEL>
    <INPUT type="hidden" name="total" id="total" class="text ui-widget-content ui-corner-all" style="width:100px;" readonly />
    <BR>
   
  </FIELDSET>
  </FORM>
</DIV>

<br>
<DIV id="dialog_instrucciones4" title="Instrucciones: ">

<TABLE >
    <THEAD>
      <TR>
           
      
        <TH><h1>Opcion #1: Surtir Orden </h1></TH>
        <TH><h1>Opcion #2: Crear una Orden Para Laboratorio</h1></TH>
        
      </TR>
    </THEAD>
    <TBODY>
  <td><img src='../imagenes/produccion3.png'  height="400" width="550" /></td>
  <td><img src='../imagenes/produccion4.png'  height="400" width="550" /></td>
    </TBODY>
  </TABLE>

</DIV>
<?
//Inicia Pie de Página
piepagina();
?>
