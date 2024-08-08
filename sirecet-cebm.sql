-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2024 a las 21:56:29
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sirecet-cebm`
--
CREATE DATABASE IF NOT EXISTS `sirecet-cebm` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sirecet-cebm`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

DROP TABLE IF EXISTS `reportes`;
CREATE TABLE `reportes` (
  `id_reporte` int(11) NOT NULL,
  `equipo` varchar(50) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `servicio` varchar(100) NOT NULL,
  `dependencia` varchar(500) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion` varchar(500) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'Pendiente',
  `fecha_actualizacion_estado` datetime DEFAULT NULL,
  `archivado` varchar(2) DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Disparadores `reportes`
--
DROP TRIGGER IF EXISTS `actualizar_fecha_reportes`;
DELIMITER $$
CREATE TRIGGER `actualizar_fecha_reportes` BEFORE UPDATE ON `reportes` FOR EACH ROW BEGIN
    IF NEW.fecha_actualizacion_estado IS NOT NULL THEN
        SET NEW.fecha_actualizacion_estado = CURRENT_TIMESTAMP;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_cargo` int(2) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `contrasena` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_cargo`, `nombre_usuario`, `contrasena`) VALUES
(1, 'Admin', 12345),
(2, 'despacho1', 1),
(3, 'despacho2', 2),
(4, 'despacho3', 3),
(5, 'despacho4', 4),
(6, 'despacho5', 5),
(7, 'despacho6', 6),
(8, 'despacho7', 7),
(9, 'despacho8', 8),
(10, 'despacho9', 9),
(11, 'despacho10', 10),
(12, 'despacho11', 11),
(13, 'despacho12', 12),
(14, 'despacho13', 13),
(15, 'despacho14', 14),
(16, 'despacho15', 15),
(17, 'despacho16', 16),
(18, 'despacho17', 17),
(19, 'despacho18', 18),
(20, 'despacho19', 19);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id_reporte`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_cargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
