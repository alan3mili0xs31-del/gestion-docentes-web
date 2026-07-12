<?php

require_once 'config/Conexion.php';

class AsignaturaModelo
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }


    public function listar()
    {
        $sql = "SELECT id_asignatura, nombre, fecha_creacion, estado 
                FROM asignaturas 
                ORDER BY id_asignatura DESC";
        $stmt = $this->conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id_asignatura)
    {
        $sql = "SELECT id_asignatura, nombre, fecha_creacion, estado 
                FROM asignaturas 
                WHERE id_asignatura = :id_asignatura";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_asignatura' => $id_asignatura]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar($datos)
    {
        $sql = "INSERT INTO asignaturas (nombre, estado) 
                VALUES (:nombre, :estado)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':estado' => $datos['estado'] ?? 'activo'
        ]);
        return $this->conexion->lastInsertId();
    }

    public function actualizar($id_asignatura, $datos)
    {
        $sql = "UPDATE asignaturas 
                SET nombre = :nombre, 
                    estado = :estado 
                WHERE id_asignatura = :id_asignatura";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':estado' => $datos['estado'],
            ':id_asignatura' => $id_asignatura
        ]);
        return $stmt->rowCount();
    }

    public function eliminar($id_asignatura)
    {
        $sql = "DELETE FROM asignaturas WHERE id_asignatura = :id_asignatura";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_asignatura' => $id_asignatura]);
        return $stmt->rowCount();
    }
}
