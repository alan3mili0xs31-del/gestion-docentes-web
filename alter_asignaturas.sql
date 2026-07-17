USE gestion_docentes_db;

ALTER TABLE asignaturas
ADD COLUMN codigo VARCHAR(20) NOT NULL AFTER id_asignatura,
ADD COLUMN creditos INT NOT NULL DEFAULT 3 AFTER nombre,
ADD COLUMN semestre VARCHAR(20) NOT NULL AFTER creditos,
ADD COLUMN facultad VARCHAR(50) NOT NULL AFTER semestre;
