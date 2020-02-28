<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />


<link rel="stylesheet" href="public/css/estilos-ajax.css" type="text/css"/>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" type="text/css"/>

<script src="public/js/prefixfree.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<script src="../Clases/Verificadores/general.js"> </script>
<script src="../Clases/javascript/nuevo_material.js"></script>




</head>
<body>

 <p>
  <?php


	/*iniciarSession();
	$nivel=$_SESSION["nivel"];
	if($nivel==0)
	{
	*/	
		if(!isset($_POST['Guardar']))

		{
			
			require("../Clases/Objetos/almacen.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			require("../Clases/Objetos/unidad.php");
			require("../Clases/Objetos/material.php");
			require("../Clases/Objetos/material_tipo.php");
			$link=conect();
			$almacen=new Almacen();
			$almacen->conexion($link);
			$material=new Material();
			$material->conexion($link);
			$material_tipo=new Material_tipo();
			$material_tipo->conexion($link);
			$unidad=new Unidad();
			$unidad->conexion($link);

			
			echo "
  		<form  method='post' name='myform' id='myform' onsubmit=\"return validarDatosMaterial(true)\" action='material_registro.php'>
		<span class='Titulo'>Registro de Material</span>
		<div id='separa3'></div>
      	<table border='0' style='padding-top:10px;'>
	  	<tr>    




		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Descripcion</td>
          <td width='100'><input type='text' required name='idsae' id='idsae' required onBlur=\"return validarMaterialSae(this.value)\" ></td>
		  
		   <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Nombre Comercial</td>
          <td width='100'><input type='text' required name='descripcion' id='descripcion' required onBlur=\"return validarMaterial(this.value)\" ></td>
		  
		  
		</tr>      
		<tr>

		  <tr>";

echo "<td class='texto_chico_tabla' style='font-size:12px;'>Unidad Medida</td>";

if(!isset($_POST['unidad_nueva']))
											{
												
												echo "
											     <td width='100'>
													  	<select name='unidadM' style='width:150px;'>";

													$array=$unidad->detalle("");
													$renglones=0;
													for($renglones=0; $renglones<count($array);$renglones++)
														{
															
															echo "<option value='".$array[$renglones][0]."'";




														echo 	">".$array[$renglones][1]."</option>";
														}

											 	echo "</select>	<button  name='unidad_nueva' >+</button></td>";

											}
											else
											{
            echo "<td width='100'><input type='text' name='unidadM' id='unidadM' maxlength='50'></td>";
											
           }
echo "<td class='texto_chico_tabla' style='font-size:12px;'>Presentacion</td>";


            echo "
                <td width='100'>
                <select name='presentacion' style='width:200px;'>";

             $array=$unidad->detalle_presentaciones_total("");
             $renglones=0;
             for($renglones=0; $renglones<count($array);$renglones++)
              {
               
               echo "<option value='".$array[$renglones][0]."'";




              echo  ">".$array[$renglones][1]."</option>";
              }

             echo "</select></td>";

           


echo "</tr>";

echo "    
<tr>

<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Flete</td>
<td width='100'><input type='text'  name='flete' id='flete' maxlength='10'>
</td>  


<td class='texto_chico_tabla' style='font-size:12px;'>Tipo</td>
<td width='100'>
     <select name='tipo'  style='width:200px;'>";
             $array_mat=$material_tipo->detalle();
             $renglones=0;
             for($renglones=0; $renglones<count($array_mat);$renglones++)
              {
               echo "<option value='".$array_mat[$renglones][0]."'";
              echo  ">".$array_mat[$renglones][2]."</option>";
              }


echo "
    
            </select>
    </td>
  </tr>";
	

 echo "		
		
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Cantidad</td>
          <td width='100'><input type='text' name='cantidadM' id='cantidadM' required onkeypress=\"return NumEntero(event)\" maxlength='50' value='0'></td>
	  
		<td class='texto_chico_tabla' style='font-size:12px;'>Almacén</td>
          <td width='100'>
		  	<select name='almacen' style='width:200px;'>";


		$array=$almacen->detalle_tabla();
		$renglones=0;
		for($renglones=0; $renglones<count($array);$renglones++)
			{
				echo "<option value='".$array[$renglones][0]."'>".$array[$renglones][1]."</option>";
			}

         echo   "</select>
		  </td>
		  		  
		</tr>
		
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Minimo</td>
          <td width='100'><input type='text' name='minimo' id='minimo' required onkeypress=\"return NumEntero(event)\" maxlength='50' value='0'></td>
	
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Maximo</td>
          <td width='100'><input type='text' name='maximo' id='maximo' required onkeypress=\"return NumEntero(event)\" maxlength='50' value='0'></td>
		</tr>

<tr>
  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Flete</td>
          <td width='100'><input type='text' name='flete' id='flete' onkeypress=\"return NumEntero(event)\" maxlength='50'></td>
</tr>


	<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Material/Producto</td>
   <td width='100'><input type='radio' name='maquila' value='0' id='material_almacen' checked > </td>
   <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Insumo</td>
   <td width='100'><input type='radio' name='maquila' value='1' id='material_taller'> </td>
  <td>
  </tr>
		
		
		<tr>
		<td style='font-size:12px;'> <LABEL for='checktotal'>Ingresar Componentes</LABEL></td>
		<td >
		<INPUT type='checkbox' id='checktotal' name='checktotal' /> </td>

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
            	<input  class='botones-metro' type='submit' name='Guardar' value='Guardar'>
            </td>
        </tr>
      </table>
  </form>
  



		  "  ;
	/*	<!--  	echo '<script type="text/javascript">';
				echo 'mostrarAgregarPoducto()';
				echo '</script>';-->*/
		

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

$unidadarray=$unidad->detalle_id($_POST['unidadM']);
if($unidadarray!=null)
{
	$res_unidad = $_POST['unidadM'];
}
else
{
	$res_unidad = $unidad->insert($_POST['unidadM']);
}


if($res_unidad!=0)
{
			$result_mat=$material->insert(
			$_POST['descripcion'],
			$_POST['tipo'],
			$res_unidad,
			$_POST['maquila'],
			$_POST['idsae'],
   $_POST['flete'],
   $_POST['presentacion']
   );
			if($result_mat!=0)
			{
				
				
				
				$res_alm=$almacen_material->insert(
				$_POST['almacen'],
				$result_mat,
				$_POST['cantidadM'],
				$_POST['maximo'],
				$_POST['minimo'],
    $_POST['minimo']);
				
				$NMate=$_POST['checktotal'];
				
				if($res_alm!=0)
				    {
						
				 echo '<script type="text/javascript">';
				echo 'almacenarDetalle('. $res_alm .')';
				echo '</script>';
				if($NMate=="on"){
				
				echo"  <span style='font-size: 22px'>";
  				echo"<LABEL style='width:50px;' id='msgTitulo'> Agregue los componentes del Producto</LABEL> <br>";
 				echo" </span>";
					
				echo '<script type="text/javascript">';
				echo "activarKit('".$NMate."',".$res_alm.");";
				echo '</script>';
					
				}else{
					echo"  <span style='font-size: 22px'>";
  				echo"<LABEL style='width:50px;' id='msgTitulo'>El Producto ha sido registrado</LABEL> <br>";
 				echo" </span>";
		
				}
				}
					else
					{
						echo "
								<br>
								<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: El Material no se ha podido registrar en el alamcén</p>";
					}
				}//domicilio		
				else
				{
					
					echo "
								<br>
								<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: El Material no se ha podido registrar</p>
								"
								;
			     }		
}
else

{
	echo "
							<br>
							<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR:La unidad no se ha podido actualizar</p>";
}
		}
		
		
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
  <H1>Productos:</H1>
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
?>
    </TBODY>
  </TABLE>
  
 
  <!--<INPUT type='checkbox'id="checkcurrency" name="checkcurrency" onChange="activatePanelCurrency(this)"/> 
 
  <LABEL for="checkcurrency">Cambiar Divisa</LABEL>-->

</DIV>
<DIV id="divguardar" style="padding-top:10px; padding-bottom:10px;">
<BUTTON id="Almacenar Detalle" onClick="almacenarDetalle()">Guardar</BUTTON>
<!--<BUTTON id="continuar-orden">Envia</BUTTON>-->
</DIV>
</body>
</html>
