-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2016 a las 06:40:53
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `chemicalquery`
--
CREATE DATABASE IF NOT EXISTS `chemicalquery` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chemicalquery`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(200) NOT NULL,
  `contrasena` text NOT NULL,
  `permisos` tinyint(1) NOT NULL DEFAULT '0',
  `nombre` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `numeroCuenta` int(11) NOT NULL,
  `tipoCuenta` varchar(100) NOT NULL,
  `contrasenaRecover` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasena`, `permisos`, `nombre`, `apellidos`, `numeroCuenta`, `tipoCuenta`, `contrasenaRecover`) VALUES
(1, 'EddyAdmin', '$2x$09$baqSBOS2udgNzsJL5fV78uJhSYntJs4TOASMKD8S02lk8fRVTL.u.', 2, 'Eddy ', 'Arellanes Bastida', 413046930, '', '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
