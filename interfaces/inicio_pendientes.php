<?
// require("../Clases/Conexion/conexion_prueba_local.php");	
require("../Clases/Objetos/almacen_material.php");
require("../Clases/Objetos/cotizacion.php");
require("../Clases/Objetos/prospecto.php");	
require("../Clases/Objetos/pedido.php");

function crea_article($url_art, $img_art, $label_count, $label_art){

echo "
		<article>
			<a href='".$url_art."' title='Proveedores'>

			<img src='public/images/".$img_art.".png' alt='Actualizar' class='imagecat' />
						<label class='labelnot'>
				".$label_count."
			</label>	
			<label class='labelcat'>
				".$label_art."
			</label>			
			</a>
		</article>
";

}

function cot_sin_aprobar($user)
{
	
	
	$link=conect();
	$cotizacion=new Cotizacion();
	$cotizacion->conexion($link);
	$total_p_sin_aprobar=$cotizacion->p_sin_aprobar($user);
	return $total_p_sin_aprobar;

}

function cot_pendientes()
{
	require("../Clases/Conexion/conexion_prueba_local.php");	
	require("../Clases/Objetos/cotizacion.php");
	$link=conect();
	$cotizacion=new Cotizacion();
	$cotizacion->conexion($link);
	$total_p_pendientes=$cotizacion->p_pendientes();


}

function mat_sin_stock()
{


	$link=conect();
	$almacen_mat=new Almacen_material();
	$almacen_mat->conexion($link);
	$total_items_stock=$almacen_mat->p_sinstock();
	return $total_items_stock;

}

function mat_minimo()
{
	$link=conect();
	$almacen_material=new Almacen_material();
	$almacen_material->conexion($link);
	$total_items_minimo=$almacen_material->p_minimo();
	return $total_items_minimo;
}

function prospectos_activos()
{

	$link=conect();
	$prospecto=new Prospecto();
	$prospecto->conexion($link);
	$total_prospectos=$prospecto->cuenta_resultado();
	return $total_prospectos;

}

function ventas_sin_facturar($usuario)
{

	$link=conect();
	$pedido=new Pedido();
	$pedido->conexion($link);
	$total_ventas=$pedido->cuenta_resultado($usuario);
	return $total_ventas;
}

?>