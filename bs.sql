-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.5.10-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para prueba
CREATE DATABASE IF NOT EXISTS `prueba` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `prueba`;

-- Volcando estructura para tabla prueba.calendario
CREATE TABLE IF NOT EXISTS `calendario` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `lunes1` int(20) NOT NULL DEFAULT 0,
  `lunes2` int(20) NOT NULL DEFAULT 0,
  `martes1` int(20) NOT NULL DEFAULT 0,
  `martes2` int(20) NOT NULL DEFAULT 0,
  `miercoles1` int(20) NOT NULL DEFAULT 0,
  `miercoles2` int(20) NOT NULL DEFAULT 0,
  `jueves1` int(20) NOT NULL DEFAULT 0,
  `jueves2` int(20) NOT NULL DEFAULT 0,
  `viernes1` int(20) NOT NULL DEFAULT 0,
  `viernes2` int(20) NOT NULL DEFAULT 0,
  `sabado1` int(20) NOT NULL DEFAULT 0,
  `sabado2` int(20) NOT NULL DEFAULT 0,
  `domingo1` int(20) NOT NULL DEFAULT 0,
  `domingo2` int(20) NOT NULL DEFAULT 0,
  `user` int(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla prueba.calendario: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `calendario` DISABLE KEYS */;
INSERT INTO `calendario` (`id`, `lunes1`, `lunes2`, `martes1`, `martes2`, `miercoles1`, `miercoles2`, `jueves1`, `jueves2`, `viernes1`, `viernes2`, `sabado1`, `sabado2`, `domingo1`, `domingo2`, `user`) VALUES
	(1, 12, 2, 9, 12, 3, 2, 9, 2, 3, 2, 3, 9, 9, 12, 1);
/*!40000 ALTER TABLE `calendario` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.combinacionescomidas
CREATE TABLE IF NOT EXISTS `combinacionescomidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comida1` int(11) NOT NULL DEFAULT 0,
  `comida2` int(11) NOT NULL DEFAULT 0,
  `kcal` int(11) NOT NULL DEFAULT 0,
  `proteina` int(11) NOT NULL DEFAULT 0,
  `grasa` int(11) NOT NULL DEFAULT 0,
  `user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla prueba.combinacionescomidas: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `combinacionescomidas` DISABLE KEYS */;
INSERT INTO `combinacionescomidas` (`id`, `comida1`, `comida2`, `kcal`, `proteina`, `grasa`, `user`) VALUES
	(3, 2, 3, 1995, 127, 77, 1),
	(4, 2, 12, 1885, 118, 88, 1),
	(5, 3, 2, 1995, 127, 77, 1),
	(6, 3, 9, 1457, 89, 58, 1),
	(7, 9, 3, 1457, 89, 58, 1),
	(8, 9, 12, 1346, 80, 69, 1),
	(9, 12, 2, 1885, 118, 88, 1),
	(10, 12, 9, 1346, 80, 69, 1);
/*!40000 ALTER TABLE `combinacionescomidas` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.comidaingredientes
CREATE TABLE IF NOT EXISTS `comidaingredientes` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `comida` int(20) NOT NULL,
  `ingrediente` int(20) NOT NULL,
  `cant` float DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `comida` (`comida`),
  KEY `ingrediente` (`ingrediente`),
  CONSTRAINT `comidaIngredientes_ibfk_1` FOREIGN KEY (`comida`) REFERENCES `comidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comidaIngredientes_ibfk_2` FOREIGN KEY (`ingrediente`) REFERENCES `ingredientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla prueba.comidaingredientes: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `comidaingredientes` DISABLE KEYS */;
INSERT INTO `comidaingredientes` (`id`, `comida`, `ingrediente`, `cant`) VALUES
	(1, 2, 1, 120),
	(2, 2, 2, 300),
	(3, 2, 3, 20),
	(4, 3, 5, 320),
	(5, 3, 8, 130),
	(6, 2, 4, 200),
	(7, 3, 7, 200),
	(8, 3, 1, 80),
	(9, 3, 6, 40),
	(18, 9, 13, 400),
	(19, 9, 14, 150),
	(23, 12, 1, 20),
	(24, 12, 3, 100),
	(25, 12, 6, 50);
/*!40000 ALTER TABLE `comidaingredientes` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.comidas
CREATE TABLE IF NOT EXISTS `comidas` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `prio` int(2) NOT NULL DEFAULT 1,
  `cont` int(20) NOT NULL DEFAULT 0,
  `last` date NOT NULL DEFAULT curdate(),
  `tipo` varchar(50) DEFAULT 'COMIDA',
  `user` int(20) DEFAULT NULL,
  `raciones` int(3) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla prueba.comidas: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `comidas` DISABLE KEYS */;
INSERT INTO `comidas` (`id`, `name`, `prio`, `cont`, `last`, `tipo`, `user`, `raciones`) VALUES
	(0, 'LIBRE', 11, 0, '2021-07-05', 'AMBOS', 1, 1),
	(2, 'Bocadillo de pechuga con bacon', 9, 2, '2021-06-23', 'CENA', 1, 1),
	(3, 'Espaguetis a la carbonara', 1, 1, '2021-06-23', 'COMIDA', 1, 4),
	(9, 'Leche con Galletas Principe', 5, 0, '2021-07-03', 'CENA', 1, 1),
	(12, 'ComidaPrueba', 1, 0, '2021-07-06', 'COMIDA', 1, 2),
	(14, 'Espaguetis a la carbonara', 1, 1, '2021-06-23', 'COMIDA', 2, 4),
	(15, 'LIBRE', 11, 0, '2021-07-05', 'AMBOS', 2, 1);
/*!40000 ALTER TABLE `comidas` ENABLE KEYS */;

-- Volcando estructura para tabla prueba.ingredientes
CREATE TABLE IF NOT EXISTS `ingredientes` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `kcal` float NOT NULL DEFAULT 0,
  `grasa` float NOT NULL DEFAULT 0,
  `saturadas` float NOT NULL DEFAULT 0,
  `hc` float NOT NULL DEFAULT 0,
  `azucar` float NOT NULL DEFAULT 0,
  `fibra` float NOT NULL DEFAULT 0,
  `proteina` float NOT NULL DEFAULT 0,
  `sal` float NOT NULL DEFAULT 0,
  `calcio` float NOT NULL DEFAULT 0,
  `fosforo` float NOT NULL DEFAULT 0,
  `hierro` float NOT NULL DEFAULT 0,
  `unidad` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla prueba.ingredientes: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `ingredientes` DISABLE KEYS */;
INSERT INTO `ingredientes` (`id`, `name`, `kcal`, `grasa`, `saturadas`, `hc`, `azucar`, `fibra`, `proteina`, `sal`, `calcio`, `fosforo`, `hierro`, `unidad`) VALUES
	(1, 'bacon', 349, 31.7, 12.7, 1, 1, 0, 14.9, 2.4, 0, 0, 0, 'g'),
	(2, 'pechuga de pollo', 110, 2.1, 0.7, 0, 0, 0, 22, 0.14, 0, 0, 0, 'g'),
	(3, 'cebolla frita', 590, 44, 21, 40, 9, 5, 6, 1.2, 0, 0, 0, 'g'),
	(4, 'Pan', 300, 1.4, 0.3, 59, 1.7, 4.1, 11, 1.6, 0, 0, 0, 'g'),
	(5, 'Tallarines', 366, 1.5, 0.3, 74, 3.5, 4, 12, 0.04, 0, 0, 0, 'g'),
	(6, 'Cuatro quesos', 352, 28, 19, 0, 0, 0, 25, 1.9, 0, 0, 0, 'g'),
	(7, 'Nata para conicar', 163, 15, 10, 5, 3, 0, 2, 0.1, 0, 0, 0, 'ml'),
	(8, 'huevos', 150, 11.1, 3.1, 0.5, 0.5, 0, 12.5, 0.36, 0, 0, 0, 'g'),
	(13, 'Leche semidesnatada', 51, 1.6, 3.9, 1, 5.2, 0, 5.2, 0.13, 0.18, 0.15, 0, 'ml'),
	(14, 'Galletas Principe', 483, 20, 6.1, 6.9, 68, 3.8, 32, 0.32, 0, 0, 0, 'g');
/*!40000 ALTER TABLE `ingredientes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
