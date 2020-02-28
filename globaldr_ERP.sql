-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: globaldr_erp
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `almacen`
--

DROP TABLE IF EXISTS `almacen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `almacen` (
  `almacen_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `domicilio_id` bigint(20) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  PRIMARY KEY (`almacen_id`),
  KEY `domicilio_id` (`domicilio_id`),
  CONSTRAINT `almacen_ibfk_1` FOREIGN KEY (`domicilio_id`) REFERENCES `domicilio` (`domicilio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='tabla Almacen';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacen`
--

LOCK TABLES `almacen` WRITE;
/*!40000 ALTER TABLE `almacen` DISABLE KEYS */;
INSERT INTO `almacen` VALUES (1,'PLANTA POZA RICA','ALMACEN DE POZA RICA',365,0,3),(2,'VH PRODUCCION','Almacen Villa Hermosa Base 2',381,1,3),(3,'PLANTA VHSA 2','BASE 2',385,0,3);
/*!40000 ALTER TABLE `almacen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `almacen_material`
--

DROP TABLE IF EXISTS `almacen_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `almacen_material` (
  `almacen_material_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `almacen_id` bigint(20) NOT NULL,
  `material_id` bigint(20) NOT NULL,
  `cantidad_actual` bigint(20) NOT NULL DEFAULT 0,
  `maximo` bigint(20) NOT NULL,
  `minimo` bigint(20) DEFAULT 0,
  `solicitud` char(11) DEFAULT '0',
  PRIMARY KEY (`almacen_material_id`),
  KEY `almacen_id` (`almacen_id`),
  KEY `material_id` (`material_id`),
  CONSTRAINT `almacen_material_ibfk_1` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`almacen_id`),
  CONSTRAINT `almacen_material_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2783 DEFAULT CHARSET=latin1 COMMENT='tabla ALMACEN_MATERIAL';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacen_material`
--

LOCK TABLES `almacen_material` WRITE;
/*!40000 ALTER TABLE `almacen_material` DISABLE KEYS */;
INSERT INTO `almacen_material` VALUES (2624,1,7,50,1000,40,'0'),(2625,1,8,40,1000,35,'0'),(2626,1,9,65,1000,50,'0'),(2627,1,10,840,2000,100,'0'),(2628,1,11,420,2000,200,'0'),(2629,1,12,4,100,0,'0'),(2630,1,13,6,100,5,'0'),(2631,1,14,285,1000,50,'0'),(2632,1,15,2,100,0,'0'),(2633,1,16,164,1000,100,'0'),(2634,1,17,30,1000,20,'0'),(2635,1,18,40,1000,40,'0'),(2636,1,19,479,1000,50,'0'),(2637,1,20,4,1000,0,'0'),(2638,1,21,1766,3000,100,'0'),(2639,1,22,23,2000,20,'0'),(2640,1,23,19,1000,10,'0'),(2641,1,24,36,1000,10,'0'),(2642,1,25,21,1000,20,'0'),(2643,1,26,36,1000,30,'0'),(2644,1,27,50,1000,40,'0'),(2645,1,28,1,100,0,'0'),(2647,1,30,16,30,10,'0'),(2648,1,31,8,20,5,'0'),(2649,1,32,0,30,10,'0'),(2650,1,33,6,15,5,'0'),(2651,1,34,60,100,10,'0'),(2652,1,35,100,100,10,'0'),(2653,1,36,100,100,10,'0'),(2654,1,37,100,100,10,'0'),(2655,2,32,0,0,0,'0'),(2657,3,39,1189,5000,250,'0'),(2659,3,41,0,0,0,'0'),(2665,3,47,0,0,0,'0'),(2666,3,48,0,0,0,'0'),(2667,3,49,0,0,0,'0'),(2668,3,50,35,2000,50,'0'),(2669,3,51,0,300,10,'0'),(2670,3,52,0,300,10,'0'),(2671,3,53,0,0,0,'0'),(2672,3,54,0,300,10,'0'),(2673,3,55,0,50,5,'0'),(2674,3,56,32,250,10,'0'),(2675,3,57,0,20,0,'0'),(2676,3,58,0,0,0,'0'),(2677,3,59,0,0,0,'0'),(2678,3,60,160,2500,100,'0'),(2679,1,61,0,0,0,'0'),(2680,3,62,0,0,0,'0'),(2681,3,63,0,0,0,'0'),(2682,3,64,0,0,0,'0'),(2683,3,65,0,100,15,'0'),(2684,3,66,0,250,30,'0'),(2685,3,67,0,0,0,'0'),(2686,1,68,1200,3000,100,'0'),(2687,3,69,0,0,0,'0'),(2688,3,70,0,0,0,'0'),(2689,3,71,0,0,0,'0'),(2690,3,72,5,0,0,'0'),(2691,3,73,37,0,0,'0'),(2692,3,74,0,0,0,'0'),(2693,3,75,0,0,0,'0'),(2694,3,76,0,0,0,'0'),(2695,3,77,0,0,0,'0'),(2696,3,78,0,0,0,'0'),(2697,3,79,7,0,0,'0'),(2698,3,80,20,0,0,'0'),(2699,3,81,9,0,0,'0'),(2700,3,82,0,0,0,'0'),(2701,3,83,6,0,0,'0'),(2702,3,84,3,0,0,'0'),(2703,3,85,0,0,0,'0'),(2704,3,86,11,0,0,'0'),(2705,3,87,30,0,0,'0'),(2706,3,88,2,0,0,'0'),(2707,3,89,27,0,0,'0'),(2708,3,90,0,400,0,'0'),(2709,3,91,1,2000,50,'0'),(2710,3,92,4,0,0,'0'),(2711,3,93,7,0,0,'0'),(2712,3,94,2707,0,0,'0'),(2713,3,95,41,0,0,'0'),(2714,3,96,41,0,0,'0'),(2715,3,97,0,0,0,'0'),(2716,3,98,0,0,0,'0'),(2717,3,99,0,0,0,'0'),(2718,3,100,0,0,0,'0'),(2719,3,101,0,0,0,'0'),(2720,3,102,0,0,0,'0'),(2721,3,103,0,0,0,'0'),(2722,3,104,5,0,0,'0'),(2723,3,105,21,0,0,'0'),(2724,3,106,5,0,0,'0'),(2725,3,107,0,0,0,'0'),(2726,3,108,0,0,0,'0'),(2727,3,109,0,0,0,'0'),(2728,3,110,91,0,0,'0'),(2729,3,111,65,0,0,'0'),(2730,3,112,0,0,0,'0'),(2731,3,113,1594,2000,100,'0'),(2732,3,114,0,0,0,'0'),(2733,3,115,30,0,0,'0'),(2734,3,116,0,0,0,'0'),(2735,3,117,0,0,0,'0'),(2736,3,118,0,0,0,'0'),(2737,3,119,0,0,0,'0'),(2738,3,120,0,0,0,'0'),(2739,3,121,5,0,0,'0'),(2740,3,122,0,0,0,'0'),(2741,3,123,0,0,0,'0'),(2742,3,124,0,0,0,'0'),(2743,3,125,117,1200,50,'0'),(2744,3,126,0,0,0,'0'),(2745,3,127,590,0,0,'0'),(2746,3,128,964,0,0,'0'),(2747,3,129,45,0,0,'0'),(2748,3,130,102,0,0,'0'),(2749,3,131,15,0,0,'0'),(2750,3,132,0,0,0,'0'),(2751,3,133,701,0,0,'0'),(2752,3,134,30,0,0,'0'),(2753,3,135,0,0,0,'0'),(2754,3,136,19,0,0,'0'),(2755,3,137,0,0,0,'0'),(2756,3,138,9,0,0,'0'),(2757,3,139,20,0,0,'0'),(2758,3,140,5,0,0,'0'),(2759,3,141,52,0,0,'0'),(2760,3,142,9,0,0,'0'),(2761,3,143,831,1500,100,'0'),(2762,3,144,314,1500,100,'0'),(2763,3,145,408,1500,100,'0'),(2764,3,146,16,250,40,'0'),(2765,3,147,0,0,0,'0'),(2766,3,148,75,800,100,'0'),(2767,3,149,348,2500,100,'0'),(2768,3,150,45,3000,250,'0'),(2769,3,151,0,0,0,'0'),(2770,3,152,0,0,0,'0'),(2771,3,153,8,250,35,'0'),(2772,3,154,0,0,0,'0'),(2773,3,155,0,0,0,'0'),(2774,3,156,8,0,0,'0'),(2775,3,157,0,0,0,'0'),(2776,3,158,20,300,50,'0'),(2777,3,159,1120,2500,50,'0'),(2778,3,160,4,100,20,'0'),(2780,3,162,500,5000,100,'0'),(2782,3,164,5,10,1,'0');
/*!40000 ALTER TABLE `almacen_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `cliente_id` varchar(10) NOT NULL DEFAULT '',
  `cliente_razonsocial` varchar(50) NOT NULL DEFAULT 'NULL',
  `cliente_rfc` varchar(12) NOT NULL DEFAULT 'NULL',
  `cliente_domicilio_fiscal` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `cliente_generales` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`cliente_id`),
  KEY `cliente_domicilio_fiscal` (`cliente_domicilio_fiscal`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`cliente_domicilio_fiscal`) REFERENCES `domicilio` (`domicilio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='cliente PROMEX';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES ('01','Agricel, SA de CV','AGR820901AI7',342,0,0),('1','Halliburton De México S. De R.L De C.V.','HME560113VAA',149,0,0),('10','FLORES Y RIOS S.A. DE C.V.','FRI921202A49',189,0,0),('11','GLOBAL DRILLING DE MEXICO S.A. DE C.V.','GDM940310FA6',190,0,0),('12','PEMEX EXPLORACION Y PRODUCCION','PEP9207167XA',191,0,0),('13','MOGEL CONSTRUCCIONES S.A. DE C.V.','MCO910502BM0',192,0,0),('14','GRUPO EXSEN S.A. DE C.V.','GEX120719J42',193,0,0),('15','MOGEL FLUIDOS, S.A. DE C.V.','MFL0711057D9',194,0,0),('2','Baker Hughes/Drilling & completion Fluids','BHO930713T99',150,0,0),('3','Global Drilling Fluids De Mexico Sa De CV','GDF030228HJ0',151,0,0),('4','Integridad Mexica Del Norte S. de R.L de C.V (Weat','IMN0405112U1',152,0,0),('5','Qmax De Mexico S.A De C.V.','QME-000424-K',153,0,0),('6','VLG Services de México SA de CV','VSM090824HX3',154,0,0),('7','Protexa S.A de C.V.','PRO8406018E4',155,0,0),('8','NATIONAL OILWELL VARCO SOLUTIONS S.A. DE C.V.','NOV080714FR4',187,0,0),('9','POCHTECA MATERIAS PRIMAS S.A. DE C.V.','PMP950301S62',188,0,0),('AJFKAF','FAFA','FAFAF',295,0,0),('AR',' ARENDAL S DE RL DE CV ','XXXX',350,0,0),('Brenntag','Brenntag Mexico, S.A. de C.V.','xxxxx',347,0,0),('BW ','BERGESEN WORLDWIDE LIMITED','BWL060222Q32',353,0,0),('COSL','COSL MEXICO SA DE CV','xxxxxxxxxx',297,0,0),('CPQ','Cproquip SA de CV','CPR150616BH3',354,0,0),('GOIMAR','GRUPO GOIMAR-GOIMSA','xxxxxxxxxx',316,0,0),('Grupo R','Grupo R Servicios Integrales SA de CV','GRS110713R85',398,0,NULL),('GSM','SERVICIOS INTEGRALES GSM S DE RL DE CV','SIG061108JB5',281,0,0),('IMP','Instituto Mexicano del Petróleo','xxxxxxxxxx',338,0,0),('ISM','IS MACHINES MEXICO SA DE CV','IMM1310181U8',343,0,0),('JP','JP Corporation de Venezuela, C.A.','N/A',344,0,0),('NTS','NACIONAL DE TECNO SERVICIOS INDUSTRIALES, S.A. DE ','NTS0406175V5',379,0,NULL),('PDG','PETROQUIMIA DEL GOLFO, SA DE CV','PGO 010518 N',283,0,0),('PPS','PEMEX PERFORACION Y SERVICIOS','XXXXXX',339,0,0),('PRUEBAS2','PRUEBAS2','PRUEBAS2',293,0,0),('PRUEBAS4','PRUEBAS4','PRUEBAS4',294,0,0),('PTX','PRO FLUIDOS SA DE CV','PRO8406018E4',349,0,0),('QC','Química Caribe Ltda. S de RL de CV','QCL150414MR1',351,0,0),('RDM','RECOLL DE MEXICO SA DE CV','RME101210EQ3',352,0,0),('RI','RICARDEZ INGENIEROS SA DE CV','xxxxxxxxxx',336,0,0),('RIG','RIGSMART SA DE CV','RIG160912RR2',348,0,0),('SAA','SERVICIO ADMINISTRATIVO ALEAL SA DE CV','SAA120817N15',346,0,0),('SIT','SERVICIOS INTEGRALES TAMABRA','XXXX',340,0,0),('SL','SERVICIOS Y PROYECTOS INTEGRADOS SELIK, SA DE CV','SPI130520K53',296,0,0),('SOE','SOE','SOE',298,0,0),('TEH','Tecnología Equipos Herramientas y Servicios S.A. d','TEH-150818-D',345,0,0),('TPM','Técnica Profesional Mexicana S.A. de C.V.','TPM0501114S2',337,0,0),('WICHO','WICHO','VAAAAAAAAAAA',399,0,NULL);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes-usuarios`
--

DROP TABLE IF EXISTS `clientes-usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes-usuarios` (
  `id_cliente_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  PRIMARY KEY (`id_cliente_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relacion Clientes - Usuarios de Ventas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes-usuarios`
--

LOCK TABLES `clientes-usuarios` WRITE;
/*!40000 ALTER TABLE `clientes-usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes-usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion` (
  `servidor_smtp` varchar(100) DEFAULT NULL COMMENT 'servidor de correo de preferencia smtp',
  `puerto` int(6) DEFAULT NULL COMMENT 'puerto servidor correo de preferencia',
  `usuario_correo_notificaciones` varchar(100) DEFAULT NULL COMMENT 'usuario correo',
  `contrasena_usuario_correo_notificaciones` varchar(30) DEFAULT NULL COMMENT 'contrasena correo',
  `frecuencia_notificaciones_pago` varchar(100) DEFAULT NULL COMMENT 'frecuencia de notificaciones de pedidos sin pagar(segundos)',
  `frecuencia_notificaciones_cotizacion_a_pedido` varchar(100) DEFAULT NULL COMMENT 'frecuencia notificaciones de cotizaciones sin ser pedidos(segundos)',
  `frecuencia_notificaciones_material_minimo` varchar(100) DEFAULT NULL COMMENT 'frecuencia recordatorio material terminado(segundos)',
  `frecuencia_notificaciones_material_caduco` varchar(100) DEFAULT NULL COMMENT 'frecuencia recordatorio material caduco(segundos)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES ('smtp.gmail.com',587,'notificaciones@mogel.com.mx','Mogel2018','600','600','600','600');
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacto_ventas`
--

DROP TABLE IF EXISTS `contacto_ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacto_ventas` (
  `contacto_ventas_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cliente_id` varchar(10) NOT NULL DEFAULT 'NULL',
  `generales_id` bigint(20) NOT NULL,
  PRIMARY KEY (`contacto_ventas_id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `generales_id` (`generales_id`),
  CONSTRAINT `contacto_ventas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`),
  CONSTRAINT `contacto_ventas_ibfk_2` FOREIGN KEY (`generales_id`) REFERENCES `generales` (`generales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1 COMMENT='Contacto para Personal de Ventas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacto_ventas`
--

LOCK TABLES `contacto_ventas` WRITE;
/*!40000 ALTER TABLE `contacto_ventas` DISABLE KEYS */;
INSERT INTO `contacto_ventas` VALUES (1,'1',143),(2,'2',144),(3,'3',145),(4,'4',146),(5,'5',147),(6,'6',148),(7,'7',149),(8,'8',179),(9,'9',180),(10,'10',181),(11,'11',182),(12,'12',183),(13,'13',184),(14,'14',185),(15,'15',186),(16,'GSM',273),(17,'PDG',275),(18,'PRUEBAS2',283),(19,'PRUEBAS4',284),(20,'AJFKAF',285),(21,'SL',286),(22,'COSL',287),(23,'SOE',288),(24,'GOIMAR',306),(25,'RI',325),(26,'TPM',326),(27,'IMP',327),(28,'PPS',328),(29,'SIT',329),(30,'PPS',330),(31,'01',331),(32,'ISM',332),(33,'JP',333),(34,'TEH',334),(35,'SAA',335),(36,'Brenntag',336),(37,'RIG',337),(38,'PTX',338),(39,'AR',339),(40,'QC',340),(41,'RDM',341),(42,'BW ',342),(43,'CPQ',343),(45,'NTS',359),(46,'Grupo R',377),(47,'WICHO',378);
/*!40000 ALTER TABLE `contacto_ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrato`
--

DROP TABLE IF EXISTS `contrato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrato` (
  `contrato_id` varchar(10) NOT NULL,
  `cliente_id` varchar(10) NOT NULL,
  `contrato_descripcion` varchar(200) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_terminacion` date NOT NULL,
  `contrato_mt` decimal(10,0) DEFAULT NULL COMMENT 'monto total',
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla Contrato';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrato`
--

LOCK TABLES `contrato` WRITE;
/*!40000 ALTER TABLE `contrato` DISABLE KEYS */;
/*!40000 ALTER TABLE `contrato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cotizacion`
--

DROP TABLE IF EXISTS `cotizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cotizacion` (
  `cotizacion_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cotizacion_edo` tinyint(4) NOT NULL DEFAULT 0,
  `cliente_id` varchar(10) DEFAULT NULL,
  `usuario_id` varchar(10) NOT NULL DEFAULT 'NULL',
  `empresa_id` bigint(20) DEFAULT NULL,
  `cotizacion_folio` int(11) DEFAULT 0,
  `cotizacion_fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cotizacion_fecha_envio` datetime DEFAULT NULL,
  `moneda_id` bigint(20) DEFAULT NULL,
  `cotizacion_divisa_dia` decimal(10,2) DEFAULT NULL,
  `cotizacion_observaciones` varchar(300) DEFAULT NULL,
  `contacto_ventas_id` bigint(20) DEFAULT NULL,
  `cotizacion_mensaje` varchar(500) DEFAULT NULL,
  `cotizacion_dias_entrega` varchar(200) DEFAULT NULL,
  `cotizacion_condiciones_pago` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT 'Ver Anexo',
  `cotizacion_vigencia` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cotizacion_recotizada` bigint(20) DEFAULT NULL,
  `cotizacion_tipo` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'producto=0; servicio=1',
  `precio_cotizacion` varchar(200) DEFAULT NULL,
  `lab` varchar(200) DEFAULT NULL,
  `capacidad_entrega` varchar(200) DEFAULT NULL,
  `muestra_existencia` bigint(20) DEFAULT NULL,
  `muestra_flete` tinyint(4) DEFAULT NULL,
  `sucursal_id` bigint(20) DEFAULT NULL,
  `puesto` varchar(200) NOT NULL,
  PRIMARY KEY (`cotizacion_id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `cotizacion_ibfk_3` (`empresa_id`),
  KEY `cotizacion_ibfk_4` (`moneda_id`),
  KEY `cotizacion_ibfk_5` (`contacto_ventas_id`),
  CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`),
  CONSTRAINT `cotizacion_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `cotizacion_ibfk_3` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  CONSTRAINT `cotizacion_ibfk_4` FOREIGN KEY (`moneda_id`) REFERENCES `moneda` (`moneda_id`),
  CONSTRAINT `cotizacion_ibfk_5` FOREIGN KEY (`contacto_ventas_id`) REFERENCES `contacto_ventas` (`contacto_ventas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1 COMMENT='Tabla de Cotizaciones';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizacion`
--

LOCK TABLES `cotizacion` WRITE;
/*!40000 ALTER TABLE `cotizacion` DISABLE KEYS */;
INSERT INTO `cotizacion` VALUES (12,2,'01','ButronJ',3,1,'2020-02-21 17:33:31','2018-09-20 00:00:00',1,1.00,'',31,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(13,2,'01','ButronJ',3,2,'2020-02-24 16:13:23','2018-09-20 00:00:00',1,1.00,'',31,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(14,2,'01','ButronJ',3,3,'2018-09-20 15:40:54','2018-09-20 00:00:00',1,1.00,'',31,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',1,1,NULL,'Compras'),(15,6,'10','ButronJ',3,4,'2018-09-20 16:08:09','2018-09-20 00:00:00',1,1.00,'',10,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',1,1,NULL,'Compras'),(16,2,'01','ButronJ',3,5,'2018-09-20 17:01:47','2018-09-20 00:00:00',1,1.00,'',31,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',1,1,NULL,'Compras'),(17,2,'1','ButronJ',3,6,'2018-09-20 17:18:58','2018-09-20 00:00:00',1,1.00,'',1,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',1,1,NULL,'Compras'),(18,2,'01','ButronJ',3,7,'2020-02-24 16:26:45','2018-09-20 00:00:00',1,1.00,'',31,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(19,9,'NTS','Monica D',3,8,'2018-09-21 17:13:48','2018-09-21 00:00:00',1,1.00,'',45,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','31 dias ',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(20,6,'NTS','Monica D',3,9,'2018-09-21 17:28:41','2018-09-21 00:00:00',2,19.20,'',45,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','31 dias. ',NULL,0,'En Dólares Americanos más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(21,6,'NTS','Monica D',3,10,'2018-09-21 17:51:01','2018-09-21 00:00:00',1,1.00,'',45,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','30 días. ',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(22,6,'NTS','Monica D',3,11,'2018-09-21 18:35:21','2018-09-21 00:00:00',2,19.20,'',45,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','31 dias. ',NULL,0,'En Dólares Americanos más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(23,6,'NTS','ADMIN 02',5,1,'2018-10-02 15:57:00','2018-10-02 00:00:00',1,1.00,'',45,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','30 DIAS',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(24,6,'1','ButronJ',3,12,'2018-10-02 17:40:05','2018-10-02 00:00:00',1,1.00,'',1,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(25,6,'11','ADMIN 02',3,13,'2018-10-03 16:01:42','2018-10-03 00:00:00',1,1.00,'',11,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(26,6,'10','ADMIN 02',3,14,'2018-10-05 16:41:25','2018-10-05 00:00:00',1,1.00,'',10,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(27,2,'1','ButronJ',3,24,'2020-02-21 20:13:36','2018-10-05 00:00:00',1,1.00,'',1,'','','Ver Anexo','',NULL,0,'','','',0,0,NULL,'Compras'),(28,6,'10','ADMIN 02',4,1,'2018-10-05 17:14:03','2018-10-05 00:00:00',1,1.00,'',10,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(29,6,'11','ADMIN 02',3,15,'2018-10-09 19:34:39','2018-10-09 00:00:00',1,1.00,'',11,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',1,1,NULL,'Compras'),(30,6,'11','ADMIN 02',3,16,'2018-10-09 21:18:17','2018-10-09 00:00:00',1,1.00,'',11,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',1,1,NULL,'Compras'),(31,6,'15','ADMIN 02',4,2,'2018-10-16 17:08:21','2018-10-16 00:00:00',1,1.00,'',15,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(32,6,'1','ButronJ',3,17,'2018-10-16 17:58:22','2018-10-16 00:00:00',1,1.00,'',1,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',1,1,NULL,'Compras'),(33,6,'14','ButronJ',3,18,'2018-10-26 16:08:59','2018-10-26 00:00:00',1,1.00,'',14,'','','Ver Anexo','',NULL,0,'','','',0,0,NULL,'Compras'),(34,6,'11','ADMIN 02',3,19,'2018-10-29 18:11:41','2018-10-29 00:00:00',1,1.00,'',11,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(35,6,'15','ADMIN 02',4,3,'2018-10-29 19:41:30','2018-10-29 00:00:00',1,1.00,'',15,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(36,6,'11','ADMIN 02',3,20,'2018-12-05 18:46:10','2018-12-04 00:00:00',1,1.00,'',11,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',1,1,NULL,'Compras'),(37,6,'Grupo R','Ana Lau',5,2,'2020-01-09 18:01:31','2020-01-09 00:00:00',2,19.20,'',46,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','30 dias de credito','30 dias',NULL,0,'En Dólares Americanos más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(48,2,'WICHO','Wicho',3,21,'2020-02-21 19:44:19','2020-01-10 00:00:00',1,1.00,'',47,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',0,0,NULL,'Compras'),(49,6,'Grupo R','Ana Lau',3,22,'2020-01-14 22:31:27','2020-01-14 00:00:00',2,19.20,'',46,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','30 dias',NULL,0,'En Dólares Americanos más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',1,1,NULL,'Compras'),(54,6,'WICHO','Wicho',3,23,'2020-02-20 19:28:00','2020-02-20 00:00:00',1,1.00,'',47,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',1,1,NULL,'Compras'),(55,0,'WICHO','Wicho',7,2,'2020-02-27 20:47:10','2020-02-26 00:00:00',1,1.00,'',47,'sadadads','Inmediata con previa recepción de la orden de compra','Ver Anexo','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',1,1,NULL,'Compras'),(56,0,'WICHO','Wicho',3,25,'2020-02-27 20:52:36','2020-02-27 00:00:00',1,1.00,'',47,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',1,1,NULL,'Compras'),(58,6,'WICHO','Wicho',3,26,'2020-02-27 23:16:35','2020-02-28 00:00:00',1,1.00,'',47,'Por medio de la presente y de acuerdo a su solicitud, nos permitimos enviarle la lista precios de los productos /servicios que ofrecemos.','Inmediata con previa recepción de la orden de compra','Neto contra entrega de material, remisiones y facturas correspondientes','',NULL,0,'En Moneda Nacional más el I.V.A.','En su Planta','El requerido por ustedes de acuerdo al programa acordado.',1,1,NULL,'Compras');
/*!40000 ALTER TABLE `cotizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_compra`
--

DROP TABLE IF EXISTS `detalle_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_compra` (
  `detalle_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `orden_compra_id` bigint(20) NOT NULL,
  `almacen_id` bigint(20) DEFAULT NULL,
  `detalle_compra_cantidad` decimal(10,0) NOT NULL DEFAULT 0,
  `detalle_compra_cantidad_s` decimal(10,0) NOT NULL DEFAULT 0,
  `producto_id` bigint(20) DEFAULT NULL,
  `costo` double DEFAULT NULL COMMENT 'Costo que viene en factura',
  `producto_desc` varchar(200) DEFAULT NULL,
  `unidad` varchar(20) DEFAULT NULL,
  `lote` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`detalle_id`),
  KEY `orden_compra_id` (`orden_compra_id`),
  KEY `almacen_material_id` (`almacen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='Tabla DETALLE ORDEN COMPRA';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_compra`
--

LOCK TABLES `detalle_compra` WRITE;
/*!40000 ALTER TABLE `detalle_compra` DISABLE KEYS */;
INSERT INTO `detalle_compra` VALUES (2,4,NULL,1,1,15,1500,'GLO PAC R HT / TAMBOR 200','TAMBOR 200',''),(3,5,NULL,20,20,30,1000,'COMPUTADORA','PIEZA','210918'),(4,6,NULL,10,10,34,20,'CUBETA / PAQUETE','PAQUETE','041018'),(5,6,NULL,10,10,34,20,'CUBETA','PIEZA','041018'),(6,17,NULL,15,0,NULL,130,'CABLE DE IMPRESORA USB NEGRO','PIEZA',NULL),(7,17,NULL,5,5,30,5000,'COMPUTADORA','PIEZA','081018'),(8,18,NULL,3,3,30,7000,'COMPUTADORA','PIEZA','101018'),(9,19,NULL,5,5,32,20,'MOUSE / PAQUETE','PAQUETE','051218'),(10,20,NULL,1,0,164,500,'manzana / PAQUETE','PAQUETE',NULL);
/*!40000 ALTER TABLE `detalle_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_cotizacion`
--

DROP TABLE IF EXISTS `detalle_cotizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_cotizacion` (
  `detalle_cotizacion_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `cotizacion_id` bigint(20) NOT NULL DEFAULT 0,
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `observaciones` varchar(300) DEFAULT NULL,
  `multiplo` decimal(10,2) NOT NULL DEFAULT 1.00,
  `procto-servicio` bigint(20) NOT NULL DEFAULT 0 COMMENT 'producto=0; servicio=1;',
  `cotizacion_tipo` tinyint(2) NOT NULL DEFAULT 0 COMMENT 'producto=0; servicio=1;',
  PRIMARY KEY (`detalle_cotizacion_id`),
  KEY `cotizacion_id` (`cotizacion_id`),
  CONSTRAINT `detalle_cotizacion_ibfk_1` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizacion` (`cotizacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1 COMMENT='DETALLE COTIZACION';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_cotizacion`
--

LOCK TABLES `detalle_cotizacion` WRITE;
/*!40000 ALTER TABLE `detalle_cotizacion` DISABLE KEYS */;
INSERT INTO `detalle_cotizacion` VALUES (8,6,1,13,200.00,'',1.00,0,0),(9,2,1,14,288.00,'',1.00,0,0),(10,7,1,14,600.00,'',1.00,0,0),(11,2,1,15,57.00,'',1.00,0,0),(12,19,1,15,89.00,'',1.00,0,0),(13,30,1,15,67.00,'',1.00,0,0),(14,2,1,16,200.00,'',1.00,0,0),(15,15,1,17,3000.00,'',1.00,0,0),(16,15,1,18,1600.00,'',1.00,0,0),(19,30,5,19,7000.00,'se modifica cantidad de pc',1.00,0,0),(20,18,2,20,111.91,'',1.00,0,0),(21,30,20,21,1000.00,'',1.00,0,0),(22,17,5,22,81.25,'',1.00,0,0),(23,31,2,23,700.00,'',1.00,0,0),(24,4,1,24,87.00,'',1.00,0,0),(25,32,3,23,200.00,'',1.00,0,0),(26,33,2,23,1500.00,'',1.00,0,0),(29,32,10,24,145.00,'',1.00,0,0),(30,34,10,25,20.00,'',1.00,0,0),(32,32,5,26,20.00,'PRUEBA FLUJO PRODUCCION',1.00,0,0),(33,10,1,27,435.00,'',1.00,0,0),(34,32,15,28,20.00,'',1.00,0,0),(35,30,12,29,3000.00,'',1.00,0,0),(36,32,1,30,10.00,'',1.00,0,0),(37,32,10,31,50.00,'FLUJO COMPLETO',1.00,0,0),(38,32,1,32,35.00,'',1.00,0,0),(39,32,10,33,565.00,'',1.00,0,0),(40,32,5,34,100.00,'ALMACEN NO CUENTA CON STOCK',1.00,0,0),(41,32,10,35,100.00,'hello 2',1.00,0,0),(42,32,5,36,20.00,'',1.00,0,0),(43,29,500,37,158.00,'',1.00,0,0),(46,39,500,49,158.00,'',1.00,0,0),(51,164,1,54,500.00,'febrero 2020',1.00,0,0),(52,11,1,55,1000.00,'',1.00,0,0),(53,164,1,56,500.00,'preube',1.00,0,0),(54,87,1,56,78955.00,'',1.00,0,0),(55,164,1,58,500.00,'son las 5pm',1.00,0,0);
/*!40000 ALTER TABLE `detalle_cotizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_material`
--

DROP TABLE IF EXISTS `detalle_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_material` (
  `detalle_material_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `material_id` bigint(20) NOT NULL,
  `detalle_material_cantidad` int(11) NOT NULL,
  `detalle_material_observaciones` varchar(50) DEFAULT NULL,
  `detalle_producto_id` bigint(20) NOT NULL,
  PRIMARY KEY (`detalle_material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_material`
--

LOCK TABLES `detalle_material` WRITE;
/*!40000 ALTER TABLE `detalle_material` DISABLE KEYS */;
INSERT INTO `detalle_material` VALUES (1,2,1,'undefined',1),(2,323,1,' ',333),(3,324,10,' ',429),(4,324,1,' ',474),(5,2446,1,'saturadda 1.2 SG',813),(6,2446,1,'litro',524),(7,2649,1,'undefined',35),(8,2649,1,'undefined',37),(9,2649,1,'undefined',36);
/*!40000 ALTER TABLE `detalle_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_orden_salida`
--

DROP TABLE IF EXISTS `detalle_orden_salida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_orden_salida` (
  `detalle_orden_compra_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `orden_salida_id` bigint(20) NOT NULL COMMENT 'llave foranea de ORDEN de SALIDA',
  `cantidad_salida` decimal(10,0) DEFAULT NULL,
  `detalle_pedido_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`detalle_orden_compra_id`),
  KEY `orden_salida_id` (`orden_salida_id`),
  KEY `detalle_pedido_id` (`detalle_pedido_id`),
  CONSTRAINT `detalle_orden_salida_ibfk_1` FOREIGN KEY (`orden_salida_id`) REFERENCES `orden_salida` (`orden_salida_id`),
  CONSTRAINT `detalle_orden_salida_ibfk_2` FOREIGN KEY (`detalle_pedido_id`) REFERENCES `detalle_pedido` (`detalle_pedido_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla DETALLE de ORDEN de SALIDA';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_orden_salida`
--

LOCK TABLES `detalle_orden_salida` WRITE;
/*!40000 ALTER TABLE `detalle_orden_salida` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_orden_salida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_pedido`
--

DROP TABLE IF EXISTS `detalle_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_pedido` (
  `detalle_pedido_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint(20) NOT NULL,
  `detalle_cotizacion_id` bigint(20) DEFAULT NULL COMMENT 'referencia al producto cotizado ',
  `cantidad_surtida` decimal(10,0) NOT NULL DEFAULT 0,
  `cantidad_surtida_produccion` decimal(10,0) DEFAULT NULL,
  `detalle_pedido_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'estado (completo o incompleto)',
  `detalle_pedido_obs` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'observaciones del estado del pedido',
  `factura_id` bigint(20) DEFAULT NULL,
  `cantidad_entregada` int(11) NOT NULL DEFAULT 0,
  `cantidad_enrutada` int(11) NOT NULL DEFAULT 0,
  `cantidad` int(11) NOT NULL,
  `pedido_tipo` tinyint(2) NOT NULL DEFAULT 0 COMMENT 'Almacen:0 , Taller:1',
  `producto_id` bigint(20) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `multiplo` decimal(10,2) NOT NULL,
  `cantidad_recoger` bigint(20) DEFAULT NULL,
  `cantidad_prestamo` bigint(20) DEFAULT NULL,
  `fecha_recoleccion` date DEFAULT NULL,
  `facturado` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no facturado, 1 Facturado',
  `almacen_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`detalle_pedido_id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `detalle_cotizacion_id` (`detalle_cotizacion_id`),
  KEY `factura_id` (`factura_id`),
  CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`detalle_cotizacion_id`) REFERENCES `detalle_cotizacion` (`detalle_cotizacion_id`),
  CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedido`
--

LOCK TABLES `detalle_pedido` WRITE;
/*!40000 ALTER TABLE `detalle_pedido` DISABLE KEYS */;
INSERT INTO `detalle_pedido` VALUES (8,9,NULL,1,NULL,3,'67.00',NULL,0,1,1,0,30,67.00,1.00,NULL,NULL,NULL,0,1),(9,9,NULL,1,NULL,3,'89.00',NULL,0,1,1,0,19,89.00,1.00,NULL,NULL,NULL,0,1),(10,9,NULL,1,NULL,3,'57.00',NULL,0,1,1,0,2,57.00,1.00,NULL,NULL,NULL,0,1),(11,10,NULL,0,1,1,'67',NULL,0,0,1,0,30,67.00,1.00,NULL,NULL,NULL,0,2),(12,11,NULL,2,NULL,3,'223.82',NULL,0,2,2,0,18,111.91,1.00,NULL,NULL,NULL,0,1),(13,12,NULL,20,NULL,3,'20000',NULL,0,20,20,0,30,1000.00,1.00,NULL,NULL,NULL,0,1),(14,13,NULL,5,NULL,3,'406.25',NULL,0,5,5,0,17,81.25,1.00,NULL,NULL,NULL,0,1),(15,14,NULL,3,NULL,3,'600',NULL,3,6,3,0,32,200.00,1.00,NULL,NULL,NULL,0,1),(16,14,NULL,2,NULL,3,'3000',NULL,2,4,2,0,33,1500.00,1.00,NULL,NULL,NULL,0,1),(17,14,NULL,2,NULL,3,'1400',NULL,2,4,2,0,31,700.00,1.00,NULL,NULL,NULL,0,1),(18,15,NULL,0,10,0,'1450',NULL,0,0,10,0,32,145.00,1.00,NULL,NULL,NULL,0,1),(19,15,NULL,0,NULL,15,'87',NULL,0,0,1,0,4,87.00,1.00,NULL,NULL,NULL,0,NULL),(20,16,NULL,10,NULL,3,'200',NULL,10,10,10,0,34,20.00,1.00,NULL,NULL,NULL,0,1),(21,17,NULL,5,5,3,'100',NULL,0,5,5,0,32,20.00,1.00,NULL,NULL,NULL,0,1),(22,18,NULL,15,15,3,'300',NULL,0,15,15,0,32,20.00,1.00,NULL,NULL,NULL,0,1),(23,19,NULL,12,NULL,1,'36000',NULL,0,0,12,0,30,3000.00,1.00,NULL,NULL,NULL,0,2),(24,20,NULL,1,1,3,'10',NULL,1,1,1,0,32,10.00,1.00,NULL,NULL,NULL,0,1),(25,21,NULL,10,10,3,'500',NULL,10,10,10,0,32,50.00,1.00,NULL,NULL,NULL,0,1),(27,23,NULL,1,1,3,'35',NULL,1,1,1,0,32,35.00,1.00,NULL,NULL,NULL,0,1),(28,24,NULL,0,NULL,1,'5650',NULL,0,0,10,0,32,565.00,1.00,NULL,NULL,NULL,0,2),(29,25,NULL,5,5,3,'500',NULL,0,5,5,0,32,100.00,1.00,NULL,NULL,NULL,0,1),(30,26,NULL,10,10,3,'1000',NULL,0,10,10,0,32,100.00,1.00,NULL,NULL,NULL,0,1),(31,27,NULL,5,NULL,3,'100',NULL,0,5,5,0,32,20.00,1.00,NULL,NULL,NULL,0,1),(32,28,NULL,65,NULL,1,'79000',NULL,0,0,500,0,29,158.00,1.00,NULL,NULL,NULL,0,3),(33,34,NULL,2,NULL,1,'prueba',NULL,0,0,2,0,164,500.00,1.00,NULL,NULL,NULL,0,2),(34,35,NULL,228,NULL,1,'',NULL,0,0,500,0,39,158.00,1.00,NULL,NULL,NULL,0,3),(35,35,NULL,0,NULL,1,'',NULL,0,0,500,0,39,158.00,1.00,NULL,NULL,NULL,0,1),(36,36,NULL,1,NULL,3,'500',NULL,0,1,1,0,164,500.00,1.00,NULL,NULL,NULL,0,1),(37,37,NULL,1,NULL,3,'FEBREP',NULL,0,1,1,0,164,500.00,1.00,NULL,NULL,NULL,0,1),(38,38,NULL,1,NULL,3,'500',NULL,0,1,1,0,164,500.00,1.00,NULL,NULL,NULL,0,1);
/*!40000 ALTER TABLE `detalle_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_reqcompra`
--

DROP TABLE IF EXISTS `detalle_reqcompra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_reqcompra` (
  `detalle_reqcompra_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `req_compra_id` bigint(20) NOT NULL,
  `almacen_id` bigint(20) NOT NULL,
  `detalle_reqcompra_cantidad` float NOT NULL DEFAULT 0,
  `producto_id` bigint(20) NOT NULL,
  `observaciones` varchar(250) NOT NULL,
  PRIMARY KEY (`detalle_reqcompra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COMMENT='Tabla DETALLE REQ COMPRA';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_reqcompra`
--

LOCK TABLES `detalle_reqcompra` WRITE;
/*!40000 ALTER TABLE `detalle_reqcompra` DISABLE KEYS */;
INSERT INTO `detalle_reqcompra` VALUES (6,18,1,1,4,'1'),(7,19,1,12,7,''),(8,20,1,1,4,''),(9,21,1,1,15,''),(10,22,1,20,30,'para tener en stock '),(11,23,1,10,34,'NUEVAS'),(12,24,1,5,30,''),(13,28,1,3,30,''),(14,36,1,5,32,''),(15,51,1,1,164,'ejemplo');
/*!40000 ALTER TABLE `detalle_reqcompra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_taller_solicitud`
--

DROP TABLE IF EXISTS `detalle_taller_solicitud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_taller_solicitud` (
  `detalle_taller_solicitud_id` int(10) NOT NULL AUTO_INCREMENT,
  `taller_solicitud_id` bigint(20) NOT NULL,
  `producto_id` bigint(20) NOT NULL,
  `cantidad_solicitada` int(10) NOT NULL,
  `cantidad_surtida` int(11) DEFAULT NULL,
  PRIMARY KEY (`detalle_taller_solicitud_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_taller_solicitud`
--

LOCK TABLES `detalle_taller_solicitud` WRITE;
/*!40000 ALTER TABLE `detalle_taller_solicitud` DISABLE KEYS */;
INSERT INTO `detalle_taller_solicitud` VALUES (1,1,35,2,NULL),(2,1,36,2,NULL),(3,1,37,2,NULL),(4,2,0,1,NULL);
/*!40000 ALTER TABLE `detalle_taller_solicitud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domicilio`
--

DROP TABLE IF EXISTS `domicilio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domicilio` (
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
) ENGINE=InnoDB AUTO_INCREMENT=403 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domicilio`
--

LOCK TABLES `domicilio` WRITE;
/*!40000 ALTER TABLE `domicilio` DISABLE KEYS */;
INSERT INTO `domicilio` VALUES (1,'IGNACIO MANUEL ALTAMIRANO','114','302B','SAN RAFAEL','CUAUHTEMOC','MEXICO','CDMX',6470),(2,'IGNACIO MANUEL ALTAMIRANO','114','302B','SAN RAFAEL','CUAUHTEMOC','Mexico','CDMX',6470),(3,'CALADA SANTA ANA, NORTE','67','','TORRES LINDA VISTA','GUSTAVO A MADERO','Mexico','Distrito F',7208),(4,'AV CHALMA LA VILLA','50','EDIF. 72 DEPTO. 403','EL ARBOLILLO','GUSTAVO A MADERO','Mexico','Distrito F',7240),(5,'Saltillo ','29','','Jardines de Guadalupe','Nezahualcoyotl','Nezahualcoyotl','Mexico',57140),(6,'Saltillo ','29','','Jardines de Guadalupe','Nezahualcoyotl','Nezahualcoyotl','Mexico',57140),(7,'Saltillo ','29','','Jardines de Guadalupe','Nezahualcoyotl','Nezahualcoyotl','Mexico',57140),(8,'Privada de Ayate','3','','H. Fuentes','Calimaya','Calimaya','Estado de México',52230),(9,'','','','','','','',0),(10,'','','','','','','',0),(11,'','','','','','','',0),(12,'','','','','','','',0),(13,'','','','','','','',0),(14,'','','','','','','',0),(15,'','','','','','','',0),(16,'','','','','','','',0),(17,'','','','','','','',0),(18,'','','','','','','',0),(19,'','','','','','','',0),(20,'','','','','','','',0),(21,'','','','','','','',0),(22,'','','','','','','',0),(23,'','','','','','','',0),(24,'','','','','','','',0),(25,'','','','','','','',0),(26,'','','','','','','',0),(27,'','','','','','','',0),(28,'','','','','','','',0),(29,'','','','','','','',0),(30,'KM.13.7 CARR QRO.','','','APASEO EL ALTO','GUANAJUATO','ESTADO','GUANAJUATO',38511),(31,'MONTE PELVOUX','111','8,9','MONTE PELVOUX','MIGUEL  HIDALGO','MEXICO','DISTRITO FEDERAL',11000),(32,'RIO DE LA PLATA BIS ','53','','CUAUTEMOC','DEL. CUAUHTEMOC','MEXICO','DISTRITO FEDERAL',6500),(33,'PROLONGACION PETEN','963','','SANTA CRUZ ATOYAC9634','BENITO JUAREZ','MEXICO','DISTRITO FEDERAL',6600),(34,'AV.PRESIDENTE JUAREZ','58','','CENTRO  TLALNEP.','TLALNEPANTLA','ESTADO','MEXICO',54000),(35,'AV.20  DE NOVIEMBRE ','195','','CENTRO  ','CUAUHTEMOC','MEXICO','DISTRITO FEDERAL',6080),(36,'TENAYUCA ','82','','INDUST. TLALNEPATLA','TLALNEPANTLA','EDO','ESTADO DE MEXICO',54030),(37,'GUILLERMO CAMARENA','1200','9-10','ALVARO OBREGON','ALVARO OBREGON','MEXICO','DISTRITO FEDERAL',1210),(38,'RIVA PALACIOS','8','','CENTRO','TLALNEPANTLA','EDO','ESTADO DE MEXICO',54000),(39,'PLAZA JUAREZ','20','','CENTRO','CUAUTEMOC','MEXICO','DISTRITO FEDERAL',6010),(40,'AV. MONTEVIDEO','8','','TEPEYAC INSURGE.','GUSTAVO A MADERO','MEXICO','DISTRITO FEDERAL',7020),(41,'','','','','','','',0),(42,'AV.EJERCITO NACIONAL','418','9','CHAPULTEPEC MOR.','MIGUEL  HIDALGO','MEXICO','DISTRITO FEDERAL',11570),(43,'AV. DE LOS REYES','91','','RESIDENCIAL DOR.','TLALNEPANTLA','ESTADO','ESTADO DE MEXICO',54070),(44,'','','','','','','',0),(45,'PERIFERICO SUR ','4249','-','JARDINES DE LA MONTA?A','-','TLALPAN','DISTRITO FEDERAL',14210),(46,'MAGNO CENTRO','26','-','BOSQUE DE LAS PALMAS','HUIXQUILUCAN','-','EDO.MEX.',0),(47,'PLAZA DE LA CONSTITUCI?N','S/N','-','CENTRO','-','MIGUEL HIDALGO','DISTRITO FEDERAL',0),(48,'PLAZA DE LA CONSTITUCI?N','S/N','-','CENTRO','-','VENUSTIANO CARRANZA','DISTRITO FEDERAL',0),(49,'PRIV. CEYLAN','S/N','-','INDUSTRIAL VALLEJO','','AZCAPOTZALCO','DISTRITO FEDERAL',0),(50,'CALLE SUR8','71','-','AGRICOLA ORIENTAL','-','IZTACALCO','DISTRITO FEDERAL',8500),(51,'CUMBRES DE LAS NACIONES','1200','-','FRACC. TRES MARIAS ','MORELIA','-','MICHOACAN',0),(52,'AV. JESUS DEL MONTE','39','-','JESUS DEL MONTE','CUAJIMALPA DE MORELOS','','EDO.MEX.',0),(53,'AV.DE LAS PALMAS','905','-','LOMAS DE CHAPULTEPEC','-','MIGUEL HIDALGO','DISTRITO FEDERAL',0),(54,'CLZ.VALLEJO','740','-','INDUSTRIAL VALLEJO','-','AZCAPOTZALCO','DISTRITO FEDERAL',0),(55,'PIROTECNIA','89','-','AZTECA','-','VENUSTIANO CARRANZA','DISTRITO FEDERAL',15320),(56,'IXTLAHUACA','10','-','STA. ISABEL TOLA','-','GUSTAVO A. MADERO','DISTRITO FEDERAL',0),(57,'FRAY SERVANDO TERESA DE MIER','S/N','-','MERCED BALBUENA','-','CUAUHTEMOC','DISTRITO FEDERAL',0),(58,'MAGNO CENTRO','25','5TO PISO','BOSQUE DE LAS PALMAS','HUIXQUILUCAN','-','EDO.MEX.',0),(59,'MAGNO CENTRO','25','5TO PISO','BOSQUE DE LAS PALMAS','HUIXQUILUCAN','-','EDO.MEX.',0),(60,'MAGNO CENTRO','25','5TO PISO','BOSQUE DE LAS PALMAS','HUIXQUILUCAN','-','EDO.MEX.',0),(61,'DR. LAVISTA','-','PISO 1','DOCTORES','-','CUAUHTEMOC','DISTRITO FEDERAL',0),(62,'MONTE DE PIEDAD','7','-','CENTRO','-','CUAUHTEMOC','DISTRITO FEDERAL',6000),(63,'AV. REVOLUCION','780','-','SAN JUAN','HUIXQUILUCAN','-','EDO.MEX.',0),(64,'PONIENTE 122','489','-','COLTONGO','-','AZCAPOTZALCO','DISTRITO FEDERAL',0),(65,'MIRADOR','77','-','?','-','TEPEPAN','DISTRITO FEDERAL',0),(66,'CLAVIJEROS','60','-','TRANSITO','-','CUAUHTEMOC','DISTRITO FEDERAL',0),(67,'GUADALAJARA','5','-','CONSTITUCION DE 1917','TLALNEPANTLA','-','EDO.MEX.',54190),(68,'GUADALAJARA','5','-','CONSTITUCION DE 1917','TLALNEPANTLA','-','EDO.MEX.',54190),(69,'ALEMANIA','70','-','INDEPENDENCIA','-','BENITO JUAREZ','DISTRITO FEDERAL',0),(70,'ALEMANIA','10','-','INDEPENDENCIA','-','BENITO JUAREZ','DISTRITO FEDERAL',0),(71,'CARR. MEXICO-QRO','KM36.5','-','PANTITLAN','-','-','-',0),(72,'LOPE DE VEGA','334','-','POLANCO','-','MIGUEL HIDALGO','DISTRITO FEDERAL',11550),(73,'LAGO DE GUADALUPE','95','-','SAN MATEO TECOLOAPAN','CIUDAD LOPEZ MATEOS','-','EDO.MEX.',0),(74,'PREADO SUR','136','-','LOMAS DE CHAPULTEPEC','-','MIGUEL HIDALGO','DISTRITO FEDERAL',11000),(75,'PROLONGACI?N DE LA REFORMA','500','PISO 2 MOD. 206','-','-','-','-',0),(76,'MONTHE ATHOS','179','-','LOMAS DE CHAPULTEPEC','-','MIGUEL HIDALGO','DISTRITO FEDERAL',11000),(77,'TECOYOTITLA','100','-','FLORIDA','-','ALVARO OBREGON','DISTRITO FEDERAL',1030),(78,'EMPRESA','66','-','MIXCOAC','-','BENITO JUAREZ','DISTRITO FEDERAL',3910),(79,'CALLE 3','S/N','-','INDEPENDENCIA','TULTITLAN','-','EDO.MEX.',54900),(80,'CALLE 3','S/N','-','INDEPENDENCIA','TULTITLAN','-','EDO.MEX.',54900),(81,'AV. DE LA PRESA','2','-','FRACC. IND. LA PRESA','TLALNEPANTLA','-','EDO.MEX.',54187),(82,'AV. INDUSTRIA ELECTRICA','S/N','-','COL. BARRIENTOS','TLALNEPANTLA','-','EDO.MEX.',99999),(83,'CARR. MEXICO-CD. SAHAGUN','KM3','-','-','CD. SAHAG?N','-','HIDALGO',43990),(84,'LA MORENA','110','-','DEL VALLE','-','BENITO JUAREZ','DISTRITO FEDERAL',0),(85,'AV. INSURGENTES SUR','1735','-','GUADALUPE INN','-','ALVARO OBREGON','DISTRITO FEDERAL',0),(86,'AV. ALEJANDRO DE RODAS','3102-A','','CUMBRES 8VO SECTOR','MONTERREY','MONTERREY','NUEVO LEON',64610),(87,'PLOMO','2','','XALOSTOC','ECATEPEC','','EDOMEX',55320),(88,'AV.INSURGENTES SUR ','421','','ROMA NORTE','DEL. A. OBREGON','DISTRITO FEDERAL','D.F.',6700),(89,'MAIZ','49','','XOCHIMILCO','DEL. XOCHIMILCO','DISTRITO FEDERAL','D.F.',16090),(90,'MUNICIPIO LIBRE','377','','STA CRUZ ATOYAC','DEL. BENITO JUAREZ','DISTRITO FEDERAL','D.F.',3310),(91,'UXMAL','866','','STA CRUZ ATOYAC','DEL. BENITO JUAREZ','DISTRITO FARDERAL','D.F.',3310),(92,'INSURGENTES SUR ','489','PISO 18','HIPODROMO CONDESA','DEL. CUAUHTEMOC','DISTRITO FEDERAL','D.F.',6100),(93,'PLOMO','54','','XALOSTOC','ECATEPEC','ESTADO DE MEXICO','EDOMEX',55320),(94,'VICENTE GUERRERO','18','','SAN MIGUEL','ECATEPEC','ESTADO DE MEXICO','EDOMEX',0),(95,'FERNANDO MONTES DE OCA','21','1','FRACC IND SAN NICOLAS','TLALNEPANTLA','ESTADO DE MEXICO','EDOMEX',54030),(96,'GANTE','20','','CENTRO','DEL. BENITO JUAREZ','DISTRITO FEDERAL','D.F.',6059),(97,'','','','','','','',0),(98,'','','','','','','',0),(99,'','','','','','','',0),(100,'','','','','','','',0),(101,'','','','','','','',0),(102,'','','','','','','',0),(103,'','','','','','','',0),(104,'','','','','','','',0),(105,'AV. MIGUEL HIDALGO','-','CENTRO','45','CUAUHTEMOC','-','',0),(106,'HOMERO','-','POLANCO','1521','MIGUEL HIDALGO','-','',0),(107,'CALLE 10','-','SAN PEDRO DE LOS PIN','145','BENITO JUAREZ','-','',0),(108,'AV. CERRADA DE LA PRESA','-','LA PRESA','47','-','TLALNEPANTLA','',0),(109,'RIO SENA','2do. PISO','CUAUHTEMOC','63','CUAUHTEMOC','-','',0),(110,'MELCHOR OCAMPO','-','VERONICA ANZURES','193','MIGUEL HIDALGO','-','',0),(111,'AV. INSURGENTES','-','DEL VALLE','-','BENITO JUAREZ','-','',0),(112,'CARR. SANTA ANA DEL CONDE','-','MONTEBELLO','S/N','-','LE?N','',0),(113,'LAGO VICTORIA','PISO 9','GRANADA','74','MIGUEL HIDALGO','-','',0),(114,'AV. EJERCITO NACIONAL','-','CHAPULTEPEC MORALES','350','-','-','',0),(115,'CARR. JOROBAS TULA','-','JAIME CANT','KM.3.5','-','HUEHUETOCA','',0),(116,'INGNACIO ALTAMIRANO','-','SAN RAFAEL','28','CUAUHTEMOC','-','',0),(117,'AV. AVILA CAMACHO','-','SAN FRANCISCO CUAUTL','348','-','NAUCALPAN','',0),(118,'PREADO SUR','136','-','LOMAS DE CHAPULTEPEC','-','MIGUEL HIDALGO','DISTRITO FEDERAL',11000),(119,'PROLONGACI?N DE LA REFORMA','500','PISO 2 MOD. 206','-','-','-','-',0),(120,'MONTHE ATHOS','179','-','LOMAS DE CHAPULTEPEC','-','MIGUEL HIDALGO','DISTRITO FEDERAL',11000),(121,'TECOYOTITLA','100','-','FLORIDA','-','ALVARO OBREGON','DISTRITO FEDERAL',1030),(122,'EMPRESA','66','-','MIXCOAC','-','BENITO JUAREZ','DISTRITO FEDERAL',3910),(123,'CALLE 3','S/N','-','INDEPENDENCIA','TULTITLAN','-','EDO.MEX.',54900),(124,'CALLE 3','S/N','-','INDEPENDENCIA','TULTITLAN','-','EDO.MEX.',54900),(125,'AV. DE LA PRESA','2','-','FRACC. IND. LA PRESA','TLALNEPANTLA','-','EDO.MEX.',54187),(126,'AV. INDUSTRIA ELECTRICA','S/N','-','COL. BARRIENTOS','TLALNEPANTLA','-','EDO.MEX.',99999),(127,'CARR. MEXICO-CD. SAHAGUN','KM3','-','-','CD. SAHAG?N','-','HIDALGO',43990),(128,'LA MORENA','110','-','DEL VALLE','-','BENITO JUAREZ','DISTRITO FEDERAL',0),(129,'AV. INSURGENTES SUR','1735','-','GUADALUPE INN','-','ALVARO OBREGON','DISTRITO FEDERAL',0),(130,'AV. CENTRAL','186-A','-','NUEVA INDUSTRIAL VALLEJO','-','GUSTAVO A. MADERO','DISTRITO FEDERAL',0),(131,'AV. M?XICO','62','-','LOS LAURELES','-','-','-',0),(132,'GENERAL ANAYA','174','-','BARRIO DE STA BARBARA','-','IZTAPALAPA','DISTRITO FEDERAL',0),(133,'IRAPUATO','259','-','EL RECREO','-','-','-',0),(134,'SIERRA NEVADA','119','-','LOMAS DE CHAPULTEPEC','-','MIGUEL HIDALGO','DISTRITO FEDERAL',0),(135,'AV. COSTERA DE LAS PALMAS','LTE H8-A1','-','PLAYA DIAMANTE','ACAPULCO','','GUERRERO',0),(136,'CARLOS B-ZETINA','401-D','-','XALOSTOC','TLALNEPANTLA','-','EDOMEX',0),(137,'CARLOS B-ZETINA','80','-','XALOSTOC','TLALNEPANTLA','-','EDOMEX',0),(138,'AV. JAVIER BARROS SIERRA','540','TORRE 1 PISO 2','ZEDEC SANTAFE','-','ALVARO OBREGON','DISTRITO FEDERAL',0),(139,'AV. IND. MIL.','1111','','L. TECAMACHALCO','NAUCALPAN','MEXICO','ESTADO DE MEXICO',53950),(140,'AVENIDA CAMELINAS','3527','902','LAS AMERICAS','MORELIA','MEXICO','MICHOACAN',58270),(141,'AVENIDA CINCO','253','','GRANJAS SAN ANTONIO','IZTAPALAPA','MEXICO','DISTRITO FEDERAL',9070),(142,'LIEJA','7','','JUAREZ','CUAUHTEMOC','MEXICO','DISTRITO FEDERAL',6600),(143,'PARROQUIA','1130','PISO 6','SANTA CRUZ ATOYAC','BENITO JUAREZ','MEXICO','DISTRITO FEDERAL',3310),(144,'','','','','','','',0),(145,'AV CESAR A. SANDINO','7','CENTRO','714','VILLAHERMOSA','N/A','TABASCO',86190),(146,'CARRETERA COATZACOALCOS CARDENAS','N/A','ARROYO HONDO','KM 113.7','HUIMANGUILLO','N/A','TABASCO',86400),(147,'PERIFERICO RAUL LOPEZ SANCHEZ','N/A','CIUDAD INDUSTRIAL','4600','TORRE?N','N/A','COAHUILA',27019),(148,'PROLONGACION DE LOS SANTOS DEGOLLADO','N/A','EL TOLOQUE','12','C?RDENAS','N/A','TABASCO',86532),(149,'Av. Paseo La Choca, Fracc. La Choca','5-A','sn','Tabasco 2000','Centro','Villahermosa','Tabasco',86037),(150,'Av. Antimonio ','S/N','S/N','Cd. Industrial','Centro','villahermosa','Tabasco',0),(151,'Av. Central Sur Mza I','Lote 2','sn','P.I.P Laguna Azul','Cd del Carmen','campeche','Campeche',24140),(152,'Av. Antimonio ','S/N','Lt 2','Cd. Industrial','Centro','villahermosa','Tabasco',86010),(153,'Carret. Vhsa-cardenas km 155+500','S/N','','Ra González 3ra secc','Centro','villahermosa','Tabasco',86035),(154,'Carret. Federal C?rdenas a Villahermosa Km. 153','S/N','','R/a Gonz?lez 3ra secc','Centro','villahermosa','Tabasco',86280),(155,'Av. Paseo Tabasco','1111','','Rovirosa','Centro','villahermosa','Tabasco',86050),(156,'qwer','2','','2','32','3','2',33333),(157,'Villa Hermosa','12','','Villa Hermosa','Municipio','Ciudad','Estado',11111),(158,'','','','','','','',0),(159,'','','','','','','',0),(161,'','','','','','','',0),(162,'','','','','','','',0),(163,'','','','','','','',0),(164,'','','','','','','',0),(165,'','','','','','','',0),(166,'','','','','','','',0),(167,'','','','','','','',0),(168,'','','','','','','',0),(169,'CARRA LAGO DE GUADALUPE KM 27.5','LT 2','BODEGA A3','SAN PEDRO BARRIENTOS','TLANEPANTLA','EDO. MEXICO','MEXICO',54010),(171,'','','','','','','',0),(172,'','','','','','','',0),(173,'','','','','','','',0),(174,'','','','','','','',0),(175,'','','','','','','',0),(176,'','','','','','','',0),(177,'','','','','','','',0),(178,'','','','','','','',0),(179,'','','','','','','',0),(180,'','','','','','','',0),(181,'','','','','','','',0),(182,'','','','','','','',0),(183,'','','','','','','',0),(184,'','','','','','','',0),(185,'','','','','','','',0),(186,'','','','','','','',0),(187,'1','LOTE 4, MZA 1','ENTRE LAS CALLES CAR','ANACLETO CANABAL 1A ','Centro','Centro','Tabasco',86103),(188,'MANUEL REYES VERAMENDI','6','','SAN MIGUEL CHAPULTEPEC','SAN MIGUEL CHAPULTEPEC','MEXICO','DISTRITO FEDERAL',11850),(189,'IGNACIO MANUEL ALTAMIRANO','114','201B','SAN RAFAEL','CUAUHTEMOC','MEXICO','DISTRITO FEDERAL',6470),(190,'IGNACIO MANUEL ALTAMIRANO','114','302B','SAN RAFAEL','CUAUHTEMOC','MEXICO','DISTRITO FEDERAL',6470),(191,'Avenida Marina Nacional','329','sn','Verónica Anzures','Miguel Hidalgo','Mexico','Distrito Federa',11300),(192,'IGNACIO MANUEL ALTAMIRANO','114','201B','SAN RAFAEL','CUAUHTEMOC','MEXICO','DISTRITO FEDERAL',6470),(193,'FRAMBOYANES','3303','','BRUNO PAGLIAI','BRUNO PAGLIAI','VERACRUZ','VERACRUZ',91697),(194,'IGNACIO MANUEL ALTAMIRANO','114','302B','SAN RAFAEL','CUAUHTEMOC','MEXICO','DISTRITO FEDERAL',6470),(195,'J. MA. GONZALEZ HERMOSILLO','35 LT 24','','MIGUEL HIDALGO','MIGUEL HIDALGO','VILLAHERMOSA','TABASCO',86126),(196,'CARRETERA TAMPICO-MANTE KM 14.5','S/N','','LAGUNA DE LA PUERTA','ALTAMIRA','ALTAMIRA','TAMAULIPAS',89609),(197,'MANUEL REYES VERAMENDI','6','','SAN MIGUEL CHAPULTEPEC','MIGUEL HIDALGO','MEXICO','DISTRITO F',11850),(198,'CALLE 6','229','','FRACCIONAMIENTO BONANZAS','CENTRO','VILLAHERMOSA','TABASCO',86030),(199,'PASEO USUMACINTA ','208','','REFORMA','CENTRO','VILLAHERMOSA','TABASCO',86080),(200,'AV JOSE PAGES LLERGO','345','','NUEVA VILLAHERMOSA','CENTRO','VILLAHERMOSA','TABASCO',86070),(201,'COLIMA','11B','','SAN LORENZO TEPALTITLAN','TOLUCA','TOLUCA','EDO MEXICO',50010),(202,'CARRETERA VILLAHERMOSA-NACAJUCA','KM 2.9','','BOSQUES DE SAYOLA 3RA','NACAJUCA','VILLAHERMOSA','TABASCO',86220),(203,'MESONES','78','','CENTRO','CUAUHTEMOC','MEXICO','DISTRITO F',6000),(204,'RIO GUADIANA','11','','CUAUHTEMOC','CUAUHTEMOC','MEXICO','DISTRITO F',6470),(205,'MONTAÑA','7','','LOS PASTORES','NAUCALPAN DE JUAREZ','MEXICO','ESTADO DE ',53340),(206,'CALLE 8','2769','','ZONA INDUSTRIAL','ZONA INDUSTRIAL','GUADALAJARA','JALISCO',44940),(207,'NA','NA','','NA','NA','NA','NA',0),(208,'AV. FUERZA AEREA MEXICANA','540','N/A','FEDERAL','VENUSTIANO CARRANZA','MEXICO','DISTRITO F',15700),(209,'2 OTE','S/N','','MANZANA 8 LOTE 19','FRACC. SAN ANGEL INDECO','VILLAHERMOSA','TABASCO',86017),(210,'BLVD. ADOLFO LOPEZ MATEOS','1941','PISO 2','LOS ALPES','ALVARO OBREGON','MEXICO','DISTRITO F',1010),(211,'SUPER AVENIDA LOMAS VERDES','464','3ER PISO','LOMAS VERDES','NAUCALPAN DE JUAREZ','MEXICO','ESTADO DE MEXICO',53120),(212,'NA','NA','','NA','NA','NA','NA',0),(213,'PROLONGACION DE PASEO TABASCO','210','N/A','FRACCIONAMIENTO CAMPESTRE','FRACCIONAMIENTO CAMPESTRE','VILLAHERMOSA','TABASCO',86035),(214,'IGNACIO MANUEL ALTAMIRANO','114','302 B','SAN RAFAEL','CUAUHTEMOC','MEXICO','DISTRITO FEDERAL',6470),(215,'INSURGENTES SUR','1106','N/A','TLACOQUEMECATL DEL VALLE','BENITO JUAREZ','MEXICO','DISTRITO FEDERAL',32000),(216,'ACUÑA','3','N/A','PARRAS DE LA FUENTE CENTRO','PARRAS','COAHUILA','COAHUILA',27980),(217,'JOSE GUILLERMO LLITERAS','12','','NA','NA','CIUDAD DEL CARMEN','CAMPECHE',24140),(218,'CAPIROTE','34','','SAN LORENZO HUIPULCO','SAN LORENZO HUIPULCO','MEXICO','DISTRITO FEDERAL',14370),(219,'PRIVADA XALAPA','12','N/A','SANTA APOLONIA','AZCAPOTZALCO','MEXICO','DISTRITO FEDERAL',2790),(220,'AV. 5 DE FEBRERO','1606 -C','N/A','SAN PABLO','SAN PABLO','QUERETARO','QUERETARO',76130),(221,'DONATO GUERRA','955','N/A','CENTRO','CENTRO','TORREON ','TORREON ',27000),(222,'AVE DE LA INDUSTRIA','64','PISO 3','MOCTEZUMA 2A SECCION','VENUSTIANO CARRANZA','MEXICO','DISTRITO FEDERAL',15530),(223,'PROLONGACION PASEO DE LA REFORMA','5287','N/A','CUAJIMALPA','CUAJIMALPA','MEXICO','DISTRITO FEDERAL',5000),(224,'BENITO JUAREA','39','','CENTRO','CENTRO','MORELIA','MICHOACAN',58000),(225,'CERRADA DE CUAUHTEMOC','S/N','','CENTRO','CENTRO','AHUAZOTEPEC','PUEBLA',73180),(226,'SAN LUIS POTOSI','25','','ROMA SUR','CUAUHTEMOC','MEXICO','DISTRITO FEDERAL',6760),(227,'NORTE 182','614','','PENSADOR MEXICANO','VENUSTIANO CARRANZA','MEXICO','DISTRITO FEDERAL',15510),(228,'GUILLERMO GONZALEZ CAMARENA','47','','PARQUE INDUSTRIAL CUAMATLA','CUAUHTITLAN IZCALLI','CUAUHTITLAN IZCALLI','EDO MEXICO',54730),(229,'AV. INTERNACIONAL','61','','FRACC. ARBOLEDAS','FRACC. ARBOLEDAS','MATAMOROS','TAMAULIPAS',87448),(230,'SUPREMA CORTE DE JUSTICIA','93','','NA','VENUSTIANO CARRANZA','MEXICO','DISTRITO FEDERAL',15700),(231,'CARRETERA VILLAHERMOSA-CARDENAS','KM 159 MAS 600','LOTE 6','LAZARO CARDENAS 2a SECCION','VILLAHERMOSA','VILLAHERMOSA','TABASCO',0),(232,'MINERIA ','201','','IND. LAS PALAMAS ','SANTACATARIANA','NUEVO LEON','MONTERREY',66350),(233,'ELEUTERIO GONZALEZ','98','','INDUSTRIAL FICO','SANTACATARIANA','NUEVO LEON','MONTERREY',66144),(234,'NA','NA','','NA','NA','NA','NA',0),(235,'IGNACIO MANUEL ALTAMIRANO','114','301 B','SAN RAFAEL','CUAUHTEMOC','MEXICO','DISTRITO FEDERAL',6470),(236,'AV. PASEODE LAS PALMAS','215','PISO 7','LOMAS DE CHAPULTEPEC','MIGUEL HIDALGO','MEXICO','DISTRITO FEDERAL',11000),(237,'AV INDUSTRIALES DEL PONIENTE','2300','','SANTA CATARINA','SANTACATARIANA','NUEVO LEON','MONTERREY',66350),(238,'PLASTICOS ','28','','SANTA CLARA','ECATEPEC','MEXICO','ESTADO DE MEXICO',55540),(239,'AVENIDA PERIFERICO SUR','7800','','STA. MA. TEQUEPEXPAN','STA. MA. TEQUEPEXPAN','TLAQUEPAQUE','JALISCO',45601),(240,'NORTE 3','560','','CENTRO','CENTRO','ORIZABA ','VERACRUZ',94300),(241,'AV XCUMPICH','500','X20A Y X20B','XCUMPICH','XCUMPICH','MERIDA','YUCATAN',97204),(242,'PERIFERICO CARLOS PELLICER CAMARA','1310','','TAMULTE DE LAS BARRANCAS','TAMULTE DE LAS BARRANCAS','VILLAHERMOSA','TABASCO',86150),(243,'JESUS JIMENEZ GALLARDO','2','','SAN SEBASTIAN XHALA','CUAUTITLAN IZCALLI','MEXICO','ESTADO DE MEXICO',54714),(244,'PASEO DE LA REFORMA','383','704','TABACALERA','CUAUHTEMOC','MEXICO','DISTRITO FEDERAL',6030),(245,'CUATRO','310','','VILLA DE LOS ACROS','VILLA DE LOS ACROS','VILLAHERMOSA','TABASCO',86130),(246,'VIVEROSEDIF A-6','DEPTO 203','','FRACC. NUEVA IMAGEN','FRACC. NUEVA IMAGEN','VILLAHERMOSA','TABASCO',86035),(247,'AV. ADOLFO RUIZ CORTINEZ','1438-A','','PERIODISTAS','PERIODISTAS','VILLAHERMOSA','TABASCO',86050),(248,'AV. ADOLFO RUIZ CORTINEZ','1120','','FRACC OROPEZA','FRACC OROPEZA','VILLAHERMOSA','TABASCO',86030),(249,'AVENIDA NIÑOS HEROES','402','','LAS BRISAS','LAS BRISAS','COATZACOALCOS ','VERACRUZ',96530),(250,'OCAMPO','S/N','','CENTRO','CENTRO','PARRAS DE LA FUENTE','COAHUILA',27980),(251,'CALZADA MARIANO ESCOBEDO','476','PISO 12','ANZURES','ANZURES','MEXICO','DISTRITO FEDERAL',11590),(252,'IGNACIO MANUEL ALTAMIRANO','114','201B','SAN RAFAEL','CUAUHTEMOC','MEXICO','DISTRITO FEDERAL',6470),(253,'LIBERTAD ','7','','SAN MIGUEL JACALONES','ACOLMAN','MEXICO','ESTADO DE MEXICO',56600),(254,'AV CONSTITUCION','1011','','CENTRO','CENTRO','VILLAHERMOSA','TABASCO',86000),(255,'AV PRIMERO DE MAYO','120','301','SAN ANDRES ATOTO','NAUCALPAN DE JUAREZ','EDO MEXICO','EDO MEXICO',53500),(256,'KM 1 CAMINO A PASAJE','NA','','CUENCAME','CUENCAME','DURANGO','DURANGO',6700),(257,'SOLES','56','','PEÑON DE LOS BAÑOS','VENUSTIANO CARRANZA','MEXICO','DISTRITO FEDERAL',15520),(258,'MORELOS','159','','CENTRO','CENTRO','VERACRUZ','VERACRUZ',91700),(259,'Calle Puerto Peñasco','42','','Col. Piloto Adolfo López Mateos','Álvaro Obregón','México','Distrito Federal',1290),(260,'Calle Veracruz','1317','','Col. Santa Amalia ','Colima','Colima','Colima',28048),(261,'Calle Mirto','2','','Col. Volcán del Colli','Zapopan','Jalisco','Jalisco',45039),(262,'Calle Malta 315 Sur','NA','','Col. Ex Hacienda los Angeles','Torreón','Torreón','Coahuila',27260),(263,'Calle Paseo de los Tamarindos','90','Piso 24','Col. Bosques de las Lomas','Cuajimalpa de Morelos','México','Distrito Federal',5120),(264,'S/N','S/N','S/N','S/N','Nazas','Durango','Durango',35700),(265,'Calle Corregidora',' 25','','Col. Centro','Cuauhtémoc','México','Distrito Federal',6060),(266,'Calle Lago Zurich','245','Edificio Telcel','Col. Ampliación Granada','Miguel Hidalgo','México','Distrito Federal',11529),(267,'Calle Andador Norte 5','256','103','Col.  Conjunto Laureles','Zapopan','Jalisco','Jalisco',45150),(268,'Calle Parque Vía','198','','Col. Cuauhtémoc','Cuauhtémoc','México','Distrito Federal',6500),(269,'FELIX PARRA','SAN JOSE INSURGENTES','','SAN JOSE INSURGENTES','BENITO JUAREZ','MEXICO','DISTRITO FEDERAL',3900),(270,'LAS CONCHAS','920','','SAN CARLOS','GUADALAJARA','GUADALAJARA','JALISCO',44460),(271,'INDEPENDENCIA','68A','','PLAN DE AYALA','TIHUATLAN','TIHUATLAN','VERACRUZ',92912),(272,'CARR FEDERAL TIHUATLAN - ALAMO','KM 9','','LAS PUENTES','TIHUATLAN','TIHUATLAN','VERACRUZ',92900),(273,'VIALIDAD DE LA BARRANCA','6','','PISO 6','ECHACIENDA JESUS DEL MONTE','HUIXQUILUCAN','ESTADO DE MEXICO',52772),(274,'JOSE MARIA CASTORENA','426','','SAN JOSE DE LOS CEDROS','CUAJIMALPA','MEXICO','DISTRITO FEDERAL',5200),(275,'CARRETERA MEXICO TUXPAN','KM 191.5','36','ZACATE COLORADO','TIHUATLAN','TIHUATLAN','VERACRUZ',92900),(276,'AV INDEPENDENCIA','68A','','PLAN DE AYALA','TIHUATLAN','TIHUATLAN','VERACRUZ',92912),(277,'CARRETERA TAMPICO MANTE','KM 14.5','','LAGUNA DE PUERTA','ALTAMIRA','ALTAMIRA','TAMAULIPAS',89603),(278,'CARRETERA COATZACOALCOS-VILLAHERMOSA','R/A','','GONZALEZ 1A SECCION','SECTOR PUNTA BRAVA','VILLAHERMOSA','TABASCO',86280),(279,'SALTILLO','19','5° PISO','CONDESA','CUAUHTEMOC','MEXICO','DISTRITO FEDERAL',6100),(280,'VILLAHERMOSA','S/N','','VILLAHERMOSA','VILLAHERMOSA','VILLAHERMOSA','TABASCO',0),(281,'Boulevard Bicentenario','4980','sn','Fracc. El Country','Centro','MEXICO','Tabasco',86039),(282,'.','.','.','.','.','.','.',0),(283,'Tenayuca, (frente al 82 y 30)','int 302','64 ','Tlalnepantla','Fracc. Industrial San Nicolas','distrito federal',' Edo. Mex.',54030),(284,'NA','NA','','NA','NA','NA','NA',0),(285,'CERRADA DE MIRLO','MANZ 9','LOTE 1','FRACC TENERIFE','CENTRO','BOSQUE DE SALOYA','Tabasco',0),(286,'AV PASEO TABASCO 2000','S/N','S/N','MULTIOCHENTA','CENTRO','VILLAHERMOSA','TABASCO',86035),(287,'C. VILLAHERMOSA-NACAJUCA','KM 2.9','S/N','BOSQUE DE SALOYA 3RA SECC','CENTRO','VILLAHERMOSA','TABASCO',86220),(288,'IGNACIO MANUEL ALTAMIRANO','114','302B','San Rafael ','Cuathemoc','Mexico ','Mexico ',6470),(289,'.','.','.','.','.','.','.',0),(290,'asdfgh','asdfgh','','asdfghjkl','asdfghj','asdfghjk','asdfghjklñajjkjkjkjj',12345),(292,'AV GREGORIO MENDEZ MAGAÑA','3237','N/A','ATASTA','CENTRO','VILLAHERMOSA','TABASCO',86000),(293,'.','.','.','.','.','.','.',0),(294,'.','.','.','.','.','.','.',0),(295,'AFAF','AFAF','','AFAF','FAFA','FAFA','AFA',123),(296,'Miguel Alemán ','82','20','Unidad Habitacional el Hicacal II ','Boca del Rio  ','Veracruz','Veracruz',94290),(297,'Avenida Central Sur',' Lote 4','Manzana 1','Puerto Industrial Pesquero Laguna Azul','Cd del Carmen','Cd del Carmen','Campeche',24129),(298,'.','.','.','.','.','.','.',0),(299,'','','','','','','',0),(300,'','','','','','','',0),(305,'PRUEBA','PRUEBA','','PRUEBA','PRUEBA','PRUEBA','PRUEBA',1),(306,'CARRET. VHSA-CÁRDENAS KM 155+500, R/A GONZÁLEZ 3RA','na','','na','VILLAHERMOSA','VILLAHERMOSA','TABASCO',0),(307,'CALLE 1 SUR LOTE I MANZANA L','SN','','PUERTO INDUSTRIAL PESQUERO LAGUNA AZUL','CD DEL CARMAN','CD DEL CARMAN','CAMPECHE',0),(308,'CARRETERA VHSA-REFORMA KM. 10.4','SN','','REFORMA,','REFORMA','REFORMA','CHIAPAS.',0),(309,'AV. JUAN SOTO. ','SN','',' LA FUENTE','VERACRUZ','VERACRUZ','VERACRUZ',0),(310,'LOTE 12, TIERRAS CITLALTEPEC CARRETERA A ZAPOTALIL','SN','','POZA RICA','POZA RICA','POZA RICA','VERACRUZ',0),(311,'AV CENTRAL SUR LOTE 7B','8ª Y 8B','','PUERTO INDUST','PEZQUERO LAGUNA AZUL','PEZQUERO LAGUNA AZUL','CAMPECHE',24120),(312,'LIBRAMIENTO A DOS BOCAS, RANCHERIA MOCTEZUMA 1RA S','SN','','PARAISO','PARAISO','PARAISO','TABASCO',0),(313,'CARRETERA FEDERAL CARDENAS-VHSA KM-153','SN','','.','.','.','TABASCO',0),(314,'CARRETERA VILLAHERMOSA-CÁRDENAS KM. 159+600 LOTE 6','SN','','RANCHERÍA LÁZARO CÁRDENAS 2DA. SECCIÓN','CENTRO','CENTRO','TABASCO.',86280),(315,'CARRETERA A ZAPOTILLO-CASTILLO DE TEAYO N º 14','sn','','.','.','TIHUATLAN','VERACRUZ',0),(316,'36 B','26','','PLAYA NORTE','Cd del Carmen','Cd del Carmen','Campeche',24120),(317,'IGNACIO MANUEL ALTAMIRANO','114','201B','SAN RAFAEL','CUAUHTEMOC','MEXICO','CDMX',6470),(318,'','','','','','','',0),(319,'','','','','','','',0),(320,'','','','','','','',0),(321,'','','','','','','',0),(322,'','','','','','','',0),(323,'','','','','','','',0),(324,'','','','','','','',0),(325,'','','','','','','',0),(326,'','','','','','','',0),(327,'','','','','','','',0),(328,'','','','','','','',0),(329,'','','','','','','',0),(330,'','','','','','','',0),(331,'','','','','','','',0),(332,'','','','','','','',0),(333,'','','','','','','',0),(334,'','','','','','','',0),(335,'','','','','','','',0),(336,'XXXXX','XXXXX','XXXX','XXXX','XXXX','XXXX','XXXX',86200),(337,'Calle 65','SN','20','PLAYA NORTE','Cd del Carmen','Cd del Carmen','Campeche',24115),(338,'Eje Central Lázaro Cárdenas','SN','152','San Bartolo Atepehuacan','Gustavo A. Madero','Distrito Federal','Mexico',773),(339,'Zona industrial km 4+500, 4ta secc, isla de tris','26','edif. HOL KA NAAB','Solidaridad urbana','Cd del Carmen','campeche','Campeche',24155),(340,'Blvd. Adolfo Ruiz Cortínez','1209 Altos','sn','Benito Juarez','Poza Rica','Veracruz','Veracruz',93210),(342,'MINERIA','201','','Ind Las Palmas','Santa Catarina','xxxxxx','Nuevo León',66350),(343,'Gregorio Mendez Magaña','548','sn','Punta Brava','Villahermosa','villahermosa','Tabasco',86150),(344,'Mario Briceño Iragorri','9 ','SN','Zona Industrial',' San José de Guanipa','Venezuela',' Anzoátegui',0),(345,'Aquiles Calderón Marchena','110','3',' El Gringo ','Cárdenas','Cárdenas','Tabasco',0),(346,'Licenciado verdad','751','A','Monterrey','centro','Monterrey','nuevo Loen',64000),(347,'Av. Acero','127','Bodega 5',' Ciudad Industrial','Centro','villahermosa','Tabasco',8601),(348,'CARRETERA FEDERAL VILLAHERMOSA A CARDENAS','KM 8','SN','ANACLETO CANABAL 2DA SECCION','Centro','VILLAHERMOSA','Tabasco',86280),(349,'CARRETERA MONTERREY SALTILLO','KM 339','sn','LOS TREVIÑOS','NUEVO LEON','SANTA CATARINA','NUEVO LEON',66350),(350,'Prolongación Los Soles, Torre Martel IV','200','302','Valle Oriente','Garza García','Nuevo Leon','Monterrey',66269),(351,'Av. Periférico Carlos Pellicer Cámara,  ','204','Plaza Mallorca Plant','Tabasco 2000 ','Centro','villahermosa','Tabasco',86035),(352,'Avenida Gragorio Méndez Magaña','1311','106','Nueva Villahermosa','Centro','villahermosa','Tabasco',86070),(353,'68 sn mza 8',' lote 16','','San Agustin del Palmar ','Cd. del Carmen','Cd .del carmen','Campeche',0),(354,'Pipila','4','','Centro','Tlacotalpan','Veracruz','Veracruz',95460),(356,'AUTOPISTA GUADALAJARA-COLIMA.','KM 61+300','','CUERPO B. EL REPARO','SAYULA','SAYULA','JALISCO',49300),(357,'que','23','','fdrd','esta','pasando','aqui',77),(358,'COMARCA','34','4','COMARCA','COMARCA','MICHOACA','MICHOACA',23456),(360,'SAYULA','4','3','SAYULA','SAYULA','SAYULA','JALISCO',86143),(361,'ww','2123','','dfs','dsfd','dcfs','dfg',34),(363,'TABASCO','2','3','RIO VIEJO','CENTRO','VILLAHERMOSA','TABASCO',85980),(364,'SAYULA','3','3','SAYULA','SAYULA','SAYULA','JALISCO',85980),(365,'Carret Sapotalillo - Castillo de Teayo','Lote 14','','Enrique Rodriguez Cano','Tihuatlan','Tihuatlan','Veracruz',92904),(366,'IGNACIO MANUEL ALTAMIRANO','114','302B','SAN RAFAEL','CUAUHTEMOC','MEXICO','DF.',6470),(367,'hgfhg','786','7856','hf','hgfhg','hfh','hgf',223),(368,'IGNACION MAUEL ALTAMIRANO','114','302B','SAN RAFAEL ','CUAUHTEMOC','MEXICO','DF',6479),(369,'VHSA REFORMA','KM 4.5','','RIO VIEJO 1 ERA SECC','CENTRO','VILLAHERMOSA','TABASCO',86280),(374,'cos','34','','dokf','ddd','hhh','wie',3457),(375,'ZAPOTALILLO ','LOTE 14','','OCOTEPEC','OCOTEPEC','TIHUATLAN','VERACRUZ',92901),(376,'ZAPOTALILLO ','LOTE 14','','JOYAS DE MOCAMBO','TIHUATLAN','TIHUATLAN','VERACRUZ',92901),(377,'ZAPOTALILLO ','LOTE 14','','JOYAS DE MOCAMBO','TIHUATLAN','TIHUATLAN','VERACRUZ',92901),(379,'CEREZO','4','','CAMPRESTE','VERACRUZ','VERACRUZ','VERACRUZ',91917),(380,'CONOCIDA','0','','TIHUATLAN','TIHUATLAN','TIHUATLAN','VERACRUZ',92901),(381,'CARRET VHSA-REFORMA','KM 4.5','','RIO VIEJO','CENTRO','VILLAHERMOSA','TABASCO',82680),(382,'invitado','0','','invitado','invitado','invitado','invitado',0),(383,'CARRET- SAPOTALILLO - CASTILLO DE TEAYO','LOTE 14','','','TIHUATLAN','TIHUATLAN','VERACRUZ',92901),(384,'CARRET- SAPOTALILLO - CASTILLO DE TEAYO','LOTE 14','','','TIHUATLAN','TIHUATLAN','VERACRUZ',92901),(385,'CARRET VHSA-REFORMA','KM 4.5','','RIO VIEJO','CENTRO','VILLAHERMOSA','TABASCO',86280),(386,'CCC','','','','','','',0),(387,'CARRET VHSA-REFORMA','KM 4.5','','RIO VIEJO 1 ERA SECC','CENTRO','VILLAHERMOSA','TABASCO',86280),(388,'CARRET VHSA-REFORMA','KM 4.5','','RIO VIEJO 1 ERA SECC','CENTRO','VILLAHERMOSA','TABASCO',86280),(389,'CARRET VHSA-REFORMA','KM 4.5','','RIO VIEJO 1 ERA SECC','CENTRO','VILLAHERMOSA','TABASCO',86280),(390,'IGNACIO M. ALTAMIRANO','114','302B','SAN RAFAEL','MEXICO','MEXICO','MEXICO',6479),(391,'','','','','','','',0),(392,'','','','','','','',0),(393,'','','','','','','',0),(394,'','','','','','','',0),(395,'','','','','','','',0),(396,'','','','','','','',0),(397,'','','','','','','',0),(398,'Segunda ','120','','Las Fuentes','Reynosa','Reynosa','Tamaulipas',88710),(399,'XOCHIMILCO','24','24','SANTA CRUZ','XOCHIMILCO','Ciudad de México','CDMX',1640),(400,'XOCHIMILCO','24','24','SANTA CRUZ','XOCHIMILCO','Ciudad de México','CDMX',1640),(401,'XOCHIMILCO','24','24','SANTA CRUZ','XOCHIMILCO','Ciudad de México','CDMX',1640),(402,'guerrero','24','','carmen','san pablo','CDMX','CIudad de México',12400);
/*!40000 ALTER TABLE `domicilio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `empresa_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `empresa_razonsocial` varchar(200) NOT NULL,
  `empresa_rfc` varchar(200) NOT NULL,
  `empresa_domicilio_fiscal` bigint(20) NOT NULL,
  `iniciales` varchar(10) NOT NULL,
  PRIMARY KEY (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (3,'MOGEL FLUÍDOS S.A. DE C.V.','MFL0711057D9',1,'MF'),(4,'GLOBAL DRILLING DE MEXICO, S.A. DE C.V.','GDM940310FA6',2,'GD'),(5,'MOGEL TRANSPORTES , SA DE CV','MTR120820BX1',288,''),(6,'FLORES Y RIOS, S.A. DE C.V.','FRI921202A49',317,''),(7,'EMpresa de pruebaa','AAAAAAAAAAAAA',402,'');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrada_material`
--

DROP TABLE IF EXISTS `entrada_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrada_material` (
  `entrada_material_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `almacen_material_id` bigint(20) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `cantidad_ingreso` decimal(10,0) NOT NULL DEFAULT 0,
  `usuario_id` varchar(20) NOT NULL,
  `material_obs` varchar(100) NOT NULL DEFAULT 'NULL',
  `orden_compra_id` bigint(20) NOT NULL,
  `entrada_folio` varchar(20) NOT NULL COMMENT 'folio factura, remision, etc',
  PRIMARY KEY (`entrada_material_id`),
  KEY `almacen_material_id` (`almacen_material_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `orden_compra_id` (`orden_compra_id`),
  CONSTRAINT `entrada_material_ibfk_1` FOREIGN KEY (`almacen_material_id`) REFERENCES `almacen_material` (`almacen_material_id`),
  CONSTRAINT `entrada_material_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `entrada_material_ibfk_3` FOREIGN KEY (`orden_compra_id`) REFERENCES `orden_compra` (`orden_compra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla Entrada Material';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrada_material`
--

LOCK TABLES `entrada_material` WRITE;
/*!40000 ALTER TABLE `entrada_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `entrada_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factura` (
  `factura_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `factura_fecha` datetime NOT NULL,
  `factura_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'estado (completo o incompleto)',
  `factura_descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'NULL',
  `pedido_id` bigint(20) NOT NULL,
  PRIMARY KEY (`factura_id`),
  KEY `pedido_pantalla_ibfk_2` (`pedido_id`),
  CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generales`
--

DROP TABLE IF EXISTS `generales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generales` (
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
) ENGINE=InnoDB AUTO_INCREMENT=381 DEFAULT CHARSET=latin1 COMMENT='Tabla de GENERALES de USUARIO, CONTACTO, ETC';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generales`
--

LOCK TABLES `generales` WRITE;
/*!40000 ALTER TABLE `generales` DISABLE KEYS */;
INSERT INTO `generales` VALUES (1,'Usuario','Normal','Sencillo','1111','2222','3333','4444','user@promex.com'),(2,'Antonio','Butrón','Luz','','','','','juanantonio.butron@soetecnologia.com'),(3,'Jaime','Solano','Hernández','','','','','j.solano19@promexextintores.com.mx'),(4,'Gerardo','Arriola','','','','','','gerardo.arriola@promexextintores.com.mx'),(5,'Mauricio','Solano','Hernández','','','','','mauricio.solano@promexextintores.com.mx'),(6,'Angeles','Cruz','Segundo','','','','','angeles.cruz@promexextintores.com.mx'),(8,'Lidia','Ocampo','Altamirano','','','','','lidia.ocampo@promexextintores.com.mx'),(9,'Carlos','Ledezma','','','','','','carlos.ledezma@promexextintores.com.mx'),(10,'Veronica','Mignon','González','','','','','veronica.mignon@promexextintores.com.mx'),(11,'Ricardo','Perez','','','','','','ricardo.perez@promexextintores.com.mx'),(12,'Wendy','Barrios','Gomez','','','','','facturacion@promexextintores.com.mx'),(13,'Esther','Curiel','','','','','','esther.curiel@promexextintores.com.mx'),(14,'Pedro','Solano','Hernández','','','','','pedro.solano@promexextintores.com.mx'),(15,'Rene','Figueroa','Umaña','','','','','rene.figueroa@promexextintores.com.mx'),(16,'Hector','Perez','','','','','','hector.perez@promextintores.com.mx'),(17,'Jair','Olivares','Arano','','','','','jair.olivares@promexextintores.com.mx'),(18,'Alfredo','Delgado','Ortiz','','','','','alfredo.delgado@promexextintores.com.mx'),(19,'Sergio','Fernandez','Franco','','','','','sergio.fernandez@promexextintores.com.mx'),(20,'Ruben','Gama','Hernández','','','','','ruben.gama@promexextintores.com.mx'),(21,'Jaime','Vega','','','','','','jaime.vega@promexextintores.com.mx'),(22,'Luis Ruben','Martin del Campo','','','','','','luis.martindelcampo@promexextintores.com.mx'),(23,'Socorro','Olalde','Bolaños','','','','','socorro.olalde@promexextintores.com.mx'),(24,'SR.FACUNDO  LUNA','','','55659333','55659333','0','0','fluna@gruposayer.com'),(25,'LIC LUCERO  MARLENE  GARCIA','','','59998400','133','0','0','lmarlene@bd.com'),(26,'SR. LUIS GERARDO LEON','','','52860600','114','0','0','luisgerardo.leon@gknobloch.mx'),(27,'SE?ORITA  SUSANA CORTES','','','50903600','57241','0','0','susan_cortez@hotmail.com'),(28,'SR. JUAN AYLLON GARCIA','','','55659811','213','0','0','jayolln.garcia@liconsa.gob.mx'),(29,'JUAN GABRIEL  FARFAN','','','50641400','','0','0','jfarfan@ran.gob.com.mx'),(30,'CHRISTIAN  CULIN','','','35361100','','0','0','estandar@christian.com.mx'),(31,'ENRIQUE RAMIREZ','','','','','0','0','eramirez@actinver.com'),(32,'MARA BERENICE SANCHEZ','','','','','0','0','mberenice@opd.gob.com.mx'),(33,'JOSE MANUEL ROCIO','','','36865100','','0','0','jrocio@sre.gob.mx'),(34,'GABRIELA  PE?A','','','','','0','0',''),(35,'','','','','','0','0',''),(36,'','','','','','0','0',''),(37,'ALMA DELIA HURTA HERNANDEZ','','','','','0','0',''),(38,'','','','','','0','0',''),(39,'CLAUDIA CASTREJON','','','50006800','','0','0','ccastrejon@gia.mx'),(40,'RICARDO RAM?REZ','','','91142083','-','0','0','rramirez@grupofrisa.com'),(41,'CP. MARIO SERRANO AMER','','','54183280','-','0','0','-'),(42,'LIC. ISMAEL ALCANTARA','','','57649400','-','0','0','-'),(43,'ALEJANDRO LICONA','','','-','-','0','0','alicona@cambifon.com.mx'),(44,'ANGELES CABRERA/ CP. GABINO JIMENEZ','','','57585838','-','0','0','acabrera@conformex.com.mx'),(45,'ING. JOS? ZAPIEN','','','433226200','-','0','0','jzapien@cinepolis.com'),(46,'JUAN CARLOS','','','57559527','-','0','0','-'),(47,'JAVIER ANZUREZ','','','51480400','-','0','0','j.anzurez@cabimail.com.mx'),(48,'ARQ. SORAIDA INCLAN ','','','55176324','-','0','0','soraida@nextcapital.com.mx'),(49,'FELIX ZU?IGA','','','57410749','-','0','0','seg.higiene@pascual.com.mx'),(50,'FELIX ZU?IGA/ PRUDENCIO GARCIA','','','57410749','-','0','0','seg.higiene@pascual.com.mx'),(51,'ING. SERGIO BARAJAS','','','57413752','-','0','0','-'),(52,'RICARDO RAM?REZ','','','91142083','-','0','0','rramirez@grupofrisa.com'),(53,'RICARDO RAM?REZ','','','91142083','-','0','0','rramirez@grupofrisa.com'),(54,'RICARDO RAM?REZ','','','91142083','-','0','0','rramirez@grupofrisa.com'),(55,'NELSON MEJIA','','','-','-','0','0','-'),(56,'LILIANA HERNANDEZ','','','52781800','-','0','0','lhernandez@montepiedad.com.mx'),(57,'RICARDO RAM?REZ','','','91142083','-','0','0','rramirez@grupofrisa.com'),(58,'-','','','-','-','0','0','-'),(59,'-','','','-','-','0','0','-'),(60,'FELIX ZU?IGA','','','57410749','-','0','0','seg.higiene@pascual.com.mx'),(61,'YURIKO FLORES','','','5533002100','-','0','0','-'),(62,'YURIKO FLORES','','','5533002100','-','0','0','-'),(63,'DALIA SELENE ESTUDILLO','','','54209528','-','0','0','bestolestudillo@fundacionbest.org.mx'),(64,'DALIA SELENE ESTUDILLO','','','54209528','-','0','0','bestolestudillo@fundacionbest.org.mx'),(65,'LIC. MAGDALENA MTZ','','','58725536','-','0','0','mmartinez@estetic.com.mx'),(66,'-','','','-','-','0','0','-'),(67,'MITZY GARCIA','','','-','-','0','0','-'),(68,'ARQ. GISELA SANTILLAN','','','26230649/534','-','0','0','gsantillan@ideainterior.com'),(69,'LIC. VIRGINIA L?PEZ','','','52578000','14537','0','0','vlopezch@santander.com.mx'),(70,'LIA JESUS CARMONA','','','52833140','3409','0','0','jcarmona@mortonsubastas.com'),(71,'ING. LUIS SERGIO CIPRES ROMERO','','','50904200','4094','0','0','isciores@fonatur.gob.mx'),(72,'LIC. JUAN CARLOS BRAVO','','','55635022','-','0','0','jcbravo@brovel.com.mx'),(73,'ING. MIGUEL VAZQUEZ','','','24872094','-','0','0','miguel.vazquez@gerdau.com'),(74,'SRITA LUZ MEJIA','','','24872050','-','0','0','luz.mejia@sidertul.com.mx'),(75,'ING. CESAR OSNAYA PEREZ','','','24872096','-','0','0','cesar.osnaya@gerdau.com'),(76,'ING. CESAR OSNAYA PEREZ','','','24872096','-','0','0','cesar.osnaya@gerdau.com'),(77,'ING. MARCOS FLORES','','','38887035','-','0','0','marcos.flores@gerdau.com'),(78,'ING. ISMAEL SOTO','','','54201100','-','0','0','isoto@hotmail.com'),(79,'LIC. MIGUEL ANGEL PAZ','','','-','-','0','0','-'),(80,'WILLIAM PE?A BARRON','','','0181 8329900','8557','0','0','WILLIAMSPB@soriana.com'),(81,'ALFREDO RODRIGUEZ','','','5699 0250','1414','0','0','alfredo.rodriguez@avantormaterials.com'),(82,'LIC. ELIUD GARCIA / CDTE. FRANCISCO BENEVIBES','','','54404300','426095','0','0','diagnostico_dsm@hotmail.com'),(83,'ING LUIS LEONARDO MORALES RIOS','','','56 29 83 00','8622','0','0','luis.morales@boehringer-ingelheim.com'),(84,'C.P. ELISA LEON','','','38 71 1000','34 338','0','0','no tiene aun'),(85,'ROBERTO HERNANDEZ','','','3003 2200','3213','0','0','rserralde@dif.gob.mx'),(86,'LIC. ROGELIO SANCHEZ OCHOA','','','5905 1000','51655','0','0','rogelio.sanchez@senasica.gob.mx'),(87,'ING. ENRIQUE LANDIN','','','5755 7720','','0','0','elandin@quimicarana.com'),(88,'ALFREDO LEON','','','57 55 9933','','0','0','alfredo.leon@paradahnos.com'),(89,'MARTHA EVA VALENCIA','','','5321 9612','','0','0','mev@avante.net'),(90,'LIC. JESUS RAMOS NAVARRO','','','52 37 2000','4815','0','0','jramos@banxico.org.mx'),(91,'','','','','','0','0',''),(92,'','','','','','0','0',''),(93,'','','','','','0','0',''),(94,'','','','','','0','0',''),(95,'','','','','','0','0',''),(96,'','','','','','0','0',''),(97,'','','','','','0','0',''),(98,'','','','BALLESTEROS','','0','0','SILVIA'),(99,'6300','','','ONTIVEROS','','0','0','FERNANDO '),(100,'-','','','ROJAS','','0','0','SR. ALFONSO '),(101,'-','','','PUENTE','','0','0','ING. SERGIO '),(102,'-','','','ESCOBAR','','0','0','ALICIA '),(103,'-','','','BOUZADA','','0','0','ING. JAIME '),(104,'11300','','','P?REZ ','ZARATE','0','0','ING. JORGE '),(105,'-','','','VAZQUEZ','','0','0','ING. DANIEL '),(106,'-','','','URIBE','','0','0','CP. GRACIELA '),(107,'11520','','','','','0','0','ING  A.'),(108,'-','','','MERA','','0','0','ING. SALVADOR '),(109,'-','','','GONZALEZ','','0','0','ING. ISRAEL '),(110,'6470','','','MONCADA','','0','0','LIC. ALEJANDRO '),(111,'-','','','J?MENEZ','','0','0','SRA. HILDA '),(112,'ARQ. GISELA SANTILLAN','','','26230649/534','-','0','0','gsantillan@ideainterior.com'),(113,'LIC. VIRGINIA L?PEZ','','','52578000','14537','0','0','vlopezch@santander.com.mx'),(114,'LIA JESUS CARMONA','','','52833140','3409','0','0','jcarmona@mortonsubastas.com'),(115,'ING. LUIS SERGIO CIPRES ROMERO','','','50904200','4094','0','0','isciores@fonatur.gob.mx'),(116,'LIC. JUAN CARLOS BRAVO','','','55635022','-','0','0','jcbravo@brovel.com.mx'),(117,'ING. MIGUEL VAZQUEZ','','','24872094','-','0','0','miguel.vazquez@gerdau.com'),(118,'SRITA LUZ MEJIA','','','24872050','-','0','0','luz.mejia@sidertul.com.mx'),(119,'ING. CESAR OSNAYA PEREZ','','','24872096','-','0','0','cesar.osnaya@gerdau.com'),(120,'ING. CESAR OSNAYA PEREZ','','','24872096','-','0','0','cesar.osnaya@gerdau.com'),(121,'ING. MARCOS FLORES','','','38887035','-','0','0','marcos.flores@gerdau.com'),(122,'ING. ISMAEL SOTO','','','54201100','-','0','0','isoto@hotmail.com'),(123,'LIC. MIGUEL ANGEL PAZ','','','-','-','0','0','-'),(124,'ALBERTO M. TORRES CORTES','','','57540235','-','0','0','atorres@aluprint.com.mx'),(125,'JUAN CARLOS L?PEZ VEGA','','','57876598','-','0','0','cqqzma918@hotmail.com'),(126,'ING. CARLOS GONZALEZ CAMACHO','','','55024520','112','0','0','carliles87@gmail.com'),(127,'ING. JOSEFINA Y SATO MATSUMOTO','','','24650033','-','0','0','jl_laser@prodigy.net.mx'),(128,'LIC. DANIEL PINEDA','','','52414549','105','0','0','-'),(129,'ALEJANDRA E. PACHECO','','','1100273','-','0','0','apacheco@hotmail.com/palmeiras.alepacheco@gmail.com'),(130,'ING. SANTIAGO RESENDIZ RESENDIZ','','','57469350','-','0','0','sresendiz@rimsa.com.mx'),(131,'LIC. OMAR VAZQUEZ','','','57476473','-','0','0','imgonzalez@lacorona.info'),(132,'FERNANDO POBLADAR GONZALEZ','','','52015800','5348','0','0','-'),(133,'TTE. COR. ING. IND. JOSE LUIS WENCE VEGA','','','55896111','55896422','0','0','industriamilitar@yahoo.com.mx'),(134,'ING. GERARDO ARRIOLA GONZALEZ','','','51200324','133','0','0','gerardo.arriola@promexextintores.com.mx'),(135,'ING. VERONICA OCHOA MONTERO','','','55812433','114','0','0','vochoa@convento.com.mx'),(136,'LIC. GERARDO GONZALEZ CANTELLANO','','','50903600','57241','0','0','gerardgonzalez@yahoo.com'),(137,'C.P. PATRICIA ARIAS CABELLO','','','36018400','48331','0','0','pariasc@sepdf.gob.mx'),(138,'ANA LAURA','SANCHEZ','RAMON','','','','','juanantonio.butron@gmail.com'),(139,'JOSE FRANCISCO','','','RODR?GUEZ','NOCEDA','0','0','mexicanadefletes@yahoo.com'),(140,'JOSE JUAN','','','GARC?A','RAMOS','0','0','disenrec@hotmail.com'),(141,'FRANCISCO','','','DAVILA','X','0','0','n/a'),(142,'JESUS','','','HERN?NDEZ','D?AZ','0','0','nmsanders.1982@hotmail.com'),(143,'Dalhy ','Sastre','',' 3101160','1470','0','0','Dalhy.Sastre@halliburton.com'),(144,'Ericka Yolanda','Garza','','938-131-3021','','0','938 137 9609','ErickaYolanda.Garza@bakerhughes.com'),(145,'Libertad','Perez','','938) 1381900','703074','','9931777100','libertad.perez@la.weatherford.com'),(146,'Garcia, Gabriel G','','',' 993 187 983','','0','0','Gabriel.Garcia@la.weatherford.com'),(147,'Gabriela ','Mendoza','Coordinador de Compras & Log-MX| Supply Chain','3100290','','0','9933300613','Gabriela.Mendoza@qmax.com'),(148,'Concepci?n Mendoza Hern?ndez','','','','','0','0','cmendoza@vlgfluids.com'),(149,'Hugo Alberto ','Gómez','Jiménez','993-3169084','6033','0','0','hgomez@protexa.com.mx'),(151,'Manuel','Uloa','Hernandez','','','','','jose.rivasa@mogel.com.mx'),(153,'Yara','Rios','','','','','','yara.rios@mogel.com.mx'),(154,'Victor','Contreras','','','','','','victor.contreras@mogel.com.mx'),(155,'Andrea','Sanchez','','','','','','andrea.sanchez@mogel.com.mx'),(156,'Jesús','Vidal','','','','','','jesus.vidal@mogel.com.mx'),(157,'Jesús','De La Cruz','','','','','','jesus.delacruz@mogel.com.mx'),(158,'Juver','Guillen','','','','','','juver.guillen@global-drilling.com'),(159,'German','Nataren','','','','','','german.nataren@mogel.com.mx'),(160,'Jesus Manuel','Valencia','','','','','','jesus.valencia@mogel.com.mx'),(161,'PENDIENTE','AAAA','AAA','AAA','','AAA','','q@AA.COM'),(163,'Nelson','Lopez','Hernandez','','','','','a@a.com'),(164,'Misael','Olan','Lopez','','','','','Misael@a.com'),(165,'Isac','Jiménez','Gamas','','','','','Isac@a.com'),(166,'Manuel','Ulloa','Hernández','','','','','t_Manuel@a.com'),(167,'Pablo','Leon','Gómez','','','','','pablo@.com'),(168,'Abraham','Olivares','López','','','','','LopezA@com'),(169,'Jorge','Bravo','Sifuentes','','','','','BravoJ@.com'),(170,'Antonio Camilio','Luna','Perez','','','','','LunaA@com'),(171,'Omar','Ernesto','Santander','','','','','Ernesto@com'),(172,'Gabriel','Bravo','Sifientes','','','','','BravoG@com'),(173,'Rogelio','Pastrana','','','','','','PastranaR@com'),(174,'Daniel','Santes','Bustos','','','','','SantesD@com'),(175,'José Daniel','Velázquez','Pastrana','','','','','VelazquezJ@com'),(176,'Roberto Carlos','Reyes','Olivares','','','','','ReyesR@.com'),(177,'Ana Laura','Sanchez','','','','','','compras.villahermosa@mogel.com.mx'),(178,'Janeth','García','','','','','','janeth.gi@mogel.com.mx'),(179,'Alejandro ','Castañeda ','Morales','99 33 10 31 ','209','','9933070057 ','  alejandro.castaneda@nov.com'),(180,'Pendiente','Pendiente','','','','','','Pendiente9@'),(181,'MONICA','DELGADO','MERINOS','','','','','monica.delgado@mogel.com.mx'),(182,'ANA','LAURA','','','','','','Pendiente11@'),(183,'xxxxxxx','xxxxxxx','','','','','',''),(184,'Pendiente13','Pendiente13','','','','','','Pendiente13@'),(185,'Pendiente','Pendiente','','','','','','Pendiente14@'),(186,'Pendiente','Pendiente','','','','','','mogelfluidos@prodigy.net.mx'),(187,'MOISES','PEREZ','NUÑEZ','(044) 993225','0','0','','procasur01@hotmail.com'),(188,'MANUELA','MEDELLIN ','CRUZ','8332819755','','','','mmedellin@mardupol.com.mx'),(189,'SANDRA ARELI','RESENDIZ','REYES','8832268367','','','','saresandiz@pochteca.com.mx'),(190,'MAYRA','DE LA CRUZ','','9933166534','','','','lifpa2003@hotmail.com'),(191,'ALMA LAURA','MAGAÑA','ARIAS','9933159213','101','','','administracion@lamarseguridad.com.mx'),(192,'CANDELARIA','GOMEZ','BROCA','9933548521','','','','cgomez@grupocomsurlab.com'),(193,'AURORA','BURGUETE ','GALLEGOS','2228896473','','','','asic_puebla@asicsc.com.mx'),(194,'MARTHA','DE La  O','LOPEZ','9933136180','1113','','','ventas_lp@live.com.mx'),(195,'WILLIAMS','MONTALVO','','57093453','','','','ovelazquez@lacasadelabascula.com'),(196,'MANUEL ','GARCÍA','BARRAGAN','(55) 5703302','','','','gb-abogadro@abogados.com.mx'),(197,'EDUARDO','BARRUETA ','','','','','','prov-pen-16@s.com'),(198,'PENDIENTE','PENDIENTE','','','','','','prov-pen-17@p.com'),(199,'PENDIENTE','PENDIENTE','','','','','','prov-pen-18@p.com'),(200,'PENDIENTE','PENDIENTE','','','','','','prov-pen-19@p.com'),(201,'PENDIENTE','PENDIENTE','','','','','','prov-pen-20@p.com'),(202,'PENDIENTE','PENDIENTE','','','','','','prov-pen-21@p.com'),(203,'PENDIENTE','PENDIENTE','','','','','','prov-pen-22@p.com'),(204,'PENDIENTE','PENDIENTE','','','','','','prov-pen-23@p.com'),(205,'PENDIENTE','PENDIENTE','','','','','','prov-pen-24@p.com'),(206,'PENDIENTE','PENDIENTE','','','','','','prov-pen-25@p.com'),(207,'PENDIENTE','PENDIENTE','','','','','','prov-pen-26@p.com'),(208,'PENDIENTE','PENDIENTE','','','','','','prov-pen-27@p.com'),(209,'PENDIENTE','PENDIENTE','','','','','','prov-pen-28@p.com'),(210,'PENDIENTE','PENDIENTE','','','','','','prov-pen-29@p.com'),(211,'PENDIENTE','PENDIENTE','','','','','','prov-pen-30@p.com'),(212,'PENDIENTE','PENDIENTE','','','','','','prov-pen-31@p.com'),(213,'PENDIENTE','PENDIENTE','','','','','','prov-pen-32@p.com'),(214,'PENDIENTE','PENDIENTE','','','','','','prov-pen-33@p.com'),(215,'PENDIENTE','PENDIENTE','','','','','','prov-pen-34@p.com'),(216,'PENDIENTE','PENDIENTE','','','','','','prov-pen-35@p.com'),(217,'PENDIENTE','PENDIENTE','','','','','','prov-pen-36@p.com'),(218,'PENDIENTE','PENDIENTE','','','','','','prov-pen-37@p.com'),(219,'PENDIENTE','PENDIENTE','','','','','','prov-pen-38@p.com'),(220,'PENDIENTE','PENDIENTE','','','','','','prov-pen-40@p.com'),(221,'PENDIENTE','PENDIENTE','','','','','','prov-pen-41@p.com'),(222,'PENDIENTE','PENDIENTE','','','','','','prov-pen-42@p.com'),(223,'PENDIENTE','PENDIENTE','','','','','','prov-pen-43@p.com'),(224,'PENDIENTE','PENDIENTE','','','','','','prov-pen-44@p.com'),(225,'PENDIENTE','PENDIENTE','','','','','','prov-pen-45@p.com'),(226,'PENDIENTE','PENDIENTE','','','','','','prov-pen-46@p.com'),(227,'PENDIENTE','PENDIENTE','','','','','','prov-pen-47@p.com'),(228,'PENDIENTE','PENDIENTE','','','','','','prov-pen-48@p.com'),(229,'PENDIENTE','PENDIENTE','','','','','','prov-pen-49@p.com'),(230,'PENDIENTE','PENDIENTE','','','','','','prov-pen-50@p.com'),(231,'PENDIENTE','PENDIENTE','','','','','','prov-pen-51@p.com'),(232,'PENDIENTE','PENDIENTE','','','','','','prov-pen-52@p.com'),(233,'PENDIENTE','PENDIENTE','','','','','','prov-pen-53@p.com'),(234,'PENDIENTE','PENDIENTE','','','','','','prov-pen-54@p.com'),(235,'PENDIENTE','PENDIENTE','','','','','','prov-pen-55@p.com'),(236,'PENDIENTE','PENDIENTE','','','','','','prov-pen-56@p.com'),(237,'PENDIENTE','PENDIENTE','','','','','','prov-pen-57@p.com'),(238,'PENDIENTE','PENDIENTE','','','','','','prov-pen-58@p.com'),(239,'PENDIENTE','PENDIENTE','','','','','','prov-pen-59@p.com'),(240,'PENDIENTE','PENDIENTE','','','','','','prov-pen-60@p.com'),(241,'PENDIENTE','PENDIENTE','','','','','','prov-pen-61@p.com'),(242,'PENDIENTE','PENDIENTE','','','','','','prov-pen-62@p.com'),(243,'PENDIENTE','PENDIENTE','','','','','','prov-pen-63@p.com'),(244,'PENDIENTE','PENDIENTE','','','','','','prov-pen-64@p.com'),(245,'PENDIENTE','PENDIENTE','','','','','','prov-pen-65@p.com'),(246,'PENDIENTE','PENDIENTE','','','','','','prov-pen-66@p.com'),(247,'PENDIENTE','PENDIENTE','','','','','','prov-pen-67@p.com'),(248,'PENDIENTE','PENDIENTE','','','','','','prov-pen-69@p.com'),(249,'PENDIENTE','PENDIENTE','','','','','','prov-pen-72@p.com'),(250,'PENDIENTE','PENDIENTE','','','','','','prov-pen-73@p.com'),(251,'PENDIENTE','PENDIENTE','','01-759-7284-','','','','prov-pen-74@p.com'),(252,'PENDIENTE','PENDIENTE','','','','','','prov-pen-75@p.com'),(253,'PENDIENTE','PENDIENTE','','','','','','prov-pen-76@p.com'),(254,'PENDIENTE','PENDIENTE','','','','','','barilasa@hotmail.com'),(255,'PENDIENTE','PENDIENTE','','','','','','prov-pen-79@p.com'),(256,'PENDIENTE','PENDIENTE','','','','','','prov-pen-80@p.com'),(257,'PENDIENTE','PENDIENTE','','','','','','prov-pen-81@p.com'),(258,'PENDIENTE','PENDIENTE','','','','','','prov-pen-82@p.com'),(259,'PENDIENTE','PENDIENTE','','','','','','prov-pen-83@p.com'),(260,'PENDIENTE','PENDIENTE','','','','','','prov-pen-84@p.com'),(261,'FRANCISCO ','PONCE','ZENDEJA','(55) 5563251','','','','fponce@mcentury.com.mx'),(262,'FRANCISCO ','NAVARRO','PORTUGAL','(33) 1588309','','','','administraciongeneral@tyreandservicesfyr.com.mx'),(263,'ABDIEL','GONZALEZ','GONZALEZ','(746) 106617','','','','goga84@gmail.com'),(264,'SILVIA','SILVERIO','ALMORA','','','','','prov-pendiente-0@p.com'),(265,'CENTRO DE ATENCION Y VENTAS IAVE','.','','(55) 5950256','','','','cavi@idmexico.com.mx'),(266,'OSCAR MANUEL','PINZON','VELARDE','(800) 800288','','','','ccq@qualitas.com.mx'),(267,'ADÁN','NÁJERA','CEDILLO','(746) 843305','','','','verifica_federal_pozarica@hotmail.com'),(268,'ANETTE','CABRERA','FLORES','(782) 111835','','','','amari_caf@live.mx'),(269,'VENTAS','N/A','','(782) 111858','','','','serviplan09@hotmail.com'),(270,'ADRIANA','RAMIREZ','TERAN','(444) 824810','','','','ateran@kwhuasteca.com'),(271,'JULIO','HERNANDEZ','','(993) 310530','','','','jhernandez@kwolmecamaya.com'),(272,'VENTAS','N/A','(800) 9043200','','','','','servicio@efectivale.com.mx'),(273,'Ing. Luz María','Santiago','García','993- 3108900','2336','','','lmsantiagog@ccicsa.com.mx'),(274,'.','.','','','','','','virtual@virtual.com'),(275,'GABRIELA  ','MANZO','GARCIA','4996 9299','','',' 044 55 2383','g.garcia@pqg.mx'),(276,'NA','NA','','','','','','LAMBERTO.SALAS@mogelfluidos.com'),(277,'JOSE EDUARDO','NARVAES','OROZCO','(993)3179928','','','9932792974','ventas_dimertab@hotmail.com'),(278,'JUAN JOSE ','VAZQUEZ','GALLEGOS','3522320 ','','','9933050828','jgallegos@officedepot.com.mx'),(279,'BEATRIZ','PEÑETA','HERNANDEZ','3136180','1113','','','vtasvhsa_v15@hotmail.com'),(280,'Pendiente','Pendiente','','','','','','servidios@pendiente.com'),(281,'1234ghgh','ahjdahjdhajdh','','','','','','irma_taboada@hotmail.co'),(282,'GASTON','GRANEL','H','3161702','','','','digiprintatasta@gmail.com'),(283,'PRUEBAS2','PRUEBAS2','','','','','','PRUEBAS@PRUEBAS.COM'),(284,'PRUBAS4','PRUEBAS4','','','','','','PRUEBAS4@PRUEBAS.COM'),(285,'','','','','','','','irma_taboada@hotmail.com'),(286,'Graciela','Méndez','Hernández','','','','(993) 278 74','g.mendez@selik.mx'),(287,'Jesus David ','García ','Alcocer','','','','9381304803','jgarcia@cosl.mx'),(288,'SOE','TECNOLOGIA','','','','','','buzon_fisher@soetecnologia.com'),(289,'Jesus','Garcia','','','','','','jesus.garcia@mogel.com.mx'),(290,'Jesus Armando','Nataren','','','','','','jesus.nataren@mogel.com.mx'),(295,'PRUEBA','PRUEBA','','','','','','PRUEBA@AFD.COM'),(296,'PRUEBA','PRUEBA','','','','','','PRUEBA@PRUEBA-QMAX.COM'),(297,'PENDIENTE','PENDIENTE','','','','','','PENDIENTE@QMAX.CAMPECHE.COM'),(298,'PENDIENTE','PEDIENTE','','','','','','PENDIENTE@HALLIBURTON.COM'),(299,'PENDIENTE','PENDIENTE','','','','','','PENDIENTE2@HALLIBURTON.COM'),(300,'PENDIENTE','PENDIENTE','','','','','','PENDIENTE3@HALLIBURTON.COM'),(301,'PENDIENTE','PENDIENTE','','','','','','PENDIENTE@PROTEXA.COM'),(302,'PENDIENTE','PENDIENTE','','','','','','PENDIENTE2@PROTEXA.COM'),(303,'PENDIENTE','PENDIENTE','','','','','','PENDIENTE1@VLG.COM'),(304,'.','.','','','','','','.@S.COM'),(305,'.','.','','','','','','p@mogel.com.mx'),(306,'Faryth Damian','Castellanos ','Jiménez','938112112262','177','','','fcastellanos@goimsa.com'),(307,'Karla','Ibarguen','.','','','','','beatriz.ibarguen@mogel.com.mx'),(308,'Bernardo','Perez','','','','','','berni.perez@mogel.com.mx'),(310,'Bonifacio','Pong','','','','','','bonifacio.pong@mogel.com.mx'),(311,'Francisco','Uscanga','','','','','','francisco.uscanga@mogel.com.mx'),(312,'Monica','Delgado','','','','','','monica.delgado@mogel.com.mx>'),(313,'Alfredo','Almora','','','','','','alfredo.almora@mogeltransportes.net'),(314,'Alan','Rios','','','','','','alan.rios@mogelfluidos.com'),(315,'Carlos','Gonzalez','','','','','','carlos.gonzalez@mogel.com.mx'),(316,'Manuel','Carballo','','','','','','manuel.carballo@mogel.com.mx'),(317,'Carolina','Gutierrez','','','','','','carolina.gutierrez@mogel.com.mx'),(318,'Cary','Aguilar','','','','','','caridad.aguilar@mogel.com.mx'),(319,'Candy','Ramirez','','','','','','candy.ramirez@mogel.com.mx'),(320,'Miguel','Juarez','','','','','','miguel.juarez@mogel.com.mx'),(321,'Planta','Sayula','','','','','','mogelplantasayula@gmail.com'),(322,'Gerardo','Guzman','','','','','','gerardo.guzman@mogel.com.mx'),(323,'Enrique','Ovando','','','','','','enrique.ovando@mogel.com.mx'),(324,'Rosa','Rodriguez','','','','','','rosa.rodriguez@mogel.com.mx'),(325,'ING. ISIDRO ','RICARDEZ','','','','','','fantell1972@gmail.com'),(326,'Angel','Rivera ','','','','','','arivera@tpmexicana.com'),(327,'Galicia Mabel ','Acosta','Garate','(55) 9175641','','','','gacosta@imp.mx'),(328,'Ing. Rafael,','Pacheco','Ruiz','','','','','rafael.pachecor@pemex.com'),(329,'Lic. Luis Reneé ','Huerta ','Beltrán',' 7821254007','','','7821292805','luis.huerta@sitamabra.com'),(330,'Flaminio',' Lunghi','','582416139194','','','','flunghi@pps.com.ve'),(331,'xxxxx','xxxxx','','','','','','franciscojrios@mogel.com.mx'),(332,'Ing. Antonio ','Martínez','','','','','9933086823','ismachinemexico@hotmail.com'),(333,'Fabiola ','Perez','Analista de Compras Internacional','2832260383 ','','','','xxxxxxx'),(334,'Alejandro Isaac','Rocha ',' Montes de Oca','019931160449','','','','alejandro.rocha@tehssa.net'),(335,'Abelardo Carlos','n/a','','','','','','lalocarlos80@hotmail.com'),(336,'Jose A ','Toto','Marin','140 7174','','','5543573712','jtoto@brenntagla.com'),(337,'JUAN CARLOS','FLORES','DOMENZAIN','','','','9931602904',' jc.flores@rigsmart.com.mx'),(338,'Hugo Alberto','Gomez ','Jiménez','316 9084','','','','hugo.gomez@protexa.com.mx'),(339,'Ramiro','Ruíz','','8181334821','','','','amiro.ruiz@arendal.com.mx'),(340,'Jose Angel','Ramón','Arcia','','','','9933762832','admmexico@quimicacaribe.com'),(341,'Omar ','García','Gómez','3156255','','','','O.garcia.gomez@recolldemexico.com'),(342,'Arantxa Alejandra','Hernandez','Sanchez','93838 420 40','102','','9381377585','arantxa.alejandra.hernandez.sanchez@bwoffshore.com'),(343,'Gabriela',' Rodriguez ','Lam','','','','','grodriguez.cproquip@gmail.com'),(346,'COMARCA','COMARCA','COMARCA','1234567812','3','','','COMAR@COMARCA.COM'),(347,'prueba','jdjdjh','','','','','','ral1skap@hotmail.com'),(349,'LISETTE','RAMOS','MENDEZ','12345','21223','123','9038049','lis.ramos@mogel.com'),(352,'rafa','alcantara','lopez','','','','','prueba@po.com'),(353,'FRANCISCO JAVIER','RIOS','REYES','5555352331','','','','franciscojrios@mogel.com.mx'),(354,'MARIA DEL PILAR ','DIAZ ','GARCIA','9931428459','','','','juan.aburto@mogel.com.mx'),(355,'RUBEN','PANCARDO','SAENZ','','','','','ruben.pancardo@mogel.com.mx'),(356,'MONICA','DELGADO','MERINOS','','','','','monica.delgado@mogel.com.mx'),(357,'FERNEL','SOLANO','SOLANO','','','','','fernel.solano@mogel.com.mx'),(358,'RAMIRO','HERNANDEZ','SANTIAGO','','','','','compras_mpg8@hotmail.com'),(359,'RAMIRO','HERNANDEZ','SANTIAGO','','','','','nts@compras.com'),(360,'RAMIRO','HERNANDEZ','SANTIAGO','','','','','ramiro@nts.com'),(361,'invitado','invitado','invitado','','','','','invitado@mogel.com.mx'),(362,'invitado','invitado','invitado','','','','','invitado@invitado.com'),(363,'ROBERTO CARLOS','REYES','OLIVARES','','','','','ROBERTO@MOGEL.COM.MX'),(364,'JOSE GUADALUPE','VAZQUEZ ','FUERTE','','','','','joseg@mogel.com.mx'),(365,'ENRIQUE','ALEJANDRO','OVANDO','','','','','enrique.ovando@mogel.com.mx'),(366,'VICTOR','CONTRERAS','HERNANDEZ','','','','','victor.contreras@mogel.com.mx'),(367,'JESUS','DE LA CRUZ','TRINIDAD','','','','','jesus.delacruz@mogel.com.mx'),(368,'JESUS EMMANUEL','VALENCIA','VALENCIA','','','','','jesus.valencia@mogel.com.mx'),(369,'LUIS ','FELIPE','VAZQUEZ','5555352331','','','','luis.vazquez@mogel.com.mx'),(370,'Luis','Vazquez','Ramirez','5535 2331','120','','','luis.vazquez@mogel.com.mx'),(371,'Maria del Pilar','Diaz','Garcia','','','','','pilar.diaz@mogel.com.mx'),(372,'Andrea','Sanchez','','','','','','andrea.sanchez@mogel.com.mx'),(373,'Jesus','Nataren','','','','','','jesus.nataren@mogel.com.mx'),(374,'Bernardo ','Perez','','','','','','berni.perez@mogel.com.mx'),(375,'Ana',' Laura','','','','','','ana.laura@mogel.com.mx'),(376,'Yara','Rios','','','','','','yara.rios@mogel.com.mx'),(377,'Astrid','Sansores','Tavernier','','','','','astrid.sansores8@hotmail.com '),(378,'wicho','vazquez','ramirez','','','','','wichouchiha@gmail.com'),(379,'luis','vazquez','','','','','','tiko@mogel.com.mx'),(380,'Proveedor de prueba','Prueba','','','','','','prueba@prueba.com');
/*!40000 ALTER TABLE `generales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historico`
--

DROP TABLE IF EXISTS `historico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historico` (
  `id_historico` bigint(20) NOT NULL AUTO_INCREMENT,
  `cantidad` bigint(20) NOT NULL,
  `id_producto` bigint(20) NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_pedido` bigint(20) DEFAULT NULL,
  `id_compra` bigint(20) DEFAULT NULL,
  `nota_salida` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_historico`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historico`
--

LOCK TABLES `historico` WRITE;
/*!40000 ALTER TABLE `historico` DISABLE KEYS */;
INSERT INTO `historico` VALUES (1,-1,484,1,'2018-07-23 17:53:08','ButronJ',2,NULL,19),(2,1,483,1,'2018-07-23 17:54:29','ButronJ',3,NULL,NULL),(3,-1,483,1,'2018-07-23 17:55:08','ButronJ',3,NULL,20),(4,-100,545,1,'2018-08-10 22:04:45','ButronJ',5,NULL,21),(5,-2,492,1,'2018-08-17 00:15:15','ButronJ',6,NULL,22),(6,-2,516,1,'2018-08-30 16:15:56','ButronJ',7,NULL,23),(7,-1,19,1,'2018-09-21 06:52:12','ButronJ',9,NULL,24),(8,-1,2,1,'2018-09-21 07:15:22','ButronJ',10,NULL,25),(9,1,15,1,'2018-09-21 08:24:39','ButronJ',NULL,2,NULL),(10,-1,30,1,'2018-09-21 08:28:40','ButronJ',8,NULL,26),(11,1,30,1,'2018-09-21 17:05:46','ButronJ',10,NULL,NULL),(12,-2,18,1,'2018-09-21 17:35:14','Monica D',12,NULL,27),(13,-20,30,1,'2018-09-21 17:56:44','Monica D',13,NULL,28),(14,20,30,1,'2018-09-21 18:26:10','Monica D',NULL,3,NULL),(15,-5,17,1,'2018-09-21 18:37:39','Monica D',14,NULL,29),(16,-2,32,1,'2018-10-02 16:33:59','ADMIN 02',15,NULL,30),(17,-1,33,1,'2018-10-02 16:34:25','ADMIN 02',16,NULL,31),(18,-1,31,1,'2018-10-02 16:39:01','ADMIN 02',17,NULL,32),(19,-1,32,1,'2018-10-02 16:40:15','ADMIN 02',15,NULL,33),(20,-1,33,1,'2018-10-02 16:40:28','ADMIN 02',16,NULL,34),(21,-1,31,1,'2018-10-02 16:40:41','ADMIN 02',17,NULL,35),(22,10,32,1,'2018-10-02 17:42:36','ButronJ',15,NULL,NULL),(23,-10,34,1,'2018-10-03 21:44:38','ADMIN 02',20,NULL,36),(24,10,34,1,'2018-10-04 20:31:57','ADMIN 02',NULL,5,NULL),(25,10,34,1,'2018-10-04 20:31:58','ADMIN 02',NULL,4,NULL),(26,5,32,1,'2018-10-05 17:04:40','ADMIN 02',17,NULL,NULL),(27,-5,32,1,'2018-10-05 17:07:28','ADMIN 02',21,NULL,37),(28,-12,32,1,'2018-10-05 17:21:07','ADMIN 02',22,NULL,38),(29,3,32,1,'2018-10-05 17:23:27','ADMIN 02',18,NULL,NULL),(30,-3,32,1,'2018-10-05 17:24:31','ADMIN 02',22,NULL,39),(31,5,30,1,'2018-10-08 17:37:26','ADMIN 02',NULL,7,NULL),(32,-12,30,1,'2018-10-09 20:21:43','ADMIN 02',23,NULL,40),(33,1,32,1,'2018-10-09 21:27:30','ADMIN 02',20,NULL,NULL),(34,-1,32,1,'2018-10-09 21:37:44','ADMIN 02',24,NULL,41),(35,3,30,1,'2018-10-10 21:57:54','ADMIN 02',NULL,8,NULL),(36,10,32,1,'2018-10-16 17:13:53','ADMIN 02',21,NULL,NULL),(37,-10,32,1,'2018-10-16 17:14:41','ADMIN 02',25,NULL,42),(38,1,32,1,'2018-10-17 17:34:04','ADMIN 02',23,NULL,NULL),(39,-1,32,1,'2018-10-17 17:34:28','ADMIN 02',27,NULL,43),(40,5,32,1,'2018-10-29 18:40:08','ADMIN 02',25,NULL,NULL),(41,5,32,1,'2018-10-29 18:40:49','ADMIN 02',25,NULL,NULL),(42,-5,32,1,'2018-10-29 19:27:46','ADMIN 02',29,NULL,44),(43,-5,32,1,'2018-10-29 19:53:09','ADMIN 02',30,NULL,45),(44,5,32,1,'2018-10-29 19:58:29','ADMIN 02',26,NULL,NULL),(45,-5,32,1,'2018-10-29 19:59:56','ADMIN 02',30,NULL,46),(46,5,32,1,'2018-12-05 19:49:29','ADMIN 02',NULL,9,NULL),(47,-5,32,1,'2018-12-05 19:52:04','ADMIN 02',31,NULL,47),(48,-35,29,1,'2020-01-09 21:20:14','Emmanuel V',32,NULL,48),(49,-30,29,1,'2020-01-09 22:49:08','Jesus C',32,NULL,49),(50,-2,164,1,'2020-01-10 20:42:46','Wicho',33,NULL,50),(51,-35,39,1,'2020-01-14 22:49:55','Emmanuel V',34,NULL,51),(52,-40,39,1,'2020-01-17 16:25:33','Jesus C',34,NULL,52),(53,-35,39,1,'2020-01-17 16:25:52','Jesus C',34,NULL,53),(54,-38,39,1,'2020-01-17 16:26:07','Jesus C',34,NULL,54),(55,-30,39,1,'2020-01-17 16:29:04','Jesus C',34,NULL,55),(56,-1,164,1,'2020-02-20 19:52:39','Wicho',36,NULL,56),(57,-50,39,1,'2020-02-20 23:43:09','Wicho',34,NULL,57),(58,-1,164,1,'2020-02-27 20:57:22','Wicho',38,NULL,58),(59,-1,164,1,'2020-02-27 23:17:45','Wicho',37,NULL,59);
/*!40000 ALTER TABLE `historico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratorio`
--

DROP TABLE IF EXISTS `laboratorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratorio` (
  `id_laboratorio` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipo_orden` tinyint(4) NOT NULL COMMENT '0=compras; 1=pedidos',
  `id_detalle` bigint(20) NOT NULL,
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
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `lote` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_laboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratorio`
--

LOCK TABLES `laboratorio` WRITE;
/*!40000 ALTER TABLE `laboratorio` DISABLE KEYS */;
INSERT INTO `laboratorio` VALUES (1,0,24,'ADMIN 02','ADMIN 02',94,1,1,'ANALISIS DE SERVICIO','CHECAR','2018-10-10 17:35:47','2018-10-10 00:00:00','',1,'101018'),(2,0,8,'ADMIN 02','ADMIN 02',94,1,1,'analisis','INTEL','2018-10-23 10:26:27','2018-10-23 00:00:00','C:fakepathMUESTRA COTIZACION 2.pdf',1,'123456'),(3,0,8,'ADMIN 02','ADMIN 02',94,1,1,'analisis','','2018-10-23 10:39:50','2018-10-23 00:00:00','',1,'234567'),(4,0,33,'Wicho','Wicho',88,2,2,'','PRUEBA','2020-01-20 13:27:08','2020-01-20 00:00:00','',1,''),(5,0,37,'Wicho','Wicho',96,1,1,'','','2020-02-27 14:55:59','2020-02-29 00:00:00','',1,'');
/*!40000 ALTER TABLE `laboratorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratorio_adicionales`
--

DROP TABLE IF EXISTS `laboratorio_adicionales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratorio_adicionales` (
  `id_laboratorio_adicional` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `lote` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_laboratorio_adicional`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratorio_adicionales`
--

LOCK TABLES `laboratorio_adicionales` WRITE;
/*!40000 ALTER TABLE `laboratorio_adicionales` DISABLE KEYS */;
INSERT INTO `laboratorio_adicionales` VALUES (1,0,32,0,'ButronJ','',58,5,0,'muestra','prueba','2018-10-26 08:54:49','0000-00-00 00:00:00','',0,'2672');
/*!40000 ALTER TABLE `laboratorio_adicionales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistica_solicitudes`
--

DROP TABLE IF EXISTS `logistica_solicitudes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logistica_solicitudes` (
  `id_logistica_solicitud` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_detalle_pedido` bigint(20) NOT NULL,
  `cantidad` float NOT NULL,
  `id_usuario` varchar(20) NOT NULL,
  `id_usuario_rev` varchar(20) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `fecha_rev` datetime NOT NULL,
  `observaciones` varchar(250) NOT NULL,
  `destino` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_logistica_solicitud`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistica_solicitudes`
--

LOCK TABLES `logistica_solicitudes` WRITE;
/*!40000 ALTER TABLE `logistica_solicitudes` DISABLE KEYS */;
/*!40000 ALTER TABLE `logistica_solicitudes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material` (
  `material_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `material_descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'NULL',
  `material_tipo` bigint(20) NOT NULL,
  `id_unidad` bigint(10) DEFAULT NULL,
  `material_precio` float NOT NULL,
  `material_maquila` tinyint(1) NOT NULL,
  `idSAE` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `material_descripcion_2` varchar(200) DEFAULT NULL,
  `id_presentacion` bigint(20) NOT NULL,
  `flete` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=latin1 COMMENT='tabla Material';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
INSERT INTO `material` VALUES (1,'pp',1,88,0,0,'PRUEBA',NULL,58,''),(2,'MO BENT',18,88,0,0,'BENTONITA NO TRATADA',NULL,66,''),(3,'GLO SORB',1,93,0,0,'ABSORBENTE',NULL,58,''),(4,'GLO SEDAR FIBE G',28,88,0,0,'ASERRIN GRUESO',NULL,67,''),(5,'MO BAR',27,88,0,0,'BARITA',NULL,68,''),(6,'MO SOSA',1,88,0,0,'SOSA EN ESCAMAS',NULL,69,''),(7,'MO CAL',1,88,0,0,'HIDROXIDO DE CALCIO',NULL,66,''),(8,'MO NaHCO3',1,88,0,0,'CARBONATO DE SODIO',NULL,68,''),(9,'MO CACL2',1,88,0,0,'CLORURO DE CALCIO',NULL,70,''),(10,'MO BENT',18,88,0,0,'BENTONITA NO TRATADA',NULL,65,''),(11,'MO BENT',18,88,0,0,'BENTONITA TRATADA',NULL,65,''),(12,'MFPD-1',1,92,0,0,'MEJORADOR DE FLUJO',NULL,59,''),(13,'AROMINA',1,92,0,0,'LIMPIADOR DE TUBERIA',NULL,71,''),(14,'GLO STARCH',18,88,0,0,'POLIMERO',NULL,69,''),(15,'GLO PAC R HT',1,92,0,0,'VISCOSIFICANTE',NULL,71,''),(16,'GLO SORB',1,93,0,0,'ABSORBENTE',NULL,72,''),(17,'GLO SULF X 100',1,93,0,0,'OXIDO DE ZINC',NULL,73,''),(18,'GLO HEC L',18,92,0,0,'VISCOSIFICANTE',NULL,74,''),(19,'GLO BIOPOLIMER HT',18,93,0,0,'POLIMERO',NULL,75,''),(20,'GLO BIOPOLIMER HT LQ',18,92,0,0,'POLIMERO',NULL,71,''),(21,'GLO BIOPOLIMER',3,88,0,0,'POLIMERO POLVO',NULL,69,''),(22,'GLO LUBE PRE',1,92,0,0,'LUBRICANTE',NULL,71,''),(23,'GLO X LUBE 300',1,92,0,0,'LUBRICANTE',NULL,71,''),(24,'GLO LUBE 300',1,92,0,0,'LUBRICANTE',NULL,71,''),(25,'GLO ECO SPOT',21,92,0,0,'DESPEGADOR',NULL,71,''),(26,'GLO D FOAM 200',22,92,0,0,'ANTI ESPUMANTE',NULL,71,''),(27,'GLO SEDAR FIBE F',28,88,0,0,'ASERRIN FINO',NULL,76,''),(28,'MO BENT',18,88,0,0,'BENTONITA NO TRATADA',NULL,77,''),(29,'MO BAR',27,89,0,0,'DENSIFICANTE',NULL,78,''),(30,'COMPUTADORA',1,94,0,0,'COMPUTADORA',NULL,58,''),(31,'KEYBOARD',1,94,0,0,'TECLADO',NULL,58,''),(32,'MOUSE',1,94,0,0,'RATON',NULL,58,'5'),(33,'DISPLAY',1,94,0,0,'MONITOR',NULL,58,''),(34,'CUBETA',1,94,0,0,'CUBETA',NULL,58,''),(35,'CABLE',1,94,0,1,'CABLE',NULL,58,''),(36,'CARCASA',1,94,0,1,'CARCASA',NULL,58,''),(37,'LENTE OPTICO',1,94,0,1,'LENTE OPTICO',NULL,58,''),(38,'GOMA XANTANA ',18,88,0,0,'GOMA XANTANA',NULL,69,''),(39,'BARITA MOLIDA AGRANEL ',27,89,0,0,'BARITA',NULL,78,''),(40,'GLO PAC LV',3,88,0,0,'Polímero reductor de filtrado Alta  viscosidad',NULL,79,''),(41,'GLO PAC LV',3,94,0,0,'Polímero reductor de filtrado Alta  viscosidad',NULL,79,''),(42,'GLO PAC LV',3,88,0,0,'Polímero reductor de filtrado Alta  viscosidad',NULL,79,''),(43,'GLO PAC LV',3,88,0,0,'Polímero reductor de filtrado Alta  viscosidad',NULL,79,''),(44,'GLO PAC LV',3,88,0,0,'Polímero reductor de filtrado Alta  viscosidad',NULL,79,''),(45,'GLO PAC LV',3,88,0,0,'Polímero reductor de filtrado Alta  viscosidad',NULL,79,''),(46,'GLO PAC LV',3,88,0,0,'Polímero reductor de filtrado Alta  viscosidad',NULL,79,''),(47,'Glo Pac LV',3,94,0,0,'Polímero reductor de filtrado Alta  viscosidad',NULL,69,''),(48,'Glo Pac LV-L',3,94,0,0,'Polímero reductor de filtrado Baja viscosidad',NULL,59,''),(49,'Glo Pac LV-L',3,94,0,0,'Polímero reductor de filtrado Baja viscosidad',NULL,71,''),(50,'Glo Pac R',3,94,0,0,'Polimero reductor de filtrado y viscosificante',NULL,69,''),(51,'Glo Pac R-L',3,94,0,0,'Polimero reductor de filtrado y viscosificante',NULL,71,''),(52,'Glo Pac R HT L',3,94,0,0,'Polimero reductor de filtrado y viscosificante',NULL,71,''),(53,'Glo Pac R-HT',3,94,0,0,'Polimero reductor de filtrado y viscosificante',NULL,79,''),(54,'GLO PAC HT L',3,94,0,0,'Polimero reductor de filtrado y viscosificante',NULL,71,''),(55,'GLO PAC L',3,94,0,0,'Reductor de filtrado',NULL,59,''),(56,'GLO LIQUI GIL',3,94,0,0,'Gilsonita liquida reductor de filtrado',NULL,71,''),(57,'GLO LIQUI GIL',3,94,0,0,'Gilsonita liquida reductor de filtrado',NULL,59,''),(58,'PHPA ',3,94,0,0,'Polímero de poliacrilamida parcialmente hidrolizada (PHPA).',NULL,70,''),(59,'PHPA ',3,94,0,0,'Polímero de poliacrilamida parcialmente hidrolizada (PHPA).',NULL,71,''),(60,'GLO THIN',17,102,0,0,'Lignito Molido',NULL,79,''),(61,'LIGNITO MOLIDO',17,88,0,0,'LIGNITO SULFONADO',NULL,79,''),(62,'LIGNITO MOLIDO',17,94,0,0,'SUPER LIG',NULL,79,''),(63,'GLO CARBONITE',17,94,0,0,'Lignito modificado (esferas de grafito)',NULL,79,''),(64,'NXB-4000 (GLO X TEND 100)',17,88,0,0,'POLIACRILATO DE SODIO (EXTEND DE BENT)',NULL,69,''),(65,'GLO BIOPOLYMER HT L',18,92,0,0,'Goma xantana líquida para alta temperatura',NULL,71,''),(66,'GLO BIOPOLYMER HT-L CUB',1,92,0,0,'GOMA XANTANA LIQUIDA PARA ALTA TEMP',NULL,63,''),(67,'GLO BIOPOLYMER HT L',18,94,0,0,'GOMA XANTANA LIQUIDA PARA ALTA TEMP',NULL,59,''),(68,'GLO BIOPOLYMER HT(GOMA XANTANA)',18,88,0,0,'Goma xantana en polvo ',NULL,69,''),(69,'HEC POLYMER',18,88,0,0,'HIDROXIETIL CELULOSA',NULL,69,''),(70,'HEC POLYMER',18,94,0,0,'POLIMERO PARA VISCOCIFICAR SALMUERA',NULL,59,''),(71,'GLO HEC-L',18,94,0,0,'POLIMERO PARA VISCOCIFICAR SALMUERA',NULL,63,''),(72,'GLO CLAY TREAT',19,92,0,0,'SILICATO DE SODIO: Inhibidor de lutitas',NULL,71,''),(73,'SILICATO DE SODIO',19,92,0,0,'SILICATO DE SODIO',NULL,71,''),(74,'GLO SURF 200',20,92,0,0,'Surfactante  ',NULL,71,''),(75,'GLO X LUBE 300',20,92,0,0,'Lubricantes de presión extrema',NULL,71,''),(76,'GLO SLICK P ( GRAFITO )',20,88,0,0,'Grafito siliconizado',NULL,79,''),(77,'GLO SLICK P ( GRAFITO )',20,88,0,0,'Grafito siliconizado',NULL,69,''),(78,'GLO LUBE 300',20,92,0,0,'Lubricante base agua',NULL,71,''),(79,'GLO LUBE 400',20,92,0,0,'LUBRICANTE BASE AGUA',NULL,71,''),(80,'GLO ENVIRO DRILL 300',20,94,0,0,'Lubricante base glicoles',NULL,71,''),(81,'GLO SUR SWEEP 10',20,97,0,0,'Surfactante Limpiador',NULL,71,''),(82,'GLO CARBO-BEAD ',20,94,0,0,'Esferas de Grafito',NULL,73,''),(83,'DIPROPOLENGRICOL',20,94,0,0,'DIPROPOLENGRICOL',NULL,71,''),(84,'MONOETILENGRICOL FIBRA',20,94,0,0,'MONOETILENGRICOL FIBRA',NULL,71,''),(85,'NONIL FENOL FIBRA O BD ',20,94,0,0,'NONIL FENOL FIBRA O BD ',NULL,71,''),(86,'GLO ECCO SPOT',21,94,0,0,'Despegador de tuberías',NULL,71,''),(87,'GLO LOW WEIGTH',22,92,0,0,'Espumante',NULL,59,''),(88,'GLO LOW WEIGTH',22,94,0,0,'Espumante',NULL,71,''),(89,'GLO DEFOAM 200',22,94,0,0,'Antiespumante',NULL,71,''),(90,'GLO DEFOAM 100',22,94,0,0,'Antiespumante',NULL,71,''),(91,'GLO D FOAM 1000',22,94,0,0,'Antiespumante',NULL,62,''),(92,'MO D FOAM 1000',22,94,0,0,'Antiespumante (resina de silicona) prod Mogel',NULL,62,''),(93,'SILBREAK 1RA FORMULACION',22,94,0,0,'Antiespumante (resina de silicona)',NULL,71,''),(94,'Antiespumante (resina de silicona)',22,94,0,0,'SILBREAK 638',NULL,71,''),(95,'SILBREAK 638 REENTARIMADO',22,94,0,0,'ANTIESPUMANTE',NULL,71,''),(96,'Glo Silbreak 600',22,94,0,0,'Espumante y desemulsificante de hidrocarburos',NULL,71,''),(97,'GLO GEL 10',23,96,0,0,'Arcilla Organofilica',NULL,79,''),(98,'EMULS PRIMARIO CONCENTRADO',23,94,0,0,'EMULS PRIMARIO CONCENTRADO',NULL,71,''),(99,'EMULS SECUNDARIO CONCENTRADO',23,94,0,0,'EMULS SECUNDARIO CONCENTRADO',NULL,71,''),(100,'GLO MUL 701',23,94,0,0,'Emulsificante primario',NULL,71,''),(101,'GLO MUL 702',23,94,0,0,'Emulsificante secundario',NULL,71,''),(102,'GLO RES A  (GILSONITA HT)',23,94,0,0,'Reductor de flitrado con asfalto',NULL,79,''),(103,'GLO RES B (LIGAM II)',23,94,0,0,'Reductor de filtrado sin asfalto ( LIGAM II)',NULL,79,''),(104,'GLO MUL BD',23,94,0,0,'Emulsificante para fluido Baja Densidad TH PETT',NULL,70,''),(105,'GLO SULF X-100',23,88,0,0,'Secuestrante de H2S( Óxido de Zinc)',NULL,79,''),(106,' GLO PDS-L',23,94,0,0,' GLO PDS-L',NULL,71,''),(107,'GLO COR 197',23,94,0,0,'GLO COR 197',NULL,71,''),(108,'MO BENT',26,88,0,0,'Bentonita NT',NULL,65,''),(109,'MO BENT SOD',26,88,0,0,'Bentonita Sodica procesada',NULL,65,''),(110,'MO BENT',26,89,0,0,'BENTONITA (No tratada)',NULL,61,''),(111,'MO SOSA',26,88,0,0,'Hidroxido de sodio o Sosa Caustica',NULL,69,''),(112,'MO Na2CO3 (ligero)',26,88,0,0,'Carbonato de sodio (ligero) ',NULL,69,''),(113,'MO NaHCO3',26,88,0,0,'Bicarbonato sodio',NULL,68,''),(114,'MO KOH',26,88,0,0,'Hidroxido de Potasio en escamas',NULL,58,''),(115,'MO CAL',26,88,0,0,'Hidroxido de Calcio',NULL,69,''),(116,'MO NaCl F (SAL FINA)',26,88,0,0,'Cloruro de sodio (Sal Fina)',NULL,68,''),(117,'MO NaCl F (SAL FINA)',26,88,0,0,'Cloruro de sodio (Sal Fina)',NULL,68,''),(118,'MO NaCl MOLIDA',26,88,0,0,'Cloruro de sodio ( sal molida)',NULL,68,''),(119,'MO NaCl MARTAJADA',26,88,0,0,'Cloruro de sodio (Sal MARTAJADA)',NULL,58,''),(120,'MO NaCl SAL PULVERIZADA ROCHE',26,88,0,0,'Cloruro de sodio',NULL,68,''),(121,'MO NaCl SAL PULVERIZADA SAYULA',26,89,0,0,'Cloruro de sodio',NULL,61,''),(122,'MO CaCl2  g',26,88,0,0,'Cloruro de calcio granular',NULL,70,''),(123,'MO CaCl2  F',26,88,0,0,'Cloruro de calcio FINO',NULL,70,''),(124,'MO CaCl2  f',26,88,0,0,'Cloruro de calcio Fino',NULL,69,''),(125,'MO KCl (CLORURO DE POTASIO)',26,88,0,0,'Cloruro de potasio',NULL,68,''),(126,'MO KCl (CLORURO DE POTASIO)',26,88,0,0,'Cloruro de potasio',NULL,69,''),(127,'GLO STARCH (ALMIDON PREGELATINIZADO)',28,88,0,0,'Estabilizador para perdidas de Fluidos ',NULL,69,''),(128,'MO CaCO3 M-30-40',28,88,0,0,'Carbonato de calcio grueso',NULL,68,''),(129,'MO CaCO3 M-70',28,88,0,0,'Carbonato de calcio medio',NULL,68,''),(130,'MO CaCO3 M-100',28,88,0,0,'Carbonato de calcio medio',NULL,68,''),(131,'MO CaCO3 M-200',28,88,0,0,'Carbonato de calcio fino',NULL,68,''),(132,'MO CaCO3 M-325',28,88,0,0,'Carbonato de calcio fino',NULL,68,''),(133,'GLO MICA F,M,C',28,88,0,0,'Obturante a base de mica',NULL,69,''),(134,'GLO KILL LOSS',26,99,0,0,'Obturante a base de laminado FORMAICA',NULL,60,''),(135,'GLO BORE SEAL F',28,100,0,0,'Cascara de Arroz Fino',NULL,60,''),(136,'GLO BORE SEAL M',28,100,0,0,'LCM Cascara de Arroz Medio',NULL,60,''),(137,'GLO WALNUT PLUG F',28,88,0,0,'Cascara de Nuez Fino',NULL,69,''),(138,'GLO WALNUT PLUG M',28,88,0,0,'Cascara de Nuez Medio',NULL,69,''),(139,'GLO CEDAR  FIBER F',28,88,0,0,'Aserrin Fino ',NULL,76,''),(140,'Glo CEDAR  FIBER G',28,88,0,0,'Aserrin Grueso',NULL,67,''),(141,'GLO SUPER SWEEP',28,101,0,0,'Fibra sintetica de monofilamento (pelo de angel)',NULL,58,''),(142,'PH BUFFER',32,88,0,0,'PH BUFFER',NULL,79,''),(143,'PLUG SAL ',32,88,0,0,'Sal sodica tamizada',NULL,79,''),(144,'PLUG SAL X',32,88,0,0,'Sal sodica tamizada',NULL,79,''),(145,'PLG SAL XC',32,88,0,0,'Sal sodica tamizada',NULL,79,''),(146,'THERMASAL A',32,88,0,0,'Sal sodica tamizada',NULL,79,''),(147,'THERMASAL B',32,88,0,0,'Sal sodica tamizada',NULL,79,''),(148,'THIXSAL ULTRA',32,88,0,0,'Polimero para salmuera',NULL,79,''),(149,'ULTRA SAL 10 E',32,88,0,0,'Obturante de sal sodica',NULL,79,''),(150,'ULTRA SAL 20 E',32,88,0,0,'Obturante de sal sodica',NULL,79,''),(151,'ULTRA SAL 30 E',28,88,0,0,'Obturante de sal sodica',NULL,79,''),(152,'ULTRA SAL 5E',28,88,0,0,'Obturante de sal sodica',NULL,79,''),(153,'ULTRA  BREAK - M ',32,88,0,0,'ULTRA  BREAK - M ',NULL,79,''),(154,'GLO MAX 100',32,88,0,0,'GLO MAX 100',NULL,79,''),(155,'GLO MAX 200',28,88,0,0,'GLO MAX 200',NULL,79,''),(156,'CM-TH',28,88,0,0,'PARA  CIMENTACIONES',NULL,79,''),(157,'INHIBISAL ULTRA -B',28,88,0,0,'INHIBISAL ULTRA -B',NULL,79,''),(158,'FL7-PLUS',28,88,0,0,'FL7-PLUS',NULL,79,''),(159,'GLO BIOPOLYMER (GOMA XANTANA)',18,94,0,0,'GOMA XANTANA EN POLVO',NULL,69,''),(160,'ÁCIDO CÍTRICO',26,94,0,0,'ACIDO CITRICO',NULL,69,''),(161,'Teclado',2,94,0,0,'teclado',NULL,58,''),(162,'banana',1,88,200,0,'banana',NULL,60,''),(163,'banana',2,88,300,0,'banana',NULL,60,''),(164,'manzana',1,88,500,0,'manzana',NULL,58,'');
/*!40000 ALTER TABLE `material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material_tipo`
--

DROP TABLE IF EXISTS `material_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material_tipo` (
  `material_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Abreviatura',
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`material_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Categorias de los materiales';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_tipo`
--

LOCK TABLES `material_tipo` WRITE;
/*!40000 ALTER TABLE `material_tipo` DISABLE KEYS */;
INSERT INTO `material_tipo` VALUES (1,'MISC','MISCELANEOS','Materiales/Equipo'),(2,'MAT','MATERIALES','Materiales/Equipo'),(3,'POL','POLIMERO REDUCTOR DE FILTRADO BASE AGUA','Materiales/Equipo'),(17,'DISP','DISPERSANTE','Materiales/Equipo'),(18,'VISCFA','VISCOSIFICANTE PARA FLUIDO BASE AGUA','Materiales/Equipo'),(19,'INH','INHIBIDOR DE ARCILLA','Materiales/Equipo'),(20,'LUB','LUBRICANTES-SURFACTANTES','Materiales/Equipo'),(21,'DTUB','DESPEGADOR DE TUBERIA','Materiales/Equipo'),(22,'ESP-ANTI','ESPUMANTE Y ANTIESPUMANTE','Materiales/Equipo'),(23,'AD-LBA','ADITIVOS PARA LODO BASE ACEITE','Materiales/Equipo'),(24,'SEC','SECUESTRANTE DE H2S','Materiales/Equipo'),(25,'INHCOR','INHIBIDOR DE CORROSION','Materiales/Equipo'),(26,'M-FLU','MOGEL FLUIDOS','Materiales/Equipo'),(27,'DESIF','DENSIFICANTES','Materiales/Equipo'),(28,'OBT','OBTURANTES','Materiales/Equipo'),(29,'DIESEL','DIESEL','Materiales/Equipo'),(30,'EQTAS','ETIQUETAS PARA PRODUCTOS','Materiales/Equipo'),(31,'MAT-PROD','MATERIA PRIMA  PARA  PRODUCTOS DE PRODUCCION','Materiales/Equipo'),(32,'TBC','TBC BRINADD (SALES)','Materiales/Equipo'),(33,'MODES','MODES','Materiales/Equipo'),(34,'GLO','GLO HANS','Materiales/Equipo'),(35,'NVO-MAT','NUEVO MATERIAL','Materiales/Equipo'),(36,'INSUMOS','INSUMOS','Materiales/Equipo'),(37,'CRIST','CRISTALERIA','Materiales/Equipo');
/*!40000 ALTER TABLE `material_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mina`
--

DROP TABLE IF EXISTS `mina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mina` (
  `id_mina` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_material` bigint(20) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `cantidad` bigint(20) NOT NULL,
  `observaciones` varchar(500) NOT NULL,
  PRIMARY KEY (`id_mina`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mina`
--

LOCK TABLES `mina` WRITE;
/*!40000 ALTER TABLE `mina` DISABLE KEYS */;
INSERT INTO `mina` VALUES (1,2578,'2018-05-04 17:10:01',10,'prueba preeliminar'),(2,967,'2018-05-04 17:59:25',80,'prueba preliminar'),(3,967,'2018-05-04 19:20:51',10,'super sacos');
/*!40000 ALTER TABLE `mina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moneda`
--

DROP TABLE IF EXISTS `moneda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moneda` (
  `moneda_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `moneda_descripcion` varchar(200) NOT NULL,
  `moneda_prefijo` varchar(50) NOT NULL,
  `moneda_tipo_cambio` double NOT NULL,
  PRIMARY KEY (`moneda_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moneda`
--

LOCK TABLES `moneda` WRITE;
/*!40000 ALTER TABLE `moneda` DISABLE KEYS */;
INSERT INTO `moneda` VALUES (1,'Pesos Mexicanos','MXN',1),(2,'Dolar Americano',' USD',19.22);
/*!40000 ALTER TABLE `moneda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nota_credito`
--

DROP TABLE IF EXISTS `nota_credito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nota_credito` (
  `nota_credito_id` bigint(20) NOT NULL,
  `orden_salida_id` bigint(20) NOT NULL,
  PRIMARY KEY (`nota_credito_id`),
  KEY `orden_salida_id` (`orden_salida_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla NOTA CREDITO';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nota_credito`
--

LOCK TABLES `nota_credito` WRITE;
/*!40000 ALTER TABLE `nota_credito` DISABLE KEYS */;
/*!40000 ALTER TABLE `nota_credito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operador`
--

DROP TABLE IF EXISTS `operador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operador` (
  `operador_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido_p` varchar(20) DEFAULT NULL,
  `apellido_m` varchar(20) DEFAULT NULL,
  `permiso` varchar(1) DEFAULT NULL,
  `licencia_no` varchar(12) DEFAULT NULL,
  `vigencia` date DEFAULT NULL,
  PRIMARY KEY (`operador_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operador`
--

LOCK TABLES `operador` WRITE;
/*!40000 ALTER TABLE `operador` DISABLE KEYS */;
INSERT INTO `operador` VALUES (1,'luis','vazquez','ramirez','B','1234567890','2020-05-25'),(14,'angel','vazquez','ramirez','A','y893429','2020-02-29'),(16,'das','dasdasd','prueba','A','adads','2020-02-13');
/*!40000 ALTER TABLE `operador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orden_compra`
--

DROP TABLE IF EXISTS `orden_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orden_compra` (
  `orden_compra_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` varchar(200) NOT NULL,
  `proveedor_id` bigint(20) DEFAULT NULL,
  `fecha_compra` datetime DEFAULT NULL,
  `fecha_entrega_prometida` datetime DEFAULT NULL,
  `fecha_entrega` varchar(200) DEFAULT NULL,
  `orden_observaciones` varchar(200) DEFAULT NULL,
  `moneda_id` bigint(20) DEFAULT NULL,
  `orden_divisa_dia` float DEFAULT NULL,
  `orden_edo` tinyint(4) DEFAULT NULL,
  `factura_proveedor` varchar(50) DEFAULT NULL COMMENT 'No. Factura Proveedor',
  `usuario_id_almacen` varchar(20) DEFAULT NULL COMMENT 'Usuario del almacen',
  `req_id` bigint(20) NOT NULL,
  `proveedor_contacto` varchar(200) DEFAULT NULL,
  `proveedor_email` varchar(200) DEFAULT NULL,
  `proveedor_tel` varchar(50) DEFAULT NULL,
  `folio_orden` varchar(20) DEFAULT NULL,
  `usuario_id_autoriza` varchar(10) DEFAULT NULL,
  `fecha_autoriza` date DEFAULT NULL,
  `condiciones` varchar(250) DEFAULT NULL,
  `certificado` varchar(250) DEFAULT NULL,
  `contacto_entrega` varchar(250) DEFAULT NULL,
  `domicilio_entrega` varchar(250) DEFAULT NULL,
  `tipo_orden` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`orden_compra_id`),
  KEY `proveedor_id` (`proveedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COMMENT='Tabla ORDEN_COMPRA';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orden_compra`
--

LOCK TABLES `orden_compra` WRITE;
/*!40000 ALTER TABLE `orden_compra` DISABLE KEYS */;
INSERT INTO `orden_compra` VALUES (2,'ButronJ',1,'2018-09-20 00:00:00','2018-09-20 00:00:00',NULL,'',NULL,NULL,3,NULL,NULL,18,'JOSE FRANCISCO  ','mexicanadefletes@yahoo.com','RODR?GUEZ','VH-GD-16-066','ButronJ','2018-09-20','prueba','1','juan','av','MISC'),(3,'ButronJ',1,'2018-09-21 00:00:00','2018-09-28 00:00:00',NULL,'PRUEBA',NULL,NULL,3,NULL,NULL,18,'JOSE FRANCISCO  ','mexicanadefletes@yahoo.com','RODR?GUEZ','VH-GD-16-067','ButronJ','2018-09-20','PRUEBA','1',' PRUEBA','PRUEBA','MISC'),(4,'ButronJ',1,'2018-09-21 00:00:00','2018-09-21 00:00:00','2018-09-21 00:00:00','prueba',NULL,NULL,4,'F5555','ButronJ',18,'JOSE FRANCISCO  ','mexicanadefletes@yahoo.com','RODR?GUEZ','VH-GD-16-068','ButronJ','2018-09-21','prueba','0','prueba','prueba','MISC'),(5,'Monica D',96,'2018-09-21 00:00:00','2018-09-28 00:00:00','2018-09-21 00:00:00','atras del mercado ',NULL,NULL,4,'rh20','Monica D',22,'JUAN JOSE  VAZQUEZ GALLEGOS','jgallegos@officedepot.com.mx','3522320 ','VH-GD-16-069','ADMIN 02','2018-09-21','transferencia electronica de fondos ','1','monica delgado merinos ','2 de abril 114 tihuatlan ','MISC'),(6,'ADMIN 02',48,'2018-10-04 00:00:00','2018-10-05 00:00:00','2018-10-04 00:00:00','',NULL,NULL,4,'OCT0418','ADMIN 02',23,'PENDIENTE PENDIENTE ','prov-pen-47@p.com','','VH-GD-16-0610','ADMIN 02','2018-10-04','DE CONTADO','2','ING. RUBEN PANCARDO','CARRETERA ZAPOTALILLO - CASTILLO DE TEAYO L-14, TIHUATLAN , VER.','MISC'),(7,'ButronJ',NULL,'2018-10-08 12:15:22',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'ButronJ',NULL,'2018-10-08 12:15:22',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'ButronJ',NULL,'2018-10-08 12:15:22',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'ButronJ',NULL,'2018-10-08 12:15:23',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,'ButronJ',NULL,'2018-10-08 12:15:23',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'ButronJ',NULL,'2018-10-08 12:15:23',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'ButronJ',NULL,'2018-10-08 12:15:23',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'ButronJ',NULL,'2018-10-08 12:15:23',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'ButronJ',NULL,'2018-10-08 12:15:23',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'ButronJ',NULL,'2018-10-08 12:15:23',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'ADMIN 02',96,'2018-10-08 00:00:00','2018-10-09 00:00:00','2018-10-08 00:00:00','COMPUTADORAS NUEVAS',NULL,NULL,4,'OFFICE081018','ADMIN 02',24,'JUAN JOSE  VAZQUEZ GALLEGOS','jgallegos@officedepot.com.mx','3522320 ','VH-GD-16-0611','ADMIN 02','2018-10-08','CONTADO','1','JUAN MANUEL ABURTO','TIHUATLAN, VERACRUZ','MISC'),(18,'ADMIN 02',96,'2018-10-10 00:00:00','2018-10-11 00:00:00','2018-10-10 00:00:00','INCLUYEN OFFICE',NULL,NULL,4,'OF-101018-MF','ADMIN 02',28,'JUAN JOSE  VAZQUEZ GALLEGOS','jgallegos@officedepot.com.mx','3522320 ','VH-GD-16-0612','ADMIN 02','2018-10-10','CONTADO','1','JUAN MANUEL ABURTO','CARRET. ZAPOTALILLO - CASTILLO DE TEAYO LOTE 14, TIHUATLAN','MISC'),(19,'ADMIN 02',96,'2018-12-05 00:00:00','2018-12-06 00:00:00','2018-12-05 00:00:00','',NULL,NULL,4,'OFIX0501218','ADMIN 02',36,'JUAN JOSE  VAZQUEZ GALLEGOS','jgallegos@officedepot.com.mx','3522320 ','VH-GD-16-0613','ADMIN 02','2018-12-05','Neto contra entrega de material, remisiones y facturas correspondientes','2','ruben pancardo','carret zapotalillo km 14.5, Tihutlan, Ver.','MISC'),(20,'Wicho',103,'2020-01-27 00:00:00','2020-01-31 00:00:00',NULL,'preueba',NULL,NULL,1,NULL,NULL,18,'Proveedor de prueba Prueba ','prueba@prueba.com','','VH-GD-16-0614',NULL,NULL,'preueba','1','luis','guerrero sur ','MISC');
/*!40000 ALTER TABLE `orden_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orden_salida`
--

DROP TABLE IF EXISTS `orden_salida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orden_salida` (
  `orden_salida_id` bigint(20) NOT NULL,
  `pedido_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`orden_salida_id`),
  CONSTRAINT `orden_salida_ibfk_1` FOREIGN KEY (`orden_salida_id`) REFERENCES `pedido` (`pedido_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla Orden de Salida';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orden_salida`
--

LOCK TABLES `orden_salida` WRITE;
/*!40000 ALTER TABLE `orden_salida` DISABLE KEYS */;
/*!40000 ALTER TABLE `orden_salida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pantalla`
--

DROP TABLE IF EXISTS `pantalla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pantalla` (
  `pantalla_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no_menu_orden` int(11) NOT NULL,
  `pantalla_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `pantalla_descripcion` varchar(50) NOT NULL,
  `id_pantalla_padre` int(11) NOT NULL,
  `pantalla_url` varchar(50) NOT NULL DEFAULT 'NULL',
  `nombre_imagen` varchar(50) NOT NULL,
  PRIMARY KEY (`pantalla_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1 COMMENT='Tabla PANTALLA';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pantalla`
--

LOCK TABLES `pantalla` WRITE;
/*!40000 ALTER TABLE `pantalla` DISABLE KEYS */;
INSERT INTO `pantalla` VALUES (2,1,'ADMIN','Menu de catalogos',0,'CATALOGOS.php',''),(3,1,'PROVEEDORES','Modulo Proveedor',6,'proveedor_busqueda.php','proveedor'),(5,2,'VENTAS','Menu de Ventas',0,'VENTAS.php',''),(6,3,'COMPRAS','Menu de Compras',0,'COMPRAS.php',''),(7,4,'FACTURACION','Menu de Facturacion',0,'FACTURACION.php',''),(8,5,'ALMACEN','Menu de Almacen',0,'ALMACEN.php',''),(9,6,'PRODUCCIÓN','Menu de Taller',0,'TALLER.php',''),(10,7,'LABORATORIO','Menu de Laboratorio',0,'CALIDAD.php',''),(11,8,'TRANSPORTES','Menu de Trafico',0,'TRAFICO.php',''),(12,7,'ALMACENES','Catalogo de Almacen',8,'almacen_busqueda.php','almacen'),(13,6,'PRODUCTO Y MATERIAL','Catalogo de Material',8,'material_busqueda.php','material'),(14,1,'EMPRESAS','Catalogo de Empresa',2,'empresa_busqueda.php','empresa'),(15,2,'LUGARES DE DESTINO','Catalogo de Matriz',29,'matriz_sucursal_busqueda.php','proveedor'),(16,7,'ASIGNACIÓN DE PRECIOS','Catalogo de Precio',5,'precios_busqueda.php','precio'),(17,2,'MONEDAS','Catalogo de Moneda',2,'moneda_busqueda.php','moneda'),(18,1,'TRANSPORTE','Catalogo de Transporte',9,'transporte_busqueda.php','transporte'),(19,1,'USUARIOS','Catalogo de Usuario',30,'usuario_busqueda.php','usuario'),(20,2,'PERFILES','Catalogo de Perfiles',30,'perfil_busqueda.php','perfiles'),(21,3,'PANTALLA','Catalogo de Pantalla',30,'pantalla_busqueda.php','pantalla'),(22,0,'PROSPECTO','Modulo Prospectar',5,'prospecto_busqueda.php','1'),(23,1,'COTIZACIONES','Modulo de Cotizaciones',5,'cotizacion_busqueda_usuario.php','suite'),(29,5,'CLIENTE','Pantalla general de clientes',5,'CLIENTE.php','cliente'),(30,3,'USUARIO','Modulo de Usuario',2,'USUARIO.php','usuario'),(31,2,'PEDIDOS','Modulo de Ordenes de salida',5,'ordenes_salida_busqueda_usuario.php','orden'),(32,0,'BITÁCORA DE RECOLECCIÓN','Modulo de ecoleccion de equipo',11,'recoleccion_equipo_busqueda_usuario.php','extintores'),(33,0,'CONTRATOS','Modulo de contratos de clientes',5,'contrato_busqueda.php','noticias'),(34,2,'ORDENES DE COMPRA','Modulo de Ordenes de compra de clientes',6,'compra_busqueda_usuario.php','ordenold'),(35,1,'FACTURAR PEDIDOS','Modulo de Facturacion de Ordenes de Salida',7,'factura_busqueda.php','pantalla'),(36,1,'REQUISICIÓN DE COMPRAS','Modulo de entradas al almacen',8,'req_busqueda_usuario_almacen.php','ordenold'),(37,5,'INVENTARIO','Consulta de inventario de almacen',8,'almacen_inventario.php','inventarioold'),(42,4,'SALIDAS DE ALMACÉN','Menú salidas',8,'SALIDAS.php','orden'),(43,8,'MATERIAL SIN STOCK','Material sin stock',8,'material_sinstock_busqueda.php','cliente'),(44,1,'PEDIDOS PRODUCCIÓN','Módulo de Ordenes de salida de taller',9,'taller_ordenes_salida.php','orden'),(45,2,'SOLICITUDES DE MATERIAL PARA PRODUCCIÓN','Módulo de solicitudes de material de taller',9,'taller_solicitud_material.php','pantalla'),(46,0,'VALES DE CONSUMO','Módulo de solicitud de vales de consumo',9,'taller_vales_consumo.php','noticias'),(47,1,'ORDENES DE LABORATORIO','Módulo de ordenes de salida de calidad',10,'calidad_busqueda.php','proveedor'),(48,1,'ASIGNACIÓN DE RUTAS','Módulo de asignación de rutas',11,'logistica_busqueda.php','9'),(49,2,'RECEPCIÓN DE RUTAS','Módulo de ordenes de entrega de logistca',11,'entrega_busqueda.php','proveedor'),(50,3,'TRANSPORTES','Catálogo de transportes',11,'transporte_busqueda.php','transporte'),(51,6,'PEDIDOS','Módulo de ordenes de salida de almacen',8,'almacen_orden_salida.php','orden'),(52,4,'SOLICITUDES DE MATERIAL','Módulo de solicitudes de material de almacen',8,'almacen_solicitud_material_busqueda.php','pantalla'),(53,0,'VALES DE CONSUMO','Módulo de vales de consumo almacen',42,'almacen_vales_consumo_busqueda.php','noticias'),(54,5,'REPORTES','Reportes de Ventas',5,'REPORTES_VENTAS.php','noticias'),(55,2,'REPORTE DE VENTAS','Comparativo de Ventas Mensual y Anual',54,'reporte_comparativo_ventas.php','noticias'),(56,4,'ASIGNACIÓN DE PEDIDOS','Distribuir Equipo Nuevo y Recargas',5,'almacen_orden_salida_Autorizacion.php','orden'),(57,2,'REQUISICIÓN DE COMPRAS AUTORIZACION','Modulo de Requisicón de compras - Autorización',8,'req_busqueda_usuario_almacen_autorizar.php','ordenold'),(58,3,'ORDENES DE COMPRA AUTORIZACION','Autorizacion de Ordenes de compra a proveedores',6,'compra_busqueda_usuario_autorizar.php','ordenold'),(59,3,'ENTRADA DE PEDIDOS','Entrada de Ordenes de Compra',8,'compra_busqueda_usuario_almacen.php','ordenold'),(60,1,'PEDIDOS MOLINO','Módulo de Pedidos entregados al Molino',9,'molino_ordenes_salida.php','orden'),(61,2,'SOLICITUDES DE LABORATORIO','Módulo de solicitudes de laboratorio',10,'calidad_solicitudes_busqueda.php','proveedor'),(62,9,'HISTORIAL MOVIMIENTOS','Consulta de Historial de entradas y salidas',8,'almacen_historial.php','inventarioold'),(63,2,'SOLICITUD DE MATERIAL','Módulo de solicitudes de material de taller',9,'taller_solicitud_material.php','pantalla'),(64,11,'UNIDADES','Catalogo de Unidades',8,'unidad_busqueda.php','almacen'),(65,11,'PRESENTACIONES','Catalogo de Presentaciones',8,'presentacion_busqueda.php','almacen'),(66,11,'ALMACEN MINA','Almacen de la mina',8,'almacen_mina.php','almacen'),(67,3,'REMOLQUES','Catálogo de Remolques',11,'remolque_busqueda.php','transporte'),(75,8,'OPERADORES','registro de operadores',11,'operador_busqueda.php','operador'),(76,1,'CLIENTES','modulo clientes',29,'cliente_busqueda.php','5');
/*!40000 ALTER TABLE `pantalla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parametros`
--

DROP TABLE IF EXISTS `parametros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parametros` (
  `parametro_id` int(11) NOT NULL AUTO_INCREMENT,
  `parametro_var` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `parametro_1` int(11) NOT NULL,
  `parametro_2` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`parametro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parametros`
--

LOCK TABLES `parametros` WRITE;
/*!40000 ALTER TABLE `parametros` DISABLE KEYS */;
INSERT INTO `parametros` VALUES (1,'VH-MF',11,16,'COMPRAS MOGEL','COMPRAS'),(2,'VH-GD',15,16,'COMPRAS GLOBAL','COMPRAS'),(3,'LAB',163,0,'LABORATORIO','REQ'),(4,'PER',250,0,'PERFORACION','REQ'),(5,'MF',1169,0,'ALMACEN','REQ'),(6,'PRO',2,0,'PRODUCCION','REQ'),(7,'MTTO',1,0,'MANTENIMIENTO','REQ'),(8,'OFI',5,0,'OFICINAS','REQ'),(9,'NOTA_SALIDA',59,0,'FOLIO DE NOTAS \r\n\r\nDE SALIDA','NOTAS');
/*!40000 ALTER TABLE `parametros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partida`
--

DROP TABLE IF EXISTS `partida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partida` (
  `partida_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `partida_no` bigint(20) NOT NULL COMMENT 'numero de partida',
  `producto_id` bigint(20) DEFAULT NULL,
  `partida_cantidad` decimal(10,0) NOT NULL COMMENT 'cantidad de producto por partida',
  `contrato_id` bigint(10) NOT NULL,
  PRIMARY KEY (`partida_id`),
  KEY `contrato_id` (`contrato_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla PARTIDA por Contrato';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partida`
--

LOCK TABLES `partida` WRITE;
/*!40000 ALTER TABLE `partida` DISABLE KEYS */;
/*!40000 ALTER TABLE `partida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido` (
  `pedido_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cotizacion_id` bigint(20) DEFAULT NULL,
  `sucursal_id` bigint(20) DEFAULT NULL,
  `pedido_fecha_creacion` datetime NOT NULL,
  `pedido_fecha_entrega` datetime DEFAULT NULL,
  `pedido_estado` tinyint(4) NOT NULL DEFAULT 0,
  `pedido_obs` varchar(100) DEFAULT NULL,
  `contrato_id` varchar(10) DEFAULT NULL,
  `partida_id` bigint(20) DEFAULT NULL,
  `folio_pedido` varchar(20) DEFAULT NULL,
  `usuario_id` varchar(10) NOT NULL,
  `pedido_fecha_recoleccion` datetime DEFAULT NULL,
  `logistica_solicitud` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`pedido_id`),
  KEY `cotizacion_id` (`cotizacion_id`),
  KEY `sucursal_id` (`sucursal_id`),
  KEY `partida_id` (`partida_id`),
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizacion` (`cotizacion_id`),
  CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`sucursal_id`),
  CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`partida_id`) REFERENCES `partida` (`partida_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1 COMMENT='Tabla Pedidos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (8,15,NULL,'2018-09-20 00:00:00','2018-09-27 00:00:00',1,'prueba',NULL,NULL,'1','ButronJ',NULL,NULL),(9,15,NULL,'2018-09-21 00:00:00','2018-09-25 00:00:00',1,'prueba 2',NULL,NULL,'9','ButronJ',NULL,NULL),(10,15,NULL,'2018-09-21 00:00:00','2018-09-27 00:00:00',1,'',NULL,NULL,'10','ButronJ',NULL,NULL),(11,20,16,'2018-09-21 00:00:00','2018-09-28 00:00:00',1,'',NULL,NULL,'11','Monica D',NULL,NULL),(12,21,16,'2018-09-21 00:00:00','2018-09-24 00:00:00',1,'',NULL,NULL,'12','Monica D',NULL,NULL),(13,22,16,'2018-09-21 00:00:00','2018-09-22 00:00:00',1,'',NULL,NULL,'13','Monica D',NULL,NULL),(14,23,16,'2018-10-02 00:00:00','2018-10-02 00:00:00',1,'VENTA DE EQUIPO DE COMPUTO',NULL,NULL,'14','ADMIN 02',NULL,NULL),(15,24,NULL,'2018-10-02 00:00:00','2018-10-09 00:00:00',1,'prueba componentes',NULL,NULL,'15','ButronJ',NULL,NULL),(16,25,NULL,'2018-10-03 00:00:00','2018-10-04 00:00:00',1,'',NULL,NULL,'16','ADMIN 02',NULL,NULL),(17,26,NULL,'2018-10-05 00:00:00','2018-10-06 00:00:00',1,'FLUJO PRODUCCION',NULL,NULL,'17','ADMIN 02',NULL,NULL),(18,28,NULL,'2018-10-05 00:00:00','2018-10-06 00:00:00',1,'',NULL,NULL,'18','ADMIN 02',NULL,NULL),(19,29,NULL,'2018-10-09 00:00:00','2018-10-10 00:00:00',1,'',NULL,NULL,'19','ADMIN 02',NULL,NULL),(20,30,NULL,'2018-10-09 00:00:00','2018-10-10 00:00:00',1,'',NULL,NULL,'20','ADMIN 02',NULL,NULL),(21,31,NULL,'2018-10-16 00:00:00','2018-10-17 00:00:00',2,'',NULL,NULL,'21','ADMIN 02',NULL,NULL),(22,32,NULL,'2018-10-16 00:00:00','2018-10-17 00:00:00',1,'',NULL,NULL,'22','ADMIN 02',NULL,NULL),(23,32,NULL,'2018-10-16 00:00:00','2018-10-17 00:00:00',1,'',NULL,NULL,'23','ADMIN 02',NULL,NULL),(24,33,NULL,'2018-10-26 00:00:00','2018-10-27 00:00:00',1,'',NULL,NULL,'24','ButronJ',NULL,NULL),(25,34,NULL,'2018-10-29 00:00:00','2018-10-30 00:00:00',1,'HELLO',NULL,NULL,'25','ADMIN 02',NULL,NULL),(26,35,NULL,'2018-10-29 00:00:00','2018-10-30 00:00:00',1,'',NULL,NULL,'26','ADMIN 02',NULL,NULL),(27,36,NULL,'2018-12-05 00:00:00','2018-12-06 00:00:00',1,'',NULL,NULL,'27','ADMIN 02',NULL,NULL),(28,37,NULL,'2020-01-01 00:00:00','2020-01-09 00:00:00',1,'Entrega final de od ',NULL,NULL,'28','Ana Lau',NULL,NULL),(34,48,NULL,'2020-01-10 00:00:00','2020-01-11 00:00:00',1,'prueba',NULL,NULL,'29','Wicho',NULL,NULL),(35,49,NULL,'2020-01-01 00:00:00','2020-01-14 00:00:00',1,'',NULL,NULL,'35','Ana Lau',NULL,NULL),(36,54,NULL,'2020-02-20 00:00:00','2020-02-29 00:00:00',1,'febrero 2020',NULL,NULL,'36','Wicho',NULL,NULL),(37,54,NULL,'2020-02-20 00:00:00','2020-02-21 00:00:00',1,'FEBRERO 2020 PRUEBA',NULL,NULL,'37','Wicho',NULL,NULL),(38,54,NULL,'2020-02-28 00:00:00','2020-02-29 00:00:00',1,'',NULL,NULL,'38','Wicho',NULL,NULL);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil` (
  `perfil_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `perfil_nombre` varchar(50) NOT NULL DEFAULT '0',
  `perfil_descripcion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1 COMMENT='Tabla PERFIL';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (45,'ADMINISTRADOR','CONTROL TOTAL'),(46,'Operadores',''),(47,'Laboratorio',''),(48,'Almcén',''),(49,'Producción',''),(50,'Logísitica',''),(51,'Ventas / Compras',''),(52,'Entradas y Salidas',''),(53,'Requisiciones - Inventarios',''),(54,'Minero',''),(55,'COMPRAS','PRUEBA'),(57,'JUAN POZA RICA','PRUEBA POZA RICA VENTAS Y COMPRAS'),(58,'JUAN INVENTARIO POZA RICA','PRUEBA DE INVENTARIO POZA RICA'),(59,'invitado',''),(60,'Mogel Transportes','');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil_pantalla`
--

DROP TABLE IF EXISTS `perfil_pantalla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_pantalla` (
  `perfil_pantalla_id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil_id` bigint(20) NOT NULL,
  `pantalla_id` bigint(20) NOT NULL,
  PRIMARY KEY (`perfil_pantalla_id`),
  KEY `perfil_id` (`perfil_id`),
  KEY `pantalla_id` (`pantalla_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3092 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_pantalla`
--

LOCK TABLES `perfil_pantalla` WRITE;
/*!40000 ALTER TABLE `perfil_pantalla` DISABLE KEYS */;
INSERT INTO `perfil_pantalla` VALUES (2014,52,62),(2015,52,37),(2016,52,8),(2017,52,31),(2018,52,5),(2149,53,37),(2150,53,36),(2151,53,8),(2350,54,66),(2351,54,8),(2508,48,47),(2509,48,10),(2510,48,64),(2511,48,65),(2512,48,66),(2513,48,62),(2514,48,43),(2515,48,12),(2516,48,51),(2517,48,13),(2518,48,37),(2519,48,52),(2520,48,59),(2521,48,57),(2522,48,36),(2523,48,8),(2524,49,47),(2525,49,10),(2526,49,45),(2527,49,63),(2528,49,44),(2529,49,60),(2530,49,9),(2531,49,51),(2532,49,37),(2533,49,36),(2534,49,8),(2535,49,34),(2536,49,6),(2555,47,61),(2556,47,47),(2557,47,10),(2558,47,36),(2559,47,8),(2560,47,34),(2561,47,61),(2562,47,47),(2563,47,10),(2564,47,36),(2565,47,8),(2566,47,34),(2597,51,49),(2598,51,48),(2599,51,11),(2600,51,47),(2601,51,10),(2602,51,44),(2603,51,9),(2604,51,64),(2605,51,65),(2606,51,51),(2607,51,13),(2608,51,37),(2609,51,52),(2610,51,42),(2611,51,59),(2612,51,57),(2613,51,36),(2614,51,8),(2615,51,58),(2616,51,34),(2617,51,3),(2618,51,6),(2619,51,16),(2620,51,15),(2621,51,4),(2622,51,29),(2623,51,56),(2624,51,31),(2625,51,23),(2626,51,5),(2627,55,58),(2628,55,34),(2629,55,3),(2630,55,6),(2631,50,50),(2632,50,67),(2633,50,49),(2634,50,48),(2635,50,11),(2636,50,61),(2637,50,47),(2638,50,10),(2639,50,45),(2640,50,63),(2641,50,18),(2642,50,44),(2643,50,60),(2644,50,9),(2645,50,64),(2646,50,65),(2647,50,66),(2648,50,62),(2649,50,43),(2650,50,12),(2651,50,51),(2652,50,13),(2653,50,37),(2654,50,52),(2655,50,42),(2656,50,59),(2657,50,57),(2658,50,36),(2659,50,8),(2660,50,35),(2661,50,15),(2662,50,4),(2663,50,29),(2664,50,56),(2665,50,31),(2738,60,50),(2739,60,67),(2740,60,49),(2741,60,48),(2742,60,11),(2743,60,61),(2744,60,47),(2745,60,10),(2746,60,45),(2747,60,63),(2748,60,18),(2749,60,44),(2750,60,60),(2751,60,9),(2752,60,64),(2753,60,65),(2754,60,66),(2755,60,62),(2756,60,43),(2757,60,12),(2758,60,51),(2759,60,13),(2760,60,37),(2761,60,52),(2762,60,42),(2763,60,59),(2764,60,57),(2765,60,36),(2766,60,8),(2767,60,35),(2768,60,7),(2769,60,58),(2770,60,34),(2771,60,3),(2772,60,15),(2773,60,4),(2774,60,56),(2775,60,31),(3039,45,75),(3040,45,50),(3041,45,67),(3042,45,49),(3043,45,48),(3044,45,11),(3045,45,61),(3046,45,47),(3047,45,10),(3048,45,45),(3049,45,63),(3050,45,60),(3051,45,44),(3052,45,18),(3053,45,9),(3054,45,64),(3055,45,66),(3056,45,65),(3057,45,62),(3058,45,43),(3059,45,12),(3060,45,13),(3061,45,51),(3062,45,37),(3063,45,52),(3064,45,42),(3065,45,59),(3066,45,57),(3067,45,36),(3068,45,8),(3069,45,35),(3070,45,7),(3071,45,58),(3072,45,34),(3073,45,3),(3074,45,6),(3075,45,16),(3076,45,55),(3077,45,54),(3078,45,15),(3079,45,76),(3080,45,29),(3081,45,56),(3082,45,31),(3083,45,23),(3084,45,5),(3085,45,21),(3086,45,20),(3087,45,19),(3088,45,30),(3089,45,17),(3090,45,14),(3091,45,2);
/*!40000 ALTER TABLE `perfil_pantalla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presentaciones`
--

DROP TABLE IF EXISTS `presentaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presentaciones` (
  `id_presentacion` bigint(20) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_presentacion`),
  KEY `id_presentacion` (`id_presentacion`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presentaciones`
--

LOCK TABLES `presentaciones` WRITE;
/*!40000 ALTER TABLE `presentaciones` DISABLE KEYS */;
INSERT INTO `presentaciones` VALUES (58,'PAQUETE'),(59,'TOTTE 1000 LTS'),(60,'SACO'),(61,'SACO JUMBO'),(62,'TAMBOR'),(63,'CUBETA'),(65,'SACO 45.5 KG'),(66,'SACO 30 KG'),(67,'SACO 8 KG'),(68,'SACO 50 KG'),(69,'SACO 25 KG'),(70,'SACO 36.32'),(71,'TAMBOR 200'),(72,'PAQ 30 LBS'),(73,'SACO 50 LB'),(74,'CUBETA 19 '),(75,'SACO 25 LB'),(76,'SACO 10 KG'),(77,'SACO J 700'),(78,'TONELADA'),(79,'SACO DE 22.68 KILOS'),(80,'SACO 10 KG'),(81,'SACO 9 KG'),(82,'CUBETA 22.66 KG');
/*!40000 ALTER TABLE `presentaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prospecto`
--

DROP TABLE IF EXISTS `prospecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prospecto` (
  `id_prospecto` bigint(20) NOT NULL AUTO_INCREMENT,
  `cliente_id` varchar(10) NOT NULL,
  `fecha_prospecto` date DEFAULT NULL,
  `carta_presentacion` tinyint(1) NOT NULL,
  `material_multimedia` tinyint(1) NOT NULL,
  `visita_cliente` tinyint(1) NOT NULL,
  `cotizacion` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_prospecto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prospecto`
--

LOCK TABLES `prospecto` WRITE;
/*!40000 ALTER TABLE `prospecto` DISABLE KEYS */;
/*!40000 ALTER TABLE `prospecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `proveedor_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `proveedor_rs` varchar(100) NOT NULL,
  `proveedor_rfc` varchar(12) NOT NULL,
  `domicilio_id` bigint(20) DEFAULT NULL,
  `generales_id` bigint(20) NOT NULL,
  PRIMARY KEY (`proveedor_id`),
  KEY `domicilio_id` (`domicilio_id`),
  KEY `generales_id` (`generales_id`),
  CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`domicilio_id`) REFERENCES `domicilio` (`domicilio_id`),
  CONSTRAINT `proveedor_ibfk_2` FOREIGN KEY (`generales_id`) REFERENCES `generales` (`generales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1 COMMENT='Tabla PROVEEDOR';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'OPERADORA MEXICANA DE FLETES, S.A. DE C.V.','OMF050622S42',145,139),(2,'JOSE AARON BRITO FRIAS','BIFA880916IP',146,140),(3,'DAVILA TRUKING, S.A. DE C.V.','DTR080414FC5',147,141),(4,'RIMI SANDERS CORNELIO LOPEZ','COLR8201158P',148,142),(6,'MOMENTIVE PERFORMANCE MATERIALS S DE RL DE CV','MPM061016HT1',169,161),(8,'MOISES PEREZ NUÑEZ','PENM660820KK',195,187),(9,'PRODUCTOS QUIMICOS MARDUPOL S.A. DE C.V.','PQM8604286U8',196,188),(10,'POCHTECA MATERIAS PRIMAS SA DE CV','PMP950301S62',197,189),(11,'LIFPA S.A. DE C.V.','LIF030829E88',198,190),(12,'SEGURIDAD INDUSTRIAL Y FERRETERIA LAMAR SA DE CV','SIF980207B37',199,191),(13,'GRUPO COMSURLAB SA DE CV','GCO1012042Y2',200,192),(14,'ASESORIA Y SERVICIOS INTEGRALES EN CALIBRACION S.C.','ASI970120U23',201,193),(15,'COMERCIALIZADORA COMPUTEL DEL SURESTE S.A. DE C.V.','CCS0308152M5',202,194),(16,'LA CASA DE LA BASCULA SA DE CV','CBA770518C26',203,195),(17,'GARCIA BARRAGAN ABOGADOS S.C.','GBA9101038F3',204,196),(18,'EDUARDO ARISTEO BARRUETA ZENTENO','BAZE350213QJ',205,197),(19,'ESTRUCTURAS Y TECHOS GUADALAJARA S.A. DE C.V.','ETG731211MS8',206,198),(20,'ESTRATEGO SERVICIO EMPRESARIALES S.A. DE C.V.','ESE120518TJ3',207,199),(21,'DHL EXPRESS MEXICO S.A. DE C.V.','DEM8801152E9',208,200),(22,'PATRICIA GONZALEZ AGUIRRE','GOAP7805216K',209,201),(23,'AFIANZADORA SOFIMEX S.A.','ASG950531ID1',210,202),(24,'PINTURERIAS Y MUROS S.A. DE C.V.','PMU06113075A',211,203),(25,'COMERCIALIZADORA ROCHE S.A. DE C.V.','CRO-010726-G',212,204),(26,'ESZA CONSTRUCCIONES S.A. DE C.V.','ECO081015N46',213,205),(27,'MOGEL TRANSPORTES S.A. DE C.V.','MTR120820BX1',214,206),(28,'ADT PRIVATE SECURITY SERVICES DE MEXICO S.A. DE C.V.','APS080728RT5',215,207),(29,'SERGIO AGUSTIN VELAZQUEZ HERNANDEZ ','VEHS601021TW',216,208),(30,'INNOVACIONES PETROLERAS OMEGA SA DE CV','IPO120510EPA',217,209),(31,'LABORATORIO DE QUIMICA DEL MEDIO E INDUSTRIAL SA DE CV','LQM841126MG8',218,210),(32,'SERVIOFFICE COMERCIALIZADORA DE INSUMOS SA DE CV','SCI1311069X3',219,211),(33,'LA PALOMA COMPAÑÍA DE METALES S.A. DE C.V.','PME760707KW3',220,212),(34,'BARESA DE TORREON SA DE CV','BTO100324NM5',221,213),(35,'RED GLOBAL CARGO S DE R.L. DE C.V.','RGC080910694',222,214),(36,'WINGU NETWORKS S.A. DE C.V.','WINGU-PENDIE',223,215),(37,'AHORRATEL S.A. DE C.V.','AHO980327DL0',224,216),(38,'AUTOFLETES LOZAGUI S.A. DE C.V.','ALO041125SJ5',225,217),(39,'EL CRISOL S.A. DE C.V.','CRI660702M43',226,218),(40,'MOVERS CONSORCIO ADUANAL S.C.','MSA010404QK9',227,219),(41,'ENVASES DE PAPEL AVENTIS S.A. DE C.V.','EPA0102073C6',228,220),(42,'GABRIEL LUNA DE MATAMOROS Y CIA S. C.','GLM991015BG1',229,221),(43,'JOSE MANUEL RODRIGUEZ MACIAS','ROMM520815HQ',230,222),(44,'SERVICIOS Y PROYECTOS INTEGRADOS SELIK S.A. DE C.V.','SPI130520K53',231,223),(45,'AGRICEL S.A. DE C.V.','AGR820901A17',232,224),(46,'NEXTBAR S.A. DE C.V.','NEX040121U44',233,225),(47,'INTERTEK TESTING SERVICES DE MEXICO SA DE CV','INTERPENDIEN',234,226),(48,'GLOBAL DRILLING DE MEXICO S.A. DE C.V.','GDM940310FA6',235,227),(49,'CIBANCO S.A. INSTITUCION DE BANCA MULTIPLE','BNY080206UR9',236,228),(50,'MAQUINAS DIESEL S.A. DE C.V.','MDI931014D37',237,229),(51,'CLARIANT MEXICO S.A. DE C.V.','CME9507123M7',238,230),(52,'TRACSA S.A.P.I. DE C.V.','TRA800423S25',239,231),(53,'SERVICIOS DEL TROPICO S.A. DE C.V.','STR970211N49',240,232),(54,'LABORATORIOS ABC QUIMICA INVESTIGACION Y ANALISIS S.A. DE C.V.','LAQ790510FH2',241,233),(55,'BEDER ROJAS CARDENAS','ROCB331025IW',242,234),(56,'PROVEEDOR INTERNACIONAL DE QUIMICOS S.A. DE C.V.','PIQ880209H51',243,235),(57,'SAMIDPROMO S.A. DE C.V.','SAM1311122U1',244,236),(58,'AGC S.A. DE C.V.','AGC0812268FA',245,237),(59,'ALFAROS EQUIPOS Y REACTIVOS S.A. DE C.V.','AER0902133C8',246,238),(60,'BALEROS Y SUMINISROS DE TABASCO S.A. DE C.V.','BST800201BA2',247,239),(61,'RODAMIENTOS, TORNILLOS Y BANDAS INDUSTRIALES SA DE CV.','RTB860410RB6',248,240),(62,'RUBEN CABRERA MORALES','CAMR760614C1',249,241),(63,'JAIME PACHICANO GARCIA','PAGJ520816RV',250,242),(64,'GUSTAVO MATIAS FERNANDEZ','MAFG720103SH',251,243),(65,'FLORES Y RIOS S.A. DE C.V.','FRI921202A49',252,244),(66,'ANGULOS Y PERFILES DE ACOLMAN S.A. DE C.V.','APA081029BC4',253,245),(67,'SANTANDREU','SAN790810M82',254,246),(68,'LA FERRE COMERCIALIZADORA S.A. DE C.V.','FCO9310234W3',255,247),(69,'MINERA JAYNO S.A. DE C.V.','MJA8109198L3',256,248),(70,'FERNANDEZ HINOJOSA Y CIA  SC','FHI8704277E9',257,249),(71,'INTERNACIONAL DE CONTENEDORES ASOCIADOS DE ','ICA9507256L6',258,250),(72,'Riviem Energía S.A de C.V','REN090731LP3',259,251),(73,'Comercializadora Minera Tobama S.A de C.V','CMT1209072E1',260,252),(74,'Vitrox S.A de C.V','VIT130107SE6',261,253),(75,'Barita de la Laguna S.A de C.V','BLA1407216E2',262,254),(76,'Comunicaciones Nextel de México S.A de C.V','CNM980114PI2',263,255),(77,'Talle de Multiservicios Sarma ','SAMG891213KJ',264,256),(78,'E.G. Tlapalero S.A de C.V','ETL-080422MF',265,257),(79,'Radiomóvil Dipsa S.A de C.V','RDI841003QJ4',266,258),(80,'Orba Canalizaciones y Obras S.A de C.V','OCO061013RD8',267,259),(81,'Teléfonos de México S.A de C.V','TME840315-KT',268,260),(82,'MANUFACTURERA CENTURY, S.A. DE C.V.','MCE830331K94',269,261),(83,'TYRE AND SERVICES FYR, S.A. DE C.V.','TAS1201102L6',270,262),(84,'ABDIEL GONZALEZ GONZALEZ','GOGA841025KA',271,263),(85,'SILVIA SILVERIO ALMORA','SIAS790311V8',272,264),(86,'I+D MEXICO, S.A. DE C.V.','ISD950921HE5',273,265),(87,'QUALITAS COMPAÑÍA DE SEGUROS, S.A. DE C.V.','QCS931209G49',274,266),(88,'CONTROL AMBIENTAL RENACE, S.A. DE C.V.','CAR061027L14',275,267),(89,'REFACCIONES Y ENGRANES ALBA, S.A. DE C.V.','REA921224FC6',276,269),(90,'KENWORTH DE LA HUASTECA, S.A. DE C.V.','KHU081007B62',277,270),(91,'KENWORTH OLMECA MAYA, S.A. DE C.V.','KOM970116SN8',278,271),(92,'EFECTIVALE, S. DE R.L. DE C.V.','EFE8908015L3',279,272),(93,'VIRTUAL','VIRTUAL',282,274),(94,'ARCILLAS INDUSTRIALES CUENCAME DGO','NA',284,276),(95,'DIMERTAB SA DE CV','DMT1504075R2',285,277),(96,'OFFICE DEPOT DE MEXICO SA DE CV','ODM950324V2A',286,278),(97,'COMERCIALIZADORA COMPUTEL DEL SURESTE SA DE CV','CCS0308152M5',287,279),(98,'SERVICIOS INNOVADORES DEL SURESTE S.A. DE C.V.','SERVICIO-PEN',289,280),(99,'as','asdf',290,281),(100,'IMPRESIONES DIGITALES DE MEXICO SA DE CV','IDM121012IZ1',292,282),(101,'DISEÑO Y PROYECTOS COMARCA','DYPR0503023V',358,346),(102,'prueb','prueb',361,347),(103,'WICHO','VAAAAAAAAAAA',401,380);
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remolque`
--

DROP TABLE IF EXISTS `remolque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remolque` (
  `remolque_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `remolque_nombre` varchar(50) DEFAULT NULL,
  `remolque_placas` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`remolque_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remolque`
--

LOCK TABLES `remolque` WRITE;
/*!40000 ALTER TABLE `remolque` DISABLE KEYS */;
INSERT INTO `remolque` VALUES (1,'PLANA','062-XP-4'),(2,'TOLVA','052-XP-4'),(3,'GONDOLA','303-WC-9'),(4,'PIPA','268-UM-1');
/*!40000 ALTER TABLE `remolque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `req_compra`
--

DROP TABLE IF EXISTS `req_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `req_compra` (
  `req_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` date NOT NULL,
  `fecha_req` date DEFAULT NULL COMMENT 'la fecha en la que se requiere el material o producto',
  `cliente_id` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Cliente al que se le asignará',
  `usuario_id` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Usuario que lo Solicita',
  `usuario_id_autoriza` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_autoriza` date DEFAULT NULL,
  `observaciones` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `req_edo` tinyint(4) NOT NULL DEFAULT 0,
  `proyecto` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lugar_entrega` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `proveedor_id` bigint(20) DEFAULT NULL,
  `empresa_id` bigint(20) DEFAULT NULL,
  `folio` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`req_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Requisiciones de Compra';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `req_compra`
--

LOCK TABLES `req_compra` WRITE;
/*!40000 ALTER TABLE `req_compra` DISABLE KEYS */;
INSERT INTO `req_compra` VALUES (18,'2018-09-20','2018-09-20','','ButronJ','ButronJ','2018-09-20','',2,'','','',NULL,3,'LAB-162'),(19,'2018-09-20','2018-09-20','','ButronJ',NULL,NULL,'',1,'','','',NULL,3,'0-'),(20,'2018-09-20','2018-09-19','','ButronJ',NULL,NULL,'',1,'','','',NULL,3,'MF-1162'),(21,'2018-09-20','2018-09-26','','ButronJ',NULL,NULL,'prueba',1,'prueba','prueba','prueba',NULL,3,'MF-1163'),(22,'2018-09-21','2018-09-21','','Monica D','ADMIN 02','2018-09-21','SE AUTORIZA LA COMPRA AL PROVEEDOR QUE MONICA QUIERA',2,'surtir almacen ','','tihuatlan, ver ',NULL,3,'MF-1164'),(23,'2018-10-04','2018-10-05','','ADMIN 02','ADMIN 02','2018-10-04','LIMPIAS Y NUEVAS',2,'','EMPAQUE DE HEC','TIHUATLAN',NULL,3,'MF-1165'),(24,'2018-10-08','2018-10-09','','ADMIN 02','ADMIN 02','2018-10-08','COMPUTADORAS NUEVAS',2,'','RESURTIMIENTO DE ALMACEN','TIHUATLAN, VERACRUZ',NULL,3,'MF-1166'),(25,'2018-10-08',NULL,'0','ButronJ',NULL,NULL,'',0,NULL,NULL,NULL,NULL,0,NULL),(26,'2018-10-08',NULL,'0','ButronJ',NULL,NULL,'',0,NULL,NULL,NULL,NULL,0,NULL),(27,'2018-10-08',NULL,'0','ButronJ',NULL,NULL,'',0,NULL,NULL,NULL,NULL,0,NULL),(28,'2018-10-10','2018-10-11','','ADMIN 02','ADMIN 02','2018-10-10','QUE INCLUYAN OFFICE',2,'','ABASTECER ALMACEN','TIHUATLAN',NULL,3,'MF-1167'),(29,'2018-10-10','2018-10-11','0','ADMIN 02',NULL,NULL,'MOUSE NUEVOS',1,'','','',NULL,3,'-'),(30,'2018-10-23',NULL,'0','ButronJ',NULL,NULL,'',0,NULL,NULL,NULL,NULL,3,NULL),(31,'2018-10-23',NULL,'0','ADMIN 02',NULL,NULL,'',0,NULL,NULL,NULL,NULL,3,NULL),(32,'2018-10-23',NULL,'0','ButronJ',NULL,NULL,'',0,NULL,NULL,NULL,NULL,3,NULL),(33,'2018-10-23','2018-10-23','0','ADMIN 02',NULL,NULL,'nuevos',1,'','','',NULL,3,'-'),(34,'2018-10-26','2018-10-27','0','ButronJ',NULL,NULL,'prueba req',1,'','','',NULL,3,'-'),(35,'2018-12-05',NULL,'0','ADMIN 02',NULL,NULL,'',0,NULL,NULL,NULL,NULL,0,NULL),(36,'2018-12-05','2018-12-05','','ADMIN 02','ADMIN 02','2018-12-05','',2,'','abastecimiento','surtir',NULL,0,'0'),(37,'2019-01-31',NULL,'0','Emmanuel V',NULL,NULL,'',0,NULL,NULL,NULL,NULL,3,NULL),(38,'2019-12-05',NULL,'0','Jesus C',NULL,NULL,'',0,NULL,NULL,NULL,NULL,3,NULL),(39,'2019-12-05',NULL,'0','Jesus C',NULL,NULL,'',0,NULL,NULL,NULL,NULL,0,NULL),(40,'2019-12-05','2019-12-05','0','Emmanuel V',NULL,NULL,'tracto camion 005-ex-2',1,'','','',NULL,3,'-'),(41,'2019-12-09',NULL,'0','Jesus C',NULL,NULL,'',0,NULL,NULL,NULL,NULL,3,NULL),(42,'2019-12-09',NULL,'0','Jesus C',NULL,NULL,'',0,NULL,NULL,NULL,NULL,3,NULL),(43,'2019-12-17','2019-12-19','0','Emmanuel V','Emmanuel V','2019-12-17','AUTORIZADO',2,'','','',NULL,3,'-'),(44,'2019-12-18',NULL,'0','Emmanuel V',NULL,NULL,'',0,NULL,NULL,NULL,NULL,3,NULL),(45,'2020-01-10',NULL,'0','Wicho',NULL,NULL,'',0,NULL,NULL,NULL,NULL,0,NULL),(46,'2020-01-10',NULL,'0','Wicho',NULL,NULL,'',0,NULL,NULL,NULL,NULL,0,NULL),(47,'2020-01-10',NULL,'0','Wicho',NULL,NULL,'',0,NULL,NULL,NULL,NULL,3,NULL),(48,'2020-01-10',NULL,'0','Wicho',NULL,NULL,'',0,NULL,NULL,NULL,NULL,0,NULL),(49,'2020-01-28',NULL,'0','Wicho',NULL,NULL,'',0,NULL,NULL,NULL,NULL,3,NULL),(50,'2020-02-07',NULL,'0','Wicho',NULL,NULL,'',0,NULL,NULL,NULL,NULL,0,NULL),(51,'2020-02-07','2020-02-07','','Wicho',NULL,NULL,'',1,'','','',NULL,3,'MF-1168'),(52,'2020-02-13',NULL,'0','Wicho',NULL,NULL,'',0,NULL,NULL,NULL,NULL,3,NULL),(53,'2020-02-14',NULL,'0','Wicho',NULL,NULL,'',0,NULL,NULL,NULL,NULL,0,NULL),(54,'2020-02-17',NULL,'0','Wicho',NULL,NULL,'',0,NULL,NULL,NULL,NULL,0,NULL);
/*!40000 ALTER TABLE `req_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ruta`
--

DROP TABLE IF EXISTS `ruta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ruta` (
  `ruta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transporte_id` bigint(20) NOT NULL,
  `ruta_estatus` int(11) NOT NULL,
  `ruta_observaciones` varchar(100) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  `operador` varchar(100) NOT NULL,
  `remolque_id` bigint(20) NOT NULL,
  PRIMARY KEY (`ruta_id`),
  KEY `orden_salida_id` (`transporte_id`),
  CONSTRAINT `ruta_ibfk_1` FOREIGN KEY (`transporte_id`) REFERENCES `transporte` (`transporte_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1 COMMENT='Tabla RUTA';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ruta`
--

LOCK TABLES `ruta` WRITE;
/*!40000 ALTER TABLE `ruta` DISABLE KEYS */;
INSERT INTO `ruta` VALUES (1,9,3,'procdos ','2018-10-02 11:56:05','JOSE GUADALUPE VAZQUEZ  FUERTE',0),(2,9,0,NULL,'2018-10-02 11:56:42','ROBERTO CARLOS REYES OLIVARES',0),(3,10,1,'PREUBA ','2018-10-03 17:03:22','ROBERTO CARLOS REYES OLIVARES',0),(4,9,1,'prueba ','2018-10-09 17:06:38','JOSE GUADALUPE VAZQUEZ  FUERTE',0),(5,27,1,'entregado ','2018-10-16 12:31:29','JOSE GUADALUPE VAZQUEZ  FUERTE',0),(6,9,3,'entregado ','2018-10-17 12:35:17','ROBERTO CARLOS REYES OLIVARES',0),(7,9,1,'prueba hoy','2020-02-11 00:00:00','LUIS VAZQUEZ',0),(8,27,0,NULL,'2020-02-13 17:57:58','',1),(9,39,0,NULL,'2020-02-14 13:17:16','',1),(10,27,1,NULL,'2020-02-14 13:20:27','',0),(11,24,0,NULL,'2020-02-17 11:19:07','',1),(12,29,0,NULL,'2020-02-17 11:23:47','ANGEL VAZQUEZ RAMIREZ',4),(13,14,0,NULL,'2020-02-19 11:10:37','',1),(14,21,0,NULL,'2020-02-19 11:12:03','ANGEL VAZQUEZ RAMIREZ',2),(15,43,0,NULL,'2020-02-19 17:00:22','',2),(16,40,0,NULL,'2020-02-19 17:14:07','ANGEL VAZQUEZ RAMIREZ',3),(17,41,0,NULL,'2020-02-19 17:24:35','',4),(18,41,0,NULL,'2020-02-19 17:31:55','',1),(19,42,0,NULL,'2020-02-19 18:08:01','ANGEL VAZQUEZ RAMIREZ',4),(20,26,0,NULL,'2020-02-19 18:13:16','',1),(21,29,0,NULL,'2020-02-19 18:14:37','',1),(22,27,0,NULL,'2020-02-19 18:15:26','',1),(23,29,0,NULL,'2020-02-19 18:16:12','',1),(24,27,0,NULL,'2020-02-19 18:17:59','',1),(25,26,0,NULL,'2020-02-20 09:58:02','',1),(26,29,0,NULL,'2020-02-20 10:49:48','',4),(27,28,0,NULL,'2020-02-20 11:13:06','',1),(28,29,0,NULL,'2020-02-20 11:15:01','',1),(29,27,0,NULL,'2020-02-20 11:15:56','',1),(30,29,0,NULL,'2020-02-20 11:31:31','',1),(31,28,0,NULL,'2020-02-20 11:32:49','',1),(32,40,0,NULL,'2020-02-20 11:34:45','',4),(33,15,0,NULL,'2020-02-20 11:35:48','',3),(34,29,1,NULL,'2020-02-20 11:52:48','1',1),(35,27,1,NULL,'2020-02-20 11:53:50','luis',1),(36,24,1,NULL,'2020-02-20 11:55:15','angel vazquez',2),(37,22,1,NULL,'2020-02-20 11:55:56','luis vazquez ramirez',2),(38,16,1,NULL,'2020-02-20 11:56:24','angel vazquez ramirez',2),(39,21,1,NULL,'2020-02-20 12:16:05','luis vazquez ramirez',2),(40,22,1,NULL,'2020-02-20 13:09:55','prueba prueba prueba',2),(41,21,1,NULL,'2020-02-20 13:53:25','prueba prueba prueba',3),(42,24,1,NULL,'2020-02-20 17:18:29','prueba prueba prueba',1),(43,21,0,NULL,'2020-02-20 18:20:07','angel vazquez ramirez',1),(44,24,1,NULL,'2020-02-27 14:57:49','luis vazquez ramirez',2),(45,26,1,NULL,'2020-02-27 17:18:13','das dasdasd prueba',2);
/*!40000 ALTER TABLE `ruta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ruta2`
--

DROP TABLE IF EXISTS `ruta2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ruta2` (
  `ruta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `clave` bigint(20) DEFAULT NULL,
  `producto_id` bigint(20) DEFAULT NULL,
  `cantidad` bigint(20) DEFAULT NULL,
  `folio_pedido` bigint(20) DEFAULT NULL,
  `cliente_id` bigint(20) DEFAULT NULL,
  `estado_id` bigint(20) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `destino` varchar(500) DEFAULT NULL,
  `remolque_id` bigint(20) DEFAULT NULL,
  `operador_id` bigint(20) DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ruta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ruta2`
--

LOCK TABLES `ruta2` WRITE;
/*!40000 ALTER TABLE `ruta2` DISABLE KEYS */;
/*!40000 ALTER TABLE `ruta2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ruta_detalle`
--

DROP TABLE IF EXISTS `ruta_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ruta_detalle` (
  `detalle_ruta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ruta_id` bigint(20) NOT NULL,
  `PedidoDetalle_id` bigint(20) NOT NULL,
  `cantidadEnrutada` int(11) NOT NULL DEFAULT 0,
  `cantidadEntregada` int(11) DEFAULT 0,
  `observaciones` varchar(50) DEFAULT NULL,
  `ruta_detalle_estatus` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Creada; 1_Terminada',
  `factura` varchar(15) NOT NULL,
  `folio_OE` varchar(20) NOT NULL,
  `usuario_nota_salida` varchar(20) NOT NULL,
  PRIMARY KEY (`detalle_ruta_id`),
  KEY `ruta_id` (`ruta_id`),
  KEY `PedidoDetalle_id` (`PedidoDetalle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ruta_detalle`
--

LOCK TABLES `ruta_detalle` WRITE;
/*!40000 ALTER TABLE `ruta_detalle` DISABLE KEYS */;
INSERT INTO `ruta_detalle` VALUES (1,1,17,2,2,'procuno ',1,'','021018',''),(2,1,16,2,2,'procdos ',1,'','021018',''),(3,1,15,3,3,'proctres ',1,'','021018',''),(4,2,17,2,0,NULL,0,'','021018',''),(5,2,16,2,0,NULL,0,'','021018',''),(6,2,15,3,0,NULL,0,'','021018',''),(7,3,20,10,10,NULL,0,'','031018',''),(8,4,24,1,1,NULL,0,'','091018',''),(9,5,25,10,10,'mouse  ',1,'','2367',''),(10,6,27,1,1,'entregado ',1,'','171018',''),(11,7,27,1,1,'en ruta',1,' ','171018',' '),(12,34,14,5,0,NULL,0,'','',''),(13,35,29,5,0,NULL,0,'','',''),(14,36,30,10,0,NULL,0,'','',''),(15,37,22,15,0,NULL,0,'','',''),(16,38,10,1,0,NULL,0,'','',''),(17,38,9,1,0,NULL,0,'','',''),(18,38,8,1,0,NULL,0,'','',''),(19,39,12,2,0,NULL,0,'','',''),(20,40,13,20,0,NULL,0,'','',''),(21,41,36,1,0,NULL,0,'','',''),(22,42,31,5,0,NULL,0,'','',''),(23,43,21,5,0,NULL,0,'','',''),(24,44,38,1,0,NULL,0,'','',''),(25,45,37,1,0,NULL,0,'','','');
/*!40000 ALTER TABLE `ruta_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salida_material`
--

DROP TABLE IF EXISTS `salida_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salida_material` (
  `salida_material_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `almacen_material_id` bigint(20) NOT NULL,
  `cantidad_salida` bigint(20) DEFAULT NULL,
  `usuario_id` bigint(20) DEFAULT NULL,
  `salida_obs` tinyint(4) DEFAULT NULL,
  `fecha_solicitud` datetime NOT NULL,
  PRIMARY KEY (`salida_material_id`),
  KEY `almacen_material_id` (`almacen_material_id`),
  CONSTRAINT `salida_material_ibfk_1` FOREIGN KEY (`almacen_material_id`) REFERENCES `almacen_material` (`almacen_material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla SALIDA de MATERIAL';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salida_material`
--

LOCK TABLES `salida_material` WRITE;
/*!40000 ALTER TABLE `salida_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `salida_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicio`
--

DROP TABLE IF EXISTS `servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicio` (
  `servicio_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `servicio_descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `servicio_precio` float NOT NULL,
  PRIMARY KEY (`servicio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicio`
--

LOCK TABLES `servicio` WRITE;
/*!40000 ALTER TABLE `servicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sucursal` (
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
  KEY `contacto_ventas_id` (`contacto_ventas_id`),
  CONSTRAINT `sucursal_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`),
  CONSTRAINT `sucursal_ibfk_2` FOREIGN KEY (`domicilio_id`) REFERENCES `domicilio` (`domicilio_id`),
  CONSTRAINT `sucursal_ibfk_3` FOREIGN KEY (`contacto_ventas_id`) REFERENCES `contacto_ventas` (`contacto_ventas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COMMENT='tabla normalizada domicilio de cliente';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sucursal`
--

LOCK TABLES `sucursal` WRITE;
/*!40000 ALTER TABLE `sucursal` DISABLE KEYS */;
INSERT INTO `sucursal` VALUES (5,'SOE',1,'PRUEBA',305,295,NULL),(6,'5',1,'QMAX MEXICO VILLAHERMOSA',306,296,NULL),(7,'5',1,'QMAX CD DEL CARMEN',307,297,NULL),(8,'1',1,'HALLIBURTON, REFORMA',308,298,NULL),(9,'1',1,'HALLIBURTON ALVARADO',309,299,NULL),(10,'1',1,'HALLIBURTON TUXPAN',310,300,NULL),(11,'7',1,'PROTEXA BASE CD. DEL CARMEN',311,301,NULL),(12,'7',1,'PROTEXA BASE PARAISO',312,302,NULL),(13,'6',1,'VLG CARDENAS',313,303,NULL),(14,'SL',1,'SERVICIOS Y PROYECTOS INTEGRADOS SELIK S.A. DE C.V',314,304,NULL),(15,'15',1,' MOGEL FLUIDOS TIHUATLAN VERACRUZ',315,305,NULL),(16,'NTS',1,'TIHUATLAN',380,360,NULL),(17,'WICHO',1,'WICHO',400,379,NULL);
/*!40000 ALTER TABLE `sucursal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taller_solicitud`
--

DROP TABLE IF EXISTS `taller_solicitud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taller_solicitud` (
  `taller_solicitud_id` int(10) NOT NULL AUTO_INCREMENT,
  `taller_id` int(10) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `usuario_id_solicitante` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `almacen_id` bigint(20) NOT NULL,
  `usuario_id_autorizador` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_autorizacion` date DEFAULT NULL,
  `motivo` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pedido_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `folio` int(10) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `id_producto` bigint(20) NOT NULL,
  `cantidad_solicitada` int(11) NOT NULL,
  `cantidad_surtida` int(11) NOT NULL,
  PRIMARY KEY (`taller_solicitud_id`),
  KEY `taller_solicitud_ibfk3` (`pedido_id`),
  KEY `taller_solicitud_ibfk2` (`almacen_id`),
  CONSTRAINT `taller_solicitud_ibfk2` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`almacen_id`),
  CONSTRAINT `taller_solicitud_ibfk3` FOREIGN KEY (`pedido_id`) REFERENCES `detalle_pedido` (`pedido_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taller_solicitud`
--

LOCK TABLES `taller_solicitud` WRITE;
/*!40000 ALTER TABLE `taller_solicitud` DISABLE KEYS */;
INSERT INTO `taller_solicitud` VALUES (1,1,'2018-10-23 15:49:25','ADMIN 02',1,'',NULL,NULL,NULL,2,0,0,0,0,0),(2,1,'2019-12-16 16:57:41','Jesus C',3,'',NULL,NULL,NULL,1,0,0,0,0,0);
/*!40000 ALTER TABLE `taller_solicitud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transporte`
--

DROP TABLE IF EXISTS `transporte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transporte` (
  `transporte_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transporte_nombre` varchar(50) DEFAULT NULL,
  `transporte_placas` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`transporte_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transporte`
--

LOCK TABLES `transporte` WRITE;
/*!40000 ALTER TABLE `transporte` DISABLE KEYS */;
INSERT INTO `transporte` VALUES (9,'KENWORKTH','783-EX-2'),(10,'KENWORKTH','008-EX-2'),(11,'KENWORKTH','007-EX-2'),(12,'KENWORKTH','784-EX-2'),(13,'KENWORKTH','31-AA-9B'),(14,'KENWORKTH','549-EV-6'),(15,'KENWORKTH','548-EV-6'),(16,'KENWORKTH','206-EV-1'),(17,'KENWORKTH','205-EV-1'),(18,'KENWORKTH','010-EX-2'),(19,'KENWORKTH','011-EX-2'),(20,'KENWORKTH','009-EX-2'),(21,'KENWORKTH','004-EX-2'),(22,'KENWORKTH','508-EU-7'),(23,'KENWORKTH','785-EX-2'),(24,'KENWORKTH','30-AA-9B'),(25,'KENWORKTH','213-AT-9'),(26,'KENWORKTH','693-EP-4'),(27,'VOLVO','309-AE-2'),(28,'FREIGHTLINER','431-AK-6'),(29,'MERCEDES BENZ','426-AK-5'),(30,'INTERNATIONAL','283-AK-6'),(31,'VOLVO','206-DY-2'),(32,'FREIGHTLINER','275-AK-6'),(33,'KENWORKTH','005-EX-2'),(34,'KENWORKTH','006-EX-2'),(35,'KENWORKTH','782-EX-2'),(36,'KENWORKTH','329-EV-4'),(37,'KENWORKTH','330-EV-4'),(38,'KENWORKTH','304-EV-4'),(39,'KENWORKTH','305-EV-4'),(40,'PRUEBAS','PRUEBAS'),(41,'PRUEBAS','A'),(42,'DE LUCIO','421-XS-2'),(43,'DE LUCIO','422-XS-2');
/*!40000 ALTER TABLE `transporte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidades`
--

DROP TABLE IF EXISTS `unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidades` (
  `id_unidad` bigint(20) NOT NULL AUTO_INCREMENT,
  `prefijo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_unidad`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1 COMMENT='Unidades de Medida';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidades`
--

LOCK TABLES `unidades` WRITE;
/*!40000 ALTER TABLE `unidades` DISABLE KEYS */;
INSERT INTO `unidades` VALUES (88,'KG'),(89,'TONELADA'),(91,'M3'),(92,'LITRO'),(93,'LIBRAS'),(94,'PIEZA'),(95,''),(96,'SACOS'),(97,'PIEZA'),(98,'18 kg '),(99,'18 kg '),(100,'15 kg'),(101,'9 kg '),(102,'');
/*!40000 ALTER TABLE `unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usuario_id` varchar(10) NOT NULL DEFAULT 'NULL',
  `usuario_password` varchar(20) NOT NULL,
  `generales_id` bigint(20) NOT NULL,
  `domicilio_id` bigint(20) DEFAULT NULL,
  `usuario_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'estado (activo, bloqueado)',
  `perfil_id` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`usuario_id`),
  KEY `generales_id` (`generales_id`),
  KEY `domicilio_id` (`domicilio_id`),
  KEY `perfil_id` (`perfil_id`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`generales_id`) REFERENCES `generales` (`generales_id`),
  CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`domicilio_id`) REFERENCES `domicilio` (`domicilio_id`),
  CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`perfil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla USUARIO';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('ADMIN 01','javier01',353,368,0,45),('ADMIN 02','juan02',354,369,0,45),('Ana Lau','C0mpr45',375,396,0,51),('Andrea S','L4bor4torio',372,393,0,47),('Bernardo P','Produ66ion',374,395,0,49),('ButronJ','usuario2',138,144,0,45),('Emmanuel V','transportes',368,389,0,60),('Enrique O','Pr0ducci0n',365,386,0,49),('Fernel','fernel01',357,377,0,58),('invitado','invitado',362,382,0,59),('Jesus C','logistica',367,388,0,60),('Jesus N','Lab0rat0ri0',373,394,0,47),('Jose G','Jose G',364,384,0,46),('Monica D','mode01',356,376,0,57),('Pilar D','V3nt45',371,392,0,51),('Roberto C','Roberto C',363,383,0,46),('Ruben P','rupa01',355,375,0,50),('Victor C','quetal',366,387,0,47),('Wicho','admin',370,391,0,45),('Yara R','Y4r4Rios',376,397,0,51);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_cliente`
--

DROP TABLE IF EXISTS `usuario_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_cliente` (
  `usuario_cliente_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` varchar(20) NOT NULL,
  `cliente_id` varchar(10) NOT NULL,
  `usuario_cliente_nivel` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`usuario_cliente_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `cliente_id` (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=latin1 COMMENT='Tabla Relacion USUARIO_CLIENTE';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_cliente`
--

LOCK TABLES `usuario_cliente` WRITE;
/*!40000 ALTER TABLE `usuario_cliente` DISABLE KEYS */;
INSERT INTO `usuario_cliente` VALUES (1,'usuario1','SOE TECNOL',0),(2,'CurieE','1',0),(3,'CurieE','2',0),(4,'CurieE','3',0),(5,'CurieE','4',0),(6,'CurieE','5',0),(7,'CurieE','6',0),(8,'CurieE','7',0),(9,'CurieE','8',0),(10,'CurieE','9',0),(11,'CurieE','10',0),(12,'CurieE','11',0),(13,'CurieE','12',0),(14,'CurieE','13',0),(15,'CurieE','14',0),(16,'CurieE','15',0),(17,'OlivaJ','16',0),(18,'OlivaJ','17',0),(19,'OlivaJ','18',0),(20,'OlivaJ','19',0),(21,'OlivaJ','20',0),(22,'OlivaJ','21',0),(23,'OlivaJ','22',0),(24,'OlivaJ','23',0),(25,'OlivaJ','24',0),(26,'OlivaJ','25',0),(27,'OlivaJ','26',0),(28,'OlivaJ','27',0),(29,'OlivaJ','28',0),(30,'OlivaJ','29',0),(31,'OlivaJ','30',0),(32,'OlivaJ','31',0),(33,'OlivaJ','32',0),(34,'OlivaJ','33',0),(35,'OlivaJ','34',0),(36,'OlivaJ','35',0),(37,'OlivaJ','36',0),(38,'OlivaJ','37',0),(39,'OlivaJ','38',0),(40,'OlivaJ','39',0),(41,'OlivaJ','40',0),(42,'OlivaJ','41',0),(43,'OlivaJ','42',0),(44,'OlivaJ','43',0),(45,'OlivaJ','44',0),(46,'OlivaJ','45',0),(47,'OlivaJ','46',0),(48,'OlivaJ','47',0),(49,'OlivaJ','48',0),(50,'OlivaJ','49',0),(51,'OlivaJ','50',0),(52,'OlivaJ','51',0),(53,'OlivaJ','52',0),(54,'OlivaJ','53',0),(55,'OlivaJ','54',0),(56,'OlivaJ','55',0),(57,'OlivaJ','56',0),(58,'DelgaA','57',0),(59,'DelgaA','58',0),(60,'DelgaA','59',0),(61,'DelgaA','60',0),(62,'DelgaA','61',0),(63,'DelgaA','62',0),(64,'DelgaA','63',0),(65,'DelgaA','64',0),(66,'DelgaA','65',0),(67,'DelgaA','66',0),(68,'DelgaA','67',0),(69,'DelgaA','68',0),(70,'DelgaA','69',0),(71,'DelgaA','70',0),(72,'DelgaA','71',0),(73,'DelgaA','72',0),(74,'DelgaA','73',0),(75,'DelgaA','74',0),(76,'FigueR','75',0),(77,'FigueR','76',0),(78,'FigueR','77',0),(79,'FigueR','78',0),(80,'FigueR','79',0),(81,'FigueR','80',0),(82,'FigueR','81',0),(83,'FigueR','82',0),(84,'FigueR','83',0),(85,'FigueR','84',0),(86,'FigueR','85',0),(87,'FigueR','86',0),(88,'FigueR','87',0),(89,'FigueR','88',0),(90,'SolanP','89',0),(91,'SolanP','90',0),(92,'SolanP','91',0),(93,'SolanP','92',0),(94,'SolanP','93',0),(95,'SolanP','94',0),(96,'SolanP','95',0),(97,'SolanP','96',0),(98,'SolanP','97',0),(99,'SolanP','98',0),(100,'SolanP','99',0),(101,'SolanP','100',0),(102,'MartiL','101',0),(103,'MartiL','102',0),(104,'MartiL','103',0),(105,'MartiL','104',0),(106,'MartiL','105',0),(107,'MartiL','106',0),(108,'MartiL','107',0),(109,'MartiL','108',0),(110,'MartiL','109',0),(111,'ArrioG','110',0),(112,'ArrioG','111',0),(113,'ArrioG','112',0),(114,'ArrioG','113',0),(115,'ArrioG','114',0),(116,'','1',0),(117,'','2',0),(118,'','3',0),(119,'','4',0),(120,'','5',0),(121,'','6',0),(122,'','7',0);
/*!40000 ALTER TABLE `usuario_cliente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-27 17:29:03
