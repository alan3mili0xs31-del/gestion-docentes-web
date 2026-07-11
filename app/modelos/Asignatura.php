<?php

require_once 'config/Conexion.php';

class Asignatura
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }


    public function listar()
    {
        // TODO:
        // Obtener todas las asignaturas.
    }


    public function buscar($id)
    {
        // TODO:
        // Consultar una asignatura por id.
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
