-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2024 a las 02:45:18
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `acro_ware`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `id_usu_per` int(11) DEFAULT NULL,
  `nombre_actividad` varchar(50) DEFAULT NULL,
  `fecha_creacion` date DEFAULT curdate(),
  `descripcion` varchar(500) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `id` int(11) NOT NULL,
  `id_piso_per` int(11) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `id_encargado` int(11) DEFAULT NULL,
  `num_bienes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bienes_informaticos`
--

CREATE TABLE `bienes_informaticos` (
  `id` int(11) NOT NULL,
  `id_room_per` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT curdate(),
  `marca` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `num_soft` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `bienes_informaticos`
--
DELIMITER $$
CREATE TRIGGER `actualizar_numero_bienes_laboratorios_despues_eliminar` AFTER DELETE ON `bienes_informaticos` FOR EACH ROW BEGIN
    DECLARE num_bienes INT;
    SELECT COUNT(*) INTO num_bienes FROM bienes_informaticos WHERE id_room_per = OLD.id_room_per;
    UPDATE laboratorios SET num_bienes = num_bienes WHERE id = OLD.id_room_per;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calcular_numero_bienes_laboratorios` AFTER INSERT ON `bienes_informaticos` FOR EACH ROW BEGIN
    DECLARE num_bienes INT;
    SELECT COUNT(*) INTO num_bienes FROM bienes_informaticos WHERE id_room_per = NEW.id_room_per;
    UPDATE laboratorios SET num_bienes = num_bienes WHERE id = NEW.id_room_per;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bienes_inmobiliarios`
--

CREATE TABLE `bienes_inmobiliarios` (
  `id` int(11) NOT NULL,
  `id_room_per` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT curdate(),
  `marca` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `precio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `bienes_inmobiliarios`
--
DELIMITER $$
CREATE TRIGGER `actualizar_numero_bienes_aulas_despues_eliminar` AFTER DELETE ON `bienes_inmobiliarios` FOR EACH ROW BEGIN
    DECLARE num_bienes INT;
    SELECT COUNT(*) INTO num_bienes FROM bienes_inmobiliarios WHERE id_room_per = OLD.id_room_per;
    UPDATE aulas SET num_bienes = num_bienes WHERE id = OLD.id_room_per;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calcular_numero_bienes_aulas` AFTER INSERT ON `bienes_inmobiliarios` FOR EACH ROW BEGIN
    DECLARE num_bienes INT;
    SELECT COUNT(*) INTO num_bienes FROM bienes_inmobiliarios WHERE id_room_per = NEW.id_room_per;
    UPDATE aulas SET num_bienes = num_bienes WHERE id = NEW.id_room_per;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloques`
--

CREATE TABLE `bloques` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorios`
--

CREATE TABLE `laboratorios` (
  `id` int(11) NOT NULL,
  `id_piso_per` int(11) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `id_encargado` int(11) DEFAULT NULL,
  `num_bienes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `laboratorios`
--
DELIMITER $$
CREATE TRIGGER `actualizar_numero_laboratorios_despues_eliminar` AFTER DELETE ON `laboratorios` FOR EACH ROW BEGIN
    DECLARE num_labs INT;
    SELECT COUNT(*) INTO num_labs FROM laboratorios WHERE id_piso_per = OLD.id_piso_per;
    UPDATE pisos SET numero_laboratorios = num_labs WHERE id = OLD.id_piso_per;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calcular_numero_laboratorios` AFTER INSERT ON `laboratorios` FOR EACH ROW BEGIN
    DECLARE num_labs INT;
    SELECT COUNT(*) INTO num_labs FROM laboratorios WHERE id_piso_per = NEW.id_piso_per;
    UPDATE pisos SET numero_laboratorios = num_labs WHERE id = NEW.id_piso_per;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pisos`
--

CREATE TABLE `pisos` (
  `id` int(11) NOT NULL,
  `id_bloque_per` int(11) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `numero_laboratorios` int(11) DEFAULT 0,
  `num_bienes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `software`
--

CREATE TABLE `software` (
  `id` int(11) NOT NULL,
  `id_bien_info_per` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `proveedor` varchar(50) DEFAULT NULL,
  `tipo_lic` varchar(50) DEFAULT NULL,
  `activado` tinyint(1) DEFAULT NULL,
  `precio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `software`
--
DELIMITER $$
CREATE TRIGGER `calcular_num_soft` AFTER INSERT ON `software` FOR EACH ROW BEGIN
    DECLARE num_soft INT;
    SELECT COUNT(*) INTO num_soft FROM software WHERE id_bien_info_per = NEW.id_bien_info_per;
    UPDATE bienes_informaticos SET num_soft = num_soft WHERE id = NEW.id_bien_info_per;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `cedula` varchar(10) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(8) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usu_per` (`id_usu_per`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_piso_per` (`id_piso_per`),
  ADD KEY `id_encargado` (`id_encargado`);

--
-- Indices de la tabla `bienes_informaticos`
--
ALTER TABLE `bienes_informaticos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_room_per` (`id_room_per`);

--
-- Indices de la tabla `bienes_inmobiliarios`
--
ALTER TABLE `bienes_inmobiliarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_room_per` (`id_room_per`);

--
-- Indices de la tabla `bloques`
--
ALTER TABLE `bloques`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_piso_per` (`id_piso_per`),
  ADD KEY `id_encargado` (`id_encargado`);

--
-- Indices de la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bloque_per` (`id_bloque_per`);

--
-- Indices de la tabla `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bien_info_per` (`id_bien_info_per`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bienes_informaticos`
--
ALTER TABLE `bienes_informaticos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bienes_inmobiliarios`
--
ALTER TABLE `bienes_inmobiliarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bloques`
--
ALTER TABLE `bloques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `laboratorios`
--
ALTER TABLE `laboratorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pisos`
--
ALTER TABLE `pisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `software`
--
ALTER TABLE `software`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`id_usu_per`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `aulas_ibfk_1` FOREIGN KEY (`id_piso_per`) REFERENCES `pisos` (`id`),
  ADD CONSTRAINT `aulas_ibfk_2` FOREIGN KEY (`id_encargado`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `bienes_informaticos`
--
ALTER TABLE `bienes_informaticos`
  ADD CONSTRAINT `bienes_informaticos_ibfk_1` FOREIGN KEY (`id_room_per`) REFERENCES `laboratorios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bienes_informaticos_ibfk_2` FOREIGN KEY (`id_room_per`) REFERENCES `aulas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `bienes_inmobiliarios`
--
ALTER TABLE `bienes_inmobiliarios`
  ADD CONSTRAINT `bienes_inmobiliarios_ibfk_1` FOREIGN KEY (`id_room_per`) REFERENCES `laboratorios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bienes_inmobiliarios_ibfk_2` FOREIGN KEY (`id_room_per`) REFERENCES `aulas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD CONSTRAINT `laboratorios_ibfk_1` FOREIGN KEY (`id_piso_per`) REFERENCES `pisos` (`id`),
  ADD CONSTRAINT `laboratorios_ibfk_2` FOREIGN KEY (`id_encargado`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD CONSTRAINT `pisos_ibfk_1` FOREIGN KEY (`id_bloque_per`) REFERENCES `bloques` (`id`);

--
-- Filtros para la tabla `software`
--
ALTER TABLE `software`
  ADD CONSTRAINT `software_ibfk_1` FOREIGN KEY (`id_bien_info_per`) REFERENCES `bienes_informaticos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
