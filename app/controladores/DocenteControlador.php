<?php

require_once __DIR__.'/../modelos/DocenteModelo.php';

class DocenteControlador
{
    public function listar()
    {
        // TODO:
        // 1. Obtener el listado de docentes desde el modelo.
        // 2. Enviar los datos a la vista de listado.
        require_once "app/vistas/docente/listado-docentes.html";
    }

    public function crear()
    {
        // TODO:
        // Mostrar el formulario para registrar un nuevo docente.
    }

    public function guardar()
    {
        // TODO:
        // 1. Recibir los datos enviados por el formulario ($_POST).
        // 2. Validar la informaciÃ³n.
        // 3. Llamar al modelo para insertar el docente.
        // 4. Redirigir al listado de docentes.
    }

    public function editar()
    {
        // TODO:
        // 1. Obtener el id del docente.
        // 2. Consultar la informaciÃ³n del docente.
        // 3. Mostrar el formulario de ediciÃ³n.
    }

    public function actualizar()
    {
        // TODO:
        // 1. Recibir los datos modificados.
        // 2. Validar la informaciÃ³n.
        // 3. Actualizar el docente mediante el modelo.
        // 4. Redirigir al listado.
    }

    public function eliminar()
    {
        // TODO:
        // 1. Obtener el id del docente.
        // 2. Eliminar el registro mediante el modelo.
        // 3. Redirigir al listado.
    }
}
