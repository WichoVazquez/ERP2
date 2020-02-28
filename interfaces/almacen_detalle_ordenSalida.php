<?

 //$id=$_GET["id"];

 //echo "Error:".$id;
 //$array=$cotizacion->detalle($id);


  require_once("index_header.php");
  $user=sesiones_start();
 
  librerias();
  librerias_dateP();
  scripts_head("../Clases/javascript/busqueda_material.js");
  scripts_head("../Clases/javascript/taller-almacen.js");	
  
  lib_shadow();
  encabezado_BIG();

	$v1=$_GET['var'];
	$v2=$_GET['var2'];
  $tipo_ped=1; //Es cero por que estamos en Almacen
  
echo "<input id='pedido_id' type='hidden' value='".$v1."'/>";
echo "<input id='var_2' type='hidden' value='".$v2."'/>";
echo "<input type=hidden id='tipo_pagina' value='almacen'/>";
echo "<input id='usuario' value='".$user."' type='hidden'/>";

	require_once("../Clases/Conexion/conexion_prueba_local.php");	
	require("../Clases/Objetos/almacen-taller.php");
  require("../Clases/Objetos/unidad.php");
	$link=conect();
	$almacen_taller=new Almacen_Taller();
	$almacen_taller->conexion($link);
  $unidad=new Unidad();
  $unidad->conexion($link);
	$resultPedidos=$almacen_taller->result_detalle_pedido1($v1);
	$resultDetalles=$almacen_taller->result_detalle_pedido2($v1,$tipo_ped);	
?>

<?
$mysqli = new mysqli('localhost', 'root', '','globaldr_ERP');
?>

<script>
  $(function() {
    $( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
    $( "#datepickers2" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
  });
</script>
  
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
<? echo "<input type=hidden id='cliente' id='cliente' value='".$resultPedidos['folioPedido']."'/>"; ?>
<h2>
<a  href="almacen_orden_salida.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>
  Detalle de Pedidos de Almacén</h2>

<div id="separa3"></div>     


<DIV>
<?
/*$perfil=$_POST['perfil'];
echo "perfil:".$perfil;*/
?>


<div>
<table width="800" border="0">
  <tr>
    <td width="120" height="39">Folio OS<div class="result">
     <?php echo $resultPedidos['folioPedido']; ?>
   </div>
 </td>

 <td width="500" style="width:500px;">Cliente:
    <div class="result">
      <?php echo $resultPedidos['cliente_razonsocial']; ?>
    </div></td>
 

	<td width="175">
<? if ($resultPedidos['sucursalName'])
    echo "Sucursal";
?>

	<td></td>
   
  </tr>
</table>
  <table width="700"  border="0">
  <tr>
    <td width="137">Estado del pedido                    
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
  <H1>Productos/Servicios:</H1>
  <TABLE id="productos" class='myTableRED'>
    <THEAD>
      <TR>
        <TH></TH>
        <TH>Tipo de Material</TH>
        <TH>Producto</TH>
        <TH>Cant.</TH>
        <TH>Unidad</TH>
        <TH>Cantidad <br>Surtida</TH>
        <TH>Cantidad <br>Producida</TH>
        <TH>Estado</TH>
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

 <div id="dialog_orden_det"  title="Solicitar Requisición de Compras">
  <FORM>
  <FIELDSET>
    
    <LABEL class="ui-widget" for="datepickers2"> Fecha del Muestreo del Material:
 <input name="datepickers2" class="ui-widget-content" readonly style="width:100px;" required  type="text" id="datepickers2" />
    <br>
    <br>
    <br>
    <LABEL class="ui-widget" for="proyecto">PROYECTO, OBRA, CONTRATO (SEGÚN EL CASO): </LABEL>
<br>
<TEXTAREA id="proyecto" style="width:450px;" maxlength="500"></TEXTAREA>
<br>
<LABEL class="ui-widget" for="descripcion">DESCRIPCION DE LOS TRABAJOS A REALIZAR CON LA COMPRA:</LABEL>
<br>
<TEXTAREA id="descripcion" style="width:450px;" maxlength="500"></TEXTAREA>
<br>
<LABEL class="ui-widget" for="lugar_entrega">LUGAR DE ENTREGA DEL PRODUCTO Y/O SERVICIO: </LABEL>
<br>
<TEXTAREA id="lugar_entrega" style="width:450px;" maxlength="500"></TEXTAREA>
<br>
<LABEL class="ui-widget" for="especificaciones"><B>ESPECIFICACIONES ESPECIALES: </B></LABEL>
<br>
  <TEXTAREA id="especificaciones" style="width:450px;" maxlength="500"></TEXTAREA>
<br>
    <br>
    <table id="orden_compra_det" class='myTable'>
      <thead>
   
          <th>&nbsp;</th>
        <TH>Clave</TH>
        <TH>Producto</TH>
        <TH>Cantidad Solicitada</TH>
        <TH>Existencia</TH>
        <TH>Cantidad Surtida</TH>
        
        <TH>Cantidad a Solicitar</TH>
      </thead>
      <tbody>
      </tbody>
    </table>
  </FIELDSET>
  </FORM>

 </div>
<br>

<DIV id="products_contain_logistica">
  <H1>Solicitud de Transportes:</H1>
  <TABLE id="productos_logistica" class='myTable'>
    <THEAD>
      <TR>
        <TH>Clave</TH>
        <TH>Producto</TH>
        <TH>Unidad</TH>
        <TH id="letraP">Cantidad pendiente por <br>Surtir</TH>
       
      </TR>
    </THEAD>
    <TBODY>

    </TBODY>
  </TABLE>

<table>
  <tr>
    <td>
      <LABEL for="destino_folio">FOLIO OS:</LABEL>
      <input type="text"  name="destino_folio" value="<?php echo $resultPedidos['folioPedido'];?>" disabled="disabled">
    </td>
    <td>
      <LABEL for="destino_cliente">Cliente:</LABEL>
      <input type="text" name="destino_cliente" value="<?php echo $resultPedidos['cliente_razonsocial'];?>" disabled="disabled">
    </td>
  </tr>
  <tr>
    <td>
      <LABEL for="datepicker">Fecha de creación:</LABEL>
   <input type='text' id='fecha_creacion' name='fecha_creacion' value="<?php echo $resultPedidos['fechaCreacion']; ?>" disabled="disabled">
    </td>
<td>
<LABEL for="datepicker">Fecha de Entrega:</LABEL>
   <input type='text' id='destino_fecha_entrega' value="<?php echo $resultPedidos['fechaEntrega']; ?>" disabled="disabled">
</td>
</tr>
<tr>
    <td colspan='2'>
      <LABEL for="datepicker">Destino:</LABEL>
        <?php
// Realizamos la consulta para extraer los datos
          $query = $mysqli -> query ("SELECT cliente.cliente_razonsocial, domicilio.domicilio_calle, domicilio.domicilio_num_ext, domicilio.domicilio_num_int, domicilio.domicilio_colonia, domicilio.domicilio_municipio, domicilio.domicilio_ciudad, domicilio.domicilio_estado, domicilio.domicilio_cp  FROM cliente INNER JOIN domicilio ON domicilio.domicilio_id = cliente.cliente_domicilio_fiscal WHERE cliente.cliente_razonsocial='$resultPedidos[cliente_razonsocial]'");
          while ($valores = mysqli_fetch_array($query)) {
// En esta sección estamos llenando el select con datos extraidos de una base de datos.
            echo "<input type='text' name='id' style='width:720px' disabled='disabled' value='$valores[1] $valores[2], $valores[3], $valores[4], $valores[5], $valores[6], $valores[7],C.P. $valores[8]'>";
          }
        ?>
</td>
  </tr>
  <tr> 
<td>
  <p>Camión:
      <select id="transporte_id" name="transporte_id">
        <option value="0">Seleccione:</option>
        <?php
// Realizamos la consulta para extraer los datos
          $query = $mysqli -> query ("SELECT * FROM transporte");
          while ($valores = mysqli_fetch_array($query)) {
// En esta sección estamos llenando el select con datos extraidos de una base de datos.
            echo '<option value="'.$valores[transporte_id].'">'.$valores[transporte_nombre].' '.$valores[transporte_placas].'</option>';
          }
        ?>
      </select>
</td>
<td>
    <p>Remolque:
      <select id="remolque_id" name="remolque_id">
        <option value="0">Seleccione:</option>
        <?php
// Realizamos la consulta para extraer los datos
          $query = $mysqli -> query ("SELECT * FROM remolque");
          while ($valores = mysqli_fetch_array($query)) {
// En esta sección estamos llenando el select con datos extraidos de una base de datos.
            echo '<option value="'.$valores[remolque_id].'">'.$valores[remolque_nombre].' '.$valores[remolque_placas].'</option>';
          }
        ?>
      </select>
</td>
</tr>
<tr> 
<td>
  <p>Operador:
      <select id="operador" name="operador_id">
        <option value="0">Seleccione:</option>
        <?php
// Realizamos la consulta para extraer los datos
          $query = $mysqli -> query ("SELECT * FROM operador");
          while ($valores = mysqli_fetch_array($query)) {
// En esta sección estamos llenando el select con datos extraidos de una base de datos.
            echo '<option value="'.$valores[operador_id].'">'.$valores[nombre].' '.$valores[apellido_p].' '.$valores[apellido_m].'</option>';
          }
        ?>
      </select>
</td>
</tr>
<tr> 
<td>
<textarea name='ruta_observacion' id='ruta_observacion' name="ruta_observacion" cols="40" rows="5" placeholder="Obeservaciones"></textarea>
</td>
</tr>
</table>

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
<LABEL for="lote_lab">Lote:</LABEL>
    <INPUT type="text" id="lote_lab" >
</td>
</tr>
<tr>

 <td>
 <LABEL class="ui-widget" for="datepicker1"> Fecha del Muestreo del Material:
 <input name="datepicker1" class="ui-widget-content" readonly style="width:100px;" required  type="text" id="datepicker1" />
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

<DIV id="dialog_transportes" title="Crear Solicitud de Transporte">

<br />
<table>
  <tr>
    <td valign="top" align="right">
    <LABEL class="ui-widget" for="proveedor">Transporte:</LABEL>
     <select id="transporte"  class="text"> 

       <?php
       require("../Clases/Objetos/transporte.php");
        
        $transporte=new Transporte();
        $transporte->conexion($link);      
        
        $array=$transporte->ObtieneTransporte();
          
        if($array!=null)
        { 
          
          $cont=0;
          for($renglones=0; $renglones<count($array);$renglones++)
          {
          echo "<option value='".$array[$renglones][0]."'>".$array[$renglones][1]."</option>";       
          }
        }
       ?>
       </select>
    <br>  
           <LABEL for="remolquees">Remolques:</LABEL>
           <select name='remolques' id='refacciones' class='ui-widget' style='max-width:200px;'>
            <option value='0'>--Seleccione Opción--</option>
            <option value='1'>PLANA 2013  3BYPA4038DH007282 062-XP-4</option>
            <option value='2'>TOLVA 2013  3BYTC3632H007224  055-XP-4</option>
            <option value='3'>GONDOLA 2007  3S9V130507E17504  303-WC-9</option>
            <option value='4'>PIPA  2010  3S9T13051AE017025 194-UM-3</option>
          </select>
    <br>

    </td>

</tr> 


</table>
</DIV>

<BUTTON id="enviar_transporte" >SOLICITAR TRANSPORTES</BUTTON> 
<BUTTON id="enviar-autorizacion">AUTORIZAR PARA PRODUCCION</BUTTON> 
 <BUTTON id="generar_orden_compra">GENERAR REQUISICIÓN DE COMPRAS</BUTTON> 

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

<DIV id="status_regis" class="ui-widget">
</DIV>

</div>

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
  <td><img src='../imagenes/almacen3.png'  height="400" width="550" /></td>
  <td><img src='../imagenes/almacen4.png'  height="400" width="550" /></td>
    </TBODY>
  </TABLE>

</DIV>

<DIV id="dialog_instrucciones44" title="Instrucciones: ">

<TABLE >
    <THEAD>
      <TR>
           
      
        <TH><h1>Paso Siguiente: </h1></TH>
        
        
      </TR>
    </THEAD>
    <TBODY>
  <td><img src='../imagenes/laboratorio1.png'  height="400" width="550" /></td>
  
    </TBODY>
  </TABLE>

</DIV>

<?
//Inicia Pie de Página
piepagina();
?>