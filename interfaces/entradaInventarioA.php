<script type="text/javascript" src="../Clases/jquery/jquery-latest.js"></script>
<script type="text/javascript">


	function revisa_stock_maximo() {
        maximo = document.getElementById("stockMaximo");
        existencias = document.getElementById("materialExist");
		cant = document.getElementById("text_cantidad");
		result = parseInt(existencias.value) + parseInt(cant.value);
		//alert(result);

		if(result==maximo.value){
				alert("Ha llegado al tope de Stock para este producto");
				text_observ.focus();
		}else{
			if(result>maximo.value){
				alert("Ha rebasado el Stock m&aacute;ximo de este producto");
				text_cantidad.focus();
			}
		}
		
    }
	function pulsar(e) {
	  tecla = (document.all) ? e.keyCode : e.which;
	  if (tecla==13) {
		revisa_stock_maximo();
	  }
	}
    

</script>

<link rel="stylesheet" href="public/css/estilos-ajax.css" type="text/css"/>



<?php

	$idMaterial=$_GET['var1']; 
	$materialDescrip=$_GET['var2'];
	$almacenNom=$_GET['var3'];
	$materialExist=$_GET['var4'];
	$stockMaximo=$_GET['var5'];
	require("../Clases/Conexion/conexion_prueba_local.php");	
	$link=conect();
	//checar stok maximo de material que va a entrar a inventario	
	
	echo '
	
<form action="entradaInventario_registro.php"  method="post">


		
	   <input type="hidden" id="stockMaximo" value="'.$stockMaximo.'">
	   <input type="hidden" id="materialExist" value="'.$materialExist.'">
	   <input type="hidden" id="var1" value="'.$idMaterial.'">
	   
		
		<h1 align="center" class="tittle">Entrada a Inventario</h1>
			<div id="separa3"></div>  
			
			<table width="483" border="0">
 
  <tr>
   
    <input type="hidden" name="material" id="material" type="text" value='.$idMaterial.'>
    </tr>

  <tr>
    <td width="93">Producto:</td>
    <td colspan="3" class="result">'.$materialDescrip.'</td>
    </tr>
  <tr>
    <td>Almac&eacute;n</td>
    <td colspan="3" class="result">'.$almacenNom.'</td>
    </tr>
  <tr>
    <td>Motivo:</td>
    <td width="186"><select name="select">
      <option value="1">Devoluci&oacute;n del cliente</option>
      <option value="2">Defectuoso</option>
      <option value="3">Por Proveedor</option>
        </select></td>
    <td width="50">Cantidad</td>
    <td width="131"><input name="text_cantidad" id="text_cantidad" type="text" class="text ui-widget-content ui-corner-all"  width="80" onChange="javascript:revisa_stock_maximo()" onkeypress = "pulsar(event)" /></td>
  </tr>
  <tr>
    <td>Observaciones:</td>
    <td colspan="3"><textarea name="text_observ" id="text_observ" style="width:330px;" maxlength="500" onClick="javascript:revisa_stock_maximo()" ></textarea></td>
    </tr>
  <tr>
   
    </tr>
</table>
 <input type="submit" value="ACEPTAR"  />
	    <LABEL class="ui-widget" for="cantidad"></LABEL>
		<BR>
<div></a></div>

	</FORM>';


	
?>