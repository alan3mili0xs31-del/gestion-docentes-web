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
        $sql = "SELECT ac.id_actividad, d.primer_nombre, d.primer_apellido, d.cedula, a.nombre as asignatura_nombre 
                FROM actividades_academicas ac
                JOIN docentes d ON ac.id_docente = d.id_docente
                JOIN asignaturas a ON ac.id_asignatura = a.id_asignatura
                ORDER BY ac.id_actividad DESC";
        $stmt = $this->conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id_actividad)
    {
        $sql = "SELECT ac.id_actividad, ac.id_docente, ac.id_asignatura, d.primer_nombre, d.primer_apellido, a.nombre as asignatura_nombre 
                FROM actividades_academicas ac
                JOIN docentes d ON ac.id_docente = d.id_docente
                JOIN asignaturas a ON ac.id_asignatura = a.id_asignatura
                WHERE ac.id_actividad = :id_actividad";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_actividad' => $id_actividad]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar($datos)
    {
        $sql = "INSERT INTO actividades_academicas (id_docente, id_asignatura) 
                VALUES (:id_docente, :id_asignatura)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':id_docente' => $datos['id_docente'],
            ':id_asignatura' => $datos['id_asignatura']
        ]);
        return $this->conexion->lastInsertId();
    }

    public function actualizar($id_actividad, $datos)
    {
        $sql = "UPDATE actividades_academicas 
                SET id_docente = :id_docente, 
                    id_asignatura = :id_asignatura 
                WHERE id_actividad = :id_actividad";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':id_docente' => $datos['id_docente'],
            ':id_asignatura' => $datos['id_asignatura'],
            ':id_actividad' => $id_actividad
        ]);
        return $stmt->rowCount();
    }

    public function eliminar($id_actividad)
    {
        $sql = "DELETE FROM actividades_academicas WHERE id_actividad = :id_actividad";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_actividad' => $id_actividad]);
        return $stmt->rowCount();
    }
}
