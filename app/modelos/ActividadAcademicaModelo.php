<?php

require_once 'config/Conexion.php';

class ActividadAcademica
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }


    public function listar()
    {
        // TODO:
        // Obtener todas las actividades académicas.
    }


    public function buscar($id)
    {
        // TODO:
        // Consultar una actividad por identificador.
    }


    public function guardar($datos)
    {
        // TODO:
        // Registrar una nueva actividad académica.
    }


    public function actualizar($id, $datos)
    {
        // TODO:
        // Actualizar una actividad académica.
    }


    public function eliminar($id)
    {
        // TODO:
        // Eliminar una actividad académica.
    }
}
