

<?// Inicia Página
require_once("index_header.php");
  $user=sesiones_start();
  librerias();
  scripts_head("../Clases/javascript/solicitud_materiales.js");
  scripts_head("../Clases/javascript/busqueda_material.js");

  encabezado_BIG();

?>

  <script>
  $(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
  });



  </script>


<H2>
<a  href="taller_solicitud_material.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>
  Nueva Solicitud de Materiales</H2>
<DIV id="varcot">
<?
//aqui le asigno a un input invisible el usuario y el no. de cotizacion
echo "<input id='usuario' value='".$user."'/>";
echo "<input id='cotizacion' value=''/>";
echo "<input id='folio' value='0'/>";
?>  
</DIV>  
<DIV>


<FORM>
<FIELDSET>


<br>
<br>



<?
   require("../Clases/Objetos/empresa.php");
   require_once("../Clases/Conexion/conexion_prueba_local.php");
    require("../Clases/Objetos/almacen.php");
  $link=conect();
  $almacen=new Almacen();
  $almacen->conexion($link);


  
?>

<LABEL class="ui-widget" for="datepicker"> Solicitar a:</LABEL> <select id='almacen' name='almacen' style='width: 200px; max-width:200px;'>
<?



    $array=$almacen->solo_almacen();
    $renglones=0;
    for($renglones=0; $renglones<count($array);$renglones++)
      {
        echo "<option value='".$array[$renglones][0]."' almacen_tipo='".$array[$renglones][2]."'>".$array[$renglones][1]."</option>";
      }

         echo   "</select>";

?>

 <input name="datepicker" type="hidden" id="datepicker" />

<br>


<!--
<LABEL class="ui-widget" for="cliente">Cliente:</LABEL>
<INPUT type="text" name="cliente" id="cliente" class="text ui-widget-content ui-corner-all" onKeyUp="showResultCliente(this.value)" onclick="showResultCliente(this.value)" width="200" maxlength="20" idcliente=0 />
<DIV id="livecliente" class="texto_lista_chico" style="position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100;"></DIV>
-->




</FIELDSET> 
</FORM>
   
</DIV>
<DIV id="dialog-form" title="Ingresar Producto">
  <FORM>
  <FIELDSET>
  
    
    <LABEL style="width:50px;" for="producto">Producto:</LABEL>
    <INPUT type="text" name="producto" id="producto" class="text ui-widget-content ui-corner-all" onKeyUp="showResult(this.value)" style="width:400px;" IDPRODUCTO="0" value=""/>
    &nbsp;&nbsp;&nbsp;
<a id="add_material" href="material_registro.php"  title="Registro Material"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></A>
    <DIV id="livesearch" class="ui-widget" style="position:absolute; overflow:auto; width:400px; padding-top:0px;background-color:#FFF;z-index:100;"></DIV>
    <BR>
    <LABEL style="width:50px;" for="cantidad">Cantidad:</LABEL>
    <INPUT type="text" name="cantidad" id="cantidad" class="text ui-widget-content ui-corner-all"  value="0" onKeyUp="calcularMontos(this.value)" style="width:100px;"  readonly="readonly"/>
<BR>
    <LABEL style="width:50px;" for="observaciones">Observaciones:</LABEL>
    <INPUT type="text" name="observaciones" id="observaciones" class="text ui-widget-content ui-corner-all"  style="width:400px;" value=""/>

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
<DIV id="products-contain" class="ui-widget">
  <H1>Productos:</H1>
  <TABLE id="productos" class="ui-widget ui-widget-content">
    <THEAD>
      <TR class="ui-widget-header ">
        <TH>&nbsp;</TH>
        <TH>Clave</TH>
        <TH>Producto</TH>
        <TH>Cantidad</TH>
        <TH>Unidad</TH>
      </TR>
    </THEAD>
    <TBODY>
<?
?>
    </TBODY>
  </TABLE>
  

 
  <INPUT type="hidden" name="mtotal" id="mtotal" class="text ui-widget-content ui-corner-all" style="width:100px;" align="right" readonly />
  <!--<INPUT type='checkbox'id="checkcurrency" name="checkcurrency" onChange="activatePanelCurrency(this)"/> 
 
  <LABEL for="checkcurrency">Cambiar Divisa</LABEL>-->
  <?
    
    require("../Clases/Objetos/moneda.php");
    $link=conect();
    
   $moneda=new Moneda();
   $moneda->conexion($link);
   $array=$moneda->busqueda_parametros("",0,10);
   echo "
   <select name='moneda' id='moneda' class='ui-widget' style='max-width:100px;' onChange='selectMoneda(this)'>";
   if($array!=null)
   {
	   for($renglones=0; $renglones<count($array);$renglones++)
	   {
		   echo "<option value='".$array[$renglones][0]."' title='".$array[$renglones][1]."' tipo_cambio='".$array[$renglones][3]."'>".$array[$renglones][2]."</option>";
	   }
   }
   else
   {
		echo "<option value='0'>Sin Resultados</option>";
   }
   echo "</select>";
  ?>
   
  <DIV id="panelchecktotal">
  <INPUT type='checkbox' id="checktotal" name="checktotal" onChange="activatePanelTotal(this)"/> 
  <LABEL for="checktotal">Aumento/Descuento Total</LABEL>
  </DIV>
  <DIV id="descuentototal" style="background-color:#FFF;">
  <H1>Aumento/Descuento Total:</H1>
  <INPUT  type="radio" name="promot" id="aumentot" class="radio ui-widget-content" checked="checked"/><LABEL for="aumentot">Aumento</LABEL>
    <INPUT type="radio" name="promot" id="descuentot" class="ui-widget-content" />
    <LABEL for="descuento">Descuento</LABEL>
	<BR>
    <BR>
    <LABEL style="width:50px;" for="cantidad-promot">Porcentaje(%):</LABEL><INPUT type="text" name="cantidad-promot" id="cantidad-promot" class="text ui-widget-content ui-corner-all"  style="width:100px;" value="0"  onKeyUp="calcularPromot(this.value)"/>
    <LABEL for="mtotalaumento">Total Modificado:$</LABEL>
  <INPUT type="text" name="mtotalaumento" id="mtotalaumento" class="text ui-widget-content ui-corner-all" style="width:100px;" align="right" readonly />
  <BUTTON id="aplicar-desmuento" style="alignment-baseline:middle">Aplicar</BUTTON>
  </DIV>
</DIV>

<br><br><br>
<BUTTON id="agregar-producto">Agregar Producto</BUTTON>
<BUTTON id="quitar-producto">Quitar Producto</BUTTON>
<DIV id="div-attach" style="padding-top:10px;">

</DIV>

<DIV id="formato" style="padding-top:10px; padding-bottom:10px;">
<H1>Formato:</H1>
<INPUT type="radio" name="formato-cot" id="FOV-01" class="ui-widget-content" checked="checked"/>
<LABEL for="FOV-01">FOVEN-01</LABEL>
<INPUT type="radio" name="formato-cot" id="FOV-02"  class="ui-widget-content" />
<LABEL for="FOV-02">FOVEN-02</LABEL>
<BUTTON id="vista-previa">Vista Previa</BUTTON>
</DIV>

<DIV id="divguardar" style="padding-top:10px; padding-bottom:10px;">

<BUTTON id="guardar_solicitud">Confirmar Solicitud de Materiales</BUTTON>

</DIV>



<DIV id="status_regis" class="ui-widget">
</DIV>
</DIV>
</SECTION>
<DIV class="clear"></DIV>
<DIV class="clear"></DIV>
<DIV id="dialog" title="Información">
	
</DIV>
<?
//Inicia Pie de Página
piepagina();
?>
