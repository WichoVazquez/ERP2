<? // Inicia Página
require_once("index_header.php");
  $user=sesiones_start();
  librerias();
  scripts_head("../Clases/javascript/nueva_compra_usuario.js");
  scripts_head("../Clases/Verificadores/general.js");
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
<a  href="COMPRAS.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>
  Nueva Orden de Compra</H2>
<DIV id="varcot">
<?
//aqui le asigno a un input invisible el usuario y el no. de cotizacion
echo "<input id='usuario' value='".$user."'/>";
echo "<input id='requisicion' value=''/>";
echo "<input id='folio' value='0'/>";
echo "<input id='ordenno' value='0'/>";


?>  
</DIV>  



<!--   ****************************************************************-->

<BUTTON id="agregar-req" style="border-top:10px;">Seleccionar Requisición</BUTTON> 

 <DIV id="dialog-form-req" title="Seleccionar Requisición de Compra">
  <FORM>
  <FIELDSET>
    <LABEL style="padding-up:-10px;">Selecciona la requisición de Compra:</LABEL>
    <table id="Orden" class="ui-widget ui-widget-content">
      <thead>
        <tr class="ui-widget-header ">
           <th>&nbsp;</th>
          <th>Folio</th>
          <th>Empresa</th>
          <th>Usuario</th>
          <th>Fecha Craeción</th>
          <th>Fecha Requerida </th>
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
           <TH>Costo</TH>
         
        

      </thead>
      <tbody>

      </tbody>
    </table>
  
  </FIELDSET>
  </FORM>

</div>



<!-- Estas cosas de sucursales y la ctm -->

<DIV id="orders-contain_cotizacion" class="ui-widget">

<h1>Datos de la Requisición No. <INPUT  name="id_req" id="id_req"  readonly style="width:200px;background-color:#D3D3D3" IDREQBUSCA="null" value=""/>
</h1>    
        
   
   
<table>

<tr>

    <td  style="width:100px;"> 
      <LABEL style="width:100px; " for="usuario_req">Solicitante:</LABEL>

    </td>

    <td  style="width:100px;"> 
        <INPUT type="text" name="usuario_req" id="usuario_req"  readonly style="width:300px; background-color:#D3D3D3;" IDEMPRESACOT="null" value=""/>
    </td>

   <td  style="width:100px;"> 

  <LABEL style="width:100px;" for="empresa_req">Empresa:</LABEL>
      </td>

    <td  style="width:100px;"> 
      <INPUT type="text" name="empresa_req" id="empresa_req"  readonly style="width:300px; background-color:#D3D3D3;" IDCLIENTECOT="null"  value=""/>

    </td>  

</tr>

</table>

 <DIV id="panelchecktotal"  class="ui-widget">
<table>
  <tr>
  
  <td width='100px'>
           <LABEL style="width:100px;" for="tipo_orden">Tipo: </LABEL>
    </td>

  <td width='200px'>
 
           <select name='tipo_orden' id='tipo_orden' class='ui-widget' style='max-width:200px;'>
            <option value='0'>--Seleccione Opción--</option>
            <option value='MISC'>MISCELANEAS</option>
            <option value='N'>NORMALES</option>
          </select>
    </td>
 
 <td width='200px'>
        <LABEL class="ui-widget" for="datepicker1"> Fecha de Creación:
  </td>
<td width='200px'>
<input name="datepicker1" class="ui-widget-content" readonly style="width:100px;" required type="text" id="datepicker1" />

    </td>
  <td width='200px'>
        <LABEL class="ui-widget" for="datepicker2"> Fecha de Entrega:
  </td>
       

 <td width='200px'>

<input name="datepicker2" class="ui-widget-content" readonly style="width:100px;" required  type="text" id="datepicker2" />

</td>


 </tr>    

</table>



   <table>
<tr>
  <td>
    <LABEL class="ui-widget" for="proveedor">Proveedor:</LABEL>

  </td>
  <td>
    <INPUT type="text" name="proveedor" id="proveedor"  style="width:350px;" onKeyUp="showResultProveedor(this.value)" width="300" maxlength="20" idproveedor="0" placeholder="Buscar Proveedor"/>
    <DIV id="liveproveedor" class="texto_lista_chico" style="position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100; width:350px;"></DIV>

  </td>
  <td>
    <LABEL class="ui-widget" for="contacto">AT'N:</LABEL>
    
  </td>

  <td>
     <INPUT type="text" name="contacto" id="contacto"  style="width:250px;" width="300" maxlength="20"/>

  </td>

</tr>

<tr>
  <td>
     <LABEL class="ui-widget" for="email_contacto">EMAIL:</LABEL>
  </td>
  <td>
     <INPUT type="text" name="email_contacto" id="email_contacto"  style="width:300px;" width="300" maxlength="100"/>
  </td>

 <td>
     <LABEL class="ui-widget" for="tel_contacto">TELÉFONO:</LABEL>
  </td>
  <td>
     <INPUT type="text" name="tel_contacto" id="tel_contacto"  style="width:250px;" width="300" maxlength="20"/>
  </td>
</tr>
  
  <tr>

</table>

<table>


<tr>
 <td width='150px'>
    <LABEL style="width:150px;" for="condiciones">Condiciones de Pago:</LABEL>
 </td>
<td width='200px'>
 <INPUT type="text" name="condiciones" id="condiciones" class="ui-widget-content"  style="width:600px;" IDOBS="null" value=""/>
</td>
</tr>

<tr>
 <td width='150px'>
    <LABEL style="width:150px;" for="certificado">Certificado de Garantía:</LABEL>
 </td>
<td width='200px'>
           <select name='certificado' id='certificado' class='ui-widget' style='max-width:200px;'>
            <option value='0'>--Seleccione Opción--</option>
            <option value='1'>SI</option>
            <option value='2'>NO</option>
          </select> 
</td>
</tr>

<tr>
<td>
<B> CONTACTO DE ENTEGA</B>
</td>
</tr>
<tr>
 <td width='150px'>
    <LABEL style="width:150px;" for="contacto_entrega">Nombre:</LABEL>
 </td>
<td width='200px'>
 <INPUT type="text" name="contacto_entrega" id="contacto_entrega" class="ui-widget-content"  style="width:600px;" IDOBS="null" value=""/>
</td>
</tr>

<tr>
 <td width='150px'>
    <LABEL style="width:150px;" for="domicilio_entrega">Domicilio:</LABEL>
 </td>
<td width='200px'>
 <INPUT type="text" name="domicilio_entrega" id="domicilio_entrega" class="ui-widget-content"  style="width:600px;" IDOBS="null" value=""/>
</td>

</tr>
<tr>
 <td width='150px'>
   <?
    require("../Clases/Objetos/moneda.php");
    $link=conect();
    $moneda=new Moneda();
    $moneda->conexion($link);
    $array=$moneda->busqueda_parametros("",0,10);
    echo "<LABEL class='ui-widget' for='moneda'>Moneda:</LABEL>
     </td>
     <td width='200px'>
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
</td>

</tr>
</table>


<table>
  <tr>

 <td width='150px'>
    <LABEL style="width:150px;" for="observaciones_ped">Observaciones:</LABEL>
 </td>
<td width='200px'>
 <INPUT type="text" name="observaciones_ped" id="observaciones_ped" class="ui-widget-content"  style="width:350px;" IDOBS="null" value=""/>
</td>

 </tr> 
</table>


<table>


<tr>
<td>
<B> SUBIR COTIZACIÓN</B>
</td>
</tr>

<tr>
<td>
<INPUT name="archivo" type="file" id="archivo" required />
</td>
</tr>

<tr>
<td>
<INPUT name="archivo" type="file" id="archivo" required />
</td>
</tr>

<tr>
<td>
<INPUT name="archivo" type="file" id="archivo" required />
</td>
</tr>

<tr>
<td>
<!--
 <td width='200px'>

   
        <INPUT type='checkbox'id="checktotal" name="checktotal" onChange="activatePanelTotallity(this)"/> 
      
    </td>
-->

    <td width='200px'>
        <DIV id="sucursal" >
       <INPUT type="text" name="sucursales" id="sucursales" value=" " class="width=100px; text ui-widget-content ui-corner-all" onclick="showResultSucursal(this.value)" width="100px" maxlength="100px" idsucursal="null" />
       <DIV id="livesucursal" width="150px" class="texto_lista_chico" style="position:absolute; overflo0w:auto; padding-top:0px; background-color:#FFF;z-index:100; width:200px; "></DIV>
        </DIV>
    </td>


  

 </tr> 




</table>



<BUTTON id="agregar_detalle_req">VER DETALLE REQUISICIÓN</BUTTON>  &nbsp;
<BUTTON id="agregar_producto">Agregar Producto</BUTTON>  &nbsp;
<BUTTON id="agregar_producto_nuevo">Agregar Producto Nuevo</BUTTON>   &nbsp;
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
        <TH>Costo</TH>
     
      </TR>
    </THEAD>
    <TBODY>

    </TBODY>
  </TABLE>
  

  <INPUT type="hidden" name="mtotal" id="mtotal" class="text ui-widget-content ui-corner-all" style="width:100px;" align="right" readonly />

   <BUTTON id="Guardar">Confirmar Orden de Compra</BUTTON> |
<BUTTON id="Cancelar">Regresar</BUTTON>


  <DIV id="panelchecktotal5">
  <INPUT type='checkbox'id="checktotal" name="checktotal" onChange="activatePanelTotal(this)"/> 
  <LABEL for="checktotal">Aumento/Descuento Total</LABEL>
  </DIV>

<DIV id="dialog_instrucciones44" title="Instrucciones: ">

<TABLE >
    <THEAD>
      <TR>
           
      
        <TH><h1>Paso Siguiente: </h1></TH>
        
        
      </TR>
    </THEAD>
    <TBODY>
  <td><img src='../imagenes/compras4.png'  height="400" width="550" /></td>
  
    </TBODY>
  </TABLE>

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
<LABEL style="width:50px;" for="costobase">Costo: $</LABEL>
    <INPUT type="text" name="costobase" id="costobase" class="text ui-widget-content ui-corner-all" onKeyUp="calcularMontosProductos(document.getElementById('cantidad').value)"  style="width:100px;"  />
    <br>



    <LABEL style="width:50px;" for="costobase"></LABEL>
    <INPUT type="hidden" name="costobase" id="costobase" class="text ui-widget-content ui-corner-all"  style="width:100px;"  readonly />
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

<DIV id="dialog_producto_nuevo" title="Ingresar Producto" height="700">
  <FORM>
  <FIELDSET>
   
    <BR>
    <LABEL style="width:50px;" for="producto_desc">Descripción:</LABEL>
    <INPUT type="text" name="producto_desc" id="producto_desc" class="text ui-widget-content ui-corner-all"   style="width:300px;" IDSERVICIO="null" value="" />
    &nbsp;&nbsp;&nbsp;
    <BR>
    <LABEL style="width:50px;" for="cantidad_producto_nuevo">Cantidad:</LABEL>
    <INPUT type="text" name="cantidad_producto_nuevo" id="cantidad_producto_nuevo" class="text ui-widget-content ui-corner-all"  value="0" style="width:100px;"  />

    <LABEL style="width:50px;" for="costobase_producto_nuevo">Costo: $</LABEL>
    <INPUT type="text" name="costobase_producto_nuevo" id="costobase_producto_nuevo" class="text ui-widget-content ui-corner-all"    style="width:100px;"   />
    <BR>
    <LABEL style="width:50px;" for="unidad_producto_nuevo">Unidad de Medida: </LABEL>
    <INPUT type="text" name="unidad_producto_nuevo" id="unidad_producto_nuevo" class="text ui-widget-content ui-corner-all" value="PIEZA"   style="width:100px;"   />
    <INPUT  type="hidden"  name="promo-servicio" id="aumento-servicio" class="radio ui-widget-content" checked="checked"/>
    <INPUT type="hidden"  name="promo-servicio" id="descuento-servicio" class="ui-widget-content" />
 
    <BR>
    <INPUT type="hidden"  name="valor-servicio" id="porcen-servicio" class="ui-widget-content" checked="checked"/>
 
    <INPUT type="hidden"  name="valor-servicio" id="real-servicio" class="ui-widget-content" />
  
  <BR>
    <BR>
   <INPUT type="hidden"  name="cantidad-promo-servicio" id="cantidad-promo-servicio" class="text ui-widget-content ui-corner-all"  style="width:100px;" value="0"  onKeyUp="calcularPromoServicio(this.value)" readonly="readonly"/>
    <BR>
  
    <INPUT type="hidden"  name="preciounit-servicio" id="preciounit-servicio" class="text ui-widget-content ui-corner-all"  style="width:100px;" readonly />
 
    <INPUT type="hidden" name="total-servicio" id="total-servicio" class="text ui-widget-content ui-corner-all" style="width:100px;" readonly />
    <BR>
   

    <INPUT type="hidden"  name="observaciones-servicio" id="observaciones-servicio" class="text ui-widget-content ui-corner-all" style="width:100px;" maxlength="300" />
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

