-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2021 a las 17:09:20
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.5

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
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_admin` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_admin`, `id_usuario`) VALUES
(1, 105);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id` bigint(20) NOT NULL,
  `tipo_habitacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id`, `tipo_habitacion`) VALUES
(71, 'Individual'),
(72, 'Suite');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones_reservas`
--

CREATE TABLE `habitaciones_reservas` (
  `id` bigint(20) NOT NULL,
  `num_reserva` bigint(20) NOT NULL,
  `id_habitacion` bigint(20) NOT NULL,
  `fecha_disponibilidad` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `habitaciones_reservas`
--

INSERT INTO `habitaciones_reservas` (`id`, `num_reserva`, `id_habitacion`, `fecha_disponibilidad`) VALUES
(90, 104, 71, '2021-06-26 22:00:00'),
(91, 105, 72, '2021-06-10 22:00:00'),
(92, 106, 71, '2021-06-26 22:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion_servicio`
--

CREATE TABLE `habitacion_servicio` (
  `tipo_habitacion` varchar(255) NOT NULL,
  `id_servicio` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `habitacion_servicio`
--

INSERT INTO `habitacion_servicio` (`tipo_habitacion`, `id_servicio`) VALUES
('Suite', 4),
('Suite', 7);

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
(133, 116, '../Reservas/Imagenes_habitaciones/581.jpg'),
(134, 116, '../Reservas/Imagenes_habitaciones/582.jpg'),
(135, 116, '../Reservas/Imagenes_habitaciones/583.jpg'),
(136, 117, '../Reservas/Imagenes_habitaciones/586.jpg'),
(137, 117, '../Reservas/Imagenes_habitaciones/587.jpg'),
(138, 117, '../Reservas/Imagenes_habitaciones/588.jpg');

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

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`num_reserva`, `id_usuario`, `fecha_entrada`, `fecha_salida`, `tipo_habitacion`) VALUES
(104, 105, '2021-06-03 22:00:00', '2021-06-11 22:00:00', 'Individual'),
(105, 105, '2021-06-02 22:00:00', '2021-06-10 22:00:00', 'Suite'),
(106, 105, '2021-06-23 22:00:00', '2021-06-26 22:00:00', 'Individual');

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
(1, 'Usuario_registrado'),
(3, 'Usuario_trabajador');

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

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre_servicio`, `precio_servicio`, `descripcion`, `disponibilidad`) VALUES
(4, 'Internet', '123.00', 'dawada', b'1'),
(5, 'Lavanderia', '1313.00', 'dadsada', b'1'),
(6, 'Basura', '32.00', 'adawad', b'1'),
(7, 'Piscina', '123.00', 'dadwa', b'1'),
(8, 'Bar', '2.00', 'qdad', b'1');

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
(116, '123.00', b'1', 'Individual', b'1', b'1', '123.00', 'sqdswqsd'),
(117, '123.00', b'1', 'Suite', b'1', b'1', '123.00', 'qdqasdqdsqad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id_trabajadores` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `fecha_nac` date NOT NULL,
  `dni` varchar(9) NOT NULL,
  `nacionalidad` varchar(255) NOT NULL,
  `sexo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `rol_usuario` bigint(20) NOT NULL,
  `imagen_usuario` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `telf`, `direccion`, `password`, `rol_usuario`, `imagen_usuario`) VALUES
(100, 'pablo', 'pablo@gmail.com', '123456789', 'callex', '$2y$10$PQmzgIIsFElSNu78U.BsSef2ow7SOTuusn5P6h1tHC4X4bLtiK1SC', 2, '../Perfil/Multimedia/0786b5b80ccd512c28a839d2b67d1a0d.jpg'),
(105, 'Pedro', 'pedrofc99@gmail.com', '698139991', 'tuputacasa', '$2y$10$XTRTnaAtpHoi52EBlG/zP.5RV9g2AKBkaQYvV1xOGHB6rUynuVzSu', 2, '../Perfil/Multimedia/0786b5b80ccd512c28a839d2b67d1a0d.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `administrador_roles_2` (`id_usuario`);

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
  ADD PRIMARY KEY (`tipo_habitacion`,`id_servicio`) USING BTREE,
  ADD KEY `id_servicio_fk` (`id_servicio`) USING BTREE,
  ADD KEY `tipo_habitacion_fk` (`tipo_habitacion`) USING BTREE;

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
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`id_trabajadores`),
  ADD KEY `trabajador_roles_2` (`id_usuario`);

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
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_admin` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `habitaciones_reservas`
--
ALTER TABLE `habitaciones_reservas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `imagenes_habitaciones`
--
ALTER TABLE `imagenes_habitaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `num_reserva` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_habitaciones`
--
ALTER TABLE `tipo_habitaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id_trabajadores` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `administrador_roles_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

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
  ADD CONSTRAINT `habitaciones_reservas_ibfk_2` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`id`);

--
-- Filtros para la tabla `habitacion_servicio`
--
ALTER TABLE `habitacion_servicio`
  ADD CONSTRAINT `habitacion_servicio_ibfk_1` FOREIGN KEY (`tipo_habitacion`) REFERENCES `tipo_habitaciones` (`tipo_de_habitacion`),
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
-- Filtros para la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD CONSTRAINT `trabajador_roles_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_usuario`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
