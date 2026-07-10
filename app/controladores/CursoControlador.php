<?php

require_once '../app/modelos/Curso.php';

class CursoControlador
{
    public function listar()
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
        // 2. Validar la informaciÃ³n.
        // 3. Llamar al modelo para insertar el curso.
        // 4. Redirigir al listado de cursos.
    }

    public function editar()
    {
        // TODO:
        // 1. Obtener el id del curso.
        // 2. Consultar la informaciÃ³n del curso.
        // 3. Mostrar el formulario de ediciÃ³n.
    }

    public function actualizar()
    {
        // TODO:
        // 1. Recibir los datos modificados.
        // 2. Validar la informaciÃ³n.
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
