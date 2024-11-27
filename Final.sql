-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2024 a las 04:30:28
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
-- Base de datos: `calendario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id_reserva` int(11) NOT NULL,
  `estado` enum('pendiente','aprobada','denegada') NOT NULL DEFAULT 'pendiente',
  `usuario` varchar(50) NOT NULL,
  `title` varchar(220) NOT NULL,
  `color` varchar(45) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `obs` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id_reserva`, `estado`, `usuario`, `title`, `color`, `start`, `end`, `obs`) VALUES
(43, 'aprobada', 'Santiago Rodriguez', 'Partido 1', '#FF4500', '2024-10-30 08:00:00', '2024-10-30 10:00:00', 'fuchibol'),
(62, 'aprobada', 'Spooky - Cicilis', 'Partido 3', '#FF4500', '2024-11-20 10:00:00', '2024-11-20 12:00:00', 'xd'),
(78, 'aprobada', 'Bruno Bustos huayanay', 'prueba 22', '#FF4500', '2024-11-25 10:00:00', '2024-11-25 11:00:00', 'JALO'),
(80, 'aprobada', 'Bruno Bustos huayanay', 'prueba 23', '#A020F0', '2024-11-13 10:00:00', '2024-11-13 11:00:00', 'Partidito de prueba'),
(81, 'aprobada', 'Bruno Bustos huayanay', 'Prueba casi final', '#8B4513', '2024-11-12 10:00:00', '2024-11-12 11:00:00', 'fuchibol'),
(84, 'pendiente', 'Bruno Bustos huayanay', 'prueba 30', '#436EEE', '2024-11-07 10:00:00', '2024-11-07 11:00:00', '123'),
(85, 'pendiente', 'Ricardo Antonio Quispe Mejia', 'Prueba 31', '#228B22', '2024-11-06 10:00:00', '2024-11-06 12:00:00', 'info 2'),
(86, 'pendiente', 'Diego Bernilla', 'prueba 33', '#40E0D0', '2024-11-14 10:00:00', '2024-11-14 12:00:00', 'Info 3'),
(87, 'aprobada', 'Bruno Bustos huayanay', 'Prueba 50', '#40E0D0', '2024-11-21 10:00:00', '2024-11-21 11:00:00', 'xd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(250) NOT NULL,
  `rol` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `correo`, `contrasena`, `rol`, `avatar`) VALUES
(19, 'Ricardo Antonio Quispe Mejia', 'ricardo.quispem@unmsm.edu.pe', 'a98bddf7d656b06567cf7f56f6fa0433af2b4c9e4efc5d8a98fb58aa05b0f67cf420bfcb3407f54b7105cf805f28c073be57387fbe6941c31e75b2afda0fc0d3', 1, ''),
(20, 'Bruno Bustos huayanay', 'bruno.bustos@unmsm.edu.pe', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2, '3a849e81dc.png'),
(21, 'Diego Bernilla', 'diego.bernilla@unmsm.edu.pe', 'e13efc991a9bf44bbb4da87cdbb725240184585ccaf270523170e008cf2a3b85f45f86c3da647f69780fb9e971caf5437b3d06d418355a68c9760c70a31d05c7', 2, 'a33538faf8.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_reserva`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
