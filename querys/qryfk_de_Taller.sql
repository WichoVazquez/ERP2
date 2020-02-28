ALTER TABLE  `detalle_taller_solicitud` DROP FOREIGN KEY  `taller_solicitud_ibfk2` ;

ALTER TABLE  `detalle_taller_solicitud` ADD CONSTRAINT  `taller_solicitud_ibfk2` FOREIGN KEY (  `detalle_taller_solicitud_id` ) REFERENCES `promex`.`taller_solicitud` (
`taller_id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;




ALTER TABLE `detalle_taller_solicitud`
  DROP `observacion`,
  DROP `status`;
