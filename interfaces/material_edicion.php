 <!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />


<link rel="stylesheet" href="public/css/estilos-ajax.css" type="text/css"/>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" type="text/css"/>

<script src="public/js/prefixfree.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="public/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="public/js/jquery-ui.js"></script>
<script src="../Clases/Verificadores/general.js"> </script>
<script src="../Clases/javascript/edicion_material.js"></script>




</head>
<body>

 <p>
   <?php
		
		if(!isset($_POST['Guardar']))
		{
			$id=$_GET['id'];
			require("../Clases/Objetos/almacen.php");
			require("../Clases/Objetos/almacen_material.php");
			require("../Clases/Objetos/material.php");
			require("../Clases/Objetos/unidad.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			require("../Clases/Objetos/material_tipo.php");
			$link=conect();
			$almacen=new Almacen();
			$almacen->conexion($link);
			$almacen_material=new Almacen_material();
			$almacen_material->conexion($link);
			$material_tipo=new Material_tipo();
			$material_tipo->conexion($link);
			$material=new Material();
			$material->conexion($link);
			$unidad=new Unidad();
			$unidad->conexion($link);

			$matarray=$almacen_material->detalle($id);


			echo "
  			<form  method='post' name='myform'  id='myform' onsubmit=\"return true\"  action=\"material_edicion.php?id=".$id."&alm=".$matarray[6]."\">

<span class='Titulo'>Editar Material</span>
 <div id='separa3'></div>

            <table border='0' style='padding-top:10px;'>
	  <tr>    
		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Descripcion</td>
          <td width='100'><input type='text' name='idsae' id='idsae' required  value='".$matarray[12]."'></td>
		  
		   <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Nombre Comercial</td>
          <td width='100'><input type='text' name='descripcion' id='descripcion' required  value='".$matarray[2]."'></td>
		  
		</tr>      
		<tr>

		  <tr>
		  <td class='texto_chico_tabla' style='font-size:12px;'>Unidad Medida</td>"
         ;
											if(!isset($_POST['unidad_nueva']))
											{
												
												echo "
											     <td width='100'>
													  	<select name='unidad' style='width:150px;'>";

													$array=$unidad->detalle();
													$renglones=0;
													for($renglones=0; $renglones<count($array);$renglones++)
														{
															
															echo "<option value='".$array[$renglones][0]."'";

															if ($matarray[5]==$array[$renglones][0])
																	echo "selected='selected'";


														echo 	">".$array[$renglones][1]."</option>";
														}

											 	echo "</select>		<button  name='unidad_nueva' >+</button></td>";

											}
											else
											{

											echo "<td width='100'><input type='text' name='unidad' id='unidad' maxlength='50'></td>";
}

echo "<td class='texto_chico_tabla' style='font-size:12px;'>Presentacion</td>";


            echo "
                <td width='100'>
                <select name='presentacion' style='width:200px;'>";

            $array=$unidad->detalle_presentaciones_total();
             $renglones=0;
             for($renglones=0; $renglones<count($array);$renglones++)
              {
               
               		echo "<option value='".$array[$renglones][0]."'";

					if ($matarray[14]==$array[$renglones][0])
					echo "selected='selected'";

					echo 	">".$array[$renglones][1]."</option>";
					
              }

             echo "</select></td>";

	echo "	  </tr>";

 echo "
 <tr>		

 <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Flete</td>
 <td width='100'><input type='text' name='flete' id='flete' onkeypress=\"return NumEntero(event)\" maxlength='50' value='".$matarray[13]."'></td>

		  <td class='texto_chico_tabla' style='font-size:12px;'>Tipo</td>
          <td width='100'>


		  	<select name='tipo' style='width:200px;'>";


													$array_mat=$material_tipo->detalle();
													$renglones=0;
													for($renglones=0; $renglones<count($array_mat);$renglones++)
														{
													
															echo "<option value='".$array_mat[$renglones][0]."'";

															if($matarray[4]==$array_mat[$renglones][0])
																echo "selected='selected'";

														echo 	">".$array_mat[$renglones][2]."</option>";
														 
														}


echo "
            </select>


		  </td>
		  
		</tr>";
			
echo "		
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Cantidad</td>
          <td width='100'><input type='text' name='cantidad_actual' id='cantidad_actual' maxlength='50' value='".$matarray[3]."'></td>
	  
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Almacen</td>
          <td width='100'><input type='text' name='alm' id='alm' maxlength='50' value='".$matarray[1]."' readonly=true></td>

		  </td>
		  		  
		</tr>
		
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Minimo</td>
          <td width='100'><input type='text' name='minimo' id='minimo' required onkeypress=\"return NumEntero(event)\" maxlength='50' value='".$matarray[9]."'></td>
	
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Maximo</td>
          <td width='100'><input type='text' name='maximo' id='maximo' required onkeypress=\"return NumEntero(event)\" maxlength='50' value='".$matarray[8]."'></td>
		
		</tr>
		
		</tr>";
		
		if ($matarray[11]==0)
		{
		
		echo"<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Material/Producto</td>
		 <td width='100'><input type='radio' name='maquila' value='0' id='material_almacen' checked > </td>
		 <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Insumo</td>
		 <td width='100'><input type='radio' name='maquila' value='1' id='material_taller'> </td>
		<td>
		</tr>";
		}else
		{
		echo"<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Material/Producto</td>
		 <td width='100'><input type='radio' name='maquila' value='0' id='material_almacen' > </td>
		 <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Insumo</td>
		 <td width='100'><input type='radio' name='maquila' value='1' id='material_taller' checked> </td>
		<td>
		</tr>";
		}
		
		
		
		echo "<tr>
		<td style='font-size:12px;'> <LABEL for='checktotal'>Modificar componentes</LABEL></td>
		<td >
		<INPUT type='checkbox' id='checktotal' name='checktotal' /> </td>

  </td>




  </td>
  
  </tr>
		 
		<tr>
		<td colspan='5'>


<DIV >

  <TABLE  >
    <THEAD>
      <TR class='ui-widget-header'>
        <TH>Clave</TH>
        <TH>Producto</TH>
        <TH>Cantidad</TH>       
        <TH>Observaciones</TH>
      </TR>
    </THEAD>
    <TBODY>";

 /*require("../Clases/Objetos/almacen_material.php");
 $link=conect();
 $detalle=new Almacen_material();
 $detalle->conexion($link);*/
 //echo "Error:".$id;
 $arrdet=$almacen_material->consulta_detalle($id);
 $total=0;
if($arrdet!=null)
{ 
        for($renglones=0; $renglones<count($arrdet); $renglones++)
        {
             
                echo "<tr>";              
                echo "<td>" .$arrdet[$renglones][1]. "</td>". //producto_id
                "<td>" .$arrdet[$renglones][2]. "</td>". //material_descripcion
                "<td>" .$arrdet[$renglones][3]. "</td>". //cantidad
                "<td>" .$arrdet[$renglones][4]. "</td>";
        }
}


echo"    </TBODY>
  </TABLE>
  </DIV>
  

</td>
</tr>


<tr>
       <td colspan='5'>
			<div id=\"error\"  class='error1'>
			</div>
		</td>
		</tr>
		<tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input  class='botones-metro' type='submit' name='Guardar' value='Guardar' >
            </td>
        </tr>
      </table>
  </form>
		  ";
		}else
		{ 
			
			require("../Clases/Objetos/almacen.php");
			require("../Clases/Objetos/almacen_material.php");
			require("../Clases/Objetos/material.php");
			require("../Clases/Objetos/unidad.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			$almacen=new Almacen();
			$almacen->conexion($link);
			$almacen_material=new Almacen_material();
			$almacen_material->conexion($link);
			$material=new Material();
			$material->conexion($link);
			$unidad=new Unidad();
			$unidad->conexion($link);

$unidadarray=$unidad->detalle_id($_POST['unidad']);
if($unidadarray!=null)
{
	$res_unidad = $_POST['unidad'];
}
else
{
	$res_unidad = $unidad->insert($_POST['unidad']);
}


if($res_unidad!=0)
{
			$res_mat=$material->update(
			$_GET['alm'],
			$_POST['descripcion'],
			$_POST['tipo'],		
			$res_unidad,
   $_POST['maquila'],
   $_POST['flete'],
   $_POST['idsae']);
			if($res_mat=="OK")
			{
				
				$res_alm=$almacen_material->update(
    $_GET['id'],
    $_POST['cantidad_actual'],
    $_POST['maximo'],
    $_POST['minimo']);
				
				$NMate=$_POST['checktotal'];
				
					if($res_alm=="OK")
					{
						if($NMate=="on")
						{
					
							
						echo '<script type="text/javascript">';
						echo "activarKit('".$NMate."');";
						echo '</script>';
						
						echo"  <span style='font-size: 22px'>";
						echo"<LABEL style='width:50px;' id='msgTitulo'> Agregue o Modifique los componentes del Producto.</LABEL> <br>";
						echo" </span>";
							
						}
						else{
							echo"  <span style='font-size: 22px'>";
						echo"<LABEL style='width:50px;' id='msgTitulo'>El Material ha sido actualizado</LABEL> <br>";
						echo" </span>";
				
						}
					}
					else
					{
						echo "
								<br>
								<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR:El Material no se ha podido actualizar</p>";
					}
			}	
			else
			{
				echo "<br>
					  <p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR: El Material no se ha podido actualizar ".$res_mat."</p>";
			}


}// if Unidad Medida

else

{
	echo "
							<br>
							<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR:La unidad no se ha podido actualizar</p>";
}


		} // else de Guardar



		
		
?>


 
  <BUTTON id="agregar-producto" >Agregar Producto</BUTTON>
<BUTTON id="quitar-producto">Quitar Producto</BUTTON>


</p>
 <p>&nbsp; </p>
<DIV id="dialog-form" title="Ingresar Producto">
  <FORM>
  <FIELDSET>

<LABEL style="width:50px;" for="producto" >Producto:</LABEL>
    <INPUT type="text" name="producto" id="producto" class="text ui-widget-content ui-corner-all" onKeyUp="showResult(this.value)" title="Palabras Clave"  style="width:100px;" IDPRODUCTO="0" value=""/>
    &nbsp;&nbsp;&nbsp;<DIV id="livesearch" class="ui-widget" style="position:absolute; overflow:auto; padding-top:0px;background-color:#FFF;z-index:100;"></DIV>
    <BR>
    <LABEL style="width:50px;" for="cantidad">Cantidad:</LABEL>
    <INPUT type="text" name="cantidad" id="cantidad" class="text ui-widget-content ui-corner-all"  value="0"  onBlur="ponerCantidad(this.value)" style="width:100px;" />
<!--onKeyUp="calcularMontos(this.value)"-->
    
    <BR>
    <LABEL style="width:50px;" for="observaciones">Observaciones:</LABEL>
    <INPUT type="textarea" name="observaciones" id="observaciones" class="text ui-widget-content ui-corner-all" style="width:100px;" onBlur="ponerObservacion(this.value)" maxlength="300" />
  </FIELDSET>
  </FORM>
</DIV>
<DIV id="products-contain" class="ui-widget">
  <H1>Componentes del Producto:</H1>
  <TABLE id="productos" class="ui-widget ui-widget-content">
    <THEAD>
      <TR class="ui-widget-header ">
        <TH>&nbsp;</TH>
        <TH>Clave</TH>
        <TH>Producto</TH>
        <TH>Cantidad</TH>       
        <TH>Observaciones</TH>
      </TR>
    </THEAD>
    <TBODY>
<?
 $arrdet=$almacen_material->consulta_detalle($_GET['id']);
 $total=0;
if($arrdet!=null)
{  for($renglones=0; $renglones<count($arrdet); $renglones++)
        {
                echo "<tr>";              
                echo "<td><input type='checkbox' value='".$arrdet[$renglones][0]."'></td>".
				"<td>" .$arrdet[$renglones][1]. "</td>". //producto_id
                "<td>" .$arrdet[$renglones][2]. "</td>". //material_descripcion
                "<td>" .$arrdet[$renglones][3]. "</td>". //cantidad
                "<td>" .$arrdet[$renglones][4]. "</td>";
        }
}

?>
    </TBODY>
  </TABLE>
  
</DIV>
<DIV id="divguardar" style="padding-top:10px; padding-bottom:10px;">
<?
echo "<BUTTON id='Almacenar Detalle' onClick='almacenarDetalle(".$_GET['id'].")'>Guardar</BUTTON>";
?>
<!--<BUTTON id="continuar-orden">Envia</BUTTON>-->
</DIV>

</body>
</html>
