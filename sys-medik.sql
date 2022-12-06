-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-12-2022 a las 23:05:46
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sys-medik`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `idEspecialidad` int(11) NOT NULL,
  `nombreEspecialidad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fechaAgregada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`idEspecialidad`, `nombreEspecialidad`, `fechaAgregada`) VALUES
(1, 'Sin especialidad', '2022-11-28 08:24:59'),
(2, 'PsicologÃ­a', '2022-11-28 08:25:54'),
(3, 'NeurologÃ­a', '2022-11-28 08:38:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infoAdmin`
--

CREATE TABLE `infoAdmin` (
  `idInfoAdmin` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `experiencia` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `infoAdmin`
--

INSERT INTO `infoAdmin` (`idInfoAdmin`, `idUsuario`, `experiencia`) VALUES
(1, 1, 'Ing en ComputaciÃ³n'),
(2, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infoDoc`
--

CREATE TABLE `infoDoc` (
  `idInfoDoc` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEspecialidad` int(11) DEFAULT 1,
  `cedulaProfesional` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idTurno` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `infoDoc`
--

INSERT INTO `infoDoc` (`idInfoDoc`, `idUsuario`, `idEspecialidad`, `cedulaProfesional`, `idTurno`) VALUES
(3, 5, 3, '35435345', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infoPaci`
--

CREATE TABLE `infoPaci` (
  `idInfoPaci` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `peso` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipoSangre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `infoPaci`
--

INSERT INTO `infoPaci` (`idInfoPaci`, `idUsuario`, `fechaNacimiento`, `peso`, `tipoSangre`) VALUES
(1, 4, '2000-02-09', '90 Kg', 'O+');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudConsulta`
--

CREATE TABLE `solicitudConsulta` (
  `idSolicitudConsulta` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaConsulta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idEspecialidad` int(11) NOT NULL,
  `estadoSolicitud` enum('Aprobada','Pendiente') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `solicitudConsulta`
--

INSERT INTO `solicitudConsulta` (`idSolicitudConsulta`, `idUsuario`, `fechaConsulta`, `idEspecialidad`, `estadoSolicitud`) VALUES
(1, 1, '2022-11-30 06:00:00', 2, 'Pendiente'),
(2, 1, '2022-12-01 06:00:00', 3, 'Aprobada'),
(3, 1, '2022-12-06 06:00:00', 2, 'Aprobada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoUsuarios`
--

CREATE TABLE `tipoUsuarios` (
  `idTipoUsuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipoUsuarios`
--

INSERT INTO `tipoUsuarios` (`idTipoUsuario`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Doctor'),
(3, 'Paciente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `idTurno` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`idTurno`, `nombre`) VALUES
(1, 'Sin Turno'),
(2, 'Matutino'),
(3, 'Vespertino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `idUsuario` int(11) NOT NULL,
  `nombreU` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apePat` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apeMat` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(254) COLLATE utf8_spanish_ci NOT NULL,
  `idTipoUsuario` int(11) NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`idUsuario`, `nombreU`, `apePat`, `apeMat`, `usuario`, `pass`, `idTipoUsuario`, `fechaAlta`) VALUES
(1, 'Conrado', 'Escobar', 'Medina', 'conrado', 'f98111cb604d1a4a49c3931b9756c0aef42fcd09250d1a1c3cdab1857aea6fc0', 1, '2022-11-26 05:58:05'),
(2, 'Yair', 'HernÃ¡ndez', 'Corona', 'yahir', '9e351b07323470bb055ee199720d0a080c08a28c0d76488b7d797890582a726b', 1, '2022-11-26 05:58:38'),
(4, 'Juan Christian', 'Gallegos', 'Acosta', 'christian', '9e351b07323470bb055ee199720d0a080c08a28c0d76488b7d797890582a726b', 3, '2022-11-27 02:28:17'),
(5, 'Jhonatan', 'Lorenzo', 'HernÃ¡ndez', 'jhonatan', '9e351b07323470bb055ee199720d0a080c08a28c0d76488b7d797890582a726b', 2, '2022-11-28 10:05:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`idEspecialidad`);

--
-- Indices de la tabla `infoAdmin`
--
ALTER TABLE `infoAdmin`
  ADD PRIMARY KEY (`idInfoAdmin`),
  ADD UNIQUE KEY `infoAdmin_UN` (`idUsuario`);

--
-- Indices de la tabla `infoDoc`
--
ALTER TABLE `infoDoc`
  ADD PRIMARY KEY (`idInfoDoc`),
  ADD UNIQUE KEY `infoDoc_UN` (`idUsuario`),
  ADD KEY `infoDoc_FK_1` (`idTurno`),
  ADD KEY `infoDoc_FK_2` (`idEspecialidad`);

--
-- Indices de la tabla `infoPaci`
--
ALTER TABLE `infoPaci`
  ADD PRIMARY KEY (`idInfoPaci`),
  ADD UNIQUE KEY `infoPaci_UN` (`idUsuario`);

--
-- Indices de la tabla `solicitudConsulta`
--
ALTER TABLE `solicitudConsulta`
  ADD PRIMARY KEY (`idSolicitudConsulta`),
  ADD KEY `solicitudConsulta_FK` (`idUsuario`),
  ADD KEY `solicitudConsulta_FK_1` (`idEspecialidad`);

--
-- Indices de la tabla `tipoUsuarios`
--
ALTER TABLE `tipoUsuarios`
  ADD PRIMARY KEY (`idTipoUsuario`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`idTurno`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idTipoUsuario` (`idTipoUsuario`),
  ADD KEY `users_UN` (`idTipoUsuario`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `idEspecialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `infoAdmin`
--
ALTER TABLE `infoAdmin`
  MODIFY `idInfoAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `infoDoc`
--
ALTER TABLE `infoDoc`
  MODIFY `idInfoDoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `infoPaci`
--
ALTER TABLE `infoPaci`
  MODIFY `idInfoPaci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitudConsulta`
--
ALTER TABLE `solicitudConsulta`
  MODIFY `idSolicitudConsulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipoUsuarios`
--
ALTER TABLE `tipoUsuarios`
  MODIFY `idTipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `idTurno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `infoAdmin`
--
ALTER TABLE `infoAdmin`
  ADD CONSTRAINT `infoAdmin_FK` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `infoDoc`
--
ALTER TABLE `infoDoc`
  ADD CONSTRAINT `infoDoc_FK` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `infoDoc_FK_1` FOREIGN KEY (`idTurno`) REFERENCES `turnos` (`idTurno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `infoDoc_FK_2` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidades` (`idEspecialidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `infoPaci`
--
ALTER TABLE `infoPaci`
  ADD CONSTRAINT `infoPaci_FK` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitudConsulta`
--
ALTER TABLE `solicitudConsulta`
  ADD CONSTRAINT `solicitudConsulta_FK` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitudConsulta_FK_1` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidades` (`idEspecialidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_FK` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipoUsuarios` (`idTipoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
