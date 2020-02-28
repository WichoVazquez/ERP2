CREATE TABLE IF NOT EXISTS `factura` (
  `factura_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `factura_fecha` datetime NOT NULL,
  `factura_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'estado (completo o incompleto)',
  `factura_descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'NULL',
  `pedido_id` bigint(20) NOT NULL,
  PRIMARY KEY (`factura_id`),
  KEY `pedido_pantalla_ibfk_2` (`pedido_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

ALTER TABLE `detalle_pedido`
  ADD `factura_id` bigint(20) NOT NULL,
  ADD KEY `factura_id` (`factura_id`),
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`),
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`detalle_cotizacion_id`) REFERENCES `detalle_cotizacion` (`detalle_cotizacion_id`),
  ADD CONSTRAINT `detalle_pedido_ifbk_3 ` FOREIGN KEY(`factura_id`) REFERENCES `factura`(`factura_id`);

ALTER TABLE `factura`
  ADD CONSTRAINT `pedido_pantalla_ibfk_2` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`);

 ALTER TABLE `pedido`
 ADD `folio_pedido` VARCHAR( 20 ) NULL ;

 ALTER TABLE `cotizacion` ADD `cotizacion_recotizada` BIGINT NOT NULL ;