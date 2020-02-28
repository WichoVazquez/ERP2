<?php
 if(!isset($_SESSION['user']))
{
  require("../Clases/Sesion/checarSesion.php");

  checarSesion();
  //checa perfil de usuario
}



require_once("index_header.php");
  $user=sesiones_start();
  librerias();
  links_style_head("public/css/estilos-ajax.css");  
  scripts_head("../Clases/javascript/nueva_factura.js");

  encabezado_BIG();
  

  $user=$_SESSION['user'];
  $idPedido=$_GET['id'];
  $cliente=$_GET['cliente'];
  $empresa=$_GET['empresa'];
  $v2=$_GET['id'];
  $idcliente=$_GET['idcliente'];
  $folioOE=$_GET['folioOE'];
  $folioOS=$_GET['folioOS'];


  require_once("../Clases/Conexion/conexion_prueba_local.php");  
  require_once("../Clases/Objetos/facturar.php");
  $link=conect();
  $factura=new Facturar();
  $factura->conexion($link);
  $RegistrosAMostrar=50;//esto deberia ser dinamico, tiempo??
  $RegistrosAEmpezar=0;
  $PagAct=1;
  $array=$factura->result_detalle_pedido2($idPedido,$folioOE);


echo "<input id='usuario' value='".$user."'/>";

?>
 <h2>

        <a  href="factura_busqueda.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>
        FACTURAR</h2>
<p></p>

  <div id="separa3"></div>
   
  <table>
        <tr >
        
          <td >GUÍA DE EMBARQUE:</td>
          <td colspan="3" class="result">
<? echo "<input id='orden_entrega' type='text' value='".$folioOE."'/>"; ?>
          </td>

    <td width="93">PEDIDO:</td>
    <td colspan="3" class="result"><input id='idPedido' type='text' 
      value='<? echo $folioOS; ?>' /></td>
  </tr>
  <tr>
    <td width="93">EMPRESA.</td>
    <td colspan="3" class="result"><input id='empresa' type='text'
      value='<? echo $empresa; ?>'/></td>

    <td width="93">CLIENTE.</td>
    <td colspan="3" class="result"><input id='cliente' type='text'
       value='<? echo $cliente; ?>'/></td>
    </tr>

        <tr>
    <td width="93">CLAVE CLIENTE</td>
    <td colspan="3" class="result"><input id='idcliente' type='text'
       value='<? echo $idcliente; ?>'/></td>


    
       

  </table>

 <button id="Generar_factura" value=""> Facturar</button>



<div id='Mostrar_todo'>
<FORM>
  <FIELDSET>
   
    <table id='Orden_sumario' class='myTable'>
      <thead>
        <th></th>    
        <TH>Clave</TH>
        <TH>Producto</TH>
        <TH>Cant.</TH>
        <TH>Unidad</TH>
        <TH>Factura</TH>     
 </thead>

 <tbody>
 
<?
          
    for($renglones=0; $renglones<count($array);$renglones++)

    {

          echo "<tr>";
                
                echo "<td>
                <INPUT type='checkbox' id='checktotal' name='checktotal' style='width:20px' checked value='".$array[$renglones][16]."'  onChange='activatePanelTotallity(this)'/>
                </td>";
                echo "<td>".$array[$renglones][14]."</td>";
                echo "<td>".$array[$renglones][4]."</td>";
                echo "<td>".$array[$renglones][1]."</td>";
                echo "<td>".$array[$renglones][6]."</td>";
                echo "<td>".$array[$renglones][15]."</td>";
               

            echo "</tr>";
    }
?>
    
  

      </tbody>
    </table>
  
  </FIELDSET>
  </FORM>

</div>


<DIV id="dialog-status" title="Ingresar Factura">
  <FORM>
  <FIELDSET>
    <LABEL style="width:50px;" for="select-status"><b>Ingresar No. Factura</b></LABEL>
<br>
    <br>
    <LABEL style="width:50px;" for="nofactura">No. Factura:</LABEL>
    <INPUT type="text" name="nofactura" id="nofactura" class="text ui-widget-content ui-corner-all; text-transform:uppercase;" style="width:150px;" maxlength="300" />
  </FIELDSET>
  </FORM>
</DIV>




<?
//Inicia Pie de Página
piepagina();
?>
