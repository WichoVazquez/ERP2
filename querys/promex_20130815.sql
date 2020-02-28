-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2013 at 05:37 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `promex`
--

-- --------------------------------------------------------

--
-- Table structure for table `almacen`
--

CREATE TABLE IF NOT EXISTS `almacen` (
  `almacen_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `domicilio_id` bigint(20) NOT NULL,
  PRIMARY KEY (`almacen_id`),
  KEY `domicilio_id` (`domicilio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla Almacen' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `almacen`
--

INSERT INTO `almacen` (`almacen_id`, `nombre`, `descripcion`, `domicilio_id`) VALUES
(2, 'Refacciones', '321', 66),
(3, 'Almacen2', 'Nuevo', 67),
(4, 'Bodega', 'Bodega de Material', 72);

-- --------------------------------------------------------

--
-- Table structure for table `almacen_material`
--

CREATE TABLE IF NOT EXISTS `almacen_material` (
  `almacen_material_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `almacen_id` bigint(20) NOT NULL,
  `material_id` bigint(20) NOT NULL,
  `cantidad_actual` bigint(20) NOT NULL DEFAULT '0',
  `maximo` bigint(20) NOT NULL,
  `minimo` bigint(20) DEFAULT '0',
  PRIMARY KEY (`almacen_material_id`),
  KEY `almacen_id` (`almacen_id`),
  KEY `material_id` (`material_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla ALMACEN_MATERIAL' AUTO_INCREMENT=17 ;

--
-- Dumping data for table `almacen_material`
--

INSERT INTO `almacen_material` (`almacen_material_id`, `almacen_id`, `material_id`, `cantidad_actual`, `maximo`, `minimo`) VALUES
(12, 3, 14, 10, 20, 1),
(13, 2, 15, 2, 1000, 1),
(14, 3, 16, 36, 50, 37),
(15, 2, 17, 4, 40, 4),
(16, 4, 18, 0, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `cliente_id` varchar(10) NOT NULL DEFAULT '',
  `cliente_razonsocial` varchar(50) NOT NULL DEFAULT 'NULL',
  `cliente_rfc` varchar(12) NOT NULL DEFAULT 'NULL',
  `cliente_domicilio_fiscal` bigint(20) NOT NULL,
  `status` bigint(20) NOT NULL,
  PRIMARY KEY (`cliente_id`),
  KEY `cliente_domicilio_fiscal` (`cliente_domicilio_fiscal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='cliente PROMEX';

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_razonsocial`, `cliente_rfc`, `cliente_domicilio_fiscal`, `status`) VALUES
('1', 'CORPORATIVO DESCI SA DE CV', 'CDE040218486', 62, 1),
('10', 'GOBIERNO DEL DISTRITO FEDERAL', 'GDF9712054NA', 55, 1),
('11', 'GOBIERNO DEL DISTRITO FEDERAL/SECRETARIA DE SALUD', 'GDF9712054NA', 56, 0),
('12', 'GOBIERNO DEL DISTRITO FEDERAL', 'GDF9712054NA', 57, 1),
('13', 'GOBIERNO DEL DISTRITO FEDERAL, G.D.F.', 'GDF9712054NA', 58, 0),
('14', 'INSTITUTO NACIONAL DE PEDIATRIA', 'INP8304203F7', 59, 1),
('15', 'FRANCISCO BRAVO SÁNCHEZ', 'XXXXXXXXXXXX', 60, 0),
('2', 'SUPERISSSTE', 'SUP090821742', 47, 0),
('3', 'Mogel Fluídos, S.A. DE C.V.', 'PEX961112RA5', 48, 1),
('4', 'ASAMBLEA LEGISLATIVA DEL DISTRITO FEDERAL', 'ALD971028S24', 49, 0),
('5', 'GOBIERNO DEL DISTRITO FEDERAL EN VENUSTIANO CARRAN', 'GDF9712054NA', 50, 0),
('6', 'SECRETARIA DEL MEDIO AMBIENTE, G.D.F.', 'GDF9712054NA', 51, 0),
('7', 'INSTITUTO NACIONAL DE ANTROPOLOGIA E HISTORIA', 'INA460815GV1', 52, 1),
('8', 'INSTITUTO FEDERAL ELECTORAL', 'IFE901011IH1', 53, 0),
('9', 'GOBIERNO DEL DISTRITO FEDERAL/SECRETARIA DE FINANZ', 'GDF9712054NA', 54, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacto_ventas`
--

CREATE TABLE IF NOT EXISTS `contacto_ventas` (
  `contacto_ventas_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cliente_id` varchar(10) NOT NULL DEFAULT 'NULL',
  `generales_id` bigint(20) NOT NULL,
  PRIMARY KEY (`contacto_ventas_id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `generales_id` (`generales_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Contacto para Personal de Ventas' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contacto_ventas`
--

INSERT INTO `contacto_ventas` (`contacto_ventas_id`, `cliente_id`, `generales_id`) VALUES
(1, '1', 16);

-- --------------------------------------------------------

--
-- Table structure for table `contrato`
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
-- Table structure for table `cotizacion`
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
  PRIMARY KEY (`cotizacion_id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `cotizacion_ibfk_3` (`empresa_id`),
  KEY `cotizacion_ibfk_4` (`moneda_id`),
  KEY `cotizacion_ibfk_5` (`contacto_ventas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla de Cotizaciones' AUTO_INCREMENT=352 ;

--
-- Dumping data for table `cotizacion`
--

INSERT INTO `cotizacion` (`cotizacion_id`, `cotizacion_edo`, `cliente_id`, `usuario_id`, `empresa_id`, `cotizacion_folio`, `cotizacion_fecha_modificacion`, `cotizacion_fecha_envio`, `moneda_id`, `cotizacion_divisa_dia`, `cotizacion_observaciones`, `contacto_ventas_id`, `cotizacion_mensaje`) VALUES
(320, 2, '1', 'usuario1', 1, 1, '2013-08-13 03:00:10', '2013-08-12 22:00:10', 1, 1.00, '', 1, 'Esta cortizaciÃ³n es de prueba solamente. Hacer caso omiso. '),
(321, 0, '1', 'usuario1', 1, 0, '2013-07-18 02:13:04', NULL, NULL, NULL, NULL, NULL, NULL),
(322, 3, '1', 'usuario1', 1, 2, '2013-07-30 16:47:15', '2013-07-19 20:54:14', 1, 1.00, '', 1, 'Por medio de la presente le envio un cordial saludo y a su vez el siguiente presupuesto para su amable consideraciÃ³n.'),
(323, 0, '1', 'usuario1', 1, 0, '2013-07-18 03:11:16', NULL, NULL, NULL, NULL, NULL, NULL),
(324, 0, '1', 'usuario1', 1, 0, '2013-07-18 03:18:46', NULL, NULL, NULL, NULL, NULL, NULL),
(325, 2, '1', 'usuario1', 1, 3, '2013-07-18 23:37:33', '2013-07-18 18:37:33', 1, 1.00, '', 1, ''),
(326, 0, '1', 'usuario1', 1, 0, '2013-07-18 03:27:24', NULL, NULL, NULL, NULL, NULL, NULL),
(327, 2, '1', 'usuario1', 1, 4, '2013-07-18 23:37:01', '2013-07-18 18:37:01', 1, 1.00, '', 1, ''),
(328, 0, '1', 'usuario1', 1, 0, '2013-07-18 18:49:08', NULL, NULL, NULL, NULL, NULL, NULL),
(329, 2, '1', 'usuario1', 1, 5, '2013-07-18 23:36:30', '2013-07-18 18:36:30', 1, 1.00, '', 1, ''),
(330, 4, '1', 'usuario1', 1, 6, '2013-07-18 23:43:24', '2013-07-18 18:38:13', 1, 1.00, '', NULL, ''),
(331, 5, '1', 'usuario1', 1, 7, '2013-08-13 10:26:10', '2013-07-18 18:39:22', 1, 1.00, '', 1, ''),
(332, 3, '1', 'usuario1', 1, 8, '2013-07-24 18:08:05', NULL, 1, 1.00, '', NULL, ''),
(333, 0, '10', 'usuario1', 1, 0, '2013-07-22 15:11:46', NULL, NULL, NULL, NULL, NULL, NULL),
(334, 0, '10', 'usuario1', 1, 0, '2013-07-22 16:59:35', NULL, NULL, NULL, NULL, NULL, NULL),
(335, 0, '1', 'usuario1', 1, 9, '2013-07-22 22:11:40', NULL, 1, 1.00, '', 1, 'Por medio de la presente'),
(336, 0, '1', 'usuario1', 1, 0, '2013-07-24 17:58:17', NULL, NULL, NULL, NULL, NULL, NULL),
(337, 0, '1', 'usuario1', 1, 0, '2013-07-24 17:59:54', NULL, NULL, NULL, NULL, NULL, NULL),
(338, 0, '1', 'usuario1', 1, 0, '2013-07-24 18:01:04', NULL, NULL, NULL, NULL, NULL, NULL),
(339, 5, '1', 'usuario1', 1, 10, '2013-07-24 18:10:38', NULL, 1, 1.00, '', NULL, ''),
(340, 0, '1', 'usuario1', 1, 0, '2013-07-24 18:08:26', NULL, NULL, NULL, NULL, NULL, NULL),
(341, 4, '1', 'usuario1', 1, 11, '2013-07-24 22:40:16', NULL, 1, 1.00, '', NULL, 'Por medio de la presente'),
(342, 0, '1', 'usuario1', 1, 0, '2013-07-29 05:49:24', NULL, NULL, NULL, NULL, NULL, NULL),
(343, 0, '1', 'usuario1', 1, 0, '2013-07-29 15:15:59', NULL, NULL, NULL, NULL, NULL, NULL),
(344, 0, '1', 'usuario1', 1, 0, '2013-07-30 06:07:49', NULL, NULL, NULL, NULL, NULL, NULL),
(345, 2, '1', 'usuario1', 2, 1, '2013-07-30 16:38:08', '2013-07-30 11:38:08', 1, 1.00, '', 1, ''),
(346, 0, '1', 'usuario1', 1, 0, '2013-07-30 21:49:10', NULL, NULL, NULL, NULL, NULL, NULL),
(347, 0, '1', 'usuario1', 1, 0, '2013-07-30 23:36:22', NULL, NULL, NULL, NULL, NULL, NULL),
(348, 0, '1', 'usuario1', 1, 0, '2013-07-31 06:35:23', NULL, NULL, NULL, NULL, NULL, NULL),
(349, 0, '1', 'usuario1', 1, 12, '2013-08-13 04:19:40', NULL, 1, 1.00, '', 1, 'Esto es un ejemplo de impresiÃ³n'),
(350, 1, '1', 'usuario1', 1, 13, '2013-08-13 10:24:44', NULL, 1, 1.00, '', NULL, 'mensaje de prueba'),
(351, 0, '1', 'usuario1', 1, 0, '2013-08-14 02:31:04', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_compra`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla DETALLE ORDEN COMPRA' AUTO_INCREMENT=23 ;

--
-- Dumping data for table `detalle_compra`
--

INSERT INTO `detalle_compra` (`detalle_id`, `orden_compra_id`, `almacen_material_id`, `detalle_compra_cantidad`, `detalle_compra_cantidad_s`, `producto_id`) VALUES
(2, 5, 12, 2, 0, 8),
(3, 6, 12, 2, 0, 8),
(4, 7, 12, 3, 0, 8),
(5, 8, 12, 2, 0, 8),
(6, 9, 12, 2, 0, 8),
(7, 10, 12, 2, 0, 8),
(8, 11, 12, 3, 0, 8),
(9, 13, 12, 4, 0, 8),
(10, 14, 12, 2, 0, 8),
(11, 15, 12, 2, 0, 8),
(12, 16, 12, 6, 0, 8),
(13, 17, 12, 5, 0, 8),
(14, 18, 12, 5, 0, 8),
(15, 19, 12, 7, 0, 8),
(16, 20, 12, 2, 0, 8),
(17, 21, 12, 2, 0, 8),
(18, 22, 12, 3, 0, 8),
(19, 23, 12, 8, 0, 8),
(20, 24, 12, 2, 0, 8),
(21, 25, 12, 3, 0, 8),
(22, 26, 12, 3, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_cotizacion`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='DETALLE COTIZACION' AUTO_INCREMENT=223 ;

--
-- Dumping data for table `detalle_cotizacion`
--

INSERT INTO `detalle_cotizacion` (`detalle_cotizacion_id`, `producto_id`, `cantidad`, `cotizacion_id`, `precio_venta`, `observaciones`, `multiplo`) VALUES
(188, 8, 1, 320, 20.00, '', 0.99),
(189, 8, 123, 322, 20.00, '', 1.00),
(190, 8, 12, 324, 20.00, '', 1.00),
(191, 8, 12, 325, 20.00, '', 0.99),
(192, 8, 1, 327, 20.00, '', 1.00),
(193, 8, 1, 328, 20.00, '', 1.00),
(195, 8, 1, 329, 20.00, '', 1.00),
(196, 8, 1, 329, 20.00, '', 1.00),
(197, 8, 1, 330, 20.00, '', 0.99),
(198, 8, 10, 331, 20.00, '', 1.00),
(199, 8, 12, 332, 20.00, '', 0.99),
(200, 8, 12, 334, 20.00, '', 0.88),
(201, 8, 12, 334, 20.00, '', 1.00),
(202, 8, 12, 334, 20.00, '', 1.00),
(203, 8, 123, 334, 20.00, '', 1.00),
(204, 8, 12, 335, 20.00, '', 0.99),
(205, 8, 12, 335, 20.00, '', 1.00),
(206, 8, 1, 336, 20.00, '', 1.00),
(207, 8, 1, 337, 20.00, '', 1.00),
(208, 8, 1, 338, 20.00, '', 1.00),
(209, 8, 1, 339, 20.00, '', 1.00),
(210, 8, 12, 339, 20.00, '', 0.99),
(211, 8, 12, 340, 20.00, '', 0.90),
(212, 8, 12, 341, 20.00, '', 0.99),
(214, 8, 2, 345, 20.00, '3', 1.00),
(215, 8, 6, 345, 20.00, 'www', 1.00),
(216, 8, 2, 320, 20.00, '', 1.00),
(217, 8, 2, 320, 20.00, 'aaa', 1.00),
(218, 8, 4, 348, 20.00, '', 1.00),
(219, 8, 2, 349, 20.00, '', 1.00),
(220, 8, 1, 349, 20.00, 'adicional', 1.00),
(221, 8, 2, 350, 20.00, 'pruebas', 0.75),
(222, 8, 2, 351, 20.00, '', 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_orden_salida`
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
-- Table structure for table `detalle_pedido`
--

CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `detalle_pedido_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint(20) NOT NULL,
  `detalle_cotizacion_id` bigint(20) DEFAULT NULL COMMENT 'referencia al producto cotizado ',
  `cantidad_surtida` decimal(10,0) NOT NULL DEFAULT '0',
  `detalle_pedido_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'estado (completo o incompleto)',
  `detalle_pedido_obs` varchar(100) DEFAULT NULL COMMENT 'observaciones del estado del pedido',
  PRIMARY KEY (`detalle_pedido_id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `detalle_cotizacion_id` (`detalle_cotizacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla DETALLE PEDIO' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `domicilio`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `domicilio`
--

INSERT INTO `domicilio` (`domicilio_id`, `domicilio_calle`, `domicilio_num_ext`, `domicilio_num_int`, `domicilio_colonia`, `domicilio_municipio`, `domicilio_ciudad`, `domicilio_estado`, `domicilio_cp`) VALUES
(47, 'AVENIDA SAN FERNANDO', '15', '', 'TORIELLO GUERRA', '', '', 'DISTRITO FEDERAL', 0),
(48, 'SALTILLO', '29', '', 'JARDINES DE GPE.', '', '', 'EDO. DE MEXICO', 0),
(49, 'DONCELES  ESQ. ALLENDE', '', '', 'CENTRO HISTORICO', '', '', 'D.F.', 0),
(50, 'PLAZA DE LA CONSTITUCIÓN', '', '', 'CTRO CD DE MEX A. 1', '', '', 'D.F.', 0),
(51, 'PLAZA DE LA CONSTITUCION  TERCER PISO', '1', '', 'CENTRO', '', '', ' D.F.', 0),
(52, 'CORDOBA', '45', '', 'ROMA', '', '', 'D.F.', 0),
(53, 'VIADUCTO TLALPAN', '100', '', 'ARENAL TEPEPAN', '', '', 'DISTRITO FEDERAL', 0),
(54, 'PLAZA DE LA CONSTITUCION', '', '', 'CENTRO', '', '', 'DISTRITO FEDERAL', 0),
(55, 'PLAZA DE LA CONSTITUCION', '', '', 'AREA 1 CENTRO DE LA CIUDAD DE MEXICO', 'CUAUHTEMOC', '', 'DISTRITO FEDERAL', 0),
(56, 'PLAZA DE LA CONSTITUCION', '', '', 'CENTRO DE LA CIUDAD DE MEXICO AREA 1', '', '', 'DISTRITO FEDERAL', 0),
(57, 'PLAZA DE LA CONSTITUCION', '', '', 'CENTRO DE LA CIUDAD DE MEXICO AREA 1', '', '', 'DISTRITO FEDERAL', 0),
(58, 'PLAZA DE LA CONSTITUCION', '', '', 'CENTRO DE LA CD. DE MEXICO,AREA 1 DISTRITO FEDERAL', '', '', 'DISTRITO FEDERAL', 0),
(59, 'INSURGENTES SUR', '3700', '', 'INSURGENTES CUICUILCO', '', '', 'DISTRITO FEDERAL', 0),
(60, 'RÍO CUAUTITLÁN', '51', '', 'COLINAS DEL LAGO', '', '', 'ESTADO DE MÉXICO', 0),
(61, 'Benito Juarez', '11', '', 'El carmen', 'Toluca', 'Toluca', 'Azteca', 50276),
(62, 'MAR DEL CORAL MZ. 1 LT. 15 14', '', '', 'FUENTES DE ECATEPEC', 'ECATEPEC', '', 'ESTADO DE MEXICO', 0),
(66, '1', '1', '1', '1', '1', 'la concha', '1', 1222),
(67, '123', '122', '123', '321', '123', '12', '123', 123),
(68, 'Hacienda Fuentes', '0', '265', 'H.Fuentes', 'Calimaya', 'Calimaya', 'Mexico', 52231),
(69, 'Paseo San Isidro', '383', '2', 'Metepec', 'Metepec', 'Metepec', 'Mexico', 99999),
(70, 'Calle1', '1', '2', 'Colonia', 'Municipio', 'Cuidad', 'Estado', 52140),
(72, 'Calle1', '12', '21', 'colonia', 'metepec', 'metepec', 'Mexico', 11111),
(75, '', '', '', '', '', '', '', 0),
(76, 'NULL', NULL, NULL, 'NULL', 'NULL', NULL, NULL, NULL),
(77, 'NULL', NULL, NULL, 'NULL', 'NULL', NULL, NULL, NULL),
(78, 'NULL', NULL, NULL, 'NULL', 'NULL', NULL, NULL, NULL),
(79, 'Paseo', '999', '', 'Santiago', 'Aaragon', 'Mexico', 'Mexico', 0);

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `empresa_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `empresa_razonsocial` varchar(200) NOT NULL,
  `empresa_rfc` varchar(200) NOT NULL,
  `empresa_domicilio_fiscal` bigint(20) NOT NULL,
  PRIMARY KEY (`empresa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `empresa`
--

INSERT INTO `empresa` (`empresa_id`, `empresa_razonsocial`, `empresa_rfc`, `empresa_domicilio_fiscal`) VALUES
(1, 'MOGEL FLUÍDOS SA DE CV', 'prom111111111', 0),
(2, 'EMPRESA2', 'ASFD999999999', 0);

-- --------------------------------------------------------

--
-- Table structure for table `entrada_material`
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
-- Table structure for table `generales`
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
  `email` varchar(20) NOT NULL DEFAULT 'NULL',
  PRIMARY KEY (`generales_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla de GENERALES de USUARIO, CONTACTO, ETC' AUTO_INCREMENT=18 ;

--
-- Dumping data for table `generales`
--

INSERT INTO `generales` (`generales_id`, `nombre`, `apel_p`, `apel_m`, `tel_trabajo`, `ext_tel_trabajo`, `tel_casa`, `tel_cel`, `email`) VALUES
(1, 'Antonio', 'Butron', 'Luz', '5095069', NULL, NULL, NULL, 'juan@gmail.com'),
(2, 'Noe', 'villa', 'Perez', '1123', '', '312', '', 'aa@g.com'),
(3, 'sd', 'asdf', 'fdqe', '11223', '', '3455', '', '123'),
(4, '', '', '', '', '', '', '', ''),
(5, 'asdf', 'asdf', 'asdf', '123', '321', '123', '123', 'a@dfsa.con'),
(7, 'Juanito', 'Robles', 'Chapoy', '11', '22', '33', '44', 'u@u.com'),
(8, 'Mayaraa', 'Alcantara', 'Gomez', '2793400', '3084', '2163148', '7229999999', 'a@maya.com'),
(9, 'Juan', 'ButrÃ³n', 'Luz', '5095069', '0', '0', '0', 'a@hotmail.com'),
(10, 'DonCusotdio', 'Paterno', 'Materno', '9999', '0', '111', '222', 'custodio@mail.com'),
(11, 'Usuario', 'Normal', 'Sencillo', '1111', '2222', '3333', '4444', 'user@promex.com'),
(15, 'Juanito', 'Perez', 'Dominguez', '2', '3', '4', '', 'a@e.com'),
(16, 'Juan', 'Gomez', 'Perez', '12345678', '123', ' ', ' ', 'juan.gomez@corporati'),
(17, 'JosÃ©', 'Torrez', 'Materno', '11232131', '', '123', '', 'asdf@a.com');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `material_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `material_descripcion` varchar(100) NOT NULL DEFAULT 'NULL',
  `material_tipo` bigint(20) NOT NULL,
  `id_unidad` bigint(10) DEFAULT NULL,
  `material_precio` float NOT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla Material' AUTO_INCREMENT=19 ;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_id`, `material_descripcion`, `material_tipo`, `id_unidad`, `material_precio`) VALUES
(7, 'material1', 3, 1, 150),
(8, 'material2', 2, 1, 20),
(9, 'Almacen2', 1, 2, 0),
(10, 'material1', 1, 2, 0),
(11, 'Almacen2', 3, 5, 400),
(12, 'Almacen2', 3, 2, 0),
(13, 'Refacciones', 3, 3, 0),
(14, 'Cilindro', 3, 3, 0),
(15, 'Camillas', 2, 3, 0),
(16, 'Aire comprimido', 2, 3, 0),
(17, 'Silicon', 1, 1, 0),
(18, 'Tablero Fire Lite 9200', 2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `moneda`
--

CREATE TABLE IF NOT EXISTS `moneda` (
  `moneda_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `moneda_descripcion` varchar(200) NOT NULL,
  `moneda_prefijo` varchar(50) NOT NULL,
  `moneda_tipo_cambio` double NOT NULL,
  PRIMARY KEY (`moneda_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `moneda`
--

INSERT INTO `moneda` (`moneda_id`, `moneda_descripcion`, `moneda_prefijo`, `moneda_tipo_cambio`) VALUES
(1, 'Pesos Mexicanos', 'MXN', 1),
(2, 'Dolar Americano', ' USD', 0.076932);

-- --------------------------------------------------------

--
-- Table structure for table `nota_credito`
--

CREATE TABLE IF NOT EXISTS `nota_credito` (
  `nota_credito_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `orden_salida_id` bigint(20) NOT NULL,
  PRIMARY KEY (`nota_credito_id`),
  KEY `orden_salida_id` (`orden_salida_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla NOTA CREDITO' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orden_compra`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla ORDEN_COMPRA' AUTO_INCREMENT=27 ;

--
-- Dumping data for table `orden_compra`
--

INSERT INTO `orden_compra` (`orden_compra_id`, `usuario_id`, `proveedor_id`, `fecha_compra`, `fecha_entrega_prometida`, `fecha_entrega`, `orden_observaciones`, `moneda_id`, `orden_divisa_dia`, `orden_edo`) VALUES
(2, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 1),
(3, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 1),
(4, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 1),
(5, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 1),
(6, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 1),
(7, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 1),
(8, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 1),
(9, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 1),
(10, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 1),
(11, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 1),
(12, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 1),
(13, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 1),
(14, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 1),
(15, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 0, 0, 1),
(16, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', 'dddd', 1, 1, 1),
(17, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', 'ffff', 1, 1, 1),
(18, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 1, 1, 1),
(19, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '2013-08-23', '', 1, 1, 1),
(20, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 1, 1, 1),
(21, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', 'fffffff', 1, 1, 1),
(22, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '0000-00-00', '', 1, 1, 1),
(23, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '08/14/2013', '', 1, 1, 1),
(24, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '08/03/2013', 'ASDF', 1, 1, 1),
(25, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '08/02/2013', 'a', 1, 1, 1),
(26, 'usuario1', 2, NULL, '0000-00-00 00:00:00', '08/09/2013', 'hola', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orden_salida`
--

CREATE TABLE IF NOT EXISTS `orden_salida` (
  `orden_salida_id` bigint(20) NOT NULL,
  `pedido_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`orden_salida_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla Orden de Salida';

-- --------------------------------------------------------

--
-- Table structure for table `pantalla`
--

CREATE TABLE IF NOT EXISTS `pantalla` (
  `pantalla_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pantalla_nombre` varchar(10) NOT NULL DEFAULT 'NULL',
  `pantalla_descripcion` varchar(50) NOT NULL,
  `pantalla_area` varchar(20) NOT NULL COMMENT 'centro de costos',
  `pantalla_url` varchar(50) NOT NULL DEFAULT 'NULL',
  PRIMARY KEY (`pantalla_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla PANTALLA' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pantalla`
--

INSERT INTO `pantalla` (`pantalla_id`, `pantalla_nombre`, `pantalla_descripcion`, `pantalla_area`, `pantalla_url`) VALUES
(1, 'Materiales', 'Materiales', 'Almacen', 'material_busqueda.php');

-- --------------------------------------------------------

--
-- Table structure for table `partida`
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
-- Table structure for table `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `pedido_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cotizacion_id` bigint(20) DEFAULT NULL,
  `sucursal_id` bigint(20) NOT NULL,
  `pedido_fecha_creacion` datetime NOT NULL,
  `pedida_fecha_entrega` datetime NOT NULL,
  `pedido_estado` tinyint(4) NOT NULL DEFAULT '0',
  `pedido_obs` varchar(100) DEFAULT NULL,
  `contrato_id` varchar(20) DEFAULT NULL,
  `partida_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`pedido_id`),
  KEY `cotizacion_id` (`cotizacion_id`),
  KEY `sucursal_id` (`sucursal_id`),
  KEY `partida_id` (`partida_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla Pedidos' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `perfil_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `perfil_nombre` varchar(20) NOT NULL DEFAULT '0',
  `perfil_descripcion` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`perfil_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla PERFIL' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `perfil`
--

INSERT INTO `perfil` (`perfil_id`, `perfil_nombre`, `perfil_descripcion`) VALUES
(1, 'PerfilInicial', 0),
(2, 'UserNomal', 0);

-- --------------------------------------------------------

--
-- Table structure for table `perfil_pantalla`
--

CREATE TABLE IF NOT EXISTS `perfil_pantalla` (
  `perfil_pantalla_id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil_id` bigint(20) NOT NULL,
  `pantalla_id` bigint(20) NOT NULL,
  PRIMARY KEY (`perfil_pantalla_id`),
  KEY `perfil_id` (`perfil_id`),
  KEY `pantalla_id` (`pantalla_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `prospecto`
--

CREATE TABLE IF NOT EXISTS `prospecto` (
  `id_prospecto` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) DEFAULT NULL,
  `fecha_prospecto` date DEFAULT NULL,
  `carta_presentacion` tinyint(1) NOT NULL,
  `material_multimedia` tinyint(1) NOT NULL,
  `visita_cliente` tinyint(1) NOT NULL,
  `cotizacion` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_prospecto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `prospecto`
--

INSERT INTO `prospecto` (`id_prospecto`, `id_cliente`, `fecha_prospecto`, `carta_presentacion`, `material_multimedia`, `visita_cliente`, `cotizacion`) VALUES
(1, 1, '2013-06-17', 1, 1, 0, 0),
(2, 10, '2013-06-13', 1, 0, 0, 1),
(3, 12, '2013-06-01', 0, 0, 1, 1),
(4, 3, '2013-06-19', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `proveedor`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla PROVEEDOR' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `proveedor`
--

INSERT INTO `proveedor` (`proveedor_id`, `proveedor_rs`, `proveedor_rfc`, `domicilio_id`, `generales_id`) VALUES
(1, 'POLVO', 'AAGM8801279M', 61, 8),
(2, 'EQUIPO SEGURIDAD', 'ASDF12344333', 79, 17);

-- --------------------------------------------------------

--
-- Table structure for table `ruta`
--

CREATE TABLE IF NOT EXISTS `ruta` (
  `ruta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `orden_salida_id` bigint(20) NOT NULL,
  `recurso_id` bigint(20) DEFAULT NULL,
  `fecha_ruta` datetime NOT NULL,
  `ruta_edo` tinyint(4) DEFAULT NULL COMMENT 'estado (entregado o no entregado)',
  PRIMARY KEY (`ruta_id`),
  KEY `orden_salida_id` (`orden_salida_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla RUTA' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salida_material`
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
-- Table structure for table `sucursal`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tabla normalizada domicilio de cliente' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sucursal`
--

INSERT INTO `sucursal` (`sucursal_id`, `cliente_id`, `tipo_establecimiento`, `clave_nombre`, `domicilio_id`, `generales_id`, `contacto_ventas_id`) VALUES
(1, '11', 1, 'Sucursal-Prom', 75, 15, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transporte`
--

CREATE TABLE IF NOT EXISTS `transporte` (
  `transporte_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transporte_nombre` varchar(50) DEFAULT NULL,
  `transporte_placas` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`transporte_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `transporte`
--

INSERT INTO `transporte` (`transporte_id`, `transporte_nombre`, `transporte_placas`) VALUES
(2, 'RabÃ³n 9', 'QTG-537'),
(3, 'Torton 1', 'UGT-882');

-- --------------------------------------------------------

--
-- Table structure for table `unidades`
--

CREATE TABLE IF NOT EXISTS `unidades` (
  `id_unidad` bigint(20) NOT NULL AUTO_INCREMENT,
  `prefijo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_unidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Unidades de Medida' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `unidades`
--

INSERT INTO `unidades` (`id_unidad`, `prefijo`) VALUES
(1, 'ltr'),
(2, 'cm'),
(3, 'pza'),
(5, 'Lucas');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
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
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_password`, `generales_id`, `domicilio_id`, `usuario_rol`, `usuario_status`, `perfil_id`) VALUES
('Custodio1', 'custodio2', 10, 69, 1, 0, 1),
('usuario1', 'usuario2', 11, 70, 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario_cliente`
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
-- Constraints for dumped tables
--

--
-- Constraints for table `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `almacen_ibfk_1` FOREIGN KEY (`domicilio_id`) REFERENCES `domicilio` (`domicilio_id`);

--
-- Constraints for table `almacen_material`
--
ALTER TABLE `almacen_material`
  ADD CONSTRAINT `almacen_material_ibfk_1` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`almacen_id`),
  ADD CONSTRAINT `almacen_material_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`);

--
-- Constraints for table `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`cliente_domicilio_fiscal`) REFERENCES `domicilio` (`domicilio_id`);

--
-- Constraints for table `contacto_ventas`
--
ALTER TABLE `contacto_ventas`
  ADD CONSTRAINT `contacto_ventas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`),
  ADD CONSTRAINT `contacto_ventas_ibfk_2` FOREIGN KEY (`generales_id`) REFERENCES `generales` (`generales_id`);

--
-- Constraints for table `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`),
  ADD CONSTRAINT `cotizacion_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `cotizacion_ibfk_3` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  ADD CONSTRAINT `cotizacion_ibfk_4` FOREIGN KEY (`moneda_id`) REFERENCES `moneda` (`Moneda_Id`),
  ADD CONSTRAINT `cotizacion_ibfk_5` FOREIGN KEY (`contacto_ventas_id`) REFERENCES `contacto_ventas` (`contacto_ventas_id`);

--
-- Constraints for table `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`orden_compra_id`) REFERENCES `orden_compra` (`orden_compra_id`),
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`almacen_material_id`) REFERENCES `almacen_material` (`almacen_material_id`);

--
-- Constraints for table `detalle_cotizacion`
--
ALTER TABLE `detalle_cotizacion`
  ADD CONSTRAINT `detalle_cotizacion_ibfk_1` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizacion` (`cotizacion_id`);

--
-- Constraints for table `detalle_orden_salida`
--
ALTER TABLE `detalle_orden_salida`
  ADD CONSTRAINT `detalle_orden_salida_ibfk_1` FOREIGN KEY (`orden_salida_id`) REFERENCES `orden_salida` (`orden_salida_id`),
  ADD CONSTRAINT `detalle_orden_salida_ibfk_2` FOREIGN KEY (`detalle_pedido_id`) REFERENCES `detalle_pedido` (`detalle_pedido_id`);

--
-- Constraints for table `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`),
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`detalle_cotizacion_id`) REFERENCES `detalle_cotizacion` (`detalle_cotizacion_id`);

--
-- Constraints for table `entrada_material`
--
ALTER TABLE `entrada_material`
  ADD CONSTRAINT `entrada_material_ibfk_1` FOREIGN KEY (`almacen_material_id`) REFERENCES `almacen_material` (`almacen_material_id`),
  ADD CONSTRAINT `entrada_material_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `entrada_material_ibfk_3` FOREIGN KEY (`orden_compra_id`) REFERENCES `orden_compra` (`orden_compra_id`);

--
-- Constraints for table `nota_credito`
--
ALTER TABLE `nota_credito`
  ADD CONSTRAINT `nota_credito_ibfk_1` FOREIGN KEY (`orden_salida_id`) REFERENCES `orden_salida` (`orden_salida_id`);

--
-- Constraints for table `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD CONSTRAINT `orden_compra_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`proveedor_id`);

--
-- Constraints for table `orden_salida`
--
ALTER TABLE `orden_salida`
  ADD CONSTRAINT `orden_salida_ibfk_1` FOREIGN KEY (`orden_salida_id`) REFERENCES `pedido` (`pedido_id`);

--
-- Constraints for table `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`contrato_id`) REFERENCES `contrato` (`contrato_id`);

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizacion` (`cotizacion_id`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`sucursal_id`),
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`partida_id`) REFERENCES `partida` (`partida_id`);

--
-- Constraints for table `perfil_pantalla`
--
ALTER TABLE `perfil_pantalla`
  ADD CONSTRAINT `perfil_pantalla_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`perfil_id`),
  ADD CONSTRAINT `perfil_pantalla_ibfk_2` FOREIGN KEY (`pantalla_id`) REFERENCES `pantalla` (`pantalla_id`);

--
-- Constraints for table `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`domicilio_id`) REFERENCES `domicilio` (`domicilio_id`),
  ADD CONSTRAINT `proveedor_ibfk_2` FOREIGN KEY (`generales_id`) REFERENCES `generales` (`generales_id`);

--
-- Constraints for table `ruta`
--
ALTER TABLE `ruta`
  ADD CONSTRAINT `ruta_ibfk_1` FOREIGN KEY (`orden_salida_id`) REFERENCES `orden_salida` (`orden_salida_id`);

--
-- Constraints for table `salida_material`
--
ALTER TABLE `salida_material`
  ADD CONSTRAINT `salida_material_ibfk_1` FOREIGN KEY (`almacen_material_id`) REFERENCES `almacen_material` (`almacen_material_id`);

--
-- Constraints for table `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `sucursal_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`),
  ADD CONSTRAINT `sucursal_ibfk_2` FOREIGN KEY (`domicilio_id`) REFERENCES `domicilio` (`domicilio_id`),
  ADD CONSTRAINT `sucursal_ibfk_3` FOREIGN KEY (`contacto_ventas_id`) REFERENCES `contacto_ventas` (`contacto_ventas_id`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`generales_id`) REFERENCES `generales` (`generales_id`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`domicilio_id`) REFERENCES `domicilio` (`domicilio_id`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`perfil_id`);

--
-- Constraints for table `usuario_cliente`
--
ALTER TABLE `usuario_cliente`
  ADD CONSTRAINT `usuario_cliente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `usuario_cliente_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`);


alter table COTIZACION add column cotizacion_tiempo_entrega int(3) null default=5;
alter table COTIZACION add column cotizacion_cond_pago varchar(200) null default "Ver Anexo";

CREATE TABLE IF NOT EXISTS `configuracion` (
  
  `servidor_smtp` varchar(100) DEFAULT NULL COMMENT 'servidor de correo de preferencia smtp',
  `puerto` int(6) DEFAULT NULL COMMENT 'puerto servidor correo de preferencia',
  `usuario_correo_notificaciones` varchar(100) DEFAULT NULL COMMENT 'usuario correo',
  `contrasena_usuario_correo_notificaciones` varchar(30) DEFAULT NULL COMMENT 'contrasena correo',
  `frecuencia_notificaciones_pago` varchar(100) DEFAULT NULL COMMENT 'frecuencia de notificaciones de pedidos sin pagar(segundos)',
  `frecuencia_notificaciones_cotizacion_a_pedido` varchar(100) DEFAULT NULL COMMENT 'frecuencia notificaciones de cotizaciones sin ser pedidos(segundos)',
  `frecuencia_notificaciones_material_minimo` varchar(100) DEFAULT NULL COMMENT 'frecuencia recordatorio material terminado(segundos)',
  `frecuencia_notificaciones_material_caduco` varchar(100) DEFAULT NULL COMMENT 'frecuencia recordatorio material caduco(segundos)'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

INSERT INTO configuracion (servidor_smtp, puerto, 
                       usuario_correo_notificaciones, contrasena_usuario_correo_notificaciones,
                       frecuencia_notificaciones_pago, frecuencia_notificaciones_cotizacion_a_pedido,
                       frecuencia_notificaciones_material_minimo, frecuencia_notificaciones_material_caduco)
            values ('smtp.soetecnologia.com', 587, 'notificaciones@soetecnologia.com', 'Notificashion2013', '600', '600', '600','600');

SELECT servidor_smtp, puerto, 
                       usuario_correo_notificaciones, contrasena_usuario_correo_notificaciones,
                       frecuencia_notificaciones_pago, frecuencia_notificaciones_cotizacion_a_pedido,
                       frecuencia_notificaciones_material_minimo, frecuencia_notificaciones_material_caduco from configuracion
SELECT material_id, almacen_id, cantidad_actual from almacen_material where cantidad_actual<minimo       
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
