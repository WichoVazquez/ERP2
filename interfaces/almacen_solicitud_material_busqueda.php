<?php

 if(!isset($_SESSION['user']))
{
  require("../Clases/Sesion/checarSesion.php");
  checarSesion();
  //checa perfil de usuario
}
 $user=$_SESSION['user'];
 $id=0;

require_once("index_header.php");
	$user=sesiones_start();
	librerias();
	scripts_head("../Clases/javascript/busqueda_solicitudes_material.js");
	encabezado_BIG();
	echo "<input id='preciobase'  type='hidden'/>";


?>	


  <script>
  $(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
  });



  </script>


<h2>
<a  href="ALMACEN.php"  title="Regresar"  style="text-decoration:none;">
				<img src='../imagenes/back-imagen.png'  height="30" width="30" /> 
				</a>
	Surtir Solicitudes de Material</h2>
<p></p>
 <div>Buscar:<INPUT type="text" id="search" onKeyUp="Pagina('1')">&nbsp;
 <select id="filter" onChange="Pagina('1')">
 <option value="-1">Todos</option>
 <option value="1">Por Autorizar</option>
 <option value="2">Enviado</option>
 <option value="3">Cancelado</option>
 <option value="4">No Autorizado</option>
 <option value="5">Autorizado</option>
 <option value="6">Confirmado</option>
 </select>
 </div>
 <div id="sentencias" class="content">

<?php
	require_once("../Clases/Conexion/conexion_prueba_local.php");	
	require_once("../Clases/Objetos/almacen-taller.php");
	$search=0;
	$link=conect();
	$almacen_taller=new Almacen_Taller();
	$almacen_taller->conexion($link);
	$RegistrosAMostrar=20;//esto deberia ser dinamico, tiempo??
	$RegistrosAEmpezar=0;
	$PagAct=1;
	$array=$resultSolicitudes=$almacen_taller->resultSolicitudes($search, $RegistrosAEmpezar, $RegistrosAMostrar);
	;	//echo $;
	if($array!=null)
	{
	
		echo "	
			
			
		<table class='myTable'>	
	
			<th>Folio</th>

   <th>Fecha de creacion</th>
   <th>Almacén Solicitado</th>
   <th> DETALLE </th>
   <th>Status</th>

			";

	for($renglones=0; $renglones<count($array);$renglones++)
		{
					echo "<tr>";
								
								echo "<td>".$array[$renglones][0]."</td>";


        echo "<td>".$array[$renglones][1]."</td>";
        echo "<td><center>".$array[$renglones][3]."</center></td>";
        echo "<td>";
        switch($array[$renglones][4])
        {
         
         case 1: echo "<a href=\"javascript:cambiar_status({id:'".$array[$renglones][0]."', nombre:'".$array[$renglones][0]."', cantidad:'".$array[$renglones][3]."', almacen_material_id:'".$array[$renglones][0]."', status:'".$array[$renglones][0]."'})\">Pendiente</a>";break;
         case 2: echo "Surtido";break;

        }
        echo "</td>";
          echo "<td><center><a href=\"javascript:detalleRuta(".$array[$renglones][0].")\">DETALLE</a></center></td>";
						echo "</tr>";
			 
		}
						echo "</table>";				
					$NroRegistros=$almacen_taller->cuenta_resultado("");
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
					if($PagAct>1) echo "<a onclick=\"Pagina('$PagAnt')\"  style=\"text-decoration:none;
					cursor:pointer;\"><img src='../imagenes/carousel_previous_button.gif'/></a> ";
					 if($PagAct<$PagUlt) echo " <a onclick=\"Pagina('$PagSig')\" style=\"text-decoration:none;cursor:pointer;\"><img src='../imagenes/carousel_next_button.gif'/></a> ";
					 
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
	
 echo '
</div>



 
';
 ?>



 <div class="clear"></div>


<DIV id="dialog-status" title="Autorizar">
  <FORM>
  <FIELDSET>
   <LABEL style="width:50px;" for="select-status">Estado:</LABEL>
    <SELECT id="select-status"  onChange="habilitar('1')" class='ui-widget' style='max-width:100px;'>
    <option value="2">Autorizar</option>
    <option value="3">No Autorizado</option>
    </SELECT>
    
  </FIELDSET>
  </FORM>
</DIV>

<?
//Inicia Pie de Página
piepagina();
?>
