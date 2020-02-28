<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 
<link rel="stylesheet" href="public/css/estilos-ajax.css" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="../Clases/Verificadores/general.js"> </script>

<script src="../Clases/jquery/DatePicker/jquery.ui.core.js"></script>
<script src="../Clases/jquery/DatePicker/jquery.ui.widget.js"></script>
<script src="../Clases/jquery/DatePicker/jquery.ui.datepicker.js"></
		<script>
	$(function() {
		$( "#datepicker" ).datepicker();
		$( "#datepicker2" ).datepicker();
	});

	function objetoAjax(){
 if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
  return xmlhttp;
}
	function showResultCliente(str)
{
 
if(str.length==0)
{
	document.getElementById('livecliente').innerHTML="";
    document.getElementById("livecliente").style.border="0px";
}
else
{
xmlhttp=objetoAjax();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livecliente").innerHTML=xmlhttp.responseText;
    document.getElementById("livecliente").style.border="1px solid #A5ACB2";
    }
  }
  
xmlhttp.open("POST","../Clases/Ajax/selectcliente_id.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("cliente="+str);  
}
}

function ponerValorCliente(str){
  document.getElementById('cliente').value=str.desc;
  document.getElementById('cliente').title=str.id;
  document.getElementById('cliente').setAttribute("idcliente",str.id);
  document.getElementById('livecliente').innerHTML="";
  document.getElementById("livecliente").style.border="0px";
  console.log('$( "#cliente" ).attr("idcliente")');

  //Habilitar Seleccion de Productos
  //alert("Activa Botones");
  //document.getElementById('agregar-producto').removeAttribute('disabled');
  //$('#attach-file').show();
 
}
	</script>


</head>

 <?php
		
	
	
		if(!isset($_POST['Guardar']))
		{	
			$id=$_GET['id'];
			require("../Clases/Objetos/contrato.php");
			require("../Clases/Objetos/cliente.php");
			require_once("../Clases/Conexion/conexion_prueba_local.php");

			$link=conect();
			$contrato=new Contrato();
			$cliente=new Cliente();
			$contrato->conexion($link);
			$contratoarray=$contrato->detalle($id);
			$cliente->conexion($link);
			$cliarray=$cliente->detalle_contacto($contratoarray[1]);

			echo "
  			<form  method='post' name='myform' id='myform' action=\"contrato_edicion.php?clave=".$id."&desc=".$contratoarray[2]."\">
			
			 <span class='Titulo'>Editar Contrato</span>
			  <div id='separa3'></div>
			 
 <table border='0' style='padding-top:10px;'>

      <tr>  
          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Cliente</td>
          <td width='100'> <input type='text' id='cliente' name='cliente'  required maxlength='200' value='".$cliarray[1]."'></td>
		  
	  </tr>
      	  <tr>  
          
		  <td width='100' style='font-size:12px;'> No. Contrato</td>
          <td width='100'><input type='text'  name='nocontrato' id='nocontrato' required maxlength='20' value='".$contratoarray[0]."' ></td>
		</tr>
	  <tr>  
          
		  <td width='100' style='font-size:12px;'> Descripcion</td>
          <td width='100'><input type='text'  name='desc' id='desc' required maxlength='20' value='".$contratoarray[2]."' ></td>
		</tr>
		<tr>  
          <td width='100' style='font-size:12px;'><LABEL class='ui-widget' for='datepicker'>Fecha de Inicio</td>
          <td width='100'> <input name='datepicker' type='text' required id='datepicker' value='".$contratoarray[3]."' /></td>  
        </tr>
		<tr>  
		<tr>  
          <td width='100' style='font-size:12px;'><LABEL class='ui-widget' for='datepicker2'>Fecha de Terminación</td>
          <td width='100'> <input name='datepicker2' type='text' required id='datepicker2' value='".$contratoarray[4]."'/></td>  
        </tr>
			  <tr>  
          
		  <td width='100' style='font-size:12px;'> Monto Total $</td>
          <td width='100'><input type='text'  name='montototal' id='montototal' required maxlength='20' value=".$contratoarray[5]." ></td>
		</tr>
      	<tr>
		
		<td colspan='5'>
			<div id=\"error\"  class='error1'>
			</div>
		</td>
		</tr>	
      			<tr>
            <td colspan='4' align='center' style='padding-top:20px;'>
            	<input class='botones-metro'  type='submit' name='Guardar' value='Guardar'>
            </td>
        </tr>
      </table>
  </form>
		  ";
		}else
		{ 
			require("../Clases/Objetos/contrato.php");
			require("../Clases/Objetos/cliente.php");
			require_once("../Clases/Conexion/conexion_prueba_local.php");
			$link=conect();
			
		
			$contrato=new Contrato();
			$contrato->conexion($link);

$cliente=$_POST['cliente'];
$qry =mysql_query("SELECT cliente.cliente_id, cliente.cliente_razonsocial from cliente where cliente_razonsocial='$cliente' ");
$fetch= mysql_fetch_array($qry);

 $cliente_id= $fetch['cliente_id'];			

			
		$result_update=$contrato->update(
		$_POST['nocontrato'],
		$cliente_id,
		$_POST['desc'],
		$_POST['datepicker'],
		$_POST['datepicker2'],
		$_POST['montototal']
		);
					if($result_update=="OK")
					{		

								echo "<br>
						   		<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>El Contrato  ha sido actualizado</p>";
							}
							else
							{
								echo "
								<br>
								<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR:El Contrato no se ha podido actualizar</p>";
							}

		
		
		} //else
		
		
?>

</body>
</html>
