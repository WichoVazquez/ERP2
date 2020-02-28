-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-03-2014 a las 10:30:13
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `promex`
--
CREATE DATABASE `promex` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `promex`;

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
dr.observaciones =observaciones_detalle
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
  `nombre` varchar(200) NOT NULL,
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
(1, 'PROMEX Almacén', 'Almacén de Promex', 85, 0),
(16, 'PROMEX Taller', 'Taller de Promex.', 111, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla ALMACEN_MATERIAL' AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `almacen_material`
--

INSERT INTO `almacen_material` (`almacen_material_id`, `almacen_id`, `material_id`, `cantidad_actual`, `maximo`, `minimo`, `solicitud`) VALUES
(4, 1, 4, 10, 30, 1, '4'),
(5, 1, 5, 10, 25, 1, '9'),
(6, 1, 6, 10, 15, 1, '0'),
(7, 1, 7, 20, 35, 1, '0'),
(8, 1, 8, 20, 35, 1, '0'),
(9, 1, 9, 10, 30, 1, '3'),
(10, 1, 10, 10, 20, 1, '0'),
(11, 1, 11, 10, 20, 1, '10'),
(14, 16, 5, 4, 50, 2, '0'),
(15, 1, 13, 20, 50, 1, '0'),
(16, 1, 14, 20, 50, 1, '0'),
(17, 16, 15, 20, 40, 1, '0'),
(18, 1, 16, 20, 50, 1, '0'),
(19, 1, 17, 50, 50, 1, '0');

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

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_razonsocial`, `cliente_rfc`, `cliente_domicilio_fiscal`, `status`, `cliente_generales`) VALUES
('1', 'S.D.N. DIR. GRAL. IND. MIL.', 'SDN8501014D2', 91, 0, 0),
('2', 'CINEPOLIS DE MEXICO, S.A. DE C.V.', 'CME981208VE4', 92, 0, 0),
('2079', 'SIEMENS INNOVACIONES S.A. DE C.V.', 'SIN031201C45', 84, 0, 0),
('3', 'PRODUCTOS DEL CONVENTO, S.A. DE C.V.', 'PCO811020L66', 93, 0, 0),
('4', 'SECRETARIA DE SALUD/COMISION NACIONAL DE PROTECCIO', 'SSA630502CU1', 94, 0, 0),
('5', 'SEP, ADMINISTRACION FEDERAL DE SERVICIOS EDUCATIVO', 'SAF121101UT3', 95, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Contacto para Personal de Ventas' AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `contacto_ventas`
--

INSERT INTO `contacto_ventas` (`contacto_ventas_id`, `cliente_id`, `generales_id`) VALUES
(3, '1', 25),
(4, '2', 26),
(5, '3', 27),
(6, '4', 28),
(7, '5', 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE IF NOT EXISTS `contrato` (
  `contrato_id` varchar(20) NOT NULL DEFAULT 'NULL',
  `cliente_id` varchar(10) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_terminacion` date NOT NULL,
  `contrato_mt` decimal(10,0) DEFAULT NULL COMMENT 'monto total',
  PRIMARY KEY (`contrato_id`)
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
  `cotizacion_condiciones_pago` varchar(200) DEFAULT 'Ver Anexo',
  `cotizacion_recotizada` bigint(20) DEFAULT NULL,
  `producto-servicio` tinyint(4) NOT NULL COMMENT 'producto=0; servicio=1',
  `cotizacion_tipo` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'producto=0; servicio=1',
  PRIMARY KEY (`cotizacion_id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `cotizacion_ibfk_3` (`empresa_id`),
  KEY `cotizacion_ibfk_4` (`moneda_id`),
  KEY `cotizacion_ibfk_5` (`contacto_ventas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla de Cotizaciones' AUTO_INCREMENT=124 ;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`cotizacion_id`, `cotizacion_edo`, `cliente_id`, `usuario_id`, `empresa_id`, `cotizacion_folio`, `cotizacion_fecha_modificacion`, `cotizacion_fecha_envio`, `moneda_id`, `cotizacion_divisa_dia`, `cotizacion_observaciones`, `contacto_ventas_id`, `cotizacion_mensaje`, `cotizacion_dias_entrega`, `cotizacion_condiciones_pago`, `cotizacion_recotizada`, `producto-servicio`, `cotizacion_tipo`) VALUES
(100, 6, '5', 'usuario1', 4, 1, '2014-01-10 17:44:02', '2014-01-10 11:43:48', 1, 1.00, '', 7, 'leyenda', 5, '', NULL, 0, 0),
(101, 6, '1', 'usuario1', 3, 1, '2014-01-10 18:00:22', '2014-01-10 12:00:05', 1, 1.00, '', 3, 'LA', 5, '', NULL, 0, 0),
(102, 0, '1', 'usuario1', 3, 0, '2014-01-13 19:56:17', NULL, NULL, NULL, NULL, 3, NULL, 5, 'Ver Anexo', NULL, 0, 0),
(103, 0, '2', 'usuario1', 3, 0, '2014-01-13 20:02:25', NULL, NULL, NULL, NULL, 4, NULL, 5, 'Ver Anexo', NULL, 0, 0),
(104, 0, '2', 'usuario1', 5, 0, '2014-01-13 20:03:28', NULL, NULL, NULL, NULL, 4, NULL, 5, 'Ver Anexo', NULL, 0, 1),
(105, 0, '1', 'usuario1', 3, 0, '2014-01-13 20:04:49', NULL, NULL, NULL, NULL, 3, NULL, 5, 'Ver Anexo', NULL, 0, 0),
(106, 0, '2', 'usuario1', 3, 0, '2014-01-13 20:27:51', NULL, NULL, NULL, NULL, 4, NULL, 5, 'Ver Anexo', NULL, 0, 0),
(107, 6, '2', 'usuario1', 3, 2, '2014-01-14 15:59:57', '2014-01-13 14:36:25', 1, 1.00, '', 4, 'xc', 5, '', NULL, 0, 0),
(108, 6, '1', 'usuario1', 3, 3, '2014-01-14 16:12:50', '2014-01-14 10:12:24', 1, 1.00, '', 3, 'lalala', 5, '', NULL, 0, 0),
(109, 6, '3', 'usuario1', 3, 4, '2014-01-14 16:56:41', '2014-01-14 10:56:11', 1, 1.00, '', 5, 'lzll', 5, '', NULL, 0, 0),
(110, 6, '2', 'usuario1', 3, 5, '2014-01-14 17:35:31', '2014-01-14 11:03:06', 1, 1.00, '', 4, 'sad', 5, '', NULL, 0, 0),
(111, 0, '3', 'usuario1', 3, 0, '2014-01-15 16:34:17', NULL, NULL, NULL, NULL, 5, NULL, 5, 'Ver Anexo', NULL, 0, 0),
(112, 0, '1', 'usuario1', 3, 0, '2014-01-15 16:35:16', NULL, NULL, NULL, NULL, 3, NULL, 5, 'Ver Anexo', NULL, 0, 0),
(113, 0, '2', 'usuario1', 3, 6, '2014-01-17 18:42:32', NULL, 1, 1.00, '', 4, '', 5, '', NULL, 0, 0),
(114, 6, '1', 'usuario1', 4, 2, '2014-01-17 19:19:36', '2014-01-17 13:04:53', 1, 1.00, '', 3, '', 5, '', NULL, 0, 0),
(115, 6, '3', 'usuario1', 3, 7, '2014-01-17 19:21:20', '2014-01-17 13:21:07', 1, 1.00, '', 5, '', 5, '', NULL, 0, 0),
(116, 6, '2', 'usuario1', 3, 8, '2014-01-17 19:27:53', '2014-01-17 13:27:36', 1, 1.00, '', 4, '', 5, '', NULL, 0, 0),
(117, 6, '1', 'usuario1', 3, 9, '2014-01-17 19:32:31', '2014-01-17 13:32:18', 1, 1.00, '', 3, '', 5, '', NULL, 0, 0),
(118, 6, '1', 'usuario1', 4, 3, '2014-01-17 19:34:43', '2014-01-17 13:34:31', 1, 1.00, '', 3, '', 5, '', NULL, 0, 0),
(119, 6, '1', 'usuario1', 3, 10, '2014-01-17 19:41:55', '2014-01-17 13:39:16', 1, 1.00, '', 3, '', 5, '', NULL, 0, 0),
(120, 6, '2', 'usuario1', 3, 11, '2014-01-17 19:45:07', '2014-01-17 13:44:55', 1, 1.00, '', 4, '', 5, '', NULL, 0, 0),
(121, 6, '1', 'usuario1', 3, 12, '2014-01-17 19:46:39', '2014-01-17 13:46:28', 1, 1.00, '', 3, '', 5, '', NULL, 0, 0),
(122, 0, '1', 'usuario1', 3, 13, '2014-01-17 20:19:52', NULL, 1, 1.00, '', 3, '', 5, '', NULL, 0, 0),
(123, 0, '4', 'usuario1', 3, 0, '2014-02-16 08:22:06', NULL, NULL, NULL, NULL, 4, NULL, 5, 'Ver Anexo', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE IF NOT EXISTS `detalle_compra` (
  `detalle_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `orden_compra_id` bigint(20) NOT NULL,
  `almacen_material_id` bigint(20) NOT NULL,
  `detalle_compra_cantidad` tinyint(4) NOT NULL DEFAULT '0',
  `detalle_compra_cantidad_s` decimal(10,0) NOT NULL DEFAULT '0',
  `producto_id` bigint(20) NOT NULL,
  PRIMARY KEY (`detalle_id`),
  KEY `orden_compra_id` (`orden_compra_id`),
  KEY `almacen_material_id` (`almacen_material_id`)
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
  `cotizacion_tipo` tinyint(20) NOT NULL DEFAULT '0' COMMENT 'producto=0; servicio=1;',
  PRIMARY KEY (`detalle_cotizacion_id`),
  KEY `cotizacion_id` (`cotizacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='DETALLE COTIZACION' AUTO_INCREMENT=117 ;

--
-- Volcado de datos para la tabla `detalle_cotizacion`
--

INSERT INTO `detalle_cotizacion` (`detalle_cotizacion_id`, `producto_id`, `cantidad`, `cotizacion_id`, `precio_venta`, `observaciones`, `multiplo`, `procto-servicio`, `cotizacion_tipo`) VALUES
(100, 9, 5, 100, 450.00, 'BUENO', 1.10, 0, 0),
(101, 6, 6, 101, 90.00, '', 1.00, 0, 0),
(102, 17, 10, 107, 270.00, 'buen equipo', 1.10, 0, 0),
(103, 15, 3, 108, 135.00, '', 1.10, 0, 0),
(104, 11, 4, 109, 600.00, '', 1.00, 0, 0),
(105, 5, 4, 109, 450.00, '', 1.00, 0, 0),
(106, 10, 1, 110, 550.00, '', 1.00, 0, 0),
(107, 9, 1, 113, 450.00, '', 1.00, 0, 0),
(108, 4, 1, 114, 200.00, '', 1.00, 0, 0),
(109, 4, 1, 115, 200.00, '', 1.00, 0, 0),
(110, 6, 1, 116, 90.00, '', 1.00, 0, 0),
(111, 8, 1, 117, 750.00, '', 1.00, 0, 0),
(112, 6, 1, 118, 90.00, '', 1.00, 0, 0),
(113, 7, 1, 119, 2100.00, '', 1.00, 0, 0),
(114, 7, 1, 120, 2100.00, '', 1.00, 0, 0),
(115, 7, 1, 121, 2100.00, '', 1.00, 0, 0),
(116, 10, 1, 122, 550.00, '', 1.00, 0, 0);

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
  PRIMARY KEY (`detalle_pedido_id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `detalle_cotizacion_id` (`detalle_cotizacion_id`),
  KEY `factura_id` (`factura_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=71 ;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`detalle_pedido_id`, `pedido_id`, `detalle_cotizacion_id`, `cantidad_surtida`, `detalle_pedido_status`, `detalle_pedido_obs`, `factura_id`, `cantidad_entregada`, `cantidad_enrutada`) VALUES
(54, 34, 100, 5, 3, NULL, 0, 0, 0),
(55, 35, 101, 6, 3, NULL, 0, 0, 0),
(56, 36, 102, 10, 3, '', 0, 0, 10),
(57, 37, 103, 3, 2, NULL, 0, 0, 0),
(58, 38, 104, 3, 1, NULL, 0, 0, 0),
(59, 38, 105, 0, 0, NULL, 0, 0, 0),
(61, 39, 106, 0, 0, NULL, 0, 0, 0),
(62, 40, 106, 0, 0, NULL, 0, 0, 0),
(63, 41, 108, 0, 1, NULL, 0, 0, 0),
(64, 42, 109, 0, 1, NULL, 0, 0, 0),
(65, 43, 110, 0, 0, NULL, 0, 0, 0),
(66, 44, 111, 0, 1, NULL, 0, 0, 0),
(67, 45, 112, 0, 0, NULL, 0, 0, 0),
(68, 48, 113, 0, 1, NULL, 0, 0, 0),
(69, 49, 114, 0, 1, NULL, 0, 0, 0),
(70, 50, 115, 0, 1, NULL, 0, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`domicilio_id`, `domicilio_calle`, `domicilio_num_ext`, `domicilio_num_int`, `domicilio_colonia`, `domicilio_municipio`, `domicilio_ciudad`, `domicilio_estado`, `domicilio_cp`) VALUES
(70, 'Calle1', '1', '2', 'Colonia', 'Municipio', 'Cuidad', 'Estado', 52140),
(82, '', '', '', '', '', '', '', 0),
(83, 'Saltillo ', '29', '', 'Jardines de Guadalupe', 'Nezahualcoyotl', 'Nezahualcoyotl', 'México', 57140),
(84, 'AV. EJÉRCITO NACIONAL', '350', '', 'CHAPULTEPEC MORALES', 'MIGUEL HIDALGO', 'MIGUEL HIDALGO', 'DF', 11570),
(85, 'Av de las palmas', '34', '', 'Lomas de Chapultepec', 'Benito Juárez', 'Mexico', 'Distrito F', 2230),
(89, 'la', '12', '2', 'infona', 'Izacalli', 'Mexico', 'Mexico', 2201),
(90, 'JUAN DE DIOS BATIZ', '12', '2', 'infona', 'GUSTAVO A MADERO', 'Mexico', 'Mexico', 2201),
(91, 'AV. IND. MIL.', '1111', '', 'L. TECAMACHALCO', 'NAUCALPAN', 'MEXICO', 'ESTADO DE MEXICO', 53950),
(92, 'AVENIDA CAMELINAS', '3527', '902', 'LAS AMERICAS', 'MORELIA', 'MEXICO', 'MICHOACAN', 58270),
(93, 'AVENIDA CINCO', '253', '', 'GRANJAS SAN ANTONIO', 'IZTAPALAPA', 'MEXICO', 'DISTRITO FEDERAL', 9070),
(94, 'LIEJA', '7', '', 'JUAREZ', 'CUAUHTEMOC', 'MEXICO', 'DISTRITO FEDERAL', 66000),
(95, 'PARROQUIA', '1130', 'PISO 6', 'SANTA CRUZ ATOYAC', 'BENITO JUAREZ', 'MEXICO', 'DISTRITO FEDERAL', 3310),
(96, 'Av de las palmas', '34', '2', 'Ferreria', 'Alvaro Obregon ', 'Mexico', 'Distrito F', 2230),
(111, 'Av de las palmas', '34', '', 'Ferreria', 'Cuautitlan mexico', 'Mexico', 'Distrito F', 2230),
(112, 'CONSTITUCION DE LA REPUBLICA ', '106', '', 'Jardines de Guadalupe', 'Nezahualcoyotl', 'Mexico', 'ESTADO DE ', 57140),
(113, 'CALADA SANTA ANA, NORTE', '67', '', 'TORRES LINDA VISTA', 'GUSTAVO A MADERO', 'Mexico', 'Distrito F', 7208),
(114, 'AV CHALMA LA VILLA', '50', 'EDIF. 72 DEPTO. 403', 'EL ARBOLILLO', 'GUSTAVO A MADERO', 'Mexico', 'Distrito F', 7240),
(115, 'Paseo San Isidro', '383', '', 'Barrio de Santiaguito', 'Metepec', 'Metepec', 'Edo. Mex', 52140),
(116, '', '', '', '', '', '', '', 0),
(117, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 0),
(118, 'calle', '5', '8', 'col', 'mun', 'ciud', 'edo', 0);

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
(3, 'PROMEX, S.A. DE C.V.', 'PEX961112RA5', 83),
(4, 'CORPORATIVO DESCI, S.A. DE C.V.', 'CDE040218486', 112),
(5, 'INDUSTRIAS PIKAJE, S.A. DE C.V.', 'IPI040607DHA', 113),
(6, 'INDUSTRIAS LOA', 'OAAL720803BQA', 114);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`factura_id`, `factura_fecha`, `factura_status`, `factura_descripcion`, `pedido_id`) VALUES
(6, '2014-01-10 00:00:00', 0, 'listo', 35),
(7, '2014-01-10 00:00:00', 0, 's', 35);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla de GENERALES de USUARIO, CONTACTO, ETC' AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `generales`
--

INSERT INTO `generales` (`generales_id`, `nombre`, `apel_p`, `apel_m`, `tel_trabajo`, `ext_tel_trabajo`, `tel_casa`, `tel_cel`, `email`) VALUES
(11, 'Usuario', 'Normal', 'Sencillo', '1111', '2222', '3333', '4444', 'user@promex.com'),
(18, 'Francisco', 'Hernandez', 'G', '58684331', '2431', '26022738', '5517624088', 'franciscoescom42@gma'),
(20, 'Gerardo', 'Arriola', 'Gonzalez', '51200324', '133', '58172805', '5518508977', 'gerardo.arriola@promexextintores.com.mx'),
(24, 'RENE', 'FIGUEROA', 'G', '58684331', '2431', '26022738', '5517624088', 'rene.figueroa@promex.com'),
(25, 'JOSE LUIS', 'WENCE', 'VEGA', '55896111', '55896422', '', '', 'gag_6319@hotmail.com'),
(26, 'GERARDO ', 'ARRIOLA', 'GONZALEZ', '51200324', '133', '', '5518508977', 'industriamilitar@yahoo.com.mx'),
(27, 'VERONICA', 'OCHOA', 'MONTERO', '55812433', '114', '', '', 'vochoa@convento.com.mx'),
(28, 'GERARDO', 'GONZALEZ', 'CANTELLANO', '50903600', '57241', '', '', 'gerardgonzalez@yahoo.com'),
(29, 'PATRICIA', 'ARIAS', 'CABELLO', '36018400', '48331', '', '', 'pariasc@sepdf.gob.mx'),
(30, 'Antonio', 'Butron', 'Luz', '7223965551', '', '7222713649', '', 'juanantonio.butron@gmail.com'),
(31, '', '', '', '', '', '', '', ''),
(33, 'mayara', 'alcantara', 'gomez', '125478', '125478', '144587', '1125478', 'magayara@hotmail.conm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `material_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `material_descripcion` varchar(100) NOT NULL DEFAULT 'NULL',
  `material_tipo` bigint(20) NOT NULL,
  `id_unidad` bigint(10) DEFAULT NULL,
  `material_precio` float NOT NULL,
  `material_maquila` tinyint(1) NOT NULL,
  `idSAE` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla Material' AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`material_id`, `material_descripcion`, `material_tipo`, `id_unidad`, `material_precio`, `material_maquila`, `idSAE`) VALUES
(2, 'extintor 40kg', 2, 3, 500, 0, 'ext40'),
(4, 'ALTAVOZ MEGAFONO 25W C/MICROFONO', 2, 3, 200, 1, 'ALLT25'),
(5, 'ALARMA CONTRA INCENDIO', 2, 1, 450, 0, 'ALMCIN'),
(6, 'AMPERIMETRO', 2, 3, 90, 0, 'AMP'),
(7, 'AIRE ACONDICIONADO TIPO MULTISPLIT DE 1', 2, 3, 2100, 1, 'AA122'),
(8, 'ACCESORIOS Y REFACCIONES', 2, 3, 750, 1, 'ACCRF'),
(9, 'EXTINTOR NUEVO A BASE CO2 TIPO BC 4.53KG', 2, 3, 450, 0, 'EXTCO24.53'),
(10, 'EXTINTOR NUEVO GRANADA BASE HFC 4.5 KG', 2, 3, 550, 0, 'EXTGRHFC4.'),
(11, 'EXTINTOR TIPO K WET CHEMICAL MOD B260', 2, 3, 600, 1, 'EXTKWCH'),
(12, 'mangueras', 1, 3, 80, 1, 'MANG12'),
(13, 'RECARGA EXTINTOR POLVO QUIMICO SECO 1KG', 2, 1, 40, 1, 'RECPQS1'),
(14, 'RECPQS2', 2, 1, 60, 1, 'RECPQS2'),
(15, 'RECARGA EXTINTOR POLVO QUIMICO SECO 4.5KG', 2, 1, 135, 1, 'RECPQS4.5'),
(16, 'RECARGA EXTINTOR POLVO QUIMICO SECO 6KG', 2, 1, 180, 1, 'RECPQS6'),
(17, 'RECARGA EXTINTOR POLVO QUIMICO SECO 9KG', 2, 1, 270, 1, 'RECPQS9');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla PANTALLA' AUTO_INCREMENT=54 ;

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
(53, 3, 'VALES DE CONSUMO', 'vales de consumo almacen', 42, 'almacen_vales_consumo_busqueda.php', 'noticias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE IF NOT EXISTS `partida` (
  `partida_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `partida_no` bigint(20) NOT NULL COMMENT 'numero de partida',
  `producto_id` bigint(20) DEFAULT NULL,
  `partida_cantidad` decimal(10,0) NOT NULL COMMENT 'cantidad de producto por partida',
  `contrato_id` varchar(20) NOT NULL,
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
  `sucursal_id` bigint(20) NOT NULL,
  `pedido_fecha_creacion` datetime NOT NULL,
  `pedido_fecha_entrega` datetime NOT NULL,
  `pedido_estado` tinyint(4) NOT NULL DEFAULT '0',
  `pedido_obs` varchar(100) DEFAULT NULL,
  `contrato_id` varchar(20) DEFAULT NULL,
  `partida_id` bigint(20) DEFAULT NULL,
  `folio_pedido` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`pedido_id`),
  KEY `cotizacion_id` (`cotizacion_id`),
  KEY `sucursal_id` (`sucursal_id`),
  KEY `partida_id` (`partida_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla Pedidos' AUTO_INCREMENT=51 ;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`pedido_id`, `cotizacion_id`, `sucursal_id`, `pedido_fecha_creacion`, `pedido_fecha_entrega`, `pedido_estado`, `pedido_obs`, `contrato_id`, `partida_id`, `folio_pedido`) VALUES
(34, 100, 3, '2014-01-10 00:00:00', '2014-01-10 00:00:00', 1, NULL, NULL, NULL, NULL),
(35, 101, 3, '2014-01-10 00:00:00', '2014-01-10 00:00:00', 1, NULL, NULL, NULL, NULL),
(36, 107, 3, '2014-01-14 00:00:00', '2014-01-14 00:00:00', 1, NULL, NULL, NULL, NULL),
(37, 108, 3, '2014-01-15 00:00:00', '2014-01-15 00:00:00', 1, NULL, NULL, NULL, NULL),
(38, 109, 3, '2014-01-14 00:00:00', '2014-01-21 00:00:00', 0, NULL, NULL, NULL, NULL),
(39, 110, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL),
(40, 110, 3, '2014-01-08 00:00:00', '2014-01-08 00:00:00', 0, NULL, NULL, NULL, NULL),
(41, 114, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL),
(42, 115, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL),
(43, 116, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL),
(44, 117, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL),
(45, 118, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL),
(46, 118, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL),
(47, 118, 3, '2014-01-12 00:00:00', '2014-01-17 00:00:00', 0, NULL, NULL, NULL, NULL),
(48, 119, 3, '2014-01-08 00:00:00', '2014-01-08 00:00:00', 0, NULL, NULL, NULL, NULL),
(49, 120, 3, '2014-01-01 00:00:00', '2014-01-01 00:00:00', 0, NULL, NULL, NULL, NULL),
(50, 121, 3, '2014-01-02 00:00:00', '2014-01-29 00:00:00', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `perfil_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `perfil_nombre` varchar(20) NOT NULL DEFAULT '0',
  `perfil_descripcion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`perfil_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla PERFIL' AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`perfil_id`, `perfil_nombre`, `perfil_descripcion`) VALUES
(28, 'prueba', 'prueba 3'),
(29, 'eliminar', 'agregar 8'),
(30, 'GENERAL', 'contiene todo'),
(31, 'prueb', 'llegar al 235'),
(32, '1', '1'),
(34, 'perfil A', 'Contiene todo');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=630 ;

--
-- Volcado de datos para la tabla `perfil_pantalla`
--

INSERT INTO `perfil_pantalla` (`perfil_pantalla_id`, `perfil_id`, `pantalla_id`) VALUES
(186, 29, 22),
(187, 29, 4),
(188, 29, 29),
(189, 29, 15),
(190, 29, 18),
(191, 29, 16),
(192, 29, 17),
(255, 31, 11),
(256, 31, 9),
(257, 31, 10),
(258, 31, 8),
(259, 31, 7),
(260, 31, 25),
(261, 31, 24),
(262, 31, 5),
(263, 31, 30),
(264, 31, 14),
(265, 31, 15),
(266, 31, 18),
(267, 32, 11),
(268, 32, 10),
(269, 32, 7),
(270, 32, 9),
(271, 32, 8),
(272, 32, 25),
(273, 32, 24),
(282, 32, 11),
(283, 32, 9),
(284, 32, 10),
(285, 32, 8),
(286, 32, 7),
(287, 32, 25),
(288, 32, 24),
(289, 32, 23),
(290, 32, 6),
(291, 32, 5),
(292, 32, 21),
(293, 32, 19),
(294, 32, 20),
(295, 32, 30),
(296, 32, 22),
(297, 32, 4),
(298, 32, 29),
(299, 32, 3),
(300, 32, 12),
(301, 32, 13),
(302, 32, 14),
(303, 32, 15),
(304, 32, 16),
(305, 32, 18),
(306, 32, 17),
(307, 32, 2),
(334, 32, 11),
(335, 32, 10),
(336, 32, 11),
(337, 32, 10),
(338, 32, 9),
(339, 32, 9),
(340, 32, 8),
(341, 31, 11),
(342, 31, 10),
(343, 31, 9),
(344, 31, 8),
(345, 31, 7),
(346, 31, 25),
(347, 31, 24),
(348, 32, 11),
(349, 32, 10),
(350, 32, 9),
(351, 32, 8),
(352, 32, 25),
(353, 32, 7),
(354, 32, 24),
(472, 28, 11),
(473, 28, 10),
(474, 28, 9),
(475, 28, 8),
(476, 28, 7),
(477, 28, 25),
(478, 28, 24),
(479, 28, 6),
(480, 28, 19),
(561, 34, 11),
(562, 34, 10),
(563, 34, 9),
(564, 34, 8),
(565, 34, 7),
(566, 34, 25),
(567, 34, 24),
(568, 34, 23),
(569, 34, 6),
(570, 34, 5),
(571, 34, 21),
(572, 34, 19),
(573, 34, 20),
(574, 34, 30),
(575, 34, 22),
(576, 34, 4),
(577, 34, 29),
(578, 34, 3),
(579, 34, 12),
(580, 34, 13),
(581, 34, 14),
(582, 34, 15),
(583, 34, 16),
(584, 34, 18),
(585, 34, 17),
(586, 34, 2),
(587, 30, 50),
(588, 30, 49),
(589, 30, 48),
(590, 30, 11),
(591, 30, 47),
(592, 30, 10),
(593, 30, 46),
(594, 30, 45),
(595, 30, 44),
(596, 30, 18),
(597, 30, 9),
(598, 30, 13),
(599, 30, 12),
(600, 30, 43),
(601, 30, 53),
(602, 30, 52),
(603, 30, 51),
(604, 30, 42),
(605, 30, 37),
(606, 30, 36),
(607, 30, 8),
(608, 30, 35),
(609, 30, 7),
(610, 30, 34),
(611, 30, 3),
(612, 30, 6),
(613, 30, 16),
(614, 30, 33),
(615, 30, 15),
(616, 30, 4),
(617, 30, 29),
(618, 30, 22),
(619, 30, 32),
(620, 30, 31),
(621, 30, 23),
(622, 30, 5),
(623, 30, 21),
(624, 30, 20),
(625, 30, 19),
(626, 30, 30),
(627, 30, 17),
(628, 30, 14),
(629, 30, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `prospecto`
--

INSERT INTO `prospecto` (`id_prospecto`, `cliente_id`, `fecha_prospecto`, `carta_presentacion`, `material_multimedia`, `visita_cliente`, `cotizacion`) VALUES
(1, '1', '2013-06-17', 1, 1, 0, 0),
(4, '3', '2013-06-19', 1, 0, 0, 0),
(5, '20', '2013-12-18', 1, 1, 1, 1);

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
  PRIMARY KEY (`ruta_id`),
  KEY `orden_salida_id` (`transporte_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla RUTA' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`ruta_id`, `transporte_id`, `ruta_estatus`, `ruta_observaciones`) VALUES
(1, 1, 1, NULL),
(2, 2, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta_detalle`
--

CREATE TABLE IF NOT EXISTS `ruta_detalle` (
  `detalle_ruta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ruta_id` bigint(20) NOT NULL,
  `PedidoDetalle_id` bigint(20) NOT NULL,
  `cantidadEnrutada` int(11) NOT NULL,
  `cantidadEntregada` int(11) DEFAULT NULL,
  `observaciones` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`detalle_ruta_id`),
  KEY `ruta_id` (`ruta_id`),
  KEY `PedidoDetalle_id` (`PedidoDetalle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `ruta_detalle`
--

INSERT INTO `ruta_detalle` (`detalle_ruta_id`, `ruta_id`, `PedidoDetalle_id`, `cantidadEnrutada`, `cantidadEntregada`, `observaciones`) VALUES
(1, 1, 54, 5, 0, NULL),
(2, 1, 55, 6, 0, NULL),
(3, 2, 56, 10, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla normalizada domicilio de cliente' AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`sucursal_id`, `cliente_id`, `tipo_establecimiento`, `clave_nombre`, `domicilio_id`, `generales_id`, `contacto_ventas_id`) VALUES
(3, '2079', 1, 'PROMEX SUCURSAL S.A DE CV', 89, 23, NULL),
(4, '2079', 1, 'Siemens Bodega', 115, 30, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte`
--

CREATE TABLE IF NOT EXISTS `transporte` (
  `transporte_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transporte_nombre` varchar(50) DEFAULT NULL,
  `transporte_placas` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`transporte_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `transporte`
--

INSERT INTO `transporte` (`transporte_id`, `transporte_nombre`, `transporte_placas`) VALUES
(1, 'CAMIONETA 2.5TON', 'MNU-634'),
(2, 'Volteo', 'JVV-1233');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE IF NOT EXISTS `unidades` (
  `id_unidad` bigint(20) NOT NULL AUTO_INCREMENT,
  `prefijo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_unidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Unidades de Medida' AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id_unidad`, `prefijo`) VALUES
(1, 'ltr'),
(2, 'cm'),
(3, 'pza');

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
('ArrioG', 'promex', 20, 82, 0, 28),
('magayara', '123456', 33, 118, 0, 30),
('usuario1', 'usuario2', 11, 70, 0, 30);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla Relación USUARIO_CLIENTE' AUTO_INCREMENT=1 ;

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
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`almacen_material_id`) REFERENCES `almacen_material` (`almacen_material_id`);

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
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`contrato_id`) REFERENCES `contrato` (`contrato_id`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
