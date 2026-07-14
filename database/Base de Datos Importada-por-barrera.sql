-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 14-07-2026 a las 04:44:05
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
-- Estructura de tabla para la tabla `actividades_academicas`
--

CREATE TABLE `actividades_academicas` (
  `id_actividad` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividades_academicas`
--

INSERT INTO `actividades_academicas` (`id_actividad`, `id_asignatura`, `id_docente`) VALUES
(1, 4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `id_asignatura` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`id_asignatura`, `nombre`, `fecha_modificacion`, `fecha_creacion`, `estado`) VALUES
(1, 'Programación I', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(2, 'Base de Datos', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(3, 'Ingeniería de Software', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(4, 'Desarrollo Web', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(5, 'Estructura de Datos', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id_asistencia` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT curdate(),
  `estado` enum('presente','ausente','atrasado') NOT NULL DEFAULT 'presente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id_asistencia`, `id_asignatura`, `id_docente`, `fecha`, `estado`) VALUES
(1, 4, 5, '2026-07-12', 'presente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `paralelo` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `horario` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `cantidad_alumnos` int(11) NOT NULL DEFAULT 0,
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `id_docente`, `id_asignatura`, `paralelo`, `nombre`, `horario`, `descripcion`, `cantidad_alumnos`, `fecha_modificacion`, `fecha_creacion`, `estado`) VALUES
(1, 1, 1, 'MAT-101', 'Programacion I', 'Lun. & Mie. 07:00 - 09:00', 'Fundamentos de programacion', 35, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(2, 1, 2, 'MAT-102', 'Base de Datos', 'Mar. & Jue. 09:00 - 11:00', 'Modelado de bases de datos y SQL', 30, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(3, 2, 3, 'MAT-103', 'Ingenieria de Software', 'Lun. & Vie. 10:00 - 12:00', 'Metodologias para el desarrollo de software', 28, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(4, 2, 4, 'VES-201', 'Desarrollo Web', 'Mie. & Jue. 13:00 - 15:00', 'HTML, CSS y JavaScript', 32, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(5, 3, 5, 'MAT-104', 'Estructura de Datos', 'Mar. 08:00 - 11:00', 'Listas, pilas, colas y arboles', 27, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(6, 4, 1, 'VES-202', 'Programacion I', 'Vie. 15:00 - 18:00', 'Programacion orientada a objetos', 33, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(7, 5, 2, 'NOC-301', 'Base de Datos', 'Lun. & Mie. 18:00 - 20:00', 'Consultas SQL avanzadas y procedimientos', 29, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(8, 5, 4, 'MAT-105', 'Desarrollo Web', 'Mar. & Jue. 07:00 - 10:00', 'Desarrollo de aplicaciones web dinamicas', 31, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `primer_nombre` varchar(100) NOT NULL,
  `segundo_nombre` varchar(100) DEFAULT NULL,
  `primer_apellido` varchar(100) NOT NULL,
  `segundo_apellido` varchar(100) DEFAULT NULL,
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `cedula`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `fecha_modificacion`, `fecha_creacion`, `estado`) VALUES
(1, '0101234567', 'Carlos', 'Andrés', 'Mendoza', 'Villacís', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(2, '0102345678', 'María', 'Fernanda', 'Paredes', 'Gómez', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(3, '0103456789', 'Luis', 'Alberto', 'Cevallos', 'Reinoso', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(4, '0104567890', 'Ana', 'Lucía', 'Morales', 'Pérez', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(5, '0105678901', 'Jorge', 'David', 'Vera', 'Salazar', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`) VALUES
(1),
(2);

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
-- Indices de la tabla `actividades_academicas`
--
ALTER TABLE `actividades_academicas`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `fk_actividad_asignatura` (`id_asignatura`),
  ADD KEY `fk_actividad_docente` (`id_docente`);

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id_asignatura`);

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `fk_asistencia_asignatura` (`id_asignatura`),
  ADD KEY `fk_asistencia_docente` (`id_docente`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `fk_curso_docente` (`id_docente`),
  ADD KEY `fk_curso_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

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
-- AUTO_INCREMENT de la tabla `actividades_academicas`
--
ALTER TABLE `actividades_academicas`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `id_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades_academicas`
--
ALTER TABLE `actividades_academicas`
  ADD CONSTRAINT `fk_actividad_asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`),
  ADD CONSTRAINT `fk_actividad_docente` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`);

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `fk_asistencia_asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`),
  ADD CONSTRAINT `fk_asistencia_docente` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_curso_asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`),
  ADD CONSTRAINT `fk_curso_docente` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
