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
        $stmt = $this->conexion->prepare("SELECT id_asignatura, nombre FROM asignaturas ORDER BY nombre ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function buscar($id)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM asignaturas WHERE id_asignatura = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }


    public function guardar($datos)
    {
        // TODO:
        // Insertar una nueva asignatura.
    }


    public function actualizar($id, $datos)
    {
        // TODO:
        // Actualizar una asignatura existente.
    }


    public function eliminar($id)
    {
        // TODO:
        // Eliminar una asignatura.
    }
}
