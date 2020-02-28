<script type="text/javascript" src="../Clases/jquery/jquery-latest.js"></script>
<script type="text/javascript">

    function revisa_stock_minimo() {
        minimo = document.getElementById("stockMinimo");
       
		cant = document.getElementById("text_cantidad");
		result = minimo.value-cant.value;
		 alert(result);
		 
    }

</script>

<style type="text/css" media="screen">
		#separa3{
			margin:10px 0 10px 0;
			background:#8A0808;
			height:2px;
			width:470px;
			}
		.tittle{
			color:#8A0808;
			
			font-size:18px;
			}
		.result{
			color:#8A0808;
			font-size:14px;
			font-weight:bold;	
		}
		
		#subtitulo
		{
		float:left;
		background:#fff;
		width:420px;
		}
 </style>	

<?php

	$idMaterial=$_GET['var1'];
	$materialDescrip=$_GET['var2'];
	$almacenNom=$_GET['var3'];
	echo '
	
<form action="salidaInventario_registro.php"  method="post">

		<h1 align="center" class="tittle">Salida de Inventario</h1>
			<div id="separa3"></div>  
			
			<table width="483" border="0">
  <tr>
    <td width="93">Producto:</td>
    <td colspan="3" class="result">'.$materialDescrip.'</td>
    </tr>
 <tr>
      <input type="hidden" name="material" id="material" type="text" value='.$idMaterial.'>
    </tr>

  <tr>
    <td>Almac&eacute;n</td>
    <td colspan="3" class="result">'.$almacenNom.'</td>
    </tr>
  <tr>
    <td>Motivo:</td>
    <td width="151"><select name="select">
      <option value="1">Solicitud de Taller</option>
      <option value="2">Defectuoso</option>
            </select></td>
    <td width="70">Cantidad</td>
    <td width="151"><input name="text_cantidad" id="text_cantidad" type="text" class="text ui-widget-content ui-corner-all"  width="80"  /></td>
  </tr>
  <tr>
    <td>Observaciones:</td>
    <td colspan="3"><textarea name="textarea" id="textarea" style="width:330px;" maxlength="500" ></textarea></td>
    </tr>
 
</table>
  <input type="submit" value="ACEPTAR"  />

	    <LABEL class="ui-widget" for="cantidad"></LABEL>
		<BR>

		
	</FORM>
';
	
	
?>