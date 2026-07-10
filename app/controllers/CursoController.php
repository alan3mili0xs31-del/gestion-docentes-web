<?php

require_once '../app/models/Curso.php';

class CursoController
{
    public function index()
    {
        // TODO:
        // 1. Obtener el listado de cursos desde el modelo.
        // 2. Enviar los datos a la vista de listado.
    }

    public function crear()
    {
        // TODO:
        // Mostrar el formulario para registrar un nuevo curso.
    }

    public function guardar()
    {
        // TODO:
        // 1. Recibir los datos enviados por el formulario ($_POST).
        // 2. Validar la información.
        // 3. Llamar al modelo para insertar el curso.
        // 4. Redirigir al listado de cursos.
    }

    public function editar()
    {
        // TODO:
        // 1. Obtener el id del curso.
        // 2. Consultar la información del curso.
        // 3. Mostrar el formulario de edición.
    }

    public function actualizar()
    {
        // TODO:
        // 1. Recibir los datos modificados.
        // 2. Validar la información.
        // 3. Actualizar el curso mediante el modelo.
        // 4. Redirigir al listado.
    }

    public function eliminar()
    {
        // TODO:
        // 1. Obtener el id del curso.
        // 2. Eliminar el registro mediante el modelo.
        // 3. Redirigir al listado.
    }
}