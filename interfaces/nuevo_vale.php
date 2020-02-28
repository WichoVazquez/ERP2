<?// Inicia Página
require_once("index_header.php");
  $user=sesiones_start();
  librerias();
  scripts_head("../Clases/javascript/nueva_solicitud_almacen.js");
 
  encabezado();

?>

  <script>
  $(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
  });



  </script>


<H2>Solicitud de Vale de consumo</H2>
 
<DIV>
<?
$almacenes='';
$i=0;
$qry_almacenes = mysql_query("SELECT almacen_id, nombre FROM almacen");
  while($res = mysql_fetch_object($qry_almacenes)){ 
    $idAlmacen=$res->almacen_id;
    $nombreAlmacen=$res->nombre;
    $almacenes.='<option value="'.$idAlmacen.'">'.$nombreAlmacen.'</option>';
  }
echo '

<form method="post" action="nuevo_vale.php">

<DIV id="panelAlmacen" style="padding-top:20px;">
<td>Solicitar a:</td> <td width="400"><select name="almacen" id="almacen" size="1">'.$almacenes.'</select></td>
<p><LABEL class="ui-widget" for="datepicker"> Fecha de Solicitud: <input name="datepicker" type="text" id="datepicker" /></p>

  

<td>Producto:</td>
    <INPUT type="text" name="producto" id="producto" class="text ui-widget-content ui-corner-all" onKeyUp="showResult(this.value)"   style="width:300px;" IDPRODUCTO="null" value=""/>
    &nbsp;&nbsp;&nbsp;<DIV id="livesearch" class="ui-widget" style="position:absolute; overflow:auto; padding-top:0px;background-color:#FFF;z-index:100;"></DIV>
        
<br>
        <td width="176">Cantidad a Solicitar:</td>
        <td width="40"><input name="dig_cantidad" id="dig_cantidad" type="text" class="text ui-widget-content ui-corner-all"  width="40" /></td>
        <td>FOLIO</td><input name="folio" id="folio" type="text" class="text ui-widget-content ui-corner-all"  width="20" />
          <input type="hidden" id="almacen" value="'.$idAlmacen.'"> 

<br>
<td>Descripcion:</td> 
<br>
<TEXTAREA id="observ" name="observ" style="width:450px;" maxlength="500"></TEXTAREA>
<br>
<input type="submit" value="SOLICITAR">
<DIV id="dialog-form" title="Ingresar Producto">
  <FORM>

  	<style="padding-up:-10px;">*Todos los precios son en Moneda Nacional
    <BR>
    <LABEL style="width:50px;" for="producto">Producto:</LABEL>
    <INPUT type="text" name="producto1" id="producto1" class="text ui-widget-content ui-corner-all" onKeyUp="showResult(this.value)" title="Palabras Clave"  style="width:100px;" IDPRODUCTO="0" value=""/>
    &nbsp;&nbsp;&nbsp;<DIV id="livesearch" class="ui-widget" style="position:absolute; overflow:auto; padding-top:0px;background-color:#FFF;z-index:100;"></DIV>
    <BR>
    <LABEL style="width:50px;" for="cantidad">Cantidad:</LABEL>
    <INPUT type="text" name="cantidad" id="cantidad" class="text ui-widget-content ui-corner-all"  value="0" onKeyUp="calcularMontos(this.value)" style="width:100px;"  readonly="readonly"/>

    <LABEL style="width:50px;" for="preciobase">Precio:</LABEL>
    <INPUT type="text" name="preciobase" id="preciobase" class="text ui-widget-content ui-corner-all"  style="width:100px;"  readonly />
    <BR>
    <INPUT  type="radio" name="promo" id="aumento" class="radio ui-widget-content" checked="checked"/><LABEL for="aumento">Aumento</LABEL>
    <INPUT type="radio" name="promo" id="descuento" class="ui-widget-content" />
    <LABEL for="descuento">Descuento</LABEL>
    <BR>
    <INPUT type="radio" name="valor" id="porcen" class="ui-widget-content" checked="checked"/>
    <LABEL for="porcen">Porcentaje</LABEL>
    <INPUT type="radio" name="valor" id="real" class="ui-widget-content" />
    <LABEL for="real">Real</LABEL>
	<BR>
    <BR>
    <LABEL style="width:50px;" for="cantidad-promo">Añadir:</LABEL><INPUT type="text" name="cantidad-promo" id="cantidad-promo" class="text ui-widget-content ui-corner-all"  style="width:100px;" value="0"  onKeyUp="calcularPromo(this.value)" readonly="readonly"/>
    <BR>
    <LABEL style="width:50px;" for="preciounit">Precio U.:</LABEL>
    <INPUT type="text" name="preciunit" id="preciounit" class="text ui-widget-content ui-corner-all"  style="width:100px;" readonly />
    <LABEL style="width:50px;" for="total">Total:</LABEL>
    <INPUT type="text" name="total" id="total" class="text ui-widget-content ui-corner-all" style="width:100px;" readonly />
  
  </FORM>
  

';

  require_once("../Clases/Conexion/conexion_prueba_local.php"); 
  $link=conect();


 $almacenID=$_POST['almacen'];
 $cantidad=$_POST['dig_cantidad'];
 $producto=$_POST['producto'];
 $datepicker=$_POST['datepicker'];
 $folio=$_POST['folio'];

 $observaciones='';

$qry2=mysql_query("INSERT INTO taller_solicitud (taller_solicitud_id, taller_id, fecha_creacion, usuario_id_solicitante, almacen_id,
 usuario_id_autorizador, fecha_autorizacion, motivo, pedido_id, status, folio, tipo) VALUES 
(NULL, '1', CURDATE( ), '', '$almacenID', '', NULL, '$observaciones', NULL, '0', '$folio', '1')");

$qry=mysql_query("SELECT taller_solicitud.taller_solicitud_id from taller_solicitud where folio LIKE '$folio'");
$fetch=mysql_fetch_array($qry);
$taller_solicitud_id=$fetch['taller_solicitud_id'];

$qryfetch1=mysql_query("SELECT material.material_id from material where material_descripcion like '$producto'");
$fetch1=mysql_fetch_array($qryfetch1);
$productoID=$fetch1['material_id'];


$qry3=mysql_query("INSERT INTO detalle_taller_solicitud (detalle_taller_solicitud_id, producto_id, cantidad_solicitada)
 VALUES ('$taller_solicitud_id', '$productoID', '$cantidad')");


if ($qry2==1&&$qry3==1) {
  echo "REGISTRO EXISTOSO <meta http-equiv='refresh' content='1;url=TALLER.php'> 
";
}
else
echo "NO EXISTOSO";

?>
<?
//Inicia Pie de Página
piepagina();
?>

