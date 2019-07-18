-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2019 a las 16:17:23
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hipermedial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `mail_codigo` int(11) NOT NULL,
  `mail_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mail_asunto` varchar(100) NOT NULL,
  `mail_mensaje` varchar(255) NOT NULL,
  `usu_remitente` int(11) NOT NULL,
  `usu_destino` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`mail_codigo`, `mail_fecha`, `mail_asunto`, `mail_mensaje`, `usu_remitente`, `usu_destino`) VALUES
(4, '2019-05-18 02:43:27', 'Prueba 3', 'HOLA', 6, 4),
(5, '2019-05-18 02:44:34', 'Prueba 1', 'Hola', 4, 6),
(6, '2019-05-18 07:37:27', 'Enviado desde Jonnathan', 'Hola', 9, 4),
(7, '2019-05-18 19:19:56', 'Enviado desde Claudio', 'Hola', 4, 6),
(8, '2019-05-18 19:20:41', 'Enviado desde Claudio', 'Hola', 4, 6),
(9, '2019-05-18 19:22:03', 'Enviado desde Claudio', 'Hola', 4, 9),
(11, '2019-05-19 06:14:56', '123', '123', 4, 5),
(12, '2019-05-19 06:32:06', 'Enviado desde Christian', 'Esto e suna prueba de mensaje...', 6, 4),
(13, '2019-05-23 01:35:57', 'Envioado desde Mario', 'Hola Claudio', 10, 4),
(14, '2019-05-24 00:15:50', 'Perdi el ciclo', 'De verdad pedi el ciclo', 4, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_codigo` int(11) NOT NULL,
  `usu_cedula` varchar(10) NOT NULL,
  `usu_nombres` varchar(50) NOT NULL,
  `usu_apellidos` varchar(50) NOT NULL,
  `usu_direccion` varchar(75) NOT NULL,
  `usu_telefono` varchar(20) NOT NULL,
  `usu_correo` varchar(20) NOT NULL,
  `usu_password` varchar(255) NOT NULL,
  `usu_fecha_nacimiento` date NOT NULL,
  `usu_eliminado` varchar(1) NOT NULL DEFAULT 'N',
  `usu_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usu_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `usu_rol` varchar(5) NOT NULL DEFAULT 'user',
  `usu_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_codigo`, `usu_cedula`, `usu_nombres`, `usu_apellidos`, `usu_direccion`, `usu_telefono`, `usu_correo`, `usu_password`, `usu_fecha_nacimiento`, `usu_eliminado`, `usu_fecha_creacion`, `usu_fecha_modificacion`, `usu_rol`, `usu_img`) VALUES
(4, '010646470', 'CLAUDIO', 'MALDONADO', 'GUALACEO', '3051114001', 'claudio@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1961-03-28', 'N', '2019-04-27 23:12:42', '2019-05-19 23:41:09', 'user', '10015062_231246500399425_5330165103815611953_n.png'),
(5, '0106464457', 'ADMIN', 'ADMIN', 'CUENCA', '0123625632', 'admin@mail.com', '202cb962ac59075b964b07152d234b70', '2000-01-03', 'N', '2019-04-28 01:05:12', '2019-05-19 02:54:37', 'admin', '10015062_231246500399425_5330165103815611953_n.png'),
(6, '1230236520', 'CHRISTIAN', 'MOCHA', 'CUENCA', '210325362', 'christian@mail.com', '202cb962ac59075b964b07152d234b70', '1111-11-11', 'N', '2019-05-18 02:41:25', '2019-05-19 02:49:35', 'user', 'Screenshot_7.png'),
(7, '1203253621', 'JONNATHAN', 'OCHOA', 'CUENCA', '12536215', 'ochoa@mail.com', '202cb962ac59075b964b07152d234b70', '1111-11-11', 'N', '2019-05-18 05:09:32', '2019-05-19 02:50:21', 'user', 'Screenshot_1.png'),
(9, '1203253512', 'JONNATHAN', 'OCHOA', 'CUENCA', '12536215', 'jonnathan@mail.com', '202cb962ac59075b964b07152d234b70', '1111-11-11', 'N', '2019-05-18 05:52:29', NULL, 'user', 'perfil.jpg'),
(10, '0125362325', 'MARIO', 'MARTINES', 'CUENCA', '2023623', 'mario@mail.com', '202cb962ac59075b964b07152d234b70', '1111-11-11', 'S', '2019-05-23 01:34:18', '2019-05-23 08:36:17', 'user', 'Digital_Art_Dark_Wallpapers_10 (darkwallz.blogspot.com).jpg'),
(11, '', '', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '0000-00-00', 'N', '2019-05-28 00:09:33', NULL, 'user', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`mail_codigo`),
  ADD KEY `FK_UsuMensajeRemitente` (`usu_remitente`),
  ADD KEY `FK_UsuMensajeDestino` (`usu_destino`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_codigo`),
  ADD UNIQUE KEY `usu_cedula` (`usu_cedula`),
  ADD UNIQUE KEY `usu_correo` (`usu_correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `mail_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `FK_UsuMensajeDestino` FOREIGN KEY (`usu_destino`) REFERENCES `usuario` (`usu_codigo`),
  ADD CONSTRAINT `FK_UsuMensajeRemitente` FOREIGN KEY (`usu_remitente`) REFERENCES `usuario` (`usu_codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
