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
        $stmt = $this->conexion->prepare(
            "SELECT id_docente, cedula, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, estado
             FROM docentes
             ORDER BY primer_apellido ASC, primer_nombre ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function buscar($id)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM docentes WHERE id_docente = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function buscarPorCedula($cedula)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM docentes WHERE cedula = :cedula");
        $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }


    public function guardar($datos)
    {
        $stmt = $this->conexion->prepare(
            "INSERT INTO docentes (cedula, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido)
             VALUES (:cedula, :primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido)"
        );
        $stmt->bindParam(':cedula', $datos['cedula']);
        $stmt->bindParam(':primer_nombre', $datos['primer_nombre']);
        $stmt->bindParam(':segundo_nombre', $datos['segundo_nombre']);
        $stmt->bindParam(':primer_apellido', $datos['primer_apellido']);
        $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido']);
        return $stmt->execute();
    }


    public function actualizar($id, $datos)
    {
        $stmt = $this->conexion->prepare(
            "UPDATE docentes SET
                cedula = :cedula,
                primer_nombre = :primer_nombre,
                segundo_nombre = :segundo_nombre,
                primer_apellido = :primer_apellido,
                segundo_apellido = :segundo_apellido,
                fecha_modificacion = NOW()
             WHERE id_docente = :id"
        );
        $stmt->bindParam(':cedula', $datos['cedula']);
        $stmt->bindParam(':primer_nombre', $datos['primer_nombre']);
        $stmt->bindParam(':segundo_nombre', $datos['segundo_nombre']);
        $stmt->bindParam(':primer_apellido', $datos['primer_apellido']);
        $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function eliminar($id)
    {
        $stmt = $this->conexion->prepare("DELETE FROM docentes WHERE id_docente = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
