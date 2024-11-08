-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para checkit
CREATE DATABASE IF NOT EXISTS `checkit` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `checkit`;

-- Volcando estructura para tabla checkit.alumno
CREATE TABLE IF NOT EXISTS `alumno` (
  `DNI` bigint NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `nacimiento` date NOT NULL,
  PRIMARY KEY (`DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla checkit.alumno: ~22 rows (aproximadamente)
INSERT INTO `alumno` (`DNI`, `nombre`, `apellido`, `email`, `nacimiento`) VALUES
	(31678123, 'Elisa', 'Ronconi', 'elisa.ronconi@email.com', '1995-01-24'),
	(32456789, 'Luca', 'Giordano', 'luca.giordano@email.com', '1997-06-02'),
	(32567890, 'Lucila', 'Mercado Ruiz', 'lucila.mercado@email.com', '1996-12-08'),
	(32789012, 'Ignacio', 'Piter', 'ignacio.piter@email.com', '1996-05-19'),
	(33234567, 'Exequiel', 'Sanchez', 'exequiel.sanchez@email.com', '1998-04-11'),
	(33345678, 'Giuliana', 'Mercado Aviles', 'giuliana.mercado@email.com', '1995-10-22'),
	(33567890, 'Agustin', 'Gomez', 'agustin.gomez@email.com', '1996-04-30'),
	(33789456, 'Melina', 'Schimpf Baldo', 'melina.schimpf@email.com', '1996-10-09'),
	(34567890, 'Diego', 'Segovia', 'diego.segovia@email.com', '1997-02-13'),
	(34876543, 'Lucas', 'Cedres', 'lucas.cedres@email.com', '1998-09-07'),
	(34890123, 'Angel', 'Murillo', 'angel.murillo@email.com', '1998-02-27'),
	(35123456, 'Valentino', 'Andrade', 'valentino.andrade@email.com', '1999-03-12'),
	(35234567, 'Fausto', 'Parada', 'fausto.parada@email.com', '1997-11-06'),
	(35345678, 'Yamil', 'Villa', 'yamil.villa@email.com', '1998-06-28'),
	(35678901, 'Brian', 'Gonzalez', 'brian.gonzalez@email.com', '1997-12-05'),
	(36123456, 'Juan', 'Nissero', 'juan.nissero@email.com', '1999-07-17'),
	(36456789, 'Camila', 'Sittner', 'camila.sittner@email.com', '1999-08-20'),
	(36789123, 'Bruno', 'Godoy', 'bruno.godoy@email.com', '1999-01-18'),
	(37890123, 'Federico', 'Guigou Scottini', 'federico.guigou@email.com', '1998-08-15'),
	(38901234, 'Luna', 'Marrano', 'luna.marrano@email.com', '1999-03-10'),
	(40123789, 'Facundo', 'Figun', 'facundo.figun@email.com', '2000-11-25'),
	(40456789, 'Tomas', 'Planchon', 'tomas.planchon@email.com', '2000-09-03');

-- Volcando estructura para tabla checkit.asistencia
CREATE TABLE IF NOT EXISTS `asistencia` (
  `id_asistencia` int NOT NULL AUTO_INCREMENT,
  `codigo_materia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `DNI_alumno` bigint NOT NULL DEFAULT '0',
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_asistencia`),
  KEY `codigo_materia` (`codigo_materia`),
  KEY `FK_asistencia_materia_alumno_2` (`DNI_alumno`),
  CONSTRAINT `FK_asistencia_materia_alumno` FOREIGN KEY (`codigo_materia`) REFERENCES `materia_alumno` (`codigo_materia`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_asistencia_materia_alumno_2` FOREIGN KEY (`DNI_alumno`) REFERENCES `materia_alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla checkit.asistencia: ~0 rows (aproximadamente)

-- Volcando estructura para tabla checkit.instituto
CREATE TABLE IF NOT EXISTS `instituto` (
  `CUE` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `direccion` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `nivel` enum('Primario','Secundario','Secundario Tecnico','Terciario Tecnico Superior','Universitario') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`CUE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla checkit.instituto: ~1 rows (aproximadamente)
INSERT INTO `instituto` (`CUE`, `direccion`, `descripcion`, `nivel`, `nombre`) VALUES
	('132342422211', 'Sepa Dios', 'Instituto Católico Terciario Superior', 'Terciario Tecnico Superior', 'Sedes Sapientiae');

-- Volcando estructura para tabla checkit.materia
CREATE TABLE IF NOT EXISTS `materia` (
  `codigo_materia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_asignacion` int NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`codigo_materia`),
  KEY `id_asignacion` (`id_asignacion`),
  CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`id_asignacion`) REFERENCES `profesor_instituto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla checkit.materia: ~1 rows (aproximadamente)
INSERT INTO `materia` (`codigo_materia`, `id_asignacion`, `nombre`) VALUES
	('PROGII2SIS', 5, 'Programacion II 2°Sistemas');

-- Volcando estructura para tabla checkit.materia_alumno
CREATE TABLE IF NOT EXISTS `materia_alumno` (
  `id_matricula` int NOT NULL AUTO_INCREMENT,
  `codigo_materia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT '',
  `DNI` bigint NOT NULL,
  PRIMARY KEY (`id_matricula`),
  KEY `curso_alumno_ibfk_2` (`DNI`),
  KEY `curso_alumno_ibfk_1` (`codigo_materia`) USING BTREE,
  CONSTRAINT `materia_alumno_ibfk_2` FOREIGN KEY (`DNI`) REFERENCES `alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `materia_alumno_ibfk_3` FOREIGN KEY (`codigo_materia`) REFERENCES `materia` (`codigo_materia`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla checkit.materia_alumno: ~22 rows (aproximadamente)
INSERT INTO `materia_alumno` (`id_matricula`, `codigo_materia`, `DNI`) VALUES
	(11, 'PROGII2SIS', 35123456),
	(12, 'PROGII2SIS', 34876543),
	(13, 'PROGII2SIS', 40123789),
	(14, 'PROGII2SIS', 32456789),
	(15, 'PROGII2SIS', 36789123),
	(16, 'PROGII2SIS', 33567890),
	(17, 'PROGII2SIS', 35678901),
	(18, 'PROGII2SIS', 37890123),
	(19, 'PROGII2SIS', 38901234),
	(20, 'PROGII2SIS', 33345678),
	(21, 'PROGII2SIS', 32567890),
	(22, 'PROGII2SIS', 34890123),
	(23, 'PROGII2SIS', 36123456),
	(24, 'PROGII2SIS', 35234567),
	(25, 'PROGII2SIS', 32789012),
	(26, 'PROGII2SIS', 40456789),
	(27, 'PROGII2SIS', 31678123),
	(28, 'PROGII2SIS', 33234567),
	(29, 'PROGII2SIS', 33789456),
	(30, 'PROGII2SIS', 34567890),
	(31, 'PROGII2SIS', 36456789),
	(32, 'PROGII2SIS', 35345678);

-- Volcando estructura para tabla checkit.notas
CREATE TABLE IF NOT EXISTS `notas` (
  `id_nota` int NOT NULL AUTO_INCREMENT,
  `codigo_materia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT '0',
  `DNI_alumno` bigint NOT NULL,
  `calificacion` int NOT NULL DEFAULT '0',
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_nota`),
  KEY `codigo_materia` (`codigo_materia`),
  KEY `FK2_materia_alumno` (`DNI_alumno`),
  CONSTRAINT `FK_notas_alumno` FOREIGN KEY (`DNI_alumno`) REFERENCES `alumno` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_notas_materia` FOREIGN KEY (`codigo_materia`) REFERENCES `materia` (`codigo_materia`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla checkit.notas: ~0 rows (aproximadamente)

-- Volcando estructura para tabla checkit.profesor
CREATE TABLE IF NOT EXISTS `profesor` (
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `legajo` int NOT NULL,
  `clave` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nacimiento` date NOT NULL,
  `sexo` enum('M','F','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`legajo`),
  KEY `email` (`email`),
  CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla checkit.profesor: ~1 rows (aproximadamente)
INSERT INTO `profesor` (`email`, `legajo`, `clave`, `nombre`, `apellido`, `nacimiento`, `sexo`) VALUES
	('javierparra@gmail.com', 10, '$2y$10$l2k8belKkuM4QENToTOgJejHrUHuOfZ4rQkawNgX35KGIIBTkmj0i', 'Javier', 'Parra', '2024-11-14', 'M');

-- Volcando estructura para tabla checkit.profesor_instituto
CREATE TABLE IF NOT EXISTS `profesor_instituto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `legajo` int NOT NULL,
  `CUE` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `legajo` (`legajo`),
  KEY `CUE` (`CUE`),
  CONSTRAINT `profesor_instituto_ibfk_1` FOREIGN KEY (`legajo`) REFERENCES `profesor` (`legajo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `profesor_instituto_ibfk_2` FOREIGN KEY (`CUE`) REFERENCES `instituto` (`CUE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla checkit.profesor_instituto: ~1 rows (aproximadamente)
INSERT INTO `profesor_instituto` (`id`, `legajo`, `CUE`) VALUES
	(5, 10, '132342422211');

-- Volcando estructura para tabla checkit.ram
CREATE TABLE IF NOT EXISTS `ram` (
  `CUE` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nota_regular` int NOT NULL DEFAULT '0',
  `nota_promocion` int NOT NULL DEFAULT '0',
  `asistencia_regular` float NOT NULL DEFAULT '0',
  `asistencia_promocion` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`CUE`),
  KEY `CUE` (`CUE`),
  CONSTRAINT `FK__instituto` FOREIGN KEY (`CUE`) REFERENCES `instituto` (`CUE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla checkit.ram: ~0 rows (aproximadamente)

-- Volcando estructura para tabla checkit.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `clave` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nacimiento` date NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla checkit.usuario: ~1 rows (aproximadamente)
INSERT INTO `usuario` (`email`, `clave`, `nombre`, `apellido`, `nacimiento`) VALUES
	('javierparra@gmail.com', '$2y$10$kg0mTVMfzLOt3Bg1yc2e9Ofz905Oipfou.948dIKyymsr0Pp647Mm', 'Javier', 'Parra', '2024-11-14');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
