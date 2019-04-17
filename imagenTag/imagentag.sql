-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-04-2019 a las 17:17:45
-- Versión del servidor: 5.7.23
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `imagentag`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenProyecto`
--

DROP TABLE IF EXISTS `imagenProyecto`;
CREATE TABLE IF NOT EXISTS `imagenProyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idImagen` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `tagPositionX` varchar(150) NOT NULL,
  `tagPositionY` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagenProyecto`
--

INSERT INTO `imagenProyecto` (`id`, `idImagen`, `idProveedor`, `tagPositionX`, `tagPositionY`) VALUES
(1, 0, 3, '287.5', '252.39999389648438'),
(2, 0, 1, '287.5', '266.3999938964844'),
(3, 0, 1, '291.5', '269.3999938964844'),
(7, 20, 4, '74.5', '468.3999938964844'),
(5, 20, 1, '767.5', '550.3999938964844'),
(6, 20, 3, '490.5', '227.39999389648438');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
