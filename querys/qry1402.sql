ALTER TABLE  `taller_solicitud` ADD  `tipo` TINYINT( 4 ) NOT NULL AFTER  `folio`

ALTER TABLE  `taller_solicitud` CHANGE  `pedido_id`  `pedido_id` BIGINT( 20 ) NULL