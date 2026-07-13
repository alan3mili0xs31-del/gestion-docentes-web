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
        // TODO:
        // Consultar todos los docentes registrados.
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
        // TODO:
        // Insertar un nuevo docente.
    }


    public function actualizar($id, $datos)
    {
        // TODO:
        // Actualizar los datos de un docente.
    }


    public function eliminar($id)
    {
        // TODO:
        // Eliminar un docente por su identificador.
    }
}
