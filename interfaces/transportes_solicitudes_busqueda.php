
<? // Inicia Página
require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_transportes_solicitudes.js");
	encabezado_BIG();

	echo "<input id='usuario' type='hidden' value='".$user."'/>";
?>


			<h2>
<a  href="TRAFICO.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
				Solicitudes de Transporte</h2>
<p></p>
 <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')"> <select id="filter" name="filter" default="-1"; onChange="Pagina('1')"></div>

 <option value="-1">Todos</option>
 <option value="0">Pendientes</option>
 <option value="1">Autorizados</option>

 </select>
 <br>
 <br>
 <div id="sentencias" class="content">

 <?
 	require_once("../Clases/Conexion/conexion_prueba_local.php");
	require_once("../Clases/Objetos/logistica_solicitudes.php");
	$link=conect();
	$logistica_solicitudes=new Logistica_solicitudes();
	$logistica_solicitudes->conexion($link);					
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$filter=-1;
	$array=$logistica_solicitudes->busqueda_parametros("", $RegistrosAEmpezar, $RegistrosAMostrar, $filter);

    ;
	if($array!=null)
	{	
		 //echo "".count($array);
		 echo "
				<table class='myTable'>
						<th>No. Solicitud</th>
						<th>Usuario Solictante</th>
						<th>Fecha Solicitud</th>
						<th>Descripcion</th>				
						<th>Usuario Aprobación</th>
						<th>Fecha Atención</th>
						<th>Estado</th>

					";
		for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
								echo "<td>".$array[$renglones][0]."</td>";			
								echo "<td>".$array[$renglones][2]."</td>";	
								echo "<td>".$array[$renglones][1]."</td>";				
								echo "<td>".$array[$renglones][3]."</td>";	
								echo "<td>".$array[$renglones][4]."</td>";
								echo "<td>".$array[$renglones][5]."</td>";
								echo "<td>";

if ($array[$renglones][6]==0)
{
								echo "<a href=\"javascript:cambiar_status({
									id:'".$array[$renglones][0]."'
								})\">Pendiente</a>";
								
}
else
{
								echo "Terminado";
					
	}
								echo "</td>";

						

						echo "</tr>";
			 
		}
						echo "</table>";
						$NroRegistros=$logistica_solicitudes->cuenta_resultado("");
						$PagAnt=$PagAct-1;
						$PagSig=$PagAct+1;
						$PagUlt=$NroRegistros/$RegistrosAMostrar;
						
						//verificamos residuo para ver si llevará decimales
						$Res=$NroRegistros%$RegistrosAMostrar;
						// si hay residuo usamos funcion floor para que me
						// devuelva la parte entera, SIN REDONDEAR, y le sumamos
						// una unidad para obtener la ultima pagina
						if($Res>0) $PagUlt=floor($PagUlt)+1;
						
						//desplazamiento
					if($PagAct>1) echo "<a  href='#' onclick=\"Pagina('$PagAnt')\"  style=\"text-decoration:none;
					cursor:pointer;\"><img src='../imagenes/carousel_previous_button.gif'/></a> ";
					 if($PagAct<$PagUlt) echo " <a  href='#' onclick=\"Pagina('$PagSig')\" style=\"text-decoration:none;cursor:pointer;\"><img src='../imagenes/carousel_next_button.gif'/></a> ";
					 
					 echo "<strong>Pagina ".$PagAct." de ".$PagUlt."</strong>&nbsp;";
					 echo "<a onclick=\"Pagina('1')\" class=\"link_regreso\" style=\"text-decoration:none;
					 cursor:pointer;\">Primero &nbsp;</a> ";
					 echo "<a onclick=\"Pagina('$PagUlt')\" class=\"link_regreso\" style=\"text-decoration:none;
					 cursor:pointer;\">Ultimo &nbsp;</a>
					 <br>";
	}
	else
	{
		echo "Búsqueda sin Resultados";
	}
	

   ?>

<DIV id="dialog-status" title="Asignación de unidades">
<h1>ASIGNACIÓN DE UNIDADES : </h1>
<DIV id="panelTransporte" style="padding-top:10px;">
<LABEL class="ui-widget" for="proveedor">Transporte:</LABEL>
 <select id="transporte"  class="text"> 

 <?php

 require("../Clases/Objetos/transporte.php");
	
	$transporte=new Transporte();
	$transporte->conexion($link);
 
	$array=$transporte->ObtieneTransporte();
    
	if($array!=null){	
		echo "<option value='0'>Seleccione Transporte</option>";
		$cont=0;
		for($renglones=0; $renglones<count($array);$renglones++){
 		echo "<option value='".$array[$renglones][0]."'>".$array[$renglones][1]."</option>";			 
		}
	}
 ?>
 </select>
 
<br>
<br>
        <LABEL for="remolquees">Remolques:</LABEL>
           <select name='remolques' id='refacciones' class='ui-widget' style='max-width:200px;'>
            <option value='0'>--Seleccione Opción--</option>
            <option value='1'>PLANA 2013  3BYPA4038DH007282 062-XP-4</option>
            <option value='2'>TOLVA 2013  3BYTC3632H007224  055-XP-4</option>
            <option value='3'>GONDOLA 2007  3S9V130507E17504  303-WC-9</option>
            <option value='4'>PIPA  2010  3S9T13051AE017025 194-UM-3</option>
          </select>

</DIV>

</DIV>

<div id="dialog" title="Información">
 </div>
 
<?
//Inicia Pie de Página
piepagina();
?>
