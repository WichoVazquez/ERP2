<link rel="stylesheet" href="public/css/estilos-ajax.css" type="text/css"/>

<?php
	
			require("../Clases/Objetos/almacen.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			require("../Clases/Objetos/unidad.php");
			require("../Clases/Objetos/material.php");
			$link=conect();
			$almacen=new Almacen();
			$almacen->conexion($link);
			$material=new Material();
			$material->conexion($link);
						$unidad=new Unidad();
			$unidad->conexion($link);

	$idMaterial=$_GET['var1'];
	$materialDescrip=$_GET['var2'];
	$almacenNom=$_GET['var3'];
	$almacen_id=$_GET['var4'];
	$almacen_material_id=$_GET['var5'];
	echo "$almacen_id";
	echo "$idMaterial";
	echo "$materialDescrip";
	echo "$almacenNom";
	echo " id del material $almacen_material_id";
	

	echo '
	<form action="traspasoInventario_registro.php"  method="post">
	   
		
		<h1 align="center" class="tittle">Traspaso entre almacenes </h1>
			<div id="separa3"></div>  
			
			<table width="483" border="0">

	    <input type="hidden" name="material" id="material" type="text" value='.$idMaterial.'>
	    <input type="hidden" name="almacen_id" id="almacen_id" type="text" value='.$almacen_id.'>
	  
  <tr>
    <td width="121">Producto:</td>
    <td colspan="3" class="result">'.$materialDescrip.' </td>
    </tr>
  <tr>
    <td>Almacen Salida</td>
		  	<td colspan="3" class="result">'.$almacenNom.' </td>';


		

         echo   '</select>
		  </td>
		  		  
		</tr>
 <tr>
    <td>Almacen entrada</td>
          <td width="200">
		  	<select name="almacen_entrada" id="almacen_entrada" style="max-width:200px;">';


		$array=$almacen->detalle_tabla();
		$renglones=1;
		if ($almacen_id==1) {
		
		for($renglones=1; $renglones<count($array);$renglones++)
			{
				echo "<option value=".$array[$renglones][0].">".$array[$renglones][1]."</option>";
			
			}
        }
      else{
      	for($renglones=0; $renglones<count($array);$renglones++)
			{
				echo "<option value=".$array[$renglones][0].">".$array[$renglones][1]."</option>";
			}

		}

         echo   '</select>
		  </td>
		  		  
		</tr>
  <tr>
    <td>Cantidad:</td>
    <td width="123"><input name="text_cantidad" id="text_cantidad" type="text" class="text ui-widget-content ui-corner-all"  width="80"  /></td>
    <td width="70">&nbsp;</td>
    <td width="151">&nbsp;</td>
  </tr>
  <tr>
    <td>Observaciones:</td>
    <td colspan="3"><textarea name="textarea" id="textarea3" style="width:330px;" maxlength="500" ></textarea></td>
    </tr>
</table>
 <input type="submit" value="ACEPTAR"/>
	        <LABEL class="ui-widget" for="cantidad"></LABEL>
		<BR>

		
	</FORM>
';
	
	
?>