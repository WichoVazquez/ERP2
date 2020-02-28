-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-01-2014 a las 20:09:46
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `promex`
--
CREATE DATABASE IF NOT EXISTS `promex` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
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
(1, 'PROMEX Alm1', 'Instalaciones', 85, 0),
(2, 'PROMEX_ALM2', 'Foraneo', 86, 0),
(16, 'TALLER', 'ALMACEN DE TALLER', 111, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla ALMACEN_MATERIAL' AUTO_INCREMENT=15 ;

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
(11, 1, 11, 10, 20, 1, '1'),
(12, 16, 12, 48, 60, 2, '0'),
(13, 2, 12, 20, 40, 5, '0'),
(14, 16, 5, 4, 50, 2, '0');

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
  PRIMARY KEY (`cotizacion_id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `cotizacion_ibfk_3` (`empresa_id`),
  KEY `cotizacion_ibfk_4` (`moneda_id`),
  KEY `cotizacion_ibfk_5` (`contacto_ventas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla de Cotizaciones' AUTO_INCREMENT=102 ;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`cotizacion_id`, `cotizacion_edo`, `cliente_id`, `usuario_id`, `empresa_id`, `cotizacion_folio`, `cotizacion_fecha_modificacion`, `cotizacion_fecha_envio`, `moneda_id`, `cotizacion_divisa_dia`, `cotizacion_observaciones`, `contacto_ventas_id`, `cotizacion_mensaje`, `cotizacion_dias_entrega`, `cotizacion_condiciones_pago`, `cotizacion_recotizada`) VALUES
(100, 6, '5', 'usuario1', 4, 1, '2014-01-10 17:44:02', '2014-01-10 11:43:48', 1, '1.00', '', 7, 'leyenda', 5, '', NULL),
(101, 6, '1', 'usuario1', 3, 1, '2014-01-10 18:00:22', '2014-01-10 12:00:05', 1, '1.00', '', 3, 'LA', 5, '', NULL);

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
  PRIMARY KEY (`detalle_cotizacion_id`),
  KEY `cotizacion_id` (`cotizacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='DETALLE COTIZACION' AUTO_INCREMENT=102 ;

--
-- Volcado de datos para la tabla `detalle_cotizacion`
--

INSERT INTO `detalle_cotizacion` (`detalle_cotizacion_id`, `producto_id`, `cantidad`, `cotizacion_id`, `precio_venta`, `observaciones`, `multiplo`) VALUES
(100, 9, 5, 100, '450.00', 'BUENO', '1.10'),
(101, 6, 6, 101, '90.00', '', '1.00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=56 ;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`detalle_pedido_id`, `pedido_id`, `detalle_cotizacion_id`, `cantidad_surtida`, `detalle_pedido_status`, `detalle_pedido_obs`, `factura_id`, `cantidad_entregada`, `cantidad_enrutada`) VALUES
(54, 34, 100, '5', 3, NULL, 0, 0, 0),
(55, 35, 101, '6', 3, NULL, 0, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`domicilio_id`, `domicilio_calle`, `domicilio_num_ext`, `domicilio_num_int`, `domicilio_colonia`, `domicilio_municipio`, `domicilio_ciudad`, `domicilio_estado`, `domicilio_cp`) VALUES
(70, 'Calle1', '1', '2', 'Colonia', 'Municipio', 'Cuidad', 'Estado', 52140),
(82, '', '', '', '', '', '', '', 0),
(84, 'AV. EJÉRCITO NACIONAL', '350', '', 'CHAPULTEPEC MORALES', 'MIGUEL HIDALGO', 'MIGUEL HIDALGO', 'DF', 11570),
(85, 'Av de las palmas', '34', '', 'Lomas de Chapultepec', 'Benito Juárez', 'Mexico', 'Distrito F', 2230),
(86, 'JUAN DE DIOS BATIZ', '12', '2', 'infona', 'Izacalli', 'Mexico', 'Mexico', 2201),
(89, 'la', '12', '2', 'infona', 'Izacalli', 'Mexico', 'Mexico', 2201),
(90, 'JUAN DE DIOS BATIZ', '12', '2', 'infona', 'GUSTAVO A MADERO', 'Mexico', 'Mexico', 2201),
(91, 'AV. IND. MIL.', '1111', '', 'L. TECAMACHALCO', 'NAUCALPAN', 'MEXICO', 'ESTADO DE MEXICO', 53950),
(92, 'AVENIDA CAMELINAS', '3527', '902', 'LAS AMERICAS', 'MORELIA', 'MEXICO', 'MICHOACAN', 58270),
(93, 'AVENIDA CINCO', '253', '', 'GRANJAS SAN ANTONIO', 'IZTAPALAPA', 'MEXICO', 'DISTRITO FEDERAL', 9070),
(94, 'LIEJA', '7', '', 'JUAREZ', 'CUAUHTEMOC', 'MEXICO', 'DISTRITO FEDERAL', 6600),
(95, 'PARROQUIA', '1130', 'PISO 6', 'SANTA CRUZ ATOYAC', 'BENITO JUAREZ', 'MEXICO', 'DISTRITO FEDERAL', 3310),
(96, 'Av de las palmas', '34', '2', 'Ferreria', 'Alvaro Obregon ', 'Mexico', 'Distrito F', 2230),
(111, 'Av de las palmas', '34', '', 'Ferreria', 'Cuautitlan mexico', 'Mexico', 'Distrito F', 2230),
(112, 'CONSTITUCION DE LA REPUBLICA ', '106', '', 'Jardines de Guadalupe', 'Nezahualcoyotl', 'Mexico', 'ESTADO DE ', 57140),
(113, 'CALADA SANTA ANA, NORTE', '67', '', 'TORRES LINDA VISTA', 'GUSTAVO A MADERO', 'Mexico', 'Distrito F', 7208),
(114, 'AV CHALMA LA VILLA', '50', 'EDIF. 72 DEPTO. 403', 'EL ARBOLILLO', 'GUSTAVO A MADERO', 'Mexico', 'Distrito F', 7240);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla de GENERALES de USUARIO, CONTACTO, ETC' AUTO_INCREMENT=30 ;

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
(29, 'PATRICIA', 'ARIAS', 'CABELLO', '36018400', '48331', '', '', 'pariasc@sepdf.gob.mx');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla Material' AUTO_INCREMENT=13 ;

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
(12, 'mangueras', 1, 3, 80, 1, 'MANG12');

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
  `no_menu` int(11) NOT NULL,
  `pantalla_nombre` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `pantalla_descripcion` varchar(50) NOT NULL,
  `pantalla_padre` varchar(20) NOT NULL COMMENT 'centro de costos',
  `pantalla_url` varchar(50) NOT NULL DEFAULT 'NULL',
  `clv_pantalla` varchar(20) NOT NULL,
  PRIMARY KEY (`pantalla_id`),
  UNIQUE KEY `clv_pantalla` (`clv_pantalla`),
  UNIQUE KEY `clv_pantalla_2` (`clv_pantalla`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla PANTALLA' AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `pantalla`
--

INSERT INTO `pantalla` (`pantalla_id`, `no_menu`, `pantalla_nombre`, `pantalla_descripcion`, `pantalla_padre`, `pantalla_url`, `clv_pantalla`) VALUES
(2, 1, 'Catalogos', 'Menu de catalogos', '', 'CATALOGOS.php', 'menu_catalogos'),
(3, 1, 'Proveedor', 'Modulo Proveedor', 'Catalogos', 'proveedor_busqueda.php', 'proveedor_busqueda'),
(4, 1, 'Cliente', 'Modulo clientes', 'Catalogos', 'cliente_busqueda.php', 'cliente_busqueda'),
(5, 2, 'Ventas', 'Menu de Ventas', '', 'VENTAS.php', 'menu_ventas'),
(6, 3, 'Compras', 'Menu de Compras', '', 'COMPRAS.php', 'menu_compras'),
(7, 4, 'Facturacion', 'Menu de Facturacion', '', 'FACTURACION.php', 'menu_facturacion'),
(8, 5, 'Almacen', 'Menu de Almacen', '', 'ALMACEN.php', 'menu_almacen'),
(9, 6, 'Taller', 'Menu de Taller', '', 'TALLER.php', 'menu_taller'),
(10, 7, 'Calidad', 'Menu de Calidad', '', 'CALIDAD.php', 'menu_calidad'),
(11, 8, 'Trafico', 'Menu de Trafico', '', 'TRAFICO.php', 'menu_trafico'),
(12, 1, 'Almacen', 'Catalogo de Almacen', 'Catalogos', 'almacen_busqueda.php', 'almacen_busqueda'),
(13, 1, 'Material', 'Catalogo de Material', 'Catalogos', 'material_busqueda.php', 'material_busqueda'),
(14, 1, 'Empresa', 'Catalogo de Empresa', 'Catalogos', 'empresa_busqueda.php', 'empresa_busqueda'),
(15, 1, 'Matriz', 'Catalogo de Matriz', 'Catalogos', 'matriz_busqueda.php', 'matriz_busqueda'),
(16, 1, 'Precio', 'Catalogo de Precio', 'Catalogos', 'precio_busqueda.php', 'precio_busqueda'),
(17, 1, 'Moneda', 'Catalogo de Moneda', 'Catalogos', 'moneda_busqueda.php', 'moneda_busqueda'),
(18, 1, 'Transporte', 'Catalogo de Transporte', 'Catalogos', 'transporte_busqueda.php', 'transporte_busqueda'),
(19, 1, 'Usuario', 'Catalogo de Usuario', 'Catalogos', 'usuario_busqueda.php', 'usuario_busqueda'),
(20, 1, 'Perfiles', 'Catalogo de Perfiles', 'Catalogos', 'perfiles_busqueda.php', 'perfiles_busqueda'),
(21, 1, 'Pantalla', 'Catalogo de Pantalla', 'Catalogos', 'pantalla_busqueda.php', 'pantalla_busqueda'),
(22, 2, 'Prospectar', 'Modulo Prospectar', 'Ventas', 'prospecto_busqueda.php', 'prospecto_busqueda'),
(23, 2, 'Cotizaciones', 'Modulo Cotizaciones', 'Ventas', 'cotizacion_busqueda_usuario.php', 'cotizacion_busqueda'),
(24, 2, 'Pedidos', 'Modulo Pedidos', 'Ventas', 'pedidos_busqueda.php', 'pedidos_busqueda'),
(25, 2, 'Reportes', 'Modulo Reportes', 'Ventas', 'reportes_ventas.php', 'reportes_ventas');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla Pedidos' AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`pedido_id`, `cotizacion_id`, `sucursal_id`, `pedido_fecha_creacion`, `pedido_fecha_entrega`, `pedido_estado`, `pedido_obs`, `contrato_id`, `partida_id`, `folio_pedido`) VALUES
(34, 100, 3, '2014-01-10 00:00:00', '2014-01-10 00:00:00', 1, NULL, NULL, NULL, NULL),
(35, 101, 3, '2014-01-10 00:00:00', '2014-01-10 00:00:00', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `perfil_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `perfil_nombre` varchar(20) NOT NULL DEFAULT '0',
  `perfil_descripcion` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`perfil_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla PERFIL' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`perfil_id`, `perfil_nombre`, `perfil_descripcion`) VALUES
(1, 'PerfilInicial', 0),
(2, 'UserNomal', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_pantalla`
--

CREATE TABLE IF NOT EXISTS `perfil_pantalla` (
  `perfil_pantalla_id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil_id` bigint(20) NOT NULL,
  `pantalla_id` bigint(20) NOT NULL,
  `alta` tinyint(1) DEFAULT NULL,
  `baja` tinyint(1) DEFAULT NULL,
  `consulta` tinyint(1) DEFAULT NULL,
  `modificacion` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`perfil_pantalla_id`),
  KEY `perfil_id` (`perfil_id`),
  KEY `pantalla_id` (`pantalla_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `perfil_pantalla`
--

INSERT INTO `perfil_pantalla` (`perfil_pantalla_id`, `perfil_id`, `pantalla_id`, `alta`, `baja`, `consulta`, `modificacion`) VALUES
(9, 21, 12, 1, 1, 1, 1),
(12, 23, 4, 1, 0, 0, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla RUTA' AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`salida_material_id`),
  KEY `almacen_material_id` (`almacen_material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla SALIDA de MATERIAL' AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla normalizada domicilio de cliente' AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`sucursal_id`, `cliente_id`, `tipo_establecimiento`, `clave_nombre`, `domicilio_id`, `generales_id`, `contacto_ventas_id`) VALUES
(3, '2079', 1, 'PROMEX SUCURSAL S.A DE CV', 89, 23, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte`
--

CREATE TABLE IF NOT EXISTS `transporte` (
  `transporte_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transporte_nombre` varchar(50) DEFAULT NULL,
  `transporte_placas` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`transporte_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `transporte`
--

INSERT INTO `transporte` (`transporte_id`, `transporte_nombre`, `transporte_placas`) VALUES
(1, 'CAMIONETA 2.5TON', 'MNU-634');

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
  `usuario_rol` bigint(20) NOT NULL DEFAULT '2' COMMENT 'rol (0-administrador, 1-custodio, 2-usuario)',
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

INSERT INTO `usuario` (`usuario_id`, `usuario_password`, `generales_id`, `domicilio_id`, `usuario_rol`, `usuario_status`, `perfil_id`) VALUES
('ArrioG', 'promex', 20, 82, 2, 0, 1),
('usuario1', 'usuario2', 11, 70, 2, 0, 1);

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
