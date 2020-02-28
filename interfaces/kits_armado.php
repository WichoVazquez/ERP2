<?
 if(!isset($_SESSION['user']))
{
  require("../Clases/Sesion/checarSesion.php");
  checarSesion();
  //checa perfil de usuario
}
 $user=$_SESSION['user'];
 
?>

<HTML lang="es">
<HEAD>
<META charset="utf-8" />
<META name="description" content="SISTEMA PROMEX">
<TITLE>
  PROMEX    
</TITLE>
<LINK rel="stylesheet" type="text/css" href="public/css/reset.css"/>
<LINK rel="stylesheet" type="text/css" href="public/css/960.min.css"/>
<LINK rel="stylesheet" type="text/css" href="public/css/text.css"/>
<LINK rel="stylesheet" type="text/css" href="public/css/style.css" media="screen"/> 
<!-- css lightbox 
<link rel="stylesheet" type="text/css" href="public/css/lightbox.css" media="screen" />
<!--  css forms-->
<LINK rel="stylesheet" type="text/css" href="public/css/zebra_form.css"/>
<LINK rel="shortcut icon" href="public/images/favicon_prom.png"/>
<LINK rel="image_src" href="public/images/keyphercom_slogan.png"/>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> -->
<SCRIPT type="text/javascript" src="public/js/zebra_form.js"></SCRIPT>
<SCRIPT type="text/javascript" src="public/js/modernizr.js"></SCRIPT>
<SCRIPT src="public/js/prefixfree.min.js"></SCRIPT>    
<!--<noscript>
<link rel="stylesheet" href="public/css/mobile.min.css" />
</noscript>
<script src="/public/js/resolutions.js"></script>
<script src="/public/js/adapt.min.js"></script>-->

<SCRIPT type="text/javascript" src="public/js/jquery.vticker-min.js"></SCRIPT>
<!--<script type="text/javascript" src="public/js/jquery.timer.js" ></script>
<script type="text/javascript" src="public/js/jquery.dwdinanews.0.1.js" ></script>-->
<SCRIPT type="text/javascript" src="public/js/effects.js" ></SCRIPT>
<SCRIPT type="text/javascript" src="public/js/functions.js" ></SCRIPT>
<SCRIPT type="text/javascript" src="public/js/googleplus.js" ></SCRIPT>
  <LINK rel="stylesheet" href="../Clases/Diseño/jquery-ui.css" />
  <SCRIPT src="../Clases/jquery/js/jquery-1.9.1.js"></SCRIPT>
  <SCRIPT src="../Clases/jquery/js/jquery-ui-1.10.3.custom.min.js"></SCRIPT>
  <SCRIPT src="../Clases/javascript/nuevokits.js"></SCRIPT>
  <STYLE>
   /* body { font-size: 62.5%; } * 
    /*label, input { display:block;  }*/
    input.text { margin-bottom:12px; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#dialog-form {background-color: white; border: 1px solid grey;}
    div#products-contain { width: 400px; margin: 20px 0; }
    div#products-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#products-contain table td, div#products-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
	div#uploaded-files { width: 400px; margin: 20px 0; }
    div#uploaded-files table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#uploaded-files table td, div#uploaded-files table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
	.text-label {
    color: #cdcdcd;
    font-weight: bold;
	}
  </STYLE>
  
</HEAD>
<BODY>
<DIV id="contentall" class="container_12">
		<NAV class="grid_7 omega">
				<UL>
						<LI><A href="/" title="Inicio">Inicio</A></LI>
						<LI><A href="login.php?error=3" title="´Salir">Cerrar Sesion</A></LI>
				</UL> 
		</NAV>
	<HEADER class="grid_12">
		<DIV id="logo" class="suffix_1 grid_4 alpha logo-tabla">
<TABLE>
	<TH>
			<H1>
				<A href="/" title="MOGEL FLUÍDOS SA de CV" >
					<IMG src="public/images/logo.png" alt="PROMEX" />
				</A>
			</H1>
	</TH>
	<TH>
	</TH>
</TABLE>
</DIV>	
	</HEADER> 
	<DIV class="clear"></DIV>
	<SECTION class="pagetitle grid_12">
			<UL>
						<LI><A href="index_usuarios.php" title="Inicio" class="active">CATÁLOGOS</A></LI>
						<LI><A href="/" title="VENTAS">VENTAS</A></LI>
						<LI><A href="/" title="COMPRAS">COMPRAS</A></LI>
						<LI><A href="/" title="ALMACEN">ALMACEN</A></LI>
						<LI><A href="/" title="FACTURACION">FACTURACION</A></LI>
						<LI><A href="/" title="REPORTES">REPORTES</A></LI>
				</UL> 
	</SECTION>                    

	<SECTION id="rightbox" class="grid_4">
<DIV class="categorybox">
	
<H2>Armado de Kits</H2>
<DIV id="varcot">
<?
//aqui le asigno a un input invisible el usuario y el no. de cotizacion
echo "<input id='usuario' value='".$user."'/>";
echo "<input id='cotizacion' value=''/>";
echo "<input id='folio' value='0'/>";



?>
</DIV>

<DIV id="panelcliente" style="padding-top:10px;">
<LABEL class="ui-widget" for="kit_descripcion">Nombre del Producto:</LABEL>
<INPUT type="text" name="kit_descripcion" id="kit_descripcion" class="text ui-widget-content ui-corner-all" width="200" maxlength="20" title="" idcliente="0" />
<BUTTON id="IniciaCkitbutton" onClick="iniciakit();" >Crear KIT</BUTTON>


</DIV>  

<DIV id="dialog-form" title="Ingresar Producto">
  <FORM>
  <FIELDSET>
  	<LABEL style="padding-up:-10px;">*Todos los precios son en Moneda Nacional</LABEL>
    <BR>
    <LABEL style="width:50px;" for="producto">Producto:</LABEL>
    <INPUT type="text" name="producto" id="producto" class="text ui-widget-content ui-corner-all" onKeyUp="showResult(this.value)" title=""  style="width:100px;" IDPRODUCTO="0" value=""/>



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
    <BR>
    <LABEL style="width:50px;" for="observaciones">Observaciones:</LABEL>
    <INPUT type="textarea" name="observaciones" id="observaciones" class="text ui-widget-content ui-corner-all" style="width:100px;" maxlength="300" />
  </FIELDSET>
  </FORM>
</DIV>
<DIV id="products-contain" class="ui-widget">
  <H1>Productos y Componentes:</H1>
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
    </TBODY>
  </TABLE>
  
  <LABEL for="mtotal">Monto Total:$</LABEL>
  <INPUT type="text" name="mtotal" id="mtotal" class="text ui-widget-content ui-corner-all" style="width:100px;" align="right" readonly />
  <BR>
   <LABEL for="pkit">Precio de Kit:$</LABEL>
  <INPUT type="text" name="pkit" id="pkit" class="text ui-widget-content ui-corner-all" style="width:100px;" align="right"/>
  <!--<INPUT type='checkbox'id="checkcurrency" name="checkcurrency" onChange="activatePanelCurrency(this)"/> 
 
  <LABEL for="checkcurrency">Cambiar Divisa</LABEL>-->

   
  <DIV id="panelchecktotal">
  <INPUT type='checkbox'id="checktotal" name="checktotal" onChange="activatePanelTotal(this)"/> 
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
<BUTTON id="guardar-kits">Guardar</BUTTON>
<BUTTON id="continuar-cotizacion">Enviar</BUTTON>

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
