-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2024 a las 04:03:48
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pas2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cabañas`
--

CREATE TABLE `cabañas` (
  `ID usuario` int(10) NOT NULL,
  `ID Cabaña` int(10) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Ubicacion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cabañas`
--

INSERT INTO `cabañas` (`ID usuario`, `ID Cabaña`, `Nombre`, `Ubicacion`) VALUES
(2, 1, 'ddd', ''),
(2, 2, 'la estrella', 'coveñas'),
(5, 14, 'cuarto', 'coveñas'),
(5, 16, 'La encantada', 'Tolu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encendido programado`
--

CREATE TABLE `encendido programado` (
  `ID VAlidar` int(10) NOT NULL,
  `ID LUZ` int(20) NOT NULL,
  `Hora de Encendido` time NOT NULL,
  `Hora de Apagado` time NOT NULL,
  `Estado Actual` tinyint(4) NOT NULL,
  `Estado Final` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `encendido programado`
--

INSERT INTO `encendido programado` (`ID VAlidar`, `ID LUZ`, `Hora de Encendido`, `Hora de Apagado`, `Estado Actual`, `Estado Final`) VALUES
(1, 4, '18:00:00', '06:00:00', 0, 0),
(2, 3, '01:00:00', '04:00:00', 1, 0),
(3, 1, '18:00:00', '06:00:00', 1, 1),
(4, 2, '18:00:00', '06:00:00', 0, 0),
(5, 5, '18:00:00', '06:00:00', 0, 0),
(6, 30, '18:00:00', '06:00:00', 0, 0),
(7, 31, '18:00:00', '06:00:00', 0, 0),
(8, 32, '18:00:00', '06:00:00', 0, 0),
(9, 33, '01:00:00', '05:07:00', 1, 0),
(10, 34, '20:05:00', '06:01:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial de encendido`
--

CREATE TABLE `historial de encendido` (
  `ID Historial` int(10) NOT NULL,
  `ID LUZ` int(10) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial de encendido`
--

INSERT INTO `historial de encendido` (`ID Historial`, `ID LUZ`, `Fecha`, `Hora`, `Estado`) VALUES
(1, 4, '2023-11-01', '16:56:39', 0),
(2, 1, '2023-11-18', '11:39:19', 0),
(3, 30, '2023-11-18', '11:39:23', 0),
(4, 3, '2023-11-18', '11:39:26', 0),
(5, 31, '2023-11-18', '17:29:31', 0),
(6, 33, '2023-11-18', '20:45:05', 1),
(7, 33, '2023-11-18', '20:45:24', 0),
(8, 33, '2023-11-18', '20:46:31', 1),
(9, 33, '2023-11-18', '20:46:40', 0),
(10, 31, '2023-11-18', '20:52:43', 1),
(11, 1, '2023-11-18', '21:26:30', 1),
(12, 34, '2023-11-22', '11:11:19', 1),
(13, 2, '2023-11-22', '11:11:23', 0),
(14, 4, '2023-11-22', '11:11:23', 0),
(15, 1, '2023-11-22', '11:11:23', 0),
(16, 5, '2023-11-22', '11:11:23', 0),
(17, 31, '2023-11-22', '11:11:25', 0),
(18, 34, '2023-11-22', '11:11:25', 0),
(19, 34, '2023-11-22', '11:11:29', 1),
(20, 1, '2023-11-22', '22:57:51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `luces`
--

CREATE TABLE `luces` (
  `ID Cabaña` int(11) NOT NULL,
  `ID Luz` int(10) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Descripcion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `luces`
--

INSERT INTO `luces` (`ID Cabaña`, `ID Luz`, `Nombre`, `Descripcion`) VALUES
(1, 1, 'cuarto', 'encendido'),
(1, 2, 'sala', 'apagado'),
(1, 3, 'cocina', 'apagado'),
(1, 4, 'baño', 'apagado'),
(1, 5, 'patio', 'apagado'),
(1, 30, 'garaje', 'apagado'),
(1, 31, 'terraza', 'apagado'),
(1, 32, 'Patio trasero', 'apagado'),
(14, 33, 'sotano', 'apagado'),
(1, 34, 'pasillo', 'encendido');

--
-- Disparadores `luces`
--
DELIMITER $$
CREATE TRIGGER `after_luces_update` AFTER UPDATE ON `luces` FOR EACH ROW BEGIN
  IF NEW.Descripcion <> OLD.Descripcion THEN
    INSERT INTO `historial de encendido` (`ID LUZ`, `Fecha`, `Hora`, `Estado`)
    VALUES (
      NEW.`ID Luz`,
      CURDATE(),
      CURTIME(),
      CASE
        WHEN NEW.Descripcion = 'encendido' THEN 1
        WHEN NEW.Descripcion = 'apagado' THEN 0
        ELSE NULL
      END
    );
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(10) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(40) NOT NULL,
  `Tipo de Documento` enum('NUIP','Cedula de Ciudadania','Tarjeta de Identidad','Pasaporte','Cedula de Extranjeria') NOT NULL,
  `Numero de Documento` int(11) NOT NULL,
  `Fecha de Nacimiento` date NOT NULL,
  `Telefono` int(10) NOT NULL,
  `Direccion` varchar(40) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Contraseña` varchar(50) NOT NULL,
  `Rol` enum('Usuario','Administrador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Nombre`, `Apellidos`, `Tipo de Documento`, `Numero de Documento`, `Fecha de Nacimiento`, `Telefono`, `Direccion`, `Correo`, `Contraseña`, `Rol`) VALUES
(2, 'juan luis', 'romero perez', 'Cedula de Ciudadania', 1004567256, '2001-12-11', 2147483647, 'calle 27 #12 16', 'usuario@example.com', '12345', 'Administrador'),
(5, 'juan luis', 'romero perez', 'Cedula de Ciudadania', 1004567256, '2001-12-11', 2147483647, 'calle 27 #12 17', 'uno@gmail.com', '12345', 'Usuario'),
(6, 'maria juana', 'lopez cerbantez', 'Tarjeta de Identidad', 2147483647, '1996-11-01', 312456134, 'carrera 28# 16 30', 'link@gmail.com', 'contra 1234', 'Usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cabañas`
--
ALTER TABLE `cabañas`
  ADD PRIMARY KEY (`ID Cabaña`),
  ADD KEY `ID usuario` (`ID usuario`);

--
-- Indices de la tabla `encendido programado`
--
ALTER TABLE `encendido programado`
  ADD PRIMARY KEY (`ID VAlidar`),
  ADD KEY `FK_LUCES_ID LUZ` (`ID LUZ`) USING BTREE;

--
-- Indices de la tabla `historial de encendido`
--
ALTER TABLE `historial de encendido`
  ADD PRIMARY KEY (`ID Historial`),
  ADD KEY `fk_Luz_ID LUZ` (`ID LUZ`);

--
-- Indices de la tabla `luces`
--
ALTER TABLE `luces`
  ADD PRIMARY KEY (`ID Luz`),
  ADD KEY `ID Cabaña` (`ID Cabaña`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Fecha de Nacimiento` (`Fecha de Nacimiento`,`Correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cabañas`
--
ALTER TABLE `cabañas`
  MODIFY `ID Cabaña` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `encendido programado`
--
ALTER TABLE `encendido programado`
  MODIFY `ID VAlidar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `historial de encendido`
--
ALTER TABLE `historial de encendido`
  MODIFY `ID Historial` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `luces`
--
ALTER TABLE `luces`
  MODIFY `ID Luz` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cabañas`
--
ALTER TABLE `cabañas`
  ADD CONSTRAINT `cabañas_ibfk_1` FOREIGN KEY (`ID usuario`) REFERENCES `usuarios` (`ID`);

--
-- Filtros para la tabla `encendido programado`
--
ALTER TABLE `encendido programado`
  ADD CONSTRAINT `encendido programado_ibfk_1` FOREIGN KEY (`ID LUZ`) REFERENCES `luces` (`ID Luz`);

--
-- Filtros para la tabla `historial de encendido`
--
ALTER TABLE `historial de encendido`
  ADD CONSTRAINT `historial de encendido_ibfk_1` FOREIGN KEY (`ID LUZ`) REFERENCES `luces` (`ID Luz`);

--
-- Filtros para la tabla `luces`
--
ALTER TABLE `luces`
  ADD CONSTRAINT `luces_ibfk_1` FOREIGN KEY (`ID Cabaña`) REFERENCES `cabañas` (`ID Cabaña`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
