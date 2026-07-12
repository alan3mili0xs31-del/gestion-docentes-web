-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 12-07-2026 a las 20:29:54
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
-- Base de datos: `gestion_docentes_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `clave` varchar(100) NOT NULL,
  `rol` enum('docente','administrador') NOT NULL DEFAULT 'docente',
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `cedula`, `nombre`, `correo`, `telefono`, `clave`, `rol`, `fecha_modificacion`, `fecha_creacion`, `estado`) VALUES
(1, '0100000001', 'Juan Perez', 'Juan@hotmail.com', '0999999999', 'admin1234', 'administrador', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(2, '0101234567', NULL, NULL, NULL, 'docente123', 'docente', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(3, '0102345678', NULL, NULL, NULL, 'docente123', 'docente', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(4, '0103456789', NULL, NULL, NULL, 'docente123', 'docente', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(5, '0104567890', NULL, NULL, NULL, 'docente123', 'docente', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(6, '0105678901', NULL, NULL, NULL, 'docente123', 'docente', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
