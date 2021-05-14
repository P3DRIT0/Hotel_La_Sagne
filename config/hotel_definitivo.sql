-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2021 a las 20:19:28
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id` bigint(20) NOT NULL,
  `tipo_habitacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones_reservas`
--

CREATE TABLE `habitaciones_reservas` (
  `id` bigint(20) NOT NULL,
  `num_reserva` bigint(20) NOT NULL,
  `id_habitacion` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion_servicio`
--

CREATE TABLE `habitacion_servicio` (
  `id_habitacion` bigint(20) NOT NULL,
  `id_servicio` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_habitaciones`
--

CREATE TABLE `imagenes_habitaciones` (
  `id` bigint(20) NOT NULL,
  `id_tipo_habitacion` bigint(20) NOT NULL,
  `imagen_habitacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes_habitaciones`
--

INSERT INTO `imagenes_habitaciones` (`id`, `id_tipo_habitacion`, `imagen_habitacion`) VALUES
(20, 61, '../Reservas/Imagenes_habitaciones/Fondo1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `num_reserva` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `fecha_entrada` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_salida` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo_habitacion` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre_rol`) VALUES
(2, 'Usuario_administrador'),
(1, 'Usuario_registrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` bigint(20) NOT NULL,
  `nombre_servicio` varchar(255) NOT NULL,
  `precio_servicio` decimal(6,2) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `disponibilidad` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitaciones`
--

CREATE TABLE `tipo_habitaciones` (
  `id` bigint(20) NOT NULL,
  `m2` decimal(6,2) NOT NULL,
  `ventana` bit(1) NOT NULL DEFAULT b'0',
  `tipo_de_habitacion` varchar(255) NOT NULL,
  `servicio_limpieza` bit(1) NOT NULL DEFAULT b'0',
  `internet` bit(1) NOT NULL DEFAULT b'0',
  `precio` decimal(6,2) NOT NULL,
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_habitaciones`
--

INSERT INTO `tipo_habitaciones` (`id`, `m2`, `ventana`, `tipo_de_habitacion`, `servicio_limpieza`, `internet`, `precio`, `descripcion`) VALUES
(61, '123.00', b'1', 'Individual', b'1', b'1', '123.00', 'dffdfdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telf` varchar(9) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `telf`, `direccion`, `password`, `rol_usuario`) VALUES
(95, 'Pedro', 'pedrofc99@gmail.com', '698139991', 'tuputacasa', '$2y$10$5aDZoZYQKW9HqpzCpL7IOecT5JL8i7iWF5gWeaxi.xi0MP1WFNtM6', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_habitacion` (`tipo_habitacion`) USING BTREE;

--
-- Indices de la tabla `habitaciones_reservas`
--
ALTER TABLE `habitaciones_reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `num_reserva` (`num_reserva`),
  ADD KEY `id_habitacion` (`id_habitacion`);

--
-- Indices de la tabla `habitacion_servicio`
--
ALTER TABLE `habitacion_servicio`
  ADD PRIMARY KEY (`id_habitacion`,`id_servicio`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `imagenes_habitaciones`
--
ALTER TABLE `imagenes_habitaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_habitacion` (`id_tipo_habitacion`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`num_reserva`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_habitaciones`
--
ALTER TABLE `tipo_habitaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipo_de_habitacion` (`tipo_de_habitacion`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telf` (`telf`),
  ADD KEY `rol_usuario` (`rol_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `habitaciones_reservas`
--
ALTER TABLE `habitaciones_reservas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `imagenes_habitaciones`
--
ALTER TABLE `imagenes_habitaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `num_reserva` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_habitaciones`
--
ALTER TABLE `tipo_habitaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `tipo_habitacion` FOREIGN KEY (`tipo_habitacion`) REFERENCES `tipo_habitaciones` (`tipo_de_habitacion`);

--
-- Filtros para la tabla `habitaciones_reservas`
--
ALTER TABLE `habitaciones_reservas`
  ADD CONSTRAINT `habitaciones_reservas_ibfk_1` FOREIGN KEY (`num_reserva`) REFERENCES `reservas` (`num_reserva`),
  ADD CONSTRAINT `habitaciones_reservas_ibfk_2` FOREIGN KEY (`id_habitacion`) REFERENCES `tipo_habitaciones` (`id`);

--
-- Filtros para la tabla `habitacion_servicio`
--
ALTER TABLE `habitacion_servicio`
  ADD CONSTRAINT `habitacion_servicio_ibfk_1` FOREIGN KEY (`id_habitacion`) REFERENCES `tipo_habitaciones` (`id`),
  ADD CONSTRAINT `habitacion_servicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id`);

--
-- Filtros para la tabla `imagenes_habitaciones`
--
ALTER TABLE `imagenes_habitaciones`
  ADD CONSTRAINT `imagenes_habitaciones_ibfk_1` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `tipo_habitaciones` (`id`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_usuario`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
