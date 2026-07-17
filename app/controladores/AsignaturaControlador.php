<?php

require_once __DIR__ . '/../modelos/AsignaturaModelo.php';

class AsignaturaControlador
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new AsignaturaModelo();
    }

    /* ─────────────────────────────────────────
     * GET /asignaturas  → muestra listado HTML
     * ───────────────────────────────────────── */
    public function listar()
    {
        require_once __DIR__ . '/../vistas/asignatura/listado-asignaturas.php';
    }

    /* ─────────────────────────────────────────
     * GET /asignaturas?accion=crear  → formulario
     * ───────────────────────────────────────── */
    public function crear()
    {
        require_once __DIR__ . '/../vistas/asignatura/nueva-asignatura.php';
    }

    /* ─────────────────────────────────────────
     * GET /asignaturas?accion=editar&id=X → formulario edición
     * ───────────────────────────────────────── */
    public function editar()
    {
        $id = intval($_GET['id'] ?? 0);
        $asignatura = $this->modelo->buscar($id);
        require_once __DIR__ . '/../vistas/asignatura/editar-asignatura.php';
    }

    /* ─────────────────────────────────────────
     * API JSON: GET  /asignaturas?accion=api_listar
     * ───────────────────────────────────────── */
    public function api_listar()
    {
        header('Content-Type: application/json; charset=utf-8');
        $facultad = $_GET['facultad'] ?? null;
        $asignaturas = $this->modelo->listar();

        if ($facultad) {
            $asignaturas = array_values(
                array_filter($asignaturas, fn($a) => $a['facultad'] === $facultad)
            );
        }

        echo json_encode(['ok' => true, 'data' => $asignaturas]);
    }

    /* ─────────────────────────────────────────
     * API JSON: GET  /asignaturas?accion=api_buscar&id=X
     * ───────────────────────────────────────── */
    public function api_buscar()
    {
        header('Content-Type: application/json; charset=utf-8');
        $id = intval($_GET['id'] ?? 0);
        $asignatura = $this->modelo->buscar($id);

        if ($asignatura) {
            echo json_encode(['ok' => true, 'data' => $asignatura]);
        } else {
            http_response_code(404);
            echo json_encode(['ok' => false, 'mensaje' => 'Asignatura no encontrada']);
        }
    }

    /* ─────────────────────────────────────────
     * API JSON: POST /asignaturas?accion=guardar
     * ───────────────────────────────────────── */
    public function guardar()
    {
        header('Content-Type: application/json; charset=utf-8');
        $datos = json_decode(file_get_contents('php://input'), true);

        if (!$datos) {
            http_response_code(400);
            echo json_encode(['ok' => false, 'mensaje' => 'Datos inválidos']);
            return;
        }

        $campos = ['codigo', 'nombre', 'creditos', 'semestre', 'facultad'];
        foreach ($campos as $campo) {
            if (empty($datos[$campo])) {
                http_response_code(422);
                echo json_encode(['ok' => false, 'mensaje' => "El campo '$campo' es requerido"]);
                return;
            }
        }

        $datos['creditos'] = intval($datos['creditos']);
        $ok = $this->modelo->guardar($datos);

        if ($ok) {
            echo json_encode(['ok' => true, 'mensaje' => 'Asignatura creada correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['ok' => false, 'mensaje' => 'Error al guardar la asignatura']);
        }
    }

    /* ─────────────────────────────────────────
     * API JSON: PUT /asignaturas?accion=actualizar&id=X
     * ───────────────────────────────────────── */
    public function actualizar()
    {
        header('Content-Type: application/json; charset=utf-8');
        $id = intval($_GET['id'] ?? 0);
        $datos = json_decode(file_get_contents('php://input'), true);

        if (!$datos || !$id) {
            http_response_code(400);
            echo json_encode(['ok' => false, 'mensaje' => 'Datos inválidos']);
            return;
        }

        $datos['creditos'] = intval($datos['creditos']);
        $ok = $this->modelo->actualizar($id, $datos);

        if ($ok) {
            echo json_encode(['ok' => true, 'mensaje' => 'Asignatura actualizada correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['ok' => false, 'mensaje' => 'Error al actualizar la asignatura']);
        }
    }

    /* ─────────────────────────────────────────
     * API JSON: DELETE /asignaturas?accion=eliminar&id=X
     * ───────────────────────────────────────── */
    public function eliminar()
    {
        header('Content-Type: application/json; charset=utf-8');
        $id = intval($_GET['id'] ?? 0);

        if (!$id) {
            http_response_code(400);
            echo json_encode(['ok' => false, 'mensaje' => 'ID no válido']);
            return;
        }

        $ok = $this->modelo->eliminar($id);

        if ($ok) {
            echo json_encode(['ok' => true, 'mensaje' => 'Asignatura eliminada correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['ok' => false, 'mensaje' => 'Error al eliminar la asignatura']);
        }
    }

    /* ─────────────────────────────────────────
     * API JSON: GET /asignaturas?accion=buscar (alias)
     * ───────────────────────────────────────── */
    public function buscar()
    {
        $this->api_buscar();
    }
}
