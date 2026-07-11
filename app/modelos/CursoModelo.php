<?php

require_once 'config/Conexion.php';

class Curso
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }


    public function listar()
    {
        // TODO:
        // Obtener todos los cursos registrados.
    }


    public function buscar($id)
    {
        // TODO:
        // Buscar un curso por su identificador.
    }


    public function guardar($datos)
    {
        // TODO:
        // Registrar un nuevo curso.
    }


    public function actualizar($id, $datos)
    {
        // TODO:
        // Modificar la información de un curso.
    }


    public function eliminar($id)
    {
        // TODO:
        // Eliminar un curso.
    }
}
