<? // Inicia Página
require_once("index_header.php");
  $user=sesiones_start();
  librerias();
  librerias_dateP();
  scripts_head("../Clases/javascript/busqueda_material.js");
  scripts_head("../Clases/javascript/nuevacotizacion.js");
  encabezado_BIG();
?>

<H2>
<a  href="cotizacion_busqueda_usuario.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>
  Nueva Cotización</H2>
<DIV id="varcot">
<?
//aqui le asigno a un input invisible el usuario y el no. de cotizacion
echo "<input id='usuario' value='".$user."'/>";
echo "<input id='cotizacion' value=''/>";
echo "<input id='folio' value='0'/>";
?>  
</DIV>  
<DIV>
<?
/*$perfil=$_POST['perfil'];
echo "perfil:".$perfil;*/
?>

<FORM>
<FIELDSET>



<?

?>

 

  
   <INPUT  type="radio" name="tipocotizacion" id="tipo-estandar" class="radio ui-widget-content" checked="checked"/>

   <INPUT  type="hidden" name="tipocotizacion" id="tipo-servicio" class="radio ui-widget-content" />
   <BR>
    <BR>
  

<?
   require("../Clases/Objetos/empresa.php");
   require_once("../Clases/Conexion/conexion_prueba_local.php");
  $link=conect();
   $empresa=new Empresa();
   $empresa->conexion($link);
   $array=$empresa->busqueda_parametros("",0,10);
   echo "<LABEL class='ui-widget' for='empresa'>Empresa:</LABEL>
   <select name='empresa' id='empresa' class='ui-widget' style='max-width:250px;' onChange='selectEmpresa(this)'>";
   if($array!=null)
   {
	   echo "<option value='0'>-Seleccione Empresa-</option>";
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
<table>
<LABEL class="ui-widget" for="datepicker"> Fecha de Cotización: <input name="datepicker" type="text" id="datepicker" width="100"  style="width:100px;"<? echo "value='".date('Y/m/d')."'";?>  />
</LABEL>
</table>

<DIV id="panelcliente" style="padding-top:10px;">
<table>
<tr>
<td>
  <LABEL class="ui-widget" for="cliente">Cliente:</LABEL>
  <INPUT type="text" name="cliente" id="cliente" class="text ui-widget-content ui-corner-all" onKeyUp="showResultCliente(this.value)" onclick="showResultCliente(this.value)" width="200" maxlength="20"  style="width:300px"  idcliente="0" />
  <DIV id="livecliente" class="texto_lista_chico" style="position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100;"></DIV>
</td>
<td>
  <LABEL class="ui-widget" for="contacto">AT'N:</LABEL>
  <INPUT type="text" name="contacto" id="contacto" value=" " class="text ui-widget-content ui-corner-all" onclick="showResultContacto(this.value)" width="200" maxlength="20"  idcontacto="null" />
  <DIV id="livecontacto" class="texto_lista_chico" style="position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100;"></DIV>
</td>
<td>
  <LABEL class="ui-widget" for="puesto">Puesto/Departamento:</LABEL>
  <INPUT type="text" name="puesto" id="puesto" value="Compras" class="text ui-widget-content ui-corner-all"  style="width:300px"  />
  <DIV id="livecliente" class="texto_lista_chico" style="position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100;"></DIV>
</td>
</tr>
</table>


<LABEL class="ui-widget" for="mensaje">Leyenda:</LABEL>

<br>
<TEXTAREA id="mensaje" style="width:800px;">Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.</TEXTAREA>
</FIELDSET> 
</FORM>
   
</DIV>


<DIV id="dialog-form" title="Ingresar Producto" height="800">
  <FORM>
  <FIELDSET>
  	
   

<?
/*
 echo "<td class='texto_chico_tabla' style='font-size:12px;'>Categoría</td>
          <td width='100'> ";
      require("../Clases/Objetos/material_tipo.php");
      $material_tipo=new Material_tipo();
      $material_tipo->conexion($link);

echo "<select name='tipo'  style='max-width:100px;'>";
                          $array_mat=$material_tipo->detalle();
                          $renglones=0;

echo "<option value='0'>--Todos--</option> ";

                          for($renglones=0; $renglones<count($array_mat);$renglones++)
                            {
                   s           echo "<option value='".$array_mat[$renglones][0]."'";
                            echo  ">".$array_mat[$renglones][2]."</option>";
                            }


echo "
            </select>
      </td>";
      */
?>



   
    <LABEL style="width:50px;" for="producto">Producto:</LABEL>
    <INPUT type="text" name="producto" id="producto" class="text ui-widget-content ui-corner-all" onKeyUp="showResult(this.value)" placeholder="Buscar Producto"   style="width:400px;" IDPRODUCTO="0" value=""/>
    <a id="add_material" href="material_registro.php"  title="Agregar Nuevo Material"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></A>
    &nbsp;&nbsp;&nbsp;<DIV id="livesearch" class="ui-widget" style="position:absolute; overflow:auto; padding-top:0px;background-color:#FFF;z-index:100;"></DIV>
        <BR>
    <LABEL style="width:50px;" for="existencia">Existencia:</LABEL>
    <INPUT type="text" name="existencia" id="existencia" class="text ui-widget-content ui-corner-all"  value="0" style="width:100px;" readonly />
    
    <table id="cAlmacen">
      <THEAD >
      <TR>
      <th>Almacen</th>
      <th>Cantidad en Existencia</th>
       </TR>
    </THEAD>
    <TBODY>
    </TBODY>
    </table>
    <BR>
    <LABEL style="width:50px;" for="cantidad">Cantidad:</LABEL>
    <INPUT type="text" name="cantidad" id="cantidad" class="text ui-corner-all"   onKeyUp="calcularMontos(this.value)" style="width:100px;background-color: #F2F5A9;" />

    <LABEL style="width:50px;" for="preciobase">Precio: $</LABEL>
    <INPUT type="text" name="preciobase" id="preciobase" class="text ui-corner-all" onKeyUp="calcularMontosProductos(document.getElementById('cantidad').value)"  style="width:100px;background-color: #F2F5A9;"  />
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
    <LABEL style="width:50px;" for="cantidad-promo">Añadir:</LABEL><INPUT type="text" name="cantidad-promo" id="cantidad-promo" class="text ui-widget-content ui-corner-all"  style="width:100px;"   onKeyUp="calcularPromo(this.value)" readonly="readonly"/>
    <BR>
    <LABEL style="width:50px;" for="preciounit">Precio U.:</LABEL>
    <INPUT type="text" name="preciunit" id="preciounit" class="text ui-widget-content ui-corner-all"  style="width:100px;" readonly />
    <LABEL style="width:50px;" for="total">Total:</LABEL>
    <INPUT type="text" name="total" id="total" class="text ui-widget-content ui-corner-all" style="width:100px;" readonly />
    <BR>
    <LABEL style="width:50px;" for="observaciones">Observaciones:</LABEL>
    <INPUT type="textarea" name="observaciones" id="observaciones" class="text ui-widget-content ui-corner-all" style="width:300px;" maxlength="300" />
  </FIELDSET>
  </FORM>
</DIV>
<DIV id="dialog-servicios" title="Ingresar Producto" height="700">
  <FORM>
  <FIELDSET>
    <LABEL style="padding-up:-10px;">*Todos los precios son en Moneda Nacional</LABEL>
    <BR>
    <LABEL style="width:50px;" for="servicio">Servicio:</LABEL>
    <INPUT type="text" name="servicio" id="servicio" class="text ui-widget-content ui-corner-all"   style="width:300px;" IDSERVICIO="null" value="" />
    &nbsp;&nbsp;&nbsp;
    <BR>
    <LABEL style="width:50px;" for="cantidad-servicio">Cantidad:</LABEL>
    <INPUT type="text" name="cantidad-servicio" id="cantidad-servicio" class="text ui-widget-content ui-corner-all"  value="0" onKeyUp="calcularMontosServicio(this.value)" style="width:100px;"  />

    <LABEL style="width:50px;" for="preciobase-servicio">Precio:</LABEL>
    <INPUT type="text" name="preciobase-servicio" id="preciobase-servicio" class="text ui-widget-content ui-corner-all"  onKeyUp="calcularMontosServicio(document.getElementById('cantidad-servicio').value)"  style="width:100px;"   />
    <BR>
    <INPUT  type="radio" name="promo-servicio" id="aumento-servicio" class="radio ui-widget-content" checked="checked"/><LABEL for="aumento">Aumento</LABEL>
    <INPUT type="radio" name="promo-servicio" id="descuento-servicio" class="ui-widget-content" />
    <LABEL for="descuento-servicio">Descuento</LABEL>
    <BR>
    <INPUT type="radio" name="valor-servicio" id="porcen-servicio" class="ui-widget-content" checked="checked"/>
    <LABEL for="porcen-servicio">Porcentaje</LABEL>
    <INPUT type="radio" name="valor-servicio" id="real-servicio" class="ui-widget-content" />
    <LABEL for="real">Real</LABEL>
  <BR>
    <BR>
    <LABEL style="width:50px;" for="cantidad-promo-servicio">Añadir:</LABEL><INPUT type="text" name="cantidad-promo-servicio" id="cantidad-promo-servicio" class="text ui-widget-content ui-corner-all"  style="width:100px;" value="0"  onKeyUp="calcularPromoServicio(this.value)" readonly="readonly"/>
    <BR>
    <LABEL style="width:50px;" for="preciounit-servicio">Precio U.:</LABEL>
    <INPUT type="text" name="preciounit-servicio" id="preciounit-servicio" class="text ui-widget-content ui-corner-all"  style="width:100px;" readonly />
    <LABEL style="width:50px;" for="total-servicio">Total:</LABEL>
    <INPUT type="text" name="total-servicio" id="total-servicio" class="text ui-widget-content ui-corner-all" style="width:100px;" readonly />
    <BR>
    <LABEL style="width:50px;" for="observaciones-servicio">Observaciones:</LABEL>
    <INPUT type="textarea" name="observaciones-servicio" id="observaciones-servicio" class="text ui-widget-content ui-corner-all" style="width:100px;" maxlength="300" />
  </FIELDSET>
  </FORM>
</DIV>
<DIV id="products-contain">
  <H1>Productos:</H1>
  <TABLE id="productos" class="myTableRED">
    <THEAD>
      <TR>
        <TH>&nbsp;</TH>
        <TH>Producto</TH>
        <TH>Cantidad</TH>
        <TH>Presentación</TH>
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
    require("../Clases/Objetos/moneda.php");
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
  	<DIV id="ref-pago">

        <LABEL for="vigencia">Precio:</LABEL>
        <INPUT  type="text" name="precio_cotizacion" id="precio_cotizacion" class="text ui-widget-content ui-corner-all" style="width:500px;" align="right" value="En Moneda Nacional más el I.V.A." />
                        <br/>
        <LABEL for="vigencia">L.A.B.:</LABEL>
        <INPUT  type="text" name="lab" id="lab" class="text ui-widget-content ui-corner-all" style="width:500px;" align="right" value="En su Planta" />
                        <br/>
        <LABEL for="condiciones">Forma de pago:</LABEL>
        <INPUT  type="text" name="condiciones" id="condiciones" class="text ui-widget-content ui-corner-all" style="width:500px;" align="right" value="Neto contra entrega de material, remisiones y facturas correspondientes" />
                <br/>
        <LABEL for="vigencia">Vigencia de Precios:</LABEL>
        <INPUT  type="text" name="vigencia" id="vigencia" class="text ui-widget-content ui-corner-all" style="width:500px;" align="right" value="" />
        <br/>
        <LABEL for="dias_entrega">Capacidad de Entrega:</LABEL>
        <INPUT type="text" name="capacidad_entrega" id="capacidad_entrega" class="text ui-widget-content ui-corner-all" style="width:500px;" align="right" value="El requerido por ustedes de acuerdo al programa acordado."/>
        <br/>
                        
        <LABEL for="dias_entrega">Tiempo de Entrega:</LABEL>
        <INPUT type="text" name="dias_entrega" id="dias_entrega" class="text ui-widget-content ui-corner-all" style="width:500px;" align="right" value="Inmediata con previa recepción de la orden de compra"/>
        <br/>
        <INPUT type='checkbox' id="check_flete" name="check_flete" checked/> 
        <LABEL for="check_flete" class='ui-widget'>Incluir Flete en el formato de Cotización?</LABEL>
        <br/>

        <INPUT type='checkbox' id="check_existencias" name="check_existencias" checked/> 
        <LABEL for="check_existencias" class='ui-widget'>Incluir Existencias en el formato de Cotización?</LABEL> 
<select id='almacen' name='almacen' style='width: 200px; max-width:200px;'>";

<?
    require("../Clases/Objetos/almacen.php");
    $almacen=new Almacen();
    $almacen->conexion($link);
    $array=$almacen->detalle_almacen_taller();
    $renglones=0;
    for($renglones=0; $renglones<count($array);$renglones++)
      {
        echo "<option value='".$array[$renglones][0]."' almacen_tipo='".$array[$renglones][2]."'>".$array[$renglones][1]."</option>";
      }

         echo   "</select>";

?>
        <br/>

 <BR>
	</DIV>
</DIV>

<BUTTON id="agregar-producto">Agregar Producto</BUTTON>
<BUTTON id="agregar-servicio">Agregar Servicio</BUTTON>
<BUTTON id="quitar-producto">Quitar Producto</BUTTON>
<!--<DIV id="div-attach" style="padding-top:10px;">
<BUTTON id="attach-file">Adjuntar Documentos</BUTTON>
</DIV>-->

<DIV id="formato" style="padding-top:10px; padding-bottom:10px;">
<H1>Formato:</H1>
<!--<INPUT type="radio" name="formato-cot" id="FOV-01" class="ui-widget-content" checked="checked"/>
<LABEL for="FOV-01">FOVEN-01</LABEL>-->
<INPUT type="radio" name="formato-cot" id="FOV-02"  class="ui-widget-content" checked="checked"/>
<LABEL for="FOV-02">FOVEN-02</LABEL>



<BUTTON id="vista-previa">Vista Previa</BUTTON>
<br>

</DIV>
<DIV id="divguardar" style="padding-top:10px; padding-bottom:10px;">
<BUTTON id="guardar-cotizacion">Guardar</BUTTON>
<BUTTON id="continuar-cotizacion">Enviar</BUTTON>
<BUTTON id="generar_excel">Generar Excel</BUTTON>
</DIV>

<DIV id="dialog_adjuntar" title="Desea Adjuntar?">
  <!--
<LABEL for="passmail">Contraseña:</LABEL>
<INPUT type="password" name="passmail" id="passmail" class="text ui-widget-content ui-corner-all"  value=""  style="width:100px;"/>
-->
<table>
<tr>
</tr>
</table>
 <BR>
 <BR>

</DIV>

<DIV id="dialog_mail" title="Enviar Correo Electrónico">
  <!--
<LABEL for="passmail">Contraseña:</LABEL>
<INPUT type="password" name="passmail" id="passmail" class="text ui-widget-content ui-corner-all"  value=""  style="width:100px;"/>
-->
<br />
<table>
  <tr>
    <td valign="top" align="right">
    <LABEL for="tomail">Para:</LABEL>
    </td>

    <td style="padding-left:15px;">
    <input name="tomail" id="tomail" class="text ui-widget-content ui-corner-all" style="width:400px;"/>
    </td>
</tr> 
  <tr>
    <td valign="top" align="right">
    <LABEL for="tomail_2">CC:</LABEL>
    </td>

    <td style="padding-left:15px;">
    <input name="tomail_2" id="tomail_2" class="text ui-widget-content ui-corner-all" style="width:400px; "/>
    </td>
</tr> 
  <tr>
    <td valign="top" align="right">
    <LABEL for="tomail_3">CC:</LABEL>
    </td>

    <td style="padding-left:15px;">
    <input name="tomail_3" id="tomail_3" class="text ui-widget-content ui-corner-all" style="width:400px;"/>
    </td>
</tr> 
  <tr>
    <td valign="top" align="right">
    <LABEL for="tomail_4">CC:</LABEL>
    </td>

    <td style="padding-left:15px;">
    <input name="tomail_4" id="tomail_4" class="text ui-widget-content ui-corner-all" style="width:400px;"/>
    </td>
</tr> 
<tr>
    <td valign="top" align="right">
    <LABEL for="msgmail">Mensaje:</LABEL> 


    </td>

    <td style="padding-left:15px;">
    <textarea name="msgmail" id="msgmail" class="text ui-widget-content ui-corner-all" style="width:400px; height:100px;" value="POR ESTE MEDIO LE ANEXO COTIZACIÓN SOLICITADA."/>POR ESTE MEDIO LE ANEXO COTIZACIÓN SOLICITADA.</textarea>
    </td>

  </tr>
</table>
</DIV>

<DIV id="dialog_instrucciones1" title="Instrucciones: ">
  
<table>
<tr>
 <LABEL for="liena4"><h1>Siguiente Paso: </h1></LABEL> 
</tr>
<tr>
 <img src='../imagenes/ventas2.png'  height="400" width="550" /> 
</tr>
</table>
 <BR>
 <BR>

</DIV>

<DIV id="status_regis" class="ui-widget">
</DIV>

<?
//Inicia Pie de Página
piepagina();
?>

