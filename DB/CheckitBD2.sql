-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.31-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
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
CREATE DATABASE IF NOT EXISTS `checkit` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci */;
USE `checkit`;

-- Volcando estructura para tabla checkit.alumno
CREATE TABLE IF NOT EXISTS `alumno` (
  `DNI` bigint(20) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `nacimiento` date NOT NULL,
  PRIMARY KEY (`DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla checkit.asignacion
CREATE TABLE IF NOT EXISTS `asignacion` (
  `id_asignacion` int(11) NOT NULL AUTO_INCREMENT,
  `legajo` int(11) NOT NULL,
  `CUE` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_asignacion`),
  KEY `legajo` (`legajo`),
  KEY `CUE` (`CUE`),
  CONSTRAINT `asignacion_ibfk_1` FOREIGN KEY (`legajo`) REFERENCES `profesor` (`legajo`),
  CONSTRAINT `asignacion_ibfk_2` FOREIGN KEY (`CUE`) REFERENCES `instituto` (`CUE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla checkit.asistencia
CREATE TABLE IF NOT EXISTS `asistencia` (
  `id_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_matricula` int(11) NOT NULL,
  `puntuacion` enum('3','4','5') COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_asistencia`),
  KEY `asistencia_ibfk_1` (`id_matricula`),
  CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`id_matricula`) REFERENCES `materia_alumno` (`id_matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla checkit.instituto
CREATE TABLE IF NOT EXISTS `instituto` (
  `CUE` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `nivel` enum('Primario','Secundario','Secundario Tecnico','Terciario Tecnico Superior','Universitario') COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`CUE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla checkit.materia
CREATE TABLE IF NOT EXISTS `materia` (
  `codigo_materia` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_asignacion` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`codigo_materia`),
  KEY `id_asignacion` (`id_asignacion`),
  CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`id_asignacion`) REFERENCES `asignacion` (`id_asignacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla checkit.materia_alumno
CREATE TABLE IF NOT EXISTS `materia_alumno` (
  `id_matricula` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_materia` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT '',
  `DNI` bigint(20) NOT NULL,
  PRIMARY KEY (`id_matricula`),
  KEY `curso_alumno_ibfk_2` (`DNI`),
  KEY `curso_alumno_ibfk_1` (`codigo_materia`) USING BTREE,
  CONSTRAINT `materia_alumno_ibfk_2` FOREIGN KEY (`DNI`) REFERENCES `alumno` (`DNI`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `materia_alumno_ibfk_3` FOREIGN KEY (`codigo_materia`) REFERENCES `materia` (`codigo_materia`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla checkit.notas
CREATE TABLE IF NOT EXISTS `notas` (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `id_matricula` int(11) NOT NULL DEFAULT '0',
  `calificacion` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_nota`),
  KEY `FK_alumno` (`id_matricula`) USING BTREE,
  CONSTRAINT `FK_materia_alumno` FOREIGN KEY (`id_matricula`) REFERENCES `materia_alumno` (`id_matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla checkit.profesor
CREATE TABLE IF NOT EXISTS `profesor` (
  `email` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `legajo` int(11) NOT NULL,
  `clave` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nacimiento` date NOT NULL,
  `sexo` enum('M','F','N') COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`legajo`),
  KEY `email` (`email`),
  CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla checkit.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `email` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `clave` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nacimiento` date NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
