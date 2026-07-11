<?php

require_once 'app/modelos/ActividadAcademicaModelo.php';

class ActividadAcademicaControlador
{
    public function listar()
    {
        // TODO:
        // 1. Obtener el listado de actividad academicas desde el modelo.
        // 2. Enviar los datos a la vista de listado.
    }

    public function crear()
    {
        // TODO:
        // Mostrar el formulario para registrar un nuevo actividad academica.
    }

    public function guardar()
    {
        // TODO:
        // 1. Recibir los datos enviados por el formulario ($_POST).
        // 2. Validar la informaciÃ³n.
        // 3. Llamar al modelo para insertar el actividad academica.
        // 4. Redirigir al listado de actividad academicas.
    }

    public function editar()
    {
        // TODO:
        // 1. Obtener el id del actividad academica.
        // 2. Consultar la informaciÃ³n del actividad academica.
        // 3. Mostrar el formulario de ediciÃ³n.
    }

    public function actualizar()
    {
        // TODO:
        // 1. Recibir los datos modificados.
        // 2. Validar la informaciÃ³n.
        // 3. Actualizar el actividad academica mediante el modelo.
        // 4. Redirigir al listado.
    }

    public function eliminar()
    {
        // TODO:
        // 1. Obtener el id del actividad academica.
        // 2. Eliminar el registro mediante el modelo.
        // 3. Redirigir al listado.
    }
}
