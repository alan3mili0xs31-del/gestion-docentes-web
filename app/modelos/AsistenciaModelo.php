<?php

require_once 'config/Conexion.php';

class AsistenciaModelo
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }


    public function listar()
    {
        $sql = "SELECT
                    a.id_asistencia,
                    a.fecha,
                    a.estado,
                    a.id_curso,
                    a.id_docente,
                    c.nombre AS curso,
                    c.paralelo,
                    d.primer_nombre,
                    d.primer_apellido,
                    asig.nombre AS asignatura_nombre
                FROM asistencias a
                INNER JOIN cursos c
                    ON a.id_curso = c.id_curso
                INNER JOIN docentes d
                    ON a.id_docente = d.id_docente
                INNER JOIN asignaturas asig
                    ON c.id_asignatura = asig.id_asignatura
                ORDER BY a.fecha DESC, a.id_asistencia DESC";

        $stmt = $this->conexion->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function listarMisAsistencias($id_docente)
    {
        $sql = "SELECT
                    a.id_asistencia,
                    a.fecha,
                    a.estado,
                    a.id_curso,
                    a.id_docente,
                    c.nombre AS curso,
                    c.paralelo,
                    d.primer_nombre,
                    d.primer_apellido,
                    asig.nombre AS asignatura_nombre
                FROM asistencias a
                INNER JOIN cursos c
                    ON a.id_curso = c.id_curso
                INNER JOIN docentes d
                    ON a.id_docente = d.id_docente
                INNER JOIN asignaturas asig
                    ON c.id_asignatura = asig.id_asignatura
                WHERE a.id_docente = :id_docente
                ORDER BY a.fecha DESC, a.id_asistencia DESC";


        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id_docente' => $id_docente
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function buscar($id_asistencia)
    {
        $sql = "SELECT
                    a.id_asistencia,
                    a.id_curso,
                    a.id_docente,
                    a.fecha,
                    a.estado,
                    c.nombre AS curso,
                    c.paralelo,
                    d.primer_nombre,
                    d.primer_apellido,
                    asig.nombre AS asignatura_nombre
                FROM asistencias a
                INNER JOIN cursos c
                    ON a.id_curso = c.id_curso
                INNER JOIN docentes d
                    ON a.id_docente = d.id_docente
                INNER JOIN asignaturas asig
                    ON c.id_asignatura = asig.id_asignatura
                WHERE a.id_asistencia = :id_asistencia";


        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id_asistencia' => $id_asistencia
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function guardar($datos)
    {
        $sql = "INSERT INTO asistencias
                (
                    id_curso,
                    id_docente,
                    fecha,
                    estado
                )
                VALUES
                (
                    :id_curso,
                    :id_docente,
                    :fecha,
                    :estado
                )";


        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id_curso' => $datos['id_curso'],
            ':id_docente' => $datos['id_docente'],
            ':fecha' => $datos['fecha'],
            ':estado' => $datos['estado']
        ]);


        return $this->conexion->lastInsertId();
    }


    public function actualizar($id_asistencia, $datos)
    {
        $sql = "UPDATE asistencias
                SET
                    id_curso = :id_curso,
                    id_docente = :id_docente,
                    fecha = :fecha,
                    estado = :estado
                WHERE id_asistencia = :id_asistencia";


        $stmt = $this->conexion->prepare($sql);


        $stmt->execute([
            ':id_curso' => $datos['id_curso'],
            ':id_docente' => $datos['id_docente'],
            ':fecha' => $datos['fecha'],
            ':estado' => $datos['estado'],
            ':id_asistencia' => $id_asistencia
        ]);


        return $stmt->rowCount();
    }


    public function eliminar($id_asistencia)
    {
        $sql = "DELETE FROM asistencias
                WHERE id_asistencia = :id_asistencia";


        $stmt = $this->conexion->prepare($sql);


        $stmt->execute([
            ':id_asistencia' => $id_asistencia
        ]);


        return $stmt->rowCount();
    }
}
