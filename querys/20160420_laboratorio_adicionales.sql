-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-04-2016 a las 21:23:36
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mogel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE IF NOT EXISTS `LABORATORIO_ADICIONALES` (
`id_laboratorio_adicional` bigint(20) NOT NULL,
  `tipo_orden` tinyint(4) NOT NULL COMMENT '0=compras; 1=pedidos',
  `id_producto` bigint(20) NOT NULL,
  `id_empresa` bigint(20) NOT NULL,
  `id_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario_rev` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_unidad` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cantidad_rev` int(11) NOT NULL,
  `servicio` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ini` datetime NOT NULL,
  `fecha_rev` datetime NOT NULL,
  `certificado` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `laboratorio`
--


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `LABORATORIO_ADICIONALES`
 ADD PRIMARY KEY (`id_laboratorio_adicional`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `LABORATORIO_ADICIONALES`
MODIFY `id_laboratorio_adicional` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
