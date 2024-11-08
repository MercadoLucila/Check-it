-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for checkit
CREATE DATABASE IF NOT EXISTS `checkit` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `checkit`;

-- Dumping structure for table checkit.alumno
CREATE TABLE IF NOT EXISTS `alumno` (
  `DNI` bigint NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `nacimiento` date NOT NULL,
  PRIMARY KEY (`DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Dumping data for table checkit.alumno: ~14 rows (approximately)
INSERT INTO `alumno` (`DNI`, `nombre`, `apellido`, `email`, `nacimiento`) VALUES
	(11222333, 'Giuliana', 'Mercado', 'giulianamercado43@gmail.com', '2004-02-15'),
	(44421224, 'Lucila', 'Mercado Ruiz', 'mrl@hotmail.com', '2002-12-03'),
	(44432554, 'Brian', 'González', 'briangonzaz@gmail.com', '2001-11-08'),
	(12345678091, 'David', 'Morales', 'david.morales@example.com', '1999-03-14'),
	(12345678901, 'Ana', 'García', 'ana.garcia@example.com', '2001-04-12'),
	(23456789011, 'Isabel', 'Díaz', 'isabel.diaz@example.com', '2000-06-05'),
	(23456789012, 'Luis', 'Martínez', 'luis.martinez@example.com', '2000-07-23'),
	(34567890112, 'Sofía', 'Torres', 'sofia.torres@example.com', '2002-10-22'),
	(34567890123, 'María', 'López', 'maria.lopez@example.com', '1999-01-15'),
	(45678901234, 'Juan', 'Gómez', 'juan.gomez@example.com', '2001-09-08'),
	(56789012345, 'Carmen', 'Rodríguez', 'carmen.rodriguez@example.com', '2002-02-27'),
	(67890123456, 'Pedro', 'Fernández', 'pedro.fernandez@example.com', '2000-05-30'),
	(78901234567, 'Lucía', 'Sánchez', 'lucia.sanchez@example.com', '1998-11-18'),
	(89012345678, 'Miguel', 'Jiménez', 'miguel.jimenez@example.com', '2002-08-25'),
	(90123456789, 'Elena', 'Ruiz', 'elena.ruiz@example.com', '2001-12-01');

-- Dumping structure for table checkit.asistencia
CREATE TABLE IF NOT EXISTS `asistencia` (
  `id_asistencia` int NOT NULL AUTO_INCREMENT,
  `codigo_materia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `DNI_alumno` bigint NOT NULL DEFAULT '0',
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_asistencia`),
  KEY `codigo_materia` (`codigo_materia`),
  KEY `FK_asistencia_materia_alumno_2` (`DNI_alumno`),
  CONSTRAINT `FK_asistencia_materia_alumno` FOREIGN KEY (`codigo_materia`) REFERENCES `materia_alumno` (`codigo_materia`) ON DELETE CASCADE,
  CONSTRAINT `FK_asistencia_materia_alumno_2` FOREIGN KEY (`DNI_alumno`) REFERENCES `materia_alumno` (`DNI`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Dumping data for table checkit.asistencia: ~0 rows (approximately)
INSERT INTO `asistencia` (`id_asistencia`, `codigo_materia`, `DNI_alumno`, `fecha`) VALUES
	(3, 'M4t32S1S', 44421224, '2024-11-07');

-- Dumping structure for table checkit.instituto
CREATE TABLE IF NOT EXISTS `instituto` (
  `CUE` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `direccion` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `nivel` enum('Primario','Secundario','Secundario Tecnico','Terciario Tecnico Superior','Universitario') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`CUE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Dumping data for table checkit.instituto: ~2 rows (approximately)
INSERT INTO `instituto` (`CUE`, `direccion`, `descripcion`, `nivel`, `nombre`) VALUES
	('111333444', 'Santa Fe 80', 'Instituto Catolico', 'Terciario Tecnico Superior', 'Sedes Sapientiae'),
	('12123', 'dasdadad', 'asdads', 'Primario', 'Malvinas'),
	('23', 'mi casa', 'clases de dibujo e ilustracion online', 'Terciario Tecnico Superior', 'Drawings');

-- Dumping structure for table checkit.materia
CREATE TABLE IF NOT EXISTS `materia` (
  `codigo_materia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_asignacion` int NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`codigo_materia`),
  KEY `id_asignacion` (`id_asignacion`),
  CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`id_asignacion`) REFERENCES `profesor_instituto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Dumping data for table checkit.materia: ~2 rows (approximately)
INSERT INTO `materia` (`codigo_materia`, `id_asignacion`, `nombre`) VALUES
	('INGL35T22DOS1S', 2, 'Inglés Técnico II - 2do Sistemas'),
	('M4t32S1S', 1, 'Matemáticas 1 Sistemas'),
	('PR0G2S1S', 1, 'ProgramacionII 2 Sistemas');

-- Dumping structure for table checkit.materia_alumno
CREATE TABLE IF NOT EXISTS `materia_alumno` (
  `id_matricula` int NOT NULL AUTO_INCREMENT,
  `codigo_materia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT '',
  `DNI` bigint NOT NULL,
  PRIMARY KEY (`id_matricula`),
  KEY `curso_alumno_ibfk_2` (`DNI`),
  KEY `curso_alumno_ibfk_1` (`codigo_materia`) USING BTREE,
  CONSTRAINT `materia_alumno_ibfk_2` FOREIGN KEY (`DNI`) REFERENCES `alumno` (`DNI`),
  CONSTRAINT `materia_alumno_ibfk_3` FOREIGN KEY (`codigo_materia`) REFERENCES `materia` (`codigo_materia`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Dumping data for table checkit.materia_alumno: ~3 rows (approximately)
INSERT INTO `materia_alumno` (`id_matricula`, `codigo_materia`, `DNI`) VALUES
	(1, 'M4t32S1S', 44421224),
	(2, 'PR0G2S1S', 44421224),
	(6, 'INGL35T22DOS1S', 11222333),
	(7, 'M4t32S1S', 11222333);

-- Dumping structure for table checkit.notas
CREATE TABLE IF NOT EXISTS `notas` (
  `id_nota` int NOT NULL AUTO_INCREMENT,
  `codigo_materia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT '0',
  `DNI_alumno` bigint NOT NULL,
  `calificacion` int NOT NULL DEFAULT '0',
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_nota`),
  KEY `codigo_materia` (`codigo_materia`),
  KEY `FK2_materia_alumno` (`DNI_alumno`),
  CONSTRAINT `FK_notas_alumno` FOREIGN KEY (`DNI_alumno`) REFERENCES `alumno` (`DNI`) ON DELETE CASCADE,
  CONSTRAINT `FK_notas_materia` FOREIGN KEY (`codigo_materia`) REFERENCES `materia` (`codigo_materia`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Dumping data for table checkit.notas: ~2 rows (approximately)
INSERT INTO `notas` (`id_nota`, `codigo_materia`, `DNI_alumno`, `calificacion`, `fecha`) VALUES
	(12, 'M4t32S1S', 44421224, 9, '2024-09-12'),
	(13, 'M4t32S1S', 44421224, 8, '2024-11-01'),
	(14, 'M4t32S1S', 44421224, 8, '2024-10-26');

-- Dumping structure for table checkit.profesor
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
  CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Dumping data for table checkit.profesor: ~0 rows (approximately)
INSERT INTO `profesor` (`email`, `legajo`, `clave`, `nombre`, `apellido`, `nacimiento`, `sexo`) VALUES
	('mercadoruizlucila@gmail.com', 12, '$2y$10$wo.U6e2mWcKTWz6ZUT/0ouVc0AlYkyJUSKkk8YOP59J2yOZxoeU9y', 'Luz', 'Ruiz', '2002-12-03', 'F');

-- Dumping structure for table checkit.profesor_instituto
CREATE TABLE IF NOT EXISTS `profesor_instituto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `legajo` int NOT NULL,
  `CUE` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `legajo` (`legajo`),
  KEY `CUE` (`CUE`),
  CONSTRAINT `profesor_instituto_ibfk_1` FOREIGN KEY (`legajo`) REFERENCES `profesor` (`legajo`),
  CONSTRAINT `profesor_instituto_ibfk_2` FOREIGN KEY (`CUE`) REFERENCES `instituto` (`CUE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Dumping data for table checkit.profesor_instituto: ~2 rows (approximately)
INSERT INTO `profesor_instituto` (`id`, `legajo`, `CUE`) VALUES
	(1, 12, '12123'),
	(2, 12, '111333444'),
	(3, 12, '23');

-- Dumping structure for table checkit.ram
CREATE TABLE IF NOT EXISTS `ram` (
  `CUE` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nota_regular` int NOT NULL DEFAULT '0',
  `nota_promocion` int NOT NULL DEFAULT '0',
  `asistencia_regular` float NOT NULL DEFAULT '0',
  `asistencia_promocion` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`CUE`),
  KEY `CUE` (`CUE`),
  CONSTRAINT `FK__instituto` FOREIGN KEY (`CUE`) REFERENCES `instituto` (`CUE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Dumping data for table checkit.ram: ~0 rows (approximately)
INSERT INTO `ram` (`CUE`, `nota_regular`, `nota_promocion`, `asistencia_regular`, `asistencia_promocion`) VALUES
	('12123', 6, 7, 60, 70);

-- Dumping structure for table checkit.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `clave` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nacimiento` date NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Dumping data for table checkit.usuario: ~0 rows (approximately)
INSERT INTO `usuario` (`email`, `clave`, `nombre`, `apellido`, `nacimiento`) VALUES
	('mercadoruizlucila@gmail.com', '$2y$10$0AyUJlN3AK21CaSRcTHi/.74XAkTe9dxNZYtBedAKBxFvZwnuNRKK', 'Luz', 'Ruiz', '2002-12-03');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
