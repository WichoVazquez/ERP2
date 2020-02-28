<?
  require_once("index_header.php");
 $id=$_GET["id"];
 require_once("../Clases/Conexion/conexion_prueba_local.php");
 require_once("../Clases/Objetos/cotizacion.php");
 $link=conect();
 $cotizacion=new Cotizacion();
 $cotizacion->conexion($link);
 //echo "Error:".$id;
 $array=$cotizacion->detalle($id);



  $user=sesiones_start();
  librerias();
  librerias_dateP();
  scripts_head("../Clases/javascript/editarcotizacion.js");
  encabezado_BIG();
  $descuentos=0;
?>

        
<H2><a  href="cotizacion_busqueda_usuario.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>Editar Cotización</H2>
<DIV id="varcot">
<?
echo "<input id='usuario' value='".$array[3]."'/>";
echo "<input id='cotizacion' value='".$id."'/>";
echo "<input id='estado' value='".$array[1]."'/>";
echo "<input id='folio' value='".$array[5]."'/>";
echo "<input id='tipo_cotizacion' value='".$array[22]."'/>";
?>
</DIV>  
<DIV>
<?
/*$perfil=$_POST['perfil'];
echo "perfil:".$perfil;*/
?>

<FORM>
<FIELDSET>
<LABEL class="ui-widget" for="cliente">Empresa:</LABEL>
<INPUT type="text" name='empresa' id='empresa' class="text ui-widget-content ui-corner-all"  width="200" style="width:300px"  <? echo "idempresa='".$array[4]."' value='".$array[14]."'"; ?> readonly/>
<br>
<LABEL class="ui-widget" for="cliente">Cliente:</LABEL>
<INPUT type="text" name="cliente" id="cliente" class="text ui-widget-content ui-corner-all"  width="200" onKeyUp="showResultCliente(this.value)" style="width:300px"   maxlength="20" title="Palabras Clave" <? echo " idcliente='".$array[2]."' value='".$array[13]."'";?>/>
<DIV id="livecliente" class="texto_lista_chico" style="position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100;"></DIV>

<LABEL class="ui-widget" for="contacto" style=" padding-right:22px;">AT'N:</LABEL>
<INPUT type="text" name="contacto" id="contacto" class="text ui-widget-content ui-corner-all"   onKeyUp="showResultContacto(this.value)" width="200" maxlength="20" title="Palabras Clave" <? echo " idcontacto='".$array[11]."' value='".$array[15]."&nbsp;".$array[16]."&nbsp;".$array[17]."'";?> />
<DIV id="livecontacto" class="texto_lista_chico" style="position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100;"></DIV>

<LABEL class="ui-widget" for="datepicker"> Fecha de Cotización: 
<input name="datepicker" type="text" id="datepicker" <? echo "value='".$array[7]."'";?> />


<BR>
<LABEL class="ui-widget" for="mensaje">Leyenda</LABEL>
<BR>
<TEXTAREA id="mensaje" style="width:800px;" MAXLENGTH="500"><? echo "".$array[12]."";?></TEXTAREA>
</FIELDSET> 
</FORM>
   
</DIV>
<DIV id="dialog-form" title="Ingresar Producto" height="700">
  <FORM>
  <FIELDSET>
    <LABEL style="padding-up:-10px;">*Todos los precios son en Moneda Nacional</LABEL>
    <BR>

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
                              echo "<option value='".$array_mat[$renglones][0]."'";
                            echo  ">".$array_mat[$renglones][2]."</option>";
                            }


echo "
            </select>
      </td>";
      */
?>



    <BR>
    <LABEL style="width:50px;" for="producto">Producto:</LABEL>
    <INPUT type="text" name="producto" id="producto" class="text ui-widget-content ui-corner-all" onKeyUp="showResult(this.value)" placeholder="Buscar Producto"   style="width:400px;" IDPRODUCTO="0" value=""/>
    <a id="add_material" href="material_registro.php"  title="Agregar Nuevo Material"><img src='../imagenes/add.png' style="alignment-adjust:middle;" /></A>
    &nbsp;&nbsp;&nbsp;<DIV id="livesearch" class="ui-widget" style="position:absolute; overflow:auto; padding-top:0px;background-color:#FFF;z-index:100;"></DIV>
        <BR>
    <LABEL style="width:50px;" for="existencia">Existencia:</LABEL>
    <INPUT type="text" name="existencia" id="existencia" class="text ui-widget-content ui-corner-all"  value="0" style="width:100px;" readonly />
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
<div id="general-form">
<DIV id="products-contain" class="ui-widget">
  <H1>Productos:</H1>
  <TABLE id="productos" class="myTable">
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
 require("../Clases/Objetos/detalle_cotizacion.php");
 $link=conect();
 $detalle=new Detalle_Cotizacion();
 $detalle->conexion($link);
 //echo "Error:".$id;
 $arrdet=$detalle->busqueda_detalle($id,1);
 $total=0;
if($arrdet!=null)
{ 
        for($renglones=0; $renglones<count($arrdet); $renglones++)
        {
                $preciounit=$arrdet[$renglones][4]*$arrdet[$renglones][6]/* *moneda*/;
                $preciototal=$preciounit*$arrdet[$renglones][2];
                $total+=$preciototal;
                echo "<tr>";              
                echo "<td><input type='checkbox' value='".$arrdet[$renglones][0]."'></td>".//detalle_cotizacion_id
                "<td>" .$arrdet[$renglones][7]. "</td>". //material_descripcion
                "<td>" .$arrdet[$renglones][2]. "</td>". //cantidad
                "<td>" .$arrdet[$renglones][10]. "</td>". //prefijo
                "<td title='".$arrdet[$renglones][4]."' multip='".$arrdet[$renglones][6]."'>$ ".number_format($preciounit, 2, '.', ''). "</td>" .
                "<td monto='".$preciototal."'>$ ".number_format($preciototal, 2, '.', '')."</td>".
                "<td>".$arrdet[$renglones][5]."</td>".
                "</tr>";
				if($arrdet[$renglones][6]<1)
					$descuentos++;
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
                   if($arrmoneda[$row][0]==$array[8])
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
   
  <DIV id="panelchecktotal">
 
  
  </DIV>
  <DIV id="descuentototal" style="background-color:#FFF;">
 
  <INPUT  type="radio" name="promot" id="aumentot" class="radio ui-widget-content" checked="checked"/><LABEL for="aumentot">Aumento</LABEL>
    <INPUT type="radio" name="promot" id="descuentot" class="ui-widget-content" />
    <LABEL for="descuento">Descuento</LABEL>
        <BR>
    <BR>
    <LABEL style="width:50px;" for="cantidad-promot">Porcentaje(%):</LABEL><INPUT type="text" name="cantidad-promot" id="cantidad-promot" class="text ui-widget-content ui-corner-all"  style="width:100px;" value="0"  onKeyUp="calcularPromot(this.value)"/>
    <LABEL for="mtotalaumento">Total Modificado:$</LABEL>
  <INPUT type="text" name="mtotalaumento" id="mtotalaumento" class="text ui-widget-content ui-corner-all" style="width:100px;" align="right" readonly />
  <BUTTON id="aplicar-desmuento" style="alignment-baseline:middle">Aplicar</BUTTON>
  <DIV id="div-descuento" style="visibility:hidden; position:absolute;">
  <?
  	echo "<input id='no_descuentos' value='".$descuentos."' readonly='readonly'/>";
  ?>
  </DIV>
  </DIV>
  <DIV id="ref-pago">


        <LABEL for="vigencia">Precio:</LABEL>
        <INPUT  type="text" name="precio_cotizacion" id="precio_cotizacion" class="text ui-widget-content ui-corner-all" style="width:500px;" align="right"  <? echo "value='".$array[23]."'"; ?>/>
                        <br/>
        <LABEL for="vigencia">L.A.B.:</LABEL>
        <INPUT  type="text" name="lab" id="lab" class="text ui-widget-content ui-corner-all" style="width:500px;" align="right" <? echo "value='".$array[24]."'"; ?>/>
                        <br/>
        <LABEL for="condiciones">Forma de pago:</LABEL>
        <INPUT  type="text" name="condiciones" id="condiciones" class="text ui-widget-content ui-corner-all" style="width:500px;" align="right"  <? echo "value='".$array[20]."'"; ?>/>
                <br/>
        <LABEL for="vigencia">Vigencia de Precios:</LABEL>
        <INPUT  type="text" name="vigencia" id="vigencia" class="text ui-widget-content ui-corner-all" style="width:500px;" align="right" <? echo "value='".$array[21]."'"; ?>/>
        <br/>
        <LABEL for="dias_entrega">Capacidad de Entrega:</LABEL>
        <INPUT type="text" name="capacidad_entrega" id="capacidad_entrega" class="text ui-widget-content ui-corner-all" style="width:500px;" align="right"  <? echo "value='".$array[25]."'"; ?>/>
        <br/>
                        
        <LABEL for="dias_entrega">Tiempo de Entrega:</LABEL>
        <INPUT type="text" name="dias_entrega" id="dias_entrega" class="text ui-widget-content ui-corner-all" style="width:500px;" align="right"  <? echo "value='".$array[19]."'"; ?>/>
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



	</DIV>
</DIV>
</DIV>
<BUTTON id="agregar-producto">Agregar Producto</BUTTON>
<BUTTON id="quitar-producto">Quitar Producto</BUTTON>

<DIV id="formato" style="padding-top:10px; padding-bottom:10px;">
<H1>Formato:</H1>
<!--<INPUT type="radio" name="formato-cot" id="FOV-01" class="ui-widget-content" checked="checked"/>
<LABEL for="FO-VEN-01">FOVEN-01</LABEL>
<INPUT type="radio" name="formato-cot" id="FOV-02"  class="ui-widget-content" />-->
<LABEL for="FO-VEN-02">FOVEN-02</LABEL>
<BUTTON id="vista-previa">Vista Previa</BUTTON>
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
    <LABEL for="tomail">Para:</LABEL>
    </td>

    <td style="padding-left:15px;">
    <textarea name="tomail" id="tomail" class="text ui-widget-content ui-corner-all" style="width:400px; height:100px;"/></textarea>
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
<DIV id="status_regis" class="ui-widget">
</DIV>
<?
//Inicia Pie de Página
piepagina();
?>
