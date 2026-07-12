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
        $sql = "SELECT a.id_asistencia, a.fecha, a.estado, d.primer_nombre, d.primer_apellido, asig.nombre as asignatura_nombre 
                FROM asistencias a
                JOIN docentes d ON a.id_docente = d.id_docente
                JOIN asignaturas asig ON a.id_asignatura = asig.id_asignatura
                ORDER BY a.fecha DESC, a.id_asistencia DESC";
        $stmt = $this->conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id_asistencia)
    {
        $sql = "SELECT a.id_asistencia, a.id_docente, a.id_asignatura, a.fecha, a.estado, d.primer_nombre, d.primer_apellido, asig.nombre as asignatura_nombre 
                FROM asistencias a
                JOIN docentes d ON a.id_docente = d.id_docente
                JOIN asignaturas asig ON a.id_asignatura = asig.id_asignatura
                WHERE a.id_asistencia = :id_asistencia";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_asistencia' => $id_asistencia]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar($datos)
    {
        $sql = "INSERT INTO asistencias (id_docente, id_asignatura, fecha, estado) 
                VALUES (:id_docente, :id_asignatura, :fecha, :estado)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':id_docente' => $datos['id_docente'],
            ':id_asignatura' => $datos['id_asignatura'],
            ':fecha' => $datos['fecha'],
            ':estado' => $datos['estado']
        ]);
        return $this->conexion->lastInsertId();
    }

    public function actualizar($id_asistencia, $datos)
    {
        $sql = "UPDATE asistencias 
                SET id_docente = :id_docente, 
                    id_asignatura = :id_asignatura,
                    fecha = :fecha,
                    estado = :estado
                WHERE id_asistencia = :id_asistencia";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':id_docente' => $datos['id_docente'],
            ':id_asignatura' => $datos['id_asignatura'],
            ':fecha' => $datos['fecha'],
            ':estado' => $datos['estado'],
            ':id_asistencia' => $id_asistencia
        ]);
        return $stmt->rowCount();
    }

    public function eliminar($id_asistencia)
    {
        $sql = "DELETE FROM asistencias WHERE id_asistencia = :id_asistencia";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_asistencia' => $id_asistencia]);
        return $stmt->rowCount();
    }
}
