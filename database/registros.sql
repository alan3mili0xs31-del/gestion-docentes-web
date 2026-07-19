USE gestion_docentes_db;

START TRANSACTION;

INSERT INTO `usuarios` (`id_usuario`, `cedula`, `nombre`, `correo`, `telefono`, `clave`, `rol`, `fecha_modificacion`, `fecha_creacion`, `estado`) VALUES
(1, '0100000001', 'Pepito Gutierrez', 'Gutierrez@hotmail.com', '0999999999', 'admin1234', 'administrador', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(2, '0101234567', "Carlos Mendoza", NULL, NULL, 'docente123', 'docente', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(3, '0102345678', "María Paredes", NULL, NULL, 'docente123', 'docente', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(4, '0103456789', "Luis Cevallos", NULL, NULL, 'docente123', 'docente', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(5, '0104567890', "Ana Morales", NULL, NULL, 'docente123', 'docente', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(6, '0105678901', "Jorge Vera", NULL, NULL, 'docente123', 'docente', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo');



INSERT INTO `docentes` (`id_docente`, `cedula`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `especialidad`, `fecha_modificacion`, `fecha_creacion`, `estado`) VALUES
(1, '0101234567', 'Carlos', 'Andrés', 'Mendoza', 'Villacís', 'Ingeniero en sistemas', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(2, '0102345678', 'María', 'Fernanda', 'Paredes', 'Gómez', 'Licenciado en redes', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(3, '0103456789', 'Luis', 'Alberto', 'Cevallos', 'Reinoso', 'Administrador de sistemas computacionales', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(4, '0104567890', 'Ana', 'Lucía', 'Morales', 'Pérez', 'Ingeniero de prompts', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(5, '0105678901', 'Jorge', 'David', 'Vera', 'Salazar', 'Ingeniero de software', '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo');





INSERT INTO `asignaturas`
(`id_asignatura`, `codigo`, `nombre`, `semestre`, `creditos`, `fecha_modificacion`, `fecha_creacion`, `estado`)
VALUES
(1, 'INF101', 'Programación I', 'Primer', 5, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(2, 'INF202', 'Base de Datos', 'Segundo', 5, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(3, 'INF305', 'Ingeniería de Software', 'Tercero', 4, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(4, 'INF406', 'Desarrollo Web', 'Cuarto', 4, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(5, 'INF203', 'Estructura de Datos', 'Segundo', 5, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo');




INSERT INTO `cursos` (`id_curso`, `id_docente`, `id_asignatura`, `paralelo`, `nombre`, `horario`, `descripcion`, `cantidad_alumnos`, `fecha_modificacion`, `fecha_creacion`, `estado`) VALUES
(1, 1, 1, 'MAT-101', 'Programacion I', 'Lun. & Mie. 07:00 - 09:00', 'Fundamentos de programacion', 35, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(2, 1, 2, 'MAT-102', 'Base de Datos', 'Mar. & Jue. 09:00 - 11:00', 'Modelado de bases de datos y SQL', 30, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(3, 2, 3, 'MAT-103', 'Ingenieria de Software', 'Lun. & Vie. 10:00 - 12:00', 'Metodologias para el desarrollo de software', 28, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(4, 2, 4, 'VES-201', 'Desarrollo Web', 'Mie. & Jue. 13:00 - 15:00', 'HTML, CSS y JavaScript', 32, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(5, 3, 5, 'MAT-104', 'Estructura de Datos', 'Mar. 08:00 - 11:00', 'Listas, pilas, colas y arboles', 27, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(6, 4, 1, 'VES-202', 'Programacion I', 'Vie. 15:00 - 18:00', 'Programacion orientada a objetos', 33, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(7, 5, 2, 'NOC-301', 'Base de Datos', 'Lun. & Mie. 18:00 - 20:00', 'Consultas SQL avanzadas y procedimientos', 29, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo'),
(8, 5, 4, 'MAT-105', 'Desarrollo Web', 'Mar. & Jue. 07:00 - 10:00', 'Desarrollo de aplicaciones web dinamicas', 31, '2026-07-12 15:47:16', '2026-07-12 15:47:16', 'activo');






INSERT INTO `asistencias`
(`id_asistencia`, `id_curso`, `id_docente`, `fecha`, `estado`) VALUES

(1, 1, 1, '2026-07-13', 'presente'),
(2, 1, 1, '2026-07-15', 'atrasado'),
(3, 2, 1, '2026-07-14', 'presente'),
(4, 2, 1, '2026-07-16', 'ausente'),

(5, 3, 2, '2026-07-13', 'presente'),
(6, 3, 2, '2026-07-17', 'atrasado'),
(7, 4, 2, '2026-07-14', 'presente'),
(8, 4, 2, '2026-07-16', 'ausente'),

(9, 5, 3, '2026-07-13', 'presente'),
(10, 5, 3, '2026-07-15', 'presente'),

(11, 6, 4, '2026-07-14', 'atrasado'),
(12, 6, 4, '2026-07-17', 'presente'),

(13, 7, 5, '2026-07-13', 'presente'),
(14, 7, 5, '2026-07-15', 'ausente'),
(15, 7, 5, '2026-07-17', 'presente'),

(16, 8, 5, '2026-07-14', 'presente'),
(17, 8, 5, '2026-07-16', 'atrasado'),
(18, 1, 1, '2026-07-17', 'presente'),
(19, 3, 2, '2026-07-16', 'presente'),
(20, 8, 5, '2026-07-17', 'ausente');






INSERT INTO `actividades_academicas`
(`id_actividad`, `id_curso`, `titulo`, `descripcion`, `categoria`, `fecha_apertura`, `fecha_cierre`)
VALUES
(1, 1, 'Tarea 1', 'Resolución de ejercicios del capítulo 1.', 'Tarea', '2026-07-20 08:00:00', '2026-07-27 23:59:59'),
(2, 2, 'Proyecto Inicial', 'Desarrollo del proyecto de introducción.', 'Proyecto', '2026-07-20 08:00:00', '2026-08-03 23:59:59'),
(3, 3, 'Quiz 1', 'Evaluación de los temas iniciales.', 'Quiz', '2026-07-21 08:00:00', '2026-07-21 23:59:59'),
(4, 4, 'Foro de Presentación', 'Presentación e interacción con los compañeros.', 'Foro', '2026-07-20 08:00:00', '2026-07-30 23:59:59'),
(5, 5, 'Laboratorio 1', 'Práctica de laboratorio sobre conceptos básicos.', 'Laboratorio', '2026-07-22 08:00:00', '2026-07-29 23:59:59'),
(6, 6, 'Examen Parcial', 'Evaluación correspondiente a la primera unidad.', 'Examen', '2026-08-01 09:00:00', '2026-08-01 11:00:00'),
(7, 7, 'Investigación 1', 'Investigar sobre las tendencias actuales del área.', 'Investigacion', '2026-07-23 08:00:00', '2026-08-06 23:59:59'),
(8, 8, 'Presentación Individual', 'Exposición de un tema asignado.', 'Presentacion', '2026-08-05 08:00:00', '2026-08-05 12:00:00'),
(9, 1, 'Tarea 2', 'Resolución de problemas avanzados.', 'Tarea', '2026-07-28 08:00:00', '2026-08-04 23:59:59'),
(10, 2, 'Proyecto Final', 'Entrega del proyecto completo.', 'Proyecto', '2026-08-07 08:00:00', '2026-08-21 23:59:59'),
(11, 3, 'Quiz 2', 'Evaluación de la segunda unidad.', 'Quiz', '2026-08-08 08:00:00', '2026-08-08 23:59:59'),
(12, 4, 'Foro de Debate', 'Debate sobre un caso de estudio.', 'Foro', '2026-08-02 08:00:00', '2026-08-10 23:59:59'),
(13, 5, 'Laboratorio 2', 'Práctica de simulación.', 'Laboratorio', '2026-08-03 08:00:00', '2026-08-10 23:59:59'),
(14, 6, 'Examen Final', 'Evaluación final del curso.', 'Examen', '2026-08-25 09:00:00', '2026-08-25 11:30:00'),
(15, 7, 'Investigación 2', 'Análisis de un artículo científico.', 'Investigacion', '2026-08-04 08:00:00', '2026-08-18 23:59:59'),
(16, 8, 'Presentación Grupal', 'Exposición del proyecto en equipo.', 'Presentacion', '2026-08-20 08:00:00', '2026-08-20 12:00:00'),
(17, 1, 'Tarea 3', 'Actividad de refuerzo.', 'Tarea', '2026-08-09 08:00:00', '2026-08-16 23:59:59'),
(18, 2, 'Quiz Final', 'Quiz de cierre del curso.', 'Quiz', '2026-08-22 08:00:00', '2026-08-22 23:59:59'),
(19, 5, 'Foro de Conclusiones', 'Compartir conclusiones finales.', 'Foro', '2026-08-15 08:00:00', '2026-08-24 23:59:59'),
(20, 8, 'Laboratorio Final', 'Práctica integradora del curso.', 'Laboratorio', '2026-08-18 08:00:00', '2026-08-26 23:59:59');


COMMIT;
