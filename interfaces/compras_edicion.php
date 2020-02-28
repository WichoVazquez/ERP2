<?

 $id=$_GET["id"];
 require("../Clases/Conexion/conexion_prueba_local.php");
 require("../Clases/Objetos/orden_compra.php");
 $link=conect();
 $compras=new Orden_compra();
 $compras->conexion($link);
 //echo "Error:".$id;
 $array=$compras->detalle($id);


  require_once("index_header.php");
  $user=sesiones_start();
  librerias();
  scripts_head("../Clases/javascript/busqueda_compras.js");
  encabezado();

?>
 <script>
  $(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
  });
</script>

        
<H2>Edición Orden Compra</H2>
<DIV id="varcot">
<?
echo "<input id='usuario' value='".$array[1]."'/>";
echo "<input id='orde_compra_id' value='".$id."'/>";
echo "<input id='estado' value='".$array[6]."'/>";

?>
</DIV>  
<DIV>
<?
/*$perfil=$_POST['perfil'];
echo "perfil:".$perfil;*/
?>

<FORM>
<FIELDSET>
<LABEL class="ui-widget" for="proveedor">Proveedor:</LABEL>
<INPUT type="text" name="cliente" id="proveedor" class="text ui-widget-content ui-corner-all"  width="200" <? echo " idproveedor='".$array[2]."' value='".$array[7]."'";?> readonly/>
<BR>
<LABEL class="ui-widget" for="mensaje">Mensaje:</LABEL>
<BR>
<TEXTAREA id="mensaje" style="width:430px;" MAXLENGTH="500"><? echo "".$array[5]."";?></TEXTAREA>
</FIELDSET> 
</FORM>
   
</DIV>
<DIV id="dialog-form" title="Ingresar Producto">
  <FORM>
  <FIELDSET>
        <LABEL style="padding-up:-10px;">*Todos los precios son en Moneda Nacional</LABEL>
    <BR>
    <LABEL style="width:50px;" for="producto">Producto:</LABEL>
    <INPUT type="text" name="producto" id="producto" class="text ui-widget-content ui-corner-all" onKeyUp="showResult(this.value)" title="Palabras Clave"  style="width:100px;" IDPRODUCTO="0" value=""/>
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
    <LABEL style="width:50px;" for="cantidad-promo">Añadir:</LABEL><INPUT type="text" name="cantidad-promo" id="cantidad-promo" class="text ui-widget-content ui-corner-all"  style="width:100px;" value="0"  onKeyUp="calcularPromo(this.value)" readonly/>
    <BR>
    <LABEL style="width:50px;" for="preciounit">Precio U.:</LABEL>
    <INPUT type="text" name="preciunit" id="preciounit" class="text ui-widget-content ui-corner-all"  style="width:100px;" readonly />
    <LABEL style="width:50px;" for="total">Total:</LABEL>
    <INPUT type="text" name="total" id="total" class="text ui-widget-content ui-corner-all" style="width:100px;" readonly />
    <BR>
    <LABEL style="width:50px;" for="observaciones">Observaciones:</LABEL>
    <INPUT type="textarea" name="observaciones" id="observaciones" class="text ui-widget-content ui-corner-all" style="width:100px;" maxlength="300" />
  </FIELDSET>
  </FORM>
</DIV>
<div id="general-form">
<DIV id="products-contain" class="ui-widget">
  <H1>Productos/Servicios:</H1>
  <TABLE id="productos" class="ui-widget ui-widget-content">
    <THEAD>
      <TR class="ui-widget-header ">
        <TH>&nbsp;</TH>
        <TH>Clave</TH>
        <TH>Producto</TH>
        <TH>Cantidad</TH>
        <TH>Unidad</TH>
        <TH>Precio</TH>
        <TH>Monto</TH>
       
      </TR>
    </THEAD>
    <TBODY>
<?
 require("../Clases/Objetos/detalle_ordencompra.php");
 $link=conect();
 $detalle=new Detalle_ordencompra();
 $detalle->conexion($link);
 //echo "Error:".$id;
 $arrdet=$detalle->busqueda_detalle($id);
 $total=0;
if($arrdet!=null)
{ 
        for($renglones=0; $renglones<count($arrdet); $renglones++)
        {
                $preciounit=$arrdet[$renglones][4];
                $preciototal=$preciounit;
                $total+=$preciototal;
                echo "<tr>";              
                echo "<td><input type='checkbox' value='".$arrdet[$renglones][0]."'></td>".//detalle_cotizacion_id
                "<td>" .$arrdet[$renglones][1]. "</td>". //producto_id
                "<td>" .$arrdet[$renglones][5]. "</td>". //material_descripcion
                "<td>" .$arrdet[$renglones][2]. "</td>". //cantidad
                "<td>" .$arrdet[$renglones][6]. "</td>". //prefijo
                "<td title='".$arrdet[$renglones][4]."' multip='".$arrdet[$renglones][6]."'>".number_format($preciounit, 2, '.', ''). "</td>" .
                "<td>".number_format($preciototal, 2, '.', '')."</td>".
                "</tr>";
        }
}

?>
    </TBODY>
  </TABLE>
  
  <LABEL for="mtotal">Monto Total:$</LABEL>
  <INPUT type="text" name="mtotal" id="mtotal" class="text ui-widget-content ui-corner-all" style="width:100px;" align="right" <? echo "value='".number_format($total, 2, '.', '')."'"; ?>readonly />
  <!--<INPUT type='checkbox'id="checkcurrency" name="checkcurrency" onChange="activatePanelCurrency(this)"/> 
 
  <LABEL for="checkcurrency">Cambiar Divisa</LABEL>-->
  <?
    require("../Clases/Objetos/moneda.php");
   $moneda=new Moneda();
   $moneda->conexion($link);
   $arrmoneda=$moneda->busqueda_parametros("",0,10);
   echo "<LABEL class='ui-widget' for='moneda'>Moneda:</LABEL>
   <select name='moneda' id='moneda' class='ui-widget' style='max-width:100px;' onChange='selectMoneda(this)'>";
   if($arrmoneda!=null)
   {
           for($row=0; $row<count($arrmoneda);$row++)
           {
                   echo "<option value='".$arrmoneda[$row][0]."' title='".$arrmoneda[$row][1]."' tipo_cambio='".$arrmoneda[$row][3]."'";
                   if($arrmoneda[$row][0]==$array[0])
                                echo "selected"; 
                   echo ">".$arrmoneda[$row][2]."</option>";
           }
   }
   else
   {
                echo "<option value='0'>Sin Resultados</option>";
   }
   echo "</select>";
  ?>
   
 

</DIV>
<BUTTON id="agregar-producto">Agregar Producto</BUTTON>
<BUTTON id="quitar-producto">Quitar Producto</BUTTON>
<DIV id="div-attach" style="padding-top:10px;">
<BUTTON id="attach-file">Adjuntar Documentos</BUTTON>
</DIV>
<DIV id="formato" style="padding-top:10px; padding-bottom:10px;">
<H1>Formato:</H1>
<!--<INPUT type="radio" name="formato-cot" id="FOV-01" class="ui-widget-content" checked="checked"/>
<LABEL for="FO-VEN-01">FOVEN-01</LABEL>
<INPUT type="radio" name="formato-cot" id="FOV-02"  class="ui-widget-content" />-->
<LABEL for="FO-VEN-02">FOVEN-02</LABEL>
<BUTTON id="vista-previa">Vista Previa</BUTTON>
</DIV>
<DIV id="divguardar" style="padding-top:10px; padding-bottom:10px;">
<BUTTON id="guardar-orden">Guardar</BUTTON>
<BUTTON id="continuar-orden">Enviar</BUTTON>
</DIV>
<DIV id="status_regis" class="ui-widget">
</DIV>

</div>


<?
//Inicia Pie de Página
piepagina();
?>
