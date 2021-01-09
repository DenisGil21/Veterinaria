-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-01-2021 a las 03:02:40
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `veterinaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `cve_cita` int(11) NOT NULL,
  `cve_persona` int(11) DEFAULT NULL,
  `cve_empresa` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `nota` varchar(150) NOT NULL,
  `activo` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`cve_cita`, `cve_persona`, `cve_empresa`, `fecha`, `hora`, `nota`, `activo`) VALUES
(20, 26, 1, '2020-07-25', '08:00:00', 'llegar temprano', b'1'),
(21, 27, 1, '2020-07-28', '07:00:00', '', b'1'),
(22, 28, 1, '2020-07-29', '08:30:00', '', b'1'),
(23, 28, 1, '2020-07-28', '09:30:00', '', b'1'),
(24, 27, 1, '2020-07-30', '09:30:00', '', b'1'),
(25, 30, 1, '2020-07-31', '07:00:00', '', b'1'),
(26, 28, 1, '2020-08-01', '08:30:00', '', b'1'),
(27, 26, 1, '2020-07-31', '07:30:00', '', b'1'),
(28, 26, 1, '2020-08-08', '15:30:00', '', b'1'),
(29, 26, 1, '2020-08-09', '11:00:00', '', b'1'),
(30, 27, 1, '2020-08-09', '12:00:00', '', b'1'),
(31, 27, 1, '2020-08-25', '08:00:00', '', b'0'),
(32, 27, 1, '2020-08-25', '08:30:00', '', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `cve_empleado` int(11) NOT NULL,
  `cve_empresa` int(11) DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`cve_empleado`, `cve_empresa`, `activo`) VALUES
(1, 1, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `cve_empresa` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`cve_empresa`, `nombre`, `direccion`, `telefono`) VALUES
(1, 'Happy Pet', 'Jalapa, Tabasco', '9321186344');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especies`
--

CREATE TABLE `especies` (
  `cve_especie` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `especies`
--

INSERT INTO `especies` (`cve_especie`, `nombre`, `activo`) VALUES
(1, 'Perro', b'1'),
(2, 'Gato', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `cve_horario` int(11) NOT NULL,
  `cve_empresa` int(11) DEFAULT NULL,
  `turno` varchar(20) NOT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `activo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`cve_horario`, `cve_empresa`, `turno`, `hora_entrada`, `hora_salida`, `activo`) VALUES
(4, 1, 'Matutino', '07:00:00', '16:00:00', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `cve_mascota` int(11) NOT NULL,
  `cve_raza` int(11) DEFAULT NULL,
  `cve_persona` int(11) DEFAULT NULL,
  `imagen` varchar(250) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `sexo` bit(1) DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`cve_mascota`, `cve_raza`, `cve_persona`, `imagen`, `nombre`, `nacimiento`, `sexo`, `activo`) VALUES
(20, 2, 26, 'perro.jpg', 'Rocky', '2013-07-07', b'1', b'1'),
(21, 12, 27, 'pitbull.jpg', 'Rex', '2015-02-27', b'1', b'1'),
(22, 4, 28, 'somali.jpg', 'Anubis', '2015-02-03', b'1', b'1'),
(23, 10, 30, 'pug.jpg', 'Scrappy', '2012-01-01', b'1', b'1'),
(24, 11, 29, 'rott.jpg', 'Rocky', '2017-07-01', b'1', b'1'),
(25, 12, 26, 'pitbull.jpg', 'Ares', '2020-07-28', b'1', b'0'),
(26, 12, 26, 'pitbull.jpg', 'Ares', '2016-08-03', b'1', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas_servicios`
--

CREATE TABLE `mascotas_servicios` (
  `cve_venta` int(11) NOT NULL,
  `cve_mascota` int(11) DEFAULT NULL,
  `cve_servicio` int(11) DEFAULT NULL,
  `cve_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mascotas_servicios`
--

INSERT INTO `mascotas_servicios` (`cve_venta`, `cve_mascota`, `cve_servicio`, `cve_empleado`) VALUES
(1, 3, 1, NULL),
(2, 3, 2, NULL),
(3, 3, 1, NULL),
(4, 3, 1, NULL),
(5, 3, 1, NULL),
(6, 3, 1, NULL),
(6, 3, 3, NULL),
(7, 3, 1, NULL),
(7, 3, 2, NULL),
(8, 3, 1, NULL),
(9, 3, 1, NULL),
(10, 6, 1, NULL),
(10, 6, 3, NULL),
(11, 10, 2, NULL),
(12, 20, 1, NULL),
(12, 20, 3, NULL),
(12, 20, 2, NULL),
(13, 24, 22, NULL),
(14, 22, 3, NULL),
(15, 20, 1, NULL),
(16, 20, 1, NULL),
(17, 22, 2, NULL),
(18, 24, 1, NULL),
(19, 20, 22, NULL),
(20, 20, 1, NULL),
(21, 21, 1, NULL),
(21, 21, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `cve_persona` int(11) NOT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `apellidos` varchar(80) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`cve_persona`, `nombre`, `apellidos`, `telefono`, `activo`) VALUES
(1, 'Denis Arturo ', 'Gil Silvan', '9992929392', b'1'),
(26, 'Cristian', 'Páramo', '9938384838', b'1'),
(27, 'Leonardo', 'Pérez Hernández', '3944949494', b'1'),
(28, 'Maria', 'Rosario Cárdenas', '0405055959', b'1'),
(29, 'Rogelio', 'Méndez Martinez', '0999555444', b'1'),
(30, 'Norma', 'Oropeza Reyes', '9955994949', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razas`
--

CREATE TABLE `razas` (
  `cve_raza` int(11) NOT NULL,
  `cve_especie` int(11) DEFAULT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `razas`
--

INSERT INTO `razas` (`cve_raza`, `cve_especie`, `nombre`, `activo`) VALUES
(1, 1, 'Pastor Aleman', b'1'),
(2, 1, 'Chihuaha', b'1'),
(3, 2, 'Korat', b'1'),
(4, 2, 'Somali', b'1'),
(5, 2, 'Curl Americano', b'1'),
(6, 2, 'Montés', b'1'),
(7, 2, 'Burmés', b'1'),
(8, 2, 'Siberiano', b'1'),
(9, 1, 'Bulldog', b'1'),
(10, 1, 'Pug', b'1'),
(11, 1, 'Rottweiler', b'1'),
(12, 1, 'Pitbull', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `cve_servicio` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`cve_servicio`, `nombre`, `precio`, `activo`) VALUES
(1, 'Vacuna', 80, b'1'),
(2, 'Limpieza', 22, b'1'),
(3, 'Corte de pelo', 77, b'1'),
(22, 'Consulta', 60, b'1'),
(23, 'Cirugia', 700, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cve_usuario` int(11) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `contrasena` varchar(150) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cve_usuario`, `imagen`, `correo`, `contrasena`, `tipo`, `activo`) VALUES
(1, 'logo.jpg', 'denisgilsil.21@gmail.com', '$2y$10$GUjtlGiexNH2pYcH1dWHe.9O1QLmutzjLKMAvibko6FNfYjlzEC/i', 1, b'1'),
(26, 'usuario.png', 'cristian@gmail.com', '$2y$10$1AjPh2HODYR1IbhXQSBIsuvnMq/jxbrJmR4Ei40Vo2dnk69LxGufi', 3, b'1'),
(27, 'usuario.png', 'leonardo@gmail.com', '$2y$10$W/XLA0CqFOztAEtRDjRAuO7sLuGBTDdHOaoH7G3aG1oRsHFmAUHj2', 3, b'1'),
(28, 'usuario.png', 'maria@gmail.com', '$2y$10$YRg0TRc5wxCWL5iKV8L3jukvbBV3Ox7HovTL8A5amz4j9htplicHi', 3, b'1'),
(29, 'usuario.png', 'rogelio@gmail.com', '$2y$10$IHaGDRAkOYkAGd7O4CEy7OPu1qqSLaqADEmn3Z5HSFF/dBlmUkzsS', 3, b'1'),
(30, 'usuario.png', 'norma@gmail.com', '$2y$10$74Y7LtgZHoStwXDf.PzaSOiHaapvsYea0HNrrsxalRaBhcNKVPLxi', 3, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `cve_venta` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `observaciones` varchar(150) DEFAULT NULL,
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`cve_venta`, `fecha`, `observaciones`, `total`) VALUES
(12, '2020-07-24 21:37:41', 'xl', 179),
(13, '2020-07-27 14:28:04', '', 60),
(14, '2020-07-27 14:32:31', '', 77),
(15, '2020-07-30 15:17:28', '', 80),
(16, '2020-08-06 15:11:38', '', 80),
(17, '2020-08-06 15:12:10', '', 22),
(18, '2020-08-06 15:12:23', '', 80),
(19, '2020-08-06 15:12:42', '', 60),
(20, '2020-08-06 18:27:43', '', 80),
(21, '2020-08-24 12:27:46', '', 102);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`cve_cita`),
  ADD KEY `fk_citas_reference_empresa` (`cve_empresa`),
  ADD KEY `fk_citas_reference_personas` (`cve_persona`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`cve_empleado`),
  ADD KEY `fk_empleado_reference_empresa` (`cve_empresa`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`cve_empresa`);

--
-- Indices de la tabla `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`cve_especie`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`cve_horario`),
  ADD KEY `fk_horario_reference_empresa` (`cve_empresa`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`cve_mascota`),
  ADD KEY `fk_mascotas_reference_razas` (`cve_raza`),
  ADD KEY `fk_mascotas_reference_personas` (`cve_persona`);

--
-- Indices de la tabla `mascotas_servicios`
--
ALTER TABLE `mascotas_servicios`
  ADD KEY `fk_mascotas_reference_mascotas` (`cve_mascota`),
  ADD KEY `fk_mascotas_reference_servicio` (`cve_servicio`),
  ADD KEY `fk_mascotas_reference_empleado` (`cve_empleado`),
  ADD KEY `fk_mascotas_reference_ventas` (`cve_venta`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`cve_persona`);

--
-- Indices de la tabla `razas`
--
ALTER TABLE `razas`
  ADD PRIMARY KEY (`cve_raza`),
  ADD KEY `fk_razas_reference_especies` (`cve_especie`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`cve_servicio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cve_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`cve_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `cve_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `cve_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `especies`
--
ALTER TABLE `especies`
  MODIFY `cve_especie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `cve_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `cve_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `cve_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `razas`
--
ALTER TABLE `razas`
  MODIFY `cve_raza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `cve_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `cve_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_citas_reference_empresa` FOREIGN KEY (`cve_empresa`) REFERENCES `empresa` (`cve_empresa`),
  ADD CONSTRAINT `fk_citas_reference_personas` FOREIGN KEY (`cve_persona`) REFERENCES `personas` (`cve_persona`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `fk_empleado_reference_empresa` FOREIGN KEY (`cve_empresa`) REFERENCES `empresa` (`cve_empresa`),
  ADD CONSTRAINT `fk_empleado_reference_personas` FOREIGN KEY (`cve_empleado`) REFERENCES `personas` (`cve_persona`);

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `fk_horario_reference_empresa` FOREIGN KEY (`cve_empresa`) REFERENCES `empresa` (`cve_empresa`);

--
-- Filtros para la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `fk_mascotas_reference_personas` FOREIGN KEY (`cve_persona`) REFERENCES `personas` (`cve_persona`),
  ADD CONSTRAINT `fk_mascotas_reference_razas` FOREIGN KEY (`cve_raza`) REFERENCES `razas` (`cve_raza`);

--
-- Filtros para la tabla `mascotas_servicios`
--
ALTER TABLE `mascotas_servicios`
  ADD CONSTRAINT `fk_mascotas_reference_empleado` FOREIGN KEY (`cve_empleado`) REFERENCES `empleados` (`cve_empleado`),
  ADD CONSTRAINT `fk_mascotas_reference_mascotas` FOREIGN KEY (`cve_mascota`) REFERENCES `mascotas` (`cve_mascota`),
  ADD CONSTRAINT `fk_mascotas_reference_servicio` FOREIGN KEY (`cve_servicio`) REFERENCES `servicios` (`cve_servicio`),
  ADD CONSTRAINT `fk_mascotas_reference_ventas` FOREIGN KEY (`cve_venta`) REFERENCES `ventas` (`cve_venta`);

--
-- Filtros para la tabla `razas`
--
ALTER TABLE `razas`
  ADD CONSTRAINT `fk_razas_reference_especies` FOREIGN KEY (`cve_especie`) REFERENCES `especies` (`cve_especie`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_reference_personas` FOREIGN KEY (`cve_usuario`) REFERENCES `personas` (`cve_persona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
