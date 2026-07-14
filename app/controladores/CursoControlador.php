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
        $cursos = $this->cursoModelo->listar();
        require_once "app/vistas/curso/curso_listado.php";
    }

    public function crear()
    {
        require __DIR__."/../vistas/curso/curso_crear.php";
    }

    public function guardar()
    {
        header('Content-Type: application/json');
        try {
            $json = file_get_contents("php://input");

            $datos = json_decode($json, true);

            if (!$datos) {
                throw new Exception("Datos inválidos");
            }

            $nombre = $datos['nombre'];
            $descripcion = $datos['descripcion'];
            $id_docente = $datos['id_docente'];
            $id_asignatura = $datos['id_asignatura'];
            $horario = $datos['horario'];
            $paralelo = $datos['paralelo'];

            $resultado = $this->cursoModelo->guardar([
                "nombre" => $nombre ,
                "descripcion" => $descripcion,
                "id_docente" => $id_docente,
                "id_asignatura" => $id_asignatura,
                "horario" => $horario,
                "paralelo" => $paralelo
            ]);

            if ($resultado > 0) {
                echo json_encode([
                    "success" => true,
                    "mensaje" => "Curso creado correctamente"
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "mensaje" => "No se pudo crear el curso"
                ]);
            }

        } catch (Exception $e) {

            http_response_code(400);

            echo json_encode([
                "success" => false,
                "mensaje" => $e->getMessage()
            ]);
        }
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
        header('Content-Type: application/json');
        try {
            $json = file_get_contents("php://input");

            $datos = json_decode($json, true);

            if (!$datos) {
                throw new Exception("Datos inválidos");
            }

            $id_curso = $datos['id_curso'];
            $nombre = $datos['nombre'];
            $descripcion = $datos['descripcion'];
            $id_docente = $datos['id_docente'];
            $id_asignatura = $datos['id_asignatura'];
            $estado = $datos['estado'];

            $resultado = $this->cursoModelo->actualizar($id_curso, [
                "nombre" => $nombre ,
                "descripcion" => $descripcion,
                "id_docente" => $id_docente,
                "id_asignatura" => $id_asignatura,
                "estado" => $estado
            ]);

            if ($resultado > 0) {
                echo json_encode([
                    "success" => true,
                    "mensaje" => "Curso actualizado correctamente"
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "mensaje" => "No se pudo actualizar el curso"
                ]);
            }

        } catch (Exception $e) {

            http_response_code(400);

            echo json_encode([
                "success" => false,
                "mensaje" => $e->getMessage()
            ]);
        }
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
        $id_curso = $_GET["id_curso"] ?? '';
        if($id_curso) {
            $this->cursoModelo->eliminar($id_curso);
            header("Location: " . BASE_URL . "/cursos");
            exit();
        }
    }
}
