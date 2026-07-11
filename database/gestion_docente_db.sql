CREATE DATABASE gestion_docentes_db;
USE gestion_docentes_db;


-- =========================================
-- TABLA ROLES
-- =========================================
CREATE TABLE roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY
);


-- =========================================
-- TABLA USUARIOS
-- Un usuario pertenece a un rol
-- =========================================
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(10) NOT NULL UNIQUE,
    clave VARCHAR(100) NOT NULL,
    rol ENUM('docente', 'administrador') NOT NULL DEFAULT 'docente',

    fecha_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('activo', 'inactivo') NOT NULL DEFAULT 'activo'
    -- id_rol INT NOT NULL,

    -- CONSTRAINT fk_usuario_rol
    --     FOREIGN KEY (id_rol)
    --     REFERENCES roles(id_rol)
);


-- =========================================
-- TABLA DOCENTES
-- =========================================
CREATE TABLE docentes (
    id_docente INT AUTO_INCREMENT PRIMARY KEY,

    cedula VARCHAR(10) NOT NULL UNIQUE,
    primer_nombre VARCHAR(100) NOT NULL,
    segundo_nombre VARCHAR(100),
    primer_apellido VARCHAR(100) NOT NULL,
    segundo_apellido VARCHAR(100),

    fecha_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('activo', 'inactivo') NOT NULL DEFAULT 'activo'

);



-- =========================================
-- TABLA ASIGNATURAS
-- Una asignatura pertenece a un curso
-- =========================================
CREATE TABLE asignaturas (
    id_asignatura INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,

    fecha_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('activo', 'inactivo') NOT NULL DEFAULT 'activo'
);


-- =========================================
-- TABLA CURSOS
-- Un curso pertenece a un docente
-- =========================================
CREATE TABLE cursos (
    id_curso INT AUTO_INCREMENT PRIMARY KEY,

    id_docente INT NOT NULL,
    id_asignatura INT NOT NULL,

    paralelo VARCHAR(10) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    horario VARCHAR(100) NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    cantidad_alumnos INT NOT NULL DEFAULT 0,
    fecha_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('activo', 'inactivo') NOT NULL DEFAULT 'activo',

    CONSTRAINT fk_curso_docente
        FOREIGN KEY (id_docente)
        REFERENCES docentes(id_docente),

    CONSTRAINT fk_curso_asignatura
        FOREIGN KEY (id_asignatura)
        REFERENCES asignaturas(id_asignatura)
);




-- =========================================
-- TABLA ASISTENCIAS
-- Una asistencia pertenece a una asignatura
-- y está relacionada con un docente
-- =========================================
CREATE TABLE asistencias (
    id_asistencia INT AUTO_INCREMENT PRIMARY KEY,

    id_asignatura INT NOT NULL,
    id_docente INT NOT NULL,

    CONSTRAINT fk_asistencia_asignatura
        FOREIGN KEY (id_asignatura)
        REFERENCES asignaturas(id_asignatura),

    CONSTRAINT fk_asistencia_docente
        FOREIGN KEY (id_docente)
        REFERENCES docentes(id_docente)
);


-- =========================================
-- TABLA ACTIVIDADES ACADEMICAS
-- Una actividad pertenece a una asignatura
-- y está relacionada con un docente
-- =========================================
CREATE TABLE actividades_academicas (
    id_actividad INT AUTO_INCREMENT PRIMARY KEY,

    id_asignatura INT NOT NULL,
    id_docente INT NOT NULL,

    CONSTRAINT fk_actividad_asignatura
        FOREIGN KEY (id_asignatura)
        REFERENCES asignaturas(id_asignatura),

    CONSTRAINT fk_actividad_docente
        FOREIGN KEY (id_docente)
        REFERENCES docentes(id_docente)
);
