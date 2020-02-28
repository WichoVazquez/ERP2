

<?// Inicia Página
require_once("index_header.php");
  $user=sesiones_start();
  librerias();
  scripts_head("../Clases/javascript/edicion_calidad.js");

  encabezado();

?>

  <script>
  $(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
  });



  </script>


<H2>Detalle de Control de Calidad</H2>
<DIV id="varcot">
<?
//aqui le asigno a un input invisible el usuario y el no. de cotizacion
echo "<input id='usuario' value='".$user."'/>";
echo "<input id='calidad' value='".$cal."'/>";
echo "<input id='folio' value='0'/>";
?>  
</DIV>  
<DIV>
<?
/*$perfil=$_POST['perfil'];
echo "perfil:".$perfil;*/
?>


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
        <TH>Precio</TH>
        <TH>Monto</TH>
        <TH>Observaciones</TH>
      </TR>
    </THEAD>
    <TBODY>
<?
?>
    </TBODY>
  </TABLE>
  
  <LABEL for="mtotal">Monto Total:$</LABEL>
  <INPUT type="text" name="mtotal" id="mtotal" class="text ui-widget-content ui-corner-all" style="width:100px;" align="right" readonly />
  <!--<INPUT type='checkbox'id="checkcurrency" name="checkcurrency" onChange="activatePanelCurrency(this)"/> 
 
  <LABEL for="checkcurrency">Cambiar Divisa</LABEL>-->
  <?
    require("../Clases/Conexion/conexion_prueba_local.php");
    require("../Clases/Objetos/moneda.php");
    $link=conect();
    
   $moneda=new Moneda();
   $moneda->conexion($link);
   $array=$moneda->busqueda_parametros("",0,10);
   echo "<LABEL class='ui-widget' for='moneda'>Moneda:</LABEL>
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
<BUTTON id="agregar-producto">Agregar Producto</BUTTON>
<BUTTON id="quitar-producto">Quitar Producto</BUTTON>
<DIV id="div-attach" style="padding-top:10px;">
<BUTTON id="attach-file">Adjuntar Documentos</BUTTON>
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
<BUTTON id="guardar-orden">Guardar</BUTTON>
<BUTTON id="continuar-orden">Enviar</BUTTON>
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