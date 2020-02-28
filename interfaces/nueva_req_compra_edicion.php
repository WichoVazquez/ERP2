

<?// Inicia Página
require_once("index_header.php");
  $user=sesiones_start();
  librerias();
  scripts_head("../Clases/javascript/editar_reqcompra.js");
  scripts_head("../Clases/javascript/busqueda_material.js");

  encabezado_BIG();
 $id=$_GET["id"];

  require_once("../Clases/Conexion/conexion_prueba_local.php");
  require_once("../Clases/Objetos/pedido.php");
  require_once("../Clases/Objetos/detalle_pedido.php");
  require_once("../Clases/Objetos/requisicion_compra.php");
  
  require_once("../Clases/Objetos/proveedor.php");
  $link=conect();
  $req_compra=new Req_compra();
  $req_compra->conexion($link);
  
  $proveedor=new Proveedor();
  $proveedor->conexion($link);

  $array_req=$req_compra->busqueda_detalle($id);
 
  $arrdet=$proveedor->detalle($id);



?>

  <script>
  $(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
  });



  </script>


<H2>
<a  href="req_busqueda_usuario_almacen.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>
  Nueva Requisición de Compra</H2>
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



<LABEL class="ui-widget" for="empresa">Empresa:</LABEL>
<INPUT type="text" name="empresa" id="empresa" class="text ui-widget-content ui-corner-all" <? echo "idempresa='".$array_req[12]."' value='".$array_req[8]."'"; ?> /> 
<BR>
<BR>
 



<p><LABEL class="ui-widget" for="datepicker"> Fecha Requerida: <input name="datepicker" type="text" id="datepicker"  <? echo " value='".$array_req[2]."'"; ?> /></p>
<br>
<LABEL class="ui-widget" for="proyecto">PROYECTO, OBRA, CONTRATO (SEGÚN EL CASO): </LABEL>
<br>
<TEXTAREA id="proyecto" style="width:450px;" maxlength="500"  ><? echo $array_req[9]; ?></TEXTAREA>
<br>
<LABEL class="ui-widget" for="descripcion">DESCRIPCION DE LOS TRABAJOS A REALIZAR CON LA COMPRA:</LABEL>
<br>
<TEXTAREA id="descripcion" style="width:450px;" maxlength="500" ><? echo $array_req[10]; ?></TEXTAREA>
<br>
<LABEL class="ui-widget" for="lugar_entrega">LUGAR DE ENTREGA DEL PRODUCTO Y/O SERVICIO: </LABEL>
<br>
<TEXTAREA id="lugar_entrega" style="width:450px;" maxlength="500"><? echo $array_req[11]; ?></TEXTAREA>
<br>
<LABEL class="ui-widget" for="especificaciones"><B>ESPECIFICACIONES ESPECIALES: </B></LABEL>
<br>
  <TEXTAREA id="especificaciones" style="width:450px;" maxlength="500" ><? echo $array_req[6]; ?></TEXTAREA>
<br>

<!--
<LABEL class="ui-widget" for="cliente">Cliente:</LABEL>
<INPUT type="text" name="cliente" id="cliente" class="text ui-widget-content ui-corner-all" onKeyUp="showResultCliente(this.value)" onclick="showResultCliente(this.value)" width="200" maxlength="20" idcliente=0 />
<DIV id="livecliente" class="texto_lista_chico" style="position:absolute; overflow:auto; padding-top:0px; background-color:#FFF;z-index:100;"></DIV>
-->




</FIELDSET> 
</FORM>
   
</DIV>
 <BUTTON id="agregar-producto">Agregar Producto</BUTTON>
<BUTTON id="quitar-producto">Quitar Producto</BUTTON>
</DIV>
<DIV id="dialog-form" title="Ingresar Producto">
  <FORM>
  <FIELDSET>
  
    
    <LABEL style="width:50px;" for="producto">Producto:</LABEL>
    <INPUT type="text" name="producto" id="producto" class="text ui-widget-content ui-corner-all" onKeyUp="showResult(this.value)" style="width:400px;" IDPRODUCTO="0" value=""/>
    &nbsp;&nbsp;&nbsp;<DIV id="livesearch" class="ui-widget" style="position:absolute; overflow:auto; width:400px; padding-top:0px;background-color:#FFF;z-index:100;"></DIV>
    <BR>
    <LABEL style="width:50px;" for="cantidad">Cantidad:</LABEL>
    <INPUT type="text" name="cantidad" id="cantidad" class="text ui-widget-content ui-corner-all"  value="0" onKeyUp="calcularMontos(this.value)" style="width:100px;"  readonly="readonly"/>

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
<BR>
<div id="sentencias" class="content">
 <?
 require_once("../Clases/Objetos/detalle_reqcompra.php");
    $req_compra_det=new Detalle_reqcompra();
  $req_compra_det->conexion($link);
 $array_req_det=$req_compra_det->busqueda_detalle($id);
 //echo "id ".$id;
  if($array_req_det!=null)
  { 
     //echo "".count($array_req_det);
     echo "
        <table class='myTable' id='prueba_compra'>
          
            <TH></TH>
        <TH>Clave</TH>
        <TH>Producto</TH>
        <TH>Cantidad</TH>
        <TH>Unidad</TH>
        <TH>Observaciones</TH>
            
        ";
          $cont=0;
    for($renglones=0; $renglones<count($array_req_det);$renglones++)
    {
      $prueba=$array_req_det[$renglones][0];
          echo "<tr>";
            echo "<td><input type='checkbox' name='checkmaterial' value='".$array_req_det[$renglones][1]."' idedit='".$array_req_det[$renglones][1]."' checked></td>";
            echo "<td>".$array_req_det[$renglones][4]."</td>";
              
              echo "<td>".$array_req_det[$renglones][6]."</td>";
              echo "<td>".$array_req_det[$renglones][3]."</td>";
              
              echo "<td>".$array_req_det[$renglones][5]."</td>";
              echo "<td>".$array_req_det[$renglones][9]."</td>";
              
      /*        echo "<td class='texto_chico_tabla'><a href=\"javascript:detalle_material(".$array[$renglones][0].")\">Ver</a></td>"; */
              
            echo "</tr>";
       
    }
            echo "</table>";

            


  }
  else
  {
    echo "Búsqueda sin Resultados";
  }
  
  
 ?>
 </div>
  <BR>
 
  <DIV id="divguardar" style="padding-top:10px; padding-bottom:10px;">
<BUTTON id="Guardar-Borrador">Guardar</BUTTON>
<BUTTON id="guardar-orden">Guardar Prueba</BUTTON>

<BUTTON id="Cancelar">Regresar</BUTTON>

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
