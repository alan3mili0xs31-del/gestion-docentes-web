<?php

require_once __DIR__.'/../modelos/AsignaturaModelo.php';

class AsignaturaControlador
{
    private AsignaturaModelo $asignaturaModelo;

    public function __construct() {
        $this->asignaturaModelo = new AsignaturaModelo();
    }

    public function listar()
    {
        $asignaturas = $this->asignaturaModelo->listar();
        require_once "app/vistas/asignatura/asignatura_listado.php";
    }

    public function crear()
    {
        require_once "app/vistas/asignatura/asignatura_crear.php";
    }

    public function guardar()
    {
        header('Content-Type: application/json');
        try {
            $json = file_get_contents("php://input");
            $datos = json_decode($json, true);

            if (!$datos || empty($datos['nombre'])) {
                throw new Exception("Datos inválidos o incompletos");
            }

            $resultado = $this->asignaturaModelo->guardar([
                'nombre' => trim($datos['nombre']),
                'estado' => $datos['estado'] ?? 'activo'
            ]);

            if ($resultado > 0) {
                echo json_encode(["success" => true, "mensaje" => "Asignatura creada correctamente"]);
            } else {
                echo json_encode(["success" => false, "mensaje" => "No se pudo crear la asignatura"]);
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["success" => false, "mensaje" => $e->getMessage()]);
        }
    }

    public function editar()
    {
        $id_asignatura = $_GET["id_asignatura"] ?? '';
        $asignatura = $this->asignaturaModelo->buscar($id_asignatura);
        if ($asignatura) {
            require_once "app/vistas/asignatura/asignatura_editar.php";
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

            if (!$datos || empty($datos['id_asignatura']) || empty($datos['nombre'])) {
                throw new Exception("Datos inválidos o incompletos");
            }

            $resultado = $this->asignaturaModelo->actualizar($datos['id_asignatura'], [
                'nombre' => trim($datos['nombre']),
                'estado' => $datos['estado'] ?? 'activo'
            ]);

            if ($resultado > 0) {
                echo json_encode(["success" => true, "mensaje" => "Asignatura actualizada correctamente"]);
            } else {
                echo json_encode(["success" => false, "mensaje" => "No se pudo actualizar la asignatura"]);
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["success" => false, "mensaje" => $e->getMessage()]);
        }
    }

    public function eliminar()
    {
        $id_asignatura = $_GET["id_asignatura"] ?? '';
        if ($id_asignatura) {
            $this->asignaturaModelo->eliminar($id_asignatura);
            header("Location: " . BASE_URL . "/asignaturas");
            exit();
        }
    }

    public function buscar()
    {
        $id_asignatura = $_GET["id_asignatura"] ?? '';
        $asignatura = $this->asignaturaModelo->buscar($id_asignatura);
        if ($asignatura) {
            require_once "app/vistas/asignatura/asignatura_detalle.php";
        } else {
            require_once "app/vistas/layout/no-encontrado.php";
        }
    }
}
