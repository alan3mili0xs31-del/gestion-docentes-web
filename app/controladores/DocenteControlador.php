<?php

require_once __DIR__.'/../modelos/DocenteModelo.php';

class DocenteControlador
{
    private DocenteModelo $docenteModelo;

    public function __construct() {
        $this->docenteModelo = new DocenteModelo();
    }

    public function listar()
    {
        $docentes = $this->docenteModelo->listar();
        require_once "app/vistas/docente/docente_listado.php";
    }

    public function crear()
    {
        require_once "app/vistas/docente/docente_crear.php";
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

            $primer_nombre = trim($datos['primer_nombre'] ?? '');
            $segundo_nombre = trim($datos['segundo_nombre'] ?? '');

            $primer_apellido = trim($datos['primer_apellido'] ?? '');
            $segundo_apellido = trim($datos['segundo_apellido'] ?? '');

            $especialidad = trim($datos['especialidad'] ?? '');

            $resultado = $this->docenteModelo->guardar([
                'cedula' => $datos['cedula'] ?? '',
                'primer_nombre' => $primer_nombre,
                'segundo_nombre' => $segundo_nombre,
                'primer_apellido' => $primer_apellido,
                'segundo_apellido' => $segundo_apellido,
                'especialidad' => $especialidad,
                'estado' => $datos['estado'] ?? 'activo'
            ]);

            if ($resultado > 0) {
                echo json_encode(["success" => true, "mensaje" => "Docente creado correctamente"]);
            } else {
                echo json_encode(["success" => false, "mensaje" => "No se pudo crear el docente"]);
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["success" => false, "mensaje" => $e->getMessage()]);
        }
    }

    public function editar()
    {
        $id_docente = $_GET["id_docente"] ?? '';
        $docente = $this->docenteModelo->buscar($id_docente);
        if ($docente) {
            require_once "app/vistas/docente/docente_editar.php";
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

            if (!$datos) {
                throw new Exception("Datos inválidos");
            }

            $primer_nombre = trim($datos['primer_nombre'] ?? '');
            $segundo_nombre = trim($datos['segundo_nombre'] ?? '');

            $primer_apellido = trim($datos['primer_apellido'] ?? '');
            $segundo_apellido = trim($datos['segundo_apellido'] ?? '');

            $especialidad = trim($datos['especialidad'] ?? '');

            $resultado = $this->docenteModelo->actualizar($datos['id_docente'], [
                'cedula' => $datos['cedula'] ?? '',
                'primer_nombre' => $primer_nombre,
                'segundo_nombre' => $segundo_nombre,
                'primer_apellido' => $primer_apellido,
                'segundo_apellido' => $segundo_apellido,
                'especialidad' => $especialidad,
                'estado' => $datos['estado'] ?? 'activo'
            ]);

            if ($resultado > 0) {
                echo json_encode(["success" => true, "mensaje" => "Docente actualizado correctamente"]);
            } else {
                echo json_encode(["success" => false, "mensaje" => "No se pudo actualizar el docente"]);
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["success" => false, "mensaje" => $e->getMessage()]);
        }
    }

    public function eliminar()
    {
        $id_docente = $_GET["id_docente"] ?? '';
        if ($id_docente) {
            $this->docenteModelo->eliminar($id_docente);
            header("Location: " . BASE_URL . "/docentes");
            exit();
        }
    }

    public function buscar()
    {
        $id_docente = $_GET["id_docente"] ?? '';
        $docente = $this->docenteModelo->buscar($id_docente);
        if ($docente) {
            require_once "app/vistas/docente/docente_detalle.php";
        } else {
            require_once "app/vistas/layout/no-encontrado.php";
        }
    }
}
