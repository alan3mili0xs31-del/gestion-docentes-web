<?php

require_once 'config/Conexion.php';

class ActividadAcademicaModelo
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    public function listar()
    {
        $sql = "SELECT
                    ac.id_actividad,
                    ac.id_curso,
                    ac.titulo,
                    ac.descripcion,
                    ac.categoria,
                    ac.fecha_apertura,
                    ac.fecha_cierre,
                    c.nombre AS curso,
                    c.paralelo,
                    a.nombre AS asignatura,
                    CONCAT(d.primer_nombre,' ',d.primer_apellido) AS docente
                FROM actividades_academicas ac
                INNER JOIN cursos c
                    ON ac.id_curso = c.id_curso
                INNER JOIN docentes d
                    ON c.id_docente = d.id_docente
                INNER JOIN asignaturas a
                    ON c.id_asignatura = a.id_asignatura
                ORDER BY ac.id_actividad DESC";

        $stmt = $this->conexion->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarMisActividades($id_docente)
    {
        $sql = "SELECT
                    ac.id_actividad,
                    ac.id_curso,
                    ac.titulo,
                    ac.descripcion,
                    ac.categoria,
                    ac.fecha_apertura,
                    ac.fecha_cierre,
                    c.nombre AS curso,
                    c.paralelo,
                    a.nombre AS asignatura,
                    CONCAT(d.primer_nombre,' ',d.primer_apellido) AS docente
                FROM actividades_academicas ac
                INNER JOIN cursos c
                    ON ac.id_curso = c.id_curso
                INNER JOIN docentes d
                    ON c.id_docente = d.id_docente
                INNER JOIN asignaturas a
                    ON c.id_asignatura = a.id_asignatura
                WHERE c.id_docente = :id_docente
                ORDER BY ac.id_actividad DESC";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id_docente' => $id_docente
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id_actividad)
    {
        $sql = "SELECT
                    ac.*,
                    c.nombre AS curso,
                    c.paralelo,
                    a.nombre AS asignatura,
                    CONCAT(d.primer_nombre,' ',d.primer_apellido) AS docente
                FROM actividades_academicas ac
                INNER JOIN cursos c
                    ON ac.id_curso = c.id_curso
                INNER JOIN docentes d
                    ON c.id_docente = d.id_docente
                INNER JOIN asignaturas a
                    ON c.id_asignatura = a.id_asignatura
                WHERE ac.id_actividad = :id_actividad";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id_actividad' => $id_actividad
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar($datos)
    {
        $sql = "INSERT INTO actividades_academicas
                (
                    id_curso,
                    titulo,
                    descripcion,
                    categoria,
                    fecha_apertura,
                    fecha_cierre
                )
                VALUES
                (
                    :id_curso,
                    :titulo,
                    :descripcion,
                    :categoria,
                    :fecha_apertura,
                    :fecha_cierre
                )";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id_curso' => $datos['id_curso'],
            ':titulo' => $datos['titulo'],
            ':descripcion' => $datos['descripcion'],
            ':categoria' => $datos['categoria'],
            ':fecha_apertura' => $datos['fecha_apertura'],
            ':fecha_cierre' => $datos['fecha_cierre']
        ]);

        return $this->conexion->lastInsertId();
    }

    public function actualizar($id_actividad, $datos)
    {
        $sql = "UPDATE actividades_academicas
                SET
                    id_curso = :id_curso,
                    titulo = :titulo,
                    descripcion = :descripcion,
                    categoria = :categoria,
                    fecha_apertura = :fecha_apertura,
                    fecha_cierre = :fecha_cierre
                WHERE id_actividad = :id_actividad";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id_curso' => $datos['id_curso'],
            ':titulo' => $datos['titulo'],
            ':descripcion' => $datos['descripcion'],
            ':categoria' => $datos['categoria'],
            ':fecha_apertura' => $datos['fecha_apertura'],
            ':fecha_cierre' => $datos['fecha_cierre'],
            ':id_actividad' => $id_actividad
        ]);

        return $stmt->rowCount();
    }

    public function eliminar($id_actividad)
    {
        $sql = "DELETE FROM actividades_academicas
                WHERE id_actividad = :id_actividad";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id_actividad' => $id_actividad
        ]);

        return $stmt->rowCount();
    }
}
