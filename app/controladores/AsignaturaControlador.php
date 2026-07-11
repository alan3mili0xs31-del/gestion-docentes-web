<?php

require_once 'app/modelos/AsignaturaModelo.php';

class AsignaturaControlador
{
    public function listar()
    {
        // TODO:
        // 1. Obtener el listado de asignaturas desde el modelo.
        // 2. Enviar los datos a la vista de listado.
        require_once "app/vistas/asignatura/listado-asignaturas.html";
    }

    public function crear()
    {
        // TODO:
        // Mostrar el formulario para registrar un nuevo asignatura.
    }

    public function guardar()
    {
        // TODO:
        // 1. Recibir los datos enviados por el formulario ($_POST).
        // 2. Validar la informaciÃ³n.
        // 3. Llamar al modelo para insertar el asignatura.
        // 4. Redirigir al listado de asignaturas.
    }

    public function editar()
    {
        // TODO:
        // 1. Obtener el id del asignatura.
        // 2. Consultar la informaciÃ³n del asignatura.
        // 3. Mostrar el formulario de ediciÃ³n.
    }

    public function actualizar()
    {
        // TODO:
        // 1. Recibir los datos modificados.
        // 2. Validar la informaciÃ³n.
        // 3. Actualizar el asignatura mediante el modelo.
        // 4. Redirigir al listado.
    }

    public function eliminar()
    {
        // TODO:
        // 1. Obtener el id del asignatura.
        // 2. Eliminar el registro mediante el modelo.
        // 3. Redirigir al listado.
    }
}
