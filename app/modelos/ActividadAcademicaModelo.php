<?php

require_once 'config/Conexion.php';

class ActividadAcademicaModelo
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    public function listar($id_docente)
    {
        $stmt = $this->conexion->prepare("
            SELECT a.*, CONCAT(d.primer_nombre, ' ', d.primer_apellido) AS nombre_docente 
            FROM actividades_academicas a 
            JOIN docentes d ON a.id_docente = d.id_docente 
            WHERE a.id_docente = :id_docente AND a.estado = 'activo' 
            ORDER BY a.fecha_inicio DESC
        ");
        $stmt->bindParam(':id_docente', $id_docente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscar($id_actividad, $id_docente)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM actividades_academicas WHERE id_actividad = :id_actividad AND id_docente = :id_docente AND estado = 'activo'");
        $stmt->bindParam(':id_actividad', $id_actividad, PDO::PARAM_INT);
        $stmt->bindParam(':id_docente', $id_docente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function guardar($datos)
    {
        $stmt = $this->conexion->prepare("INSERT INTO actividades_academicas (id_docente, categoria, horas, fecha_inicio, fecha_fin) VALUES (:id_docente, :categoria, :horas, :fecha_inicio, :fecha_fin)");
        $stmt->bindParam(':id_docente', $datos['id_docente'], PDO::PARAM_INT);
        $stmt->bindParam(':categoria', $datos['categoria'], PDO::PARAM_STR);
        $stmt->bindParam(':horas', $datos['horas'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha_inicio', $datos['fecha_inicio'], PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $datos['fecha_fin'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function actualizar($id_actividad, $datos)
    {
        $stmt = $this->conexion->prepare("UPDATE actividades_academicas SET categoria = :categoria, horas = :horas, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id_actividad = :id_actividad AND id_docente = :id_docente");
        $stmt->bindParam(':categoria', $datos['categoria'], PDO::PARAM_STR);
        $stmt->bindParam(':horas', $datos['horas'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha_inicio', $datos['fecha_inicio'], PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $datos['fecha_fin'], PDO::PARAM_STR);
        $stmt->bindParam(':id_actividad', $id_actividad, PDO::PARAM_INT);
        $stmt->bindParam(':id_docente', $datos['id_docente'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function eliminar($id_actividad, $id_docente)
    {
        // Usamos borrado lógico
        $stmt = $this->conexion->prepare("UPDATE actividades_academicas SET estado = 'inactivo' WHERE id_actividad = :id_actividad AND id_docente = :id_docente");
        $stmt->bindParam(':id_actividad', $id_actividad, PDO::PARAM_INT);
        $stmt->bindParam(':id_docente', $id_docente, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
