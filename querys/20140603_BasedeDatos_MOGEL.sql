-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-04-2014 a las 01:52:57
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `promex`
--
CREATE DATABASE IF NOT EXISTS `mogel` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `mogel`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `detalle_entrega`(IN `id_ruta_detalle` INT, IN `cantidad_enrutada` INT, IN `cantidad_entregada` INT, IN `observaciones_detalle` VARCHAR(50))
    NO SQL
BEGIN
DECLARE id_pedido int;
DECLARE cantidad_cotizacion INT;
DECLARE cantidad_total_entregada INT;

update detalle_pedido as dp
inner join ruta_detalle as dr on dp.detalle_pedido_id= dr.PedidoDetalle_id
inner join detalle_cotizacion as dc on dp.detalle_cotizacion_id = dc.detalle_cotizacion_id
set dr.cantidadEntregada=cantidad_entregada, 
dp.cantidad_entregada=dp.cantidad_entregada+cantidad_entregada,
dp.cantidad_enrutada = dp.cantidad_enrutada-(cantidad_enrutada-cantidad_entregada),
dr.observaciones =observaciones_detalle,
dp.detalle_pedido_status = 4
where dr.detalle_ruta_id=id_ruta_detalle;

select @id_pedido :=dp.pedido_id
, @cantidad_cotizacion := SUM( dc.cantidad )
, @cantidad_total_entregada := SUM( dp.cantidad_entregada ) 
FROM detalle_pedido AS dp
INNER JOIN ruta_detalle AS dr ON dp.detalle_pedido_id = dr.PedidoDetalle_id
INNER JOIN detalle_cotizacion AS dc ON dp.detalle_cotizacion_id = dc.detalle_cotizacion_id
WHERE dr.detalle_ruta_id =id_ruta_detalle;

if (@cantidad_total_entregada < @cantidad_cotizacion) then
	update pedido set pedido_estado=0 where pedido_id=@id_pedido;
else
       	update pedido set pedido_estado=1 where pedido_id=@id_pedido;
end if;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE IF NOT EXISTS `almacen` (
  `almacen_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `domicilio_id` bigint(20) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  PRIMARY KEY (`almacen_id`),
  KEY `domicilio_id` (`domicilio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla Almacen' AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`almacen_id`, `nombre`, `descripcion`, `domicilio_id`, `tipo`) VALUES
(1, 'PROMEX Almacén', 'Almacén de Promex', 5, 0),
(16, 'PROMEX Taller', 'Taller de Promex.', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen_material`
--

CREATE TABLE IF NOT EXISTS `almacen_material` (
  `almacen_material_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `almacen_id` bigint(20) NOT NULL,
  `material_id` bigint(20) NOT NULL,
  `cantidad_actual` bigint(20) NOT NULL DEFAULT '0',
  `maximo` bigint(20) NOT NULL,
  `minimo` bigint(20) DEFAULT '0',
  `solicitud` char(11) DEFAULT '0',
  PRIMARY KEY (`almacen_material_id`),
  KEY `almacen_id` (`almacen_id`),
  KEY `material_id` (`material_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla ALMACEN_MATERIAL' AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `almacen_material`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `cliente_id` varchar(10) NOT NULL DEFAULT '',
  `cliente_razonsocial` varchar(50) NOT NULL DEFAULT 'NULL',
  `cliente_rfc` varchar(12) NOT NULL DEFAULT 'NULL',
  `cliente_domicilio_fiscal` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `cliente_generales` bigint(20) NOT NULL,
  PRIMARY KEY (`cliente_id`),
  KEY `cliente_domicilio_fiscal` (`cliente_domicilio_fiscal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='cliente PROMEX';



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes-usuarios`
--

CREATE TABLE IF NOT EXISTS `clientes-usuarios` (
  `id_cliente_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  PRIMARY KEY (`id_cliente_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relacion Clientes - Usuarios de Ventas' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
  `servidor_smtp` varchar(100) DEFAULT NULL COMMENT 'servidor de correo de preferencia smtp',
  `puerto` int(6) DEFAULT NULL COMMENT 'puerto servidor correo de preferencia',
  `usuario_correo_notificaciones` varchar(100) DEFAULT NULL COMMENT 'usuario correo',
  `contrasena_usuario_correo_notificaciones` varchar(30) DEFAULT NULL COMMENT 'contrasena correo',
  `frecuencia_notificaciones_pago` varchar(100) DEFAULT NULL COMMENT 'frecuencia de notificaciones de pedidos sin pagar(segundos)',
  `frecuencia_notificaciones_cotizacion_a_pedido` varchar(100) DEFAULT NULL COMMENT 'frecuencia notificaciones de cotizaciones sin ser pedidos(segundos)',
  `frecuencia_notificaciones_material_minimo` varchar(100) DEFAULT NULL COMMENT 'frecuencia recordatorio material terminado(segundos)',
  `frecuencia_notificaciones_material_caduco` varchar(100) DEFAULT NULL COMMENT 'frecuencia recordatorio material caduco(segundos)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`servidor_smtp`, `puerto`, `usuario_correo_notificaciones`, `contrasena_usuario_correo_notificaciones`, `frecuencia_notificaciones_pago`, `frecuencia_notificaciones_cotizacion_a_pedido`, `frecuencia_notificaciones_material_minimo`, `frecuencia_notificaciones_material_caduco`) VALUES
('smtp.soetecnologia.com', 587, 'notificaciones@soetecnologia.com', 'Notificashion2013', '600', '600', '600', '600');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto_ventas`
--

CREATE TABLE IF NOT EXISTS `contacto_ventas` (
  `contacto_ventas_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cliente_id` varchar(10) NOT NULL DEFAULT 'NULL',
  `generales_id` bigint(20) NOT NULL,
  PRIMARY KEY (`contacto_ventas_id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `generales_id` (`generales_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Contacto para Personal de Ventas' AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `contacto_ventas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE IF NOT EXISTS `contrato` (
  `contrato_id` varchar(10) NOT NULL,
  `cliente_id` varchar(10) NOT NULL,
  `contrato_descripcion` varchar(200) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_terminacion` date NOT NULL,
  `contrato_mt` decimal(10,0) DEFAULT NULL COMMENT 'monto total',
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla Contrato';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE IF NOT EXISTS `cotizacion` (
  `cotizacion_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cotizacion_edo` tinyint(4) NOT NULL DEFAULT '0',
  `cliente_id` varchar(10) DEFAULT NULL,
  `usuario_id` varchar(10) NOT NULL DEFAULT 'NULL',
  `empresa_id` bigint(20) DEFAULT NULL,
  `cotizacion_folio` int(11) DEFAULT '0',
  `cotizacion_fecha_modificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cotizacion_fecha_envio` datetime DEFAULT NULL,
  `moneda_id` bigint(20) DEFAULT NULL,
  `cotizacion_divisa_dia` decimal(10,2) DEFAULT NULL,
  `cotizacion_observaciones` varchar(300) DEFAULT NULL,
  `contacto_ventas_id` bigint(20) DEFAULT NULL,
  `cotizacion_mensaje` varchar(500) DEFAULT NULL,
  `cotizacion_dias_entrega` int(3) DEFAULT '5',
  `cotizacion_condiciones_pago` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT 'Ver Anexo',
  `cotizacion_vigencia` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cotizacion_recotizada` bigint(20) DEFAULT NULL,
  `cotizacion_tipo` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'producto=0; servicio=1',
  PRIMARY KEY (`cotizacion_id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `cotizacion_ibfk_3` (`empresa_id`),
  KEY `cotizacion_ibfk_4` (`moneda_id`),
  KEY `cotizacion_ibfk_5` (`contacto_ventas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla de Cotizaciones' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE IF NOT EXISTS `detalle_compra` (
  `detalle_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `orden_compra_id` bigint(20) NOT NULL,
  `almacen_id` bigint(20) NOT NULL,
  `detalle_compra_cantidad` tinyint(4) NOT NULL DEFAULT '0',
  `detalle_compra_cantidad_s` decimal(10,0) NOT NULL DEFAULT '0',
  `producto_id` bigint(20) NOT NULL,
  `costo` double DEFAULT NULL COMMENT 'Costo que viene en factura',
  PRIMARY KEY (`detalle_id`),
  KEY `orden_compra_id` (`orden_compra_id`),
  KEY `almacen_material_id` (`almacen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla DETALLE ORDEN COMPRA' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cotizacion`
--

CREATE TABLE IF NOT EXISTS `detalle_cotizacion` (
  `detalle_cotizacion_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `cotizacion_id` bigint(20) NOT NULL DEFAULT '0',
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `observaciones` varchar(300) DEFAULT NULL,
  `multiplo` decimal(10,2) NOT NULL DEFAULT '1.00',
  `procto-servicio` bigint(20) NOT NULL COMMENT 'producto=0; servicio=1;',
  `cotizacion_tipo` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'producto=0; servicio=1;',
  PRIMARY KEY (`detalle_cotizacion_id`),
  KEY `cotizacion_id` (`cotizacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='DETALLE COTIZACION' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_material`
--

CREATE TABLE IF NOT EXISTS `detalle_material` (
  `detalle_material_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `material_id` bigint(20) NOT NULL,
  `detalle_material_cantidad` int(11) NOT NULL,
  `detalle_material_observaciones` varchar(50) DEFAULT NULL,
  `detalle_producto_id` bigint(20) NOT NULL,
  PRIMARY KEY (`detalle_material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden_salida`
--

CREATE TABLE IF NOT EXISTS `detalle_orden_salida` (
  `detalle_orden_compra_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `orden_salida_id` bigint(20) NOT NULL COMMENT 'llave foranea de ORDEN de SALIDA',
  `cantidad_salida` decimal(10,0) DEFAULT NULL,
  `detalle_pedido_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`detalle_orden_compra_id`),
  KEY `orden_salida_id` (`orden_salida_id`),
  KEY `detalle_pedido_id` (`detalle_pedido_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla DETALLE de ORDEN de SALIDA' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `detalle_pedido_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint(20) NOT NULL,
  `detalle_cotizacion_id` bigint(20) DEFAULT NULL COMMENT 'referencia al producto cotizado ',
  `cantidad_surtida` decimal(10,0) NOT NULL DEFAULT '0',
  `detalle_pedido_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'estado (completo o incompleto)',
  `detalle_pedido_obs` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'observaciones del estado del pedido',
  `factura_id` bigint(20) NOT NULL,
  `cantidad_entregada` int(11) NOT NULL DEFAULT '0',
  `cantidad_enrutada` int(11) NOT NULL DEFAULT '0',
  `cantidad` int(11) NOT NULL,
  `pedido_tipo` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'Almacen:0 , Taller:1',
  `producto_id` bigint(20) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `multiplo` decimal(10,2) NOT NULL,
  `cantidad_recoger` bigint(20) DEFAULT NULL,
  `cantidad_prestamo` bigint(20) DEFAULT NULL,
  `fecha_recoleccion` date DEFAULT NULL,
  `facturado` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=no facturado, 1 Facturado',
  PRIMARY KEY (`detalle_pedido_id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `detalle_cotizacion_id` (`detalle_cotizacion_id`),
  KEY `factura_id` (`factura_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_taller_solicitud`
--

CREATE TABLE IF NOT EXISTS `detalle_taller_solicitud` (
  `detalle_taller_solicitud_id` int(10) NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) NOT NULL,
  `cantidad_solicitada` int(10) NOT NULL,
  PRIMARY KEY (`detalle_taller_solicitud_id`),
  KEY `taller_solicitud_ibfk1` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE IF NOT EXISTS `domicilio` (
  `domicilio_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `domicilio_calle` varchar(200) DEFAULT 'NULL',
  `domicilio_num_ext` varchar(20) DEFAULT NULL,
  `domicilio_num_int` varchar(20) DEFAULT NULL,
  `domicilio_colonia` varchar(50) DEFAULT 'NULL',
  `domicilio_municipio` varchar(50) DEFAULT 'NULL',
  `domicilio_ciudad` varchar(50) DEFAULT NULL,
  `domicilio_estado` varchar(20) DEFAULT NULL,
  `domicilio_cp` int(5) DEFAULT NULL,
  PRIMARY KEY (`domicilio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=144 ;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`domicilio_id`, `domicilio_calle`, `domicilio_num_ext`, `domicilio_num_int`, `domicilio_colonia`, `domicilio_municipio`, `domicilio_ciudad`, `domicilio_estado`, `domicilio_cp`) VALUES
(1, 'Saltillo ', '29', '', 'Jardines de Guadalupe', 'Nezahualcoyotl', 'Nezahualcoyotl', 'Mexico', 57140),
(2, 'CONSTITUCION DE LA REPUBLICA ', '106', '', 'Jardines de Guadalupe', 'Nezahualcoyotl', 'Mexico', 'ESTADO DE ', 57140),
(3, 'CALADA SANTA ANA, NORTE', '67', '', 'TORRES LINDA VISTA', 'GUSTAVO A MADERO', 'Mexico', 'Distrito F', 7208),
(4, 'AV CHALMA LA VILLA', '50', 'EDIF. 72 DEPTO. 403', 'EL ARBOLILLO', 'GUSTAVO A MADERO', 'Mexico', 'Distrito F', 7240),
(5, 'Saltillo ', '29', '', 'Jardines de Guadalupe', 'Nezahualcoyotl', 'Nezahualcoyotl', 'Mexico', 57140),
(6, 'Saltillo ', '29', '', 'Jardines de Guadalupe', 'Nezahualcoyotl', 'Nezahualcoyotl', 'Mexico', 57140),
(7, 'Saltillo ', '29', '', 'Jardines de Guadalupe', 'Nezahualcoyotl', 'Nezahualcoyotl', 'Mexico', 57140),
(8, 'Privada de Ayate', '3', '', 'H. Fuentes', 'Calimaya', 'Calimaya', 'Estado de México', 52230),
(9, '', '', '', '', '', '', '', 0),
(10, '', '', '', '', '', '', '', 0),
(11, '', '', '', '', '', '', '', 0),
(12, '', '', '', '', '', '', '', 0),
(13, '', '', '', '', '', '', '', 0),
(14, '', '', '', '', '', '', '', 0),
(15, '', '', '', '', '', '', '', 0),
(16, '', '', '', '', '', '', '', 0),
(17, '', '', '', '', '', '', '', 0),
(18, '', '', '', '', '', '', '', 0),
(19, '', '', '', '', '', '', '', 0),
(20, '', '', '', '', '', '', '', 0),
(21, '', '', '', '', '', '', '', 0),
(22, '', '', '', '', '', '', '', 0),
(23, '', '', '', '', '', '', '', 0),
(24, '', '', '', '', '', '', '', 0),
(25, '', '', '', '', '', '', '', 0),
(26, '', '', '', '', '', '', '', 0),
(27, '', '', '', '', '', '', '', 0),
(28, '', '', '', '', '', '', '', 0),
(29, '', '', '', '', '', '', '', 0),
(30, 'KM.13.7 CARR QRO.', '', '', 'APASEO EL ALTO', 'GUANAJUATO', 'ESTADO', 'GUANAJUATO', 38511),
(31, 'MONTE PELVOUX', '111', '8,9', 'MONTE PELVOUX', 'MIGUEL  HIDALGO', 'MEXICO', 'DISTRITO FEDERAL', 11000),
(32, 'RIO DE LA PLATA BIS ', '53', '', 'CUAUTEMOC', 'DEL. CUAUHTEMOC', 'MEXICO', 'DISTRITO FEDERAL', 6500),
(33, 'PROLONGACION PETEN', '963', '', 'SANTA CRUZ ATOYAC9634', 'BENITO JUAREZ', 'MEXICO', 'DISTRITO FEDERAL', 6600),
(34, 'AV.PRESIDENTE JUAREZ', '58', '', 'CENTRO  TLALNEP.', 'TLALNEPANTLA', 'ESTADO', 'MEXICO', 54000),
(35, 'AV.20  DE NOVIEMBRE ', '195', '', 'CENTRO  ', 'CUAUHTEMOC', 'MEXICO', 'DISTRITO FEDERAL', 6080),
(36, 'TENAYUCA ', '82', '', 'INDUST. TLALNEPATLA', 'TLALNEPANTLA', 'EDO', 'ESTADO DE MEXICO', 54030),
(37, 'GUILLERMO CAMARENA', '1200', '9-10', 'ALVARO OBREGON', 'ALVARO OBREGON', 'MEXICO', 'DISTRITO FEDERAL', 1210),
(38, 'RIVA PALACIOS', '8', '', 'CENTRO', 'TLALNEPANTLA', 'EDO', 'ESTADO DE MEXICO', 54000),
(39, 'PLAZA JUAREZ', '20', '', 'CENTRO', 'CUAUTEMOC', 'MEXICO', 'DISTRITO FEDERAL', 6010),
(40, 'AV. MONTEVIDEO', '8', '', 'TEPEYAC INSURGE.', 'GUSTAVO A MADERO', 'MEXICO', 'DISTRITO FEDERAL', 7020),
(41, '', '', '', '', '', '', '', 0),
(42, 'AV.EJERCITO NACIONAL', '418', '9', 'CHAPULTEPEC MOR.', 'MIGUEL  HIDALGO', 'MEXICO', 'DISTRITO FEDERAL', 11570),
(43, 'AV. DE LOS REYES', '91', '', 'RESIDENCIAL DOR.', 'TLALNEPANTLA', 'ESTADO', 'ESTADO DE MEXICO', 54070),
(44, '', '', '', '', '', '', '', 0),
(45, 'PERIFERICO SUR ', '4249', '-', 'JARDINES DE LA MONTA?A', '-', 'TLALPAN', 'DISTRITO FEDERAL', 14210),
(46, 'MAGNO CENTRO', '26', '-', 'BOSQUE DE LAS PALMAS', 'HUIXQUILUCAN', '-', 'EDO.MEX.', 0),
(47, 'PLAZA DE LA CONSTITUCI?N', 'S/N', '-', 'CENTRO', '-', 'MIGUEL HIDALGO', 'DISTRITO FEDERAL', 0),
(48, 'PLAZA DE LA CONSTITUCI?N', 'S/N', '-', 'CENTRO', '-', 'VENUSTIANO CARRANZA', 'DISTRITO FEDERAL', 0),
(49, 'PRIV. CEYLAN', 'S/N', '-', 'INDUSTRIAL VALLEJO', '', 'AZCAPOTZALCO', 'DISTRITO FEDERAL', 0),
(50, 'CALLE SUR8', '71', '-', 'AGRICOLA ORIENTAL', '-', 'IZTACALCO', 'DISTRITO FEDERAL', 8500),
(51, 'CUMBRES DE LAS NACIONES', '1200', '-', 'FRACC. TRES MARIAS ', 'MORELIA', '-', 'MICHOACAN', 0),
(52, 'AV. JESUS DEL MONTE', '39', '-', 'JESUS DEL MONTE', 'CUAJIMALPA DE MORELOS', '', 'EDO.MEX.', 0),
(53, 'AV.DE LAS PALMAS', '905', '-', 'LOMAS DE CHAPULTEPEC', '-', 'MIGUEL HIDALGO', 'DISTRITO FEDERAL', 0),
(54, 'CLZ.VALLEJO', '740', '-', 'INDUSTRIAL VALLEJO', '-', 'AZCAPOTZALCO', 'DISTRITO FEDERAL', 0),
(55, 'PIROTECNIA', '89', '-', 'AZTECA', '-', 'VENUSTIANO CARRANZA', 'DISTRITO FEDERAL', 15320),
(56, 'IXTLAHUACA', '10', '-', 'STA. ISABEL TOLA', '-', 'GUSTAVO A. MADERO', 'DISTRITO FEDERAL', 0),
(57, 'FRAY SERVANDO TERESA DE MIER', 'S/N', '-', 'MERCED BALBUENA', '-', 'CUAUHTEMOC', 'DISTRITO FEDERAL', 0),
(58, 'MAGNO CENTRO', '25', '5TO PISO', 'BOSQUE DE LAS PALMAS', 'HUIXQUILUCAN', '-', 'EDO.MEX.', 0),
(59, 'MAGNO CENTRO', '25', '5TO PISO', 'BOSQUE DE LAS PALMAS', 'HUIXQUILUCAN', '-', 'EDO.MEX.', 0),
(60, 'MAGNO CENTRO', '25', '5TO PISO', 'BOSQUE DE LAS PALMAS', 'HUIXQUILUCAN', '-', 'EDO.MEX.', 0),
(61, 'DR. LAVISTA', '-', 'PISO 1', 'DOCTORES', '-', 'CUAUHTEMOC', 'DISTRITO FEDERAL', 0),
(62, 'MONTE DE PIEDAD', '7', '-', 'CENTRO', '-', 'CUAUHTEMOC', 'DISTRITO FEDERAL', 6000),
(63, 'AV. REVOLUCION', '780', '-', 'SAN JUAN', 'HUIXQUILUCAN', '-', 'EDO.MEX.', 0),
(64, 'PONIENTE 122', '489', '-', 'COLTONGO', '-', 'AZCAPOTZALCO', 'DISTRITO FEDERAL', 0),
(65, 'MIRADOR', '77', '-', '?', '-', 'TEPEPAN', 'DISTRITO FEDERAL', 0),
(66, 'CLAVIJEROS', '60', '-', 'TRANSITO', '-', 'CUAUHTEMOC', 'DISTRITO FEDERAL', 0),
(67, 'GUADALAJARA', '5', '-', 'CONSTITUCION DE 1917', 'TLALNEPANTLA', '-', 'EDO.MEX.', 54190),
(68, 'GUADALAJARA', '5', '-', 'CONSTITUCION DE 1917', 'TLALNEPANTLA', '-', 'EDO.MEX.', 54190),
(69, 'ALEMANIA', '70', '-', 'INDEPENDENCIA', '-', 'BENITO JUAREZ', 'DISTRITO FEDERAL', 0),
(70, 'ALEMANIA', '10', '-', 'INDEPENDENCIA', '-', 'BENITO JUAREZ', 'DISTRITO FEDERAL', 0),
(71, 'CARR. MEXICO-QRO', 'KM36.5', '-', 'PANTITLAN', '-', '-', '-', 0),
(72, 'LOPE DE VEGA', '334', '-', 'POLANCO', '-', 'MIGUEL HIDALGO', 'DISTRITO FEDERAL', 11550),
(73, 'LAGO DE GUADALUPE', '95', '-', 'SAN MATEO TECOLOAPAN', 'CIUDAD LOPEZ MATEOS', '-', 'EDO.MEX.', 0),
(74, 'PREADO SUR', '136', '-', 'LOMAS DE CHAPULTEPEC', '-', 'MIGUEL HIDALGO', 'DISTRITO FEDERAL', 11000),
(75, 'PROLONGACI?N DE LA REFORMA', '500', 'PISO 2 MOD. 206', '-', '-', '-', '-', 0),
(76, 'MONTHE ATHOS', '179', '-', 'LOMAS DE CHAPULTEPEC', '-', 'MIGUEL HIDALGO', 'DISTRITO FEDERAL', 11000),
(77, 'TECOYOTITLA', '100', '-', 'FLORIDA', '-', 'ALVARO OBREGON', 'DISTRITO FEDERAL', 1030),
(78, 'EMPRESA', '66', '-', 'MIXCOAC', '-', 'BENITO JUAREZ', 'DISTRITO FEDERAL', 3910),
(79, 'CALLE 3', 'S/N', '-', 'INDEPENDENCIA', 'TULTITLAN', '-', 'EDO.MEX.', 54900),
(80, 'CALLE 3', 'S/N', '-', 'INDEPENDENCIA', 'TULTITLAN', '-', 'EDO.MEX.', 54900),
(81, 'AV. DE LA PRESA', '2', '-', 'FRACC. IND. LA PRESA', 'TLALNEPANTLA', '-', 'EDO.MEX.', 54187),
(82, 'AV. INDUSTRIA ELECTRICA', 'S/N', '-', 'COL. BARRIENTOS', 'TLALNEPANTLA', '-', 'EDO.MEX.', 99999),
(83, 'CARR. MEXICO-CD. SAHAGUN', 'KM3', '-', '-', 'CD. SAHAG?N', '-', 'HIDALGO', 43990),
(84, 'LA MORENA', '110', '-', 'DEL VALLE', '-', 'BENITO JUAREZ', 'DISTRITO FEDERAL', 0),
(85, 'AV. INSURGENTES SUR', '1735', '-', 'GUADALUPE INN', '-', 'ALVARO OBREGON', 'DISTRITO FEDERAL', 0),
(86, 'AV. ALEJANDRO DE RODAS', '3102-A', '', 'CUMBRES 8VO SECTOR', 'MONTERREY', 'MONTERREY', 'NUEVO LEON', 64610),
(87, 'PLOMO', '2', '', 'XALOSTOC', 'ECATEPEC', '', 'EDOMEX', 55320),
(88, 'AV.INSURGENTES SUR ', '421', '', 'ROMA NORTE', 'DEL. A. OBREGON', 'DISTRITO FEDERAL', 'D.F.', 6700),
(89, 'MAIZ', '49', '', 'XOCHIMILCO', 'DEL. XOCHIMILCO', 'DISTRITO FEDERAL', 'D.F.', 16090),
(90, 'MUNICIPIO LIBRE', '377', '', 'STA CRUZ ATOYAC', 'DEL. BENITO JUAREZ', 'DISTRITO FEDERAL', 'D.F.', 3310),
(91, 'UXMAL', '866', '', 'STA CRUZ ATOYAC', 'DEL. BENITO JUAREZ', 'DISTRITO FARDERAL', 'D.F.', 3310),
(92, 'INSURGENTES SUR ', '489', 'PISO 18', 'HIPODROMO CONDESA', 'DEL. CUAUHTEMOC', 'DISTRITO FEDERAL', 'D.F.', 6100),
(93, 'PLOMO', '54', '', 'XALOSTOC', 'ECATEPEC', 'ESTADO DE MEXICO', 'EDOMEX', 55320),
(94, 'VICENTE GUERRERO', '18', '', 'SAN MIGUEL', 'ECATEPEC', 'ESTADO DE MEXICO', 'EDOMEX', 0),
(95, 'FERNANDO MONTES DE OCA', '21', '1', 'FRACC IND SAN NICOLAS', 'TLALNEPANTLA', 'ESTADO DE MEXICO', 'EDOMEX', 54030),
(96, 'GANTE', '20', '', 'CENTRO', 'DEL. BENITO JUAREZ', 'DISTRITO FEDERAL', 'D.F.', 6059),
(97, '', '', '', '', '', '', '', 0),
(98, '', '', '', '', '', '', '', 0),
(99, '', '', '', '', '', '', '', 0),
(100, '', '', '', '', '', '', '', 0),
(101, '', '', '', '', '', '', '', 0),
(102, '', '', '', '', '', '', '', 0),
(103, '', '', '', '', '', '', '', 0),
(104, '', '', '', '', '', '', '', 0),
(105, 'AV. MIGUEL HIDALGO', '-', 'CENTRO', '45', 'CUAUHTEMOC', '-', '', 0),
(106, 'HOMERO', '-', 'POLANCO', '1521', 'MIGUEL HIDALGO', '-', '', 0),
(107, 'CALLE 10', '-', 'SAN PEDRO DE LOS PIN', '145', 'BENITO JUAREZ', '-', '', 0),
(108, 'AV. CERRADA DE LA PRESA', '-', 'LA PRESA', '47', '-', 'TLALNEPANTLA', '', 0),
(109, 'RIO SENA', '2do. PISO', 'CUAUHTEMOC', '63', 'CUAUHTEMOC', '-', '', 0),
(110, 'MELCHOR OCAMPO', '-', 'VERONICA ANZURES', '193', 'MIGUEL HIDALGO', '-', '', 0),
(111, 'AV. INSURGENTES', '-', 'DEL VALLE', '-', 'BENITO JUAREZ', '-', '', 0),
(112, 'CARR. SANTA ANA DEL CONDE', '-', 'MONTEBELLO', 'S/N', '-', 'LE?N', '', 0),
(113, 'LAGO VICTORIA', 'PISO 9', 'GRANADA', '74', 'MIGUEL HIDALGO', '-', '', 0),
(114, 'AV. EJERCITO NACIONAL', '-', 'CHAPULTEPEC MORALES', '350', '-', '-', '', 0),
(115, 'CARR. JOROBAS TULA', '-', 'JAIME CANT', 'KM.3.5', '-', 'HUEHUETOCA', '', 0),
(116, 'INGNACIO ALTAMIRANO', '-', 'SAN RAFAEL', '28', 'CUAUHTEMOC', '-', '', 0),
(117, 'AV. AVILA CAMACHO', '-', 'SAN FRANCISCO CUAUTL', '348', '-', 'NAUCALPAN', '', 0),
(118, 'PREADO SUR', '136', '-', 'LOMAS DE CHAPULTEPEC', '-', 'MIGUEL HIDALGO', 'DISTRITO FEDERAL', 11000),
(119, 'PROLONGACI?N DE LA REFORMA', '500', 'PISO 2 MOD. 206', '-', '-', '-', '-', 0),
(120, 'MONTHE ATHOS', '179', '-', 'LOMAS DE CHAPULTEPEC', '-', 'MIGUEL HIDALGO', 'DISTRITO FEDERAL', 11000),
(121, 'TECOYOTITLA', '100', '-', 'FLORIDA', '-', 'ALVARO OBREGON', 'DISTRITO FEDERAL', 1030),
(122, 'EMPRESA', '66', '-', 'MIXCOAC', '-', 'BENITO JUAREZ', 'DISTRITO FEDERAL', 3910),
(123, 'CALLE 3', 'S/N', '-', 'INDEPENDENCIA', 'TULTITLAN', '-', 'EDO.MEX.', 54900),
(124, 'CALLE 3', 'S/N', '-', 'INDEPENDENCIA', 'TULTITLAN', '-', 'EDO.MEX.', 54900),
(125, 'AV. DE LA PRESA', '2', '-', 'FRACC. IND. LA PRESA', 'TLALNEPANTLA', '-', 'EDO.MEX.', 54187),
(126, 'AV. INDUSTRIA ELECTRICA', 'S/N', '-', 'COL. BARRIENTOS', 'TLALNEPANTLA', '-', 'EDO.MEX.', 99999),
(127, 'CARR. MEXICO-CD. SAHAGUN', 'KM3', '-', '-', 'CD. SAHAG?N', '-', 'HIDALGO', 43990),
(128, 'LA MORENA', '110', '-', 'DEL VALLE', '-', 'BENITO JUAREZ', 'DISTRITO FEDERAL', 0),
(129, 'AV. INSURGENTES SUR', '1735', '-', 'GUADALUPE INN', '-', 'ALVARO OBREGON', 'DISTRITO FEDERAL', 0),
(130, 'AV. CENTRAL', '186-A', '-', 'NUEVA INDUSTRIAL VALLEJO', '-', 'GUSTAVO A. MADERO', 'DISTRITO FEDERAL', 0),
(131, 'AV. M?XICO', '62', '-', 'LOS LAURELES', '-', '-', '-', 0),
(132, 'GENERAL ANAYA', '174', '-', 'BARRIO DE STA BARBARA', '-', 'IZTAPALAPA', 'DISTRITO FEDERAL', 0),
(133, 'IRAPUATO', '259', '-', 'EL RECREO', '-', '-', '-', 0),
(134, 'SIERRA NEVADA', '119', '-', 'LOMAS DE CHAPULTEPEC', '-', 'MIGUEL HIDALGO', 'DISTRITO FEDERAL', 0),
(135, 'AV. COSTERA DE LAS PALMAS', 'LTE H8-A1', '-', 'PLAYA DIAMANTE', 'ACAPULCO', '', 'GUERRERO', 0),
(136, 'CARLOS B-ZETINA', '401-D', '-', 'XALOSTOC', 'TLALNEPANTLA', '-', 'EDOMEX', 0),
(137, 'CARLOS B-ZETINA', '80', '-', 'XALOSTOC', 'TLALNEPANTLA', '-', 'EDOMEX', 0),
(138, 'AV. JAVIER BARROS SIERRA', '540', 'TORRE 1 PISO 2', 'ZEDEC SANTAFE', '-', 'ALVARO OBREGON', 'DISTRITO FEDERAL', 0),
(139, 'AV. IND. MIL.', '1111', '', 'L. TECAMACHALCO', 'NAUCALPAN', 'MEXICO', 'ESTADO DE MEXICO', 53950),
(140, 'AVENIDA CAMELINAS', '3527', '902', 'LAS AMERICAS', 'MORELIA', 'MEXICO', 'MICHOACAN', 58270),
(141, 'AVENIDA CINCO', '253', '', 'GRANJAS SAN ANTONIO', 'IZTAPALAPA', 'MEXICO', 'DISTRITO FEDERAL', 9070),
(142, 'LIEJA', '7', '', 'JUAREZ', 'CUAUHTEMOC', 'MEXICO', 'DISTRITO FEDERAL', 6600),
(143, 'PARROQUIA', '1130', 'PISO 6', 'SANTA CRUZ ATOYAC', 'BENITO JUAREZ', 'MEXICO', 'DISTRITO FEDERAL', 3310);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `empresa_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `empresa_razonsocial` varchar(200) NOT NULL,
  `empresa_rfc` varchar(200) NOT NULL,
  `empresa_domicilio_fiscal` bigint(20) NOT NULL,
  PRIMARY KEY (`empresa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empresa_id`, `empresa_razonsocial`, `empresa_rfc`, `empresa_domicilio_fiscal`) VALUES
(3, 'MOGEL FLUÍDOS S.A. de C.V.', 'MOGEL999999', 1),
(4, 'GLOBAL DRILLING', 'GLOBAL777777', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_material`
--

CREATE TABLE IF NOT EXISTS `entrada_material` (
  `entrada_material_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `almacen_material_id` bigint(20) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `cantidad_ingreso` decimal(10,0) NOT NULL DEFAULT '0',
  `usuario_id` varchar(20) NOT NULL,
  `material_obs` varchar(100) NOT NULL DEFAULT 'NULL',
  `orden_compra_id` bigint(20) NOT NULL,
  `entrada_folio` varchar(20) NOT NULL COMMENT 'folio factura, remision, etc',
  PRIMARY KEY (`entrada_material_id`),
  KEY `almacen_material_id` (`almacen_material_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `orden_compra_id` (`orden_compra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla Entrada Material' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `factura_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `factura_fecha` datetime NOT NULL,
  `factura_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'estado (completo o incompleto)',
  `factura_descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'NULL',
  `pedido_id` bigint(20) NOT NULL,
  PRIMARY KEY (`factura_id`),
  KEY `pedido_pantalla_ibfk_2` (`pedido_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generales`
--

CREATE TABLE IF NOT EXISTS `generales` (
  `generales_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apel_p` varchar(50) NOT NULL DEFAULT 'NULL',
  `apel_m` varchar(50) DEFAULT NULL,
  `tel_trabajo` varchar(12) DEFAULT NULL,
  `ext_tel_trabajo` varchar(12) DEFAULT NULL,
  `tel_casa` varchar(12) DEFAULT NULL,
  `tel_cel` varchar(12) DEFAULT NULL,
  `email` varchar(60) NOT NULL DEFAULT 'NULL',
  PRIMARY KEY (`generales_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla de GENERALES de USUARIO, CONTACTO, ETC' AUTO_INCREMENT=138 ;

--
-- Volcado de datos para la tabla `generales`
--

INSERT INTO `generales` (`generales_id`, `nombre`, `apel_p`, `apel_m`, `tel_trabajo`, `ext_tel_trabajo`, `tel_casa`, `tel_cel`, `email`) VALUES
(1, 'Usuario', 'Normal', 'Sencillo', '1111', '2222', '3333', '4444', 'user@promex.com'),
(2, 'Antonio', 'Butrón', 'Luz', '', '', '', '', 'juanantonio.butron@soetecnologia.com'),
(3, 'Jaime', 'Solano', 'Hernández', '', '', '', '', 'j.solano19@promexextintores.com.mx'),
(4, 'Gerardo', 'Arriola', '', '', '', '', '', 'gerardo.arriola@promexextintores.com.mx'),
(5, 'Mauricio', 'Solano', 'Hernández', '', '', '', '', 'mauricio.solano@promexextintores.com.mx'),
(6, 'Angeles', 'Cruz', 'Segundo', '', '', '', '', 'angeles.cruz@promexextintores.com.mx'),
(8, 'Lidia', 'Ocampo', 'Altamirano', '', '', '', '', 'lidia.ocampo@promexextintores.com.mx'),
(9, 'Carlos', 'Ledezma', '', '', '', '', '', 'carlos.ledezma@promexextintores.com.mx'),
(10, 'Veronica', 'Mignon', 'González', '', '', '', '', 'veronica.mignon@promexextintores.com.mx'),
(11, 'Ricardo', 'Perez', '', '', '', '', '', 'ricardo.perez@promexextintores.com.mx'),
(12, 'Wendy', 'Barrios', 'Gomez', '', '', '', '', 'facturacion@promexextintores.com.mx'),
(13, 'Esther', 'Curiel', '', '', '', '', '', 'esther.curiel@promexextintores.com.mx'),
(14, 'Pedro', 'Solano', 'Hernández', '', '', '', '', 'pedro.solano@promexextintores.com.mx'),
(15, 'Rene', 'Figueroa', 'Umaña', '', '', '', '', 'rene.figueroa@promexextintores.com.mx'),
(16, 'Hector', 'Perez', '', '', '', '', '', 'hector.perez@promextintores.com.mx'),
(17, 'Jair', 'Olivares', 'Arano', '', '', '', '', 'jair.olivares@promexextintores.com.mx'),
(18, 'Alfredo', 'Delgado', 'Ortiz', '', '', '', '', 'alfredo.delgado@promexextintores.com.mx'),
(19, 'Sergio', 'Fernandez', 'Franco', '', '', '', '', 'sergio.fernandez@promexextintores.com.mx'),
(20, 'Ruben', 'Gama', 'Hernández', '', '', '', '', 'ruben.gama@promexextintores.com.mx'),
(21, 'Jaime', 'Vega', '', '', '', '', '', 'jaime.vega@promexextintores.com.mx'),
(22, 'Luis Ruben', 'Martin del Campo', '', '', '', '', '', 'luis.martindelcampo@promexextintores.com.mx'),
(23, 'Socorro', 'Olalde', 'Bolaños', '', '', '', '', 'socorro.olalde@promexextintores.com.mx'),
(24, 'SR.FACUNDO  LUNA', '', '', '55659333', '55659333', '0', '0', 'fluna@gruposayer.com'),
(25, 'LIC LUCERO  MARLENE  GARCIA', '', '', '59998400', '133', '0', '0', 'lmarlene@bd.com'),
(26, 'SR. LUIS GERARDO LEON', '', '', '52860600', '114', '0', '0', 'luisgerardo.leon@gknobloch.mx'),
(27, 'SE?ORITA  SUSANA CORTES', '', '', '50903600', '57241', '0', '0', 'susan_cortez@hotmail.com'),
(28, 'SR. JUAN AYLLON GARCIA', '', '', '55659811', '213', '0', '0', 'jayolln.garcia@liconsa.gob.mx'),
(29, 'JUAN GABRIEL  FARFAN', '', '', '50641400', '', '0', '0', 'jfarfan@ran.gob.com.mx'),
(30, 'CHRISTIAN  CULIN', '', '', '35361100', '', '0', '0', 'estandar@christian.com.mx'),
(31, 'ENRIQUE RAMIREZ', '', '', '', '', '0', '0', 'eramirez@actinver.com'),
(32, 'MARA BERENICE SANCHEZ', '', '', '', '', '0', '0', 'mberenice@opd.gob.com.mx'),
(33, 'JOSE MANUEL ROCIO', '', '', '36865100', '', '0', '0', 'jrocio@sre.gob.mx'),
(34, 'GABRIELA  PE?A', '', '', '', '', '0', '0', ''),
(35, '', '', '', '', '', '0', '0', ''),
(36, '', '', '', '', '', '0', '0', ''),
(37, 'ALMA DELIA HURTA HERNANDEZ', '', '', '', '', '0', '0', ''),
(38, '', '', '', '', '', '0', '0', ''),
(39, 'CLAUDIA CASTREJON', '', '', '50006800', '', '0', '0', 'ccastrejon@gia.mx'),
(40, 'RICARDO RAM?REZ', '', '', '91142083', '-', '0', '0', 'rramirez@grupofrisa.com'),
(41, 'CP. MARIO SERRANO AMER', '', '', '54183280', '-', '0', '0', '-'),
(42, 'LIC. ISMAEL ALCANTARA', '', '', '57649400', '-', '0', '0', '-'),
(43, 'ALEJANDRO LICONA', '', '', '-', '-', '0', '0', 'alicona@cambifon.com.mx'),
(44, 'ANGELES CABRERA/ CP. GABINO JIMENEZ', '', '', '57585838', '-', '0', '0', 'acabrera@conformex.com.mx'),
(45, 'ING. JOS? ZAPIEN', '', '', '433226200', '-', '0', '0', 'jzapien@cinepolis.com'),
(46, 'JUAN CARLOS', '', '', '57559527', '-', '0', '0', '-'),
(47, 'JAVIER ANZUREZ', '', '', '51480400', '-', '0', '0', 'j.anzurez@cabimail.com.mx'),
(48, 'ARQ. SORAIDA INCLAN ', '', '', '55176324', '-', '0', '0', 'soraida@nextcapital.com.mx'),
(49, 'FELIX ZU?IGA', '', '', '57410749', '-', '0', '0', 'seg.higiene@pascual.com.mx'),
(50, 'FELIX ZU?IGA/ PRUDENCIO GARCIA', '', '', '57410749', '-', '0', '0', 'seg.higiene@pascual.com.mx'),
(51, 'ING. SERGIO BARAJAS', '', '', '57413752', '-', '0', '0', '-'),
(52, 'RICARDO RAM?REZ', '', '', '91142083', '-', '0', '0', 'rramirez@grupofrisa.com'),
(53, 'RICARDO RAM?REZ', '', '', '91142083', '-', '0', '0', 'rramirez@grupofrisa.com'),
(54, 'RICARDO RAM?REZ', '', '', '91142083', '-', '0', '0', 'rramirez@grupofrisa.com'),
(55, 'NELSON MEJIA', '', '', '-', '-', '0', '0', '-'),
(56, 'LILIANA HERNANDEZ', '', '', '52781800', '-', '0', '0', 'lhernandez@montepiedad.com.mx'),
(57, 'RICARDO RAM?REZ', '', '', '91142083', '-', '0', '0', 'rramirez@grupofrisa.com'),
(58, '-', '', '', '-', '-', '0', '0', '-'),
(59, '-', '', '', '-', '-', '0', '0', '-'),
(60, 'FELIX ZU?IGA', '', '', '57410749', '-', '0', '0', 'seg.higiene@pascual.com.mx'),
(61, 'YURIKO FLORES', '', '', '5533002100', '-', '0', '0', '-'),
(62, 'YURIKO FLORES', '', '', '5533002100', '-', '0', '0', '-'),
(63, 'DALIA SELENE ESTUDILLO', '', '', '54209528', '-', '0', '0', 'bestolestudillo@fundacionbest.org.mx'),
(64, 'DALIA SELENE ESTUDILLO', '', '', '54209528', '-', '0', '0', 'bestolestudillo@fundacionbest.org.mx'),
(65, 'LIC. MAGDALENA MTZ', '', '', '58725536', '-', '0', '0', 'mmartinez@estetic.com.mx'),
(66, '-', '', '', '-', '-', '0', '0', '-'),
(67, 'MITZY GARCIA', '', '', '-', '-', '0', '0', '-'),
(68, 'ARQ. GISELA SANTILLAN', '', '', '26230649/534', '-', '0', '0', 'gsantillan@ideainterior.com'),
(69, 'LIC. VIRGINIA L?PEZ', '', '', '52578000', '14537', '0', '0', 'vlopezch@santander.com.mx'),
(70, 'LIA JESUS CARMONA', '', '', '52833140', '3409', '0', '0', 'jcarmona@mortonsubastas.com'),
(71, 'ING. LUIS SERGIO CIPRES ROMERO', '', '', '50904200', '4094', '0', '0', 'isciores@fonatur.gob.mx'),
(72, 'LIC. JUAN CARLOS BRAVO', '', '', '55635022', '-', '0', '0', 'jcbravo@brovel.com.mx'),
(73, 'ING. MIGUEL VAZQUEZ', '', '', '24872094', '-', '0', '0', 'miguel.vazquez@gerdau.com'),
(74, 'SRITA LUZ MEJIA', '', '', '24872050', '-', '0', '0', 'luz.mejia@sidertul.com.mx'),
(75, 'ING. CESAR OSNAYA PEREZ', '', '', '24872096', '-', '0', '0', 'cesar.osnaya@gerdau.com'),
(76, 'ING. CESAR OSNAYA PEREZ', '', '', '24872096', '-', '0', '0', 'cesar.osnaya@gerdau.com'),
(77, 'ING. MARCOS FLORES', '', '', '38887035', '-', '0', '0', 'marcos.flores@gerdau.com'),
(78, 'ING. ISMAEL SOTO', '', '', '54201100', '-', '0', '0', 'isoto@hotmail.com'),
(79, 'LIC. MIGUEL ANGEL PAZ', '', '', '-', '-', '0', '0', '-'),
(80, 'WILLIAM PE?A BARRON', '', '', '0181 8329900', '8557', '0', '0', 'WILLIAMSPB@soriana.com'),
(81, 'ALFREDO RODRIGUEZ', '', '', '5699 0250', '1414', '0', '0', 'alfredo.rodriguez@avantormaterials.com'),
(82, 'LIC. ELIUD GARCIA / CDTE. FRANCISCO BENEVIBES', '', '', '54404300', '426095', '0', '0', 'diagnostico_dsm@hotmail.com'),
(83, 'ING LUIS LEONARDO MORALES RIOS', '', '', '56 29 83 00', '8622', '0', '0', 'luis.morales@boehringer-ingelheim.com'),
(84, 'C.P. ELISA LEON', '', '', '38 71 1000', '34 338', '0', '0', 'no tiene aun'),
(85, 'ROBERTO HERNANDEZ', '', '', '3003 2200', '3213', '0', '0', 'rserralde@dif.gob.mx'),
(86, 'LIC. ROGELIO SANCHEZ OCHOA', '', '', '5905 1000', '51655', '0', '0', 'rogelio.sanchez@senasica.gob.mx'),
(87, 'ING. ENRIQUE LANDIN', '', '', '5755 7720', '', '0', '0', 'elandin@quimicarana.com'),
(88, 'ALFREDO LEON', '', '', '57 55 9933', '', '0', '0', 'alfredo.leon@paradahnos.com'),
(89, 'MARTHA EVA VALENCIA', '', '', '5321 9612', '', '0', '0', 'mev@avante.net'),
(90, 'LIC. JESUS RAMOS NAVARRO', '', '', '52 37 2000', '4815', '0', '0', 'jramos@banxico.org.mx'),
(91, '', '', '', '', '', '0', '0', ''),
(92, '', '', '', '', '', '0', '0', ''),
(93, '', '', '', '', '', '0', '0', ''),
(94, '', '', '', '', '', '0', '0', ''),
(95, '', '', '', '', '', '0', '0', ''),
(96, '', '', '', '', '', '0', '0', ''),
(97, '', '', '', '', '', '0', '0', ''),
(98, '', '', '', 'BALLESTEROS', '', '0', '0', 'SILVIA'),
(99, '6300', '', '', 'ONTIVEROS', '', '0', '0', 'FERNANDO '),
(100, '-', '', '', 'ROJAS', '', '0', '0', 'SR. ALFONSO '),
(101, '-', '', '', 'PUENTE', '', '0', '0', 'ING. SERGIO '),
(102, '-', '', '', 'ESCOBAR', '', '0', '0', 'ALICIA '),
(103, '-', '', '', 'BOUZADA', '', '0', '0', 'ING. JAIME '),
(104, '11300', '', '', 'P?REZ ', 'ZARATE', '0', '0', 'ING. JORGE '),
(105, '-', '', '', 'VAZQUEZ', '', '0', '0', 'ING. DANIEL '),
(106, '-', '', '', 'URIBE', '', '0', '0', 'CP. GRACIELA '),
(107, '11520', '', '', '', '', '0', '0', 'ING  A.'),
(108, '-', '', '', 'MERA', '', '0', '0', 'ING. SALVADOR '),
(109, '-', '', '', 'GONZALEZ', '', '0', '0', 'ING. ISRAEL '),
(110, '6470', '', '', 'MONCADA', '', '0', '0', 'LIC. ALEJANDRO '),
(111, '-', '', '', 'J?MENEZ', '', '0', '0', 'SRA. HILDA '),
(112, 'ARQ. GISELA SANTILLAN', '', '', '26230649/534', '-', '0', '0', 'gsantillan@ideainterior.com'),
(113, 'LIC. VIRGINIA L?PEZ', '', '', '52578000', '14537', '0', '0', 'vlopezch@santander.com.mx'),
(114, 'LIA JESUS CARMONA', '', '', '52833140', '3409', '0', '0', 'jcarmona@mortonsubastas.com'),
(115, 'ING. LUIS SERGIO CIPRES ROMERO', '', '', '50904200', '4094', '0', '0', 'isciores@fonatur.gob.mx'),
(116, 'LIC. JUAN CARLOS BRAVO', '', '', '55635022', '-', '0', '0', 'jcbravo@brovel.com.mx'),
(117, 'ING. MIGUEL VAZQUEZ', '', '', '24872094', '-', '0', '0', 'miguel.vazquez@gerdau.com'),
(118, 'SRITA LUZ MEJIA', '', '', '24872050', '-', '0', '0', 'luz.mejia@sidertul.com.mx'),
(119, 'ING. CESAR OSNAYA PEREZ', '', '', '24872096', '-', '0', '0', 'cesar.osnaya@gerdau.com'),
(120, 'ING. CESAR OSNAYA PEREZ', '', '', '24872096', '-', '0', '0', 'cesar.osnaya@gerdau.com'),
(121, 'ING. MARCOS FLORES', '', '', '38887035', '-', '0', '0', 'marcos.flores@gerdau.com'),
(122, 'ING. ISMAEL SOTO', '', '', '54201100', '-', '0', '0', 'isoto@hotmail.com'),
(123, 'LIC. MIGUEL ANGEL PAZ', '', '', '-', '-', '0', '0', '-'),
(124, 'ALBERTO M. TORRES CORTES', '', '', '57540235', '-', '0', '0', 'atorres@aluprint.com.mx'),
(125, 'JUAN CARLOS L?PEZ VEGA', '', '', '57876598', '-', '0', '0', 'cqqzma918@hotmail.com'),
(126, 'ING. CARLOS GONZALEZ CAMACHO', '', '', '55024520', '112', '0', '0', 'carliles87@gmail.com'),
(127, 'ING. JOSEFINA Y SATO MATSUMOTO', '', '', '24650033', '-', '0', '0', 'jl_laser@prodigy.net.mx'),
(128, 'LIC. DANIEL PINEDA', '', '', '52414549', '105', '0', '0', '-'),
(129, 'ALEJANDRA E. PACHECO', '', '', '1100273', '-', '0', '0', 'apacheco@hotmail.com/palmeiras.alepacheco@gmail.com'),
(130, 'ING. SANTIAGO RESENDIZ RESENDIZ', '', '', '57469350', '-', '0', '0', 'sresendiz@rimsa.com.mx'),
(131, 'LIC. OMAR VAZQUEZ', '', '', '57476473', '-', '0', '0', 'imgonzalez@lacorona.info'),
(132, 'FERNANDO POBLADAR GONZALEZ', '', '', '52015800', '5348', '0', '0', '-'),
(133, 'TTE. COR. ING. IND. JOSE LUIS WENCE VEGA', '', '', '55896111', '55896422', '0', '0', 'industriamilitar@yahoo.com.mx'),
(134, 'ING. GERARDO ARRIOLA GONZALEZ', '', '', '51200324', '133', '0', '0', 'gerardo.arriola@promexextintores.com.mx'),
(135, 'ING. VERONICA OCHOA MONTERO', '', '', '55812433', '114', '0', '0', 'vochoa@convento.com.mx'),
(136, 'LIC. GERARDO GONZALEZ CANTELLANO', '', '', '50903600', '57241', '0', '0', 'gerardgonzalez@yahoo.com'),
(137, 'C.P. PATRICIA ARIAS CABELLO', '', '', '36018400', '48331', '0', '0', 'pariasc@sepdf.gob.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `material_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `material_descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'NULL',
  `material_tipo` bigint(20) NOT NULL,
  `id_unidad` bigint(10) DEFAULT NULL,
  `material_precio` float NOT NULL,
  `material_maquila` tinyint(1) NOT NULL,
  `idSAE` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla Material' AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `material`
--
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material_tipo`
--

CREATE TABLE IF NOT EXISTS `material_tipo` (
  `material_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Abreviatura',
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`material_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Categorias de los materiales' AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `material_tipo`
--

INSERT INTO `material_tipo` (`material_tipo`, `nombre`, `descripcion`, `categoria`) VALUES
(1, 'MISC', 'Miscelaneos', 'Materiales/Equipo'),
(2, 'MAT', 'Materiales', 'Materiales/Equipo'),
(3, 'NVO', 'Equipo Nuevo', 'Materiales/Equipo'),
(4, 'REC', 'Recarga de Equipo', 'Materiales/Equipo'),
(5, 'SEÑ', 'Señalizaciones', 'Materiales/Equipo'),
(6, 'E.BOM', 'Equipo Bomberos', 'Materiales/Equipo'),
(7, 'E.INC', 'Equipo VS Incendio', 'Materiales/Equipo'),
(8, 'CYG', 'Cubiertas y Gabinetes', 'Materiales/Equipo'),
(9, 'SEGP', 'Seguridad Personal', 'Materiales/Equipo'),
(10, 'PROTC', 'Protección Civil', 'Materiales/Equipo'),
(11, 'CAP', 'Capacitación', 'Materiales/Equipo'),
(12, 'M.EQ', 'Mtto. Equipo', 'Materiales/Equipo'),
(13, 'S-INC', 'Sistema VS Incendio', 'Servicios'),
(14, 'M.S-INC', 'Mtto. Sistema VS Incendio', 'Servicios'),
(15, 'R-HID', 'Red de Hidrantes', 'Servicios'),
(16, 'M.R-HID', 'Mtto. Red de Hidrantes', 'Servicios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE IF NOT EXISTS `moneda` (
  `moneda_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `moneda_descripcion` varchar(200) NOT NULL,
  `moneda_prefijo` varchar(50) NOT NULL,
  `moneda_tipo_cambio` double NOT NULL,
  PRIMARY KEY (`moneda_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`moneda_id`, `moneda_descripcion`, `moneda_prefijo`, `moneda_tipo_cambio`) VALUES
(1, 'Pesos Mexicanos', 'MXN', 1),
(2, 'Dolar Americano', ' USD', 0.076932);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_credito`
--

CREATE TABLE IF NOT EXISTS `nota_credito` (
  `nota_credito_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `orden_salida_id` bigint(20) NOT NULL,
  PRIMARY KEY (`nota_credito_id`),
  KEY `orden_salida_id` (`orden_salida_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla NOTA CREDITO' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE IF NOT EXISTS `orden_compra` (
  `orden_compra_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` varchar(200) NOT NULL,
  `proveedor_id` bigint(20) DEFAULT NULL,
  `fecha_compra` datetime DEFAULT NULL,
  `fecha_entrega_prometida` datetime NOT NULL,
  `fecha_entrega` varchar(200) NOT NULL,
  `orden_observaciones` varchar(200) NOT NULL,
  `moneda_id` bigint(20) NOT NULL,
  `orden_divisa_dia` float NOT NULL,
  `orden_edo` tinyint(4) NOT NULL,
  `factura_proveedor` varchar(50) DEFAULT NULL COMMENT 'No. Factura Proveedor',
  `usuario_id_almacen` varchar(20) DEFAULT NULL COMMENT 'Usuario del almacen',
  PRIMARY KEY (`orden_compra_id`),
  KEY `proveedor_id` (`proveedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla ORDEN_COMPRA' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_salida`
--

CREATE TABLE IF NOT EXISTS `orden_salida` (
  `orden_salida_id` bigint(20) NOT NULL,
  `pedido_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`orden_salida_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla Orden de Salida';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pantalla`
--

CREATE TABLE IF NOT EXISTS `pantalla` (
  `pantalla_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no_menu_orden` int(11) NOT NULL,
  `pantalla_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `pantalla_descripcion` varchar(50) NOT NULL,
  `id_pantalla_padre` int(11) NOT NULL,
  `pantalla_url` varchar(50) NOT NULL DEFAULT 'NULL',
  `nombre_imagen` varchar(50) NOT NULL,
  PRIMARY KEY (`pantalla_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla PANTALLA' AUTO_INCREMENT=56 ;

--
-- Volcado de datos para la tabla `pantalla`
--

INSERT INTO `pantalla` (`pantalla_id`, `no_menu_orden`, `pantalla_nombre`, `pantalla_descripcion`, `id_pantalla_padre`, `pantalla_url`, `nombre_imagen`) VALUES
(2, 1, 'ADMIN', 'Menu de catalogos', 0, 'CATALOGOS.php', ''),
(3, 1, 'PROVEEDORES', 'Modulo Proveedor', 6, 'proveedor_busqueda.php', 'proveedor'),
(4, 1, 'CLIENTES', 'Modulo clientes', 29, 'cliente_busqueda.php', '5'),
(5, 2, 'VENTAS', 'Menu de Ventas', 0, 'VENTAS.php', ''),
(6, 3, 'COMPRAS', 'Menu de Compras', 0, 'COMPRAS.php', ''),
(7, 4, 'FACTURACION', 'Menu de Facturacion', 0, 'FACTURACION.php', ''),
(8, 5, 'ALMACEN', 'Menu de Almacen', 0, 'ALMACEN.php', ''),
(9, 6, 'TALLER', 'Menu de Taller', 0, 'TALLER.php', ''),
(10, 7, 'CALIDAD', 'Menu de Calidad', 0, 'CALIDAD.php', ''),
(11, 8, 'TRAFICO', 'Menu de Trafico', 0, 'TRAFICO.php', ''),
(12, 5, 'ALMACÉN Y TALLER', 'Catalogo de Almacen', 8, 'almacen_busqueda.php', 'almacen'),
(13, 6, 'PRODUCTO Y MATERIAL', 'Catalogo de Material', 8, 'material_busqueda.php', 'material'),
(14, 1, 'EMPRESAS', 'Catalogo de Empresa', 2, 'empresa_busqueda.php', 'empresa'),
(15, 2, 'LUGARES DE DESTINO', 'Catalogo de Matriz', 29, 'matriz_sucursal_busqueda.php', 'proveedor'),
(16, 7, 'ASIGNACIÓN DE PRECIOS', 'Catalogo de Precio', 5, 'precios_busqueda.php', 'precio'),
(17, 2, 'MONEDAS', 'Catalogo de Moneda', 2, 'moneda_busqueda.php', 'moneda'),
(18, 1, 'TRANSPORTE', 'Catalogo de Transporte', 9, 'transporte_busqueda.php', 'transporte'),
(19, 1, 'USUARIOS', 'Catalogo de Usuario', 30, 'usuario_busqueda.php', 'usuario'),
(20, 2, 'PERFILES', 'Catalogo de Perfiles', 30, 'perfil_busqueda.php', 'perfiles'),
(21, 3, 'PANTALLA', 'Catalogo de Pantalla', 30, 'pantalla_busqueda.php', 'pantalla'),
(22, 4, 'PROSPECTO', 'Modulo Prospectar', 5, 'prospecto_busqueda.php', '1'),
(23, 1, 'COTIZACIONES', 'COTIZACIONES', 5, 'cotizacion_busqueda_usuario.php', 'suite'),
(29, 5, 'CLIENTE', 'pantalla general de clientes', 5, 'CLIENTE.php', 'cliente'),
(30, 3, 'USUARIO', '', 2, 'USUARIO.php', 'usuario'),
(31, 2, 'ORDENES DE SALIDA', 'ordenes de salida', 5, 'ordenes_salida_busqueda_usuario.php', 'orden'),
(32, 3, 'RECOLECCION DE EQUIPO', 'recoleccion de equipo', 5, 'recoleccion_equipo_busqueda_usuario.php', 'extintores'),
(33, 6, 'CONTRATOS', 'contratos de clientes', 5, 'contrato_busqueda.php', 'noticias'),
(34, 2, 'ORDENES DE COMPRA', 'ordenes de compra de clientes', 6, 'compra_busqueda_usuario.php', 'ordenold'),
(35, 1, 'FACTURAR', 'FACTURACION ', 7, 'factura_busqueda.php', 'pantalla'),
(36, 1, 'ENTRADAS', 'entradas al almacen', 8, 'compra_busqueda_usuario_almacen.php', 'ordenold'),
(37, 2, 'INVENTARIO', 'inventario de almacen', 8, 'almacen_inventario.php', 'inventarioold'),
(42, 3, 'SALIDAS', 'Menú salidas', 8, 'SALIDAS.php', 'orden'),
(43, 4, 'MATERIAL SIN STOCK', 'material sin stock', 8, 'material_sinstock_busqueda.php', 'cliente'),
(44, 1, 'ORDENES DE SALIDA', 'ordenes de salida de taller', 9, 'taller_ordenes_salida.php', 'orden'),
(45, 2, 'SOLICITUDES DE MATERIAL', 'solicitudes de material de taller', 9, 'taller_solicitud_material.php', 'pantalla'),
(46, 3, 'VALES DE CONSUMO', 'vales de consumo', 9, 'taller_vales_consumo.php', 'noticias'),
(47, 1, 'ORDENES DE SALIDA', 'ordenes de salida de calidad', 10, 'calidad_busqueda.php', 'proveedor'),
(48, 1, 'ADMINISTRACIÓN DE RUTAS', 'administración de rutas', 11, 'logistica_busqueda.php', '9'),
(49, 2, 'ORDENES DE ENTREGA', 'ordenes de entrega de logistca', 11, 'entrega_busqueda.php', 'proveedor'),
(50, 3, 'TRANSPORTES', 'catalogo de transportes', 11, 'transporte_busqueda.php', 'transporte'),
(51, 1, 'ORDENES DE SALIDA', 'ordenes de salida de almacen', 42, 'almacen_orden_salida.php', 'orden'),
(52, 2, 'SOLICITUDES DE MATERIAL', 'solicitudes de material de almacen', 42, 'almacen_solicitud_material_busqueda.php', 'pantalla'),
(53, 3, 'VALES DE CONSUMO', 'vales de consumo almacen', 42, 'almacen_vales_consumo_busqueda.php', 'noticias'),
(54, 5, 'REPORTES', 'Reportes de Ventas', 5, 'REPORTES_VENTAS.php', 'noticias'),
(55, 2, 'COMPARATIVO VENTAS', 'Comparativo de Ventas Mensual y Anual', 54, 'reporte_comparativo_ventas.php', 'noticias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE IF NOT EXISTS `partida` (
  `partida_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `partida_no` bigint(20) NOT NULL COMMENT 'numero de partida',
  `producto_id` bigint(20) DEFAULT NULL,
  `partida_cantidad` decimal(10,0) NOT NULL COMMENT 'cantidad de producto por partida',
  `contrato_id` bigint(10) NOT NULL,
  PRIMARY KEY (`partida_id`),
  KEY `contrato_id` (`contrato_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla PARTIDA por Contrato' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `pedido_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cotizacion_id` bigint(20) DEFAULT NULL,
  `sucursal_id` bigint(20) DEFAULT NULL,
  `pedido_fecha_creacion` datetime NOT NULL,
  `pedido_fecha_entrega` datetime DEFAULT NULL,
  `pedido_estado` tinyint(4) NOT NULL DEFAULT '0',
  `pedido_obs` varchar(100) DEFAULT NULL,
  `contrato_id` varchar(10) DEFAULT NULL,
  `partida_id` bigint(20) DEFAULT NULL,
  `folio_pedido` varchar(20) DEFAULT NULL,
  `usuario_id` varchar(10) NOT NULL,
  `pedido_fecha_recoleccion` datetime DEFAULT NULL,
  PRIMARY KEY (`pedido_id`),
  KEY `cotizacion_id` (`cotizacion_id`),
  KEY `sucursal_id` (`sucursal_id`),
  KEY `partida_id` (`partida_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla Pedidos' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `perfil_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `perfil_nombre` varchar(50) NOT NULL DEFAULT '0',
  `perfil_descripcion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`perfil_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla PERFIL' AUTO_INCREMENT=45 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`perfil_id`, `perfil_nombre`, `perfil_descripcion`) VALUES
(30, 'ADMINISTRACION', 'contiene todo'),
(35, 'Ventas', 'Ventas'),
(36, 'Gerencia Ventas', 'Ventas - Inventario'),
(37, 'Almacen', 'Operaciones Almacen'),
(38, 'Direccion General', 'Autorizaciones'),
(39, 'Taller-Tráfico', 'Operacion Taller y Tráfico'),
(40, 'Control de Calidad', 'Operacion de Control de Calidad'),
(41, 'Facturacion', 'Operaciones Facturacion'),
(42, 'Asistente de Ventas', 'Funciones de Asistente de Ventas'),
(43, 'Asistente de Direccion General', 'Actividades de Asistente de Dirección General'),
(44, 'Compras', 'Actividades correspondientes a Compras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_pantalla`
--

CREATE TABLE IF NOT EXISTS `perfil_pantalla` (
  `perfil_pantalla_id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil_id` bigint(20) NOT NULL,
  `pantalla_id` bigint(20) NOT NULL,
  PRIMARY KEY (`perfil_pantalla_id`),
  KEY `perfil_id` (`perfil_id`),
  KEY `pantalla_id` (`pantalla_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=916 ;

--
-- Volcado de datos para la tabla `perfil_pantalla`
--

INSERT INTO `perfil_pantalla` (`perfil_pantalla_id`, `perfil_id`, `pantalla_id`) VALUES
(648, 35, 33),
(649, 35, 15),
(650, 35, 4),
(651, 35, 29),
(652, 35, 22),
(653, 35, 32),
(654, 35, 31),
(655, 35, 23),
(656, 35, 5),
(657, 36, 37),
(658, 36, 8),
(659, 36, 16),
(660, 36, 33),
(661, 36, 15),
(662, 36, 4),
(663, 36, 29),
(664, 36, 22),
(665, 36, 32),
(666, 36, 31),
(667, 36, 23),
(668, 36, 5),
(679, 38, 35),
(680, 38, 7),
(681, 38, 33),
(682, 38, 4),
(683, 38, 29),
(684, 38, 22),
(685, 38, 31),
(686, 38, 23),
(687, 38, 5),
(688, 38, 17),
(689, 38, 2),
(690, 37, 13),
(691, 37, 12),
(692, 37, 43),
(693, 37, 53),
(694, 37, 52),
(695, 37, 51),
(696, 37, 42),
(697, 37, 37),
(698, 37, 36),
(699, 37, 8),
(705, 39, 46),
(706, 39, 45),
(707, 39, 44),
(708, 39, 18),
(709, 39, 9),
(710, 40, 47),
(711, 40, 10),
(712, 41, 13),
(713, 41, 8),
(714, 41, 35),
(715, 41, 7),
(759, 42, 22),
(760, 42, 23),
(761, 42, 5),
(774, 43, 37),
(775, 43, 8),
(776, 43, 34),
(777, 43, 6),
(778, 43, 23),
(779, 43, 5),
(868, 30, 50),
(869, 30, 49),
(870, 30, 48),
(871, 30, 11),
(872, 30, 47),
(873, 30, 10),
(874, 30, 46),
(875, 30, 45),
(876, 30, 44),
(877, 30, 18),
(878, 30, 9),
(879, 30, 13),
(880, 30, 12),
(881, 30, 43),
(882, 30, 53),
(883, 30, 52),
(884, 30, 51),
(885, 30, 42),
(886, 30, 37),
(887, 30, 36),
(888, 30, 8),
(889, 30, 35),
(890, 30, 7),
(891, 30, 34),
(892, 30, 3),
(893, 30, 6),
(894, 30, 16),
(895, 30, 33),
(896, 30, 55),
(897, 30, 54),
(898, 30, 15),
(899, 30, 4),
(900, 30, 29),
(901, 30, 22),
(902, 30, 32),
(903, 30, 31),
(904, 30, 23),
(905, 30, 5),
(906, 30, 21),
(907, 30, 20),
(908, 30, 19),
(909, 30, 30),
(910, 30, 17),
(911, 30, 14),
(912, 30, 2),
(913, 44, 34),
(914, 44, 3),
(915, 44, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prospecto`
--

CREATE TABLE IF NOT EXISTS `prospecto` (
  `id_prospecto` bigint(20) NOT NULL AUTO_INCREMENT,
  `cliente_id` varchar(10) NOT NULL,
  `fecha_prospecto` date DEFAULT NULL,
  `carta_presentacion` tinyint(1) NOT NULL,
  `material_multimedia` tinyint(1) NOT NULL,
  `visita_cliente` tinyint(1) NOT NULL,
  `cotizacion` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_prospecto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `proveedor_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `proveedor_rs` varchar(100) NOT NULL,
  `proveedor_rfc` varchar(12) NOT NULL,
  `domicilio_id` bigint(20) DEFAULT NULL,
  `generales_id` bigint(20) NOT NULL,
  PRIMARY KEY (`proveedor_id`),
  KEY `domicilio_id` (`domicilio_id`),
  KEY `generales_id` (`generales_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla PROVEEDOR' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE IF NOT EXISTS `ruta` (
  `ruta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transporte_id` bigint(20) NOT NULL,
  `ruta_estatus` int(11) NOT NULL,
  `ruta_observaciones` varchar(100) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  `operador` varchar(100) NOT NULL,
  PRIMARY KEY (`ruta_id`),
  KEY `orden_salida_id` (`transporte_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla RUTA' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta_detalle`
--

CREATE TABLE IF NOT EXISTS `ruta_detalle` (
  `detalle_ruta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ruta_id` bigint(20) NOT NULL,
  `PedidoDetalle_id` bigint(20) NOT NULL,
  `cantidadEnrutada` int(11) NOT NULL DEFAULT '0',
  `cantidadEntregada` int(11) DEFAULT '0',
  `observaciones` varchar(50) DEFAULT NULL,
  `ruta_detalle_estatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Creada; 1_Terminada',
  PRIMARY KEY (`detalle_ruta_id`),
  KEY `ruta_id` (`ruta_id`),
  KEY `PedidoDetalle_id` (`PedidoDetalle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida_material`
--

CREATE TABLE IF NOT EXISTS `salida_material` (
  `salida_material_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `almacen_material_id` bigint(20) NOT NULL,
  `cantidad_salida` bigint(20) DEFAULT NULL,
  `usuario_id` bigint(20) DEFAULT NULL,
  `salida_obs` tinyint(4) DEFAULT NULL,
  `fecha_solicitud` datetime NOT NULL,
  PRIMARY KEY (`salida_material_id`),
  KEY `almacen_material_id` (`almacen_material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla SALIDA de MATERIAL' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `servicio_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `servicio_descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `servicio_precio` float NOT NULL,
  PRIMARY KEY (`servicio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE IF NOT EXISTS `sucursal` (
  `sucursal_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cliente_id` varchar(10) NOT NULL DEFAULT 'NULL',
  `tipo_establecimiento` bigint(20) NOT NULL,
  `clave_nombre` varchar(200) NOT NULL,
  `domicilio_id` bigint(20) NOT NULL,
  `generales_id` bigint(20) NOT NULL,
  `contacto_ventas_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`sucursal_id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `domicilio_id` (`domicilio_id`),
  KEY `contacto_ventas_id` (`contacto_ventas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla normalizada domicilio de cliente' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taller_solicitud`
--

CREATE TABLE IF NOT EXISTS `taller_solicitud` (
  `taller_solicitud_id` int(10) NOT NULL AUTO_INCREMENT,
  `taller_id` int(10) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `usuario_id_solicitante` int(10) NOT NULL,
  `almacen_id` bigint(20) NOT NULL,
  `usuario_id_autorizador` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_autorizacion` date DEFAULT NULL,
  `motivo` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pedido_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `folio` int(10) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  PRIMARY KEY (`taller_solicitud_id`),
  KEY `taller_solicitud_ibfk3` (`pedido_id`),
  KEY `taller_solicitud_ibfk2` (`almacen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte`
--

CREATE TABLE IF NOT EXISTS `transporte` (
  `transporte_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transporte_nombre` varchar(50) DEFAULT NULL,
  `transporte_placas` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`transporte_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `transporte`
--

INSERT INTO `transporte` (`transporte_id`, `transporte_nombre`, `transporte_placas`) VALUES
(3, 'Nissan 1', 'pendientes'),
(4, 'Nissan 2', 'n2'),
(5, 'Nissan 3', 'p3'),
(6, 'Nissan 4', 'n4'),
(7, 'Nissan 5', 'n5'),
(8, 'Nissan 6', 'n6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE IF NOT EXISTS `unidades` (
  `id_unidad` bigint(20) NOT NULL AUTO_INCREMENT,
  `prefijo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_unidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Unidades de Medida' AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id_unidad`, `prefijo`) VALUES
(1, 'pz'),
(2, 'PIEZA'),
(3, 'UNIDAD'),
(4, 'JUEGO'),
(5, 'LITRO'),
(6, 'KILO'),
(7, 'CAJA'),
(8, 'PAR'),
(9, 'METRO'),
(10, 'METRO LINE'),
(11, 'PAQUETE'),
(12, 'SR'),
(13, 'JG'),
(14, 'LOTE'),
(15, 'NO PLICA'),
(16, 'KILO|'),
(17, 'SRV'),
(18, 'NO APLUCA'),
(19, 'KG'),
(20, 'N/A'),
(21, 'LT'),
(22, 'PAQ'),
(23, 'JGO'),
(24, 'MT'),
(25, 'ATADOS'),
(26, 'DIAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` varchar(10) NOT NULL DEFAULT 'NULL',
  `usuario_password` varchar(20) NOT NULL,
  `generales_id` bigint(20) NOT NULL,
  `domicilio_id` bigint(20) DEFAULT NULL,
  `usuario_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'estado (activo, bloqueado)',
  `perfil_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usuario_id`),
  KEY `generales_id` (`generales_id`),
  KEY `domicilio_id` (`domicilio_id`),
  KEY `perfil_id` (`perfil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla USUARIO';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_password`, `generales_id`, `domicilio_id`, `usuario_status`, `perfil_id`) VALUES
('ArrioG', 'promex', 4, 10, 0, 30),
('BarriW', 'wendy', 12, 18, 0, 41),
('CruzA', 'angeles', 6, 12, 0, 42),
('CurieE', 'esther', 13, 19, 0, 35),
('DelgaA', 'alfredo', 18, 24, 0, 35),
('FernaS', 'sergio', 19, 25, 0, 35),
('FigueR', 'rene', 15, 21, 0, 35),
('GamaR', 'ruben', 20, 26, 0, 35),
('LedezC', 'carlos', 9, 15, 0, 37),
('MartiL', 'luis', 22, 28, 0, 35),
('MignoV', 'veronica', 10, 16, 0, 39),
('OcampL', 'lidia', 8, 14, 0, 43),
('OlaldS', 'socorro', 23, 29, 0, 41),
('OlivaJ', 'jair', 17, 23, 0, 35),
('PerezH', 'hector', 16, 22, 0, 35),
('PerezR', 'ricardo', 11, 17, 0, 40),
('SolanJ', 'jaime', 3, 9, 0, 38),
('SolanM', 'mauricio', 5, 11, 0, 36),
('SolanP', 'pedro', 14, 20, 0, 35),
('usuario1', 'usuario2', 1, 7, 0, 30),
('VegaJ', 'jaime', 21, 27, 0, 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_cliente`
--

CREATE TABLE IF NOT EXISTS `usuario_cliente` (
  `usuario_cliente_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` varchar(20) NOT NULL,
  `cliente_id` varchar(10) NOT NULL,
  `usuario_cliente_nivel` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usuario_cliente_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `cliente_id` (`cliente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla RelaciÃ³n USUARIO_CLIENTE' AUTO_INCREMENT=116 ;

--
-- Volcado de datos para la tabla `usuario_cliente`
--

INSERT INTO `usuario_cliente` (`usuario_cliente_id`, `usuario_id`, `cliente_id`, `usuario_cliente_nivel`) VALUES
(1, 'usuario1', 'SOE TECNOL', 0),
(2, 'CurieE', '1', 0),
(3, 'CurieE', '2', 0),
(4, 'CurieE', '3', 0),
(5, 'CurieE', '4', 0),
(6, 'CurieE', '5', 0),
(7, 'CurieE', '6', 0),
(8, 'CurieE', '7', 0),
(9, 'CurieE', '8', 0),
(10, 'CurieE', '9', 0),
(11, 'CurieE', '10', 0),
(12, 'CurieE', '11', 0),
(13, 'CurieE', '12', 0),
(14, 'CurieE', '13', 0),
(15, 'CurieE', '14', 0),
(16, 'CurieE', '15', 0),
(17, 'OlivaJ', '16', 0),
(18, 'OlivaJ', '17', 0),
(19, 'OlivaJ', '18', 0),
(20, 'OlivaJ', '19', 0),
(21, 'OlivaJ', '20', 0),
(22, 'OlivaJ', '21', 0),
(23, 'OlivaJ', '22', 0),
(24, 'OlivaJ', '23', 0),
(25, 'OlivaJ', '24', 0),
(26, 'OlivaJ', '25', 0),
(27, 'OlivaJ', '26', 0),
(28, 'OlivaJ', '27', 0),
(29, 'OlivaJ', '28', 0),
(30, 'OlivaJ', '29', 0),
(31, 'OlivaJ', '30', 0),
(32, 'OlivaJ', '31', 0),
(33, 'OlivaJ', '32', 0),
(34, 'OlivaJ', '33', 0),
(35, 'OlivaJ', '34', 0),
(36, 'OlivaJ', '35', 0),
(37, 'OlivaJ', '36', 0),
(38, 'OlivaJ', '37', 0),
(39, 'OlivaJ', '38', 0),
(40, 'OlivaJ', '39', 0),
(41, 'OlivaJ', '40', 0),
(42, 'OlivaJ', '41', 0),
(43, 'OlivaJ', '42', 0),
(44, 'OlivaJ', '43', 0),
(45, 'OlivaJ', '44', 0),
(46, 'OlivaJ', '45', 0),
(47, 'OlivaJ', '46', 0),
(48, 'OlivaJ', '47', 0),
(49, 'OlivaJ', '48', 0),
(50, 'OlivaJ', '49', 0),
(51, 'OlivaJ', '50', 0),
(52, 'OlivaJ', '51', 0),
(53, 'OlivaJ', '52', 0),
(54, 'OlivaJ', '53', 0),
(55, 'OlivaJ', '54', 0),
(56, 'OlivaJ', '55', 0),
(57, 'OlivaJ', '56', 0),
(58, 'DelgaA', '57', 0),
(59, 'DelgaA', '58', 0),
(60, 'DelgaA', '59', 0),
(61, 'DelgaA', '60', 0),
(62, 'DelgaA', '61', 0),
(63, 'DelgaA', '62', 0),
(64, 'DelgaA', '63', 0),
(65, 'DelgaA', '64', 0),
(66, 'DelgaA', '65', 0),
(67, 'DelgaA', '66', 0),
(68, 'DelgaA', '67', 0),
(69, 'DelgaA', '68', 0),
(70, 'DelgaA', '69', 0),
(71, 'DelgaA', '70', 0),
(72, 'DelgaA', '71', 0),
(73, 'DelgaA', '72', 0),
(74, 'DelgaA', '73', 0),
(75, 'DelgaA', '74', 0),
(76, 'FigueR', '75', 0),
(77, 'FigueR', '76', 0),
(78, 'FigueR', '77', 0),
(79, 'FigueR', '78', 0),
(80, 'FigueR', '79', 0),
(81, 'FigueR', '80', 0),
(82, 'FigueR', '81', 0),
(83, 'FigueR', '82', 0),
(84, 'FigueR', '83', 0),
(85, 'FigueR', '84', 0),
(86, 'FigueR', '85', 0),
(87, 'FigueR', '86', 0),
(88, 'FigueR', '87', 0),
(89, 'FigueR', '88', 0),
(90, 'SolanP', '89', 0),
(91, 'SolanP', '90', 0),
(92, 'SolanP', '91', 0),
(93, 'SolanP', '92', 0),
(94, 'SolanP', '93', 0),
(95, 'SolanP', '94', 0),
(96, 'SolanP', '95', 0),
(97, 'SolanP', '96', 0),
(98, 'SolanP', '97', 0),
(99, 'SolanP', '98', 0),
(100, 'SolanP', '99', 0),
(101, 'SolanP', '100', 0),
(102, 'MartiL', '101', 0),
(103, 'MartiL', '102', 0),
(104, 'MartiL', '103', 0),
(105, 'MartiL', '104', 0),
(106, 'MartiL', '105', 0),
(107, 'MartiL', '106', 0),
(108, 'MartiL', '107', 0),
(109, 'MartiL', '108', 0),
(110, 'MartiL', '109', 0),
(111, 'ArrioG', '110', 0),
(112, 'ArrioG', '111', 0),
(113, 'ArrioG', '112', 0),
(114, 'ArrioG', '113', 0),
(115, 'ArrioG', '114', 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `almacen_ibfk_1` FOREIGN KEY (`domicilio_id`) REFERENCES `domicilio` (`domicilio_id`);

--
-- Filtros para la tabla `almacen_material`
--
ALTER TABLE `almacen_material`
  ADD CONSTRAINT `almacen_material_ibfk_1` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`almacen_id`),
  ADD CONSTRAINT `almacen_material_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`cliente_domicilio_fiscal`) REFERENCES `domicilio` (`domicilio_id`);

--
-- Filtros para la tabla `contacto_ventas`
--
ALTER TABLE `contacto_ventas`
  ADD CONSTRAINT `contacto_ventas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`),
  ADD CONSTRAINT `contacto_ventas_ibfk_2` FOREIGN KEY (`generales_id`) REFERENCES `generales` (`generales_id`);

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`),
  ADD CONSTRAINT `cotizacion_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `cotizacion_ibfk_3` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  ADD CONSTRAINT `cotizacion_ibfk_4` FOREIGN KEY (`moneda_id`) REFERENCES `moneda` (`moneda_id`),
  ADD CONSTRAINT `cotizacion_ibfk_5` FOREIGN KEY (`contacto_ventas_id`) REFERENCES `contacto_ventas` (`contacto_ventas_id`);

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`orden_compra_id`) REFERENCES `orden_compra` (`orden_compra_id`),
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`almacen_id`);

--
-- Filtros para la tabla `detalle_cotizacion`
--
ALTER TABLE `detalle_cotizacion`
  ADD CONSTRAINT `detalle_cotizacion_ibfk_1` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizacion` (`cotizacion_id`);

--
-- Filtros para la tabla `detalle_orden_salida`
--
ALTER TABLE `detalle_orden_salida`
  ADD CONSTRAINT `detalle_orden_salida_ibfk_1` FOREIGN KEY (`orden_salida_id`) REFERENCES `orden_salida` (`orden_salida_id`),
  ADD CONSTRAINT `detalle_orden_salida_ibfk_2` FOREIGN KEY (`detalle_pedido_id`) REFERENCES `detalle_pedido` (`detalle_pedido_id`);

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`detalle_cotizacion_id`) REFERENCES `detalle_cotizacion` (`detalle_cotizacion_id`),
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`);

--
-- Filtros para la tabla `detalle_taller_solicitud`
--
ALTER TABLE `detalle_taller_solicitud`
  ADD CONSTRAINT `detalle_taller_solicitud_ibfk_1` FOREIGN KEY (`detalle_taller_solicitud_id`) REFERENCES `taller_solicitud` (`taller_solicitud_id`),
  ADD CONSTRAINT `taller_solicitud_ibfk1` FOREIGN KEY (`producto_id`) REFERENCES `material` (`material_id`);

--
-- Filtros para la tabla `entrada_material`
--
ALTER TABLE `entrada_material`
  ADD CONSTRAINT `entrada_material_ibfk_1` FOREIGN KEY (`almacen_material_id`) REFERENCES `almacen_material` (`almacen_material_id`),
  ADD CONSTRAINT `entrada_material_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `entrada_material_ibfk_3` FOREIGN KEY (`orden_compra_id`) REFERENCES `orden_compra` (`orden_compra_id`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`);

--
-- Filtros para la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  ADD CONSTRAINT `nota_credito_ibfk_1` FOREIGN KEY (`orden_salida_id`) REFERENCES `orden_salida` (`orden_salida_id`);

--
-- Filtros para la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD CONSTRAINT `orden_compra_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`proveedor_id`);

--
-- Filtros para la tabla `orden_salida`
--
ALTER TABLE `orden_salida`
  ADD CONSTRAINT `orden_salida_ibfk_1` FOREIGN KEY (`orden_salida_id`) REFERENCES `pedido` (`pedido_id`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizacion` (`cotizacion_id`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`sucursal_id`),
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`partida_id`) REFERENCES `partida` (`partida_id`);

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`domicilio_id`) REFERENCES `domicilio` (`domicilio_id`),
  ADD CONSTRAINT `proveedor_ibfk_2` FOREIGN KEY (`generales_id`) REFERENCES `generales` (`generales_id`);

--
-- Filtros para la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD CONSTRAINT `ruta_ibfk_1` FOREIGN KEY (`transporte_id`) REFERENCES `transporte` (`transporte_id`);

--
-- Filtros para la tabla `salida_material`
--
ALTER TABLE `salida_material`
  ADD CONSTRAINT `salida_material_ibfk_1` FOREIGN KEY (`almacen_material_id`) REFERENCES `almacen_material` (`almacen_material_id`);

--
-- Filtros para la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `sucursal_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`),
  ADD CONSTRAINT `sucursal_ibfk_2` FOREIGN KEY (`domicilio_id`) REFERENCES `domicilio` (`domicilio_id`),
  ADD CONSTRAINT `sucursal_ibfk_3` FOREIGN KEY (`contacto_ventas_id`) REFERENCES `contacto_ventas` (`contacto_ventas_id`);

--
-- Filtros para la tabla `taller_solicitud`
--
ALTER TABLE `taller_solicitud`
  ADD CONSTRAINT `taller_solicitud_ibfk2` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`almacen_id`),
  ADD CONSTRAINT `taller_solicitud_ibfk3` FOREIGN KEY (`pedido_id`) REFERENCES `detalle_pedido` (`pedido_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`generales_id`) REFERENCES `generales` (`generales_id`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`domicilio_id`) REFERENCES `domicilio` (`domicilio_id`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`perfil_id`);

--
-- Filtros para la tabla `usuario_cliente`
--
ALTER TABLE `usuario_cliente`
  ADD CONSTRAINT `usuario_cliente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `usuario_cliente_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`);

  ALTER TABLE `material` CHANGE `material_tipo` `material_tipo` BIGINT( 20 ) NOT NULL DEFAULT '0';
  
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
