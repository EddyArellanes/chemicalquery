-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2016 a las 20:15:06
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
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `asunto` varchar(200) NOT NULL,
  `mensaje` text NOT NULL,
  `visto` tinyint(4) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `usuario`, `asunto`, `mensaje`, `visto`, `fecha`) VALUES
(21, 'EddyAdmin', 'Quiero ser Administrador', 'Hola, mucho gusto mi nombre es Ydde y quiero ser administrador.', 1, '2016-11-08 05:48:38'),
(22, 'EddyAdmin', 'Hola', 'Pues eso... Hola :3', 1, '2016-11-08 05:54:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `categoria` varchar(200) CHARACTER SET latin1 NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `fisicas` text COLLATE utf8_unicode_ci NOT NULL,
  `quimicas` text COLLATE utf8_unicode_ci NOT NULL,
  `termodinamicas` text COLLATE utf8_unicode_ci NOT NULL,
  `imagen` varchar(200) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `nombre` (`nombre`,`descripcion`),
  FULLTEXT KEY `nombre_2` (`nombre`),
  FULLTEXT KEY `descripcion` (`descripcion`),
  FULLTEXT KEY `fisicas_2` (`fisicas`),
  FULLTEXT KEY `nombre_3` (`nombre`,`descripcion`,`fisicas`,`quimicas`,`termodinamicas`),
  FULLTEXT KEY `fisicas` (`fisicas`),
  FULLTEXT KEY `quimicas` (`quimicas`),
  FULLTEXT KEY `termodinamicas` (`termodinamicas`),
  FULLTEXT KEY `nombre_4` (`nombre`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `categoria`, `descripcion`, `fisicas`, `quimicas`, `termodinamicas`, `imagen`) VALUES
(5, 'Maíz', 'Horneado', 'Maiz siempre ricolino', 'duro,amarillo', 'co3,nitrogeno', 'calientito,fresquesito', ''),
(6, 'Pan', 'Horneado', '', '', '', '', ''),
(7, 'SAgua', 'Liquido', '', '', '', '', 'agua.jpg'),
(8, 'Ron', 'Liquido', '', '', '', 'ebullicion, 102°', '');

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
  `imagen` text NOT NULL,
  `contrasenaRecover` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasena`, `permisos`, `nombre`, `apellidos`, `numeroCuenta`, `tipoCuenta`, `imagen`, `contrasenaRecover`) VALUES
(1, 'EddyAdmin', '$2x$09$cZ4U72AnUhuYwEceKTXaveW37494N1eeEJA9/nwsa1q5m2Ur1cQWC', 2, 'Eddy', 'Arellanes Bastidassss', 2147483647, 'Profesor', 'Torre_Oscura.jpg', '5fFwlSVkT3KPLrQi7Oso'),
(19, 'TorreNigga', '$2x$09$b3VNIuq5ynZ2bh31uSJQHOKXrr/H5kVuD6aZWjQcdHoq7Q3kV2udu', 2, 'Ernesto', 'TorreNega', 9872, 'Estudiante', '', '7lG0LOheCJfYVNkE5d1H'),
(32, 'reefefe', '$2x$09$faRUrR0P/JSbLEAfKs5rsOZlTHfWjBvVdyKOlcNpp4EGGHzDpg7z2', 2, 'Eddy', 'are', 3334343, 'Estudiante', '', ''),
(35, 'AlitaDestroyer', '$2x$09$wG1flA6pfqACDjIJgVU2CeC8rJffQya1JNF5akl6J4ZI2xEN1hLZG', 2, 'eddylll', 'TorreNega', 2147483647, 'Estudiante', '', ''),
(36, 'EddyAdminffff', '$2x$09$McVTXoXhtaNO/hbWpokfp.CuCeg3W9jirnIG31vpTPwS7/IGMHvVu', 2, 'eddy', 'are', 65445564, 'Estudiante', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
