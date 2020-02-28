ALTER TABLE `detalle_pedido` DROP FOREIGN KEY `detalle_pedido_ibfk_1` ;
ALTER TABLE `detalle_pedido` DROP FOREIGN KEY `detalle_pedido_ibfk_2` ;
ALTER TABLE `material` ADD `material_ubicacion` TINYINT NOT NULL DEFAULT '0';



ALTER TABLE `detalle_pedido` ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY ( `detalle_cotizacion_id` ) REFERENCES `promex`.`detalle_cotizacion` (
`detalle_cotizacion_id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;