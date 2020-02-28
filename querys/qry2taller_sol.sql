ALTER TABLE `detalle_taller_solicitud` CHANGE `producto_id` `producto_id` BIGINT( 20 ) NOT NULL 


ALTER TABLE `detalle_taller_solicitud` ADD CONSTRAINT `taller_solicitud_ibfk1` FOREIGN KEY ( `producto_id` ) 
REFERENCES `promex`.`material` (`material_id`) ON DELETE RESTRICT ON UPDATE RESTRICT

ALTER TABLE  `taller_solicitud` CHANGE  `pedido_id`  `pedido_id` BIGINT( 20 ) NOT NULL ;

ALTER TABLE  `taller_solicitud` ADD CONSTRAINT  `taller_solicitud_ibfk3` FOREIGN KEY (  `pedido_id` ) REFERENCES `promex`.`detalle_pedido` (
`pedido_id`
);

ALTER TABLE  `taller_solicitud` CHANGE  `almacen_id`  `almacen_id` BIGINT( 20 ) NOT NULL ;

ALTER TABLE  `taller_solicitud` ADD CONSTRAINT  `taller_solicitud_ibfk2` FOREIGN KEY (  `almacen_id` ) REFERENCES  `promex`.`almacen` (
`almacen_id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;
