<? // Inicia Página
require_once("index_header.php");
  $id=$_GET["id"];
  require_once("../Clases/Conexion/conexion_prueba_local.php");
  require_once("../Clases/Objetos/pedido.php");
  require_once("../Clases/Objetos/detalle_pedido.php");
  $link=conect();
  $orden_salida=new Pedido();
  $orden_salida_detalle=new Detalle_pedido();
  $orden_salida->conexion($link);
  $orden_salida_detalle->conexion($link);
  $array_pedido=$orden_salida->Obtiene_detalle_pedido($id);
  $arrdet=$orden_salida_detalle->Obtiene_detalle_pedido($id);


  $user=sesiones_start();
  librerias();
  scripts_head("../Clases/javascript/editar_ordensalida.js");
 // links_style_head("public/css/estilos-ajax.css");
  encabezado_BIG();
?>

<script>
  $(function() {
    $( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
    $( "#datepicker2" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
  });
</script>

<H2>
<a  href="ordenes_salida_busqueda_usuario.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>
  Nuevo Pedido</H2>
<DIV id="varcot">
<?
//aqui le asigno a un input invisible el usuario y el no. de cotizacion
echo "<input id='usuario' value='".$user."'/>";
echo "<input id='cotizacion' value='".$array_pedido[2]."'/>";
echo "<input id='folio' value='".$array_pedido[9]."'/>";
echo "<input id='pedidono' value='".$array_pedido[9]."'/>";
?>  
</DIV>  



<!--   ****************************************************************-->

<BUTTON id="agregar-cotizacion" style="border-top:10px;">Seleccionar Cotizacion</BUTTON> 

 <DIV id="dialog-form-cotizaciones" title="Ingresar Cotizacion">
  <FORM>
  <FIELDSET>
    <LABEL style="padding-up:-10px;">Selecciona las ordenes de Salida</LABEL>
    <table id="Orden" class="ui-widget ui-widget-content">
      <thead>
        <tr class="ui-widget-header ">
           <th>&nbsp;</th>
          <th>Empresa</th>
          <th>Folio</th>
          <th>Cliente</th>
          <th>Fecha Inicio</th>
          <th>Fecha Entrega</th>
          <th>Observaciones</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
   
  </FIELDSET>
  </FORM>
</DIV>
<!--  A QUI VA EL DETALLE DE LAS COTIZACIONES-->

<div id="Mostrar_todo">
<FORM>
  <FIELDSET>
   
    <table id="Orden_sumario" class='myTable'>
      <thead>
            <th> </th>
          <th>Producto </th>
          <th>Unidad</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Monto Total</th>

      </thead>
      <tbody>

      </tbody>
    </table>
  
  </FIELDSET>
  </FORM>

</div>



<!-- Estas cosas de sucursales y la ctm -->

<DIV id="orders-contain_cotizacion" class="ui-widget">

<h1>Datos de la Cotizacion No. <INPUT  name="id_cot" id="id_cot"  readonly style="width:60px;"  <? echo "IDCOTBUSCA='".$array_pedido[2]."' value='".$array_pedido[8]."'"; ?>/>
</h1>    
        
   
   
<table>

<tr>

    <td  style="width:100px;"> 
      <LABEL style="width:100px;" for="empresa_cot">Empresa:</LABEL>

    </td>

    <td  style="width:100px;"> 
        <INPUT type="text" name="empresa_cot" id="empresa_cot"  readonly style="width:300px; background-color:#D3D3D3;" IDEMPRESACOT="null" <? echo "idempresa='".$array_pedido[0]."' value='".$array_pedido[1]."'"; ?>/>
    </td>

   <td  style="width:100px;"> 

  <LABEL style="width:100px;" for="cliente_cot">Cliente:</LABEL>
      </td>

    <td  style="width:100px;"> 
      <INPUT type="text" name="cliente_cot" id="cliente_cot"  readonly style="width:300px; background-color:#D3D3D3;"  <? echo "IDCLIENTECOT='".$array_pedido[3]."' value='".$array_pedido[4]."'"; ?>/>

    </td>  

</tr>

</table>

 <DIV id="panelchecktotal"  class="ui-widget">

<table>
  <tr>
  <td width='100px'>
           <h1>FOLIO:</h1> 
    </td>
  <td width='100px'>

           <INPUT type="text" name="folio_OS" id="folio_OS" class="ui-widget-content" readonly onkeypress="return NumEntero(event)" required style="width:100px;" FOLIOOBS="null"  
           <?echo "value='".$array_pedido[9]."'"?>/>
    </td>

 <td width='200px'>
        <LABEL class="ui-widget" for="datepicker1"> Fecha de Inicio:
  </td>
<td width='200px'>
<input name="datepicker1" class="ui-widget-content" readonly style="width:100px;" required type="text" id="datepicker1" <?echo "value='".$array_pedido[10]."'"?> />

    </td>
  <td width='200px'>
        <LABEL class="ui-widget" for="datepicker2"> Fecha de Entrega:
  </td>
       

 <td width='200px'>

<input name="datepicker2" class="ui-widget-content" readonly style="width:100px;" required  type="text" id="datepicker2" <?echo "value='".$array_pedido[11]."'"?> />

</td>


 </tr>    

</table>



   <table>
  <tr>

 <td width='150px'>
    <LABEL style="width:150px;" for="observaciones_ped">Observaciones:</LABEL>
 </td>
<td width='200px'>
 <INPUT type="text" name="observaciones_ped" id="observaciones_ped" class="ui-widget-content"  style="width:350px;" IDOBS="null" <?echo "value='".$array_pedido[12]."'"?> />
</td>

 <td width='200px'>

   
        <INPUT type='checkbox'id="checktotal" name="checktotal" onChange="activatePanelTotallity(this)"/> 
        <LABEL for="sucursal">Lugar de Destino</LABEL>
    </td>
    <td width='200px'>
        <DIV id="sucursal" >
       <INPUT type="text" name="sucursales" id="sucursales" value=" " class="width=100px; text ui-widget-content ui-corner-all" onclick="showResultSucursal(this.value)" width="100px" maxlength="100px" idsucursal="null" />
       <DIV id="livesucursal" width="150px" class="texto_lista_chico" style="position:absolute; overflo0w:auto; padding-top:0px; background-color:#FFF;z-index:100; width:200px; "></DIV>
        </DIV>
    </td>

  

 </tr> 




</table>



<BUTTON id="agregar-detalle-cot">VER DETALLE COTIZACION</BUTTON>  &nbsp;
<BUTTON id="agregar-producto">Agregar Producto</BUTTON>  &nbsp;
<BUTTON id="agregar-servicio">Agregar Servicio</BUTTON>   &nbsp;
<BUTTON id="quitar-producto">Quitar Producto</BUTTON> &nbsp; 

 </DIV>

<!-- otras chungessillas -->

<DIV id="products-contain" >
  <H1>Productos:</H1>
  <TABLE id="productos" class="myTable">
    <THEAD>
      <TR>
        <TH>&nbsp;</TH>
        <TH>Producto</TH>
        <TH>Cantidad</TH>
        <TH>Unidad</TH>
      </TR>
    </THEAD>
    <TBODY>
  <?

 
 $total=0;
if($arrdet!=null)
{ 
        for($renglones=0; $renglones<count($arrdet); $renglones++)
        {
              $preciounit=$arrdet[$renglones][4]*$arrdet[$renglones][2]/* *moneda*/;
                echo "<tr>";              
                echo "<td><input type='checkbox' value='".$arrdet[$renglones][0]."'></td>".//detalle_cotizacion_id
                "<td>" .$arrdet[$renglones][9]. "</td>". //material_descripcion
                "<td>" .$arrdet[$renglones][2]. "</td>". //cantidad
                "<td>" .$arrdet[$renglones][10]. "</td>". //unidad

                "</tr>";

        }
}
?>
    </TBODY>
  </TABLE>
  




  
  <INPUT type="hidden" name="mtotal" id="mtotal" class="text ui-widget-content ui-corner-all" style="width:100px;" align="right" readonly />
  <!--<INPUT type='checkbox'id="checkcurrency" name="checkcurrency" onChange="activatePanelCurrency(this)"/> 
 
  <LABEL for="checkcurrency">Cambiar Divisa</LABEL>-->

<BUTTON id="Guardar-Borrador">Guardar</BUTTON> 
   <BUTTON id="Guardar">Confirmar Pedido</BUTTON> |
<BUTTON id="Cancelar">Regresar</BUTTON>


  <DIV id="panelchecktotal5">
  <INPUT type='checkbox'id="checktotal" name="checktotal" onChange="activatePanelTotal(this)"/> 
  <LABEL for="checktotal">Aumento/Descuento Total</LABEL>
  </DIV>
  


</DIV>
  


 <div id='separa3'></div>
</DIV>

<!--   ****************************************************************-->


<DIV>

<FORM>
<FIELDSET>

<DIV id="panelcliente" style="padding-top:10px;">
<LABEL class="ui-widget" for="cliente">Cliente:</LABEL>
<INPUT type="text" name="cliente" id="cliente" class="text ui-widget-content ui-corner-all" onKeyUp="showResultCliente(this.value)" width="200" maxlength="20" idcliente=0 />
<DIV id="livecliente" class="texto_lista_chico" style="position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100;"></DIV>
<LABEL class="ui-widget" for="contacto">AT'N:</LABEL>
<INPUT type="text" name="contacto" id="contacto" value=" " class="text ui-widget-content ui-corner-all" onclick="showResultContacto(this.value)" width="200" maxlength="20"  idcontacto="null" />
<DIV id="livecontacto" class="texto_lista_chico" style="position:absolute; overflo0w:auto; padding-top:0px; background-color:#FFF;z-index:100;"></DIV>
<br>

 

<LABEL class="ui-widget" for="mensaje">Leyenda:</LABEL>


<br>
<TEXTAREA id="mensaje" style="width:450px;" maxlength="500"></TEXTAREA>
</FIELDSET> 
</FORM>
   
</DIV>

<DIV id="dialog-form" title="Ingresar Producto" height="700">
  <FORM>
  <FIELDSET>
  
    
    <LABEL style="width:50px;" for="producto">Producto:</LABEL>
    <INPUT type="text" name="producto" id="producto" class="text ui-widget-content ui-corner-all" onKeyUp="showResult(this.value)" style="width:500px;" IDPRODUCTO="0" value=""/>
    &nbsp;&nbsp;&nbsp;<DIV id="livesearch" class="ui-widget" style="position:absolute; overflow:auto; width:500px; padding-top:0px;background-color:#FFF;z-index:100;"></DIV>
    <BR>
    <LABEL style="width:50px;" for="existencia">Existencia:</LABEL>
    <INPUT type="text" name="existencia" id="existencia" class="text ui-widget-content ui-corner-all"  value="0" style="width:100px;" readonly />
    <BR>
    <LABEL style="width:50px;" for="cantidad">Cantidad:</LABEL>
    <INPUT type="text" name="cantidad" id="cantidad" class="text ui-widget-content ui-corner-all"  value="0" onKeyUp="calcularMontos(this.value)" style="width:100px;"  readonly="readonly"/>
<LABEL style="width:50px;" for="preciobase">Precio: $</LABEL>
    <INPUT type="text" name="preciobase" id="preciobase" class="text ui-widget-content ui-corner-all" onKeyUp="calcularMontosProductos(document.getElementById('cantidad').value)"  style="width:100px;"  />
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
<DIV id="dialog-servicios" title="Ingresar Producto" height="700">
  <FORM>
  <FIELDSET>
   
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


    <DIV id="ref-pago">
        <LABEL for="dias_entrega">Tiempo de Entrega(días):</LABEL>
        <INPUT type="number" name="dias_entrega" id="dias_entrega" class="text ui-widget-content ui-corner-all" style="width:30px;" align="right" value="5"/>
        <br/>
        <LABEL for="tiempo-entrega">Condiciones de Pago:</LABEL>
        <INPUT  type="text" name="condiciones" id="condiciones" class="text ui-widget-content ui-corner-all" style="width:100px;" align="right" />
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
</DIV>
<DIV id="divguardar" style="padding-top:10px; padding-bottom:10px;">
<BUTTON id="guardar-cotizacion">Guardar</BUTTON>
<BUTTON id="continuar-cotizacion">Enviar</BUTTON>
</DIV>

<DIV id="dialog_mail" title="Correo Electrónico">
  <!--
<LABEL for="passmail">Contraseña:</LABEL>
<INPUT type="password" name="passmail" id="passmail" class="text ui-widget-content ui-corner-all"  value=""  style="width:100px;"/>
-->
<br />
<table>
<tr>
<td valign="top" align="right">
<LABEL for="msgmail">Mensaje:</LABEL>
</td>
<td style="padding-left:15px;">
<textarea name="msgmail" id="msgmail" class="text ui-widget-content ui-corner-all" style="width:200px; hight:250px;"/></textarea>
</td>
</tr>
</table>
</DIV>
<DIV id="status_regis" class="ui-widget">
</DIV>


<?
//Inicia Pie de Página
piepagina();
?>

