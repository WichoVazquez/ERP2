
--SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
--SET time_zone = "-06:00";
--create user 'promex_master'@'localhost' identified by 'MePrendio';
--grant select, insert, update, delete on PROMEX.* to 'promex_master'@'localhost';
-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'CLIENTE'
-- CLIENTE PROMEX
-- ---

DROP TABLE IF EXISTS `CLIENTE`;
    
CREATE TABLE `CLIENTE` (
  `cliente_id` VARCHAR(10) NOT NULL,
  `cliente_razonsocial` VARCHAR(50) NOT NULL,
  `cliente_rfc` VARCHAR(12) NOT NULL DEFAULT 'NULL',
  `cliente_domicilio_fiscal` BIGINT NOT NULL,
  PRIMARY KEY (`cliente_id`)
) COMMENT 'CLIENTE PROMEX';

-- ---
-- Table 'CONTACTO_VENTAS'
-- Contacto para Personal de Ventas
-- ---

DROP TABLE IF EXISTS `CONTACTO_VENTAS`;
    
CREATE TABLE `CONTACTO_VENTAS` (
  `contacto_ventas_id` BIGINT NOT NULL AUTO_INCREMENT,
  `cliente_id` VARCHAR(10) NOT NULL DEFAULT 'NULL',
  `generales_id` BIGINT NOT NULL,
  PRIMARY KEY (`contacto_ventas_id`)
) COMMENT 'Contacto para Personal de Ventas';

-- ---
-- Table 'DOMICILIO'
-- 
-- ---

DROP TABLE IF EXISTS `DOMICILIO`;
    
CREATE TABLE `DOMICILIO` (
  `domicilio_id` BIGINT NOT NULL AUTO_INCREMENT,
  `domicilio_calle` VARCHAR(50) NOT NULL,
  `domicilio_num_ext` VARCHAR(20) NOT NULL,
  `domicilio_num_int` VARCHAR(20) NULL DEFAULT NULL,
  `domicilio_colonia` VARCHAR NOT NULL,
  `domicilio_municipio` VARCHAR(50) NULL,
  `domicilio_ciudad` VARCHAR(50) NOT NULL,
  `domicilio_estado` VARCHAR(10) NOT NULL,
  `domicilio_cp` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`domicilio_id`)
);

-- ---
-- Table 'SUCURSAL'
-- tabla normalizada domicilio de cliente
-- ---

DROP TABLE IF EXISTS `SUCURSAL`;
    
CREATE TABLE `SUCURSAL` (
  `sucursal_id` TINYINT NOT NULL AUTO_INCREMENT,
  `cliente_id` VARCHAR(10) NOT NULL,
  `domicilio_id` BIGINT NOT NULL,
  `generales_id` BIGINT NOT NULL,
  PRIMARY KEY (`sucursal_id`)
) COMMENT 'tabla normalizada domicilio de cliente';

-- ---
-- Table 'COTIZACION'
-- Tabla de Cotizaciones
-- ---

DROP TABLE IF EXISTS `COTIZACION`;
    
CREATE TABLE `COTIZACION` (
  `cotizacion_id` BIGINT NULL AUTO_INCREMENT DEFAULT NULL,
  `cotización_fecha_envio` DATETIME(10) NOT NULL,
  `cotizacion_edo` TINYINT NOT NULL DEFAULT 0,
  `cliente_id` VARCHAR(10) NOT NULL DEFAULT 'NULL',
  `usuario_id` VARCHAR(10) NOT NULL DEFAULT 'NULL',
  PRIMARY KEY (`cotizacion_id`)
) COMMENT 'Tabla de Cotizaciones';

-- ---
-- Table 'PEDIDO'
-- Tabla Pedidos
-- ---

DROP TABLE IF EXISTS `PEDIDO`;
    
CREATE TABLE `PEDIDO` (
  `pedido_id` BIGINT NOT NULL AUTO_INCREMENT,
  `cotizacion_id` BIGINT NULL DEFAULT NULL,
  `sucursal_id` TINYINT NOT NULL DEFAULT NULL,
  `pedido_fecha_creacion` DATETIME NOT NULL,
  `pedida_fecha_entrega` DATETIME NOT NULL DEFAULT 'NULL',
  `pedido_estado` TINYINT NOT NULL DEFAULT 0,
  `pedido_obs` VARCHAR(100) NULL DEFAULT NULL,
  `contrato_id` VARCHAR(20) NULL DEFAULT NULL,
  `partida_id` BIGINT NULL DEFAULT NULL,
  PRIMARY KEY (`pedido_id`)
) COMMENT 'Tabla Pedidos';

-- ---
-- Table 'DETALLE_COTIZACION'
-- DETALLE COTIZACION
-- ---

DROP TABLE IF EXISTS `DETALLE_COTIZACION`;
    
CREATE TABLE `DETALLE_COTIZACION` (
  `detalle_cotizacion_id` BIGINT NOT NULL AUTO_INCREMENT,
  `producto_id` BIGINT NOT NULL,
  `cantidad` DECIMAL NOT NULL,
  `cotizacion_id` BIGINT NOT NULL,
  `precio_venta` DECIMAL(10) NOT NULL,
  PRIMARY KEY (`detalle_cotizacion_id`)
) COMMENT 'DETALLE COTIZACION';

-- ---
-- Table 'USUARIO'
-- tabla USUARIO
-- ---

DROP TABLE IF EXISTS `USUARIO`;
    
CREATE TABLE `USUARIO` (
  `usuario_id` VARCHAR(10) NOT NULL DEFAULT 'NULL',
  `usuario_password` VARCHAR(20) NOT NULL,
  `generales_id` BIGINT NOT NULL DEFAULT NULL,
  `domicilio_id` BIGINT NULL DEFAULT NULL,
  `usuario_rol` TINYINT NOT NULL DEFAULT 2 COMMENT 'rol (0-administrador, 1-custodio, 2-usuario)',
  `usuario_status` TINYINT NOT NULL DEFAULT 0 COMMENT 'estado (activo, bloqueado)',
  `perfil_id` BIGINT NOT NULL DEFAULT NULL,
  PRIMARY KEY (`usuario_id`)
) COMMENT 'tabla USUARIO';

-- ---
-- Table 'USUARIO_CLIENTE'
-- Tabla Relación USUARIO_CLIENTE
-- ---

DROP TABLE IF EXISTS `USUARIO_CLIENTE`;
    
CREATE TABLE `USUARIO_CLIENTE` (
  `usuario_cliente_id` BIGINT NOT NULL AUTO_INCREMENT,
  `usuario_id` VARCHAR(10) NOT NULL,
  `cliente_id` VARCHAR(10) NOT NULL,
  `usuario_cliente_nivel` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`usuario_cliente_id`)
) COMMENT 'Tabla Relación USUARIO_CLIENTE';

-- ---
-- Table 'GENERALES'
-- Tabla de GENERALES de USUARIO, CONTACTO, ETC
-- ---

DROP TABLE IF EXISTS `GENERALES`;
    
CREATE TABLE `GENERALES` (
  `generales_id` BIGINT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `apel_p` VARCHAR(50) NOT NULL,
  `apel_m` VARCHAR(50) NULL,
  `tel_trabajo` VARCHAR(12) NULL,
  `ext_tel_trabajo` VARCHAR(12) NULL DEFAULT NULL,
  `tel_casa` VARCHAR(12) NULL DEFAULT NULL,
  `tel_cel` VARCHAR(12) NULL DEFAULT NULL,
  `email` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`generales_id`)
) COMMENT 'Tabla de GENERALES de USUARIO, CONTACTO, ETC';

-- ---
-- Table 'PERFIL'
-- Tabla PERFIL
-- ---

DROP TABLE IF EXISTS `PERFIL`;
    
CREATE TABLE `PERFIL` (
  `perfil_id` BIGINT NOT NULL AUTO_INCREMENT,
  `perfil_nombre` VARCHAR(20) NOT NULL DEFAULT '0',
  `perfil_descripcion` TINYINT NULL DEFAULT NULL,
  PRIMARY KEY (`perfil_id`)
) COMMENT 'Tabla PERFIL';

-- ---
-- Table 'PANTALLA'
-- Tabla PANTALLA
-- ---

DROP TABLE IF EXISTS `PANTALLA`;
    
CREATE TABLE `PANTALLA` (
  `pantalla_id` BIGINT NOT NULL AUTO_INCREMENT,
  `pantalla_nombre` VARCHAR(10) NOT NULL,
  `pantalla_descripcion` VARCHAR(50) NOT NULL,
  `pantalla_area` VARCHAR(20) NOT NULL COMMENT 'centro de costos',
  `pantalla_url` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`pantalla_id`)
) COMMENT 'Tabla PANTALLA';

-- ---
-- Table 'PERFIL_PANTALLA'
-- 
-- ---

DROP TABLE IF EXISTS `PERFIL_PANTALLA`;
    
CREATE TABLE `PERFIL_PANTALLA` (
  `perfil_pantalla_id` INT NOT NULL AUTO_INCREMENT,
  `perfil_id` BIGINT NOT NULL,
  `pantalla_id` BIGINT NOT NULL DEFAULT NULL,
  PRIMARY KEY (`perfil_pantalla_id`)
);

-- ---
-- Table 'ALMACEN'
-- tabla Almacen
-- ---

DROP TABLE IF EXISTS `ALMACEN`;
    
CREATE TABLE `ALMACEN` (
  `almacen_id` BIGINT NOT NULL AUTO_INCREMENT,
  `domicilio_id` BIGINT NOT NULL,
  PRIMARY KEY (`almacen_id`)
) COMMENT 'tabla Almacen';

-- ---
-- Table 'MATERIAL'
-- tabla Material
-- ---

DROP TABLE IF EXISTS `MATERIAL`;
    
CREATE TABLE `MATERIAL` (
  `material_id` BIGINT NOT NULL AUTO_INCREMENT,
  `material_descripcion` VARCHAR(100) NOT NULL,
  `material_tipo` BIGINT NOT NULL,
  `material_unidad` VARCHAR NULL DEFAULT NULL,
  PRIMARY KEY (`material_id`)
) COMMENT 'tabla Material';

-- ---
-- Table 'ALMACEN_MATERIAL'
-- tabla ALMACEN_MATERIAL
-- ---

DROP TABLE IF EXISTS `ALMACEN_MATERIAL`;
    
CREATE TABLE `ALMACEN_MATERIAL` (
  `almacen_material_id` BIGINT NOT NULL AUTO_INCREMENT,
  `almacen_id` BIGINT NOT NULL,
  `material_id` BIGINT NOT NULL DEFAULT NULL,
  `cantidad_actual` DECIMAL NOT NULL DEFAULT 0,
  `maximo` DECIMAL NOT NULL DEFAULT 0,
  `minimo` DECIMAL NULL DEFAULT 0,
  PRIMARY KEY (`almacen_material_id`)
) COMMENT 'tabla ALMACEN_MATERIAL';

-- ---
-- Table 'ENTRADA_MATERIAL'
-- Tabla Entrada Material
-- ---

DROP TABLE IF EXISTS `ENTRADA_MATERIAL`;
    
CREATE TABLE `ENTRADA_MATERIAL` (
  `entrada_material_id` VARCHAR NOT NULL AUTO_INCREMENT,
  `almacen_material_id` BIGINT NOT NULL,
  `fecha_ingreso` TINYINT NULL DEFAULT NULL,
  `cantidad_ingreso` DECIMAL NOT NULL DEFAULT 0,
  `usuario_id` VARCHAR(10) NOT NULL,
  `material_obs` VARCHAR(100) NOT NULL DEFAULT 'NULL',
  `orden_compra_id` BIGINT NOT NULL,
  `entrada_folio` VARCHAR(20) NOT NULL COMMENT 'folio factura, remision, etc',
  PRIMARY KEY (`entrada_material_id`)
) COMMENT 'Tabla Entrada Material';

-- ---
-- Table 'ORDEN_COMPRA'
-- Tabla ORDEN_COMPRA
-- ---

DROP TABLE IF EXISTS `ORDEN_COMPRA`;
    
CREATE TABLE `ORDEN_COMPRA` (
  `orden_compra_id` BIGINT NOT NULL AUTO_INCREMENT,
  `proveedor_id` BIGINT NULL DEFAULT NULL,
  `fecha_compra` TIMESTAMP NULL DEFAULT NULL,
  `fecha_entrega_prometida` TIMESTAMP NOT NULL,
  `fecha_entrega` DATETIME NOT NULL,
  `orden_compra_obs` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`orden_compra_id`)
) COMMENT 'Tabla ORDEN_COMPRA';

-- ---
-- Table 'DETALLE_COMPRA'
-- Tabla DETALLE ORDEN COMPRA
-- ---

DROP TABLE IF EXISTS `DETALLE_COMPRA`;
    
CREATE TABLE `DETALLE_COMPRA` (
  `detalle_id` BIGINT NOT NULL AUTO_INCREMENT DEFAULT NULL,
  `orden_compra_id` BIGINT NOT NULL,
  `almacen_material_id` BIGINT NOT NULL,
  `detalle_compra_cantidad` TINYINT NOT NULL DEFAULT 0,
  `detalle_compra_cantidad_s` DECIMAL NOT NULL DEFAULT 0,
  PRIMARY KEY (`detalle_id`)
) COMMENT 'Tabla DETALLE ORDEN COMPRA';

-- ---
-- Table 'PROVEEDOR'
-- Tabla PROVEEDOR
-- ---

DROP TABLE IF EXISTS `PROVEEDOR`;
    
CREATE TABLE `PROVEEDOR` (
  `proveedor_id` BIGINT NOT NULL AUTO_INCREMENT,
  `proveedor_rs` VARCHAR(100) NOT NULL,
  `proveedor_rfc` VARCHAR(12) NOT NULL,
  `domicilio_id` BIGINT NOT NULL,
  `generales_id` BIGINT NOT NULL,
  PRIMARY KEY (`proveedor_id`)
) COMMENT 'Tabla PROVEEDOR';

-- ---
-- Table 'SALIDA_MATERIAL'
-- Tabla SALIDA de MATERIAL
-- ---

DROP TABLE IF EXISTS `SALIDA_MATERIAL`;
    
CREATE TABLE `SALIDA_MATERIAL` (
  `salida_material_id` BIGINT NOT NULL AUTO_INCREMENT,
  `almacen_material_id` BIGINT NOT NULL,
  `cantidad_salida` DECIMAL NULL DEFAULT NULL,
  `usuario_id` VARCHAR(10) NOT NULL,
  `salida_obs` TINYINT NULL DEFAULT NULL,
  PRIMARY KEY (`salida_material_id`)
) COMMENT 'Tabla SALIDA de MATERIAL';

-- ---
-- Table 'ORDEN_SALIDA'
-- Tabla Orden de Salida
-- ---

DROP TABLE IF EXISTS `ORDEN_SALIDA`;
    
CREATE TABLE `ORDEN_SALIDA` (
  `orden_salida_id` BIGINT NOT NULL,
  `pedido_id` TINYINT NULL DEFAULT NULL,
  PRIMARY KEY (`orden_salida_id`)
) COMMENT 'Tabla Orden de Salida';

-- ---
-- Table 'CONTRATO'
-- Tabla Contrato
-- ---

DROP TABLE IF EXISTS `CONTRATO`;
    
CREATE TABLE `CONTRATO` (
  `contrato_id` VARCHAR(20) NOT NULL,
  `cliente_id` VARCHAR(10) NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_terminacion` DATE NOT NULL,
  `contrato_mt` DECIMAL NULL DEFAULT NULL COMMENT 'monto total',
  PRIMARY KEY (`contrato_id`)
) COMMENT 'Tabla Contrato';

-- ---
-- Table 'PARTIDA'
-- Tabla PARTIDA por Contrato
-- ---

DROP TABLE IF EXISTS `PARTIDA`;
    
CREATE TABLE `PARTIDA` (
  `partida_id` BIGINT NOT NULL AUTO_INCREMENT,
  `partida_no` TINYINT NOT NULL COMMENT 'numero de partida',
  `producto_id` BIGINT NULL DEFAULT NULL,
  `partida_cantidad` DECIMAL NOT NULL COMMENT 'cantidad de producto por partida',
  `contrato_id` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`partida_id`)
) COMMENT 'Tabla PARTIDA por Contrato';

-- ---
-- Table 'RUTA'
-- Tabla RUTA
-- ---

DROP TABLE IF EXISTS `RUTA`;
    
CREATE TABLE `RUTA` (
  `ruta_id` BIGINT NOT NULL AUTO_INCREMENT,
  `orden_salida_id` BIGINT NOT NULL,
  `recurso_id` TINYINT NULL DEFAULT NULL,
  `fecha_ruta` DATE NOT NULL DEFAULT 'NULL',
  `ruta_edo` TINYINT NULL DEFAULT NULL COMMENT 'estado (entregado o no entregado)',
  PRIMARY KEY (`ruta_id`)
) COMMENT 'Tabla RUTA';

-- ---
-- Table 'DETALLE_PEDIDO'
-- Tabla DETALLE PEDIO
-- ---

DROP TABLE IF EXISTS `DETALLE_PEDIDO`;
    
CREATE TABLE `DETALLE_PEDIDO` (
  `detalle_pedido_id` BIGINT NOT NULL AUTO_INCREMENT,
  `pedido_id` BIGINT NOT NULL,
  `detalle_cotizacion_id` BIGINT NULL DEFAULT NULL COMMENT 'referencia al producto cotizado ',
  `cantidad_surtida` DECIMAL(10) NOT NULL DEFAULT 0,
  `detalle_pedido_status` TINYINT NOT NULL DEFAULT 0 COMMENT 'estado (completo o incompleto)',
  `detalle_pedido_obs` VARCHAR(100) NULL DEFAULT NULL COMMENT 'observaciones del estado del pedido',
  PRIMARY KEY (`detalle_pedido_id`)
) COMMENT 'Tabla DETALLE PEDIO';

-- ---
-- Table 'DETALLE_ORDEN_SALIDA'
-- Tabla DETALLE de ORDEN de SALIDA
-- ---

DROP TABLE IF EXISTS `DETALLE_ORDEN_SALIDA`;
    
CREATE TABLE `DETALLE_ORDEN_SALIDA` (
  `detalle_orden_compra_id` BIGINT NOT NULL AUTO_INCREMENT,
  `orden_salida_id` BIGINT NOT NULL COMMENT 'llave foranea de ORDEN de SALIDA',
  `cantidad_salida` DECIMAL NULL DEFAULT NULL,
  `detalle_pedido_id` TINYINT NULL DEFAULT NULL,
  PRIMARY KEY (`detalle_orden_compra_id`)
) COMMENT 'Tabla DETALLE de ORDEN de SALIDA';

-- ---
-- Table 'NOTA_CREDITO'
-- Tabla NOTA CREDITO
-- ---

DROP TABLE IF EXISTS `NOTA_CREDITO`;
    
CREATE TABLE `NOTA_CREDITO` (
  `nota_credito_id` BIGINT NOT NULL AUTO_INCREMENT DEFAULT NULL,
  `orden_salida_id` BIGINT NOT NULL,
  PRIMARY KEY (`nota_credito_id`)
) COMMENT 'Tabla NOTA CREDITO';

-- ---
-- Table 'PRODUCTO'
-- Tabla PRODUCTO
-- ---

DROP TABLE IF EXISTS `PRODUCTO`;
    
CREATE TABLE `PRODUCTO` (
  `producto_id` BIGINT NOT NULL AUTO_INCREMENT,
  `producto_descripcion` VARCHAR(100) NOT NULL,
  `producto_unidad` VARCHAR(5) NULL DEFAULT NULL,
  `producto_precio_base` DECIMAL NULL DEFAULT NULL,
  PRIMARY KEY (`producto_id`)
) COMMENT 'Tabla PRODUCTO';

-- ---
-- Table 'DESCUENTO'
-- Tabla DESCUENTO
-- ---

DROP TABLE IF EXISTS `DESCUENTO`;
    
CREATE TABLE `DESCUENTO` (
  `descuento_id` BIGINT NOT NULL AUTO_INCREMENT,
  `producto_id` BIGINT NULL DEFAULT NULL,
  `cliente_id` VARCHAR(10) NOT NULL DEFAULT 'NULL',
  `precio_cliente` DECIMAL NULL DEFAULT NULL,
  `sucursal_id` TINYINT NULL DEFAULT NULL,
  PRIMARY KEY (`descuento_id`)
) COMMENT 'Tabla DESCUENTO';

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `CLIENTE` ADD FOREIGN KEY (cliente_domicilio_fiscal) REFERENCES `DOMICILIO` (`domicilio_id`);
ALTER TABLE `CONTACTO_VENTAS` ADD FOREIGN KEY (cliente_id) REFERENCES `CLIENTE` (`cliente_id`);
ALTER TABLE `CONTACTO_VENTAS` ADD FOREIGN KEY (generales_id) REFERENCES `GENERALES` (`generales_id`);
ALTER TABLE `SUCURSAL` ADD FOREIGN KEY (cliente_id) REFERENCES `CLIENTE` (`cliente_id`);
ALTER TABLE `SUCURSAL` ADD FOREIGN KEY (domicilio_id) REFERENCES `DOMICILIO` (`domicilio_id`);
ALTER TABLE `SUCURSAL` ADD FOREIGN KEY (generales_id) REFERENCES `GENERALES` (`generales_id`);
ALTER TABLE `COTIZACION` ADD FOREIGN KEY (cliente_id) REFERENCES `CLIENTE` (`cliente_id`);
ALTER TABLE `COTIZACION` ADD FOREIGN KEY (usuario_id) REFERENCES `USUARIO` (`usuario_id`);
ALTER TABLE `PEDIDO` ADD FOREIGN KEY (cotizacion_id) REFERENCES `COTIZACION` (`cotizacion_id`);
ALTER TABLE `PEDIDO` ADD FOREIGN KEY (sucursal_id) REFERENCES `SUCURSAL` (`sucursal_id`);
ALTER TABLE `PEDIDO` ADD FOREIGN KEY (contrato_id) REFERENCES `CONTRATO` (`contrato_id`);
ALTER TABLE `PEDIDO` ADD FOREIGN KEY (partida_id) REFERENCES `PARTIDA` (`partida_id`);
ALTER TABLE `DETALLE_COTIZACION` ADD FOREIGN KEY (producto_id) REFERENCES `PRODUCTO` (`producto_id`);
ALTER TABLE `DETALLE_COTIZACION` ADD FOREIGN KEY (cotizacion_id) REFERENCES `COTIZACION` (`cotizacion_id`);
ALTER TABLE `USUARIO` ADD FOREIGN KEY (generales_id) REFERENCES `GENERALES` (`generales_id`);
ALTER TABLE `USUARIO` ADD FOREIGN KEY (domicilio_id) REFERENCES `DOMICILIO` (`domicilio_id`);
ALTER TABLE `USUARIO` ADD FOREIGN KEY (perfil_id) REFERENCES `PERFIL` (`perfil_id`);
ALTER TABLE `USUARIO_CLIENTE` ADD FOREIGN KEY (usuario_id) REFERENCES `USUARIO` (`usuario_id`);
ALTER TABLE `USUARIO_CLIENTE` ADD FOREIGN KEY (cliente_id) REFERENCES `CLIENTE` (`cliente_id`);
ALTER TABLE `PERFIL_PANTALLA` ADD FOREIGN KEY (perfil_id) REFERENCES `PERFIL` (`perfil_id`);
ALTER TABLE `PERFIL_PANTALLA` ADD FOREIGN KEY (pantalla_id) REFERENCES `PANTALLA` (`pantalla_id`);
ALTER TABLE `ALMACEN` ADD FOREIGN KEY (domicilio_id) REFERENCES `DOMICILIO` (`domicilio_id`);
ALTER TABLE `ALMACEN_MATERIAL` ADD FOREIGN KEY (almacen_id) REFERENCES `ALMACEN` (`almacen_id`);
ALTER TABLE `ALMACEN_MATERIAL` ADD FOREIGN KEY (material_id) REFERENCES `MATERIAL` (`material_id`);
ALTER TABLE `ENTRADA_MATERIAL` ADD FOREIGN KEY (almacen_material_id) REFERENCES `ALMACEN_MATERIAL` (`almacen_material_id`);
ALTER TABLE `ENTRADA_MATERIAL` ADD FOREIGN KEY (usuario_id) REFERENCES `USUARIO` (`usuario_id`);
ALTER TABLE `ENTRADA_MATERIAL` ADD FOREIGN KEY (orden_compra_id) REFERENCES `ORDEN_COMPRA` (`orden_compra_id`);
ALTER TABLE `ORDEN_COMPRA` ADD FOREIGN KEY (proveedor_id) REFERENCES `PROVEEDOR` (`proveedor_id`);
ALTER TABLE `DETALLE_COMPRA` ADD FOREIGN KEY (orden_compra_id) REFERENCES `ORDEN_COMPRA` (`orden_compra_id`);
ALTER TABLE `DETALLE_COMPRA` ADD FOREIGN KEY (almacen_material_id) REFERENCES `ALMACEN_MATERIAL` (`almacen_material_id`);
ALTER TABLE `PROVEEDOR` ADD FOREIGN KEY (domicilio_id) REFERENCES `DOMICILIO` (`domicilio_id`);
ALTER TABLE `PROVEEDOR` ADD FOREIGN KEY (generales_id) REFERENCES `GENERALES` (`generales_id`);
ALTER TABLE `SALIDA_MATERIAL` ADD FOREIGN KEY (almacen_material_id) REFERENCES `ALMACEN_MATERIAL` (`almacen_material_id`);
ALTER TABLE `ORDEN_SALIDA` ADD FOREIGN KEY (orden_salida_id) REFERENCES `PEDIDO` (`pedido_id`);
ALTER TABLE `PARTIDA` ADD FOREIGN KEY (contrato_id) REFERENCES `CONTRATO` (`contrato_id`);
ALTER TABLE `RUTA` ADD FOREIGN KEY (orden_salida_id) REFERENCES `ORDEN_SALIDA` (`orden_salida_id`);
ALTER TABLE `DETALLE_PEDIDO` ADD FOREIGN KEY (pedido_id) REFERENCES `PEDIDO` (`pedido_id`);
ALTER TABLE `DETALLE_PEDIDO` ADD FOREIGN KEY (detalle_cotizacion_id) REFERENCES `DETALLE_COTIZACION` (`detalle_cotizacion_id`);
ALTER TABLE `DETALLE_ORDEN_SALIDA` ADD FOREIGN KEY (orden_salida_id) REFERENCES `ORDEN_SALIDA` (`orden_salida_id`);
ALTER TABLE `DETALLE_ORDEN_SALIDA` ADD FOREIGN KEY (detalle_pedido_id) REFERENCES `DETALLE_PEDIDO` (`detalle_pedido_id`);
ALTER TABLE `NOTA_CREDITO` ADD FOREIGN KEY (orden_salida_id) REFERENCES `ORDEN_SALIDA` (`orden_salida_id`);
ALTER TABLE `DESCUENTO` ADD FOREIGN KEY (producto_id) REFERENCES `PRODUCTO` (`producto_id`);
ALTER TABLE `DESCUENTO` ADD FOREIGN KEY (cliente_id) REFERENCES `CLIENTE` (`cliente_id`);
ALTER TABLE `DESCUENTO` ADD FOREIGN KEY (sucursal_id) REFERENCES `SUCURSAL` (`sucursal_id`);

-- ---
-- Table Properties
-- ---

ALTER TABLE `CLIENTE` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `CONTACTO_VENTAS` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `DOMICILIO` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `MATRIZ_SUCURSAL` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `COTIZACION` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `PEDIDO` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `DETALLE_COTIZACION` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `USUARIO` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `USUARIO_CLIENTE` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `GENERALES` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `PERFIL` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `PANTALLA` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `PERFIL_PANTALLA` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `ALMACEN` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `MATERIAL` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `ALMACEN_MATERIAL` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `ENTRADA_MATERIAL` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `ORDEN_COMPRA` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `DETALLE_COMPRA` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `PROVEEDOR` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `SALIDA_MATERIAL` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `ORDEN_SALIDA` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `CONTRATO` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `PARTIDA` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `RUTA` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `DETALLE_PEDIDO` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `DETALLE_ORDEN_SALIDA` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `NOTA_CREDITO` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `PRODUCTO` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `DESCUENTO` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `CLIENTE` (`cliente_id`,`cliente_razonsocial`,`cliente_rfc`,`cliente_domicilio_fiscal`) VALUES
-- ('','','','');
-- INSERT INTO `CONTACTO_VENTAS` (`contacto_ventas_id`,`cliente_id`,`generales_id`) VALUES
-- ('','','');
-- INSERT INTO `DOMICILIO` (`domicilio_id`,`domicilio_calle`,`domicilio_num_ext`,`domicilio_num_int`,`domicilio_colonia`,`domicilio_municipio`,`domicilio_ciudad`,`domicilio_estado`,`domicilio_cp`) VALUES
-- ('','','','','','','','','');
-- INSERT INTO `SUCURSAL` (`sucursal_id`,`cliente_id`,`domicilio_id`,`contacto_ventas_id`) VALUES
-- ('','','','');
-- INSERT INTO `COTIZACION` (`cotizacion_id`,`cotización_fecha_envio`,`cotizacion_edo`,`cliente_id`,`usuario_id`) VALUES
-- ('','','','','');
-- INSERT INTO `PEDIDO` (`pedido_id`,`cotizacion_id`,`sucursal_id`,`pedido_fecha_creacion`,`pedida_fecha_entrega`,`pedido_estado`,`pedido_obs`,`contrato_id`,`partida_id`) VALUES
-- ('','','','','','','','','');
-- INSERT INTO `DETALLE_COTIZACION` (`detalle_cotizacion_id`,`producto_id`,`cantidad`,`cotizacion_id`,`precio_venta`) VALUES
-- ('','','','','');
-- INSERT INTO `USUARIO` (`usuario_id`,`usuario_password`,`generales_id`,`domicilio_id`,`usuario_rol`,`usuario_status`,`perfil_id`) VALUES
-- ('','','','','','','');
-- INSERT INTO `USUARIO_CLIENTE` (`usuario_cliente_id`,`usuario_id`,`cliente_id`,`usuario_cliente_nivel`) VALUES
-- ('','','','');
-- INSERT INTO `GENERALES` (`generales_id`,`nombre`,`apel_p`,`apel_m`,`tel_trabajo`,`ext_tel_trabajo`,`tel_casa`,`tel_cel`,`email`) VALUES
-- ('','','','','','','','','');
-- INSERT INTO `PERFIL` (`perfil_id`,`perfil_nombre`,`perfil_descripcion`) VALUES
-- ('','','');
-- INSERT INTO `PANTALLA` (`pantalla_id`,`pantalla_nombre`,`pantalla_descripcion`,`pantalla_area`,`pantalla_url`) VALUES
-- ('','','','','');
-- INSERT INTO `PERFIL_PANTALLA` (`perfil_pantalla_id`,`perfil_id`,`pantalla_id`) VALUES
-- ('','','');
-- INSERT INTO `ALMACEN` (`almacen_id`,`domicilio_id`) VALUES
-- ('','');
-- INSERT INTO `MATERIAL` (`material_id`,`material_descripcion`,`material_tipo`,`material_unidad`) VALUES
-- ('','','','');
-- INSERT INTO `ALMACEN_MATERIAL` (`almacen_material_id`,`almacen_id`,`material_id`,`cantidad_actual`,`maximo`,`minimo`) VALUES
-- ('','','','','','');
-- INSERT INTO `ENTRADA_MATERIAL` (`entrada_material_id`,`almacen_material_id`,`fecha_ingreso`,`cantidad_ingreso`,`usuario_id`,`material_obs`,`orden_compra_id`,`entrada_folio`) VALUES
-- ('','','','','','','','');
-- INSERT INTO `ORDEN_COMPRA` (`orden_compra_id`,`proveedor_id`,`fecha_compra`,`fecha_entrega_prometida`,`fecha_entrega`,`orden_compra_obs`) VALUES
-- ('','','','','','');
-- INSERT INTO `DETALLE_COMPRA` (`detalle_id`,`orden_compra_id`,`almacen_material_id`,`detalle_compra_cantidad`,`detalle_compra_cantidad_s`) VALUES
-- ('','','','','');
-- INSERT INTO `PROVEEDOR` (`proveedor_id`,`proveedor_rs`,`proveedor_rfc`,`domicilio_id`,`generales_id`) VALUES
-- ('','','','','');
-- INSERT INTO `SALIDA_MATERIAL` (`salida_material_id`,`almacen_material_id`,`cantidad_salida`,`usuario_id`,`salida_obs`) VALUES
-- ('','','','','');
-- INSERT INTO `ORDEN_SALIDA` (`orden_salida_id`,`pedido_id`) VALUES
-- ('','');
-- INSERT INTO `CONTRATO` (`contrato_id`,`cliente_id`,`fecha_inicio`,`fecha_terminacion`,`contrato_mt`) VALUES
-- ('','','','','');
-- INSERT INTO `PARTIDA` (`partida_id`,`partida_no`,`producto_id`,`partida_cantidad`,`contrato_id`) VALUES
-- ('','','','','');
-- INSERT INTO `RUTA` (`ruta_id`,`orden_salida_id`,`recurso_id`,`fecha_ruta`,`ruta_edo`) VALUES
-- ('','','','','');
-- INSERT INTO `DETALLE_PEDIDO` (`detalle_pedido_id`,`pedido_id`,`detalle_cotizacion_id`,`cantidad_surtida`,`detalle_pedido_status`,`detalle_pedido_obs`) VALUES
-- ('','','','','','');
-- INSERT INTO `DETALLE_ORDEN_SALIDA` (`detalle_orden_compra_id`,`orden_salida_id`,`cantidad_salida`,`detalle_pedido_id`) VALUES
-- ('','','','');
-- INSERT INTO `NOTA_CREDITO` (`nota_credito_id`,`orden_salida_id`) VALUES
-- ('','');
-- INSERT INTO `PRODUCTO` (`producto_id`,`producto_descripcion`,`producto_unidad`,`producto_precio_base`) VALUES
-- ('','','','');
-- INSERT INTO `DESCUENTO` (`descuento_id`,`producto_id`,`cliente_id`,`precio_cliente`,`sucursal_id`) VALUES
-- ('','','','','');

