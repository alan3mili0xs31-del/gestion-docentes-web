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
        $stmt = $this->conexion->prepare(
            "SELECT id_asignatura, codigo, nombre, creditos, semestre, facultad
             FROM asignaturas
             WHERE estado = 'activo'
             ORDER BY nombre ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscar($id)
    {
        $stmt = $this->conexion->prepare(
            "SELECT id_asignatura, codigo, nombre, creditos, semestre, facultad
             FROM asignaturas
             WHERE id_asignatura = :id AND estado = 'activo'"
        );
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function guardar($datos)
    {
        $stmt = $this->conexion->prepare(
            "INSERT INTO asignaturas (codigo, nombre, creditos, semestre, facultad)
             VALUES (:codigo, :nombre, :creditos, :semestre, :facultad)"
        );
        $stmt->bindParam(':codigo',   $datos['codigo'],   PDO::PARAM_STR);
        $stmt->bindParam(':nombre',   $datos['nombre'],   PDO::PARAM_STR);
        $stmt->bindParam(':creditos', $datos['creditos'], PDO::PARAM_INT);
        $stmt->bindParam(':semestre', $datos['semestre'], PDO::PARAM_STR);
        $stmt->bindParam(':facultad', $datos['facultad'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function actualizar($id, $datos)
    {
        $stmt = $this->conexion->prepare(
            "UPDATE asignaturas
             SET codigo = :codigo,
                 nombre = :nombre,
                 creditos = :creditos,
                 semestre = :semestre,
                 facultad = :facultad
             WHERE id_asignatura = :id"
        );
        $stmt->bindParam(':codigo',   $datos['codigo'],   PDO::PARAM_STR);
        $stmt->bindParam(':nombre',   $datos['nombre'],   PDO::PARAM_STR);
        $stmt->bindParam(':creditos', $datos['creditos'], PDO::PARAM_INT);
        $stmt->bindParam(':semestre', $datos['semestre'], PDO::PARAM_STR);
        $stmt->bindParam(':facultad', $datos['facultad'], PDO::PARAM_STR);
        $stmt->bindParam(':id',       $id,                PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function eliminar($id)
    {
        $stmt = $this->conexion->prepare(
            "UPDATE asignaturas SET estado = 'inactivo' WHERE id_asignatura = :id"
        );
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
