<?php

require_once 'config/Conexion.php';

class Docente
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
        // TODO:
        // Buscar un docente por su identificador.
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
