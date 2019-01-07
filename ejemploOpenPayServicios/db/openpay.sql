-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2018 a las 21:08:47
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `openpay`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `clt_id` int(11) NOT NULL AUTO_INCREMENT,
  `clt_nombre` varchar(50) NOT NULL,
  `clt_apellido` varchar(50) NOT NULL,
  `clt_telefono` varchar(50) NOT NULL,
  `clt_email` varchar(50) NOT NULL,
  `clt_tipoCliente` int(1) NOT NULL,
  `clt_openpayCustomer` longtext NOT NULL,
  `clt_openpayCard` longtext NOT NULL,
  `clt_openpaySuscripcion` longtext NOT NULL,
  PRIMARY KEY (`clt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`clt_id`, `clt_nombre`, `clt_apellido`, `clt_telefono`, `clt_email`, `clt_tipoCliente`, `clt_openpayCustomer`, `clt_openpayCard`, `clt_openpaySuscripcion`) VALUES
(1, 'Jonathan', 'Jimenez Gamero', '5538030380', 'jonysthil@gmail.com', 0, '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagoPlan`
--

CREATE TABLE IF NOT EXISTS `pagoPlan` (
  `pp_Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del pago',
  `cli_d` int(11) NOT NULL COMMENT 'Referencia a la tabla propiedad',
  `pp_monto` decimal(10,2) NOT NULL COMMENT 'Cuanto se cobrara mes a mes',
  `pp_fechaPago` date NOT NULL DEFAULT '0000-00-00' COMMENT 'Fecha en el que se realizo el pago',
  `pp_estatusPago` int(11) NOT NULL DEFAULT '2' COMMENT 'Referencia a la tabla estatus de pago',
  `pp_openpayCustumer` longtext NOT NULL COMMENT 'Datos de OpenPay',
  `pp_openpayCard` longtext NOT NULL COMMENT 'Datos de OpenPay',
  PRIMARY KEY (`pp_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla de pos de suscripciones' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `pd_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del pedido',
  `clt_id` int(11) NOT NULL COMMENT 'Referencia a la tabla cliente',
  `pd_descripcion` longtext NOT NULL COMMENT 'Informacion del pedido',
  `pd_total` decimal(10,2) DEFAULT NULL COMMENT 'Total Final a pagar',
  `pd_pagoEstatus` varchar(50) NOT NULL,
  `pd_pagoFecha` varchar(50) NOT NULL,
  PRIMARY KEY (`pd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Taba de pedidos' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`pd_id`, `clt_id`, `pd_descripcion`, `pd_total`, `pd_pagoEstatus`, `pd_pagoFecha`) VALUES
(1, 1, 'Producto 430105 CINTA M-TAPE Cantidad 4 Precio Unitario $149.00 Subtotal $596.00, --Producto 43003 TOBILLERA XLP GRANDE Cantidad 5 Precio Unitario $789.00 Subtotal $3945.00, --Producto 130105 Cinta M-Tape blanco 32 rollos 3.8 cm X 13.7m Cantidad 2 Precio Unitario $1499.00 Subtotal $2998.00, --Producto 130105 Cinta M-Tape blanco 32 rollos 3.8 cm X 13.7m Cantidad 2 Precio Unitario $1499.00 Subtotal $2998.00', '2750.00', 'completed', '17-05-30 17:31:27');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
