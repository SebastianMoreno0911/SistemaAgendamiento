-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2026 a las 03:08:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agendamiento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_oficina` int(11) NOT NULL,
  `id_tramite` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_cita` time NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_usuario`, `id_oficina`, `id_tramite`, `fecha_cita`, `hora_cita`, `fecha_creacion`, `id_estado`) VALUES
(1, 1, 1, 1, '2026-05-20', '09:00:00', '2026-05-13 16:02:34', 2),
(2, 1, 2, 2, '2026-05-20', '13:00:00', '2026-05-14 01:44:03', 2),
(3, 1, 14, 2, '2026-05-28', '14:00:00', '2026-05-14 17:54:47', 1),
(4, 1, 14, 2, '2026-05-28', '14:00:00', '2026-05-14 17:54:47', 1),
(5, 1, 14, 1, '2026-05-21', '12:00:00', '2026-05-14 20:12:51', 2),
(6, 1, 14, 1, '2026-05-21', '12:00:00', '2026-05-14 20:12:51', 2),
(7, 1, 6, 1, '2026-05-27', '10:00:00', '2026-05-14 23:50:16', 2),
(8, 1, 6, 1, '2026-05-27', '10:00:00', '2026-05-14 23:50:16', 2),
(9, 1, 14, 2, '2026-05-17', '10:00:00', '2026-05-14 23:51:25', 2),
(10, 1, 14, 2, '2026-05-17', '10:00:00', '2026-05-14 23:51:25', 1),
(11, 1, 10, 2, '2026-05-13', '13:00:00', '2026-05-14 23:53:42', 1),
(12, 1, 10, 2, '2026-05-13', '13:00:00', '2026-05-14 23:53:42', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id_ciudad` int(11) NOT NULL,
  `nombre_ciudad` varchar(100) NOT NULL,
  `id_region` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id_ciudad`, `nombre_ciudad`, `id_region`) VALUES
(1, 'Barranquilla', 4),
(2, 'Cartagena', 5),
(3, 'Tunja', 6),
(4, 'Manizales', 7),
(5, 'Popayan', 10),
(6, 'Bogota', 14),
(7, 'Santa Marta', 19),
(8, 'Pasto', 21),
(9, 'Cucuta', 22),
(10, 'Armenia', 24),
(11, 'Pereira', 25),
(12, 'San Andres', 26),
(13, 'Bucaramanga', 27),
(14, 'Cali', 30),
(15, 'Palmira', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `nombre_estado`) VALUES
(1, 'Agendada'),
(2, 'Cancelada'),
(4, 'En curso'),
(5, 'Finalizada'),
(3, 'Incumplida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficinas`
--

CREATE TABLE `oficinas` (
  `id_oficina` int(11) NOT NULL,
  `nombre_oficina` varchar(100) NOT NULL,
  `direccion_oficina` varchar(150) NOT NULL,
  `id_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oficinas`
--

INSERT INTO `oficinas` (`id_oficina`, `nombre_oficina`, `direccion_oficina`, `id_ciudad`) VALUES
(1, 'Oficina Norte', 'Cra 45 #70-20', 1),
(2, 'Oficina Centro', 'Av Santander #12-34', 2),
(3, 'Oficina Principal', 'Calle 19 #8-15', 3),
(4, 'Oficina Cable', 'Av Kevin Angel #23-40', 4),
(5, 'Oficina Central', 'Cra 6 #5-18', 5),
(6, 'Oficina Capital', 'Cra 10 #20-30', 6),
(7, 'Oficina Bahia', 'Calle 22 #14-10', 7),
(8, 'Oficina Sur', 'Cra 27 #16-50', 8),
(9, 'Oficina Frontera', 'Av Libertadores #11-25', 9),
(10, 'Oficina Plaza', 'Cra 14 #21-11', 10),
(11, 'Oficina Pereira', 'Calle 18 #7-40', 11),
(12, 'Oficina Isla', 'Av Colon #3-22', 12),
(13, 'Oficina Cabecera', 'Cra 33 #48-15', 13),
(14, 'Oficina Cali Centro', 'Calle 9 #4-55', 14),
(15, 'Oficina Palmira', 'Cra 28 #30-12', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regionales`
--

CREATE TABLE `regionales` (
  `id_region` int(11) NOT NULL,
  `nombre_region` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `regionales`
--

INSERT INTO `regionales` (`id_region`, `nombre_region`) VALUES
(1, 'Amazonas'),
(2, 'Antioquia'),
(3, 'Arauca'),
(4, 'Atlantico'),
(5, 'Bolivar'),
(6, 'Boyaca'),
(7, 'Caldas'),
(8, 'Caqueta'),
(9, 'Casanare'),
(10, 'Cauca'),
(11, 'Cesar'),
(12, 'Choco'),
(13, 'Cordoba'),
(14, 'Cundinamarca'),
(15, 'Guainia'),
(16, 'Guaviare'),
(17, 'Huila'),
(18, 'La Guajira'),
(19, 'Magdalena'),
(20, 'Meta'),
(21, 'Narino'),
(22, 'Norte de Santander'),
(23, 'Putumayo'),
(24, 'Quindio'),
(25, 'Risaralda'),
(26, 'San Andres y Providencia'),
(27, 'Santander'),
(28, 'Sucre'),
(29, 'Tolima'),
(30, 'Valle del Cauca'),
(31, 'Vaupes'),
(32, 'Vichada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramites`
--

CREATE TABLE `tramites` (
  `id_tramite` int(11) NOT NULL,
  `nombre_tramite` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tramites`
--

INSERT INTO `tramites` (`id_tramite`, `nombre_tramite`) VALUES
(3, 'Adquirir Producto Empresas'),
(1, 'Adquirir Producto Personas'),
(4, 'Servicio al Cliente Empresas'),
(2, 'Servicio al Cliente Personas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `documento` varchar(50) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `tipo_documento`, `documento`, `telefono`, `correo_electronico`) VALUES
(1, 'sebastian', 'moreno', 'cc', '1192792720', '3183544532', 'test@test.com'),
(2, 'Alejandro', 'Ruiz', 'CC', '1005823412', '3157894422', 'a.ruiz@mail.com'),
(3, 'Valentina', 'Gómez', 'CC', '1118234567', '3004567890', 'valen.gomez@provisional.co'),
(4, 'Mateo', 'Salazar', 'TI', '1098765432', '3123334455', 'mateo.sal@edu.co'),
(5, 'Isabella', 'Castaño', 'CC', '1144098765', '3219876543', 'isabella.c@webmail.com'),
(6, 'Santiago', 'Méndez', 'CE', '203456', '3105552211', 'santi.mendez@servicio.net'),
(7, 'Lucía', 'Valencia', 'CC', '1151987321', '3012223344', 'lucia.val@fastmail.com'),
(8, 'Daniel', 'Rojas', 'CC', '1006432110', '3164445566', 'd.rojas92@infotech.com'),
(9, 'Mariana', 'Herrera', 'TI', '1088123456', '3189990011', 'marianah@estudiante.com'),
(10, 'Felipe', 'Torres', 'CC', '1193445566', '3057778899', 'f.torres@corporativo.co'),
(11, 'Camila', 'Peña', 'CE', '405987', '3176661122', 'camilap@freelance.org');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_oficina` (`id_oficina`),
  ADD KEY `id_tramite` (`id_tramite`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id_ciudad`),
  ADD KEY `id_region` (`id_region`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`),
  ADD UNIQUE KEY `nombre_estado` (`nombre_estado`);

--
-- Indices de la tabla `oficinas`
--
ALTER TABLE `oficinas`
  ADD PRIMARY KEY (`id_oficina`),
  ADD KEY `id_ciudad` (`id_ciudad`);

--
-- Indices de la tabla `regionales`
--
ALTER TABLE `regionales`
  ADD PRIMARY KEY (`id_region`),
  ADD UNIQUE KEY `nombre_region` (`nombre_region`);

--
-- Indices de la tabla `tramites`
--
ALTER TABLE `tramites`
  ADD PRIMARY KEY (`id_tramite`),
  ADD UNIQUE KEY `nombre_tramite` (`nombre_tramite`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `documento` (`documento`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `oficinas`
--
ALTER TABLE `oficinas`
  MODIFY `id_oficina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `regionales`
--
ALTER TABLE `regionales`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `tramites`
--
ALTER TABLE `tramites`
  MODIFY `id_tramite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_oficina`) REFERENCES `oficinas` (`id_oficina`),
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`id_tramite`) REFERENCES `tramites` (`id_tramite`),
  ADD CONSTRAINT `citas_ibfk_4` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`);

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `ciudades_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `regionales` (`id_region`);

--
-- Filtros para la tabla `oficinas`
--
ALTER TABLE `oficinas`
  ADD CONSTRAINT `oficinas_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudades` (`id_ciudad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
