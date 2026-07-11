<?php

require_once 'config/Conexion.php';

class Asistencia
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }


    public function listar()
    {
        // TODO:
        // Consultar registros de asistencia.
    }


    public function buscar($id)
    {
        // TODO:
        // Buscar una asistencia por identificador.
    }


    public function guardar($datos)
    {
        // TODO:
        // Registrar una nueva asistencia.
    }


    public function actualizar($id, $datos)
    {
        // TODO:
        // Actualizar un registro de asistencia.
    }


    public function eliminar($id)
    {
        // TODO:
        // Eliminar un registro de asistencia.
    }
}
