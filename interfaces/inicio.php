<?// Inicia Página
require_once("index_header.php");
// require_once("inicio_pendientes.php");
	$user=sesiones_start();
	librerias();
	encabezado_test();
?>


	<h2>INICIO</h2>


	<section>
		<?


//COTIZACIONES

$cotizaciones_sin_aprobar = cot_sin_aprobar($user);
if ($cotizaciones_sin_aprobar>0)
crea_article("cotizacion_busqueda_usuario.php","1",$cotizaciones_sin_aprobar, "COTIZACION SIN APROBAR");

$ventas_sin_facturar = ventas_sin_facturar($user);
if ($ventas_sin_facturar>0)
crea_article("ordenes_salida_busqueda_usuario.php","9",$ventas_sin_facturar, "PEDIDOS PENDIENTES POR TERMINAR");

//MATERIAL

/*
$material_sin_stock = mat_sin_stock();
if ($material_sin_stock>0)
crea_article("almacen_inventario.php","material",$material_sin_stock,"MATERIAL SIN STOCK");
*/

$material_minimo = mat_minimo();
if($material_minimo>0)
crea_article("material_sinstock_busqueda.php","material",$material_minimo,"MATERIAL DEBAJO MÍNIMO");

// CLIENTES

$prospectos = prospectos_activos();
if ($prospectos>0)
crea_article("prospecto_busqueda.php","proveedor",$prospectos, "PROSPECTOS");



?>
		<section>

<?
//Inicia Pie de Página
piepagina();
?>


