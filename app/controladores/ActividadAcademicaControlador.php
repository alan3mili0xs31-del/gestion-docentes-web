<?php

require_once __DIR__.'/../modelos/ActividadAcademicaModelo.php';
require_once __DIR__.'/../modelos/DocenteModelo.php';
require_once __DIR__.'/../modelos/AsignaturaModelo.php';

class ActividadAcademicaControlador
{
    private ActividadAcademicaModelo $actividadModelo;
    private DocenteModelo $docenteModelo;
    private AsignaturaModelo $asignaturaModelo;

    public function __construct() {
        $this->actividadModelo = new ActividadAcademicaModelo();
        $this->docenteModelo = new DocenteModelo();
        $this->asignaturaModelo = new AsignaturaModelo();
    }

    public function listar()
    {
        $actividades = $this->actividadModelo->listar();
        require_once "app/vistas/actividad-docente/actividad_listado.php";
    }

    public function crear()
    {
        $docentes = $this->docenteModelo->listar();
        $asignaturas = $this->asignaturaModelo->listar();
        require_once "app/vistas/actividad-docente/actividad_crear.php";
    }

    public function guardar()
    {
        header('Content-Type: application/json');
        try {
            $json = file_get_contents("php://input");
            $datos = json_decode($json, true);

            if (!$datos || empty($datos['id_docente']) || empty($datos['id_asignatura'])) {
                throw new Exception("Datos inválidos o incompletos");
            }

            $resultado = $this->actividadModelo->guardar([
                'id_docente' => $datos['id_docente'],
                'id_asignatura' => $datos['id_asignatura']
            ]);

            if ($resultado > 0) {
                echo json_encode(["success" => true, "mensaje" => "Actividad asignada correctamente"]);
            } else {
                echo json_encode(["success" => false, "mensaje" => "No se pudo asignar la actividad"]);
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["success" => false, "mensaje" => $e->getMessage()]);
        }
    }

    public function editar()
    {
        $id_actividad = $_GET["id_actividad"] ?? '';
        $actividad = $this->actividadModelo->buscar($id_actividad);
        
        if ($actividad) {
            $docentes = $this->docenteModelo->listar();
            $asignaturas = $this->asignaturaModelo->listar();
            require_once "app/vistas/actividad-docente/actividad_editar.php";
        } else {
            require_once "app/vistas/layout/no-encontrado.php";
        }
    }

    public function actualizar()
    {
        header('Content-Type: application/json');
        try {
            $json = file_get_contents("php://input");
            $datos = json_decode($json, true);

            if (!$datos || empty($datos['id_actividad']) || empty($datos['id_docente']) || empty($datos['id_asignatura'])) {
                throw new Exception("Datos inválidos o incompletos");
            }

            $resultado = $this->actividadModelo->actualizar($datos['id_actividad'], [
                'id_docente' => $datos['id_docente'],
                'id_asignatura' => $datos['id_asignatura']
            ]);

            if ($resultado > 0) {
                echo json_encode(["success" => true, "mensaje" => "Actividad actualizada correctamente"]);
            } else {
                echo json_encode(["success" => false, "mensaje" => "No se pudo actualizar la actividad"]);
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["success" => false, "mensaje" => $e->getMessage()]);
        }
    }

    public function eliminar()
    {
        $id_actividad = $_GET["id_actividad"] ?? '';
        if ($id_actividad) {
            $this->actividadModelo->eliminar($id_actividad);
            header("Location: /gestion-docentes-web/actividades-docente");
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
