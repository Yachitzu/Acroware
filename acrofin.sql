-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2024 a las 01:59:31
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
-- Base de datos: `das`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `id_usu_asig` int(11) DEFAULT NULL,
  `nombre_actividad` varchar(50) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `plazo` int(11) DEFAULT NULL,
  `fecha_finalizacion` date DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL,
  `id_bien_info` int(11) DEFAULT NULL,
  `id_bien_mobi` int(11) DEFAULT NULL,
  `activo` enum('si','no') NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `piso` varchar(50) DEFAULT NULL,
  `id_bloque_per` int(11) DEFAULT NULL,
  `id_usu_encargado` int(11) DEFAULT NULL,
  `activo` enum('si','no') NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `descripcion`, `piso`, `id_bloque_per`, `id_usu_encargado`, `activo`) VALUES
(1, 'Aula', 'Primer Aula a la derecha subiendo las escaleras', '0', 1, 1, 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bienes_informaticos`
--

CREATE TABLE `bienes_informaticos` (
  `id` int(11) NOT NULL,
  `codigo_uta` varchar(30) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `serie` varchar(20) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `id_area_per` int(11) DEFAULT NULL,
  `id_ubi_per` int(11) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT current_timestamp(),
  `precio` float DEFAULT NULL,
  `activo` enum('si','no') NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bienes_mobiliarios`
--

CREATE TABLE `bienes_mobiliarios` (
  `id` int(11) NOT NULL,
  `codigo_uta` varchar(30) DEFAULT NULL,
  `bld_o_bca` varchar(3) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `serie` varchar(20) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `material` varchar(30) DEFAULT NULL,
  `dimensiones` varchar(70) DEFAULT NULL,
  `condicion` varchar(30) DEFAULT NULL,
  `custodio_actual` varchar(250) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT current_timestamp(),
  `valor_contable` float DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `id_area_per` int(11) DEFAULT NULL,
  `id_ubi_per` int(11) DEFAULT NULL,
  `activo` enum('si','no') NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bienes_mobiliarios`
--

INSERT INTO `bienes_mobiliarios` (`id`, `codigo_uta`, `bld_o_bca`, `nombre`, `serie`, `id_marca`, `modelo`, `marca`, `color`, `material`, `dimensiones`, `condicion`, `custodio_actual`, `fecha_ingreso`, `valor_contable`, `precio`, `id_area_per`, `id_ubi_per`, `activo`) VALUES
(1, 'PC01-1', 'bca', 'Escritorio', 'E001', 1, 'DES', 'DES', 'Negro', 'PVC', '15x15', 'Buen Estado', 'Christian', '2024-05-28', 15, 15, 1, 1, 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloques`
--

CREATE TABLE `bloques` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `id_facultad_per` int(11) DEFAULT NULL,
  `pisos` int(11) DEFAULT NULL,
  `activo` enum('si','no') NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bloques`
--

INSERT INTO `bloques` (`id`, `nombre`, `descripcion`, `id_facultad_per`, `pisos`, `activo`) VALUES
(1, 'Talleres Tecnologicos', 'Al lado del Edificio Financiero', 1, 2, 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componentes`
--

CREATE TABLE `componentes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(70) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `serie` varchar(20) DEFAULT NULL,
  `codigo_adi_uta` varchar(20) DEFAULT NULL,
  `id_bien_infor_per` int(11) DEFAULT NULL,
  `repotenciado` varchar(2) DEFAULT NULL CHECK (`repotenciado` in ('si','no')),
  `activo` enum('si','no') NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultades`
--

CREATE TABLE `facultades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(600) DEFAULT NULL,
  `campus` varchar(30) DEFAULT NULL,
  `activo` enum('si','no') NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facultades`
--

INSERT INTO `facultades` (`id`, `nombre`, `descripcion`, `campus`, `activo`) VALUES
(1, 'FISEI', 'Al lado de la Facultad de Jurisprudencia', 'Huachi Chico', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `descripcion` varchar(600) DEFAULT NULL,
  `pais` varchar(30) DEFAULT NULL,
  `area` varchar(60) DEFAULT NULL,
  `activo` enum('si','no') NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `descripcion`, `pais`, `area`, `activo`) VALUES
(1, 'IKEA', 'Marca de Escritorios', 'Suecia', 'mobiliario', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recordatorio`
--

CREATE TABLE `recordatorio` (
  `id` int(11) NOT NULL,
  `actividad` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `estado` enum('pendiente','finalizado','cancelado') NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recordatorio`
--

INSERT INTO `recordatorio` (`id`, `actividad`, `fecha`, `usuario_id`, `estado`) VALUES
(1, 'Nueva Actividad desde la BD', '2024-05-29 04:56:20', 1, 'pendiente'),
(4, '1', '2024-05-29 22:23:00', 1, 'pendiente'),
(5, '1', '2024-05-29 22:24:15', 1, 'pendiente'),
(6, '1', '2024-05-31 13:09:02', 1, 'pendiente'),
(7, '1', '2024-05-31 13:10:10', 1, 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperar_password`
--

CREATE TABLE `recuperar_password` (
  `id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `token` varchar(100) NOT NULL,
  `expFech` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repotenciaciones`
--

CREATE TABLE `repotenciaciones` (
  `id` int(11) NOT NULL,
  `id_componente` int(11) DEFAULT NULL,
  `nombre` varchar(70) DEFAULT NULL,
  `serie` varchar(20) DEFAULT NULL,
  `codigo_adi_uta` varchar(20) DEFAULT NULL,
  `detalle_repotenciacion` varchar(300) DEFAULT NULL,
  `fecha_repotenciacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `activo` enum('si','no') NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `software`
--

CREATE TABLE `software` (
  `id` int(11) NOT NULL,
  `nombre_software` varchar(50) DEFAULT NULL,
  `proveedor` varchar(30) DEFAULT NULL,
  `tipo_licencia` varchar(50) DEFAULT NULL,
  `activado` varchar(2) DEFAULT NULL CHECK (`activado` in ('si','no')),
  `fecha_adqui` date DEFAULT current_timestamp(),
  `fecha_activacion` date DEFAULT NULL,
  `precio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `id_area_per` int(11) DEFAULT NULL,
  `activo` enum('si','no') NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id`, `nombre`, `descripcion`, `id_area_per`, `activo`) VALUES
(1, 'PC', 'Primer escritorio  al lado de la puerta', 1, 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `cedula` varchar(10) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `psswd` varchar(20) DEFAULT NULL,
  `rol` varchar(30) DEFAULT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `activo` enum('si','no') NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `cedula`, `email`, `psswd`, `rol`, `fecha_ingreso`, `activo`) VALUES
(1, 'Christian', 'Lopez', '0803536341', 'clopez6341@uta.edu.ec', '15Diciembre001', 'admin', '2024-05-28 21:33:48', 'si'),
(2, 'Diana', 'Quinga', '0803536333', 'c.ristian-lp@hotmail.com', '15Diciembre001', 'admin', '2024-05-28 21:33:48', 'si');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usu_asig` (`id_usu_asig`),
  ADD KEY `id_area` (`id_area`),
  ADD KEY `id_ubicacion` (`id_ubicacion`),
  ADD KEY `id_bien_info` (`id_bien_info`),
  ADD KEY `id_bien_mobi` (`id_bien_mobi`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bloque_per` (`id_bloque_per`),
  ADD KEY `id_usu_encargado` (`id_usu_encargado`);

--
-- Indices de la tabla `bienes_informaticos`
--
ALTER TABLE `bienes_informaticos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_area_per` (`id_area_per`),
  ADD KEY `id_ubi_per` (`id_ubi_per`);

--
-- Indices de la tabla `bienes_mobiliarios`
--
ALTER TABLE `bienes_mobiliarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_area_per` (`id_area_per`),
  ADD KEY `id_ubi_per` (`id_ubi_per`);

--
-- Indices de la tabla `bloques`
--
ALTER TABLE `bloques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_facultad_per` (`id_facultad_per`);

--
-- Indices de la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bien_infor_per` (`id_bien_infor_per`);

--
-- Indices de la tabla `facultades`
--
ALTER TABLE `facultades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recordatorio`
--
ALTER TABLE `recordatorio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `recuperar_password`
--
ALTER TABLE `recuperar_password`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `repotenciaciones`
--
ALTER TABLE `repotenciaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_componente` (`id_componente`);

--
-- Indices de la tabla `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_area_per` (`id_area_per`);

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
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `bienes_informaticos`
--
ALTER TABLE `bienes_informaticos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bienes_mobiliarios`
--
ALTER TABLE `bienes_mobiliarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `bloques`
--
ALTER TABLE `bloques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facultades`
--
ALTER TABLE `facultades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `recordatorio`
--
ALTER TABLE `recordatorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `recuperar_password`
--
ALTER TABLE `recuperar_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `repotenciaciones`
--
ALTER TABLE `repotenciaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `software`
--
ALTER TABLE `software`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`id_usu_asig`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `actividades_ibfk_2` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `actividades_ibfk_3` FOREIGN KEY (`id_ubicacion`) REFERENCES `ubicaciones` (`id`),
  ADD CONSTRAINT `actividades_ibfk_4` FOREIGN KEY (`id_bien_info`) REFERENCES `bienes_informaticos` (`id`),
  ADD CONSTRAINT `actividades_ibfk_5` FOREIGN KEY (`id_bien_mobi`) REFERENCES `bienes_mobiliarios` (`id`);

--
-- Filtros para la tabla `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`id_bloque_per`) REFERENCES `bloques` (`id`),
  ADD CONSTRAINT `areas_ibfk_2` FOREIGN KEY (`id_usu_encargado`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `bienes_informaticos`
--
ALTER TABLE `bienes_informaticos`
  ADD CONSTRAINT `bienes_informaticos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `bienes_informaticos_ibfk_2` FOREIGN KEY (`id_area_per`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `bienes_informaticos_ibfk_3` FOREIGN KEY (`id_ubi_per`) REFERENCES `ubicaciones` (`id`);

--
-- Filtros para la tabla `bienes_mobiliarios`
--
ALTER TABLE `bienes_mobiliarios`
  ADD CONSTRAINT `bienes_mobiliarios_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `bienes_mobiliarios_ibfk_2` FOREIGN KEY (`id_area_per`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `bienes_mobiliarios_ibfk_3` FOREIGN KEY (`id_ubi_per`) REFERENCES `ubicaciones` (`id`);

--
-- Filtros para la tabla `bloques`
--
ALTER TABLE `bloques`
  ADD CONSTRAINT `bloques_ibfk_1` FOREIGN KEY (`id_facultad_per`) REFERENCES `facultades` (`id`);

--
-- Filtros para la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD CONSTRAINT `componentes_ibfk_1` FOREIGN KEY (`id_bien_infor_per`) REFERENCES `bienes_informaticos` (`id`);

--
-- Filtros para la tabla `recordatorio`
--
ALTER TABLE `recordatorio`
  ADD CONSTRAINT `recordatorio_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `repotenciaciones`
--
ALTER TABLE `repotenciaciones`
  ADD CONSTRAINT `repotenciaciones_ibfk_1` FOREIGN KEY (`id_componente`) REFERENCES `componentes` (`id`);

--
-- Filtros para la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD CONSTRAINT `ubicaciones_ibfk_1` FOREIGN KEY (`id_area_per`) REFERENCES `areas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
