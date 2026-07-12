<?php

require_once 'config/Conexion.php';

class DocenteModelo
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }


    public function listar()
    {
        $sql = "SELECT id_docente, cedula, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_creacion, estado 
                FROM docentes 
                ORDER BY id_docente DESC";
        $stmt = $this->conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id_docente)
    {
        $sql = "SELECT id_docente, cedula, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_creacion, estado 
                FROM docentes 
                WHERE id_docente = :id_docente";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_docente' => $id_docente]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar($datos)
    {
        $sql = "INSERT INTO docentes (cedula, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, estado) 
                VALUES (:cedula, :primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :estado)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':cedula' => $datos['cedula'],
            ':primer_nombre' => $datos['primer_nombre'],
            ':segundo_nombre' => $datos['segundo_nombre'],
            ':primer_apellido' => $datos['primer_apellido'],
            ':segundo_apellido' => $datos['segundo_apellido'],
            ':estado' => $datos['estado'] ?? 'activo'
        ]);
        return $this->conexion->lastInsertId();
    }

    public function actualizar($id_docente, $datos)
    {
        $sql = "UPDATE docentes 
                SET cedula = :cedula, 
                    primer_nombre = :primer_nombre, 
                    segundo_nombre = :segundo_nombre, 
                    primer_apellido = :primer_apellido, 
                    segundo_apellido = :segundo_apellido,
                    estado = :estado 
                WHERE id_docente = :id_docente";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':cedula' => $datos['cedula'],
            ':primer_nombre' => $datos['primer_nombre'],
            ':segundo_nombre' => $datos['segundo_nombre'],
            ':primer_apellido' => $datos['primer_apellido'],
            ':segundo_apellido' => $datos['segundo_apellido'],
            ':estado' => $datos['estado'],
            ':id_docente' => $id_docente
        ]);
        return $stmt->rowCount();
    }

    public function eliminar($id_docente)
    {
        $sql = "DELETE FROM docentes WHERE id_docente = :id_docente";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_docente' => $id_docente]);
        return $stmt->rowCount();
    }
}
