<?php

require_once __DIR__.'/../modelos/ActividadAcademicaModelo.php';
require_once __DIR__.'/../modelos/DocenteModelo.php';
require_once __DIR__.'/../modelos/CursoModelo.php';

class ActividadAcademicaControlador
{
    private ActividadAcademicaModelo $actividadModelo;
    private DocenteModelo $docenteModelo;
    private CursoModelo $cursoModelo;

    public function __construct()
    {
        $this->actividadModelo = new ActividadAcademicaModelo();
        $this->docenteModelo = new DocenteModelo();
        $this->cursoModelo = new CursoModelo();
    }

    public function listar()
    {
        $usuario_session = $_SESSION["usuario"];
        $actividades = [];

        if ($usuario_session["rol"] != "administrador") {
            $docente = $this->docenteModelo->buscarPorCedula($usuario_session["cedula"]);
            $actividades = $this->actividadModelo->listarMisActividades($docente["id_docente"]);
        } else {
            $actividades = $this->actividadModelo->listar();
        }

        require_once "app/vistas/actividad-docente/actividad_listado.php";
    }

    public function crear()
    {
        $cursos = [];
        if ($_SESSION["usuario"]["rol"] == "administrador") {
            $cursos = $this->cursoModelo->listar();
        } else {
            $docente = $this->docenteModelo->buscarPorCedula($_SESSION["usuario"]["cedula"]);
            $cursos = $this->cursoModelo->listar($docente["id_docente"]);
        }
        require_once "app/vistas/actividad-docente/actividad_crear.php";
    }

    public function guardar()
    {
        header('Content-Type: application/json');

        try {

            $datos = json_decode(file_get_contents("php://input"), true);

            if (
                empty($datos['id_curso']) ||
                empty($datos['titulo']) ||
                empty($datos['categoria']) ||
                empty($datos['fecha_apertura']) ||
                empty($datos['fecha_cierre'])
            ) {
                throw new Exception("Datos inválidos o incompletos.");
            }

            $resultado = $this->actividadModelo->guardar([
                'id_curso'         => $datos['id_curso'],
                'titulo'           => trim($datos['titulo']),
                'descripcion'      => trim($datos['descripcion'] ?? ''),
                'categoria'        => $datos['categoria'],
                'fecha_apertura'   => $datos['fecha_apertura'],
                'fecha_cierre'     => $datos['fecha_cierre']
            ]);

            echo json_encode([
                "success" => $resultado > 0,
                "mensaje" => $resultado > 0
                    ? "Actividad creada correctamente."
                    : "No se pudo crear la actividad."
            ]);

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
        $id_actividad = $_GET["id_actividad"] ?? '';

        $actividad = $this->actividadModelo->buscar($id_actividad);

        if ($actividad) {

            $cursos = $this->cursoModelo->listar();

            require_once "app/vistas/actividad-docente/actividad_editar.php";

        } else {

            require_once "app/vistas/layout/no-encontrado.php";
        }
    }

    public function actualizar()
    {
        header('Content-Type: application/json');

        try {

            $datos = json_decode(file_get_contents("php://input"), true);

            if (
                empty($datos['id_actividad']) ||
                empty($datos['id_curso']) ||
                empty($datos['titulo']) ||
                empty($datos['categoria']) ||
                empty($datos['fecha_apertura']) ||
                empty($datos['fecha_cierre'])
            ) {
                throw new Exception("Datos inválidos o incompletos.");
            }

            $resultado = $this->actividadModelo->actualizar(
                $datos['id_actividad'],
                [
                    'id_curso'         => $datos['id_curso'],
                    'titulo'           => trim($datos['titulo']),
                    'descripcion'      => trim($datos['descripcion'] ?? ''),
                    'categoria'        => $datos['categoria'],
                    'fecha_apertura'   => $datos['fecha_apertura'],
                    'fecha_cierre'     => $datos['fecha_cierre']
                ]
            );

            echo json_encode([
                "success" => $resultado > 0,
                "mensaje" => $resultado > 0
                    ? "Actividad actualizada correctamente."
                    : "No se pudo actualizar la actividad."
            ]);

        } catch (Exception $e) {

            http_response_code(400);

            echo json_encode([
                "success" => false,
                "mensaje" => $e->getMessage()
            ]);
        }
    }

    public function eliminar()
    {
        $id_actividad = $_GET["id_actividad"] ?? '';

        if ($id_actividad) {

            $this->actividadModelo->eliminar($id_actividad);

            header("Location: " . BASE_URL . "/actividades-docente");
            exit();
        }
    }

    public function buscar()
    {
        $id_actividad = $_GET["id_actividad"] ?? '';

        $actividad = $this->actividadModelo->buscar($id_actividad);

        if ($actividad) {

            require_once "app/vistas/actividad-docente/actividad_detalle.php";

        } else {

            require_once "app/vistas/layout/no-encontrado.php";
        }
    }
}
