-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.11-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para tienda_master
CREATE DATABASE IF NOT EXISTS `tienda_master` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `tienda_master`;

-- Volcando estructura para tabla tienda_master.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla tienda_master.categorias: ~5 rows (aproximadamente)
DELETE FROM `categorias`;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `nombre`) VALUES
	(1, 'Manga corta'),
	(2, 'Tirantes'),
	(3, 'Manga larga'),
	(4, 'Sudaderas'),
	(5, 'Deportivo');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla tienda_master.lineas_pedidos
CREATE TABLE IF NOT EXISTS `lineas_pedidos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(255) NOT NULL,
  `producto_id` int(255) NOT NULL,
  `unidades` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lineas_pedido` (`pedido_id`),
  KEY `fk_lineas_producto` (`producto_id`),
  CONSTRAINT `fk_lineas_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `fk_lineas_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla tienda_master.lineas_pedidos: ~44 rows (aproximadamente)
DELETE FROM `lineas_pedidos`;
/*!40000 ALTER TABLE `lineas_pedidos` DISABLE KEYS */;
INSERT INTO `lineas_pedidos` (`id`, `pedido_id`, `producto_id`, `unidades`) VALUES
	(11, 26, 26, 1),
	(12, 26, 21, 1),
	(13, 26, 18, 1),
	(14, 26, 25, 2),
	(15, 27, 26, 1),
	(16, 27, 21, 1),
	(17, 27, 18, 1),
	(18, 27, 25, 2),
	(19, 27, 22, 1),
	(20, 28, 26, 1),
	(21, 28, 21, 2),
	(22, 28, 18, 1),
	(23, 28, 25, 2),
	(24, 28, 22, 1),
	(25, 29, 26, 1),
	(26, 29, 21, 2),
	(27, 29, 18, 1),
	(28, 29, 25, 2),
	(29, 29, 22, 1),
	(30, 30, 26, 1),
	(31, 30, 21, 2),
	(32, 30, 18, 1),
	(33, 30, 25, 2),
	(34, 30, 22, 1),
	(35, 31, 26, 2),
	(36, 31, 21, 2),
	(37, 31, 18, 1),
	(38, 31, 25, 2),
	(39, 31, 22, 1),
	(40, 32, 27, 1),
	(41, 32, 21, 1),
	(42, 33, 24, 1),
	(43, 33, 21, 1),
	(44, 33, 18, 1),
	(45, 34, 24, 1),
	(46, 34, 21, 1),
	(47, 34, 18, 1),
	(48, 35, 24, 1),
	(49, 35, 21, 1),
	(50, 35, 18, 1),
	(51, 36, 21, 1),
	(52, 37, 25, 1),
	(53, 37, 27, 1),
	(54, 37, 21, 1);
/*!40000 ALTER TABLE `lineas_pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla tienda_master.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(255) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `coste` float(200,2) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedidos_usuario` (`usuario_id`),
  CONSTRAINT `fk_pedidos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla tienda_master.pedidos: ~12 rows (aproximadamente)
DELETE FROM `pedidos`;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` (`id`, `usuario_id`, `provincia`, `localidad`, `direccion`, `coste`, `estado`, `fecha`, `hora`) VALUES
	(26, 30, 'lima', 'lima', 'Int. M-125 Golden Plaza Horizonte, Jr. Antonio Bazo 510, La Victoria 15018, Perú, 4', 886.00, 'sended', '2021-06-09', '17:56:51'),
	(27, 30, 'lima', 'lima', 'Int. M-125 Golden Plaza Horizonte, Jr. Antonio Bazo 510, La Victoria 15018, Perú, 4', 1771.00, 'ready', '2021-06-09', '18:18:11'),
	(28, 30, 'apurimac', 'abancay', 'Int. M-125 Golden Plaza Horizonte, Jr. Antonio Bazo 510, La Victoria 15018, Perú, 4', 1816.00, 'confirm', '2021-06-09', '18:29:37'),
	(29, 30, 'lima', 'lima', 'Int. M-125 Golden Plaza Horizonte, Jr. Antonio Bazo 510, La Victoria 15018, Perú, 4', 1816.00, 'sended', '2021-06-09', '20:40:26'),
	(30, 30, 'lima', 'lima', 'Int. M-125 Golden Plaza Horizonte, Jr. Antonio Bazo 510, La Victoria 15018, Perú, 4', 1816.00, 'preparation', '2021-06-09', '20:42:39'),
	(31, 30, 'lima', 'lima', 'Int. M-125 Golden Plaza Horizonte, Jr. Antonio Bazo 510, La Victoria 15018, Perú, 4', 2150.00, 'ready', '2021-06-10', '00:13:48'),
	(32, 32, 'lima', 'lima', 'Int. M-125 Golden Plaza Horizonte, Jr. Antonio Bazo 510, La Victoria 15018, Perú, 4', 147.00, 'sended', '2021-06-10', '01:29:29'),
	(33, 33, 'Puno', 'juliaca', 'Prado alto calle 3 piso 1 mc1tl5', 437.00, 'sended', '2021-06-10', '17:46:36'),
	(34, 31, 'lima', 'lima', 'Int. M-125 Golden Plaza Horizonte, Jr. Antonio Bazo 510, La Victoria 15018, Perú, 4', 437.00, 'confirm', '2021-06-10', '17:50:06'),
	(35, 31, 'lima', 'lima', 'Int. M-125 Golden Plaza Horizonte, Jr. Antonio Bazo 510, La Victoria 15018, Perú, 4', 437.00, 'confirm', '2021-06-10', '17:52:01'),
	(36, 30, 'lima', 'lima', 'Int. M-125 Golden Plaza Horizonte, Jr. Antonio Bazo 510, La Victoria 15018, Perú, 4', 45.00, 'confirm', '2021-06-11', '20:55:24'),
	(37, 31, 'lima', 'lima', 'Int. M-125 Golden Plaza Horizonte, Jr. Antonio Bazo 510, La Victoria 15018, Perú, 4', 234.00, 'sended', '2021-06-19', '22:52:29');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla tienda_master.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` float(100,2) NOT NULL,
  `stock` int(255) NOT NULL,
  `oferta` varchar(2) DEFAULT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_categoria` (`categoria_id`),
  CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla tienda_master.productos: ~9 rows (aproximadamente)
DELETE FROM `productos`;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `oferta`, `fecha`, `imagen`) VALUES
	(18, 4, 'Benjamin Abel', 's simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make ', 333.00, 33, NULL, '2021-06-05', 'homme-tatoue-a-ipanema-0_940x705.jpg'),
	(20, 5, 'mi 555', 's simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make ', 555.00, 555, NULL, '2021-06-05', 'images (5).jpg'),
	(21, 2, 'mas tatuaje', 's simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make ', 45.00, 56, NULL, '2021-06-05', '1178805080_small.jpg'),
	(22, 3, 'otro mas', 's simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make ', 885.00, 33, NULL, '2021-06-05', 'd13740427d8cdf75e24e375d865e611a.jpg'),
	(23, 1, 'espalda', 'Una etiqueta de línea es aquella que ocupa el espacio mínimo necesario en horizontal, y permite que otro elemento se coloque a su lado. En cambio una etiqueta de bloque, ocupa todo el ancho disponible y no permite que otro elemento se coloque a su lado (aunque aparentemente tenga lugar suficiente).', 44.00, 354, NULL, '2021-06-05', 'homme-tatoue-a-ipanema-0_940x705.jpg'),
	(24, 3, 'mas tatu', 's simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make ', 59.00, 56, NULL, '2021-06-05', 'fb437a7fe724b9d7956004ecbc561675.jpg'),
	(25, 4, 'premiun tatu', 's simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make ', 87.00, 33, NULL, '2021-06-05', 'FB_IMG_1476534260971.jpg'),
	(26, 3, 'espalda rosa', 'aaaaaaaaaaaaas sssssssffsdfs dfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff ffffffffffffffffffffffff aaaaaaa', 334.00, 12, NULL, '2021-06-07', '14716519_1613641375598815_3799786072469143552_n.jpg'),
	(27, 1, 'Tatu Rallas azu ', 'Tatuaje de raya azu, estilo Asia con modelo gris de fuciones termicos en la es', 102.00, 122, NULL, '2021-06-10', 'Tatuajes.jpg');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla tienda_master.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla tienda_master.usuarios: ~17 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`, `imagen`) VALUES
	(2, 'Benjamin Abel', 'Sucasaire Huamani', 'benjaminsucasaire@gmail.com', '$2y$04$PVkPxE/9v15Y3a4gqsnnq.EvGbhiw9obiCM6bsaPAllwPgFqfvNDW', 'user', NULL),
	(4, 'Benjamin Abel', 'Sucasaire Huamani', 'benjaminsucasaire1@gmail.com', '$2y$04$StgJBNBva0NfQP95TPt8POOxMvk7tRDbCvdmL.HAtqf0mJ2x9ItOa', 'user', NULL),
	(7, 'Benjamin Abel', 'Huamani', 'benjaminsucasaire2@gmail.com', '$2y$04$pDmT0DavvY0TwAxOSbCwBeueN5jbNhGdVg4opD/uLeqkKCSt4eYGa', 'user', NULL),
	(16, 'Benjamin Abel', 'Huamani', 'benjaminsucasaire4@gmail.com', '$2y$04$z9uzsXeSkm4go9fIml/vv.qbQxdFpHa46MOUxTWRv/ZpzYN4/gzX2', 'user', NULL),
	(18, 'Benjamin Abel', 'Huamani', 'benjaminsucasaire5@gmail.com', '$2y$04$O8YhVi9F5NPcD.T4ZbC/wOAVkc20fzcoH7X5Bryjxi760acGSvw8K', 'user', NULL),
	(24, 'Benjamin Abel', 'Huamani', 'benjaminsucasaire3@gmail.com', '$2y$04$zpOwHfNDHPW5z/YZXq/x6eIsvunY0ha6bmdG4/a6LRc5oTG0Tt4DK', 'user', NULL),
	(27, 'Benjamin Abel', 'Huamani', 'benjaminsucasaire6@gmail.com', '$2y$04$0KDeBHJcNK5XTqoDups67us8fkgeSKWhFV6weqsdBzSxvZy7HD3D6', 'user', NULL),
	(28, 'Benjamin Abel', 'Huamani', 'benjaminsucasaire7@gmail.com', '$2y$04$umiYhrcCGb4L13NAW431ye5nHFxTEz2fbigqZ63/Wi/3gMWMjVIT.', 'user', NULL),
	(30, 'Benjamin Abel', 'Huamani', 'benjaminsucasaire8@gmail.com', '$2y$04$ocdra2Zajjysr1wYOjIQb.vusDUPtFl9/AH9eQj/iGeV0yOVTL3OS', 'user', NULL),
	(31, 'administrador', 'admin', 'admin@admin.com', '$2y$04$auuIAuVjwRW.mJTBV04VD.Hd/o313xPo2HA2xB6VSCrSVE56KJdMy', 'admin', NULL),
	(32, 'Abue', 'Sucasaire Huamani', 'benjaminsucasaire9@gmail.com', '$2y$04$sr7DrPWpJxAlDhV18qckMeUGQIi1BNVGat.3jIzEjF0diQGtCY7Aq', 'user', NULL),
	(33, 'martin', 'Sucasaire Huamani', 'martin@martin.com', '$2y$04$7Lxnv1eJ79uc5rco4grKlecdKp4k/3cxi.OTRJwwojBRxyuvfBg/2', 'user', NULL),
	(39, 'Benjamin Abel', 'Huamani', 'benjaminsucasaire75@gmail.com', '$2y$04$voNuLof4pXD9Oi4H4AiuKOVAgECowLxINcQsUF2BBNq28u6xEeeWu', 'user', NULL),
	(41, 'Benjamin Abel', 'Huamani', 'benjaminsucasaire554645@gmail.com', '$2y$04$p5U.D4tKejA/p8nCg22L7uRCaHrqjlKX9b9WPxZzCC9GIpm5uNGK6', 'user', NULL),
	(43, 'Benjamin Abel', 'Huamani', 'benjaminsucasaire4444333@gmail.com', '$2y$04$mkfbXKjwqtNJ0lKqxPURi.6eT7pPG48xhS8ENWVoVCkTZYyl7mJBm', 'user', NULL),
	(45, 'Benjamin Abel', 'Huamani', 'benjaminsucasaire32341@gmail.com', '$2y$04$b9bCNzNo5yZlYczBly7hQOkAyZIFojNiSKS7wtmqntQ5KLnhVJcRq', 'user', NULL),
	(46, 'Benjamin Abel', 'Huamani', 'benjaminsucasaire5g9@gmail.com', '$2y$04$RqunFwnIF/0jus3a4Ckv8eVbecUVQbnPqUbbGBpu7pZnEHet8t9BK', 'user', NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
