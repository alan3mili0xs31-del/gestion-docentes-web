<?php

require_once __DIR__.'/../modelos/CursoModelo.php';

class CursoControlador
{
    private CursoModelo $cursoModelo;

    public function __construct() {
        $this->cursoModelo = new CursoModelo();
    }

    public function listar()
    {
        // TODO:
        // 1. Obtener el listado de cursos desde el modelo.
        // 2. Enviar los datos a la vista de listado.
        $cursos = $this->cursoModelo->listar();
        require_once "app/vistas/curso/curso_listado.php";
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


    public function buscar()
    {
        $id_curso = $_GET["id_curso"] ?? '';
        $curso = $this->cursoModelo->buscarPorId($id_curso);
        if ($curso) {
            require_once "app/vistas/curso/curso_detalle.php";
        }
        else {
            require_once "app/vistas/layout/no-encontrado.php";
        }

    }

    public function eliminar()
    {
        // TODO:
        // 1. Obtener el id del curso.
        // 2. Eliminar el registro mediante el modelo.
        // 3. Redirigir al listado.
    }
}
