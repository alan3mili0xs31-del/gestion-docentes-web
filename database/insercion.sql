-- =========================================
-- ROLES
-- =========================================
INSERT INTO roles (id_rol)
VALUES
(1),
(2);


-- =========================================
-- USUARIO ADMINISTRADOR
-- Clave: admin123
-- =========================================
INSERT INTO usuarios
(cedula, clave, rol)
VALUES
('0100000001', 'admin123', 'administrador');


-- =========================================
-- USUARIOS DOCENTES
-- Clave temporal: docente123
-- =========================================
INSERT INTO usuarios
(
    cedula,
    clave,
    rol
)
VALUES
('0101234567', 'docente123', 'docente'),
('0102345678', 'docente123', 'docente'),
('0103456789', 'docente123', 'docente'),
('0104567890', 'docente123', 'docente'),
('0105678901', 'docente123', 'docente');


-- =========================================
-- DOCENTES
-- =========================================
INSERT INTO docentes
(
    cedula,
    primer_nombre,
    segundo_nombre,
    primer_apellido,
    segundo_apellido
)
VALUES
('0101234567','Carlos','Andrés','Mendoza','Villacís'),
('0102345678','María','Fernanda','Paredes','Gómez'),
('0103456789','Luis','Alberto','Cevallos','Reinoso'),
('0104567890','Ana','Lucía','Morales','Pérez'),
('0105678901','Jorge','David','Vera','Salazar');

-- =========================================
-- ASIGNATURAS
-- =========================================
INSERT INTO asignaturas (nombre)
VALUES
('Programación I'),
('Base de Datos'),
('Ingeniería de Software'),
('Desarrollo Web'),
('Estructura de Datos');

-- =========================================
-- CURSOS
-- =========================================
INSERT INTO cursos
(
    id_docente,
    id_asignatura,
    paralelo,
    nombre,
    horario,
    descripcion,
    cantidad_alumnos
)
VALUES
(1,1,'MAT-101',
'Programacion I',
'Lun. & Mie. 07:00 - 09:00',
'Fundamentos de programacion',
35),

(1,2,'MAT-102',
'Base de Datos',
'Mar. & Jue. 09:00 - 11:00',
'Modelado de bases de datos y SQL',
30),

(2,3,'MAT-103',
'Ingenieria de Software',
'Lun. & Vie. 10:00 - 12:00',
'Metodologias para el desarrollo de software',
28),

(2,4,'VES-201',
'Desarrollo Web',
'Mie. & Jue. 13:00 - 15:00',
'HTML, CSS y JavaScript',
32),

(3,5,'MAT-104',
'Estructura de Datos',
'Mar. 08:00 - 11:00',
'Listas, pilas, colas y arboles',
27),

(4,1,'VES-202',
'Programacion I',
'Vie. 15:00 - 18:00',
'Programacion orientada a objetos',
33),

(5,2,'NOC-301',
'Base de Datos',
'Lun. & Mie. 18:00 - 20:00',
'Consultas SQL avanzadas y procedimientos',
29),

(5,4,'MAT-105',
'Desarrollo Web',
'Mar. & Jue. 07:00 - 10:00',
'Desarrollo de aplicaciones web dinamicas',
31);
