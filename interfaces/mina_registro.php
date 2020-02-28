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
<script src="../Clases/javascript/nuevo_almina.js"></script>
<script>
  $(function() {
    $( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
    
  });

  
</script>


</head>
<body>
<DIV id="varcot">
<?
function sesiones_start(){
	 if(!isset($_SESSION['user']))
	{
	  require("../Clases/Sesion/checarSesion.php");
	  checarSesion();
	  //checa perfil de usuario
	}
 return $_SESSION['user'];
}
$user=sesiones_start();
//aqui le asigno a un input invisible el usuario y el no. de cotizacion
echo "<input id='usuario' value='".$user."'/>";

?>  
</DIV>  
 <p>

  <?php

		
		if(!isset($_POST['Guardar']))

		{
			
			require("../Clases/Objetos/almacen.php");
			require("../Clases/Objetos/almacen_material.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
			require("../Clases/Objetos/unidad.php");
			require("../Clases/Objetos/material.php");
			require("../Clases/Objetos/material_tipo.php");
			$link=conect();
			$almacen=new Almacen();
			$almacen->conexion($link);
			$almacen_material=new Almacen_material();
			$almacen_material->conexion($link);
			$material=new Material();
			$material->conexion($link);
			$material_tipo=new Material_tipo();
			$material_tipo->conexion($link);
			$unidad=new Unidad();
			$unidad->conexion($link);

			$matarray=$almacen_material->detalle_rafa("");
			$prueba=$matarray[6];	
			echo "
  		<form  method='post' name='myform' id='myform' action='mina_registro.php'>
		<span class='Titulo'>Registro de Material</span>
		<div id='separa3'></div>
      	<table border='0' style='padding-top:10px;'>
	  	<tr>    

	  	  <tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Folio de Entrada</td>
          <td width='100'><input type='text' name='cantidad_actual' id='cantidad_actual' maxlength='50' value='".$matarray[3]."' readonly=true></td>
	  
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Lote</td>
          <td width='100'><input type='text' name='cantidadM' id='cantidadM' required onkeypress=\"return NumEntero(event)\" maxlength='50' value='0'></td>
		  		  
		</tr>



		  <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Descripcion</td>
          <td width='100'><input type='text' name='idsae' id='idsae' required  value='".$matarray[12]."' readonly=true></td>

          <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Almacen</td>
          <td width='100'><input type='text' name='alm' id='alm' maxlength='50' value='".$matarray[1]."' readonly=true></td>
		  
		  
		</tr>      
		<tr>

		  <tr>";


	

 echo "		
		
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Cantidad en Existencia</td>
          <td width='100'><input type='text' name='cantidad_actual' id='cantidad_actual' maxlength='50' value='".$matarray[3]."' readonly=true></td>
	  
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Cantidad Nueva</td>
          <td width='100'><input type='text' name='cantidadM' id='cantidadM' required onkeypress=\"return NumEntero(event)\" maxlength='50' value='0'></td>
		  		  
		</tr>
		
		<tr>

		<td class='texto_chico_tabla' width='100' style='font-size:12px;' for='datepicker1'> Fecha de Registro</td>
          <td width='100'><input name='datepicker1' class='ui-widget-content' readonly  required type='text' id='datepicker1' /></td>
        
           <td class='texto_chico_tabla' width='100' style='font-size:12px;'>Presentacion</td>
          <td width='100'><input type='text' name='presentacion' id='presentacion' required  value=' ' readonly=true></td>
		</tr>
		
		<tr>
		<td class='texto_chico_tabla' width='100' style='font-size:12px;'>Observaciones</td>
     <td width='200'><INPUT type='textarea' name='observaciones' id='observaciones' class='text ui-widget-content ui-corner-all'  onBlur='ponerObservacion(this.value)' maxlength='300' /></td>

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
		//echo "estoy aqui";

		}else
		{ 

			
			require("../Clases/Objetos/almacen.php");
			require("../Clases/Objetos/almacen_material.php");
			require("../Clases/Objetos/mina.php");
			require("../Clases/Objetos/unidad.php");
			require("../Clases/Conexion/conexion_prueba_local.php");
		//echo "entre aqui2";
			$link=conect();
			$almacen=new Almacen();
			$almacen->conexion($link);
			$almacen_material=new Almacen_material();
			$almacen_material->conexion($link);
			$mina=new Mina();
			$mina->conexion($link);
			$unidad=new Unidad();
			$unidad->conexion($link);
echo "entre aqui3";
$date=$_POST['datepicker1'];


//echo "user HOLA";
echo "user".$user;
			
			
			if ($_POST['cantidadM']==0||$date=="") {
				echo "
								<br>
								<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>ERROR: El Material no se ha podido registrar </p>
								<br>
								<p id='text' class='texto_subtitulo' style=' padding-top:20px;font-size:22px;'>NOTA: La Cantidad Ingresada Debe Ser Mayor a 0 o Favor de Revisar la Fecha ";
			}else{
			$result_mat=$mina->insert(
			$_POST['idsae'],
			$date,
			$_POST['cantidadM'],
			$_POST['observaciones'],
			$user
			
   			);
				if($result_mat!=0)
			{
				
				$existencia=$_POST['cantidad_actual'];
				//echo "existencia".$existencia;
				$nuevaCant=$_POST['cantidadM'];
				//echo "nueva".$nuevaCant;
				$nuevaExistencia=$existencia+$nuevaCant;
				//echo "nuevaexistencia".$nuevaExistencia;

				$res_alm=$almacen_material->update_rafa(
				$nuevaExistencia
					);
				
				
				//$NMate=$_POST['checktotal'];
				
				if($res_alm!=0)
				    {
						
				 
				
				echo "que pedo aqui";
				
					
				}else{
					echo"  <span style='font-size: 22px'>";
  				echo"<LABEL style='width:50px;' id='msgTitulo'>El Producto ha sido registrado</LABEL> <br>";
 				echo" </span>";
		
				}
			}
		}
			/*if($result_mat!=0)
			{
				
				$existencia=$_POST['cantidad_actual']);
				$nuevaCant=$_POST['cantidadM']
				
				$nuevaExistencia=$existencia+$nuevaCant;
				$res_alm=$almacen_material->update_rafa(
				$nuevaExistencia
					);
				
				
				//$NMate=$_POST['checktotal'];
				
				if($res_alm!=0)
				    {
						
				 
				
				echo "que pedo aqui";
				
					
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
				
}
else

{
	echo "
							<br>
							<p id='text' class='texto_subtitulo' style='padding-top:20px;font-size:22px;'>ERROR:La unidad no se ha podido actualizar</p>";
}*/
		}
		
		
?>
   
 

</body>
</html>