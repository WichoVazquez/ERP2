<?

 //$id=$_GET["id"];

 //echo "Error:".$id;
 //$array=$cotizacion->detalle($id);


  require_once("index_header.php");
  $user=sesiones_start();
 
  librerias();
  scripts_head("../Clases/javascript/busqueda_material.js");
  scripts_head("../Clases/javascript/taller-almacen.js");	
  
  lib_shadow();
  encabezado_BIG();

	$v1=$_GET['var'];
	$v2=$_GET['var2'];
  $tipo_ped=1; //Es cero por que estamos en Almacen


	require_once("../Clases/Conexion/conexion_prueba_local.php");	
	require("../Clases/Objetos/almacen-taller.php");
  require("../Clases/Objetos/almacen.php");
	$link=conect();
  $almacen=new Almacen();
  $almacen->conexion($link);
	$almacen_taller=new Almacen_Taller();
	$almacen_taller->conexion($link);
	$resultPedidos=$almacen_taller->result_detalle_pedido1($v1);
	$resultDetalles=$almacen_taller->result_detalle_pedido2_AUTORIZACION($v1,$tipo_ped);
	
	echo "<input type='hidden' id='folio' value='".$resultPedidos['folioPedido']."'/>";

?>
  
  <style type="text/css" media="screen">
#separa3{
  margin:10px 0 10px 0;
  background:#8A0808;
  height:2px;
  width:800px;
  }
.tittle{
  color:#8A0808;
  text-shadow: 0.01em 0.01em 0.008em #333;
  }
.result{
  color:#8A0808;
  font-size:14px;
  font-weight:bold; 
}
#letraP{
  font-size:10px;
  font-weight:bold; 
}
#bot_return
{
float:left;
background:#fff;
width:320px;
}
#subtitulo
{
float:left;
background:#fff;
width:420px;
}
   </style> 

<h2>
<a  href="almacen_orden_salida_Autorizacion.php"  title="Regresar"  style="text-decoration:none;">
        <img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
        </a>
  Asignación de Pedidos</h2>

<div id="separa3"></div>     


<DIV>
<?
/*$perfil=$_POST['perfil'];
echo "perfil:".$perfil;*/
?>


<div>
<table width="800" border="0">
  <tr>
    <td width="120" height="39">Folio<div class="result">
     <?php echo $resultPedidos['folioPedido']; ?>
   </div>
 </td>

 <td width="500" style="width:500px;">Cliente:
    <div class="result">
      <?php echo $resultPedidos['cliente_razonsocial']; ?>
    </div></td>
 

	<td width="175">
<? if ($resultPedidos['sucursalName'])
    echo "Sucursal";
?>

	<td></td>
   
  </tr>
</table>
  <table width="700"  border="0">
  <tr>
    <td width="137">Estado de orden                    
    <div><?php echo $resultPedidos['pedidoEdo'];?></div> </td>
    <td></td>
    <td  width="230" style="width:230px;">Observaciones
    <div class="result"><?php echo $resultPedidos['observaciones']; ?></div></td>
        <td width="230" style="width:230px;">Fecha de Inicio<div class="result"> 
      <?php echo $resultPedidos['fechaCreacion']; ?>
    </div></td>
    <td width="230" style="width:230px;">Fecha de Entrega
    <div class="result">
      <?php echo $resultPedidos['fechaEntrega']; ?>
    </div></td>
  </tr>
</table>


</div>
 <div id="separa3"></div>
</DIV>



<div id="general-form">
<DIV id="products-contain">
  <H1>Productos/Servicios:</H1>
  <TABLE id="productos" class='myTableRED'>
    <THEAD>
      <TR>
           <TH>Enviar</TH>
      
        <TH>Tipo</TH>
        <TH>Producto</TH>
        <TH>Cant.</TH>
        <TH>Unidad</TH>
        <TH>Existencia</TH>
    
      </TR>
    </THEAD>
    <TBODY>
	<?php
	
		echo $resultDetalles;
		
	?>
    </TBODY>
  </TABLE>
  
  

 
   
  
</DIV>


<select id='almacen' name='almacen' style='width: 200px; max-width:200px;'>";

<?
    $array=$almacen->detalle_almacen_taller();
    $renglones=0;
    for($renglones=0; $renglones<count($array);$renglones++)
      {
        echo "<option value='".$array[$renglones][0]."' almacen_tipo='".$array[$renglones][2]."'>".$array[$renglones][1]."</option>";
      }

         echo   "</select>";

?>
          <BUTTON id="enviar-taller">ENVIAR</BUTTON> 

<DIV id="status_regis" class="ui-widget">
</DIV>

</div>

<br>


<DIV id="dialog_instrucciones3" title="Instrucciones: ">

<TABLE >
    <THEAD>
      <TR>
           
      
        <TH><h1>Opcion #1: </h1></TH>
        <TH><h1>Opcion #2: </h1></TH>
        
      </TR>
    </THEAD>
    <TBODY>
  <td><img src='../imagenes/almacen11.png'  height="400" width="550" /> </td>
  <td><img src='../imagenes/produccion1.png'  height="400" width="550" /></td>
    </TBODY>
  </TABLE>

</DIV>
<?
//Inicia Pie de Página
piepagina();
?>
