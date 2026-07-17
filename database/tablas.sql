CREATE DATABASE IF NOT EXISTS gestion_docentes_db;
USE gestion_docentes_db;

START TRANSACTION;

CREATE TABLE usuarios (
    id_usuario INT(11) NOT NULL AUTO_INCREMENT,
    cedula VARCHAR(10) NOT NULL,
    nombre VARCHAR(100) DEFAULT NULL,
    correo VARCHAR(100) DEFAULT NULL,
    telefono VARCHAR(20) DEFAULT NULL,
    clave VARCHAR(100) NOT NULL,
    rol ENUM('docente','administrador') NOT NULL DEFAULT 'docente',
    fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('activo','inactivo') NOT NULL DEFAULT 'activo',

    PRIMARY KEY(id_usuario),
    UNIQUE KEY uk_usuario_cedula(cedula)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE docentes (
    id_docente INT(11) NOT NULL AUTO_INCREMENT,
    cedula VARCHAR(10) NOT NULL,
    primer_nombre VARCHAR(100) NOT NULL,
    segundo_nombre VARCHAR(100) DEFAULT NULL,
    primer_apellido VARCHAR(100) NOT NULL,
    segundo_apellido VARCHAR(100) DEFAULT NULL,
    especialidad VARCHAR(100) NOT NULL,
    fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('activo','inactivo') NOT NULL DEFAULT 'activo',

    PRIMARY KEY(id_docente),
    UNIQUE KEY uk_docente_cedula(cedula)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE asignaturas (
    id_asignatura INT(11) NOT NULL AUTO_INCREMENT,
    codigo VARCHAR(20) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    semestre ENUM(
        'Primer',
        'Segundo',
        'Tercero',
        'Cuarto',
        'Quinto',
        'Sexto',
        'Septimo',
        'Octavo',
        'Noveno',
        'Decimo'
    ) NOT NULL,
    creditos INT(2) NOT NULL,
    fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('activo','inactivo') NOT NULL DEFAULT 'activo',

    PRIMARY KEY(id_asignatura),
    UNIQUE KEY uk_asignatura_codigo(codigo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE cursos (
    id_curso INT(11) NOT NULL AUTO_INCREMENT,
    id_docente INT(11) NOT NULL,
    id_asignatura INT(11) NOT NULL,
    paralelo VARCHAR(10) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    horario VARCHAR(100) NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    cantidad_alumnos INT(11) NOT NULL DEFAULT 0,
    fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('activo','inactivo') NOT NULL DEFAULT 'activo',

    PRIMARY KEY(id_curso),

    CONSTRAINT fk_curso_docente
        FOREIGN KEY(id_docente)
        REFERENCES docentes(id_docente),

    CONSTRAINT fk_curso_asignatura
        FOREIGN KEY(id_asignatura)
        REFERENCES asignaturas(id_asignatura)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE asistencias (
    id_asistencia INT(11) NOT NULL AUTO_INCREMENT,
    id_curso INT(11) NOT NULL,
    id_docente INT(11) NOT NULL,
    fecha DATE NOT NULL DEFAULT (CURRENT_DATE),
    fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado ENUM(
        'presente',
        'ausente',
        'atrasado'
    ) NOT NULL DEFAULT 'presente',

    PRIMARY KEY(id_asistencia),

    CONSTRAINT fk_asistencia_curso
        FOREIGN KEY(id_curso)
        REFERENCES cursos(id_curso),

    CONSTRAINT fk_asistencia_docente
        FOREIGN KEY(id_docente)
        REFERENCES docentes(id_docente)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE actividades_academicas (
    id_actividad INT(11) NOT NULL AUTO_INCREMENT,
    id_curso INT(11) NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT DEFAULT NULL,
    categoria ENUM(
        'Tarea',
        'Proyecto',
        'Examen',
        'Quiz',
        'Foro',
        'Laboratorio',
        'Investigacion',
        'Presentacion'
    ) NOT NULL,
    fecha_apertura DATETIME NOT NULL,
    fecha_cierre DATETIME NOT NULL,
    fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('activo','inactivo') NOT NULL DEFAULT 'activo',

    PRIMARY KEY(id_actividad),

    CONSTRAINT fk_actividad_curso
        FOREIGN KEY(id_curso)
        REFERENCES cursos(id_curso)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


COMMIT;
